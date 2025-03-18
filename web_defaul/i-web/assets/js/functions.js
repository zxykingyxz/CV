function loadApplication(check = true) {
    if (check) {
        $('body').append(`
            <div class="loadApplication">
               <div class="form_in_loadApplication">
                    <div class="icons_loadApplication">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="text_loadApplication">
                        <span>
                            Đang xử lý ...
                        </span>
                    </div>
                </div>
            </div>
        `);
    } else {
        setTimeout(function() {
            $("body .loadApplication").remove();
        }, 200)
    }
}