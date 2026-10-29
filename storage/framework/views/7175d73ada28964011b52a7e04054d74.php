<?php $__env->startSection('title', 'Моя организация'); ?>

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
                        <!-- Start Profile Settings Area -->
                        <div class="dashboard-block mt-0 profile-settings-block">
                            <div class="block-head">
                                <h3 class="block-title">Моя организация</h3>
                                <?php if($organization): ?>
                                    <a class="btn alt-btn" href="<?php echo e(route('organization',$organization->id)); ?>" target="_blank">Открыть публичную страницу</a>
                                <?php endif; ?>
                            </div>
                            <div class="inner-block">
                                <?php if($organization): ?>
                                <div class="image">

                                    <?php if($organization->logo): ?>
                                        <img class="image-logo" src="<?php echo e(Storage::url($organization->logo)); ?>" alt="<?php echo e($organization->title); ?>">
                                    <?php else: ?>
                                        <svg class="bd-placeholder-img img-fluid rounded-start" width="100%" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image" preserveAspectRatio="xMidYMid slice" focusable="false">
                                            <title>Placeholder</title>
                                            <rect width="100%" height="100%" fill="#868e96"></rect>
                                            <text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image</text>
                                        </svg>
                                    <?php endif; ?>

                                </div>
                                    <form class="profile-setting-form" method="post" action="<?php echo e(route('organization_update',['organization'=>$organization->id])); ?>" method="post"
                                          enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PATCH'); ?>
                                        <div class="row">
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label>Название организации</label>
                                                    <input name="title" type="text" value="<?php echo e($organization->title); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label>УНП</label>
                                                    <input name="unp" type="text" id="unp"  value="<?php echo e($organization->unp); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">

                                                <div class="form-group">
                                                    <label>Город</label>
                                                    <div class="selector-head">

                                                        <div id="container_location_0" class="container_location"></div>

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label>Адрес организации</label>
                                                    <textarea name="address" cols="1" ><?php echo e($organization->address); ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-12">
                                                <div class="form-group">
                                                    <label>Телефон</label>
                                                    <input type="text"  id="phone" name="phone"  value="<?php echo e($organization->phone); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-12">
                                                <div class="form-group">
                                                    <label>E-mail</label>
                                                    <input type="email"  name="email"  value="<?php echo e($organization->email); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-12">
                                                <div class="form-group">
                                                    <label>Сайт</label>
                                                    <input type="text"  name="site"  value="<?php echo e($organization->site); ?>">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group mt-30">
                                                    <label>Описание (не более 1000 символов)</label>
                                                    <textarea name="description" placeholder="" maxlength="1000"><?php echo e($organization->content); ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-12">
                                                <div class="form-group upload-image">
                                                    <?php

                                                   /* if ($organization->logo){
                                                      echo  $old_image ='{"name":"'.$organization->name.'","id":'.$organization->id.',"file":"'.$organization->id.'","local":"'.Storage::url($organization->logo).'","data":{"url":"'.Storage::url($organization->logo).'","thumbnail":"'.Storage::url($organization->logo) .'","readerForce":true}}';
                                                    }*/

                                                    ?>
                                                    <label>Обновить логотип</label>
                                                    <input type="file"  name="file" data-fileuploader-limit="1">
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group button mb-0">
                                                    <button type="submit" class="btn ">Обновить</button>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </form>
                                <?php else: ?>

                                        <div class="row">

                                            <div class="col-6">
                                                <div class="form-group button mb-0">
                                                    <a href="<?php echo e(route('organization_add')); ?>" class="btn ">Добавить организацию</a>
                                                </div>
                                            </div>

                                        </div>

                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- End Profile Settings Area -->
                        <!-- Start Password Change Area -->

                        <!-- End Password Change Area -->
                    </div>



                </div>
            </div>
        </div>
    </section>

    <script>
        window.addEventListener("load", function(){
            $("#phone").mask("+375 99 999-99-99")
            $("#unp").mask("999999999")
            window.json_location = <?php echo json_encode($locations, 15, 512) ?>;
            <?php $__currentLoopData = $all_locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location_): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            NewSelect('location',<?php if (!$location_->parent_id) {echo 'null';} else {echo $location_->parent_id;}  ?>,<?php echo e($location_->level); ?>,<?php echo e($location_->id); ?>,<?php echo json_encode($all_locations, 15, 512) ?>);
            $('#location_level_<?php echo e($location_->level); ?> option[value=<?php echo e($location_->id); ?>]').prop('selected', true);
console.log(<?php echo e($location_->id); ?>)

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        });
    </script>

   











<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /workspaces/php-mariadb/specmashina.by/resources/views/organization/my_organization.blade.php ENDPATH**/ ?>