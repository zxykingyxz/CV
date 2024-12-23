<?php
$name = (isset($data["ten_$lang"])) ? $data["ten_$lang"] : $data["ten"];

$photo = ($data["photo"]);

$width = 1200;

$height = 1200;

if ($watermark) {
    $href = _watermark . "/product/" . $width . "x" . $height . "x2/" . _upload_baiviet_l . $photo;
} else {
    $href = "/thumbs/" . $width . "x" . $height . "x2/" . _upload_baiviet_l . $photo;
}

?>
<style>
    .item-slide {
        width: 100%;
        height: auto;
        aspect-ratio: 1/1;
    }

    .Slider_detail .lSSlideWrapper.usingCss {
        aspect-ratio: 1/1;
    }
</style>
<div class="slider-detail-product relative fix-slide-lSlider" id="slide-light-detail">
    <ul class="slider">
        <li data-caption="<?= $name ?>" data-thumb="<?= $href ?>">
            <?= $func->addHrefImg([
                'addhref' => true,
                'href' => $href,
                'classfix' => 'item-slide cs-pointer block',
                'sizes' => '600x600x2',
                'actual_width' => $width,
                'isWatermark' => $watermark,
                'prefix' => 'product',
                'data' => 'data-fancybox="images_detail" ',
                'upload' => _upload_baiviet_l,
                'image' => $photo,
                'alt' => $name,
            ]); ?>
        </li>
        <?php if (!empty($data["video"])) { ?>
            <li class="items  video-criteria item-slide cursor-pointer relative flex-1" data-fancybox="images_detail" href="<?= _upload_baiviet_l . $data["video"] ?>" data-caption="<?= $name ?>" data-thumb="assets/images/icon/film.svg">
                <div class='h-full flex items-center'>
                    <video width='100%' height='' autoplay="" muted="" loop="" controls="" style="max-width:100%;object-fit: cover;aspect-ratio: 16/9;">
                        <source src="<?= _upload_baiviet_l . $data["video"] ?>" type="video/mp4">
                    </video>
                </div>
            </li>
        <?php } ?>
        <?php if (!empty($data["link"])) { ?>
            <li class="items  video-criteria item-slide cursor-pointer relative flex-1" data-fancybox="images_detail" href="<?= $data["link"] ?>" data-caption="<?= $name ?>" data-thumb="assets/images/icon/video.svg">
                <div class='h-full flex items-center'>
                    <iframe width='100%' height='' style='aspect-ratio:16/9;max-width:100%;' allowfullscreen src='https://www.youtube.com/embed/<?= $func->getYoutube($data["link"]) ?>'>
                    </iframe>
                </div>
            </li>
        <?php } ?>
        <?php foreach ($photos as $k => $v) {
            if ($watermark) {
                $href_photos = _watermark . "/product/" . $width . "x" . $height . "x2/" . _upload_baiviet_l . $v['photo'];
            } else {
                $href_photos = "/thumbs/" . $width . "x" . $height . "x2/" . _upload_baiviet_l . $v['photo'];
            }
        ?>
            <li data-caption="<?= $name ?>" data-thumb="<?= $href_photos ?>">
                <?= $func->addHrefImg([
                    'addhref' => true,
                    'href' => $href_photos,
                    'classfix' => 'item-slide cs-pointer d-block',
                    'sizes' => '600x600x2',
                    'actual_width' => $width,
                    'isWatermark' => $watermark,
                    'prefix' => 'product',
                    'data' => 'data-fancybox="images_detail"',
                    'upload' => _upload_baiviet_l,
                    'image' => $v['photo'],
                    'alt' => $name,
                ]); ?>
            </li>
        <?php } ?>
    </ul>
</div>