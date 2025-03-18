$(".form_captcha_js").captchaGenerator({
    button: '.btn_captcha_js',
    codeCaptcha: '.code_captcha',
    ajax_data: function(value, _this) {
        $.ajax({
            url: 'ajax/default/buildCaptcha.php',
            type: 'POST',
            data: {
                captcha: value,
                name: 'news_captcha',
            },
            dataType: 'Json',
            success: function(data) {}
        });
    },
});