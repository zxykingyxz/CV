<?php
$current_time = time();

$flash_sale = $db->rawQueryOne("select id_product from #_flashsale where hienthi=1 and time_start<={$current_time} and time_end>={$current_time} limit 1", array());

if (!empty($product['id']) && !empty($flash_sale['id_product']) && in_array($product['id'], explode(',', $flash_sale['id_product']))) {
    $price = ($giabansale  != 0) ? $func->changeMoney($giabansale, $lang) : 'Liên hệ';
    $sale =  ($giabansale > 0 && $giacu > 0) ? $func->percentPrice($giacu, $giabansale) : '';
} else {
    $price = ($giaban != 0) ? $func->changeMoney($giaban, $lang) : 'Liên hệ';
    $sale = ($giaban > 0 && $giacu > 0) ? $func->percentPrice($giacu, $giaban) : '';
}
$price_old =  ($giaban > 0 && $giacu > 0) ? ($func->changeMoney($giacu, $lang)) : '';

?>
<div>
    <div class="flex items-center gap-3">
        <span>
            <span class="text-sm text-black">
                Giá:
            </span>
            &ensp;
            <span class="text-lg font-semibold font-main-600 text-red-600">
                <?= $price ?>
            </span>
        </span>
        <?php if (!empty($sale)) { ?>
            <span class="inline-flex items-center justify-center h-5 px-2 rounded bg-red-200 text-red-600 text-xs font-medium font-main-600 arrow ml20">
                <span>
                    <?= '-' . $sale ?>
                </span>
            </span>
        <?php } ?>
    </div>
    <?php if (!empty($price_old)) { ?>
        <div class="flex items-center gap-1 mt-1">
            <div>
                <span class="text-sm text-black">
                    Giá thị trường:
                </span>
                &ensp;
                <del class="text-sm font-medium font-main-500 text-gray-400">
                    <?= $price_old ?>
                </del>
            </div>
        </div>
    <?php } ?>
</div>