<?php $table=$setting[$com]['properties'];?>
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
});
</script>
<form name="supplier" class="form form-validate"
    action="index.html?com=properties&act=save<?php if($_GET['id_product']!='') echo'&id_product='. $_GET['id_product'];?><?php if($_GET['id']!='') echo'&id='. $_GET['id'];?><?php if($_GET['type']!='') echo'&type='. $_GET['type'];?>" method="post"
    enctype="multipart/form-data" autocomplete="off" accept-charset="utf-8">

    <div class="control_frm">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a
                        href="index.html?com=properties&act=add<?php if($_GET['id_product']!='') echo'&id_product='. $_GET['id_product'];?><?php if($_GET['id']!='') echo'&id='. $_GET['id'];?><?php if($_GET['type']!='') echo'&type='. $_GET['type'];?>"><span><?=$table['name']?></span></a>
                </li>
                <li class="current"><a href="#"
                        onclick="return false;"><?=($_GET['act']=='capnhat') ? 'Cập nhật':'Thêm'?></a></li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
    <div class="oneOne">
        <div class="widget mtop0">
            <div class="title chonngonngu" style="border-bottom: 0px solid transparent">
                <ul>
                    <?php  foreach ($config['lang'] as $k => $v){ ?>
                    <li><a href="<?=$k?>" class="<?= ($k == 'vi') ? 'active': '' ?> tipS" title="<?=$v?>"><img
                                src="./images/<?=$k?>.png" alt="" class="<?=$func->changeTitle($v)?>" /><?=$v?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="<?=($table['full']==true) ? 'oneOne':'colLeft' ?>">
        <div class="widget mtop0">
            <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
                <h6>Thông tin bài viết</h6>
            </div>

            <?php  foreach ($config['lang'] as $k => $v){ ?>
            <div class="formRow lang_hidden lang_<?=$k?> <?= ($k == 'vi') ? 'active': '' ?>">
                <label>Tiêu đề [<?=$v?>]</label>
                <div class="formRight">
                    <input data-validation="required" data-validation-error-msg="Tên không được để trống" type="text" name="data[ten_<?=$k?>]" title="Nhập tên danh mục" id="ten_<?=$k?>"
                        class="tipS validate[required]" value="<?=@$item['ten_'.$k]?>" />
                </div>
                <div class="clear"></div>
            </div>
            <?php } ?>
            <?php if($table['color']){?>
                <div class="formRow">
                    <label>Màu sắc</label>
                    <div class="formRight">
                        <input type="text" class="cp3" data-validation="required" data-validation-error-msg="Color không được để trống" name="data[colors]" title="Nhập color" id="colors"
                            class="tipS" value="<?=@$item['colors']?>" />
                    </div>
                    <div class="clear"></div>
                </div>
            <?php }?>
            <?php if($table['price']){?>
                <div class="formRow">
                    <label>Giá bán</label>
                    <div class="formRight">
                        <input type="text" class="conso" data-validation="required" data-validation-error-msg="Giá không được để trống" name="data[price]" title="Nhập giá" id="price"
                            class="tipS" value="<?=@$item['price']?>" />
                    </div>
                    <div class="clear"></div>
                </div>
            <?php }?>
            <?php if($table['qty']){?>
                <div class="formRow">
                    <label>Số lượng</label>
                    <div class="formRight">
                        <input type="text" data-validation="required" data-validation-error-msg="Số lượng không được để trống" name="data[qty]" title="Nhập số lượng" id="qty" onkeypress="return onlyNumber(event)"
                            class="tipS" value="<?=@$item['qty']?>" />
                    </div>
                    <div class="clear"></div>
                </div>
            <?php }?>
        </div>

    </div>
    <div class="<?=($table['photo']!=true) ? 'oneOne':'colRight' ?>">
        <?php if($table['photo']==true){ ?>
        <div class="widget mtop0">
            <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
                <h6>Thuộc tính</h6>
            </div>
            <div class="formRow">
            <label>Tải hình ảnh:</label>
            <div class="formRight">
                <?php if($_GET['act']=='edit'){?>
                     <input type="file" id="file" name="file" />
                <?php }else{?>
                    <input data-validation="required"
                     data-validation-allowing="jpg, png" 
                     data-validation-max-size="300kb" 
                     data-validation-error-msg-required="Bạn chưa chọn file" type="file" id="file" name="file" />
                <?php }?>
                <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS"
                    original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
                <br />
                <br />
                <span style="display: inline-block; line-height: 30px;color:#CCC;">
                    Width: <?=$table['img-width']*$table['img-ratio']?>px -
                    Height:<?=$table['img-height']*$table['img-ratio']?>px
                </span>
            </div>
            <div class="clear"></div>
        </div>
            <div class="formRow">
                <label>Hình Hiện Tại :</label>
                <div class="formRight">
                    <div class="mt10"><img src="<?=$folder.$item['photo']?>" alt="NO PHOTO" width="100" /></div>
                </div>
                <div class="clear"></div>
            </div>
              <div class="formRow">
                <div class="formRight">
                    <label class="stardust-checkbox">
                        Hiển thị
                        <input class="stardust-checkbox__input"
                            <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> name="hienthi"
                            type="checkbox" value="1" style="display:none">
                        <div class="stardust-checkbox__box"></div>
                    </label>
                </div>
            </div>
            <div class="formRow">
                <div class="formRight">
                    <label>Số thứ tự: </label>
                    <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:$func->checkNumb('stt','baiviet_properties',$type)?>"
                        name="data[stt]" style="width:40px; text-align:center;"
                        onkeypress="return onlyNumber(event)"
                        original-title="Số thứ tự của danh mục, chỉ nhập số">
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <?php } ?>
    </div>
    <div class="formRow fixedBottom">
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