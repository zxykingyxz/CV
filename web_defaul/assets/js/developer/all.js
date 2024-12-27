// popup
function actionPopup(class_form = null, class_close_form = null, class_view_form = null, check_ajax = false) {
    $('body').on('click', '.' + class_view_form, function() {
        if (!$('body .' + class_form).hasClass('active')) {
            $('body .' + class_form).addClass('active');
            $("body ").css('overflow', 'hidden');
        }
    });
    $('body').on('click', '.' + class_close_form, function() {
        if ($(this).closest(' .' + class_form).hasClass('active')) {
            $(this).closest(' .' + class_form).removeClass('active');
            $("body ").css('overflow', 'auto');
        }
    });
}


$(document).ready(function() {
    $('body').on('click', '.data_output_gglang', function() {
        let value = $(this).data('lang');
        doGoogleLanguageTranslator(value);
    });
    $(".form_menu").btnNoneBlockPlugin({
        button: 'btn_menu', // Thay thế class cho button
        data: 'data_menu',
        animation: false,
        check_out: false,
        close: false,
        event_hover: true,
    });
    $(".form_nb").btnNoneBlockPlugin({
        button: 'btn_nb', // Thay thế class cho button
        data: 'data_nb',
        animation: false,
        check_out: false,
        close: true,
    });
    $(".form_contents_product").btnNoneBlockPlugin({
        button: 'btn_contents_product', // Thay thế class cho button
        data: 'data_contents_product',
        animation: false,
        check_out: false,
        close: false,
    });
    $(".form_filter_price").btnNoneBlockPlugin({
        button: 'btn_filter_price', // Thay thế class cho button
        data: 'data_filter_price',
        animation: false,
        check_out: true,
        close: true,
        scroll_top: true,
        scroll_hiden: true,
    });
    $(".form_flashsale").btnNoneBlockPlugin({
        button: 'btn_flashsale', // Thay thế class cho button
        data: 'data_flashsale',
        animation: false,
        check_out: false,
        close: false,
    });
    // Khoảng giá
    // $(".price_range").ionRangeSlider({
    //     skin: "big",
    //     type: "double",
    //     min: 0,
    //     max: 200000000,
    //     from: 20000000,
    //     to: 180000000,
    //     step: 100,
    //     onStart: function(data) {},
    //     onChange: function(data) {
    //         // Cập nhật giá trị khi thay đổi
    //         var $minInput = $(data.input).closest(".form_price_range").find(" .input_price[name='min_price']");
    //         var $maxInput = $(data.input).closest(".form_price_range").find(" .input_price[name='max_price']");

    //         $minInput.val(data.from).trigger('input');
    //         $maxInput.val(data.to).trigger('input');
    //     }
    // });
    $('.input_price').formatInputPlugin({
        max: 200000000,
        min: 0,
        unit: "đ",
    });
    $('.form_filter_price').paramUrlInput({
        button: 'button_filter_price',
        ajax_data: function(value, _this) {
            let time_out
            clearTimeout(time_out);
            time_out = setTimeout($.ajax({
                url: value,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: function() {
                    if (_COM != "index") {
                        loadApplication(true);
                    }
                },
                success: function(res) {
                    _this.find('.text_filter_search').text("Xem " + res.data.total + " Kết Quả");
                    if (_COM != "index") {
                        loadApplication(false);
                    }
                },
                error: function(data) {
                    console.error("Error:", data);
                },
                complete: function() {
                    console.log("AJAX call completed");
                }
            }), 1000);
        },
    });
    $('.content_js').showHideContents({
        class_sub: 'class_show_content',
        textShowMore: 'Xem Thêm',
        textShowLess: 'Thu Gọn',
        iconShowMore: '<i class="fas fa-angle-double-down"></i>',
        iconShowLess: '<i class="fas fa-angle-double-up"></i>',
        colorHover: 'var(--html-bg-website)',
    });
    // button xem thông tin sản phẩm
    $('body').on('click', '.views_product_info', function() {
        let value = $(this).data('value');
        $.ajax({
            url: 'ajax/ajaxViewInfo.php',
            type: 'POST',
            data: {
                value: value,
                form: 'view_info_product',
            },
            dataType: 'json',
            beforeSend: function() {
                loadApplication(true);
            },
            success: function(data) {
                $('body').append(data.html);
                $('body .form_popup').addClass('active');
                $("body ").css('overflow', 'hidden');
                $('body').on('click', '.close_form_popup', function() {
                    if ($(this).closest(' .form_popup').hasClass('active')) {
                        $(this).closest(' .form_popup').remove();
                        $("body ").css('overflow', 'auto');
                    }
                });
                _FRAMEWORK.loadWesite();
                _FRAMEWORK.Lazys();
                _FRAMEWORK.lightSliderPage();
                loadApplication(false);
            },
            complete: function() {}
        });
    });
    // button xem thông tin thanh toán
    $('body').on('click', '.views_pay_info', function() {
        let value = $(this).data('value');
        $.ajax({
            url: 'ajax/ajaxViewInfo.php',
            type: 'POST',
            data: {
                value: value,
                form: 'view_info_pay',
            },
            dataType: 'json',
            beforeSend: function() {
                loadApplication(true);
            },
            success: function(data) {
                $('body').append(data.html);
                $('body .form_popup').addClass('active');
                $("body ").css('overflow', 'hidden');
                $('body').on('click', '.close_form_popup', function() {
                    if ($(this).closest(' .form_popup').hasClass('active')) {
                        $(this).closest(' .form_popup').remove();
                        $("body ").css('overflow', 'auto');
                    }
                });
                _FRAMEWORK.loadWesite();
                _FRAMEWORK.Lazys();
                loadApplication(false);
            },
            complete: function() {}
        });
    });
    // button xóa đã xem
    $('body').on('click', '.remove_viewed', function() {
        let _this = $(this);
        let value = $(this).data('value');
        $.ajax({
            url: 'ajax/ajaxViewed.php',
            type: 'POST',
            data: {
                value: value,
            },
            beforeSend: function() {
                loadApplication(true);
            },
            success: function(data) {
                _this.closest(".items_viewed").closest('.owl-item ').remove();
                loadApplication(false);
            },
            complete: function() {}
        });
    });
    // xem thông tin chi tiết
    $('body').on('click', '.views_product_detail', function() {
        let value = $(this).data('value');
        let active = $(this).data('active');
        $.ajax({
            url: 'ajax/ajaxViewInfo.php',
            type: 'POST',
            data: {
                value: value,
                active: active,
                form: 'view_product_detail',
            },
            dataType: 'json',
            beforeSend: function() {
                loadApplication(true);
            },
            success: function(data) {
                $('body').append(data.html);
                _FRAMEWORK.loadWesite();
                _FRAMEWORK.Lazys();
                _FRAMEWORK.lightSliderPage();
                setTimeout(function() {
                    $('body .form_popup').find(".data_product_detail.active").css("display", "none");
                }, 1);
                $('body .form_popup').addClass('active');
                $("body ").css('overflow', 'hidden');
                $('body').on('click', '.close_form_popup', function() {
                    if ($(this).closest(' .form_popup').hasClass('active')) {
                        $(this).closest(' .form_popup').remove();
                        $("body ").css('overflow', 'auto');
                    }
                });

                $(".form_product_detail").btnNoneBlockPlugin({
                    button: 'btn_product_detail', // Thay thế class cho button
                    data: 'data_product_detail',
                    animation: false,
                    check_out: false,
                    close: false,
                });

                loadApplication(false);
            },
            complete: function() {}
        });
    });
    if ($('input.input_date').length > 0) {
        flatpickr("input.input_date", {
            enableTime: false,
            dateFormat: "d/m/Y",
            locale: "vn",
            maxDate: new Date(),
            shorthandCurrentMonth: true,
        });
    }
})