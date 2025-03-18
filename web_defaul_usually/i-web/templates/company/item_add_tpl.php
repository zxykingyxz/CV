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

<form name="supplier" class="form form-validate"
    action="index.html?com=company&act=save<?php if($_GET['type']!='') echo'&type='. $_GET['type'];?>"
    method="post" enctype="multipart/form-data">
    <div class="control_frm">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a
                        href="index.html?com=company&act=capnhat<?php if($_GET['type']!='') echo'&type='. $_GET['type'];?>"><span><?=_update?>
                            <?=$GLOBAL[$com][$type]['title_main']?></span></a></li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
    <div class="mtop0">
        <div class="oneOne">
            <div class="widget mtop0">
                <div class="title chonngonngu" style="border-bottom: 0px solid transparent">
                    <ul>
                        <?php  foreach ($config['lang'] as $k => $v){ ?>
                        <li><a href="<?=$k?>" class="<?= ($k == 'vi') ? 'active': '' ?> tipS" title="<?=$v?>"><img
                                    src="./images/<?=$k?>.png" alt="" class="<?=$func->changeTitle($v)?>" /><?=$v?></a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="oneOne">
            <div class="widget mtop0">

                <?php if($GLOBAL[$com][$type]["ten"]){ ?>

                <?php  foreach ($config['lang'] as $k => $v){ ?>

                    <div class="formRow lang_hidden lang_<?=$k?> <?= ($k == 'vi') ? 'active': '' ?>">

                        <label>Tiêu đề [<?=$v?>]</label>

                        <div class="formRight">

                            <input type="text" data-validation="required"
                                data-validation-error-msg="Tên không được để trống"
                                onkeyup="changeSlug('name_<?=$k?>','alias_<?=$k?>','url_seo_<?=$k?>','title_seo_<?=$k?>','title_<?=$k?>')"
                                name="data[ten_<?=$k?>]" title="Nhập tên danh mục" id="name_<?=$k?>" class="tipS"
                                value="<?=@$item['ten_'.$k]?>" />

                        </div>

                        <div class="clear"></div>

                    </div>

                <?php }?>

                <?php }?>

                <?php foreach ($config['lang'] as $k => $v){ ?>
                <?php if($GLOBAL[$com][$type]["mota"]){ ?>
                <div class="formRow lang_hidden lang_<?=$k?> <?= ($k == 'vi') ? 'active': '' ?>">
                    <label><?=_mota?> [<?=$v?>]</label>
                    <div class="ck_editor">
                        <textarea rows="10" title="Nhập mô tả . " data-height="400" id="mota_<?=$k?>"
                            class="<?=($GLOBAL['company'][$type]['mota-ckeditor']) ? 'ck_editors' : ''?>"
                            name="data[mota_<?=$k?>]"><?=@$item['mota_'.$k]?></textarea>
                    </div>
                    <div class="clear"></div>
                </div>
                <?php } ?>
                <?php if($GLOBAL[$com][$type]["noidung"]){ ?>
                <div class="formRow lang_hidden lang_<?=$k?> <?= ($k == 'vi') ? 'active': '' ?>">
                    <label><?=_noidung?> [<?=$v?>]</label>
                    <div class="ck_editor">
                        <textarea rows="10" title="Nhập mô tả . " data-height="400" id="noidung_<?=$k?>"
                            class="<?=($GLOBAL['company'][$type]['noidung-ckeditor']) ? 'ck_editors' : ''?>"
                            name="data[noidung_<?=$k?>]"><?=@$item['noidung_'.$k]?></textarea>
                    </div>
                    <div class="clear"></div>
                </div>
                <?php } ?>
                <?php }?>
            </div>
        </div>
        <div class="formRow fixedBottom">
            <div class="box-admin" style="display:flex; align-items:center;justify-content:flex-end">
                <div class="box-action">
                    <button type="submit" class="btn btn-sm bg-gradient-primary text-white submit-check">
                        <i class="far fa-save mr-2"></i>Lưu
                    </button>
                    <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm
                        lại</button>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</form>