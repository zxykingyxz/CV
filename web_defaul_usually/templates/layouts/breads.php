<?php if (!empty($banner_tpl)) { ?>
    <section class="flex relative flex-wrap justify-center items-center ">
        <div class="grid_x wide no_p leading-[0]">
            <?= $func->addHrefImg([
                'addhref' => true,
                'href' =>  $jv0,
                'target' => '',
                'sizes' => '1440x690x1',
                'actual_width' => 1900,
                'upload' => _upload_hinhanh_l,
                'image' => $banner_tpl['photo'],
                'alt' => "banner"
            ]); ?>
        </div>
        <?php if (!in_array($com, ['']) && !empty($titleContainer)) { ?>
            <div class="grid_s wide absolute top-0 -translate-x-1/2 left-1/2 w-full h-full ">
                <div class=" h-full text-center flex justify-center items-center ">
                    <?= $sample->getTemplateLayoutsFor([
                        'name_layouts' => 'titleSeo',
                        'title' => $titleContainer,
                        'class' => 'relative block text-white text-xl sm:text-2xl md:text-3xl lg:text-5xl font-bold',
                        'style' => "text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.8);"
                    ]); ?>
                </div>
            </div>
        <?php } ?>
    </section>
    <?php if (!in_array($com, [''])) { ?>
        <div class=" w-full h-auto bg-[var(--html-bg-website)]">
            <div class="grid_s wide">
                <div class="w-full flex">
                    <div class="relative z-10 overflow-hidden inline-block text-white border-white  pl-2 py-1">
                        <?= $str_breadcrumbs ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } else { ?>
    <section class=" hidden sm:block mt-3">
        <div class="grid_s wide">
            <div class=" w-full bg-inherit text-[var(--html-cl-website)]  pl-2 py-1">
                <?= $str_breadcrumbs ?>
            </div>
        </div>
    </section>
<?php } ?>