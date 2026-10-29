<!doctype html>
<html lang="ru">
<?php
    /* Признак страниц админки и личного кабинета. На них:
         — подключается public/css/admin.css (стиль Norwegian Air);
         — выводится публичная шапка сайта <x-header /> (та же, что на главной),
           вместо легаси-шапки layouts.header;
         — на <body> ставится класс admin-area для стилей уровнем ниже.
       Все разделы администратора живут под /dashboard (см. routes/web.php),
       пользовательские — /profile и переписка /messages, /chats (im/im.blade.php).
       Важно: префиксы post*, page* не используются — по этим URL открываются
       публичные страницы (/post/{id}, /posts, /page/{id}) с легаси-шапкой. */
    $isAdminArea = request()->is('dashboard*')
        || request()->is('profile*')
        || request()->routeIs('messages', 'chat', 'chats');
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="google-site-verification" content="KPquQdARylCEK_nLx3nqzajr2qGVoHKCLwYYkQDy5uU" />
    <meta name="yandex-verification" content="63553149395c09b8" />
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <meta name="description" content="<?php echo $__env->yieldContent('description'); ?>" />
    <!-- Fonts -->

    <!-- Обязательный (и достаточный) тег для браузеров -->
    <link type="image/x-icon" rel="shortcut icon" href="/favicon.ico">

    <!-- Дополнительные иконки для десктопных браузеров -->
    <link type="image/png" sizes="16x16" rel="icon" href="/favicon-16x16.png">
    <link type="image/png" sizes="32x32" rel="icon" href="/favicon-32x32.png">
    <link type="image/png" sizes="96x96" rel="icon" href="/favicon-96x96.png">
    <link type="image/png" sizes="120x120" rel="icon" href="/favicon-120x120.png">

    <!-- Иконки для Android -->
    <link type="image/png" sizes="72x72" rel="icon" href="/android-icon-72x72.png">
    <link type="image/png" sizes="96x96" rel="icon" href="/android-icon-96x96.png">
    <link type="image/png" sizes="144x144" rel="icon" href="/android-icon-144x144.png">
    <link type="image/png" sizes="192x192" rel="icon" href="/android-icon-192x192.png">
    <link type="image/png" sizes="512x512" rel="icon" href="/android-icon-512x512.png">
    <link rel="manifest" href="/manifest.json">

    <!-- Иконки для iOS (Apple) -->
    <link sizes="57x57" rel="apple-touch-icon" href="/apple-touch-icon-57x57.png">
    <link sizes="60x60" rel="apple-touch-icon" href="/apple-touch-icon-60x60.png">
    <link sizes="72x72" rel="apple-touch-icon" href="/apple-touch-icon-72x72.png">
    <link sizes="76x76" rel="apple-touch-icon" href="/apple-touch-icon-76x76.png">
    <link sizes="114x114" rel="apple-touch-icon" href="/apple-touch-icon-114x114.png">
    <link sizes="120x120" rel="apple-touch-icon" href="/apple-touch-icon-120x120.png">
    <link sizes="144x144" rel="apple-touch-icon" href="/apple-touch-icon-144x144.png">
    <link sizes="152x152" rel="apple-touch-icon" href="/apple-touch-icon-152x152.png">
    <link sizes="180x180" rel="apple-touch-icon" href="/apple-touch-icon-180x180.png">

    <!-- Иконки для MacOS (Apple) -->
    <link color="#e52037" rel="mask-icon" href="/safari-pinned-tab.svg">

    <!-- Иконки и цвета для плиток Windows -->
    <meta name="msapplication-TileColor" content="#2b5797">
    <meta name="msapplication-TileImage" content="/mstile-144x144.png">
    <meta name="msapplication-square70x70logo" content="/mstile-70x70.png">
    <meta name="msapplication-square150x150logo" content="/mstile-150x150.png">
    <meta name="msapplication-wide310x150logo" content="/mstile-310x310.png">
    <meta name="msapplication-square310x310logo" content="/mstile-310x150.png">
    <meta name="application-name" content="Landi.by">
    <meta name="msapplication-config" content="/browserconfig.xml">
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/jquery-ui.min.css" rel="stylesheet">
    <link href="/css/LineIcons.2.0.css" rel="stylesheet">
    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/tiny-slider.css" rel="stylesheet">
    <link href="/css/glightbox.min.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <link href="/css/font-fileuploader.css" rel="stylesheet">
    <link href="/css/jquery.fileuploader.min.css" rel="stylesheet">
    <link href="/assets/css/fontawesome.css" rel="stylesheet" />
    <link href="/assets/css/brands.css" rel="stylesheet" />
    <link href="/assets/css/solid.css" rel="stylesheet" />
    <link href="/css/share-buttons.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">
<?php if($isAdminArea): ?>
    <!-- Админ-панель / личный кабинет: стиль Norwegian Air (norwegian.com).
         Подключается после main.css и переопределяет легаси-акценты #5830E0
         на фирменную палитру --norwegian-red #D92323. -->
    <link href="/css/admin.css" rel="stylesheet">
<?php endif; ?>
<!-- <?php echo app('Illuminate\Foundation\Vite')(['resources/js/app.js']); ?>-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("vendor/cookie-consent/css/cookie-consent.css")); ?>">
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/tracking/collector.js'); ?>
</head>
<?php
    $cookieRefused = isset($_COOKIE[config('cookie-consent.cookie_refuse_name')]) && $_COOKIE[config('cookie-consent.cookie_refuse_name')] == '1';
?>
<body class="<?php echo e($isAdminArea ? 'admin-area' : ''); ?>">
<?php if(!$cookieRefused): ?>
<!-- Google tag (gtag.js) -->
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-S960LS3E82"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-S960LS3E82');
</script>
<?php endif; ?>
<?php if($isAdminArea): ?>
    
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
<?php else: ?>
    <?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endif; ?>


