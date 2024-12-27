// ao.js
AOS.init();
// wow.js
new WOW().init();
// liên hệ gọi lại
$('body').on('click', '.btn_clientSupport_js', function() {
    var _this = $(this);
    var phone = _this.closest('.form_clientSupport').find('.phone_clientSupport_js').val();
    if (validatePhone(phone)) {
        $.ajax({
            url: 'ajax/ajaxClientSupport.php',
            type: 'POST',
            data: {
                phone: phone,
            },
            dataType: 'JSON',

            beforeSend: function() {},
            success: function(data) {
                if (typeof window.stackTopLeft === 'undefined') {
                    window.stackTopLeft = new PNotify.Stack({
                        dir1: 'down',
                        dir2: 'left',
                        firstpos1: 25,
                        firstpos2: 25,
                        push: 'top',
                        maxStrategy: 'close'
                    });
                }
                if (data.status == 200) {
                    PNotify.success({
                        title: 'Success!',
                        text: data.message,
                        stack: window.stackTopLeft
                    });
                } else {
                    PNotify.error({
                        title: 'Oh No!',
                        text: data.message,
                        stack: window.stackTopLeft
                    });
                };
                _this.closest('.form_clientSupport').find('.phone_clientSupport_js').val('');
                _this.closest('.form_clientSupport').find('.error_clientSupport').text('');
            },
            complete: function() {}
        });
    } else {
        _this.closest('.form_clientSupport').find('.error_clientSupport').text('Số Điện Thoại Không Hợp Lệ !');
    };
});
// load submit
$('.submit_load').on('submit', function(e) {
    // Check if the form is valid
    if (this.checkValidity()) {
        loadApplication(true);
    }
});

// slider
var form_slider_main = $(".form_slider_main");
form_slider_main.owlCarousel({
    dots: false,
    loop: false,
    center: false,
    nav: false,
    items: 1,
    responsiveClass: true,
    autoplay: true,
    autoplayTimeout: 6000,
    autoplayHoverPause: true,
    navText: [
        "<i class='fas fa-angle-left'></i>",
        "<i class='fas fa-angle-right'></i>",
    ],
});

// gg dịch
$('body').on('click', '.data_output_gglang', function() {
    let value = $(this).data('lang');
    doGoogleLanguageTranslator(value);
});
// ()