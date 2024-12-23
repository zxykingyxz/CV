<?php
// quy trình
$info_process = $cache->getCache("select  ten_$lang as ten , mota_$lang as mota from #_bannerqc where type=? and hienthi=1", array('info-process'), 'fetch', _TIMECACHE);

$list_process = $cache->getCache("select ten_$lang as ten ,mota_$lang as mota from #_photo where type=? and hienthi=1 order by stt asc limit 0,6", array('process'), 'result', _TIMECACHE);

?>
<!-- Quy trình vận chuyển quốc tế -->
<?php if (!empty($list_process)) { ?>
    <section class="section-process pt-5 pb-8 sm:pt-11 sm:pb-16 bg-[var(--html-sc-website)]">
        <div class="grid_s wide">
            <div class="wow fadeInDown" data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="0.2s">
                <div class="text-center mb-5">
                    <a href="<?= $jv0 ?>" title="" class=" <?= $class_title_main ?>">
                        <?= $info_process['ten'] ?>
                    </a>
                </div>
                <div class="mb-7 text-center flex justify-center ">
                    <div class="w-10/12">
                        <span class="<?= $class_content_main ?>">
                            <?= htmlspecialchars_decode($info_process['mota']) ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="relative z-10 flex flex-wrap gap-y-3 justify-center items-start">
                <?php foreach ($list_process as $key_process => $value_process) { ?>
                    <div class=" basis-1/2 sm:basis-1/3 lg:basis-1/5 flex justify-center">
                        <div class="w-[92.5%] ">
                            <div class="flex justify-center items-center mb-3">
                                <div class="h-[45px] rounded max-w-full min-w-[73%] line-clamp-1 inline-flex justify-center items-center uppercase text-sm sm:text-base text-white  font-semibold font-main-600 bg-[#F0AF2D] text-center transition-all duration-300">
                                    <span>
                                        <?= $value_process['ten'] ?>
                                    </span>
                                </div>
                            </div>
                            <div class="flex justify-center items-center mb-4">
                                <div class="relative z-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29" fill="none">
                                        <circle cx="14.7086" cy="14.0615" r="10.5" fill="white" stroke="#F0AF2D" />
                                        <circle cx="14.7086" cy="14.0615" r="13.5" stroke="#F0AF2D" stroke-dasharray="2 2" />
                                        <circle cx="14.7086" cy="14.0615" r="8.5" fill="#F0AF2D" stroke="#F0AF2D" />
                                    </svg>
                                </div>
                                <div class="absolute h-[10px] w-full left-0 bg-[var(--html-bg-website)] z-[-1] rounded-lg overflow-hidden"></div>
                            </div>
                            <div class="flex flex-col items-center justify-center ">
                                <div class="bg-white w-[16px] h-[13px]" style="clip-path: polygon(50% 0,100% 100%,0 100%);"></div>
                                <div class="bg-white w-full rounded p-3 text-center text-xs sm:text-sm font-medium font-main-500 leading-[1.76] sm:leading-[1.76] text-[#323232] line-clamp-3  ">
                                    <span>
                                        <?= $value_process['mota'] ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>