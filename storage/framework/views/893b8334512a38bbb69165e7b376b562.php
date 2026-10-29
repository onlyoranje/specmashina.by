<?php $__env->startSection('title', 'Категории'); ?>

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
                                <div class="dashboard-block mt-0">
                                    <div class="block-head">
                                        <h3 class="block-title">Категории</h3>
                                        <div class="block-actions block-actions--tools">
                                            <div class="adm-tree-tools">
                                                <button type="button" class="adm-tree-tool" id="rubric-collapse-all">Свернуть все</button>
                                                <button type="button" class="adm-tree-tool" id="rubric-expand-all">Развернуть все</button>
                                            </div>
                                            <a href="<?php echo e(route('rubric_dashboard_add')); ?>" class="btn">+ Добавить категорию</a>
                                        </div>
                                    </div>

                                    
                                    <?php if(count($rubrics) > 0): ?>
                                        <ul class="adm-list" id="rubric-tree">
                                            <?php echo $__env->make('rubric.partials.tree', ['rubrics' => $rubrics, 'prefix' => '', 'depth' => 0], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                        </ul>
                                    <?php else: ?>
                                        <ul class="adm-list" id="rubric-tree">
                                            <li class="adm-empty">Пока нет ни одной категории</li>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="<?php echo e(asset('js/rubric-tree.js')); ?>" defer></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /workspaces/php-mariadb/specmashina.by/resources/views/rubric/dashboard.blade.php ENDPATH**/ ?>