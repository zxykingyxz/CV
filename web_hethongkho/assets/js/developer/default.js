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