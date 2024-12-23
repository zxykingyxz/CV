<?php
// quy trình
$info_process = $cache->getCache("select  ten_$lang as ten,slogan_$lang as slogan , mota_$lang as mota from #_bannerqc where type=? and hienthi=1", array('info-process'), 'fetch', _TIMECACHE);

$ach_process = $cache->getCache("select  ten_$lang as ten,photo, mota_$lang as mota from #_photo where type=? and hienthi=1 order by stt asc ", array('process'), 'result', _TIMECACHE);
?>
<script>
    var totalitems_process = $("body .form_process").children('.items_process').length;
    var currentIndex_process = 1;

    setInterval(function() {
        currentIndex_process = updateItemsNext("form_process", "items_process", currentIndex_process, totalitems_process);
    }, 1500);

    $('body').on("click", ".button_process_next", function() {
        currentIndex_process = updateItemsNext("form_process", "items_process", currentIndex_process, totalitems_process);
    });
    $('body').on("click", ".button_process_prev", function() {
        currentIndex_process = currentIndex_process - 2;
        currentIndex_process = updateItemsNext("form_process", "items_process", currentIndex_process, totalitems_process);
    });

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
<!-- quy trình -->
<?php if (!empty($ach_process)) { ?>
    <div class="w-full mb-7 sm:mb-[72px]">
        <div class="wow fadeInDown" data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="0.2s">
            <?php if (!empty($info_process['slogan'])) { ?>
                <div class="text-center mb-2">
                    <a href="<?= $jv0 ?>" title="" class=" <?= $class_title_sup_main ?>">
                        <?= $info_process['slogan'] ?>
                    </a>
                </div>
            <?php } ?>
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
        <div class="wow zoomIn" data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="0.2s">
            <div class="relative z-10 mb-5">
                <div class="form_process w-full flex flex-wrap items-start justify-evenly gap-y-7 ">
                    <?php foreach ($ach_process as $key_process => $value_process) { ?>
                        <div class="items_process group/process basis-1/2 sm:basis-1/3 lg:basis-1/4 flex justify-center">
                            <div class=" w-[64%] flex flex-wrap flex-col justify-center items-center">
                                <div class="relative  h-[105px] aspect-[1/1] rounded-full bg-[var(--html-bg-website)] p-2 mb-1">
                                    <div class="h-full w-full  rounded-full bg-white flex justify-center items-center ">
                                        <div class="w-[52%] aspect-[1/1] brightness-0 group-hover/process:brightness-100 group-[&.active]/process:brightness-100 group-hover/process:scale-x-[-1] group-[&.active]/process:scale-x-[-1] transition-all duration-300">
                                            <?= $func->addHrefImg([
                                                'classfix' => 'w-full',
                                                'addhref' => true,
                                                'href' => $jv0,
                                                'sizes' => '45x45x2',
                                                'actual_width' => 800,
                                                'upload' => _upload_hinhanh_l,
                                                'image' => ($value_process["photo"]),
                                                'alt' => $value_process["ten"],
                                            ]); ?>
                                        </div>
                                        <div class="w-[42px] aspect-[1/1] border-[3.5px] border-[var(--html-bg-website)] bg-white group-hover/process:bg-[var(--html-bg-website)] group-hover/process:border-white group-hover/process:text-white group-[&.active]/process:bg-[var(--html-bg-website)] group-[&.active]/process:border-white group-[&.active]/process:text-white transition-all duration-300 rounded-full absolute top-[5px] left-[-7px] inline-flex justify-center items-center text-lg text-[#343434] font-bold font-main-700">
                                            <span>
                                                <?= sprintf("%02d", $key_process + 1) ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-center items-center mb-[14px] ">
                                    <div class=" h-4 aspect-[1/1] rounded-full bg-inherit p-[2.8px] group-hover/process:bg-[var(--html-bg-website)] group-[&.active]/process:bg-[var(--html-bg-website)] transition-all duration-300">
                                        <div class="relative w-full h-full rounded-full bg-[#777] ">
                                            <div class="absolute h-[17px] border-[1.2px] border-[#777] z-10 top-full left-1/2 -translate-x-1/2"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-0 h-[13px] max-w-[190px] rounded-3xl bg-[var(--html-bg-website)] group-hover/process:w-full group-[&.active]/process:w-full transition-all duration-300 mb-3">
                                    <div class="absolute h-[13px]  w-full left-0 bg-[#DACACA] rounded-3xl z-[-1]"></div>
                                </div>
                                <div class="text-center text-[#251910] text-sm sm:text-base font-bold font-main-700 line-clamp-2 group-hover/process:text-[var(--html-bg-website)] group-[&.active]/process:text-[var(--html-bg-website)] transition-all duration-300 mb-1">
                                    <span>
                                        <?= $value_process["ten"] ?>
                                    </span>
                                </div>
                                <div class="text-center text-[#777] text-sm sm:text-base font-medium font-main-500 line-clamp-3 ">
                                    <span>
                                        <?= htmlspecialchars_decode($value_process["mota"]) ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="flex justify-center items-center gap-2">
                <div class="button_process_prev cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="36" viewBox="0 0 35 36" fill="none">
                        <rect width="34.2086" height="34.2086" transform="matrix(-1 0 0 1 34.6108 0.902344)" fill="#8B5E3B" fill-opacity="0.5" />
                        <path d="M29.937 16.5066C30.7654 16.5066 31.437 17.1782 31.437 18.0066C31.437 18.835 30.7654 19.5066 29.937 19.5066L29.937 16.5066ZM4.016 19.0673C3.43022 18.4815 3.43022 17.5317 4.016 16.9459L13.5619 7.39999C14.1477 6.8142 15.0975 6.8142 15.6833 7.39999C16.2691 7.98578 16.2691 8.93553 15.6833 9.52131L7.19798 18.0066L15.6833 26.4919C16.2691 27.0777 16.2691 28.0274 15.6833 28.6132C15.0975 29.199 14.1477 29.199 13.5619 28.6132L4.016 19.0673ZM29.937 19.5066L5.07666 19.5066L5.07666 16.5066L29.937 16.5066L29.937 19.5066Z" fill="white" />
                    </svg>
                </div>
                <div class="button_process_next cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="36" viewBox="0 0 35 36" fill="none">
                        <rect x="0.61084" y="0.902344" width="34.2086" height="34.2086" fill="#8B5E3B" fill-opacity="0.5" />
                        <path d="M5.28491 16.5066C4.45649 16.5066 3.78491 17.1782 3.78491 18.0066C3.78491 18.835 4.45648 19.5066 5.28491 19.5066L5.28491 16.5066ZM31.2059 19.0673C31.7917 18.4815 31.7917 17.5317 31.2059 16.9459L21.66 7.39999C21.0742 6.8142 20.1244 6.8142 19.5387 7.39999C18.9529 7.98578 18.9529 8.93553 19.5387 9.52131L28.0239 18.0066L19.5387 26.4919C18.9529 27.0777 18.9529 28.0274 19.5387 28.6132C20.1244 29.199 21.0742 29.199 21.66 28.6132L31.2059 19.0673ZM5.28491 19.5066L30.1453 19.5066L30.1453 16.5066L5.28491 16.5066L5.28491 19.5066Z" fill="white" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
<?php } ?>