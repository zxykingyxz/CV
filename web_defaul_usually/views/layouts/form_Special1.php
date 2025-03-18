<?php
// trải nghiệm khách hàng
$info_client = $cache->getCache("select  ten_$lang as ten , slogan_$lang as slogan,mota_$lang as mota,photo from #_bannerqc where type=? and hienthi=1", array('info-client'), 'fetch', _TIMECACHE);

$mimeType_client = mime_content_type(_upload_hinhanh_l . $info_client['photo']);

$list_client = $cache->getCache("select ten_$lang as ten ,mota_$lang as mota,slogan_$lang as slogan,photo from #_photo where type=? and hienthi=1 order by stt asc ", array('client'), 'result', _TIMECACHE);

?>
<!-- trải nghiệm khách hàng -->
<?php if (!empty($list_client)) { ?>
    <section class="section-client ">
        <div class="grid_x wide no_p relative z-10 ">
            <div class="absolute z-[-1] top-0 left-0 w-full h-1/2 pointer-events-none ">
                <div class="w-full h-full relative">
                    <?php if (str_starts_with($mimeType_client, 'image/')) { ?>
                        <div class=" absolute top-1/2 left-1/2 overflow-hidden w-full h-full -translate-x-1/2 -translate-y-1/2">
                            <?= $func->addHrefImg([
                                'addhref' => false,
                                'classfix' => "w-full h-full",
                                'class' => "w-full h-full",
                                'sizes' => '1440x215x1',
                                'actual_width' => 1900,
                                'upload' => _upload_hinhanh_l,
                                'image' => $info_client['photo'],
                                'alt' =>  $info_client["ten"],
                            ]); ?>
                        </div>
                    <?php } elseif (str_starts_with($mimeType_client, 'video/')) { ?>
                        <video width="100%" height="auto" autoplay="" playsinline="" muted="" loop="" style="object-fit: cover;position: absolute;top: 0;left: 0;width: 100%;height: 100%;">
                            <source src="<?= _upload_hinhanh_l . $info_client['photo'] ?>" type="video/mp4">
                        </video>
                    <?php } ?>
                </div>
            </div>
            <div class="absolute pointer-events-none z-[-1] bottom-0 left-0 w-full h-1/2 bg-[var(--html-bg-website)]"></div>
            <div class="grid_s wide">
                <div class="w-full pt-9 pb-11">
                    <div class="wow fadeInDown" data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="0.2s">
                        <div class="text-center mb-2 sm:mb-5">
                            <a href="<?= $jv0 ?>" title="" class=" <?= $class_title_main ?>">
                                <span class="text-white">
                                    <?= $info_client['ten'] ?>
                                </span>
                            </a>
                        </div>
                        <div class="pb-2 sm:pb-7 text-center flex justify-center ">
                            <div class="w-10/12 <?= $class_content_main ?>">
                                <span class="text-white">
                                    <?= htmlspecialchars_decode($info_client['mota']) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-center">
                        <div class="w-full sm:w-[90%] md:w-[86%]">
                            <div class="w-full owl-carousel form_client_main owl-theme">
                                <?= $sample->getTemplateLayoutsFor([
                                    'name_layouts' => 'gridTemplateView6',
                                    'seoHeading' => 'span',
                                    'data' => $list_client,
                                ]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>