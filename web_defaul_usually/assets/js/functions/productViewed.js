// button xóa đã xem
$('body').on('click', '.remove_viewed', function() {
    let _this = $(this);
    let value = $(this).data('value');
    $.ajax({
        url: 'ajax/functions/ajaxInteracted.php',
        type: 'POST',
        data: {
            value: value,
            form: "viewed",
        },
        dataType: 'JSON',
        beforeSend: function() {
            loadApplication(true);
        },
        success: function(data) {
            if (data.length && _this.closest(".items_viewed").closest('.owl-item').length > 0) {
                _this.closest(".items_viewed").closest('.owl-item').remove();
            }
        },
        complete: function() {
            loadApplication(false);
        }
    });
});