// ============ tool mobile =============
$(".form_tool_mobile").btnNoneBlockPlugin({
    button: "btn_tool_mobile", // Thay thế class cho button
    data: "data_tool_mobile",
    animation: false,
    check_out: true,
    close: true,
});
// ============= hotline ===============
$(".form_hotline").btnNoneBlockPlugin({
    button: "btn_hotline", // Thay thế class cho button
    data: "data_hotline",
    animation: true,
    check_out: true,
    close: true,
});
// ========= liên hệ gọi lại ==========
$("body").on("click", ".btn_clientSupport_js", function () {
    var _this = $(this);
    var phone = _this.closest(".form_clientSupport").find(".phone_clientSupport_js").val();
    if (validatePhone(phone)) {
        $.ajax({
            url: "ajax/default/ajaxClientSupport.php",
            type: "POST",
            data: {
                phone: phone,
            },
            dataType: "JSON",
            beforeSend: function () {},
            success: function (data) {
                if (data.status == 200) {
                    _FRAMEWORK.showNotification({
                        title: "Yêu cầu hỗ trợ",
                        message: data.message,
                        status: "success",
                    });
                } else {
                    _FRAMEWORK.showNotification({
                        title: "Yêu cầu hỗ trợ",
                        message: data.message,
                        status: "error",
                    });
                }
                _this.closest(".form_clientSupport").find(".phone_clientSupport_js").val("");
                _this.closest(".form_clientSupport").find(".error_clientSupport").text("");
            },
            complete: function () {},
        });
    } else {
        _this.closest(".form_clientSupport").find(".error_clientSupport").text("Số Điện Thoại Không Hợp Lệ !");
    }
});
// ========= slider trang chủ ========
const swiper = new Swiper(".form_slider_main", {
    effect: "fade",
    slidesPerView: "auto",
    loop: true,
    dots: true,
    autoplay: {
        delay: time_slider,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});
//  ====== slider trang chi tiết sản phẩm ========
$(".form_product_detail").owlCarousel({
    dots: true,
    loop: false,
    center: false,
    nav: true,
    rewind: true,
    lazyLoad: true,
    responsive: {
        0: {
            items: 2,
            margin: 10,
        },
        500.5: {
            items: 3,
            margin: 10,
        },
        750.5: {
            items: 4,
            margin: 15,
        },
        1023.5: {
            items: 5,
            margin: 15,
        },
    },
    responsiveClass: true,
    autoplay: true,
    autoplayTimeout: 6000,
    autoplayHoverPause: true,
    navText: ["<i class='fas fa-angle-left'></i>", "<i class='fas fa-angle-right'></i>"],
});
// ============= load submit ===========
$(".submit_load").on("submit", function (e) {
    // Check if the form is valid
    if (this.checkValidity()) {
        loadApplication(true);
    }
});

// ==== auto load lại trang khi đổi khung hình ====
var resizeTimer;
var currentWidth = $(window).width();
$(window).on("resize", function () {
    var newWidth = $(window).width();
    if (newWidth !== currentWidth && (currentWidth - newWidth > 100 || newWidth - currentWidth > 100)) {
        currentWidth = newWidth;
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function () {
            location.reload(); // Tự động load lại trang sau khi dừng resize
        }, 300); // Thời gian chờ sau khi dừng resize (ms)
    }
});
// ======== tạo captcha liên hệ ==========
$(".form_captcha_contact").captchaGenerator({
    button: ".btn_captcha_contact",
    codeCaptcha: ".code_captcha_contact",
    ajax_data: function (value, _this) {
        $.ajax({
            url: "ajax/default/buildCaptcha.php",
            type: "POST",
            data: {
                captcha: value,
                name: "captcha_code",
            },
            dataType: "Json",
            success: function (data) {},
        });
    },
});

// ========== Nội dung trang web ========
$("body .content img").each(function () {
    let $width_images = $(this).attr("width") || $(this).width();
    let $height_images = $(this).attr("height") || $(this).height();

    if ($width_images && $height_images) {
        $(this).css("width", $width_images);
        $(this).css("aspect-ratio", $width_images + "/" + $height_images);
    }
});
