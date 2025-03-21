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
        animationAction: 0, // Hiệu ứng chuyển động (ms)
        rotationSpeed: 1,
    });

    $('.btn_scroll').scrollToTarget({
        scrollSpeed: 600, // Tốc độ cuộn chậm hơn
    });

    gsap.registerPlugin(ScrollTrigger, TextPlugin);

    for (i = 1; i <= 10; i++) {
        gsap.from(".title_gsap_" + i, {
            scrollTrigger: {
                trigger: ".title_gsap_" + i,
                scrub: 0.5, // Mượt hơn khi cuộn
                start: "top 80%", // Kích hoạt sớm hơn một chút
                end: "top 50%", // Kéo dài hiệu ứng
            },
            x: 0,
            y: -80, // Giảm khoảng cách rơi xuống
            opacity: 0,
            duration: 1.2,
            ease: "power2.out" // Làm chậm dần khi kết thúc
        });
        let $element = $('.gsap_text_' + i);
        if ($element.length) {
            let value = $element.text().trim();
            gsap.to(".gsap_text_" + i, {
                scrollTrigger: {
                    trigger: ".gsap_text_" + i,
                    start: "top 90%",
                    end: "top 60%",
                    scrub: 5,
                },
                duration: 2,
                text: {
                    value: value,
                    delimiter: ""
                },
                ease: "power1.out",
            });
        }
        gsap.from(".image_fade_scale_" + i, {
            scrollTrigger: {
                trigger: ".image_fade_scale_" + i,
                start: "top 80%",
                end: "top 50%",
                scrub: 2,
            },
            opacity: 0,
            scale: 0.8,
            duration: 2,
            ease: "power2.out",
        });
        gsap.from(".form_opacity_" + i, {
            scrollTrigger: {
                trigger: ".form_opacity_" + i,
                start: "top 80%",
                end: "top 40%",
                scrub: 2,
            },
            opacity: 0,
            duration: 2,
            ease: "power2.out",
        });
        gsap.from(".form_left_" + i, {
            scrollTrigger: {
                trigger: ".form_left_" + i,
                start: "top 90%",
                end: "top 70%",
                scrub: 3,
            },
            opacity: 0,
            x: -100,
            duration: 5,
            ease: "power2.out",
        });
        gsap.from(".form_right_" + i, {
            scrollTrigger: {
                trigger: ".form_right_" + i,
                start: "top 90%",
                end: "top 70%",
                scrub: 3,
            },
            opacity: 0,
            x: 100,
            duration: 5,
            ease: "power2.out",
        });
        gsap.from(".form_product_" + i, {
            scrollTrigger: {
                trigger: ".form_product_" + i,
                start: "top 90%",
                end: "top 50%",
                scrub: 5,
            },
            opacity: 0,
            y: -100,
            duration: 10,
            ease: "power2.out",
        });
    }
    gsap.from(".form_left_client", {
        scrollTrigger: {
            trigger: ".form_left_client",
            start: "top 90%",
            end: "top 10%",
            scrub: 3,
        },
        opacity: 0,
        x: -100,
        duration: 5,
        ease: "power2.out",
    });
    gsap.from(".form_right_client", {
        scrollTrigger: {
            trigger: ".form_right_client",
            start: "top 90%",
            end: "top 40%",
            scrub: 3,
        },
        opacity: 0,
        scale: 0.6,
        duration: 5,
        ease: "power2.out",
    });
    gsap.from(".form_left_dk", {
        scrollTrigger: {
            trigger: ".form_left_dk",
            start: "top 90%",
            end: "top 50%",
            scrub: 3,
        },
        opacity: 0,
        scale: 0.6,
        duration: 5,
        ease: "power2.out",
    });
    gsap.from(".form_right_dk", {
        scrollTrigger: {
            trigger: ".form_right_dk",
            start: "top 90%",
            end: "top 50%",
            scrub: 3,
        },
        opacity: 0,
        x: 100,
        duration: 5,
        ease: "power2.out",
    });
})