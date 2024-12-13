(function($) {
    $.fn.btnNoneBlockPlugin = function(options) {
        var settings = $.extend({
            class_form: 'form_nb',
            class_form_cc: 'form_cc_nb',
            button: 'button_nb',
            data: 'data_nb',
            animation: false,
            animation_time: 200,
            single: true,
            class_check: 'on',
            close: true,
            check_out: false,
            dropdowns: false,
            dropdowns_click_out: true,
            dropdowns_data: {
                input: 'data_input',
                output: 'data_output',
            },
            dropdowns_ajax_data: null,
        }, options);
        var class_out = "out";
        var data_inout = "data-nb";

        // Hàm chính xử lý sự kiện và class
        function btnNoneBlock(_this, _btn) {
            var data_btn_nb = _this.data('nb');
            if (!_this.hasClass(settings.class_check)) {
                if (settings.single) {
                    _this.closest("." + settings.class_form).find(_btn).removeClass(settings.class_check);
                    if (settings.animation) {
                        _this.closest("." + settings.class_form).find("." + settings.data).slideUp(settings.animation_time);
                    } else {
                        _this.closest("." + settings.class_form).find("." + settings.data).hide();
                    }
                } else {
                    _this.siblings(_btn).removeClass(settings.class_check);
                    if (settings.animation) {
                        _this.closest("." + settings.class_form).siblings("." + settings.class_form_cc).find("." + settings.data).slideUp(settings.animation_time);
                    } else {
                        _this.closest("." + settings.class_form).siblings("." + settings.class_form_cc).find("." + settings.data).hide();
                    }
                }
                _this.closest("." + settings.class_form).find("." + settings.button + "[" + data_inout + "='" + data_btn_nb + "']").addClass(settings.class_check);

                if (settings.animation) {
                    $("body ." + settings.class_form + " ." + settings.data + "[" + data_inout + "='" + data_btn_nb + "']").slideDown(settings.animation_time);
                } else {
                    $("body ." + settings.class_form + " ." + settings.data + "[" + data_inout + "='" + data_btn_nb + "']").show();
                }
            } else if (settings.close) {
                _this.removeClass(settings.class_check);
                if (settings.animation) {
                    $("." + settings.data + "[" + data_inout + "='" + data_btn_nb + "']").slideUp(settings.animation_time);
                } else {
                    $("." + settings.data + "[" + data_inout + "='" + data_btn_nb + "']").hide();
                }
            }
        };

        // Sự kiên click
        $("body").on("click", "." + settings.button, function() {
            btnNoneBlock($(this), "." + settings.button);
        });

        // Sự kiên click ra ngoài
        if (settings.check_out) {
            if (settings.single) {
                $("body ." + settings.class_form).find("." + settings.data).addClass(class_out);
            } else {
                $("body ." + settings.class_form).closest("." + settings.class_form_cc).find("." + settings.data).addClass(class_out);
            }
        };

        $(document).on('click', function(event) {
            if (!$(event.target).closest('body ' + "." + settings.button).length && !$(event.target).closest('body ' + "." + settings.data + ' *').length) {
                if (settings.animation) {
                    $('body ' + "." + settings.data + "." + class_out).slideUp(settings.animation_time);
                } else {
                    $('body ' + "." + settings.data + "." + class_out).hide();
                }
                $('body ' + "." + settings.data + "." + class_out).closest("." + settings.class_form).find("." + settings.button).removeClass(settings.class_check);
            }
        });

        // Dropdowns
        if (settings.dropdowns) {
            $("body").on("click", "." + settings.dropdowns_data.input, function() {
                // lấy giá trị
                var value_dropdowns = $(this).data('value');
                var html_dropdowns = $(this).html();
                if (settings.single) {
                    $(this).closest("." + settings.class_form).find("." + settings.dropdowns_data.output).html(html_dropdowns);
                    $(this).closest("." + settings.class_form).find("." + settings.dropdowns_data.output).data('value', value_dropdowns);
                    if (settings.dropdowns_click_out) {
                        $(this).closest("." + settings.class_form).find("." + settings.button).removeClass(settings.class_check);
                    }
                } else {
                    $(this).closest("." + settings.class_form_cc).siblings("." + settings.class_form).find("." + settings.dropdowns_data.output).html(html_dropdowns);
                    $(this).closest("." + settings.class_form_cc).siblings("." + settings.class_form).find("." + settings.dropdowns_data.output).data('value', value_dropdowns);
                    if (settings.dropdowns_click_out) {
                        $(this).closest("." + settings.class_form_cc).siblings("." + settings.class_form).find("." + settings.button).removeClass(settings.class_check);
                    }
                }
                // đóng
                if (settings.dropdowns_click_out) {
                    if (settings.animation) {
                        $(this).closest("." + settings.data).slideUp(settings.animation_time);
                    } else {
                        $(this).closest("." + settings.data).hide();
                    }
                }
                if (settings.dropdowns_ajax_data) {
                    settings.dropdowns_ajax_data(value_dropdowns, $(this));
                }
            });
        }

        return this;
    };
}(jQuery));