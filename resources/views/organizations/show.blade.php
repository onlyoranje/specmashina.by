{{-- ==========================================================================
   ПРОФИЛЬ ОРГАНИЗАЦИИ · resources/views/organizations/show.blade.php
   ==========================================================================
   Детальная страница компании редизайна 2026 в стиле Norwegian Air.
   Роут organization/{id} · OrganizationController::detail().

   Модель данных (data contract):
     $organization → Organization.
                     Поля: title (название — в ТЗ «name») | unp | content
                     (описание — в ТЗ «description») | address | location
                     (город + lat/lng для карты) | phone | email | site | logo.
     $listings     → Collection АКТИВНЫХ объявлений компании (Bb) — выводятся
                     компонентом <x-equipment-card> (Norwegian-карточки с
                     красной ценой «от 45 BYN / час»).

   Логотип без файла — SVG-аватар с инициалами (Avatar, как в listings/show).
   Карта: Яндекс-виджет по координатам города (location->lat/lng), иначе
   Google-embed по адресу; «Проложить маршрут» открывает карты с точкой базы.
   ========================================================================== --}}
@extends('redesign.layouts.base')

@section('title', $organization->title.' — контакты и объявления техники')
@section('description', Str::limit(trim(($organization->location?->title ? $organization->location->title.', ' : '').($organization->address ?? '')), 160) ?: 'Контакты, адрес базы и объявления организации на specmashina.by')

@push('styles')
    {{-- Стили раздела организаций: подключается постранично (как catalog.css) --}}
    <link rel="stylesheet" href="{{ asset('css/orgs.css') }}">
@endpush

