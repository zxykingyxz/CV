<?php

$name = ((isset($row_detail["ten_$lang"])) ? $row_detail["ten_$lang"] : $row_detail["ten"]);

$photo = ((isset($row_detail["photo_$lang"])) ? $row_detail["photo_$lang"] : $row_detail["photo"]);

$href =  _upload_baiviet_l . $photo;
$watermark = false;
?>

<section class="wrapper-detail mt-5 mb-5">
    <div class="grid_s wide">
        <div class="flex flex-wrap gap-3">
            <div class="flex-1 max-w-full bg_form_all">
                <div class=" ">
                    <div class=" text-center mb-5">
                        <?= $sample->getTemplateLayoutsFor([
                            'name_layouts' => 'titleSeo',
                            'title' => $titleContainer,
                            'class' => 'title_detail',
                            'banner_tpl' => $banner_tpl,
                        ]); ?>
                    </div>

                    <?php if (!empty($row_detail['mota_' . $lang])) { ?>
                        <div class=" content mb-5">
                            <?= htmlspecialchars_decode($row_detail['mota_' . $lang]) ?>
                        </div>
                    <?php } ?>
                    <div class="w-full mb-11">
                        <div class="swiper view_images_thumbs_gallery_project w-full aspect-[488/287]">
                            <div class="swiper-wrapper w-full aspect-[488/287]">
                                <div class="swiper-slide bg-gray-100 overflow-hidden w-full aspect-[488/287] leading-[0]" data-caption="<?= $name ?>" data-thumb="<?= $href ?>">
                                    <?= $func->addHrefImg([
                                        'addhref' => true,
                                        'href' => $href,
                                        'classfix' => 'item-slide cs-pointer d-block',
                                        'sizes' => '488x287x2',
                                        'actual_width' => 1220,
                                        'data' => 'data-fancybox="images"',
                                        'upload' => _upload_baiviet_l,
                                        'image' => $photo,
                                        'alt' => $name,
                                    ]); ?>
                                </div>
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
                                            'classfix' => 'item-slide cs-pointer d-block',
                                            'sizes' => '488x287x2',
                                            'actual_width' => 1220,
                                            'data' => 'data-fancybox="images"',
                                            'upload' => _upload_baiviet_l,
                                            'image' => $v['photo'],
                                            'alt' => $name,
                                        ]); ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="button_next_images_thumbs_gallery_project absolute top-1/2 -translate-y-1/2 right-0 rounded-l h-10 w-7 bg-gray-600 opacity-20 hover:opacity-100 [&.swiper-button-disabled]:opacity-0  [&.swiper-button-disabled]:pointer-events-none  inline-flex justify-center items-center leading-[0] z-10 transition-all duration-300 ">
                                <i class="fas fa-angle-right text-xl text-white "></i>
                            </div>
                            <div class="button_prev_images_thumbs_gallery_project absolute top-1/2 -translate-y-1/2 left-0 rounded-r h-10 w-7 bg-gray-600 opacity-20 hover:opacity-100 [&.swiper-button-disabled]:opacity-0  [&.swiper-button-disabled]:pointer-events-none inline-flex justify-center items-center leading-[0] z-10 transition-all duration-300">
                                <i class="fas fa-angle-left text-xl text-white"></i>
                            </div>
                        </div>
                        <?php if (!empty($photos)) { ?>
                            <div class="swiper button_images_thumbs_gallery_project mt-2">
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
                        <?php } ?>
                    </div>
                    <div class="mb-3">
                        <?php if (!empty($row_detail['noidung_' . $lang])) { ?>
                            <div class="wrapper-toc ">
                                <div class="content zoom-detail ">
                                    <?= $func->htmlDecodeContent($seo->getSeo('content')) ?>
                                </div>
                            </div>
                        <?php } else { ?>
                            <?= $sample->getTemplateLayoutsFor([
                                'name_layouts' => 'form_nocontent',
                                'class' => '',
                            ]) ?>
                        <?php } ?>
                    </div>
                </div>
                <?= $sample->getTemplateLayoutsFor([
                    'name_layouts' => 'shareLinks',
                ]) ?>
                <?= $sample->getTemplateLayoutsFor([
                    'name_layouts' => 'author',
                    'author' => $row_tacgia,
                    'class_form' => "",
                ]) ?>
            </div>
        </div>
    </div>
</section>