<?php
global $logo;
// order by
$orderbyForProduct = $func->getOrderByTypeFor('san-pham');
$orderbyForService = $func->getOrderByTypeFor('dich-vu');
$orderbyForTips = $func->getOrderByTypeFor('meo-thu-cung');


$class_title_sup_main = "text-base font-medium font-main-500 text-black ";
$class_title_main = "text-xl sm:text-2xl font-bold font-main-700 text-[var(--html-bg-website)] uppercase  ";
$class_content_main = "text-sm text-[#757575]  leading-[1.8] font-normal font-main-400";

// giới thiệu
$info = $cache->getCache("select id,type,ten_$lang as ten,slogan_$lang as slogan,mota_$lang as mota,photo from #_info where type=? and hienthi=1", array('ve-chung-toi'), 'fetch', _TIMECACHE);

$list_photos_info = $cache->getCache("select photo from #_baiviet_photo where type=? and id_baiviet=? and hienthi=1 order by stt asc", array($info['type'], $info['id']), 'result', _TIMECACHE);
// lý do
$info_why = $cache->getCache("select  ten_$lang as ten,mota_$lang as mota,slogan_$lang as slogan from #_bannerqc where type=? and hienthi=1", array('info_why'), 'fetch', _TIMECACHE);

$list_why = $cache->getCache("select  ten_$lang as ten,photo from #_photo where type=? and hienthi=1", array('list_why'), 'result', _TIMECACHE);

// lợi ích
$info_benerfit = $cache->getCache("select  ten_$lang as ten,mota_$lang as mota,slogan_$lang as slogan,photo,photo2 from #_bannerqc where type=? and hienthi=1", array('info_benerfit'), 'fetch', _TIMECACHE);

$list_benerfit = $cache->getCache("select  ten_$lang as ten,photo from #_photo where type=? and hienthi=1 limit 0,10", array('list_benerfit'), 'result', _TIMECACHE);

// sản phẩm
$info_product = $cache->getCache("select  ten_$lang as ten,mota_$lang as mota,slogan_$lang as slogan from #_bannerqc where type=? and hienthi=1", array('info_product'), 'fetch', _TIMECACHE);

$list_c1_procuct = $cache->getCache("select id,type, ten_$lang as ten,photo from #_baiviet_list where type =? and hienthi=1 order by stt asc", array("san-pham"), 'result', _TIMECACHE);

// hình ảnh
$info_images = $cache->getCache("select  ten_$lang as ten,mota_$lang as mota,slogan_$lang as slogan from #_bannerqc where type=? and hienthi=1", array('info_images'), 'fetch', _TIMECACHE);

$list_images = $cache->getCache("select id,type,ten_$lang as ten,photo from #_photo where type=? and hienthi=1 order by stt asc,id desc ", array('hinh-anh'), 'result', _TIMECACHE);

// form đăng ký
$info_about = $cache->getCache("select  ten_$lang as ten,mota_$lang as mota,photo from #_bannerqc where type=? and hienthi=1", array('info_about'), 'fetch', _TIMECACHE);

$info_client = $cache->getCache("select  ten_$lang as ten,mota_$lang as mota,slogan_$lang as slogan,photo from #_bannerqc where type=? and hienthi=1", array('info_client'), 'fetch', _TIMECACHE);

$info_client_sub = $cache->getCache("select  ten_$lang as ten,mota_$lang as mota,slogan_$lang as slogan,photo from #_bannerqc where type=? and hienthi=1", array('info_client_sub'), 'fetch', _TIMECACHE);

