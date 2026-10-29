{{-- SEO meta: keywords, title, description, og_*.
     Каждая секция задаёт значение @yield, дефолт — общий для всего сайта.
     Использование: @section('keywords', '...') ... @show в дочернем шаблоне. --}}
@php
    $keywords = $__env->yieldContent('keywords');
    if ($keywords === null || trim($keywords) === '') {
        $keywords = config('site.keywords', 'аренда спецтехники, продажа спецтехники, строительная техника, спецтехника Беларусь, аренда экскаваторов, погрузчики, краны, самосвалы');
    }
@endphp
<meta name="keywords" content="{{ $keywords }}">
