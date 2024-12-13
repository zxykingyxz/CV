<div class="col l-3 m-4 c-12">

    <?php if (count($tintuc) > 0) { ?>

        <div class="wrapper-featured__news wrapper-featured__author mt30">

            <div class="sidebar__head">

                <span><i class="fa fa-caret-right" aria-hidden="true"></i>&nbsp;Tác giả khác</span>

            </div>

            <ul class="wrapper-featured__news-list">

                <?php foreach ($tintuc as $key => $value) { ?>

                    <li class="wrapper-featured__news-item mb20">

                        <a href="<?= $func->slugUrl($value) ?>" aria-label="<?= $value["ten_$lang"] ?>" title="<?= $value["ten_$lang"] ?>" class="wrapper-featured__news-link" role="link" rel="dofollow">

                            <div class="wrapper-featured__news-img">

                                <span class="d-block cubic-img hover-left">

                                    <?= $func->addHrefImg([
                                        'classfix' => 'cubic-img d-block hover-left ratio-cover ratio-img w100',
                                        'addhref' => true,
                                        'href' =>  $jv0,
                                        'sizes' => '120x84x1',
                                        // 'isWatermark' => 'true',
                                        // 'prefix' => 'product',
                                        'upload' => _upload_baiviet_l,
                                        'image' => ($value["photo"]),
                                        'alt' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
                                    ]); ?>
                                </span>

                            </div>

                            <div class="wrapper-featured__news-info">

                                <div class="wrapper-featured__news-info-title line-3">

                                    <span><?= $value["ten_$lang"] ?></span>

                                </div>

                                <div class="wrapper-featured__news-info-job line-3">

                                    <span><?= $value["job_$lang"] ?></span>

                                </div>

                                <div class="wrapper-featured__news-info-date">

                                    <span><i class="fa-light fa-calendar-clock mr5"></i>
                                        <?= ($value["ngaysua"] != 0) ? date('d/m/Y', $value["ngaysua"]) : date('d/m/Y', $value["ngaytao"]) ?>
                                    </span>

                                </div>

                            </div>

                        </a>

                    </li>

                <?php } ?>

            </ul>

        </div>

    <?php } ?>

    <?php /*<div class="baogia-aside">

        <div class="baogia">

            <span>Đăng ký báo giá</span>

            <div class="box area-baogia">

                <input type="text" name="fullname2" autocomplete="off" class="input-baogia mb20" placeholder="Họ và tên * ">

                <input type="text" name="email2" autocomplete="off" class="input-baogia mb20" placeholder="Email">

                <input type="text" name="phone2" autocomplete="off" class="input-baogia mb20" placeholder="Số điện thoại * ">

                <textarea type="text" name="content2" autocomplete="off" class="input-baogia" placeholder="Nội dung"></textarea>

                <div class="d-flex justify-content-center">

                    <button type="button" class="btn-baogia">Gửi ngay</button>

                </div>

            </div>

        </div>

    </div> */ ?>

</div>