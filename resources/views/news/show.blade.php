{{-- ==========================================================================
   ДЕТАЛЬНАЯ СТРАНИЦА НОВОСТИ · resources/views/news/show.blade.php
   ==========================================================================
   Статья редизайна 2026 в стиле Norwegian Air (norwegian.com).
   Центрированный контентный блок max-width 800px для комфортного чтения.

   Модель данных (data contract):
     $article → Post (роут /news/{article}, NewsController::show).
                Поля: title | content (HTML из CKEditor) | preview_text |
                image | category (строка) | tags (строка «а, б, в») |
                created_at | count_views().
                Примечание: category — строковая колонка posts (не связь),
                поэтому выводится напрямую, а не $article->category->name.
     $related → Collection до 3 постов «Читайте также» (свежие из той же
                категории, добор последними новостями).

   Просмотры инкрементируются в NewsController::show — та же логика, что в
   PostsController::post (не более одного просмотра в сутки на сессию).
   ========================================================================== --}}
@extends('redesign.layouts.base')

@section('title', $article->title)
@section('description', Str::limit(trim(strip_tags($article->preview_text ?: (string) $article->content)), 160))

@push('styles')
    {{-- Стили новостного раздела: подключается постранично (как catalog.css) --}}
    <link rel="stylesheet" href="{{ asset('css/news.css') }}">
@endpush

