<?php if($$GLOBAL['video']['video']['seo']==true){ ?>
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
});
</script>
<div class="wrapper">

    <div class="control_frm">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a
                        href="index.html?com=video&act=add<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span><?=($_GET['act']=='edit') ? _sua : _them?>
                            <?=$GLOBAL['video']['video']['title_main']?></span></a></li>
                <li class="current"><a href="#" onclick="return false;"><?=($_GET['act']=='edit') ? _sua : _them?></a>
                </li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>

    <form name="supplier" id="validate" class="form"
        action="index.html?com=video&act=save<?php if($_REQUEST['id']!='') echo'&id='. $_REQUEST['id'];?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"
        method="post" enctype="multipart/form-data">
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
            <div class="<?=($config_cap1['full']==true) ? 'oneOne':'colLeft' ?>">
                <div class="widget mtop0">
                    <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
                        <h6><?=_thongtin?> <?=$GLOBAL['video']['video']['title_main']?></h6>
                    </div>
                    <?php  foreach ($config['lang'] as $k => $v){ ?>
                    <div class="formRow lang_hidden lang_<?=$k?> <?= ($k == 'vi') ? 'active': '' ?>">
                        <label><?=_tieude?> [<?=$v?>]</label>
                        <div class="formRight">
                            <input type="text" name="data[ten_<?=$k?>]" title="Nhập tên danh mục" id="ten_<?=$k?>"
                                class="tipS validate[required]" value="<?=@$item['ten_'.$k]?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php if($GLOBAL['video']['video']['mota']==true){ ?>
                    <div class="formRow lang_hidden lang_<?=$k?> <?= ($k == 'vi') ? 'active': '' ?>">
                        <label><?=_mota?> [<?=$v?>]</label>
                        <div class="ck_editor">
                            <textarea title="Nhập mô tả . " data-height="400" id="mota_<?=$k?>"
                                <?= ($GLOBAL['video']['video']['mota-ckeditor']==true) ? 'class="ck_editors"':'rows="8"' ?>
                                name="data[mota_<?=$k?>]"><?=@$item['mota_'.$k]?></textarea>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php } ?>
                    <?php if($GLOBAL['video']['video']['nguoidang']==true){?>

                        <div class="formRow">

                            <label>Tên người đăng</label>

                            <div class="formRight">

                                <input type="text" name="data[nguoidang]" title="Nhập người đăng" id="nguoidang" class="tipS"
                                    value="<?=@$item['nguoidang']?>" />

                            </div>

                            <div class="clear"></div>

                        </div>

                    <?php }?>
                    <?php } ?>
                </div>
            </div>

            <div class="<?=($config_cap1['full']==true) ? 'oneOne':'colRight' ?>">
                <div class="widget mtop0">
                    <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
                        <h6><?=_thongtin?> <?=$GLOBAL['video']['video']['title_main']?></h6>
                    </div>
                    <?php if($GLOBAL['video']['video']['img']==true){ ?>
                    <div class="formRow ">
                        <label><?=_uploadhinhanh?>:</label>
                        <div class="formRight">
                            <input type="file" id="file" name="file" />
                            <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS"
                                original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
                            <span style="display: inline-block; line-height: 30px;color:#CCC;">
                                Width:
                                <?=$GLOBAL['video']['video']['img-width']*$GLOBAL['video']['video']['img-ratio']?>px -
                                Height:
                                <?=$GLOBAL['video']['video']['img-height']*$GLOBAL['video']['video']['img-ratio']?>px
                            </span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php if($_GET['act']=='edit'){?>
                    <div class="formRow ">
                        <label>Hình hiện tại :</label>
                        <div class="formRight">

                            <div class="mt10"><img src="<?=_upload_hinhanh.$item['photo']?>" alt="NO PHOTO"
                                    width="100" /></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php } ?>
                    <?php } ?>

                    <?php if($GLOBAL['video']['video']['icon']==true){ ?>

                    <div class="formRow">

                        <label>Tải avata:</label>

                        <div class="formRight">

                            <input type="file" id="file" name="icon" />

                            <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS"
                                original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">

                            <br />

                            <br />

                            <span style="display: inline-block; line-height: 30px;color:#CCC;">

                                Width: <?=$table['img-width1']*$table['img-ratio']?>px -

                                Height:<?=$table['img-height1']*$table['img-ratio']?>px

                            </span>

                        </div>

                        <div class="clear"></div>

                    </div>

                    <?php if($_GET['act']=='edit'){?>

                    <div class="formRow">

                        <label>Hình Hiện Tại :</label>

                        <div class="formRight">

                            <div class="mt10"><img src="<?=_upload_hinhanh.$item['icon']?>" alt="NO PHOTO"
                                    width="100" /></div>

                        </div>

                        <div class="clear"></div>

                    </div>

                    <?php } ?>

                    <?php } ?>

                    <?php if($GLOBAL['video']['video']['upload']==true){ ?>
                    <div class="formRow ">
                        <label>Upload video:</label>
                        <div class="formRight">
                            <input type="file" id="video" name="video" />
                            <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS"
                                original-title="Tải hình ảnh (ảnh mp4)">
                            <span style="display: inline-block; line-height: 30px;color:#CCC;">
                                mp4|MP4
                            </span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Video hiện đại</label>
                        <div class="formRight">
                            <video width="300" height="200" autoplay muted controls>
                                <source src="<?=_upload_hinhanh.@$item['video']?>" type="video/mp4">
                            </video>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php } ?>

                    <?php if($GLOBAL['video']['video']['link']==true){ ?>
                    <?php if($_GET['act']=='edit'){?>
                    <div class="formRow">
                        <label>Video hiện tại :</label>
                        <div class="formRight">

                            <object width="300" height="200">
                                <param name="movie"
                                    value="//www.youtube.com/v/<?=$func->getYoutube($item['links'])?>?version=3&amp;hl=vi_VN&amp;rel=0">
                                </param>
                                <param name="allowFullScreen" value="true">
                                </param>
                                <param name="allowscriptaccess" value="always">
                                </param><embed
                                    src="//www.youtube.com/v/<?=$func->getYoutube($item['links'])?>?version=3&amp;hl=vi_VN&amp;rel=0"
                                    type="application/x-shockwave-flash" width="300" height="200"
                                    allowscriptaccess="always" allowfullscreen="true" wmode="transparent"></embed>
                            </object>

                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php } ?>
                    <div class="formRow">
                        <label>Link youtube</label>
                        <div class="formRight">
                            <input type="text" name="data[links]" title="Nhập tên links youtobe" id="ten_en"
                                class="tipS validate[required]" value="<?=@$item['links']?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php } ?>


                    <?php if($GLOBAL['video']['video']['seo']==true){ ?>
                    <div class="widget mtop10">
                        <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
                            <h6><?=_thuoctinhseo?></h6>
                        </div>
                        <div class="formRow">
                            <label><?=_title1?></label>
                            <div class="formRight">
                                <input type="text" value="<?=@$item['title']?>" name="data[title]"
                                    title="Nội dung thẻ meta Title dùng để SEO" class="tipS" />
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow">
                            <label><?=_keywords?></label>
                            <div class="formRight">
                                <input type="text" value="<?=@$item['keywords']?>" name="data[keywords]"
                                    title="Từ khóa chính cho danh mục" class="tipS" />
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow">
                            <label><?=_decription?>:</label>
                            <div class="formRight">
                                <textarea rows="4" cols="" title="Nội dung thẻ meta Description dùng để SEO"
                                    class="tipS" name="data[description]"
                                    id="description"><?=@$item['description']?></textarea>
                                <input readonly="readonly" type="text"
                                    style="width:45px; margin-top:10px; text-align:center;" name="des_char"
                                    id="des_char" value="<?=@$item['des_char']?>" /> ký tự <b>(Tốt nhất là 68 - 170 ký
                                    tự)</b>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <?php } ?>
                    <div class="formRow">
                        <div class="formRight">
                            <label><?=_sothutu?>: </label>
                            <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt"
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
            </div>

        </div>

        <div class="formRow fixedBottom sidebar-bunker">
            <div class="formRight">
                <input type="submit" class="blueB" onclick="TreeFilterChanged2(); return false;"
                    value="Hoàn tất" />
                <a href="index.html?com=video&act=man<?php if($_REQUEST['id']!='') echo'&id='. $_REQUEST['id'];?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"
                    onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS redB"
                    original-title="Thoát">Thoát</a>
            </div>
            <div class="clear"></div>
        </div>
    </form>
</div>