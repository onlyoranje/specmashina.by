<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="module" src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    @vite(['resources/js/app.js'])

</head>
<body>
{{--
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item"  href="{{route('mybb')}}">Dashboard</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <nav class="nav">
            <a class="nav-link" href="{{route('mybb')}}"> Мои объявления</a>
            <a href="{{route('my_organization')}}"  class="nav-link" >Моя организация</a>
            @if(Auth::user()->isAdmin())
            <a href="{{route('location_dashboard')}}" class="nav-link">Список городов</a>
            <a href="{{route('rubric_dashboard')}}" class="nav-link"> Список категорий</a>
            <a href="{{route('parameter_dashboard')}}" class="nav-link"> Параметры</a>
            <a href="{{route('vendor_dashboard')}}" class="nav-link"> Список производителей</a>
            <a href="{{route('price_type_dashboard')}}" class="nav-link"> Виды цен</a>
            <a href="{{route('contact_type_dashboard')}}" class="nav-link"> Типы контатков</a>
                @endif
        </nav>

        @yield('main')
    </main>
</div>
--}}
<header class="header-global">
    <nav id="navbar-main" aria-label="Primary navigation" class="navbar navbar-main navbar-expand-lg navbar-theme-primary headroom navbar-light navbar-theme-secondary">
        <div class="container position-relative">
            <a class="navbar-brand me-lg-5" href="../../index.html">
                <img class="navbar-brand-dark" src="../../assets/img/brand/light.svg" alt="Logo light">
                <img class="navbar-brand-light" src="../../assets/img/brand/dark.svg" alt="Logo dark">
            </a>
            <div class="navbar-collapse collapse me-auto" id="navbar_global">
                <div class="navbar-collapse-header">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            <a href="../../index.html">
                                <img src="../../assets/img/brand/dark.svg" alt="Themesberg logo">
                            </a>
                        </div>
                        <div class="col-6 collapse-close">
                            <a href="#navbar_global" class="fas fa-times" data-bs-toggle="collapse" data-bs-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" title="close" aria-label="Toggle navigation"></a>
                        </div>
                    </div>
                </div>
                <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="frontPagesDropdown" aria-expanded="false" data-bs-toggle="dropdown">
                            Pages
                            <span class="fas fa-angle-down nav-link-arrow ms-1"></span>
                        </a>
                        <div class="dropdown-menu dropdown-megamenu px-0 py-2 p-lg-4" aria-labelledby="frontPagesDropdown">
                            <div class="row">
                                <div class="col-6 col-lg-4">
                                    <h6 class="d-block mb-3 text-primary">Main pages</h6>
                                    <ul class="list-style-none mb-4">
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="../../html/pages/about.html">About</a>
                                        </li>
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="../../html/pages/contact.html">Contact</a>
                                        </li>
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="https://demo.themesberg.com/pixel-pro/v5/html/pages/pricing.html" target="_blank">Pricing <span class="badge bg-tertiary">Pro</span></a>
                                        </li>
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="https://demo.themesberg.com/pixel-pro/v5/html/pages/team.html" target="_blank">Team <span class="badge bg-tertiary">Pro</span></a>
                                        </li>
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="https://demo.themesberg.com/pixel-pro/v5/html/pages/services.html" target="_blank">Services <span class="badge bg-tertiary">Pro</span></a>
                                        </li>
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="https://demo.themesberg.com/pixel-pro/v5/html/pages/profile.html" target="_blank">Profile <span class="badge bg-tertiary">Pro</span></a>
                                        </li>
                                    </ul>
                                    <h6 class="d-block text-primary">Legal</h6>
                                    <ul class="list-style-none mb-4">
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="https://demo.themesberg.com/pixel-pro/v5/html/pages/legal.html" target="_blank">Legal center <span class="badge bg-tertiary">Pro</span></a>
                                        </li>
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="https://demo.themesberg.com/pixel-pro/v5/html/pages/terms.html" target="_blank">Terms <span class="badge bg-tertiary">Pro</span></a>
                                        </li>
                                    </ul>
                                    <h6 class="d-block text-primary">Career</h6>
                                    <ul class="list-style-none mb-4">
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="https://demo.themesberg.com/pixel-pro/v5/html/pages/careers.html" target="_blank">Careers <span class="badge bg-tertiary">Pro</span></a>
                                        </li>
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="https://demo.themesberg.com/pixel-pro/v5/html/pages/career-single.html" target="_blank">Career Single <span class="badge bg-tertiary">Pro</span></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-6 col-lg-4">
                                    <h6 class="d-block mb-3 text-primary">Landings</h6>
                                    <ul class="list-style-none mb-4">
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="../../html/pages/landing-freelancer.html">Freelancer</a>
                                        </li>
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="https://demo.themesberg.com/pixel-pro/v5/html/pages/landing-app.html" target="_blank">App <span class="badge bg-tertiary">Pro</span></a>
                                        </li>
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="https://demo.themesberg.com/pixel-pro/v5/html/pages/landing-crypto.html" target="_blank">Crypto <span class="badge bg-tertiary">Pro</span></a>
                                        </li>
                                    </ul>
                                    <h6 class="d-block mb-3 text-primary">Support</h6>
                                    <ul class="list-style-none mb-4">
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="https://demo.themesberg.com/pixel-pro/v5/html/pages/support.html" target="_blank">Support center <span class="badge bg-tertiary">Pro</span></a>
                                        </li>
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="https://demo.themesberg.com/pixel-pro/v5/html/pages/support-topic.html" target="_blank">Support topic <span class="badge bg-tertiary">Pro</span></a>
                                        </li>
                                    </ul>
                                    <h6 class="d-block mb-3 text-primary">Blog</h6>
                                    <ul class="list-style-none mb-4">
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="https://demo.themesberg.com/pixel-pro/v5/html/pages/blog.html" target="_blank">Blog <span class="badge bg-tertiary">Pro</span></a>
                                        </li>
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="https://demo.themesberg.com/pixel-pro/v5/html/pages/blog-post.html" target="_blank">Blog post <span class="badge bg-tertiary">Pro</span></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-6 col-lg-4">
                                    <h6 class="d-block mb-3 text-primary">User</h6>
                                    <ul class="list-style-none mb-4">
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="../../html/pages/sign-in.html">Sign in</a>
                                        </li>
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="../../html/pages/sign-up.html">Sign up</a>
                                        </li>
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="https://demo.themesberg.com/pixel-pro/v5/html/pages/forgot-password.html" target="_blank">Forgot password <span class="badge bg-tertiary">Pro</span></a>
                                        </li>
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="https://demo.themesberg.com/pixel-pro/v5/html/pages/reset-password.html" target="_blank">Reset password <span class="badge bg-tertiary">Pro</span></a>
                                        </li>
                                    </ul>
                                    <h6 class="d-block mb-3 text-primary">Special</h6>
                                    <ul class="list-style-none mb-4">
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="https://demo.themesberg.com/pixel-pro/v5/html/pages/404.html" target="_blank">404 Not Found <span class="badge bg-tertiary">Pro</span></a>
                                        </li>
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="https://demo.themesberg.com/pixel-pro/v5/html/pages/500.html" target="_blank">500 Server Error <span class="badge bg-tertiary">Pro</span></a>
                                        </li>
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="https://demo.themesberg.com/pixel-pro/v5/html/pages/maintenance.html" target="_blank">Maintenance <span class="badge bg-tertiary">Pro</span></a>
                                        </li>
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="https://demo.themesberg.com/pixel-pro/v5/html/pages/coming-soon.html" target="_blank">Coming soon <span class="badge bg-tertiary">Pro</span></a>
                                        </li>
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="../../html/pages/blank.html">Blank page</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="dashboardDropdown" aria-expanded="false" data-bs-toggle="dropdown">
                            Dashboard
                            <span class="fas fa-angle-down nav-link-arrow ms-1"></span>
                        </a>
                        <div class="dropdown-menu dropdown-megamenu-sm px-0 py-2 p-lg-4" aria-labelledby="dashboardDropdown">
                            <div class="row">
                                <div class="col-6">
                                    <h6 class="d-block mb-3 text-primary">User dashboard</h6>
                                    <ul class="list-style-none mb-4">
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="https://demo.themesberg.com/pixel-pro/v5/html/dashboard/account.html" target="_blank">My account <span class="badge bg-tertiary">Pro</span></a>
                                        </li>
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="https://demo.themesberg.com/pixel-pro/v5/html/dashboard/settings.html" target="_blank">Settings <span class="badge bg-tertiary">Pro</span></a>
                                        </li>
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="https://demo.themesberg.com/pixel-pro/v5/html/dashboard/security.html" target="_blank">Security <span class="badge bg-tertiary">Pro</span></a>
                                        </li>
                                    </ul>
                                    <h6 class="d-block mb-3 text-primary">Items</h6>
                                    <ul class="list-style-none">
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="https://demo.themesberg.com/pixel-pro/v5/html/dashboard/my-items.html" target="_blank">My items <span class="badge bg-tertiary">Pro</span></a>
                                        </li>
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="https://demo.themesberg.com/pixel-pro/v5/html/dashboard/edit-item.html" target="_blank">Edit item <span class="badge bg-tertiary">Pro</span></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <h6 class="d-block mb-3 text-primary">Messaging</h6>
                                    <ul class="list-style-none mb-4">
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="https://demo.themesberg.com/pixel-pro/v5/html/dashboard/messages.html" target="_blank">Messages <span class="badge bg-tertiary">Pro</span></a>
                                        </li>
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="https://demo.themesberg.com/pixel-pro/v5/html/dashboard/single-message.html" target="_blank">Chat <span class="badge bg-tertiary">Pro</span></a>
                                        </li>
                                    </ul>
                                    <h6 class="d-block mb-3 text-primary">Billing</h6>
                                    <ul class="list-style-none mb-4">
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="https://demo.themesberg.com/pixel-pro/v5/html/dashboard/billing.html" target="_blank">Billing details <span class="badge bg-tertiary">Pro</span></a>
                                        </li>
                                        <li class="mb-2 megamenu-item">
                                            <a class="megamenu-link" href="https://demo.themesberg.com/pixel-pro/v5/html/dashboard/invoice.html" target="_blank">Invoice <span class="badge bg-tertiary">Pro</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="componentsDropdown" aria-expanded="false" data-bs-toggle="dropdown">
                            Components
                            <span class="fas fa-angle-down nav-link-arrow ms-1"></span>
                        </a>
                        <div class="dropdown-menu dropdown-megamenu-md p-0" aria-labelledby="componentsDropdown">
                            <div class="row g-0">
                                <div class="col-lg-6 bg-dark d-none d-lg-block me-0 me-3">
                                    <div class="px-0 py-3 text-center">
                                        <img src="../../assets/img/megamenu_image.png" alt="Pixel Components">
                                    </div>
                                </div>
                                <div class="col ps-0 py-3">
                                    <ul class="list-style-none">
                                        <li><a class="dropdown-item" href="../../html/components/accordions.html">Accordions</a></li>
                                        <li><a class="dropdown-item" href="../../html/components/alerts.html">Alerts</a></li>
                                        <li><a class="dropdown-item" href="../../html/components/badges.html">Badges</a></li>
                                        <li><a class="dropdown-item" href="../../html/components/cards.html">Cards</a></li>
                                        <li><a class="dropdown-item" href="https://demo.themesberg.com/pixel-pro/v5/html/components/charts.html" target="_blank">Charts <span class="badge bg-tertiary">Pro</span></a></li>
                                        <li><a class="dropdown-item" href="../../html/components/bootstrap-carousels.html">Carousels</a></li>
                                        <li><a class="dropdown-item" href="../../html/components/breadcrumbs.html">Breadcrumbs</a></li>
                                        <li><a class="dropdown-item" href="../../html/components/buttons.html">Buttons</a></li>
                                        <li><a class="dropdown-item" href="https://demo.themesberg.com/pixel-pro/v5/html/components/counters.html" target="_blank">Counters <span class="badge bg-tertiary">Pro</span></a></li>
                                    </ul>
                                </div>
                                <div class="col ps-0 py-3">
                                    <ul class="list-style-none">
                                        <li><a class="dropdown-item" href="../../html/components/dropdowns.html">Dropdowns</a></li>
                                        <li><a class="dropdown-item" href="https://demo.themesberg.com/pixel-pro/v5/html/components/e-commerce.html" target="_blank">E-commerce <span class="badge bg-tertiary">Pro</span></a></li>
                                        <li><a class="dropdown-item" href="../../html/components/forms.html">Forms</a></li>
                                        <li><a class="dropdown-item" href="https://demo.themesberg.com/pixel-pro/v5/html/components/icon-boxes.html" target="_blank">Icon Boxes <span class="badge bg-tertiary">Pro</span></a></li>
                                        <li><a class="dropdown-item" href="../../html/components/modals.html">Modals</a></li>
                                        <li><a class="dropdown-item" href="../../html/components/navs.html">Navs</a></li>
                                        <li><a class="dropdown-item" href="https://demo.themesberg.com/pixel-pro/v5/html/components/glidejs-carousels.html" target="_blank">GlideJS <span class="badge bg-tertiary">Pro</span></a></li>
                                        <li><a class="dropdown-item" href="../../html/components/pagination.html">Pagination</a></li>
                                        <li><a class="dropdown-item" href="../../html/components/popovers.html">Popovers</a></li>
                                    </ul>
                                </div>
                                <div class="col ps-0 py-3">
                                    <ul class="list-style-none">
                                        <li><a class="dropdown-item" href="../../html/components/progress-bars.html">Progress Bars</a></li>
                                        <li><a class="dropdown-item" href="https://demo.themesberg.com/pixel-pro/v5/html/components/steps.html" target="_blank">Steps <span class="badge bg-tertiary">Pro</span></a></li>
                                        <li><a class="dropdown-item" href="../../html/components/tables.html">Tables</a></li>
                                        <li><a class="dropdown-item" href="../../html/components/tabs.html">Tabs</a> </li>
                                        <li><a class="dropdown-item" href="../../html/components/toasts.html">Toasts</a> </li>
                                        <li><a class="dropdown-item" href="https://demo.themesberg.com/pixel-pro/v5/html/components/timelines.html" target="_blank">Timelines <span class="badge bg-tertiary">Pro</span></a></li>
                                        <li><a class="dropdown-item" href="../../html/components/tooltips.html">Tooltips</a></li>
                                        <li><a class="dropdown-item" href="../../html/components/typography.html">Typography</a></li>
                                        <li><a class="dropdown-item" href="https://demo.themesberg.com/pixel-pro/v5/html/components/widgets.html" target="_blank">Widgets <span class="badge bg-tertiary">Pro</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" id="supportDropdown" aria-expanded="false">
                            Support
                            <span class="fas fa-angle-down nav-link-arrow ms-1"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg" aria-labelledby="supportDropdown">
                            <div class="col-auto px-0">
                                <div class="list-group list-group-flush">
                                    <a href="https://themesberg.com/docs/bootstrap-5/pixel/getting-started/quick-start/" target="_blank" class="list-group-item list-group-item-action d-flex align-items-center p-0 py-3 px-lg-4">
                                        <span class="icon icon-sm"><span class="fas fa-file-alt"></span></span>
                                        <div class="ms-4">
                                            <span class="d-block font-small fw-bold mb-0">Documentation<span class="badge badge-sm badge-secondary ms-2">v3.1</span></span>
                                            <span class="small">Examples and guides</span>
                                        </div>
                                    </a>
                                    <a href="https://github.com/themesberg/pixel-bootstrap-ui-kit/issues" target="_blank" class="list-group-item list-group-item-action d-flex align-items-center p-0 py-3 px-lg-4">
                                        <span class="icon icon-sm"><span class="fas fa-microphone-alt"></span></span>
                                        <div class="ms-4">
                                            <span class="d-block font-small fw-bold mb-0">Support</span>
                                            <span class="small">Need help? Ask us!</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="d-flex align-items-center">
                <a href="https://themesberg.com/docs/bootstrap-5/pixel/getting-started/quick-start/" target="_blank" class="btn btn-outline-gray-100 d-none d-lg-inline me-md-3"><span class="fas fa-book me-2"></span> Docs</a>
                <a href="https://themesberg.com/product/ui-kit/pixel-free-bootstrap-5-ui-kit" target="_blank" class="btn btn-tertiary"><i class="fas fa-cloud-download-alt me-2"></i> Download</a>
                <button class="navbar-toggler ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    </nav>
