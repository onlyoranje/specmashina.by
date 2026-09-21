{{-- ==========================================================================
   ПАРТИАЛ: САЙДБАР ФИЛЬТРОВ КАТАЛОГА
   resources/views/catalog/partials/sidebar.blade.php
   ==========================================================================
   Рендерится и в полной странице (catalog/index.blade.php), и в AJAX-ответе
   CatalogController::index() — разметка не дублируется.

   Переменные (data contract, см. CatalogController::catalogData()):
     $filterCities        → города: id + title (для <select name="city_id">)
     $categories          → рубрики: id + title + ads_count
     $isSale              → секция «Продажа» (иначе «Аренда»)
     $rootId              → id корневой рубрики секции (1 / 118)
     $currentRubricId     → id открытой рубрики (подсветка is-active)
     $currentRubricTitle  → её название
     $listQuery           → непустые фильтры (city_id/sort/view) для ссылок

   Все элементы-навигаторы несут атрибут data-ajax-link: JS перехватывает
   клик и подгружает фрагменты без перезагрузки (public/js/catalog-filters.js).
   href остаётся рабочим — без JS фильтры работают как обычные GET-ссылки.
   ========================================================================== --}}

      <aside class="catalog-sidebar" id="catalog-sidebar" aria-label="Фильтры поиска">

        {{-- Блок «Города»: стилизованный select для быстрой фильтрации.
             На мобильных — скрываемая/раскрываемая плашка (<details>).
             Форма нужна как fallback без JS; JS перехватывает submit и
             подгружает результаты AJAX-ом. Скрытые sort/view сохраняют
             соседние фильтры при обычной отправке формы. --}}
        <details class="filter-block" open>
          <summary class="filter-summary">Города</summary>
          <div class="filter-body">
            <form method="get" action="{{ url()->current() }}" class="city-filter-form">
              <label class="city-filter-label" for="city_id">Город подачи</label>
              {{-- Выбор города обрабатывает public/js/catalog-filters.js (событие change,
                   без перезагрузки). Инлайнового onchange нет намеренно: form.submit()
                   выполняется до делегированного обработчика и вызывал бы перезагрузку.
                   Без JS работает кнопка «Показать» из <noscript> ниже. --}}
              @php
                // Активный город берём из нормализованного $listQuery: туда
                // контроллер кладёт только реально применённый фильтр. Если
                // сравнивать с сырым request('city_id'), пустое/битое значение
                // не совпадёт ни с одним пунктом и браузер подставит первый
                // город списка — фильтр будет выглядеть применённым.
                $activeCityId = $listQuery['city_id'] ?? null;
              @endphp
              <select class="catalog-select" name="city_id" id="city_id" data-filter="city_id">
                {{-- Плейсхолдер: пустое значение = без фильтра → показываем объявления
                     по всем городам. Рендерится всегда, чтобы при первой загрузке
                     (/rent, /sale) в поле не подставлялся первый город списка. --}}
                <option value="" @if (! $activeCityId) selected @endif>Все города</option>
                @foreach ($filterCities as $city)
                  @php
                    $cityId   = $city->id ?? $city['id'];
                    $cityName = $city->title ?? $city['title'];
                  @endphp
                  <option value="{{ $cityId }}"
                    @if ((string) $activeCityId === (string) $cityId) selected @endif
                  >{{ $cityName }}</option>
                @endforeach
              </select>

              {{-- Соседние фильтры: сохраняются при submit без JS --}}
              @if (($sort ?? 'date') !== 'date')
                <input type="hidden" name="sort" value="{{ $sort }}">
              @endif
              @if (($view ?? 'list') !== 'list')
                <input type="hidden" name="view" value="{{ $view }}">
              @endif

              <noscript>
                <button type="submit" class="catalog-select-submit">Показать</button>
              </noscript>
            </form>
          </div>
        </details>

        {{-- Блок «Категории»: кликабельные строки, счётчик — только для непустых --}}
        <details class="filter-block" open>
          <summary class="filter-summary">Категории</summary>
          <ul class="catalog-categories">
            {{-- Возврат к полному списку секции + индикатор открытой категории.
                 Нужны, когда открыта не корневая рубрика: список ниже — это её
                 дочерние рубрики, поэтому саму выбранную категорию показываем
                 активной строкой, чтобы выбор был очевиден. --}}
            @if (isset($rootId, $currentRubricId) && (int) $rootId !== (int) $currentRubricId)
              <li class="catalog-category catalog-category--back">
                <a href="{{ route($isSale ? 'sale.index' : 'rent.index', $listQuery ?? []) }}"
                   class="catalog-category__link"
                   data-ajax-link>
                  <span class="catalog-category__name">← Все категории</span>
                </a>
              </li>
              {{-- Индикатор выбранной категории показываем только если её самой
                   нет в списке ниже (когда список — дочерние рубрики); иначе
                   она и так подсвечена активной строкой среди соседей. --}}
              @if (! $categories->contains(fn ($c) => (int) ($c->id ?? 0) === (int) $currentRubricId))
                <li class="catalog-category">
                  <span class="catalog-category__link is-active" aria-current="page">
                    <span class="catalog-category__name">{{ $currentRubricTitle }}</span>
                  </span>
                </li>
              @endif
            @endif

            @foreach ($categories as $cat)
              @php
                $catTitle = $cat->title ?? $cat['title'];
                // ads_count — активные объявления с учётом вложенных рубрик;
                // fallback на bbs_count/count для plain-объектов.
                $catCount = (int) ($cat->ads_count ?? $cat->bbs_count ?? ($cat->count ?? ($cat['count'] ?? 0)));
                $catId    = $cat->id ?? ($cat['id'] ?? null);
                // Ссылка на страницу рубрики внутри ТЕКУЩЕЙ секции:
                // /rent/{rubric} или /sale/{rubric}. Остальные фильтры
                // (city_id/sort/view) сохраняем, чтобы выбор категории их не сбрасывал.
                $catHref  = $cat->url ?? ($cat['url'] ?? null);
                if (! $catHref && $catId) {
                    $catHref = route($isSale ? 'sale.index' : 'rent.index', array_filter(array_merge(
                        $listQuery ?? [],
                        ['rubric' => $catId]
                    ), fn ($value) => $value !== null && $value !== ''));
                }
                // Категории без техники приглушаем — меньше визуального шума.
                $catEmpty = $catCount < 1;
                // Активная категория — та, что открыта сейчас (стилизуется
                // существующим классом .catalog-category__link.is-active).
                $catActive = isset($currentRubricId) && (int) $currentRubricId === (int) $catId;
              @endphp
              <li class="catalog-category{{ $catEmpty ? ' catalog-category--empty' : '' }}">
                <a href="{{ $catHref ?: '#' }}"
                   class="catalog-category__link{{ $catActive ? ' is-active' : '' }}"
                   data-ajax-link
                   @if ($catActive) aria-current="page" @endif>
                  <span class="catalog-category__name">{{ $catTitle }}</span>
                  {{-- Ноль не показываем: счётчик рендерится только при наличии техники --}}
                  @if ($catCount > 0)
                    <span class="catalog-category__count">{{ $catCount }}</span>
                  @endif
                </a>
              </li>
            @endforeach
          </ul>
        </details>

      </aside>
