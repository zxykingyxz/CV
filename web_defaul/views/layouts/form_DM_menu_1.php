<?php
$list_c1_product_menu = $cache->getCache("select id,type ,photo, ten_$lang as ten , tenkhongdau_$lang as tenkhongdau from #_baiviet_list where type in ('san-pham') and menu=1 and hienthi=1 order by stt asc", array(), 'result', _TIMECACHE);
$padding_list = "px-2 py-1";
$number_colum = 3;
$class_grid = "grid-cols-3";
$class_gap = "gap-1";
if (!$list_data) {
    $class_list_data = "opacity-0 invisible pointer-events-none group-hover/DM:opacity-100 group-hover/DM:visible absolute top-full w-full left-0  overflow-hidden";
    $class_list_button = "w-[250px]";
    $class_list_form = "flex-1";
} else {
    $class_list_data = "w-full relative form_menu_dm_c1";
    $class_list_button = "w-full";
    $class_list_form = "w-[900px] absolute left-full h-full top-0 z-10 pointer-events-none";
}
?>
<script>
    $(".form_menu_dm_c1").btnNoneBlockPlugin({
        button: 'btn_menu_dm_c1', // Thay thế class cho button
        data: 'data_menu_dm_c1',
        animation: false,
        check_out: false,
        close: true,
        event_hover: true,
    });
    $(".form_menu_dm_c2").btnNoneBlockPlugin({
        button: 'btn_menu_dm_c2', // Thay thế class cho button
        data: 'data_menu_dm_c2',
        animation: true,
        check_out: false,
        close: true,
        event_hover: true,
    });
