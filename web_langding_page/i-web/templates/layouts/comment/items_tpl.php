<style>
.select-w {

    width: 130px;

}

div.uploader{

    width: 150px;
    
}

</style>

<script type="text/javascript">
$(document).ready(function() {

    $('.update_stt').keyup(function(event) {

        var id = $(this).attr('rel');

        var table = 'comment';

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

        window.location.href = "index.html?com=comment&act=man&type=<?=$_GET['type']?>&keyword=" +

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
                                "index.html?com=comment&act=delete&type=<?=$_GET['type']?>&page=<?=$_GET['page']?>&listid=" +
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

<div class="box-dashboards">

    <div class="control_frm">

        <div class="bc">

            <ul id="breadcrumbs" class="breadcrumbs">

                <li><a
                        href="index.html?com=comment&act=man<?php if($_GET['id_list']!='') echo'&id_list='. $_GET['id_list'];?><?php if($_GET['id_cat']!='') echo'&id_cat='. $_GET['id_cat'];?><?php if($_GET['id_item']!='') echo'&id_item='. $_GET['id_item'];?><?php if($_GET['id_sub']!='') echo'&id_sub='. $_GET['id_sub'];?><?php if($_GET['type']!='') echo'&type='. $_GET['type'];?><?php if($_GET['page']!='') echo'&page='. $_GET['page'];?>"><span>Đánh
                            giá học viên</span></a>

                </li>

                <?php if($_GET['keyword']!=''){ ?>

                <li class="current"><a href="#" onclick="return false;">Kết quả tìm kiếm " <?=$_GET['keyword']?> " </a>

                </li>

                <?php }else{ ?>

                <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>

                <?php } ?>

            </ul>

            <div class="clear"></div>

        </div>

    </div>

        <div class="oneOne">

            <div class="box-admin" style="display:flex; align-items:center;">
                <?php if(($kiemtra == 1 & ($xoa)) || ($kiemtra != 1)){?>
                <div class="box-action">

                    <!-- <a class="btn btn-sm bg-gradient-primary text-white"
                        href="index.html?com=comment&act=add<?php if($_GET['id_list']!='') echo'&id_list='. $_GET['id_list'];?><?php if($_GET['id_cat']!='') echo'&id_cat='. $_GET['id_cat'];?><?php if($_GET['id_item']!='') echo'&id_item='. $_GET['id_item'];?><?php if($_GET['id_sub']!='') echo'&id_sub='. $_GET['id_sub'];?><?php if($_GET['id_product']!='') echo'&id_product='. $_GET['id_product'];?><?php if($_GET['type']!='') echo'&type='. $_GET['type'];?><?php if($_GET['page']!='') echo'&page='. $_GET['page'];?>">

                        <i class="fas fa-plus mr-2"></i>Thêm mới

                    </a> -->

                    <a class="btn btn-sm bg-gradient-danger text-white" id="xoahet">

                        <i class="far fa-trash-alt mr-2"></i>Xóa tất cả

                    </a>

                </div>
                <?php }?>
                <div class="box-search">

                    <input type="text" value="" placeholder="Nhập từ khóa tìm kiếm ">

                    <button type="button" style="border-radius:0" class="btn btn-navbar text-white" value=""><i
                            class="fas fa-search"></i></button>

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

                            <?php if(($kiemtra == 1 & ($sua)) || ($kiemtra != 1)){?>
                            <td style="width:40px!important" class="tb_data_small">Stt</td>
                            <?php }?>

                            <td class="sortCol" style="width:70px">

                                <div>Hình ảnh</div>

                            </td>

                            <td class="sortCol" style="width:70px">

                                <div>Upload hình ảnh</div>

                            </td>

                            <td class="sortCol" style="width:100px">

                                <div>Họ và tên</div>

                            </td>
                            <!-- <td class="sortCol" style="width:160px">

                                <div>Email</div>

                            </td>
                            <td class="sortCol" style="width:160px">

                                <div>Link sản phẩm</div>

                            </td> -->

                            <td style="width:290px">

                                <div>Nộidung</div>

                            </td>
                            <td align="center" style="width:60px">

                                <div>Số sao</div>

                            </td>
                            <td align="center" style="width:210px; color:red">

                                <div>Trả lời</div>

                            </td>
                            <?php if(($kiemtra == 1 & ($sua)) || ($kiemtra != 1)){?>
                            <td style="width: 60px; text-align: center;">Hiển thị</td>
                            <?php }?>
                            <?php if(($kiemtra == 1 & ($xoa)) || ($kiemtra != 1)){?>
                            <td style="width: 90px; text-align: center;">Thao Tác</td>
                            <?php }?>

                        </tr>

                    </thead>

                    <tbody>

                        <?php for($i=0, $count=count($items); $i<$count; $i++){

                        ?>

                        <tr>

                            <td>

                                <label class="stardust-checkbox checker">

                                    <input class="stardust-checkbox__input" name="chon" id="check<?=$i?>"
                                        type="checkbox" value="<?=$items[$i]['id']?>" style="display:none">

                                    <div class="stardust-checkbox__box"></div>

                                </label>

                            </td>
                            <?php if(($kiemtra == 1 & ($sua)) || ($kiemtra != 1)){?>
                            <td style="width:50px" align="center">
                                <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]"
                                    onkeypress="return OnlyNumber(event)" class="tipS smallText update_stt"
                                    original-title="Nhập số thứ tự " rel="<?=$items[$i]['id']?>" />
                                <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>"
                                        src="images/loader.gif" alt="loader" /></div>
                            </td>
                            <?php }?>

                            <td class="title_name_data">
                                <img width="50" src="<?=_upload_user.$items[$i]['photo']?>" alt="" />
                            </td>
                            <td class="uploader-ajax" align="center">
                                <form action="" name="form<?=$items[$i]['id']?>" id="form<?=$items[$i]['id']?>"
                                    method="POST" enctype="multipart/form-data" autocomplete="off"
                                    accept-charset="utf-8">
                                    <input type="hidden" name="id" value="<?=$items[$i]['id']?>">
                                    <input type="file" class="res--file--upload" id="file<?=$items[$i]['id']?>"
                                        data-id="<?=$items[$i]['id']?>" name="file" />
                                </form>                          
                            </td>
                            <td class="title_name_data">
                                <?=$items[$i]['hoten']?>
                            </td>

                            <!-- <td class="title_name_data">
                                <?=$items[$i]['email']?>
                            </td>

                            <td class="title_name_data">
                                <a href="<?=$items[$i]['url']?>">
                                    <?=$items[$i]['url']?>
                                </a>
                            </td> -->

                            <td class="title_name_data">
                                <?=$items[$i]['content']?>
                            </td>

                            <td align="center" class="title_name_data">
                                <?=$items[$i]['rating']?>
                            </td>
                            <td align="center" class="title_name_data">
                                <div class="form">
                                    <input type="text" name="traloi" id="<?=$items[$i]['id']?>" value="<?=($items[$i]['traloi']!='')?$items[$i]['traloi']:''?>" placeholder="Nhập trả lời" class="js-reply-comment">
                                </div>
                            </td>
                            <?php if(($kiemtra == 1 & ($sua)) || ($kiemtra != 1)){?>
                            <td align="center">

                                <label class="stardust-checkbox checkOnOff">

                                    <input class="stardust-checkbox__input" data-id="<?=$items[$i]['id']?>"
                                        data-table="table_comment" data-type="<?='hienthi'?>"
                                        rel="<?=$items[$i]['hienthi']?>"
                                        <?php if($items[$i]['hienthi']==1) echo 'checked'; ?> name="onOff"
                                        type="checkbox" style="display:none">

                                    <div class="stardust-checkbox__box"></div>

                                </label>

                            </td>
                            <?php }?>
                            <?php if(($kiemtra == 1 & ($xoa)) || ($kiemtra != 1)){?>
                            <td class="actBtns">

                                <!-- <a class="text-primary"
                                    href="index.html?com=comment&act=edit<?php if($_GET['id_list']!='') echo'&id_list='. $_GET['id_list'];?><?php if($_GET['id_cat']!='') echo'&id_cat='. $_GET['id_cat'];?><?php if($_GET['id_item']!='') echo'&id_item='. $_GET['id_item'];?><?php if($_GET['id_sub']!='') echo'&id_sub='. $_GET['id_sub'];?><?php if($_GET['id_product']!='') echo'&id_product='. $_GET['id_product'];?>&id=<?=$items[$i]['id']?><?php if($_GET['type']!='') echo'&type='. $_GET['type'];?><?php if($_GET['page']!='') echo'&page='. $_GET['page'];?>"
                                    title="" class="smallButton tipS" original-title="Sửa"><i
                                        class="fas fa-edit"></i></a> -->

                                <a class="text-danger" data-product="<?=$items[$i]['id']?>" data-com="<?=$_GET['com']?>"
                                    data-act="delete" data-tbl="<?=$_GET['tbl']?>" data-type="<?=$_GET['type']?>"
                                    data-page="<?=$_GET['page']?>" href="javascript:" data-js-delete title=""
                                    class="smallButton tipS" original-title="Xóa ">

                                    <i class="fas fa-trash-alt"></i>

                                </a>

                            </td>
                            <?php }?>

                        </tr>

                        <?php } ?>

                    </tbody>

                </table>

                <div class="paging"><?=$paging?></div>

            </div>



        </div>





</div>



<script>
function changeSelect(value, product, type) {

    $.ajax({

        url: 'ajax/loadSelect.php',

        type: 'post',

        data: {
            value: value,
            product: product,
            type: type
        },

        success: function(data) {

            $('select[data-cat-' + product + ']').html(data);

        }

    });

}

function updateSelect(value, product, type, x) {

    $.ajax({

        url: 'ajax/updateSelect.php',

        type: 'post',

        data: {
            value: value,
            product: product,
            type: type,
            loai: x
        },

        success: function(data) {

            // window.location.reload();

        }

    });

}

$(function() {

    $('select[data-view-id]').change(function() {

        var _o = $(this);

        var _v = _o.val();

        var _idp = _o.attr('data-product');

        var _data = _o.data('loai');

        var _type = "<?=$_GET['type']?>";

        $.confirm({

            title: 'Xác nhận!',

            content: 'Bạn có chắc chắn muốn thay đổi danh mục này!',

            buttons: {

                success: {

                    text: 'Đồng ý!',

                    btnClass: 'btn-blue',

                    action: function() {

                        changeSelect(_v, _idp, _type);

                        updateSelect(_v, _idp, '<?=$type?>', _data);

                    }

                },

                cancel: {

                    text: 'Hủy ngay!',

                    btnClass: 'btn-red'

                }

            }

        });

    });

    $('select[data-view-cat]').change(function() {

        var _o = $(this);

        var _v = _o.val();

        var _idp = _o.attr('data-product');

        $.confirm({

            title: 'Xác nhận!',

            content: 'Bạn có chắc chắn muốn thay đổi danh mục này!',

            buttons: {

                success: {

                    text: 'Đồng ý!',

                    btnClass: 'btn-blue',

                    action: function() {

                        updateSelect(_v, _idp, '<?=$type?>', 'idc');

                    }

                },

                cancel: {

                    text: 'Hủy ngay!',

                    btnClass: 'btn-red'

                }

            }

        });



    });

    $('select[data-view-item]').change(function() {

        var _o = $(this);

        var _v = _o.val();

        var _idp = _o.attr('data-product');

        $.confirm({

            title: 'Xác nhận!',

            content: 'Bạn có chắc chắn muốn thay đổi danh mục này!',

            buttons: {

                success: {

                    text: 'Đồng ý!',

                    btnClass: 'btn-blue',

                    action: function() {

                        updateSelect(_v, _idp, '<?=$type?>', 'idi');

                    }

                },

                cancel: {

                    text: 'Hủy ngay!',

                    btnClass: 'btn-red'

                }

            }

        });



    });

    $('.res--file--upload').change(function() {

        let _this = $(this);
        let id = _this.attr('data-id');
        var name = document.getElementById("file" + id).files[0].name;
        var ext = name.split('.').pop().toLowerCase();
        if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
            alert("Hình ảnh không đúng định dạng [gif, png, jpg, jpeg]");
        }
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("file" + id).files[0]);

        var f = document.getElementById("file" + id).files[0];

        var fsize = f.size || f.fileSize;
        if (fsize > 2 * 1024 * 1024) {
            alert("Hình ảnh quá lớn > 2MB");
            return false;
        } else {

            let form = document.getElementById('form' + id);

            let fd = new FormData(form);
            $.ajax({
                url: "ajax/upload.php",
                type: "POST",
                data: fd,
                dataType: 'JSON',
                contentType: false,
                // cache: false,
                processData: false,
                beforeSend: function() {

                },
                success: function(data) {
                    window.location.reload();
                }
            });
        }

    });

    $('.js-reply-comment').change(function(){
        var reply = $(this).val();
        var id = $(this).attr('id');
        $.ajax({
            url: "ajax/updateComment.php",
            type: "POST",
            data:{
                reply:reply,
                id:id
            },
            dataType: 'JSON',
            beforeSend: function() {

            },
            success: function(data) {
                window.location.reload();
            }
        });
    });

});
</script>