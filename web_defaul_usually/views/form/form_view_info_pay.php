<script>
    // button xem thông tin thanh toán
    $('body').on('click', '.views_pay_info', function() {
        let value = $(this).data('value');
        $.ajax({
            url: 'ajax/functions/ajaxViewInfo.php',
            type: 'POST',
            data: {
                value: value,
                form: 'view_info_pay',
            },
            dataType: 'json',
            beforeSend: function() {
                loadApplication(true);
            },
            success: function(data) {
                $('body').append(data.html);
                $('body .form_popup').addClass('active');
                $("body ").css('overflow', 'hidden');
                $('body').on('click', '.close_form_popup', function() {
                    if ($(this).closest(' .form_popup').hasClass('active')) {
                        $(this).closest(' .form_popup').remove();
                        $("body ").css('overflow', 'auto');
                    }
                });
                _FRAMEWORK.loadWesite();
                _FRAMEWORK.Lazys();
                loadApplication(false);
            },
            complete: function() {}
        });
    });
</script>
<div class="form_view_info_product w-full <?= (!empty($background)) ? $background : 'bg-white' ?> py-4 px-3">
    <div class="<?= $close_popup ?> absolute inline-flex justify-center items-center h-7 aspect-[1/1] top-3 right-3 rounded-full bg-inherit cursor-pointer hover:bg-red-600 hover:text-white transition-all text-base z-10 ">
        <span>
            <i class="fas fa-times"></i>
        </span>
    </div>
    <div class="h-5"></div>
    <div class="text-xl font-main-700 font-bold leading-relaxed">
        <span>
            <?= $data['ten'] ?>
        </span>
    </div>
    <div class="text-base w-full content mt-5">
        <span>
            <?= htmlspecialchars_decode($data['mota']) ?>
        </span>
    </div>
</div>