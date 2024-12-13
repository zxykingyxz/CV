<?php /* if($banner_tpl){ ?>

<section class="packaging-banner__allpage p-relative" style="background:url('<?=_upload_hinhanh_l.$banner_tpl["photo"]?>') no-repeat center center/cover;background-attachment: fixed;">

    <div class="packaging-title__tpl">

         <h1 class="mg0">

            <span>

                <?php if($seo->getSeo('h1') != ""){?>
                <?=$seo->getSeo('h1')?>
                <?php }else{ echo $title_seo;}?>

            </span>

        </h1>

    </div>

    <div class="packaging-banner__breadcumb">

        <div class="grid_s wide">

            <div class="row">

                <div class="col l-12 m-12 c-12">

                    <div class="breadcumb">

                        <?=$str_breadcrumbs?>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<?php } */ ?>

<section class="mt30 mt-m-20">

    <div class="grid_s wide">

        <div class="row">

            <div class="col l-12 m-12 c-12">

                <div class="title-default t-center mb20 p-relative">

                    <h1>

                        <span>

                            <?php if ($seo->getSeo('h1') != "") { ?>
                                <?= $seo->getSeo('h1') ?>
                            <?php } else {
                                echo $title_seo;
                            } ?>

                        </span>

                    </h1>

                </div>

            </div>

            <?php if ($seo->getSeo('subject') != '') { ?>

                <div class="col l-12 m-12 c-12">

                    <div class="box-description mt20">

                        <span><?= htmlspecialchars_decode($seo->getSeo('subject')) ?></span>

                    </div>

                </div>

            <?php } ?>

        </div>

        <div class="mt30 mt-m-20 mb50">

            <div class="row">

                <div class="col l-12 m-12 c-12">

                    <?php if (count($tintuc) > 0) { ?>

                        <div class="row">

                            <?php foreach ($tintuc as $k => $v) {
                                $photos = $db->rawQuery("select id,photo from #_baiviet_photo where type=? and id_baiviet=? order by stt asc, id desc", array($v["type"], $v["id"]));
                            ?>

                                <div class="col l-3 m-4 c-6 mb20 mb-m-8">
                                    <div class="section-album__box-images">
                                        <a data-fancybox="albums<?= $v['id'] ?>" href="<?= _upload_baiviet_l . $v["photo"] ?>" title="<?= $v["ten_$lang"] ?>" class="d-block hover-left cubic-img ratio-cover ratio-img" img-width="280" img-height="380">
                                            <img class="ratio-img__content" width="280" height="380" src="<?= _upload_baiviet_l . $v["photo"] ?>" alt="<?= $v["ten_$lang"] ?>">
                                            <div class="hidden">
                                                <?php foreach ($photos as $key => $value) { ?>
                                                    <a data-fancybox="albums<?= $v['id'] ?>" href="<?= _upload_baiviet_l . $value["photo"] ?>" title="<?= $v["ten_$lang"] ?>">
                                                        <img class="ratio-img__content" width="280" height="380" src="<?= _upload_baiviet_l . $value["photo"] ?>" alt="<?= $v["ten_$lang"] ?>">
                                                    </a>
                                                <?php } ?>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                        <?php if ($total_paging > 0 && $com != "room" && $com != "tim-kiem") { ?>
                            <div class="row">
                                <div class="col l-12 m-12 c-12 justify-content-center mb20 mt20">
                                    <div id="paging" class="t-center">
                                        <?= $func->getTemplateLayoutsFor(($com == 'khoa-hoc-noi-bat') ? $total_paging_list : $total_paging, $per_page, $page, $textButton) ?></div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>


                </div>

            </div>

            <?php if ($seo->getSeo('content') != '') { ?>

                <div class="row">

                    <div class="wrapper-toc mt10">

                        <div class="content ">

                            <?= htmlspecialchars_decode($seo->getSeo('content')) ?>

                        </div>

                    </div>

                </div>

            <?php } ?>

        </div>

    </div>

</section>