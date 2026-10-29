<?php $__env->startSection('title', 'Моя организация/ИП'); ?>

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
                    <div class="alert alert-warning" role="alert">
                        Для размещения объявления на сайте, Вам нужно внести информацию об организации/ИП
                    </div>
                    <div class="main-content">
                        <!-- Start Profile Settings Area -->

                        <div class="dashboard-block mt-0 profile-settings-block">
                            <div class="block-head">
                                <h3 class="block-title">Моя организация/ИП</h3>
                                <div class="block-actions">
                                    <a class="btn alt-btn" href="<?php echo e(route('my_organization')); ?>">Моя организация</a>
                                </div>
                            </div>
                            <div class="inner-block">


                                    <form class="profile-setting-form" method="post" action="<?php echo e(route('addOrganizationToDB')); ?>" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label>Название организации/ИП</label>
                                                    <input name="title" type="text" >
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label>УНП</label>
                                                    <input name="unp" type="text" id="unp">
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
                                                    <textarea name="address" cols="1" ></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-12">
                                                <div class="form-group">
                                                <label>Телефон</label>
                                                <input type="text"  id="phone" name="phone">
                                            </div>
                                            </div>
                                            <div class="col-lg-4 col-12">
                                                <div class="form-group">
                                                    <label>E-mail</label>
                                                    <input type="email"  name="email">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-12">
                                                <div class="form-group">
                                                    <label>Сайт</label>
                                                    <input type="text"  name="site">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group mt-30">
                                                    <label>Описание (не более 1000 символов)</label>
                                                    <textarea name="description" placeholder="" maxlength="1000"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group upload-image">
                                                    <label>Лого</label>
                                                    <input type="file"  name="file">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group button mb-0">
                                                    <button type="submit" class="btn ">Добавить</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

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
            NewSelect('location');
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /workspaces/php-mariadb/specmashina.by/resources/views/organization/add.blade.php ENDPATH**/ ?>