// popup
function actionPopup(class_form = null, class_close_form = null, class_view_form = null, check_ajax = false) {
    $("body").on("click", "." + class_view_form, function () {
        if (!$("body ." + class_form).hasClass("active")) {
            $("body ." + class_form).addClass("active");
            $("body ").css("overflow", "hidden");
        }
    });
    $("body").on("click", "." + class_close_form, function () {
        if (
            $(this)
                .closest(" ." + class_form)
                .hasClass("active")
        ) {
            $(this)
                .closest(" ." + class_form)
                .removeClass("active");
            $("body ").css("overflow", "auto");
        }
    });
}

$(document).ready(function () {
    $(".form_product_index").btnNoneBlockPlugin({
        button: "btn_product_index", // Thay thế class cho button
        data: "data_product_index",
        animation: false,
        check_out: false,
        close: false,
    });
});