<?php echo $__env->make('breadcrumbs', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<main>


    <?php echo $__env->yieldContent('main'); ?>
</main>
<?php if($isAdminArea): ?>
    
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

    
    <?php echo $__env->yieldContent('dashboard_bottom_nav'); ?>
<?php else: ?>
<footer class="footer">
    <!-- Start Footer Top -->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer mobile-app">
                       
                        <ul>
                            <li>
                                Зарегистрирован в реестре рекламораспространителей под номером 4682
                            </li>
                        </ul>
                    </div>
                    <!-- End Single Widget -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer f-link">
                        <h3>Города</h3>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <ul>
                                    <?php (
    $bbs_city = App\Models\Location::withCount([
                'bbs' => function (Illuminate\Database\Eloquent\Builder $query) {
                    $query->where('active', 'Y');
                },
            ])->where('level',1)->orderBy('bbs_count','desc')->limit(10)->get()
); ?>
                                    <?php $__currentLoopData = $bbs_city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($key<5): ?>
                                        <li><a href="<?php echo e(route('location',$city->id)); ?>"><?php echo e($city->title); ?></a></li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <ul>
                                    <?php $__currentLoopData = $bbs_city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($key>4): ?>
                                            <li><a href="<?php echo e(route('location',$city->id)); ?>"><?php echo e($city->title); ?></a></li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Widget -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer f-link">
                        <h3>Популярное</h3>
                        <ul>
                            <li><a href="<?php echo e(route('rubric',1000)); ?>">Аренда техники</a></li>
                            <li><a href="<?php echo e(route('rubric',2000)); ?>">Продажа техники</a></li>
                            <li><a href="<?php echo e(route('organizations')); ?>">Организации</a></li>
                            <li><a href="<?php echo e(route('posts')); ?>">Новости</a></li>
                            <li><a href="<?php echo e(route('dashboard')); ?>">Регистрация</a></li>
                        </ul>
                    </div>
                    <!-- End Single Widget -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer f-contact">
                        <h3>Контакты</h3>
                        <ul>
                            <li>ООО "Терва"<br>УНП 391747684</li>
                            <li>ул. Московская, 1/3 корп.А<br> Орша, Витебская область</li>
                            <li>Tel. +375 (29) 116-66-00 <br> Mail. support@landi.by</li>
                        </ul>
                    </div>
                    <!-- End Single Widget -->
                </div>
            </div>
        </div>
    </div>
    <!--/ End Footer Middle -->
    <!-- Start Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="inner">
                <div class="row">
                    <div class="col-12">
                        <div class="content">
                            <ul class="footer-bottom-links">
                                <li><a href="https://landi.by/page/1">ПОЛЬЗОВАТЕЛЬСКОЕ СОГЛАШЕНИЕ</a></li>
                                <li><a href="https://landi.by/page/2">ПОЛИТИКА ОБРАБОТКИ ПЕРСОНАЛЬНЫХ ДАННЫХ</a></li>
                                <li><a href="javascript:void(0)">Публичная оферта</a></li>
                                <li><a href="javascript:void(0)">Карта сайта</a></li>
                                <li><a href="javascript:void(0)">О нас</a></li>
                                <li><a href="javascript:void(0)" class="cookie-settings-link" onclick="return false;">Настройки куки</a></li>
                            </ul>
                            <p class="copyright-text"><a href="/">Landi.by - Портал объявлений об аренде и продаже строительной техники и инструмента</a>
                            </p>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Middle -->
</footer>
<?php endif; ?>
<!-- ========================= scroll-top ========================= -->
<a href="#" class="scroll-top btn-hover">
    <i class="lni lni-chevron-up"></i>
</a>
<div class="toast-container"></div>

</body>
<?php if(Request::routeIs(['post_add','post_dashboard','page_add','page_dashboard'])): ?>
<script src="/assets/vendor/ckeditor5/build/ckeditor.js"></script>
    <script type="text/javascript" src="/js/ckfinder/ckfinder.js"></script>
<script>CKFinder.config( { connectorPath: '/ckfinder/connector' } );</script>

<?php endif; ?>
    <script type="text/javascript" src="/js/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/js/jquery.fileuploader.min.js"></script>
    <script type="text/javascript" src="/js/jquery.maskedinput.js"></script>
    <script type="text/javascript" src="/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="/js/tiny-slider.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="/js/custom.js"></script>


<?php if(Auth::user()): ?>
<script>
/*    window.addEventListener("load", function(){
        Pusher.logToConsole = true;

        var pusher = new Pusher('b52b7d79e679a85bb93f', {
            cluster: 'eu'
        });

        var channel = pusher.subscribe('user.<?php echo e(Auth::id()); ?>');
        channel.bind('my-event', function(data) {
            //alert(JSON.stringify(data));
            var arr = $.parseJSON(JSON.stringify(data));
            //console.log( typeof arr.user)
            newNotificate(arr.category,arr.message,arr.user1,<?php echo e(Auth::id()); ?>)




            });

        let _url     = `/chats`;
        let _token   = $('meta[name="csrf-token"]').attr('content');
        $.get( _url, function( data ) {
            $( '.all_chats' ).html( data );
        })


    });*/



</script>

<!-- Yandex.Metrika counter -->
<?php if(!$cookieRefused): ?>
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();
        for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
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
<!-- /Yandex.Metrika counter -->
<?php endif; ?>
    <?php endif; ?>

</html>
<?php /**PATH /workspaces/php-mariadb/specmashina.by/resources/views/layouts/base.blade.php ENDPATH**/ ?>