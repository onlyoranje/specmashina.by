
    <!-- Start Dashboard Sidebar -->
    <div class="dashboard-sidebar">
        <div class="user-image">
            <img src="assets/images/dashboard/user-image.jpg" alt="#">
            <h3>Steve Aldridge
                <span><a href="javascript:void(0)">@username</a></span>
            </h3>
        </div>
        <div class="dashboard-menu">
            <ul>
                <li><a href="{{route('mybb')}}"><i class="lni lni-dashboard"></i> Мои объявления</a></li>
                <li><a class="active" href="{{route('my_organization')}}"><i class="lni lni-pencil-alt"></i>
                        Моя организация</a></li>
                @if(Auth::user()->isAdmin())
                <li><a href="{{route('location_dashboard')}}"><i class="lni lni-bolt-alt"></i> Список городов</a></li>
                <li><a href="{{route('rubric_dashboard')}}"><i class="lni lni-heart"></i> Список категорий</a></li>
                <li><a href="{{route('parameter_dashboard')}}"><i class="lni lni-circle-plus"></i> Параметры</a></li>
                <li><a href="{{route('parameter_type_dashboard')}}"><i class="lni lni-bookmark"></i> Типы параметров</a></li>
                <li><a href="{{route('vendor_dashboard')}}"><i class="lni lni-envelope"></i> Список производителей</a></li>
                <li><a href="{{route('price_type_dashboard')}}"><i class="lni lni-trash"></i> Виды цен</a></li>
                <li><a href="{{route('contact_type_dashboard')}}"><i class="lni lni-printer"></i> Типы контатков</a></li>
                <li><a href="{{route('status_dashboard')}}"><i class="lni lni-printer"></i> Статусы объявлений</a></li>
                @endif
            </ul>
            <div class="button">
                <a class="btn" href="javascript:void(0)">Logout</a>
            </div>
        </div>
    </div>
    <!-- Start Dashboard Sidebar -->


