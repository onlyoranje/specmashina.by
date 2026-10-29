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
                                        <h3 class="block-title">Обновление категории</h3>
                                        <div class="block-actions">
                                            <a class="btn alt-btn" href="<?php echo e(route('rubric_dashboard')); ?>">К списку категорий</a>
                                        </div>
                                    </div>
                                    <form class="default-form-style" action="<?php echo e(route('editRubricToDB',['rubric'=>$rubric->id])); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PATCH'); ?>

                                        <div class="inner-block">
                                            <div class="row">
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label>Наименование</label>
                                                        <input type="text" value="<?php echo e(old('title',$rubric->title)); ?>"  name="title"  required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label>Наименование (род.пад.)</label>
                                                        <input type="text" value="<?php echo e(old('title_r',$rubric->title_r)); ?>"  name="title_r"  required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label>Сортировка</label>
                                                        <input type="number" value="<?php echo e(old('sort',$rubric->sort)); ?>" name="sort"   required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label>Родительская категория</label>
                                                        <div class="selector-head">
                                                            <span class="arrow"><i class="lni lni-chevron-down"></i></span>


                                                            <select name="parent_id" id="select_category" class="user-chosen-select">
                                                                <option value="">Корневая категория</option>
                                                                <?
                                                                $traverse = function ($rubrics, $prefix = '-') use (&$traverse) {
                                                                    foreach ($rubrics as $rubric) {
                                                                        echo "<option value=".$rubric->id." ";
                                                                        echo ">". PHP_EOL.$prefix.' '.$rubric->title."</option>";

                                                                        $traverse($rubric->children, $prefix.'-');
                                                                    }
                                                                };

                                                                $traverse($rubrics);
                                                                ?>



                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Иконка</label>
                                                        <div class="selector-head">
                                                            <span class="arrow"><i class="lni lni-chevron-down"></i></span>


                                                            <textarea name="icon" class="form-control" rows="3"><?php echo e(old('icon', $rubric->icon)); ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div>
                                                        <img class="img-fluid icon" src="<?php echo e(asset("images/logo/logo.svg")); ?>" alt="Logo">
                                                    </div>

                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group button mb-0 mt-5">
                                                        <button type="submit" class="btn ">Обновить</button>
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
    <script>
        window.addEventListener("load", function() {
            <?php if(isset($rubric->parent_id)): ?>
            $('#select_category option[value=<?php echo e($rubric->parent_id); ?>]').prop('selected', true);
            <?php endif; ?>

            <?php $__currentLoopData = $depth; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ch_cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            $('#select_category option[value="<?php echo e($ch_cat->id); ?>"]').attr('disabled', 'disabled');
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            $( "select[name='icon']" ).on( "change",function () {
                $('.icon').attr('src','/images/'+$("select[name='icon']" ).val())
                console.log($( "select[name='icon']" ).val())
            })

        })
    </script>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /workspaces/php-mariadb/specmashina.by/resources/views/rubric/edit.blade.php ENDPATH**/ ?>