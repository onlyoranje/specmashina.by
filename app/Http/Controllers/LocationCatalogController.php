<?php

namespace App\Http\Controllers;

use App\Models\Bb;
use App\Models\Location;
use App\Models\Rubric;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Локационный хаб каталога (редизайн 2026) — страница /location/{location}.
 *
 * Выводит ВСЕ активные объявления (аренда + продажа) выбранной локации:
 * H1 «Строительная техника в г. {город}», локальные фильтры (категории
 * города + радиус поиска), лента карточек-«билетов», карта региона.
 * Визуальный стиль — catalog/location.blade.php + public/css/location.css.
 *
 * Контракт данных шаблона (см. шапку catalog/location.blade.php):
 *   $city, $listings, $localCategories, $sort, $view, $radius,
 *   $listQuery, $mapPoints.
 *
 * Поддержка старых ссылок: виджет category_location.blade.php и прочие
 * передают категорию как ?rubric={id} — читаем и её (category приоритетнее).
 */
class LocationCatalogController extends Controller
{
    private const PER_PAGE = 12;

    public function show(Request $request, $id)
    {
        $location = Location::findOrFail($id);

        // --- Нормализация фильтров: сортировка · вид · радиус · категория ---
        $sort   = in_array($request->input('sort'), ['date', 'price'], true) ? $request->input('sort') : 'date';
        $view   = in_array($request->input('view'), ['grid', 'list'], true) ? $request->input('view') : 'list';
        $radius = in_array($request->input('radius'), ['0', '10', '30', 'region'], true) ? $request->input('radius') : '0';

        $categoryId = $request->input('category') ?: $request->input('rubric');
        $category   = $categoryId ? Rubric::find((int) $categoryId) : null;

        // Непустые фильтры (без page) — подставляются в ссылки фильтров
        // и категорий, чтобы переход не сбрасывал соседние параметры.
        $listQuery = array_filter([
            'category' => $category->id ?? null,
            'radius'   => $radius !== '0' ? $radius : null,
            'sort'     => $sort !== 'date' ? $sort : null,
            'view'     => $view !== 'list' ? $view : null,
        ], fn ($value) => $value !== null && $value !== '');

        // --- 1. Гео-диапазон: id локаций, попадающие в выбранный радиус ---
        $allowedLocationIds = $this->allowedLocationIds($location, $radius);

        // --- 2. Рубрики: выбранная категория + все её потомки ---
        $rubricIds = $category
            ? Rubric::descendantsAndSelf($category->id)->pluck('id')
            : null;

        // --- 3. Лента объявлений локации (порядок как в CatalogController) ---
        $query = Bb::query()
            ->select('bbs.*')
            ->join('status_bbs', 'bbs.status_bb_id', '=', 'status_bbs.id')
            ->where('status_bbs.active', 'Y')
            ->whereIn('bbs.location_id', $allowedLocationIds)
            ->when($rubricIds, fn ($q) => $q->whereIn('bbs.rubric_id', $rubricIds))
            ->with(['location', 'bbprice.pricetype'])
            ->orderBy('status_bbs.sort_on_board', 'asc');   // приоритет «на доске»

        if ($sort === 'price') {
            $query->leftJoin('bb_prices', 'bb_prices.bb_id', '=', 'bbs.id')
                  ->orderBy('bb_prices.price', 'asc')
                  ->orderBy('bbs.created_at', 'desc');
        } else {
            $query->orderBy('lifted_at', 'desc')
                  ->orderBy('bbs.created_at', 'desc');
        }

        $listings = $query->paginate(self::PER_PAGE)->withQueryString();

        // --- 4. Категории, реально присутствующие в выбранном радиусе ---
        $localCategories = $this->localCategories($allowedLocationIds);

        // --- 5. Маркеры карты: объявления текущей страницы с координатами ---
        $mapPoints = $listings->getCollection()
            ->filter(fn ($bb) => $bb->location && $bb->location->lat && $bb->location->lng)
            ->map(fn ($bb) => [
                'lat'   => (float) $bb->location->lat,
                'lng'   => (float) $bb->location->lng,
                'title' => method_exists($bb, 'title') ? $bb->title() : $bb->title,
                'price' => (float) ($bb->bbprice?->price ?? 0),
            ])
            ->values();

        return view('catalog.location', [
            'city'            => $location,
            'listings'        => $listings,
            'localCategories' => $localCategories,
            'sort'            => $sort,
            'view'            => $view,
            'radius'          => $radius,
            'listQuery'       => $listQuery,
            'mapPoints'       => $mapPoints,
        ]);
    }

    /**
     * id локаций, попадающие в выбранный радиус поиска.
     *   0      → только сам город;
     *   10/30  → все локации с координатами в радиусе N км (haversine) + город;
     *   region → вся область: потомки корневого региона + сам он.
     */
    private function allowedLocationIds(Location $location, string $radius): array
    {
        if ($radius === 'region') {
            $rootId = $location->parent_id ?: $location->id;

            return Location::descendantsAndSelf($rootId)->pluck('id')->all();
        }

        if (in_array($radius, ['10', '30'], true) && $location->lat && $location->lng) {
            $ids = Location::query()
                ->whereNotNull('lat')
                ->whereNotNull('lng')
                ->select('id')
                ->selectRaw(
                    '(6371 * acos(cos(radians(?)) * cos(radians(lat)) '
                    .'* cos(radians(lng) - radians(?)) '
                    .'+ sin(radians(?)) * sin(radians(lat)))) as distance',
                    [$location->lat, $location->lng, $location->lat]
                )
                ->having('distance', '<=', (int) $radius)
                ->pluck('id');

            return $ids->push($location->id)->unique()->all();
        }

        // «Только в городе» (и fallback, если у города нет координат)
        return [$location->id];
    }

    /**
     * Рубрики 1-го уровня, в которых в выбранном радиусе есть активные
     * объявления. Объявления привязаны к рубрикам 2-го уровня, поэтому
     * категория-предок определяется через вложенные множества (_lft/_rgt).
     * Возвращает строки: id / title / title_r / count (атрибут count).
     */
    private function localCategories(array $locationIds)
    {
        return DB::table('bbs')
            ->join('status_bbs', 'bbs.status_bb_id', '=', 'status_bbs.id')
            ->join('rubrics as leaf', 'bbs.rubric_id', '=', 'leaf.id')
            ->join('rubrics as cat', function ($join) {
                $join->on('cat._lft', '<=', 'leaf._lft')
                     ->on('cat._rgt', '>=', 'leaf._rgt')
                     ->where('cat.level', 1);
            })
            ->where('status_bbs.active', 'Y')
            ->whereIn('bbs.location_id', $locationIds)
            ->groupBy('cat.id', 'cat.title', 'cat.title_r')
            ->orderBy('cat.title')
            ->get([
                'cat.id',
                'cat.title',
                'cat.title_r',
                DB::raw('count(*) as count'),
            ]);
    }
}

