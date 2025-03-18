FRAMEWORK = {
    init: function() {

        FRAMEWORK.formSelectAdmin();

        FRAMEWORK.menuAdmin();

        FRAMEWORK.tableAdmin();

    },
    formSelectAdmin: function() {
        $('.sumoselect_one').each(function() {
            let _this = $(this);
            _this.SumoSelect({
                search: true,
                placeholder: _this.data('placeholder'),
                searchText: 'Enter here search.',
            });
        });
    },
    tableAdmin: function() {
        $('.input_stt').formatInputPlugin({
            max: 1000,
            min: 0,
            type: "number",
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
        $.toast({
            heading: data.title,
            text: data.message,
            position: 'top-right',
            stack: false,
            icon: data.status
        });
    },
}

$(document).ready(function() {
    loadApplication(true);
    FRAMEWORK.init();
    loadApplication(false);
});