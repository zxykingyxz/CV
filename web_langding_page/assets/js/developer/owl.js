$(document).ready(function() {
    var form_benerfit_mb = $(".form_benerfit_mb");
    form_benerfit_mb.owlCarousel({
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

    var swiper = new Swiper(".introduce_main", {
        slidesPerView: 1.5,
        spaceBetween: 20,
        centeredSlides: true,
        loop: true,
        navigation: {
            nextEl: ".swiper_button_design_next",
            prevEl: ".swiper_button_design_prev",
        },
    });
    _FRAMEWORK.Lazys();

});