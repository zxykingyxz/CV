(function($) {
    $.fn.formatInputPlugin = function(options) {
        var settings = $.extend({
            length_value: null, // Độ dài tối đa của giá trị
            max: null, // Giá trị tối đa
            min: null, // Giá trị tối thiểu
            unit: null, // Giá trị tối thiểu
        }, options);

        return this.each(function() {
            var $this = $(this);

            // Lắng nghe sự kiện 'input' để áp dụng định dạng khi người dùng nhập
            $this.on('input', function() {
                var value = $this.val();

                // Loại bỏ tất cả các ký tự không phải số
                value = value.replace(/\D/g, '');

                // Định dạng số với dấu phân cách hàng nghìn
                value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

                // Kiểm tra độ dài tối đa (length_value) và cắt nếu cần
                if (settings.length_value && value.length > settings.length_value) {
                    value = value.slice(0, settings.length_value);
                }

                // Kiểm tra giá trị tối đa và tối thiểu
                if (settings.max && parseInt(value.replace(/,/g, '')) > settings.max) {
                    value = settings.max.toLocaleString('vi-VN');
                }
                if (settings.min && parseInt(value.replace(/,/g, '')) < settings.min) {
                    value = settings.min.toLocaleString('vi-VN');
                }

                // Nếu giá trị trống, đặt giá trị mặc định là 1
                if (value.length < 0) {
                    value = 0;
                }
                // Thêm đơn vị nếu có
                if (settings.unit && settings.unit.length > 0) {
                    value = value + settings.unit;
                }
                // Cập nhật lại giá trị của input
                $this.val(value);
            });
        });
    };
})(jQuery);