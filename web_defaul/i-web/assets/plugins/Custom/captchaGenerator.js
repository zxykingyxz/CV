(function($) {
    $.fn.captchaGenerator = function(options) {
        // Các giá trị mặc định
        var settings = $.extend({
            button: '.btn_captcha_js',
            codeCaptcha: '.code_captcha',
            fontWeight: 400,
            fontSize: 13,
            timeOutAjax: 100,
            fontFamily: 'sans-serif',
            colorCaptcha: '#222020',
            defaultSize: '70x17',
            defaultLength: 6,
            firstLoad: true,
            ajax_data: null,
        }, options);

        var typingTimer;

        // Hàm tạo captcha
        function generateCaptcha(length) {
            var chars = 'ABCDEFGHJKMNPQRSTUVWXYZ123456789qwertyuiopasdfghjklzxcvbnm';
            var captcha = '';
            for (var i = 0; i < length; i++) {
                captcha += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            return captcha;
        }

        // Xử lý sự kiện click
        return this.each(function() {
            var $this = $(this);

            var $button = $(this).find(settings.button);

            $button.on('click', function() {
                if (!$button.hasClass('on')) {
                    $button.addClass('on');

                    // Lấy dữ liệu từ các thuộc tính
                    var size = $button.data('size') || settings.defaultSize;
                    var length = $button.data('length') || settings.defaultLength;

                    // Xử lý kích thước canvas
                    var sizeParts = (size && size.includes('x')) ? size.split('x') : settings.defaultSize.split('x');
                    var widthCanvas = parseInt(sizeParts[0], 10);
                    var heightCanvas = parseInt(sizeParts[1], 10);

                    // Tạo mã captcha
                    var captchaString = generateCaptcha(length);
                    // Callback AJAX nếu có
                    if ($.isFunction(settings.ajax_data)) {
                        clearTimeout(typingTimer);
                        typingTimer = setTimeout(function() {
                            settings.ajax_data(captchaString, $this);
                        }, settings.timeOutAjax);
                    }

                    // Tạo canvas với ID duy nhất
                    var uniqueId = 'code_captcha_' + Math.random().toString(36).substr(2, 9);
                    var canvas = $('<canvas/>', { id: uniqueId });
                    canvas.attr({ width: widthCanvas, height: heightCanvas });

                    let captcha = canvas[0];
                    if (captcha && captcha.getContext) {
                        let ctx = captcha.getContext('2d');
                        ctx.font = settings.fontWeight + ' ' + settings.fontSize + 'px ' + settings.fontFamily;
                        ctx.fillStyle = settings.colorCaptcha;
                        ctx.textAlign = "center";
                        ctx.textBaseline = "middle";
                        ctx.fillText(captchaString, widthCanvas / 2, heightCanvas / 2);

                        $this.find(settings.codeCaptcha).html(canvas);
                        setTimeout(function() {
                            $button.removeClass('on');
                        }, 500);
                    }
                }
            });

            if (settings.firstLoad && $button.length > 0) {
                $button.click();
            }
        });
    };
})(jQuery);