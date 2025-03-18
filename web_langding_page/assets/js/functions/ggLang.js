$(window).on("load", function() {
    let lang = getCookie('lang-default');
    if (lang != "" && lang != "vi") {
        $('body').find('.data_gg_lang_input[data-value="' + lang + '"]').click();
    }
});

$('body').on('click', '.click_gg_lang', function() {
    let value = $(this).data('lang');
    doGoogleLanguageTranslator(value);
    setCookie('lang-default', value, '1');
});
$(".form_gg_lang").btnNoneBlockPlugin({
    button: 'btn_gg_lang', // Thay thế class cho button
    data: 'data_gg_lang',
    animation: true,
    check_out: true,
    close: true,
    dropdowns: true,
    dropdowns_click_out: true,
    dropdowns_data: {
        input: 'data_gg_lang_input',
        output: 'data_gg_lang_output'
    },
});