@section('content')

  @php
      // Время чтения: ~200 слов в минуту; кириллица учитывается через \p{L}
      $plain = trim(strip_tags((string) $article->content));
      $words = $plain !== '' ? (int) preg_match_all('/[\p{L}\p{N}]+/u', $plain) : 0;
      $read_minutes = max(1, (int) ceil($words / 200));

      // Теги статьи: строка «экскаваторы, Минск» → массив
      $articleTags = array_values(array_filter(array_map('trim', explode(',', (string) $article->tags))));

      // Ссылки «Поделиться» (как на странице объявления listings/show)
      $share_url   = urlencode(Request::url());
      $share_title = urlencode($article->title);
      $share = [
          'telegram' => ['https://t.me/share/url?url='.$share_url.'&text='.$share_title, 448, 'M446.7 98.6l-67.6 318.8c-5.1 22.5-18.4 28.1-37.3 17.5l-103-75.9-49.7 47.8c-5.5 5.5-10.1 10.1-20.7 10.1l7.4-104.9 190.9-172.5c8.3-7.4-1.8-11.5-12.9-4.1L117.8 284 16.2 252.2c-22.1-6.9-22.5-22.1 4.6-32.7L418.2 66.4c18.4-6.9 34.5 4.1 28.5 32.2z'],
          'whatsapp' => ['https://wa.me/?text='.$share_title.'%20'.$share_url, 448, 'M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z'],
          'vk'       => ['https://vk.com/share.php?url='.$share_url.'&title='.$share_title, 576, 'M545 117.7c3.7-12.5 0-21.7-17.8-21.7h-58.9c-15 0-21.9 7.9-25.6 16.7 0 0-30 73.1-72.4 120.5-13.7 13.7-20 18.1-27.5 18.1-3.7 0-9.4-4.4-9.4-16.9V117.7c0-15-4.2-21.7-16.6-21.7h-92.6c-9.4 0-15 7-15 13.5 0 14.2 21.2 17.5 23.4 57.5v86.8c0 19-3.4 22.5-10.9 22.5-20 0-68.6-73.4-97.4-157.4-5.8-16.3-11.5-22.9-26.6-22.9H38.8c-16.8 0-20.2 7.9-20.2 16.7 0 15.6 20 93.1 93.1 195.5C160.4 378.1 229 416 291.4 416c37.5 0 42.1-8.4 42.1-22.9 0-66.8-3.4-73.1 15.4-73.1 8.7 0 23.7 4.4 58.7 38.1 40 40 46.6 57.9 69 57.9h58.9c16.8 0 25.3-8.4 20.4-25-11.2-34.9-86.9-106.7-90.3-111.5-8.7-11.2-6.2-16.2 0-26.2.1-.1 72-101.3 79.4-135.6z'],
          'facebook' => ['https://www.facebook.com/sharer/sharer.php?u='.$share_url, 320, 'M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z'],
      ];
  @endphp

  <section class="article-page">
    <div class="container">
      <article class="article">

        {{-- ================= ХЛЕБНЫЕ КРОШКИ ================= --}}
        <nav class="news-crumbs" aria-label="Навигационная цепочка">
          <a href="{{ url('/') }}">Главная</a>
          <span class="news-crumbs__sep" aria-hidden="true">/</span>
          <a href="{{ route('news.index') }}">Новости</a>
          @if ($article->category)
            <span class="news-crumbs__sep" aria-hidden="true">/</span>
            <a href="{{ route('news.index', ['category' => $article->category]) }}">{{ $article->category }}</a>
          @endif
        </nav>

        {{-- ================= ШАПКА СТАТЬИ ================= --}}
        <div class="article-eyebrow">
          @if ($article->category)
            <a class="article-eyebrow__category"
               href="{{ route('news.index', ['category' => $article->category]) }}">{{ $article->category }}</a>
          @endif
          <span class="article-eyebrow__date">{{ $article->created_at->format('d.m.Y') }}</span>
        </div>

        <h1 class="article-title">{{ $article->title }}</h1>

        <ul class="article-meta">
          <li class="article-meta__item">
            <svg class="article-meta__icon" viewBox="0 0 512 512" fill="currentColor" aria-hidden="true"><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm61.8-104.4l-84.9-61.7c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v141.7l66.8 48.6c5.4 3.9 6.5 11.4 2.6 16.8L334.6 349c-3.9 5.3-11.4 6.5-16.8 2.6z"/></svg>
            <span>{{ $read_minutes }} {{ trans_choice('минута чтения|минуты чтения|минут чтения', $read_minutes) }}</span>
          </li>
          <li class="article-meta__item">
            <svg class="article-meta__icon" viewBox="0 0 576 512" fill="currentColor" aria-hidden="true"><path d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z"/></svg>
            <span>{{ $article->count_views() }} {{ trans_choice('просмотр|просмотра|просмотров', $article->count_views()) }}</span>
          </li>
        </ul>

        {{-- ================= ГЛАВНОЕ ИЗОБРАЖЕНИЕ ================= --}}
        @if ($article->image)
          <figure class="article-figure">
            <img class="article-image"
                 src="{{ Storage::url($article->resizeImage($article->image, 1200, null)) }}"
                 alt="{{ $article->title }}">
          </figure>
        @endif

        {{-- ================= ТЕКСТ СТАТЬИ ================= --}}
        <div class="news-content">
          {!! $article->content !!}
        </div>

        {{-- ================= ТЕГИ СТАТЬИ ================= --}}
        @if ($articleTags)
          <div class="article-tags">
            <div class="news-tags">
              @foreach ($articleTags as $tag)
                <a class="news-tags__link" href="{{ route('news.index', ['tag' => $tag]) }}">#{{ $tag }}</a>
              @endforeach
            </div>
          </div>
        @endif

        {{-- ================= ПОДЕЛИТЬСЯ ================= --}}
        <div class="article-share">
          <span class="article-share__label">Поделиться:</span>
          <ul class="share-row">
            @foreach ($share as $network => $item)
              <li>
                <a class="share-btn" href="{{ $item[0] }}" target="_blank" rel="nofollow noopener"
                   aria-label="Поделиться в {{ $network }}">
                  <svg viewBox="0 0 {{ $item[1] }} 512" fill="currentColor" aria-hidden="true"><path d="{{ $item[2] }}"/></svg>
                </a>
              </li>
            @endforeach
          </ul>
        </div>
      </article>

      {{-- ================= ЧИТАЙТЕ ТАКЖЕ ================= --}}
      @if ($related->isNotEmpty())
        <section class="article-related">
          <h2 class="article-related__title">Читайте также</h2>
          <div class="related-grid">
            @foreach ($related as $post)
              <a class="related-card" href="{{ route('news.show', $post) }}">
                @if ($post->category)<span class="related-card__category">{{ $post->category }}</span>@endif
                <h3 class="related-card__title">{{ $post->title }}</h3>
                <span class="related-card__date">{{ $post->created_at->format('d.m.Y') }}</span>
              </a>
            @endforeach
          </div>
        </section>
      @endif
    </div>
  </section>

@endsection