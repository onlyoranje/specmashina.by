@extends('layouts.base')
@section('title', 'Главная')

@section('main')



<script type="text/javascript">
   window.addEventListener("load", function(){

        // enable fileuploader plugin**
        $('input[name="file"]').fileuploader({
            limit: 20,
            maxSize: 50,

            changeInput: '<div class="fileuploader-input">' +
                '<div class="fileuploader-input-inner">' +
                '<div class="fileuploader-icon-main"></div>' +
                '<h3 class="fileuploader-input-caption"><span>Нет фото</span></h3>' +
                '<p>Перетащите фото сюда</p>' +
                '<button type="button" class="fileuploader-input-button"><span>загрузить фото</span></button>' +
                '</div>' +
                '</div>',
            theme: 'thumbnails',
            addMore: true,
            //            thumbnails: {
            //                onItemShow: function(item) {
            //                    // add sorter button to the item html
            //                    item.html.find('.fileuploader-action-remove').before('<button type="button" class="fileuploader-action fileuploader-action-sort" title="Sort"><i class="fileuploader-icon-sort"></i></button>');
            //                }
            //            },
            thumbnails: {
                // thumbnails list HTML {String, Function}
                // example: '<ul></ul>'
                // example: function(options) { return '<ul></ul>'; }
                box: '<div class="fileuploader-items">' +
                    '<ul class="fileuploader-items-list row"></ul>' +
                    '</div>',

                // append thumbnails list to selector {null, String, jQuery Object}
                // example: 'body'
                boxAppendTo: null,

                // thumbnails for the choosen files {String, Function}
                // example: '<li>${name}</li>'
                // example: function(item) { return '<li>' + item.name + '</li>'; }
                item: '<li class="fileuploader-item">' +
                    '<div class="fileuploader-item-inner">' +
                    '<div class="type-holder">${extension}</div>' +
                    '<div class="actions-holder">' +
                    '<button type="button" class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="fileuploader-icon-remove"></i></button>' +
                    '</div>' +
                    '<div class="thumbnail-holder">' +
                    '${image}' +
                    '<span class="fileuploader-action-popup"></span>' +
                    '</div>' +
                    '<div class="content-holder"><h5>${name}</h5><span>${size2}</span></div>' +
                    '<div class="progress-holder">${progressBar}</div>' +
                    '</div>' +
                    '</li>',

                // thumbnails for the preloaded files {String, Function}
                // example: '<li>${name}</li>'
                // example: function(item) { return '<li>' + item.name + '</li>'; }
                item2: '<li class="fileuploader-item">' +
                    '<div class="fileuploader-item-inner">' +
                    '<div class="type-holder">${extension}</div>' +
                    '<div class="actions-holder">' +
                    '<a href="${file}" class="fileuploader-action fileuploader-action-download" title="${captions.download}" download><i class="fileuploader-icon-download"></i></a>' +
                    '<div type="button" class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="fileuploader-icon-remove"></i></div>' +
                    '</div>' +
                    '<div class="thumbnail-holder">' +
                    '${image}' +
                    '<span class="fileuploader-action-popup"></span>' +
                    '</div>' +
                    '<div class="content-holder"><h5 title="${name}">${name}</h5><span>${size2}</span></div>' +
                    '<div class="progress-holder">${progressBar}</div>' +
                    '</div>' +
                    '</li>',

                // thumbnails selectors
                _selectors: {
                    list: '.fileuploader-items-list',
                    item: '.fileuploader-item',
                    start: '.fileuploader-action-start',
                    retry: '.fileuploader-action-retry',
                    remove: '.fileuploader-action-remove',
                    sorter: '.fileuploader-action-sort',
                    popup: '.fileuploader-popup-preview',
                    popup_open: '.fileuploader-action-popup'
                },

                // insert the thumbnail's item at the begining of the list? {Boolean}
                itemPrepend: false,

                // show a confirmation dialog by removing a file? {Boolean}
                // it will not be shown in upload mode by canceling an upload
                // you can call your own dialog box using dialogs option
                removeConfirmation: true,

                // render the image thumbnail? {Boolean}
                // if false, it will generate an icon(you can also hide it with css)
                // if false, you can use the API method item.renderThumbnail() to render it (check thumbnails example)
                startImageRenderer: true,

                // render the images synchron {Boolean}
                // used to improve the browser speed
                synchronImages: true,

                // read image using URL createObjectURL method {Boolean}
                // if false, it will use readAsDataURL
                useObjectUrl: false,

                // render the image in a canvas element {Boolean, Object}
                // if true, it will generate an image with the css sizes from the parent element of ${image}
                // you can also set the width and the height in the object {width: 96, height: 96}
                canvasImage: true,

                // render thumbnail for video files? {Boolean}
                videoThumbnail: false,

                // fix exif orientation {Boolean}
                exif: true,

                // Callback fired before adding the list element
                beforeShow: null,

                // Callback fired after adding the item element
                onItemShow: function(item) {
                    // add sorter button to the item html
                    item.html.find('.fileuploader-action-remove').before('<div class="fileuploader-action fileuploader-action-sort" title="Sort"><i class="fileuploader-icon-sort"></i></div>');
                },
                // Callback fired after removing the item element
                // by default we will animate the removing action
                onItemRemove: function(html) {
                    html.children().animate({'opacity': 0}, 200, function() {
                        setTimeout(function() {
                            html.slideUp(200, function() {
                                html.remove();
                            });
                        }, 100);
                    });
                },

                // Callback fired after the item image was loaded or a image file is invalid
                // default - null
                onImageLoaded: function(item, listEl, parentEl, newInputEl, inputEl) {
                    // invalid image?
                    if (item.image.hasClass('fileuploader-no-thumbnail')) {
                        // callback goes here
                    }

                    // check image size and ratio?
                    if (item.reader.node && item.reader.width > 1920 && item.reader.height > 1080 && item.reader.ratio != '16:9') {
                        // callback goes here
                    }
                },

                // item popup preview {Object}
                popup: {
                    // popup append to container {String, jQuery Object}
                    container: 'body',

                    // enable arrows {Boolean}
                    arrows: true,

                    // loop the arrows {Boolean}
                    loop: true,

                    // popup HTML {String, Function}
                    template: function(data) { return '<div class="fileuploader-popup-preview">' +
                        '<div class="fileuploader-popup-move" data-action="prev"><i class="fileuploader-icon-arrow-left"></i></div>' +
                        '<div class="fileuploader-popup-node ${format}">' +
                        '${reader.node}' +
                        '</div>' +
                        '<div class="fileuploader-popup-content">' +
                        '<div class="fileuploader-popup-footer">' +
                        '<ul class="fileuploader-popup-tools">' +
                        (data.format == 'image' && data.reader.node && data.editor ? (data.editor.cropper ? '<li>' +
                                '<div data-action="crop">' +
                                '<i class="fileuploader-icon-crop"></i> ${captions.crop}' +
                                '</div>' +
                                '</li>' : '') +
                                (data.editor.rotate ? '<li>' +
                                    '<div data-action="rotate-cw">' +
                                    '<i class="fileuploader-icon-rotate"></i> ${captions.rotate}' +
                                    '</div>' +
                                    '</li>' : '') : ''
                        ) +
                        (data.format == 'image' ?
                                '<li class="fileuploader-popup-zoomer">' +
                                '<div data-action="zoom-out">&minus;</div>' +
                                '<input type="range" min="0" max="100">' +
                                '<div data-action="zoom-in">&plus;</div>' +
                                '<span></span> ' +
                                '</li>' : ''
                        ) +
                        (data.data.url ? '<li>' +
                                '<a href="'+ data.file +'" data-action target="_blank">' +
                                '<i class="fileuploader-icon-external"></i> ${captions.open}' +
                                '</a>' +
                                '</li>' : ''
                        ) +
                        '<li>' +
                        '<div data-action="remove">' +
                        '<i class="fileuploader-icon-trash"></i> ${captions.remove}' +
                        '</div>' +
                        '</li>' +
                        '</ul>' +
                        '</div>' +
                        '<div class="fileuploader-popup-header">' +
                        '<ul class="fileuploader-popup-meta">' +
                        '<li>' +
                        '<span>${captions.name}:</span>' +
                        '<h5>${name}</h5>' +
                        '</li>' +
                        '<li>' +
                        '<span>${captions.type}:</span>' +
                        '<h5>${extension.toUpperCase()}</h5>' +
                        '</li>' +
                        '<li>' +
                        '<span>${captions.size}:</span>' +
                        '<h5>${size2}</h5>' +
                        '</li>' +
                        (data.reader && data.reader.width ? '<li>' +
                                '<span>${captions.dimensions}:</span>' +
                                '<h5>${reader.width}x${reader.height}px</h5>' +
                                '</li>' : ''
                        ) +
                        (data.reader && data.reader.duration ? '<li>' +
                                '<span>${captions.duration}:</span>' +
                                '<h5>${reader.duration2}</h5>' +
                                '</li>' : ''
                        ) +
                        '</ul>' +
                        '<div class="fileuploader-popup-info"></div>' +
                        '<ul class="fileuploader-popup-buttons">' +
                        '<li><div class="fileuploader-popup-button" data-action="cancel">${captions.cancel}</a></li>' +
                        (data.editor ? '<li><div class="fileuploader-popup-button button-success" data-action="save">${captions.confirm}</div></li>' : ''
                        ) +
                        '</ul>' +
                        '</div>' +
                        '</div>' +
                        '<div class="fileuploader-popup-move" data-action="next"><i class="fileuploader-icon-arrow-right"></i></div>' +
                        '</div>'; },

                    // Callback fired after creating the popup
                    // we will trigger by default buttons with custom actions
                    onShow: function(item) {
                        item.popup.html.on('click', '[data-action="remove"]', function(e) {
                            item.popup.close();
                            item.remove();
                        }).on('click', '[data-action="cancel"]', function(e) {
                            item.popup.close();
                        }).on('click', '[data-action="save"]', function(e) {
                            if (item.editor)
                                item.editor.save();
                            if (item.popup.close)
                                item.popup.close();
                        });
                    },

                    // Callback fired after closing the popup
                    onHide: null
                }
            },

            sorter: {
                selectorExclude: null,
                placeholder: null,
                scrollContainer: window,
                onSort: function(list, listEl, parentEl, newInputEl, inputEl) {
                    // onSort callback
                }
            }
        });

    });
