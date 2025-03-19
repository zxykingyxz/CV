<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
            <li><a href="index.html?com=ngonngu&act=man_lang"><span><?=_danhsach?></span></a></li>
            <li class="current"><a href="#" onclick="return false;"><?=_tatca?></a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('.update_stt').keyup(function(event) {
        var id = $(this).attr('rel');
        var table = 'lang';
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
    $('.box-search button').click(function(event) {
        var keyword = $(this).parent().find('input').val();
        window.location.href = "index.html?com=ngonngu&act=man_lang&keyword=" + keyword;
    });
    $("#xoahet").click(function() {
        var listid=$("input[name='chon']:checked").map(function() {
            return this.value
        }).get().join(",");

        if(listid.length>0){
            $.confirm({
                title: 'Xác nhận!',
                content: 'Bạn có chắc chắn muốn xóa mục này!',
                buttons: {
                    success: {
                        text: 'Đồng ý!',
                        btnClass: 'btn-blue',
                        action: function(){
                           redirect("index.html?com=ngonngu&act=delete_lang&page=<?=$_GET['page']?>&listid=" + listid);
                        }
                    },
                    cancel: {   
                        text: 'Hủy ngay!',
                        btnClass: 'btn-red'
                    }
                }
            });
        }
    });
});
</script>
<form name="f" id="f" method="post">
    <div class="oneOne">
        <div class="box-admin" style="display:flex; align-items:center;">
            <div class="box-action">
                <a class="btn btn-sm bg-gradient-primary text-white" href="index.html?com=ngonngu&act=add_lang">
                    <i class="fas fa-plus mr-2"></i>Thêm mới
                </a>
                <a class="btn btn-sm bg-gradient-danger text-white" id="xoahet">
                    <i class="far fa-trash-alt mr-2"></i>Xóa tất cả
                </a>
            </div>
            <div class="box-search">
                <input type="text" value="" placeholder="Nhập từ khóa tìm kiếm ">
                <button type="button" style="border-radius:0" class="btn btn-navbar text-white" value=""><i
                        class="fas fa-search"></i></button>
            </div>
        </div>
    </div>
    <div class="oneOne">
        <div class="title">
            <p style="color:#f00;font-style:italic">[ Tất cả tên biến phải được viết thường, không viết in hoa, vui lòng
                viết theo mẫu đã có sẵn ]</p>
        </div>
    </div>
    <div class="oneOne">
        <div class="widget mtop0">
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
                <thead>
                    <tr>
                        <td>

                            <label class="stardust-checkbox">
                                <input class="stardust-checkbox__input" id="checkAll" type="checkbox" value=""
                                    style="display:none">
                                <div class="stardust-checkbox__box"></div>
                            </label>
                        </td>
                        <td width="150"><?=_tenbien?></td>
                        <?php foreach($config['lang'] as $k => $v){?>
                        <td class="sortCol">
                            <div><?=$v?><span></span></div>
                        </td>
                        <?php } ?>
                        <td width="150"><?=_thaotac?></td>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0, $count=count($items); $i<$count; $i++){?>
                    <tr>
                        <td>
                            <label class="stardust-checkbox checker">
                                <input class="stardust-checkbox__input" name="chon" id="check<?=$i?>" type="checkbox"
                                    value="<?=$items[$i]['id']?>" style="display:none">
                                <div class="stardust-checkbox__box"></div>
                            </label>
                        </td>

                        <td style="width:20%;"><a
                                href="index.html?com=ngonngu&act=edit_lang&id=<?=$items[$i]['id']?><?php if($_REQUEST['page']!='') echo'&page='. $_REQUEST['page'];?>"
                                style="text-decoration:none;">
                                <?=$items[$i]['item']?>
                                <?php foreach($config['lang'] as $k => $v){?>
                        <td style="width:20%;"><?=$items[$i]['lang_'.$k]?></td>
                        <?php }?>
                        <td class="actBtns">
                            <a href="index.html?com=ngonngu&act=edit_lang&id=<?=$items[$i]['id']?>" title=""
                                class="smallButton tipS" original-title="Sửa hình ảnh"><img
                                    src="./images/icons/dark/pencil.png" alt=""></a>
                            <a class="text-danger" data-product="<?=$items[$i]['id']?>" data-com="<?=$_GET['com']?>" data-act="delete_lang" data-tbl="<?=$_GET['tbl']?>" data-type="<?=$_GET['type']?>" data-page="<?=$_GET['page']?>" href="javascript:" data-js-delete title=""
                                    class="smallButton tipS" original-title="Xóa "><img
                                    src="./images/icons/dark/close.png" alt=""></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</form>
<div class="paging"><?=$paging?></div>