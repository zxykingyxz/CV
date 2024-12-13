$(document).ready(function() {
    //  gg lang web
    $(document).btnNoneBlockPlugin({
        class_form: 'form_gglang',
        button: 'btn_gglang', // Thay thế class cho button
        data: 'data_gglang',
        animation: true,
        check_out: true,
        dropdowns: true,
        dropdowns_data: {
            input: 'data_input_gglang',
            output: 'data_output_gglang',
        },
        dropdowns_ajax_data: function(value) {
            doGoogleLanguageTranslator(value)
        },
    });

    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length >= 2) return parts[1];
        return null;
    }
    const currentLang = getCookie('googtrans');
    switch (currentLang) {
        case '/vi/vi':
        case null:
            $("body .data_output_gglang[data-lang='/vi/vi']").siblings(".data_output_gglang").remove();
            break;
        case '/vi/en':
            $("body .data_output_gglang[data-lang='/vi/en']").siblings(".data_output_gglang").remove();
            break;
        default:
            break;
    }
});