<?php

$type_slider = '';

$max_h_video = 700;

$min_h_video = 200;

$h_images = 650;

$w_images = 1600;
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
                        <div class="owl-carousel form_slider_main owl-theme" style="width: 100%; aspect-ratio:<?= $w_images . '/' . $h_images ?> ;">
                            <?php foreach ($slider as $k => $v) { ?>
                                <?= $func->addHrefImg(
                                    [
                                        'addhref' => true,
                                        'isLazy' => false,
                                        'href' => $v["link"],
                                        'target' => '_blank',
                                        'upload' => _upload_hinhanh_l,
                                        'image' => $v['photo'],
                                        'sizes' => $w_images . 'x' . $h_images . 'x1',
                                        'actual_width' => 1900,
                                        'alt' => $v["ten"],
                                    ]
                                ); ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
            <?php
                    break;
            }
            ?>
        </div>
    </div>
</section>