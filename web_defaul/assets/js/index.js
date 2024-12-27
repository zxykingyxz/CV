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

        _FRAMEWORK.captcha();

        _FRAMEWORK.scrollIndicator();

        _FRAMEWORK.zoomDetail();

        _FRAMEWORK.Menu();

        _FRAMEWORK.autoResizeWeb();

        _FRAMEWORK.advancedSearch();

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
                if ($.inArray(name_flie, [""]) === -1) {
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
        var time_addkeywords = 500;
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

    autoResizeWeb: () => {
        var resizeTimer;
        var currentWidth = $(window).width();
        $(window).on('resize', function() {
            var newWidth = $(window).width();
            if ((newWidth !== currentWidth) && (((currentWidth - newWidth) > 100) || ((newWidth - currentWidth) > 100))) {
                currentWidth = newWidth;
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(function() {
                    location.reload(); // Tự động load lại trang sau khi dừng resize
                }, 300); // Thời gian chờ sau khi dừng resize (ms)
            }
        });
    },

    loadWesite: () => {
        // tạo trạng thái load
        $('body').find('.load_website').each(function() {
            var load_website = $(this);
            load_website.find('*').on('load', function() {
                setTimeout(function() {
                    load_website.removeClass('load_website');
                }, 300);
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
            font_weight: 400,
            font_size: 13,
            font_family: 'sans-serif',
            // color captcha
            color_captcha: '#222020',
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
        ValidationFormSelf('form_price_quote');
        ValidationFormSelf('form_client');
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
$(document).ready(function() {
    loadApplication(true);
    _FRAMEWORK.init();
    loadApplication(false);
});