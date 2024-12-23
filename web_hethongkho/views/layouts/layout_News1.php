<!-- blog và tin tức -->
<?php
// banner
$list_blogs = $cache->getCache("select photo,id,type, ten_$lang as ten , tenkhongdau_$lang as tenkhongdau ,ngaytao from #_baiviet where noibat=1 and type=? and hienthi=1 $orderbyForBlog", array('blog-chia-se'), 'result', _TIMECACHE);

$list_tintuc = $cache->getCache("select photo,id,type, ten_$lang as ten , tenkhongdau_$lang as tenkhongdau ,ngaytao from #_baiviet where noibat=1 and type=? and hienthi=1 $orderbyForTinTuc", array('tin-tuc'), 'result', _TIMECACHE);

?>
<script>
    var blogs_main = $(".form_blogs_main");
    blogs_main.owlCarousel({
        dots: false,
        loop: false,
        center: false,
        responsive: {
            0: {
                margin: 15,
                nav: false,
            },
            700.5: {
                nav: true,
                margin: 20,
            },
        },
        items: 1,
        responsiveClass: true,
        autoplay: false,
        autoplayTimeout: 6000,
        autoplayHoverPause: true,
        navText: [
            "<i class='fas fa-angle-left'></i>",
            "<i class='fas fa-angle-right'></i>",
        ],
    });
</script>
<?php if (!empty($list_product_c1)) { ?>
    <section class="section-product pt-5 pb-6 sm:pt-10 sm:pb-10 bg-white">
        <div class="grid_s wide">
            <div class="flex flex-wrap w-full justify-between gap-8 sm:gap-0">
                <div class="w-full md:w-[46%]">
                    <div class="mb-5 sm:mb-7">
                        <a href="<?= $func->getType('blog-chia-se'); ?>" title="<?= $info_lvhd['ten'] ?>" class=" <?= $class_title_main ?>">
                            <?= "BLOG CHIA SẺ" ?>
                        </a>
                    </div>
                    <div class="w-full">
                        <div class="owl-carousel form_blogs_main owl-theme">
                            <?= $func->getTemplateLayoutsFor([
                                'name_layouts' => 'gridTemplateNews1',
                                'seoHeading' => 'h3',
                                'data' => $list_blogs,
                            ]) ?>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2">
                    <div class="mb-5 sm:mb-7">
                        <a href="<?= $func->getType('tin-tuc'); ?>" title="<?= $info_lvhd['ten'] ?>" class=" <?= $class_title_main ?>">
                            <?= "TIN TỨC" ?>
                        </a>
                    </div>
                    <div class="w-full max-h-[clamp(355px,40vw,530px)] overflow-x-hidden overflow-y-auto scroll-y grid grid-cols-1 gap-3">
                        <?= $func->getTemplateLayoutsFor([
                            'name_layouts' => 'gridTemplateNews2',
                            'seoHeading' => 'h3',
                            'data' => $list_tintuc,
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>