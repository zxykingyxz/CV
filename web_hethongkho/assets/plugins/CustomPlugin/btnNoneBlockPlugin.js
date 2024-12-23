(function($) {
    $.fn.btnNoneBlockPlugin = function(options) {
        var settings = $.extend({
            namespace: 'btnnb', // Thêm namespace để giảm xung đột
            class_form_cc: 'form-cc',
            button: 'button',
            data: 'data',
            class_check: 'on',
            animation: false,
            animation_time: 200,
            single: true,
            close: false,
            scroll_top: false,
            scroll_hiden: false,
            event_hover: false,
            check_out: false,
            dropdowns: false,
            dropdowns_click_out: true,
            dropdowns_data: {
                input: 'dropdown-input',
                output: 'dropdown-output'
            },
            dropdowns_ajax_data: null
        }, options);

        var class_out = settings.namespace + "-out";
        var data_inout = "data-nb";
        var $form = $(this);

        // Hàm chính xử lý sự kiện và class
        function btnNoneBlock($button, btnSelector) {
            var dataBtn = $button.data('nb');
            var $target = $("." + settings.data + "[" + data_inout + "='" + dataBtn + "']");
            if (!$button.hasClass(settings.class_check)) {
                // Xử lý khi bật nút
                if (settings.single) {
                    $form.find(btnSelector).removeClass(settings.class_check);
                    $form.find("." + settings.data).stop(true, true).slideUp(settings.animation ? settings.animation_time : 0);
                } else {
                    $button.siblings(btnSelector).removeClass(settings.class_check);
                    $form.siblings("." + settings.class_form_cc).find("." + settings.data).stop(true, true).slideUp(settings.animation ? settings.animation_time : 0);
                }

                $form.find("." + settings.button + "[" + data_inout + "='" + dataBtn + "']").addClass(settings.class_check);
                $target.stop(true, true).slideDown(settings.animation ? settings.animation_time : 0);
                if (settings.scroll_top) {
                    $("html, body").animate({
                        scrollTop: ($button.offset().top) - 180,
                    }, 500);
                }
                if (settings.scroll_hiden) {
                    $("body ").css('overflow', 'hidden');
                }
            } else if (settings.close) {
                // Xử lý khi tắt nút
                $button.removeClass(settings.class_check);
                $target.stop(true, true).slideUp(settings.animation ? settings.animation_time : 0);
                if (settings.scroll_hiden) {
                    $("body ").css('overflow', 'auto');
                }
            }
        }

        // Gán sự kiện click cho nút
        if (settings.event_hover === true) {
            this.on("mouseenter", "." + settings.button, function() {
                btnNoneBlock($(this), "." + settings.button);
            });
            if (settings.close) {
                this.on("mouseleave", "." + settings.button, function() {
                    var $button = $(this);
                    var dataBtn = $button.data('nb');
                    var $target = $("." + settings.data + "[" + data_inout + "='" + dataBtn + "']");
                    $button.removeClass(settings.class_check);
                    $target.stop(true, true).slideUp(settings.animation ? settings.animation_time : 0);
                    if (settings.scroll_hiden) {
                        $("body ").css('overflow', 'auto');
                    }
                });
            }
        } else {
            this.on("click", "." + settings.button, function() {
                btnNoneBlock($(this), "." + settings.button);
            });
        }

        // Xử lý click ra ngoài
        if (settings.check_out) {
            if (settings.single) {
                $("body").find($form).find("." + settings.data).addClass(class_out);
            } else {
                $("body").find($form).siblings("." + settings.class_form_cc).find("." + settings.data).addClass(class_out);
            }
            $(document).on('click', function(event) {
                if (!$(event.target).closest('body ' + "." + settings.button).length && !$(event.target).closest('body ' + "." + settings.data + ' *').length) {
                    var $outElements = $("." + settings.data + "." + class_out);
                    $outElements.stop(true, true).slideUp(settings.animation ? settings.animation_time : 0);
                    $outElements.closest($form).find("." + settings.button).removeClass(settings.class_check);
                    if (settings.scroll_hiden) {
                        $("body ").css('overflow', 'auto');
                    }
                }
            }.bind(this));
        }

        // Dropdowns
        if (settings.dropdowns) {
            this.on("click", "." + settings.dropdowns_data.input, function() {
                var $dropdown = $(this);
                var value = $dropdown.data('value');
                var html = $dropdown.html();

                var $form = $dropdown.closest($form);
                var $output = $form.find("." + settings.dropdowns_data.output);

                $output.html(html).data('value', value);

                if (settings.dropdowns_click_out) {
                    $form.find("." + settings.button).removeClass(settings.class_check);
                    $dropdown.closest("." + settings.data).stop(true, true).slideUp(settings.animation ? settings.animation_time : 0);
                    if (settings.scroll_hiden) {
                        $("body ").css('overflow', 'auto');
                    }
                }

                // Callback AJAX nếu có
                if ($.isFunction(settings.dropdowns_ajax_data)) {
                    settings.dropdowns_ajax_data(value, $dropdown);
                }
            });
        }
        return this;
    };
}(jQuery));