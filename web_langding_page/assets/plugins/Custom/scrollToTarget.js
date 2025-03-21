(function($) {
    $.fn.scrollToTarget = function(options) {
        var settings = $.extend({
            targetAttr: 'data-target', // Thuộc tính chứa ID phần tử đích
            scrollSpeed: 800, // Tốc độ cuộn (ms)
            activeClass: 'active', // Class active cho nút
            offset: 100 // Khoảng cách từ trên xuống mới tính là active
        }, options);

        var $buttons = this; // Lưu danh sách các nút

        // Xử lý sự kiện click cho từng nút
        $buttons.each(function() {
            var $trigger = $(this);

            $trigger.on('click', function(e) {
                e.preventDefault();
                var targetSelector = $(this).attr(settings.targetAttr);
                if (!targetSelector) return; // Không có data-target thì bỏ qua

                var $target = $("#" + targetSelector);
                if ($target.length) {
                    $('html, body').animate({
                        scrollTop: $target.offset().top - settings.offset
                    }, settings.scrollSpeed);
                }
            });
        });

        var scrollTimeout;
        $(window).on('scroll', function() {
            if (scrollTimeout) clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(function() {
                var scrollTop = $(window).scrollTop();
                var activeTarget = null;

                $('[id]').each(function() {
                    var $target = $(this);
                    var targetTop = $target.offset().top - settings.offset;
                    var targetBottom = targetTop + $target.outerHeight();

                    if (scrollTop >= targetTop && scrollTop < targetBottom) {
                        activeTarget = $target.attr('id');
                        return false;
                    }
                });

                if (activeTarget) {
                    $buttons.removeClass(settings.activeClass);
                    $buttons.filter('[' + settings.targetAttr + '="' + activeTarget + '"]').addClass(settings.activeClass);
                }
            }, 100); // Chỉ kiểm tra mỗi 100ms
        });


        return this;
    };
}(jQuery));