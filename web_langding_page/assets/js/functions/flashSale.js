if (flashsale_web_end != '' && flashsale_web_end > 0) {
    setInterval(function() {
        var now = new Date().getTime();
        var timeRemaining = new Date(time_end).getTime() - now;
        if (timeRemaining > 0) {
            var days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
            var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

            $('body .days_flash_sale').html(days.toString().padStart(2, '0'));
            $('body .hours_flash_sale').html(hours.toString().padStart(2, '0'));
            $('body .minutes_flash_sale').html(minutes.toString().padStart(2, '0'));
            $('body .seconds_flash_sale').html(seconds.toString().padStart(2, '0'));
        } else {
            setTimeout(function() {
                location.reload();
            }, 1000);

        }
    }, 1000);
}