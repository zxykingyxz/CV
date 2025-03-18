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

    $('.form_circle').animationCircle({
        numberOfItems: $('.form_circle').data('items'), // Tổng số items (phần tử)
        items: "items_circle",
        deviation: 100, // Khoảng cách vào trong (px)
        directionStart: 'top', // Hướng bắt đầu
        locationStart: 0, // Vị trí xuất phát
        directionClick: 'right', // Hướng khi click
        locationClick: 1, // Vị trí khi click
        animation: false // Hiệu ứng chuyển động (ms)
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
    $('.form_filter_price').updateUrlParams({
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
                complete: function() {}
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