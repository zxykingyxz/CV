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

    $('.themmoi').click(function(e) {
        $.ajax({
            type: "POST",
            url: "ajax/khuyenmai.php",
            success: function(result) {
                $('.load_sp').append(result);
            }
        });
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
                <li><a href="index.html?com=ngonngu&act=add_lang"><span>Thêm ngôn ngữ</span></a></li>
                <li class="current"><a href="#" onclick="return false;"><?=($_GET['act']=='edit') ? 'Sửa':'Thêm'?></a>
                </li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>

    <form name="supplier" id="validate" class="card-article form"
        action="index.html?com=ngonngu&act=save_lang<?php if($_REQUEST['currentPage']!='') echo'&currentPage='. $_REQUEST['currentPage'];?>"
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

            <div class="<?=($config_pr['full']==true) ? 'oneOne':'colLeft' ?>">
                <div class="widget mtop0">
                    <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
                        <h6>Thông tin chung</h6>
                    </div>
                    <div class="formRow">
                        <label>Tên biến</label>
                        <div class="formRight">
                            <input type="text" name="item" readonly="readonly" title="Nhập tên biến" id="item"
                                class="tipS validate[required]" value="<?=@$item['item']?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php  foreach ($config['lang'] as $k => $v){ ?>
                    <div class="formRow lang_hidden lang_<?=$k?> <?= ($k == 'vi') ? 'active': '' ?>">
                        <label>Tiêu đề [<?=$v?>]</label>
                        <div class="formRight">
                            <input type="text" name="lang_<?=$k?>" title="Nhập tên ngôn ngữ" id="lang_<?=$k?>"
                                class="tipS validate[required]" value="<?=@$item['lang_'.$k]?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="formRow fixedBottom">
                <div class="formRight">
                    <input type="hidden" name="type" id="id_this_type" value="<?=$_REQUEST['type']?>" />
                    <input type="hidden" name="id" id="id_this_post" value="<?=@$item['id']?>" />
                    <div class="box-admin" style="display:flex; align-items:center;justify-content:flex-end">
                        <div class="box-action">
                            <button type="submit" class="btn btn-sm bg-gradient-primary text-white submit-check">
                                <i class="far fa-save mr-2"></i>Lưu
                            </button>
                            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i
                                    class="fas fa-redo mr-2"></i>Làm lại</button>
                            <a class="btn btn-sm bg-gradient-danger text-white"
                                href="index.html?com=ngonngu&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>">
                                <i class="fas fa-sign-out-alt mr-2"></i>Thoát
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>
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