<?php
$bg_footer = $cache->getCache("select ten_$lang as ten,slogan_$lang as slogan,mota_$lang as mota,photo from #_bannerqc where hienthi=1 and type=? limit 0,1", array('bg_footer'), 'fetch', _TIMECACHE);

$footer = $cache->getCache("select mota_$lang as mota,ten_$lang as ten from #_company where type=? limit 1", array('footer'), 'fetch', _TIMECACHE);

$support_center = $cache->getCache("select mota_$lang as mota from #_company where type=? limit 1", array('support-center'), 'fetch', _TIMECACHE);

$worktime = $cache->getCache("select mota_$lang as mota from #_company where type=? limit 1", array('worktime'), 'fetch', _TIMECACHE);

$footer_class_title = " font-main-600 font-semibold text-base text-[#343434] capitalize ";

$footer_class_content = "text-[#343434] text-[13px] font-normal font-main-400 leading-normal ";

$pay = $cache->getCache("select id, ten_$lang as ten ,photo from #_photo where type=? and hienthi=1 order by stt asc ", array('pay'), 'result', _TIMECACHE);

$margin_top = " mt-[10px] ";

$list_service = $db->rawQuery("select id,ten_$lang as ten from #_baiviet where type=? and hienthi=1 order by stt asc", array('dich-vu'));

?>


<footer class="section-footer  footer overflow-hidden relative bg-white" <?php if (!empty($bg_footer['photo'])) { ?> style="background: url(<?= _upload_hinhanh_l . $bg_footer['photo'] ?>) no-repeat center/cover ;" <?php } ?>>
    <div class="grid_s wide">
        <div class=" pt-8 sm:pt-[45px] pb-8 relative z-30">
            <div class="row justify-between gap-5 sm:gap-2">
                <!-- thông tin liên hệ -->
                <div class="col flex-1 relative overflow-hidden">
                    <div class="wow fadeInLeft" data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="0s">
                        <div class="<?= $footer_class_title ?>">
                            <span>Thông tin công ty</span>
                        </div>
                        <div class=" mb-4 <?= $margin_top . $footer_class_content ?>">
                            <?= $func->htmlDecodeContent($footer["mota"]) ?>
                        </div>
                    </div>
                </div>
                <div class="col overflow-hidden basis-full  md:basis-6/12 lg:basis-[18%] flex justify-start lg:justify-center">
                    <div class=" wow fadeInLeft" data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="0.2s">
                        <div class="<?= $footer_class_title ?>">
                            <span>Thời gian làm việc</span>
                        </div>
                        <div class="<?= $margin_top . $footer_class_content ?> content">
                            <span>
                                <?= $func->htmlDecodeContent($worktime["mota"]) ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col overflow-hidden basis-full  md:basis-6/12 lg:basis-[22%] flex justify-start lg:justify-center">
                    <div class="wow fadeInLeft" data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="0.4s">
                        <div class="<?= $footer_class_title ?>">
                            <span>quy định & chính sách</span>
                        </div>
                        <div class="<?= $margin_top ?>">
                            <ul class="grid grid-cols-1 gap-4">
                                <?php foreach ($chinhsach as $key => $value) {
                                ?>
                                    <li class="group transition-all duration-300 views_introduce_info " data-value="<?= $value['id'] ?>" data-form="view_baiviet">
                                        <a href="<?= $jv0 ?>" title="<?= $value['ten'] ?>" class="flex items-center gap-2 group-hover:translate-x-3 transition-all duration-300">
                                            <div class="flex-initial leading-none aspect-[1/1] w-[7px] flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="6" height="7" viewBox="0 0 6 7" fill="none">
                                                    <circle cx="3" cy="3.06592" r="3" fill="var(--html-bg-website)" />
                                                </svg>
                                            </div>
                                            <div class="<?= $footer_class_content ?>  flex-1   transition-all duration-300 group-hover:text-[var(--html-bg-website)] ">
                                                <?= $value['ten'] ?>
                                            </div>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- mạng xã hội -->
                <div class="col overflow-hidden flex-1 flex justify-start lg:justify-center">
                    <div class=" w-full wow fadeInLeft" data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="0.6s">
                        <div class="<?= $footer_class_title ?>">
                            <span>Kết Nối Nhanh</span>
                        </div>
                        <div class="<?= $margin_top  ?>"></div>
                        <div class="grid grid-cols-2 gap-3 mb-4 ">
                            <?php foreach ($socical as $k => $v) { ?>
                                <a href="<?= $v['link'] != '' ? $v['link'] : $jv0 ?>" title="<?= $v['ten'] ?>" target="<?= $v['link'] != '' ? '_blank' : '_top' ?>" class="group/mxh py-3 px-5 text-[13px] font-medium font-main-500 flex justify-center items-center gap-2 bg-white hover:bg-[var(--html-bg-website)] hover:text-white shadow-[3px_4px_10px_0px_rgba(0,_0,_0,_0.15)] border border-gray-100 hover:border-[var(--html-bg-website)] rounded-lg transition-all duration-300 ">
                                    <div class="w-5 aspect-[1/1] overflow-hidden group-hover/mxh:brightness-0  group-hover/mxh:invert transition-all duration-300 leading-[0]">
                                        <?= $func->addHrefImg([
                                            'addhref' => false,
                                            'href' =>  "",
                                            'target' => '',
                                            'sizes' => '20x20x2',
                                            'actual_width' => 500,
                                            'upload' => _upload_hinhanh_l,
                                            'image' => $v['photo'],
                                            'alt' =>  $v['ten']
                                        ]); ?>
                                    </div>
                                    <div class="flex-1">
                                        <span>
                                            <?= $v['ten'] ?>
                                        </span>
                                    </div>
                                </a>
                            <?php }  ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php include _layouts . "sectionCopy.php"; ?>