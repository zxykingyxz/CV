<?php
$bg_footer = $cache->getCache("select ten_$lang as ten,slogan_$lang as slogan,mota_$lang as mota,photo from #_bannerqc where hienthi=1 and type=? limit 0,1", array('bg_footer'), 'fetch', _TIMECACHE);

$footer = $cache->getCache("select mota_$lang as mota,ten_$lang as ten from #_company where type=? limit 1", array('footer'), 'fetch', _TIMECACHE);

$footer_class_title = " font-main-400 font-bold text-base text-[#040404] capitalize ";

$footer_class_content = "text-[#040404] text-[13px] font-light font-main-300 leading-normal ";

$list_c1_procuct_footer = $cache->getCache("select id,type, ten_$lang as ten , tenkhongdau_$lang as tenkhongdau from #_baiviet_list where type=? and footer=1 and hienthi=1 order by stt asc,id desc", array("san-pham"), 'result', _TIMECACHE);

$margin_top = " mt-6 ";

?>

<footer class="section-footer  footer overflow-hidden relative bg-white" <?php if (!empty($bg_footer['photo'])) { ?> style="background: url(<?= _upload_hinhanh_l . $bg_footer['photo'] ?>) no-repeat center/cover ;" <?php } ?>>
    <div class="grid_s wide">
        <div class=" pt-5  pb-3 relative z-30">
            <div class="flex justify-center">
                <div class="w-full row justify-between gap-5 sm:gap-2">
                    <!-- thông tin liên hệ -->
                    <div class="col flex-1 relative overflow-hidden">
                        <div class="wow ">
                            <div class="w-full flex justify-center sm:justify-start ">
                                <div class="max-w-[185px] leading-[0]">
                                    <?= $func->addHrefImg([
                                        'addhref' => true,
                                        'href' =>  "",
                                        'target' => '',
                                        'sizes' => '185x157x2',
                                        'actual_width' => 500,
                                        'upload' => _upload_hinhanh_l,
                                        'image' => $logo_footer['photo'],
                                        'alt' => "logo footer"
                                    ]); ?>
                                </div>
                            </div>
                            <div class=" mt-1 <?= $footer_class_content ?>">
                                <?= $func->htmlDecodeContent($footer["mota"]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col overflow-hidden basis-full  md:basis-6/12 lg:basis-[20%] flex justify-start lg:justify-center">
                        <div class="wow " data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="0.4s">
                            <div class="<?= $footer_class_title ?>">
                                <span>Sản phẩm</span>
                            </div>
                            <div class="<?= $margin_top ?>">
                                <ul class="grid grid-cols-1 gap-5">
                                    <?php foreach ($list_c1_procuct_footer as $key => $value) {
                                    ?>
                                        <li class="group transition-all duration-300 ">
                                            <a href="<?= $func->getUrl($value) ?>" title="<?= $value['ten'] ?>" class="flex items-center gap-2 group-hover:translate-x-3 transition-all duration-300">
                                                <div class="flex-initial leading-none aspect-[1/1] w-[7px] flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="6" height="7" viewBox="0 0 6 7" fill="none">
                                                        <circle cx="3" cy="3.06592" r="3" fill="var(--html-sc-website)" />
                                                    </svg>
                                                </div>
                                                <div class="<?= $footer_class_content ?>  flex-1   transition-all duration-300 group-hover:text-[var(--html-sc-website)] ">
                                                    <?= $value['ten'] ?>
                                                </div>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col overflow-hidden basis-full  md:basis-6/12 lg:basis-[25%] flex justify-start lg:justify-center">
                        <div class="wow ">
                            <div class="<?= $footer_class_title ?>">
                                <span>quy định & chính sách</span>
                            </div>
                            <div class="<?= $margin_top ?>">
                                <ul class="grid grid-cols-1 gap-5">
                                    <?php foreach ($chinhsach as $key => $value) {
                                    ?>
                                        <li class="group transition-all duration-300 ">
                                            <a href="<?= $func->getUrl($value) ?>" title="<?= $value['ten'] ?>" class="flex items-center gap-2 group-hover:translate-x-3 transition-all duration-300">
                                                <div class="flex-initial leading-none aspect-[1/1] w-[7px] flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="6" height="7" viewBox="0 0 6 7" fill="none">
                                                        <circle cx="3" cy="3.06592" r="3" fill="var(--html-sc-website)" />
                                                    </svg>
                                                </div>
                                                <div class="<?= $footer_class_content ?>  flex-1   transition-all duration-300 group-hover:text-[var(--html-sc-website)] ">
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
                    <div class="col overflow-hidden basis-full  md:basis-6/12 lg:basis-[25%] flex justify-start lg:justify-center">
                        <div class=" w-full wow " data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="0.6s">
                            <div class="<?= $footer_class_title ?>">
                                <span>Kết Nối Nhanh</span>
                            </div>
                            <div class="<?= $margin_top  ?>"></div>
                            <div class="grid grid-cols-2 gap-3 mb-4 ">
                                <?php foreach ($socical as $k => $v) { ?>
                                    <a href="<?= $v['link'] != '' ? $v['link'] : $jv0 ?>" title="<?= $v['ten'] ?>" target="<?= $v['link'] != '' ? '_blank' : '_top' ?>" class="group/mxh py-3 px-5 text-[13px] font-medium font-main-500 flex justify-center items-center gap-2 bg-[#F4F4F4] hover:bg-[var(--html-bg-website)] hover:text-white shadow-[3px_4px_10px_0px_rgba(0,_0,_0,_0.15)] border border-gray-100 hover:border-[var(--html-bg-website)] rounded-lg transition-all duration-300 ">
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
        <?php include _layouts . "sectionCopy.php"; ?>
    </div>
</footer>