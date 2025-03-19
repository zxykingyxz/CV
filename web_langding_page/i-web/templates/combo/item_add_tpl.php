<link href="plugin/sumoselect/sumoselect.css" rel="stylesheet" />

<script src="plugin/sumoselect/jquery.sumoselect.min.js"></script>


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
<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
            <li><a href="index.html?com=combo&act=man<?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?><?php if ($_GET['page'] != '') echo '&page=' . $_GET['page']; ?>"><span><?= $GLOBAL[$com][$type]['title'] ?></span></a>
            </li>
            <li class="current"><a href="#" onclick="return false;"><?= _them ?>
                    <?= $GLOBAL[$com][$type]['title_main'] ?></a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>

<?php
?>
<form name="supplier" class="form form-validate" action="index.html?com=combo&act=save<?php if ($_GET['id'] != '') echo '&id=' . $_GET['id']; ?><?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?><?php if ($_GET['page'] != '') echo '&page=' . $_GET['page']; ?>" method="post" enctype="multipart/form-data" autocomplete="off" accept-charset="utf-8">
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
                        <label><?= !empty($GLOBAL[$com][$type]['ten_admin']) ? $GLOBAL[$com][$type]['ten_admin'] : _tieude ?> [<?= $v ?>]</label>
                        <div class="formRight">
                            <input type="text" name="data[ten_<?= $k ?>]" title="Nhập tên danh mục" id="ten_<?= $k ?>" class="tipS validate[required]" value="<?= @$item['ten_' . $k] ?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php if ($GLOBAL[$com][$type]['img'] == true) { ?>
                        <div class="formRow lang_hidden lang_<?= $k ?>  <?= ($k == 'vi') ? 'active' : '' ?>">
                            <label><?= _uploadhinhanh ?>:</label>
                            <div class="formRight">
                                <?php if ($_GET['act'] == 'edit' || $_GET['act'] == 'copy') { ?>

                                    <input type="file" id="file_<?= $k ?>" name="file_<?= $k ?>" />

                                <?php } else { ?>


                                    <input data-validation="required" data-validation-allowing="jpg, png" data-validation-max-size="300kb" data-validation-error-msg-required="Bạn chưa chọn file" type="file" id="file_<?= $k ?>" name="file_<?= $k ?>" />


                                <?php } ?>
                                <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
                                <br />
                                <br />
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
                            <label>Hình Hiện Tại :</label>
                            <div class="formRight">
                                <div class="mt10"><img src="<?= $folder . $item["photo"] ?>" alt="NO PHOTO" width="100" /></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    <?php } ?>
                    <?php if ($GLOBAL[$com][$type]['photo2'] == true) { ?>
                        <div class="formRow lang_hidden lang_<?= $k ?>  <?= ($k == 'vi') ? 'active' : '' ?>">
                            <label>Tải hình ảnh 2:</label>
                            <div class="formRight">
                                <?php if ($_GET['act'] == 'edit' || $_GET['act'] == 'copy') { ?>

                                    <input type="file" id="filephu" name="filephu" />

                                <?php } else { ?>

                                    <input data-validation="required" data-validation-allowing="jpg, png" data-validation-max-size="300kb" data-validation-error-msg-required="Bạn chưa chọn file" type="file" id="filephu" name="filephu" />

                                <?php } ?>
                                <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
                                <br />
                                <br />
                                <span style="display: inline-block; line-height: 30px;color:#CCC;">
                                    Width: <?= $GLOBAL[$com][$type]['img-width'] * $GLOBAL[$com][$type]['img-ratio'] ?>px - Height:
                                    <?= $GLOBAL[$com][$type]['img-height'] * $GLOBAL[$com][$type]['img-ratio'] ?>px
                                </span>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow lang_hidden lang_<?= $k ?>  <?= ($k == 'vi') ? 'active' : '' ?>">
                            <label>Hình Hiện Tại :</label>
                            <div class="formRight">
                                <div class="mt10"><img src="<?= $folder . $item['photo2'] ?>" alt="NO PHOTO" width="100" /></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    <?php } ?>



                    <?php if ($GLOBAL[$com][$type]['slogan'] == true) { ?>
                        <div class="formRow lang_hidden lang_<?= $k ?>  <?= ($k == 'vi') ? 'active' : '' ?>">
                            <label>Slogan [<?= $v ?>]</label>
                            <div class="formRight">
                                <input type="text" id="slogan_<?= $k ?>" name="data[slogan_<?= $k ?>]" title="Nhập link liên kết cho hình ảnh" class="tipS" value="<?= @$item["slogan_$k"] ?>" />
                            </div>
                            <div class="clear"></div>
                        </div>
                    <?php } ?>
                    <?php if ($GLOBAL[$com][$type]['job'] == true) { ?>
                        <div class="formRow lang_hidden lang_<?= $k ?>  <?= ($k == 'vi') ? 'active' : '' ?>">
                            <label>Công việc [<?= $v ?>]</label>
                            <div class="formRight">
                                <input type="text" id="job_<?= $k ?>" name="data[job_<?= $k ?>]" title="Nhập link liên kết cho hình ảnh" class="tipS" value="<?= @$item["job_$k"] ?>" />
                            </div>
                            <div class="clear"></div>
                        </div>
                    <?php } ?>
                <?php } ?>
                <?php if ($GLOBAL[$com][$type]['code'] == true) { ?>
                    <div class="formRow">
                        <label>Mã Combo</label>
                        <div class="formRight">
                            <input type="text" name="data[code]" title="Nhập số điện thoại" id="code" class="tipS" value="<?= @$item['code'] ?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>
                <?php if ($GLOBAL[$com][$type]['price'] == true) { ?>

                    <div class="formRow">

                        <label>Giá combo</label>

                        <div class="formRight">

                            <input type="text" name="data[price]" title="Nhập giá " id="price" class="conso tipS" value="<?= @$item['price'] ?>" />

                        </div>

                        <div class="clear"></div>

                    </div>

                <?php } ?>
                <?php
                if ($GLOBAL[$com][$type]['id_product'] == true) {
                    $dmc1_products = $db->rawQuery("select id,ten_$lang as ten from #_baiviet_list where type=? and hienthi=1 order by stt asc,id desc", array('san-pham'));
                    // $ex_tags = json_decode($item['id_product'], true);
                ?>
                    <?php foreach ($dmc1_products as $dmc1_product) {
                        $data_products = $db->rawQuery("select id,ten_$lang as ten from #_baiviet where type=? and id_list=? and hienthi=1 order by stt asc,id desc", array('san-pham', $dmc1_product['id']));
                        if (!empty($data_products)) { ?>
                            <div class="formRow">

                                <label>Chọn <?= $dmc1_product['ten'] ?> (nếu có)</label>

                                <div class="formRight">

                                    <select name="data[id_product][]">
                                        <option value="">Chọn sản phẩm</option>
                                        <?php foreach ($data_products as $k => $v) { ?>
                                            <option value="<?= $v['id'] ?>" <?php /* <?=(isset($ex_tags) && count($ex_tags)>0) ? ((in_array($v['id'],$ex_tags)) ? 'selected':''):''?>
*/ ?> <?= (in_array($v["id"], explode(",", $item['id_product']))) ? 'selected' : '' ?>>
                                                <?= $v['ten'] ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                                <div class="clear"></div>
                            </div>
                        <?php } ?>

                    <?php } ?>


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
                <?php if ($GLOBAL[$com][$type]['video'] == true) { ?>

                    <div class="formRow ">

                        <label>Upload video :</label>

                        <div class="formRight">

                            <input type="file" id="filevideo" name="filevideo" />

                            <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">

                        </div>

                        <div class="clear"></div>

                    </div>

                    <div class="formRow ">

                        <label>Tệp video hiện tại</label>

                        <div class="formRight">

                            <div class="mt10 change-photo">

                                <?php $pathImg = _upload_hinhanh . $item["video"]; ?>

                                <video width="300" height="300" autoplay muted loop controls style="width: 300px;object-fit: cover;height: 300px;aspect-ratio: 16/9;">

                                    <source src="<?= $pathImg ?>" type="video/mp4">

                                </video>

                                <span style="color:blue;display:block;font-size:16px;" class="mt20"><span style="color:#000;">Tên tệp video: </span> <?= @$item["video"] ?></span>

                            </div>

                        </div>

                        <div class="clear"></div>

                    </div>

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
                            </select>

                        </div>

                        <div class="clear"></div>

                    </div>

                <?php } ?>
                <?php if ($GLOBAL[$com][$type]['link_video'] == true) { ?>
                    <?php if ($_GET['act'] == 'edit') { ?>
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
                <?php if ($GLOBAL[$com][$type]['numb'] == true) { ?>
                    <div class="formRow lang_hidden lang_<?= $k ?> <?= ($k == 'vi') ? 'active' : '' ?>">
                        <label>Number</label>
                        <div class="formRight">
                            <input type="text" data-validation="required" data-validation-error-msg="Số không được bỏ trống" name="data[number]" title="Nhập tên danh mục" id="number" class="conso tipS validate[required]" value="<?= @$item['number'] ?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>

                <?php if ($GLOBAL[$com][$type]['phone'] == true) { ?>
                    <div class="formRow">
                        <label>Số điện thoại</label>
                        <div class="formRight">
                            <input type="text" name="data[phone]" title="Nhập số điện thoại" id="phone" class="tipS" value="<?= @$item['phone'] ?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>
                <?php if ($GLOBAL[$com][$type]['zalo'] == true) { ?>
                    <div class="formRow">
                        <label>Số zalo</label>
                        <div class="formRight">
                            <input type="text" name="data[zalo]" title="Nhập số zalo" id="zalo" class="tipS" value="<?= @$item['zalo'] ?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>
                <?php if ($GLOBAL[$com][$type]['email'] == true) { ?>
                    <div class="formRow">
                        <label>Email</label>
                        <div class="formRight">
                            <input type="text" name="data[email]" title="Nhập email" id="email" class="tipS" value="<?= @$item['email'] ?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>
                <?php if ($GLOBAL[$com][$type]['address'] == true) { ?>
                    <div class="formRow">
                        <label>Địa chỉ</label>
                        <div class="formRight">
                            <input type="text" name="data[address]" title="Nhập address" id="address" class="tipS" value="<?= @$item['address'] ?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>


                <?php if ($GLOBAL[$com][$type]['link'] == true) { ?>
                    <div class="formRow">
                        <label>Link liên kết:</label>
                        <div class="formRight">
                            <input type="text" id="code_pro" name="data[link]" title="Nhập link liên kết cho hình ảnh" class="tipS" value="<?= @$item['link'] ?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>
                <?php if ($GLOBAL[$com][$type]['img-gallery'] == true) { ?>

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

                                            <img class="img_trich" src="<?= _upload_hinhanh . $ds_photo[$i]['photo'] ?>" />

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
                    <a class="btn btn-sm bg-gradient-danger text-white" href="index.html?com=combo&act=man<?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?><?php if ($_GET['page'] != '') echo '&page=' . $_GET['page']; ?>">
                        <i class="fas fa-sign-out-alt mr-2"></i>Thoát
                    </a>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>

</form>

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

        window.asd = $('.select2').SumoSelect({
            placeholder: 'Chọn khuyến mãi',
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

        window.asd = $('.product').SumoSelect({
            placeholder: 'Chọn sản phẩm',
            csvDispCount: 3,
            captionFormat: '{0} Selected',
            floatWidth: 500,
            forceCustomRendering: false,
            triggerChangeCombined: true,
            selectAll: true,
            search: true,
            searchText: 'Nhập từ khóa tìm kiếm...',
            noMatch: 'No matches for "{0}"',
            prefix: '',
            locale: ['OK', 'Cancel', 'Select All'],
            up: 'false',
            showTitle: 'true',
        });

        window.asd = $('.select-size').SumoSelect({
            placeholder: 'Chọn size',
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

        window.asd = $('.selectTags').SumoSelect({
            placeholder: 'Chọn tags sản phẩm',
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