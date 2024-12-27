// scroll web
// window.addEventListener('load', function() {
//     SmoothScroll({
//         stepSize: 50,
//         animationTime: 500,
//         accelerationMax: 3,
//         accelerationDelta: 100,
//         pulseScale: 4,
//         arrowScroll: 50,
//         keyboardSupport: true,
//         pulseAlgorithm: true,
//         anchor: true
//     });
// });
// cuộn ngang tự động
$(document).ready(function() {
    if ($('#scroll-container').length > 0) {
        var $scrollContainer = $('#scroll-container');
        var scrollWidth = $scrollContainer[0].scrollWidth;
        var containerWidth = $scrollContainer.width();
        var scrollAmount = 2; // Tốc độ cuộn tự động px
        var timescroll = 20; // Thời gian scroll
        var autoScrollInterval;
        var isDown = false;
        var startX;
        var scrollLeft;

        // Bắt sự kiện khi chuột được nhấn xuống trên khung chứa
        $scrollContainer.on('mousedown', function(e) {
            isDown = true;
            startX = e.pageX - $(this).offset().left;
            scrollLeft = $(this).scrollLeft();
            $(this).css('cursor', 'grabbing'); // Thay đổi con trỏ khi kéo
        });

        // Bắt sự kiện khi rời khỏi vùng chứa
        $(document).on('mouseleave', function() {
            if (isDown) {
                isDown = false;
                $scrollContainer.css('cursor', 'auto'); // Trả lại con trỏ mặc định khi rời ra ngoài
            }
        });

        // Bắt sự kiện khi nhả chuột
        $(document).on('mouseup', function() {
            if (isDown) {
                isDown = false;
                $scrollContainer.css('cursor', 'auto'); // Trả lại con trỏ mặc định khi nhả chuột
            }
        });

        // Bắt sự kiện khi di chuyển chuột trên khung chứa
        $scrollContainer.on('mousemove', function(e) {
            if (isDown) {
                e.preventDefault();
                var x = e.pageX - $(this).offset().left;
                var walk = (x - startX) * 3; // Điều chỉnh tốc độ kéo
                $(this).scrollLeft(scrollLeft - walk);
            }
        });

        // Hàm cuộn tự động
        function autoScroll() {
            var newScrollLeft = $scrollContainer.scrollLeft() + scrollAmount;
            if (newScrollLeft >= scrollWidth - containerWidth || newScrollLeft <= 0) {
                scrollAmount = -scrollAmount; // Đổi hướng khi đạt biên
            }
            if (timescroll > 1000) {
                $scrollContainer.stop().animate({ scrollLeft: newScrollLeft }, 500, 'swing');
            } else {
                $scrollContainer.scrollLeft(newScrollLeft);

            }
        }

        function startAutoScroll() {
            autoScrollInterval = setInterval(autoScroll, timescroll);
        }

        function stopAutoScroll() {
            clearInterval(autoScrollInterval);
        }

        $scrollContainer.on('mouseenter', stopAutoScroll);
        $scrollContainer.on('mouseleave', startAutoScroll);
        // Bắt đầu cuộn tự động mặc định
        autoScrollInterval = setInterval(autoScroll, timescroll);
    }
});

// bố trí items hình tròn tự động
$(document).ready(function() {

    // bố trí items hình tròn
    var form = $('.form_value'); // Chắc chắn rằng selector là đúng
    var items = form.find('.items_value'); // Chắc chắn rằng selector là đúng
    var numberOfItems = 12; // số lượng items
    var padding = 20; // độ lệch vào trong (px)
    var angleStep = 360 / numberOfItems;
    var radius = (form.outerWidth()) / 2; // bán kính của vòng tròn theo phần trăm
    var direction_start = 'top'; // hướng bắt đầu
    var location_start = -2; // vị trí xuất phát
    var direction_click = 'top'; // hướng click
    var location_click = 0; // vị trí xuất phát click
    var animation = false;

    function arrangeItemsInCircle(direction = 'top', location = 0, reduce_rotate = 0) {
        let direction_css;
        items.each(function(index) {
            $(this).css({
                position: 'absolute',
                left: '50%',
                top: '50%',
                transform: 'translate(-50%, -50%)',
                transition: 'all ' + animation / 1000 + 's',
            });
        });
        let width_items = items.width() / 2;
        switch (direction) {
            case 'top':
                direction_css = 'translateY(' + -(radius - width_items - padding) + 'px)';
                break;
            case 'left':
                direction_css = 'translateX(' + -(radius - width_items - padding) + 'px)';
                break;
            case 'bottom':
                direction_css = 'translateY(' + (radius - width_items - padding) + 'px)';
                break;
            case 'right':
                direction_css = 'translateX(' + (radius - width_items - padding) + 'px)';
                break;
            default:
                direction_css = 'translateY(' + -(radius - width_items - padding) + 'px)';
                break;
        }

        items.each(function(index) {
            const angle = (angleStep * index) + (angleStep * location) - (reduce_rotate);
            if (!$(this).attr('data-rotate')) {
                $(this).attr('data-rotate', (angleStep * index));
            }
            $(this).css({
                transform: 'translate(-50%, -50%) rotate(' + angle + 'deg) ' + direction_css + ' rotate(' + (-angle) + 'deg)',
            });
        });
    };
    arrangeItemsInCircle(direction_start, location_start);
    if (animation != false) {
        items.on('click', function() {
            let rotate = 0;
            rotate = $(this).data('rotate');
            arrangeItemsInCircle(direction_click, location_click, rotate);
        });
    }
});

// tạo passwỏd
function generateRandomPassword(length = 12) {
    const lowerCaseLetters = 'abcdefghijklmnopqrstuvwxyz';
    const upperCaseLetters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const specialCharacters = '!@#$%^&*(),.?":{}|<>';
    const allCharacters = lowerCaseLetters + upperCaseLetters + specialCharacters + '0123456789';
    let password = '';
    password += lowerCaseLetters[Math.floor(Math.random() * lowerCaseLetters.length)];
    password += upperCaseLetters[Math.floor(Math.random() * upperCaseLetters.length)];
    password += specialCharacters[Math.floor(Math.random() * specialCharacters.length)];
    for (let i = password.length; i < length; i++) {
        password += allCharacters[Math.floor(Math.random() * allCharacters.length)];
    }
    return shuffleString(password);
};

function shuffleString(str) {
    const array = str.split('');
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array.join('');
};

// popup
function actionPopup(class_form = null, class_close_form = null, class_view_form = null) {
    $('body').on('click', '.' + class_view_form, function() {
        if (!$('body .' + class_form).hasClass('active')) {
            $('body .' + class_form).addClass('active');
            $("body ").css('overflow', 'hidden');
        }
    });
    $('body').on('click', '.' + class_close_form, function() {
        if ($(this).closest(' .' + class_form).hasClass('active')) {
            $(this).closest(' .' + class_form).removeClass('active');
            $("body ").css('overflow', 'auto');
        }
    });
}
actionPopup("form_popup", "close_form_popup", "action_warehouse");