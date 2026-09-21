{{-- ==========================================================================
   «ВСЕ ОБЪЯВЛЕНИЯ» — полный список активных объявлений с пагинацией.
   Карточки — <x-equipment-card> (стили .cards-grid/.eq-card в style.css).
   Контроллер: CatalogController::ads().
   ========================================================================== --}}
@extends('redesign.layouts.base')

@section('title', $pageTitle . ' — ' . config('site.name'))
@section('description', 'Все объявления аренды и продажи строительной спецтехники в Беларуси — ' . (int) $equipments->total() . ' актуальных предложений от собственников.')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
  <style>
    .page-head { padding: 56px 0 0; }
    .page-head .eyebrow { margin-bottom: 8px; }
    .page-title { font-size: 2.25rem; font-weight: 800; color: var(--primary-dark); }
    .catalog-counter { font-size: 1rem; font-weight: 600; color: var(--text-gray); margin-left: 12px; white-space: nowrap; }
    .section__empty { color: var(--text-gray); }

    /* Пагинация: плоские квадратные кнопки в стиле редизайна (Paginator::useBootstrap) */
    .ads-pagination { margin-top: 40px; }
    .ads-pagination .pagination { display: flex; flex-wrap: wrap; gap: 8px; justify-content: center; list-style: none; margin: 0; padding: 0; }
    .ads-pagination .page-link { display: block; padding: 8px 14px; border: 1px solid var(--border-color); border-radius: var(--border-radius); color: var(--primary-dark); font-size: 0.875rem; background-color: var(--bg-white); }
    .ads-pagination .page-link:hover { border-color: var(--primary-red); color: var(--primary-red); }
    .ads-pagination .active .page-link { background-color: var(--primary-red); border-color: var(--primary-red); color: var(--bg-white); }
    .ads-pagination .disabled .page-link { color: var(--text-gray); opacity: 0.6; }
  </style>
@endpush

@section('content')
  <section class="section--light page-head">
    <div class="container">
      <p class="eyebrow">Площадка</p>
      <h1 class="page-title">{{ $pageTitle }}
        <span class="catalog-counter">Найдено: {{ $equipments->total() }}</span>
      </h1>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="cards-grid">
        @forelse($equipments as $equipment)
          <x-equipment-card :equipment="$equipment" />
        @empty
          <p class="section__empty">По выбранным фильтрам ничего не найдено.</p>
        @endforelse
      </div>

      <nav class="ads-pagination" aria-label="Страницы результатов">
        {{ $equipments->links() }}
      </nav>
    </div>
  </section>
@endsection
