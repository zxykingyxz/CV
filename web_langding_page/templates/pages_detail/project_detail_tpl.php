<?php

$name = ((isset($row_detail["ten_$lang"])) ? $row_detail["ten_$lang"] : $row_detail["ten"]);

$photo = ((isset($row_detail["photo_$lang"])) ? $row_detail["photo_$lang"] : $row_detail["photo"]);

$href =  _upload_baiviet_l . $photo;
?>

<section class="wrapper-detail mt-5 mb-5">
    <div class="grid_s wide">
        <div class="flex flex-wrap gap-3">
            <div class="flex-1 max-w-full bg_form_all">
                <div class=" ">
                    <div class=" text-center mb-3">
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
                    <div class="w-full mb-11" id="slide-light-detail">
                        <ul class="slider">
                            <li data-caption="<?= $name ?>" data-thumb="<?= $href ?>">
                                <?= $func->addHrefImg([
                                    'addhref' => true,
                                    'href' => $href,
                                    'classfix' => 'item-slide cs-pointer d-block',
                                    'sizes' => '488x287x1',
                                    'actual_width' => 1220,
                                    'data' => 'data-fancybox="images"',
                                    'upload' => _upload_baiviet_l,
                                    'image' => $photo,
                                    'alt' => $name,
                                ]); ?>
                            </li>
                            <?php if (count($photos) > 0) { ?>
                                <?php foreach ($photos as $k_ds => $v_ds) {
                                    $href_photos =  _upload_baiviet_l . $v_ds['photo'];
                                ?>
                                    <li data-caption="<?= $name ?>" data-thumb="<?= $href_photos ?>" class="img">
                                        <?= $func->addHrefImg([
                                            'addhref' => true,
                                            'href' => $href_photos,
                                            'classfix' => 'item-slide cs-pointer d-block',
                                            'sizes' => '488x287x1',
                                            'actual_width' => 1220,
                                            'data' => 'data-fancybox="images"',
                                            'upload' => _upload_baiviet_l,
                                            'image' => $v_ds['photo'],
                                            'alt' => $name,
                                        ]); ?>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                        </ul>
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