// ============ tool mobile =============
$(".form_tool_mobile").btnNoneBlockPlugin({
    button: 'btn_tool_mobile', // Thay thế class cho button
    data: 'data_tool_mobile',
    animation: false,
    check_out: true,
    close: true,
});
// ============= hotline ===============
$(".form_hotline").btnNoneBlockPlugin({
    button: 'btn_hotline', // Thay thế class cho button
    data: 'data_hotline',
    animation: true,
    check_out: true,
    close: true,
});
// ========= slider trang chủ ========
$(".form_slider_main").owlCarousel({
    dots: false,
    loop: false,
    center: false,
    nav: false,
    items: 1,
    responsiveClass: true,
    autoplay: true,
    autoplayTimeout: time_slider,
    autoplayHoverPause: true,
    navText: [
        "<i class='fas fa-angle-left'></i>",
        "<i class='fas fa-angle-right'></i>",
    ],
});

// ============= load submit ===========
$('.submit_load').on('submit', function(e) {
    // Check if the form is valid
    if (this.checkValidity()) {
        loadApplication(true);
    }
});

// ==== auto load lại trang khi đổi khung hình ====
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

// ========== Nội dung trang web ========
$("body .content img").each(function() {
    let $width_images = $(this).attr("width") || $(this).width();
    let $height_images = $(this).attr("height") || $(this).height();

    if ($width_images && $height_images) {
        $(this).css("width", $width_images);
        $(this).css("aspect-ratio", $width_images + '/' + $height_images);
    }
});