

      <aside class="catalog-sidebar" id="catalog-sidebar" aria-label="Фильтры поиска">

        <?php
          // Мобильная версия: блоки-фильтры свёрнуты (<details> без [open]);
          // на десктопе раскрыты. Определение серверное через mobile-detect —
          // тот же механизм, что в остальных шаблонах сайта.
          $isMobile = app('mobile-detect')->isMobile();
        ?>

        
        <details class="filter-block" <?php if (! ($isMobile)): ?> open <?php endif; ?>>
          <summary class="filter-summary">Города</summary>
          <div class="filter-body">
            <form method="get" action="<?php echo e(current_path()); ?>" class="city-filter-form">
              <label class="city-filter-label" for="city_id">Город подачи</label>
              
              <?php
                // Активный город берём из нормализованного $listQuery: туда
                // контроллер кладёт только реально применённый фильтр. Если
                // сравнивать с сырым request('city_id'), пустое/битое значение
                // не совпадёт ни с одним пунктом и браузер подставит первый
                // город списка — фильтр будет выглядеть применённым.
                $activeCityId = $listQuery['city_id'] ?? null;
              ?>
              <select class="catalog-select" name="city_id" id="city_id" data-filter="city_id">
                
                <option value="" <?php if(! $activeCityId): ?> selected <?php endif; ?>>Все города</option>
                <?php $__currentLoopData = $filterCities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php
                    $cityId   = $city->id ?? $city['id'];
                    $cityName = $city->title ?? $city['title'];
                  ?>
                  <option value="<?php echo e($cityId); ?>"
                    <?php if((string) $activeCityId === (string) $cityId): ?> selected <?php endif; ?>
                  ><?php echo e($cityName); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>

              
              <?php if(($sort ?? 'date') !== 'date'): ?>
                <input type="hidden" name="sort" value="<?php echo e($sort); ?>">
              <?php endif; ?>
              <?php if(($view ?? 'list') !== 'list'): ?>
                <input type="hidden" name="view" value="<?php echo e($view); ?>">
              <?php endif; ?>

              <noscript>
                <button type="submit" class="catalog-select-submit">Показать</button>
              </noscript>
            </form>
          </div>
        </details>

        
        <details class="filter-block" <?php if (! ($isMobile)): ?> open <?php endif; ?>>
          <summary class="filter-summary">Категории</summary>
          <ul class="catalog-categories">
            
            <?php if(isset($rootId, $currentRubricId) && (int) $rootId !== (int) $currentRubricId): ?>
              <li class="catalog-category catalog-category--back">
                <a href="<?php echo e(route($isSale ? 'sale.index' : 'rent.index', $listQuery ?? [])); ?>"
                   class="catalog-category__link"
                   data-ajax-link>
                  <span class="catalog-category__name">← Все категории</span>
                </a>
              </li>
              
              <?php if(! $categories->contains(fn ($c) => (int) ($c->id ?? 0) === (int) $currentRubricId)): ?>
                <li class="catalog-category">
                  <span class="catalog-category__link is-active" aria-current="page">
                    <span class="catalog-category__name"><?php echo e($currentRubricTitle); ?></span>
                  </span>
                </li>
              <?php endif; ?>
            <?php endif; ?>

            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $catTitle = $cat->title ?? $cat['title'];
                // ads_count — активные объявления с учётом вложенных рубрик;
                // fallback на bbs_count/count для plain-объектов.
                $catCount = (int) ($cat->ads_count ?? $cat->bbs_count ?? ($cat->count ?? ($cat['count'] ?? 0)));
                $catId    = $cat->id ?? ($cat['id'] ?? null);
                // Ссылка на страницу рубрики внутри ТЕКУЩЕЙ секции:
                // /rent/{rubric} или /sale/{rubric}. Остальные фильтры
                // (city_id/sort/view) сохраняем, чтобы выбор категории их не сбрасывал.
                $catHref  = $cat->url ?? ($cat['url'] ?? null);
                if (! $catHref && $catId) {
                    $catHref = route($isSale ? 'sale.index' : 'rent.index', array_filter(array_merge(
                        $listQuery ?? [],
                        ['rubric' => $catId]
                    ), fn ($value) => $value !== null && $value !== ''));
                }
                // Категории без техники приглушаем — меньше визуального шума.
                $catEmpty = $catCount < 1;
                // Активная категория — та, что открыта сейчас (стилизуется
                // существующим классом .catalog-category__link.is-active).
                $catActive = isset($currentRubricId) && (int) $currentRubricId === (int) $catId;
              ?>
              <li class="catalog-category<?php echo e($catEmpty ? ' catalog-category--empty' : ''); ?>">
                <a href="<?php echo e($catHref ?: '#'); ?>"
                   class="catalog-category__link<?php echo e($catActive ? ' is-active' : ''); ?>"
                   data-ajax-link
                   <?php if($catActive): ?> aria-current="page" <?php endif; ?>>
                  <span class="catalog-category__name"><?php echo e($catTitle); ?></span>
                  
                  <?php if($catCount > 0): ?>
                    <span class="catalog-category__count"><?php echo e($catCount); ?></span>
                  <?php endif; ?>
                </a>
              </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </details>

      </aside>
<?php /**PATH /workspaces/php-mariadb/specmashina.by/resources/views/catalog/partials/sidebar.blade.php ENDPATH**/ ?>