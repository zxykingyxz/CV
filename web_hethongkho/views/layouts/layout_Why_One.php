<?php
// tại sao chọn chúng tôi
$info_why = $cache->getCache("select  ten_$lang as ten , mota_$lang as mota,photo from #_bannerqc where type=? and hienthi=1", array('info-why'), 'fetch', _TIMECACHE);

$list_why = $cache->getCache("select ten_$lang as ten ,photo from #_photo where type=? and hienthi=1 order by stt asc limit 0,6", array('why'), 'result', _TIMECACHE);

?>
<!-- tại sao chọn chúng tôi -->
<?php if (!empty($list_why)) { ?>
    <section class="section-introduct bg-white pt-8 pb-4 sm:pt-12 sm:pb-7">
        <div class="grid_s wide ">
            <div class="wow fadeInDown" data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="0.2s">
                <div class="text-center mb-5">
                    <a href="<?= $jv0 ?>" title="" class=" <?= $class_title_main ?>">
                        <?= $info_why['ten'] ?>
                    </a>
                </div>
                <div class="mb-7 text-center flex justify-center ">
                    <div class="w-10/12">
                        <span class="<?= $class_content_main ?>">
                            <?= htmlspecialchars_decode($info_why['mota']) ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap justify-between items-center gap-3">
                <div class="group/layoutsWhy left w-full md:w-[45%] lg:w-[32%] grid grid-cols-1 gap-3 lg:gap-12 [&.left]:md:text-end [&.right]:text-start">
                    <?php foreach (array($list_why[0], $list_why[2], $list_why[4])  as $key_why => $value_why) {
                    ?>
                        <div class="bg-[#F6F6F6] hover:bg-[var(--html-sc-website)] rounded-[20px] py-3 sm:py-6 px-[14px] shadow-[6px_5px_15px_0px_rgba(0,_0,_0,_0.15)] inline-flex justify-center items-center leading-[0] translate-x-0 gap-[15px] flex-row group-[&.right]/layoutsWhy:md:flex-row-reverse transition-all duration-300 group-[&.left]/layoutsWhy:mr-[37px] group-[&.right]/layoutsWhy:md:ml-[37px] group-[&.right]/layoutsWhy:md:mr-[0px] group-[&.right]/layoutsWhy:mr-[37px]   <?= ($key_why != 1) ? " group-[&.left]/layoutsWhy:lg:translate-x-[16%] group-[&.right]/layoutsWhy:lg:translate-x-[-16%] " : "" ?>">
                            <div class="flex-1 text-sm sm:text-base line-clamp-2 h-[calc(14px*1.75*2)] sm:h-[calc(16px*1.75*2)]  leading-[1.75] sm:leading-[1.75] text-[#323232] font-medium font-main">
                                <span>
                                    <?= $value_why['ten'] ?>
                                </span>
                            </div>
                            <div class="w-[23px] relative">
                                <div class="absolute top-1/2 group-[&.left]/layoutsWhy:left-0 group-[&.right]/layoutsWhy:md:right-0 group-[&.right]/layoutsWhy:md:left-[unset]  group-[&.right]/layoutsWhy:left-0 -translate-y-1/2 w-[74px] aspect-[1/1]">
                                    <div class="w-full h-full border-[5px] border-[var(--html-bg-website)] rounded-full overflow-hidden bg-white leading-[0] inline-flex justify-center items-center">
                                        <div class="w-[54%] aspect-[1/1]">
                                            <?= $func->addHrefImg([
                                                'addhref' => true,
                                                'href' => $jv0,
                                                'sizes' => '200x200x2',
                                                'actual_width' => 600,
                                                'upload' => _upload_hinhanh_l,
                                                'image' =>  $value_why["photo"],
                                                'alt' => (isset($value_why["ten_$lang"])) ? $value_why["ten_$lang"] : $value_why["ten"],
                                            ]); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="w-[21%] hidden lg:flex justify-center items-center">
                    <div class="leading-[0]">
                        <?= $func->addHrefImg([
                            'addhref' => true,
                            'href' => $jv0,
                            'sizes' => '300x300x1',
                            'actual_width' => 600,
                            'upload' => _upload_hinhanh_l,
                            'image' =>  $info_why["photo"],
                            'alt' => (isset($info_why["ten_$lang"])) ? $info_why["ten_$lang"] : $info_why["ten"],
                        ]); ?>
                    </div>
                </div>
                <div class="group/layoutsWhy right w-full md:w-[45%] lg:w-[32%] grid grid-cols-1 gap-3 lg:gap-12 [&.left]:md:text-end [&.right]:text-start">
                    <?php foreach (array($list_why[1], $list_why[3], $list_why[5])  as $key_why => $value_why) {
                    ?>
                        <div class="bg-[#F6F6F6] hover:bg-[var(--html-sc-website)] rounded-[20px] py-3 sm:py-6 px-[14px] shadow-[6px_5px_15px_0px_rgba(0,_0,_0,_0.15)] inline-flex justify-center items-center leading-[0] translate-x-0 gap-[15px] flex-row group-[&.right]/layoutsWhy:md:flex-row-reverse transition-all duration-300 group-[&.left]/layoutsWhy:mr-[37px] group-[&.right]/layoutsWhy:md:ml-[37px] group-[&.right]/layoutsWhy:md:mr-[0px] group-[&.right]/layoutsWhy:mr-[37px]   <?= ($key_why != 1) ? " group-[&.left]/layoutsWhy:lg:translate-x-[16%] group-[&.right]/layoutsWhy:lg:translate-x-[-16%] " : "" ?>">
                            <div class="flex-1 text-sm sm:text-base line-clamp-2 h-[calc(14px*1.75*2)] sm:h-[calc(16px*1.75*2)]  leading-[1.75] sm:leading-[1.75] text-[#323232] font-medium font-main">
                                <span>
                                    <?= $value_why['ten'] ?>
                                </span>
                            </div>
                            <div class="w-[23px] relative">
                                <div class="absolute top-1/2 group-[&.left]/layoutsWhy:left-0 group-[&.right]/layoutsWhy:md:right-0 group-[&.right]/layoutsWhy:md:left-[unset]  group-[&.right]/layoutsWhy:left-0 -translate-y-1/2 w-[74px] aspect-[1/1]">
                                    <div class="w-full h-full border-[5px] border-[var(--html-bg-website)] rounded-full overflow-hidden bg-white leading-[0] inline-flex justify-center items-center">
                                        <div class="w-[54%] aspect-[1/1]">
                                            <?= $func->addHrefImg([
                                                'addhref' => true,
                                                'href' => $jv0,
                                                'sizes' => '200x200x2',
                                                'actual_width' => 600,
                                                'upload' => _upload_hinhanh_l,
                                                'image' =>  $value_why["photo"],
                                                'alt' => (isset($value_why["ten_$lang"])) ? $value_why["ten_$lang"] : $value_why["ten"],
                                            ]); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>