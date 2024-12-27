<?php
if (!empty($_SESSION['product_viewed'])) {
    $list_id = implode(',', $_SESSION['product_viewed']);
    if (!empty($list_id)) {
        $list_product = $cache->getCache("select id,type,ten_$lang as ten,giaban,giacu,photo,tenkhongdau_$lang as tenkhongdau from #_baiviet where id in ($list_id) and hienthi=1 order by stt asc,id desc", array(), 'result', _TIMECACHE);
    }
}

// ajax
require_once 'ajaxConfig.php';

if ($func->isAjax()) {

    @$value = htmlspecialchars($_POST['value']);

    $key = array_search($value, $_SESSION['product_viewed']);

    if (!empty($_SESSION['product_viewed'][$key])) {
        unset($_SESSION['product_viewed'][$key]);
    }

    $func->_setCookie('_product_viewed_', $func->json_encode($_SESSION['product_viewed']));
};

?>
<script>
    // button xóa đã xem
    $('body').on('click', '.remove_viewed', function() {
        let _this = $(this);
        let value = $(this).data('value');
        $.ajax({
            url: 'ajax/ajaxViewed.php',
            type: 'POST',
            data: {
                value: value,
            },
            beforeSend: function() {
                loadApplication(true);
            },
            success: function(data) {
                _this.closest(".items_viewed").closest('.owl-item ').remove();
                loadApplication(false);
            },
            complete: function() {}
        });
    });
</script>
<?php if (!empty($list_product)) { ?>
    <div class="bg-white rounded-2xl px-3 sm:px-10 py-9">
        <div class=" w-full ">
            <div class="flex ">
                <div>
                    <div class="text-2xl font-bold font-main-700  text-black">
                        <span>
                            <?= "SẢN PHẨM ĐÃ XEM" ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="owl-carousel form_viewed_product owl-theme mt-6">
                <?= $func->getTemplateLayoutsFor([
                    'name_layouts' => 'gridTemplateProduct4',
                    'seoHeading' => 'span',
                    'data' => $list_product,
                ]); ?>
            </div>
        </div>
    </div>
<?php } ?>