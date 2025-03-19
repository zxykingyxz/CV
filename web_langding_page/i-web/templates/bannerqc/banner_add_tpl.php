<?php

$options = (isset($item['options']) && $item['options'] != '') ? json_decode($item['options'], true) : null;

?>

<link href="plugin/sumoselect/sumoselect.css" rel="stylesheet" />

<script src="plugin/sumoselect/jquery.sumoselect.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $('.chonngonngu li a').click(function(event) {

            var lang = $(this).attr('href');

            $('.chonngonngu li a').removeClass('active');

            $(this).addClass('active');

            $('.lang_hidden').removeClass('active');

            $('.lang_' + lang).addClass('active');

            return false;

        });

    });
</script>

<div class="wrapper">

    <div class="control_frm">

        <div class="bc">

            <ul id="breadcrumbs" class="breadcrumbs">

                <li><a href="index.html?com=bannerqc&act=capnhat<?php if ($_REQUEST['type'] != '') echo '&type=' . $_REQUEST['type']; ?>"><span><?= $GLOBAL[$com][$type]['title'] ?></span></a>

                </li>

                <li class="current"><a href="" title=""><span><?= $GLOBAL[$com][$type]['title_main'] ?></span></a></li>

            </ul>

            <div class="clear"></div>

        </div>

    </div>

    <form name="supplier" class="form" action="index.html?com=bannerqc&act=save<?php if ($_REQUEST['type'] != '') echo '&type=' . $_REQUEST['type']; ?>" method="post" enctype="multipart/form-data">

        <div class="mtop0">

            <div class="oneOne">

                <div class="widget mtop0">

                    <div class="title chonngonngu" style="border-bottom: 0px solid transparent">

                        <ul>

                            <?php foreach ($config['lang'] as $k => $v) { ?>

                                <li><a href="<?= $k ?>" class="<?= ($k == 'vi') ? 'active' : '' ?> tipS" title="<?= $v ?>"><img src="./images/<?= $k ?>.png" alt="" class="<?= $func->changeTitle($v) ?>" /><?= $v ?></a>

                                </li>

                            <?php } ?>

                        </ul>

                    </div>

                </div>

            </div>

            <div class="oneOne">

                <div class="widget mtop0">

                    <?php
                    foreach ($config['lang'] as $k => $v) { ?>

                        <?php if ($GLOBAL[$com][$type]['ten'] == true) { ?>

                            <div class="formRow lang_hidden lang_<?= $k ?> <?= ($k == 'vi') ? 'active' : '' ?>">

                                <label><?= _ten ?> [<?= $v ?>]:</label>

                                <div class="formRight">

                                    <input type="text" name="data[ten_<?= $k ?>]" title="Nhập ten_<?= $k ?>" id="ten_<?= $k ?>" class="tipS" value="<?= @$item['ten_' . $k] ?>" />

                                </div>

                                <div class="clear"></div>

                            </div>

                        <?php } ?>

                        <?php if ($GLOBAL[$com][$type]['text'] == true) { ?>

                            <div class="formRow lang_hidden lang_<?= $k ?> <?= ($k == 'vi') ? 'active' : '' ?>">

                                <label>Text [<?= $v ?>]:</label>

                                <div class="formRight">

                                    <input type="text" name="data[text_<?= $k ?>]" title="Nhập text_<?= $k ?>" id="text_<?= $k ?>" class="tipS" value="<?= @$item['text_' . $k] ?>" />

                                </div>

                                <div class="clear"></div>

                            </div>

                        <?php } ?>

                        <?php if ($GLOBAL[$com][$type]['slogan'] == true) { ?>

                            <div class="formRow lang_hidden lang_<?= $k ?> <?= ($k == 'vi') ? 'active' : '' ?>">

                                <label>Slogan [<?= $v ?>]:</label>

                                <div class="formRight">

                                    <input type="text" name="data[slogan_<?= $k ?>]" title="Nhập slogan_<?= $k ?>" id="slogan_<?= $k ?>" class="tipS" value="<?= @$item['slogan_' . $k] ?>" />

                                </div>

                                <div class="clear"></div>

                            </div>

                        <?php } ?>


                    <?php } ?>

                    <?php if ($GLOBAL[$com][$type]['link'] == true) { ?>

                        <div class="formRow">

                            <label>Link:</label>

                            <div class="formRight">

                                <input type="text" name="data[link]" title="Nhập link" id="link" class="tipS" value="<?= @$item['link'] ?>" />

                            </div>

                            <div class="clear"></div>

                        </div>

                    <?php } ?>
                    <?php if ($GLOBAL[$com][$type]['address'] == true) { ?>
                        <div class="formRow">
                            <label>Địa chỉ:</label>
                            <div class="formRight">
                                <input type="text" name="data[address]" title="Nhập address" id="address" class="tipS" value="<?= @$item['address'] ?>" />
                            </div>
                            <div class="clear"></div>
                        </div>
                    <?php } ?>
                    <?php if ($GLOBAL[$com][$type]['phone'] == true) { ?>
                        <div class="formRow">
                            <label>Số Điện Thoại:</label>
                            <div class="formRight">
                                <input type="text" name="data[phone]" title="Nhập phone" id="phone" class="tipS" value="<?= @$item['phone'] ?>" />
                            </div>
                            <div class="clear"></div>
                        </div>
                    <?php } ?>
                    <?php if ($GLOBAL[$com][$type]['email'] == true) { ?>
                        <div class="formRow">
                            <label>Email:</label>
                            <div class="formRight">
                                <input type="text" name="data[email]" title="Nhập email" id="email" class="tipS" value="<?= @$item['email'] ?>" />
                            </div>
                            <div class="clear"></div>
                        </div>
                    <?php } ?>
                    <?php if ($GLOBAL[$com][$type]['width_img'] == true) { ?>

                        <div class="formRow">

                            <label>Chiều rộng hình (px):</label>

                            <div class="formRight">

                                <input type="text" name="data[width_img]" title="Nhập chiều rộng hình" id="width_img" class=" tipS" value="<?= @$item['width_img'] ?>" />

                            </div>

                            <div class="clear"></div>

                        </div>

                    <?php } ?>
                    <?php if ($GLOBAL[$com][$type]['height_img'] == true) { ?>

                        <div class="formRow">

                            <label>Chiều dài hình (px):</label>

                            <div class="formRight">

                                <input type="text" name="data[height_img]" title="Nhập chiều dài hình" id="height_img" class=" tipS" value="<?= @$item['height_img'] ?>" />

                            </div>

                            <div class="clear"></div>

                        </div>

                    <?php } ?>

                    <?php if ($GLOBAL[$com][$type]['iframe'] == true) { ?>

                        <div class="formRow">

                            <label>Iframe</label>

                            <div class="formRight">

                                <input type="text" name="data[iframe]" title="Nhập chiều dài hình" id="iframe" class=" tipS" value="<?= @$item['iframe'] ?>" />

                            </div>

                            <div class="clear"></div>

                        </div>

                    <?php } ?>

                    <?php foreach ($config['lang'] as $k => $v) { ?>

                        <?php if ($GLOBAL[$com][$type]['mota'] == true) { ?>

                            <div class="formRow lang_hidden lang_<?= $k ?> <?= ($k == 'vi') ? 'active' : '' ?>">

                                <label><?= _mota ?> [<?= $v ?>] <?php if ($type == 'title_register') { ?> <span style="color:red;">(Ví dụ: Giá trị ; Giá trị)</span> <?php } ?></label>

                                <div class="ck_editor">

                                    <textarea title="Nhập mô tả [<?= $v ?>]. " data-height="400" id="mota_<?= $k ?>" <?= ($GLOBAL[$com][$type]['mota-ckeditor'] == true) ? 'class="ck_editors"' : 'rows="8"' ?> name="data[mota_<?= $k ?>]"><?= @$item['mota_' . $k] ?></textarea>

                                </div>

                                <div class="clear"></div>

                            </div>

                        <?php } ?>

                    <?php } ?>
                    <?php if ($GLOBAL[$com][$type]['category_img'] == true) { ?>

                        <div class="formRow">

                            <label>Chọn dạng video hay hình ảnh:</label>

                            <div class="formRight">

                                <select name="data[category_img]">

                                    <option value="">Chọn dạng video hay hình ảnh</option>

                                    <option value="1" <?php if ($item['category_img'] == 1) echo 'selected'; ?>>Dạng hinh ảnh
                                    </option>
                                    <option value="2" <?php if ($item['category_img'] == 2) echo 'selected'; ?>>Dạng video
                                    </option>
                                    <option value="3" <?php if ($item['category_img'] == 3) echo 'selected'; ?>>Dạng hình ảnh lấy link video
                                    </option>
                                </select>

                            </div>

                            <div class="clear"></div>

                        </div>

                    <?php } ?>
                    <?php if ($GLOBAL[$com][$type]['link_video'] == true) { ?>
                        <?php if ($_GET['act'] == 'capnhat') { ?>
                            <div class="formRow">
                                <label>Video hiện tại :</label>
                                <div class="formRight">
                                    <object width="300" height="200">
                                        <param name="movie" value="//www.youtube.com/v/<?= $func->getYoutube($item['link_video']) ?>?version=3&amp;hl=vi_VN&amp;rel=0">
                                        </param>
                                        <param name="allowFullScreen" value="true">
                                        </param>
                                        <param name="allowscriptaccess" value="always">
                                        </param><embed src="//www.youtube.com/v/<?= $func->getYoutube($item['link_video']) ?>?version=3&amp;hl=vi_VN&amp;rel=0" type="application/x-shockwave-flash" width="300" height="200" allowscriptaccess="always" allowfullscreen="true" wmode="transparent"></embed>
                                    </object>

                                </div>
                                <div class="clear"></div>
                            </div>
                        <?php } ?>
                        <div class="formRow">
                            <div class="formRight">
                                <label>Link video youtube</label>
                                <input type="text" name="data[link_video]" title="Nhập tên links youtobe" id="ten_en" class="tipS validate[required]" value="<?= @$item['link_video'] ?>" />
                            </div>
                            <div class="clear"></div>
                        </div>
                    <?php } ?>

                    <?php if ($GLOBAL[$com][$type]['img'] == true) { ?>

                        <?php $duoihinh = $func->getDuoiHinh(_upload_hinhanh . $item["photo"]); ?>
                        <div class="formRow ">

                            <label>Tải file:</label>

                            <div class="formRight">

                                <input type="file" id="file" name="file_<?= $k ?>" />

                                <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">

                                <br />

                                <br />

                                <span style="display: inline-block; line-height: 30px;color:#CCC;">

                                    Mặc định Width: <?= $GLOBAL[$com][$type]['img-width'] * $GLOBAL[$com][$type]['img-ratio'] ?>px -

                                    <?= $GLOBAL[$com][$type]['img-height'] * $GLOBAL[$com][$type]['img-ratio'] ?>px

                                </span>

                            </div>

                            <div class="clear"></div>

                        </div>
                        <?php if ($item["photo"] != '') { ?>

                            <?php if ($duoihinh == 'jpg' || $duoihinh == 'png' || $duoihinh == 'jpeg' || $duoihinh == 'gif' || $duoihinh == 'svg' || $duoihinh == 'webp') { ?>

                                <div class="formRow ">

                                    <label><?= _hinhanh ?> hiện tại :</label>

                                    <div class="formRight">

                                        <div class="mt10 change-photo">

                                            <?php $pathImg = $GLOBAL[$com][$type]['watermark'] == true ? _thumbs . '/' . $GLOBAL[$com][$type]['thumb'] . '/' . _upload_hinhanh_l . @$item["photo"] : _upload_hinhanh . $item["photo"] ?>

                                            <img style="max-width:200px;width: 100%;" src="<?= $pathImg ?>" alt="">

                                        </div>

                                    </div>

                                    <div class="clear"></div>

                                </div>

                            <?php } else { ?>
                                <div class="formRow lang_hidden lang_<?= $k ?> <?= ($k == 'vi') ? 'active' : '' ?>">
                                    <label>Video hiện tại</label>
                                    <div class="formRight">
                                        <video width="300" height="200" autoplay muted controls>
                                            <source src="<?= _upload_hinhanh . @$item["photo"] ?>" type="video/mp4">
                                        </video>
                                    </div>
                                    <div class="clear"></div>
                                </div>

                            <?php } ?>
                        <?php } ?>


                    <?php } ?>
                    <?php if ($GLOBAL[$com][$type]['photo2'] == true) { ?>
                        <div class="formRow lang_hidden lang_<?= $k ?>  <?= ($k == 'vi') ? 'active' : '' ?>">
                            <label>Tải hình ảnh background:</label>
                            <div class="formRight">
                                <?php if ($_GET['act'] == 'capnhat' || $_GET['act'] == 'copy') { ?>

                                    <input type="file" id="filephu" name="filephu" />

                                <?php } else { ?>

                                    <input data-validation="required" data-validation-allowing="jpg, png" data-validation-max-size="300kb" data-validation-error-msg-required="Bạn chưa chọn file" type="file" id="filephu" name="filephu" />

                                <?php } ?>
                                <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
                                <br />
                                <br />
                                <span style="display: inline-block; line-height: 30px;color:#CCC;">
                                    Width: <?= $GLOBAL[$com][$type]['img-width-bg'] * $GLOBAL[$com][$type]['img-ratio'] ?>px - Height:
                                    <?= $GLOBAL[$com][$type]['img-height-bg'] * $GLOBAL[$com][$type]['img-ratio'] ?>px
                                </span>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow lang_hidden lang_<?= $k ?>  <?= ($k == 'vi') ? 'active' : '' ?>">
                            <label>Hình Hiện Tại :</label>
                            <div class="formRight">
                                <div class="mt10"><img src="<?= $folder . $item['photo2'] ?>" alt="NO PHOTO" width="300" /></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    <?php } ?>
                    <?php if ($GLOBAL[$com][$type]['option'] == true) { ?>

                        <div class="formRow">

                            <label>Chọn vị trí hiển thị:</label>

                            <div class="formRight">

                                <select name="options[]" class="main_select multiselect-info" multiple="multiple" style="max-width:300px">

                                    <?php

                                    $arr = json_decode($item['options'], true);

                                    foreach ($config['popup'] as $k => $v) { ?>

                                        <option value="<?= $k ?>" <?= (in_array($k, $arr)) ? 'selected' : '' ?>><?= $v ?></option>

                                    <?php } ?>

                                </select>

                            </div>

                            <div class="clear"></div>

                        </div>

                    <?php } ?>

                    <?php if ($GLOBAL[$com][$type]['time'] == true) { ?>

                        <div class="formRow">

                            <label>Thời gian hiển thị:</label>

                            <div class="formRight">

                                <select name="time_out" class="main_select" style="max-width:300px">

                                    <?php for ($i = 1; $i <= 10; $i++) { ?>

                                        <option value="<?= $i * 1000 ?>" <?= ($item['time_out'] == $i * 1000) ? 'selected' : '' ?>><?= $i ?>

                                            phút</option>

                                    <?php } ?>

                                </select>

                            </div>

                            <div class="clear"></div>

                        </div>

                    <?php } ?>

                    <?php if ($GLOBAL[$com][$type]['count'] == true) { ?>

                        <div class="formRow">

                            <label>Số lần hiển thị:</label>

                            <div class="formRight">

                                <select name="data[count]" class="main_select" style="max-width:300px">

                                    <?php for ($i = 1; $i <= 10; $i++) { ?>

                                        <option value="<?= $i ?>" <?= ($item['count'] == $i) ? 'selected' : '' ?>><?= $i ?> lần</option>

                                    <?php } ?>

                                </select>

                            </div>

                            <div class="clear"></div>

                        </div>

                    <?php } ?>
                    <div class="formRow">
                        <div class="formRight">
                            <?php if (isset($GLOBAL[$com][$type]['watermark-advanced']) && $GLOBAL[$com][$type]['watermark-advanced'] == true) { ?>

                                <?php

                                $tl = (isset($options) && $options != null && $options['watermark']['position'] == 1 || !isset($options['watermark']['position'])) ? 'checked' : '';

                                $tc = (isset($options) && $options != null && $options['watermark']['position'] == 2) ? 'checked' : '';

                                $tr = (isset($options) && $options != null && $options['watermark']['position'] == 3) ? 'checked' : '';

                                $mr = (isset($options) && $options != null && $options['watermark']['position'] == 4) ? 'checked' : '';

                                $br = (isset($options) && $options != null && $options['watermark']['position'] == 5) ? 'checked' : '';

                                $bc = (isset($options) && $options != null && $options['watermark']['position'] == 6) ? 'checked' : '';

                                $bl = (isset($options) && $options != null && $options['watermark']['position'] == 7) ? 'checked' : '';

                                $ml = (isset($options) && $options != null && $options['watermark']['position'] == 8) ? 'checked' : '';

                                $cc = (isset($options) && $options != null && $options['watermark']['position'] == 9) ? 'checked' : '';

                                $watermark = _thumbs . '/' . $GLOBAL[$com][$type]['thumb'] . '/' . _upload_hinhanh_l . @$item["photo"];

                                ?>

                                <div class="row d-flex pt10">

                                    <div class="col-4 pr15">

                                        <div class="item col-12">

                                            <label>Vị trí đóng dấu:</label>

                                            <div class="clear"></div>

                                            <div class="watermark-position rounded">

                                                <label for="tl">

                                                    <input type="radio" name="data[options][watermark][position]" id="tl" value="1" <?= $tl ?>>

                                                    <img class="rounded" onerror="src='images/noimage.png'" src="<?= ($tl) ? $watermark : '' ?>" alt="watermark-cover">

                                                </label>

                                                <label for="tc">

                                                    <input type="radio" name="data[options][watermark][position]" id="tc" value="2" <?= $tc ?>>

                                                    <img class="rounded" onerror="src='images/noimage.png'" src="<?= ($tc) ? $watermark : '' ?>" alt="watermark-cover">

                                                </label>

                                                <label for="tr">

                                                    <input type="radio" name="data[options][watermark][position]" id="tr" value="3" <?= $tr ?>>

                                                    <img class="rounded" onerror="src='images/noimage.png'" src="<?= ($tr) ? $watermark : '' ?>" alt="watermark-cover">

                                                </label>

                                                <label for="mr">

                                                    <input type="radio" name="data[options][watermark][position]" id="mr" value="4" <?= $mr ?>>

                                                    <img class="rounded" onerror="src='images/noimage.png'" src="<?= ($mr) ? $watermark : '' ?>" alt="watermark-cover">

                                                </label>

                                                <label for="br">

                                                    <input type="radio" name="data[options][watermark][position]" id="br" value="5" <?= $br ?>>

                                                    <img class="rounded" onerror="src='images/noimage.png'" src="<?= ($br) ? $watermark : '' ?>" alt="watermark-cover">

                                                </label>

                                                <label for="bc">

                                                    <input type="radio" name="data[options][watermark][position]" id="bc" value="6" <?= $bc ?>>

                                                    <img class="rounded" onerror="src='images/noimage.png'" src="<?= ($bc) ? $watermark : '' ?>" alt="watermark-cover">

                                                </label>

                                                <label for="bl">

                                                    <input type="radio" name="data[options][watermark][position]" id="bl" value="7" <?= $bl ?>>

                                                    <img class="rounded" onerror="src='images/noimage.png'" src="<?= ($bl) ? $watermark : '' ?>" alt="watermark-cover">

                                                </label>

                                                <label for="ml">

                                                    <input type="radio" name="data[options][watermark][position]" id="ml" value="8" <?= $ml ?>>

                                                    <img class="rounded" onerror="src='images/noimage.png'" src="<?= ($ml) ? $watermark : '' ?>" alt="watermark-cover">

                                                </label>

                                                <label for="cc">

                                                    <input type="radio" name="data[options][watermark][position]" id="cc" value="9" <?= $cc ?>>

                                                    <img class="rounded" onerror="src='images/noimage.png'" src="<?= ($cc) ? $watermark : '' ?>" alt="watermark-cover">

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="item col-8">

                                        <div class="row d-flex flex-wrap">

                                            <div class="item col-12 mb15">

                                                <label>Độ trong suốt:</label>

                                                <input type="text" class="form-control " name="data[options][watermark][opacity]" placeholder="70" value="<?= $options['watermark']['opacity'] ?>">

                                            </div>

                                            <div class="item col-12 mb15">

                                                <label>Tỉ lệ:</label>

                                                <input type="text" class="form-control " name="data[options][watermark][per]" placeholder="2" value="<?= (isset($options['watermark']['per']) && $options['watermark']['per'] != '') ? $options['watermark']['per'] : '' ?>">

                                            </div>

                                            <div class="item col-12 mb15">

                                                <label>Tỉ lệ < 300px:</label>

                                                        <input type="text" class="form-control " name="data[options][watermark][small_per]" placeholder="3" value="<?= (isset($options['watermark']['small_per']) && $options['watermark']['small_per'] != '') ? $options['watermark']['small_per'] : '' ?>">

                                            </div>

                                            <div class="item col-12 mb15">

                                                <label>Kích thước tối đa:</label>

                                                <input type="text" class="form-control " name="data[options][watermark][max]" placeholder="600" value="<?= (isset($options['watermark']['max']) && $options['watermark']['max'] != '') ? $options['watermark']['max'] : '' ?>">

                                            </div>

                                            <div class="item col-12 mb15">

                                                <label>Kích thước tối thiểu:</label>

                                                <input type="text" class="form-control " name="data[options][watermark][min]" placeholder="100" value="<?= (isset($options['watermark']['min']) && $options['watermark']['min'] != '') ? $options['watermark']['min'] : '' ?>">

                                            </div>

                                        </div>

                                    </div>

                                <?php } ?>



                                </div>



                        </div>



                        <div class="formRow">

                            <div class="formRight">

                                <label class="stardust-checkbox">

                                    Hiển thị

                                    <input class="stardust-checkbox__input" <?= (!isset($item['hienthi']) || $item['hienthi'] == 1) ? 'checked="checked"' : '' ?> name="hienthi" type="checkbox" value="1" style="display:none">

                                    <div class="stardust-checkbox__box"></div>

                                </label>

                            </div>

                        </div>



                    </div>

                </div>

            </div>

            <input type="hidden" name="type" value="<?= $_GET['type'] ?>">

            <div class="formRow fixedBottom sidebar-bunker">

                <div class="formRight">

                    <div class="box-admin" style="display:flex; align-items:center;justify-content:flex-end">

                        <div class="box-action">

                            <button type="submit" class="btn btn-sm bg-gradient-primary text-white submit-check">

                                <i class="far fa-save mr-2"></i>Lưu

                            </button>

                            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm

                                lại</button>

                        </div>

                    </div>

                </div>

                <div class="clear"></div>

            </div>

    </form>

</div>

<script type="text/javascript">
    $(document).ready(function() {

        window.asd = $('.multiselect-info').SumoSelect({

            placeholder: 'Chọn vị trí hiển thị',

            csvDispCount: 3,

            captionFormat: '{0} Selected',

            floatWidth: 500,

            forceCustomRendering: false,

            triggerChangeCombined: true,

            selectAll: true,

            search: true,

            searchText: 'Search...',

            noMatch: 'No matches for "{0}"',

            prefix: '',

            locale: ['OK', 'Cancel', 'Select All'],

            up: 'false',

            showTitle: 'true',

        });

    });
</script>