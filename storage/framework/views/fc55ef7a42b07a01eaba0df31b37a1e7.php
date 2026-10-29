<?php $__env->startSection('title', 'Мои объявления'); ?>

<?php $__env->startSection('main'); ?>
    <?php echo $__env->make('dashboard_nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

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
                        <div class="dashboard-block mt-0">
                            <div class="block-head d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <h3 class="block-title mb-0 border-0 pb-0">Мои объявления</h3>
                                <div class="block-actions pe-3">
                                    <a href="<?php echo e(route('addForm')); ?>" class="btn">+ Добавить объявление</a>
                                </div>
                            </div>
                            <nav class="list-nav">
                                <ul>
                                    <li class="<?php echo e($request->status_id ? '':'active'); ?>"><a href="<?php echo e(route('mybb')); ?>">Все <span><?php echo e($bbs_count); ?></span></a></li>
                                    <?php $__currentLoopData = $status_bb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($status->count_bbs()): ?>
                                    <li class="<?php echo e($request->status_id==$status->id ? 'active':''); ?>"><a href="?status_id=<?php echo e($status->id); ?>"><?php echo e($status->name); ?> <span><?php echo e($status->count_bbs()); ?></span></a></li>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </nav>

                            <!-- Start Items Area -->
                            <div class="my-items">
                                <table class="bb-table">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="bb-col-listing">Объявление</th>
                                            <th scope="col" class="bb-col-status">Статус</th>
                                            <th scope="col" class="bb-col-city">Город</th>
                                            <th scope="col" class="bb-col-views">Просмотры</th>
                                            <th scope="col" class="bb-col-actions">Действия</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            <?php if(count($bbs) > 0): ?>
                                <?php $__currentLoopData = $bbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php
                                        $parent_rubrics = App\Models\Rubric::whereAncestorOrSelf($bb->rubric_id)->orderBy('level')->get();
                                        $parent_rubric = $parent_rubrics[0];
                                        $subparent_rubric = $parent_rubrics[1];
                                    ?>
                                <!-- Start Single List -->
                                <tr class="bb-row">
                                    <td class="bb-cell-listing">
                                        <div class="bb-listing">
                                            <?php if(count($bb->userfile)> 0): ?>
                                                <img class="bb-listing__thumb" src="<?php echo e(Storage::url($bb->userfile[0]->resize(100, 100))); ?>" alt="<?php echo e($bb->title); ?>" width="70" height="70" loading="lazy">
                                            <?php else: ?>
                                                <img class="bb-listing__thumb" src="http://placehold.it/100x100&text=<?php echo e($bb->title); ?>" alt="<?php echo e($bb->title); ?>" width="70" height="70">
                                            <?php endif; ?>
                                            <div class="bb-listing__body">
                                                <a class="bb-listing__title" href="<?php echo e(route('bb',['bb'=>$bb->id])); ?>"><?php echo e($parent_rubric->title); ?> <?php echo e($bb->rubric->title_r); ?> <?php echo e($bb->vendor->name); ?> <?php echo e($bb->title); ?></a>
                                                <?php if($bb->bbprice): ?>
                                                    <span class="bb-listing__price"><?php echo e($bb->bbprice->price); ?> <?php echo e($bb->bbprice->pricetype->type); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="bb-cell-status">
                                        <span class="status-badge" style="--badge: <?php echo e(optional($bb->status_bb)->color_badge ? '#' . optional($bb->status_bb)->color_badge : '#D92323'); ?>"><?php echo e(optional($bb->status_bb)->name); ?></span>
                                        <div class="bb-dates">
                                            <span class="bb-dates__line">Создано: <?php echo e(date('d.m.Y H:i',strtotime($bb->created_at))); ?></span>
                                            <?php if($bb->created_at!=$bb->updated_at): ?>
                                                <span class="bb-dates__line">Обновлено: <?php echo e(date('d.m.Y H:i',strtotime($bb->updated_at))); ?></span>
                                            <?php endif; ?>
                                            <?php if($bb->lifted_at): ?>
                                                <span class="bb-dates__line">Поднято: <?php echo e(date('d.m.Y H:i',strtotime($bb->lifted_at))); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </td>

                                    <td class="bb-cell-meta bb-cell-city" data-label="Город"><?php echo e($bb->location->title); ?></td>
                                    <td class="bb-cell-meta bb-cell-views" data-label="Просмотры"><?php echo e($bb->count_views()); ?></td>

                                    <td class="bb-cell-actions">
                                        <div class="bb-actions">
                                            <a class="bb-btn-edit" href="<?php echo e(route('bb_edit', ['bb'=>$bb->id])); ?>">Редактировать</a>
                                            <?php if($bb->active=='Y'): ?>
                                                <a class="bb-icon bb-icon--view" href="<?php echo e(route('bb',['bb'=>$bb->id])); ?>" target="_blank" rel="noopener" title="Просмотреть" aria-label="Просмотреть"><i class="fa-solid fa-eye" aria-hidden="true"></i></a>
                                            <?php endif; ?>
                                            <?php if(optional($bb->status_bb)->status=='P'): ?>
                                                <a class="bb-icon bb-icon--play" href="<?php echo e(route('bb_edit_status',['bb'=>$bb->id,'status'=>$bb->previus_status ?: 'S'])); ?><?php echo e(url_parameters($request)); ?>" title="Снять с паузы" aria-label="Снять с паузы"><i class="fa-solid fa-play" aria-hidden="true"></i></a>
                                            <?php endif; ?>
                                            <?php if(optional($bb->status_bb)->active=='Y'): ?>
                                                <a class="bb-icon bb-icon--pause" href="<?php echo e(route('bb_edit_status',['bb'=>$bb->id,'status'=>'P'])); ?><?php echo e(url_parameters($request)); ?>" title="Пауза" aria-label="Поставить объявление на паузу"><i class="fa-solid fa-pause" aria-hidden="true"></i></a>
                                            <?php endif; ?>
                                            <?php if($bb->active=='Y'): ?>
                                                <a class="bb-icon bb-icon--lift" href="<?php echo e(route('bb_up',['bb'=>$bb->id])); ?><?php echo e(url_parameters($request)); ?>" title="Поднять объявление" aria-label="Поднять объявление"><i class="fa-solid fa-arrow-up" aria-hidden="true"></i></a>
                                            <?php endif; ?>
                                            <a class="bb-icon bb-icon--danger" href="<?php echo e(route('bb_delete', ['bb'=>$bb->id])); ?><?php echo e(url_parameters($request)); ?>" title="Удалить" aria-label="Удалить объявление"><i class="fa-solid fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- End Single List -->
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr>
                                    <td class="adm-empty" colspan="5">Объявлений пока нет. <a href="<?php echo e(route('addForm')); ?>">Добавить объявление</a></td>
                                </tr>
                            <?php endif; ?>
                                </tbody>
                                </table>
                                <!-- Pagination -->
                                <?php if($bbs->hasPages()): ?>
                                    <div class="adm-list-pages">
                                        <?php echo e($bbs->links('pagination::norwegian')); ?>

                                    </div>
                                <?php endif; ?>
                                <!--/ End Pagination -->
                            </div>
                            <!-- End Items Area -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /workspaces/php-mariadb/specmashina.by/resources/views/bb/mybb.blade.php ENDPATH**/ ?>