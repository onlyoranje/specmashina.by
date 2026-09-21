@extends('redesign.layouts.base')

@section('title', $title)
@section('description', $title.". ".($bb->user->organization?->title ?? '').". ".($bb->bbprice?->price ?? '')." ".($bb->bbprice?->pricetype?->type ?? ''))

@push('styles')
    {{-- Стили страницы: подключается постранично (как catalog.css в catalog/index) --}}
    <link rel="stylesheet" href="{{ asset('css/listing.css') }}">
@endpush

@section('content')

@php
    // Контакты по кодам типов (phone, user_name, mail, ...)
    $contact_info = [];
    foreach ($bb->bbcontact as $contact) {
        $contact_info[$contact->contactType->code] = $contact->value;
    }
    $phone        = $contact_info['phone'] ?? null;
    $phone_raw    = $phone ? preg_replace('/[^\d+]/', '', $phone) : null;
    $contact_name = $contact_info['user_name'] ?? ($bb->user->organization?->title ?? $bb->user->name);

    // Исходное состояние закладки «В избранное»
    $is_fav = Auth::check() && \Maize\Markable\Models\Bookmark::has($bb, Auth::user());

    // Похожие объявления в том же городе («Еще техника в …»)
    $bbs_location = App\Models\Bb::select('bbs.*')
        ->join('status_bbs', 'bbs.status_bb_id', '=', 'status_bbs.id')
        ->where('status_bbs.active', 'Y')
        ->where('location_id', $bb->location_id)
        ->whereNot('bbs.id', $bb->id)
        ->orderBy('bbs.created_at', 'desc')
        ->limit(3)
        ->get();

    $share_url   = urlencode(Request::url());
    $share_title = urlencode($title);

    $is_admin = Auth::check() && Auth::user()->isAdmin();
@endphp

