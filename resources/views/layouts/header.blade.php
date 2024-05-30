<header class="header navbar-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="nav-inner">

                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="/">
                            <img src="{{asset("images/logo/logo.svg")}}" alt="Logo">
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
                            <a class=" dd-menu collapsed"
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
                                                <li class="nav-item"><a href="{{route('rubric',$menu_item->id)}}">{{$menu_item->title}}</a></li>


                                        @if ($key==$count_column)
                                            </ul></li><li class="single-block"><ul>
                                            @endif
                                        @endforeach
                                    </ul></li>




                                    </ul>
                                </li>
                                @endforeach

                                <li class="nav-item">
                                    <a href="{{route('organizations')}}" aria-label="Toggle navigation">Организации</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('locations')}}" aria-label="Toggle navigation">Города</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('posts')}}" aria-label="Toggle navigation">Новости</a>
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
                                @if(Auth::user()->organization)
                            <a href="{{route('addForm')}}" class="btn">Добавить объявления</a>
                                @else
                                    <a href="{{route('my_organization')}}" class="btn">Добавить объявления</a>
                                @endif
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

