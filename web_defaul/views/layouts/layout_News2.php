<?php
// tin tức
$info_blogs = $cache->getCache("select  ten_$lang as ten , slogan_$lang as slogan,mota_$lang as mota from #_bannerqc where type=? and hienthi=1", array('info-blogs'), 'fetch', _TIMECACHE);

$list_blogs = $cache->getCache("select id,type,ten_$lang as ten,ngaytao,photo,luotxem,tenkhongdau_$lang as tenkhongdau from #_baiviet where noibat=1 and type=? and hienthi=1 $orderbyForBlogs ", array('tin-tuc'), 'result', _TIMECACHE);

?>
<!-- tin tức -->
<?php if (!empty($list_blogs)) { ?>
    <section class="section-blogs pt-5 sm:pt-10  pb-6 sm:pb-10 ">
        <div class="grid_s wide">
            <div class="wow fadeInDown" data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="0.2s">
                <div class="text-center pb-3">
                    <a href="<?= $jv0 ?>" title="" class=" <?= $class_title_main ?>">
                        <span class="text-[var(--html-bg-website)]">
                            <?= $info_blogs['ten'] ?>
                        </span>
                    </a>
                </div>
                <div class="pb-4 text-center flex justify-center <?= $class_content_main ?> ">
                    <div class="w-10/12">
                        <span class=" text-[var(--html-bg-website)]">
                            <?= htmlspecialchars_decode($info_blogs['mota']) ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap gap-5">
                <div class="flex-1">
                    <?= $sample->getTemplateLayoutsFor([
                        'name_layouts' => 'gridTemplateNews7',
                        'seoHeading' => 'h4',
                        'data' => array_slice($list_blogs, 0, 1),
                    ]) ?>
                </div>
                <div class="flex-initial w-full lg:w-[58%]">
                    <div class="w-full owl-carousel form_blogs_main owl-theme">
                        <?= $sample->getTemplateLayoutsFor([
                            'name_layouts' => 'gridTemplateNews8',
                            'seoHeading' => 'h4',
                            'data' => array_slice($list_blogs, 1),
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>