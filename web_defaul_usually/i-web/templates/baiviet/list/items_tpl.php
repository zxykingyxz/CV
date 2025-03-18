<script type="text/javascript">
$(document).ready(function() {
    $('.update_stt').keyup(function(event) {
        var id = $(this).attr('rel');
        var table = 'baiviet_list';
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
        window.location.href =
            "index.html?com=baiviet&act=man_list&tbl=<?=$_GET['tbl']?>&type=<?=$_GET['type']?>&keyword=" +
            keyword;
    });
    $("#xoahet").click(function() {
        var listid = $("input[name='chon']:checked").map(function() {
            return this.value
        }).get().join(",");
        $.confirm({
            title: 'Xác nhận!',
            content: 'Bạn có chắc chắn muốn xóa mục này!',
            buttons: {
                success: {
                    text: 'Đồng ý!',
                    btnClass: 'btn-blue',
                    action: function() {
                        redirect(
                            "index.html?com=baiviet&act=delete_list&tbl=<?=$_GET['tbl']?>&type=<?=$_GET['type']?>&page=<?=$_GET['page']?>&listid=" +
                            listid);
                    }
                },
                cancel: {
                    text: 'Hủy ngay!',
                    btnClass: 'btn-red'
                }
            }
        });
    });
});
</script>
<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
            <li><a
                    href="index.html?com=baiviet&act=man_list&tbl=<?=$_GET['tbl']?><?php if($_GET['type']!='') echo'&type='. $_GET['type'];?>"><span>Danh
                        sách</span></a>
            </li>
            <?php if($_GET['keyword']!=''){ ?>
            <li class="current"><a href="#" onclick="return false;"><?=_ketquatimkiem?> " <?=$_GET['keyword']?> " </a>
            </li>
            <?php }else{ ?>
            <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
            <?php } ?>
        </ul>
        <div class="clear"></div>
    </div>
</div>


<form name="f" id="f" method="post">
    <div class="oneOne">
        <div class="box-admin d-flex d-block-m align-items-center">
            <div class="box-action">
                <a class="btn btn-sm bg-gradient-primary text-white"
                    href="index.html?com=baiviet&act=add_list&tbl=<?=$_GET['tbl']?><?php if($_GET['type']!='') echo'&type='. $_GET['type'];?><?php if($_GET['page']!='') echo'&page='. $_GET['page'];?>">
                    <i class="fas fa-plus mr-2"></i>Thêm mới
                </a>
                <a class="btn btn-sm bg-gradient-danger text-white" id="xoahet">
                    <i class="far fa-trash-alt mr-2"></i>Xóa tất cả
                </a>
            </div>
            <div class="box-search mt-m-20">
                <input type="text" class="mg-m-0" value="" placeholder="Nhập từ khóa tìm kiếm ">
                <button type="button" class="btn btn-navbar text-white" value=""><i class="fas fa-search"></i></button>
            </div>
        </div>
    </div>
    <div class="oneOne">
        <div class="widget mtop0">
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
                            <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;"><?=_thutu?></a></td>
                            <?php if($GLOBAL_LEVEL1[$com][$type]['img']==true){ ?>
                            <td style="width: 100px; text-align: center;"><?=_hinhanh?></td>
                            <?php } ?>
                            <td class="sortCol">
                                <div><?=_tendanhmuc?><span></span></div>
                            </td>
                            <?php foreach($GLOBAL_LEVEL1[$com][$type]['check_list'] as $key =>$value){ ?>
                            <td class="tb_data_small"><?=$value?></td>
                            <?php } ?>
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
                                    original-title="Nhập số thứ tự" rel="<?=$items[$i]['id']?>" />
                                <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>"
                                        src="images/loader.gif" alt="loader" /></div>
                            </td>
                            <?php if($GLOBAL_LEVEL1[$com][$type]['img']==true){ ?>
                            <td align="center">
                                <a href="index.html?com=baiviet&act=edit_list&tbl=<?=$_GET['tbl']?>&id=<?=$items[$i]['id']?><?php if($_GET['type']!='') echo'&type='. $_GET['type'];?><?php if($_GET['page']!='') echo'&page='. $_GET['page'];?>"
                                    class="tipS SC_bold">
                                    <img src="<?=_upload_baiviet.$items[$i]['photo']?>" alt="" width="100">
                                </a>
                            </td>
                            <?php } ?>

                            <td class="title_name_data">
                                <a href="index.html?com=baiviet&act=edit_list&tbl=<?=$_GET['tbl']?>&id=<?=$items[$i]['id']?><?php if($_GET['type']!='') echo'&type='. $_GET['type'];?><?php if($_GET['page']!='') echo'&page='. $_GET['page'];?>"
                                    class="tipS SC_bold"><?=$items[$i]['ten_vi']?></a>
                            </td>
                            <?php foreach($GLOBAL_LEVEL1[$com][$type]['check_list'] as $key =>$value){ ?>
                            <td align="center">
                                <label class="stardust-checkbox checkOnOff">
                                    <input class="stardust-checkbox__input" data-id="<?=$items[$i]['id']?>"
                                        data-table="table_baiviet_list" data-type="<?=$key?>"
                                        rel="<?=$items[$i][$key]?>" <?php if($items[$i][$key]==1) echo 'checked'; ?>
                                        name="onOff" type="checkbox" style="display:none">
                                    <div class="stardust-checkbox__box"></div>
                                </label>
                            </td>
                            <?php } ?>
                            <td class="actBtns">
                                <a class="text-primary"
                                    href="index.html?com=baiviet&act=edit_list&tbl=<?=$_GET['tbl']?>&id=<?=$items[$i]['id']?><?php if($_GET['type']!='') echo'&type='. $_GET['type'];?><?php if($_GET['page']!='') echo'&page='. $_GET['page'];?>"
                                    title="" class="smallButton tipS" original-title="Sửa"><i
                                        class="fas fa-edit"></i></a>
                                <a class="text-danger" data-product="<?=$items[$i]['id']?>" data-com="<?=$_GET['com']?>"
                                    data-act="delete_<?=$_GET['tbl']?>" data-tbl="<?=$_GET['tbl']?>"
                                    data-type="<?=$_GET['type']?>" data-page="<?=$_GET['page']?>" href="javascript:"
                                    data-js-delete title="" class="smallButton tipS" original-title="Xóa "><i
                                        class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="paging"><?=$paging?></div>
        </div>
        <div class="clear"></div>

    </div>
</form>