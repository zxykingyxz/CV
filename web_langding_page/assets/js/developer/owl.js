$(document).ready(function() {
    var form_c1_procuct = $(".form_c1_procuct");
    form_c1_procuct.owlCarousel({
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
            600.5: {
                items: 4,
                margin: 10,
            },
            700.5: {
                items: 5,
                margin: 15,
            },
            800.5: {
                items: 6,
                margin: 15,
            },
            900.5: {
                items: 7,
                margin: 15,
            },
            1023.5: {
                items: 8,
                margin: 20,
            },
        },
        responsiveClass: true,
        autoplay: true,
        autoplayTimeout: 6000,
        autoplayHoverPause: true,
        navText: [
            "<i class='fas fa-angle-left'></i>",
            "<i class='fas fa-angle-right'></i>",
        ],
    });
    var form_blogs = $(".form_blogs");
    form_blogs.owlCarousel({
        dots: false,
        loop: false,
        center: false,
        nav: false,
        responsive: {
            0: {
                items: 1,
                margin: 10,
            },
            600: {
                items: 2,
                margin: 10,
            },
            800.5: {
                items: 3,
                margin: 15,
            },
            1023.5: {
                items: 4,
                margin: 20,
            },
        },
        responsiveClass: true,
        autoplay: true,
        autoplayTimeout: 6000,
        autoplayHoverPause: true,
        navText: [
            "<i class='fas fa-angle-left'></i>",
            "<i class='fas fa-angle-right'></i>",
        ],
    });
    var form_product_sale = $(".form_product_sale");
    form_product_sale.owlCarousel({
        dots: false,
        loop: false,
        center: false,
        nav: true,
        responsive: {
            0: {
                items: 2,
                margin: 10,
            },
            639.5: {
                items: 3,
                margin: 15,
            },
            767.5: {
                items: 4,
                margin: 15,
            },
            1023.5: {
                items: 6,
                margin: 15,
            },
        },
        responsiveClass: true,
        autoplay: true,
        autoplayTimeout: 6000,
        autoplayHoverPause: true,
        navText: [
            "<i class='fas fa-angle-left'></i>",
            "<i class='fas fa-angle-right'></i>",
        ],
    });
    var form_viewed_product = $(".form_viewed_product");
    form_viewed_product.owlCarousel({
        dots: false,
        loop: false,
        center: false,
        nav: true,
        responsive: {
            0: {
                items: 1,
                margin: 10,
            },
            500.5: {
                items: 2,
                margin: 15,
            },
            900.5: {
                items: 3,
                margin: 15,
            },
            1023.5: {
                items: 4,
                margin: 20,
            },
        },
        responsiveClass: true,
        autoplay: true,
        autoplayTimeout: 6000,
        autoplayHoverPause: true,
        navText: [
            "<i class='fas fa-angle-left'></i>",
            "<i class='fas fa-angle-right'></i>",
        ],
    });
    _FRAMEWORK.Lazys();

});