$.fn.validateForm = function (opts) {
    var element = $(this),
        defaults = {
            url: 'ajax/newsletter.php',
            btnSubmit: '.btn-submit',
            btnSubmit1: '.btn-submit1'
        };
    $.extend(defaults, opts);
    element.on('click', defaults.btnSubmit, function () {

    });
};