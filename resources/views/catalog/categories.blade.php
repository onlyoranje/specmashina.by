{{-- ==========================================================================
   «ВЕСЬ КАТАЛОГ» — все категории (рубрики 1-го уровня) обеих секций.
   Карточки — те же .cat-card из public/css/home.css, что и в блоке
   категорий на главной. Контроллер: CatalogController::categories().
   ========================================================================== --}}
@extends('redesign.layouts.base')

@section('title', $pageTitle . ' — ' . config('site.name'))
@section('description', 'Все категории аренды и продажи строительной спецтехники в Беларуси — выбирайте технику по разделам «Аренда» и «Продажа».')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
  <style>
    .page-head { padding: 56px 0 0; }
    .page-head .eyebrow { margin-bottom: 8px; }
    .page-title { font-size: 2.25rem; font-weight: 800; color: var(--primary-dark); }
    .page-lead { max-width: 44rem; margin-top: 12px; color: var(--text-gray); }
    .section__empty { color: var(--text-gray); }
  </style>
@endpush

@section('content')
  <section class="section--light page-head">
    <div class="container">
      <p class="eyebrow">Каталог</p>
      <h1 class="page-title">{{ $pageTitle }}</h1>
      <p class="page-lead">Все категории техники, размещённые на площадке. Внутри каждой категории — подкатегории с объявлениями аренды и продажи по всей Беларуси.</p>
    </div>
  </section>

  @foreach([['title' => 'Аренда', 'route' => 'rent.index', 'cats' => $rentCategories],
            ['title' => 'Продажа', 'route' => 'sale.index', 'cats' => $saleCategories]] as $section)
    <section class="section">
      <div class="container">
        <div class="section__head">
          <div>
            <p class="eyebrow">Секция</p>
            <h2>{{ $section['title'] }}</h2>
          </div>
          <a class="section__link" href="{{ route($section['route']) }}">Все объявления
            <svg viewBox="0 0 16 16" aria-hidden="true"><path d="M3 8h9M8 3l5 5-5 5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </a>
        </div>

        <div class="cats">
          @foreach($section['cats'] as $cat)
            <a class="cat-card" href="{{ route($section['route'], $cat->id) }}">
              <x-cat-icon :title="$cat->title" :icon="$cat->icon" />
              <span class="cat-card__name">{{ $cat->title }}</span>
              <span class="cat-card__count">{{ $cat->ads_count ? bbs_count_title($cat->ads_count) : 'Нет объявлений' }}</span>
            </a>
          @endforeach
        </div>
      </div>
    </section>
  @endforeach
@endsection
