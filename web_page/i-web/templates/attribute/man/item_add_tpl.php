<link href="plugin/sumoselect/sumoselect.css" rel="stylesheet" />

<script src="plugin/sumoselect/jquery.sumoselect.min.js"></script>

<script src="assets/js/star.js"></script>

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

            var table = 'attribute_photo';

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

                <li><a href="index.html?com=attribute&act=add<?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?><?php if ($_GET['page'] != '') echo '&page=' . $_GET['page']; ?>"><span>Thuộc tính</span></a>

                </li>

                <li class="current"><a href="#" onclick="return false;"><?= ($_GET['act'] == 'edit') ? 'Sửa' : 'Thêm' ?></a>

                </li>

            </ul>

            <div class="clear"></div>

        </div>

    </div>



    <form name="supplier" class="form" action="index.html?com=attribute&act=save<?php if ($_GET['id'] != '') echo '&id=' . $_GET['id']; ?><?php if ($_GET['id_product'] != '') echo '&id_product=' . $_GET['id_product']; ?><?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?><?php if ($_GET['page'] != '') echo '&page=' . $_GET['page']; ?>&act_baiviet=<?= $_GET["act_baiviet"] ?>&page_baiviet=<?= $_GET["page_baiviet"] ?>" method="post" enctype="multipart/form-data" autocomplete="off" accept-charset="utf-8">

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

                    <div style="padding:10px;">

                        <a class="btn btn-sm bg-gradient-primary text-white" href="index.php?com=<?= $com ?>&act=man&type=<?= $_GET["type"] ?>&id_product=<?= $_GET["id_product"] ?>&page=<?= $_GET["page"] ?>">

                            <i class="fas fa-backward mr-2"></i>Trở lại danh sách

                        </a>

                    </div>
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

                    <?php if ($table['link']) { ?>

                        <div class="formRow">

                            <label>Link Video Thuộc tính</label>

                            <div class="formRight">

                                <input type="text" name="data[link]" title="Nhập link" id="link" class="tipS" value="<?= @$item['link'] ?>" />

                            </div>

                            <div class="clear"></div>

                        </div>

                    <?php } ?>

                    <?php foreach ($config['lang'] as $k => $v) { ?>

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

                    <?php if ($table['giabansale'] == true) { ?>

                        <div class="formRow">

                            <label>Giá Flase Sale</label>

                            <div class="formRight">

                                <input type="text" name="data[giabansale]" title="Nhập giá cũ nếu có" id="giabansale" class="conso tipS" value="<?= @$item['giabansale'] ?>" />

                            </div>

                            <div class="clear"></div>

                        </div>

                    <?php } ?>


                    <?php if (($table['color'] == true) && (in_array($type, ['color', 'mau-sac']))) { ?>

                        <div class="formRow">

                            <label>Chọn color</label>

                            <div class="formRight">

                                <input type="text" name="data[color]" title="Nhập giá cũ nếu có" id="color" class="cp3" value="<?= @$item['color'] ?>" />

                            </div>

                            <div class="clear"></div>

                        </div>

                    <?php } ?>
                    <?php if ($table['img'] == true) { ?>

                        <div class="formRow">

                            <label>Tải hình ảnh:</label>

                            <div class="formRight">

                                <?php if ($_GET['act'] == 'edit') { ?>

                                    <input type="file" id="file" name="file" />

                                <?php } else { ?>

                                    <input data-validation-allowing="jpg, png" data-validation-max-size="300kb" data-validation-error-msg-required="Bạn chưa chọn file" type="file" id="file" name="file" />

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

                        <?php if ($_GET['act'] == 'edit') { ?>

                            <div class="formRow">

                                <label>Hình Hiện Tại :</label>

                                <div class="formRight">

                                    <div class="mt10"><img src="<?= _upload_baiviet . $item['photo'] ?>" alt="NO PHOTO" width="100" /></div>

                                </div>

                                <div class="clear"></div>

                            </div>

                        <?php } ?>
                        <?php if ($table['file'] == true) { ?>

                            <div class="formRow">

                                <label>Tải file:</label>

                                <div class="formRight">

                                    <?php if ($_GET['act'] == 'edit') { ?>

                                        <input type="file" id="download" name="download" />

                                    <?php } else { ?>

                                        <input data-validation="required" data-validation-allowing="jpg, png" data-validation-max-size="300kb" data-validation-error-msg-required="Bạn chưa chọn file" type="file" id="download" name="download" />

                                    <?php } ?>

                                    <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải file">

                                    <br />

                                </div>

                                <div class="clear"></div>

                            </div>

                            <?php if ($_GET['act'] == 'edit') { ?>

                                <div class="formRow">

                                    <label>File Hiện Tại :</label>

                                    <div class="formRight">

                                        <div class="mt10">
                                            <?= $item['download'] ?>
                                        </div>

                                    </div>

                                    <div class="clear"></div>

                                </div>

                            <?php } ?>
                        <?php } ?>
                        <?php if ($table['video'] == true) { ?>
                            <div class="formRow">
                                <label>Upload video :</label>
                                <div class="formRight">
                                    <input type="file" id="video" name="video" />
                                    <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
                                    <br />
                                    <br />
                                    <span style="display: inline-block; line-height: 30px;color:#CCC;">
                                        Width: <?= $table['img-width'] * $table['img-ratio'] ?>px - Height:
                                        <?= $table['img-height'] * $table['img-ratio'] ?>px
                                    </span>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="formRow">
                                <label>Tệp video hiện tại</label>
                                <div class="formRight">
                                    <div class="mt10">
                                        <?php $pathImg = _upload_baiviet . $item["video"]; ?>

                                        <video width="300" height="300" autoplay muted loop controls style="width: 300px;object-fit: cover;height: 300px;aspect-ratio: 16/9;">

                                            <source src="<?= $pathImg ?>" type="video/mp4">

                                        </video>

                                        <span style="color:blue;display:block;font-size:16px;" class="mt20"><span style="color:#000;">Tên tệp video: </span> <?= @$item["video"] ?></span>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        <?php } ?>

                        <?php if ($table['img-gallery'] == true) { ?>

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

                                </div>
                                <?php
                                if (!empty($ds_photo)) {
                                    for ($i = 0; $i < count($ds_photo); $i++) { ?>

                                        <div class="item_trich">

                                            <img class="img_trich" src="<?= _upload_baiviet . $ds_photo[$i]['photo'] ?>" />

                                            <input type="text" rel="<?= $ds_photo[$i]['id'] ?>" value="<?= $ds_photo[$i]['stt'] ?>" class="update_stt tipS" />
                                            <a class="delete_images icon-jfi-trash jFiler-item-trash-action" title="<?= $ds_photo[$i]['id'] ?>" style="color:#FF0000"></a>

                                        </div>
                                    <?php } ?>
                                <?php } ?>
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

                                                <a href="<?= $https_config ?><?= $item["tenkhongdau_$k"] ?>" target="_blank" title="<?= $https_config ?>"><span><?= $https_config ?></span><span id="url_seo_<?= $k ?>"><?= $item["tenkhongdau_$k"] ?></span></a>

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



                                <div class="formRow">

                                    <label>Title [ <?= $v ?> ]: </label>

                                    <div class="formRight">

                                        <input type="text" data-validation="required" data-validation-error-msg="Không được để trống" value="<?= @$seoDB['title_' . $k] ?>" id="title" name="dataseo[title_<?= $k ?>]" title="Nội dung thẻ meta Title dùng để SEO" class="tipS input100" />

                                    </div>

                                    <div class="clear"></div>

                                </div>



                                <div class="formRow">

                                    <label>Keywords [ <?= $v ?> ]: </label>

                                    <div class="formRight">

                                        <input type="text" value="<?= @$seoDB['keywords_' . $k] ?>" id="title" name="dataseo[keywords_<?= $k ?>]" title="Từ khóa chính cho danh mục" class="tipS input100" />

                                    </div>

                                    <div class="clear"></div>

                                </div>



                                <div class="formRow">

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

                            <i class="far fa-save mr-2"></i>Lưu

                        </button>

                        <button type="submit" class="btn btn-sm bg-gradient-success" name="save-here"><i class="far fa-save mr-2"></i>Lưu tại trang</button>

                        <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>

                        <a class="btn btn-sm bg-gradient-danger text-white" href="index.html?com=attribute&act=man<?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?><?php if ($_GET['id_product'] != '') echo '&id_product=' . $_GET['id_product']; ?>">

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

        $('#star-product').commentStar({

            countSelected: $('#rank').val(),

            complete: function(vl) {

                $('#rank').val(vl);

            }

        });

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