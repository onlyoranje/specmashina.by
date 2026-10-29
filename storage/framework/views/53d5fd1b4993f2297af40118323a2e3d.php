<?php
    $parent_rubrics = App\Models\Rubric::whereAncestorOrSelf($bb->rubric_id)->orderBy('level')->get();
    $parent_rubric = $parent_rubrics[0];
    $subparent_rubric = $parent_rubrics[1];
    $images = App\Models\UserFile::where('bb_id',$bb->id)->orderBy('sort')->get();

?>
<div class="image">
    <?php if(count($images)> 0): ?>
        <a href="<?php echo e(route('bb',['bb'=>$bb->id])); ?>"><img
                src="<?php echo e(Storage::url($images[0]->resize(60, 60))); ?>" alt="<?php echo e($bb->title); ?>"></a>
    <?php else: ?>
        <a href="<?php echo e(route('bb',['bb'=>$bb->id])); ?>"><img
                src="http://placehold.it/60x60&text=<?php echo e($bb->id); ?>" alt="<?php echo e($bb->title); ?>"></a>
    <?php endif; ?>
</div>
<a href="<?php echo e(route('bb',['bb'=>$bb->id])); ?>" class="title"><?php echo e($parent_rubric->title); ?> <?php echo e($bb->rubric->title_r); ?> <?php echo e($bb->vendor->name); ?> <?php echo e($bb->title); ?></a>
<?php if($bb->status_bb->active=='Y'): ?>
<span class="time"><?php echo e($bb->bbstatistic_count); ?> просмотров</span>
<?php endif; ?>

<?php if($bb->status_bb->status=='N'): ?>
    <a href="<?php echo e(route('bb_edit',$bb->id)); ?>" class="adm-action">Исправить</a>
<?php endif; ?>
<?php /**PATH /workspaces/php-mariadb/specmashina.by/resources/views/bb/dashboardcard.blade.php ENDPATH**/ ?>