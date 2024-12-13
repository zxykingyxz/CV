<style>

    .select-w{

        width: 130px;

    }

</style>

<script type="text/javascript">

$(document).ready(function() {

    $('.update_stt').keyup(function(event) {

        var id = $(this).attr('rel');

        var table = 'attribute';

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

        window.location.href = "index.html?com=attribute&act=man&id_product=<?= $_GET["id_product"]?>&type=<?=$_GET['type']?>&keyword=" +

            keyword;

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

                           redirect("index.html?com=attribute&act=delete&type=<?=$_GET['type']?>&id_product=<?=$_GET['id_product']?>&page=<?=$_GET['page']?>&listid=" + listid+"&act_baiviet=<?=$_GET["act_baiviet"]?>&page_baiviet=<?=$_GET["page_baiviet"]?>");

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

                        href="index.html?com=attribute&act=man<?php if($_GET['id_list']!='') echo'&id_list='. $_GET['id_list'];?><?php if($_GET['id_cat']!='') echo'&id_cat='. $_GET['id_cat'];?><?php if($_GET['id_item']!='') echo'&id_item='. $_GET['id_item'];?><?php if($_GET['id_sub']!='') echo'&id_sub='. $_GET['id_sub'];?><?php if($_GET['type']!='') echo'&type='. $_GET['type'];?><?php if($_GET['page']!='') echo'&page='. $_GET['page'];?>"><span><?=$GLOBAL[$com][$type]['title']?></span></a>

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

    <form name="f" id="f" method="post">

        <div class="oneOne">

            <div class="box-admin" style="display:flex; align-items:center;">

                <div class="box-action">

                    <?php
                    
                        if($_GET["act_baiviet"]=="man"){

                            $urlBaiviet = "index.php?com=baiviet&act=man&type=san-pham&page={$_GET["page_baiviet"]}";

                        }else{

                            $urlBaiviet = "index.html?com=baiviet&act=edit&id={$_GET["id_product"]}&type=san-pham&page={$_GET["page_baiviet"]}";

                        }
                    
                    ?>

                    <a class="btn btn-sm bg-gradient-primary text-white"

                        href="<?=$urlBaiviet?>">

                        <i class="fas fa-backward mr-2"></i>Trở lại

                    </a>

                    <a class="btn btn-sm bg-gradient-primary text-white"

                        href="index.html?com=attribute&act=add<?php if($_GET['id_product']!='') echo'&id_product='. $_GET['id_product'];?><?php if($_GET['type']!='') echo'&type='. $_GET['type'];?><?php if($_GET['page']!='') echo'&page='. $_GET['page'];?>&act_baiviet=<?=$_GET["act_baiviet"]?>&page_baiviet=<?=$_GET["page_baiviet"]?>">

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

                                <td style="width:40px!important" class="tb_data_small">Stt</td>

                                <?php if($GLOBAL[$com][$type]['img']==true){ ?>

                                <td style="width: 70px; text-align: center;">Hình Ảnh</td>

                                <?php } ?>

                                <td class="sortCol" style="width:290px">

                                    <div>Tiêu Đề</div>

                                </td>

                                <?php foreach($GLOBAL[$com][$type]['status'] as $key => $value){ ?>

                                <td style="width: 60px; text-align: center;"><?=$value?></td>

                                <?php } ?>

                                <?php foreach($GLOBAL[$com][$type]['check'] as $key => $value){ ?>

                                <td style="width: 60px; text-align: center;"><?=$value?></td>

                                <?php } ?>

                                <td style="width: 90px; text-align: center;">Thao Tác</td>

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



                                <td style="width:50px" align="center">

                                    <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]"

                                        onkeypress="return OnlyNumber(event)" class="tipS smallText update_stt"

                                        original-title="Nhập số thứ tự " rel="<?=$items[$i]['id']?>" />

                                    <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>"

                                            src="images/loader.gif" alt="loader" /></div>

                                </td>

                                <?php if($GLOBAL[$com][$type]['img']==true){ ?>

                                <td align="center" class="title_name_data">

                                    <a href="index.html?com=attribute&act=edit<?php if($_GET['id_list']!='') echo'&id_list='. $_GET['id_list'];?><?php if($_GET['id_cat']!='') echo'&id_cat='. $_GET['id_cat'];?><?php if($_GET['id_item']!='') echo'&id_item='. $_GET['id_item'];?><?php if($_GET['id_sub']!='') echo'&id_sub='. $_GET['id_sub'];?><?php if($_GET['id_product']!='') echo'&id_product='. $_GET['id_product'];?>&id=<?=$items[$i]['id']?><?php if($_GET['type']!='') echo'&type='. $_GET['type'];?><?php if($_GET['page']!='') echo'&page='. $_GET['page'];?>"

                                        class="tipS SC_bold">

                                        <img class="img-list" src="<?=_upload_baiviet.$items[$i]['photo']?>" alt="" width="70">

                                    </a>

                                </td>

                                <?php } ?>



                                <td class="title_name_data">

                                    <a href="index.html?com=attribute&act=edit<?php if($_GET['id_list']!='') echo'&id_list='. $_GET['id_list'];?><?php if($_GET['id_cat']!='') echo'&id_cat='. $_GET['id_cat'];?><?php if($_GET['id_item']!='') echo'&id_item='. $_GET['id_item'];?><?php if($_GET['id_sub']!='') echo'&id_sub='. $_GET['id_sub'];?><?php if($_GET['id_product']!='') echo'&id_product='. $_GET['id_product'];?>&id=<?=$items[$i]['id']?><?php if($_GET['type']!='') echo'&type='. $_GET['type'];?><?php if($_GET['page']!='') echo'&page='. $_GET['page'];?>"

                                        class="tipS SC_bold"><?=$items[$i]['ten_vi']?></a>

                                    <div class="add-attr mt10">

                                        <a style="color:#37a000;font-size:12px"

                                            href="index.html?com=attribute&act=edit<?php if($_GET['id_list']!='') echo'&id_list='. $_GET['id_list'];?><?php if($_GET['id_cat']!='') echo'&id_cat='. $_GET['id_cat'];?><?php if($_GET['id_item']!='') echo'&id_item='. $_GET['id_item'];?><?php if($_GET['id_sub']!='') echo'&id_sub='. $_GET['id_sub'];?><?php if($_GET['id_product']!='') echo'&id_product='. $_GET['id_product'];?>&id=<?=$items[$i]['id']?><?php if($_GET['type']!='') echo'&type='. $_GET['type'];?><?php if($_GET['page']!='') echo'&page='. $_GET['page'];?>&act_baiviet=<?=$_GET["act_baiviet"]?>&page_baiviet=<?=$_GET["page_baiviet"]?>"

                                            class="tipS SC_bold">

                                            <i class="fa fa-edit"></i>

                                            Chỉnh sửa

                                        </a>

                                        <a style="color:#D33331;font-size:12px"

                                            href="index.html?com=attribute&act=delete&id=<?=$items[$i]['id']?><?php if($_GET['id_product']!='') echo'&id_product='. $_GET['id_product'];?><?php if($_GET['type']!='') echo'&type='. $_GET['type'];?><?php if($_GET['page']!='') echo'&page='. $_GET['page'];?>&act_baiviet=<?=$_GET["act_baiviet"]?>&page_baiviet=<?=$_GET["page_baiviet"]?>"

                                            class="tipS SC_bold">

                                            <i class="fa fa-trash"></i>

                                            Xóa

                                        </a>

                                    </div>

                                </td>

                    
                                <?php if(!empty($GLOBAL[$com][$type]['status'])){ $arr_status=explode(',',$items[$i]['status']);?>

                                <?php foreach($GLOBAL[$com][$type]['status'] as $k1 => $v1){?>

                                    <td class="sortCol" align="center">

                                        <label class="stardust-checkbox checkOnOff">

                                            <input class="checker-status" data-table="<?=$com?>" data-type="<?=$type?>" data-id="<?=$items[$i]['id']?>"

                                                <?php if(in_array($k1,$arr_status)) echo 'checked'; ?> name="status<?=$items[$i]['id']?>[]" type="checkbox" value="<?=$k1?>"

                                                style="display:none">

                                            <div class="stardust-checkbox__box"></div>

                                        </label>

                                    </td>

                                <?php }?>

                                <?php }?>

                                <?php foreach($GLOBAL[$com][$type]['check'] as $key => $value){?>

                                <td align="center">

                                    <label class="stardust-checkbox checkOnOff">

                                        <input class="stardust-checkbox__input" data-id="<?=$items[$i]['id']?>"

                                            data-table="table_attribute" data-type="<?=$key?>" rel="<?=$items[$i][$key]?>"

                                            <?php if($items[$i][$key]==1) echo 'checked'; ?> name="onOff" type="checkbox"

                                            style="display:none">

                                        <div class="stardust-checkbox__box"></div>

                                    </label>

                                </td>

                                <?php } ?>

                                <td class="actBtns">

                                    <a class="text-primary"

                                        href="index.html?com=attribute&act=edit<?php if($_GET['id_list']!='') echo'&id_list='. $_GET['id_list'];?><?php if($_GET['id_cat']!='') echo'&id_cat='. $_GET['id_cat'];?><?php if($_GET['id_item']!='') echo'&id_item='. $_GET['id_item'];?><?php if($_GET['id_sub']!='') echo'&id_sub='. $_GET['id_sub'];?><?php if($_GET['id_product']!='') echo'&id_product='. $_GET['id_product'];?>&id=<?=$items[$i]['id']?><?php if($_GET['type']!='') echo'&type='. $_GET['type'];?><?php if($_GET['page']!='') echo'&page='. $_GET['page'];?>&act_baiviet=<?=$_GET["act_baiviet"]?>&page_baiviet=<?=$_GET["page_baiviet"]?>"

                                        title="" class="smallButton tipS" original-title="Sửa"><i

                                            class="fas fa-edit"></i></a>

                                    <a class="text-danger" 
                                    data-act-baiviet="<?=$_GET["act_baiviet"]?>" 
                                    data-page-baiviet="<?=$_GET["page_baiviet"]?>" 
                                    data-id-product="<?=$_GET["id_product"]?>" 
                                    data-product="<?=$items[$i]['id']?>" 
                                    data-com="<?=$_GET['com']?>" 
                                    data-act="delete" 
                                    data-tbl="<?=$_GET['tbl']?>" 
                                    data-type="<?=$_GET['type']?>" 
                                    data-page="<?=$_GET['page']?>" href="javascript:" data-js-delete-attribute title=""

                                        class="smallButton tipS" original-title="Xóa ">

                                        <i class="fas fa-trash-alt"></i>

                                    </a>

                                </td>

                            </tr>

                            <?php } ?>

                        </tbody>

                    </table>

                </div> 

                <div class="paging"><?=$paging?></div>

            </div>



        </div>

    </form>



</div>



<script>

    function changeSelect(value,product,type){

        $.ajax({

            url:'ajax/loadSelect.php',

            type:'post',

            data:{value:value,product:product,type:type},

            success:function(data){

                $('select[data-cat-'+product+']').html(data);

            }

        });

    }

    function updateSelect(value,product,type,x){

        $.ajax({

            url:'ajax/updateSelect.php',

            type:'post',

            data:{value:value,product:product,type:type,loai:x},

            success:function(data){

                // window.location.reload();

            }

        });

    }

    $(function(){

        $('select[data-view-id]').change(function(){

            var _o=$(this);

            var _v=_o.val();

            var _idp=_o.attr('data-product');

            var _type="<?=$_GET['type']?>";

            $.confirm({

                title: 'Xác nhận!',

                content: 'Bạn có chắc chắn muốn thay đổi danh mục này!',

                buttons: {

                    success: {

                        text: 'Đồng ý!',

                        btnClass: 'btn-blue',

                        action: function(){

                            changeSelect(_v,_idp,_type);

                            updateSelect(_v,_idp,'<?=$type?>','idl');

                        }

                    },

                    cancel: {   

                        text: 'Hủy ngay!',

                        btnClass: 'btn-red'

                    }

                }

            });

        });

        $('select[data-view-cat]').change(function(){

            var _o=$(this);

            var _v=_o.val();

            var _idp=_o.attr('data-product');

            $.confirm({

                title: 'Xác nhận!',

                content: 'Bạn có chắc chắn muốn thay đổi danh mục này!',

                buttons: {

                    success: {

                        text: 'Đồng ý!',

                        btnClass: 'btn-blue',

                        action: function(){

                            updateSelect(_v,_idp,'<?=$type?>','idc');

                        }

                    },

                    cancel: {   

                        text: 'Hủy ngay!',

                        btnClass: 'btn-red'

                    }

                }

            });

            

        });

        $('select[data-view-item]').change(function(){

            var _o=$(this);

            var _v=_o.val();

            var _idp=_o.attr('data-product');

            $.confirm({

                title: 'Xác nhận!',

                content: 'Bạn có chắc chắn muốn thay đổi danh mục này!',

                buttons: {

                    success: {

                        text: 'Đồng ý!',

                        btnClass: 'btn-blue',

                        action: function(){

                            updateSelect(_v,_idp,'<?=$type?>','idi');

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