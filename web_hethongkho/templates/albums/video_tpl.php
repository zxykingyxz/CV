<?php if ($banner_tpl) { ?>

    <section class="packaging-banner__allpage p-relative" style="background:url('<?= _upload_hinhanh_l . $banner_tpl["photo"] ?>') no-repeat center center/cover;background-attachment: fixed;">

        <div class="packaging-title__tpl">

            <h1 class="mg0">

                <span>

                    <?php if ($seo->getSeo('h1') != "") { ?>
                        <?= $seo->getSeo('h1') ?>
                    <?php } else {
                        echo $title_seo;
                    } ?>

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

<section class="section-videos mt30 mb20 mt-m-10 mb-m-10">

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

        </div>

        <?php if ($seo->getSeo('subject') != '') { ?>

            <div class="row">

                <div class="col l-12 m-12 c-12">

                    <div class="box-description mt10">

                        <span><?= htmlspecialchars_decode($seo->getSeo('subject')) ?></span>

                    </div>

                </div>

            </div>

        <?php } ?>

        <div class="row mt30 mb30">

            <div class="col l-12 m-12 c-12 w-100-m w-100-t">

                <div class="row">

                    <?php if (count($tintuc) > 0) { ?>

                        <?php foreach ($tintuc as $k => $value) { ?>

                            <div class="col l-3 m-4 c-6 mb20 mb-t-16 mb-m-20 d-flex">

                                <div class="packaging-video__box" style="width: 100%">

                                    <?php

                                    $duoihinh = $func->getDuoiHinh(_upload_hinhanh_l . $value["photo"]);

                                    if ($duoihinh == 'jpg' || $duoihinh == 'jpeg' || $duoihinh == 'png' || $duoihinh == 'png') { ?>

                                        <div class="packaging-video__box-img">

                                            <a href="<?= $value["links"] ?>" role="button" rel="nofollow" title="<?= $value["ten_$lang"] ?>" aria-label="<?= $value["ten_$lang"] ?>" data-fancybox="videolist" class="d-block hover-left ratio-cover ratio-img" img-width="285" img-height="185">

                                                <img width="285" height="185" class="ratio-img__content img-scale" src="<?= $imgDefault ?>" data-src="<?= _upload_hinhanh_l . $value["photo"] ?>" alt="<?= $value["ten_$lang"] ?>">

                                                <span class="packaging-intro__right-img-playvideo">

                                                    <i class="fa-regular fa-play-pause"></i>

                                                </span>

                                            </a>

                                        </div>

                                    <?php } else { ?>

                                        <div class="packaging-video__box-list">

                                            <a class="d-block hover-left" href="javascript:void(0)" title="<?= $value["ten_$lang"] ?>" img-width="285" img-height="185">

                                                <iframe width="100%" id="framevideo" height="100%" style="aspect-ratio:16/9;max-width:100%;" allowfullscreen src="https://www.youtube.com/embed/<?= $func->getYoutube($value['links']) ?>">

                                                </iframe>

                                            </a>

                                            <?php /* <video class="packaging-video__box-list-music" autoplay playsinline muted controls >

                                            <source src="<?=_upload_hinhanh_l.$value["photo"]?>" type="video/mp4">

                                        </video> */ ?>

                                        </div>

                                    <?php } ?>

                                    <?php /* <div class="packaging-video__box-detail">

                                    <h3 class="packaging-video__box-detail-title line-2 t-center">

                                        <span><?=$value["ten_$lang"]?></span>

                                    </h3>

                                </div> */ ?>

                                </div>

                            </div>

                        <?php } ?>

                    <?php } else { ?>

                        <div class="col l-12 m-12 c-12 mt20 mb20">
                            <p class="t-center">Nội dung đang được cập nhật....</p>
                        </div>
                    <?php } ?>

                </div>

            </div>

            <?php /* if(!$func->isAjax()){?>

            <div class="col l-12 m-12 c-12 mb20">

                <div id="pagingPage"><?=$paging?></div>

            </div>

            <?php } */ ?>

        </div>

        <?php if ($seo->getSeo('content') != '') { ?>

            <div class="row">

                <div class="col l-12 m-12 c-12">

                    <div class="p-relative">

                        <div class="wrapper-toc mt10 mb20">

                            <div class="content ">

                                <?= htmlspecialchars_decode($seo->getSeo('content')) ?>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        <?php } ?>

    </div>

</section>