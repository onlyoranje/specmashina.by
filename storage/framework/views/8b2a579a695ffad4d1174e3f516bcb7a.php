
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#D92323">
  
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <title><?php echo $__env->yieldContent('title', config('site.name') . ' — аренда и продажа строительной техники в Беларуси'); ?></title>
  <meta name="description" content="<?php echo $__env->yieldContent('description', 'landi.by — открытая площадка объявлений аренды и продажи строительной спецтехники в Беларуси. Сотни объявлений от собственников в одном месте, бесплатное размещение, поиск по городам и категориям машин.'); ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('favicon-32x32.png')); ?>">

  
  <link rel="canonical" href="<?php echo $__env->yieldContent('canonical', url()->current()); ?>">

  <!-- SEO: meta keywords (несколько тегов для разных поисковиков) -->
  <meta name="keywords" content="<?php echo $__env->yieldContent('keywords', 'аренда спецтехники, продажа спецтехники, строительная техника,Landi.by, спецтехника Беларусь, аренда экскаваторов, погрузчики, краны, самосвалы, землеройка, бульдозеры, буровое оборудование, спецтехника в Минске, спецтехника в Гродно, спецтехника в Витебске, спецтехника в Гомеле, сараны, земляные работы, техника для строительства'); ?>">

  
  <meta property="og:type" content="<?php echo $__env->yieldContent('og_type', 'website'); ?>">
  <meta property="og:site_name" content="<?php echo e(config('site.name', 'LANDI.BY')); ?>">
  <meta property="og:title" content="<?php echo $__env->yieldContent('og_title', trim($__env->yieldContent('title'))); ?>">
  <meta property="og:description" content="<?php echo $__env->yieldContent('description', 'landi.by — открытая площадка объявлений аренды и продажи строительной спецтехники в Беларуси.'); ?>">
  <meta property="og:url" content="<?php echo e(url()->current()); ?>">
  <meta property="og:locale" content="ru_RU">
  <?php if (! empty(trim($__env->yieldContent('og_image')))): ?>
  <meta property="og:image" content="<?php echo e(url($__env->yieldContent('og_image'))); ?>">
  <meta name="twitter:image" content="<?php echo e(url($__env->yieldContent('og_image'))); ?>">
  <?php endif; ?>
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?php echo $__env->yieldContent('og_title', trim($__env->yieldContent('title'))); ?>">
  <meta name="twitter:description" content="<?php echo $__env->yieldContent('description', 'landi.by — открытая площадка объявлений аренды и продажи строительной спецтехники в Беларуси.'); ?>">
  <!-- SEO: structured data (Organization + WebSite) -->
  <script type="application/ld+json">
  <?php echo $__env->make('redesign.components.seo.schemas.organization', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  </script>
  <script type="application/ld+json">
  <?php echo $__env->make('redesign.components.seo.schemas.website', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  </script>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  
  <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset("vendor/cookie-consent/css/cookie-consent.css")); ?>">
  <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body <?php $cookieRefused = isset($_COOKIE[config('cookie-consent.cookie_refuse_name')]) && $_COOKIE[config('cookie-consent.cookie_refuse_name')] == '1'; ?>>

  <?php if (isset($component)) { $__componentOriginalfd1f218809a441e923395fcbf03e4272 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfd1f218809a441e923395fcbf03e4272 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.header','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfd1f218809a441e923395fcbf03e4272)): ?>
<?php $attributes = $__attributesOriginalfd1f218809a441e923395fcbf03e4272; ?>
<?php unset($__attributesOriginalfd1f218809a441e923395fcbf03e4272); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfd1f218809a441e923395fcbf03e4272)): ?>
<?php $component = $__componentOriginalfd1f218809a441e923395fcbf03e4272; ?>
<?php unset($__componentOriginalfd1f218809a441e923395fcbf03e4272); ?>
<?php endif; ?>

  
  <main>
    <?php $breadcrumbs ??= []; ?>
    <?php if(! empty($breadcrumbs) && is_array($breadcrumbs) && isset($breadcrumbs['list']) && is_array($breadcrumbs['list'])): ?>
        <?php echo $__env->make('redesign.components.seo.schemas.breadcrumb', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endif; ?>

    <?php echo $__env->yieldContent('content'); ?>
  </main>

  <?php if (isset($component)) { $__componentOriginal8a8716efb3c62a45938aca52e78e0322 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8a8716efb3c62a45938aca52e78e0322 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8a8716efb3c62a45938aca52e78e0322)): ?>
<?php $attributes = $__attributesOriginal8a8716efb3c62a45938aca52e78e0322; ?>
<?php unset($__attributesOriginal8a8716efb3c62a45938aca52e78e0322); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8a8716efb3c62a45938aca52e78e0322)): ?>
<?php $component = $__componentOriginal8a8716efb3c62a45938aca52e78e0322; ?>
<?php unset($__componentOriginal8a8716efb3c62a45938aca52e78e0322); ?>
<?php endif; ?>

  
  <?php echo $__env->yieldPushContent('scripts'); ?>

  
  <?php if(!$cookieRefused): ?>
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-S960LS3E82"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-S960LS3E82');
  </script>
  <?php endif; ?>

  
  <?php if(!$cookieRefused): ?>
  <script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();
        for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return: }}
        k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(98791848, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
    });
  </script>
  <noscript><div><img src="https://mc.yandex.ru/watch/98791848" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
  <?php endif; ?>

</body>
</html>
<?php /**PATH /workspaces/php-mariadb/specmashina.by/resources/views/redesign/layouts/base.blade.php ENDPATH**/ ?>