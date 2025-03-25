<script type="text/javascript">
    $(document).ready(function() {

        $('.update_stt').keyup(function(event) {

            var id = $(this).attr('rel');

            var table = 'booking';

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

            window.location.href = "index.html?com=booking&act=man&type=<?= $_GET['type'] ?>&keyword=" +

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
                                    "index.html?com=booking&act=delete&type=<?= $_GET['type'] ?>&page=<?= $_GET['page'] ?>&listid=" +
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

            <li><a href="index.html?com=booking&act=man<?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?>"><span>Quản

                        lý <?= $GLOBAL[$com][$type]['title'] ?></span></a></li>

            <?php if ($_GET['keyword'] != '') { ?>

                <li class="current"><a href="#" onclick="return false;">Kết quả tìm kiếm " <?= $_GET['keyword'] ?> " </a>
                </li>

            <?php } else { ?>

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

                <a class="btn btn-sm bg-gradient-danger text-white" id="xoahet">

                    <i class="far fa-trash-alt mr-2"></i>Xóa tất cả

                </a>

            </div>

            <div class="box-search">

                <input type="text" value="" placeholder="Nhập từ khóa tìm kiếm ">

                <button type="button" style="border-radius:0" class="btn btn-navbar text-white" value=""><i class="fas fa-search"></i></button>

            </div>

        </div>

    </div>

    <div class="oneOne">

        <div class="widget mtop0">

            <div class="table-responsive">

                <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">

                    <thead>

                        <tr>

                            <td style="">

                                <label class="stardust-checkbox">

                                    <input class="stardust-checkbox__input" id="checkAll" type="checkbox" value="" style="display:none">

                                    <div class="stardust-checkbox__box"></div>

                                </label>

                            </td>
                            <?php if ($GLOBAL[$com][$type]['product'] == true) { ?>

                                <td width="20%" class="tb_data_small" style="text-align: left !important;">Sản phẩm</td>

                            <?php } ?>

                            <?php if ($GLOBAL[$com][$type]['ten'] == true) { ?>

                                <td width="20%" class="tb_data_small" style="text-align: left !important;">Tên</td>

                            <?php } ?>

                            <?php if ($GLOBAL[$com][$type]['id_product'] == true) { ?>

                                <td width="20%" class="tb_data_small" style="text-align: left !important;">Tên phòng đặt</td>

                            <?php } ?>

                            <?php if ($GLOBAL[$com][$type]['phone'] == true) { ?>

                                <td width="20%" class="tb_data_small" style="text-align: left !important;">Điện thoại</td>

                            <?php } ?>
                            <?php if ($GLOBAL[$com][$type]['website'] == true) { ?>

                                <td width="20%" class="tb_data_small" style="text-align: left !important;">Website</td>

                            <?php } ?>
                            <?php if ($GLOBAL[$com][$type]['email'] == true) { ?>

                                <td width="20%" class="tb_data_small" style="text-align: left !important;">Email</td>

                            <?php } ?>
                            <?php if ($GLOBAL[$com][$type]['sophong'] == true) { ?>

                                <td width="20%" class="tb_data_small" style="text-align: left !important;">Số phòng</td>

                            <?php } ?>
                            <?php if ($GLOBAL[$com][$type]['songuoi'] == true) { ?>

                                <td width="20%" class="tb_data_small" style="text-align: left !important;">Số người</td>

                            <?php } ?>
                            <?php if ($GLOBAL[$com][$type]['giaphong'] == true) { ?>

                                <td width="20%" class="tb_data_small" style="text-align: left !important;">Giá</td>

                            <?php } ?>

                            <?php if ($GLOBAL[$com][$type]['diachi'] == true) { ?>

                                <td width="20%" class="tb_data_small" style="text-align: left !important;">Địa chỉ</td>

                            <?php } ?>

                            <?php if ($GLOBAL[$com][$type]['dichvu'] == true) { ?>

                                <td width="20%" style="text-align: left !important;">Dịch vụ đã chọn</td>

                            <?php } ?>

                            <?php if ($GLOBAL[$com][$type]['nhucau'] == true) { ?>

                                <td width="20%" style="text-align: left !important;">Nhu cầu</td>

                            <?php } ?>

                            <?php if ($GLOBAL[$com][$type]['soluong'] == true) { ?>

                                <td width="20%" style="text-align: left !important;">Số lượng</td>

                            <?php } ?>

                            <?php if ($GLOBAL[$com][$type]['quycach'] == true) { ?>

                                <td width="20%" style="text-align: left !important;">Quy cách</td>

                            <?php } ?>

                            <?php if ($GLOBAL[$com][$type]['loai_thung'] == true) { ?>

                                <td width="20%" style="text-align: left !important;">Loại thùng</td>

                            <?php } ?>
                            <?php if ($GLOBAL[$com][$type]['loai_sp'] == true) { ?>

                                <td width="20%" class="tb_data_small" style="text-align: left !important;">In</td>

                            <?php } ?>

                            <?php if ($GLOBAL[$com][$type]['ngaydatlich'] == true) { ?>

                                <td width="10%" class="tb_data_small" style="text-align: center !important;">Ngày đặt lịch</td>

                            <?php } ?>

                            <?php if ($GLOBAL[$com][$type]['khunggio'] == true) { ?>

                                <td width="20%" style="text-align: left !important;">Giờ đặt lịch</td>

                            <?php } ?>

                            <?php if ($GLOBAL[$com][$type]['noidung'] == true) { ?>

                                <td width="29%" style="text-align: left !important;">Nội dung</td>

                            <?php } ?>
                            <?php if ($GLOBAL[$com][$type]['ngayvao'] == true) { ?>

                                <td width="20%" class="tb_data_small" style="text-align: left !important;">Ngày vào</td>

                            <?php } ?>
                            <?php if ($GLOBAL[$com][$type]['ngayra'] == true) { ?>

                                <td width="20%" class="tb_data_small" style="text-align: left !important;">Ngày ra</td>

                            <?php } ?>

                            <?php if ($GLOBAL[$com][$type]['ngaytao'] == true) { ?>

                                <td width="20%" class="tb_data_small" style="text-align: left !important;">Ngày gửi</td>

                            <?php } ?>

                            <?php if ($GLOBAL[$com][$type]['file'] == true) { ?>

                                <td width="29%" class="tb_data_small" style="text-align: left !important;">

                                    Download file

                                </td>

                            <?php } ?>

                            <!-- <td width="8%" style="text-align: center !important;">Ẩn/Hiện</td> -->

                            <td width="8%" style="text-align: center;">Thao tác</td>

                        </tr>

                    </thead>



                    <tbody>

                        <?php for ($i = 0, $count = count($items); $i < $count; $i++) { ?>

                            <tr>

                                <td style="width:3%">

                                    <label class="stardust-checkbox checker">

                                        <input class="stardust-checkbox__input" name="chon" id="check<?= $i ?>" type="checkbox" value="<?= $items[$i]['id'] ?>" style="display:none">

                                        <div class="stardust-checkbox__box"></div>

                                    </label>

                                </td>
                                <?php if ($GLOBAL[$com][$type]['product'] == true) { ?>

                                    <td class="title_name_data">

                                        <?= $items[$i]['product'] ?>

                                    </td>

                                <?php } ?>


                                <?php if ($GLOBAL[$com][$type]['ten'] == true) { ?>

                                    <td class="title_name_data">

                                        <a href="index.html?com=booking&act=edit&id=<?= $items[$i]['id'] ?>&type=<?= ($_GET['type'] != '') ? $_GET['type'] : '' ?>" class="tipS SC_bold"><?= $items[$i]['ten_vi'] ?></a>

                                    </td>

                                <?php } ?>

                                <?php if ($GLOBAL[$com][$type]['id_product'] == true) {
                                    $tensanpham = $db->rawQueryOne("select ten_$lang as ten from #_baiviet where type=? and id=? limit 0,1", array('danh-sach-phong', $items[$i]["id_product"]));
                                ?>

                                    <td class="title_name_data">

                                        <?= $tensanpham["ten"] ?>

                                    </td>

                                <?php } ?>

                                <?php if ($GLOBAL[$com][$type]['phone'] == true) { ?>

                                    <td class="title_name_data">

                                        <?= $items[$i]['dienthoai'] ?>

                                    </td>

                                <?php } ?>

                                <?php if ($GLOBAL[$com][$type]['website'] == true) { ?>

                                    <td class="title_name_data">

                                        <?= $items[$i]['website'] ?>

                                    </td>

                                <?php } ?>

                                <?php if ($GLOBAL[$com][$type]['email'] == true) { ?>

                                    <td class="title_name_data">

                                        <?= $items[$i]['email'] ?>

                                    </td>

                                <?php } ?>
                                <?php if ($GLOBAL[$com][$type]['sophong'] == true) { ?>

                                    <td class="title_name_data">

                                        <?= $items[$i]['sophong'] ?>

                                    </td>

                                <?php } ?>
                                <?php if ($GLOBAL[$com][$type]['songuoi'] == true) { ?>

                                    <td class="title_name_data">

                                        <?= $items[$i]['songuoi'] ?>

                                    </td>

                                <?php } ?>
                                <?php if ($GLOBAL[$com][$type]['giaphong'] == true) { ?>

                                    <td class="title_name_data">

                                        <?= $items[$i]['giaphong'] ?>

                                    </td>

                                <?php } ?>

                                <?php if ($GLOBAL[$com][$type]['nhucau'] == true) { ?>

                                    <td class="title_name_data">

                                        <?= $items[$i]['nhucau'] ?>

                                    </td>

                                <?php } ?>
                                <?php if ($GLOBAL[$com][$type]['soluong'] == true) { ?>

                                    <td class="title_name_data">

                                        <?= $items[$i]['soluong'] ?>

                                    </td>

                                <?php } ?>

                                <?php if ($GLOBAL[$com][$type]['quycach'] == true) { ?>

                                    <td class="title_name_data">

                                        <?= $items[$i]['quycach'] ?>

                                    </td>

                                <?php } ?>

                                <?php if ($GLOBAL[$com][$type]['loai_thung'] == true) { ?>

                                    <td class="title_name_data">

                                        <?= $items[$i]['loai_thung'] ?>

                                    </td>

                                <?php } ?>

                                <?php if ($GLOBAL[$com][$type]['loai_sp'] == true) { ?>

                                    <td class="title_name_data">

                                        <?= $items[$i]['loai_sp'] ?>

                                    </td>

                                <?php } ?>

                                <?php if ($GLOBAL[$com][$type]['diachi'] == true) { ?>

                                    <td class="title_name_data">

                                        <?= $items[$i]['diachi'] ?>

                                    </td>

                                <?php } ?>

                                <?php if ($GLOBAL[$com][$type]['dichvu'] == true) {
                                    $getService = $db->rawQueryOne("select id,ten_$lang as ten from #_baiviet where hienthi=1 and type=? and id=? limit 1", array('linh-vuc-hoat-dong', $items[$i]["id_dichvu"]));
                                ?>

                                    <td class="title_name_data">

                                        <!-- <a title="<?= $getService["ten"] ?>" href="javascript:void(0)"><?= $getService["ten"] ?></a> -->
                                        <?= $getService["ten"] ?>

                                    </td>

                                <?php } ?>

                                <?php if ($GLOBAL[$com][$type]['ngaydatlich'] == true) { ?>

                                    <td class="title_name_data">

                                        <?= htmlspecialchars_decode($items[$i]['ngaydatlich']) ?>

                                    </td>

                                <?php } ?>

                                <?php if ($GLOBAL[$com][$type]['khunggio'] == true) { ?>

                                    <td class="title_name_data">

                                        <?= htmlspecialchars_decode($items[$i]['khunggio']) ?>

                                    </td>

                                <?php } ?>

                                <?php if ($GLOBAL[$com][$type]['noidung'] == true) { ?>

                                    <td class="title_name_data">

                                        <?= htmlspecialchars_decode($items[$i]['noidung']) ?>

                                    </td>

                                <?php } ?>
                                <?php if ($GLOBAL[$com][$type]['ngayvao'] == true) { ?>

                                    <td class="title_name_data">

                                        <?= date('d-m-Y', $items[$i]["ngayvao"]) ?>

                                    </td>

                                <?php } ?>
                                <?php if ($GLOBAL[$com][$type]['ngayra'] == true) { ?>

                                    <td class="title_name_data">

                                        <?= date('d-m-Y', $items[$i]["ngayra"]) ?>

                                    </td>

                                <?php } ?>

                                <?php if ($GLOBAL[$com][$type]['ngaytao'] == true) { ?>

                                    <td class="title_name_data">

                                        <?= date('d-m-Y', $items[$i]["ngaytao"]) ?>

                                    </td>

                                <?php } ?>

                                <?php if ($GLOBAL[$com][$type]['file'] == true) { ?>

                                    <td class="title_name_data">

                                        <?php if ($items[$i]['tailieu'] != '') { ?>

                                            <a href="<?= _upload_tailieu . $items[$i]['tailieu'] ?>">

                                                <?= $items[$i]['tailieu'] ?>

                                            </a>

                                        <?php } else {
                                            echo 'Empty!';
                                        } ?>

                                    </td>

                                <?php } ?>

                                <td class="actBtns">
                                    <?php
                                    if ($_GET["type"] != 'danh-gia') {
                                    ?>

                                        <a class="text-primary" href="index.html?com=booking&act=edit&id=<?= $items[$i]['id'] ?><?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?>" title="" class="smallButton tipS" original-title="Sửa "><i class="fas fa-edit"></i></a>
                                    <?php } ?>

                                    <a class="text-danger" data-product="<?= $items[$i]['id'] ?>" data-com="<?= $_GET['com'] ?>" data-act="delete" data-tbl="<?= $_GET['tbl'] ?>" data-type="<?= $_GET['type'] ?>" data-page="<?= $_GET['page'] ?>" href="javascript:" data-js-delete title="" class="smallButton tipS" original-title="Xóa "><i class="fas fa-trash-alt"></i></a>

                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</form>

<div class="paging"><?= $paging ?></div>