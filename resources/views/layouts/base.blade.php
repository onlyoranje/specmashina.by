<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="KPquQdARylCEK_nLx3nqzajr2qGVoHKCLwYYkQDy5uU" />
    <meta name="yandex-verification" content="63553149395c09b8" />
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')" />
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
   <!-- @vite(['resources/js/app.js'])-->
    <link rel="stylesheet" type="text/css" href="{{asset("vendor/cookie-consent/css/cookie-consent.css")}}">
</head>
<body>
<!-- Google tag (gtag.js) -->
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-S960LS3E82"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-S960LS3E82');
</script>
@include('layouts.header')
<main>


    @yield('main')
</main>
<footer class="footer">
    <!-- Start Footer Top -->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer mobile-app">
                       {{-- <h3>Приложения (в разработке)</h3>
                        <div class="app-button">
                            <a href="javascript:void(0)" class="btn">
                                <i class="lni lni-play-store"></i>
                                <span class="text">
                                        <span class="small-text">Скачать с</span>
                                        Google Play
                                    </span>
                            </a>
                            <a href="javascript:void(0)" class="btn">
                                <i class="lni lni-apple"></i>
                                <span class="text">
                                        <span class="small-text">Скачать с</span>
                                        App Store
                                    </span>
                            </a>
                        </div>--}}
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
                                    @php(
    $bbs_city = App\Models\Location::withCount([
                'bbs' => function (Illuminate\Database\Eloquent\Builder $query) {
                    $query->where('active', 'Y');
                },
            ])->where('level',1)->orderBy('bbs_count','desc')->limit(10)->get()
)
                                    @foreach($bbs_city as $key=>$city)
                                        @if ($key<5)
                                        <li><a href="{{route('location',$city->id)}}">{{$city->title}}</a></li>
                                        @endif
                                    @endforeach

                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <ul>
                                    @foreach($bbs_city as $key=>$city)
                                        @if ($key>4)
                                            <li><a href="{{route('location',$city->id)}}">{{$city->title}}</a></li>
                                        @endif
                                    @endforeach
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
                            <li><a href="{{route('rubric',1)}}">Аренда техники</a></li>
                            <li><a href="{{route('rubric',118)}}">Продажа техники</a></li>
                            <li><a href="{{route('organizations')}}">Организации</a></li>
                            <li><a href="{{route('posts')}}">Новости</a></li>
                            <li><a href="{{route('dashboard')}}">Регистрация</a></li>
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
                                <li><a href="javascript:void(0)">Условия использования</a></li>
                                <li><a href="javascript:void(0)">Политика безопасности</a></li>
                                <li><a href="javascript:void(0)">Публичная оферта</a></li>
                                <li><a href="javascript:void(0)">Карта сайта</a></li>
                                <li><a href="javascript:void(0)">О нас</a></li>
                            </ul>
                            <p class="copyright-text"><a href="/">Landi.by - Портал объявлений об аренде и продаже строительной техники и инструмента</a>
                            </p>
                           {{-- <ul class="footer-social">
                                <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-youtube"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-linkedin-original"></i></a></li>

                            </ul>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Middle -->
</footer>
<!-- ========================= scroll-top ========================= -->
<a href="#" class="scroll-top btn-hover">
    <i class="lni lni-chevron-up"></i>
</a>
<div class="toast-container"></div>

@include('cookie-consent::index')
</body>
@if (Request::routeIs(['post_add','post_dashboard']))
<script src="/assets/vendor/ckeditor5/build/ckeditor.js"></script>
    <script type="text/javascript" src="/js/ckfinder/ckfinder.js"></script>
<script>CKFinder.config( { connectorPath: '/ckfinder/connector' } );</script>

@endif
    <script type="text/javascript" src="/js/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/js/jquery.fileuploader.min.js"></script>
    <script type="text/javascript" src="/js/jquery.maskedinput.js"></script>
    <script type="text/javascript" src="/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="/js/tiny-slider.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="/js/custom.js"></script>


@if (Auth::user())
<script>
/*    window.addEventListener("load", function(){
        Pusher.logToConsole = true;

        var pusher = new Pusher('b52b7d79e679a85bb93f', {
            cluster: 'eu'
        });

        var channel = pusher.subscribe('user.{{Auth::id()}}');
        channel.bind('my-event', function(data) {
            //alert(JSON.stringify(data));
            var arr = $.parseJSON(JSON.stringify(data));
            //console.log( typeof arr.user)
            newNotificate(arr.category,arr.message,arr.user1,{{Auth::id()}})




            });

        let _url     = `/chats`;
        let _token   = $('meta[name="csrf-token"]').attr('content');
        $.get( _url, function( data ) {
            $( '.all_chats' ).html( data );
        })


    });*/



</script>

<!-- Yandex.Metrika counter -->
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
    @endif

</html>
