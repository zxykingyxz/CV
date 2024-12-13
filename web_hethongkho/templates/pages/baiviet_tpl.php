<section class="mt-5 mb-7">
    <div class="grid_s wide">
        <div class="bg_form_all">
            <div class="flex justify-center items-center text-center ">
                <?= $func->getTemplateLayoutsFor([
                    'name_layouts' => 'titleSeo',
                    'title' => $titleContainer,
                    'class' => 'title-container mb-3',
                    'banner_tpl' => $banner_tpl,
                ]); ?>
            </div>
            <div class="content zoom-detail  mb-5">
                <?= $func->htmlDecodeContent($row_detail['mota_' . $lang]) ?>
            </div>
            <div class="wrapper-toc mb-7">
                <div class="content zoom-detail ">
                    <?php if (!empty($row_detail['noidung_' . $lang])) { ?>
                        <?= $func->htmlDecodeContent($row_detail['noidung_' . $lang]) ?>
                    <?php } else { ?>
                        <?= $func->getTemplateLayoutsFor([
                            'name_layouts' => 'form_nocontent',
                            'class' => '',
                        ]) ?>
                    <?php } ?>
                </div>
            </div>
            <?php include_once _source . 'shareLinks.php' ?>
        </div>
    </div>
</section>