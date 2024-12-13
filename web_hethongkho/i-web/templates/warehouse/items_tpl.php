<script type="text/javascript">
    $(document).ready(function() {

        $('.update_stt').keyup(function(event) {

            var id = $(this).attr('rel');

            var table = 'baiviet';

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

            window.location.href = "index.html?com=warehouse&type=account&act=man&keyword=" +

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
                                    "index.html?com=baiviet&act=delete&tbl=<?= $_GET['tbl'] ?>&type=<?= $_GET['type'] ?>&page=<?= $_GET['page'] ?>&listid=" +
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

                <li><a href="index.html?com=warehouse&type=account&act=man&page=1'; ?>"><span><?= " Tài Khoản Thành Viên" ?></span></a>

                </li>

                <?php if ($_GET['keyword'] != '') { ?>

                    <li class="current"><a href="#" onclick="return false;">Kết quả tìm kiếm " <?= $_GET['keyword'] ?> "
                        </a>

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

            <div class="box-admin d-flex d-block-m align-items-center">

                <div class="box-action">
                    <?php /*
                    <a class="btn btn-sm bg-gradient-primary text-white" href="index.html?com=baiviet&act=add<?php if ($_GET['id_list'] != '') echo '&id_list=' . $_GET['id_list']; ?><?php if ($_GET['id_cat'] != '') echo '&id_cat=' . $_GET['id_cat']; ?><?php if ($_GET['id_item'] != '') echo '&id_item=' . $_GET['id_item']; ?><?php if ($_GET['id_sub'] != '') echo '&id_sub=' . $_GET['id_sub']; ?><?php if ($_GET['id_product'] != '') echo '&id_product=' . $_GET['id_product']; ?><?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?><?php if ($_GET['page'] != '') echo '&page=' . $_GET['page']; ?>">

                        <i class="fas fa-plus mr-2"></i>Thêm mới

                    </a>

                    <a class="btn btn-sm bg-gradient-danger text-white" id="xoahet">

                        <i class="far fa-trash-alt mr-2"></i>Xóa tất cả

                    </a>
                    */ ?>
                </div>

                <div class="box-search mt-m-20">

                    <input type="text" class="mg-m-0" value="" placeholder="Nhập từ khóa tìm kiếm ">

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

                                <td>

                                    <label class="stardust-checkbox">

                                        <input class="stardust-checkbox__input" id="checkAll" type="checkbox" value="" style="display:none">

                                        <div class="stardust-checkbox__box"></div>

                                    </label>

                                </td>

                                <td class="sortCol">

                                    <div>Tiêu Đề</div>

                                </td>

                                <td>Tên cửa hàng</td>
                                <td>Số Điện Thoại</td>
                                <td>Email</td>

                                <!-- <td>Thao Tác</td> -->

                            </tr>

                        </thead>

                        <tbody>

                            <?php for ($i = 0, $count = count($items); $i < $count; $i++) {

                            ?>

                                <tr>

                                    <td>

                                        <label class="stardust-checkbox checker">

                                            <input class="stardust-checkbox__input" name="chon" id="check<?= $i ?>" type="checkbox" value="<?= $items[$i]['id'] ?>" style="display:none">

                                            <div class="stardust-checkbox__box"></div>

                                        </label>

                                    </td>

                                    <td class="title_name_data">
                                        <a href='javascript:void(0)' class="tipS SC_bold"><?= $items[$i]['name'] ?></a>
                                    </td>

                                    <td class="" align="center"><?= $items[$i]['subdomain'] ?></td>
                                    <td class="" align="center"><?= $items[$i]['phone'] ?></td>
                                    <td class="" align="center"><?= $items[$i]['email'] ?></td>

                                    <?php /*
                                    <td class="actBtns">

                                        <a class="text-primary" href="index.html?com=baiviet&act=edit<?php if ($_GET['id_list'] != '') echo '&id_list=' . $_GET['id_list']; ?><?php if ($_GET['id_cat'] != '') echo '&id_cat=' . $_GET['id_cat']; ?><?php if ($_GET['id_item'] != '') echo '&id_item=' . $_GET['id_item']; ?><?php if ($_GET['id_sub'] != '') echo '&id_sub=' . $_GET['id_sub']; ?><?php if ($_GET['id_product'] != '') echo '&id_product=' . $_GET['id_product']; ?>&id=<?= $items[$i]['id'] ?><?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?><?php if ($_GET['page'] != '') echo '&page=' . $_GET['page']; ?>" title="" class="smallButton tipS" original-title="Sửa"><i class="fas fa-edit"></i></a>

                                        <a class="text-danger" data-product="<?= $items[$i]['id'] ?>" data-com="<?= $_GET['com'] ?>" data-act="delete" data-tbl="" data-type="<?= $_GET['type'] ?>" data-page="<?= $_GET['page'] ?>" href="javascript:" data-js-delete title="" class="smallButton tipS" original-title="Xóa ">

                                            <i class="fas fa-trash-alt"></i>

                                        </a>

                                    </td>
                                    */ ?>
                                </tr>

                            <?php } ?>

                        </tbody>

                    </table>
                </div>
                <div class="paging"><?= $paging ?></div>

            </div>



        </div>

    </form>



</div>



<script>
    // function changeSelect(value,product,type){
    //     $.ajax({

    //         url:'ajax/loadSelect.php',

    //         type:'post',

    //         data:{value:value,product:product,type:type},

    //         success:function(data){

    //             $('select[data-cat-'+product+']').html(data);

    //         }

    //     });

    // }

    $(document).ready(() => {
        $('.select-w').on('change', function() {
            var action = $(this).attr('id');
            var value = $(this).val();
            var product = $(this).attr('data-product');
            var type = '<?= $_GET["type"] ?>';

            if (action == 'list') {
                result = 'cat';
            } else {
                result = 'item';
            }
            if (action != 'item') {
                $.ajax({

                    url: 'ajax/loadSelect.php',

                    type: 'post',

                    data: {
                        value: value,
                        product: product,
                        type: type,
                        action: action
                    },

                    success: function(data) {

                        $('[data-' + result + '-' + product + ']').html(data);

                    }

                });
            }
        });
    });

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

            }

        });

    }

    $(function() {

        $('select[data-view-id]').change(function() {

            var _o = $(this);

            var _v = _o.val();

            var _idp = _o.attr('data-product');

            var _type = "<?= $_GET['type'] ?>";

            $.confirm({

                title: 'Xác nhận!',

                content: 'Bạn có chắc chắn muốn thay đổi danh mục này!',

                buttons: {

                    success: {

                        text: 'Đồng ý!',

                        btnClass: 'btn-blue',

                        action: function() {

                            updateSelect(_v, _idp, '<?= $type ?>', 'idl');

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
<style>
    .main_select {
        max-width: 170px;
        font-size: 10px;
    }
</style>