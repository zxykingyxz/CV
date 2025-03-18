<?php
$list_c1_product_menu = $cache->getCache("select id,type ,photo, ten_$lang as ten , tenkhongdau_$lang as tenkhongdau from #_baiviet_list where noibat=1 and type in ('san-pham') and hienthi=1 order by stt asc", array(), 'result', _TIMECACHE);

?>
<script>
    $(".form_product_menu_c1").btnNoneBlockPlugin({
        button: 'btn_product_menu_c1', // Thay thế class cho button
        data: 'data_product_menu_c1',
        animation: true,
        check_out: false,
        close: true,
    });
    $(".form_product_menu_c2").btnNoneBlockPlugin({
        button: 'btn_product_menu_c2', // Thay thế class cho button
        data: 'data_product_menu_c2',
        animation: true,
        check_out: false,
        close: true,
    });
</script>
<div class=" hidden md:block w-full md:w-[280px] flex-initial h-[inherit]">
    <div class=" bg_form_all  w-full">
        <div class="">
            <a href="<?= $func->getType('san-pham') ?>" title="Danh mục sản phẩm" class="text-lg font-semibold">
                Danh mục sản phẩm
            </a>
        </div>
        <div class="mt-2 border-t border-gray-200 pt-3">
            <div class="grid grid-cols-1 gap-1 form_product_menu_c1">
                <?php foreach ($list_c1_product_menu  as $key => $value) {
                    $list_c2_dm = $cache->getCache("select id,type, ten_$lang as ten , tenkhongdau_$lang as tenkhongdau ,photo from #_baiviet_cat where type=? and id_list=? and hienthi=1 order by stt asc", array($value['type'], $value['id']), 'result', _TIMECACHE);
                ?>
                    <div class="w-full  " data-nb="menu_dmc1_<?= $value['id'] ?>">
                        <div class="w-full text-base  font-main-400 text-black py-1 flex items-center gap-3">
                            <a href="<?= $func->getUrl($value) ?>" title="<?= (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"] ?>" class="font-normal flex-1 hover:text-[var(--html-bg-website)] transition-all duration-300">
                                <span>
                                    <?= (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"] ?>
                                </span>
                            </a>
                            <?php if (!empty($list_c2_dm)) { ?>
                                <div class="btn_product_menu_c1 [&.on]:scale-y-[-1] hover:text-[var(--html-bg-website)] transition-all duration-300 cursor-pointer" data-nb="menu_c1_<?= $value['id'] ?>">
                                    <i class="fas fa-angle-down font-medium text-base"></i>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="data_product_menu_c1 w-full hidden" data-nb="menu_c1_<?= $value['id'] ?>">
                            <div class="grid w-full gap-1 grid-cols-1 pl-3 mt-1 border-t border-gray-200">
                                <?php foreach ($list_c2_dm as $key_dm_c2 => $value_dm_c2) {
                                    $list_c3_dm = $cache->getCache("select id,type, ten_$lang as ten , tenkhongdau_$lang as tenkhongdau ,photo from #_baiviet_item where type=? and id_list=? and id_cat=? and hienthi=1 order by stt asc", array($value['type'], $value['id'], $value_dm_c2['id']), 'result', _TIMECACHE);
                                ?>
                                    <div class="w-full form_product_menu_c2">
                                        <div class="w-full text-sm  font-main-400 text-black py-1 flex items-center gap-1">
                                            <a href="<?= $func->getUrl($value_dm_c2) ?>" title="<?= (isset($value_dm_c2["ten_$lang"])) ? $value_dm_c2["ten_$lang"] : $value_dm_c2["ten"] ?>" class="font-normal flex-1 hover:text-[var(--html-bg-website)] transition-all duration-300">
                                                <span>
                                                    <?= (isset($value_dm_c2["ten_$lang"])) ? $value_dm_c2["ten_$lang"] : $value_dm_c2["ten"] ?>
                                                </span>
                                            </a>
                                            <?php if (!empty($list_c3_dm)) { ?>
                                                <div class="btn_product_menu_c2 [&.on]:scale-y-[-1] hover:text-[var(--html-bg-website)] transition-all duration-300 cursor-pointer" data-nb="menu_c2_<?= $value_dm_c2['id'] ?>">
                                                    <i class="fas fa-angle-down font-medium text-base"></i>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="hidden data_product_menu_c2" data-nb="menu_c2_<?= $value_dm_c2['id'] ?>">
                                            <div class="grid w-full gap-1 grid-cols-1 pl-3 mt-1 border-t border-gray-200">
                                                <?php foreach ($list_c3_dm as $key_dm_c3 => $value_dm_c3) { ?>
                                                    <div class="w-full text-sm  font-main-300 text-black py-1 ">
                                                        <a href="<?= $func->getUrl($value_dm_c3) ?>" title="<?= (isset($value_dm_c3["ten_$lang"])) ? $value_dm_c3["ten_$lang"] : $value_dm_c3["ten"] ?>" class="font-normal">
                                                            <span>
                                                                <?= (isset($value_dm_c3["ten_$lang"])) ? $value_dm_c3["ten_$lang"] : $value_dm_c3["ten"] ?>
                                                            </span>
                                                        </a>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>