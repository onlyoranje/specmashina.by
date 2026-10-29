<?php if(Request::routeIs('home')==false): ?>
<?php if(!empty($isAdminArea)): ?>
    
    <?php
        $currentCrumb = trim($__env->yieldContent('title'));
        // Легаси-страницы кабинета могли не задавать заголовок или оставлять
        // дефолтное «Главная» (layouts/dashboard) — последняя крошка всё равно
        // должна быть осмысленной, а не дублировать корень.
        if ($currentCrumb === '' || $currentCrumb === 'Главная') {
            $currentCrumb = 'Личный кабинет';
        }
    ?>
    <div class="container admin-breadcrumbs">
        <nav class="catalog-breadcrumbs" aria-label="Хлебные крошки">
            <a href="<?php echo e(url('/')); ?>" class="breadcrumb-link">Главная</a>
            <?php if($currentCrumb !== 'Личный кабинет'): ?>
                <span class="breadcrumb-sep" aria-hidden="true">/</span>
                <a href="<?php echo e(route('dashboard')); ?>" class="breadcrumb-link">Личный кабинет</a>
            <?php endif; ?>
            <span class="breadcrumb-sep" aria-hidden="true">/</span>
            <span class="breadcrumb-current"><?php echo e($currentCrumb); ?></span>
        </nav>
    </div>
<?php else: ?>
<div class="breadcrumbs">
    <div class="container">
        <div class="row align-items-center">
            
            <div class="col-12">
                <ul class="breadcrumb-nav">
                    <li>
                        <a href="/">Главная</a>
                    </li>
                <?php if(isset($breadcrumbs)): ?>
                        <?php $__currentLoopData = $breadcrumbs['list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(is_object($breadcrumb)): ?>
                    <li>
                         <a href="<?php echo e(route($breadcrumbs['route'],$breadcrumb->id)); ?>"><?php echo e($breadcrumb->title); ?></a>
                    </li>
                            <?php elseif(is_array($breadcrumb)): ?>
                    <li>
                         <a href="<?php echo e(route($breadcrumb['route'])); ?><?php echo e((!empty($breadcrumb['param']))? $breadcrumb["param"]:""); ?>"><?php echo e($breadcrumb['title']); ?></a>
                    </li>
                         <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php endif; ?>
                    <li><?php echo $__env->yieldContent('title'); ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php endif; ?>
<?php /**PATH /workspaces/php-mariadb/specmashina.by/resources/views/breadcrumbs.blade.php ENDPATH**/ ?>