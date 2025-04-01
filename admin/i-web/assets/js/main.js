FRAMEWORK = {
    init: function () {
        FRAMEWORK.formSelectAdmin();

        FRAMEWORK.menuAdmin();

        FRAMEWORK.tableAdmin();

        FRAMEWORK.iconsWeb();

        FRAMEWORK.detailFuntions();

        FRAMEWORK.ckeditorBuild();

        FRAMEWORK.uploadImageFiles();

    },
    iconsWeb: function () {
        // icons
        lucide.createIcons();
    },
    formSelectAdmin: function () {
        $(".sumoselect_one").each(function () {
            let _this = $(this);
            _this.SumoSelect({
                search: true,
                placeholder: _this.data("placeholder"),
                searchText: "Enter here search.",
            });
        });
    },
    uploadImageFiles: function () {
        $(".sumoselect_one").each(function () {
            let _this = $(this);
            _this.SumoSelect({
                search: true,
                placeholder: _this.data("placeholder"),
                searchText: "Enter here search.",
            });
        });
    },
    detailFuntions: function () {
        $(".form_lang_admin").btnNoneBlockPlugin({
            button: "btn_lang_admin", // Thay thế class cho button
            data: "data_lang_admin",
            animation: false,
            close: false,
        });
        $(".form_baiviet_admin").btnNoneBlockPlugin({
            button: "btn_baiviet_admin", // Thay thế class cho button
            data: "data_baiviet_admin",
            animation: false,
            close: false,
            class_check: "active",
            top_height: 70,
            scroll_top: true,
        });
    },
    ckeditorBuild: function () {
        $(".ClassCkEditor").each(function (index, el) {
            var id = $(this).attr("id");
            CKEDITOR.replace(id, {
                height: 300,
                entities: false,
                skin: "office2013",
                basicEntities: false,
                entities_greek: false,
                entities_latin: false,
                filebrowserBrowseUrl: "ckfinder/ckfinder.html",
                filebrowserImageBrowseUrl: "ckfinder/ckfinder.html?type=Images",
                filebrowserFlashBrowseUrl: "ckfinder/ckfinder.html?type=Flash",
                filebrowserUploadUrl: "ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files",
                filebrowserImageUploadUrl: "ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images",
                filebrowserFlashUploadUrl: "ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash",
                allowedContent: "h1 h2 h3 h4 h5 h6 p blockquote strong em;" + "a[!href];" + "img(left,right)[!src,alt,width,height];" + "table tr th td caption;" + "span{!font-family};" + "span{!color};" + "span(!marker);" + "del ins",
            });
        });
    },
    tableAdmin: function () {
        $(".input_stt").formatInputPlugin({
            max: 1000,
            min: 0,
            type: "number",
        });
    },
    menuAdmin: function () {
        $(".form_menu_admin").btnNoneBlockPlugin({
            button: "btn_menu_admin", // Thay thế class cho button
            data: "data_menu_admin",
            animation: true,
            check_out: false,
            close: true,
        });
        $("body").on("click", ".action_menu_admin", function () {
            $("body .form_all_menu_admin").toggleClass("active");
        });
    },
    showNotification: function (
        data = {
            title: null,
            message: null,
            status: "success",
        }
    ) {
        // Khởi tạo cấu hình Notiflix để hỗ trợ HTML
        Notiflix.Notify.init({
            useIcon: true, // Hiển thị icon
            messageMaxLength: 300, // Độ dài tối đa của thông báo
            plainText: false, // Cho phép nội dung HTML
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
    showConfirm: function (
        data = {
            title: null,
            message: null,
            confirmText: "Đồng ý",
            cancelText: "Hủy bỏ",
            onConfirm: null,
            onCancel: null,
        }
    ) {
        // Khởi tạo cấu hình Notiflix Confirm
        Notiflix.Confirm.init({});

        let style_title = "font-size: 16px; font-weight: bold;";

        // Hiển thị hộp thoại xác nhận
        Notiflix.Confirm.show(
            data.title || "Xác nhận hành động",
            `<div style="${style_title}">${data.message || "Bạn có chắc chắn muốn tiếp tục không?"}</div>`,
            data.confirmText || "Đồng ý",
            data.cancelText || "Hủy bỏ",
            function () {
                if (typeof data.onConfirm === "function") {
                    data.onConfirm();
                }
            },
            function () {
                if (typeof data.onCancel === "function") {
                    data.onCancel();
                }
            }
        );
    },
};

$(document).ready(function () {
    loadApplication(true);
    FRAMEWORK.init();
    loadApplication(false);
});
