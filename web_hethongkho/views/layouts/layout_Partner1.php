<!-- đối tác -->
<?php
// đối tác
$info_partner = $cache->getCache("select ten_$lang as ten , mota_$lang as mota from #_bannerqc where type=? and hienthi=1", array('title_partner'), 'fetch', _TIMECACHE);

$ach_partner = $cache->getCache("select link, ten_$lang as ten ,photo from #_photo where type=? and hienthi=1 order by stt asc ", array('partner'), 'result', _TIMECACHE);

?>
<script>
    var form_partner = $(".form_partner");
    form_partner.owlCarousel({
        dots: false,
        loop: false,
        center: false,
        responsive: {
            0: {
                nav: false,
                items: 2,
                margin: 8,
            },
            400.5: {
                nav: true,
                items: 3,
                margin: 8,
            },
            700.5: {
                nav: true,
                items: 4,
                margin: 8,
            },
            800.5: {
                nav: true,
                items: 5,
                margin: 10,
            },
            1023.5: {
                nav: true,
                items: 6,
                margin: 12,
            },
        },
        responsiveClass: true,
        autoplay: true,
        autoplayTimeout: 6000,
        autoplayHoverPause: true,
        navText: [
            "<i class='fas fa-angle-left'></i>",
            "<i class='fas fa-angle-right'></i>",
        ],
    });
</script>
<?php if (!empty($ach_partner)) { ?>
    <section class="section-product pt-3 pb-3 sm:pt-5 sm:pb-5 bg-white">
        <div class="grid_s wide">
            <div class="text-center mb-7">
                <a href="<?= $jv0 ?>" title="<?= $info_lvhd['ten'] ?>" class=" <?= $class_title_main ?>">
                    <?= $info_partner['ten'] ?>
                </a>
            </div>
            <?php if (!empty($info_partner['mota'])) { ?>
                <div class="mb-5 text-center flex justify-center ">
                    <div class="w-full sm:w-11/12 lg:w-10/12 ">
                        <span class="<?= $class_content_main ?>">
                            <?= htmlspecialchars_decode($info_partner['mota']) ?>
                        </span>
                    </div>
                </div>
            <?php } ?>
            <div class="w-full">
                <div class="owl-carousel form_partner owl-theme">
                    <?php foreach ($ach_partner as $key => $value) { ?>
                        <div class="bg-white border border-gray-200 hover:bg-[var(--html-sc-website)] transition-all duration-300">
                            <?= $func->addHrefImg([
                                'classfix' => 'w-full',
                                'addhref' => true,
                                'href' => (!empty($value['link'])) ? $value['link'] : $jv0,
                                'sizes' => '190x110x2',
                                'actual_width' => 800,
                                'upload' => _upload_hinhanh_l,
                                'image' => ($value["photo"]),
                                'alt' => $value["ten"],
                            ]); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>