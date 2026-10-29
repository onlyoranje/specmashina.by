<?php $__env->startSection('title', $pageTitle . ' — ' . config('site.name')); ?>
<?php $__env->startSection('description', 'Все категории аренды и продажи строительной спецтехники в Беларуси — выбирайте технику по разделам «Аренда» и «Продажа».'); ?>

<?php $__env->startPush('styles'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('css/home.css')); ?>">
  <style>
    .page-head { padding: 56px 0 0; }
    .page-head .eyebrow { margin-bottom: 8px; }
    .page-title { font-size: 2.25rem; font-weight: 800; color: var(--primary-dark); }
    .page-lead { max-width: 44rem; margin-top: 12px; color: var(--text-gray); }
    .section__empty { color: var(--text-gray); }
  </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
  <section class="section--light page-head">
    <div class="container">
      <p class="eyebrow">Каталог</p>
      <h1 class="page-title"><?php echo e($pageTitle); ?></h1>
      <p class="page-lead">Все категории техники, размещённые на площадке. Внутри каждой категории — подкатегории с объявлениями аренды и продажи по всей Беларуси.</p>
    </div>
  </section>

  <?php $__currentLoopData = [['title' => 'Аренда', 'route' => 'rent.index', 'cats' => $rentCategories],
            ['title' => 'Продажа', 'route' => 'sale.index', 'cats' => $saleCategories]]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <section class="section">
      <div class="container">
        <div class="section__head">
          <div>
            <p class="eyebrow">Секция</p>
            <h2><?php echo e($section['title']); ?></h2>
          </div>
          <a class="section__link" href="<?php echo e(route($section['route'])); ?>">Все объявления
            <svg viewBox="0 0 16 16" aria-hidden="true"><path d="M3 8h9M8 3l5 5-5 5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </a>
        </div>

        <div class="cats">
          <?php $__currentLoopData = $section['cats']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a class="cat-card" href="<?php echo e(route($section['route'], $cat->id)); ?>">
              <?php if (isset($component)) { $__componentOriginal6209a0be2014ea7f5be053498f36e5d0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6209a0be2014ea7f5be053498f36e5d0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cat-icon','data' => ['title' => $cat->title,'icon' => $cat->icon]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cat-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cat->title),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cat->icon)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6209a0be2014ea7f5be053498f36e5d0)): ?>
<?php $attributes = $__attributesOriginal6209a0be2014ea7f5be053498f36e5d0; ?>
<?php unset($__attributesOriginal6209a0be2014ea7f5be053498f36e5d0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6209a0be2014ea7f5be053498f36e5d0)): ?>
<?php $component = $__componentOriginal6209a0be2014ea7f5be053498f36e5d0; ?>
<?php unset($__componentOriginal6209a0be2014ea7f5be053498f36e5d0); ?>
<?php endif; ?>
              <span class="cat-card__name"><?php echo e($cat->title); ?></span>
              <span class="cat-card__count"><?php echo e($cat->ads_count ? bbs_count_title($cat->ads_count) : 'Нет объявлений'); ?></span>
            </a>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </section>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('redesign.layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /workspaces/php-mariadb/specmashina.by/resources/views/catalog/categories.blade.php ENDPATH**/ ?>