<section class="listing-page">
    <div class="container">
        <header class="listing-header">
            <nav class="listing-breadcrumbs" aria-label="Навигационная цепочка">
                @foreach ($breadcrumbs['list'] as $crumb)
                    <a href="{{ route('rubric', $crumb->id) }}">{{ $crumb->title }}</a>
                    <span class="listing-breadcrumbs__sep" aria-hidden="true">/</span>
                @endforeach
                <a href="{{ route('location', $bb->location->id) }}">{{ $bb->location->title }}</a>
                <span class="listing-breadcrumbs__sep" aria-hidden="true">/</span>
                <span class="listing-breadcrumbs__current">{{ $title }}</span>
            </nav>

            <h1 class="listing-title">{{ $title }}</h1>

            <ul class="listing-meta">
                <li class="listing-meta__item">
                    <svg class="listing-meta__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor" aria-hidden="true"><path d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z"/></svg>
                    <span>{{ $bb->count_views('text') }}</span>
                </li>
                <li class="listing-meta__item">
                    <svg class="listing-meta__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" fill="currentColor" aria-hidden="true"><path d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z"/></svg>
                    <a href="{{ route('location', $bb->location->id) }}">{{ $bb->location->title }}@if ($bb->location->parent), {{ $bb->location->parent->title }}@endif</a>
                </li>
                <li class="listing-meta__item">
                    <svg class="listing-meta__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor" aria-hidden="true"><path d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm320-196c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM192 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM64 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z"/></svg>
                    <span>{{ $bb->time_update() }}</span>
                </li>
            </ul>

            @if (in_array($bb->status_bb->status, ['M', 'N']))
                <div class="listing-notice">
                    <span class="listing-notice__label">
                        Объявление {{ $bb->status_bb->status === 'M' ? 'на модерации' : 'не прошло модерацию' }}
                    </span>
                    @if ($is_admin && $bb->status_bb->status === 'M')
                        <a class="listing-notice__action listing-notice__action--primary" href="{{ route('approve', $bb->id) }}">Принять</a>
                        <details class="listing-notice__reasons">
                            <summary>Отклонить…</summary>
                            <form method="POST" action="{{ route('reject', $bb->id) }}">
                                @csrf
                                @method('PATCH')
                                @foreach ($reasons as $reason)
                                    <label class="listing-notice__reason">
                                        <input type="checkbox" name="reasons[]" value="{{ $reason->id }}">
                                        {{ $reason->reason }}
                                    </label>
                                @endforeach
                                <input type="text" name="comment" placeholder="Комментарий">
                                <button class="listing-notice__action listing-notice__action--primary" type="submit">Отклонить</button>
                            </form>
                        </details>
                    @endif
                </div>
            @endif
        </header>

        {{-- ================== ДВУХКОЛОНОЧНЫЙ МАКЕТ: 65% · 35% ================== --}}
        <div class="listing-layout">

            {{-- ---------- ЛЕВАЯ КОЛОНКА: основной контент ---------- --}}
            <div class="listing-main">

                {{-- Галерея: слайды переключаются opacity, стрелки + счётчик + миниатюры --}}
                @if (count($images))
                    <div class="lg">
                        <div class="lg__stage">
                            @foreach ($images as $img)
                                {{-- data-full — версия для лайтбокса: высота 1080px, ширина по пропорции (без кропа 3:2) --}}
                                <img class="lg__img @if ($loop->first) is-active @endif"
                                     src="{{ Storage::url($img->resize(900, 560)) }}"
                                     data-full="{{ Storage::url($img->resize(null, 1080)) }}"
                                     alt="{{ $title }} — фото {{ $loop->iteration }}">
                            @endforeach

                            @if (count($images) > 1)
                                <button class="lg__nav lg__nav--prev" type="button" aria-label="Предыдущее фото">
                                    <svg viewBox="0 0 256 512" fill="currentColor" aria-hidden="true"><path d="M31.7 239l136-136c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9L127.9 256l96.4 96.4c9.4 9.4 9.4 24.6 0 33.9L201.7 409c-9.4 9.4-24.6 9.4-33.9 0l-136-136c-9.5-9.4-9.5-24.6-.1-34z"/></svg>
                                </button>
                                <button class="lg__nav lg__nav--next" type="button" aria-label="Следующее фото">
                                    <svg viewBox="0 0 256 512" fill="currentColor" aria-hidden="true"><path d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z"/></svg>
                                </button>
                            @endif

                            <span class="lg__counter">1 / {{ count($images) }}</span>
                        </div>

                        @if (count($images) > 1)
                            <div class="lg__thumbs">
                                @foreach ($images as $img)
                                    <button class="lg__thumb @if ($loop->first) is-active @endif"
                                            type="button" data-index="{{ $loop->index }}"
                                            aria-label="Показать фото {{ $loop->iteration }}">
                                        <img src="{{ Storage::url($img->resize(160, 120)) }}" alt="">
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- Лайтбокс: полноэкранный просмотр, открывается кликом по кадру --}}
                    <div class="lb" id="lightbox" role="dialog" aria-modal="true" aria-label="Просмотр фотографии" hidden>
                        <button class="lb__close" type="button" aria-label="Закрыть просмотр">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18"/></svg>
                        </button>
                        <button class="lb__nav lb__nav--prev" type="button" aria-label="Предыдущее фото">
                            <svg viewBox="0 0 256 512" fill="currentColor" aria-hidden="true"><path d="M31.7 239l136-136c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9L127.9 256l96.4 96.4c9.4 9.4 9.4 24.6 0 33.9L201.7 409c-9.4 9.4-24.6 9.4-33.9 0l-136-136c-9.5-9.4-9.5-24.6-.1-34z"/></svg>
                        </button>
                        <figure class="lb__figure">
                            <img class="lb__img" alt="">
                        </figure>
                        <button class="lb__nav lb__nav--next" type="button" aria-label="Следующее фото">
                            <svg viewBox="0 0 256 512" fill="currentColor" aria-hidden="true"><path d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z"/></svg>
                        </button>
                        <div class="lb__counter" aria-live="polite"></div>
                    </div>
                @else
                    {{-- Плоская заглушка «нет фото» с иконкой техники --}}
                    <div class="lg-empty">
                        <svg class="lg-empty__icon" viewBox="0 0 640 512" fill="currentColor" aria-hidden="true"><path d="M528 336c-48.6 0-88 39.4-88 88s39.4 88 88 88 88-39.4 88-88-39.4-88-88-88zm0 112c-13.23 0-24-10.77-24-24s10.77-24 24-24 24 10.77 24 24-10.77 24-24 24zm80-288h-64v-40.2c0-14.12 4.7-27.76 13.15-38.84 4.42-5.8 3.55-14.06-1.32-19.49L534.2 37.3c-6.66-7.45-18.32-6.92-24.7.78C490.58 60.9 480 89.81 480 119.8V160H377.67L321.58 29.14A47.914 47.914 0 0 0 277.45 0H144c-26.47 0-48 21.53-48 48v146.52c-8.63-6.73-20.96-6.46-28.89 1.47L36 227.1c-8.59 8.59-8.59 22.52 0 31.11l5.06 5.06c-4.99 9.26-8.96 18.82-11.91 28.72H22c-12.15 0-22 9.85-22 22v44c0 12.15 9.85 22 22 22h7.14c2.96 9.91 6.92 19.46 11.91 28.73l-5.06 5.06c-8.59 8.59-8.59 22.52 0 31.11L67.1 476c8.59 8.59 22.52 8.59 31.11 0l5.06-5.06c9.26 4.99 18.82 8.96 28.72 11.91V490c0 12.15 9.85 22 22 22h44c12.15 0 22-9.85 22-22v-7.14c9.9-2.95 19.46-6.92 28.72-11.91l5.06 5.06c8.59 8.59 22.52 8.59 31.11 0l31.11-31.11c8.59-8.59 8.59-22.52 0-31.11l-5.06-5.06c4.99-9.26 8.96-18.82 11.91-28.72H330c12.15 0 22-9.85 22-22v-6h80.54c21.91-28.99 56.32-48 95.46-48 18.64 0 36.07 4.61 51.8 12.2l50.82-50.82c6-6 9.37-14.14 9.37-22.63V192c.01-17.67-14.32-32-31.99-32zM176 416c-44.18 0-80-35.82-80-80s35.82-80 80-80 80 35.82 80 80-35.82 80-80 80zm22-256h-38V64h106.89l41.15 96H198z"/></svg>
                        <p class="lg-empty__text">Фото пока не добавлены</p>
                    </div>
                @endif


                {{-- Описание: чистая типографика, без серых плашек --}}
                @if ($bb->content)
                    <section class="listing-block">
                        <h2 class="listing-block__title">Описание</h2>
                        <div class="listing-text">{!! nl2br(e($bb->content)) !!}</div>
                    </section>
                @endif

                {{-- Похожие объявления в том же городе --}}
                @if (count($bbs_location))
                    <section class="listing-block">
                        <h2 class="listing-block__title">Ещё техника в {{ $bb->location->title_r ?? $bb->location->title }}</h2>
                        <div class="listing-cards">
                            @foreach ($bbs_location as $near)
                                @php
                                    $near_img   = $near->images()->first();
                                    $near_price = $near->bbprice;
                                @endphp
                                <a class="listing-card" href="{{ route('listings.show', $near->id) }}">
                                    <span class="listing-card__media">
                                        @if ($near_img)
                                            <img src="{{ Storage::url($near_img->resize(600, 400)) }}"
                                                 alt="{{ $near->title() }}" loading="lazy">
                                        @else
                                            <span class="listing-card__ph">
                                                <svg viewBox="0 0 640 512" fill="currentColor" aria-hidden="true"><path d="M528 336c-48.6 0-88 39.4-88 88s39.4 88 88 88 88-39.4 88-88-39.4-88-88-88zm0 112c-13.23 0-24-10.77-24-24s10.77-24 24-24 24 10.77 24 24-10.77 24-24 24zm80-288h-64v-40.2c0-14.12 4.7-27.76 13.15-38.84 4.42-5.8 3.55-14.06-1.32-19.49L534.2 37.3c-6.66-7.45-18.32-6.92-24.7.78C490.58 60.9 480 89.81 480 119.8V160H377.67L321.58 29.14A47.914 47.914 0 0 0 277.45 0H144c-26.47 0-48 21.53-48 48v146.52c-8.63-6.73-20.96-6.46-28.89 1.47L36 227.1c-8.59 8.59-8.59 22.52 0 31.11l5.06 5.06c-4.99 9.26-8.96 18.82-11.91 28.72H22c-12.15 0-22 9.85-22 22v44c0 12.15 9.85 22 22 22h7.14c2.96 9.91 6.92 19.46 11.91 28.73l-5.06 5.06c-8.59 8.59-8.59 22.52 0 31.11L67.1 476c8.59 8.59 22.52 8.59 31.11 0l5.06-5.06c9.26 4.99 18.82 8.96 28.72 11.91V490c0 12.15 9.85 22 22 22h44c12.15 0 22-9.85 22-22v-7.14c9.9-2.95 19.46-6.92 28.72-11.91l5.06 5.06c8.59 8.59 22.52 8.59 31.11 0l31.11-31.11c8.59-8.59 8.59-22.52 0-31.11l-5.06-5.06c4.99-9.26 8.96-18.82 11.91-28.72H330c12.15 0 22-9.85 22-22v-6h80.54c21.91-28.99 56.32-48 95.46-48 18.64 0 36.07 4.61 51.8 12.2l50.82-50.82c6-6 9.37-14.14 9.37-22.63V192c.01-17.67-14.32-32-31.99-32zM176 416c-44.18 0-80-35.82-80-80s35.82-80 80-80 80 35.82 80 80-35.82 80-80 80zm22-256h-38V64h106.89l41.15 96H198z"/></svg>
                                            </span>
                                        @endif
                                    </span>
                                    <span class="listing-card__body">
                                        <span class="listing-card__title">{{ $near->title() }}</span>
                                        <span class="listing-card__city">{{ $near->location->title }}</span>
                                    </span>
                                    <span class="listing-card__price">
                                        @if ($near_price)
                                            {{ $near_price->price }} {{ $near_price->pricetype->type }}
                                        @else
                                            Цена по запросу
                                        @endif
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </section>
                @endif


            </div>{{-- /listing-main --}}

            {{-- ---------- ПРАВАЯ КОЛОНКА: «виджет покупки билета» ---------- --}}
            <aside class="listing-aside">
                <div class="listing-widget">
                    @php $price = $bb->bbprice; @endphp

                    {{-- Цена --}}
                    <div class="listing-widget__price">
                        <span class="listing-price__hint">{{ $price ? 'Цена' : 'Стоимость' }}</span>
                        @if ($price)
                            <div class="listing-price">{{ $price->price }}</div>
                            <span class="listing-price__unit">{{ $price->pricetype->type }}</span>
                        @else
                            <div class="listing-price listing-price--ask">Цена по запросу</div>
                        @endif
                    </div>

                    {{-- Характеристики: строки с тончайшими разделителями --}}
                    @if ($bb->vendor || $bb->BbParameters->isNotEmpty())
                        <dl class="listing-specs">
                            @if ($bb->vendor)
                                <div class="listing-specs__row">
                                    <dt class="listing-specs__dt">Производитель</dt>
                                    <dd class="listing-specs__dd">{{ $bb->vendor->name }}</dd>
                                </div>
                            @endif
                            <div class="listing-specs__row">
                                <dt class="listing-specs__dt">Модель</dt>
                                <dd class="listing-specs__dd">{{ $bb->title }}</dd>
                            </div>
                            @foreach ($bb->BbParameters as $parameter)
                                @if ($parameter->parameters)
                                    <div class="listing-specs__row">
                                        <dt class="listing-specs__dt">{{ $parameter->parameters->name }}@if ($parameter->parameters->measure), {{ $parameter->parameters->measure }}@endif</dt>
                                        <dd class="listing-specs__dd">{{ $parameter->value }}</dd>
                                    </div>
                                @endif
                            @endforeach
                        </dl>
                    @endif


                    {{-- Главный CTA: телефон сразу или «Показать телефон» --}}
                    @if ($phone)
                        <a class="btn-contact" href="tel:{{ $phone_raw }}">
                            <svg viewBox="0 0 512 512" fill="currentColor" aria-hidden="true"><path d="M493.4 24.6l-104-24c-11.3-2.6-22.9 3.3-27.5 13.9l-48 112c-4.2 9.8-1.4 21.3 6.9 28l60.6 49.6c-36 76.7-98.9 140.5-177.2 177.2l-49.6-60.6c-6.8-8.3-18.2-11.1-28-6.9l-112 48C3.9 366.5-2 378.1.6 389.4l24 104C27.1 504.2 36.7 512 48 512c256.1 0 464-207.5 464-464 0-11.2-7.7-20.9-18.6-23.4z"/></svg>
                            {{ $phone }}
                        </a>
                        @if ($contact_name)
                            <p class="listing-widget__manager">Контактное лицо: {{ $contact_name }}</p>
                        @endif
                    @elseif (isset($contact_info['mail']) && $contact_info['mail'])
                        <a class="btn-contact" href="mailto:{{ $contact_info['mail'] }}">
                            <svg viewBox="0 0 512 512" fill="currentColor" aria-hidden="true"><path d="M493.4 24.6l-104-24c-11.3-2.6-22.9 3.3-27.5 13.9l-48 112c-4.2 9.8-1.4 21.3 6.9 28l60.6 49.6c-36 76.7-98.9 140.5-177.2 177.2l-49.6-60.6c-6.8-8.3-18.2-11.1-28-6.9l-112 48C3.9 366.5-2 378.1.6 389.4l24 104C27.1 504.2 36.7 512 48 512c256.1 0 464-207.5 464-464 0-11.2-7.7-20.9-18.6-23.4z"/></svg>
                            Написать автору
                        </a>
                    @endif

                    {{-- Второстепенное действие: закладка (совместима с JS сайта: li.like) --}}
                    <ul class="listing-fav-row">
                        <li class="like" data-bb-id="{{ $bb->id }}" data-bookmark="{{ $is_fav ? 'true' : 'false' }}">
                            <a href="javascript:void(0)" class="listing-fav @if ($is_fav) is-active @endif" role="button" aria-pressed="{{ $is_fav ? 'true' : 'false' }}">
                                <svg class="listing-fav__icon" viewBox="0 0 384 512" fill="currentColor" aria-hidden="true"><path d="M336 0H48C21.49 0 0 21.49 0 48v464l192-112 192 112V48c0-26.51-21.49-48-48-48zm0 428.43l-144-84-144 84V54a6 6 0 0 1 6-6h276c3.314 0 6 2.683 6 5.996V428.43z"/></svg>
                                <span>В избранное</span>
                            </a>
                        </li>
                    </ul>

                    <hr class="listing-widget__divider">


                    {{-- Организация --}}
                    @if ($bb->organization_id && $bb->user->organization)
                        @php
                            $org = $bb->user->organization;
                            $org_url = route('organization', $bb->organization_id);
                        @endphp
                        <div class="listing-widget__org">
                            <span class="listing-widget__org-logo">
                                @if ($org->logo)
                                    <img src="{{ Storage::url($org->logo) }}" alt="{{ $org->title }}">
                                @else
                                    {!! Avatar::create($org->title)->toSvg() !!}
                                @endif
                            </span>
                            <span class="listing-widget__org-info">
                                <a class="listing-widget__org-name" href="{{ $org_url }}">{{ $org->title }}</a>
                                <span class="listing-widget__org-city">
                                    {{ $org->location->title }}@if ($org->address), {{ $org->address }}@endif
                                </span>
                                <a class="listing-widget__org-link" href="{{ $org_url }}">Все объявления организации</a>
                            </span>
                        </div>
                    @endif

                    {{-- Карта: координаты города, иначе адрес организации --}}
                    @php
                        $lat = $bb->location->lat;
                        $lng = $bb->location->lng;
                        $org_addr = ($bb->organization_id && isset($org) && $org->address) ? $org->address.', '.$org->location->title : null;
                    @endphp
                    @if (($lat && $lng) || $org_addr)
                        <div class="listing-map">
                            <div class="listing-map__frame">
                                @if ($lat && $lng)
                                    <iframe src="https://yandex.ru/map-widget/v1/?ll={{ $lng }}%2C{{ $lat }}&z=14&pt={{ $lng }}%2C{{ $lat }}%2Cpm2rdm"
                                            loading="lazy" title="Расположение техники на карте"></iframe>
                                    @php $maps_url = 'https://yandex.ru/maps/?pt='.$lng.'%2C'.$lat.'&z=16'; @endphp
                                @else
                                    <iframe src="https://maps.google.com/maps?q={{ urlencode($org_addr) }}&z=13&output=embed"
                                            loading="lazy" title="Расположение организации на карте"></iframe>
                                    @php $maps_url = 'https://maps.google.com/?q='.urlencode($org_addr); @endphp
                                @endif
                            </div>
                            <a class="listing-map__link" href="{{ $maps_url }}" target="_blank" rel="nofollow noopener">
                                Открыть в Картах
                                <svg viewBox="0 0 512 512" fill="currentColor" aria-hidden="true"><path d="M432,320H400a16,16,0,0,0-16,16V448H64V128H208a16,16,0,0,0,16-16V80a16,16,0,0,0-16-16H48A48,48,0,0,0,0,112V464a48,48,0,0,0,48,48H400a48,48,0,0,0,48-48V336A16,16,0,0,0,432,320ZM488,0h-128c-21.37,0-32.05,25.91-17,41l35.73,35.73L135,320.37a24,24,0,0,0,0,34L157.67,377a24,24,0,0,0,34,0L435.28,133.32,471,169c15,15,41,4.5,41-17V24A24,24,0,0,0,488,0Z"/></svg>
                            </a>
                        </div>
                    @endif
                </div>{{-- /listing-widget --}}
            </aside>
        </div>{{-- /listing-layout --}}


        {{-- ---------- НИЖНЯЯ ПАНЕЛЬ «ПОДЕЛИТЬСЯ»: монохром, цвет на hover ---------- --}}
        <section class="listing-share">
            <h2 class="listing-share__title">Поделиться</h2>
            <ul class="listing-share__list">
                @php
                    $share = [
                        'viber'    => ['viber://forward?text='.$share_title.'%20'.$share_url, 512, 'M444 49.9C431.3 38.2 379.9.9 265.3.4c0 0-135.1-8.1-200.9 52.3C27.8 89.3 14.9 143 13.5 209.5c-1.4 66.5-3.1 191.1 117 224.9h.1l-.1 51.6s-.8 20.9 13 25.1c16.6 5.2 26.4-10.7 42.3-27.8 8.7-9.4 20.7-23.2 29.8-33.7 82.2 6.9 145.3-8.9 152.5-11.2 16.6-5.4 110.5-17.4 125.7-142 15.8-128.6-7.6-209.8-49.8-246.5zM457.9 287c-12.9 104-89 110.6-103 115.1-6 1.9-61.5 15.7-131.2 11.2 0 0-52 62.7-68.2 79-5.3 5.3-11.1 4.8-11-5.7 0-6.9.4-85.7.4-85.7-.1 0-.1 0 0 0-101.8-28.2-95.8-134.3-94.7-189.8 1.1-55.5 11.6-101 42.6-131.6 55.7-50.5 170.4-43 170.4-43 96.9.4 143.3 29.6 154.1 39.4 35.7 30.6 53.9 103.8 40.6 211.1zm-139-80.8c.4 8.6-12.5 9.2-12.9.6-1.1-22-11.4-32.7-32.6-33.9-8.6-.5-7.8-13.4.7-12.9 27.9 1.5 43.4 17.5 44.8 46.2zm20.3 11.3c1-42.4-25.5-75.6-75.8-79.3-8.5-.6-7.6-13.5.9-12.9 58 4.2 88.9 44.1 87.8 92.5-.1 8.6-13.1 8.2-12.9-.3zm47 13.4c.1 8.6-12.9 8.7-12.9.1-.6-81.5-54.9-125.9-120.8-126.4-8.5-.1-8.5-12.9 0-12.9 73.7.5 133 51.4 133.7 139.2zM374.9 329v.2c-10.8 19-31 40-51.8 33.3l-.2-.3c-21.1-5.9-70.8-31.5-102.2-56.5-16.2-12.8-31-27.9-42.4-42.4-10.3-12.9-20.7-28.2-30.8-46.6-21.3-38.5-26-55.7-26-55.7-6.7-20.8 14.2-41 33.3-51.8h.2c9.2-4.8 18-3.2 23.9 3.9 0 0 12.4 14.8 17.7 22.1 5 6.8 11.7 17.7 15.2 23.8 6.1 10.9 2.3 22-3.7 26.6l-12 9.6c-6.1 4.9-5.3 14-5.3 14s17.8 67.3 84.3 84.3c0 0 9.1.8 14-5.3l9.6-12c4.6-6 15.7-9.8 26.6-3.7 14.7 8.3 33.4 21.2 45.8 32.9 7 5.7 8.6 14.4 3.8 23.6z'],
                        'telegram' => ['https://t.me/share/url?url='.$share_url.'&text='.$share_title, 448, 'M446.7 98.6l-67.6 318.8c-5.1 22.5-18.4 28.1-37.3 17.5l-103-75.9-49.7 47.8c-5.5 5.5-10.1 10.1-20.7 10.1l7.4-104.9 190.9-172.5c8.3-7.4-1.8-11.5-12.9-4.1L117.8 284 16.2 252.2c-22.1-6.9-22.5-22.1 4.6-32.7L418.2 66.4c18.4-6.9 34.5 4.1 28.5 32.2z'],
                        'vk'       => ['https://vk.com/share.php?url='.$share_url.'&title='.$share_title, 576, 'M545 117.7c3.7-12.5 0-21.7-17.8-21.7h-58.9c-15 0-21.9 7.9-25.6 16.7 0 0-30 73.1-72.4 120.5-13.7 13.7-20 18.1-27.5 18.1-3.7 0-9.4-4.4-9.4-16.9V117.7c0-15-4.2-21.7-16.6-21.7h-92.6c-9.4 0-15 7-15 13.5 0 14.2 21.2 17.5 23.4 57.5v86.8c0 19-3.4 22.5-10.9 22.5-20 0-68.6-73.4-97.4-157.4-5.8-16.3-11.5-22.9-26.6-22.9H38.8c-16.8 0-20.2 7.9-20.2 16.7 0 15.6 20 93.1 93.1 195.5C160.4 378.1 229 416 291.4 416c37.5 0 42.1-8.4 42.1-22.9 0-66.8-3.4-73.1 15.4-73.1 8.7 0 23.7 4.4 58.7 38.1 40 40 46.6 57.9 69 57.9h58.9c16.8 0 25.3-8.4 20.4-25-11.2-34.9-86.9-106.7-90.3-111.5-8.7-11.2-6.2-16.2 0-26.2.1-.1 72-101.3 79.4-135.6z'],
                        'whatsapp' => ['https://wa.me/?text='.$share_title.'%20'.$share_url, 448, 'M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z'],
                        'facebook' => ['https://www.facebook.com/sharer/sharer.php?u='.$share_url, 320, 'M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z'],
                    ];
                @endphp
                @foreach ($share as $network => $item)
                    <li>
                        <a class="listing-share__link listing-share__link--{{ $network }}"
                           href="{{ $item[0] }}" target="_blank" rel="nofollow noopener"
                           aria-label="Поделиться в {{ $network }}">
                            <svg viewBox="0 0 {{ $item[1] }} 512" fill="currentColor" aria-hidden="true"><path d="{{ $item[2] }}"/></svg>
                        </a>
                    </li>
                @endforeach
            </ul>
        </section>
    </div>{{-- /container --}}