</script>
<?php if (!$list_data) { ?>
    <div class="form_menu_dm_c1 group/DM flex-initial leading-[0]  ">
        <div class=" inline-flex justify-center items-center leading-none gap-4 text-xl font-normal font-main-400 text-white cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" width="27" height="19" viewBox="0 0 27 19" fill="none">
                <path d="M1 1H26" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M1 9.33325H26" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M1 17.6667H26" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <?php if (($source == 'index') && ($seo_data == true)) { ?>
                <h2>
                <?php } ?>
                <a href="<?= $func->getType('san-pham') ?>" class="font-normal" title="Danh mục sản phẩm">Danh mục sản phẩm</a>
                <?php if (($source == 'index') && ($seo_data == true)) { ?>
                </h2>
            <?php } ?>
        </div>
    <?php } ?>
    <div class=" flex transition-all duration-300 <?= $class_list_data ?>">
        <div class=" pointer-events-auto bg-white shadow-md shadow-gray-300 border border-gray-300 max-h-[423px] overflow-y-auto overflow-x-hidden scroll-y <?= $class_list_button ?>">
            <div class="grid grid-cols-1 ">
                <?php foreach ($list_c1_product_menu as $key => $value) { ?>
                    <div class=" bg-inherit [&.on]:bg-[var(--html-bg-website)] [&.on]:text-white w-full first:border-none border-t border-gray-300 btn_menu_dm_c1 transition-all duration-300 " data-nb="menu_dm_<?= $value['id'] ?>">
                        <?php if (($source == 'index') && ($seo_data == true)) { ?>
                            <h3>
                            <?php } ?>
                            <a href="<?= $func->getUrl($value) ?>" title="<?= $value['ten'] ?>" class=" flex items-center gap-2 px-3 py-2 font-normal">
                                <div class="rounded-md bg-gray-100 w-9 h-9 flex justify-center items-center p-2">
                                    <?= $func->addHrefImg([
                                        'addhref' => false,
                                        'sizes' => '200x200x2',
                                        'actual_width' => 500,
                                        'upload' => _upload_baiviet_l,
                                        'image' => ($value["photo"]),
                                    ]); ?>
                                </div>
                                <div class="leading-normal">
                                    <span><?= $value['ten'] ?></span>
                                </div>
                            </a>
                            <?php if (($source == 'index') && ($seo_data == true)) { ?>
                            </h3>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="<?= $class_list_form ?>">
            <?php
            foreach ($list_c1_product_menu  as $key_dm_c1 => $value_dm_c1) {
                $list_c2_dm = $cache->getCache("select id,type, ten_$lang as ten , tenkhongdau_$lang as tenkhongdau ,photo from #_baiviet_cat where type=? and id_list=? and hienthi=1 order by stt asc", array($value_dm_c1['type'], $value_dm_c1['id']), 'result', _TIMECACHE);
                if (((count($list_c2_dm))  % $number_colum) > 0) {
                    $max_list = intval((count($list_c2_dm)) / $number_colum) + 1;
                } else {
                    $max_list = intval((count($list_c2_dm)) / $number_colum);
                }
            ?>
                <div class="pointer-events-auto w-full p-2   bg-white h-full shadow-md shadow-gray-300 border border-gray-200  hidden data_menu_dm_c1 " data-nb="menu_dm_<?= $value_dm_c1['id'] ?>">
                    <div class="grid w-full items-start  max-h-[410px] overflow-y-auto overflow-x-hidden scroll-y <?= $class_grid . " " . $class_gap ?>">
                        <?php for ($i = 0; $i < $number_colum; $i++) { ?>
                            <div class="grid grid-cols-1 <?= $class_gap ?> items-start form_menu_dm_c2">
                                <?php for ($i_list = 0; $i_list < $max_list; $i_list++) {
                                    $value_dm_c2 = $list_c2_dm[($i + ($i_list * $number_colum))];
                                    $list_c3_dm = $cache->getCache("select id,type, ten_$lang as ten , tenkhongdau_$lang as tenkhongdau ,photo from #_baiviet_item where type=? and id_list=? and id_cat=? and hienthi=1 order by stt asc", array($value_dm_c1['type'], $value_dm_c1['id'], $value_dm_c2['id']), 'result', _TIMECACHE);
                                    if (!empty($value_dm_c2)) {
                                ?>
                                        <div class=" w-full group/DMC2 btn_menu_dm_c2" data-nb="c2_<?= $value_dm_c2['id'] ?>">
                                            <div class="w-full text-base  font-main-400 text-black  bg-inherit group-hover/DMC2:bg-gray-100 transition-all duration-300 rounded-md <?= $padding_list ?> ">
                                                <?php if (($source == 'index') && ($seo_data == true)) { ?>
                                                    <h4>
                                                    <?php } ?>
                                                    <a href="<?= $func->getUrl($value_dm_c2) ?>" title="<?= (isset($value_dm_c2["ten_$lang"])) ? $value_dm_c2["ten_$lang"] : $value_dm_c2["ten"] ?>" class="font-normal flex items-center gap-3 w-full transition-all duration-300">
                                                        <span class="flex-1 ">
                                                            <?= (isset($value_dm_c2["ten_$lang"])) ? $value_dm_c2["ten_$lang"] : $value_dm_c2["ten"] ?>
                                                        </span>
                                                        <i class="fas fa-chevron-right font-normal text-sm"> </i>
                                                    </a>
                                                    <?php if (($source == 'index') && ($seo_data == true)) { ?>
                                                    </h4>
                                                <?php } ?>
                                            </div>
                                            <?php if (!empty($list_c3_dm)) { ?>
                                                <div class="w-full pl-4 hidden data_menu_dm_c2" data-nb="c2_<?= $value_dm_c2['id'] ?>">
                                                    <div class="w-full grid grid-cols-1 ">
                                                        <?php foreach ($list_c3_dm as $key_dm_c3 => $value_dm_c3) { ?>
                                                            <div class="w-full text-sm  font-main-300 text-black <?= $padding_list ?> hover:text-[var(--html-bg-website)]">
                                                                <?php if (($source == 'index') && ($seo_data == true)) { ?>
                                                                    <h5>
                                                                    <?php } ?>
                                                                    <a href="<?= $func->getUrl($value_dm_c3) ?>" title="<?= (isset($value_dm_c3["ten_$lang"])) ? $value_dm_c3["ten_$lang"] : $value_dm_c3["ten"] ?>" class="font-normal">
                                                                        <span>
                                                                            <?= (isset($value_dm_c3["ten_$lang"])) ? $value_dm_c3["ten_$lang"] : $value_dm_c3["ten"] ?>
                                                                        </span>
                                                                    </a>
                                                                    <?php if (($source == 'index') && ($seo_data == true)) { ?>
                                                                    </h5>
                                                                <?php } ?>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php if (!$list_data) { ?>
    </div>
<?php } ?>