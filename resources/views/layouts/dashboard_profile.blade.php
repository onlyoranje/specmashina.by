@php
$user = Auth::user();
@endphp
    <!-- Start Dashboard Sidebar -->
    <div class="dashboard-sidebar">
        <div class="user-image">
            @if (isset($user->avatar))
                <img src="{{Storage::url($user->resizeImage($user->avatar,150, 150))}}" alt="#">
            @else
                {!! Avatar::create($user->realname)->toSvg() !!}
            @endif
            <h3>{{$user->realname}}

                <span><a href="javascript:void(0)">Кредиты: {{ $user->credit->credits ?? ''}}</a></span>
            </h3>
        </div>
        <div class="dashboard-menu">
            <ul>
                <li><a class="{{ Request::routeIs(['dashboard']) ? 'active' : null }}" href="{{route('dashboard')}}"><i class="fa-solid fa-gauge"></i> Дашборд</a></li>

                <li><a class="{{ Request::routeIs(['mybb','bb_edit']) ? 'active' : null }}" href="{{route('mybb')}}"><i class="fa-solid fa-clone"></i> Мои объявления</a></li>
                <li><a class="{{ Request::routeIs('addForm') ? 'active' : null }}" href="{{route('addForm')}}"><i class="fa-solid fa-plus"></i> Добавить объявление</a></li>
                <li><a class="{{ Request::routeIs('profile.edit') ? 'active' : null }}" href="{{route('profile.update')}}"><i class="fa-solid fa-user"></i>Мой профиль</a></li>
                <li><a class="{{ Request::routeIs(['alerts']) ? 'active' : null }}" href="{{route('alerts')}}"><i class="fa-solid fa-bell"></i> Уведомления</a></li>
                <li><a class="{{ Request::routeIs('credit.dashboard') ? 'active' : null }}" href="{{route('credit.dashboard')}}"><i class="fa-solid fa-user"></i>Кредиты</a></li>
                <li><a class="{{ Request::routeIs('my_organization') ? 'active' : null }}" href="{{route('my_organization')}}"><i class="fa-solid fa-building"></i>Моя организация</a></li>
                <li><a class="{{ Request::routeIs('favorite') ? 'active' : null }}" href="{{route('favorite')}}"><i class='fa-solid fa-bookmark'></i>Закладки</a></li>


            </ul>

        </div>
        <div class="dashboard-menu">
            <ul>


                @if(Auth::user()->isAdmin())
                    <li><a class="{{ Request::routeIs('admin_dashboard') ? 'active' : null }}"  href="{{route('admin_dashboard')}}"><i class="fa-solid fa-gauge"></i> Админ-дашборд</a></li>
                    <li><a class="{{ Request::routeIs(['allbb']) ? 'active' : null }}" href="{{route('allbb')}}"><i class="fa-solid fa-clone"></i> Все объявления</a></li>
                    <li><a class="{{ Request::routeIs(['allusers']) ? 'active' : null }}" href="{{route('allusers')}}"><i class="fa-solid fa-clone"></i> Пользователи</a></li>
                    <li><a class="{{ Request::routeIs(['allorganizations']) ? 'active' : null }}" href="{{route('allorganizations')}}"><i class="fa-solid fa-clone"></i> Организации</a></li>
                    <li><a class="{{ Request::routeIs('location_dashboard') ? 'active' : null }}"  href="{{route('location_dashboard')}}"><i class="fa-solid fa-mountain-city"></i> Список городов</a></li>
                    <li><a class="{{ Request::routeIs('rubric_dashboard') ? 'active' : null }}"  href="{{route('rubric_dashboard')}}"><i class="fa-solid fa-folder-tree"></i> Список категорий</a></li>
                    <li><a class="{{ Request::routeIs('parameter_dashboard') ? 'active' : null }}"  href="{{route('parameter_dashboard')}}"><i class="fa-solid fa-list"></i> Параметры</a></li>
                    <li><a class="{{ Request::routeIs('parameter_type_dashboard') ? 'active' : null }}"  href="{{route('parameter_type_dashboard')}}"><i class="fa-solid fa-list"></i> Типы параметров</a></li>
                    <li><a class="{{ Request::routeIs('vendor_dashboard') ? 'active' : null }}"  href="{{route('vendor_dashboard')}}"><i class="fa-solid fa-copyright"></i> Список производителей</a></li>
                    <li><a class="{{ Request::routeIs('price_type_dashboard') ? 'active' : null }}"  href="{{route('price_type_dashboard')}}"><i class="fa-solid fa-tag"></i> Виды цен</a></li>
                    <li><a class="{{ Request::routeIs('contact_type_dashboard') ? 'active' : null }}"  href="{{route('contact_type_dashboard')}}"><i class="fa-solid fa-id-badge"></i> Типы контактов</a></li>
                    <li><a class="{{ Request::routeIs('status_dashboard') ? 'active' : null }}"  href="{{route('status_dashboard')}}"><i class="fa-regular fa-star"></i> Статусы объявлений</a></li>
                    <li><a class="{{ Request::routeIs('posts_dashboard') ? 'active' : null }}"  href="{{route('posts_dashboard')}}"><i class="fa-solid fa-newspaper"></i> Новости</a></li>
                    <li><a class="{{ Request::routeIs('pages_dashboard') ? 'active' : null }}"  href="{{route('pages_dashboard')}}"><i class="fa-solid fa-newspaper"></i> Статические страницы</a></li>
                    <li><a class="{{ Request::routeIs('banners_dashboard') ? 'active' : null }}"  href="{{route('banners_dashboard')}}"><i class="fa-solid fa-newspaper"></i> Баннеры</a></li>
                @endif
            </ul>
            <div class="button">
                <a class="btn" href="{{route('logout')}}">Выход</a>
            </div>
        </div>
    </div>
    <!-- Start Dashboard Sidebar -->


