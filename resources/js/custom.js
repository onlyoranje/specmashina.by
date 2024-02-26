window.NewSelect = function (model, parent_id = null, level = 0, id = null, selected = false) {
    /*console.log('model:'+model);
    console.log('parent_id:'+parent_id);
    console.log('level:'+level);
    console.log('id:'+id);
    console.log('selected:'+selected);
    console.log('-----');*/
    var json

    var child_cat = 0;
    if (model === 'rubric') json = json_rubric;
    if (model === 'location') json = json_location;
    $.each(json, function (key, data) {
            if (parent_id == data['parent_id']) {
                child_cat++
            }
        }
    )
    if (level) $("#container_"+model+"_"+(level+1)).remove();
    $('#log').text("child_cat:" + child_cat + " parent_id:" + parent_id + " level:" + level)
    if (level > 0 && child_cat === 0) {
        $("#" + model + "_level_" + level).remove()
    }
    if (child_cat > 0) {
        var sel = $("#container_" + model + "_" + (level)).html("<div class='selector-head'><span class='arrow'><i class='lni lni-chevron-down'></i></span><select class=\"form-select mb-3\" name='" + model + "_id' id='" + model + "_level_" + level + "' onchange= \"NewSelect('" + model + "',this.value," + (level + 1) + ")\"></select></div>");
        $("#container_" + model + "_" + (level)).append($("<div id='container_" + model + "_" + (level + 1) + "' class='container_" + model + "'></div>"))
        if (id) {
            $("#" + model + "_level_" + level).append('<option disabled>- выбрать -</option>');
        } else {
            $("#" + model + "_level_" + level).append('<option disabled selected="selected">- выбрать -</option>');
        }

        $("#" + model + "_level_" + (level - 1)).removeAttr('name')

        $.each(json, function (key, data) {
                if (parent_id == data['parent_id']) {
                    $("#" + model + "_level_" + level).append(new Option(data['title']+':'+data['id'], data['id']));
                }
            }
        );

        if (model === 'rubric') $(".input-parameter").hide();
        if (model === 'rubric') $(".input-pricetype").hide();
    } else {
        if (model === 'rubric') Parameter_Rubric($("select[name='rubric_id']").val());
        if (model === 'rubric') PriceType_Rubric($("select[name='rubric_id']").val());
        $("#" + model + "_level_" + (level - 1)).attr('name', model + "_id")
        $("#" + model + "_level_" + (level - 1)).attr('data-name', model)
        $("#" + model + "_level_" + (level - 1)).attr('required', "required")
console.log("#" + model + "_level_" + (level - 1))
    }

}

$(document).ready(function () {
    $("input[type='checkbox']").change(function () {
        $(this).siblings('ul')
            .find("input[type='checkbox']")
            .prop('checked', this.checked);
    });



})

window.CheckRubrics = function (parent_id, id) {
   // console.log(id)
    var child_cat = $('.parent' + parent_id).length
    var child_cat_checked = $('.parent' + parent_id + ':checked').length;

    if (child_cat > child_cat_checked) {
        $('#checkbox' + parent_id).prop({indeterminate: true});

    }
    if (child_cat === child_cat_checked) {
        $('#checkbox' + parent_id).prop({indeterminate: false, checked: true});

    }
    if (child_cat_checked === 0) {
        $('#checkbox' + parent_id).prop({indeterminate: false, checked: false});

    }
    if ($('.parent' + id).length > 0) {
        $(".parent" + id).each(function () {
            $(".parent" + $(this).val()).prop('checked', true);
            CheckRubrics(id, $(this).val());
        })
    }
}

window.Parameter_Rubric = function (rubric_id) {
    $(".input-parameter").hide();



    $.each(json_parameter_rubric, function (key, data) {


        if (rubric_id == data['rubric_id']) {

            $('#parameter_' + data['parameter_id']).show()
        }
    })
}
window.PriceType_Rubric = function (rubric_id) {
    $(".input-pricetype").hide();
    var arr =[];
    $.each(json_pricetype_rubric, function (key, data) {

        if (rubric_id == data['rubric_id']) {
            arr.unshift(data['price_type_id']);
            $('#pricetype_' + data['price_type_id']).show();
            $('#input_pricetype_' + data['price_type_id']).prop('checked', false);

            ;

        }
        /*console.log(rubric_id +' - ' + data['rubric_id'])*/
    })
    if (arr.length==1) {
        var element_id = arr.shift();
        $('#pricetype_' + element_id).prop('selected', true);
    }

}
$(document).ready(function () {
    $('input[name="price_type"]').change(function (e) {
        if ($(this).data('hasvalue')==='Y'){
            $('#price').attr('required','required')
            $('#price').show()
        } else {
            $('#price').removeAttr('required')
            $('#price').hide()

        }
        console.log($(this).data('hasvalue'))
    })
})
window.selectTab = function (id,forms = false)
{
    var errors = Array();
    if (id=='nav-item-details'){
        $.each(forms,function(id,form)
        {
            var val_form = $('[data-name="'+form+'"]').val();
            if (val_form == '' || val_form== null) {
                errors.push(form)
            } /*else {
                errors.push(form)
            }*/
            console.log(form +"=="+val_form)

        })
    }
    console.log(errors)
    if (errors.length<1) {
        $('.nav-link').removeClass('active')
        $('.tab-pane').removeClass('active show')
        $('#' + id).addClass('active show')
        $('#' + id + '-tab').addClass('active')
    }
}

$(document).ready(function () {

    // enable fileuploader plugin
    $('input[name="file"]').fileuploader({
        limit: 20,
        maxSize: 50,

        changeInput: '<div class="fileuploader-input">' +
            '<div class="fileuploader-input-inner">' +
            '<div class="fileuploader-icon-main"></div>' +
            '<div class="fileuploader-input-caption"><span class="d-block mb-15">Нет фото</span></div>' +
            '<span class="d-block mb-15">Перетащите фото сюда</span>' +
            '<div class="form-group button mb-0">\n' +
            '<button type="button" class="btn">загрузить фото</button>' +
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
                '<div class="thumbnail-holder" style="background: url(' +
                '${data.thumbnail}' +
                ');background-size: contain;"><span class="fileuploader-action-popup"></span>' +
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
(function () {

    "use strict";

    //===== Prealoder

    /*window.onload = function () {
        window.setTimeout(fadeout, 200);
    }*/


   /* function fadeout() {
        document.querySelector('.preloader').style.opacity = '0';
        document.querySelector('.preloader').style.display = 'none';
    }*/


    /*=====================================
    Sticky
    ======================================= */
    window.onscroll = function () {
        var header_navbar = document.querySelector(".navbar-area");
        var sticky = header_navbar.offsetTop;

        if (window.pageYOffset > sticky) {
            header_navbar.classList.add("sticky");
        } else {
            header_navbar.classList.remove("sticky");
        }

        // show or hide the back-top-top button
        var backToTo = document.querySelector(".scroll-top");
        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            backToTo.style.display = "flex";
        } else {
            backToTo.style.display = "none";
        }
    };

    //===== Mobile-menu-btn
    let navbarToggler = document.querySelector(".mobile-menu-btn");
    navbarToggler.addEventListener('click', function () {
        navbarToggler.classList.toggle("active");
    });

    // WOW active
   // new WOW().init();

})();
