<section class="wrapper-detail mt-5 mb-5">
    <div class="grid_s wide">
        <div class="w-full flex flex-wrap gap-3">
            <div class="flex-initial w-full <?= (!empty($tintuc) ? "md:w-[70%]" : "") ?>  bg_form_all">
                <div class=" ">
                    <div class="title_detail mb-3">
                        <?= $sample->getTemplateLayoutsFor([
                            'name_layouts' => 'titleSeo',
                            'title' => $titleContainer,
                            'class' => 'title_detail',
                            'banner_tpl' => $banner_tpl,
                        ]); ?>
                    </div>
                    <div class="mb-3 flex gap-2 sm:gap-4 lg:gap-8">
                        <p class="whitespace-nowrap mb-0"><i class="fa fa-calendar mr-1"></i> <?= $func->daysOfTheWeek($row_detail["ngaytao"]) ?>, <?= date('d/m/Y', $row_detail['ngaytao']) ?></p>
                        <p class="whitespace-nowrap mb-0"><i class="fa fa-user mr-1"></i> <?= $row_tacgia["ten"] != '' ? $row_tacgia["ten"] : 'Administrator' ?></p>
                        <p class="whitespace-nowrap mb-0"><i class="fa fa-eye mr-1"></i><?= $row_detail['luotxem'] ?></p>
                    </div>
                    <?php if (!empty($row_detail['mota_' . $lang])) { ?>
                        <div class=" content mb-5">
                            <?= htmlspecialchars_decode($row_detail['mota_' . $lang]) ?>
                        </div>
                    <?php } ?>
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
            <?= $sample->getTemplateLayoutsFor([
                'name_layouts' => 'relatedPosts',
                'data' => $tintuc,
                'class_form' => "flex-1",
            ]) ?>
        </div>
    </div>
</section>