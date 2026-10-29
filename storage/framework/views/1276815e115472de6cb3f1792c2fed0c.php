<?php
$user = Auth::user();
?>
<!-- Start Dashboard Sidebar -->
<div class="dashboard-sidebar">
    <div class="user-image">
        <?php if(isset($user->avatar)): ?>
            <img src="<?php echo e(Storage::url($user->resizeImage($user->avatar,150, 150))); ?>" alt="#">
        <?php else: ?>
            <?php echo Avatar::create($user->realname)->toSvg(); ?>

        <?php endif; ?>
        <h3><?php echo e($user->realname); ?></h3>
    </div>
    <div class="dashboard-menu">
        <ul>
            <li><a class="<?php echo e(Request::routeIs(['dashboard']) ? 'active' : null); ?>" href="<?php echo e(route('dashboard')); ?>"><i class="fa-solid fa-gauge"></i> Дашборд</a></li>

            <li><a class="<?php echo e(Request::routeIs(['mybb','bb_edit']) ? 'active' : null); ?>" href="<?php echo e(route('mybb')); ?>"><i class="fa-solid fa-clone"></i> Мои объявления</a></li>
            <li><a class="<?php echo e(Request::routeIs('addForm') ? 'active' : null); ?>" href="<?php echo e(route('addForm')); ?>"><i class="fa-solid fa-plus"></i> Добавить объявление</a></li>
            <li><a class="<?php echo e(Request::routeIs('profile.edit') ? 'active' : null); ?>" href="<?php echo e(route('profile.update')); ?>"><i class="fa-solid fa-user"></i> Мой профиль</a></li>
            <li><a class="<?php echo e(Request::routeIs(['alerts']) ? 'active' : null); ?>" href="<?php echo e(route('alerts')); ?>"><i class="fa-solid fa-bell"></i> Уведомления</a></li>
            <li><a class="<?php echo e(Request::routeIs('my_organization') ? 'active' : null); ?>" href="<?php echo e(route('my_organization')); ?>"><i class="fa-solid fa-building"></i> Моя организация</a></li>
            <li><a class="<?php echo e(Request::routeIs('favorite') ? 'active' : null); ?>" href="<?php echo e(route('favorite')); ?>"><i class='fa-solid fa-bookmark'></i> Закладки</a></li>


        </ul>

    </div>
    <div class="dashboard-menu">
        <ul>
            <li class="dashboard-menu-label">Администрирование</li>


            <?php if(Auth::user()->isAdmin()): ?>
                <li><a class="<?php echo e(Request::routeIs('admin_dashboard') ? 'active' : null); ?>"  href="<?php echo e(route('admin_dashboard')); ?>"><i class="fa-solid fa-gauge"></i> Админ-дашборд</a></li>
                <li><a class="<?php echo e(Request::routeIs(['allbb']) ? 'active' : null); ?>" href="<?php echo e(route('allbb')); ?>"><i class="fa-solid fa-clone"></i> Все объявления</a></li>
                <li><a class="<?php echo e(Request::routeIs(['allusers']) ? 'active' : null); ?>" href="<?php echo e(route('allusers')); ?>"><i class="fa-solid fa-users"></i> Пользователи</a></li>
                <li><a class="<?php echo e(Request::routeIs(['allorganizations']) ? 'active' : null); ?>" href="<?php echo e(route('allorganizations')); ?>"><i class="fa-solid fa-building"></i> Организации</a></li>
                <li><a class="<?php echo e(Request::routeIs('location_dashboard') ? 'active' : null); ?>"  href="<?php echo e(route('location_dashboard')); ?>"><i class="fa-solid fa-mountain-city"></i> Список городов</a></li>
                <li><a class="<?php echo e(Request::routeIs('rubric_dashboard') ? 'active' : null); ?>"  href="<?php echo e(route('rubric_dashboard')); ?>"><i class="fa-solid fa-folder-tree"></i> Список категорий</a></li>
                <li><a class="<?php echo e(Request::routeIs('parameter_dashboard') ? 'active' : null); ?>"  href="<?php echo e(route('parameter_dashboard')); ?>"><i class="fa-solid fa-list"></i> Параметры</a></li>
                <li><a class="<?php echo e(Request::routeIs('parameter_type_dashboard') ? 'active' : null); ?>"  href="<?php echo e(route('parameter_type_dashboard')); ?>"><i class="fa-solid fa-list-check"></i> Типы параметров</a></li>
                <li><a class="<?php echo e(Request::routeIs('vendor_dashboard') ? 'active' : null); ?>"  href="<?php echo e(route('vendor_dashboard')); ?>"><i class="fa-solid fa-copyright"></i> Список производителей</a></li>
                <li><a class="<?php echo e(Request::routeIs('price_type_dashboard') ? 'active' : null); ?>"  href="<?php echo e(route('price_type_dashboard')); ?>"><i class="fa-solid fa-tag"></i> Виды цен</a></li>
                <li><a class="<?php echo e(Request::routeIs('contact_type_dashboard') ? 'active' : null); ?>"  href="<?php echo e(route('contact_type_dashboard')); ?>"><i class="fa-solid fa-id-badge"></i> Типы контактов</a></li>
                <li><a class="<?php echo e(Request::routeIs('status_dashboard') ? 'active' : null); ?>"  href="<?php echo e(route('status_dashboard')); ?>"><i class="fa-regular fa-star"></i> Статусы объявлений</a></li>
                <li><a class="<?php echo e(Request::routeIs('posts_dashboard') ? 'active' : null); ?>"  href="<?php echo e(route('posts_dashboard')); ?>"><i class="fa-solid fa-newspaper"></i> Новости</a></li>
                <li><a class="<?php echo e(Request::routeIs('pages_dashboard') ? 'active' : null); ?>"  href="<?php echo e(route('pages_dashboard')); ?>"><i class="fa-solid fa-file-lines"></i> Статические страницы</a></li>
                <li><a class="<?php echo e(Request::routeIs('banners_dashboard') ? 'active' : null); ?>"  href="<?php echo e(route('banners_dashboard')); ?>"><i class="fa-solid fa-rectangle-ad"></i> Баннеры</a></li>
                <li><a class="<?php echo e(Request::routeIs('settings.mail') ? 'active' : null); ?>" href="<?php echo e(route('settings.mail')); ?>"><i class="fa-solid fa-envelope"></i> Настройки почты</a></li>
                <li><a class="<?php echo e(Request::routeIs('settings.site') ? 'active' : null); ?>" href="<?php echo e(route('settings.site')); ?>"><i class="fa-solid fa-sliders"></i> Настройка сайта</a></li>
                <li><a class="<?php echo e(Request::routeIs('settings.seo') ? 'active' : null); ?>" href="<?php echo e(route('settings.seo')); ?>"><i class="fa-solid fa-search"></i> Настройка SEO</a></li>
            <?php endif; ?>
        </ul>
        <div class="button">
            <a class="btn" href="<?php echo e(route('logout')); ?>">Выход</a>
        </div>
    </div>
</div>
<!-- Start Dashboard Sidebar -->


<?php /**PATH /workspaces/php-mariadb/specmashina.by/resources/views/layouts/dashboard_profile.blade.php ENDPATH**/ ?>