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

                        <div class="row">
                            <div class="col-12">
                                <!-- Start Activity Log -->
                                <div class="profile-settings-block dashboard-block mt-0">
                                    <div class="block-head">
                                        <h3 class="block-title"><?php echo e($title); ?></h3>
                                        <div class="block-actions">
                                            <a class="btn alt-btn" href="<?php echo e(route('banners_dashboard')); ?>">К списку баннеров</a>
                                        </div>
                                    </div>
                                    <form class="default-form-style" action="<?php echo e(route('banner_add_db')); ?>" method="post" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>

                                        <div class="inner-block">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Заголовок</label>
                                                        <input type="text" value="<?php echo e(old('title')); ?>"  name="title"  required>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>URL</label>
                                                        <input type="text" value="<?php echo e(old('url')); ?>"  name="url"  required>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Максимальное количесвто показов</label>
                                                        <input type="number" value="<?php echo e(old('maximum_views')); ?>"  name="maximum_views">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Начало показов</label>
                                                        <input type="datetime-local" value="<?php echo e(old('start')); ?>"  name="start">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Окончание показов</label>
                                                        <input type="datetime-local" value="<?php echo e(old('end')); ?>"  name="end">
                                                    </div>
                                                </div>


                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group upload-image">
                                                        <label>Баннер </label>
                                                        <input type="file"  name="file1">
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group button mb-0 mt-5">
                                                        <button type="submit" class="btn " id="addpost">Добавить</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                                <!-- End Activity Log -->
                            </div>

                        </div>



                    </div>
                </div>
            </div>
        </div>
    </section>




<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /workspaces/php-mariadb/specmashina.by/resources/views/banner/add.blade.php ENDPATH**/ ?>