<?php
// quy trình
$info_process = $cache->getCache("select  ten_$lang as ten , mota_$lang as mota from #_bannerqc where type=? and hienthi=1", array('info_process'), 'fetch', _TIMECACHE);

$list_process = $cache->getCache("select ten_$lang as ten ,photo from #_photo where type=? and hienthi=1 order by stt asc", array('process'), 'result', _TIMECACHE);

?>
<!-- quy trình -->
<?php if (!empty($list_process)) { ?>
    <section class="section-process pt-5 pb-10 bg-[var(--html-bg-website)]">
        <div class="grid_s wide">
            <div class="w-full text-center flex flex-wrap justify-center">
                <?php if (!empty($info_process["ten"])) { ?>
                    <div class="<?= $class_title_main ?>   w-full">
                        <span class="text-white">
                            <?= $info_process["ten"] ?>
                        </span>
                    </div>
                <?php } ?>
                <?php if (!empty($info_process["mota"])) { ?>
                    <div class="mt-2 <?= $class_content_main ?>">
                        <span class="line-clamp-6 text-white">
                            <?= htmlspecialchars_decode($info_process["mota"]) ?>
                        </span>
                    </div>
                <?php } ?>
            </div>
            <?php if ($deviceType != "phone") { ?>
                <div class="relative z-10 flex flex-wrap gap-y-3 justify-center items-start mt-8">
                    <?php foreach ($list_process as $key_process => $value_process) { ?>
                        <div class="group/process <?= ($key_process % 2 == 0) ? "even" : "odd" ?> flex-1 min-w-[190px] flex justify-center">
                            <div class="w-full flex flex-wrap  group-[&.even]/process:flex-col group-[&.odd]/process:flex-col-reverse">
                                <div class="w-full flex justify-center group-[&.odd]/process:items-start items-end h-[110px] ">
                                    <div class="px-3 text-center flex items-center overflow-hidden text-sm text-white leading-[2] h-[calc(14px*2*2)] ">
                                        <span class="line-clamp-2">
                                            <?= $value_process['ten'] ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex justify-end items-center  ">
                                    <div class="relative z-10">
                                        <div class="h-2 w-2 rounded-full bg-[#D5D5D5]"></div>
                                    </div>
                                    <div class="absolute h-[1px] w-full left-0  z-[-1]  overflow-hidden" style="background: repeating-linear-gradient( to left,white 0px, white 3px, transparent 3px, transparent 7px);"></div>
                                </div>
                                <div class="w-full flex group-[&.even]/process:flex-col group-[&.odd]/process:flex-col-reverse items-center h-[110px] ">
                                    <div class="w-[1px] h-[35px]" style="background: repeating-linear-gradient( to bottom,white 0px, white 3px, transparent 3px, transparent 6px);"></div>
                                    <div class="flex justify-center">
                                        <div class="w-[50px] ring_web">
                                            <?= $func->addHrefImg([
                                                'addhref' => true,
                                                'href' => $jv0,
                                                'sizes' => '100x100x2',
                                                'actual_width' => 200,
                                                'upload' => _upload_hinhanh_l,
                                                'image' => $value_process["photo"],
                                                'alt' => $value_process["ten"],
                                            ]); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="relative grid grid-cols-1 gap-2 mt-8">
                    <?php foreach ($list_process as $key_process => $value_process) { ?>
                        <div class="flex items-center gap-2">
                            <div class="w-[60px] h-[60px] p-2 ring_web">
                                <?= $func->addHrefImg([
                                    'addhref' => true,
                                    'href' => $jv0,
                                    'sizes' => '100x100x2',
                                    'actual_width' => 200,
                                    'upload' => _upload_hinhanh_l,
                                    'image' => $value_process["photo"],
                                    'alt' => $value_process["ten"],
                                ]); ?>
                            </div>
                            <div class="h-[1px] w-[35px]" style="background: repeating-linear-gradient( to left,white 0px, white 3px, transparent 3px, transparent 7px);"></div>
                            <div class="flex-1 pl-3 flex items-center overflow-hidden text-sm text-white leading-[2] h-[calc(14px*2*2)] ">
                                <span class="line-clamp-2">
                                    <?= $value_process['ten'] ?>
                                </span>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="absolute top-1/2 -translate-y-1/2 left-[86px] w-[1px] h-[calc(100%-60px)]" style="background: repeating-linear-gradient( to bottom,white 0px, white 3px, transparent 3px, transparent 6px);"></div>
                </div>
            <?php } ?>
        </div>
    </section>
<?php } ?>