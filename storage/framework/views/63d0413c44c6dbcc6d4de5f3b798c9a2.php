<?php $__env->startSection('title', config('site.name') . ' — аренда и продажа строительной техники в Беларуси'); ?>
<?php $__env->startSection('og_type', 'website'); ?>

<?php $__env->startSection('og_image', (($popular->first()?->images()->first()) ? Storage::url($popular->first()->images()->first()->resize(1200, 630)) : asset('images/placeholder/no-image.jpg'))); ?>

<?php $__env->startPush('styles'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('css/home.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

  
  <section class="hero">
    <div class="container hero__inner">
      <div class="hero__content">
        <p class="eyebrow">Каталог спецтехники · landi.by</p>
        <h1 class="hero__title">Аренда и продажа строительной техники в Беларуси</h1>
        <p class="hero__lead">Экскаваторы, погрузчики, краны и самосвалы от проверенных организаций. Сравните объявления, подайте заявку онлайн и получите технику на объект в день обращения.</p>
        <dl class="hero__stats">
          <div class="hero__stat"><dt>194</dt><dd>категории техники</dd></div>
          <div class="hero__stat"><dt>6</dt><dd>областных городов подачи</dd></div>
          <div class="hero__stat"><dt>24/7</dt><dd>приём заявок онлайн</dd></div>
        </dl>
      </div>

      <div class="search-widget">
        <p class="search-widget__title">Поиск техники</p>

        
        <div class="search-widget__tabs" role="group" aria-label="Тип сделки">
          <button type="button" class="search-widget__tab is-active" data-type="rent" aria-pressed="true">Аренда</button>
          <button type="button" class="search-widget__tab" data-type="sale" aria-pressed="false">Продажа</button>
        </div>

        <form action="<?php echo e(route('search')); ?>" method="GET" class="search-widget__form">
          <input type="hidden" name="type" id="search-type" value="rent">

          <div class="search-widget__field">
            <label class="search-widget__label" for="sw-category">Категория техники</label>
            
            <select class="search-widget__select" id="sw-category" name="category_id">
              <option value="">Любая категория</option>
              <?php $__currentLoopData = $categories->groupBy('root_title'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rootTitle => $rootCategories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                  $section = $rootCategories->first()->root_id === 2000 ? 'sale' : 'rent';
                ?>
                <optgroup label="<?php echo e($rootTitle); ?>" data-section="<?php echo e($section); ?>" <?php if($section !== 'rent'): ?> hidden disabled <?php endif; ?>>
                  <?php $__currentLoopData = $rootCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->title); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </optgroup>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>

          <div class="search-widget__field">
            <label class="search-widget__label" for="sw-city">Город подачи</label>
            <select class="search-widget__select" id="sw-city" name="city">
              <option value="">Вся Беларусь</option>
              <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($city->id); ?>"><?php echo e($city->title); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>

          <button class="btn-submit" type="submit">Найти технику</button>
        </form>
      </div>
    </div>
  </section>

  
  <script>
    (function () {
      var hidden     = document.getElementById('search-type');
      var tabs       = document.querySelectorAll('.search-widget__tab');
      var categories = document.getElementById('sw-category');
      var groups     = categories ? categories.querySelectorAll('optgroup[data-section]') : [];

      function activateTab(type) {
        tabs.forEach(function (t) {
          var active = t.dataset.type === type;
          t.classList.toggle('is-active', active);
          t.setAttribute('aria-pressed', active ? 'true' : 'false');
          if (active) hidden.value = type;
        });

        // В списке категорий оставляем только активную секцию.
        groups.forEach(function (g) {
          var show = g.dataset.section === type;
          g.hidden = !show;
          g.disabled = !show;
          g.querySelectorAll('option').forEach(function (o) {
            o.hidden = !show;
          });
        });

        // Выбранная категория относится к другой секции — сбрасываем на «Любая».
        var selected = categories.options[categories.selectedIndex];
        if (selected && selected.value && selected.hidden) {
          categories.value = '';
        }
      }

      tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
          activateTab(tab.dataset.type);
        });
      });

      // Подстраховка (например, при нестандартном DOM или до первого запуска
      // activateTab): выбор категории включает вкладку её секции.
      if (categories) {
        categories.addEventListener('change', function () {
          var option  = categories.options[categories.selectedIndex];
          var section = option ? option.closest('optgroup[data-section]') : null;
          if (section) activateTab(section.dataset.section);
        });
      }

      // Начальное состояние: список категорий соответствует вкладке по умолчанию.
      activateTab(hidden.value === 'sale' ? 'sale' : 'rent');
    })();
  </script>

  
  <section class="section section--light" id="categories">
    <div class="container">
      <div class="section__head">
        <div>
          <p class="eyebrow">Каталог</p>
          <h2>Категории техники</h2>
        </div>
        <a class="section__link" href="<?php echo e(route('catalog.all')); ?>">Весь каталог
          <svg viewBox="0 0 16 16" aria-hidden="true"><path d="M3 8h9M8 3l5 5-5 5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
      </div>

      <div class="cats">
        <?php $__empty_1 = true; $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <a class="cat-card" href="<?php echo e($cat->parent_id === 2000 ? route('sale.index', $cat->id) : route('rent.index', $cat->id)); ?>">
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
            
            <span class="cat-card__name"><?php echo e($cat->cardTitle()); ?></span>
            <span class="cat-card__count"><?php echo e($cat->ads_count ? bbs_count_title($cat->ads_count) : 'Нет объявлений'); ?></span>
          </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <p class="section__empty">Пока нет объявлений.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>
  
  <section class="section" id="catalog">
    <div class="container">
      <div class="section__head">
        <div>
          <p class="eyebrow">Востребовано сейчас</p>
          <h2>Популярная техника</h2>
        </div>
        <a class="section__link" href="<?php echo e(route('ads.index')); ?>">Все объявления
          <svg viewBox="0 0 16 16" aria-hidden="true"><path d="M3 8h9M8 3l5 5-5 5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
      </div>

      <div class="cards-grid">
        <?php $__empty_1 = true; $__currentLoopData = $popular; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <?php if (isset($component)) { $__componentOriginale7b99e5423177d7d270b63b6f282d3f5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale7b99e5423177d7d270b63b6f282d3f5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.equipment-card','data' => ['equipment' => $equipment]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('equipment-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['equipment' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($equipment)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale7b99e5423177d7d270b63b6f282d3f5)): ?>
