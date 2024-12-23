<?php
// đối tác
$ach_partner = $cache->getCache("select link, ten_$lang as ten ,photo from #_photo where type=? and hienthi=1 order by stt asc ", array('partner'), 'result', _TIMECACHE);

?>
<script>
    var form_partner = $(".form_partner");
    form_partner.owlCarousel({
        dots: true,
        loop: true,
        center: false,
        nav: false,
        responsive: {
            0: {
                items: 2,
                margin: 8,
            },
            400.5: {
                items: 3,
                margin: 8,
            },
            700.5: {
                items: 4,
                margin: 8,
            },
            800.5: {
                items: 5,
                margin: 10,
            },
            1023.5: {
                items: 6,
                margin: 12,
            },
        },
        stagePadding: 10,
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
<!-- đối tác  -->
<?php if (!empty($ach_partner)) { ?>
    <section class="section-partner pt-3 pb-10 sm:pt-8 sm:pb-[90px] bg-white">
        <div class="grid_s wide ">
            <div class="mx-[-10px]">
                <div class="owl-carousel form_partner owl-theme  wow zoomIn" data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="0.2s">
                    <?php foreach ($ach_partner as $key => $value) { ?>
                        <div class="bg-white my-5 shadow-[0px_10px_15px_0px_rgba(0,_0,_0,_0.10)]  transition-all duration-300">
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