</section>

{{-- Галерея + лайтбокс: vanilla JS (не зависит от jQuery custom.js).
     Клик по кадру открывает полноэкранный просмотр: стрелки, счётчик,
     клавиатура (Esc / ←→), свайп; клик по фону или Esc закрывает. --}}
<script>
(function () {
  var stage   = document.querySelector('.lg');
  if (!stage) return;
  var imgs    = stage.querySelectorAll('.lg__img');
  var thumbs  = stage.querySelectorAll('.lg__thumb');
  var counter = stage.querySelector('.lg__counter');
  var lb      = document.getElementById('lightbox');
  var current = 0;

  function show(index) {
    if (index < 0) index = imgs.length - 1;
    if (index >= imgs.length) index = 0;
    imgs.forEach(function (img, i) { img.classList.toggle('is-active', i === index); });
    thumbs.forEach(function (t, i) { t.classList.toggle('is-active', i === index); });
    if (counter) counter.textContent = (index + 1) + ' / ' + imgs.length;
    current = index;
  }

  var prev = stage.querySelector('.lg__nav--prev');
  var next = stage.querySelector('.lg__nav--next');
  if (prev) prev.addEventListener('click', function () { show(current - 1); });
  if (next) next.addEventListener('click', function () { show(current + 1); });
  thumbs.forEach(function (t) {
    t.addEventListener('click', function () { show(parseInt(t.dataset.index, 10)); });
  });

  // Свайп по галерее на мобильных
  var x0 = null;
  stage.addEventListener('touchstart', function (e) { x0 = e.touches[0].clientX; }, { passive: true });
  stage.addEventListener('touchend', function (e) {
    if (x0 === null) return;
    var dx = e.changedTouches[0].clientX - x0;
    if (Math.abs(dx) > 40) show(current + (dx < 0 ? 1 : -1));
    x0 = null;
  }, { passive: true });

  /* ---------- ЛАЙТБОКС ---------- */
  if (!lb || !imgs.length) return;

  // Если фото одно — стрелки листания не нужны
  if (imgs.length < 2) {
    var p = lb.querySelector('.lb__nav--prev'), n = lb.querySelector('.lb__nav--next');
    if (p) p.style.display = 'none';
    if (n) n.style.display = 'none';
  }

  var lbImg     = lb.querySelector('.lb__img');
  var lbCounter = lb.querySelector('.lb__counter');
  var lastFocus = null;
  var hideTimer = null;

  function fullSrc(img) { return img.dataset.full || img.src; }
  function preload(img) { var im = new Image(); im.src = fullSrc(img); }

  function lbShow(index) {
    var img = imgs[index];
    lbImg.style.opacity = '0';                 // плавная смена кадра
    lbImg.onload  = function () { lbImg.style.opacity = '1'; };
    lbImg.onerror = lbImg.onload;
    lbImg.src = fullSrc(img);
    lbImg.alt = img.alt;
    if (lbCounter) lbCounter.textContent = (index + 1) + ' / ' + imgs.length;
    preload(imgs[(index + 1) % imgs.length]);  // соседи — заранее в кэш
    preload(imgs[(index - 1 + imgs.length) % imgs.length]);
  }

  function openLb() {
    if (hideTimer) { clearTimeout(hideTimer); hideTimer = null; }
    lastFocus = document.activeElement;
    lb.hidden = false;
    requestAnimationFrame(function () { lb.classList.add('is-open'); });
    document.documentElement.classList.add('lb-lock');
    lbShow(current);
    var btn = lb.querySelector('.lb__close');
    if (btn) btn.focus();
  }

  function closeLb() {
    lb.classList.remove('is-open');
    document.documentElement.classList.remove('lb-lock');
    hideTimer = window.setTimeout(function () { lb.hidden = true; }, 200);
    if (lastFocus && typeof lastFocus.focus === 'function') lastFocus.focus();
    lastFocus = null;
  }

  function lbStep(delta) {
    show(current + delta);   // show() зацикливает индекс и синхронизирует галерею
    lbShow(current);
  }

  // Клик по кадру открывает лайтбокс; стрелки и миниатюры галереи — нет
  stage.addEventListener('click', function (e) {
    if (e.target.closest('.lg__nav') || e.target.closest('.lg__thumb')) return;
    openLb();
  });

  lb.querySelector('.lb__close').addEventListener('click', closeLb);
  lb.querySelector('.lb__nav--prev').addEventListener('click', function () { lbStep(-1); });
  lb.querySelector('.lb__nav--next').addEventListener('click', function () { lbStep(1); });

  // Клик по тёмному фону закрывает (но не клик по самому фото)
  lb.addEventListener('click', function (e) {
    if (e.target === lb || e.target.classList.contains('lb__figure')) closeLb();
  });

  // Клавиатура
  document.addEventListener('keydown', function (e) {
    if (lb.hidden) return;
    if (e.key === 'Escape') { closeLb(); }
    else if (e.key === 'ArrowLeft') { lbStep(-1); }
    else if (e.key === 'ArrowRight') { lbStep(1); }
  });

  // Свайп в лайтбоксе
  var lx0 = null;
  lb.addEventListener('touchstart', function (e) { lx0 = e.touches[0].clientX; }, { passive: true });
  lb.addEventListener('touchend', function (e) {
    if (lx0 === null) return;
    var dx = e.changedTouches[0].clientX - lx0;
    if (Math.abs(dx) > 40) lbStep(dx < 0 ? 1 : -1);
    lx0 = null;
  }, { passive: true });
})();
</script>

