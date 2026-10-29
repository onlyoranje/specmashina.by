
<?php
    // Активные фильтры без page — база для ссылок сортировки/вида.
    $baseQuery = $listQuery ?? [];

    // Ссылка на текущий URL с переопределением параметров (null → параметр убирается).
    // Путь — от корня сайта: не зависит от схемы/хоста (request()->url()
    // при проксировании даёт http://<LAN-IP>/… → Mixed Content).
    $linkTo = function (array $overrides = []) use ($baseQuery) {
        $query = array_filter(
            array_merge($baseQuery, $overrides),
            fn ($value) => $value !== null && $value !== ''
        );
        return $query ? current_path() . '?' . http_build_query($query) : current_path();
    };

    $sortActive = $sort ?? 'date';
    $viewActive = $view ?? 'list';
?>

      
      <section class="catalog-main" id="catalog-main" aria-label="Результаты поиска">

        
        <div class="catalog-toolbar">
          <div class="toolbar-sort">
            <span class="sort-label">Сортировка:</span>
            <a href="<?php echo e($linkTo(['sort' => null])); ?>"
               class="sort-link<?php echo e($sortActive === 'date' ? ' is-active' : ''); ?>"
               data-ajax-link
               data-sort="date"
               <?php if($sortActive === 'date'): ?> aria-current="true" <?php endif; ?>>по дате</a>
            <a href="<?php echo e($linkTo(['sort' => 'price'])); ?>"
               class="sort-link<?php echo e($sortActive === 'price' ? ' is-active' : ''); ?>"
               data-ajax-link
               data-sort="price"
               <?php if($sortActive === 'price'): ?> aria-current="true" <?php endif; ?>>по цене</a>
          </div>

          <div class="toolbar-view" role="group" aria-label="Вид списка">
            <a href="<?php echo e($linkTo(['view' => 'grid'])); ?>"
               class="view-btn<?php echo e($viewActive === 'grid' ? ' is-active' : ''); ?>"
               aria-label="Сетка"
               data-ajax-link
               data-view="grid"
               <?php if($viewActive === 'grid'): ?> aria-current="true" <?php endif; ?>>
              <svg viewBox="0 0 16 16" aria-hidden="true"><path d="M2 2h5v5H2zM9 2h5v5h-5zM2 9h5v5H2zM9 9h5v5h-5z"/></svg>
            </a>
            <a href="<?php echo e($linkTo(['view' => null])); ?>"
               class="view-btn<?php echo e($viewActive === 'list' ? ' is-active' : ''); ?>"
               aria-label="Список"
               data-ajax-link
               data-view="list"
               <?php if($viewActive === 'list'): ?> aria-current="true" <?php endif; ?>>
              <svg viewBox="0 0 16 16" aria-hidden="true"><path d="M2 4h12v2H2zM2 7h12v2H2zM2 10h8v2H2z"/></svg>
            </a>
          </div>
        </div>

        
        <?php if($equipments->count() > 0): ?>
          <div class="equipment-grid<?php echo e($viewActive === 'grid' ? ' is-grid' : ''); ?>">
            <?php $__currentLoopData = $equipments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php echo $__env->make('catalog.partials.ticket', ['item' => $item], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        <?php else: ?>
          <p class="catalog-empty">По выбранным фильтрам ничего не найдено.</p>
        <?php endif; ?>

        
        <?php if($equipments->hasPages()): ?>
          
          <div class="catalog-pagination">
            <?php echo e($equipments->links('catalog.partials.pagination')); ?>

          </div>
        <?php endif; ?>

      </section><?php /**PATH /workspaces/php-mariadb/specmashina.by/resources/views/catalog/partials/main.blade.php ENDPATH**/ ?>