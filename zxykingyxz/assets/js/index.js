FRAMEWORK = {
    init: function() {

        FRAMEWORK.formSelectAdmin();

        FRAMEWORK.formInputAdmin();

        FRAMEWORK.menuAdmin();

        FRAMEWORK.iconsWeb();

        FRAMEWORK.cacheWeb();

        FRAMEWORK.animationsWeb();

        FRAMEWORK.handleExcel();

        FRAMEWORK.handleTable();

        FRAMEWORK.allJs();

    },
    allJs: function() {
        // Toàn màng hình
        $('body').on('click', "#fullscreenBtn", function() {
            if (!document.fullscreenElement) {
                $('html')[0].requestFullscreen().catch(function(err) {
                    alert(`Lỗi khi vào fullscreen: ${err.message}`);
                });
            } else {
                document.exitFullscreen();
            }
        });
    },
    cacheWeb: function() {
        // xóa cache
        $('body').on("click", '#buttonDeleteCache', function() {
            $.ajax({
                url: "ajax/functions/handleWeb.php",
                type: 'POST',
                data: {
                    form: "delete_cache"
                },
                dataType: 'JSON',
                beforeSend: function() {
                    loadApplication(true);
                },
                success: function(response) {
                    if (response.data.status == 200) {
                        FRAMEWORK.showNotification({
                            title: "Thông báo hệ thống",
                            message: response.data.message,
                            status: "success",
                        });
                    } else {
                        FRAMEWORK.showNotification({
                            title: "Thông báo hệ thống",
                            message: response.data.message,
                            status: "error",
                        });
                    }
                },
                error: function(data) {
                    FRAMEWORK.showNotification({
                        title: "Thông báo hệ thống",
                        message: "Truyền dữ liệu bị lỗi!",
                        status: "error",
                    });
                    loadApplication(false);
                },
                complete: function() {
                    loadApplication(false);
                }
            });
        });
    },
    handleExcel: function() {

        // form popup
        $('body').on('click', '.button_modal_import', function() {
            let _this = $(this);
            let url = _this.data('url');
            $.ajax({
                url: "ajax/functions/excel.php",
                type: 'POST',
                data: {
                    form: "modal",
                    value: url,
                },
                dataType: 'JSON',
                beforeSend: function() {
                    loadApplication(true);
                },
                success: function(data) {
                    $('body').find('#form_modal').html(data.html.modal);
                    submitImportExcel();
                },
                error: function(data) {
                    loadApplication(false);
                },
                complete: function() {
                    loadApplication(false);
                }
            });
        });
        $('body').on('click', '.close_modal_import', function() {
            $('body').find('#form_modal *').remove();
        });

        // xuất file mẫu
        $('body').on("click", '.button_download_excel_sample', function() {
            let _this = $(this);
            let url = _this.data('url');
            const postData = {
                form: 'sample',
                value: url,
            };
            handleExcelExport(postData);
        });
    },
    iconsWeb: function() {
        // icons
        lucide.createIcons();
    },
    animationsWeb: function() {
        // Chạy số
        $(".animation_price").animationNumber({
            duration: 2000,
            type: 'currency',
            currencySymbol: ' đ'
        });
    },
    formSelectAdmin: function() {
        // chọn 1
        $('.sumoselect_one').each(function() {
            let _this = $(this);
            _this.SumoSelect({
                search: true,
                placeholder: _this.data('placeholder'),
                searchText: 'Enter here search.',
            });
        });
    },
    formInputAdmin: function() {
        // chọn ngày
        if ($('input.input_date').length > 0) {
            flatpickr("input.input_date", {
                enableTime: false,
                dateFormat: "d/m/Y",
                locale: "vn",
                maxDate: new Date(),
                shorthandCurrentMonth: true,
            });
        }
        // chọn giá
        $('.input_price').formatInputPlugin({});
        // tìm kiếm giá
        $(document).ready(function() {
            var $priceRange = $(".price_range");

            // Khởi tạo ionRangeSlider
            $priceRange.ionRangeSlider({
                skin: "big",
                type: "double",
                min: 0,
                max: 10000000,
                from: 0,
                to: 10000000,
                step: 10000,
                prettify: function(num) {
                    if (num >= 1000000) {
                        return (num / 1000000) + "M";
                    } else if (num >= 1000) {
                        return (num / 1000) + "k";
                    }
                    return num;
                },
                onStart: function(data) {
                    // Đảm bảo lấy đúng slider sau khi khởi tạo
                    priceSlider = $priceRange.data("ionRangeSlider");
                },
                onChange: function(data) {
                    $("input.input_range_price[name='min_price']").val(data.from).trigger('input');
                    $("input.input_range_price[name='max_price']").val(data.to).trigger('input');
                }
            });

            var priceSlider = $priceRange.data("ionRangeSlider"); // Đảm bảo slider đã sẵn sàng

            // Kiểm tra và sử dụng plugin formatInputPlugin nếu có
            if ($.fn.formatInputPlugin) {
                $('.input_range_price').formatInputPlugin({
                    max: 10000000,
                    min: 0,
                    unit: "đ"
                });
            }

            var timeInput;
            $("input.input_range_price").on("input", function() {
                clearTimeout(timeInput);
                timeInput = setTimeout(function() {
                    var minPrice = parseInt($("input[name='min_price']").val().replace(/\D/g, "")) || 0;
                    var maxPrice = parseInt($("input[name='max_price']").val().replace(/\D/g, "")) || 10000000;

                    // Đảm bảo minPrice không lớn hơn maxPrice
                    minPrice = Math.min(minPrice, maxPrice);
                    maxPrice = Math.max(minPrice, maxPrice);

                    // Cập nhật slider
                    priceSlider.update({
                        from: minPrice,
                        to: maxPrice
                    });
                }, 500);
            });
        });

    },
    handleTable: function() {
        //======= tìm kiếm ==========
        $('.form_table_detal').updateUrlParams({
            classItems: 'param_table_detail',
            changeLink: false,
            callback: function(url, form) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'JSON',
                    beforeSend: function() {
                        loadApplication(true);
                    },
                    success: function(data) {
                        $('body').find("#table_body").html(data.html.tablebody);
                        $('body').find(".pagging_list").html(data.html.pagging);
                        window.history.pushState(null, '', url);
                        FRAMEWORK.iconsWeb();
                    },
                    error: function(data) {
                        console.error("Error:", data);
                        loadApplication(false);
                    },
                    complete: function() {
                        loadApplication(false);
                    }
                });
            }
        });

        //===== xóa nhiều dữ liệu =====
        $('body').on('click', '.button_delete_all_default', function() {
            let _this = $(this);
            let url = _this.data('url');
            let list_delete = $('input[name="check_box_default"]:checked').map(function() {
                return this.value;
            }).get().join(',');
            let data_url = url + "&list_delete=" + list_delete;
            FRAMEWORK.showConfirm({
                title: "Xóa dữ liệu",
                message: "Bạn có chắc chắn muốn xóa dữ liệu này không?",
                confirmText: "Xóa",
                cancelText: "Hủy",
                onConfirm: function() {
                    $.ajax({
                        url: data_url,
                        type: 'GET',
                        data: {},
                        dataType: 'JSON',
                        beforeSend: function() {
                            loadApplication(true);
                        },
                        success: function(data) {
                            if ($('body').find('input[name="keywords"]').length > 0) {
                                $('body').find('input[name="keywords"]').trigger("change");
                            } else {
                                location.reload();
                            };
                            FRAMEWORK.showNotification({
                                title: "Thông báo hệ thống",
                                message: data.message,
                                status: (data.status == 200) ? "success" : "error",
                            });
                        },
                        error: function(data) {
                            FRAMEWORK.showNotification({
                                title: "Thông báo hệ thống",
                                message: "Truyền dữ liệu bị lỗi!",
                                status: "error",
                            });
                            loadApplication(false);
                        },
                        complete: function() {
                            loadApplication(false);
                        }
                    });

                },
                onCancel: function() {}
            });
        });
        $("body").on("change", ".input_check_default", function() {
            if (($("body .input_check_default:checked")).length > 0) {
                $(".input_check_all_default").prop("checked", true);
            } else {
                $(".input_check_all_default").prop("checked", false);
            }
        });
        $("body").on("change", ".input_check_all_default", function() {
            if ($("body .input_check_all_default").is(":checked")) {
                $("body .input_check_default").prop("checked", true);
            } else {
                $("body .input_check_default").prop("checked", false);
            }
        });

        // ======= xóa 1 dữ liệu =====
        $('body').on('click', '.button_delete_one', function() {
            let _this = $(this);
            let url = _this.data('url');
            FRAMEWORK.showConfirm({
                title: "Xóa dữ liệu",
                message: "Bạn có chắc chắn muốn xóa dữ liệu này không?",
                confirmText: "Xóa",
                cancelText: "Hủy",
                onConfirm: function() {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        data: {},
                        dataType: 'JSON',
                        beforeSend: function() {
                            loadApplication(true);
                        },
                        success: function(data) {
                            if ($('body').find('input[name="keywords"]').length > 0) {
                                $('body').find('input[name="keywords"]').trigger("change");
                            } else {
                                location.reload();
                            };
                            FRAMEWORK.showNotification({
                                title: "Thông báo hệ thống",
                                message: data.message,
                                status: (data.status == 200) ? "success" : "error",
                            });
                        },
                        error: function(data) {
                            FRAMEWORK.showNotification({
                                title: "Thông báo hệ thống",
                                message: "Truyền dữ liệu bị lỗi!",
                                status: "error",
                            });
                            loadApplication(false);
                        },
                        complete: function() {
                            loadApplication(false);
                        }
                    });

                },
                onCancel: function() {}
            });
        });
    },
    menuAdmin: function() {
        $(".form_menu_admin").btnNoneBlockPlugin({
            button: 'btn_menu_admin', // Thay thế class cho button
            data: 'data_menu_admin',
            animation: true,
            check_out: false,
            close: true,
        });
        $('body').on('click', '.action_menu_admin', function() {
            $('body .form_all_menu_admin').toggleClass("active");
        });
    },
    showNotification: function(data = {
        title: null,
        message: null,
        status: "success"
    }) {
        // Khởi tạo cấu hình Notiflix để hỗ trợ HTML
        Notiflix.Notify.init({
            useIcon: true, // Hiển thị icon
            messageMaxLength: 300, // Độ dài tối đa của thông báo
            plainText: false // Cho phép nội dung HTML
        });
        let style_title = "font-size: 16px; font-weight: bold;";
        // Xử lý trạng thái và hiển thị thông báo
        switch (data.status) {
            case "success":
                Notiflix.Notify.success(
                    `<div style="${style_title}}">${data.title}</div>
                     <div>${data.message}</div>`
                );
                break;
            case "error":
                Notiflix.Notify.failure(
                    `<div style="${style_title}}">${data.title}</div>
                     <div>${data.message}</div>`
                );
                break;
            case "info":
                Notiflix.Notify.info(
                    `<div style="${style_title}}">${data.title}</div>
                     <div>${data.message}</div>`
                );
                break;
            default:
                Notiflix.Notify.warning(
                    `<div style="${style_title}}">Trạng thái không xác định!</div>
                     <div>Vui lòng kiểm tra lại.</div>`
                );
                break;
        }
    },
    showConfirm: function(data = {
        title: null,
        message: null,
        confirmText: "Đồng ý",
        cancelText: "Hủy bỏ",
        onConfirm: null,
        onCancel: null
    }) {
        // Khởi tạo cấu hình Notiflix Confirm
        Notiflix.Confirm.init({});

        let style_title = "font-size: 16px; font-weight: bold;";

        // Hiển thị hộp thoại xác nhận
        Notiflix.Confirm.show(
            data.title || "Xác nhận hành động",
            `<div style="${style_title}">${data.message || "Bạn có chắc chắn muốn tiếp tục không?"}</div>`,
            data.confirmText || "Đồng ý",
            data.cancelText || "Hủy bỏ",
            function() {
                if (typeof data.onConfirm === 'function') {
                    data.onConfirm();
                }
            },
            function() {
                if (typeof data.onCancel === 'function') {
                    data.onCancel();
                }
            }
        );
    }
}
$(document).ready(function() {
    loadApplication(true);
    FRAMEWORK.init();
    setTimeout(function() {
        $("body").removeClass("body_load");
    }, 100);
    loadApplication(false);
});