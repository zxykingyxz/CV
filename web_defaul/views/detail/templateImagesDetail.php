<?php
$name = (isset($data["ten_$lang"])) ? $data["ten_$lang"] : $data["ten"];

$photo = ($data["photo"]);

$width = 1200;

$height = 1200;

if ($watermark) {
    $href = _watermark . "/product/" . $width . "x" . $height . "x2/" . _upload_baiviet_l . $photo;
} else {
    $href =  _upload_baiviet_l . $photo;
}

?>
<style>
    .button_images_thumbs_gallery .swiper-slide-thumb-active {
        border: 1px solid var(--html-bg-website);
    }
</style>
<!-- Slider chính -->
<div class="swiper view_images_thumbs_gallery">
    <div class="swiper-wrapper">
        <div class="swiper-slide bg-gray-100 overflow-hidden w-full aspect-[1/1] leading-[0]" data-caption="<?= $name ?>" data-thumb="<?= $href ?>">
            <?= $func->addHrefImg([
                'addhref' => true,
                'href' => $href,
                'classfix' => '',
                'sizes' => '600x600x2',
                'actual_width' => $width,
                'isWatermark' => $watermark,
                'prefix' => 'product',
                'actual_width' => 1200,
                'data' => 'data-fancybox="images_detail" ',
                'upload' => _upload_baiviet_l,
                'image' => $photo,
                'alt' => $name,
            ]); ?>
        </div>
        <?php if (!empty($data["video"])) { ?>
            <div class="swiper-slide bg-gray-100 overflow-hidden  w-full aspect-[1/1] leading-[0]  ">
                <div class='w-full flex items-center aspect-[1/1]' data-fancybox="images_detail" href="<?= _upload_baiviet_l . $data["video"] ?>" data-caption="<?= $name ?>" data-thumb="assets/images/icon/film.svg">
                    <video width='100%' height='' autoplay="" muted="" loop="" controls="" style="max-width:100%;object-fit: cover;aspect-ratio: 16/9;">
                        <source src="<?= _upload_baiviet_l . $data["video"] ?>" type="video/mp4">
                    </video>
                </div>
            </div>
        <?php } ?>
        <?php if (!empty($data["link"])) { ?>
            <div class="swiper-slide bg-gray-100 overflow-hidden  w-full aspect-[1/1] leading-[0]" data-fancybox="images_detail" href="<?= $data["link"] ?>" data-caption="<?= $name ?>" data-thumb="assets/images/icon/video.svg">
                <div class='w-full flex items-center aspect-[1/1]'>
                    <iframe width='100%' height='' style='aspect-ratio:16/9;max-width:100%;' allowfullscreen src='https://www.youtube.com/embed/<?= $func->getYoutube($data["link"]) ?>'>
                    </iframe>
                </div>
            </div>
        <?php } ?>
        <?php foreach ($photos as $k => $v) {
            if ($watermark) {
                $href_photos = _watermark . "/product/" . $width . "x" . $height . "x2/" . _upload_baiviet_l . $v['photo'];
            } else {
                $href_photos = _upload_baiviet_l . $v['photo'];
            }
        ?>
            <div class="swiper-slide bg-gray-100 overflow-hidden  w-full aspect-[1/1] leading-[0]" data-caption="<?= $name ?>" data-thumb="<?= $href_photos ?>">
                <?= $func->addHrefImg([
                    'addhref' => true,
                    'href' => $href_photos,
                    'classfix' => '',
                    'sizes' => '600x600x2',
                    'actual_width' => $width,
                    'isWatermark' => $watermark,
                    'prefix' => 'product',
                    'actual_width' => 1200,
                    'data' => 'data-fancybox="images_detail"',
                    'upload' => _upload_baiviet_l,
                    'image' => $v['photo'],
                    'alt' => $name,
                ]); ?>
            </div>
        <?php } ?>
    </div>
    <div class="button_next_images_thumbs_gallery absolute top-1/2 -translate-y-1/2 right-0 rounded-l h-10 w-7 bg-gray-600 opacity-20 hover:opacity-100 [&.swiper-button-disabled]:opacity-0  [&.swiper-button-disabled]:pointer-events-none  inline-flex justify-center items-center leading-[0] z-10 transition-all duration-300 ">
        <i class="fas fa-angle-right text-xl text-white "></i>
    </div>
    <div class="button_prev_images_thumbs_gallery absolute top-1/2 -translate-y-1/2 left-0 rounded-r h-10 w-7 bg-gray-600 opacity-20 hover:opacity-100 [&.swiper-button-disabled]:opacity-0  [&.swiper-button-disabled]:pointer-events-none inline-flex justify-center items-center leading-[0] z-10 transition-all duration-300">
        <i class="fas fa-angle-left text-xl text-white"></i>
    </div>
</div>

<!-- Thumbnails slider -->
<div class="swiper button_images_thumbs_gallery mt-2">
    <div class="swiper-wrapper">
        <div class="swiper-slide bg-gray-100 overflow-hidden  w-full aspect-[1/1]  leading-[0]">
            <?= $func->addHrefImg([
                'addhref' => false,
                'classfix' => '',
                'sizes' => '600x600x2',
                'actual_width' => $width,
                'isWatermark' => $watermark,
                'prefix' => 'product',
                'upload' => _upload_baiviet_l,
                'image' => $photo,
                'alt' => $name,
            ]); ?>
        </div>
        <?php if (!empty($data["video"])) { ?>
            <div class="swiper-slide bg-gray-100 overflow-hidden  w-full aspect-[1/1] leading-[0] ">
                <img src="assets/images/icon/film.svg" alt="">
            </div>
        <?php } ?>

        <?php if (!empty($data["link"])) { ?>
            <div class="swiper-slide bg-gray-100 overflow-hidden  w-full aspect-[1/1] leading-[0]">
                <img src="assets/images/icon/video.svg" alt="">
            </div>
        <?php } ?>
        <?php foreach ($photos as $k => $v) { ?>
            <div class="swiper-slide bg-gray-100 overflow-hidden  w-full aspect-[1/1] leading-[0]">
                <?= $func->addHrefImg([
                    'addhref' => true,
                    'href' => $jv0,
                    'classfix' => '',
                    'sizes' => '600x600x2',
                    'actual_width' => $width,
                    'isWatermark' => $watermark,
                    'prefix' => 'product',
                    'actual_width' => 1200,
                    'upload' => _upload_baiviet_l,
                    'image' => $v['photo'],
                    'alt' => $name,
                ]); ?>
            </div>
        <?php } ?>
    </div>
</div>