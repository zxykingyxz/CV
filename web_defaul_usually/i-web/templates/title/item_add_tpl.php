<?php if($GLOBAL[$com][$type]['seo']){ ?>
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
    action="index.html?com=title&act=save<?php if($_GET['type']!='') echo'&type='. $_GET['type'];?>" method="post"
    enctype="multipart/form-data" autocomplete="off" accept-charset="utf-8">

    <div class="control_frm">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a
                        href="index.html?com=title&act=capnhat<?php if($_GET['type']!='') echo'&type='. $_GET['type'];?>"><span><?=$GLOBAL[$com][$type]['title']?></span></a>
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
    <div class="<?=($GLOBAL[$com][$type]['full']==true) ? 'oneOne':'colLeft' ?>">
        <div class="widget mtop0">
            <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
                <h6>Thông tin bài viết</h6>
            </div>

            <?php  foreach ($config['lang'] as $k => $v){ ?>
            <div class="formRow lang_hidden lang_<?=$k?> <?= ($k == 'vi') ? 'active': '' ?>">
                <label>Tiêu đề [<?=$v?>]</label>
                <div class="formRight">
                    <input data-validation="required" data-validation-error-msg="Tên không được để trống" type="text" name="data[title_<?=$k?>]" title="Nhập tên danh mục" id="title_<?=$k?>"
                        class="tipS validate[required]" value="<?=@$item['title_'.$k]?>" />
                </div>
                <div class="clear"></div>
            </div>
            <?php if($GLOBAL[$com][$type]['mota']){ ?>
            <div class="formRow lang_hidden lang_<?=$k?> <?= ($k == 'vi') ? 'active': '' ?>">
                <label>Mô tả [<?=$v?>]</label>
                <div class="ck_editor">
                    <textarea title="Nhập mô tả . " data-height="400" id="mota_<?=$k?>"
                        <?= ($GLOBAL[$com][$type]['mota-ckeditor']==true) ? 'class="ck_editors"':'rows="8"' ?>
                        name="data[mota_<?=$k?>]"><?=@$item['mota_'.$k]?></textarea>
                </div>
                <div class="clear"></div>
            </div>
            <?php } ?>

            <?php if($GLOBAL[$com][$type]['noidung']){ ?>
            <div class="formRow lang_hidden lang_<?=$k?> <?= ($k == 'vi') ? 'active': '' ?>">
                <label>Nội dung [<?=$v?>]</label>
                <div class="ck_editor">
                    <textarea title="Nhập nội dung . " data-height="400" id="noidung_<?=$k?>"
                        <?= ($GLOBAL[$com][$type]['noidung-ckeditor']==true) ? 'class="ck_editors"':'rows="8"' ?>
                        name="data[noidung_<?=$k?>]"><?=@$item['noidung_'.$k]?></textarea>
                </div>
                <div class="clear"></div>
            </div>
            <?php } ?>
            <?php } ?>
        </div>

    </div>
    <div class="<?=($GLOBAL[$com][$type]['full']==true) ? 'oneOne':'colRight' ?>">
        <?php if($GLOBAL[$com][$type]['img']==true){ ?>
        <div class="widget mtop0">
            <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
                <h6>Thuộc tính</h6>
            </div>
            <?php if($GLOBAL[$com][$type]['link']==true) {?>
            <div class="formRow">
                <label>Link youtube</label>
                <div class="formRight">
                    <input type="text" name="data[links]" title="Nhập tên link youtube" id="links" class="tipS"
                        value="<?=@$item['links']?>" />
                </div>
                <div class="clear"></div>
            </div>
            <?php } ?>
            <div class="formRow">
                <label>Tải hình ảnh:</label>
                <div class="formRight">
                    <input type="file" id="file" name="file" />
                    <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS"
                        original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
                    <br />
                    <br />
                    <span style="display: inline-block; line-height: 30px;color:#CCC;">
                        Width: <?=$GLOBAL[$com][$type]['img-width']*$GLOBAL[$com][$type]['img-ratio']?>px - Height:
                        <?=$GLOBAL[$com][$type]['img-height']*$GLOBAL[$com][$type]['img-ratio']?>px
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
        </div>
        <?php if($GLOBAL[$com][$type]['img-gallery']==true){ ?>
        <div class="formRow">
            <label>Hình đính kèm:
                <span>[Width:<?=$table['multi-gallery-arr'][$type]['width_photo']*$table['multi-gallery-arr'][$type]['thumb_ratio_photo']?>px
                    -
                    Height:
                    <?=$table['multi-gallery-arr'][$type]['thumb_height_photo']*$table['multi-gallery-arr'][$type]['thumb_ratio_photo']?>px]</span>
            </label>
            <div class="formRight">
                <a class="file_input" data-jfiler-name="files" data-jfiler-extensions="jpg, jpeg, png, gif">
                    <div class="jFiler jFiler-theme-dragdropbox">
                        <div class="jFiler-input-dragDrop">
                            <div class="jFiler-input-inner">
                                <div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div>
                                <div class="jFiler-input-text">
                                    <h3>Upload files here</h3>
                                </div>
                                <span class="jFiler-input-choose-btn btn-custom blue-light">Browse Files</span>
                            </div>
                        </div>
                    </div>
                </a>
                <?php if($act=='capnhat'){?>
                <?php if(count($dsInfo)!=0){?>
                <?php for($i=0;$i<count($dsInfo);$i++){?>
                <div class="item_trich">
                    <img class="img_trich" src="<?=$folder.$dsInfo[$i]['photo']?>" />
                    <input type="text" rel="<?=$dsInfo[$i]['id']?>" value="<?=$dsInfo[$i]['stt']?>"
                        class="update_stt tipS" />
                    <a class="delete_images icon-jfi-trash jFiler-item-trash-action" title="<?=$dsInfo[$i]['id']?>"
                        style="color:#FF0000"></a>
                </div>
                <?php } ?>
                <?php }?>
                <?php }?>
            </div>
            <div class="clear"></div>
        </div>
        <?php } ?>
        <?php } ?>
        <?php if($GLOBAL[$com][$type]['seo']){ ?>
          <?php if(isset($GLOBAL[$com][$type]['seo'])&&$GLOBAL[$com][$type]['seo']==true){
            $seoDB = $seo->getSeoDB(0,$com,$act,$type);
        ?>
        <div class="widget mtop10">
            <div class="formRow">
                <div class="formRight">
                   <div class="box-seo">
                         <?php  foreach ($config['seo-lang'] as $k => $v){ ?>
                            <p
                                style="font-size:18px;font-weight:normal;border-bottom:1px solid #ccc;padding-bottom:10px">
                                Hiển thị kết quả tìm kiếm google search</p>
                            <h3 style="padding-top: 10px;font-size: 20px;line-height: 1.3;color: #1a0dab;margin-bottom: 0px;font-weight:500"
                                class="title_seo" id="title_seo">
                                <?=($seoDB['title_'.$k]!='') ? $seoDB['title_'.$k] : '[SEO Onpage] là gì? Hướng dẫn tối ưu SEO Onpage...' ?>
                            </h3>
                            <p style="padding-top:10px;font-size:14px;line-height: 1.57;word-wrap: break-word;color: #6a6a6a;margin-bottom: 0px;"
                                class="description_seo" id="description_seo">
                                <?=($seoDB['description_'.$k]!='') ? $seoDB['description_'.$k] : ' Hướng dẫn SEO onpage căn bản tối ưu để trang web chuẩn SEO lên top Google nhanh và bền vững, kỹ thuật tối ưu SEO onpage đơn giản' ?>

                            </p>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
        <div class="widget <?=($GLOBAL[$com][$type]['img']==true) ? 'mtop10':'mtop0'?>">
            <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
                <h6>Nội dung seo</h6>
            </div>
             <?php  foreach ($config['seo-lang'] as $k => $v){ ?>
                    <div class="formRow">
                        <label>Title [ <?=$v?> ]: </label>
                        <div class="formRight">
                            <input data-validation="required" data-validation-error-msg="Title không được để trống" type="text" value="<?=@$seoDB['title_'.$k]?>" id="title" name="dataseo[title_<?=$k?>]"
                                title="Nội dung thẻ meta Title dùng để SEO" class="tipS input100" />
                        </div>
                        <div class="clear"></div>
                    </div>

                    <div class="formRow">
                        <label>Keywords [ <?=$v?> ]: </label>
                        <div class="formRight">
                            <input type="text" value="<?=@$seoDB['keywords_'.$k]?>" id="title" name="dataseo[keywords_<?=$k?>]"
                                title="Từ khóa chính cho danh mục" class="tipS input100" />
                        </div>
                        <div class="clear"></div>
                    </div>

                    <div class="formRow">
                        <label>Description [ <?=$v?> ]:</label>
                        <div class="formRight">
                            <textarea data-validation="required" data-validation-error-msg="Description không được để trống" rows="4" cols="" title="Nội dung thẻ meta Description dùng để SEO" class="tipS input100"
                                name="dataseo[description_<?=$k?>]" id="description"><?=@$seoDB['description_'.$k]?></textarea>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="formRight">
                            <input readonly="readonly" type="text"
                                style="width:45px; margin-top:10px; text-align:center;" name="des_char" id="des_char"
                                value="<?=@$item['des_char']?>" /> <?=_kytu?> <b>(Từ 160-300 ký tự)</b>
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>
            <?php } ?>
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
<script>
$(document).ready(function() {
    $('.file_input').filer({
        showThumbs: true,
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