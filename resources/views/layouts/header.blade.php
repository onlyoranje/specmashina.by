<header class="header navbar-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="nav-inner">

                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="/">
                            <img src="/storage/images/logo/logo.svg" alt="Logo">
                        </a>
                        <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ms-auto">
                                <li class="nav-item">
                                    <a href="/" aria-label="Toggle navigation">Главная </a>
                                </li>
                                <li class="nav-item">
                                    <a class=" dd-menu collapsed" href="javascript:void(0)"
                                       data-bs-toggle="collapse" data-bs-target="#submenu-1-4"
                                       aria-controls="navbarSupportedContent" aria-expanded="false"
                                       aria-label="Toggle navigation">Объявления</a>
                                    <ul class="sub-menu mega-menu collapse" id="submenu-1-4">
                                        @php
                                            $result = App\Models\Rubric::orderBy('sort')->get()->toFlatTree();
/*echo "<pre>";print_r($result);
echo "</pre>";*/

                                        @endphp
                                        <li class="single-block"><ul>
                                        <?
                                        $traverse = function ($result, $prefix = '-') use (&$traverse) {
                                            foreach ($result as $menu_item) {

                                                if ($menu_item->level==0) echo '<li class="mega-menu-title">'.$menu_item->title.'</li>';
                                                if ($menu_item->level==1) echo '<li class="nav-item"><a href="about-us.html">'.$menu_item->title.'</a></li>';

                                                $traverse($menu_item->children, $prefix.'-');
                                            }
                                        };

                                        $traverse($result);
                                        ?>


                                            </ul>
                                        </li>


                                       {{-- <li class="single-block">
                                            <ul>
                                                <li class="mega-menu-title">Dashboard</li>
                                                <li class="nav-item"><a href="javascript:void(0)">Account Overview</a>
                                                </li>
                                                <li class="nav-item"><a href="javascript:void(0)">My Profile</a>
                                                </li>
                                                <li class="nav-item"><a href="javascript:void(0)">My Ads</a></li>
                                                <li class="nav-item"><a href="javascript:void(0)">Favorite Ads</a>
                                                </li>
                                                <li class="nav-item"><a href="javascript:void(0)">Ad post</a></li>
                                                <li class="nav-item"><a href="javascript:void(0)">Bookmarked Ad</a>
                                                </li>
                                                <li class="nav-item"><a href="javascript:void(0)">Messages</a></li>
                                                <li class="nav-item"><a href="javascript:void(0)">Close account</a>
                                                </li>
                                                <li class="nav-item"><a href="javascript:void(0)">Invoice</a></li>
                                            </ul>

                                        </li>--}}

                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:void(0)" aria-label="Toggle navigation">Categories</a>
                                </li>
                                <li class="nav-item">
                                    <a class=" dd-menu collapsed" href="javascript:void(0)"
                                       data-bs-toggle="collapse" data-bs-target="#submenu-1-3"
                                       aria-controls="navbarSupportedContent" aria-expanded="false"
                                       aria-label="Toggle navigation">Listings</a>
                                    <ul class="sub-menu collapse" id="submenu-1-3">
                                        <li class="nav-item"><a href="javascript:void(0)">Ad Grid</a></li>
                                        <li class="nav-item"><a href="javascript:void(0)">Ad Listing</a></li>
                                        <li class="nav-item"><a href="javascript:void(0)">Ad Details</a></li>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a class=" dd-menu collapsed" href="javascript:void(0)"
                                       data-bs-toggle="collapse" data-bs-target="#submenu-1-5"
                                       aria-controls="navbarSupportedContent" aria-expanded="false"
                                       aria-label="Toggle navigation">Blog</a>
                                    <ul class="sub-menu collapse" id="submenu-1-5">
                                        <li class="nav-item"><a href="javascript:void(0)">Blog Grid Sidebar</a>
                                        </li>
                                        <li class="nav-item"><a href="javascript:void(0)">Blog Single</a></li>
                                        <li class="nav-item"><a href="javascript:void(0)">Blog Single
                                                Sibebar</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div> <!-- navbar collapse -->
                        <div class="login-button">
                            <ul>

                                @if(Auth::user())
                                <li>
                                    <a href="{{route('dashboard')}}"><i class="lni lni-enter"></i> Личный кабинет</a>
                                </li>
                                @else
                                <li>
                                    <a href="{{route('dashboard')}}"><i class="lni lni-enter"></i> Вход</a>
                                </li>
                                <li>
                                    <a href="{{route('dashboard')}}"><i class="lni lni-user"></i> Регистрация</a>
                                </li>
                                @endif
                            </ul>
                        </div>
                        <div class="button header-button">
                            @if(Auth::user())
                            <a href="{{route('addForm')}}" class="btn">Добавить объявления</a>
                                @else
                                <a href="{{route('dashboard')}}" class="btn">Добавить объявление</a>
                            @endif
                        </div>
                    </nav>
                    <!-- navbar -->
                </div>
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</header>

@extends('breadcrumbs')

