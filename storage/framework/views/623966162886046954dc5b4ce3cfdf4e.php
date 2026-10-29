<?php $__env->startSection('title', 'Личный кабинет'); ?>

<?php $__env->startSection('main'); ?>

    <section class="dashboard section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12">

                <?php echo $__env->make('layouts.dashboard_profile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                </div>
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="main-content">
                        <!-- Start Details Lists -->
                        <div class="details-lists">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-12">
                                    <!-- Start Single List -->
                                    <div class="single-list">
                                        <div class="list-icon">
                                            <i class="lni lni-checkmark-circle"></i>
                                        </div>
                                        <h3>
                                            <?php echo e(count($bbs)); ?>

                                            <span>Всего объявлений</span>
                                        </h3>
                                    </div>
                                    <!-- End Single List -->
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <!-- Start Single List -->
                                    <div class="single-list two">
                                        <div class="list-icon">
                                            <i class="lni lni-bolt"></i>
                                        </div>
                                        <h3>
                                            <?php echo e(count($bbs_active)); ?>

                                            <span>Опубликовано </span>
                                        </h3>
                                    </div>
                                    <!-- End Single List -->
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <!-- Start Single List -->
                                    <div class="single-list three">
                                        <div class="list-icon">
                                            <i class="lni lni-emoji-sad"></i>
                                        </div>
                                        <h3>
                                            <?php echo e(count($bbs_moderation)); ?>

                                            <span>На модерации </span>
                                        </h3>
                                    </div>
                                    <!-- End Single List -->
                                </div>
                            </div>
                        </div>
                        <!-- End Details Lists -->
                        <div class="row">

                            <div class="col-lg-6 col-md-12 col-12">
                                <div class="activity-log dashboard-block">
                                    <div class="block-head">
                                        <h3 class="block-title">Новые уведомления</h3>
                                        <div class="block-actions">
                                            <a class="btn alt-btn" href="<?php echo e(route('alerts')); ?>">Все уведомления</a>
                                        </div>
                                    </div>

                                    <ul class="adm-list">
                                        <?php if(isset($notifications) and count($notifications)>0): ?>
                                            <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <div class="log-icon" id="alert<?php echo e($notification->id); ?>">

                                                <i class="<?php echo e(($notification->read_at)?'fa-regular':'fa-solid'); ?> fa-bell"></i>
                                            </div>
                                            <a href="javascript:void(0)" id="alerttext<?php echo e($notification->id); ?>" class="title"><?php echo e($notification->title); ?></a>

                                            <span class="time "><?php echo e(\Carbon\Carbon::parse($notification->created_at)->format('H:i:s d.m.Y')); ?></span>
                                            <span class="remove"><a  data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo e($notification->id); ?>"><i class="fa-solid fa-expand"></i></a></span>
                                        </li>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <li class="adm-empty">Уведомлений пока нет</li>
                                            <?php endif; ?>
                                    </ul>
                                </div>

                                <!-- End Activity Log -->
                            </div>
                            <div class="col-lg-6 col-md-12 col-12">
                                <?php if(count($bbs_moderation)>0): ?>
                                <div class="recent-items dashboard-block">
                                    <div class="block-head">
                                        <h3 class="block-title">На модерации</h3>
                                        <span class="block-count"><?php echo e(count($bbs_moderation)); ?></span>
                                    </div>
                                    <ul class="adm-list">
                                        <?php $__currentLoopData = $bbs_moderation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <?php echo $__env->make('bb.dashboardcard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                            </li>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </ul>
                                </div>
                            <?php endif; ?>
                                    <?php if(count($bbs_moderation_fail)>0): ?>
                                        <div class="recent-items dashboard-block">
                                            <div class="block-head">
                                                <h3 class="block-title">Не прошло модерацию</h3>
                                                <span class="block-count"><?php echo e(count($bbs_moderation_fail)); ?></span>
                                            </div>
                                            <ul class="adm-list">
                                                <?php $__currentLoopData = $bbs_moderation_fail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        <?php echo $__env->make('bb.dashboardcard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                                    </li>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            </ul>
                                        </div>
                                <?php endif; ?>
                                <!-- Start Recent Items -->
                                <div class="recent-items dashboard-block">
                                    <div class="block-head">
                                        <h3 class="block-title">Популярные</h3>
                                        <span class="block-count"><?php echo e(count($bbs_popular)); ?></span>
                                    </div>
                                    <ul class="adm-list">
                                        <?php $__empty_1 = true; $__currentLoopData = $bbs_popular; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                        <li>
<?php echo $__env->make('bb.dashboardcard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                                        </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <li class="adm-empty">Объявлений пока нет</li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                                <!-- End Recent Items -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">

                    <script>

                    </script>
                </div>
            </div>
        </div>
    </section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /workspaces/php-mariadb/specmashina.by/resources/views/dashboard.blade.php ENDPATH**/ ?>