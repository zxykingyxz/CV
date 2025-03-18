(function($) {
    $.fn.dynamicUrlBuilder = function(options) {
        var settings = $.extend({
            type: 'click',
            button: '',
            buttonType: '',
            changeLink: false,
            loadAction: false,
            timeOutAjax: 1000,
            ajax_click: false,
            ajax_data: null
        }, options);

        var $form = $(this);
        var typingTimer = {};

        if ($form.length > 0 && settings.loadAction) {
            this.each(function() {
                getParamUrl($(this));
            });
        }
        // Xử lý khi input thay đổi
        $form.on('input change', 'input, select', function() {
            getParamUrl($(this).closest('form'));
        });

        // Xử lý khi click
        if (settings.type === "click" && typeof settings.button === "string" && settings.button.length > 0) {
            $form.on("click", `.${settings.button}`, function() {
                var $currentForm = $(this).closest($form);
                var url = getParamUrl($currentForm, settings.ajax_click);
                if (settings.changeLink) {
                    window.history.pushState(null, '', url);
                } else {
                    window.location.href = url;
                }
            });
        }

        function getParamUrl($formAll, allowAjax = true) {
            var listParam = {};
            var params = {};
            settings.timeOutAjax = parseInt(settings.timeOutAjax, 10) || 1000;

            // Duyệt qua tất cả input và select trong form
            $formAll.find('input, select').each(function() {
                var $this_items = $(this);
                var name = $this_items.attr('name');
                var value = "";
                var inputType = $this_items.attr('type');

                if ($this_items.is('select')) {
                    // Xử lý giá trị của select
                    value = $this_items.val();
                } else if (inputType === "checkbox" || inputType === "radio") {
                    // Xử lý giá trị checkbox/radio
                    if ($this_items.prop("checked")) {
                        value = $this_items.val();
                    }
                } else {
                    // Xử lý giá trị input thông thường
                    value = $this_items.val();
                }

                // Thêm giá trị vào danh sách tham số nếu hợp lệ
                if (value != null && value !== "") {
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
                .map(key => `${encodeURIComponent(key)}=${Array.isArray(params[key]) ? params[key].map(encodeURIComponent).join(",") : encodeURIComponent(params[key])}`)
                .join("&");

            // Tạo URL
            var com = $formAll.data('url') || '';
            var url = queryString ? `${com}?${queryString}` : `${com}`;

            // Xử lý ajax
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