{{-- «В избранное»: vanilla JS (в редизайне нет jQuery/custom.js). Логика и
     эндпоинт те же, что в js/custom.js: PATCH /bookmarked передаёт ТЕКУЩЕЕ
     состояние (data-bookmark); ответ 'add' — добавлено, 'remove' — убрано. --}}
<script>
(function () {
  var row = document.querySelector('.listing-fav-row .like');
  if (!row) return;
  var link  = row.querySelector('.listing-fav');
  var label = link.querySelector('span');
  var meta  = document.querySelector('meta[name="csrf-token"]');

  row.addEventListener('click', function () {
    fetch('{{ route('bookmarked') }}', {
      method: 'PATCH',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': meta ? meta.content : ''
      },
      body: JSON.stringify({
        id: row.dataset.bbId,
        bookmark: row.dataset.bookmark
      })
    }).then(function (response) {
      if (response.status === 401) {                    // гость — отправляем на вход
        window.location.href = '{{ route('login') }}';
        return null;
      }
      return response.text();
    }).then(function (result) {
      if (result === null) return;
      var added = (result === 'add');
      row.dataset.bookmark = added ? 'true' : 'false';
      link.classList.toggle('is-active', added);        // красная рамка/иконка
      link.setAttribute('aria-pressed', added ? 'true' : 'false');
      if (label) label.textContent = added ? 'В избранном' : 'В избранное';
    }).catch(function () { /* ошибка сети — молча, как в custom.js */ });
  });
})();
</script>

@endsection