@section('content')

  @php
      // Телефон: в схеме одна колонка → href tel: без форматирования
      $org_phone_raw = $organization->phone ? preg_replace('/[^\d+]/', '', $organization->phone) : null;

      // Карта: координаты города из locations, иначе адрес текстом
      $org_lat = $organization->location->lat ?? null;
      $org_lng = $organization->location->lng ?? null;
      $org_geo = trim(($organization->address ? $organization->address.', ' : '').($organization->location->title ?? ''));
      $org_embed = $org_lat && $org_lng
          ? 'https://yandex.ru/map-widget/v1/?ll='.$org_lng.'%2C'.$org_lat.'&z=14&pt='.$org_lng.'%2C'.$org_lat.'%2Cpm2rdm'
          : 'https://maps.google.com/maps?q='.urlencode($org_geo).'&z=13&output=embed';
      $org_route = $org_lat && $org_lng
          ? 'https://yandex.ru/maps/?rtext=~'.$org_lat.'%2C'.$org_lng
          : 'https://www.google.com/maps/dir/?api=1&destination='.urlencode($org_geo);
  @endphp

  <section class="org-page">
    <div class="container">

      {{-- ================= ХЛЕБНЫЕ КРОШКИ ================= --}}
      <nav class="org-crumbs" aria-label="Навигационная цепочка">
        <a href="{{ url('/') }}">Главная</a>
        <span class="org-crumbs__sep" aria-hidden="true">/</span>
        <a href="{{ route('organizations') }}">Организации</a>
        <span class="org-crumbs__sep" aria-hidden="true">/</span>
        <span class="org-crumbs__current">{{ $organization->title }}</span>
      </nav>

      {{-- ================= ШАПКА ПРОФИЛЯ ================= --}}
      <header class="org-hero">
        <div class="org-hero__brand">
          <div class="org-hero__logo">
            @if ($organization->logo)
              <img src="{{ Storage::url($organization->logo) }}" alt="{{ $organization->title }}">
            @else
              {{-- Fallback: SVG-аватар с инициалами (как на странице объявления) --}}
              {!! Avatar::create($organization->title)->toSvg() !!}
            @endif
          </div>
          <div class="org-hero__name">
            <h1 class="org-hero__title">{{ $organization->title }}</h1>
            <p class="org-hero__unp">
              @if ($organization->unp)УНП {{ $organization->unp }}@endif
              @if ($organization->location)@if ($organization->unp) · @endif{{ $organization->location->title }}@endif
            </p>
          </div>
        </div>

        <div class="org-hero__contacts">
          @if ($organization->phone)
            <a class="org-hero__phone" href="tel:{{ $org_phone_raw }}">{{ $organization->phone }}</a>
            <a class="org-hero__cta" href="tel:{{ $org_phone_raw }}">
              <svg viewBox="0 0 512 512" fill="currentColor" aria-hidden="true"><path d="M493.4 24.6l-104-24c-11.3-2.6-22.9 3.3-27.5 13.9l-48 112c-4.2 9.8-1.4 21.3 6.9 28l60.6 49.6c-36 76.7-98.9 140.5-177.2 177.2l-49.6-60.6c-6.8-8.3-18.2-11.1-28-6.9l-112 48C3.9 366.5-2 378.1.6 389.4l24 104C27.1 504.2 36.7 512 48 512c256.1 0 464-207.5 464-464 0-11.2-7.7-20.9-18.6-23.4z"/></svg>
              Показать телефон
            </a>
          @endif
          @if ($organization->site)
            <a class="org-hero__link" href="{{ route('organization_site_redirect', $organization->id) }}" target="_blank" rel="nofollow noopener">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c2.5 2.6 4 5.6 4 9s-1.5 6.4-4 9c-2.5-2.6-4-5.6-4-9s1.5-6.4 4-9z"/></svg>
              {{ $organization->site }}
            </a>
          @endif
          @if ($organization->email)
            <a class="org-hero__link" href="mailto:{{ $organization->email }}">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg>
              {{ $organization->email }}
            </a>
          @endif
        </div>
      </header>

      {{-- ================= ДВУХКОЛОНОЧНЫЙ МАКЕТ ================= --}}
      <div class="org-layout">

        {{-- ---------- ЛЕВАЯ КОЛОНКА: КОНТЕНТ ---------- --}}
        <div class="org-main">

          {{-- «О компании» --}}
          @if ($organization->content)
            <section class="org-block">
              <h2 class="org-block__title">О компании</h2>
              <div class="org-about">{!! nl2br(e($organization->content)) !!}</div>
            </section>
          @endif

          {{-- «Объявления организации» — карточки в стиле Norwegian Air --}}
          <section class="org-block">
            <div class="org-block__head">
              <h2 class="org-block__title">Объявления организации</h2>
              <span class="org-block__count">
                {{ $listings->count() }}
                {{ trans_choice('объявление|объявления|объявлений', $listings->count()) }}
              </span>
            </div>

            @if ($listings->isNotEmpty())
              <div class="cards-grid">
                @foreach ($listings as $listing)
                  <x-equipment-card :listing="$listing" />
                @endforeach
              </div>
            @else
              <p class="org-empty">Сейчас у компании нет активных объявлений.</p>
            @endif
          </section>
        </div>

        {{-- ---------- САЙДБАР: АДРЕС И КАРТА ---------- --}}
        <aside class="org-side">
          <section class="org-side__block">
            <h2 class="org-side__title">Адрес и база</h2>
            <p class="org-side__address">
              @if ($organization->location){{ $organization->location->title }}@endif
              @if ($organization->address)@if ($organization->location), @endif{{ $organization->address }}@endif
            </p>

            @if ($org_geo)
              <div class="org-map">
                <iframe src="{{ $org_embed }}"
                        loading="lazy"
                        title="Расположение {{ $organization->title }} на карте"></iframe>
                <a class="org-map__route" href="{{ $org_route }}" target="_blank" rel="nofollow noopener">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2L4.5 20.3l.7.7L12 18l6.8 3 .7-.7z"/></svg>
                  Проложить маршрут
                </a>
              </div>
            @endif
          </section>
        </aside>
      </div>

    </div>
  </section>

@endsection