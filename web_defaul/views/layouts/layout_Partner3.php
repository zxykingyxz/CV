<?php
$list_brand = $cache->getCache("select ten_$lang as ten ,link,photo from #_photo where type=? and hienthi=1 order by stt asc ", array('brand'), 'result', _TIMECACHE);

?>
<script>
    var form_brand = $(".form_brand");
    form_brand.owlCarousel({
        dots: true,
        loop: true,
        center: false,
        responsive: {
            0: {
                items: 2,
                margin: 12,
            },
            700.5: {
                items: 3,
                margin: 12,
            },
            800.5: {
                items: 4,
                margin: 16,
            },
            1023.5: {
                items: 5,
                margin: 20,
            },
        },
        nav: false,
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
<?php if (!empty($list_teams)) { ?>
    <section class="section-teams pt-9 sm:pt-14 pb-5 sm:pb-14 bg-white">
        <div class="grid_s wide">
            <div class="owl-carousel form_brand owl-theme">
                <?php
                $list_tmp = array();
                foreach ($list_brand as $k => $v) {
                    if (((($k + 1) % 2 === 0) && ($k != 0)) || (count($list_brand) == ($k + 1))) {
                        array_push($list_tmp, $v);
                ?>
                        <div class="grid grid-cols-1 gap-3 md:gap-4 lg:gap-5">
                            <?php foreach ($list_tmp as $key => $value) { ?>
                                <div class="bg-white border border-gray-200 hover:bg-[var(--html-sc-website)] transition-all duration-300">
                                    <?= $func->addHrefImg([
                                        'classfix' => 'w-full',
                                        'addhref' => true,
                                        'href' => (!empty($value['link'])) ? $value['link'] : $jv0,
                                        'sizes' => '224x107x2',
                                        'actual_width' => 800,
                                        'upload' => _upload_hinhanh_l,
                                        'image' => ($value["photo"]),
                                        'alt' => $value["ten"],
                                    ]); ?>
                                </div>
                            <?php } ?>
                        </div>
                <?php
                        $list_tmp = array();
                    } else {
                        array_push($list_tmp, $v);
                    }
                }
                ?>

            </div>
        </div>
    </section>
<?php } ?>