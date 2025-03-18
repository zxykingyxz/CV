(function($) {
    $.fn.animationNumber = function(options) {
        var settings = $.extend({
            duration: 3000,
            start: 0,
            format: false,
            observer: true,
            rootMargin: "0px 0px",
            threshold: 0,
            type: 'number', // 'number', 'percent', 'currency'
            currencySymbol: ' đ',
            currencyPosition: 'right',
        }, options);

        return this.each(function() {
            var $this = $(this);

            function formatValue(value) {
                if (settings.type === 'percent') {
                    return Math.round(value) + '%';
                } else if (settings.type === 'currency') {
                    let formatted = Math.round(value).toLocaleString('vi-VN');
                    return settings.currencyPosition === 'left' ? settings.currencySymbol + formatted : formatted + settings.currencySymbol;
                } else {
                    return (settings.format ? Math.round(value).toLocaleString('vi-VN') : Math.round(value));
                }
            }


            function startCounting() {
                const end = parseFloat($this.data("value"));
                if (isNaN(end)) return;
                let startTimestamp = null;

                function step(timestamp) {
                    if (!startTimestamp) startTimestamp = timestamp;
                    const elapsedPercent = (timestamp - startTimestamp) / settings.duration;
                    const easedProgress = Math.min(easeOutQuint(elapsedPercent), 1);
                    let interimNumber = easedProgress * (end - settings.start) + settings.start;

                    $this.html(formatValue(interimNumber));
                    if (easedProgress < 1) {
                        window.requestAnimationFrame(step);
                    }
                }

                window.requestAnimationFrame(step);
            }

            function easeOutQuint(x) {
                return 1 - Math.pow(1 - x, 5);
            }

            if (settings.observer) {
                var observer = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            startCounting();
                            observer.unobserve($this[0]);
                        }
                    });
                }, { root: null, rootMargin: settings.rootMargin, threshold: settings.threshold });

                observer.observe($this[0]);
            } else {
                startCounting();
            }
        });
    };
})(jQuery);

// Ví dụ sử dụng
// $("[data-module='countup']").animationNumber({ duration: 3000, type: 'currency', currencySymbol: '€' });