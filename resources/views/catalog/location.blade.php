{{-- ==========================================================================
   ЛОКАЦИОННЫЙ ХАБ КАТАЛОГА  ·  resources/views/catalog/location.blade.php
   ==========================================================================
   Страница всех объявлений (аренда + продажа), привязанных к одной локации
   (город): /location/{id}. Визуальный стиль — региональный хаб Norwegian Air:
   чистый белый фон, ультра-тонкие светло-серые линии (#EDF2F7), много воздуха,
   фирменный красный (--norwegian-red) для цен, бэйджей и главных действий.

   Контракт данных (LocationController::show()):
     $city             → объект локации: name (+lat/lng для карты, опц.)
     $listings         → пагинатор объявлений (->total(), ->hasPages(), ->links())
     $localCategories  → категории, реально присутствующие в городе:
                         id / title / count (или ads_count) / url (опц.)
     $sort / $view     → активные состояния тулбара ('date'|'price', 'grid'|'list')
     $radius           → текущий радиус поиска ('0'|'10'|'30'|'region')
     $listQuery        → активные GET-параметры для ссылок тулбара (опц.)
     $mapPoints        → маркеры карты: [{lat, lng, title, price}] (опц.)

   Стили страницы — public/css/location.css (подключается ниже).
   ========================================================================== --}}
@extends('redesign.layouts.base')

@section('title', 'Строительная техника в г. ' . ($city->name ?? ($city->title ?? '')) . ' — аренда и продажа')
@section('description', 'Найдено ' . (int) ($listings->total() ?? 0) . ' объявлений об аренде и продаже строительной спецтехники в г. ' . ($city->name ?? ($city->title ?? '')) . ' и пригороде.')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/location.css') }}">
@endpush

@section('content')
@php
    // Location хранит название в поле title (name — из контракта ТЗ, fallback).
    $cityName   = $city->name ?? ($city->title ?? '');
    $sortActive = $sort ?? 'date';
    $viewActive = $view ?? 'list';
    $radius     = $radius ?? '0';

    // База для GET-ссылок тулбара (сортировка / вид / радиус).
    $baseQuery  = $listQuery ?? [];

    // Ссылка на текущий URL с переопределением параметров (null → параметр убирается).
    $linkTo = function (array $overrides = []) use ($baseQuery) {
        $query = array_filter(
            array_merge($baseQuery, $overrides),
            fn ($value) => $value !== null && $value !== ''
        );
        return $query ? request()->url() . '?' . http_build_query($query) : request()->url();
    };
@endphp

<div class="container location-page" id="location-page">

  {{-- ==================== 1. ГЕО-ШАПКА (на всю ширину) ==================== --}}
  <header class="location-header">
    <nav class="location-breadcrumbs" aria-label="Хлебные крошки">
      <a href="{{ url('/') }}" class="breadcrumb-link">Главная</a>
      <span class="breadcrumb-sep" aria-hidden="true">/</span>
      <a href="{{ $linkTo([]) }}" class="breadcrumb-link">Спецтехника в регионах</a>
      <span class="breadcrumb-sep" aria-hidden="true">/</span>
      <span class="breadcrumb-current">{{ $cityName }}</span>
    </nav>

    <h1 class="location-title">Строительная техника в г. {{ $cityName }}</h1>
    <p class="location-counter">
      Найдено {{ $listings->total() }} объявлений об аренде и продаже в локации {{ $cityName }} и пригороде
    </p>
  </header>

  {{-- ==================== 2. Двухколоночный макет (CSS Grid) ====================
       Левая колонка (~280px) — локальные фильтры, правая (~75%) — лента объявлений. --}}
  <div class="location-layout">

    {{-- ---------------- ЛЕВАЯ КОЛОНКА: локальные фильтры ---------------- --}}
    <aside class="location-sidebar" id="location-sidebar">

      {{-- Блок «Категории в этом городе»: только реально существующие категории --}}
      <section class="filter-block">
        <h2 class="filter-block__title">Категории в этом городе</h2>
        <ul class="location-categories">
          @forelse ($localCategories as $cat)
            @php
                // localCategories приходят stdClass-объектами из контроллера
                // (DB::table): id / title / count. Доступ только по свойствам.
                $catTitle = $cat->title ?? '';
                $catCount = (int) ($cat->count ?? 0);
                $catId    = $cat->id ?? null;
                $catHref  = $catId
                    ? route('location', array_filter(array_merge(
                        ['location' => $city->id],
                        $baseQuery,
                        ['category' => $catId]
                    ), fn ($value) => $value !== null && $value !== ''))
                    : '#';
            @endphp
            <li class="location-category">
              <a href="{{ $catHref ?: '#' }}" class="location-category__link">
                <span class="location-category__name">{{ $catTitle }}</span>
                <span class="location-category__count">({{ $catCount }})</span>
              </a>
            </li>
          @empty
            <li class="location-category location-category--empty">
              <span class="location-category__link">В этом городе пока нет категорий</span>
            </li>
          @endforelse
        </ul>
      </section>

      {{-- Блок «Радиус поиска»: обычная GET-форма, работает без JS --}}
      <section class="filter-block">
        <h2 class="filter-block__title">Радиус поиска</h2>
        <form method="GET" action="{{ request()->url() }}" class="radius-form">
          @foreach (array_diff_key($baseQuery, ['radius' => null]) as $key => $value)
            @if (! is_null($value) && $value !== '')
              <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endif
          @endforeach
          <select name="radius" class="location-select" aria-label="Радиус поиска" onchange="this.form.submit()">
            <option value="0"      @selected($radius === '0')>Только в городе</option>
            <option value="10"     @selected($radius === '10')>+ 10 км</option>
            <option value="30"     @selected($radius === '30')>+ 30 км</option>
            <option value="region" @selected($radius === 'region')>По всей области</option>
          </select>
        </form>
      </section>

    </aside>

    {{-- ---------------- ПРАВАЯ КОЛОНКА: лента объявлений города ---------------- --}}
    <main class="location-main" id="location-main">

      {{-- Панель быстрого переключения вида (Сетка / Список) и сортировки цен --}}
      <div class="location-toolbar">
        <div class="toolbar-sort">
          <span class="sort-label">Сортировка:</span>
          <a href="{{ $linkTo(['sort' => null]) }}"
             class="sort-link{{ $sortActive === 'date' ? ' is-active' : '' }}"
             @if ($sortActive === 'date') aria-current="true" @endif>по дате</a>
          <a href="{{ $linkTo(['sort' => 'price']) }}"
             class="sort-link{{ $sortActive === 'price' ? ' is-active' : '' }}"
             @if ($sortActive === 'price') aria-current="true" @endif>по цене</a>
        </div>

        <div class="toolbar-view" role="group" aria-label="Вид списка">
          <a href="{{ $linkTo(['view' => 'grid']) }}"
             class="view-btn{{ $viewActive === 'grid' ? ' is-active' : '' }}"
             aria-label="Сетка"
             @if ($viewActive === 'grid') aria-current="true" @endif>
            <svg viewBox="0 0 16 16" aria-hidden="true"><path d="M2 2h5v5H2zM9 2h5v5h-5zM2 9h5v5H2zM9 9h5v5h-5z"/></svg>
          </a>
          <a href="{{ $linkTo(['view' => null]) }}"
             class="view-btn{{ $viewActive === 'list' ? ' is-active' : '' }}"
             aria-label="Список"
             @if ($viewActive === 'list') aria-current="true" @endif>
            <svg viewBox="0 0 16 16" aria-hidden="true"><path d="M2 4h12v2H2zM2 7h12v2H2zM2 10h8v2H2z"/></svg>
          </a>
        </div>
      </div>

      {{-- ---------- Лента: карточки-строки «билет» ---------- --}}
      @if ($listings->count() > 0)
        <div class="location-grid{{ $viewActive === 'grid' ? ' is-grid' : '' }}">
          @foreach ($listings as $item)
            @php
                // --- Сборка данных карточки под модель Bb (graceful fallback) ---
                $price  = $item->bbprice?->price ?? ($item->price ?? 0);
                $priceF = number_format((float) $price, 0, '', ' ');

                // Бэйдж владельца: организация → «Компания», иначе «Частное»
                $isPrivate = empty($item->organization_id);

                // Полное название объявления: Bb::title() = родительская рубрика
                // + рубрика в род. падеже + вендор + модель (fallback на поле title)
                $cardTitle = method_exists($item, 'title')
                    ? $item->title()
                    : ($item->title ?? 'Спецтехника');

                // Район / адрес стоянки: локация объявления (+ область)
                $district = $item->location?->title;

                // Статус сделки: корневая рубрика — 1 «Аренда», 118 «Продажа»
                $rootRubricId = method_exists($item, 'parent_rubric')
                    ? ($item->parent_rubric()->id ?? null)
                    : null;
                $dealType = $rootRubricId === 118 ? 'Продажа' : 'Аренда';

                // Фото: image | первая загруженная картинка | placeholder
                $image = $item->image ?? null;
                if (! $image && method_exists($item, 'images')) {
                    $file = $item->images()->first();
                    $image = $file ? Storage::url($file->resize(600, 400)) : null;
                }
                $image = $image ?? asset('images/placeholder/no-image.svg');

                $href = $item->url ?? ($item->id ? route('listings.show', $item->id) : '#');
            @endphp

            <article class="location-ticket" data-listing-id="{{ $item->id ?? '' }}">
              <a class="location-ticket__link" href="{{ $href }}">

                {{-- Зона 1 (лево): фото + бэйдж владельца --}}
                <div class="lt__media">
                  <img class="lt__img" src="{{ $image }}" alt="{{ $cardTitle }}" loading="lazy">
                  <span class="lt__owner-badge">{{ $isPrivate ? 'Частное' : 'Компания' }}</span>
                </div>

                {{-- Зона 2 (центр): название + район + статус сделки --}}
                <div class="lt__body">
                  <h3 class="lt__title">{{ $cardTitle }}</h3>
                  <p class="lt__meta">
                    @if ($district)
                      <span class="lt__district">{{ $district }}</span>
                    @endif
                    <span class="lt__deal-type">{{ $dealType }}</span>
                  </p>
                </div>

                {{-- Зона 3 (право): цена в городе + кнопка контактов --}}
                <div class="lt__price-zone">
                  <div class="lt__price-block">
                    <span class="lt__price-label">Цена в г. {{ $cityName }}</span>
                    <span class="lt__price-amount">
                      {{ $priceF }} <span class="lt__price-unit">BYN / час</span>
                    </span>
                  </div>
                  <button type="button" class="lt__action">Показать контакты</button>
                </div>

              </a>
            </article>
          @endforeach
        </div>
      @else
        <p class="location-empty">В локации {{ $cityName }} объявлений пока не найдено.</p>
      @endif

      {{-- ---------- Пагинация: квадратные кнопки без заливки ---------- --}}
      @if ($listings->hasPages())
        <div class="location-pagination">
          {{ $listings->links('catalog.partials.pagination') }}
        </div>
      @endif

    </main>
  </div>

  {{-- ==================== 3. ИНТЕРАКТИВНАЯ КАРТА РЕГИОНА (на всю ширину) ====================
       Плоский минималистичный виджет с тонкими границами. Маркеры техники города
       можно отдать JSON-ом в #location-map-points — их подхватит JS-инициализатор
       Яндекс.Карт; базовый вариант — встроенный iframe-виджет по названию города. --}}
  <section class="location-map-wrapper" id="location-map-wrapper">
    <h2 class="location-map-title">Техника на карте г. {{ $cityName }}</h2>
    <div class="location-map" id="location-map">
      <iframe class="location-map__frame"
              title="Карта спецтехники в г. {{ $cityName }}"
              src="https://yandex.ru/map-widget/v1/?text={{ rawurlencode('г. ' . $cityName . ', Беларусь') }}&z=12"
              allowfullscreen
              loading="lazy"></iframe>
    </div>
    @isset($mapPoints)
      <script type="application/json" id="location-map-points">@json($mapPoints)</script>
    @endisset
  </section>

</div>
@endsection
