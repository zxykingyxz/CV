(function($) {
    $.fn.formatInputPlugin = function(options) {
        var settings = $.extend({
            max: null, // Giá trị tối đa
            min: null, // Giá trị tối thiểu
            unit: null, // Đơn vị (ví dụ: 'VND', '%')
            unit_position: 'right', // Vị trí đơn vị ('left' hoặc 'right')
            type: 'price', // Kiểu dữ liệu ('price', 'number', 'percent', 'decimal')
            decimal_places: 2 // Số chữ số thập phân (áp dụng cho 'decimal' & 'percent')
        }, options);

        return this.each(function() {
            var $this = $(this);

            function cleanValue(value) {
                if (!value) return '';

                // Loại bỏ đơn vị nếu có
                if (settings.unit) {
                    value = value.replace(new RegExp(settings.unit, 'g'), '').trim();
                }

                // Chỉ giữ số và ký tự hợp lệ
                if (settings.type === 'number') {
                    value = value.replace(/\D/g, ''); // Chỉ giữ số
                } else if (settings.type === 'decimal' || settings.type === 'percent') {
                    value = value.replace(/[^0-9.]/g, ''); // Chỉ giữ số & dấu chấm
                } else {
                    value = value.replace(/[^0-9,]/g, ''); // Chỉ giữ số & dấu phẩy
                }

                return value;
            }

            function formatValue(value) {
                if (!value) return '';

                var numValue = parseFloat(value.replace(/,/g, '')) || 0;

                // Giới hạn giá trị min/max
                if (settings.max !== null) numValue = Math.min(numValue, settings.max);
                if (settings.min !== null) numValue = Math.max(numValue, settings.min);

                switch (settings.type) {
                    case 'price':
                        return numValue.toLocaleString('vi-VN');
                    case 'number':
                        return numValue.toString();
                    case 'percent':
                    case 'decimal':
                        return numValue.toFixed(settings.decimal_places);
                    default:
                        return numValue;
                }
            }

            function updateDisplay() {
                var rawValue = cleanValue($this.val());
                var formattedValue = formatValue(rawValue);

                // Lưu giá trị thực tế không có đơn vị
                $this.attr('data-raw', rawValue);

                // Thêm đơn vị nếu cần
                if (settings.unit) {
                    formattedValue =
                        settings.unit_position === 'right' ?
                        formattedValue + ' ' + settings.unit :
                        settings.unit + ' ' + formattedValue;
                }

                $this.val((rawValue > 0) ? formattedValue : 0);
            }

            // Gọi cập nhật khi nhập dữ liệu
            $this.on('input', function(e) {
                let value = $this.val();
                if (value.trim() !== '') { // Kiểm tra không phải chuỗi trống
                    updateDisplay();
                }
            });
            $this.each(function() {
                let value = $this.val();
                if (value.trim() !== '') {
                    updateDisplay();
                }
            });

            // Xử lý khi mất focus (đảm bảo lưu giá trị thực tế)
            $this.on('blur', function() {
                var rawValue = cleanValue($this.val());
                $this.attr('data-raw', rawValue);
            });
        });
    };
})(jQuery);