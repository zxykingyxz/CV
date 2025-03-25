<link href="plugin/sumoselect/sumoselect.css" rel="stylesheet" />

<script src="plugin/sumoselect/jquery.sumoselect.min.js"></script>

<?php if ($table['seo'] == true) { ?>

    <script>
        var edit = "<?= $_GET['act'] ?>";



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
    $(document).ready(function() {

        $('.chonngonngu li a').click(function(event) {

            var lang = $(this).attr('href');

            $('.chonngonngu li a').removeClass('active');

            $(this).addClass('active');

            $('.lang_hidden').removeClass('active');

            $('.lang_' + lang).addClass('active');

            return false;

        });

        $('select[js-select-city]').change(function() {

            var id = $(this).val();

            $.post('ajax/loadDist.php', {

                'id': id

            }, function(data, st) {

                $('select[data-view-dist]').html(data);

            });

        });

        $('.update_stt').keyup(function(event) {

            var id = $(this).attr('rel');

            var table = 'baiviet_photo';

            var value = $(this).val();

            $.ajax({

                type: "POST",

                url: "ajax/update_stt.php",

                data: {

                    id: id,

                    table: table,

                    value: value

                },

                success: function(result) {}

            });

        });



        $('.delete_images').click(function() {

            if (confirm('Bạn có muốn xóa hình này ko ? ')) {

                var id = $(this).attr('title');

                var table = 'baiviet_photo';

                $.ajax({

                    type: "POST",

                    url: "ajax/delete_images.php",

                    data: {

                        id: id,

                        table: table

                    },

                    success: function(result) {}

                });

                $(this).parent().slideUp();

            }

            return false;

        });



        $('.delete').click(function(e) {

            $(this).parent().remove();

        });



    });
</script>

<div class="wrapper">



    <div class="control_frm">

        <div class="bc">

            <ul id="breadcrumbs" class="breadcrumbs">

                <li><a href="index.html?com=tags&act=add<?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?><?php if ($_GET['page'] != '') echo '&page=' . $_GET['page']; ?>"><span><?= $table['title'] ?></span></a>

                </li>

                <li class="current"><a href="#" onclick="return false;"><?= ($_GET['act'] == 'edit') ? 'Sửa' : 'Thêm' ?></a>

                </li>

            </ul>

            <div class="clear"></div>

        </div>

    </div>



    <form name="supplier" class="form" action="index.html?com=tags&act=<?= ($_GET["act"] == 'copy') ? 'save_copy' : 'save' ?><?php if ($_GET['id_copy'] != '') echo '&id_copy=' . $_GET['id_copy']; ?><?php if ($_GET['id'] != '') echo '&id=' . $_GET['id']; ?><?php if ($_GET['id_list'] != '') echo '&id_list=' . $_GET['id_list']; ?><?php if ($_GET['id_cat'] != '') echo '&id_cat=' . $_GET['id_cat']; ?><?php if ($_GET['id_item'] != '') echo '&id_item=' . $_GET['id_item']; ?><?php if ($_GET['id_sub'] != '') echo '&id_sub=' . $_GET['id_sub']; ?><?php if ($_GET['id_product'] != '') echo '&id_product=' . $_GET['id_product']; ?><?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?><?php if ($_GET['page'] != '') echo '&page=' . $_GET['page']; ?>" method="post" enctype="multipart/form-data" autocomplete="off" accept-charset="utf-8">

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



            <div class="<?= ($table['full'] == true) ? 'oneOne' : 'colLeft' ?>">

                <div class="widget mtop0">

                    <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />

                        <h6>Thông tin chung</h6>

                    </div>

                    <?php foreach ($config['lang'] as $k => $v) { ?>

                        <div class="formRow lang_hidden lang_<?= $k ?> <?= ($k == 'vi') ? 'active' : '' ?>">

                            <label>Tiêu đề [<?= $v ?>]</label>

                            <div class="formRight">

                                <input type="text" data-validation="required" data-validation-error-msg="Tên không được để trống" onkeyup="changeSlug('name_<?= $k ?>','alias_<?= $k ?>','url_seo_<?= $k ?>','title_seo_<?= $k ?>','title_<?= $k ?>')" name="data[ten_<?= $k ?>]" title="Nhập tên danh mục" id="name_<?= $k ?>" class="tipS" value="<?= @$item['ten_' . $k] ?>" />

                            </div>

                            <div class="clear"></div>

                        </div>

                    <?php } ?>

                    <?php if ($GLOBAL['tags'][$_GET["type"]]['alias'] == true) { ?>

                        <?php foreach ($config['lang'] as $k => $v) { ?>

                            <div class="formRow lang_hidden lang_<?= $k ?> <?= ($k == 'vi') ? 'active' : '' ?>">

                                <label class="d-block">[<?= $v ?>] Đường dẫn hiển thị (Bạn có thể thay đổi đường dẫn) :</label>

                                <div class="formRight">

                                    <div class="box-alias" style="position: relative;display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;-ms-flex-align: stretch;align-items: stretch;width: 100%;">

                                        <div class="alias-text-disabled">

                                            <b><?= $https_config ?></b>

                                        </div>

                                        <div style="position: relative;-ms-flex: 1 1 auto;flex: 1 1 auto;width: 1%;margin-bottom: 0;">

                                            <input onblur="changeUrl('alias_<?= $k ?>','url_seo_<?= $k ?>')" data-validation="required" data-validation-error-msg="Url không được để trống" type="text" name="data[tenkhongdau_<?= $k ?>]" title="Nhập tên không dấu" id="alias_<?= $k ?>" class="tipS" value="<?= @$item['tenkhongdau_' . $k] ?>" />

                                        </div>



                                        <?php if ($_GET['act'] == 'edit') { ?>

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

                    <?php if ($table['link']) { ?>

                        <div class="formRow">

                            <label>Link web mẫu</label>

                            <div class="formRight">

                                <input type="text" data-validation="required" data-validation-error-msg="Link không được để trống" name="data[link]" title="Nhập link" id="link" class="tipS" value="<?= @$item['link'] ?>" />

                            </div>

                            <div class="clear"></div>

                        </div>

                    <?php } ?>

                    <?php foreach ($config['lang'] as $k => $v) { ?>

                        <?php if ($table['job'] == true) { ?>

                            <div class="formRow lang_hidden lang_<?= $k ?> <?= ($k == 'vi') ? 'active' : '' ?>">

                                <label>Vị trí [<?= $v ?>]</label>

                                <div class="formRight">

                                    <input type="text" data-validation="required" data-validation-error-msg="Không được để trống" name="data[job_<?= $k ?>]" title="Nhập địa chỉ" id="job_<?= $k ?>" class="tipS" value="<?= @$item['job_' . $k] ?>" />

                                </div>

                                <div class="clear"></div>

                            </div>

                        <?php } ?>

                        <?php if ($table['mota'] == true) { ?>

                            <div class="formRow lang_hidden lang_<?= $k ?> <?= ($k == 'vi') ? 'active' : '' ?>">

                                <label>Mô tả [<?= $v ?>]</label>

                                <div class="ck_editor">

                                    <textarea title="Nhập mô tả [<?= $v ?>]. " data-height="400" id="mota_<?= $k ?>" <?= ($table['mota-ckeditor'] == true) ? 'class="ck_editors"' : 'rows="8"' ?> name="data[mota_<?= $k ?>]"><?= @$item['mota_' . $k] ?></textarea>

                                </div>

                                <div class="clear"></div>

                            </div>

                        <?php } ?>


                        <?php if ($table['noidung'] == true) { ?>

                            <div class="formRow lang_hidden lang_<?= $k ?> <?= ($k == 'vi') ? 'active' : '' ?>">

                                <label>Nội dung [<?= $v ?>]</label>

                                <div class="ck_editor">

                                    <textarea data-validation="required" data-validation-error-msg="Không được để trống" title="Nhập nội dung [<?= $v ?>]. " data-height="400" id="noidung_<?= $k ?>" <?= ($table['noidung-ckeditor'] == true) ? 'class="ck_editors"' : 'rows="8"' ?> name="data[noidung_<?= $k ?>]"><?= @$item['noidung_' . $k] ?></textarea>

                                </div>

                                <div class="clear"></div>

                            </div>

                        <?php } ?>

                    <?php } ?>

                </div>



            </div>



            <div class="<?= ($table['full'] == true) ? 'oneOne' : 'colRight' ?>">

                <div class="widget mtop0">

                    <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />

                        <h6>Hình ảnh và danh mục</h6>

                    </div>

                    <?php if ($table['list'] == true) { ?>

                        <div class="formRow">

                            <label><?= $GLOBAL_LEVEL1[$com][$type]['title'] ?></label>

                            <div class="formRight">

                                <select class="main_select" onchange="onChangePage(this.value,'tags_cat','<?= $_GET['type'] ?>','id_cat','id_list')" name="data[id_list]" id="id_list">

                                    <option value="0">Chọn danh mục cấp 1</option>

                                    <?php for ($i = 0; $i < count($items_list); $i++) { ?>

                                        <option value="<?= $items_list[$i]['id'] ?>" <?= ($item['id_list'] == $items_list[$i]['id']) ? 'selected' : '' ?>><?= $items_list[$i]['ten_vi'] ?></option>

                                    <?php } ?>

                                </select>

                            </div>

                            <div class="clear"></div>

                        </div>

                    <?php } ?>

                    <?php if ($table['cat'] == true) { ?>

                        <div class="formRow">

                            <label><?= $GLOBAL_LEVEL2[$com][$type]['title'] ?></label>

                            <div class="formRight">

                                <select class="main_select" onchange="onChangePage(this.value,'tags_item','<?= $_GET['type'] ?>','id_item','id_cat')" name="data[id_cat]" id="id_cat">

                                    <option value="0">Chọn danh mục cấp 2</option>

                                    <?php for ($i = 0; $i < count($items_cat); $i++) { ?>

                                        <option value="<?= $items_cat[$i]['id'] ?>" <?= ($item['id_cat'] == $items_cat[$i]['id']) ? 'selected' : '' ?>><?= $items_cat[$i]['ten_vi'] ?></option>

                                    <?php } ?>

                                </select>

                            </div>

                            <div class="clear"></div>

                        </div>

                    <?php } ?>

                    <?php if ($table['item'] == true) { ?>

                        <div class="formRow">

                            <label><?= $GLOBAL_LEVEL3[$com][$type]['title'] ?></label>

                            <div class="formRight">

                                <select class="main_select" onchange="onChangePage(this.value,'tags_sub','<?= $_GET['type'] ?>','id_sub','id_item')" name="data[id_item]" id="id_item">

                                    <option value="0">Chọn danh mục cấp 3</option>

                                    <?php for ($i = 0; $i < count($items_item); $i++) { ?>

                                        <option value="<?= $items_item[$i]['id'] ?>" <?= ($item['id_item'] == $items_item[$i]['id']) ? 'selected' : '' ?>><?= $items_item[$i]['ten_vi'] ?></option>

                                    <?php } ?>

                                </select>

                            </div>

                            <div class="clear"></div>

                        </div>

                    <?php } ?>



                    <style>
                        .flex-checkbox {

                            display: flex;

                            align-items: center;

                            justify-content: center;

                            margin-right: 10px !important;

                        }

                        .flex-checkbox span {

                            display: inline-block;

                            margin-left: 5px;

                        }
                    </style>

                    <?php /* if($_GET['type']=='san-pham'){

                        $brands=$db->rawQuery("select * from table_tags_list where type='thuong-hieu' order by stt asc, id desc");

                        $arr=explode(',',$item['id_thuonghieu']);

                    ?>

                        <div class="formRow">

                            <label>Thương hiệu</label>

                            <div class="formRight">

                                <?php foreach($brands as $key => $value){?>

                                <label class="stardust-checkbox checker flex-checkbox">

                                    <input class="stardust-checkbox__input" <?php if(in_array($value['id'],$arr)) echo 'checked';?> name="id_thuonghieu[]" id="check<?=$key?>" type="checkbox"

                                        value="<?=$value['id']?>" style="display:none">

                                    <div class="stardust-checkbox__box"></div>

                                    <span><?=$value["ten_$lang"]?></span>

                                </label>

                                <?php }?>

                            </div>

                            <div class="clear"></div>

                        </div>

                    <?php } */ ?>

                    <?php if ($table['masp'] == true) { ?>

                        <div class="formRow">

                            <label>Mã sản phẩm</label>

                            <div class="formRight">

                                <input type="text" data-validation="required" data-validation-error-msg="Không được để trống" name="data[masp]" title="Nhập mã sản phẩm" id="masp" class="tipS" value="<?= @$item['masp'] ?>" />

                            </div>

                            <div class="clear"></div>

                        </div>

                    <?php } ?>

                    <?php if ($GLOBAL[$com][$type]['xuatxu']) { ?>

                        <div class="formRow">

                            <label>Xuất xứ</label>

                            <div class="formRight">

                                <input type="text" name="data[xuatxu]" title="Nhập mã sản phẩm" id="xuatxu" class="tipS" value="<?= @$item['xuatxu'] ?>" />

                            </div>

                            <div class="clear"></div>

                        </div>

                    <?php } ?>

                    <?php if ($GLOBAL[$com][$type]['rating']) { ?>

                        <div class="formRow">

                            <label>Đánh giá sao</label>

                            <div class="formRight">

                                <input type="text" name="data[rating]" title="Nhập số sao cẩn đánh giá" id="rating" class="tipS" value="<?= @$item['rating'] ?>" />

                            </div>

                            <div class="clear"></div>

                        </div>

                    <?php } ?>

                    <?php if ($GLOBAL[$com][$type]['baohanh']) { ?>

                        <div class="formRow">

                            <label>Bảo hành</label>

                            <div class="formRight">

                                <input type="text" name="data[baohanh]" title="Nhập mã sản phẩm" id="baohanh" class="tipS" value="<?= @$item['baohanh'] ?>" />

                            </div>

                            <div class="clear"></div>

                        </div>

                    <?php } ?>

                    <?php if ($table['gia'] == true) { ?>

                        <div class="formRow">

                            <label>Giá bán</label>

                            <div class="formRight">

                                <input type="text" name="data[giaban]" title="Nhập giá bán" id="giaban" class="conso tipS" value="<?= @$item['giaban'] ?>" />

                            </div>

                            <div class="clear"></div>

                        </div>

                    <?php } ?>

                    <?php if ($table['giacu'] == true) { ?>

                        <div class="formRow">

                            <label>Giá cũ nếu có</label>

                            <div class="formRight">

                                <input type="text" name="data[giacu]" title="Nhập giá cũ nếu có" id="giacu" class="conso tipS" value="<?= @$item['giacu'] ?>" />

                            </div>

                            <div class="clear"></div>

                        </div>

                    <?php } ?>
                    <?php if ($table['donvitinh'] == true) { ?>

                        <div class="formRow">

                            <label>Trọng lượng</label>

                            <div class="formRight">

                                <input type="text" name="data[donvitinh]" title="Nhập đơn vị tính" id="donvitinh" class="tipS" value="<?= @$item['donvitinh'] ?>" />

                            </div>

                            <div class="clear"></div>

                        </div>

                    <?php } ?>

                    <?php if ($table['tinhtrang'] == true) { ?>

                        <div class="formRow">

                            <label>Trạng thái</label>

                            <div class="formRight">

                                <select name="data[id_loai]" id="id_loai" class="main_select">

                                    <option value="1" <?= (@$item['id_loai'] == 1) ? 'selected' : '' ?>>Còn món

                                    </option>

                                    <option value="2" <?= (@$item['id_loai'] == 2) ? 'selected' : '' ?>>Tạm hết món

                                    </option>

                                </select>

                            </div>

                            <div class="clear"></div>

                        </div>



                    <?php } ?>



                    <?php if ($table['img'] == true) { ?>

                        <div class="formRow">

                            <label>Tải hình ảnh:</label>

                            <div class="formRight">

                                <?php if ($_GET['act'] == 'edit' || $_GET['act'] == 'copy') { ?>

                                    <input type="file" id="file" name="file" />

                                <?php } else { ?>

                                    <input data-validation="required" data-validation-allowing="jpg, png" data-validation-max-size="300kb" data-validation-error-msg-required="Bạn chưa chọn file" type="file" id="file" name="file" />

                                <?php } ?>

                                <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">

                                <br />

                                <br />

                                <span style="display: inline-block; line-height: 30px;color:#CCC;">

                                    Width: <?= $table['img-width'] * $table['img-ratio'] ?>px -

                                    Height:<?= $table['img-height'] * $table['img-ratio'] ?>px

                                </span>

                            </div>

                            <div class="clear"></div>

                        </div>

                        <?php if ($_GET['act'] == 'edit' || $_GET['act'] == 'copy') { ?>

                            <div class="formRow">

                                <label>Hình Hiện Tại :</label>

                                <div class="formRight">

                                    <div class="mt10"><img style="max-width:100%" src="<?= _upload_baiviet . $item['photo'] ?>" alt="NO PHOTO" width="<?= $table['img-width'] ?>" height="<?= $table['img-height'] ?>" /></div>

                                </div>

                                <div class="clear"></div>

                            </div>

                        <?php } ?>

                        <?php if ($table['img-gallery'] == true || $_GET["type"] == 'album-anh') { ?>

                            <div class="formRow">

                                <label>Hình đính kèm:

                                    <span>[Width:<?= $table['img-width'] * $table['img-ratio'] ?>px -

                                        Height:

                                        <?= $table['img-height'] * $table['img-ratio'] ?>px]</span></label>

                                <div class="formRight">

                                    <a class="file_input" data-jfiler-name="files" data-jfiler-extensions="jpg, jpeg, png, gif">

                                        <div class="jFiler jFiler-theme-dragdropbox">

                                            <div class="jFiler-input-dragDrop">

                                                <div class="jFiler-input-inner">

                                                    <div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div>

                                                    <div class="jFiler-input-text">

                                                        <h3>Upload files here</h3>

                                                    </div><span class="jFiler-input-choose-btn btn-custom blue-light">Browse

                                                        Files</span>

                                                </div>

                                            </div>

                                        </div>

                                    </a>

                                    <?php if ($act == 'edit') { ?>

                                        <?php

                                        if (count($ds_photo) != 0) {

                                        ?>

                                            <?php for ($i = 0; $i < count($ds_photo); $i++) { ?>

                                                <div class="item_trich">

                                                    <img class="img_trich" src="<?= _upload_tags . $ds_photo[$i]['photo'] ?>" />

                                                    <input type="text" rel="<?= $ds_photo[$i]['id'] ?>" value="<?= $ds_photo[$i]['stt'] ?>" class="update_stt tipS" />

                                                    <a class="delete_images icon-jfi-trash jFiler-item-trash-action" title="<?= $ds_photo[$i]['id'] ?>" style="color:#FF0000"></a>

                                                </div>

                                            <?php } ?>

                                        <?php } ?>

                                    <?php } ?>

                                </div>

                                <div class="clear"></div>

                            </div>

                        <?php } ?>

                    <?php } ?>

                    <?php if ($table['icon'] == true) { ?>

                        <div class="formRow">

                            <label>Tải icon:</label>

                            <div class="formRight">

                                <input type="file" id="file" name="icon" />

                                <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">

                                <br />

                                <br />

                                <span style="display: inline-block; line-height: 30px;color:#CCC;">

                                    Width: <?= $table['img-width1'] * $table['img-ratio'] ?>px -

                                    Height:<?= $table['img-height1'] * $table['img-ratio'] ?>px

                                </span>

                            </div>

                            <div class="clear"></div>

                        </div>

                        <?php if ($_GET['act'] == 'edit') { ?>

                            <div class="formRow">

                                <label>Hình Hiện Tại :</label>

                                <div class="formRight">

                                    <div class="mt10"><img src="<?= _upload_tags . $item['icon'] ?>" alt="NO PHOTO" width="100" /></div>

                                </div>

                                <div class="clear"></div>

                            </div>

                        <?php } ?>

                    <?php } ?>

                    <div class="formRow">



                        <div class="formRight">

                            <label>Số thứ tự: </label>

                            <input type="text" class="tipS" value="<?= isset($item['stt']) ? $item['stt'] : $func->checkNumb('stt', $com, $type) ?>" name="data[stt]" style="width:40px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">

                        </div>

                        <div class="clear"></div>

                    </div>
                    <?php
                    if ($table["iframe_map"] == true) {
                    ?>
                        <div class="formRow">

                            <label>Iframe map <strong><a href="https://www.google.com/maps" target="_blank" title="Lấy mã nhúng Google Map">( <i class="fas fa-map-marker-alt" aria-hidden="true"></i> Lấy mã nhúng )</a></strong></label>

                            <div>

                                <textarea data-validation="required" data-validation-error-msg="Iframe map không được để trống" title="Nhập iframe. " id="iframe_map" rows="7" name="data[iframe_map]"><?= @$item['iframe_map'] ?></textarea>

                            </div>

                            <div class="clear"></div>

                        </div>
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

                </div>



                <?php if ($table['seo'] == true) { ?>

                    <?php if (isset($table['seo']) && $table['seo'] == true) {

                        $seoDB = $seo->getSeoDB($id, $com, 'man' . $tbl, $type);

                    ?>

                        <div class="widget mtop10">

                            <div class="formRow">

                                <div class="formRight">

                                    <div class="box-seo">

                                        <?php foreach ($config['seo-lang'] as $k => $v) { ?>

                                            <p style="font-size:18px;font-weight:normal;border-bottom:1px solid #ccc;padding-bottom:10px">

                                                Hiển thị kết quả tìm kiếm google search</p>

                                            <p style="font-size:14px;font-weight:normal;padding:10px 0px">

                                                <a href="<?= $https_config ?><?= @$item['type'] ?>/<?= $item["tenkhongdau_$k"] ?>" target="_blank" title="<?= $https_config ?>"><span><?= $https_config ?><?= $item['type'] ?>/</span><span id="url_seo_<?= $k ?>"><?= $item["tenkhongdau_$k"] ?></span></a>

                                            </p>

                                            <h3 style="font-size: 20px;line-height: 1.3;color: #1a0dab;margin-bottom: 0px;font-weight:500" class="title_seo" id="title_seo">

                                                <?= ($seoDB['title_' . $k] != '') ? $seoDB['title_' . $k] : '[SEO Onpage] là gì? Hướng dẫn tối ưu SEO Onpage...' ?>

                                            </h3>

                                            <p style="padding-top:10px;font-size:14px;line-height: 1.57;word-wrap: break-word;color: #6a6a6a;margin-bottom: 0px;" class="description_seo" id="description_seo">

                                                <?= ($seoDB['description_' . $k] != '') ? $seoDB['description_' . $k] : ' Hướng dẫn SEO onpage căn bản tối ưu để trang web chuẩn SEO lên top Google nhanh và bền vững, kỹ thuật tối ưu SEO onpage đơn giản' ?>



                                            </p>

                                        <?php } ?>

                                    </div>

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

                                        <input type="text" data-validation="required" data-validation-error-msg="Không được để trống" value="<?= @$seoDB['title_' . $k] ?>" id="title" name="dataseo[title_<?= $k ?>]" title="Nội dung thẻ meta Title dùng để SEO" class="tipS input100" />

                                    </div>

                                    <div class="clear"></div>

                                </div>

                                <div class="formRow lang_hidden lang_<?= $k ?> <?= ($k == 'vi') ? 'active' : '' ?>">

                                    <label>Description [ <?= $v ?> ]:</label>

                                    <div class="formRight">

                                        <textarea rows="4" data-validation="required" data-validation-error-msg="Không được để trống" cols="" title="Nội dung thẻ meta Description dùng để SEO" class="tipS input100" name="dataseo[description_<?= $k ?>]" id="description"><?= @$seoDB['description_' . $k] ?></textarea>

                                    </div>

                                    <div class="clear"></div>

                                </div>

                                <div class="formRow">

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



        <div class="formRow fixedBottom">

            <div class="formRight">

                <input type="hidden" name="id_attr" value="<?= $rowId['id'] ?>" />



                <div class="box-admin" style="display:flex; align-items:center;justify-content:flex-end">

                    <div class="box-action">

                        <button type="submit" class="btn btn-sm bg-gradient-primary text-white">

                            <i class="far fa-save mr-2"></i><?= ($_GET["act"] == 'copy') ? 'Lưu copy' : 'Lưu' ?>

                        </button>

                        <button type="submit" class="btn btn-sm bg-gradient-success" name="save-here"><i class="far fa-save mr-2"></i>Lưu tại trang</button>

                        <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>

                        <a class="btn btn-sm bg-gradient-danger text-white" href="index.html?com=tags&act=man<?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?>">

                            <i class="fas fa-sign-out-alt mr-2"></i>Thoát

                        </a>

                    </div>

                </div>



            </div>

        </div>

        <div class="clear"></div>

</div>

</form>

</div>

<script type="text/javascript">
    $(document).ready(function() {

        window.asd = $('.multiselect-size').SumoSelect({

            placeholder: 'Chọn kích thước',

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

<script type="text/javascript">
    $(document).ready(function() {

        window.asd = $('.multiselect-info').SumoSelect({

            placeholder: 'Chọn nhà cung ứng',

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

<script>
    $(document).ready(function() {

        $('.file_input').filer({

            limit: 1000,

            maxSize: null,

            extensions: ["jpg", "png", "jpeg", "JPG", "PNG", "JPEG", "Png"],

            changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div><div class="jFiler-input-text"><h3>Kéo và thả hình vào đây</h3> <span style="display:inline-block; margin: 15px 0">hoặc</span></div><a class="jFiler-input-choose-btn blue">Chọn hình</a></div></div>',

            theme: "dragdropbox",

            showThumbs: true,

            addMore: true,

            allowDuplicates: false,

            clipBoardPaste: false,

            dragDrop: {

                dragEnter: null,

                dragLeave: null,

                drop: null,

                dragContainer: null

            },

            captions: {

                button: "Thêm hình",

                feedback: "Vui lòng chọn hình ảnh",

                feedback2: "Những hình đã được chọn",

                drop: "Kéo hình vào đây để upload",

                removeConfirmation: "Bạn muốn loại bỏ hình ảnh này ?",

                errors: {

                    filesLimit: "Chỉ được upload mỗi lần {{fi-limit}} hình ảnh",

                    filesType: "Chỉ hỗ trợ tập tin là hình ảnh có định dạng: {{fi-extensions}}",

                    filesSize: "Hình {{fi-name}} có kích thước quá lớn. Vui lòng upload hình ảnh có kích thước tối đa {{fi-maxSize}} MB.",

                    filesSizeAll: "Những hình ảnh bạn chọn có kích thước quá lớn. Vui lòng chọn những hình ảnh có kích thước tối đa {{fi-maxSize}} MB."

                }

            },

            templates: {

                box: '<ul class="jFiler-item-list"></ul>',

                item: '<li class="jFiler-item">\
            <div class="jFiler-item-container">\
                <div class="jFiler-item-inner">\
                    <div class="jFiler-item-thumb">\
                        <div class="jFiler-item-status"></div>\
                            <div class="jFiler-item-info">\
                                <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                    </div>\
                                    {{fi-image}}\
                                </div>\
                                <div class="jFiler-item-assets jFiler-row">\
                                    <ul class="list-inline pull-left">\
                                        <li><span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span></li>\
                                    </ul>\
                                    <ul class="list-inline pull-right">\
                                        <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                    </ul>\
                                </div>\<input type="text" name="stthinh[]" class="stthinh" />\
                            </div>\
                        </div>\
                    </li>',

                itemAppend: '<li class="jFiler-item">\
                        <div class="jFiler-item-container">\
                            <div class="jFiler-item-inner">\
                                <div class="jFiler-item-thumb">\
                                    <div class="jFiler-item-status"></div>\
                                    <div class="jFiler-item-info">\
                                        <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                    </div>\
                                    {{fi-image}}\
                                </div>\
                                <div class="jFiler-item-assets jFiler-row">\
                                    <ul class="list-inline pull-left">\
                                        <span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span>\
                                    </ul>\
                                    <ul class="list-inline pull-right">\
                                        <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                    </ul>\
                                </div>\<input type="text" name="stthinh[]" class="stthinh" />\
                            </div>\
                        </div>\
                    </li>',

                progressBar: '<div class="bar"></div>',

                itemAppendToEnd: true,

                removeConfirmation: true,

                _selectors: {

                    list: '.jFiler-item-list',

                    item: '.jFiler-item',

                    progressBar: '.bar',

                    remove: '.jFiler-item-trash-action',

                }

            },

            addMore: true

        });

    });
</script>