<?php
$list_all_c1 = $db->rawQuery("select id,type,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau from #_baiviet_list ", array());

$list_all_c2 = $db->rawQuery("select id,id_list,type,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau from #_baiviet_cat ", array());

$list_all_c3 = $db->rawQuery("select id,id_cat,type,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau from #_baiviet_item ", array());

function renderMenuItems($options)
{
    $defaults = [
        'type' => '',
        'level' => '',
        'name' => '',
        'before' => '',
        'after' => '',
        'link' => '',
        'is-lever' => false,
        'hidden' => false,

    ];
    $info = array_merge($defaults, $options);
    ob_start();
?>
    <div class="items_menu_mobile_js group/item flex border-b border-gray-300 transition-all duration-300 [&.active]:bg-[var(--html-bg-website)] [&.active_*]:text-white" data-type="<?= $info["type"] ?>" data-before="<?= $info["before"] ?>" data-after="<?= $info["after"] ?>" data-level="<?= $info["level"] ?>" <?= ($info["hidden"] == false ? "style='display: none;'" : "") ?>>
        <a href="<?= $info["link"] ?>" class="py-3 pr-2 pl-3 flex-1 text-[#040404] text-base transition-all duration-300 font-medium font-main" title="<?= $info["name"] ?>">
            <?= $info["name"] ?>
        </a>
        <?php if ($info["is-lever"] == true) { ?>
            <div class="btn_menu_mobile_js h-[initial] w-[45px] inline-flex justify-center items-center flex-initial border-l border-gray-300 cursor-pointer transition-all duration-300">
                <i class="fas fa-angle-down font-medium text-xl text-gray-600 group-[&.active]/item:rotate-90 transition-all duration-300"></i>
            </div>
        <?php } ?>
    </div>
<?php
    $htmlContent = ob_get_clean();
    echo $htmlContent;
}
?>
<div class="form_menu_mobile_js fixed flex left-0 top-1/2 h-full w-full z-50 transition-all duration-300 translate-x-[-100%] translate-y-[-50%] pointer-events-none opacity-0 invisible [&.active]:translate-x-[0%] [&.active]:opacity-100 [&.active]:visible [&.active]:pointer-events-auto">
    <div class="bg-white max-w-[80%] w-[400px] h-full shadow-md flex-initial flex flex-col">
        <div class="flex  justify-between items-center bg-[var(--html-bg-website)] shadow brightness-95 p-1 gap-1">
            <div class="flex-1 ">
                <form method="get" class="form-search relative bg-white rounded pr-1 pl-3 transition-all duration-500  mx-auto w-full ">
                    <div class=" flex justify-center items-center max-w-full">
                        <div class="flex-1">
                            <input type="text" size="0" name="keywords" class="keyword w-full flex-1 h-9 outline-none border-none text-sm placeholder:text-gray-600" placeholder="Tìm Kiếm...">
                        </div>
                        <?php if ($config['function']['advancedSearch'] == true) { ?>
                            <div class="close_view_search hidden">
                                <div class="" style="display: flex;cursor: pointer; justify-content: center; align-items: center;width: 40px; height: 40px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="Capa_1" enable-background="new 0 0 320.591 320.591" viewBox="0 0 320.591 320.591" style="width: 15px; height: auto; fill: var(--html-bg-website);">
                                        <g>
                                            <g id="close_1_">
                                                <path d="m30.391 318.583c-7.86.457-15.59-2.156-21.56-7.288-11.774-11.844-11.774-30.973 0-42.817l257.812-257.813c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875l-259.331 259.331c-5.893 5.058-13.499 7.666-21.256 7.288z" style="fill: var(--html-bg-website);" />
                                                <path d="m287.9 318.583c-7.966-.034-15.601-3.196-21.257-8.806l-257.813-257.814c-10.908-12.738-9.425-31.908 3.313-42.817 11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414-6.35 5.522-14.707 8.161-23.078 7.288z" style="fill: var(--html-bg-website);" />
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                            <div class=" view_load_search hidden">
                                <div class="rp-loader" style="display: flex; justify-content: center; align-items: center;width: 40px; height: 40px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" style="width: 25px; height: auto; fill: var(--html-bg-website);">
                                        <circle r="80" cx="500" cy="90" style="fill: var(--html-bg-website);"></circle>
                                        <circle r="80" cx="500" cy="910" style="fill: var(--html-bg-website);"></circle>
                                        <circle r="80" cx="90" cy="500" style="fill: var(--html-bg-website);"></circle>
                                        <circle r="80" cx="910" cy="500" style="fill: var(--html-bg-website);"></circle>
                                        <circle r="80" cx="212" cy="212" style="fill: var(--html-bg-website);"></circle>
                                        <circle r="80" cx="788" cy="212" style="fill: var(--html-bg-website);"></circle>
                                        <circle r="80" cx="212" cy="788" style="fill: var(--html-bg-website);"></circle>
                                        <circle r="80" cx="788" cy="788" style="fill: var(--html-bg-website);"></circle>
                                    </svg>
                                </div>
                            </div>
                        <?php } ?>
                        <button type="submit" class="btn-search flex-initial rounded-full outline-none border-none cursor-pointer bg-transparent text-lg w-10 aspect-[1/1] text-[var(--html-bg-website)] ">
                            <i class="fas fa-search font-medium h-[19px] w-[19px] leading-[0] inline-flex justify-center items-center"></i>
                        </button>
                    </div>
                </form>
                <?php if ($config['function']['advancedSearch'] == true) { ?>
                    <div class="view_input" style="width: 100%;"></div>
                <?php } ?>
            </div>
            <div class="flex-initial">
                <div class="btn_menuMb cursor-pointer text-white text-2xl h-[40px] aspect-[1/1] inline-flex justify-center items-center">
                    <i class="fas fa-times"></i>
                </div>
            </div>
        </div>
        <div class="flex-1 overflow-x-hidden overflow-y-auto max-h-[inherit] scroll-design-one">
            <!-- danh mục -->
            <?php
            foreach ($authArrs as $k => $v) {
                if (!in_array($k, $notShowMenu)) {
                    $list_c1 = $db->rawQuery("select id from #_baiviet_list where type=? limit 0,1 ", array($k));
                    renderMenuItems([
                        'type' => $k,
                        'level' => 0,
                        'name' => $v['title'],
                        'before' => '',
                        'after' => $k,
                        'link' => $func->getType($k),
                        'is-lever' => $v['level'] == true && (!empty($list_c1) || $v['isCheck'] == true),
                        'hidden' =>  true,
                    ]);
                    if ($v['isCheck'] == true) {
                        $list_ds = $db->rawQuery("select id,type,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau from #_baiviet where type=?  ", array($k));
                        foreach ($list_ds as $k_ds => $v_ds) {
                            renderMenuItems([
                                'type' => $v_ds['type'],
                                'level' => 1,
                                'name' => $v_ds['ten'],
                                'before' => $v_ds['type'],
                                'after' => $v_ds['type'] . $v_ds['id'],
                                'link' => $func->getUrl($v_ds),
                            ]);
                        }
                    }
                }
            }
            // danh mục cấp 1 
            if ($v_c1['type'] != 'goi-chup-anh-cuoi') {
                foreach ($list_all_c1 as $k_c1 => $v_c1) {
                    $list_c2 = $db->rawQuery("select id from #_baiviet_cat where id_list=? and type=? limit 0,1 ", array($v_c1['id'], $v_c1['type']));
                    renderMenuItems([
                        'type' => $v_c1['type'],
                        'level' => 1,
                        'name' => $v_c1['ten'],
                        'before' => $v_c1['type'],
                        'after' => $v_c1['type'] . $v_c1['id'],
                        'link' => $func->getUrl($v_c1),
                        'is-lever' => $v_c1['type'] == 'goi-chup-anh-cuoi' ? false : (!empty($list_c2)),

                    ]);
                }
            }
            // //  danh mục cấp 2 
            if ($v_c2['type'] != 'goi-chup-anh-cuoi') {
                foreach ($list_all_c2 as $k_c2 => $v_c2) {
                    $list_c3 = $db->rawQuery("select id from #_baiviet_item where id_cat=? and type=? limit 0,1 ", array($v_c2['id'], $v_c2['type']));
                    renderMenuItems([
                        'type' => $v_c2['type'],
                        'level' => 2,
                        'name' => $v_c2['ten'],
                        'before' => $v_c2['type'] . $v_c2['id_list'],
                        'after' => $v_c2['type'] . $v_c2['id'],
                        'link' => $func->getUrl($v_c2),
                        'is-lever' => (!empty($list_c3)),
                    ]);
                }
            }
            //  danh mục cấp 3 
            foreach ($list_all_c3 as $k_c3 => $v_c3) {
                renderMenuItems([
                    'type' => $v_c3['type'],
                    'level' => 3,
                    'name' => $v_c3['ten'],
                    'before' => $v_c3['type'] . $v_c3['id_cat'],
                    'after' => $v_c3['type'] . $v_c3['id'],
                    'link' => $func->getUrl($v_c3),
                ]);
            }
            ?>
        </div>
        <div class="w-full bg-[var(--html-bg-website)] px-1 py-3 flex items-center">
        </div>
    </div>
    <div class="btn_menuMb cursor-pointer opacity-0 bg-[#000000a8] flex-1 h-full [&.active]:opacity-100 [&.active]:transition-[opacity] [&.active]:delay-300 [&.active]:duration-300"></div>
</div>