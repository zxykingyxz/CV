<?php

$type_slider = '';

$max_h_video = 700;

$min_h_video = 400;


$w_images = 1440;
if ($deviceType != 'phone') {
    $type_slider = 'slider';
    $h_images = 500;
} else {
    $type_slider = 'slider-mobile';
    $h_images = 900;
}

$slider = $db->rawQuery("select ten_$lang as ten,photo,link,mota_$lang as mota,slogan_$lang as slogan from #_photo where hienthi=1 and type=? order by stt asc,id desc", array($type_slider));
?>

<section class="slider bg-white">
    <div class="grid_x no_p wide ">
        <div class="relative w-full">
            <?php switch ($row_setting["slider_web"]) {
                case 1:
            ?>
                    <video class="ratio-video__content w-full aspect-[16/9]" playsinline autoplay muted controls loop>
                        <source src="<?= _upload_hinhanh_l . $row_setting["photo"] ?>" type="video/mp4">
                    </video>
                <?php
                    break;
                case 3:
                ?>
                    <iframe width="100%" height="100%" class="aspect-[16/9] w-full" allowfullscreen
                        src="https://www.youtube.com/embed/<?= $func->getYoutube($row_setting['linksyoutube']) ?>">
                    </iframe>
                <?php
                    break;
                default:
                ?>
                    <?php if (!empty($slider)) { ?>
                        <div class="swiper form_slider_main">
                            <div class="swiper-wrapper">
                                <?php foreach ($slider as $k => $v) { ?>
                                    <div class="swiper-slide transition-all duration-300 w-full leading-[0] btn_scroll" data-target="client">
                                        <?= $func->addHrefImg(
                                            [
                                                'addhref' => true,
                                                'classfix' => "leading-none",
                                                'href' => $jv0,
                                                'upload' => _upload_hinhanh_l,
                                                'image' => $v['photo'],
                                                'sizes' => $w_images . 'x' . $h_images . 'x1',
                                                'actual_width' => 1900,
                                                'alt' => $v["ten"],
                                            ]
                                        ); ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class=" swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    <?php } ?>
            <?php
                    break;
            }
            ?>
        </div>
    </div>
</section>