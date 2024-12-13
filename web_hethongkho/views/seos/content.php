<?php if ($seo->getSeo('content') != '') { ?>
    <div class="row <?= $class ?>">
        <div class="col basis-full">
            <div class="wrapper-toc mt-4 ">
                <div class="content ">
                    <?= $func->htmlDecodeContent($seo->getSeo('content')) ?>
                </div>
            </div>
        </div>
        <div class="detail col">

            <?php include_once _source . 'shareLinks.php' ?>

        </div>
    </div>
<?php } ?>