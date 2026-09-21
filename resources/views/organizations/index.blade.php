{{-- ==========================================================================
   СПИСОК ОРГАНИЗАЦИЙ · resources/views/organizations/index.blade.php
   ==========================================================================
   Каталог компаний/арендодателей редизайна 2026 в стиле Norwegian Air
   (norwegian.com). Роут organizations, NewsController нет — OrganizationController::list().

   Модель данных (data contract):
     $organizations → LengthAwarePaginator активных организаций (Organization),
                      сортировка по названию; filters q/city_id в ссылках (appends).
                      Каждая модель несёт listings_count — число АКТИВНЫХ
                      объявлений (withCount по связи bbs × status_bb.active).
     $cities        → Collection областных/крупных городов РБ (id, title)
                      для фильтра.

   Поля Organization: title (название — в ТЗ «name») | location->title (город —
   в ТЗ «city») | address | unp | phone | email | site | logo | active.
   Краткой «специализации» в схеме нет — во второй строке выводится город
   и адрес базы (graceful fallback, можно заменить на отдельное поле).
   Активные фильтры читаются из query string: request('q')/request('city_id').
   ========================================================================== --}}
@extends('redesign.layouts.base')

@section('title', 'Компании и владельцы спецтехники в Беларуси')
@section('description', 'Каталог компаний и владельцев строительной спецтехники в Беларуси: контакты, адреса баз и актуальные объявления аренды и продажи техники.')

@push('styles')
    {{-- Стили раздела организаций: подключается постранично (как catalog.css) --}}
    <link rel="stylesheet" href="{{ asset('css/orgs.css') }}">
@endpush

@section('content')

  <section class="orgs-page">
    <div class="container">

      {{-- ================= ХЛЕБНЫЕ КРОШКИ ================= --}}
      <nav class="org-crumbs" aria-label="Навигационная цепочка">
        <a href="{{ url('/') }}">Главная</a>
        <span class="org-crumbs__sep" aria-hidden="true">/</span>
        <span class="org-crumbs__current">Организации</span>
      </nav>

      {{-- ================= HERO ================= --}}
      <header class="orgs-hero">
        <h1 class="orgs-hero__title">Компании и владельцы спецтехники в Беларуси</h1>
        <p class="orgs-hero__count">Всего: {{ $organizations->total() }}</p>
      </header>

      {{-- ================= ПАНЕЛЬ ФИЛЬТРАЦИИ ================= --}}
      <form class="orgs-filter" method="GET" action="{{ route('organizations') }}">
        <input class="orgs-filter__input" type="text" name="q" value="{{ request('q') }}"
               placeholder="Название компании" aria-label="Поиск по названию">
        <select class="orgs-filter__select" name="city_id" aria-label="Город">
          <option value="">Все города</option>
          @foreach ($cities as $city)
            <option value="{{ $city->id }}" @selected(request('city_id') == $city->id)>{{ $city->title }}</option>
          @endforeach
        </select>
        <button class="orgs-filter__btn" type="submit">Найти</button>
        @if (request('q') || request('city_id'))
          <a class="orgs-filter__reset" href="{{ route('organizations') }}">Сбросить</a>
        @endif
      </form>

      {{-- ================= СПИСОК КОМПАНИЙ ================= --}}
      <div class="orgs-list">
        @forelse ($organizations as $company)
          <a class="org-row" href="{{ route('organization', $company->id) }}">
            <div class="org-row__logo">
              @if ($company->logo)
                <img src="{{ Storage::url($company->logo) }}" alt="{{ $company->title }}" loading="lazy">
              @else
                {{-- Fallback: SVG-аватар с инициалами (как на странице объявления) --}}
                {!! Avatar::create($company->title)->toSvg() !!}
              @endif
            </div>

            <div class="org-row__body">
              <h3 class="org-row__name">{{ $company->title }}</h3>
              @php
                  // Специализации в схеме нет — вторая строка: город · адрес базы
                  $row_info = trim(($company->location?->title ?? 'Беларусь')
                      . ($company->address ? ' · '.Str::limit($company->address, 60) : ''));
              @endphp
              <p class="org-row__info">{{ $row_info }}</p>
            </div>

            <div class="org-row__action">
              <span class="org-row__count">
                {{ $company->listings_count }}
                {{ trans_choice('объявление|объявления|объявлений', $company->listings_count) }}
              </span>
              <span class="org-row__btn">
                Смотреть профиль
                <svg viewBox="0 0 16 16" aria-hidden="true"><path d="M3 8h9M8 3l5 5-5 5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
              </span>
            </div>
          </a>
        @empty
          <p class="orgs-empty">По вашему запросу организаций не найдено.</p>
        @endforelse
      </div>

      {{-- ================= ПАГИНАЦИЯ ================= --}}
      @if ($organizations->hasPages())
        <nav class="orgs-pagination" aria-label="Страницы каталога">
          {{ $organizations->links() }}
        </nav>
      @endif

    </div>
  </section>

@endsection