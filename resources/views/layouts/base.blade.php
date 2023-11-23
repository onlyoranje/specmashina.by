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
 
    @vite(['resources/js/app.js'])

</head>
<body>
@include('layouts.header')
<main>


    @yield('main')
</main>
<footer class="footer pt-6 pb-5 bg-dark text-white">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img class="navbar-brand-dark mb-4" height="35" src="../../assets/img/brand/light.svg"
                     alt="Logo light">
                <p>Pixel is a free and open source Bootstrap 5 UI Kit that will help you prototype and build beautiful
                    website pages and applications.</p>
                <ul class="social-buttons mb-5 mb-lg-0">
                    <li>
                        <a href="https://twitter.com/themesberg" aria-label="twitter social link"
                           class="icon-white me-2">
                            <span class="fab fa-twitter"></span>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.facebook.com/themesberg/" class="icon-white me-2"
                           aria-label="facebook social link">
                            <span class="fab fa-facebook"></span>
                        </a>
                    </li>
                    <li>
                        <a href="https://github.com/themesberg" aria-label="github social link" class="icon-white me-2">
                            <span class="fab fa-github"></span>
                        </a>
                    </li>
                    <li>
                        <a href="https://dribbble.com/themesberg" class="icon-white" aria-label="dribbble social link">
                            <span class="fab fa-dribbble"></span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-6 col-md-2 mb-5 mb-lg-0">
                <span class="h5">Themesberg</span>
                <ul class="footer-links mt-2">
                    <li><a target="_blank" href="https://themesberg.com/blog">Blog</a></li>
                    <li><a target="_blank" href="https://themesberg.com/themes">Themes</a></li>
                    <li><a target="_blank" href="https://themesberg.com/about">About Us</a></li>
                    <li><a target="_blank" href="https://themesberg.com/contact">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-6 col-md-2 mb-5 mb-lg-0">
                <span class="h5">Other</span>
                <ul class="footer-links mt-2">
                    <li><a href="https://themesberg.com/docs/bootstrap-5/pixel/getting-started/quick-start/"
                           target="_blank">Docs</a></li>
                    <li><a href="https://themesberg.com/docs/pixel-bootstrap/getting-started/changelog"
                           target="_blank">Changelog</a></li>
                    <li><a target="_blank" href="https://themesberg.com/licensing">License</a>
                    </li>
                    <li><a target="_blank"
                           href="https://github.com/themesberg/pixel-bootstrap-ui-kit/issues">Support</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-4 mb-5 mb-lg-0">
                <span class="h5">Subscribe</span>
                <p class="text-muted font-small mt-2">Join our mailing list. We write rarely, but only the best content.
                </p>
                <form action="#">
                    <div class="form-row mb-2">
                        <div class="col-12">
                            <label class="h6 fw-normal text-muted d-none" for="exampleInputEmail3">Email address</label>
                            <input type="email" class="form-control mb-2" placeholder="example@company.com" name="email"
                                   aria-label="Subscribe form" id="exampleInputEmail3" required>
                        </div>
                        <div class="col-12 d-grid">
                            <button type="submit" class="btn btn-tertiary" data-loading-text="Sending">
                                <span>Subscribe</span>
                            </button>
                        </div>
                    </div>
                </form>
                <p class="text-muted font-small m-0">We’ll never share your details. See our <a class="text-white"
                                                                                                href="#">Privacy
                        Policy</a></p>
            </div>
        </div>
        <hr class="bg-secondary my-3 my-lg-5">
        <div class="row">
            <div class="col mb-md-0">
                <a href="https://themesberg.com" target="_blank" class="d-flex justify-content-center mb-3">
                    <img src="../../assets/img/themesberg.svg" height="30" class="me-2" alt="Themesberg Logo">
                    <p class="text-white fw-bold footer-logo-text m-0">Themesberg</p>
                </a>
                <div class="d-flex text-center justify-content-center align-items-center" role="contentinfo">
                    <p class="fw-normal font-small mb-0">Copyright © Themesberg 2019-<span
                            class="current-year">2021</span>. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<script type="text/javascript">
    $(document).ready(function () {

        // enable fileuploader plugin
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
                onItemShow: function (item) {
                    // add sorter button to the item html
                    item.html.find('.fileuploader-action-remove').before('<div class="fileuploader-action fileuploader-action-sort" title="Sort"><i class="fileuploader-icon-sort"></i></div>');
                },
                // Callback fired after removing the item element
                // by default we will animate the removing action
                onItemRemove: function (html) {
                    html.children().animate({'opacity': 0}, 200, function () {
                        setTimeout(function () {
                            html.slideUp(200, function () {
                                html.remove();
                            });
                        }, 100);
                    });
                },

                // Callback fired after the item image was loaded or a image file is invalid
                // default - null
                onImageLoaded: function (item, listEl, parentEl, newInputEl, inputEl) {
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
                    template: function (data) {
                        return '<div class="fileuploader-popup-preview">' +
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
                                    '<a href="' + data.file + '" data-action target="_blank">' +
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
                            '</div>';
                    },

                    // Callback fired after creating the popup
                    // we will trigger by default buttons with custom actions
                    onShow: function (item) {
                        item.popup.html.on('click', '[data-action="remove"]', function (e) {
                            item.popup.close();
                            item.remove();
                        }).on('click', '[data-action="cancel"]', function (e) {
                            item.popup.close();
                        }).on('click', '[data-action="save"]', function (e) {
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
                onSort: function (list, listEl, parentEl, newInputEl, inputEl) {
                    // onSort callback
                }
            }
        });

    });
</script>
</body>


<!-- Turn all file input elements into ponds -->

</html>
