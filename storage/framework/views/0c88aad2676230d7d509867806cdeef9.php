
<?php $__currentLoopData = $rubrics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rubric): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li class="adm-tree-row" data-depth="<?php echo e($depth ?? 0); ?>" data-id="<?php echo e($rubric->id); ?>">
        <?php if(count($rubric->children) > 0): ?>
            
            <button type="button" class="adm-tree-toggle" aria-expanded="true"
                    aria-label="Свернуть или развернуть категории внутри «<?php echo e($rubric->title); ?>»"></button>
        <?php else: ?>
            <span class="adm-tree-spacer" aria-hidden="true"></span>
        <?php endif; ?>
        <div class="log-icon">
            <i class="lni lni-folder" aria-hidden="true"></i>
        </div>
        <a href="<?php echo e(route('rubric_dashboard_edit', ['rubric' => $rubric->id])); ?>" class="title">
            <?php echo $prefix; ?><?php echo e($rubric->title); ?>

            <span class="adm-muted">(уровень: <?php echo e($rubric->level); ?>)</span>
        </a>
        <span class="time"><a href="<?php echo e(route('rubric_dashboard_edit', ['rubric' => $rubric->id])); ?>">Редактировать</a></span>
        <span class="time"><a href="<?php echo e(route('rubric_dashboard_delete', ['rubric' => $rubric->id])); ?>" class="text-danger">Удалить</a></span>
    </li>
    <?php echo $__env->make('rubric.partials.tree', ['rubrics' => $rubric->children, 'prefix' => $prefix.'&mdash;&nbsp;', 'depth' => ($depth ?? 0) + 1], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /workspaces/php-mariadb/specmashina.by/resources/views/rubric/partials/tree.blade.php ENDPATH**/ ?>