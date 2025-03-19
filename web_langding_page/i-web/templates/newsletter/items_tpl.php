<script>

$(document).ready(function() {

    $("#chonhet").click(function() {

        var status = this.checked;

        $("input[name='chon']").each(function() {

            this.checked = status;

        });

    });



    $('.box-search button').click(function(event) {

        var keyword = $(this).parent().find('input').val();

        window.location.href = "index.html?com=newsletter&act=man&type=<?=$_GET['type']?>&keyword=" +

            keyword + "&page=<?=$_GET['page']?>";

    });



     $("#send").click(function() {

        var listid=$("input[name='chon']:checked").map(function() {

            return this.value

        }).get().join(",");



        if(listid.length>0){

            $.confirm({

                title: 'Xác nhận!',

                content: 'Bạn có gửi thư đi!',

                buttons: {

                    success: {

                        text: 'Đồng ý!',

                        btnClass: 'btn-blue',

                        action: function(){

                           redirect("index.html?com=newsletter&act=send&listid=" + listid +"<?php if($_GET['type']!='') echo'&type='. $_GET['type'];?><?php if($_GET['page']!='') echo'&page='. $_GET['page'];?>");

                        }

                    },

                    cancel: {   

                        text: 'Hủy ngay!',

                        btnClass: 'btn-red'

                    }

                }

            });

        }else{



            alert('Bạn chưa chọn email để gửi!');

            return false;



        }

    });

});

</script>



<div class="control_frm">

    <div class="bc">

        <ul id="breadcrumbs" class="breadcrumbs">

            <li><a

                    href="index.html?com=newsletter&act=man<?php if($_GET['type']!='') echo'&type='. $_GET['type'];?><?php if($_GET['page']!='') echo'&page='. $_GET['page'];?>"><span><?=_quanly?></span></a>

            </li>

            <?php if($_GET['keyword']!=''){ ?>

            <li class="current"><a href="#" onclick="return false;"><?=_ketquatimkiem?> " <?=$_GET['keyword']?> " </a>

            </li>

            <?php }else{ ?>

            <li class="current"><a href="#" onclick="return false;"><?=_quanlyemail?></a></li>

            <?php } ?>

        </ul>

        <div class="clear"></div>

    </div>

</div>



<form name="frm" method="post"

    action="index.html?com=newsletter&act=send<?php if($_GET['type']!='') echo'&type='. $_GET['type'];?><?php if($_GET['page']!='') echo'&page='. $_GET['page'];?>"

    enctype="multipart/form-data" id="f">

    <div class="oneOne">

        <div class="box-admin d-flex d-block-m align-items-center">

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

                    <tr style="text-align:center">

                        <td>



                            <label class="stardust-checkbox">

                                <input class="stardust-checkbox__input" id="checkAll" type="checkbox" value=""

                                    style="display:none">

                                <div class="stardust-checkbox__box"></div>

                            </label>

                        </td>

                        <td align="left" class="sortCol">

                            <div><?=_email?><span></span></div>

                        </td>

                        <!-- <td class="sortCol"><div>Tên<span></span></div></td>

                        <td align="left" class="sortCol"><div>Điện thoại<span></span></div></td>

                        <td style="width:150px" align="center" class="tb_data_small">nội dung</td> -->

                        <td style="width:150px" align="left" class="tb_data_small">Ngày tạo</td>

                        <td class="tb_data_small"><?=_thaotac?></td>

                    </tr>

                </thead>



                <tbody>

                    <?php for($i=0, $count=count($items); $i<$count; $i++){?>

                    <tr style="text-align:center">

                        <td>

                            <label class="stardust-checkbox checker">

                                <input class="stardust-checkbox__input" name="chon" id="check<?=$i?>" type="checkbox"

                                    value="<?=$items[$i]['id']?>" style="display:none">

                                <div class="stardust-checkbox__box"></div>

                            </label>

                        </td>

                        <td align="left"><b><?=$items[$i]['email']?></b></td>

                        <!-- <td align="left"><b><?=$items[$i]['ten_vi']?></b></td> -->

                        <!-- <td align="left"><b><?=$items[$i]['dienthoai']?></b></td> -->

                        <!-- <td style="width:150px" align="center"><b><?=$items[$i]['noidung']?></b></td> -->

                        <td style="width:150px" align="center"><b><?=date('d/m/Y',$items[$i]['ngaytao'])?></b></td>

                        <td class="tb_data_small">

                           <a class="text-danger" data-product="<?=$items[$i]['id']?>" data-com="<?=$_GET['com']?>" data-act="delete" data-tbl="<?=$_GET['tbl']?>" data-type="<?=$_GET['type']?>" data-page="<?=$_GET['page']?>" href="javascript:" data-js-delete title=""

                                    class="smallButton tipS" original-title="Xóa "><i class="fas fa-trash-alt"></i></a>

                        </td>

                    </tr>

                    <?php } ?>

                </tbody>

            </table>
                    </div>
        </div>

    </div>



    <div class="oneOne">

        <div class="widget mtop0">

            <div class="formRow">

                <label><?=_filedinhkem?>:</label>

                <div class="formRight">

                    <input type="file" id="file" name="file" />

                    <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS"

                        original-title="Tải File (rar|zip|doc|docx|xls|xlsx|ppt|pptx|pdf|png|jpg|jpeg|gif)">

                </div>

                <div class="clear"></div>

            </div>



            <div class="formRow form">

                <label><?=_tieude?></label>

                <div class="formRight">

                    <input type="text" name="ten_vi" title="Nhập tiêu đề " id="ten_vi" class="tipS validate[required]"

                        value="<?=@$item['ten_vi']?>" />

                </div>

                <div class="clear"></div>

            </div>





            <div class="formRow">

                <label><?=_noidung?></label>

                <div class="ck_editor">

                    <textarea id="noidung_vi" name="noidung_vi" class="ck_editors"><?=@$item['noidung_vi']?></textarea>

                </div>

                <div class="clear"></div>

            </div>



            <div class="formRow">

                <button id="send" class="btn btn-sm bg-gradient-primary text-white submit-check">

                    <i class="far fa-save mr-2"></i><?=_sendmail?>

                </button>

            </div>

        </div>

    </div>



</form>