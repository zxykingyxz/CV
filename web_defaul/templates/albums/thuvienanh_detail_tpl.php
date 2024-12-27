<?php

$photos = $db->rawQuery("select id,photo from #_baiviet_photo where type=? and id_baiviet=? order by stt asc, id desc", array($row_detail["type"], $row_detail["id"]));

?>

<?php if ($banner_tpl) { ?>

    <section class="packaging-banner__allpage p-relative" style="background:url('<?= _upload_hinhanh_l . $banner_tpl["photo"] ?>') no-repeat center center/cover;background-attachment: fixed;">

        <div class="packaging-title__tpl">

            <h1 class="mg0">

                <span>

                    <?= $seo->getSeo('h1') ?>

                </span>

            </h1>

        </div>

        <div class="packaging-banner__breadcumb">

            <div class="grid_s wide">

                <div class="row">

                    <div class="col l-12 m-12 c-12">

                        <div class="breadcumb">

                            <?= $str_breadcrumbs ?>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

<?php } ?>

<section class="wrapper-album-detail mt-m-20 mb-m-10 mt-t-40 mt80">

    <div class="grid_s wide">

        <div class="row">

            <?php if (count($photos) > 0) { ?>

                <?php foreach ($photos as $key => $value) { ?>

                    <div class="col l-4 m-4 c-6 mb20 mb-m-8">

                        <div class="wrapper-album-detail__box">

                            <a href="<?= _upload_baiviet_l . $value["photo"] ?>" title="<?= $row_detail["ten_$lang"] ?>" aria-label="<?= $row_detail["ten_$lang"] ?>" role="button" rel="nofollow" data-fancybox="album-detail" class="d-block ratio-cover ratio-img" img-width="387" img-height="289">

                                <img width="387" height="289" data-src="<?= _upload_baiviet_l . $value["photo"] ?>" src="<?= $imgDefault ?>" alt="<?= $row_detail["ten_$lang"] ?>" class="ratio-img__content img-scale">

                                <div class="packaging-template__customers-overplay">

                                    <div class="packaging-template__customers-overplay-glass"><i class="fa-regular fa-magnifying-glass-plus"></i></div>

                                </div>

                            </a>

                        </div>

                    </div>

                <?php } ?>

            <?php } else { ?>

                <div class="col l-12 m-12 c-12">

                    <p class="t-center">Hình ảnh thư viện đang được cập nhật...</p>

                </div>

            <?php } ?>

        </div>

    </div>

</section>