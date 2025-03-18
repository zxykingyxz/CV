<div class="row <?= $class_form ?>">
    <?php if ($seo->getSeo('subject') != '') { ?>
        <div class="col basis-full ">
            <div class="box-description mt-8">
                <span><?= $func->htmlDecodeContent($seo->getSeo('subject')) ?></span>
            </div>
        </div>
    <?php } ?>
</div>