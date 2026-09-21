<?php

namespace App\Http\Controllers;

use App\Models\Bb;
use App\Models\Rubric;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Две точки входа на /search:
     *
     * 1) Виджет «Поиск техники» на главной (редизайн 2026) — передаёт
     *    type (rent|sale), category_id, city. Отправляем пользователя в
     *    каталог нового фронтенда (/rent, /sale), где уже работают все
     *    фильтры (город, категория, сортировка, AJAX-обновление) и
     *    карточки объявлений в актуальном дизайне.
     * 2) Текстовый поиск (q) со старых страниц (widgets/search_mini) —
     *    легаси-страница результатов сохранена без изменений.
     */
    public function search_result(Request $request)
    {
        // Виджет всегда шлёт type/category_id/city и никогда — q.
        if (! $request->filled('q')) {
            return $this->redirectToCatalog($request);
        }

        // Базовый запрос: только активные объявления
        $query = Bb::where('active', 'Y');

        // --- Фильтры поискового виджета на главной (редизайн 2026) ---
        // Категория техники -> rubric_id
        if ($request->filled('category_id')) {
            $query->where('rubric_id', (int) $request->integer('category_id'));
        }

        // Город -> location_id
        if ($request->filled('city')) {
            $query->where('location_id', (int) $request->integer('city'));
        }

        // Тип сделки (rent/sale) приходит только из виджета на главной —
        // он обрабатывается redirectToCatalog() (редирект в /rent или /sale).
        // Текстовый поиск легаси-страницы не разделяет секции.
        $type = $request->query('type') === 'sale' ? 'sale' : 'rent';

        // --- Текстовый поиск (легаси-поведение сохранено) ---
        $text = trim((string) $request->query('q', ''));
        $text = preg_replace("|\b[\d\w]{1,3}\b|i", '', $text);
        $text = preg_replace('/[\p{P}]/u', '', $text);

        if ($text !== '') {
            $words = preg_split('/\s+/', $text, -1, PREG_SPLIT_NO_EMPTY);

            // Скоринг: сколько слов запроса нашлось в search_text
            $score = [];
            foreach ($words as $word) {
                Bb::where('search_text', 'LIKE', '%' . $word . '%')
                    ->where('active', 'Y')
                    ->select('id')
                    ->chunk(500, function ($bbs) use (&$score, $word) {
                        foreach ($bbs as $bb) {
                            $score[$bb->id][] = $word;
                        }
                    });
            }

            if (count($score) > 0) {
                uasort($score, static function ($a, $b) {
                    return count($a) < count($b);
                });

                // Релевантность поверх фильтров виджета
                $ids = array_keys($score);
                $query->whereIn('id', $ids)
                      ->orderByRaw('FIELD(id, ' . implode(',', $ids) . ')');
            } else {
                // По тексту ничего не найдено — отдаём пустой результат
                $query->whereRaw('1 = 0');
            }
        }

        $result_bb = $query->paginate(15)->withQueryString();

        return view('search.result', [
            'bbs'   => $result_bb,
            'query' => $text,
            'type'  => $type,
        ]);
    }

    /**
     * Редирект из виджета «Поиск техники» на главной в каталог редизайна.
     *
     * Секция (Аренда / Продажа) определяется по КОРНЕВОЙ рубрике выбранной
     * категории — так выбор категории из другой секции не даёт пустой
     * выдачи, а вкладка виджета влияет только когда категория не выбрана.
     * Корневые рубрики секций — те же, что использует CatalogController:
     *   id 1   → «Аренда»  (/rent)
     *   id 118 → «Продажа» (/sale)
     *
     * Город из виджета (name="city") маппится в city_id — параметр фильтра
     * каталога, он попадёт и в список, и в выбранный <select> сайдбара.
     */
    private function redirectToCatalog(Request $request): \Illuminate\Http\RedirectResponse
    {
        $section     = null;
        $rubricParam = null;

        if ($request->filled('category_id')) {
            $rubric = Rubric::find((int) $request->integer('category_id'));

            if ($rubric) {
                $rubricParam = $rubric->id;

                // Поднимаемся по дереву до корневой рубрики секции
                // (уровень 0): «Аренда» (id 1) или «Продажа» (id 118).
                $root = $rubric;
                while ($root->parent_id) {
                    $root = $root->parent;
                }

                $section = ((int) $root->id === 118) ? 'sale' : 'rent';
            }
        }

        // Категория не выбрана (или не найдена) — секцию задаёт вкладка виджета
        // (rent активна по умолчанию, см. скрытый инпут #search-type).
        $section = $section ?? (($request->query('type') === 'sale') ? 'sale' : 'rent');

        $query = array_filter([
            'city_id' => $request->filled('city') ? (int) $request->integer('city') : null,
        ], fn ($value) => $value !== null && $value !== '');

        // /rent/{rubric}?city_id=… или /rent?city_id=… (вся секция)
        if ($rubricParam) {
            $query = ['rubric' => $rubricParam] + $query;
        }

        return redirect()->route($section . '.index', $query);
    }
}
