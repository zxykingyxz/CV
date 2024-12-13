<style>
    .select-w {

        width: 130px;

    }
</style>

<script type="text/javascript">
    $(document).ready(function() {

        $('.update_stt').keyup(function(event) {

            var id = $(this).attr('rel');

            var table = 'flashsale';

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
                "index.html?com=flashsale&act=man_info&type=<?= $_GET['type'] ?>&keyword=" +

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
                                    "index.html?com=flashsale&act=delete_info&id=<?= $_GET["id"] ?>&page=<?= $_GET['page'] ?>&listid=" +
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

                <li>
                    <a href="index.html?com=flashsale&act=man_info<?php if ($_GET['tbl'] != '') echo '&tbl=' . $_GET['tbl']; ?><?php if ($_GET['id'] != '') echo '&id=' . $_GET['id']; ?><?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?><?php if ($_GET['page'] != '') echo '&page=' . $_GET['page']; ?>"><span>Sản phẩm flash sale</span></a>
                </li>

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

                    <?php

                    if ($_GET["act"] == "man_info") {

                        $urlBaiviet = "index.php?com=flashsale&act=man&type=flashsale&page={$_GET["page_flashsale"]}";
                    } else {

                        $urlBaiviet = "index.html?com=flashsale&act=edit&id={$_GET["id_product"]}&type=flashsale&page={$_GET["page_flashsale"]}";
                    }

                    ?>

                    <a class="btn btn-sm bg-gradient-primary text-white" href="<?= $urlBaiviet ?>">

                        <i class="fas fa-backward mr-2"></i>Trở lại

                    </a>
                    <a class="btn btn-confirm btn-sm text-white" data-id="<?= $_GET['id'] ?>" style="background: #f00;" href="javascript:void(0)">

                        </i>Xác nhận

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

                <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
                    <thead>
                        <tr>
                            <td>
                                <label class="stardust-checkbox">

                                    <input class="stardust-checkbox__input" id="checkAll" type="checkbox" value="" style="display:none">

                                    <div class="stardust-checkbox__box"></div>
                                </label>
                            </td>
                            <td style="width:40px!important" class="tb_data_small">Stt</td>
                            <td style="width: 70px; text-align: center;">Hình Ảnh</td>
                            <td class="sortCol" style="width:290px">
                                <div>Tiêu đề</div>
                            </td>
                            <td class="sortCol" style="width:290px">
                                <div>Giá Sale</div>
                            </td>
                            <?php /*
                            <td style="width: 60px; text-align: center;">Hiển thị</td>
                            <td style="width: 90px; text-align: center;">Thao Tác</td>
                            */ ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pro_sale = $db->rawQuery("select stt, id,ten_$lang as ten,photo,giabansale from #_baiviet where type=? and flashsale=1", array('san-pham'));

                        $check_sale = $db->rawQueryOne("select id_product from #_flashsale where type=? and id=? and hienthi=1", array('flashsale', $_GET['id']));
                        $check_sale_tmp = explode(',', $check_sale['id_product']);
                        foreach ($pro_sale as $k => $v) {

                        ?>
                            <tr <?= ($k % 2 == 0) ? 'style="background: rgba(0,0,0,.05);"' : '' ?>>
                                <td>
                                    <label class="stardust-checkbox checker">
                                        <input class="stardust-checkbox__input check-btn" <?= (in_array($v['id'], $check_sale_tmp) ? 'checked' : '') ?> name="" id="check<?= $i ?>" type="checkbox" value="<?= $v['id'] ?>" style="display:none">
                                        <div class="stardust-checkbox__box"></div>
                                    </label>
                                </td>

                                <td style="width:50px" align="center">

                                    <input type="text" value="<?= $v['stt'] ?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText update_stt" original-title="Nhập số thứ tự " rel="<?= $v['id'] ?>" />

                                    <div id="ajaxloader"><img class="numloader" id="ajaxloader<?= $v['id'] ?>" src="images/loader.gif" alt="loader" /></div>

                                </td>

                                <td class="title_name_data">
                                    <img class="img-list" src="<?= _upload_baiviet . $v['photo'] ?>" alt="" width="70">
                                </td>
                                <td class="title_name_data t-center">
                                    <?= $v['ten'] ?>
                                </td>
                                <td class="title_name_data t-center">
                                    <?= $func->changeMoney($v['giabansale'], 'đ') ?>
                                </td>
                                <?php /*
                                <td align="center">

                                    <label class="stardust-checkbox checkOnOff">

                                        <input class="stardust-checkbox__input" data-id="<?= $items[$i]['id'] ?>" data-table="table_flashsale" data-type="hienthi" rel="<?= $items[$i]['hienthi'] ?>" <?php if ($items[$i]['hienthi'] == 1) echo 'checked'; ?> name="onOff" type="checkbox" style="display:none">
                                        <div class="stardust-checkbox__box"></div>
                                    </label>
                                </td>

                                <td class="actBtns">

                                    <a class="text-primary" href="index.html?com=flashsale&act=edit_info<?php if ($_GET['tbl'] != '') echo '&tbl=' . $_GET['tbl']; ?><?php if ($_GET['id'] != '') echo '&id=' . $_GET['id']; ?>&id_product=<?= $items[$i]['id_product'] ?><?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?><?php if ($_GET['page'] != '') echo '&page=' . $_GET['page']; ?>" title="" class="smallButton tipS" original-title="Sửa"><i class="fas fa-edit"></i></a>
                                    <a class="text-danger" data-product="<?= $items[$i]['id_product'] ?>" data-com="<?= $_GET['com'] ?>" data-act="delete_info" data-flash="<?= $_GET["id"] ?>" data-tbl="<?= $_GET['tbl'] ?>" data-type="<?= $_GET['type'] ?>" data-page="<?= $_GET['page'] ?>" href="javascript:" data-js-delete-info title="" class="smallButton tipS" original-title="Xóa ">

                                        <i class="fas fa-trash-alt"></i>

                                    </a>
                                </td>
                                */ ?>
                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

                <div class="paging"><?= $paging ?></div>

            </div>



        </div>

    </form>



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

            var _type = "<?= $_GET['type'] ?>";

            $.confirm({

                title: 'Xác nhận!',

                content: 'Bạn có chắc chắn muốn thay đổi danh mục này!',

                buttons: {

                    success: {

                        text: 'Đồng ý!',

                        btnClass: 'btn-blue',

                        action: function() {

                            changeSelect(_v, _idp, _type);

                            updateSelect(_v, _idp, '<?= $type ?>', _data);

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

                            updateSelect(_v, _idp, '<?= $type ?>', 'idc');

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

                            updateSelect(_v, _idp, '<?= $type ?>', 'idi');

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