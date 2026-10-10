@if (Request::routeIs('home')==false)
@if (!empty($isAdminArea))
    {{-- Крошки админки — та же разметка, что в публичном каталоге
         (resources/views/catalog/index.blade.php): .catalog-breadcrumbs с
         .breadcrumb-link / .breadcrumb-sep / .breadcrumb-current.
         Цепочка: Главная / Личный кабинет / <заголовок страницы (@yield title)>.
         Стили — public/css/admin.css, секция 15. --}}
    @php
        $currentCrumb = trim($__env->yieldContent('title'));
        // Легаси-страницы кабинета могли не задавать заголовок или оставлять
        // дефолтное «Главная» (layouts/dashboard) — последняя крошка всё равно
        // должна быть осмысленной, а не дублировать корень.
        if ($currentCrumb === '' || $currentCrumb === 'Главная') {
            $currentCrumb = 'Личный кабинет';
        }
    @endphp
    <div class="container admin-breadcrumbs">
        <nav class="catalog-breadcrumbs" aria-label="Хлебные крошки">
            <a href="{{ url('/') }}" class="breadcrumb-link">Главная</a>
            @if ($currentCrumb !== 'Личный кабинет')
                <span class="breadcrumb-sep" aria-hidden="true">/</span>
                <a href="{{ route('dashboard') }}" class="breadcrumb-link">Личный кабинет</a>
            @endif
            <span class="breadcrumb-sep" aria-hidden="true">/</span>
            <span class="breadcrumb-current">{{ $currentCrumb }}</span>
        </nav>
    </div>
@else
<div class="breadcrumbs">
    <div class="container">
        <div class="row align-items-center">
            {{--<div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title"></h1>
                </div>
            </div>--}}
            <div class="col-12">
                <ul class="breadcrumb-nav">
                    <li>
                        <a href="/">Главная</a>
                    </li>
                @if (isset($breadcrumbs))
                        @foreach($breadcrumbs['list'] as $key=>$breadcrumb)
                            @if (is_object($breadcrumb))
                    <li>
                         <a href="{{route($breadcrumbs['route'],$breadcrumb->id)}}">{{$breadcrumb->title}}</a>
                    </li>
                            @elseif (is_array($breadcrumb))
                    <li>
                         <a href="{{route($breadcrumb['route'])}}{{ (!empty($breadcrumb['param']))? $breadcrumb["param"]:""}}">{{$breadcrumb['title']}}</a>
                    </li>
                         @endif
                        @endforeach

                    @endif
                    <li>@yield('title')</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endif
@endif
