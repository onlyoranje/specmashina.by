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
                                @php
                                    $root_categories= App\Models\Rubric::where('level',0)->orderBy('sort')->get();
                                @endphp
                                @foreach ($root_categories as $root_category)
                        <li class="nav-item">
                            <a class=" dd-menu collapsed" href="javascript:void(0)"
                               data-bs-toggle="collapse" data-bs-target="#submenu-1-4"
                               aria-controls="navbarSupportedContent" aria-expanded="false"
                               aria-label="Toggle navigation">{{$root_category->title}}</a>
                            <ul class="sub-menu mega-menu collapse" id="submenu-1-4">
                                @php
                                    $result = App\Models\Rubric::where('parent_id',$root_category->id)->orderBy('sort')->get();

                                $count_column = ceil(count($result)/2)-1;
                                        @endphp
                                        @foreach ($result as $key=>$menu_item)
                                        @if ($key==0)
                                        <li class="single-block"><ul>
                                        @endif
                                                <li class="nav-item"><a href="{{$key}}">{{$menu_item->title}}</a></li>


                                        @if ($key==$count_column)
                                            </ul></li><li class="single-block"><ul>
                                            @endif
                                        @endforeach
                                    </ul></li>




                                    </ul>
                                </li>
                                @endforeach

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

