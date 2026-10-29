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

  <!-- SEO: meta keywords (несколько тегов для разных поисковиков) -->
  <meta name="keywords" content="@yield('keywords', 'аренда спецтехники, продажа спецтехники, строительная техника,Landi.by, спецтехника Беларусь, аренда экскаваторов, погрузчики, краны, самосвалы, землеройка, бульдозеры, буровое оборудование, спецтехника в Минске, спецтехника в Гродно, спецтехника в Витебске, спецтехника в Гомеле, сараны, земляные работы, техника для строительства')">

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
  <!-- SEO: structured data (Organization + WebSite) -->
  <script type="application/ld+json">
  @include('redesign.components.seo.schemas.organization')
  </script>
  <script type="application/ld+json">
  @include('redesign.components.seo.schemas.website')
  </script>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  {{-- Глобальные стили редизайна. Источник правды — resources/css/app.css;
       пока в окружении нет Node, в рантайме раздаётся его статическая копия.
       После первого `npm install && npm run build` замените строку ниже на:
       @vite('resources/css/app.css') --}}
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" type="text/css" href="{{asset("vendor/cookie-consent/css/cookie-consent.css")}}">
  @stack('styles')
</head>
<body @php $cookieRefused = isset($_COOKIE[config('cookie-consent.cookie_refuse_name')]) && $_COOKIE[config('cookie-consent.cookie_refuse_name')] == '1'; @endphp>

  <x-header />

  {{-- Основной контент страницы. Строго один <main> на документ: вложенные
       секции контента используют <article>/<section>/<div>, но не <main>. --}}
  <main>
    @php $breadcrumbs ??= []; @endphp
    @if (! empty($breadcrumbs) && is_array($breadcrumbs) && isset($breadcrumbs['list']) && is_array($breadcrumbs['list']))
        @include('redesign.components.seo.schemas.breadcrumb')
    @endif

    @yield('content')
  </main>

  <x-footer />

  {{-- Скрипты страниц: подключаются через @push('scripts') в дочерних шаблонах.
       defer — разметка уже разобрана, порядок обращений не важен. --}}
  @stack('scripts')

  {{-- Google tag (gtag.js) — только если не отказано в куки --}}
  @if (!$cookieRefused)
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-S960LS3E82"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-S960LS3E82');
  </script>
  @endif

  {{-- Yandex.Metrika counter — только если не отказано в куки --}}
  @if (!$cookieRefused)
  <script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();
        for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return: }}
        k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(98791848, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
    });
  </script>
  <noscript><div><img src="https://mc.yandex.ru/watch/98791848" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
  @endif

</body>
</html>
