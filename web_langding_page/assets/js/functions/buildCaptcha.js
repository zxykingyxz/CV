$(".form_captcha_js").captchaGenerator({
    button: '.btn_captcha_js',
    fontSize: 16,
    fontWeight: 400,
    colorCaptcha: '#717070',
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