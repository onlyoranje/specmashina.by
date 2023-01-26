<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    @vite(['resources/js/app.js'])

</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item"  href="{{route('mybb')}}">Dashboard</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <nav class="nav">
            <a class="nav-link" href="{{route('mybb')}}"> Мои объявления</a>
            <a class="nav-link">Моя организация</a>
            <a href="{{route('location_dashboard')}}" class="nav-link">Список городов</a>
            <a href="{{route('rubric_dashboard')}}" class="nav-link"> Список категорий</a>
        </nav>
        @yield('main')
    </main>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        // enable fileuploader plugin
        $('input[name="file"]').fileuploader({
            limit: 20,
            maxSize: 50,

            changeInput: '<div class="fileuploader-input">' +
                '<div class="fileuploader-input-inner">' +
                '<div class="fileuploader-icon-main"></div>' +
                '<h3 class="fileuploader-input-caption"><span>1</span></h3>' +
                '<p>2</p>' +
                '<button type="button" class="fileuploader-input-button"><span>3</span></button>' +
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
</body>


<!-- Turn all file input elements into ponds -->

</html>
