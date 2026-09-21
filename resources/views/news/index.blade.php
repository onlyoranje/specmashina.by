{{-- ==========================================================================
   СПИСОК НОВОСТЕЙ (БЛОГ) · resources/views/news/index.blade.php
   ==========================================================================
   Лента новостей редизайна 2026 в стиле Norwegian Air (norwegian.com).
   Один шаблон обслуживает общий список и фильтры «?category=…» / «?tag=…».

   Модель данных (data contract):
     $news       → LengthAwarePaginator активных постов (Post), сортировка id
                   по убыванию; фильтры сохраняются в ссылках (appends).
     $categories → array уникальных категорий активных постов (лента-фильтр).
     $popular    → Collection 4 самых читаемых постов (сумма views по
                   post_statistics — приём withSum, как у Bb на главной).
     $tags       → array уникальных тегов (строки) для облака в сайдбаре.

   Поля Post: title | preview_text | content | image | category (строка) |
   tags (строка «экскаваторы, Минск») | created_at | count_views().
   Активный фильтр читается из query string: request('category')/request('tag').
   ========================================================================== --}}
@extends('redesign.layouts.base')

@section('title', 'Новости спецтехники и рынка аренды в Беларуси')
@section('description', 'Новости рынка аренды и продажи строительной спецтехники в Беларуси: обзоры машин, цены, законодательство и инструкции для собственников и арендаторов.')

@push('styles')
    {{-- Стили новостного раздела: подключается постранично (как catalog.css) --}}
    <link rel="stylesheet" href="{{ asset('css/news.css') }}">
@endpush

@section('content')

  @php
      // Заглушка «нет фото» для карточек без изображения (одна на файл)
      $empty_media = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="9" cy="10" r="2"/><path d="M21 16.5l-4.5-5.5-5.5 7L8 15l-5 6"/></svg>';
  @endphp

  <section class="news-page">
    <div class="container">

      {{-- ================= HERO + ЛЕНТА КАТЕГОРИЙ ================= --}}
      <header class="news-hero">
        <p class="news-hero__eyebrow">Блог · {{ config('site.domain') }}</p>
        <h1 class="news-hero__title">Новости спецтехники и рынка аренды в Беларуси</h1>

        <nav class="news-categories" aria-label="Категории новостей">
          <a @class(['news-categories__link', 'is-active' => !request('category') && !request('tag')])
             href="{{ route('news.index') }}">Все</a>
          @foreach ($categories as $category)
            <a @class(['news-categories__link', 'is-active' => request('category') === $category])
               href="{{ route('news.index', ['category' => $category]) }}">{{ $category }}</a>
          @endforeach
        </nav>
      </header>

      {{-- ================= ДВУХКОЛОНОЧНЫЙ МАКЕТ ================= --}}
      <div class="news-layout">

        {{-- ---------- ЛЕВАЯ КОЛОНКА: ЛЕНТА НОВОСТЕЙ ---------- --}}
        <div class="news-feed">
          @forelse ($news as $post)
            @if ($loop->first)
              {{-- ГЛАВНАЯ НОВОСТЬ: крупный горизонтальный блок --}}
              <a class="news-featured" href="{{ route('news.show', $post) }}">
                <div class="news-featured__media">
                  @if ($post->image)
                    <img src="{{ Storage::url($post->resizeImage($post->image, 900, 600)) }}"
                         alt="{{ $post->title }}">
                  @else
                    <div class="news-media-empty">{!! $empty_media !!}</div>
                  @endif
                </div>
                <div class="news-featured__body">
                  <div class="news-featured__meta">
                    @if ($post->category)<span class="news-featured__category">{{ $post->category }}</span>@endif
                    <span class="news-featured__date">{{ $post->created_at->format('d.m.Y') }}</span>
                  </div>
                  <h2 class="news-featured__title">{{ $post->title }}</h2>
                  <div class="news-featured__preview">{{ $post->preview_text ?: Str::limit(strip_tags((string) $post->content), 180) }}</div>
                </div>
              </a>

              <div class="news-grid">
            @else
              {{-- КАРТОЧКА НОВОСТИ --}}
              <a class="news-card" href="{{ route('news.show', $post) }}">
                <div class="news-card__media">
                  @if ($post->image)
                    <img src="{{ Storage::url($post->resizeImage($post->image, 600, 400)) }}"
                         alt="{{ $post->title }}" loading="lazy">
                  @else
                    <div class="news-media-empty">{!! $empty_media !!}</div>
                  @endif
                </div>
                <div class="news-card__body">
                  @if ($post->category)<span class="news-card__category">{{ $post->category }}</span>@endif
                  <h3 class="news-card__title">{{ $post->title }}</h3>
                  <span class="news-card__date">{{ $post->created_at->format('d.m.Y') }}</span>
                  @php
                      // tags хранятся строкой «экскаваторы, Минск» — до 3 тегов на карточку
                      $cardTags = array_slice(array_filter(array_map('trim', explode(',', (string) $post->tags))), 0, 3);
                  @endphp
                  @if ($cardTags)
                    <div class="news-card__tags">
                      @foreach ($cardTags as $tag)<span class="news-card__tag">#{{ $tag }}</span>@endforeach
                    </div>
                  @endif
                </div>
              </a>
            @endif
            @if ($loop->last)</div>@endif
          @empty
            <p class="news-empty">В этом разделе пока нет публикаций.</p>
          @endforelse
        </div>

        {{-- ---------- САЙДБАР ---------- --}}
        <aside class="news-side">
          @if ($tags)
            <section class="news-side__block">
              <h2 class="news-side__title">Популярные теги</h2>
              <div class="news-tags">
                @foreach ($tags as $tag)
                  <a @class(['news-tags__link', 'is-active' => request('tag') === $tag])
                     href="{{ route('news.index', ['tag' => $tag]) }}">#{{ $tag }}</a>
                @endforeach
              </div>
            </section>
          @endif

          @if ($popular->isNotEmpty())
            <section class="news-side__block">
              <h2 class="news-side__title">Популярное</h2>
              <ul class="news-popular">
                @foreach ($popular as $post)
                  <li>
                    <a class="news-popular__item" href="{{ route('news.show', $post) }}">
                      <span class="news-popular__title">{{ $post->title }}</span>
                      <span class="news-popular__date">{{ $post->created_at->format('d.m.Y') }}</span>
                    </a>
                  </li>
                @endforeach
              </ul>
            </section>
          @endif
        </aside>
      </div>

      {{-- ================= ПАГИНАЦИЯ ================= --}}
      @if ($news->hasPages())
        <nav class="news-pagination" aria-label="Страницы новостей">
          {{ $news->links() }}
        </nav>
      @endif

    </div>
  </section>

@endsection