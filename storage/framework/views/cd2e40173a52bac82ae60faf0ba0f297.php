<?php $__env->startSection('title', 'Новости спецтехники и рынка аренды в Беларуси — новости, обзоры, цены на landi.by'); ?>
<?php $__env->startSection('description', 'Новости рынка аренды и продажи строительной спецтехники в Беларуси: обзоры машин, цены, законодательство и инструкции для собственников и арендаторов.'); ?>
<?php $__env->startSection('og_title', 'Новости спецтехники и рынка аренды в Беларуси'); ?>
<?php $__env->startSection('og_image', (($news->first()->image ?? null) ? Storage::url($news->first()->resizeImage($news->first()->image, 1200, 630)) : asset('images/placeholder/no-image.jpg'))); ?>
<?php $__env->startSection('og_type', 'website'); ?>

<?php $__env->startPush('styles'); ?>
    
    <link rel="stylesheet" href="<?php echo e(asset('css/news.css')); ?>">
    
    <link rel="stylesheet" href="<?php echo e(asset('css/catalog.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

  <?php
      // Заглушка «нет фото» для карточек без изображения (одна на файл)
      $empty_media = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="9" cy="10" r="2"/><path d="M21 16.5l-4.5-5.5-5.5 7L8 15l-5 6"/></svg>';
  ?>

  <section class="news-page">
    <div class="container">

      
      <header class="news-hero">
        <p class="news-hero__eyebrow">Блог · <?php echo e(config('site.domain')); ?></p>
        <h1 class="news-hero__title">Новости спецтехники и рынка аренды в Беларуси</h1>

        <nav class="news-categories" aria-label="Категории новостей">
          <a class="<?php echo \Illuminate\Support\Arr::toCssClasses(['news-categories__link', 'is-active' => !request('category') && !request('tag')]); ?>"
             href="<?php echo e(route('news.index')); ?>">Все</a>
          <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a class="<?php echo \Illuminate\Support\Arr::toCssClasses(['news-categories__link', 'is-active' => request('category') === $category]); ?>"
               href="<?php echo e(route('news.index', ['category' => $category])); ?>"><?php echo e($category); ?></a>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </nav>
      </header>

      
      <div class="news-layout">

        
        <div class="news-feed">
          <?php if($news->isEmpty()): ?>
            <p class="news-empty">В этом разделе пока нет публикаций.</p>
          <?php else: ?>
            
            <div class="news-grid">
              <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($news->onFirstPage() && $loop->first): ?>
                  
                  <a class="news-card news-card--featured" href="<?php echo e(route('news.show', $article)); ?>"
                     <?php if($article->image): ?> style="background-image:url('<?php echo e(Storage::url($article->resizeImage($article->image, 1600, 900))); ?>');" <?php endif; ?>>
                    
                    <?php if($article->image): ?>
                      <img class="news-card--featured__photo"
                           src="<?php echo e(Storage::url($article->resizeImage($article->image, 800, 500))); ?>"
                           alt="<?php echo e($article->title); ?>" loading="lazy">
                    <?php endif; ?>
                    <span class="news-card--featured__body">
                      <span class="news-card__meta">
                        <span class="news-card__date"><?php echo e($article->created_at->format('d.m.Y')); ?></span>
                        <?php if($article->category): ?><span class="news-card__category"><?php echo e($article->category); ?></span><?php endif; ?>
                      </span>
                      <h2 class="news-card--featured__title"><?php echo e($article->title); ?></h2>
                      <span class="news-card--featured__preview"><?php echo e($article->preview_text ?: Str::limit(strip_tags((string) $article->content), 180)); ?></span>
                    </span>
                  </a>
                <?php else: ?>
                  
                  <a class="news-card news-card--standard" href="<?php echo e(route('news.show', $article)); ?>">
                    <span class="news-card__media">
                      <?php if($article->image): ?>
                        <img src="<?php echo e(Storage::url($article->resizeImage($article->image, 600, 400))); ?>"
                             alt="<?php echo e($article->title); ?> — фото новости"
                             title="<?php echo e($article->title); ?> — новость о аренде и продаже спецтехники на landi.by"
                             loading="lazy">
                      <?php else: ?>
                        <span class="news-media-empty"><?php echo $empty_media; ?></span>
                      <?php endif; ?>
                    </span>
                    <span class="news-card__body">
                      <span class="news-card__meta">
                        <span class="news-card__date"><?php echo e($article->created_at->format('d.m.Y')); ?></span>
                        <?php if($article->category): ?><span class="news-card__category"><?php echo e($article->category); ?></span><?php endif; ?>
                      </span>
                      <h3 class="news-card__title"><?php echo e($article->title); ?></h3>
                      <span class="news-card__preview"><?php echo e($article->preview_text ?: Str::limit(strip_tags((string) $article->content), 140)); ?></span>
                    </span>
                  </a>
                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          <?php endif; ?>
        </div>

        
        <aside class="news-side">
          <?php if($tags): ?>
            <section class="news-side__block">
              <h2 class="news-side__title">Популярные теги</h2>
              <div class="news-tags">
                <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <a class="<?php echo \Illuminate\Support\Arr::toCssClasses(['news-tags__link', 'is-active' => request('tag') === $tag]); ?>"
                     href="<?php echo e(route('news.index', ['tag' => $tag])); ?>">#<?php echo e($tag); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </section>
          <?php endif; ?>

          <?php if($popular->isNotEmpty()): ?>
            <section class="news-side__block">
              <h2 class="news-side__title">Популярное</h2>
              <ul class="news-popular">
                <?php $__currentLoopData = $popular; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li>
                    <a class="news-popular__item" href="<?php echo e(route('news.show', $post)); ?>">
                      <span class="news-popular__title"><?php echo e($post->title); ?></span>
                      <span class="news-popular__date"><?php echo e($post->created_at->format('d.m.Y')); ?></span>
                    </a>
                  </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
            </section>
          <?php endif; ?>
        </aside>
      </div>

      
      
      <?php if($news->hasPages()): ?>
        <nav class="news-pagination" aria-label="Навигация по страницам новостей">
          <?php echo e($news->links()); ?>

        </nav>
      <?php endif; ?>

    </div>
  </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('redesign.layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /workspaces/php-mariadb/specmashina.by/resources/views/news/index.blade.php ENDPATH**/ ?>