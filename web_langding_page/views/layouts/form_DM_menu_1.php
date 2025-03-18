<?php
$list_c1_product_menu = $cache->getCache("select id,type ,photo, ten_$lang as ten , tenkhongdau_$lang as tenkhongdau from #_baiviet_list where noibat=1 and type in ('san-pham') and hienthi=1 order by stt asc", array(), 'result', _TIMECACHE);
?>
<?= $func->getTemplateLayoutsFor([
    'name_layouts' => 'form_dm_menu',
    'seo_data' => true,
    'global' => ['source'],
]) ?>
<script>
    $(".form_menu").btnNoneBlockPlugin({
        button: 'btn_menu', // Thay thế class cho button
        data: 'data_menu',
        animation: false,
        check_out: false,
        close: false,
        event_hover: true,
    });
</script>
<div class="group/DM flex-initial leading-[0]">
    <div class=" inline-flex justify-center items-center leading-none gap-4 text-xl font-normal font-main-400 text-white cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="19" viewBox="0 0 27 19" fill="none">
            <path d="M1 1H26" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M1 9.33325H26" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M1 17.6667H26" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <span>Danh mục sản phẩm</span>
    </div>
    <div class="opacity-0 invisible pointer-events-none  group-hover/DM:opacity-100 group-hover/DM:visible  absolute top-full w-full left-0  overflow-hidden flex transition-all duration-300 ">
        <div class="hidden">
            <?php if (($source == 'index') && ($seo_data == true)) { ?>
                <h2>
                <?php } ?>
                <span>Sản Phấm</span>
                <?php if (($source == 'index') && ($seo_data == true)) { ?>
                </h2>
            <?php } ?>
        </div>
        <div class="pointer-events-auto w-[250px] bg-white shadow-md shadow-gray-300 border border-gray-300 max-h-[423px] overflow-y-auto overflow-x-hidden scroll-y">
            <div class="grid grid-cols-1 ">
                <?php foreach ($list_c1_product_menu as $key => $value) { ?>
                    <div class=" bg-inherit [&.on]:bg-[var(--html-bg-website)] [&.on]:text-white w-full first:border-none border-t border-gray-300 btn_menu transition-all duration-300  " data-nb="menu_dm_<?= $value['id'] ?>">
                        <?php if (($source == 'index') && ($seo_data == true)) { ?>
                            <h3>
                            <?php } ?>
                            <a href="<?= $func->getType($value) ?>" title="<?= $value['ten'] ?>" class=" flex items-center gap-2 px-3 py-2 font-normal">
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
        <div class="flex-1">
            <?php foreach ($list_c1_product_menu  as $key => $value) {
                $list_c2_dm = $cache->getCache("select id,type, ten_$lang as ten , tenkhongdau_$lang as tenkhongdau ,photo from #_baiviet_cat where type=? and id_list=? and hienthi=1 order by stt asc", array($value['type'], $value['id']), 'result', _TIMECACHE);
            ?>
                <div class="pointer-events-auto w-full data_menu p-2 opacity_animaiton hidden bg-white h-full shadow-md shadow-gray-300 border border-gray-200" data-nb="menu_dm_<?= $value['id'] ?>">
                    <div class="grid w-full gap-2 grid-cols-3 max-h-[410px] overflow-y-auto overflow-x-hidden scroll-y gap-y-5">
                        <?php foreach ($list_c2_dm as $key_dm_c2 => $value_dm_c2) {
                            $list_c3_dm = $cache->getCache("select id,type, ten_$lang as ten , tenkhongdau_$lang as tenkhongdau ,photo from #_baiviet_item where type=? and id_list=? and id_cat=? and hienthi=1 order by stt asc", array($value['type'], $value['id'], $value_dm_c2['id']), 'result', _TIMECACHE);
                        ?>
                            <div class="w-full ">
                                <div class="w-full text-base  font-main-400 text-black px-2 py-1 bg-gray-200">
                                    <?php if (($source == 'index') && ($seo_data == true)) { ?>
                                        <h4>
                                        <?php } ?>
                                        <a href="<?= $func->getUrl($value_dm_c2) ?>" title="<?= (isset($value_dm_c2["ten_$lang"])) ? $value_dm_c2["ten_$lang"] : $value_dm_c2["ten"] ?>" class="font-semibold">
                                            <span>
                                                <?= (isset($value_dm_c2["ten_$lang"])) ? $value_dm_c2["ten_$lang"] : $value_dm_c2["ten"] ?>
                                            </span>
                                        </a>
                                        <?php if (($source == 'index') && ($seo_data == true)) { ?>
                                        </h4>
                                    <?php } ?>
                                </div>
                                <div class="w-full grid grid-cols-1 ">
                                    <?php foreach ($list_c3_dm as $key_dm_c3 => $value_dm_c3) { ?>
                                        <div class="w-full text-sm  font-main-300 text-black px-3 py-2 first:border-none border-t border-gray-300">
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
                </div>
            <?php } ?>
        </div>
    </div>
</div>