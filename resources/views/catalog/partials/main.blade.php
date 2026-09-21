{{-- ==========================================================================
   ПАРТИАЛ: ОСНОВНАЯ КОЛОНКА КАТАЛОГА (тулбар + результаты + пагинация)
   resources/views/catalog/partials/main.blade.php
   ==========================================================================
   Рендерится и в полной странице (catalog/index.blade.php), и в AJAX-ответе
   CatalogController::index() — разметка не дублируется.

   Переменные: $equipments (пагинатор), $categories не нужны, $sort, $view,
   $listQuery, $isSale, $currentRubricId, $rootId, $priceUnit/$priceLabel/$actionLabel.

   Сортировка и вид списка — обычные GET-ссылки (работают без JS) с
   data-ajax-link: JS перехватывает клик и подгружает фрагмент. Вид списка
   применяется на сервере классом .is-grid — состояние приходит в разметке,
   а не додумывается клиентом.
   ========================================================================== --}}
@php
    // Активные фильтры без page — база для ссылок сортировки/вида.
    $baseQuery = $listQuery ?? [];

    // Ссылка на текущий URL с переопределением параметров (null → параметр убирается).
    $linkTo = function (array $overrides = []) use ($baseQuery) {
        $query = array_filter(
            array_merge($baseQuery, $overrides),
            fn ($value) => $value !== null && $value !== ''
        );
        return $query ? request()->url() . '?' . http_build_query($query) : request()->url();
    };

    $sortActive = $sort ?? 'date';
    $viewActive = $view ?? 'list';
@endphp

      <main class="catalog-main" id="catalog-main">

        {{-- ---------- Верхняя панель: сортировка + переключатель вида ---------- --}}
        <div class="catalog-toolbar">
          <div class="toolbar-sort">
            <span class="sort-label">Сортировка:</span>
            <a href="{{ $linkTo(['sort' => null]) }}"
               class="sort-link{{ $sortActive === 'date' ? ' is-active' : '' }}"
               data-ajax-link
               data-sort="date"
               @if ($sortActive === 'date') aria-current="true" @endif>по дате</a>
            <a href="{{ $linkTo(['sort' => 'price']) }}"
               class="sort-link{{ $sortActive === 'price' ? ' is-active' : '' }}"
               data-ajax-link
               data-sort="price"
               @if ($sortActive === 'price') aria-current="true" @endif>по цене</a>
          </div>

          <div class="toolbar-view" role="group" aria-label="Вид списка">
            <a href="{{ $linkTo(['view' => 'grid']) }}"
               class="view-btn{{ $viewActive === 'grid' ? ' is-active' : '' }}"
               aria-label="Сетка"
               data-ajax-link
               data-view="grid"
               @if ($viewActive === 'grid') aria-current="true" @endif>
              <svg viewBox="0 0 16 16" aria-hidden="true"><path d="M2 2h5v5H2zM9 2h5v5h-5zM2 9h5v5H2zM9 9h5v5h-5z"/></svg>
            </a>
            <a href="{{ $linkTo(['view' => null]) }}"
               class="view-btn{{ $viewActive === 'list' ? ' is-active' : '' }}"
               aria-label="Список"
               data-ajax-link
               data-view="list"
               @if ($viewActive === 'list') aria-current="true" @endif>
              <svg viewBox="0 0 16 16" aria-hidden="true"><path d="M2 4h12v2H2zM2 7h12v2H2zM2 10h8v2H2z"/></svg>
            </a>
          </div>
        </div>

        {{-- ---------- Сетка объявлений / состояние «ничего не найдено» ---------- --}}
        @if ($equipments->count() > 0)
          <div class="equipment-grid{{ $viewActive === 'grid' ? ' is-grid' : '' }}">
            @foreach ($equipments as $item)
              @include('catalog.partials.ticket', ['item' => $item])
            @endforeach
          </div>
        @else
          <p class="catalog-empty">По выбранным фильтрам ничего не найдено.</p>
        @endif

        {{-- ---------- Пагинация ---------- --}}
        @if ($equipments->hasPages())
          {{-- Кастомный вид: ссылки с data-ajax-link → листание без перезагрузки
               (public/js/catalog-filters.js). Стили — .catalog-pagination в catalog.css. --}}
          <div class="catalog-pagination">
            {{ $equipments->links('catalog.partials.pagination') }}
          </div>
        @endif

      </main>