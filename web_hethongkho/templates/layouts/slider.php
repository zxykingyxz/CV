<?php

$type_slider = '';

$max_h_video = 700;

$min_h_video = 200;

$h_images = 662;

$w_images = 1440;
switch ($com) {
        // case 'gioi-thieu':
        //     $type_slider = 'slider-gioithieu';
        //     break;
        // case 'sua-chua-nha':
        //     $type_slider = 'slider-suachuanha';
        //     break;
        // case '1000-mau-nha':
        //     $type_slider = 'slider-1000maunha';
        //     break;
        // case 'xay-nha-moi':
        //     $type_slider = 'slider-xaynhamoi';
        //     break;
        // case 'thiet-ke-noi-that':
        //     $type_slider = 'slider-thietkenoithat';
        //     break;
        // case 'vat-lieu-xay-dung':
        //     $type_slider = 'slider-vatlieuxaydung';
        //     break;
        // case 'kinh-nghiem-xay-dung':
        //     $type_slider = 'slider-kinhnghiemxaydung';
        //     break;
        // case 'phong-thuy':
        //     $type_slider = 'slider-phongthuy';
        //     break;
        // case 'bao-gia':
        //     $type_slider = 'slider-baogia';
        //     break;
        // case 'danh-gia-khach-hang':
        //     $type_slider = 'slider-danhgiakhachhang';
        //     break;
    default:
        if ($deviceType != 'phone') {
            $type_slider = 'slider';
        } else {
            $type_slider = 'slider-mobile';
        }
        break;
}

$slider = $db->rawQuery("select ten_$lang as ten,photo,link,mota_$lang as mota,slogan_$lang as slogan from #_photo where hienthi=1 and type=? order by stt asc,id desc", array($type_slider));


?>

<?php if ($row_setting["slider_web"] == 1) { ?>
    <section class="slider-videoupload p-relative">
        <div class="grid_x wide no_p">
            <video class="ratio-video__content w-full aspect-[16/9]" playsinline autoplay muted controls loop>
                <source src="<?= _upload_hinhanh_l . $row_setting["photo"] ?>" type="video/mp4">
            </video>
        </div>
    </section>
<?php } else if ($row_setting["slider_web"] == 2) { ?>
    <?php if (!empty($slider)) { ?>
        <section class="">
            <div class="grid_x wide no_p">
                <div class="owl-carousel owl-theme owl-carousel-loop owl-slider" <?= !empty($time_slider) ? "data-delay='$time_slider'" : "" ?> data-height="640" data-nav="0" data-loop="1" data-play="1" data-lg-items="1" data-md-items="1" data-sm-items="1" data-xs-items="1" data-dot="0" <?php if ($deviceType == 'computer') { ?> data-margin='20' <?php } else { ?> data-margin='8' <?php } ?> data-delay="<?= $time_slider ?>">
                    <?php foreach ($slider as $k => $v) { ?>
                        <?= $func->addHrefImg(
                            [
                                'addhref' => true,
                                'href' => $v["link"],
                                'target' => '_blank',
                                'upload' => _upload_hinhanh_l,
                                'image' => $v['photo'],
                                'sizes' => '1600x' . (int)(($h_images * 1600) / $w_images) . 'x1',
                                'alt' => $v["ten"],
                            ]
                        ); ?>
                    <?php } ?>
                </div>
            </div>
        </section>
    <?php } ?>
<?php } else { ?>
    <section class="slider-linksyoutube">
        <div class="grid_x wide no_p">
            <iframe width="100%" height="100%" class="aspect-[16/9] w-full" allowfullscreen src="https://www.youtube.com/embed/<?= $func->getYoutube($row_setting['linksyoutube']) ?>">
            </iframe>
        </div>
    </section>
<?php } ?>