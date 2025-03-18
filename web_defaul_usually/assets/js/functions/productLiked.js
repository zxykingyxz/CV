// like sản phẩm
$('body').on('click', '.btn-link', function() {
    let _this = $(this);
    let id = _this.data('id');
    $.ajax({
        url: 'ajax/functions/ajaxInteracted.php',
        type: 'POST',
        data: {
            value: id,
            form: "like",
        },
        dataType: 'JSON',
        beforeSend: function() {
            loadApplication(true);
        },
        success: function(data) {
            $('body').find('.view_liked').text(data.data.total);
            _this.toggleClass('active');
        },
        complete: function() {
            loadApplication(false);
        }
    });
});