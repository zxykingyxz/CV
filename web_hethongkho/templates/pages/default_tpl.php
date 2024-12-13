<section class="mt-5 mb-7">
    <div class="grid_s wide">
        <div class="w-full mb-3">
            <div class=" bg_form_all mb-5">
                <div class="w-full ">
                    <?php if (empty($banner_tpl)) { ?>
                        <div class=" flex justify-center text-center">
                            <?= $func->getTemplateLayoutsFor([
                                'name_layouts' => 'titleSeo',
                                'title' => $titleContainer,
                                'class' => 'title-container mb-3',
                                'banner_tpl' => $banner_tpl,
                            ]); ?>
                        </div>
                    <?php } ?>
                    <?= $func->getTemplateLayoutsFor([
                        'name_layouts' => 'subject',
                        'subject' => $seo->getSeo('subject'),
                        'class_form' => '',
                    ]); ?>
                    <?php if (($config['layouts']['tap_list'] == true)) {
                        $data = [];
                        switch ($rowc['type']) {
                            case 'general':
                                $data = $row_list;
                                break;
                            case 'list':
                                $data = $row_cat;
                                break;
                            case 'cat':
                                $data = $row_item;
                                break;
                            default:
                        }
                        if (!empty($data)) {
                    ?>
                            <div class="text-lg sm:text-xl font-main font-bold text-[var(--html-bg-website)] mb-2 mt-7">
                                <span>
                                    Danh Mục
                                </span>
                            </div>

                            <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-2 justify-center ">
                                <?php foreach ($data as $k => $v) { ?>
                                    <div class=" ">
                                        <div class="bg-white shadow-md shadow-gray-300  border border-gray-200 hover:shadow-[var(--html-bg-website)] hover:border-[var(--html-bg-website)] rounded-md p-2 sm:p-3 transition-all duration-300">
                                            <div class="overflow-hidden relative  rounded leading-[0]">
                                                <?= $func->addHrefImg([
                                                    'addhref' => true,
                                                    'href' =>  $func->getUrl($v),
                                                    'sizes' => '300x250x1',
                                                    'actual_width' => 500,
                                                    'upload' => _upload_baiviet_l,
                                                    'image' => ((isset($v["photo_$lang"])) ? $v["photo_$lang"] : $v["photo"]),
                                                    'alt' => (isset($v["ten_$lang"])) ? $v["ten_$lang"] : $v["ten"],
                                                ]); ?>
                                                <div class="absolute top-0 left-0 w-full h-full pointer-events-none bg-[#00000060] p-1 inline-flex justify-center items-center leading-[0]">
                                                    <h2>
                                                        <span class="text-center text-white line-clamp-4 text-xs sm:text-sm font-medium font-main-500">
                                                            <?= (isset($v["ten_$lang"])) ? $v["ten_$lang"] : $v["ten"] ?>
                                                        </span>
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                    <?php }
                    } ?>
                    <style>
                        .form_category_detail:hover .text_category_detail {
                            opacity: 0 !important;
                        }
                    </style>
                </div>
            </div>
            <div class=" bg_form_all">
                <div class="w-full ">
                    <div class="text-lg sm:text-xl font-main font-bold  text-[var(--html-bg-website)] mb-2">
                        <span>
                            Danh Sách
                        </span>
                    </div>
                    <div class="flex gap-2">
                        <div class="f1" id="scroll__product">
                            <?php if (!empty($tintuc)) { ?>
                                <div class="<?= $class_form_new ?> now-loading w100" id="wrap__product">
                                    <?= $func->getTemplateLayoutsFor([
                                        'name_layouts' => $layouts,
                                        'seoHeading' => 'h3',
                                        'data' => $tintuc,
                                    ]); ?>
                                </div>
                                <?php
                                if ($config['website']['paging']) { ?>
                                    <div class="mt10" id="paging">
                                        <?= $paging ?>
                                    </div>
                                    <?php } else {
                                    if ($total_paging > 0) { ?>
                                        <div id="paging" class="t-center">
                                            <?= $func->getTemplateLayoutsFor([
                                                'name_layouts' => 'loadMore',
                                                'total' => $total_paging,
                                                'options' =>  ['page' => $page, 'item' => $per_page],
                                                'title' => $textButton,
                                            ]); ?>
                                        </div>
                                <?php }
                                } ?>
                            <?php } else { ?>
                                <?= $func->getTemplateLayoutsFor([
                                    'name_layouts' => 'form_nodata',
                                    'class' => '',
                                ]) ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (!empty($seo->getSeo('content'))) { ?>
            <div class="bg_form_all mb-3 ">
                <?= $func->getTemplateLayoutsFor([
                    'name_layouts' => 'content',
                    'content' => $seo->getSeo('content'),
                ]); ?>
            </div>
        <?php } ?>
    </div>
</section>