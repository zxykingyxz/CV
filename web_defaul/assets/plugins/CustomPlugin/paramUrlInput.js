(function($) {
    $.fn.paramUrlInput = function(options) {
        var settings = $.extend({
            type: 'click',
            button: 'button',
            timeOutAjax: 1000,
            ajax_click: false,
            ajax_data: null
        }, options);

        var $form = $(this);
        var typingTimer = {};

        if ($form.length > 0) {
            this.each(function() {
                getParamUrl($(this));
            });
        }
        // Xử lý khi input thay đổi
        $form.find('input').on('input', function() {
            getParamUrl($(this).closest($form));
        });

        // Xử lý khi click
        if (settings.type === "click") {
            $form.on("click", `.${settings.button}`, function() {
                var $currentForm = $(this).closest($form);
                var url = getParamUrl($currentForm, settings.ajax_click);
                window.location.href = url;
            });
        }

        function getParamUrl($formAll, allowAjax = true) {
            var listParam = {};
            var params = {};

            // Duyệt qua tất cả input trong form
            $formAll.find('input').each(function() {
                var $input = $(this);
                var name = $input.attr('name');
                var value = "";
                var inputType = $input.attr('type');

                // Xử lý giá trị checkbox/radio
                if (inputType === "checkbox" || inputType === "radio") {
                    if ($input.prop("checked")) {
                        value = $input.val();
                    }
                } else {
                    value = $input.val();
                }

                // Thêm giá trị vào danh sách tham số nếu hợp lệ
                if (value.length > 0) {
                    if (!listParam[name]) {
                        listParam[name] = [];
                    }
                    listParam[name].push(value);
                }
            });

            // Chuyển đổi listParam thành params
            Object.keys(listParam).forEach(key => {
                params[key] = listParam[key];
            });

            // Xây dựng chuỗi query string
            var queryString = Object.keys(params)
                .map(key => `${key}=${Array.isArray(params[key]) ? params[key].join(",") : params[key]}`)
                .join("&");

            // Tạo URL
            var com = $formAll.data('url');
            var url = queryString ? `${com}?${queryString}` : `${com}`;
            // xử lý ajax
            if ($.isFunction(settings.ajax_data) && (allowAjax == true)) {
                clearTimeout(typingTimer[com]);
                typingTimer[com] = setTimeout(function() {
                    settings.ajax_data(url, $formAll);
                }, settings.timeOutAjax);
            }
            return url;
        }
        return this;
    };
}(jQuery));