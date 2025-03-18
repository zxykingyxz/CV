_FRAMEWORK = {

    init: function() {

        _FRAMEWORK.Counter();

        _FRAMEWORK.thumbsGallery();

        _FRAMEWORK.tocList();

        _FRAMEWORK.searchPage();

        _FRAMEWORK.scrollTo();

        _FRAMEWORK.validateForm();

        _FRAMEWORK.ajaxPaging();

        _FRAMEWORK.autocomplete();

        _FRAMEWORK.scrollIndicator();

        _FRAMEWORK.animation();

        _FRAMEWORK.zoomDetail();

        _FRAMEWORK.Menu();

        _FRAMEWORK.loadWesite();

        _FRAMEWORK.Function();

        _FRAMEWORK.developer();

        _FRAMEWORK.Lazys();

    },
    Function: function() {
        if (array_js_functions != '') {
            array_js_functions = array_js_functions.split(',');
            for (var i = 0; i < array_js_functions.length; i++) {
                const name_flie = array_js_functions[i].trim();
                if ($.inArray(name_flie, ["all_db"]) === -1) {
                    $.getScript('./assets/js/functions/' + name_flie, function() {
                        _FRAMEWORK.loadWesite();
                        _FRAMEWORK.Lazys();
                    });
                }
            }
        }
    },
    developer: function() {
        if (array_js_developer != '') {
            array_js_developer = array_js_developer.split(',');
            for (var i = 0; i < array_js_developer.length; i++) {
                const name_flie = array_js_developer[i].trim();
                if ($.inArray(name_flie, ["all_db"]) === -1) {
                    $.getScript('./assets/js/developer/' + name_flie, function() {
                        _FRAMEWORK.loadWesite();
                        _FRAMEWORK.Lazys();
                    });
                }
            }
        }
    },
    loadWesite: () => {
        // tạo trạng thái load
        $('body').find('.load_website').each(function() {
            var load_website = $(this);
            load_website.find('*').on('load', function() {
                setTimeout(function() {
                    load_website.removeClass('load_website');
                }, 100);
            });
        });
    },
    thumbsGallery: function() {
        const thumbsSlider = new Swiper(".button_images_thumbs_gallery", {
            slidesPerView: 4, // Số thumbnails hiển thị cùng lúc
            spaceBetween: 8, // Khoảng cách giữa các thumbnails
            watchSlidesProgress: true, // Theo dõi trạng thái thumbnail
        });

        // Main slider
        const mainSlider = new Swiper(".view_images_thumbs_gallery", {
            spaceBetween: 10,
            navigation: {
                nextEl: ".button_next_images_thumbs_gallery", // Nút chuyển tiếp
                prevEl: ".button_prev_images_thumbs_gallery", // Nút quay lại
            },
            thumbs: {
                swiper: thumbsSlider, // Kết nối với thumbs slider
            },
        });
    },
    zoomDetail: function() {
        $('body .content img').each(function() {
            var img_link = $(this).attr('src');
            $(this).wrap('<a href=' + img_link + ' data-fancybox="gallery"></a>');
        });
    },
    scrollIndicator: function() {
        document.addEventListener("DOMContentLoaded", function() {
            updateProgressBarWidth();
            document.addEventListener("scroll", updateProgressBarWidth);
            window.addEventListener("resize", updateProgressBarWidth);
        });
    },
    validateForm: function() {
        ValidationFormSelf('form_price_quote');
        ValidationFormSelf('form_client');
    },
    animation: function() {
        // ao.js
        AOS.init();
        // wow.js
        wow = new WOW({
            boxClass: 'wow',
            offset: 10,
            mobile: true,
            live: true,
        });
        wow.init();
    },
    Lazys: function() {
        if (exists($(".lazy"))) {
            var lazyLoadInstance = new LazyLoad({
                elements_selector: ".lazy",
            });
        }
    },
    Menu: function() {
        // menu design 1
        var select_design1 = {
            // mở menu
            btn: ' .btn_menuMb',
            // form menu
            form_menu: 'body .form_menu_mobile_js',
            // btn danh mục
            btn_dm: ' .btn_menu_mobile_js',
            // items danh mục
            items: ' .items_menu_mobile_js',
        };
        $("body").on("click", select_design1.btn, function(event) {
            event.preventDefault();
            var _this = $(this);
            if (_this.hasClass("active")) {
                $("body " + select_design1.btn).removeClass('active');
                $(select_design1.form_menu).removeClass('active');
                $("body ").css('overflow', 'auto');
            } else {
                $("body " + select_design1.btn).addClass('active');
                $(select_design1.form_menu).addClass('active');
                $("body ").css('overflow', 'hidden');
            }
        });
        $("body").on("click", select_design1.btn_dm, function(event) {
            event.preventDefault();
            var _this = $(this);
            var data_type = _this.closest(select_design1.items).data('type');
            var data_level = _this.closest(select_design1.items).data('level');
            var data_before = _this.closest(select_design1.items).data('before');
            var data_after = _this.closest(select_design1.items).data('after');
            if (_this.closest(select_design1.items).hasClass("active")) {
                // đóng
                _this.closest(select_design1.form_menu).find(select_design1.items).hide().removeClass("active");
                if (data_level == 0) {
                    _this.closest(select_design1.form_menu).find(select_design1.items + "[data-level='" + (data_level) + "']").show();
                } else {
                    _this.closest(select_design1.form_menu).find(select_design1.items + "[data-type='" + data_type + "' ][data-level='" + (data_level - 1) + "'][data-after='" + (data_before) + "']").addClass('active').show();
                    _this.closest(select_design1.form_menu).find(select_design1.items + "[data-type='" + data_type + "' ][data-level='" + (data_level) + "'][data-before='" + (data_before) + "']").show();
                }
            } else {
                // mở
                _this.closest(select_design1.form_menu).find(select_design1.items).hide().removeClass("active");
                _this.closest(select_design1.items).addClass("active").show();
                _this.closest(select_design1.form_menu).find(select_design1.items + "[data-type='" + data_type + "' ][data-level='" + (data_level + 1) + "'][data-before='" + (data_after) + "']").show();
            }
        });
    },
    autocomplete: function() {

        $('.autocomplete_keyw').focus(function() {

            $('.autocomplete_show').show();

        }).blur(function() {

            setTimeout(() => {

                $('.autocomplete_show').hide();

            }, 200);

        });
        $('.autocomplete_keyw').keyup(function() {

            // var type=$('select[name="type"]').val();

            var type = $('#type').val();

            var keywords = $(this).val();

            if (keywords != '') {
                $.ajax({

                    url: 'ajax/autoComplete.php',

                    type: "POST",

                    data: {

                        keywords: keywords,

                        type: type

                    },

                    success: function(data) {

                        $('.autocomplete_show').html(data);

                        $('.js-search-faq').click(function() {

                            var id = $(this).data('id');

                            $('.js-faq.' + id).trigger('click');

                        });

                    }

                });

            } else {

                $('.autocomplete_show').html('');

            }

        });


    },
    ajaxPaging: function() {
        $('body').on('click', '.view__load', function() {
            let _this = $(this);
            let page = parseInt(_this.attr('data-page'));
            let url = getUrlParam({
                'page': parseInt(page) + 1,
            });
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: function() {
                    $('.rp-loader').show();
                    _this.hide();
                },
                success: function(data) {
                    $('#wrap__product').append(data.html.items);
                    $('#paging').html(data.html.paging);
                    $('.move-loading').remove();
                    $('.rp-loader').hide();
                    _this.show();
                    _FRAMEWORK.Lazys();
                    _FRAMEWORK.loadWesite();
                },
                error: function(data) {},
                complete: function() {}
            });
        });
        $('body').on('click', '.view__load_index', function() {
            let _this = $(this);
            let page = parseInt(_this.attr('data-page'));
            let layouts = _this.attr('data-layouts');
            let form = _this.attr('data-form');
            let seoheading = _this.attr('data-seoheading');
            let items = parseInt(_this.attr('data-items'));
            let total = parseInt(_this.attr('data-total'));
            let sql = _this.attr('data-sql');
            let formItems = _this.attr('data-form-items');
            let formPaging = _this.attr('data-form-paging');

            $.ajax({
                url: "ajax/default/pagingIndex.php",
                type: 'POST',
                data: {
                    form: form,
                    page: page,
                    layouts: layouts,
                    seoheading: seoheading,
                    items: items,
                    total: total,
                    sql: sql,
                },
                dataType: 'JSON',
                beforeSend: function() {
                    $('.rp-loader').show();
                    _this.hide();
                },
                success: function(data) {
                    $('#' + formItems).append(data.html.items);
                    $('#' + formPaging).html(data.html.paging);
                    $('.rp-loader').hide();
                    _this.show();
                    _FRAMEWORK.Lazys();
                    _FRAMEWORK.loadWesite();
                },
                error: function(data) {},
                complete: function() {}
            });

        });
    },
    scrollTo: function() {
        $('body').append('<div id="back-to-top" style=""><a class="top arrow"><i class="fa fa-angle-up"></i> <span></span></a></div>');
        $(window).scroll(() => {
            if ($(window).scrollTop() > 30) {
                $('body .header_menu').addClass('animate');
            } else {
                $('body .header_menu').removeClass('animate');
            }
            if ($(window).scrollTop() > 100) {
                $('#back-to-top .top').addClass('animate_top');
            } else {
                $('#back-to-top .top').removeClass('animate_top');
            }
        });

        $('#back-to-top .top').click(() => {
            $('html, body').animate({ scrollTop: 0 }, 500);
        });
        $('#slide-menu-right').click(function() {
            var container = $('#slide-menu');
            sideScroll(container, 'right', 25, 100, $(".slide-menu").width());
        });
        $('#slide-menu-left').click(function() {
            var container = $('#slide-menu');
            sideScroll(container, 'left', 25, 100, $(".slide-menu").width());
        });

    },
    chaychu: function() {
        $('.chaychu > div').textillate({ in: {
                effect: 'fadeInLeft'
            },
            out: {
                effect: 'fadeInRight'
            },
            loop: true
        });
    },
    Counter: () => {
        $(window).on('load', () => {
            setTimeout(function() {
                $.ajax({

                    url: 'ajax/default/ajaxCounter.php',

                    type: 'POST',

                    dataType: 'json',

                    success: (data) => {
                        $("body .value_counter[data-counter='total']").text(data.counter_items['totalaccess']);
                        $("body .value_counter[data-counter='online']").text(data.counter_online['dangxem']);
                        $("body .value_counter[data-counter='weeks']").text(data.counter_items['week']);
                        $("body .value_counter[data-counter='month']").text(data.counter_items['month']);
                    }
                });
            }, 3000);
        });

    },
    searchPage: function() {
        if ($(".search-Click").length) {
            $(".search-Click").click(function() {
                $(".block-search").show();
                setTimeout(function() {
                    $(".block-search").find("form").addClass("active");
                }, 50);
            });
            $('body').on('click', ".close-form-search", function() {
                $(".block-search").hide();
                $(".block-search").find("form").removeClass("active");
            });
        }
        $("body").on("submit", ".form-search", function(event) {
            event.preventDefault();
            var keywords = $(this).find(".keyword");
            if (keywords.val()) {
                var k = keywords.val();
                window.location.href = encodeURI(`${_ROOT}tim-kiem?keywords=${k}`);
            } else {
                keywords.focus();
            }
        });
    },
    showNotification: function(data = {
        title: null,
        message: null,
        status: "success"
    }) {
        if (typeof window.stackTopLeft === 'undefined') {
            window.stackTopLeft = new PNotify.Stack({
                dir1: 'down',
                dir2: 'left',
                firstpos1: 15,
                firstpos2: 15,
                push: 'top',
                maxStrategy: 'close'
            });
        }
        switch (data.status) {
            case "success":
                PNotify.success({
                    title: data.title,
                    text: data.message,
                    stack: window.stackTopLeft
                });
                break;
            case "error":
                PNotify.error({
                    title: data.title,
                    text: data.message,
                    stack: window.stackTopLeft
                });
                break;
            default:
                break;
        }
    },
    tocList: function() {
        if (_TOC == 1 || _LIST_TOC == 1) {
            $('#toc').toc({
                selectors: 'h2, h3, h4, h5, h6',
                container: $('.content'),
                status: true
            });
            $('a#toc').click(function() {
                $('.toc-list').toggle(200);
            });
            $('.toc-list').find('a').click(function(e) {
                e.preventDefault();
                var x = $(this).attr('data-rel');
                goToByScroll(x);
            });
        }
    },
};
$(document).ready(function() {
    loadApplication(true);
    _FRAMEWORK.init();
    loadApplication(false);
});