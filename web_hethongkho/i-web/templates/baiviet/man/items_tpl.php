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

            window.location.href = "index.html?com=baiviet&act=man&type=<?= $_GET['type'] ?>&keyword=" +

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

                <li><a href="index.html?com=baiviet&act=man<?php if ($_GET['id_list'] != '') echo '&id_list=' . $_GET['id_list']; ?><?php if ($_GET['id_cat'] != '') echo '&id_cat=' . $_GET['id_cat']; ?><?php if ($_GET['id_item'] != '') echo '&id_item=' . $_GET['id_item']; ?><?php if ($_GET['id_sub'] != '') echo '&id_sub=' . $_GET['id_sub']; ?><?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?><?php if ($_GET['page'] != '') echo '&page=' . $_GET['page']; ?>"><span><?= $GLOBAL[$com][$type]['title'] ?></span></a>

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

                    <a class="btn btn-sm bg-gradient-primary text-white" href="index.html?com=baiviet&act=add<?php if ($_GET['id_list'] != '') echo '&id_list=' . $_GET['id_list']; ?><?php if ($_GET['id_cat'] != '') echo '&id_cat=' . $_GET['id_cat']; ?><?php if ($_GET['id_item'] != '') echo '&id_item=' . $_GET['id_item']; ?><?php if ($_GET['id_sub'] != '') echo '&id_sub=' . $_GET['id_sub']; ?><?php if ($_GET['id_product'] != '') echo '&id_product=' . $_GET['id_product']; ?><?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?><?php if ($_GET['page'] != '') echo '&page=' . $_GET['page']; ?>">

                        <i class="fas fa-plus mr-2"></i>Thêm mới

                    </a>

                    <a class="btn btn-sm bg-gradient-danger text-white" id="xoahet">

                        <i class="far fa-trash-alt mr-2"></i>Xóa tất cả

                    </a>

                </div>

                <div class="box-search mt-m-20">

                    <input type="text" class="mg-m-0" value="" placeholder="Nhập từ khóa tìm kiếm ">

                    <button type="button" style="border-radius:0" class="btn btn-navbar text-white" value=""><i class="fas fa-search"></i></button>

                </div>

            </div>

        </div>

        <div class="oneOne">

            <div class="title">

                <div class="timkiem">

                    <?php if ($GLOBAL[$com][$type]['list'] == true) { ?>

                        <select class="main_select" name="data[id_list]" id="id_list" onChange="window.location.href='index.html?com=<?= $_GET['com'] ?>&act=man&type=<?= $_GET['type'] ?>&id_list='+this.value">

                            <option value="0">Chọn danh mục cấp 1</option>

                            <?php for ($i = 0; $i < count($items_list); $i++) { ?>

                                <option value="<?= $items_list[$i]['id'] ?>" <?= ($_GET['id_list'] == $items_list[$i]['id']) ? 'selected' : '' ?>>
                                    <?= $items_list[$i]['ten_vi'] ?></option>

                            <?php } ?>

                        </select>

                    <?php } ?>

                    <?php if ($GLOBAL[$com][$type]['cat'] == true) { ?>

                        <select class="main_select" name="data[id_cat]" id="id_cat" onChange="window.location.href='index.html?com=<?= $_GET['com'] ?>&act=man&type=<?= $_GET['type'] ?>&id_list=<?= $_GET['id_list'] ?>&id_cat='+this.value">

                            <option value="0">Chọn danh mục cấp 2</option>

                            <?php for ($i = 0; $i < count($items_cat); $i++) { ?>

                                <option value="<?= $items_cat[$i]['id'] ?>" <?= ($_GET['id_cat'] == $items_cat[$i]['id']) ? 'selected' : '' ?>>
                                    <?= $items_cat[$i]['ten_vi'] ?>
                                </option>

                            <?php } ?>

                        </select>

                    <?php } ?>

                    <?php if ($GLOBAL[$com][$type]['item'] == true) { ?>

                        <select class="main_select" name="data[id_item]" id="id_item" onChange="window.location.href='index.html?com=<?= $_GET['com'] ?>&act=man&type=<?= $_GET['type'] ?>&id_list=<?= $_GET['id_list'] ?>&id_cat=<?= $_GET['id_cat'] ?>&id_item='+this.value">

                            <option value="0">Chọn danh mục cấp 3</option>

                            <?php for ($i = 0; $i < count($items_item); $i++) { ?>

                                <option value="<?= $items_item[$i]['id'] ?>" <?= ($_GET['id_item'] == $items_item[$i]['id']) ? 'selected' : '' ?>>
                                    <?= $items_item[$i]['ten_vi'] ?></option>

                            <?php } ?>

                        </select>

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

                                <td class="tb_data_small">Stt</td>

                                <?php if ($GLOBAL[$com][$type]['img'] == true) { ?>

                                    <td>Hình Ảnh</td>

                                <?php } ?>

                                <td class="sortCol">

                                    <div>Tiêu Đề</div>

                                </td>

                                <?php if ($GLOBAL[$com][$type]['list'] == true) { ?>

                                    <td align="center" align="left">

                                        <div>Danh mục cấp 1</div>

                                    </td>

                                <?php } ?>

                                <?php if ($GLOBAL[$com][$type]['cat'] == true) { ?>

                                    <td align="center" align="left">

                                        <div>Danh mục cấp 2</div>

                                    </td>

                                <?php } ?>

                                <?php if ($GLOBAL[$com][$type]['item'] == true) { ?>

                                    <td align="center" align="left">

                                        <div>Danh mục cấp 3</div>

                                    </td>

                                <?php } ?>

                                <?php if ($GLOBAL[$com][$type]['user'] == true) { ?>

                                    <td>Người đăng</td>



                                    <td>Ngày đăng</td>

                                <?php } ?>

                                <?php if ($GLOBAL[$com][$type]['duyetdon'] == true) { ?>

                                    <td>Trạng thái</td>

                                <?php } ?>

                                <?php if ($GLOBAL[$com][$type]['daytin'] == true) { ?>

                                    <td class="tb_data_small">Đẩy tin</td>

                                <?php } ?>

                                <?php foreach ($GLOBAL[$com][$type]['status'] as $key => $value) { ?>

                                    <td><?= $value ?></td>

                                <?php } ?>

                                <?php foreach ($GLOBAL[$com][$type]['check'] as $key => $value) { ?>

                                    <td><?= $value ?></td>

                                <?php } ?>
                                <?php if ($table['qty'] == true) { ?>
                                    <td>Tồn kho</td>
                                <?php } ?>

                                <td>Thao Tác</td>

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



                                    <td align="center">

                                        <input type="text" value="<?= $items[$i]['stt'] ?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText update_stt" original-title="Nhập số thứ tự " rel="<?= $items[$i]['id'] ?>" />

                                        <div id="ajaxloader"><img class="numloader" id="ajaxloader<?= $items[$i]['id'] ?>" src="images/loader.gif" alt="loader" /></div>

                                    </td>

                                    <?php if ($GLOBAL[$com][$type]['img'] == true) { ?>

                                        <td align="center" class="title_name_data">

                                            <a href="index.html?com=baiviet&act=edit<?php if ($_GET['id_list'] != '') echo '&id_list=' . $_GET['id_list']; ?><?php if ($_GET['id_cat'] != '') echo '&id_cat=' . $_GET['id_cat']; ?><?php if ($_GET['id_item'] != '') echo '&id_item=' . $_GET['id_item']; ?><?php if ($_GET['id_sub'] != '') echo '&id_sub=' . $_GET['id_sub']; ?><?php if ($_GET['id_product'] != '') echo '&id_product=' . $_GET['id_product']; ?>&id=<?= $items[$i]['id'] ?><?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?><?php if ($_GET['page'] != '') echo '&page=' . $_GET['page']; ?>" class="tipS SC_bold">

                                                <img class="img-list" src="<?= _upload_baiviet . $items[$i]['photo'] ?>" alt="" width="70">

                                            </a>

                                        </td>

                                    <?php } ?>



                                    <td class="title_name_data">

                                        <a href="index.html?com=baiviet&act=edit<?php if ($_GET['id_list'] != '') echo '&id_list=' . $_GET['id_list']; ?><?php if ($_GET['id_cat'] != '') echo '&id_cat=' . $_GET['id_cat']; ?><?php if ($_GET['id_item'] != '') echo '&id_item=' . $_GET['id_item']; ?><?php if ($_GET['id_sub'] != '') echo '&id_sub=' . $_GET['id_sub']; ?><?php if ($_GET['id_product'] != '') echo '&id_product=' . $_GET['id_product']; ?>&id=<?= $items[$i]['id'] ?><?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?><?php if ($_GET['page'] != '') echo '&page=' . $_GET['page']; ?>" class="tipS SC_bold"><?= $items[$i]['ten_vi'] ?></a>

                                        <div class="add-attr mt10">

                                            <?php if (!in_array($type, $viewArray)) { ?>

                                                <a style="color:#37a000;font-size:12px" title="Thuộc tính xem ngay" href="<?= ($config['alias']) ? $https_config . $items[$i]['type'] . '/' . $items[$i]['tenkhongdau_' . $lang] : $https_config . $items[$i]['tenkhongdau_' . $lang]; ?>" target="_blank" class="tipS SC_bold">

                                                    <i class="fa fa-eye"></i>

                                                    Xem ngay

                                                </a>

                                            <?php } ?>


                                            <?php /*
                                        <a style="color:#37a000;font-size:12px" title="Thuộc tính chỉnh sửa"

                                            href="index.html?com=baiviet&act=edit<?php if($_GET['id_list']!='') echo'&id_list='. $_GET['id_list'];?><?php if($_GET['id_cat']!='') echo'&id_cat='. $_GET['id_cat'];?><?php if($_GET['id_item']!='') echo'&id_item='. $_GET['id_item'];?><?php if($_GET['id_sub']!='') echo'&id_sub='. $_GET['id_sub'];?><?php if($_GET['id_product']!='') echo'&id_product='. $_GET['id_product'];?>&id=<?=$items[$i]['id']?><?php if($_GET['type']!='') echo'&type='. $_GET['type'];?><?php if($_GET['page']!='') echo'&page='. $_GET['page'];?>"

                                        class="tipS SC_bold">

                                        <i class="fa fa-edit"></i>

                                        Chỉnh sửa

                                        </a> */ ?>
                                            <a style="color:#37a000;font-size:12px ;margin: 0px 5px 5px;" title="Thuộc tính copy" href="index.html?com=baiviet&act=copy&id_copy=<?= $items[$i]['id'] ?><?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?><?php if ($_GET['page'] != '') echo '&page=' . $_GET['page']; ?>" class="tipS SC_bold">

                                                <i class="fa fa-copy"></i>

                                                Copy

                                            </a>

                                            <?php if ($GLOBAL[$com][$type]['comment']) { ?>
                                                <?php $count_comment = $db->rawQueryOne("select COUNT(*) as `num` from #_comment where hienthi=1 and pid=? and type=? order by id desc", array($items[$i]['id'], $_GET['type'])); ?>

                                                <a style="color:#37a000;font-size:12px ;margin: 0px 5px 5px;" title="Thuộc tính comment" href="index.html?com=comment&act=man&pid=<?= $items[$i]['id'] ?><?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?><?php if ($_GET['page'] != '') echo '&page=' . $_GET['page']; ?>" class="tipS SC_bold">

                                                    <i class="fas fa-comment"></i>

                                                    Comment (<?= $count_comment['num'] ?>)

                                                </a>
                                            <?php } ?>


                                        </div>

                                        <div class="attr-properties mt5">

                                            <?php if ($GLOBAL[$com][$type]['size']) { ?>
                                                <a style="color:#37a000;font-size:12px" href="index.html?com=attribute&act=man&type=size&id_product=<?= $items[$i]['id'] ?>&page=1" class="tipS SC_bold">

                                                    <i class="fas fa-cubes"></i>

                                                    Thêm trọng lượng

                                                </a>
                                            <?php } ?>

                                            <?php if ($GLOBAL[$com][$type]['color']) { ?>

                                                <a style="color:#37a000;font-size:12px" href="index.html?com=attribute&act=man&type=color&id_product=<?= $items[$i]['id'] ?>&page=1&act_baiviet=<?= $_GET["act"] ?>&page_baiviet=<?= $_GET["page"] ?>" class="tipS SC_bold">

                                                    <i class="fas fa-fill"></i>

                                                    Thêm màu

                                                </a>

                                            <?php } ?>


                                            <?php /* if($GLOBAL[$com][$type]['size']==true){ ?>

                                        <a style="color:#37a000;font-size:12px;margin: 0px 5px 5px;"
                                            title="Thuộc tính size"
                                            href="index.html?com=properties&act=man&id_product=<?=$items[$i]['id']?>&type=size<?php if($_GET['page']!='') echo'&page='. $_GET['page'];?>"
                                            class="tipS SC_bold">

                                            <i class="fa fa-cog"></i> Thêm size

                                        </a>

                                        <?php } */ ?>

                                            <?php /*<a style="color:#D33331;font-size:12px" title="Thuộc tính xóa"

                                            href="index.html?com=baiviet&act=delete&id=<?=$items[$i]['id']?><?php if($_GET['id_product']!='') echo'&id_product='. $_GET['id_product'];?><?php if($_GET['type']!='') echo'&type='. $_GET['type'];?><?php if($_GET['page']!='') echo'&page='. $_GET['page'];?>"

                                        class="tipS SC_bold">

                                        <i class="fa fa-trash"></i>

                                        Xóa

                                        </a> */ ?>

                                        </div>

                                    </td>

                                    <?php if ($GLOBAL[$com][$type]['list'] == true) { ?>
                                        <td align="center" class="title_name_data">

                                            <?php

                                            // $result = $db->rawQueryOne("select ten_vi from table_baiviet_list where id='" . $items[$i]['id_list'] . "' and type=?", array($type));

                                            // echo @$result['ten_vi'];

                                            ?>


                                            <select select-w data-view-id data-list-<?= $items[$i]['id'] ?> data-product="<?= $items[$i]['id'] ?>" class="main_select select-w" name="select_list" id="list">

                                                <option>Chọn DMC 1</option>

                                                <?php foreach ($items_list as $k => $v) { ?>

                                                    <option <?php if ($v['id'] == $items[$i]['id_list']) echo 'selected="selected"' ?> value="<?= $v['id'] ?>"><?= $v["ten_vi"] ?></option>

                                                <?php } ?>

                                            </select>

                                        </td>
                                    <?php } ?>






                                    <?php if ($GLOBAL[$com][$type]['cat'] == true) {
                                        // $items_cat = $db->rawQuery("select id, ten_$lang as ten from table_baiviet_cat where id_list='" . $items[$i]['id_list'] . "' and type=?", array($type));
                                    ?>
                                        <td align="center" class="title_name_data">

                                            <?php

                                            // $result = $db->rawQueryOne("select ten_vi from table_baiviet_cat where id='" . $items[$i]['id_cat'] . "' and type=?", array($type));

                                            // echo @$result['ten_vi'];

                                            ?>

                                            <select select-w data-view-cat data-cat-<?= $items[$i]['id'] ?> data-product="<?= $items[$i]['id'] ?>" class="main_select select-w" name="select_cat" id="cat">

                                                <option>Chọn DMC 2</option>
                                                <?php foreach ($items_cat as $k => $v) {
                                                    if (!empty($items[$i]['id_list']) && $v['id_list'] == $items[$i]['id_list']) {
                                                ?>

                                                        <option <?php if ($v['id'] == $items[$i]['id_cat']) echo 'selected="selected"' ?> value="<?= $v['id'] ?>"><?= $v["ten_vi"] ?></option>

                                                <?php }
                                                } ?>

                                            </select>



                                        </td>
                                    <?php } ?>






                                    <?php if ($GLOBAL[$com][$type]['item'] == true) { ?>
                                        <td align="center" class="title_name_data">

                                            <?php

                                            // $result = $db->rawQueryOne("select ten_vi from table_baiviet_item where id='" . $items[$i]['id_item'] . "' and type=?", array($type));

                                            // echo @$result['ten_vi'];

                                            ?>
                                            <select select-w data-view-item data-item-<?= $items[$i]['id'] ?> data-product="<?= $items[$i]['id'] ?>" class="main_select
                                    select-w" name="select_item" id="item">

                                                <option>Chọn DMC 3</option>

                                                <?php foreach ($items_item as $k => $v) {
                                                    if (!empty($items[$i]['id_cat']) && $v["id_cat"] == $items[$i]['id_cat']) {
                                                ?>

                                                        <option <?php if ($v['id'] == $items[$i]['id_item']) echo 'selected="selected"' ?> value="<?= $v['id'] ?>"><?= $v["ten_vi"] ?></option>

                                                <?php }
                                                } ?>

                                            </select>


                                        </td>
                                    <?php } ?>







                                    <?php if ($GLOBAL[$com][$type]['daytin'] == true) { ?>

                                        <td align="center" align="center">

                                            <a data-push="<?= $items[$i]['id'] ?>" data-url="<?= $items[$i]['type'] ?>/<?= $items[$i]['tenkhongdau'] ?>" data-type="<?= $items[$i]['type'] ?>" data-val2="table_baiviet" rel="<?= $items[$i]['daytin'] ?>" data-val3="daytin" class="push-news diamondToggle <?= ($items[$i]['daytin'] == 1) ? "diamondToggleOff" : "" ?>" data-val0="<?= $items[$i]['id'] ?>"></a>

                                        </td>

                                    <?php } ?>

                                    <?php if ($GLOBAL[$com][$type]['user'] == true) { ?>

                                        <td class="tb_data_small"><?= $userInfo['hoten'] ?></td>

                                        <td class="tb_data_small"><?= date('d/m/Y H:s:i', $items[$i]['ngaytao']) ?></td>

                                    <?php } ?>

                                    <?php if ($GLOBAL[$com][$type]['duyetdon'] == true) { ?>

                                        <td align="center">

                                            <select name="status" <?php if ($items[$i]['id_loai'] == 0) {

                                                                        echo 'style="border-color:#2b6893"';
                                                                    } else if ($items[$i]['id_loai'] == 1) {

                                                                        echo 'style="border-color:#37a000"';
                                                                    } else {

                                                                        echo 'style="border-color:red"';
                                                                    } ?> data-table="baiviet" data-type="post" data-id="<?= $items[$i]['id'] ?>" class="main_select js-update-status">

                                                <?php foreach ($config['id_loai'] as $key => $value) { ?>

                                                    <option value="<?= $key ?>" <?= (@$items[$i]['id_loai'] == $key) ? 'selected' : '' ?>>

                                                        <?= $value ?></option>

                                                <?php } ?>

                                            </select>

                                        </td>

                                    <?php } ?>

                                    <?php if (!empty($GLOBAL[$com][$type]['status'])) {
                                        $arr_status = explode(',', $items[$i]['status']); ?>

                                        <?php foreach ($GLOBAL[$com][$type]['status'] as $k1 => $v1) { ?>

                                            <td class="sortCol" align="center">

                                                <label class="stardust-checkbox checkOnOff">

                                                    <input class="checker-status" data-table="<?= $com ?>" data-type="<?= $type ?>" data-id="<?= $items[$i]['id'] ?>" <?php if (in_array($k1, $arr_status)) echo 'checked'; ?> name="status<?= $items[$i]['id'] ?>[]" type="checkbox" value="<?= $k1 ?>" style="display:none">

                                                    <div class="stardust-checkbox__box"></div>

                                                </label>

                                            </td>

                                        <?php } ?>

                                    <?php } ?>

                                    <?php foreach ($GLOBAL[$com][$type]['check'] as $key => $value) { ?>

                                        <td align="center">

                                            <label class="stardust-checkbox checkOnOff">

                                                <input class="stardust-checkbox__input" data-id="<?= $items[$i]['id'] ?>" data-table="table_baiviet" data-type="<?= $key ?>" rel="<?= $items[$i][$key] ?>" <?php if ($items[$i][$key] == 1) echo 'checked'; ?> name="onOff" type="checkbox" style="display:none">

                                                <div class="stardust-checkbox__box"></div>

                                            </label>

                                        </td>

                                    <?php } ?>
                                    <?php if ($table['qty'] == true) { ?>
                                        <td class="t-center" <?php if ($items[$i]['qty'] == 0) { ?> style="color: #f00; font-weight: bold; text-transform: uppercase;" <?php } ?>><?= $items[$i]['qty'] != 0 ? $items[$i]['qty'] : "Hết hàng" ?></td>
                                    <?php } ?>

                                    <td class="actBtns">

                                        <a class="text-primary" href="index.html?com=baiviet&act=edit<?php if ($_GET['id_list'] != '') echo '&id_list=' . $_GET['id_list']; ?><?php if ($_GET['id_cat'] != '') echo '&id_cat=' . $_GET['id_cat']; ?><?php if ($_GET['id_item'] != '') echo '&id_item=' . $_GET['id_item']; ?><?php if ($_GET['id_sub'] != '') echo '&id_sub=' . $_GET['id_sub']; ?><?php if ($_GET['id_product'] != '') echo '&id_product=' . $_GET['id_product']; ?>&id=<?= $items[$i]['id'] ?><?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?><?php if ($_GET['page'] != '') echo '&page=' . $_GET['page']; ?>" title="" class="smallButton tipS" original-title="Sửa"><i class="fas fa-edit"></i></a>

                                        <a class="text-danger" data-product="<?= $items[$i]['id'] ?>" data-com="<?= $_GET['com'] ?>" data-act="delete" data-tbl="" data-type="<?= $_GET['type'] ?>" data-page="<?= $_GET['page'] ?>" href="javascript:" data-js-delete title="" class="smallButton tipS" original-title="Xóa ">

                                            <i class="fas fa-trash-alt"></i>

                                        </a>

                                    </td>

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