_FRAMEWORK = {

    init: function() {

        _FRAMEWORK.Counter();

        _FRAMEWORK.carouselSlider();

        _FRAMEWORK.lightSliderPage();

        _FRAMEWORK.tocList();

        _FRAMEWORK.searchPage();

        _FRAMEWORK.scrollTo();

        _FRAMEWORK.validateForm();

        _FRAMEWORK.ajaxPaging();

        _FRAMEWORK.autocomplete();

        _FRAMEWORK.captcha();

        _FRAMEWORK.scrollIndicator();

        _FRAMEWORK.zoomDetail();

        _FRAMEWORK.Menu();

        _FRAMEWORK.loadWesite();

        _FRAMEWORK.developer();

        _FRAMEWORK.Lazys();

    },
    developer: function() {
        if ($('body input[name="array_js_developer"]').length > 0) {
            var array_js_developer = $('body input[name="array_js_developer"]').val();
            var array_js_developer = array_js_developer.split(',');
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

    product: function() {
        // like sản phẩm
        $('body').on('click', '.btn-link', function() {
            let _this = $(this);
            let id = _this.data('id');

            $.ajax({
                url: 'ajax/ajaxLikeProduct.php',
                type: 'POST',
                data: {
                    id: id,
                },
                dataType: 'JSON',
                beforeSend: function() {},
                success: function(data) {
                    $('body').find('.view_like').text(data.sum);
                    if (_this.hasClass('active')) {
                        _this.removeClass('active');
                    } else {
                        _this.addClass('active');
                    }
                },
                complete: function() {}
            });
        });
    },

    advancedSearch: function() {
        // tìm kiếm nâng cao
        var typingTimer;
        var time_addkeywords = 300;
        $('body').on('input', 'input[name="keywords"]', function() {
            if ($('body').find('.view_input').length > 0) {
                var _this = $(this);
                clearTimeout(typingTimer);
                $('body').find('.view_load_search').css('display', 'block');
                $('body').find('.close_view_search').css('display', 'none');
                typingTimer = setTimeout(function() {
                    var value = _this.val();
                    $.ajax({
                        url: 'ajax/ajaxAdvancedSearch.php',
                        type: 'POST',
                        data: {
                            value: value,
                        },
                        beforeSend: function() {},
                        success: function(data) {
                            $('body').find('.view_input').html(data);
                            $('body').find('.view_load_search').css('display', 'none');
                            if (value.length > 0) {
                                $('body').find('.close_view_search').css('display', 'block');
                            } else {
                                $('body').find('.close_view_search').css('display', 'none');
                            };
                            _FRAMEWORK.loadWesite();
                            _FRAMEWORK.Lazys();
                        },
                        complete: function() {}
                    });
                }, time_addkeywords);
            }
        });
        $('body').on('click', '.close_view_search', function() {
            var _this = $(this);
            $('body').find('.view_input>div').remove();
            $('body').find('input[name="keywords"]').val('');
            $('body').find('.close_view_search').css('display', 'none');
        });
    },

    loadWesite: () => {
        $('body').find('.load_website').each(function() {
            var load_website = $(this);
            load_website.find('*').on('load', function() {
                setTimeout(function() {
                    load_website.removeClass('load_website');
                }, 200);
            });
        });
    },

    FlashSale: function() {
        if ($('body input[name=flash_web]').length) {
            var time_end = $('body input[name=flash_web]').val();
            if (time_end != '') {
                setInterval(function() {
                    var now = new Date().getTime();
                    var timeRemaining = new Date(time_end).getTime() - now;
                    if (timeRemaining > 0) {
                        var days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
                        var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

                        $('body .days_flash_sale').html(days.toString().padStart(2, '0'));
                        $('body .hours_flash_sale').html(hours.toString().padStart(2, '0'));
                        $('body .minutes_flash_sale').html(minutes.toString().padStart(2, '0'));
                        $('body .seconds_flash_sale').html(seconds.toString().padStart(2, '0'));
                    } else {
                        setTimeout(function() {
                            location.reload();
                        }, 1000);

                    }
                }, 1000);
            }
        }
    },

    lightSliderPage: function() {
        var slide1 = $("#slide-light-detail .slider").lightSlider({
            gallery: true,
            item: 1,
            loop: false,
            slideMargin: 0,
            adaptiveHeight: false,
            vertical: false,
            verticalHeight: 330,
            vThumbWidth: 70,
            thumbItem: 4,
            thumbMargin: 4,
            enableDrag: false,
            addClass: ' Slider_detail',
            currentPagerPosition: 'left',
            responsive: [{ breakpoint: 767, settings: { thumbItem: 4 } }]
        });
    },

    zoomDetail: function() {
        $('body').on('click', '.zoom-detail img', function() {
            let _this = $(this);
            let title = _this.attr('alt');
            let src = _this.attr('src');
            $('body .popup-zoom').addClass('show-zoom');
            if ($('body .popup-zoom .img-zoom').length > 0) {
                $('body .popup-zoom .img-zoom').attr('src', src);
            }
            if ($('body .popup-zoom .wrap-caption-zoom').length > 0) {
                $('body .popup-zoom .wrap-caption-zoom').html(`
                    <div class="inner-caption scrollbar-macosx ss-container">
                        <div class="ss-wrapper">
                            <div class="ss-content">
                                <p class="Image">${title}</p>
                            </div>
                        </div>
                        <div class="ss-scroll ss-hidden"></div>
                    </div>
                `);
            }
        });
        $('body').on('click', '.close-zoom', function() {
            $('body .popup-zoom').removeClass('show-zoom');
        });
    },

    scrollIndicator: function() {
        document.addEventListener("DOMContentLoaded", function() {
            updateProgressBarWidth();
            document.addEventListener("scroll", updateProgressBarWidth);
            window.addEventListener("resize", updateProgressBarWidth);
        });
    },

    captcha: function() {
        var select_Captcha = {
            // class form tổng
            form_captcha: ' .form_captcha_js',
            // button 
            button: ' .btn_captcha_js',
            // dữ liệu nhận
            code_captcha: ' .code_captcha',
            // font captcha
            font_weight: 600,
            font_size: 15,
            font_family: 'sans-serif',
            // color captcha
            color_captcha: '#000',
            // data-name=""     Nhập tên lưu 
            // data-size=""     Nhập Kích thước WxH 
            // data-length=""     Nhập số ký tự 
            // data-ajax=""     Nhập file source 

        };
        $('body').on('click', select_Captcha.button, function() {
            var _this = $(this);
            if (!_this.hasClass('on')) {
                _this.addClass('on');
                // tên lưu
                var name_save = _this.data('name');
                // kích thước captcha
                var size = _this.data('size');
                if (!size || size.length === 0) {
                    size = '70x17';
                }
                var parts_canvas = size.split('x');
                var width_canvas = parseInt(parts_canvas[0], 10);
                var height_canvas = parseInt(parts_canvas[1], 10);
                // độ dài captcha
                let length_value = _this.data('length');
                var length = 0;
                if (length_value !== undefined && length_value !== null) {
                    length = length_value;
                } else {
                    length = 6;
                }
                // url file source
                var url_ajax_value = _this.data('ajax');
                var ajax_file = '';
                if (url_ajax_value !== undefined && url_ajax_value !== null) {
                    ajax_file = url_ajax_value;
                } else {
                    ajax_file = 'ajax/buildCaptcha.php';
                }
                // mã captcha
                var chars = 'ABCDEFGHJKMNPQRSTUVWXYZ123456789123456789123456789123456789123456789qwertyuiopasdfghjklzxcvbnm';
                var string = '';
                for (var i = 0; i < length; i++) {
                    string += chars.charAt(Math.floor(Math.random() * chars.length));
                }
                $.ajax({
                    url: ajax_file,
                    type: 'POST',
                    data: {
                        captcha: string,
                        name: name_save,
                    },
                    dataType: 'Json',
                    success: function(data) {
                        var canvas = $('<canvas/>', {
                            id: 'code_captcha',
                        });
                        canvas.attr({
                            width: width_canvas,
                            height: height_canvas
                        });
                        let captcha = canvas[0];
                        if (captcha && captcha.getContext) {
                            let ctx = captcha.getContext('2d');
                            ctx.font = select_Captcha.font_weight + ' ' + select_Captcha.font_size + 'px ' + select_Captcha.font_family;
                            ctx.fillStyle = select_Captcha.color_captcha;
                            ctx.textAlign = "center";
                            ctx.textBaseline = "middle";
                            ctx.fillText(data.captcha, ((width_canvas) / 2), ((height_canvas) / 2));
                            _this.closest(select_Captcha.form_captcha).find(select_Captcha.code_captcha).html(canvas);
                            setTimeout(function() {
                                _this.removeClass('on');
                            }, 500);
                        }
                    }
                });
            }
        });
        if ($(select_Captcha.button).length > 0) {
            $(select_Captcha.button).click();
        }
        $('body').on('click', '.reload-captcha', function() {
            let _this = $(this);
            $.ajax({
                url: 'ajax/loadCaptcha.php',
                type: 'GET',
                dataType: 'json',
                beforeSend: function() {
                    _this.addClass('active')
                },
                success: (data) => {
                    $('.captcha-code').text(data.code);
                    setTimeout(function() {
                        _this.removeClass('active');
                    }, 300);
                },
            })
        });
        $('.reload-captcha').trigger('click');
    },

    validateForm: function() {
        ValidationFormSelf('form-validate-warehouse-sign_up');
        ValidationFormSelf('form-validate-warehouse-login');
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
            let item = parseInt(_this.attr('data-item'));
            let page = parseInt(_this.attr('data-page'));
            let total = parseInt(_this.attr('data-total'));
            let showItem = total > item ? item : total;
            let x = page + 1;
            let arr_filter = ['page', 'per_page', 'total'];
            let linkadd = 'page=' + x + '&per_page=' + item + '&total=' + total;
            let url = create_link();
            url = removeParam(arr_filter, url);
            var url_tmp = url;
            url = (url.indexOf("?") !== -1) ? url + '&' + linkadd : url + '?' + linkadd;
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: function() {
                    $('#wrap__product').append(getSketon(showItem));
                    $('.rp-loader').show();
                    _this.hide();
                },
                success: function(data) {
                    pushState({}, '', url_tmp);
                    setTimeout(() => {
                        $('#wrap__product').append(data.html);
                        $('.move-loading').remove();
                        $('#paging').html(data.paging);
                        _FRAMEWORK.ratioImage();
                        _FRAMEWORK.Lazys();
                        _FRAMEWORK.loadWesite();
                        $('.rp-loader').hide();
                        _this.show();
                    }, 300);

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

                    url: 'ajax/ajaxCounter.php',

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

    carouselSlider: function() {


        var owl = $('.owl-carousel.in-home');

        owl.each(function() {

            var xs_item = $(this).attr('data-xs-items');

            var md_item = $(this).attr('data-md-items');

            var lg_item = $(this).attr('data-lg-items');

            var sm_item = $(this).attr('data-sm-items');

            var margin = $(this).attr('data-margin');

            var dot = $(this).attr('data-dot');

            var nav = $(this).attr('data-nav');

            var height = $(this).attr('data-height');

            var play = $(this).attr('data-play');

            var loop = $(this).attr('data-loop');



            if (typeof margin !== typeof undefined && margin !== false) {

            } else {

                margin = 30;

            }

            if (typeof xs_item !== typeof undefined && xs_item !== false) {

            } else {

                xs_item = 1;

            }

            if (typeof sm_item !== typeof undefined && sm_item !== false) {



            } else {

                sm_item = 3;

            }

            if (typeof md_item !== typeof undefined && md_item !== false) {

            } else {

                md_item = 3;

            }

            if (typeof lg_item !== typeof undefined && lg_item !== false) {

            } else {

                lg_item = 3;

            }



            if (loop == 1) { loop = true; } else { loop = false; }

            if (dot == 1) { dot = true; } else { dot = false; }

            if (nav == 1) { nav = true; } else { nav = false; }

            if (play == 1) { play = true; } else { play = false; }



            $(this).owlCarousel({

                loop: loop,

                margin: Number(margin),

                responsiveClass: true,

                dots: dot,

                nav: nav,

                navText: ["<div class='arrowleft'><svg viewBox='0 0 16000 16000'><polyline class='a' points='11040,1920 4960,8000 11040,14080'></polyline></svg></div>", "<div class='arrowright'><svg viewBox='0 0 16000 16000' style='position:absolute;top:0;left:0;width:100%;height:100%;'><polyline class='a' points='4960,1920 11040,8000 4960,14080'></polyline></svg></div>"],

                autoplay: play,

                autoplayTimeout: 10000,

                smartSpeed: 2000,

                autoplayHoverPause: true,

                autoHeight: false,

                responsive: {

                    0: {

                        items: Number(xs_item),

                        margin: 8,

                    },

                    600: {

                        items: Number(sm_item)

                    },

                    1000: {

                        items: Number(md_item)

                    },

                    1200: {

                        items: Number(lg_item)

                    }

                }

            });

        });

        var owlslider = $('.owl-carousel.owl-slider');

        owlslider.each(function() {

            var xs_item = $(this).attr('data-xs-items');

            var md_item = $(this).attr('data-md-items');

            var lg_item = $(this).attr('data-lg-items');

            var sm_item = $(this).attr('data-sm-items');

            var margin = $(this).attr('data-margin');

            var dot = $(this).attr('data-dot');

            var nav = $(this).attr('data-nav');

            var height = $(this).attr('data-height');

            var play = $(this).attr('data-play');

            var loop = $(this).attr('data-loop');

            var delay = $(this).attr('data-delay');


            if (typeof margin !== typeof undefined && margin !== false) {

            } else {

                margin = 30;

            }

            if (typeof xs_item !== typeof undefined && xs_item !== false) {

            } else {

                xs_item = 1;

            }

            if (typeof sm_item !== typeof undefined && sm_item !== false) {



            } else {

                sm_item = 3;

            }

            if (typeof md_item !== typeof undefined && md_item !== false) {

            } else {

                md_item = 3;

            }

            if (typeof lg_item !== typeof undefined && lg_item !== false) {

            } else {

                lg_item = 3;

            }



            if (loop == 1) { loop = true; } else { loop = false; }

            if (dot == 1) { dot = true; } else { dot = false; }

            if (nav == 1) { nav = true; } else { nav = false; }

            if (play == 1) { play = true; } else { play = false; }



            $(this).owlCarousel({

                loop: loop,

                margin: Number(margin),

                responsiveClass: true,

                // animateOut: 'fadeOut',

                dots: dot,

                nav: nav,

                navText: ["<div class='arrowleft'><svg viewBox='0 0 16000 16000'><polyline class='a' points='11040,1920 4960,8000 11040,14080'></polyline></svg></div>", "<div class='arrowright'><svg viewBox='0 0 16000 16000' style='position:absolute;top:0;left:0;width:100%;height:100%;'><polyline class='a' points='4960,1920 11040,8000 4960,14080'></polyline></svg></div>"],

                autoplay: play,

                autoplayTimeout: delay,

                smartSpeed: 1000,

                autoplayHoverPause: true,

                autoHeight: false,

                responsive: {

                    0: {

                        items: Number(xs_item)

                    },

                    600: {

                        items: Number(sm_item)

                    },

                    1000: {

                        items: Number(md_item)

                    },

                    1200: {

                        items: Number(lg_item)

                    }

                }

            });

        });

        var owlQuick = $('.owl-carousel.quick-slide');

        owlQuick.each(function() {

            var xs_item = $(this).attr('data-xs-items');

            var md_item = $(this).attr('data-md-items');

            var lg_item = $(this).attr('data-lg-items');

            var sm_item = $(this).attr('data-sm-items');

            var margin = $(this).attr('data-margin');

            var dot = $(this).attr('data-dot');

            var nav = $(this).attr('data-nav');

            var height = $(this).attr('data-height');

            var play = $(this).attr('data-play');

            var loop = $(this).attr('data-loop');

            var delay = $(this).attr('data-delay');



            if (typeof margin !== typeof undefined && margin !== false) {

            } else {

                margin = 30;

            }

            if (typeof xs_item !== typeof undefined && xs_item !== false) {

            } else {

                xs_item = 1;

            }

            if (typeof sm_item !== typeof undefined && sm_item !== false) {



            } else {

                sm_item = 4;

            }

            if (typeof md_item !== typeof undefined && md_item !== false) {

            } else {

                md_item = 4;

            }

            if (typeof lg_item !== typeof undefined && lg_item !== false) {

            } else {

                lg_item = 4;

            }



            if (loop == 1) { loop = true; } else { loop = false; }

            if (dot == 1) { dot = true; } else { dot = false; }

            if (nav == 1) { nav = true; } else { nav = false; }

            if (play == 1) { play = true; } else { play = false; }



            $(this).owlCarousel({

                loop: loop,

                margin: Number(margin),

                responsiveClass: true,

                dots: dot,

                nav: nav,

                navText: ['<span aria-label="Previous"></span>', '<span aria-label="Next"></span>'],

                autoplay: play,

                autoplayTimeout: delay,

                smartSpeed: 200,

                autoplayHoverPause: true,

                autoHeight: false,

                responsive: {

                    0: {
                        margin: 5,
                        items: 2,

                    },

                    600: {
                        margin: 5,
                        items: 3,


                    },

                    1000: {
                        margin: 5,
                        items: 4,

                    },

                    1200: {
                        margin: 5,
                        items: 5,

                    }

                }

            });

        });

        var owlQuickCenter = $('.owl-carousel.quick-slide-center');

        owlQuickCenter.each(function() {

            var xs_item = $(this).attr('data-xs-items');

            var md_item = $(this).attr('data-md-items');

            var lg_item = $(this).attr('data-lg-items');

            var sm_item = $(this).attr('data-sm-items');

            var margin = $(this).attr('data-margin');

            var dot = $(this).attr('data-dot');

            var nav = $(this).attr('data-nav');

            var height = $(this).attr('data-height');

            var play = $(this).attr('data-play');

            var loop = $(this).attr('data-loop');

            var delay = $(this).attr('data-delay');



            if (typeof margin !== typeof undefined && margin !== false) {

            } else {

                margin = 30;

            }

            if (typeof xs_item !== typeof undefined && xs_item !== false) {

            } else {

                xs_item = 1;

            }

            if (typeof sm_item !== typeof undefined && sm_item !== false) {



            } else {

                sm_item = 3;

            }

            if (typeof md_item !== typeof undefined && md_item !== false) {

            } else {

                md_item = 3;

            }

            if (typeof lg_item !== typeof undefined && lg_item !== false) {

            } else {

                lg_item = 3;

            }



            if (loop == 1) { loop = true; } else { loop = false; }

            if (dot == 1) { dot = true; } else { dot = false; }

            if (nav == 1) { nav = true; } else { nav = false; }

            if (play == 1) { play = true; } else { play = false; }



            $(this).owlCarousel({

                center: true,

                loop: loop,

                margin: Number(margin),

                responsiveClass: true,

                dots: dot,

                nav: nav,

                navText: ['<span aria-label="Previous"></span>', '<span aria-label="Next"></span>'],

                autoplay: play,

                autoplayTimeout: delay,

                smartSpeed: 200,

                autoplayHoverPause: true,

                autoHeight: false,

                responsive: {

                    0: {

                        items: Number(xs_item),

                    },

                    600: {

                        items: Number(sm_item),


                    },

                    1000: {

                        items: Number(md_item)

                    },

                    1200: {

                        items: Number(lg_item)

                    }

                }

            })

        });

        $('.quick-slide-prev').click(function() {

            var id = $(this).data('id');

            $('.quick-slide__customer' + id).trigger('prev.owl.carousel');

        });

        $('.quick-slide-next').click(function() {

            var id = $(this).data('id');

            $('.quick-slide__customer' + id).trigger('next.owl.carousel');

        });


        if (exists("#sync1")) {
            var sync1 = $("#sync1 .owl-theme");
            var sync2 = $("#sync2 .owl-theme");
            var slidesPerPage = 5;
            var syncedSecondary = true;
            sync1.owlCarousel({
                items: 1,
                slideSpeed: 2000,
                nav: true,
                navText: ['<span aria-label="Previous"></span>', '<span aria-label="Next"></span>'],
                center: false,
                autoplay: true,
                autoplayHoverPause: true,
                dots: false,
                loop: true,
                lazyLoad: true,
                responsiveRefreshRate: 200

            }).on('changed.owl.carousel', syncPosition);

            sync2
                .on('initialized.owl.carousel', function() {
                    sync2.find(".owl-item").eq(0).addClass("synced");
                })
                .owlCarousel({
                    items: slidesPerPage,
                    dots: false,
                    margin: 10,
                    nav: false,
                    loop: false,
                    center: false,
                    smartSpeed: 200,
                    slideSpeed: 500,
                    slideBy: slidesPerPage,
                    responsiveRefreshRate: 100,
                    responsive: {

                        0: {
                            items: 2
                        },
                        600: {
                            items: 2
                        },
                        1000: {
                            items: 3
                        },
                        1200: {

                            items: 4

                        }

                    }
                }).on('changed.owl.carousel', syncPosition2);

            function syncPosition(el) {
                var count = el.item.count - 1;
                var current = Math.round(el.item.index - (el.item.count / 2) - .5);

                if (current < 0 && 1 < 2) {
                    current = count;
                }
                if (current > count) {
                    current = 0;
                }

                sync2
                    .find(".owl-item")
                    .removeClass("synced")
                    .eq(current)
                    .addClass("synced");
                var onscreen = sync2.find('.owl-item.active').length - 1;
                var start = sync2.find('.owl-item.active').first().index();
                var end = sync2.find('.owl-item.active').last().index();

                if (current > end) {
                    sync2.data('owl.carousel').to(current, 100, true);
                }
                if (current < start && 1 < 2) {
                    sync2.data('owl.carousel').to(current - onscreen, 100, true);
                }
            }

            function syncPosition2(el) {
                if (syncedSecondary) {
                    var number = el.item.index;
                    sync1.data('owl.carousel').to(number, 100, true);
                }
            }

            sync2.on("click", ".owl-item", function(e) {
                e.preventDefault();
                var number = $(this).index();
                sync1.data('owl.carousel').to(number, 300, true);
            });
        }

    },

    searchPage: function() {

        $('button[data-btn-search-page]').click(function() {

            var t = $('.keywords-page');

            searchEnter(t);

        });

        $('button[data-btn-search-pc]').click(function() {

            var t = $('#keywordspc');

            searchEnter(t);

        });

        $('button[data-btn-search-m]').click(function() {

            var t = $('#keywords-m');

            searchEnter(t);

        });
        $('button.button-search-m').click(function() {

            var t = $('#keywords-m');

            searchEnter(t);

        });

        $('button.button-search-mmenu').click(function() {

            var t = $('#keywords-mmenu');

            searchEnter(t);

        });

        $('i.button-search-m').click(function() {

            var t = $('#keywords-m');

            searchEnter(t);

        });

        $('button.btn--search').click(function() {

            var t = $('#keywords');

            searchEnter(t);

        });


        $('#keywords').keypress(function(e) {

            if (e.which == 13) {

                searchEnter($(this));

            }

        });

        $('#keywords-m').keypress(function(e) {

            if (e.which == 13) {

                searchEnter($(this));

            }

        });

        $('#keywords-mmenu').keypress(function(e) {

            if (e.which == 13) {

                searchEnter($(this));

            }

        });

        $('#keywordspc').keypress(function(e) {

            if (e.which == 13) {

                searchEnter($(this));

            }

        });

        $('.keywords-page').keypress(function(e) {

            if (e.which == 13) {

                searchEnter($(this));

            }

        });
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
        $('input[data-role="search-input"]').placeholderTypewriter({ text: _PLACEHOLDER });

        $('input[data-inputsearch-mobile]').placeholderTypewriter({ text: _PLACEHOLDER });



    },

    showError: function(message, status) {
        $.toast({
            heading: lang.thong_bao,
            text: message,
            position: 'top-right',
            stack: false,
            icon: status
        });
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
        $('.tab_toc_list').click(function(e) {
            var x = $(this).attr('data-rel');
            goToByScroll(x);
        });
        $('.move_register').click(function(e) {
            var x = $(this).attr('data-rel');
            goToByScroll(x);
            $('.nameFocus').focus();
        });
        $('.moveAbout').click(function(e) {
            var x = $(this).attr('data-rel');
            goToByScroll(x);
        });
    },

};
loadApplication(true);
_FRAMEWORK.init();
loadApplication(false);