<?php $attributes = $__attributesOriginale7b99e5423177d7d270b63b6f282d3f5; ?>
<?php unset($__attributesOriginale7b99e5423177d7d270b63b6f282d3f5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale7b99e5423177d7d270b63b6f282d3f5)): ?>
<?php $component = $__componentOriginale7b99e5423177d7d270b63b6f282d3f5; ?>
<?php unset($__componentOriginale7b99e5423177d7d270b63b6f282d3f5); ?>
<?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <p class="section__empty">Пока нет объявлений.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>

  
  <section class="section section--light" id="actual">
    <div class="container">
      <div class="section__head">
        <div>
          <p class="eyebrow">Свежие предложения</p>
          <h2>Актуальные объявления</h2>
        </div>
        <a class="section__link" href="<?php echo e(route('ads.index')); ?>">Все объявления
          <svg viewBox="0 0 16 16" aria-hidden="true"><path d="M3 8h9M8 3l5 5-5 5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
      </div>

      <div class="cards-grid">
        <?php $__empty_1 = true; $__currentLoopData = $actual; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <?php if (isset($component)) { $__componentOriginale7b99e5423177d7d270b63b6f282d3f5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale7b99e5423177d7d270b63b6f282d3f5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.equipment-card','data' => ['equipment' => $equipment]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('equipment-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['equipment' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($equipment)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale7b99e5423177d7d270b63b6f282d3f5)): ?>
