<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('main'); ?>
    <section class="dashboard section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-12">
                    <!-- Start Dashboard Sidebar -->
                <?php echo $__env->make('layouts.dashboard_profile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <!-- Start Dashboard Sidebar -->
                </div>
                <div class="col-lg-9 col-md-12 col-12">
                    <div class="main-content">

                        <!-- Start Activity Log -->
                        <div class="dashboard-block mt-0">
                            <div class="block-head">
                                <h3 class="block-title">Баннеры</h3>
                                <div class="block-actions">
                                    <a href="<?php echo e(route('banner_add')); ?>" class="btn">+ Добавить баннер</a>
                                </div>
                            </div>
                            <ul class="adm-list">
                                <?php $__empty_1 = true; $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <li>
                                        <img src="<?php echo e(Storage::url($banner->image)); ?>" alt="<?php echo e($banner->title); ?>" class="adm-thumb">
                                        <a href="<?php echo e(route('banner_dashboard', ['banner' => $banner->id])); ?>" class="title"><?php echo e($banner->title); ?></a>
                                        <span class="adm-stats">
                                            Показов: <b><?php echo e($banner->views); ?></b><br>
                                            Кликов: <b><?php echo e($banner->clicks); ?></b>
                                            <?php if($banner->views > 0): ?>
                                                <br>CTR: <b><?php echo e(round($banner->clicks / $banner->views * 100, 2)); ?>%</b>
                                            <?php endif; ?>
                                        </span>
                                        <span class="time"><a href="<?php echo e(route('banner_dashboard', ['banner' => $banner->id])); ?>">Редактировать</a></span>
                                        <span class="time"><a href="<?php echo e(route('delete_banner', ['banner' => $banner->id])); ?>" class="text-danger">Удалить</a></span>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <li class="adm-empty">Пока нет ни одного баннера</li>
                                <?php endif; ?>
                            </ul>

                            
                            <?php if($banners->hasPages()): ?>
                                <div class="adm-list-pages">
                                    <?php echo e($banners->links('pagination::norwegian')); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                        <!-- End Activity Log -->

                    </div>

                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /workspaces/php-mariadb/specmashina.by/resources/views/banner/dashboard.blade.php ENDPATH**/ ?>