</script>
@endsection('main')

{{-- ==========================================================================
     НИЖНЯЯ ПАНЕЛЬ НАВИГАЦИИ ЛИЧНОГО КАБИНЕТА (мобильные экраны)

     Объявлена здесь, в макете кабинета, и выводится в layouts/base.blade.php
     через @yield('dashboard_bottom_nav') — так разметка одна для всех страниц
     /dashboard* и /profile, а на публичных страницах панели нет.

     Раскладка:
       — десктоп: панель скрыта (display:none), работает сайдбар
                  layouts/dashboard_profile.blade.php;
       — ≤768px:  сайдбар скрывается, а навигация переезжает в фиксированную
                  нижнюю панель с горизонтальным скроллом.
     CSS: public/css/admin.css, раздел 20.
     ========================================================================== --}}
@section('dashboard_bottom_nav')
    @auth
        @php
            /* Пункты панели: [маршрут, подпись, иконка, активные маршруты].
               Порядок = порядок на экране: сначала пользовательские разделы,
               затем (у админа) администрирование, в конце — выход. */
            $bottom_nav_items = [
                ['dashboard',        'Дашборд',     'fa-gauge',         ['dashboard']],
                ['mybb',             'Объявления',  'fa-clone',         ['mybb', 'bb_edit']],
                ['addForm',          'Добавить',    'fa-plus',          ['addForm']],
                ['profile.edit',     'Профиль',     'fa-user',          ['profile.edit']],
                ['alerts',           'Уведомления', 'fa-bell',          ['alerts']],
                ['my_organization',  'Организация', 'fa-building',      ['my_organization']],
                ['favorite',         'Закладки',    'fa-bookmark',      ['favorite']],
            ];

            /* На мобильных сайдбар скрыт, поэтому разделы администрирования
               дублируются в той же прокручиваемой полосе — иначе к ним не
               было бы доступа с телефона. */
            if (Auth::user()->isAdmin()) {
                $bottom_nav_items = array_merge($bottom_nav_items, [
                    ['admin_dashboard',         'Админ',      'fa-gauge-high',    ['admin_dashboard']],
                    ['allbb',                   'Все объяв.', 'fa-clone',         ['allbb']],
                    ['allusers',                'Пользователи', 'fa-users',      ['allusers']],
                    ['allorganizations',        'Организации', 'fa-building',    ['allorganizations']],
                    ['location_dashboard',      'Города',     'fa-mountain-city', ['location_dashboard']],
                    ['rubric_dashboard',        'Категории',  'fa-folder-tree',  ['rubric_dashboard']],
                    ['parameter_dashboard',     'Параметры',  'fa-list',         ['parameter_dashboard']],
                    ['parameter_type_dashboard','Типы парам.', 'fa-list-check',  ['parameter_type_dashboard']],
                    ['vendor_dashboard',        'Бренды',     'fa-copyright',    ['vendor_dashboard']],
                    ['price_type_dashboard',    'Виды цен',   'fa-tag',          ['price_type_dashboard']],
                    ['contact_type_dashboard',  'Контакты',   'fa-id-badge',     ['contact_type_dashboard']],
                    ['status_dashboard',        'Статусы',    'fa-star',         ['status_dashboard']],
                    ['posts_dashboard',         'Новости',    'fa-newspaper',    ['posts_dashboard']],
                    ['pages_dashboard',         'Страницы',   'fa-file-lines',   ['pages_dashboard']],
                    ['banners_dashboard',       'Баннеры',    'fa-rectangle-ad', ['banners_dashboard']],
                ]);
            }

            $bottom_nav_unread = Auth::user()->countAlerts();
        @endphp

        <nav class="dashboard-bottom-nav" aria-label="Навигация личного кабинета">
            @foreach ($bottom_nav_items as [$nav_route, $nav_label, $nav_icon, $nav_active])
                <a class="dashboard-bottom-nav__item {{ Request::routeIs($nav_active) ? 'active' : '' }}"
                   href="{{ route($nav_route) }}">
                    <i class="fa-solid {{ $nav_icon }}" aria-hidden="true"></i>
                    <span>{{ $nav_label }}</span>
                    @if ($nav_route === 'alerts' and $bottom_nav_unread > 0)
                        <span class="dashboard-bottom-nav__count">{{ $bottom_nav_unread }}</span>
                    @endif
                </a>
            @endforeach

            <a class="dashboard-bottom-nav__item dashboard-bottom-nav__item--logout" href="{{ route('logout') }}">
                <i class="fa-solid fa-right-from-bracket" aria-hidden="true"></i>
                <span>Выход</span>
            </a>
        </nav>
    @endauth
@endsection

