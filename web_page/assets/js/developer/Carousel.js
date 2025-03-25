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
                items: 3,
                margin: 10,
            },
            600.5: {
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
    var form_blogs_main = $(".form_blogs_main");
    form_blogs_main.owlCarousel({
        dots: false,
        loop: false,
        center: false,
        nav: false,
        rewind: true,
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
        navText: ["<i class='fas fa-angle-left'></i>", "<i class='fas fa-angle-right'></i>"],
    });
    var form_partner = $(".form_partner");
    form_partner.owlCarousel({
        dots: false,
        loop: false,
        center: false,
        nav: false,
        responsive: {
            0: {
                items: 2,
                margin: 12,
            },
            700.5: {
                items: 3,
                margin: 18,
            },
        },
        responsiveClass: true,
        autoplay: true,
        autoplayTimeout: 6000,
        autoplayHoverPause: true,
        navText: ["<i class='fas fa-angle-left'></i>", "<i class='fas fa-angle-right'></i>"],
    });

    $(".form_project_main").flipster({
        style: "carousel",
        spacing: -0.5,
        loop: true,
        nav: true,
        buttons: false,
    });
    _FRAMEWORK.Lazys();
    _FRAMEWORK.loadWesite();
});
