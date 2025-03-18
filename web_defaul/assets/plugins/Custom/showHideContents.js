(function($) {
    $.fn.showHideContents = function(options) {
        // Thiết lập giá trị mặc định
        var settings = $.extend({
            class_sub: '',
            typeCheck: 'line', // 'line' hoặc 'height'
            lineCount: 10, // Số lượng dòng tối thiểu để hiện nút
            maxHeight: 200, // Chiều cao tối thiểu để hiện nút (tính bằng px)
            textShowMore: 'Hiển Thị Thêm',
            textShowLess: 'Thu Gọn Lại',
            iconShowMore: '<i class="fas fa-angle-down"></i>',
            iconShowLess: '<i class="fas fa-angle-up"></i>',
            button: 'btn_showhiden_contents',
            colorHover: 'blue',
            onToggle: null // Callback khi bật/tắt trạng thái
        }, options);

        // Xử lý từng phần tử được gọi plugin
        this.each(function() {
            var $container = $(this);

            // Lấy giá trị từ data-attribute hoặc mặc định từ settings
            var lineCount = $container.data('line') || settings.lineCount;
            var maxHeight = $container.data('height') || settings.maxHeight;

            // Tách nội dung ra một vùng riêng
            var html = $container.html();
            $container.find('*').remove();
            $container.append('<div class="content_showHideContents"></div>');
            $container.find('.content_showHideContents').append(html);
            html = "";
            var form_content = $container.find('.content_showHideContents');

            // Kiểm tra chế độ kiểm tra (line hoặc height)
            const contentHeight = form_content[0].scrollHeight;

            switch (settings.typeCheck) {
                case 'line':
                    {
                        const lineHeight = parseInt(form_content.css('line-height'), 10); // Lấy chiều cao dòng
                        const totalLines = Math.ceil(contentHeight / lineHeight);

                        if (totalLines > lineCount) {
                            addButton($container);
                            form_content.css({
                                'display': '-webkit-box',
                                '-webkit-line-clamp': String(lineCount),
                                '-webkit-box-orient': 'vertical',
                                'text-overflow': 'ellipsis',
                                'white-space': 'normal',
                                'overflow': 'hidden'
                            });
                        }
                        break;
                    }
                case 'height':
                    {
                        if (contentHeight > maxHeight) {
                            addButton($container);
                            form_content.css({
                                'max-height': maxHeight + 'px',
                                'overflow': 'hidden'
                            });
                        }
                        break;
                    }
                default:
                    console.warn('Invalid typeCheck value: ', settings.typeCheck);
            }

            // Gắn sự kiện click một lần trên document
            $('body').on('click', '.' + settings.button, function() {
                toggleContent($(this).closest($container));
            });
        });

        // Hàm thêm nút
        function addButton($container) {
            if ($container.find('.' + settings.button).length === 0) {
                var text = settings.textShowMore;
                var icon = settings.iconShowMore;
                var $button = $('<div>', {
                    class: settings.button + " " + settings.class_sub,
                    html: '<span>' + text + '</span>' + icon
                }).css({
                    'padding': '10px 15px',
                    'cursor': 'pointer',
                    'display': 'flex',
                    'justify-content': 'center',
                    'align-items': 'center',
                    'gap': '6px',
                    'font-size': '16px',
                    'font-weight': '700',
                    'transition': 'all 0.3s',
                });
                $button.hover(function() {
                    $(this).css('color', settings.colorHover);
                }, function() {
                    $(this).css('color', '#000');
                });
                $container.append($button);
            }
        }

        // Hàm bật/tắt hiển thị nội dung
        function toggleContent($container) {
            var isExpanded = $container.hasClass('show_content');
            $container.toggleClass('show_content');
            var lineCount = $container.data('line') || settings.lineCount;
            var maxHeight = $container.data('height') || settings.maxHeight;

            var text = isExpanded ? settings.textShowMore : settings.textShowLess;
            var icon = isExpanded ? settings.iconShowMore : settings.iconShowLess;
            var $button = $container.find('.' + settings.button);
            $button.html('<span>' + text + '</span>' + icon);

            if (isExpanded) {
                switch (settings.typeCheck) {
                    case 'line':
                        {
                            $container.find('.content_showHideContents').css({
                                '-webkit-line-clamp': String(lineCount),
                            });
                            break;
                        }
                    case 'height':
                        {
                            $container.find('.content_showHideContents').css({
                                'max-height': maxHeight + 'px',
                            });
                            break;
                        }
                }
            } else {
                switch (settings.typeCheck) {
                    case 'line':
                        {
                            $container.find('.content_showHideContents').css({
                                '-webkit-line-clamp': 'unset',
                            });
                            break;
                        }
                    case 'height':
                        {
                            $container.find('.content_showHideContents').css({
                                'max-height': 'none',
                            });
                            break;
                        }
                }
            }

            // Gọi callback nếu có
            if (typeof settings.onToggle === 'function') {
                settings.onToggle($container, !isExpanded);
            }
        }

        // Đảm bảo chuỗi plugin jQuery
        return this;
    };
}(jQuery));