<?php $attributes = $__attributesOriginale7b99e5423177d7d270b63b6f282d3f5; ?>
<?php unset($__attributesOriginale7b99e5423177d7d270b63b6f282d3f5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale7b99e5423177d7d270b63b6f282d3f5)): ?>
<?php $component = $__componentOriginale7b99e5423177d7d270b63b6f282d3f5; ?>
<?php unset($__componentOriginale7b99e5423177d7d270b63b6f282d3f5); ?>
<?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <p class="section__empty">Пока нет объявлений.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>

  
  <section class="section" id="news">
    <div class="container">
      <div class="section__head">
        <div>
          <p class="eyebrow">Журнал</p>
          <h2>Новости</h2>
        </div>
        <a class="section__link" href="<?php echo e(route('news.index')); ?>">Все новости
          <svg viewBox="0 0 16 16" aria-hidden="true"><path d="M3 8h9M8 3l5 5-5 5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
      </div>

      <div class="news-grid">
        <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <?php
            // resizeImage возвращает 'images/placeholder/no-image.svg',
            // если файла нет на диске — тогда нужен asset(), а не Storage::url()
            $newsImage = $post->image ? $post->resizeImage($post->image, 480, 320) : null;
            $newsSrc = ($newsImage && ! str_starts_with($newsImage, 'images/placeholder'))
                ? Storage::url($newsImage)
                : asset('images/placeholder/no-image.svg');
          ?>
          <article class="news-card">
            <a class="news-card__media" href="<?php echo e(route('news.show', $post)); ?>" tabindex="-1" aria-hidden="true">
              <img class="news-card__img"
                   src="<?php echo e($newsSrc); ?>"
                   alt="<?php echo e($post->title); ?>" loading="lazy">
            </a>
            <div class="news-card__body">
              <?php if($post->category): ?>
                <span class="news-card__category"><?php echo e($post->category); ?></span>
              <?php endif; ?>
              <h3 class="news-card__title"><a href="<?php echo e(route('news.show', $post)); ?>"><?php echo e($post->title); ?></a></h3>
              <?php if($post->preview_text): ?>
                <p class="news-card__text"><?php echo e($post->preview_text); ?></p>
              <?php endif; ?>
              <p class="news-card__meta"><?php echo e(optional($post->created_at)->format('d.m.Y')); ?></p>
            </div>
          </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <p class="section__empty">Скоро здесь появятся новости.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>
  
  <section class="section" id="advantages">
    <div class="container">
      <div class="section__head">
        <div>
          <p class="eyebrow">Почему landi.by</p>
          <h2>Маркетплейс спецтехники Беларуси</h2>
        </div>
      </div>

      <div class="adv">
        <div class="adv__item">
          <svg class="adv__icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="6" y="6" width="15" height="15" rx="2"/><rect x="27" y="6" width="15" height="15" rx="2"/><rect x="6" y="27" width="15" height="15" rx="2"/><rect x="27" y="27" width="15" height="15" rx="2"/></svg>
          <h3 class="adv__title">Огромный выбор</h3>
          <p class="adv__text">Сотни арендодателей по всей Беларуси в одном месте.</p>
        </div>
        <div class="adv__item">
          <svg class="adv__icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="24" cy="15" r="8"/><path d="M8 42c2.5-9.5 8.5-14 16-14s13.5 4.5 16 14"/></svg>
          <h3 class="adv__title">Прямые контакты</h3>
          <p class="adv__text">Общайтесь напрямую с владельцами техники — без посредников и комиссий сайта.</p>
        </div>
        <div class="adv__item">
          <svg class="adv__icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 22l36-12v24L6 28v-6z"/><path d="M24 34a7 7 0 1 1-13-4"/></svg>
          <h3 class="adv__title">Бесплатное размещение</h3>
          <p class="adv__text">Для собственников техники публикация объявлений абсолютно бесплатна.</p>
        </div>
        <div class="adv__item">
          <svg class="adv__icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="22" cy="22" r="13"/><path d="M32 32l9 9"/></svg>
          <h3 class="adv__title">Быстрый поиск</h3>
          <p class="adv__text">Фильтры по городам РБ и категориям машин — как при поиске авиабилетов.</p>
        </div>
      </div>
    </div>
  </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('redesign.layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /workspaces/php-mariadb/specmashina.by/resources/views/redesign/home.blade.php ENDPATH**/ ?>