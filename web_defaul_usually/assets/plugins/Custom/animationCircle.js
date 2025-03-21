(function($) {
    $.fn.animationCircle = function(options) {
        // Giá trị mặc định
        var settings = $.extend({
            items: "items_value", // Số lượng items
            numberOfItems: 5, // Số lượng items
            deviation: 0, // Khoảng cách vào trong (px)
            directionStart: 'top', // Hướng bắt đầu (top, left, bottom, right)
            locationStart: -2, // Vị trí xuất phát
            allowClick: false,
            directionClick: 'top', // Hướng click
            locationClick: 0, // Vị trí xuất phát khi click
            animationAction: 0, // Thời gian animationAction (ms) - false nếu không có
            rotationSpeed: 0
        }, options);

        return this.each(function() {
            var form = $(this);
            var currentRotate = 0;
            var items = form.find('.' + settings.items);
            if (items.length === 0) return;
            var angleStep = 360 / settings.numberOfItems;
            var radius = (form.outerWidth()) / 2;
            form.css({
                position: 'relative',
            });

            function arrangeItemsInCircle(userOptions) {

                let options = $.extend({ direction: 'top', location: 0, reduceRotate: 0, animation: true }, userOptions);

                let directionCSS;
                let heightItems = 0;
                items.each(function() {
                    heightItems = Math.max(heightItems, $(this).outerHeight() / 2);
                });

                const directions = {
                    top: `translateY(${-(radius - heightItems - settings.deviation)}px)`,
                    left: `translateX(${-(radius - heightItems - settings.deviation)}px)`,
                    bottom: `translateY(${radius - heightItems - settings.deviation}px)`,
                    right: `translateX(${radius - heightItems - settings.deviation}px)`
                };
                directionCSS = directions[options.direction] || directions['top'];

                items.each(function(index) {
                    const angle = (angleStep * index) + (angleStep * options.location) - (options.reduceRotate);
                    $(this).attr('data-rotate', angleStep * index);

                    $(this).css({
                        position: 'absolute',
                        left: '50%',
                        top: '50%',
                        transform: 'translate(-50%, -50%) rotate(' + angle + 'deg) ' + directionCSS + ' rotate(0deg)',
                        transition: ((parseFloat(settings.animationAction)) > 0 && options.animation) ? `all ${parseFloat(settings.animationAction)}s` : ''
                    });

                    if ($(this).find(".swivel_part").length > 0) {
                        $(this).find(".swivel_part").css({
                            display: 'inline-block',
                            transform: 'rotate(' + (-angle) + 'deg)',
                        })
                    }
                });
            }

            function rotateSmoothly() {
                currentRotate += (0.1 * settings.rotationSpeed); // Tăng góc quay
                arrangeItemsInCircle({
                    direction: settings.directionStart,
                    location: settings.locationStart,
                    reduceRotate: currentRotate,
                    animation: false,
                });
                requestAnimationFrame(rotateSmoothly);
            }
            // Gọi function sắp xếp ban đầu
            arrangeItemsInCircle({
                direction: settings.directionStart,
                location: settings.locationStart,
            });
            if (settings.rotationSpeed > 0) {
                rotateSmoothly();
            }

            // Xử lý khi click nếu có animationAction
            if (settings.allowClick) {
                items.off('click').on('click', function() {
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