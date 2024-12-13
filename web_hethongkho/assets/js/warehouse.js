_FRAMEWORK = {
    init: function() {
        _FRAMEWORK.Lazys();
        _FRAMEWORK.table();
        _FRAMEWORK.login_signup();
        _FRAMEWORK.Dashboard();
        _FRAMEWORK.captcha();
        _FRAMEWORK.popup();
        _FRAMEWORK.notification();
        _FRAMEWORK.search();
        _FRAMEWORK.excel();
        _FRAMEWORK.delete();
        _FRAMEWORK.all();
    },

    Lazys: function() {
        if (exists($(".lazy"))) {
            var lazyLoadInstance = new LazyLoad({
                elements_selector: ".lazy",
            });
        }
        // TỰ ĐỘNG LOAD TRANG KHI THU NHỎ KÍCH THƯỚC
        var resizeTimer;
        var currentWidth = $(window).width();
        $(window).on('resize', function() {
            if (isMobileDevice()) {
                var newWidth = $(window).width();
                if (newWidth !== currentWidth) {
                    currentWidth = newWidth;
                    clearTimeout(resizeTimer);
                    resizeTimer = setTimeout(function() {
                        location.reload();
                    }, 300);
                }
            }
        });
    },
    login_signup: function() {
        // chọn ngàng nghề
        $('body').on('click', 'input[name="data[profession]"]', function() {
            if (!$('body .form_profession').hasClass('on')) {
                $('body .form_profession').addClass('on');
            }
        });
        $('body').on('click', '.close_form_profession', function() {
            if ($(this).closest(' .form_profession').hasClass('on')) {
                $(this).closest(' .form_profession').removeClass('on');
            }
        });
        $('body').on('click', '.items_list_profession', function() {
            var value_profession = $(this).data('value');
            if ($(this).closest(' .form_profession').hasClass('on')) {
                $(this).closest(' .form_profession').removeClass('on');
            };
            $('body input[name="data[profession]"]').val(value_profession);
        });
        var maxLength = 30;
        $('input[name="data[subdomain]"]').on('input', function() {
            var inputValue = $(this).val().toLowerCase()
                .normalize("NFD")
                .replace(/[\u0300-\u036f]/g, "")
                .replace(/[^a-z0-9]/g, "");
            if (inputValue.length > maxLength) {
                inputValue = inputValue.substring(0, maxLength);
                alert('Bạn chỉ có thể nhập tối đa ' + maxLength + ' ký tự.');
            }
            $(this).val(inputValue);
        });
        // copy
        $('body .button_copy').click(function() {
            var copyText = $(this).data('copy');
            loadApplication(true);
            if (copyText.length > 0) {
                var tempInput = $('<input>');
                $('body').append(tempInput);
                tempInput.val(copyText).select();
                document.execCommand('copy');
                tempInput.remove();
                $(this).css("color", "#808080");
                loadApplication(false);
            }
        });
        // hiển thị password
        $('body .showPassword').click(function() {
            var passwordField = $(this).closest('.form_password').find('input[name="data[password]"]');
            var passwordFieldType = passwordField.attr('type');

            if (passwordFieldType === 'password') {
                passwordField.attr('type', 'text');
                $(this).addClass('on');
            } else {
                passwordField.attr('type', 'password');
                $(this).removeClass('on');
            }
        });
        // đăng xuất
        $('body').on('click', '.button_logout', function() {
            $.ajax({
                url: 'ajax/warehouse/log_out.php',
                type: 'POST',
                data: "",
                dataType: 'JSON',
                beforeSend: function() {
                    loadApplication(true);
                },
                success: function(data) {
                    window.location.href = data.url;
                },
                complete: function() {
                    loadApplication(false);
                }
            });
        });

    },
    Dashboard: function() {
        //  Select All Chart
        $(document).btnNoneBlockPlugin({
            class_form: 'form_all_chart',
            button: 'btn_all_chart', // Thay thế class cho button
            data: 'data_all_chart',
            animation: true,
            check_out: true,
            dropdowns: true,
            dropdowns_data: {
                input: 'data_input_all_chart',
                output: 'data_output_all_chart',
            },
            dropdowns_ajax_data: function(value) {
                $.ajax({
                    url: _URL,
                    type: 'POST',
                    data: {
                        act: 'man',
                        src: 'dashboard',
                        form: 'thong-ke',
                        value_c1: value,
                    },
                    dataType: 'JSON',
                    beforeSend: function() {
                        loadApplication(true);
                    },
                    success: function(data) {
                        viewChart_storeHouse(data);
                        $('body .form_btn_chart_dashboard').find('.form_chart_dashboard_c2').html(data.html.html_chart);

                    },
                    complete: function() {
                        loadApplication(false);
                    },
                });
            },
        });
        // Select Năm 
        $(document).btnNoneBlockPlugin({
            class_form: 'form_dashboard_year_nb',
            button: 'btn_dashboard_year_nb',
            data: 'data_dashboard_year_nb',
            animation: true,
            check_out: true,
            dropdowns: true,
            dropdowns_data: {
                input: 'data_dashboard_input_year',
                output: 'data_dashboard_output_year',
            },
            dropdowns_ajax_data: function(value) {
                value_c1 = $("body .form_option_dashboard .data_output_all_chart").data("value");
                var value_c2;
                switch (value_c1) {
                    case 'tuan':
                        value_c2_month = $("body .form_dashboard_week_month_nb .data_dashboard_output_month").data("value");
                        value_c2 = value_c2_month + '/' + value;
                        break;
                    case 'thang':
                    case 'quy':
                        value_c2 = value;
                        break;
                    default:
                        break;
                }

                $.ajax({
                    url: _URL,
                    type: 'POST',
                    data: {
                        act: 'man',
                        src: 'dashboard',
                        form: 'thong-ke',
                        value_c1: value_c1,
                        value_c2: value_c2,
                    },
                    dataType: 'JSON',
                    beforeSend: function() {
                        loadApplication(true);
                    },
                    success: function(data) {
                        viewChart_storeHouse(data);
                    },
                    complete: function() {
                        loadApplication(false);
                    },
                });
            },
        });
        // Select Tháng 
        $(document).btnNoneBlockPlugin({
            class_form: 'form_dashboard_week_month_nb',
            button: 'btn_dashboard_week_month_nb', // Thay thế class cho button
            data: 'data_dashboard_week_month_nb',
            animation: true,
            check_out: true,
            dropdowns: true,
            dropdowns_data: {
                input: 'data_dashboard_input_month',
                output: 'data_dashboard_output_month',
            },
            dropdowns_ajax_data: function(value) {

                value_c1 = $("body .form_option_dashboard .data_output_all_chart").data("value");
                value_c2_year = $("body .form_dashboard_year_nb .data_dashboard_output_year").data("value");
                value_c2 = value + '/' + value_c2_year;
                $.ajax({
                    url: _URL,
                    type: 'POST',
                    data: {
                        act: 'man',
                        src: 'dashboard',
                        form: 'thong-ke',
                        value_c1: value_c1,
                        value_c2: value_c2,
                    },
                    dataType: 'JSON',
                    beforeSend: function() {
                        loadApplication(true);
                    },
                    success: function(data) {
                        viewChart_storeHouse(data);
                    },
                    complete: function() {
                        loadApplication(false);
                    },
                });
            },
        });

        // Select Top 10
        $(document).btnNoneBlockPlugin({
            class_form: 'form_dashboard_top10',
            button: 'btn_dashboard_top10', // Thay thế class cho button
            data: 'data_dashboard_top10',
            animation: true,
            check_out: true,
            dropdowns: true,
            dropdowns_data: {
                input: 'data_input_dashboard_top10',
                output: 'data_output_dashboard_top10',
            },
            dropdowns_ajax_data: function(value) {},
        });
    },
    search: function() {
        // ------------- Tìm Kiếm theo từ khóa --------------
        $('body').on('click', '.button_search_keywords', function() {
            searchKeywords($('body input[name="data[keywords]"]'));
        });
        $('body input[name="data[keywords]"]').on('keydown', function(e) {
            if (e.key === 'Enter') {
                searchKeywords($(this));
            }
        });
        // ------------- Tìm Kiếm theo checkbox ------------
        $(document).btnNoneBlockPlugin({
            class_form: 'form_search_check',
            button: 'btn_search_check', // Thay thế class cho button
            data: 'data_search_check',
            animation: true,
            close: true,
            // data-nb là data kiểm tra dữ liệu
        });

        $("body .form_search_checkbox .items_search_checkbox input[type='checkbox']").on('change', function() {
            let list_param = {};
            $('body .form_search_checkbox .items_search_checkbox').each(function() {
                let _this_name = $(this);
                let param = _this_name.data('value'); // Lấy giá trị của 'data-value' từ phần tử hiện tại
                let array_value_param_checkbox = [];

                // Sử dụng jQuery `.find()` để tìm các thẻ input bên trong `_this_name`
                _this_name.find("input[name='data[" + param + "]']").each(function() {
                    let _this_value = $(this);
                    if (_this_value.prop("checked")) {
                        let item_value = _this_value.val();
                        array_value_param_checkbox.push(item_value);
                    }
                });

                // Nối các giá trị trong `array_value_param_checkbox` thành chuỗi
                let value_param = array_value_param_checkbox.join(',');
                list_param[param] = value_param;
            });
            var url_paramcheck = getUrlParam(list_param);
            if (url_paramcheck.length > 0) {
                $.ajax({
                    url: url_paramcheck,
                    type: "POST",
                    data: "",
                    dataType: "json",
                    beforeSend: function() {
                        loadApplication(true);
                    },
                    success: function(data) {
                        $("body").find("#html_table").html(data.html.table);
                        $("body").find("#paging_table").html(data.html.paging);
                        _FRAMEWORK.Lazys();
                        history.pushState(null, null, url_paramcheck);
                    },
                    complete: function() {
                        loadApplication(false);
                    },
                });
            }
        });
    },
    popup: function() {
        actionPopup("form_popup", "close_form_popup", "add_warehouse");
        actionPopup("form_popup_import", "close_form_popup_import", "add_warehouse_import");
    },
    excel: function() {
        // lấy file mẫu
        $('body').on("click", '.button_download_excel', function() {
            const urlParams = new URLSearchParams(window.location.search);
            let src = '';
            let type = '';
            let act = '';
            urlParams.forEach((value, key) => {
                if (key == 'src') {
                    src = value;
                }
                if (key == 'type') {
                    type = value;
                }
                if (key == 'act') {
                    act = value;
                }
            });
            const postData = {
                src: src,
                type: type,
                act: act,
                form: 'sample',
            };
            if (src.length > 0 && type.length > 0) {
                handleExcelExport(postData);
            } else {
                alert("Đường link của bạn không đúng");
            }

        });
        // Xuất danh sách dữ liệu
        $('body').on("click", '.warehouse_export', function() {
            const urlParams = new URLSearchParams(window.location.search);
            let src = '';
            let type = '';
            let act = '';
            urlParams.forEach((value, key) => {
                if (key == 'src') {
                    src = value;
                }
                if (key == 'type') {
                    type = value;
                }
                if (key == 'act') {
                    act = value;
                }
            });
            var list_param = [];
            $("body .form_table_views input[type='checkbox'][name='data[export]']").each(function() {
                let _this = $(this);
                if (_this.prop('checked')) {
                    let id = _this.val();
                    list_param.push(id);
                }
            });
            if (list_param.length !== 0) {
                const postData = {
                    src: src,
                    type: type,
                    act: act,
                    form: 'export',
                    data: list_param,
                };
                handleExcelExport(postData);
            } else {
                alert('Bạn chưa chọn dữ liệu xuất');
            }
        });
    },
    table: function() {
        // ------------------ lấy vị trí max cảu table -------------
        // if ($('body .form_table_view').length > 0) {
        //     var height_save = 0;
        //     setInterval(function() {
        //         if (height_save != $(window).height()) {
        //             var table_top = $('.form_table_view');
        //             var table_topOffset = table_top.offset().top - $(window).scrollTop();
        //             var viewportHeight = $(window).height() - 60;
        //             var max_heightTable = viewportHeight - table_topOffset;
        //             if (max_heightTable > 1200) {
        //                 table_top.css({
        //                     "max-height": max_heightTable + "px",
        //                 });
        //             }
        //             height_save = $(window).height();
        //         }
        //     }, 300);
        // }
        // end
        // ------------------- xem chi tiết --------------------
        $(document).btnNoneBlockPlugin({
            class_form: 'form_table_views',
            button: 'btn_table_views', // Thay thế class cho button
            data: 'data_table_views',
            animation: true,
            check_out: false,
            close: true,
        });
        // end
        // ------------------- Load khu vực --------------------
        $('body').on('change', 'select[name="data[city]"]', function() {
            if (!$(this).hasClass('no_load')) {
                var value = $(this).val();
                $.ajax({
                    url: "ajax/warehouse/SelectCity.php",
                    type: "POST",
                    data: {
                        id: value,
                    },
                    dataType: "json",
                    beforeSend: function() {
                        loadApplication(true);
                    },
                    success: function(data) {
                        if ($('body .form_select_district').length > 0) {
                            $('body .form_select_district').html(data.html);
                        }
                    },
                    complete: function() {
                        loadApplication(false);
                    }
                });
            }
        });
        // checkbox
        $("body .form_table_views input[type='checkbox'][name='data[export]']").on('change', function() {
            if ($('body .form_table_views input[type="checkbox"][name="data[export]"]:checked').length > 0) {
                $('body .form_table_views input[type="checkbox"][name="data[export_all]"]').prop('checked', true);
            } else {
                $('body .form_table_views input[type="checkbox"][name="data[export_all]"]').prop('checked', false);
            }
        });
        $("body .form_table_views input[type='checkbox'][name='data[export_all]']").on('change', function() {
            if ($(this).prop('checked')) {
                $('body .form_table_views input[type="checkbox"][name="data[export]"]').prop('checked', true);
            } else {
                $('body .form_table_views input[type="checkbox"][name="data[export]"]').prop('checked', false);
            }
        });
        // sort
        $(document).btnNoneBlockPlugin({
            class_form: 'form_sort',
            button: 'btn_sort', // Thay thế class cho button
            data: 'data_sort',
            animation: true,
            check_out: true,
            close: true,
            dropdowns: true,
            dropdowns_click_out: false,
            dropdowns_data: {
                input: 'data_input_sort',
                output: 'data_output_sort',
            },
            dropdowns_ajax_data: function(value, _this) {
                var url_param_sort = getUrlParam({ sort: value });
                if (!_this.hasClass('active')) {
                    $.ajax({
                        url: url_param_sort,
                        type: 'POST',
                        dataType: 'JSON',
                        beforeSend: function() {
                            loadApplication(true);
                        },
                        success: function(data) {
                            _this.closest('.form_sort').find('.data_input_sort').removeClass('active');
                            _this.addClass('active');
                            $("body").find("#html_table").html(data.html.table);
                            $("body").find("#paging_table").html(data.html.paging);
                            _FRAMEWORK.Lazys();
                            history.pushState(null, null, url_param_sort);
                        },
                        complete: function() {
                            loadApplication(false);
                        },
                    });
                }

            },
        });
        // end
    },
    delete: function() {
        // Chuyển vào thùng rác
        $('body').on('click', '.button_trash', function() {
            let _this = $(this);
            let id = _this.data('id');
            let table = _this.data('table');
            if (id > 0) {
                Swal.fire({
                    title: 'Bạn có chắc chắn?',
                    text: "Muốn chuyển dữ liệu này vào thùng rác!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Xác nhận',
                    cancelButtonText: 'Hủy bỏ'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Hiển thị thông báo đã xác nhận
                        Swal.fire({
                            title: 'Đã xác nhận!',
                            text: 'Thao tác đang được thực hiện...',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        // Gửi yêu cầu AJAX
                        $.ajax({
                            url: "ajax/warehouse/delete.php",
                            type: "POST",
                            data: {
                                id: id, // Biến ID cần định nghĩa trước
                                status: "trash",
                                table: table // Biến table cần định nghĩa trước
                            },
                            dataType: "json",
                            beforeSend: function() {
                                loadApplication(true); // Hàm xử lý hiệu ứng tải
                            },
                            success: function(data) {
                                // Xóa dòng dữ liệu trong bảng nếu có
                                if (_this.closest('.item_tbody_table').length > 0) {
                                    _this.closest('.item_tbody_table').remove();
                                }

                                // Hiển thị thông báo theo kết quả
                                jsNotification(data.status, data.messenger);
                            },
                            complete: function() {
                                loadApplication(false); // Kết thúc hiệu ứng tải
                            }
                        });
                    }
                });
            }
        });
        // Xóa
        $('body').on('click', '.button_delete', function() {
            let _this = $(this);
            let id = _this.data('id');
            let table = _this.data('table');
            let url = getUrlParam();
            if (id > 0) {
                Swal.fire({
                    title: 'Bạn có chắc chắn?',
                    text: "Muốn xóa dữ liệu này!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Xác nhận',
                    cancelButtonText: 'Hủy bỏ'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Hiển thị thông báo đã xác nhận
                        Swal.fire({
                            title: 'Đã xác nhận!',
                            text: 'Thao tác đang được thực hiện...',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        // Gửi yêu cầu AJAX
                        $.ajax({
                            url: url,
                            type: "POST",
                            data: {
                                id: id,
                                status: "delete",
                                table: table,
                            },
                            dataType: "json",
                            beforeSend: function() {
                                loadApplication(true);
                            },
                            success: function(data) {
                                if ($('body').find('#list_trash').length > 0) {
                                    $('body').find('#list_trash').html(data.html.table);
                                };
                                jsNotification(data.data.notification.status, data.data.notification.messenger);
                            },
                            complete: function() {
                                loadApplication(false);
                            }
                        });
                    }
                });
            }
        });
        // Hoàn tác
        $('body').on('click', '.button_undo', function() {
            let _this = $(this);
            let id = _this.data('id');
            let table = _this.data('table');
            let url = getUrlParam();
            if (id > 0) {
                Swal.fire({
                    title: 'Bạn có chắc chắn?',
                    text: "Muốn hoàn tác dữ liệu này!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Xác nhận',
                    cancelButtonText: 'Hủy bỏ'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Hiển thị thông báo đã xác nhận
                        Swal.fire({
                            title: 'Đã xác nhận!',
                            text: 'Thao tác đang được thực hiện...',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        // Gửi yêu cầu AJAX
                        $.ajax({
                            url: url,
                            type: "POST",
                            data: {
                                id: id,
                                status: "undo",
                                table: table,
                            },
                            dataType: "json",
                            beforeSend: function() {
                                loadApplication(true);
                            },
                            success: function(data) {
                                if ($('body').find('#list_trash').length > 0) {
                                    $('body').find('#list_trash').html(data.html.table);
                                };
                                jsNotification(data.data.notification.status, data.data.notification.messenger);
                            },
                            complete: function() {
                                loadApplication(false);
                            }
                        });
                    }
                });
            }
        });
    },
    notification: function() {
        // thông báo trang web
        $(document).btnNoneBlockPlugin({
            class_form: 'form_all_notification',
            button: 'btn_all_notification', // Thay thế class cho button
            data: 'data_all_notification',
            animation: true,
            check_out: true,
            dropdowns_click_out: false,
            dropdowns: true,
            dropdowns_data: {
                input: 'data_input_all_notification',
                output: 'data_output_all_notification',
            },
            dropdowns_ajax_data: function(value, _this) {
                if (!_this.hasClass('viewed')) {
                    $.ajax({
                        url: 'ajax/warehouse/handleNotification.php',
                        type: 'POST',
                        data: {
                            id: value,
                        },
                        dataType: 'JSON',
                        beforeSend: function() {
                            loadApplication(true);
                        },
                        success: function(data) {
                            if (data.status == 200) {
                                if (_this.hasClass("success")) {
                                    _this.removeClass('success');
                                } else if (_this.hasClass("error")) {
                                    _this.removeClass('error');
                                }
                                _this.closest('.form_all_notification').find('#quantity_notification').text(data.quantity);
                                _this.addClass('viewed');
                            }
                        },
                        complete: function() {
                            loadApplication(false);
                        },
                    });
                }
            },
        });
        // thông báo trạng thái
        if ($('body .form_notification').length > 0) {
            $('body .form_notification').css({
                "transform": "translateX(0)",
                "opacity": "1",
                "visibility": "visible"
            });
            setTimeout(function() {
                $('body .form_notification').css({
                    "transform": "translateX(calc(100% + 50px))",
                    "opacity": "0",
                    "visibility": "hidden"
                });
                setTimeout(function() {
                    $('body .form_notification').remove();
                }, 1000);
            }, 5000);
        }
    },
    captcha: function() {
        var select_Captcha = {
            // class form tổng
            form_captcha: ' .form_captcha_js',
            // button 
            button: ' .btn_captcha_js',
            // dữ liệu nhận
            code_captcha: ' .code_captcha',
            // font captcha
            font_weight: 600,
            font_size: 15,
            font_family: 'sans-serif',
            // color captcha
            color_captcha: '#000',
            // data-name=""     Nhập tên lưu 
            // data-size=""     Nhập Kích thước WxH 
            // data-length=""     Nhập số ký tự 
            // data-ajax=""     Nhập file source 

        };
        $('body').on('click', select_Captcha.button, function() {
            var _this = $(this);
            if (!_this.hasClass('on')) {
                _this.addClass('on');
                // tên lưu
                var name_save = _this.data('name');
                // kích thước captcha
                var size = _this.data('size');
                if (!size || size.length === 0) {
                    size = '70x17';
                }
                var parts_canvas = size.split('x');
                var width_canvas = parseInt(parts_canvas[0], 10);
                var height_canvas = parseInt(parts_canvas[1], 10);
                // độ dài captcha
                let length_value = _this.data('length');
                var length = 0;
                if (length_value !== undefined && length_value !== null) {
                    length = length_value;
                } else {
                    length = 6;
                }
                // url file source
                var url_ajax_value = _this.data('ajax');
                var ajax_file = '';
                if (url_ajax_value !== undefined && url_ajax_value !== null) {
                    ajax_file = url_ajax_value;
                } else {
                    ajax_file = 'ajax/buildCaptcha.php';
                }
                // mã captcha
                var chars = 'ABCDEFGHJKMNPQRSTUVWXYZ123456789123456789123456789123456789123456789qwertyuiopasdfghjklzxcvbnm';
                var string = '';
                for (var i = 0; i < length; i++) {
                    string += chars.charAt(Math.floor(Math.random() * chars.length));
                }
                $.ajax({
                    url: ajax_file,
                    type: 'POST',
                    data: {
                        captcha: string,
                        name: name_save,
                    },
                    dataType: 'Json',
                    success: function(data) {
                        var canvas = $('<canvas/>', {
                            id: 'code_captcha',
                        });
                        canvas.attr({
                            width: width_canvas,
                            height: height_canvas
                        });
                        let captcha = canvas[0];
                        if (captcha && captcha.getContext) {
                            let ctx = captcha.getContext('2d');
                            ctx.font = select_Captcha.font_weight + ' ' + select_Captcha.font_size + 'px ' + select_Captcha.font_family;
                            ctx.fillStyle = select_Captcha.color_captcha;
                            ctx.textAlign = "center";
                            ctx.textBaseline = "middle";
                            ctx.fillText(data.captcha, ((width_canvas) / 2), ((height_canvas) / 2));
                            _this.closest(select_Captcha.form_captcha).find(select_Captcha.code_captcha).html(canvas);
                            setTimeout(function() {
                                _this.removeClass('on');
                            }, 500);
                        }
                    }
                });
            }
        });
        if ($(select_Captcha.button).length > 0) {
            $(select_Captcha.button).click();
        }
    },
    all: function() {
        // Chọn Ngày
        if ($('input.input_date').length > 0) {
            flatpickr("input.input_date", {
                enableTime: false,
                dateFormat: "d/m/Y",
                locale: "vn",
                maxDate: new Date(),
                shorthandCurrentMonth: true,
            });
        }
        if ($('input.input_date_import').length > 0) {
            flatpickr("input.input_date_import", {
                enableTime: false,
                dateFormat: "d/m/Y",
                locale: "vn",
                shorthandCurrentMonth: true,
            });
        }
        // end
        setTimeout(function() {
            $("body .loadApplication").remove();
        }, 200);
        $('body').find('.load_website').each(function() {
            var load_website = $(this);
            load_website.find('*').on('load', function() {
                setTimeout(function() {
                    load_website.removeClass('load_website');
                }, 300);
            });
        });

    },
};

$(document).ready(function() {
    _FRAMEWORK.init();
});

function jsNotification(status = null, messenger = null) {
    $.ajax({
        url: 'ajax/warehouse/ajax_notification.php',
        type: 'POST',
        data: {
            status: status,
            messenger: messenger,
        },
        dataType: 'Json',
        success: function(data) {
            $('body').append(data.html);
            if ($('body .form_notification').length > 0) {
                $('body .form_notification').css({
                    "transform": "translateX(0)",
                    "opacity": "1",
                    "visibility": "visible"
                });
                setTimeout(function() {
                    $('body .form_notification').css({
                        "transform": "translateX(calc(100% + 50px))",
                        "opacity": "0",
                        "visibility": "hidden"
                    });
                    setTimeout(function() {
                        $('body .form_notification').remove();
                    }, 1000);
                }, 5000);
            }
        },
        complete: function() {},
    });
}

function actionPopup(class_form = null, class_close_form = null, class_view_form = null) {
    $('body').on('click', '.' + class_view_form, function() {
        if (!$('body .' + class_form).hasClass('active')) {
            $('body .' + class_form).addClass('active');
            $("body ").css('overflow', 'hidden');
        }
    });
    $('body').on('click', '.' + class_close_form, function() {
        if ($(this).closest(' .' + class_form).hasClass('active')) {
            $(this).closest(' .' + class_form).removeClass('active');
            $("body ").css('overflow', 'auto');
        }
    });
}

function loadApplication(check = true) {
    if (check) {
        $('body').append(`
            <div class="loadApplication">
               <div class="form_in_loadApplication">
                    <div class="icons_loadApplication">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="text_loadApplication">
                        <span>
                            Đang xử lý ...
                        </span>
                    </div>
                </div>
            </div>
        `);
    } else {
        setTimeout(function() {
            $("body .loadApplication").remove();
        }, 200)
    }
}

function getUrlParam(paramsToAdd = {}) {
    const urlParams = new URLSearchParams(window.location.search);
    let params = {};
    // Lấy tất cả tham số từ URL hiện tại
    urlParams.forEach((value, key) => {
        if (key != 'page') {
            params[key] = value;
        }
    });
    // Nếu có tham số key và value, thêm hoặc thay đổi tham số
    Object.keys(paramsToAdd).forEach(key => {
        let value = paramsToAdd[key];
        params[key] = value; // Thêm hoặc cập nhật tham số với giá trị mới
    });
    // Chuyển mảng params thành chuỗi truy vấn
    params = Object.fromEntries(
        Object.entries(params).filter(([key, value]) => value !== "" && value !== null && value !== undefined)
    );
    let queryString = $.param(params);
    // Tạo URL mới
    let url = '';
    if (queryString === "") {
        url = _URL; // Nếu không có tham số, chỉ trả về URL cơ bản
    } else {
        url = _URL + '?' + queryString; // Thêm tham số vào URL
    }

    return url;
}

function viewChart_storeHouse(data) {
    if ($('body #revenue_statistics_table').length > 0) {

        Highcharts.chart('revenue_statistics_table', {
            credits: {
                enabled: false,
            },
            chart: {
                type: 'column',
                scrollablePlotArea: {
                    minWidth: 700
                }
            },
            title: {
                text: 'Biểu Đồ Doanh Thu',
                align: 'left'
            },
            xAxis: {
                categories: data.data.array_x,
                tickWidth: 0,
                gridLineWidth: 1,
                showFirstLabel: true
            },
            yAxis: [{
                title: {
                    text: 'Doanh thu (VNĐ)'
                },
                labels: {
                    align: 'right',
                    x: -3,
                    y: 3,
                    formatter: function() {
                        return Highcharts.numberFormat(this.value / 1000000, 0, ',', '.') + 'M'; // Chia giá trị cho 1 triệu và thêm 'M'
                    }
                },
                showFirstLabel: false
            }],
            tooltip: {
                crosshairs: true,
                shared: true,
                formatter: function() {
                    return 'Ngày: <b>' + this.key + '</b><br>' +
                        'Giá trị: <b>' + Highcharts.numberFormat(this.y / 1000000, 1, ',', '.') + 'M</b>';
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.1,
                    groupPadding: 0.1,
                    borderWidth: 0,
                }
            },
            series: [{
                    name: 'Đơn Hoàn Thành',
                    data: data.data.array_success,
                    marker: {
                        enabled: false,
                    },
                    showInLegend: true,
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        style: {
                            fontWeight: 'bold',
                            textOutline: 'none'
                        },
                        formatter: function() {
                            return Highcharts.numberFormat(this.y / 1000000, 1, ',', '.') + 'M';
                        }
                    },
                    zIndex: 2,
                    tooltip: {
                        pointFormatter: function() {
                            return this.series.name + ': <b>' + Highcharts.numberFormat(this.y / 1000000, 1, ',', '.') + 'M</b>';
                        }
                    }
                },
                // {
                //     name: 'Trả Hàng',
                //     data: data.data.array_cancel,
                //     marker: {
                //         enabled: false,
                //     },
                //     showInLegend: true,
                //     color: 'red',
                // }
            ]
        });
    }
}

function searchKeywords(keywordsInput) {
    let keywords = keywordsInput.val().trim(); // Lấy giá trị và loại bỏ khoảng trắng đầu/cuối
    if (keywords.length > 0) {
        // Mã hóa từ khóa để đảm bảo nó an toàn khi sử dụng trong URL
        let encodedKeywords = encodeURIComponent(keywords);
        let url = getUrlParam({
            'keywords': encodedKeywords,
        });
        window.location.href = url; // Chuyển hướng đến URL mới
    } else {
        alert('Vui lòng nhập từ khóa tìm kiếm');
    }
}

function handleExcelExport(postData = null) {
    loadApplication(true);
    fetch('ajax/warehouse/excel.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded', // Định dạng gửi dữ liệu
            },
            body: new URLSearchParams(postData) // Dữ liệu gửi đi dưới dạng URL encoded
        })
        .then(response => response.blob()) // Chuyển đổi dữ liệu trả về thành Blob (file)
        .then(blob => {
            if (blob.size > 0) {
                // Tạo đối tượng URL từ Blob
                const downloadUrl = window.URL.createObjectURL(blob);

                // Tạo một liên kết ẩn và kích hoạt tải file
                const link = document.createElement('a');
                link.href = downloadUrl;
                link.download = 'List.xlsx'; // Tên file khi tải về
                link.click();

                // Giải phóng bộ nhớ
                window.URL.revokeObjectURL(downloadUrl);
            } else {
                alert('Dữ liệu bị lỗi');
            }
            loadApplication(false);
        })
        .catch(error => {
            console.error('Download failed:', error, );
            loadApplication(false);
        });
}


function exists(el) {
    if (el.length > 0) return true;
    else return false
};

function isMobileDevice() {
    return (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent));
}