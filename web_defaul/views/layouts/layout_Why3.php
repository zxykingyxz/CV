<?php
// lợi ích
$info_benerfit = $cache->getCache("select  ten_$lang as ten,mota_$lang as mota,slogan_$lang as slogan,photo,photo2 from #_bannerqc where type=? and hienthi=1", array('info_benerfit'), 'fetch', _TIMECACHE);

$list_benerfit = $cache->getCache("select  ten_$lang as ten,photo from #_photo where type=? and hienthi=1 limit 0,10", array('list_benerfit'), 'result', _TIMECACHE);

?>
<script>
    $('.form_circle').animationCircle({
        numberOfItems: $('.form_circle').data('items'), // Tổng số items (phần tử)
        items: "items_circle",
        deviation: 100, // Khoảng cách vào trong (px)
        directionStart: 'top', // Hướng bắt đầu
        locationStart: 0, // Vị trí xuất phát
        directionClick: 'right', // Hướng khi click
        locationClick: 1, // Vị trí khi click
        animationAction: 0, // Hiệu ứng chuyển động (ms)
        rotationSpeed: 1,
    });
</script>
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