<?php
// quá trình phát triển
$info_development_process = $cache->getCache("select  ten_$lang as ten ,slogan_$lang as slogan , mota_$lang as mota from #_bannerqc where type=? and hienthi=1", array('info-development-process'), 'fetch', _TIMECACHE);

$ach_development_process = $cache->getCache("select mota_$lang as mota , ten_$lang as ten from #_photo where type=? and hienthi=1 order by stt asc ", array('development-process'), 'result', _TIMECACHE);
?>
<script>
    var totalitems_development_process = $("body .form_development_process").children('.items_development_process').length;
    var currentIndex_development_process = 1;

    setInterval(function() {
        currentIndex_development_process = updateItemsNext("form_development_process", "items_development_process", currentIndex_development_process, totalitems_development_process);
    }, 1500);

    function updateItemsNext(class_form, class_items, number_items, total_items) {
        $("body ." + class_form).children('.' + class_items).removeClass('active');
        $("body ." + class_form).children('.' + class_items + ':nth-child(' + number_items + ')').addClass('active');
        if ((number_items === total_items) || number_items < 0) {
            number_items = 1;
        } else {
            number_items++;
        }
        return number_items;
    }
</script>
<!-- quá trình phát triển -->
<?php if (!empty($ach_development_process)) { ?>
    <div class="w-full mb-7 sm:mb-[72px]">
        <div class="wow fadeInDown" data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="0.2s">
            <?php if (!empty($info_development_process['slogan'])) { ?>
                <div class="text-center mb-2">
                    <a href="<?= $jv0 ?>" title="" class=" <?= $class_title_sup_main ?>">
                        <?= $info_development_process['slogan'] ?>
                    </a>
                </div>
            <?php } ?>
            <div class="text-center mb-5">
                <a href="<?= $jv0 ?>" title="" class=" <?= $class_title_main ?>">
                    <?= $info_development_process['ten'] ?>
                </a>
            </div>
            <div class="mb-7 text-center flex justify-center ">
                <div class="w-10/12">
                    <span class="<?= $class_content_main ?>">
                        <?= htmlspecialchars_decode($info_development_process['mota']) ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="relative wow zoomIn" data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="0.2s">
            <div class="w-full  overflow-x-auto overflow-y-hidden scroll-x">
                <div class="inline-block min-w-full pb-[65px] ">
                    <div class="relative w-full ">
                        <div class="absolute top-[59px] sm:top-[66px] left-0 w-full border-b-2 border-[#b4b4b484] pointer-events-none"></div>
                    </div>
                    <div class=" inline-flex min-w-full justify-evenly items-start form_development_process gap-3">
                        <?php foreach ($ach_development_process as $key_dp => $value_dp) { ?>
                            <div class="items_development_process  group/development_process cursor-pointer text-center text-black  font-semibold font-main-600 leading-[0]">
                                <div class="mb-3 text-lg sm:text-xl">
                                    <span>
                                        <?= $value_dp['ten'] ?>
                                    </span>
                                </div>
                                <div class="h-10 sm:h-[52px] aspect-[1/1] inline-flex justify-center items-center leading-[0] relative z-10 ">
                                    <div class="h-[63%] aspect-[1/1] bg-[#727272] rounded-full group-hover/development_process:h-full group-hover/development_process:bg-[var(--html-bg-website)] group-[&.active]/development_process:h-full group-[&.active]/development_process:bg-[var(--html-bg-website)] transition-all duration-300 leading-[0]"></div>
                                </div>
                                <div class="absolute bg-white pointer-events-none bottom-2 left-1/2 -translate-x-1/2  w-full opacity-0 group-hover/development_process:opacity-100 group-[&.active]/development_process:opacity-100 transition-all duration-300">
                                    <span class="text-lg sm:text-xl">
                                        <?= htmlspecialchars_decode($value_dp['mota']) ?>
                                    </span>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>