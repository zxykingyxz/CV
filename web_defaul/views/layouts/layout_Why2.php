<?php
// lý do
$info_why = $cache->getCache("select  ten_$lang as ten,mota_$lang as mota,slogan_$lang as slogan from #_bannerqc where type=? and hienthi=1", array('info_why'), 'fetch', _TIMECACHE);

$list_why = $cache->getCache("select  ten_$lang as ten,photo from #_photo where type=? and hienthi=1", array('list_why'), 'result', _TIMECACHE);

?>
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