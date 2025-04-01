<?php if ($GLOBAL_LEVEL2[$com][$type]['seo'] == true) { ?>
    <script>
        function text_count_changed(textfield_id, counter_id) {
            var v = $(textfield_id).val();
            if (parseInt(v.length) > 300) {
                $(textfield_id).css('border', '1px solid #D90000');
                $(textfield_id).css('background', '#e5e5e5');
                $(counter_id).val(parseInt(v.length));
            } else {
                $(textfield_id).css('border', '1px solid #DDDDDD');
                $(textfield_id).css('background', '#FFF');
                $(counter_id).val(parseInt(v.length));
            }
        }
        $(document).ready(function() {
            text_count_changed("#description", "#des_char");
            $('#description').blur(function(event) {
                text_count_changed($(this), "#des_char");
            });
            $('#description').keypress(function(event) {
                text_count_changed($(this), "#des_char");
            });
        });
    </script>
<?php } ?>
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
<div class="wrapper">
    <div class="control_frm">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="index.html?com=baiviet&act=add_cat&tbl=<?= $_GET['tbl'] ?><?php if ($_GET['id_list'] != '') echo '&id_list=' . $_GET['id_list']; ?><?php if ($_REQUEST['type'] != '') echo '&type=' . $_REQUEST['type']; ?>"><span><?= $GLOBAL_LEVEL2[$com][$type]['title'] ?></span></a>
                </li>
                <li class="current"><a href="#" onclick="return false;"><?= ($_GET['act'] == 'edit_cat') ? _sua : _them ?></a></li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>

    <form name="supplier" class="form form-validate" action="index.html?com=baiviet&act=save_cat&tbl=<?= $_GET['tbl'] ?><?php if ($_REQUEST['id'] != '') echo '&id=' . $_REQUEST['id']; ?><?php if ($_GET['id_list'] != '') echo '&id_list=' . $_GET['id_list']; ?><?php if ($_REQUEST['type'] != '') echo '&type=' . $_REQUEST['type']; ?><?php if ($_GET['page'] != '') echo '&page=' . $_GET['page']; ?>" method="post" enctype="multipart/form-data" autocomplete="off" accept-charset="utf-8">
        <div class="mtop0">
            <div class="oneOne">
                <div class="widget mtop0">
                    <div class="title chonngonngu" style="border-bottom: 0px solid transparent">
                        <ul>
                            <?php foreach ($config['lang'] as $k => $v) { ?>
                                <li><a href="<?= $k ?>" class="<?= ($k == 'vi') ? 'active' : '' ?> tipS" title="<?= $v ?>"><img src="./images/<?= $k ?>.png" alt="" class="<?= $func->changeTitle($v) ?>" /><?= $v ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="<?= ($GLOBAL_LEVEL2[$com][$type]['full'] == true) ? 'oneOne' : 'colLeft' ?>">
                <div class="widget mtop0">
                    <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
                        <h6><?= _thongtin ?></h6>
                    </div>
                    <?php foreach ($config['lang'] as $k => $v) { ?>
                        <div class="formRow lang_hidden lang_<?= $k ?> <?= ($k == 'vi') ? 'active' : '' ?>">
                            <label><?= _tieude ?> [<?= $v ?>]</label>
                            <div class="formRight">
                                <input type="text" data-validation="required" data-validation-error-msg="Tên không được để trống" onkeyup="changeSlug('name_<?= $k ?>','alias_<?= $k ?>','url_seo_<?= $k ?>','title_seo_<?= $k ?>','title_<?= $k ?>')" class="input100" name="data[ten_<?= $k ?>]" title="Nhập tên danh mục" id="name_<?= $k ?>" class="tipS" value="<?= @$item['ten_' . $k] ?>" />
                            </div>
                            <div class="clear"></div>
                        </div>
                    <?php } ?>
                    <?php if ($GLOBAL[$com][$type]['alias'] == true) { ?>
                        <?php foreach ($config['lang'] as $k => $v) { ?>
                            <div class="formRow lang_hidden lang_<?= $k ?> <?= ($k == 'vi') ? 'active' : '' ?>">
                                <label class="d-block">[<?= $v ?>] Đường hiển thị (Bạn có thể thay đổi đường dẫn) :</label>
                                <div class="formRight">
                                    <div class="box-alias" style="position: relative;display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;-ms-flex-align: stretch;align-items: stretch;width: 100%;">
                                        <div class="alias-text-disabled">
                                            <b><?= $https_config ?><?php if ($config['alias']) { ?><?= @$_GET['type'] ?>/<?php } ?></b>
                                        </div>
                                        <div style="position: relative;-ms-flex: 1 1 auto;flex: 1 1 auto;width: 1%;margin-bottom: 0;">
                                            <input type="text" name="data[tenkhongdau_<?= $k ?>]" title="Nhập tên không dấu" id="alias_<?= $k ?>" class="tipS input100" value="<?= @$item['tenkhongdau_' . $k] ?>" />
                                        </div>
                                        <?php if ($_GET['act'] == 'edit_cat') { ?>
                                            <div class="input-group-append" style="display:flex;align-items:center;margin-left:10px">
                                                <div class="input-group-text">
                                                    <input type="checkbox" id="checkUrl<?= $k ?>" data-id="<?= $k ?>" class="change_alias alias_<?= $k ?>" checked>
                                                    <label style="float:right;padding:0;margin-left:5px;" for="checkUrl<?= $k ?>" class="mb-0 ml-1">Không đổi link</label>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>

                                </div>
                                <div class="clear"></div>
                            </div>
                        <?php } ?>
                    <?php } ?>

                    <?php foreach ($config['lang'] as $k => $v) { ?>

                        <?php if ($GLOBAL[$com][$type]["link_cano"] == true) { ?>

                            <div class="formRow lang_hidden lang_<?= $k ?> <?= ($k == 'vi') ? 'active' : '' ?>">

                                <label>Link canonical [<?= $v ?>]</label>

                                <div class="formRight">

                                    <input type="text" name="data[cano_<?= $k ?>]" title="Nhập link canonical" id="cano_<?= $k ?>" class="tipS" value="<?= @$item['cano_' . $k] ?>" />

                                </div>

                                <div class="clear"></div>

                            </div>

                        <?php } ?>

                    <?php } ?>
                    <?php foreach ($config['lang'] as $k => $v) { ?>
                        <?php if ($GLOBAL_LEVEL2[$com][$type]['mota'] == true) { ?>
                            <div class="formRow lang_hidden lang_<?= $k ?> <?= ($k == 'vi') ? 'active' : '' ?>">
                                <label><?= _mota ?> [<?= $v ?>]</label>
                                <div <?php if ($GLOBAL_LEVEL2[$com][$type]['mota-ckeditor'] == true) echo 'class="ck_editor"'; ?>>
                                    <textarea title="Nhập mô tả . " data-height="400" id="mota_<?= $k ?>" <?php if ($GLOBAL_LEVEL2[$com][$type]['mota-ckeditor'] == true) echo 'class="ck_editors"'; ?> name="data[mota_<?= $k ?>]"><?= htmlspecialchars_decode($item['mota_' . $k]) ?></textarea>
                                </div>
                                <div class="clear"></div>
                            </div>
                        <?php } ?>
                        <?php if ($GLOBAL_LEVEL2[$com][$type]['noidung'] == true) { ?>
                            <div class="formRow lang_hidden lang_<?= $k ?> <?= ($k == 'vi') ? 'active' : '' ?>">
                                <label>Nội dung [<?= $v ?>]</label>
                                <div <?php if ($GLOBAL_LEVEL2[$com][$type]['noidung-ckeditor'] == true) echo 'class="ck_editor"'; ?>>
                                    <textarea title="Nhập mô tả . " data-height="400" id="noidung_<?= $k ?>" <?php if ($GLOBAL_LEVEL2[$com][$type]['noidung-ckeditor'] == true) echo 'class="ck_editors"'; ?> name="data[noidung_<?= $k ?>]"><?= htmlspecialchars_decode($item['noidung_' . $k]) ?></textarea>
                                </div>
                                <div class="clear"></div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
                <div class="clear"></div>
            </div>
            <div class="<?= ($GLOBAL_LEVEL2[$com][$type]['full'] == true) ? 'oneOne' : 'colRight' ?>">
                <div class="widget mtop0">
                    <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
                        <h6>Danh mục và mô tả</h6>
                    </div>

                    <?php if ($GLOBAL[$com][$type]['list'] == true) { ?>
                        <div class="formRow">
                            <label><?= $GLOBAL_LEVEL2[$com][$type]['title'] ?></label>
                            <div class="formRight">
                                <select class="main_select" name="data[id_list]" id="id_list">
                                    <option value="0">Chọn danh mục cấp 1</option>
                                    <?php for ($i = 0; $i < count($items_list); $i++) { ?>
                                        <option value="<?= $items_list[$i]['id'] ?>" <?= ($_GET['id_list'] == $items_list[$i]['id']) ? 'selected' : '' ?>><?= $items_list[$i]['ten_vi'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="clear"></div>
                        </div>
                    <?php } ?>

                    <?php if ($GLOBAL_LEVEL2[$com][$type]['img'] == true) { ?>
                        <div class="formRow">
                            <label>Tải hình ảnh:</label>
                            <div class="formRight">
                                <?php if ($_GET['act'] == 'edit_cat') { ?>
                                    <input type="file" id="file" name="file" />
                                <?php } else { ?>
                                    <input data-validation="required" data-validation-allowing="jpg, png" data-validation-max-size="300kb" data-validation-error-msg-required="Bạn chưa chọn file" type="file" id="file" name="file" />
                                <?php } ?>
                                <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
                                <span style="display: inline-block; line-height: 30px;color:#CCC; padding-left: 10px;">
                                    Width:
                                    <?= $GLOBAL_LEVEL2[$com][$type]['img-width'] * $GLOBAL_LEVEL2[$com][$type]['img-ratio'] ?>px
                                    -
                                    <?= $GLOBAL_LEVEL2[$com][$type]['img-height'] * $GLOBAL_LEVEL2[$com][$type]['img-ratio'] ?>px
                                </span>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <?php if ($_GET['act'] == 'edit_cat' && $item['photo'] != '') { ?>
                            <div class="formRow">
                                <label>Hình Hiện Tại :</label>
                                <div class="formRight">

                                    <div class="mt10"><img width="<?= $GLOBAL_LEVEL2[$com][$type]['img-width'] ?>" height="<?= $GLOBAL_LEVEL2[$com][$type]['img-height'] ?>" src="<?= _upload_baiviet . $item['photo'] ?>" alt="NO PHOTO" /></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($GLOBAL_LEVEL2[$com][$type]['icon'] == true) { ?>
                        <div class="formRow">
                            <label>Tải icon:</label>
                            <div class="formRight">
                                <input type="file" id="file" name="icon" />
                                <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
                                <br />
                                <br />
                                <span style="display: inline-block; line-height: 30px;color:#CCC;">
                                    Width:
                                    <?= $GLOBAL_LEVEL2[$com][$type]['img-width1'] * $GLOBAL_LEVEL2[$com][$type]['img-ratio'] ?>px
                                    - Height:
                                    <?= $GLOBAL_LEVEL2[$com][$type]['img-height1'] * $GLOBAL_LEVEL2[$com][$type]['img-ratio'] ?>px
                                </span>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <?php if ($_REQUEST['act'] == 'edit_list' && $item['icon'] != '') { ?>
                            <div class="formRow">
                                <label>Icon Hiện Tại :</label>
                                <div class="formRight">
                                    <div class="mt10"><img src="<?= _upload_baiviet . $item['icon'] ?>" alt="NO PHOTO" width="40" />
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        <?php } ?>
                    <?php } ?>

                    <div class="formRow">
                        <div class="formRight">
                            <label class="stardust-checkbox">
                                Hiển thị
                                <input class="stardust-checkbox__input" <?= (!isset($item['hienthi']) || $item['hienthi'] == 1) ? 'checked="checked"' : '' ?> name="hienthi" type="checkbox" value="1" style="display:none">
                                <div class="stardust-checkbox__box"></div>
                            </label>
                        </div>
                    </div>

                    <div class="formRow">
                        <div class="formRight">
                            <label><?= _sothutu ?>: </label>
                            <input type="text" class="tipS" value="<?= isset($item['stt']) ? $item['stt'] : $func->checkNumb('stt', $com . '_cat', $type) ?>" name="data[stt]" style="width:40px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <?php if ($GLOBAL_LEVEL2[$com][$type]['seo'] == true) { ?>
                    <?php if (isset($GLOBAL_LEVEL2[$com][$type]['seo']) && $GLOBAL_LEVEL2[$com][$type]['seo'] == true) {
                        $seoDB = $seo->getSeoDB($id, $com, 'man' . $tbl, $type);
                    ?>
                        <div class="widget mtop10">
                            <div class="formRow">
                                <div class="formRight">
                                    <?php foreach ($config['seo-lang'] as $k => $v) { ?>
                                        <div class="box-seo lang_hidden lang_<?= $k ?> <?= ($k == 'vi') ? 'active' : '' ?>">

                                            <p style="font-size:18px;font-weight:normal;border-bottom:1px solid #ccc;padding-bottom:10px">
                                                Hiển thị kết quả tìm kiếm google search</p>
                                            <p style="font-size:14px;font-weight:normal;padding:10px 0px">
                                                <a href="<?= $https_config ?><?= $item["tenkhongdau_$k"] ?>" target="_blank" title="<?= $https_config ?>"><span><?= $https_config ?></span><span id="url_seo_<?= $k ?>"><?= $item["tenkhongdau_$k"] ?></span></a>
                                            </p>
                                            <h3 style="font-size: 20px;line-height: 1.3;color: #1a0dab;margin-bottom: 0px;font-weight:500" class="title_seo" id="title_seo">
                                                <?= ($seoDB['title_' . $k] != '') ? $seoDB['title_' . $k] : '[SEO Onpage] là gì? Hướng dẫn tối ưu SEO Onpage...' ?>
                                            </h3>
                                            <p style="padding-top:10px;font-size:14px;line-height: 1.57;word-wrap: break-word;color: #6a6a6a;margin-bottom: 0px;" class="description_seo" id="description_seo">
                                                <?= ($seoDB['description_' . $k] != '') ? $seoDB['description_' . $k] : ' Hướng dẫn SEO onpage căn bản tối ưu để trang web chuẩn SEO lên top Google nhanh và bền vững, kỹ thuật tối ưu SEO onpage đơn giản' ?>

                                            </p>

                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="widget mtop10">
                            <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
                                <h6><?= _noidungseo ?></h6>
                            </div>

                            <?php foreach ($config['seo-lang'] as $k => $v) { ?>

                                <div class="formRow lang_hidden lang_<?= $k ?> <?= ($k == 'vi') ? 'active' : '' ?>">
                                    <label>Title [ <?= $v ?> ]: </label>
                                    <div class="formRight">
                                        <input data-validation="required" data-validation-error-msg="Title không được để trống" type="text" value="<?= @$seoDB['title_' . $k] ?>" id="title" name="dataseo[title_<?= $k ?>]" title="Nội dung thẻ meta Title dùng để SEO" class="tipS input100" />
                                    </div>
                                    <div class="clear"></div>
                                </div>

                                <div class="formRow lang_hidden lang_<?= $k ?> <?= ($k == 'vi') ? 'active' : '' ?>">
                                    <label>Description [ <?= $v ?> ]:</label>
                                    <div class="formRight">
                                        <textarea data-validation="required" data-validation-error-msg="Description không được để trống" rows="4" cols="" title="Nội dung thẻ meta Description dùng để SEO" class="tipS input100" name="dataseo[description_<?= $k ?>]" id="description"><?= @$seoDB['description_' . $k] ?></textarea>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <?php /*
                            <div class="formRow lang_hidden lang_<?=$k?> <?= ($k == 'vi') ? 'active': '' ?>">

                                <label>Schema</label>

                                <div class="formRight">

                                    <textarea rows="8" cols="" title="Những đoạn code khách hàng muốn chèn trên header của website"

                                        class="tipS" name="dataseo[schema]"><?=@$seoDB['schema']?></textarea>

                                </div>

                                <div class="clear"></div>

                            </div>
                            */ ?>
                                <div class="formRow lang_hidden lang_<?= $k ?> <?= ($k == 'vi') ? 'active' : '' ?>">
                                    <div class="formRight">
                                        <input readonly="readonly" type="text" style="width:45px; margin-top:10px; text-align:center;" name="des_char" id="des_char" value="<?= @$item['des_char'] ?>" /> <?= _kytu ?> <b>(Từ 160-300 ký tự)</b>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } ?>
                <div class="clear"></div>
            </div>
        </div>
        <div class="formRow fixedBottom sidebar-bunker">
            <div class="formRight">
                <div class="box-admin" style="display:flex; align-items:center;justify-content:flex-end">
                    <div class="box-action">
                        <button type="submit" class="btn btn-sm bg-gradient-primary text-white submit-check btn-disabled">
                            <i class="far fa-save mr-2"></i>Lưu
                        </button>
                        <button type="submit" class="btn btn-sm bg-gradient-success btn-disabled" name="save-here"><i class="far fa-save mr-2"></i>Lưu tại trang</button>
                        <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
                        <a class="btn btn-sm bg-gradient-danger text-white" href="index.html?com=baiviet&act=man_cat<?php if ($_REQUEST['type'] != '') echo '&type=' . $_REQUEST['type']; ?>">
                            <i class="fas fa-sign-out-alt mr-2"></i>Thoát
                        </a>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </form>
</div>
<script>