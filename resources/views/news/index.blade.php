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

{{-- SEO: <title> — коммерческий хвост + бренд, <h1> одиночный (без дубля). --}}
@section('title', 'Новости спецтехники и рынка аренды в Беларуси — новости, обзоры, цены на landi.by')
@section('description', 'Новости рынка аренды и продажи строительной спецтехники в Беларуси: обзоры машин, цены, законодательство и инструкции для собственников и арендаторов.')
@section('og_title', 'Новости спецтехники и рынка аренды в Беларуси')
@section('og_image', (($news->first()->image ?? null) ? Storage::url($news->first()->resizeImage($news->first()->image, 1200, 630)) : asset('images/placeholder/no-image.jpg')))
@section('og_type', 'website')

@push('styles')
    {{-- Стили новостного раздела --}}
    <link rel="stylesheet" href="{{ asset('css/news.css') }}">
    {{-- Стили пагинации каталога: квадратные кнопки, красная активная страница, .catalog-pagination --}}
    <link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
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
          @if ($news->isEmpty())
            <p class="news-empty">В этом разделе пока нет публикаций.</p>
          @else
            {{-- Единая CSS Grid: на десктопе 2 колонки; первая карточка 1-й
                 страницы тянется на всю ширину (span 2), остальные — в 1 колонку. --}}
            <div class="news-grid">
              @foreach ($news as $article)
                @if ($news->onFirstPage() && $loop->first)
                  {{-- ===== ГЛАВНАЯ НОВОСТЬ 1-й страницы: фон-фото + текст поверх ===== --}}
                  <a class="news-card news-card--featured" href="{{ route('news.show', $article) }}"
                     @if ($article->image) style="background-image:url('{{ Storage::url($article->resizeImage($article->image, 1600, 900)) }}');" @endif>
                    {{-- Реальное фото: скрыто на десктопе (фон задаёт background-image),
                         показывается на мобильных, где карточка перестраивается вертикально. --}}
                    @if ($article->image)
                      <img class="news-card--featured__photo"
                           src="{{ Storage::url($article->resizeImage($article->image, 800, 500)) }}"
                           alt="{{ $article->title }}" loading="lazy">
                    @endif
                    <span class="news-card--featured__body">
                      <span class="news-card__meta">
                        <span class="news-card__date">{{ $article->created_at->format('d.m.Y') }}</span>
                        @if ($article->category)<span class="news-card__category">{{ $article->category }}</span>@endif
                      </span>
                      <h2 class="news-card--featured__title">{{ $article->title }}</h2>
                      <span class="news-card--featured__preview">{{ $article->preview_text ?: Str::limit(strip_tags((string) $article->content), 180) }}</span>
                    </span>
                  </a>
                @else
                  {{-- ===== СТАНДАРТНАЯ КАРТОЧКА: фото сверху + белая плашка снизу ===== --}}
                  <a class="news-card news-card--standard" href="{{ route('news.show', $article) }}">
                    <span class="news-card__media">
                      @if ($article->image)
                        <img src="{{ Storage::url($article->resizeImage($article->image, 600, 400)) }}"
                             alt="{{ $article->title }} — фото новости"
                             title="{{ $article->title }} — новость о аренде и продаже спецтехники на landi.by"
                             loading="lazy">
                      @else
                        <span class="news-media-empty">{!! $empty_media !!}</span>
                      @endif
                    </span>
                    <span class="news-card__body">
                      <span class="news-card__meta">
                        <span class="news-card__date">{{ $article->created_at->format('d.m.Y') }}</span>
                        @if ($article->category)<span class="news-card__category">{{ $article->category }}</span>@endif
                      </span>
                      <h3 class="news-card__title">{{ $article->title }}</h3>
                      <span class="news-card__preview">{{ $article->preview_text ?: Str::limit(strip_tags((string) $article->content), 140) }}</span>
                    </span>
                  </a>
                @endif
              @endforeach
            </div>
          @endif
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
      {{-- Стандартный вывод Laravel (Paginator::useBootstrap → .pagination/.page-item/.page-link),
           стилизован под Norwegian в /css/news.css. Фильтр ?category/?tag сохраняется. --}}
      @if ($news->hasPages())
        <nav class="news-pagination" aria-label="Навигация по страницам новостей">
          {{ $news->links() }}
        </nav>
      @endif

    </div>
  </section>

@endsection