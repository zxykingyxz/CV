<script type="text/javascript">
$(document).ready(function() {
    $('.update_stt').keyup(function(event) {
        var id = $(this).attr('rel');
        var table = 'contact';
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
        window.location.href = "index.html?com=contact&act=man&type=<?=$_GET['type']?>&keyword=" +
            keyword;
    });

    $("#xoahet").click(function() {
        var listid = $("input[name='chon']:checked").map(function() {
            return this.value
        }).get().join(",");

        if (listid.length > 0) {
            $.confirm({
                title: 'Xác nhận!',
                content: 'Bạn có chắc chắn muốn xóa mục này!',
                buttons: {
                    success: {
                        text: 'Đồng ý!',
                        btnClass: 'btn-blue',
                        action: function() {
                            redirect(
                                "index.html?com=contact&act=delete&type=<?=$_GET['type']?>&page=<?=$_GET['page']?>&listid=" +
                                listid);
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


<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
            <li><a
                    href="index.html?com=contact&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span><?=_quanlylienhe?></span></a>
            </li>
            <?php if($_GET['keyword']!=''){ ?>
            <li class="current"><a href="#" onclick="return false;"><?=_ketquatimkiem?> " <?=$_GET['keyword']?> " </a>
            </li>
            <?php }else { ?>
            <li class="current"><a href="#" onclick="return false;"><?=_tatca?></a></li>
            <?php } ?>
        </ul>
        <div class="clear"></div>
    </div>
</div>


<form name="f" id="f" method="post">
    <div class="oneOne">
        <div class="box-admin d-flex d-block-m align-items-center">
            <div class="box-action">
                <a class="btn btn-sm bg-gradient-danger text-white" id="xoahet">
                    <i class="far fa-trash-alt mr-2"></i>Xóa tất cả
                </a>
            </div>
            <div class="box-search mt-m-20">
                <input type="text" class="mg-m-0" value="" placeholder="Nhập từ khóa tìm kiếm ">
                <button type="button" style="border-radius:0" class="btn btn-navbar text-white" value=""><i
                        class="fas fa-search"></i></button>
            </div>
        </div>
    </div>
    <div class="oneOne">
        <div class="widget mtop10">
            <div class="table-responsive">
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
                            <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;"><?=_sothutu?></a>
                            </td>
                            <td class="sortCol">
                                <div><?=_tieude?> <span></span></div>
                            </td>
                            <td class="sortCol">
                                <div><?=_ten?> <span></span></div>
                            </td>
                            <td class="sortCol">
                                <div>Số điện thoại <span></span></div>
                            </td>
                            <td class="sortCol">
                                <div><?=_email?> <span></span></div>
                            </td>
                            <td class="tb_data_small"><?=_ngaytao?></td>
                            <td class="tb_data_small"><?=_thaotac?></td>
                        </tr>
                    </thead>

                    <tbody>
                        <?php for($i=0, $count=count($items); $i<$count; $i++){?>
                        <tr>
                            <td>
                                <label class="stardust-checkbox checker">
                                    <input class="stardust-checkbox__input" name="chon" id="check<?=$i?>"
                                        type="checkbox" value="<?=$items[$i]['id']?>" style="display:none">
                                    <div class="stardust-checkbox__box"></div>
                                </label>
                            </td>

                            <td align="center">
                                <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]"
                                    onkeypress="return OnlyNumber(event)" class="tipS smallText update_stt"
                                    original-title="Nhập số thứ tự sản phẩm" rel="<?=$items[$i]['id']?>" />
                                <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>"
                                        src="images/loader.gif" alt="loader" /></div>
                            </td>

                            <td align="center" <?php if($items[$i]['view']==0){ echo "style='font-weight:bold;'";}?>>
                                <?=$items[$i]['subject']?></td>
                            <td align="center" <?php if($items[$i]['view']==0){ echo "style='font-weight:bold;'";}?>>
                                <?=$items[$i]['fullname']?></td>
                            <td align="center" <?php if($items[$i]['view']==0){ echo "style='font-weight:bold;'";}?>>
                                <?=$items[$i]['phone']?></td>
                            <td align="center" <?php if($items[$i]['view']==0){ echo "style='font-weight:bold;'";}?>>
                                <?=$items[$i]['email']?></td>
                            <td align="center"><?=date('d/m/Y - g:i A',$items[$i]['createdAt']);?></td>
                            <td class="actBtns">
                                <a class="text-primary"
                                    href="index.html?com=contact&act=edit&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"
                                    title="" class="smallButton tipS" original-title="Sửa sản phẩm"><i
                                        class="fas fa-edit"></i></a>

                                <a class="text-danger" data-product="<?=$items[$i]['id']?>" data-com="<?=$_GET['com']?>"
                                    data-act="delete" data-tbl="<?=$_GET['tbl']?>" data-type="<?=$_GET['type']?>"
                                    data-page="<?=$_GET['page']?>" href="javascript:" data-js-delete title=""
                                    class="smallButton tipS" original-title="Xóa "><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>
<div class="paging"><?=$paging?></div>