$list_about = $cache->getCache("select id,type,ten_$lang as ten,mota_$lang as mota,photo from #_photo where type=? and hienthi=1 order by stt asc,id desc ", array('list_about'), 'result', _TIMECACHE);
?>
<div class="h-8 sm:h-12 "></div>
<!-- giới thiệu -->
<?php if (!empty($info)) { ?>
    <section class="section-introduce pb-8 sm:pb-12 ">
        <div class="grid_s wide ">
            <div class="bg_form_all form_opacity_1">
                <div class="w-full flex flex-wrap items-center justify-center gap-5 md:gap-[35px] pb-6">
                    <div class="flex-1">
                        <div class="flex items-center title_gsap_1 <?= $class_title_sup_main ?> gap-2 ">
                            <div class="flex-[0_0_auto] w-4 h-0 border-t border-[var(--html-sc-website)]"></div>
                            <span class="flex-initial">
                                <?= $info["ten"] . " " ?>
                            </span>
                            <div class=" flex-[0_0_auto] w-4 h-0 border-t border-[var(--html-sc-website)]"></div>
                        </div>
                        <div class="<?= $class_title_main ?> title_gsap_1 mt-2 ">
                            <span>
                                <?= $info["slogan"] ?>
                            </span>
                        </div>
                        <div class="mt-2 text-sm leading-[1.8] font-normal font-main-400">
                            <span class="text-[#494949] line-clamp-6 ">
                                <?= htmlspecialchars_decode($info["mota"]) ?>
                            </span>
                        </div>
                        <div class="mt-7 ">
                            <button title="Tìm hiểu thêm " class="views_introduce_info capitalize outline-none border-none inline-flex justify-center items-center leading-none h-10 rounded-full px-8 bg-[var(--html-bg-website)] text-white text-base font-medium font-main-500 text-center hover:bg-[var(--html-sc-website)] gap-2 transition-all duration-300" data-value="<?= $info["id"] ?>" data-form="view_info_introduce">
                                <span>Tìm hiểu thêm</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <g clip-path="url(#clip0_1_59)">
                                        <path d="M6.5625 13.209V16.6875C6.5625 16.9305 6.7185 17.1457 6.9495 17.2222C7.00725 17.241 7.0665 17.25 7.125 17.25C7.3005 17.25 7.47 17.1675 7.578 17.0205L9.61275 14.2515L6.5625 13.209Z" fill="currentColor" />
                                        <path d="M17.7638 0.104316C17.5913 -0.0179335 17.3648 -0.0344335 17.1773 0.0638165L0.302283 8.87632C0.102783 8.98057 -0.0149666 9.19357 0.00153336 9.41782C0.0187834 9.64282 0.168033 9.83482 0.380283 9.90757L5.07153 11.5111L15.0623 2.96857L7.33128 12.2828L15.1935 14.9701C15.252 14.9896 15.3135 15.0001 15.375 15.0001C15.477 15.0001 15.5783 14.9723 15.6675 14.9183C15.81 14.8313 15.9068 14.6851 15.9315 14.5208L17.994 0.645816C18.0248 0.435816 17.9363 0.227316 17.7638 0.104316Z" fill="currentColor" />
                                    </g>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="w-full lg:w-[52%] image_fade_scale_1 ">
                        <div class="swiper introduce_main">
                            <div class="swiper-wrapper">
                                <?php foreach ($list_photos_info as $key => $value) { ?>
                                    <div class="swiper-slide transition-all duration-300">
                                        <div class="w-full rounded-lg sm:rounded-3xl overflow-hidden leading-none">
                                            <?= $func->addHrefImg([
                                                'classfix' => '',
                                                'addhref' => false,
                                                'sizes' => "372x316x1",
                                                'actual_width' => 1100,
                                                'upload' => _upload_hinhanh_l,
                                                'image' => $value["photo"],
                                                'alt' =>  $info["ten"],
                                            ]); ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="w-full mt-5 flex items-center justify-center gap-3 ">
                                <button class="swiper_button_design_prev w-[37px] aspect-[1/1] bg-[#DFDDDD] rounded-full text-[#444343] hover:bg-[var(--html-bg-website)] hover:text-white flex justify-center items-center transition-all duration-300 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="8" viewBox="0 0 16 8" fill="none">
                                        <path d="M0.772627 3.38717C0.577365 3.58243 0.577365 3.89901 0.772627 4.09427L3.95461 7.27626C4.14987 7.47152 4.46645 7.47152 4.66171 7.27626C4.85698 7.08099 4.85698 6.76441 4.66171 6.56915L1.83329 3.74072L4.66171 0.912295C4.85698 0.717032 4.85698 0.40045 4.66171 0.205188C4.46645 0.0099256 4.14987 0.00992557 3.95461 0.205188L0.772627 3.38717ZM15.4573 3.24072L1.12618 3.24072L1.12618 4.24072L15.4573 4.24072L15.4573 3.24072Z" fill="currentColor" />
                                    </svg>
                                </button>
                                <button class="swiper_button_design_next w-[37px] aspect-[1/1] bg-[#DFDDDD] rounded-full text-[#444343] hover:bg-[var(--html-bg-website)] hover:text-white flex justify-center items-center transition-all duration-300 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="8" viewBox="0 0 16 8" fill="none">
                                        <path d="M15.2265 4.09428C15.4218 3.89902 15.4218 3.58243 15.2265 3.38717L12.0445 0.20519C11.8493 0.00992759 11.5327 0.00992757 11.3374 0.20519C11.1422 0.400452 11.1422 0.717034 11.3374 0.912296L14.1659 3.74072L11.3374 6.56915C11.1422 6.76441 11.1422 7.081 11.3374 7.27626C11.5327 7.47152 11.8493 7.47152 12.0445 7.27626L15.2265 4.09428ZM0.541809 4.24072L14.873 4.24072L14.873 3.24072L0.541809 3.24072L0.541809 4.24072Z" fill="currentColor" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>

<!-- lý do -->
<?php if (!empty($list_why)) { ?>
    <section class="section-why pb-8 sm:pb-12 ">
        <div class="grid_s wide ">
            <div class="bg_form_all form_opacity_2">
                <div class="w-full text-center flex flex-wrap justify-center">
                    <div class="w-full flex items-center justify-center title_gsap_2 <?= $class_title_sup_main ?> gap-2 ">
                        <div class="flex-[0_0_auto] w-4 h-0 border-t border-[var(--html-sc-website)]"></div>
                        <span class="flex-initial">
                            <?= $info_why["ten"] . " " ?>
                        </span>
                        <div class="flex-[0_0_auto] w-4 h-0 border-t border-[var(--html-sc-website)]"></div>
                    </div>
                    <div class="<?= $class_title_main ?> title_gsap_2 mt-2  w-full">
                        <span>
                            <?= $info_why["slogan"] ?>
                        </span>
                    </div>
                    <div class="mt-2 <?= $class_content_main ?> gsap_text_2">
                        <span class="line-clamp-6 ">
                            <?= htmlspecialchars_decode($info_why["mota"]) ?>
                        </span>
                    </div>
                </div>
                <?php if ($deviceType != "phone") { ?>
                    <div class="w-full flex justify-center mt-7">
                        <div class="w-full lg:w-[70%] grid grid-cols-1 gap-[30px] relative">
                            <?php foreach ($list_why as $key => $value) { ?>
                                <div class="group/why  w-full relative [&.right]:flex-row-reverse flex items-center z-10 <?= ($key % 2 == 0) ? "left form_left_" . $key + 1 : "right form_right_" . $key + 1 ?>">
                                    <div class="w-[calc(50%+35px)] rounded-full group-[&.right]/why:flex-row-reverse flex  items-center " style="background: var(--color-linear-sc);">
                                        <div class="flex-1 group-[&.left]/why:text-end  text-white font-normal text-base font-main-400 px-2 ">
                                            <span class="line-clamp-2">
                                                <?= $value["ten"] ?>
                                            </span>
                                        </div>
                                        <div class="w-[70px] aspect-[1/1] flex justify-center items-center">
                                            <div class="w-[56%] h-[56%] overflow-hidden aspect-[1/1] rounded-full bg-white border-[3px] border-[#d9d9d99d] shadow-[0px_0px_0px_3px_#ffffff7e]">
                                                <div class="w-full p-2">
                                                    <?= $func->addHrefImg([
                                                        'classfix' => '',
                                                        'addhref' => false,
                                                        'sizes' => "100x100x2",
                                                        'actual_width' => 200,
                                                        'upload' => _upload_hinhanh_l,
                                                        'image' => $value["photo"],
                                                        'alt' =>  $value["ten"],
                                                    ]); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="absolute z-[-1] top-1/2 group-[&.left]/why:left-1/2 group-[&.right]/why:right-1/2 w-1/2  group-[&.right]/why:flex-row-reverse h-auto -translate-y-1/2 flex items-center">
                                        <div class="w-[80px] h-[40px]  group-[&.right]/why:rotate-180 " style="clip-path: polygon(0 0 ,80% 0%,100% 50%,80% 100%,0 100% );background: var(--color-linear-sc);">
                                            <div class="w-full h-full relative">
                                                <div class="absolute right-[20%] w-[16px] rounded-full bg-white h-[16px] top-1/2 -translate-y-1/2 "></div>
                                                <div class="absolute right-[20%] w-[80%]  bg-white h-[3px] top-1/2 -translate-y-1/2 "></div>
                                            </div>
                                        </div>
                                        <div class="flex-1 text-[70px] font-bold font-main-700 stroke-1 px-3 text-center " style="-webkit-text-stroke-width: 1px;-webkit-text-stroke-color: var(--html-bg-website); color: transparent;">
                                            <span style="font-family: sans-serif;">
                                                <?= sprintf("%02d", $key + 1) ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="absolute top-0 left-1/2 -translate-x-1/2 h-full w-[2px]" style="background: var(--color-linear-sc);"></div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="w-full flex justify-center mt-7">
                        <div class="w-full grid grid-cols-1 gap-[30px] relative">
                            <?php foreach ($list_why as $key => $value) { ?>
                                <div class="group/why  w-full relative [&.right]:flex-row-reverse <?= " form_right_" . $key + 1 ?> flex items-center z-10 right">
                                    <div class="w-[calc(60%+35px)] rounded-full group-[&.right]/why:flex-row-reverse flex  items-center " style="background: var(--color-linear-sc);">
                                        <div class="flex-1 group-[&.left]/why:text-end  text-white font-normal text-xs font-main-400 px-2 ">
                                            <span class="line-clamp-2">
                                                <?= $value["ten"] ?>
                                            </span>
                                        </div>
                                        <div class="w-[70px] aspect-[1/1] flex justify-center items-center">
                                            <div class="w-[56%] h-[56%] overflow-hidden aspect-[1/1] rounded-full bg-white border-[3px] border-[#d9d9d99d] shadow-[0px_0px_0px_3px_#ffffff7e]">
                                                <div class="w-full  p-2">
                                                    <?= $func->addHrefImg([
                                                        'classfix' => '',
                                                        'addhref' => false,
                                                        'sizes' => "100x100x2",
                                                        'actual_width' => 200,
                                                        'upload' => _upload_hinhanh_l,
                                                        'image' => $value["photo"],
                                                        'alt' =>  $value["ten"],
                                                    ]); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="absolute z-[-1] top-1/2 group-[&.left]/why:left-1/2 group-[&.right]/why:right-[60%] w-[40%]  group-[&.right]/why:flex-row-reverse h-auto -translate-y-1/2 flex items-center">
                                        <div class="w-[80px] h-[40px]  group-[&.right]/why:rotate-180 " style="clip-path: polygon(0 0 ,80% 0%,100% 50%,80% 100%,0 100% );background: var(--color-linear-sc);">
                                            <div class="w-full h-full relative">
                                                <div class="absolute right-[20%] w-[16px] rounded-full bg-white h-[16px] top-1/2 -translate-y-1/2 "></div>
                                                <div class="absolute right-[20%] w-[80%]  bg-white h-[3px] top-1/2 -translate-y-1/2 "></div>
                                            </div>
                                        </div>
                                        <div class="flex-1 text-[40px] font-bold font-main-700  " style="-webkit-text-stroke-width: 1px;-webkit-text-stroke-color: var(--html-bg-website); color: transparent;">
                                            <span style="font-family: sans-serif;">
                                                <?= sprintf("%02d", $key + 1) ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="absolute top-0 left-[40%] -translate-x-1/2 h-full w-[2px] " style="background: var(--color-linear-sc);"></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>

<!-- lợi ích  -->
<?php if (!empty($list_benerfit)) { ?>
    <section class="section-benerfit pb-8 sm:pb-12 ">
        <div class="grid_s wide ">
            <div class="form_opacity_3 rounded-lg sm:rounded-[32px] px-[clamp(10px,3vw,32px)] py-[40px] " <?php if (!empty($info_benerfit['photo2'])) { ?> style="background: url(<?= _upload_hinhanh_l . $info_benerfit['photo2'] ?>) no-repeat center/cover ;" <?php } ?>>
                <div class="w-full text-center flex flex-wrap items-center justify-center gap-0 sm:gap-[70px]">
                    <div class="w-full lg:w-auto">
                        <div class="w-full flex justify-center items-center title_gsap_3 <?= $class_title_sup_main ?> gap-2 ">
                            <div class="flex-[0_0_auto] w-4 h-0 border-t border-white"></div>
                            <span class="flex-initial text-white">
                                <?= $info_benerfit["ten"] . " " ?>
                            </span>
                            <div class="flex-[0_0_auto] w-4 h-0 border-t border-white "></div>
                        </div>
                        <div class="<?= $class_title_main ?> title_gsap_3 mt-2  w-full">
                            <span class=" text-white">
                                <?= $info_benerfit["slogan"] ?>
                            </span>
                        </div>
                        <div class="mt-2 <?= $class_content_main ?> gsap_text_3">
                            <span class="line-clamp-6 text-white">
                                <?= htmlspecialchars_decode($info_benerfit["mota"]) ?>
                            </span>
                        </div>
                    </div>
                    <?php if ($deviceType == "computer") { ?>
                        <div class="form_circle relative load_website opacity_animaiton rounded-full overflow-hidden h-[620px] text-center w-[620px] text-white" data-items="<?= count($list_benerfit) ?>">
                            <?php foreach ($list_benerfit as $key => $value) { ?>
                                <div class="items_circle relative z-10 ">
                                    <div class="relative">
                                        <div class="  px-7 pt-[60px] absolute bottom-0 left-1/2  text-[var(--html-sc-website)] -translate-x-1/2 h-[200px] w-[250px]  font-normal font-main-400 text-sm bg-white z-[-1] " style="clip-path: polygon(0 0,100% 0,50% 100%);color: var(--html-sc-website);">
                                            <div class="swivel_part w-[80px]">
                                                <span class=" line-clamp-3">
                                                    <?= $value['ten'] ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="   rounded-full border-[13px] border-white  h-[63px] w-[63px]  flex justify-center items-center  p-2 bg-[var(--html-sc-website)] ">
                                            <span class="swivel_part w-full h-full ">
                                                <?= $func->addHrefImg([
                                                    'classfix' => '',
                                                    'addhref' => false,
                                                    'sizes' => "100x100x2",
                                                    'actual_width' => 200,
                                                    'upload' => _upload_hinhanh_l,
                                                    'image' => $value["photo"],
                                                    'alt' =>  $value["ten"],
                                                ]); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[339px] h-[339px] rounded-full shadow-[0px_0px_0px_22px_#FFFFFF4D] overflow-hidden border-[24px] border-[var(--html-bg-website)]" <?php if (!empty($info_benerfit['photo'])) { ?> style="background: url(<?= _upload_hinhanh_l . $info_benerfit['photo'] ?>) no-repeat center/cover ;" <?php } ?>></div>
                            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[90%] h-[90%] border border-white border-dashed rounded-full "></div>
                        </div>
                    <?php } else { ?>
                        <div class="w-full mt-7 ">
                            <div class="owl-carousel form_benerfit_mb owl-theme">
                                <?php
                                $list_tmp = array();
                                foreach ($list_benerfit as $k => $v) {
                                    if (((($k + 1) % 2 === 0) && ($k != 0)) || (count($list_benerfit) == ($k + 1))) {
                                        array_push($list_tmp, $v);
                                ?>
                                        <div class="w-full grid grid-cols-1 gap-4">
                                            <?php foreach ($list_tmp as $key => $value) { ?>
                                                <div class="relative w-full rounded-xl bg-white pt-4 px-3 pb-[35px] mb-[35px] text-center">
                                                    <div class="h-[calc(14px*3*1.5)]">
                                                        <span class=" font-normal font-main-400 text-sm line-clamp-3 text-[var(--html-sc-website)]">
                                                            <?= $value['ten'] ?>
                                                        </span>
                                                    </div>
                                                    <div class="absolute top-full left-1/2 shadow-[0px_0px_0px_1px_var(--html-bg-website)] -translate-x-1/2 -translate-y-1/2 w-[63px] h-[63px] border-white  border-[13px] flex justify-center items-center rounded-full overflow-hidden p-2 bg-[var(--html-sc-website)]">
                                                        <?= $func->addHrefImg([
                                                            'classfix' => '',
                                                            'addhref' => false,
                                                            'sizes' => "100x100x2",
                                                            'actual_width' => 200,
                                                            'upload' => _upload_hinhanh_l,
                                                            'image' => $value["photo"],
                                                            'alt' =>  $value["ten"],
                                                        ]); ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                <?php
                                        $list_tmp = array();
                                    } else {
                                        array_push($list_tmp, $v);
                                    }
                                } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>

<!-- sản phẩm -->
<?php if (!empty($list_c1_procuct)) { ?>
    <section class="section-product pb-8 sm:pb-12 ">
        <div class="grid_s wide ">
            <div class="bg_form_all form_opacity_4">
                <div class="w-full text-center flex flex-wrap justify-center">
                    <div class="title_gsap_4 w-full flex items-center justify-center <?= $class_title_sup_main ?> gap-2 ">
                        <div class="flex-[0_0_auto] w-4 h-0 border-t border-[var(--html-sc-website)]"></div>
                        <span class="flex-initial">
                            <?= $info_product["ten"] . " " ?>
                        </span>
                        <div class="flex-[0_0_auto] w-4 h-0 border-t border-[var(--html-sc-website)]"></div>
                    </div>
                    <div class="<?= $class_title_main ?> title_gsap_4 mt-2  w-full">
                        <span>
                            <?= $info_product["slogan"] ?>
                        </span>
                    </div>
                    <div class="mt-2 <?= $class_content_main ?>">
                        <span class="line-clamp-6">
                            <?= htmlspecialchars_decode($info_product["mota"]) ?>
                        </span>
                    </div>
                </div>
                <div class="w-full grid grid-cols-1 gap-5 mt-7">
                    <?php foreach ($list_c1_procuct  as $key_c1 => $value_c1) {
                        $list_procuct = $cache->getCache("select id,type, ten_$lang as ten from #_baiviet where type =? and id_list =? and hienthi=1 order by stt asc", array($value_c1['type'], $value_c1['id']), 'result', _TIMECACHE);
                        if ($deviceType != "phone") {
                            if ((count($list_procuct) % 5) != 0) {
                                for ($i = 1; $i < 5; $i++) {
                                    $list_procuct[] = "";
                                    if ((count($list_procuct) % 5) == 0) {
                                        break;
                                    }
                                }
                            }
                        } else {
                            if ((count($list_procuct) % 2) != 0) {
                                for ($i = 1; $i < 2; $i++) {
                                    $list_procuct[] = "";
                                    if ((count($list_procuct) % 2) == 0) {
                                        break;
                                    }
                                }
                            }
                        }
                        if (!empty($list_procuct)) {
                    ?>
                            <div class="<?= "form_product_" . $key_c1 + 1 ?> w-full rounded-lg sm:rounded-2xl overflow-hidden bg-white" id="sanpham_dmc1_<?= $value_c1['id'] ?>">
                                <div class="w-full flex items-center justify-center h-[50px] text-white text-base font-semibold font-main-600 uppercase  bg-[var(--html-bg-website)] gap-3 py-2 px-3">
                                    <div class="h-[34px] max-w-[34px]">
                                        <?= $func->addHrefImg([
                                            'classfix' => '',
                                            'addhref' => false,
                                            'sizes' => "200x200x2",
                                            'actual_width' => 300,
                                            'upload' => _upload_baiviet_l,
                                            'image' => $value_c1["photo"],
                                            'alt' =>  $value_c1["ten"],
                                        ]); ?>
                                    </div>
                                    <span>
                                        <?= $value_c1["ten"] ?>
                                    </span>
                                </div>
                                <div class="w-full scroll-design-one overflow-y-auto overflow-x-hidden max-h-[520px] my-[2px] ">
                                    <div class="w-full grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-[2px]">
                                        <?php foreach ($list_procuct  as $key => $value) { ?>
                                            <div class="w-full min-h-[50px] flex items-center  bg-[rgba(213,_243,_171,_0.76)] px-4 py-2 cursor-pointer views_introduce_info" data-value="<?= $value['id'] ?? null ?>" data-form="view_baiviet">
                                                <span class="text-[#040404] text-sm font-normal font-main-400">
                                                    <?= (!empty($value['ten'])) ? $value['ten'] : "" ?>
                                                </span>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="h-[22px] bg-[rgba(213,_243,_171,_0.76)]"></div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>

<!-- hình ảnh -->
<?php if (!empty($list_images)) { ?>
    <section class="section-images pb-8 sm:pb-12 ">
        <div class="grid_s wide ">
            <div class="w-full text-center flex flex-wrap justify-center form_opacity_5">
                <div class="form_opacity_5 w-full flex items-center justify-center <?= $class_title_sup_main ?> gap-2 ">
                    <div class="flex-[0_0_auto] w-4 h-0 border-t border-[var(--html-sc-website)]"></div>
                    <span class="flex-initial">
                        <?= $info_images["ten"]  ?>
                    </span>
                    <div class=" flex-[0_0_auto] w-4 h-0 border-t border-[var(--html-sc-website)]"></div>
                </div>
                <div class="form_opacity_5 <?= $class_title_main ?> mt-2  w-full">
                    <span>
                        <?= $info_images["slogan"] ?>
                    </span>
                </div>
                <div class="mt-2 <?= $class_content_main ?>">
                    <span class="line-clamp-6">
                        <?= htmlspecialchars_decode($info_images["mota"]) ?>
                    </span>
                </div>
            </div>
            <div class="form_opacity_6 w-full grid grid-cols-2 md:grid-cols-3  lg:grid-cols-4 gap-5 mt-7">
                <?= $this->getTemplateLayoutsFor([
                    'name_layouts' => 'gridTemplateImages1',
                    'data' => $list_images,
                ]) ?>
            </div>
        </div>
    </section>
<?php } ?>

<!-- Đăng ký -->
<section class="section-client pb-8 sm:pb-12 ">
    <div class="grid_s wide ">
        <div class="w-full flex flex-wrap items-start gap-0 lg:gap-4 form_opacity_7">
            <div class="w-full lg:w-[40%] leading-[0] form_left_client">
                <?= $func->addHrefImg([
                    'classfix' => '',
                    'addhref' => false,
                    'sizes' => "473x532x1",
                    'actual_width' => 1000,
                    'upload' => _upload_hinhanh_l,
                    'image' => $info_about["photo"],
                    'alt' =>  $info_about["ten"],
                ]); ?>
            </div>
            <div class="flex-1 rounded-lg sm:rounded-2xl bg-white p-3 sm:p-5 mb-3 form_right_client">
                <div class="<?= $class_title_main ?> w-full">
                    <span>
                        <?= $info_about["ten"] ?>
                    </span>
                </div>
                <?php if (!empty($list_about)) { ?>
                    <div class="mt-7 w-full grid grid-cols-1 gap-5 text-sm font-normal font-main-400">
                        <?php foreach ($list_about as $key => $value) { ?>
                            <div class="w-full flex items-center gap-2">
                                <div class="w-[50px] h-[50px] flex items-center justify-center bg-[var(--html-bg-website)] p-2 rounded-full overflow-hidden">
                                    <?= $func->addHrefImg([
                                        'classfix' => '',
                                        'addhref' => false,
                                        'sizes' => "100x100x2",
                                        'actual_width' => 200,
                                        'upload' => _upload_hinhanh_l,
                                        'image' => $value["photo"],
                                        'alt' =>  $value["ten"],
                                    ]); ?>
                                </div>
                                <div class="flex-1">
                                    <strong><?= $value["ten"] . ":" ?></strong>
                                    <span><?= $value["mota"] ?></span>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
                <div class="<?= $class_content_main ?> mt-7 w-full rounded-2xl bg-[#F9F7F7] p-4">
                    <span>
                        <?= htmlspecialchars_decode($info_about["mota"]) ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="w-full form_opacity_8 rounded-lg sm:rounded-2xl bg-white px-3 sm:px-[47px] pt-[30px] pb-[35px]">
            <div class="w-full flex flex-wrap items-center gap-5 sm:gap-7  md:gap-10 lg:gap-[80px] ">
                <div class="flex-1 form_left_dk">
                    <div class="w-full text-center ">
                        <div class="w-full  flex justify-center items-center <?= $class_title_sup_main ?> gap-2 ">
                            <div class="flex-[0_0_auto] w-4 h-0 border-t border-[var(--html-bg-website)]"></div>
                            <span class="flex-initial ">
                                <?= $info_client["ten"] ?>
                            </span>
                            <div class="flex-[0_0_auto] w-4 h-0 border-t border-[var(--html-bg-website)]"></div>
                        </div>
                        <div class="<?= $class_title_main ?> mt-2  w-full">
                            <span class=" ">
                                <?= $info_client["slogan"] ?>
                            </span>
                        </div>
                        <div class="mt-2 <?= $class_content_main ?>">
                            <span class="line-clamp-6 text-white">
                                <?= htmlspecialchars_decode($info_client["mota"]) ?>
                            </span>
                        </div>
                    </div>
                    <div class="mt-5">
                        <form action="" method="POST" name="form_client" id="client" class="form_client w-full flex flex-wrap items-start gap-3 " enctype="multipart/form-data">
                            <div class="w-full grid grid-cols-1 gap-[15px]">
                                <?= $this->getTemplateLayoutsFor([
                                    'name_layouts' => 'input_web',
                                    'class_form' => 'w-full',
                                    'label' => "Họ Và Tên",
                                    'placeholder' => "Nhập Họ Và Tên",
                                    'id' => 'fullname',
                                    'data' => 'data[fullname]',
                                    'value' => '',
                                    'type' => 'text',
                                    'save_cache' => false,
                                    'required' => true,
                                    'readonly' => false,
                                    'function' => '',
                                    'form' => false,
                                ]); ?>
                                <?= $this->getTemplateLayoutsFor([
                                    'name_layouts' => 'input_web',
                                    'class_form' => 'w-full',
                                    'label' => "Địa chỉ",
                                    'placeholder' => "Nhập Địa chỉ",
                                    'id' => 'address',
                                    'data' => 'data[address]',
                                    'value' => '',
                                    'type' => 'text',
                                    'save_cache' => false,
                                    'required' => true,
                                    'readonly' => false,
                                    'function' => '',
                                    'form' => false,
                                ]); ?>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-[15px]">
                                    <?= $this->getTemplateLayoutsFor([
                                        'name_layouts' => 'input_web',
                                        'class_form' => 'w-full',
                                        'label' => "Số Điện Thoại",
                                        'placeholder' => "Số Điện Thoại",
                                        'id' => 'phone',
                                        'data' => 'data[phone]',
                                        'value' => '',
                                        'type' => 'number',
                                        'save_cache' => false,
                                        'required' => true,
                                        'readonly' => false,
                                        'function' => '',
                                        'form' => false,
                                    ]); ?>
                                    <?= $this->getTemplateLayoutsFor([
                                        'name_layouts' => 'input_web',
                                        'class_form' => 'w-full',
                                        'label' => "Email",
                                        'placeholder' => "Email",
                                        'id' => 'email',
                                        'data' => 'data[email]',
                                        'value' => '',
                                        'type' => 'text',
                                        'save_cache' => false,
                                        'required' => true,
                                        'readonly' => false,
                                        'function' => '',
                                        'form' => false,
                                    ]); ?>
                                </div>
                                <?= $this->getTemplateLayoutsFor([
                                    'name_layouts' => 'textarea_web',
                                    'class_form' => 'w-full',
                                    'class' => "",
                                    'label' => "Nội Dung",
                                    'placeholder' => "Nhập Nội Dung",
                                    'id' => "notes",
                                    'data' => "data[notes]",
                                    'rows' => 4,
                                    'value' => '',
                                    'save_cache' => false,
                                    'required' => false,
                                    'readonly' => false,
                                    'function' => '',
                                    'form' => false,
                                ]); ?>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-[15px]">
                                    <?= $this->getTemplateLayoutsFor([
                                        'name_layouts' => 'input_web',
                                        'class_form' => 'w-full',
                                        'placeholder' => 'Nhập Mã Xác Nhận',
                                        'id' => 'captcha',
                                        'data' => 'data[captcha]',
                                        'value' => '',
                                        'type' => 'text',
                                        'save_cache' => false,
                                        'required' => true,
                                        'readonly' => false,
                                        'function' => '',
                                        'form' => false,
                                    ]); ?>
                                    <div class="">
                                        <div class="form_captcha_js flex justify-center items-center w-full h-[50px] rounded-md border border-[var(--html-bg-website)] bg-white pl-2 pr-3">
                                            <div class="flex-initial code_captcha rounded "></div>
                                            <div class="flex-1"></div>
                                            <div class="h-[28px] inline-flex justify-center items-center rounded-[50%] overflow-hidden cursor-pointer aspect-[1/1] btn_captcha_js [&.on]:animate-load-captcha" data-name="captcha_price_quote" data-size="80x18">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                    <path d="M11.4047 13.8994L7.71469 11.4385C7.67215 11.4109 7.62299 11.3951 7.57232 11.3929C7.52165 11.3907 7.47131 11.4021 7.42653 11.426C7.38176 11.4498 7.34417 11.4852 7.31769 11.5284C7.29121 11.5717 7.27679 11.6212 7.27594 11.6719V12.6141C5.98273 12.5501 4.74679 12.0611 3.75978 11.2231C2.77276 10.3851 2.08983 9.24483 1.81687 7.97914C2.05077 6.88134 2.5967 5.87444 3.38906 5.07945C3.41542 5.05329 3.43634 5.02218 3.45062 4.98791C3.4649 4.95363 3.47226 4.91687 3.47226 4.87973C3.47227 4.8426 3.46493 4.80584 3.45066 4.77155C3.4364 4.73727 3.41548 4.70615 3.38914 4.67999C3.36279 4.65383 3.33152 4.63314 3.29714 4.61911C3.26276 4.60509 3.22594 4.598 3.18881 4.59827C3.15168 4.59854 3.11497 4.60616 3.08079 4.62068C3.04662 4.6352 3.01565 4.65634 2.98969 4.68289C2.11245 5.56758 1.51104 6.68799 1.25851 7.90801C1.00598 9.12803 1.11322 10.3951 1.56718 11.5554C2.02114 12.7156 2.8023 13.719 3.81573 14.4437C4.82916 15.1684 6.03125 15.5831 7.27594 15.6376V16.5938C7.27677 16.6445 7.29118 16.6941 7.31766 16.7374C7.34413 16.7807 7.38172 16.816 7.4265 16.8399C7.47129 16.8637 7.52164 16.8751 7.57231 16.8729C7.62299 16.8707 7.67216 16.8549 7.71469 16.8273L11.4047 14.3663C11.4435 14.341 11.4755 14.3064 11.4976 14.2657C11.5197 14.2249 11.5313 14.1793 11.5313 14.1329C11.5313 14.0865 11.5197 14.0409 11.4976 14.0001C11.4755 13.9593 11.4435 13.9247 11.4047 13.8994Z" fill="#717070" />
                                                    <path d="M10.7241 2.36326V1.40701C10.7233 1.35625 10.709 1.30662 10.6825 1.26329C10.6561 1.21996 10.6185 1.18453 10.5737 1.16069C10.5289 1.13684 10.4785 1.12546 10.4277 1.12772C10.377 1.12999 10.3278 1.14582 10.2853 1.17357L6.59536 3.63451C6.55695 3.66015 6.52547 3.69487 6.50369 3.73559C6.48192 3.7763 6.47052 3.82177 6.47052 3.86794C6.47052 3.91412 6.48191 3.95958 6.50368 4.0003C6.52545 4.04102 6.55694 4.07574 6.59534 4.10138L10.2853 6.56231C10.3279 6.58994 10.377 6.60567 10.4277 6.60789C10.4784 6.6101 10.5287 6.5987 10.5735 6.57488C10.6183 6.55106 10.6558 6.51568 10.6823 6.47243C10.7088 6.42917 10.7232 6.37961 10.7241 6.3289V5.38671C12.0173 5.45076 13.2532 5.93971 14.2402 6.77773C15.2273 7.61575 15.9102 8.75602 16.1832 10.0217C15.9493 11.1195 15.4033 12.1264 14.611 12.9214C14.5596 12.9746 14.5312 13.0459 14.5319 13.1198C14.5327 13.1938 14.5626 13.2645 14.6151 13.3166C14.6676 13.3688 14.7385 13.3981 14.8124 13.3984C14.8864 13.3986 14.9575 13.3697 15.0103 13.3179C15.8876 12.4333 16.489 11.3128 16.7415 10.0928C16.994 8.8728 16.8868 7.6057 16.4328 6.44547C15.9789 5.28524 15.1977 4.28183 14.1843 3.55715C13.1709 2.83246 11.9688 2.4177 10.7241 2.36326Z" fill="#717070" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full flex items-center justify-center mt-5">
                                    <button type="submit" name="submit-resgister-client" class="w-full max-w-[320px] uppercase h-[50px] bg-[var(--html-bg-website)] hover:bg-[var(--html-sc-website)] transition-all duration-300 text-base font-semibold text-white text-center px-7 rounded-lg flex justify-center items-center gap-3">
                                        <span>đăng ký ngay</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="13" viewBox="0 0 15 13" fill="none">
                                            <g clip-path="url(#clip0_1_493)">
                                                <path d="M13.2439 6.5V11.7H2.04392V1.3H7.64392V0H0.643921V13H14.6439V6.5H13.2439Z" fill="white" />
                                                <path d="M9.04958 0L11.0656 1.872L7.09705 5.55707L8.66505 7.01307L12.6336 3.328L14.6496 5.2V0H9.04958Z" fill="white" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_1_493">
                                                    <rect width="14" height="13" fill="white" transform="translate(0.651733)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="form_right_dk flex-initial w-full md:w-[35%] lg:w-[47%]">
                    <div class="text-end flex justify-center items-center gap-1">
                        <span class="flex-initial text-lg sm:text-xl font-semibold font-main-600 text-[#414141]"><?= $info_client_sub['ten'] ?></span>
                        <span class="flex-initial text-3xl sm:text-[64px] font-bold font-main-700 text-[var(--html-bg-website)]"><?= $info_client_sub['slogan'] ?></span>
                    </div>
                    <div class="mt-4 text-center">
                        <span class=" text-xs sm:text-sm font-normal font-main-400 text-[#717070]"><?= htmlspecialchars_decode($info_client_sub['mota']) ?></span>
                    </div>
                    <div class="mt-7">
                        <?= $func->addHrefImg([
                            'classfix' => '',
                            'addhref' => false,
                            'sizes' => "511x81x2",
                            'actual_width' => 600,
                            'upload' => _upload_hinhanh_l,
                            'image' => $info_client_sub["photo"],
                            'alt' =>  $info_client_sub["ten"],
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>