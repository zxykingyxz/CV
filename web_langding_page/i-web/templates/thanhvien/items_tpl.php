<script type="text/javascript">
$(document).ready(function() {
    $('.update_stt').keyup(function(event) {
        var id = $(this).attr('rel');
        var table = 'member';
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
        window.location.href = "index.html?com=member&act=man&type=<?=$_GET['type']?>&keyword=" +
            keyword;
    });

    $("#xoahet").click(function() {
        var listid = "";
        $("input[name='chon']").each(function() {
            if (this.checked) listid = listid + "," + this.value;
        })
        listid = listid.substr(1); //alert(listid);
        if (listid == "") {
            alert("Bạn chưa chọn mục nào");
            return false;
        }
        hoi = confirm("Bạn có chắc chắn muốn xóa?");
        if (hoi == true) document.location =
            "index.html?com=member&act=delete&curPage=<?=$_GET['curPage']?>&listid=" + listid;
    });
});
</script>


<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
            <li><a href="index.html?com=member&act=man"><span>Quản lý Thành viên</span></a></li>
            <?php if($_GET['keyword']!=''){ ?>
            <li class="current"><a href="#" onclick="return false;">Kết quả tìm kiếm " <?=$_GET['keyword']?> " </a></li>
            <?php }  else { ?>
            <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
            <?php } ?>
        </ul>
        <div class="clear"></div>
    </div>
</div>


<form name="f" id="f" method="post">
    <div class="oneOne">
        <div class="box-admin" style="display:flex; align-items:center;">
            <div class="box-action">
                <a class="btn btn-sm bg-gradient-primary text-white"
                    href="index.html?com=member&act=add<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>">
                    <i class="fas fa-plus mr-2"></i>Thêm mới
                </a>
                <a class="btn btn-sm bg-gradient-danger text-white" id="xoahet">
                    <i class="far fa-trash-alt mr-2"></i>Xóa tất cả
                </a>
            </div>
            <div class="box-search">
                <input type="text" value="" placeholder="Nhập từ khóa tìm kiếm ">
                <button type="button" class="btn btn-navbar text-white" value=""><i class="fas fa-search"></i></button>
            </div>
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
                        <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td>
                        <td class="sortCol">#ID</tdtd>
                        <td class="sortCol">Số điện thoại</td>
                        <td class="sortCol">Họ tên</td>
                        <td class="sortCol">Email</td>
                        <td class="sortCol">Ngày tạo</td>
                        <!-- <td class="sortCol">Xem shop</td> -->
                        <td class="tb_data_small">Ẩn/Hiện</td>
                        <td class="tb_data_small">Thao tác</td>
                    </tr>
                </thead>

                <tbody>
                    <?php for($i=0, $count=count($items); $i<$count; $i++){ 
                        $userInfo=$func->getUserInfo($items[$i]['id']);
                    ?>
                    <tr>
                        <td>
                            <label class="stardust-checkbox checker">
                                <input class="stardust-checkbox__input" name="chon" id="check<?=$i?>" type="checkbox"
                                    value="<?=$items[$i]['id']?>" style="display:none">
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
                        <td class="title_name_data"><b><?=$items[$i]['username']?><b></td>
                        <?php if($GLOBAL[$com][$type]['type']){?>
                        <td class="title_name_data"><?=$func->getMemberType('ten_vi',$items[$i]['id_loaithanhvien'])?>
                        </td>
                        <?php }?>
                        <?php if($GLOBAL[$com][$type]['percent']){?>
                        <td class="title_name_data">
                            <?=($func->getMemberType('phantram',$items[$i]['id_loaithanhvien'])!=0) ? $func->getMemberType('phantram',$items[$i]['id_loaithanhvien']): 0?>%
                        </td>
                        <?php }?>
                        <?php if($GLOBAL[$com][$type]['point']){?>
                        <td style="color:#f00;" class="title_name_data"><b><?=tiente($point)?></b></td>
                        <?php }?>
                        <?php if($GLOBAL[$com][$type]['level']){?>
                        <td class="title_name_data"><b
                                style="color:<?=$level['mausac']?>"><?=(!empty($level['ten_'.$lang]) ? $level['ten_'.$lang] : 'Member')?></b>
                        </td>
                        <?php }?>
                        <?php if($GLOBAL[$com][$type]['point']){?>
                        <td align="center" class="title_name_data">
                            <?php if($toTalPointNext>0){?>
                            <b style="color:<?=$nextPercent['mausac']?>"><?=$nextPercent['ten_'.$lang]?></b><br>
                            <p style="color:#f00;margin-top:5px">{ cần thêm <?=tiente($toTalPointNext)?> }</p>
                            <?php }else{ echo 'Empty...'; }?>
                        </td>
                        <?php }?>
                        <td class="title_name_data">
                            <?=$items[$i]['dienthoai']?>
                        </td>
                        <td class="title_name_data">
                            <a href="index.html?com=member&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>"
                                class="tipS SC_bold"><?=$userInfo['hoten']?></a>
                        </td>
                        <td class="title_name_data"><?=$userInfo['email']?></td>
                        <td class="title_name_data"><?=date('d/m/Y',$items[$i]['ngaytao'])?></td>
                        <!-- <td class="title_name_data" align="center">
                            <a href="index.html?com=member&act=login&id=<?=$items[$i]['id']?>&type=member" title="Đăng nhập" target="_blank" class="tipS SC_bold">
                                Xem shop
                            </a>
                    </td> -->
                        <td align="center">
                            <label class="stardust-checkbox checkOnOff">
                                <input class="stardust-checkbox__input" data-id="<?=$items[$i]['id']?>"
                                    data-table="table_member" data-type="hienthi" rel="<?=$items[$i]['hienthi']?>"
                                    <?php if($items[$i]['hienthi']==1) echo 'checked'; ?> name="onOff" type="checkbox"
                                    style="display:none">
                                <div class="stardust-checkbox__box"></div>
                            </label>
                        </td>

                        <td class="actBtns">
                            <a class="text-primary"
                                href="index.html?com=member&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>"
                                title="" class="smallButton tipS" original-title="Sửa sản phẩm"><i
                                    class="fas fa-edit"></i></a>

                           <a class="text-danger" data-product="<?=$items[$i]['id']?>" data-com="<?=$_GET['com']?>" data-act="delete" data-tbl="<?=$_GET['tbl']?>" data-type="<?=$_GET['type']?>" data-page="<?=$_GET['page']?>" href="javascript:" data-js-delete title=""
                                    class="smallButton tipS" original-title="Xóa "><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</form>
<div class="paging"><?=$paging?></div>