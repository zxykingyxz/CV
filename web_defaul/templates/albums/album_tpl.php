<?php if ($banner_tpl) { ?>

    <section class="starceiling-banner__allpage p-relative" style="background:url('<?= _upload_hinhanh_l . $banner_tpl["photo"] ?>') no-repeat center center/cover;background-attachment: fixed;">

        <div class="starceiling-title__tpl">

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

        <div class="starceiling-banner__breadcumb">

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

        <div class="mt30 mt-m-20">

            <div class="row">

                <div class="col l-12 m-12 c-12">

                    <?php if (count($tintuc) > 0) { ?>

                        <div class="row mb20">

                            <?php foreach ($tintuc as $k => $v) {
                                $photos = $db->rawQuery("select photo,ten from #_baiviet_photo where id_baiviet=? order by stt asc,id desc", array($v['id']));
                            ?>
                                <?php /* <div class="col l-2-4 m-3 c-6 mb20 mb-m-8">
                                <div class="section-img-video__box p-relative">
                                    <div class="images">
                                        <a data-fancybox="album<?=$k?>" data-caption="<?=$v["ten_$lang"]?>" href="<?=_upload_baiviet_l.$v["photo"]?>" title="<?=$v["ten_$lang"]?>" class="d-block hover-left cubic-img ratio-cover ratio-img" img-width="286" img-height="365">
                                            <img loading="lazy" class="ratio-img__content img-scale" width="286" height="365" data-src="<?=_upload_baiviet_l.$v["photo"]?>" src="<?=$imgDefault?>" alt="<?=$v["ten_$lang"]?>">                                   
                                        </a> 
                                    </div>
                                    <div class="title p-absolute">
                                        <span><?=$v["ten_$lang"]?></span>
                                    </div> 
                                    <?php foreach($photos as $key => $value){?>
                                        <a href="<?= _upload_baiviet_l.$value['photo']?>" data-fancybox="album<?=$k?>" data-caption="<?=$v["ten_$lang"]?>"></a>
                                    <?php }?>
                                </div>
                            </div> */ ?>

                                <div class="col l-4 m-4 c-12 mb20">
                                    <div class="section-album__box p-relative o-hidden">
                                        <div class="section-album__box-images">
                                            <a data-fancybox="album<?= $k ?>" href="<?= _upload_baiviet_l . $v["photo"] ?>" title="<?= $v["ten_$lang"] ?>" class="d-block ratio-cover ratio-img" role="link" rel="dofollow" img-width="380" img-height="280">
                                                <img class="ratio-img__content img-scale" width="380" height="280" data-src="<?= _upload_baiviet_l . $v["photo"] ?>" src="<?= $imgDefault ?>" alt="<?= $v["ten_$lang"] ?>">
                                            </a>
                                        </div>
                                        <div class="section-album__box-detail p-absolute">
                                            <div class="section-album__box-bg p-relative pr30">
                                                <div class="title line-2">
                                                    <a href="javascript:void(0)" title="<?= $v["ten_$lang"] ?>"><?= $v["ten_$lang"] ?></a>
                                                </div>
                                                <div class="icon p-absolute">
                                                    <a data-fancybox="albums<?= $k ?>" href="<?= _upload_baiviet_l . $v["photo"] ?>" title="<?= $v["ten_$lang"] ?>"><i class="fa-regular fa-arrow-up-right-from-square"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php foreach ($photos as $key => $value) { ?>
                                            <a href="<?= _upload_baiviet_l . $value['photo'] ?>" data-fancybox="album<?= $k ?>"></a>
                                        <?php } ?>
                                        <?php foreach ($photos as $key => $value) { ?>
                                            <a href="<?= _upload_baiviet_l . $value['photo'] ?>" data-fancybox="albums<?= $k ?>"></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>

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