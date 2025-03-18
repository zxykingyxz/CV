<?php if ($seo->getSeo('content') != '') { ?>
    <div class="row ">
        <div class="col basis-full">
            <div class="wrapper-toc mt-4  ">
                <div class="content zoom-detail <?= $class ?> ">
                    <?= $func->htmlDecodeContent($seo->getSeo('content')) ?>
                </div>
            </div>
        </div>
        <div class="detail col">
            <?= $this->getTemplateLayoutsFor([
                'name_layouts' => 'shareLinks',
            ]) ?>
        </div>
    </div>
<?php } ?>