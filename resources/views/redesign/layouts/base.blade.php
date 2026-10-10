{{-- ==========================================================================
  Базовый лейаут редизайна (скандинавский минимализм, norwegian.com).
  База стилей: public/css/style.css (токены, reset, .btn, .container).
  Страничные стили подключаются через @push('styles') в дочерних шаблонах.
=========================================================================== --}}
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#D92323">
  {{-- CSRF-токен: нужен AJAX-запросам на страницах редизайна (например, «В избранное») --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', config('site.name') . ' — аренда и продажа строительной техники в Беларуси')</title>
  <meta name="description" content="@yield('description', 'landi.by — открытая площадка объявлений аренды и продажи строительной спецтехники в Беларуси. Сотни объявлений от собственников в одном месте, бесплатное размещение, поиск по городам и категориям машин.')">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">

  {{-- Канонический URL: защита от дублей при наличии GET-параметров (сортировка,
       пагинация, фильтры), которые не меняют смысловое содержимое страницы. --}}
  <link rel="canonical" href="@yield('canonical', url()->current())">

  {{-- Open Graph / Twitter: корректные превью при публикации ссылок в соцсетях
       и мессенджерах. Заголовок/описание по умолчанию повторяют <title>/description. --}}
  <meta property="og:type" content="@yield('og_type', 'website')">
  <meta property="og:site_name" content="{{ config('site.name', 'LANDI.BY') }}">
  <meta property="og:title" content="@yield('og_title', trim($__env->yieldContent('title')))">
  <meta property="og:description" content="@yield('description', 'landi.by — открытая площадка объявлений аренды и продажи строительной спецтехники в Беларуси.')">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:locale" content="ru_RU">
  @hasSection('og_image')
  <meta property="og:image" content="{{ url($__env->yieldContent('og_image')) }}">
  <meta name="twitter:image" content="{{ url($__env->yieldContent('og_image')) }}">
  @endif
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="@yield('og_title', trim($__env->yieldContent('title')))">
  <meta name="twitter:description" content="@yield('description', 'landi.by — открытая площадка объявлений аренды и продажи строительной спецтехники в Беларуси.')">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  {{-- Глобальные стили редизайна. Источник правды — resources/css/app.css;
       пока в окружении нет Node, в рантайме раздаётся его статическая копия.
       После первого `npm install && npm run build` замените строку ниже на:
       @vite('resources/css/app.css') --}}
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  @stack('styles')
</head>
<body>

  <x-header />

  {{-- Основной контент страницы. Строго один <main> на документ: вложенные
       секции контента используют <article>/<section>/<div>, но не <main>. --}}
  <main>
    @yield('content')
  </main>

  <x-footer />

  {{-- Скрипты страниц: подключаются через @push('scripts') в дочерних шаблонах.
       defer — разметка уже разобрана, порядок обращений не важен. --}}
  @stack('scripts')

</body>
</html>
