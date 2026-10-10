<?php

namespace App\Http\Controllers;

use App\Models\Bb;
use App\Models\Location;
use App\Models\Rubric;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CatalogController extends Controller
{
    /**
     * Страница каталога — «Аренда» (/rent) и «Продажа» (/sale),
     * а также подборка по конкретной категории:
     * /rent/{rubric}, /sale/{rubric}.
     *
     * Один Blade-шаблон resources/views/catalog/index.blade.php обслуживает
     * обе страницы: различаются $priceUnit (руб/час ↔ руб/смена) и $isSale.
     *
     * Корневые рубрики секций совпадают с RubricsController::location():
     *   id 1   → «Аренда»
     *   id 118 → «Продажа»
     *
     * ВСЕ фильтры (город, категория, сортировка, вид списка, пагинация)
     * работают без перезагрузки: тот же роут отвечает JSON с готовыми
     * HTML-фрагментами, если запрос пришёл с заголовком X-Requested-With
     * (см. ветку `$request->ajax()` ниже). Полная страница и фрагменты
     * рендерятся из одних и тех же partials — разметка не дублируется.
     * Клиентская часть — public/js/catalog-filters.js.
     */
    public function index(Request $request, $rubric = null)
    {
        $data = $this->catalogData($request, $rubric);

        // AJAX: тот же роут отдаёт JSON с готовыми HTML-фрагментами
        // (сайдбар фильтров + основная колонка). Полная страница и фрагменты
        // рендерятся из одних partials, поэтому разметка не дублируется.
        // Признак — заголовок X-Requested-With (JS) или Accept: application/json.
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'sidebar' => view('catalog.partials.sidebar', $data)->render(),
                'main'    => view('catalog.partials.main', $data)->render(),
                'title'   => $data['pageTitle'] . ' — ' . config('site.name'),
                'crumb'   => $data['pageTitle'],
                'heading' => $data['currentCategoryName'],
                'counter' => 'Найдено: ' . $data['equipments']->total(),
                'total'   => $data['equipments']->total(),
                // Путь с query без схемы/хоста: history.pushState() в
                // catalog-filters.js принимает относительные URL.
                'url'     => current_url(),
            ]);
        }

        return view('catalog.index', $data);
    }

    /**
     * Единая сборка данных каталога для полной страницы и AJAX-фрагментов.
     *
     * Возвращает полный набор переменных шаблона — все они ожидаются
     * partials (catalog.partials.sidebar / catalog.partials.main) и
     * catalog/index.blade.php.
     */
    private function catalogData(Request $request, $rubric = null): array
    {
        // --- Секция: rent / sale (из первого сегмента URL) ---
        $isSale = ($request->segment(1) === 'sale');
        $rootId = $isSale ? 118 : 1;

        // Конкретная категория или корень секции.
        $rubricModel = $rubric
            ? Rubric::findOrFail($rubric)
            : Rubric::findOrFail($rootId);

        // Все рубрики-потомки + сама рубрика → диапазон объявлений.
        $rubricIds = Rubric::descendantsAndSelf($rubricModel->id)->pluck('id');

        // --- Активные фильтры: город · сортировка · вид списка ---
        // Нормализуются в одном месте, поэтому одинаково работают и при
        // обычной загрузке страницы, и при AJAX-запросе того же URL.
        $cityId = $request->filled('city_id') ? $request->input('city_id') : null;
        $sort   = in_array($request->input('sort'), ['date', 'price'], true) ? $request->input('sort') : 'date';
        $view   = in_array($request->input('view'), ['grid', 'list'], true) ? $request->input('view') : 'list';

        // Непустые фильтры (без page) — подставляются в ссылки фильтров
        // и категорий, чтобы переход не сбрасывал соседние параметры.
        $listQuery = array_filter([
            'city_id' => $cityId,
            'sort'    => $sort !== 'date' ? $sort : null,
            'view'    => $view !== 'list' ? $view : null,
        ], fn ($value) => $value !== null && $value !== '');

        // --- Пагинированный список объявлений (запрос как в RubricsController) ---
        $query = Bb::query()
            ->select('bbs.*')
            ->join('status_bbs', 'bbs.status_bb_id', '=', 'status_bbs.id')
            ->where('status_bbs.active', 'Y')
            ->whereIn('rubric_id', $rubricIds)
            ->when($cityId, function ($q) use ($cityId) {
                $q->where('bbs.location_id', $cityId);
            })
            ->orderBy('status_bbs.sort_on_board', 'asc');   // приоритет «на доске» — всегда первый

        if ($sort === 'price') {
            // «по цене»: bb_prices — hasOne (одна строка на объявление → без дублей)
            $query->leftJoin('bb_prices', 'bb_prices.bb_id', '=', 'bbs.id')
                  ->orderBy('bb_prices.price', 'asc')
                  ->orderBy('bbs.created_at', 'desc');
        } else {
            // «по дате» (по умолчанию): свежие поднятия — выше
            $query->orderBy('lifted_at', 'desc')
                  ->orderBy('bbs.created_at', 'desc');
        }

        $equipments = $query->paginate(12)
            ->withQueryString();    // ?city_id=&sort=&view= сохраняются в пагинации

        // --- Города для фильтра «Город подачи» ---
        // level 1 — областные центры и крупные города РБ (id + title).
        // Пустого значения в списке нет: опция-плейсхолдер «Все города»
        // рендерится в partials/sidebar.blade.php.
        $filterCities = Location::where('level', 1)->orderBy('title')->get(['id', 'title']);

        // --- Подкатегории текущей рубрики со счётчиком объявлений ---
        // withAdsCount() считает АКТИВНЫЕ объявления с учётом вложенных рубрик
        // (объявления привязаны к рубрикам 2-го уровня, а в списке — 1-й)
        // → атрибут ads_count, который читает шаблон.
        $categories = Rubric::where('parent_id', $rubricModel->id)
            ->withAdsCount()
            ->orderBy('sort')
            ->orderBy('title')
            ->get();

        // Если у открытой рубрики нет вложенных (объявления привязаны к ней
        // самой) — показываем её соседей по уровню: блок «Категории» не должен
        // оставаться пустым, а текущая категория подсвечивается активной
        // ($catActive в шаблоне).
        if ($categories->isEmpty() && $rubricModel->parent_id) {
            $categories = Rubric::where('parent_id', $rubricModel->parent_id)
                ->withAdsCount()
                ->orderBy('sort')
                ->orderBy('title')
                ->get();
        }

        // --- Подписи цены и кнопки (единица тарификации) ---
        $priceUnit   = $isSale ? 'руб/смена' : 'руб/час';
        $priceLabel  = $isSale ? 'Цена' : 'Цена от';
        $actionLabel = 'Подробнее';

        // --- Идентификатор открытой рубрики: шаблон подсвечивает её в сайдбаре
        //     (класс is-active) и показывает ссылку «← Все категории». ---
        $currentRubricId    = $rubricModel->id;
        $currentRubricTitle = $rubricModel->title;

        // --- Заголовки страницы ---
        // H1 — лаконичный: «Продажа дорожно-строительной техники» (+ «в г. …»).
        // TITLE (шаблон добавляет хвост «— цены, каталог объявлений на landi.by»):
        //   корень секции — generic «Продажа строительной техники»;
        //   подрубрика    — её название, чтобы у каждой категории был уникальный title.
        $pageTitle = $isSale ? 'Продажа строительной техники' : 'Аренда строительной техники';
        $currentCategoryName = $rubricModel->title();       // умеет «Аренда/Продажа + категория»
        if ($request->city_id && ($city = Location::find($request->city_id))) {
            $pageTitle           .= ' в ' . $city->title_r;
            $currentCategoryName .= ' в ' . $city->title_r;
        }

        // Открыта конкретная подрубрика (не корень секции /rent|/sale):
        // title берём её название — иначе все категории секции имели бы
        // дублирующийся generic-заголовок «Продажа/Аренда строительной техники».
        if ($rubricModel->id !== $rootId) {
            $pageTitle = $currentCategoryName;
        }

        // SEO: картинка Open Graph. Для каталога — 1-я загруженная картинка
        //       первого объявления; иначе placeholder 1200×630.
        $ogImage = $this->seoImage($request->city_id, $equipments);

        // --- Полный набор переменных для шаблонов ---------------------------
        // $view / $sort — активные состояния панели (partials/main.blade.php);
        // $listQuery   — непустые фильтры без page: подставляются в ссылки
        //                категорий и сортировки, чтобы переход не сбрасывал
        //                соседние параметры.
        return compact(
            'pageTitle',
            'currentCategoryName',
            'equipments',
            'categories',
            'filterCities',
            'priceUnit',
            'priceLabel',
            'actionLabel',
            'isSale',
            'currentRubricId',
            'currentRubricTitle',
            'rootId',
            'sort',
            'view',
            'listQuery',
            'ogImage',
        );
    }

    /**
     * Страница «Весь каталог» — все категории (рубрики 1-го уровня) обеих
     * секций, сгруппированные по корню («Аренда» / «Продажа»).
     * Счётчик объявлений — с учётом вложенных рубрик (scopeWithAdsCount),
     * общий список отсортирован по количеству объявлений по убыванию.
     */
    public function categories()
    {
        $cats = Rubric::query()
            ->where('rubrics.level', 1) // qualified: scopeWithAdsCount делает self-join
            ->withAdsCount()
            ->orderByDesc('ads_count')
            ->orderBy('title')
            ->get();

        return view('catalog.categories', [
            'pageTitle'      => 'Все категории спецтехники',
            'rentCategories' => $cats->where('parent_id', 1)->values(),
            'saleCategories' => $cats->where('parent_id', 118)->values(),
        ]);
    }

    /**
     * Страница «Все объявления» — все активные объявления без привязки
     * к секции (аренда/продажа) и категории. Запрос аналогичен index()
     * без фильтра по рубрикам.
     */
    public function ads()
    {
        $equipments = Bb::query()
            ->select('bbs.*')
            ->join('status_bbs', 'bbs.status_bb_id', '=', 'status_bbs.id')
            ->where('status_bbs.active', 'Y')
            ->with(['location', 'bbprice.pricetype', 'BbParameters.parameters'])
            ->orderBy('status_bbs.sort_on_board', 'asc')
            ->orderBy('lifted_at', 'desc')
            ->orderBy('bbs.created_at', 'desc')
            ->paginate(12);

        return view('ads.index', [
            'pageTitle'  => 'Все объявления',
            'equipments' => $equipments,
        ]);
    }

    /**
     * SEO: Open Graph для страницы каталога/локации — 1200×630.
     *
     * Приоритет источника: картинка локации (города) → первая картинка
     * первого объявления → placeholder.
     *
     * @param  int|string|null  $cityId  id локации (null для корневого каталога)
     * @param  mixed  $listings  пагинатор/коллекция объявлений страницы
     */
    private function seoImage($cityId, $listings): string
    {
        $city = $cityId ? Location::find($cityId) : null;

        if ($city && $city->image) {
            return (string) Storage::url($city->resizeImage($city->image, 1200, 630));
        }

        if ($listings && method_exists($listings, 'isNotEmpty') && $listings->isNotEmpty()) {
            $first = $listings->first();

            if ($first->image) {
                return (string) Storage::url($first->resizeImage($first->image, 1200, 630));
            }

            if (method_exists($first, 'images') && ($img = $first->images()->first())) {
                return (string) Storage::url($img->resize(1200, 630));
            }
        }

        // Fallback: картинка первого города (для корневого каталога).
        if (! $city && ($fallback = Location::where('level', 1)->first()) && $fallback->image) {
            return (string) Storage::url($fallback->resizeImage($fallback->image, 1200, 630));
        }

        return asset('images/placeholder/no-image.jpg');
    }
}
