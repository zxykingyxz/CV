<?php
$name = (isset($data["ten_$lang"])) ? $data["ten_$lang"] : $data["ten"];

$photo = ($data["photo"]);

if ($watermark) {
    $href = _watermark . '/product/1000x1000x2/' . _upload_baiviet_l . $photo;
} else {
    $href =  _upload_baiviet_l . $photo;
}

if (!empty($data["link"])) {
    $link = $data["link"];
} else if (!empty($data["video"])) {
    $link = _upload_baiviet_l . $data["video"];
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
                'sizes' => '1000x1000x2',
                'isWatermark' => $watermark,
                'prefix' => 'product',
                'data' => 'data-fancybox="images_detail" ',
                'upload' => _upload_baiviet_l,
                'image' => $photo,
                'alt' => $name,
            ]); ?>
        </li>
        <?php if ((!empty($data["link"])) || (!empty($data["video"]))) { ?>
            <li class="items  video-criteria item-slide cursor-pointer relative flex-1" data-fancybox="images_detail" href="<?= $link ?>" data-caption="<?= $name ?>" data-thumb="assets/images/icon/video.svg">
                <?php if (!empty($data["link"])) { ?>
                    <div class='h-full flex items-center'>
                        <iframe width='100%' height='' style='aspect-ratio:16/9;max-width:100%;' allowfullscreen src='https://www.youtube.com/embed/<?= $func->getYoutube($link) ?>'>
                        </iframe>
                    </div>
                <?php } else if (!empty($data["video"])) {  ?>
                    <div class='h-full flex items-center'>
                        <video width='100%' height='' autoplay="" muted="" loop="" controls="" style="max-width:100%;object-fit: cover;aspect-ratio: 16/9;">
                            <source src="<?= $link ?>" type="video/mp4">
                        </video>
                    </div>
                <?php } ?>
            </li>
        <?php } ?>
        <?php foreach ($photos as $k => $v) {
            if ($watermark) {
                $href_photos = _watermark . '/product/1000x1000x2/' . _upload_baiviet_l . $v['photo'];
            } else {
                $href_photos =  _upload_baiviet_l . $v['photo'];
            }
        ?>
            <li data-caption="<?= $name ?>" data-thumb="<?= $href_photos ?>">
                <?= $func->addHrefImg([
                    'addhref' => true,
                    'href' => $href_photos,
                    'classfix' => 'item-slide cs-pointer d-block',
                    'sizes' => '1000x1000x2',
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