(function($) {
    $.fn.updateUrlParams = function(options) {
        var config = $.extend({
            classItems: 'param_items',
            button: 'button',
            timeOutAjax: 1000,
            loadAction: false,
            changeLink: false,
            callbackEvent: null,
            callbackClick: null,
            callback: null
        }, options);

        var $formContainer = $(this);
        var ajaxTimeout = {};

        // load khi trang được tải
        if ($formContainer.length > 0 && config.loadAction) {
            $formContainer.each(function() {
                generateUrlWithParams($(this));
            });
        }
        // kiểm tra sự kiện
        $formContainer.on('input change', `.${config.classItems}`, function(event) {
            let $target = $(event.target);

            // Kiểm tra giá trị cũ, nếu giống thì không làm gì
            if ($target.data('previousValue') === $target.val()) {
                return;
            }
            $target.data('previousValue', $target.val());

            if ($target.is('input, select')) {
                if (typeof config.callbackEvent === 'function') {
                    config.callbackEvent($(this), $formContainer);
                }
                generateUrlWithParams($(this).closest($formContainer), $(this));
            }
        });


        // cài đặt nút click
        if (config.button !== "") {
            $formContainer.on("click", `.${config.button}`, function() {
                let $currentForm = $(this).closest($formContainer);

                if (typeof config.callbackClick === 'function') {
                    config.callbackClick($(this), $currentForm);
                }

                let url = generateUrlWithParams($currentForm, $(this), Boolean(config.changeLink));

                if (config.changeLink) {
                    window.history.pushState(null, '', url);
                } else {
                    window.location.href = url;
                }
            });
        }


        function generateUrlWithParams($formContainerAll, $this = null, allowAjax = true) {

            var params = new URLSearchParams();

            config.timeOutAjax = parseInt(config.timeOutAjax, 10) || 1000;

            $formContainerAll.find(`.${config.classItems}`).each(function() {

                let $el = $(this);
                let value = "";

                if ($el.is('input, select')) {
                    var name = $.trim($el.attr('name'));
                    if ($el.is(':checkbox, :radio')) {
                        value = $el.prop("checked") ? $.trim($el.val()) : null;
                    } else {
                        value = $.trim($el.val());
                    }
                }
                if (!name) return;

                if (value !== "" && value !== null) {
                    if (params.has(name)) {
                        params.set(name, params.get(name) + ',' + value);
                    } else {
                        params.set(name, value);
                    }
                }
            });

            var baseUrl = $formContainerAll.data('url') || '';
            var url = baseUrl + (params.toString() ? '?' + params.toString() : '');

            // Xử lý nếu có function và được phép chạy
            if (typeof config.callback === 'function' && allowAjax) {
                clearTimeout(ajaxTimeout[baseUrl]);
                ajaxTimeout[baseUrl] = setTimeout(function() {
                    config.callback(url, $formContainerAll, $this);
                }, config.timeOutAjax);
            }
            return url;
        }
        return this;
    };
}(jQuery));