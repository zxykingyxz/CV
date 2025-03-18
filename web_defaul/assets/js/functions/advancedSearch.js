// tìm kiếm nâng cao
var typingTimer;
var time_addkeywords = 500;
$('body').on('input', 'input[name="keywords"]', function() {
    if ($('body').find('.view_input').length > 0) {
        var _this = $(this);
        clearTimeout(typingTimer);
        $('body').find('.view_load_search').css('display', 'block');
        $('body').find('.close_view_search').css('display', 'none');
        typingTimer = setTimeout(function() {
            var value = _this.val();
            $.ajax({
                url: 'ajax/functions/ajaxAdvancedSearch.php',
                type: 'POST',
                data: {
                    value: value,
                },
                beforeSend: function() {},
                success: function(data) {
                    $('body').find('.view_input').html(data);
                    $('body').find('.view_load_search').css('display', 'none');
                    if (value.length > 0) {
                        $('body').find('.close_view_search').css('display', 'block');
                    } else {
                        $('body').find('.close_view_search').css('display', 'none');
                    };
                    _FRAMEWORK.loadWesite();
                    _FRAMEWORK.Lazys();
                },
                complete: function() {}
            });
        }, time_addkeywords);
    }
});
$('body').on('click', '.close_view_search', function() {
    $('body').find('.view_input>div').remove();
    $('body').find('input[name="keywords"]').val('');
    $('body').find('.close_view_search').css('display', 'none');
});