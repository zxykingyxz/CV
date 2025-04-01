$(document).ready(function () {
    var form_criteria_main = $(".form_criteria_main");
    form_criteria_main.owlCarousel({
        dots: false,
        loop: true,
        center: false,
        nav: false,
        rewind: false,
        lazyLoad: true,
        responsive: {
            0: {
                items: 2,
                margin: 10,
            },
            600.5: {
                items: 3,
                margin: 15,
            },
            800.5: {
                items: 4,
                margin: 20,
            },
            1023.5: {
                items: 5,
                margin: 25,
            },
        },
        responsiveClass: true,
        autoplay: true,
        autoplayTimeout: 6000,
        autoplayHoverPause: true,
        navText: ["<i class='fas fa-angle-left'></i>", "<i class='fas fa-angle-right'></i>"],
    });

    $(".form_blogs_main").slick({
        slidesToShow: 3, // Hiển thị 3 item cùng lúc
        slidesToScroll: 1,
        vertical: true, // Chạy dọc
        adaptiveHeight: true, // Tự động căn chiều cao
        infinite: false, // Không loop
        dots: false, // Hiển thị chấm trượt
        autoplay: true, // Tự động chạy
        autoplaySpeed: 4000, // Chạy mỗi 6 giây
        draggable: true, // Cho phép kéo chuột để trượt
        verticalSwiping: true,
        responsive: [
            {
                breakpoint: 768, // Khi màn hình nhỏ hơn 768px (mobile)
                settings: {
                    slidesToShow: 2, // Hiển thị 2 item
                },
            },
        ],
    });

    var form_product_banchay_main = $(".form_product_banchay_main");
    form_product_banchay_main.owlCarousel({
        dots: false,
        loop: false,
        center: false,
        rewind: true,
        responsive: {
            0: {
                items: 2,
                margin: 10,
            },
            700.5: {
                nav: false,

                items: 3,
                margin: 15,
            },
            1023.5: {
                nav: true,

                items: 4,
                margin: 20,
            },
        },
        responsiveClass: true,
        autoplay: true,
        autoplayTimeout: 6000,
        autoplayHoverPause: true,
        navText: ["<i class='fas fa-angle-left'></i>", "<i class='fas fa-angle-right'></i>"],
    });

    var form_dm_product_index = $(".form_dm_product_index");
    form_dm_product_index.owlCarousel({
        dots: false,
        loop: false,
        nav: true,
        responsive: {
            0: {
                autoWidth: false,
                center: true,
                items: 1,
                margin: 12,
            },
            700.5: {
                items: 3,
                margin: 70,
            },
            1023.5: {
                autoWidth: true,
                center: false,
                items: 4,
                margin: 70,
            },
        },
        responsiveClass: true,
        autoplay: false,
        // autoplayTimeout: 6000,
        autoplayHoverPause: false,
        navText: ["<i class='fas fa-angle-double-left'></i>", "<i class='fas fa-angle-double-right'></i>"],
    });

    _FRAMEWORK.Lazys();
    _FRAMEWORK.loadWesite();
});
