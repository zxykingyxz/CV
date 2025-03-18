(function($) {
    $.fn.btnNoneBlockPlugin = function(options) {
        var settings = $.extend({
            namespace: 'btnnb_btnNoneBlockPlugin', // Thêm namespace để giảm xung đột
            class_form_cc: 'form_btnNoneBlockPlugin',
            button: 'button_btnNoneBlockPlugin',
            data: 'data_btnNoneBlockPlugin',
            class_check: 'on',
            animation: false,
            animation_time: 200,
            single: true,
            close: false,
            scroll_top: false,
            top_height: 180,
            scroll_hiden: false,
            event_hover: false,
            check_out: false,
            dropdowns: false,
            dropdowns_click_out: true,
            dropdowns_data: {
                input: 'dropdown-input',
                output: 'dropdown-output'
            },
            timeOutAjax: 200,
            onPluginDropdownsComplete: null,
            onPluginComplete: null,
        }, options);
        var data_inout = "data-nb";
        var class_out = settings.namespace + "_out";

        // Hàm chính xử lý sự kiện và class
        function btnNoneBlock($button, $formAll) {
            let dataBtn = $button.data('nb');
            let $target = $("." + settings.data + "[" + data_inout + "='" + dataBtn + "']");
            if (!$button.hasClass(settings.class_check)) {
                // Xử lý khi bật nút
                if (settings.single) {
                    $formAll.find("." + settings.button).removeClass(settings.class_check);
                    $formAll.find("." + settings.data).stop(true, true).slideUp(settings.animation ? settings.animation_time : 0);
                } else {
                    $button.siblings("." + settings.button).removeClass(settings.class_check);
                    $formAll.siblings("." + settings.class_form_cc).find("." + settings.data).stop(true, true).slideUp(settings.animation ? settings.animation_time : 0);
                }

                $formAll.find("." + settings.button + "[" + data_inout + "='" + dataBtn + "']").addClass(settings.class_check);
                $target.stop(true, true).slideDown(settings.animation ? settings.animation_time : 0);
                if (settings.scroll_top) {
                    $("html, body").animate({
                        scrollTop: ($button.offset().top) - settings.top_height,
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
            // Gọi callback nếu có
            if (typeof settings.onPluginComplete === 'function') {
                settings.onPluginComplete($button);
            }
        }

        //  dropdowns
        return this.each(function() {
            var $form = $(this);
            var typingTimer;
            // Gán sự kiện click cho nút
            if (settings.event_hover === true) {
                $form.on("mouseenter", "." + settings.button, function() {
                    btnNoneBlock($(this), $(this).closest($form));
                });
                if (settings.close) {
                    $form.on("mouseleave", "." + settings.button, function() {
                        let $button = $(this);
                        let dataBtn = $button.data('nb');
                        let $target = $("." + settings.data + "[" + data_inout + "='" + dataBtn + "']");
                        $button.removeClass(settings.class_check);
                        $target.stop(true, true).slideUp(settings.animation ? settings.animation_time : 0);
                        if (settings.scroll_hiden) {
                            $("body ").css('overflow', 'auto');
                        }
                    });
                }
            } else {
                $form.on("click", "." + settings.button, function() {
                    btnNoneBlock($(this), $(this).closest($form));
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
                $form.on("click", "." + settings.dropdowns_data.input, function() {
                    let $dropdown = $(this);
                    let value = $dropdown.data('value');
                    let html = $dropdown.html();
                    let $formAll = $dropdown.closest($form);
                    let $output = $formAll.find("." + settings.dropdowns_data.output);

                    $output.html(html).data('value', value);

                    if (settings.dropdowns_click_out) {
                        $formAll.find("." + settings.button).removeClass(settings.class_check);
                        $dropdown.closest("." + settings.data).stop(true, true).slideUp(settings.animation ? settings.animation_time : 0);
                        if (settings.scroll_hiden) {
                            $("body ").css('overflow', 'auto');
                        }
                    }

                    // Callback AJAX nếu có
                    if ($.isFunction(settings.onPluginDropdownsComplete)) {
                        clearTimeout(typingTimer);
                        typingTimer = setTimeout(function() {
                            settings.onPluginDropdownsComplete(value, $dropdown);
                        }, settings.timeOutAjax);
                    }
                });
            }
        });
    };
}(jQuery));