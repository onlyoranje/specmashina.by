@php
$user = Auth::user();
@endphp
    <!-- Start Dashboard Sidebar -->
    <div class="dashboard-sidebar">
        <div class="user-image">
            @if ($user->avatar)
                <img src="{{Storage::url($user->resizeImage($user->avatar,150, 150))}}" alt="#">
            @else
                {!! Avatar::create($user->realname)->toSvg() !!}
            @endif
            <h3>{{$user->realname}}

                <span><a href="javascript:void(0)">ID: {{$user->id}}</a></span>
            </h3>
        </div>
        <div class="dashboard-menu">
            <ul>
                <li><a class="{{ Request::routeIs(['dashboard']) ? 'active' : null }}" href="{{route('dashboard')}}"><i class="lni lni-dashboard"></i> Дашборд</a></li>
                <li><a class="{{ Request::routeIs(['messages']) ? 'active' : null }}" href="{{route('messages')}}"><i class="lni lni-dashboard"></i> Сообщения</a></li>
                <li><a class="{{ Request::routeIs(['mybb','bb_edit']) ? 'active' : null }}" href="{{route('mybb')}}"><i class="lni lni-dashboard"></i> Мои объявления</a></li>
                <li><a class="{{ Request::routeIs('addForm') ? 'active' : null }}" href="{{route('addForm')}}"><i class="lni lni-dashboard"></i> Добавить объявление</a></li>
                <li><a class="{{ Request::routeIs('profile.edit') ? 'active' : null }}" href="{{route('profile.update')}}"><i class="lni lni-pencil-alt"></i>Мой профиль</a></li>
                <li><a class="{{ Request::routeIs('my_organization') ? 'active' : null }}" href="{{route('my_organization')}}"><i class="lni lni-pencil-alt"></i>
                        Моя организация</a></li>
                @if(Auth::user()->isAdmin())
                <li><a class="{{ Request::routeIs('admin_dashboard') ? 'active' : null }}"  href="{{route('admin_dashboard')}}"><i class="lni lni-bolt-alt"></i> Админ-дашборд</a></li>
                <li><a class="{{ Request::routeIs('location_dashboard') ? 'active' : null }}"  href="{{route('location_dashboard')}}"><i class="lni lni-bolt-alt"></i> Список городов</a></li>
                <li><a class="{{ Request::routeIs('rubric_dashboard') ? 'active' : null }}"  href="{{route('rubric_dashboard')}}"><i class="lni lni-heart"></i> Список категорий</a></li>
                <li><a class="{{ Request::routeIs('parameter_dashboard') ? 'active' : null }}"  href="{{route('parameter_dashboard')}}"><i class="lni lni-circle-plus"></i> Параметры</a></li>
                <li><a class="{{ Request::routeIs('parameter_type_dashboard') ? 'active' : null }}"  href="{{route('parameter_type_dashboard')}}"><i class="lni lni-bookmark"></i> Типы параметров</a></li>
                <li><a class="{{ Request::routeIs('vendor_dashboard') ? 'active' : null }}"  href="{{route('vendor_dashboard')}}"><i class="lni lni-envelope"></i> Список производителей</a></li>
                <li><a class="{{ Request::routeIs('price_type_dashboard') ? 'active' : null }}"  href="{{route('price_type_dashboard')}}"><i class="lni lni-trash"></i> Виды цен</a></li>
                <li><a class="{{ Request::routeIs('contact_type_dashboard') ? 'active' : null }}"  href="{{route('contact_type_dashboard')}}"><i class="lni lni-printer"></i> Типы контатков</a></li>
                <li><a class="{{ Request::routeIs('status_dashboard') ? 'active' : null }}"  href="{{route('status_dashboard')}}"><i class="lni lni-printer"></i> Статусы объявлений</a></li>
                @endif
            </ul>
            <div class="button">
                <a class="btn" href="{{route('logout')}}">Выход</a>
            </div>
        </div>
    </div>
    <!-- Start Dashboard Sidebar -->


