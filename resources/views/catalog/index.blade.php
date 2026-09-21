{{-- ==========================================================================
   КАТАЛОГ СПЕЦТЕХНИКИ  ·  resources/views/catalog/index.blade.php
   ==========================================================================
   Один шаблон обслуживает обе страницы — «Аренда» (/rent) и «Продажа»
   (/sale), включая подборку по категории: /rent/{rubric}, /sale/{rubric}.
   Различаются только данные: $pageTitle / $currentCategoryName /
   $priceUnit (руб/час ↔ руб/смена).

   Модель данных (data contract) — см. CatalogController::catalogData():
     $pageTitle           → подпись в хлебных крошках           (string)
     $currentCategoryName → H1
     $equipments          → пагинатор (->total(), ->hasPages(), ->links())
     $categories          → рубрики: id + title + ads_count
     $filterCities        → города: id + title (для <select name="city_id">)
     $priceUnit/$priceLabel/$actionLabel → подписи карточки
     $isSale              → флаг секции «Продажа»
     $sort / $view        → активные состояния панели
     $rootId / $currentRubricId / $currentRubricTitle → для сайдбара
     $listQuery           → активные фильтры для ссылок

   ВСЕ ФИЛЬТРЫ РАБОТАЮТ БЕЗ ПЕРЕЗАГРУЗКИ:
   разметка левой (фильтры) и правой (результаты) колонок вынесена в
   partials/catalog/partials/{sidebar,main}.blade.php. Тот же роут отвечает
   JSON-фрагментами на AJAX-запрос (X-Requested-With), поэтому полная
   страница и фрагменты рендерятся из одного кода — расхождений нет.
   Клиентский перехват — public/js/catalog-filters.js.

   Прогрессивное улучшение: все фильтры — обычные GET-ссылки/формы,
   без JS страница работает как раньше (перезагрузка по ссылке).
   ========================================================================== --}}
@extends('redesign.layouts.base')

@section('title', $pageTitle ?? 'Аренда спецтехники в Беларуси')
@section('description', ($currentCategoryName ?? 'Аренда строительной техники') . ' в Беларуси — ' . (int) $equipments->total() . ' объявлений. Аренда и продажа строительной спецтехники.')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
@endpush

@section('content')
@php
    // Единица тарификации и подписи кнопки (контроллер может переопределить).
    $isSale      = $isSale ?? false;
    $priceUnit   = $priceUnit ?? ($isSale ? 'руб' : 'руб/час');
    $priceLabel  = $priceLabel ?? ($isSale ? 'Цена' : 'Цена от');
    $actionLabel = $actionLabel ?? 'Подробнее';

    // Города: если контроллер не передал коллекцию — fallback на 7 региональных
    // центров РБ. Каждый элемент может быть объектом (id/title) или массивом.
    // Опция-плейсхолдер («Все города» → без фильтра) рендерится в разметке
    // <select> (partials/sidebar), поэтому в списке городов пустых значений быть
    // не должно: иначе браузер подставит первую опцию (алфавитно — «Барановичи»).
    $filterCities = $filterCities ?? collect([
        ['id' => 1,   'title' => 'Минск'],
        ['id' => 2,   'title' => 'Брест'],
        ['id' => 3,   'title' => 'Витебск'],
        ['id' => 4,   'title' => 'Гомель'],
        ['id' => 5,   'title' => 'Гродно'],
        ['id' => 6,   'title' => 'Могилев'],
        ['id' => 7,   'title' => 'Орша'],
    ]);
@endphp

  <div class="container catalog-page" id="catalog-page">

    {{-- ===================== 1. Хлебные крошки + H1 (на всю ширину) ===================== --}}
    <div class="catalog-header">
      <nav class="catalog-breadcrumbs" aria-label="Хлебные крошки">
        <a href="{{ url('/') }}" class="breadcrumb-link">Главная</a>
        <span class="breadcrumb-sep" aria-hidden="true">/</span>
        {{-- id — цель AJAX-обновления при смене фильтров --}}
        <span class="breadcrumb-current" id="catalog-crumb">{{ $pageTitle ?? ($currentCategoryName ?? 'Аренда спецтехники') }}</span>
      </nav>

      <h1 class="catalog-title">
        <span id="catalog-heading">{{ $currentCategoryName ?? 'Аренда строительной техники' }}</span>
        <span class="catalog-counter" id="catalog-counter">Найдено: {{ $equipments->total() }}</span>
      </h1>
    </div>

    {{-- ===================== 2. Двухколоночный макет (CSS Grid) =====================
         Левая колонка — панель фильтров, правая — результаты с пагинацией.
         Обе приходят из partials: их же HTML отдаёт AJAX, поэтому разметка
         обновляется целиком (включая пересчитанные счётчики категорий). --}}
    <div class="catalog-layout" id="catalog-layout">

      @include('catalog.partials.sidebar')

      @include('catalog.partials.main')

    </div>

    {{-- Индикатор загрузки: показывается на время AJAX-запроса фильтров --}}
    <div class="catalog-loading" id="catalog-loading" hidden aria-hidden="true">
      <span class="catalog-loading__spinner"></span>
      <span class="catalog-loading__text">Обновляем объявления…</span>
    </div>

    {{-- Статус для скринридеров: «обновлено N объявлений» --}}
    <p class="visually-hidden" id="catalog-status" role="status" aria-live="polite"></p>
  </div>

@endsection

@push('scripts')
  {{-- Все фильтры каталога — через AJAX (см. шапку шаблона и сам файл скрипта).
       Без JS фильтры остаются обычными GET-ссылками и формами. --}}
  <script src="{{ asset('js/catalog-filters.js') }}" defer></script>
@endpush
