<?php
$bg_footer = $cache->getCache("select ten_$lang as ten,slogan_$lang as slogan,mota_$lang as mota,photo from #_bannerqc where hienthi=1 and type=? limit 0,1", array('bg_footer'), 'fetch', _TIMECACHE);

$logo_footer = $cache->getCache("select photo  from #_bannerqc where hienthi=1 and type=? limit 0,1", array('logo_footer'), 'fetch', _TIMECACHE);

$footer = $cache->getCache("select mota_$lang as mota,ten_$lang as ten from #_company where type=? limit 1", array('footer'), 'fetch', _TIMECACHE);

$pay = $cache->getCache("select mota_$lang as mota,ten_$lang as ten from #_company where type=? limit 1", array('pay'), 'fetch', _TIMECACHE);

$footer_class_title = " font-main-600 font-semibold text-base capitalize text-[#343434] ";

$footer_class_content = "text-[#343434] text-[13px] font-medium font-main-500 leading-normal ";

$margin_top = " mt-6 ";

?>


<footer class="section-product footer overflow-hidden relative bg-white" <?php if (!empty($bg_footer['photo'])) { ?> style="background: url(<?= _upload_hinhanh_l . $bg_footer['photo'] ?>) no-repeat center/cover ;" <?php } ?>>
    <div class="grid_s wide">
        <div class=" pt-8 sm:pt-[45px] pb-3 relative z-30">
            <div class="row justify-between gap-5 sm:gap-2">
                <!-- thông tin liên hệ -->
                <div class="col flex-1 relative overflow-hidden">
                    <div class="wow fadeInLeft" data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="0.2s">
                        <div class="<?= $footer_class_title ?>">
                            <span>Thông tin liên hệ</span>
                        </div>
                        <div class=" mb-4 <?= $margin_top . $footer_class_content ?>">
                            <?= $func->htmlDecodeContent($footer["mota"]) ?>
                        </div>
                    </div>
                </div>
                <!-- Các danh mục footer -->
                <div class="col overflow-hidden basis-full  md:basis-6/12 lg:basis-[22%] flex justify-start lg:justify-center">
                    <div class=" wow fadeInLeft" data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="0.6s">
                        <div class="<?= $footer_class_title ?>">
                            <span>Thông Tin Thanh Toán</span>
                        </div>
                        <div class="<?= $margin_top . $footer_class_content ?> content">
                            <span>
                                <?= $func->htmlDecodeContent($pay["mota"]) ?>
                            </span>
                        </div>
                        <div class="w-[150px] mt-2">
                            <?= $func->addHrefImg([
                                'addhref' => true,
                                'href' => !empty($bct["link"]) ? $bct["link"] : $jv0,
                                'target' =>  !empty($bct["link"]) ? "'_blank'" : "",
                                'sizes' => '146x54x2',
                                'actual_width' => 500,
                                'upload' => _upload_hinhanh_l,
                                'image' => ($bct["photo"]),
                                'alt' => "Bộ Công Thương",
                            ]); ?>
                        </div>
                    </div>
                </div>
                <div class="col overflow-hidden basis-full  md:basis-6/12 lg:basis-[22%] flex justify-start lg:justify-center">
                    <div class="wow fadeInLeft" data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="1s">
                        <div class="<?= $footer_class_title ?>">
                            <span>chính sách & quy định</span>
                        </div>
                        <div class="<?= $margin_top ?>">
                            <ul class="grid grid-cols-1 gap-2">
                                <?php foreach ($chinhsach as $key => $value) {
                                    // !empty($value['link']) ? $value['link'] : $jv0
                                ?>
                                    <li class="group transition-all duration-500 hover:translate-x-4">
                                        <a href="<?= $func->getUrl($value) ?>" title="<?= $value['ten'] ?>" class="flex items-center gap-2 ">
                                            <div class="flex-initial">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="6" height="7" viewBox="0 0 6 7" fill="none">
                                                    <circle cx="3" cy="3.06592" r="3" fill="var(--html-bg-website)" />
                                                </svg>
                                            </div>
                                            <div class="<?= $footer_class_content ?>  flex-1   transition-all duration-500 group-hover:text-[var(--html-bg-website)] ">
                                                <?= $value['ten'] ?>
                                            </div>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="w-[150px] mt-2">
                            <?= $func->addHrefImg([
                                'addhref' => true,
                                'href' => !empty($dmca["link"]) ? $dmca["link"] : $jv0,
                                'target' =>  !empty($dmca["link"]) ? "'_blank'" : "",
                                'sizes' => '146x54x2',
                                'actual_width' => 500,
                                'upload' => _upload_hinhanh_l,
                                'image' => ($dmca["photo"]),
                                'alt' => "DMCA",
                            ]); ?>
                        </div>
                    </div>
                </div>

                <!-- mạng xã hội -->
                <div class="col overflow-hidden flex-1 flex justify-start lg:justify-center">
                    <div class=" w-full wow fadeInLeft" data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="1.4s">
                        <div class="<?= $footer_class_title ?>">
                            <span>Kết Nối Nhanh</span>
                        </div>
                        <div class="<?= $margin_top  ?>"></div>
                        <div class="grid grid-cols-2 gap-3 mb-4 ">
                            <?php foreach ($socical as $k => $v) { ?>
                                <a href="<?= $v['link'] != '' ? $v['link'] : $jv0 ?>" title="<?= $v['ten'] ?>" target="<?= $v['link'] != '' ? '_blank' : '_top' ?>" class="group/mxh py-3 px-5 text-[13px] font-medium font-main-500 flex justify-center items-center gap-2 bg-white hover:bg-[var(--html-bg-website)] hover:text-white shadow-[3px_4px_10px_0px_rgba(0,_0,_0,_0.15)] border border-gray-100 rounded-full transition-all duration-300 ">
                                    <div class="w-5 aspect-[1/1] group-hover/mxh:brightness-0  group-hover/mxh:invert transition-all duration-300 leading-[0]">
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
        <?php include _layouts . "sectionCopy.php"; ?>
    </div>
</footer>