<header class="header navbar-area">
    <div class="container">
        <div class="row align-items-center">
         {{--   <div class="col-12"style="width:100%; background-color: yellow; color:black; text-align: center; font-weight: 400">Портал работает в режиме тестирования. Некоторые функции могут быть не доступны.</div>--}}
            <div class="col-lg-12">
                <div class="nav-inner">

                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="/">
                            <img src="{{asset("images/logo/logo.svg")}}" alt="Logo" class="logo-header">
                        </a>
                        <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav {{--ms-auto--}}">
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
                                {{-- <li class="nav-item" id="menu_location">
 @php
                                     if (isset($_COOKIE['mylocation'])) $mylocation = App\Models\Location::find($_COOKIE['mylocation']);
                                     $all_location =  App\Models\Location::where('level',1)->orderBy('title')->get();;
  @endphp
                                     <a class=" dd-menu collapsed header-location-link"
                                        data-bs-toggle="collapse" data-bs-target="#submenu-location"
                                        aria-controls="navbarSupportedContent" aria-expanded="false"
                                        aria-label="Toggle navigation"><i class="lni lni-map-marker"></i><span id="my_location">{{isset($mylocation)?$mylocation->title:"Беларусь"}}</span></a>
                                     <ul class="sub-menu mega-menu collapse" id="submenu-location">
                                         <div class=" default-form-style">
                                         <div class="form-group">
                                             <label>Category*</label>
                                             <div class="selector-head">
                                                 <span class="arrow"><i class="lni lni-chevron-down"></i></span>
                                                 <select class="user-chosen-select" id="location_selector" onchange="setLocation(this)">
                                                     <option value="none">Выбрать регион</option>
                                                     <option value="all">Беларусь</option>
                                                     @foreach ($all_location as $location)

                                                     <option data-name="{{$location->title}}" value="{{$location->id}}">{{$location->title}}</option>

                                                     @endforeach
                                                 </select>
                                             </div>
                                             </div>
                         </div>
                                         <div class=" default-form-style">
                                             <div class="form-group">
                                                 <label>Category*</label>
                                             <div class="selector-head">
                                                 <span class="arrow"><i class="lni lni-chevron-down"></i></span>
                                                 <select class="user-chosen-select">
                                                     <option value="none">Select a Category</option>
                                                     @foreach ($all_location as $location)
                                                         @if ($location->parent_id)
                                                             <option value="none" class="region{{$location->parent_id}}" style="display: none">{{$location->title}}</option>
                                                         @endif
                                                     @endforeach
                                                 </select>
                                             </div>
                                         </div>
                                         </div>--}}


                                            {{--   @php
                                                if ($_COOKIE['mylocation'])
                                                    $regions = App\Models\Location::where('parent_id',$_COOKIE['mylocation'])->orderBy('sort')->get();
                                                else
                                                    $regions = App\Models\Location::whereNull('parent_id')->orderBy('sort')->get();
                                                $count_column = ceil(count($regions)/2)-1;
                                               @endphp
                                                @foreach ($regions as $key=>$location)
                                                    @if ($key==0)
                                                        <li class="single-block"><ul>
                                                                @endif
                                                <li class="nav-item"><a onclick="setLocation({{$location->id}})">{{$location->title}}</a></li>
                                                                @if ($key==$count_column)
                                                            </ul></li><li class="single-block"><ul>
                                                        @endif
                                                        @endforeach
                                            </ul>

                                    </ul>
                                </li>--}}
                                @mobile
                                @if(Auth::user())
                                    <li class="nav-item">
                                        <a href="{{route('dashboard')}}" aria-label="Toggle navigation">Личный кабинет</a>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a href="{{route('dashboard')}}" aria-label="Toggle navigation">Вход</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('register')}}" aria-label="Toggle navigation">Регистрация</a>
                                    </li>
                                @endif
                                @endmobile
                            </ul>
                        </div> <!-- navbar collapse -->
                        <div class="login-button">
                            <ul>

                                @if(Auth::user())
                                <li>
                                    <a href="{{route('dashboard')}}"><i class="lni lni-enter"></i> {{Auth::user()->name}}</a>
                                </li>
                                @if (Auth::user()->countAlerts()>0)
                                    <li>
                                        <a href="{{route('alerts')}}"> <span class="badge rounded-pill bg-danger"><i class="fa-solid fa-bell text-white text-small" style="font-size: 0.95em;"></i>{{Auth::user()->countAlerts()}}</span></a>
                                    </li>
                                    @endif
                                @else
                                <li>
                                    <a href="{{route('dashboard')}}"><i class="lni lni-enter"></i> Вход</a>
                                </li>
                                <li>
                                    <a href="{{route('register')}}"><i class="lni lni-user"></i> Регистрация</a>
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

