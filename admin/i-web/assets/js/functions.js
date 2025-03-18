function loadApplication(check = true) {
    Notiflix.Loading.init({
        svgColor: "#32c682",
        messageFontSize: "18px",
        messageMaxLength: 200
    });
    if (check) {
        Notiflix.Loading.standard("Đang xử lý...");
    } else {
        setTimeout(function() {
            Notiflix.Loading.remove();
        }, 200);
    }
}