</header>
<main>


    <!-- Hero -->
{{--    <section class="section-header">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 text-center">
                    <h1 class="display-2 mb-3">Blank starter page</h1>
                    <p>Hello world!</p>
                </div>
            </div>
        </div>
    </section>--}}

    @yield('main')
</main>
<footer class="footer pt-6 pb-5 bg-dark text-white">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img class="navbar-brand-dark mb-4" height="35" src="../../assets/img/brand/light.svg"
                     alt="Logo light">
                <p>Pixel is a free and open source Bootstrap 5 UI Kit that will help you prototype and build beautiful website pages and applications.</p>
                <ul class="social-buttons mb-5 mb-lg-0">
                    <li>
                        <a href="https://twitter.com/themesberg" aria-label="twitter social link"
                           class="icon-white me-2">
                            <span class="fab fa-twitter"></span>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.facebook.com/themesberg/" class="icon-white me-2"
                           aria-label="facebook social link">
                            <span class="fab fa-facebook"></span>
                        </a>
                    </li>
                    <li>
                        <a href="https://github.com/themesberg" aria-label="github social link" class="icon-white me-2">
                            <span class="fab fa-github"></span>
                        </a>
                    </li>
                    <li>
                        <a href="https://dribbble.com/themesberg" class="icon-white" aria-label="dribbble social link">
                            <span class="fab fa-dribbble"></span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-6 col-md-2 mb-5 mb-lg-0">
                <span class="h5">Themesberg</span>
                <ul class="footer-links mt-2">
                    <li><a target="_blank" href="https://themesberg.com/blog">Blog</a></li>
                    <li><a target="_blank" href="https://themesberg.com/themes">Themes</a></li>
                    <li><a target="_blank" href="https://themesberg.com/about">About Us</a></li>
                    <li><a target="_blank" href="https://themesberg.com/contact">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-6 col-md-2 mb-5 mb-lg-0">
                <span class="h5">Other</span>
                <ul class="footer-links mt-2">
                    <li><a href="https://themesberg.com/docs/bootstrap-5/pixel/getting-started/quick-start/"
                           target="_blank">Docs</a></li>
                    <li><a href="https://themesberg.com/docs/pixel-bootstrap/getting-started/changelog"
                           target="_blank">Changelog</a></li>
                    <li><a target="_blank" href="https://themesberg.com/licensing">License</a>
                    </li>
                    <li><a target="_blank"
                           href="https://github.com/themesberg/pixel-bootstrap-ui-kit/issues">Support</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-4 mb-5 mb-lg-0">
                <span class="h5">Subscribe</span>
                <p class="text-muted font-small mt-2">Join our mailing list. We write rarely, but only the best content.
                </p>
                <form action="#">
                    <div class="form-row mb-2">
                        <div class="col-12">
                            <label class="h6 fw-normal text-muted d-none" for="exampleInputEmail3">Email address</label>
                            <input type="email" class="form-control mb-2" placeholder="example@company.com" name="email"
                                   aria-label="Subscribe form" id="exampleInputEmail3" required>
                        </div>
                        <div class="col-12 d-grid">
                            <button type="submit" class="btn btn-tertiary" data-loading-text="Sending">
                                <span>Subscribe</span>
                            </button>
                        </div>
                    </div>
                </form>
                <p class="text-muted font-small m-0">We’ll never share your details. See our <a class="text-white"
                                                                                                href="#">Privacy Policy</a></p>
            </div>
        </div>
        <hr class="bg-secondary my-3 my-lg-5">
        <div class="row">
            <div class="col mb-md-0">
                <a href="https://themesberg.com" target="_blank" class="d-flex justify-content-center mb-3">
                    <img src="../../assets/img/themesberg.svg" height="30" class="me-2" alt="Themesberg Logo">
                    <p class="text-white fw-bold footer-logo-text m-0">Themesberg</p>
                </a>
                <div class="d-flex text-center justify-content-center align-items-center" role="contentinfo">
                    <p class="fw-normal font-small mb-0">Copyright © Themesberg 2019-<span
                            class="current-year">2021</span>. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<script type="text/javascript">
    $(document).ready(function() {

        // enable fileuploader plugin
        $('input[name="file"]').fileuploader({
            limit: 20,
            maxSize: 50,

            changeInput: '<div class="fileuploader-input">' +
                '<div class="fileuploader-input-inner">' +
                '<div class="fileuploader-icon-main"></div>' +
                '<h3 class="fileuploader-input-caption"><span>Нет фото</span></h3>' +
                '<p>Перетащите фото сюда</p>' +
                '<button type="button" class="fileuploader-input-button"><span>загрузить фото</span></button>' +
                '</div>' +
                '</div>',
            theme: 'thumbnails',
            addMore: true,
            //            thumbnails: {
            //                onItemShow: function(item) {
            //                    // add sorter button to the item html
            //                    item.html.find('.fileuploader-action-remove').before('<button type="button" class="fileuploader-action fileuploader-action-sort" title="Sort"><i class="fileuploader-icon-sort"></i></button>');
            //                }
            //            },
            thumbnails: {
                // thumbnails list HTML {String, Function}
                // example: '<ul></ul>'
                // example: function(options) { return '<ul></ul>'; }
                box: '<div class="fileuploader-items">' +
                    '<ul class="fileuploader-items-list row"></ul>' +
                    '</div>',

                // append thumbnails list to selector {null, String, jQuery Object}
                // example: 'body'
                boxAppendTo: null,

                // thumbnails for the choosen files {String, Function}
                // example: '<li>${name}</li>'
                // example: function(item) { return '<li>' + item.name + '</li>'; }
                item: '<li class="fileuploader-item">' +
                    '<div class="fileuploader-item-inner">' +
                    '<div class="type-holder">${extension}</div>' +
                    '<div class="actions-holder">' +
                    '<button type="button" class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="fileuploader-icon-remove"></i></button>' +
                    '</div>' +
                    '<div class="thumbnail-holder">' +
                    '${image}' +
                    '<span class="fileuploader-action-popup"></span>' +
                    '</div>' +
                    '<div class="content-holder"><h5>${name}</h5><span>${size2}</span></div>' +
                    '<div class="progress-holder">${progressBar}</div>' +
                    '</div>' +
                    '</li>',

                // thumbnails for the preloaded files {String, Function}
                // example: '<li>${name}</li>'
                // example: function(item) { return '<li>' + item.name + '</li>'; }
                item2: '<li class="fileuploader-item">' +
                    '<div class="fileuploader-item-inner">' +
                    '<div class="type-holder">${extension}</div>' +
                    '<div class="actions-holder">' +
                    '<a href="${file}" class="fileuploader-action fileuploader-action-download" title="${captions.download}" download><i class="fileuploader-icon-download"></i></a>' +
                    '<div type="button" class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="fileuploader-icon-remove"></i></div>' +
                    '</div>' +
                    '<div class="thumbnail-holder">' +
                    '${image}' +
                    '<span class="fileuploader-action-popup"></span>' +
                    '</div>' +
                    '<div class="content-holder"><h5 title="${name}">${name}</h5><span>${size2}</span></div>' +
                    '<div class="progress-holder">${progressBar}</div>' +
                    '</div>' +
                    '</li>',

                // thumbnails selectors
                _selectors: {
                    list: '.fileuploader-items-list',
                    item: '.fileuploader-item',
                    start: '.fileuploader-action-start',
                    retry: '.fileuploader-action-retry',
                    remove: '.fileuploader-action-remove',
                    sorter: '.fileuploader-action-sort',
                    popup: '.fileuploader-popup-preview',
                    popup_open: '.fileuploader-action-popup'
                },

                // insert the thumbnail's item at the begining of the list? {Boolean}
                itemPrepend: false,

                // show a confirmation dialog by removing a file? {Boolean}
                // it will not be shown in upload mode by canceling an upload
                // you can call your own dialog box using dialogs option
                removeConfirmation: true,

                // render the image thumbnail? {Boolean}
                // if false, it will generate an icon(you can also hide it with css)
                // if false, you can use the API method item.renderThumbnail() to render it (check thumbnails example)
                startImageRenderer: true,

                // render the images synchron {Boolean}
                // used to improve the browser speed
                synchronImages: true,

                // read image using URL createObjectURL method {Boolean}
                // if false, it will use readAsDataURL
                useObjectUrl: false,

                // render the image in a canvas element {Boolean, Object}
                // if true, it will generate an image with the css sizes from the parent element of ${image}
                // you can also set the width and the height in the object {width: 96, height: 96}
                canvasImage: true,

                // render thumbnail for video files? {Boolean}
                videoThumbnail: false,

                // fix exif orientation {Boolean}
                exif: true,

                // Callback fired before adding the list element
                beforeShow: null,

                // Callback fired after adding the item element
                onItemShow: function(item) {
                    // add sorter button to the item html
                    item.html.find('.fileuploader-action-remove').before('<div class="fileuploader-action fileuploader-action-sort" title="Sort"><i class="fileuploader-icon-sort"></i></div>');
                },
                // Callback fired after removing the item element
                // by default we will animate the removing action
                onItemRemove: function(html) {
                    html.children().animate({'opacity': 0}, 200, function() {
                        setTimeout(function() {
                            html.slideUp(200, function() {
                                html.remove();
                            });
                        }, 100);
                    });
                },

                // Callback fired after the item image was loaded or a image file is invalid
                // default - null
                onImageLoaded: function(item, listEl, parentEl, newInputEl, inputEl) {
                    // invalid image?
                    if (item.image.hasClass('fileuploader-no-thumbnail')) {
                        // callback goes here
                    }

                    // check image size and ratio?
                    if (item.reader.node && item.reader.width > 1920 && item.reader.height > 1080 && item.reader.ratio != '16:9') {
                        // callback goes here
                    }
                },

                // item popup preview {Object}
                popup: {
                    // popup append to container {String, jQuery Object}
                    container: 'body',

                    // enable arrows {Boolean}
                    arrows: true,

                    // loop the arrows {Boolean}
                    loop: true,

                    // popup HTML {String, Function}
                    template: function(data) { return '<div class="fileuploader-popup-preview">' +
                        '<div class="fileuploader-popup-move" data-action="prev"><i class="fileuploader-icon-arrow-left"></i></div>' +
                        '<div class="fileuploader-popup-node ${format}">' +
                        '${reader.node}' +
                        '</div>' +
                        '<div class="fileuploader-popup-content">' +
                        '<div class="fileuploader-popup-footer">' +
                        '<ul class="fileuploader-popup-tools">' +
                        (data.format == 'image' && data.reader.node && data.editor ? (data.editor.cropper ? '<li>' +
                                '<div data-action="crop">' +
                                '<i class="fileuploader-icon-crop"></i> ${captions.crop}' +
                                '</div>' +
                                '</li>' : '') +
                                (data.editor.rotate ? '<li>' +
                                    '<div data-action="rotate-cw">' +
                                    '<i class="fileuploader-icon-rotate"></i> ${captions.rotate}' +
                                    '</div>' +
                                    '</li>' : '') : ''
                        ) +
                        (data.format == 'image' ?
                                '<li class="fileuploader-popup-zoomer">' +
                                '<div data-action="zoom-out">&minus;</div>' +
                                '<input type="range" min="0" max="100">' +
                                '<div data-action="zoom-in">&plus;</div>' +
                                '<span></span> ' +
                                '</li>' : ''
                        ) +
                        (data.data.url ? '<li>' +
                                '<a href="'+ data.file +'" data-action target="_blank">' +
                                '<i class="fileuploader-icon-external"></i> ${captions.open}' +
                                '</a>' +
                                '</li>' : ''
                        ) +
                        '<li>' +
                        '<div data-action="remove">' +
                        '<i class="fileuploader-icon-trash"></i> ${captions.remove}' +
                        '</div>' +
                        '</li>' +
                        '</ul>' +
                        '</div>' +
                        '<div class="fileuploader-popup-header">' +
                        '<ul class="fileuploader-popup-meta">' +
                        '<li>' +
                        '<span>${captions.name}:</span>' +
                        '<h5>${name}</h5>' +
                        '</li>' +
                        '<li>' +
                        '<span>${captions.type}:</span>' +
                        '<h5>${extension.toUpperCase()}</h5>' +
                        '</li>' +
                        '<li>' +
                        '<span>${captions.size}:</span>' +
                        '<h5>${size2}</h5>' +
                        '</li>' +
                        (data.reader && data.reader.width ? '<li>' +
                                '<span>${captions.dimensions}:</span>' +
                                '<h5>${reader.width}x${reader.height}px</h5>' +
                                '</li>' : ''
                        ) +
                        (data.reader && data.reader.duration ? '<li>' +
                                '<span>${captions.duration}:</span>' +
                                '<h5>${reader.duration2}</h5>' +
                                '</li>' : ''
                        ) +
                        '</ul>' +
                        '<div class="fileuploader-popup-info"></div>' +
                        '<ul class="fileuploader-popup-buttons">' +
                        '<li><div class="fileuploader-popup-button" data-action="cancel">${captions.cancel}</a></li>' +
                        (data.editor ? '<li><div class="fileuploader-popup-button button-success" data-action="save">${captions.confirm}</div></li>' : ''
                        ) +
                        '</ul>' +
                        '</div>' +
                        '</div>' +
                        '<div class="fileuploader-popup-move" data-action="next"><i class="fileuploader-icon-arrow-right"></i></div>' +
                        '</div>'; },

                    // Callback fired after creating the popup
                    // we will trigger by default buttons with custom actions
                    onShow: function(item) {
                        item.popup.html.on('click', '[data-action="remove"]', function(e) {
                            item.popup.close();
                            item.remove();
                        }).on('click', '[data-action="cancel"]', function(e) {
                            item.popup.close();
                        }).on('click', '[data-action="save"]', function(e) {
                            if (item.editor)
                                item.editor.save();
                            if (item.popup.close)
                                item.popup.close();
                        });
                    },

                    // Callback fired after closing the popup
                    onHide: null
                }
            },

            sorter: {
                selectorExclude: null,
                placeholder: null,
                scrollContainer: window,
                onSort: function(list, listEl, parentEl, newInputEl, inputEl) {
                    // onSort callback
                }
            }
        });

    });
</script>
</body>


<!-- Turn all file input elements into ponds -->

</html>
