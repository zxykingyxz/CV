<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
            <li><a href="index.html?com=photo&act=man"><span><?= $GLOBAL[$com][$type]['title'] ?></span></a></li>
            <li class="current"><a href="#" onclick="return false;">Sửa <?= $GLOBAL[$com][$type]['title_main'] ?></a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">
    function TreeFilterChanged2() {
        $('#validate').submit();
    }
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
<form name="supplier" class="form" id="form-validate" action="index.html?com=photo&act=save<?php if ($_GET['id'] != '') echo '&id=' . $_GET['id']; ?><?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?><?php if ($_GET['page'] != '') echo '&page=' . $_GET['page']; ?>" method="post" enctype="multipart/form-data" autocomplete="off" accept-charset="utf-8">
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
                <?php foreach ($config['lang'] as $k => $v) { ?>
                    <div class="formRow lang_hidden lang_<?= $k ?> <?= ($k == 'vi') ? 'active' : '' ?>">
                        <label><?= _tieude ?> [<?= $v ?>]</label>
                        <div class="formRight">
                            <input type="text" name="data[ten_<?= $k ?>]" title="Nhập tên" id="ten_<?= $k ?>" class="tipS validate[required]" value="<?= @$item['ten_' . $k] ?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php if ($GLOBAL[$com][$type]['img'] == true) {
                    ?>
                        <div class="formRow lang_hidden lang_<?= $k ?>  <?= ($k == 'vi') ? 'active' : '' ?>">
                            <label><?= _uploadhinhanh ?>:</label>
                            <div class="formRight">
                                <input type="file" id="file_<?= $k ?>" name="file_<?= $k ?>" />
                                <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
                                <span style="display: inline-block; line-height: 30px;color:#CCC;">
                                    Width: <?= $GLOBAL[$com][$type]['img-width'] * $GLOBAL[$com][$type]['img-ratio'] ?>px - Height:
                                    <?= $GLOBAL[$com][$type]['img-height'] * $GLOBAL[$com][$type]['img-ratio'] ?>px
                                </span>
                                <?php if ($_GET["type"] == 'catalogy') { ?>
                                    <span style="color:#f00">(Nếu chọn slider danh mục chiều cao và chiều rộng để auto)</span>
                                <?php } ?>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow lang_hidden lang_<?= $k ?>  <?= ($k == 'vi') ? 'active' : '' ?>">
                            <label>Ảnh [<?= $v ?>] hiện Tại :</label>
                            <div class="formRight">
                                <div class="mt10"><img src="<?= _upload_hinhanh . $item['photo'] ?>" alt="NO PHOTO" width="100" /></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                    <?php } ?>
                <?php } ?>
                <?php if ($GLOBAL[$com][$type]['numb'] == true) { ?>
                    <div class="formRow lang_hidden lang_<?= $k ?> <?= ($k == 'vi') ? 'active' : '' ?>">
                        <label>Number</label>
                        <div class="formRight">
                            <input type="text" data-validation="required" data-validation-error-msg="Số không được bỏ trống" name="data[number]" title="Nhập tên danh mục" id="number" class="conso tipS validate[required]" value="<?= @$item['number'] ?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>
                <?php if ($GLOBAL[$com][$type]['slogan'] == true) { ?>
                    <div class="formRow">
                        <label>Slogan</label>
                        <div class="formRight">
                            <input type="text" id="slogan" name="data[slogan]" value="<?= $item["slogan"] ?>" title="Nhập link liên kết cho hình ảnh" class="tipS" />
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>
                <?php if ($GLOBAL[$com][$type]['link'] == true) { ?>
                    <div class="formRow">
                        <label>Link liên kết: </label>
                        <div class="formRight">
                            <input type="text" id="price" name="data[link]" value="<?= @$item['link'] ?>" title="Nhập link liên kết cho hình ảnh" class="tipS" />
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>
                <?php foreach ($config['lang'] as $k => $v) { ?>
                    <?php if ($GLOBAL[$com][$type]['mota'] == true) { ?>
                        <div class="formRow lang_hidden lang_<?= $k ?> <?= ($k == 'vi') ? 'active' : '' ?>">
                            <label>Mô tả [<?= $v ?>]</label>
                            <div class="ck_editor">
                                <textarea title="Nhập mô tả [<?= $v ?>]. " data-height="400" id="mota_<?= $k ?>" <?= ($GLOBAL[$com][$type]['mota-ckeditor'] == true) ? 'class="ck_editors"' : 'rows="8"' ?> name="data[mota_<?= $k ?>]"><?= @$item['mota_' . $k] ?></textarea>
                            </div>
                            <div class="clear"></div>
                        </div>
                    <?php } ?>
                <?php } ?>

                <div class="formRow">

                    <div class="formRight">
                        <label><?= _sothutu ?>: </label>
                        <input type="text" class="tipS" value="<?= isset($item['stt']) ? $item['stt'] : 1 ?>" name="data[stt]" style="width:40px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
                    </div>
                    <div class="clear"></div>
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
            <div class="clear"></div>
        </div>
    </div>
    <div class="formRow fixedBottom sidebar-bunker">
        <div class="formRight">
            <div class="box-admin" style="display:flex; align-items:center;justify-content:flex-end">
                <div class="box-action">
                    <button type="submit" class="btn btn-sm bg-gradient-primary text-white submit-check">
                        <i class="far fa-save mr-2"></i>Lưu
                    </button>
                    <button type="submit" class="btn btn-sm bg-gradient-success" name="save-here"><i class="far fa-save mr-2"></i>Lưu tại trang</button>
                    <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm
                        lại</button>
                    <a class="btn btn-sm bg-gradient-danger text-white" href="index.html?com=photo&act=man<?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?><?php if ($_GET['page'] != '') echo '&page=' . $_GET['page']; ?>">
                        <i class="fas fa-sign-out-alt mr-2"></i>Thoát
                    </a>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</form>