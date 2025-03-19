<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
            <li><a href="index.html?com=combo&act=man<?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?>"><span><?= $GLOBAL[$com][$type]['title'] ?></span></a>
            </li>
            <li class="current"><a href="#" onclick="return false;"><?= _tatca ?></a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.update_stt').keyup(function(event) {
            var id = $(this).attr('rel');
            var table = 'photo';
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
                "index.html?com=combo&act=man&type=<?= $_GET['type'] ?>&page=<?= $_GET['page'] ?>&keyword=" +
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
                                redirect("index.html?com=combo&act=delete&type=<?= $_GET['type'] ?>&page=<?= $_GET['page'] ?>&listid=" + listid);
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
        <div class="box-admin d-flex d-block-m align-items-center">
            <div class="box-action">
                <?php if (($kiemtra == 1 & $func->checkPermissions('photo', 'add', $type)) || $kiemtra != 1) { ?>
                    <a class="btn btn-sm bg-gradient-primary text-white" href="index.html?com=combo&act=add<?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?>">
                        <i class="fas fa-plus mr-2"></i>Thêm mới
                    </a>
                <?php } ?>
                <?php if (($kiemtra == 1 & $func->checkPermissions('photo', 'delete', $type)) || $kiemtra != 1) { ?>
                    <a class="btn btn-sm bg-gradient-danger text-white" id="xoahet">
                        <i class="far fa-trash-alt mr-2"></i>Xóa tất cả
                    </a>
                <?php } ?>
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
                            <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;"><?= _stt ?></a></td>
                            <?php if ($GLOBAL[$com][$type]['img'] == true) { ?>
                                <td width="150"><?= _hinhanh ?></td>
                            <?php } ?>

                            <td class="sortCol">
                                <div>Tiêu đề<span></span></div>
                            </td>
                            <?php if ($GLOBAL[$com][$type]['phone'] == true) { ?>
                                <td class="sortCol">
                                    <div>Điện thoại<span></span></div>
                                </td>
                            <?php } ?>
                            <?php if ($GLOBAL[$com][$type]['email'] == true) { ?>
                                <td class="sortCol">
                                    <div>Email<span></span></div>
                                </td>
                            <?php } ?>
                            <?php if ($GLOBAL[$com][$type]['zalo'] == true) { ?>
                                <td class="sortCol">
                                    <div>Số zalo<span></span></div>
                                </td>
                            <?php } ?>
                            <?php if ($GLOBAL[$com][$type]['address'] == true) { ?>
                                <td class="sortCol">
                                    <div>Địa chỉ<span></span></div>
                                </td>
                            <?php } ?>
                            <?php foreach ($GLOBAL[$com][$type]['check'] as $key => $value) { ?>
                                <td class="tb_data_small"><?= $value ?></td>
                            <?php } ?>

                            <td class="tb_data_small"><?= _anhien ?></td>
                            <td class="tb_data_small"><?= _thaotac ?></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0, $count = count($items); $i < $count; $i++) { ?>
                            <tr>
                                <td>
                                    <label class="stardust-checkbox checker">
                                        <input class="stardust-checkbox__input" name="chon" id="check<?= $i ?>" type="checkbox" value="<?= $items[$i]['id'] ?>" style="display:none">
                                        <div class="stardust-checkbox__box"></div>
                                    </label>
                                </td>
                                <td align="center">
                                    <input type="text" value="<?= $items[$i]['stt'] ?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText update_stt" original-title="Nhập số thứ tự <?= $GLOBAL[$com][$type]['title_main'] ?>" rel="<?= $items[$i]['id'] ?>" />
                                    <div id="ajaxloader"><img class="numloader" id="ajaxloader<?= $items[$i]['id'] ?>" src="images/loader.gif" alt="loader" /></div>
                                </td>
                                <?php if ($GLOBAL[$com][$type]['img'] == true) { ?>
                                    <td align="center">
                                        <img src="<?= _upload_hinhanh . $items[$i]['photo'] ?>" width="100" border="0" />
                                    </td>
                                <?php } ?>
                                <td class="title_name_data t-center">
                                    <a href="index.html?com=combo&act=edit&id=<?= $items[$i]['id'] ?><?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?><?php if ($_GET['page'] != '') echo '&page=' . $_GET['page']; ?>" class="tipS SC_bold"><?= $items[$i]['ten_vi'] ?></a>
                                </td>
                                <?php if ($GLOBAL[$com][$type]['phone'] == true) { ?>
                                    <td class="title_name_data t-center">
                                        <a href="index.html?com=combo&act=edit&id=<?= $items[$i]['id'] ?><?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?><?php if ($_GET['page'] != '') echo '&page=' . $_GET['page']; ?>" class="tipS SC_bold"><?= $items[$i]['phone'] ?></a>
                                    </td>
                                <?php } ?>
                                <?php if ($GLOBAL[$com][$type]['email'] == true) { ?>
                                    <td class="title_name_data t-center">
                                        <a href="index.html?com=combo&act=edit&id=<?= $items[$i]['id'] ?><?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?><?php if ($_GET['page'] != '') echo '&page=' . $_GET['page']; ?>" class="tipS SC_bold"><?= $items[$i]['email'] ?></a>
                                    </td>
                                <?php } ?>
                                <?php if ($GLOBAL[$com][$type]['zalo'] == true) { ?>
                                    <td class="title_name_data t-center">
                                        <a href="index.html?com=combo&act=edit&id=<?= $items[$i]['id'] ?><?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?><?php if ($_GET['page'] != '') echo '&page=' . $_GET['page']; ?>" class="tipS SC_bold"><?= $items[$i]['zalo'] ?></a>
                                    </td>
                                <?php } ?>
                                <?php if ($GLOBAL[$com][$type]['address'] == true) { ?>
                                    <td class="title_name_data t-center">
                                        <a href="index.html?com=combo&act=edit&id=<?= $items[$i]['id'] ?><?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?><?php if ($_GET['page'] != '') echo '&page=' . $_GET['page']; ?>" class="tipS SC_bold"><?= $items[$i]['address'] ?></a>
                                    </td>
                                <?php } ?>
                                <?php foreach ($GLOBAL[$com][$type]['check'] as $key => $value) { ?>
                                    <td align="center" <?= (($kiemtra == 1 & $func->checkPermissions('photo', 'edit', $type)) || $kiemtra != 1) ? '' : 'style="pointer-events: none;"'; ?>>
                                        <label class="stardust-checkbox checkOnOff">
                                            <input <?php if (($kiemtra == 1 & $func->checkPermissions('photo', 'edit', $type)) || $kiemtra != 1) { ?> data-id="<?= $items[$i]['id'] ?>" data-id="<?= $items[$i]['id'] ?>" data-table="table_photo" data-type="<?= $key ?>" <?php } ?> class="stardust-checkbox__input" rel="<?= $items[$i][$key] ?>" <?php if ($items[$i][$key] == 1) echo 'checked'; ?> name="onOff" type="checkbox" style="display:none">
                                            <div class="stardust-checkbox__box"></div>
                                        </label>
                                    </td>
                                <?php } ?>

                                <td align="center" <?= (($kiemtra == 1 & $func->checkPermissions('photo', 'edit', $type)) || $kiemtra != 1) ? '' : 'style="pointer-events: none;"'; ?>>
                                    <label class="stardust-checkbox checkOnOff">
                                        <input <?php if (($kiemtra == 1 & $func->checkPermissions('photo', 'edit', $type)) || $kiemtra != 1) { ?> data-id="<?= $items[$i]['id'] ?>" data-id="<?= $items[$i]['id'] ?>" data-table="table_photo" data-type="hienthi" <?php } ?> class="stardust-checkbox__input" rel="<?= $items[$i]['hienthi'] ?>" <?php if ($items[$i]['hienthi'] == 1) echo 'checked'; ?> name="onOff" type="checkbox" style="display:none">
                                        <div class="stardust-checkbox__box"></div>
                                    </label>
                                </td>
                                <td class="actBtns">
                                    <?php if (($kiemtra == 1 & $func->checkPermissions('photo', 'edit', $type)) || $kiemtra != 1) { ?>
                                        <a class="text-primary" href="index.html?com=combo&act=edit&id=<?= $items[$i]['id'] ?><?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?><?php if ($_GET['page'] != '') echo '&page=' . $_GET['page']; ?>" title="" class="smallButton tipS" original-title="Sửa hình ảnh"><i class="fas fa-edit"></i></a>
                                    <?php } ?>
                                    <?php if (($kiemtra == 1 & $func->checkPermissions('photo', 'delete', $type)) || $kiemtra != 1) { ?>
                                        <a class="text-danger" data-product="<?= $items[$i]['id'] ?>" data-com="<?= $_GET['com'] ?>" data-act="delete" data-tbl="<?= $_GET['tbl'] ?>" data-type="<?= $_GET['type'] ?>" data-page="<?= $_GET['page'] ?>" href="javascript:" data-js-delete title="" class="smallButton tipS" original-title="Xóa "><i class="fas fa-trash-alt"></i></a>
                                    <?php } ?>
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