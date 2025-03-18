(function($) {
    $.fn.animationCircle = function(options) {
        // Giá trị mặc định
        var settings = $.extend({
            items: "items_value", // Số lượng items
            numberOfItems: 5, // Số lượng items
            deviation: 0, // Khoảng cách vào trong (px)
            directionStart: 'top', // Hướng bắt đầu (top, left, bottom, right)
            locationStart: -2, // Vị trí xuất phát
            directionClick: 'top', // Hướng click
            locationClick: 0, // Vị trí xuất phát khi click
            animation: false // Thời gian animation (ms) - false nếu không có
        }, options);

        return this.each(function() {
            var form = $(this);

            var items = form.find('.' + settings.items);
            var angleStep = 360 / settings.numberOfItems;
            var radius = (form.outerWidth()) / 2;
            form.css({
                position: 'relative',
            });

            function arrangeItemsInCircle(userOptions) {

                let options = $.extend({ direction: 'top', location: 0, reduceRotate: 0 }, userOptions);

                let directionCSS;
                let heightItems = 0;
                items.each(function() {
                    heightItems = Math.max(heightItems, $(this).outerHeight() / 2);
                });
                switch (options.direction) {
                    case 'top':
                        directionCSS = 'translateY(' + (-(radius - heightItems - settings.deviation)) + 'px)';
                        break;
                    case 'left':
                        directionCSS = 'translateX(' + (-(radius - heightItems - settings.deviation)) + 'px)';
                        break;
                    case 'bottom':
                        directionCSS = 'translateY(' + (radius - heightItems - settings.deviation) + 'px)';
                        break;
                    case 'right':
                        directionCSS = 'translateX(' + (radius - heightItems - settings.deviation) + 'px)';
                        break;
                    default:
                        directionCSS = 'translateY(' + (-(radius - heightItems - settings.deviation)) + 'px)';
                        break;
                }

                items.each(function(index) {
                    const angle = (angleStep * index) + (angleStep * options.location) - (options.reduceRotate);
                    if (!$(this).attr('data-rotate')) {
                        $(this).attr('data-rotate', (angleStep * index));
                    }
                    $(this).css({
                        position: 'absolute',
                        left: '50%',
                        top: '50%',
                        transform: 'translate(-50%, -50%) rotate(' + angle + 'deg) ' + directionCSS + ' rotate(0deg)',
                        transition: settings.animation ? `all ${settings.animation / 1000}s` : ''
                    });

                    if ($(this).find(".swivel_part").length > 0) {
                        $(this).find(".swivel_part").css({
                            display: 'inline-block',
                            transform: 'rotate(' + (-angle) + 'deg)',
                        })
                    }
                });
            }

            // Gọi function sắp xếp ban đầu
            arrangeItemsInCircle({
                direction: settings.directionStart,
                location: settings.locationStart,
            });

            // Xử lý khi click nếu có animation
            if (settings.animation) {
                items.on('click', function() {
                    let rotate = $(this).data('rotate');
                    arrangeItemsInCircle({
                        direction: settings.directionClick,
                        location: settings.locationClick,
                        reduceRotate: rotate
                    });
                });
            }
        });
    };
})(jQuery);