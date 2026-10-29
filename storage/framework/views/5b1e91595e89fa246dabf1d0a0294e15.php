<?php $__env->startSection('title', ($pageTitle ?? 'Аренда спецтехники') . ' — цены, каталог объявлений на landi.by'); ?>
<?php $__env->startSection('description', ($currentCategoryName ?? 'Аренда строительной техники') . ' в Беларуси — ' . (int) $equipments->total() . ' объявлений. Аренда и продажа строительной спецтехники от собственников и организаций.'); ?>
<?php $__env->startSection('og_type', 'website'); ?>
<?php $__env->startSection('og_image', $ogImage); ?>

<?php $__env->startPush('styles'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('css/catalog.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
    // Единица тарификации и подписи кнопки (контроллер может переопределить).
    $isSale      = $isSale ?? false;
    $priceUnit   = $priceUnit ?? ($isSale ? 'руб' : 'руб/час');
    $priceLabel  = $priceLabel ?? ($isSale ? 'Цена' : 'Цена от');
    $actionLabel = $actionLabel ?? 'Подробнее';

    // Города: если контроллер не передал коллекцию — fallback на 7 региональных
    // центров РБ. Каждый элемент может быть объектом (id/title) или массивом.
    // Опция-плейсхолдер («Все города» → без фильтра) рендерится в разметке
    // <select> (partials/sidebar), поэтому в списке городов пустых значений быть
    // не должно: иначе браузер подставит первую опцию (алфавитно — «Барановичи»).
    $filterCities = $filterCities ?? collect([
        ['id' => 1,   'title' => 'Минск'],
        ['id' => 2,   'title' => 'Брест'],
        ['id' => 3,   'title' => 'Витебск'],
        ['id' => 4,   'title' => 'Гомель'],
        ['id' => 5,   'title' => 'Гродно'],
        ['id' => 6,   'title' => 'Могилев'],
        ['id' => 7,   'title' => 'Орша'],
    ]);
?>

  <div class="container catalog-page" id="catalog-page">

    
    <div class="catalog-header">
      <nav class="catalog-breadcrumbs" aria-label="Хлебные крошки">
        <a href="<?php echo e(url('/')); ?>" class="breadcrumb-link">Главная</a>
        <span class="breadcrumb-sep" aria-hidden="true">/</span>
        
        <span class="breadcrumb-current" id="catalog-crumb"><?php echo e($pageTitle ?? ($currentCategoryName ?? 'Аренда спецтехники')); ?></span>
      </nav>

      <h1 class="catalog-title">
        <span id="catalog-heading"><?php echo e($currentCategoryName ?? 'Аренда строительной техники'); ?></span>
        <span class="catalog-counter" id="catalog-counter">Найдено: <?php echo e($equipments->total()); ?></span>
      </h1>
    </div>

    
    <div class="catalog-layout" id="catalog-layout">

      <?php echo $__env->make('catalog.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

      <?php echo $__env->make('catalog.partials.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    </div>

    
    <div class="catalog-loading" id="catalog-loading" hidden aria-hidden="true">
      <span class="catalog-loading__spinner"></span>
      <span class="catalog-loading__text">Обновляем объявления…</span>
    </div>

    
    <p class="visually-hidden" id="catalog-status" role="status" aria-live="polite"></p>
  </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  
  <script src="<?php echo e(asset('js/catalog-filters.js')); ?>" defer></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('redesign.layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /workspaces/php-mariadb/specmashina.by/resources/views/catalog/index.blade.php ENDPATH**/ ?>