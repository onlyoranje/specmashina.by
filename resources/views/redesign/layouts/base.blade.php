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

  <main>
    @yield('content')
  </main>

  <x-footer />

  {{-- Скрипты страниц: подключаются через @push('scripts') в дочерних шаблонах.
       defer — разметка уже разобрана, порядок обращений не важен. --}}
  @stack('scripts')

</body>
</html>
