<?php if($config_pr['seo']==true){ ?>

<script>
function text_count_changed(textfield_id, counter_id) {

    var v = $(textfield_id).val();

    if (parseInt(v.length) > 170) {

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

            success: function(result) {

            }

        });

    });



    $('.delete').click(function(e) {

        $(this).parent().remove();

    });



});
</script>

<div class="wrapper">

    <?php 
		$com = $_GET['com'];
		$type = $_GET['type'];
		$table = $GLOBAL[$com][$type];
	?>

    <div class="control_frm">

        <div class="bc">

            <ul id="breadcrumbs" class="breadcrumbs">

                <li><a href="index.html?com=map&act=add"><span>Chi nhánh</span></a></li>

                <li class="current"><a href="#" onclick="return false;"><?=($_GET['act']=='edit') ? 'Sửa':'Thêm'?></a>
                </li>

            </ul>

            <div class="clear"></div>

        </div>

    </div>



    <form name="supplier" id="form-validate" class="form"
        action="index.html?com=map&act=save<?=(!empty($_GET['id']) ? '&id='.$_GET['id'] : '')?><?=(!empty($_GET['type']) ? '&type='.$_GET['type'] : '')?>"
        method="post" enctype="multipart/form-data" autocomplete="off" accept-charset="utf-8">

        <div class="mtop0">

            <div class="oneOne">

                <div class="widget mtop0">

                    <div class="title chonngonngu" style="border-bottom: 0px solid transparent">

                        <ul>

                            <?php  foreach ($config['lang'] as $k => $v){ ?>

                            <li><a href="<?=$k?>" class="<?= ($k == 'vi') ? 'active': '' ?> tipS" title="<?=$v?>"><img
                                        src="./images/<?=$k?>.png" alt=""
                                        class="<?=$func->changeTitle($v)?>" /><?=$v?></a></li>

                            <?php } ?>

                        </ul>

                    </div>

                </div>

            </div>



            <div class="<?=($config_pr['full']==true) ? 'oneOne':'colLeft' ?>">

                <div class="widget mtop0">

                    <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />

                        <h6>Thông tin chung</h6>

                    </div>



                    <?php  foreach ($config['lang'] as $k => $v){ ?>

                    <div class="formRow lang_hidden lang_<?=$k?> <?= ($k == 'vi') ? 'active': '' ?>">

                        <label>Tiêu đề [<?=$v?>]</label>

                        <div class="formRight">

                            <input type="text" data-validation="required"
                                data-validation-error-msg="Tên không được để trống" name="data[ten_<?=$k?>]"
                                title="Nhập tên danh mục" id="ten_<?=$k?>" class="tipS validate[required]"
                                value="<?=@$item['ten_'.$k]?>" />

                        </div>

                        <div class="clear"></div>

                    </div>
                    <?php if($GLOBAL[$com][$type]['diachi']){?>
                    <div class="formRow lang_hidden lang_<?=$k?> <?= ($k == 'vi') ? 'active': '' ?>">

                        <label>Địa chỉ [<?=$v?>]</label>

                        <div class="ck_editor">

                            <textarea data-validation="required" data-validation-error-msg="Địa chỉ không được để trống"
                                title="Nhập địa chỉ [<?=$v?>]. " id="diachi_<?=$k?>" rows="3"
                                name="data[diachi_<?=$k?>]"><?=@$item['diachi_'.$k]?></textarea>

                        </div>

                        <div class="clear"></div>

                    </div>
                    <?php }?>
                    <?php if($GLOBAL[$com][$type]['mota']){?>
                    <div class="formRow lang_hidden lang_<?=$k?> <?= ($k == 'vi') ? 'active': '' ?>">

                        <label>Mô tả [<?=$v?>]</label>

                        <div class="ck_editor">

                            <textarea title="Nhập mô tả [<?=$v?>]. " data-height="400" id="mota_<?=$k?>" rows="3"
                                <?=($table['mota-ckeditor']==true) ? 'class="ck_editors"':'rows="8"' ?>
                                name="data[mota_<?=$k?>]"><?=@$item['mota_'.$k]?></textarea>

                        </div>

                        <div class="clear"></div>

                    </div>
                    <?php }?>
                    <?php if($GLOBAL[$com][$type]['noidung']){?>
                    <div class="formRow lang_hidden lang_<?=$k?> <?= ($k == 'vi') ? 'active': '' ?>">

                        <label>Nội dung [<?=$v?>]</label>

                        <div class="ck_editor">

                            <textarea title="Nhập nội dung [<?=$v?>]. " data-height="400" id="noidung_<?=$k?>" rows="8"
                                <?=($table['noidung-ckeditor']==true) ? 'class="ck_editors"':'rows="8"' ?>
                                name="data[noidung_<?=$k?>]"><?=@$item['noidung_'.$k]?></textarea>

                        </div>

                        <div class="clear"></div>

                    </div>
                    <?php }?>
                    <?php } ?>

                </div>

                <div class="clear"></div>

            </div>



            <div class="<?=($config_pr['full']==true) ? 'oneOne':'colRight' ?>">

                <div class="widget mtop0">

                    <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />

                        <h6>Hình ảnh và iframe</h6>

                    </div>

                    <?php if($GLOBAL[$com][$type]['phone']){?>
                    <div class="formRow">

                        <label>Phone</label>

                        <div class="formRight">

                            <input type="text" data-validation="required"
                                data-validation-error-msg="Điện thoại không được để trống" name="data[phone]"
                                title="Nhập phone" id="phone" class="tipS" value="<?=@$item['phone']?>" />

                        </div>

                        <div class="clear"></div>

                    </div>
                    <?php }?>

                    <?php if($GLOBAL[$com][$type]['diachi']){?>
                    <div class="formRow">

                        <label>Email</label>

                        <div class="formRight">

                            <input type="text" name="data[email]"
                                title="Nhập email" id="email" class="tipS" value="<?=@$item['email']?>" />

                        </div>

                        <div class="clear"></div>

                    </div>
                    <?php }?>

                    <?php if($GLOBAL[$com][$type]['email']){?>
                    <div class="formRow">

                        <label>Email</label>

                        <div class="formRight">

                            <input data-validation="required" data-validation-error-msg="Email không được để trống"
                                type="text" name="data[email]" title="Nhập email" id="email" class="tipS"
                                value="<?=@$item['email']?>" />

                        </div>

                        <div class="clear"></div>

                    </div>
                    <?php }?>
                    <?php if($GLOBAL[$com][$type]['toado']){?>
                    <div class="formRow">

                        <label>Tọa độ</label>

                        <div class="formRight">

                            <input type="text" data-validation="required"
                                data-validation-error-msg="Tọa độ không được để trống" name="data[toado]"
                                title="Nhập tọa độ" id="toado" class="tipS" value="<?=@$item['toado']?>" />

                        </div>

                        <div class="clear"></div>

                    </div>
                    <?php }?>
                    <?php if($table['website']){?>
                    <div class="formRow">

                        <label>Website</label>

                        <div class="formRight">

                            <input type="text" data-validation="required"
                                data-validation-error-msg="website không được để trống" name="data[website]"
                                title="Nhập web" id="website" class="tipS" value="<?=@$item['website']?>" />

                        </div>

                        <div class="clear"></div>

                    </div>
                    <?php }?>
                    <?php if($table['color']){?>
                    <div class="formRow">

                        <label>Color</label>

                        <div class="formRight">

                            <input type="text" data-validation="required"
                                data-validation-error-msg="color không được để trống" name="data[color]"
                                title="Nhập web" id="color" class="tipS" value="<?=@$item['color']?>" />

                        </div>

                        <div class="clear"></div>

                    </div>
                    <?php }?>
                    <?php if($_GET["type"]!='hotline'){ ?>
                    <div class="formRow">

                        <label>Iframe map <strong><a href="https://www.google.com/maps" target="_blank"
                                    title="Lấy mã nhúng Google Map">( <i class="fas fa-map-marker-alt"
                                        aria-hidden="true"></i> Lấy mã nhúng )</a></strong></label>

                        <div>

                            <textarea data-validation="required"
                                data-validation-error-msg="Iframe map không được để trống" title="Nhập iframe. "
                                id="iframe_map" rows="7" name="data[iframe_map]"><?=@$item['iframe_map']?></textarea>

                        </div>

                        <div class="clear"></div>

                    </div>
                    <?php }?>
                    <?php if($table['img']){?>
                    <div class="formRow">

                        <label>Tải hình ảnh:</label>

                        <div class="formRight">

                            <input type="file" id="file" name="file" />

                            <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS"
                                original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">

                            <br />

                            <br />

                            <span style="display: inline-block; line-height: 30px;color:#CCC;">

                                Width: 268px - Height:268px

                            </span>

                        </div>

                        <div class="clear"></div>

                    </div>

                    <?php if($_GET['act']=='edit'){?>

                    <div class="formRow">

                        <label>Hình Hiện Tại :</label>

                        <div class="formRight">

                            <div class="mt10"><img src="<?=_upload_hinhanh.$item['photo']?>" alt="NO PHOTO"
                                    width="100" /></div>

                        </div>

                        <div class="clear"></div>

                    </div>

                    <?php } ?>
                    <?php }?>
                    <div class="formRow">

                        <div class="formRight">

                            <label>Số thứ tự: </label>

                            <input type="text" class="tipS"
                                value="<?=isset($item['stt'])?$item['stt']:$func->checkNumb('stt',$com,'')?>" name="stt"
                                style="width:40px; text-align:center;" onkeypress="return OnlyNumber(event)"
                                original-title="Số thứ tự của danh mục, chỉ nhập số">

                        </div>

                        <div class="clear"></div>

                    </div>

                    <div class="formRow">

                        <div class="formRight">

                            <label class="stardust-checkbox">

                                Hiển thị

                                <input class="stardust-checkbox__input"
                                    <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>
                                    name="hienthi" type="checkbox" value="1" style="display:none">

                                <div class="stardust-checkbox__box"></div>

                            </label>

                        </div>

                    </div>

                </div>

                <div class="clear"></div>

            </div>

        </div>



        <div class="formRow fixedBottom">

            <div class="formRight">

                <input type="hidden" name="id" value="<?=$_GET['id']?>" />

                <div class="box-admin" style="display:flex; align-items:center;justify-content:flex-end">

                    <div class="box-action">

                        <button type="submit" class="btn btn-sm bg-gradient-primary text-white">

                            <i class="far fa-save mr-2"></i>Lưu

                        </button>

                        <button type="submit" class="btn btn-sm bg-gradient-success" name="save-here"><i
                                class="far fa-save mr-2"></i>Lưu tại trang</button>

                        <button type="reset" class="btn btn-sm bg-gradient-secondary"><i
                                class="fas fa-redo mr-2"></i>Làm lại</button>

                        <a class="btn btn-sm bg-gradient-danger text-white" href="index.html?com=map&act=man">

                            <i class="fas fa-sign-out-alt mr-2"></i>Thoát

                        </a>

                    </div>

                </div>



            </div>

        </div>

    </form>

</div>