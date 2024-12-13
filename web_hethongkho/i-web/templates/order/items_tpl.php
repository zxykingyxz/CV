<link href="plugin/sumoselect/sumoselect.css" rel="stylesheet" />
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"> -->

<script src="plugin/sumoselect/jquery.sumoselect.min.js"></script>

<link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css" />

<script src="assets/plugins/moment/moment.js"></script>

<script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
<script src="assets/plugins/daterangepicker/daterangepicker.js"></script>

<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
            <li><a href="index.php?com=order&act=man"><span><?= _donhang ?></span></a></li>
            <li class="current"><a href="#" onclick="return false;"><?= _tatca ?></a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script language="javascript">
    $(document).ready(function() {
        $('#search_btn').click(function() {
            var loai = 1;
            var madonhang = $('#madonhang').val();
            var id_tinhtrang = $('#tinhtrangdon').val();
            var date_order = $('#date_order').val();
            var start = $('#start').val();
            var end = $('#end').val();
            window.location = "index.php?com=order&act=man&loai=" + loai + "&type_order=" + date_order + "&code=" + madonhang +
                "&order_status=" + id_tinhtrang + "&sday=" + start +
                '&eday=' + end;
            return true;
        });
        $('#sortby').change(function() {

            let _this = $(this);

            let per_page = _this.val();

            let com = _this.data('com');

            let act = _this.data('act');

            let page = _this.data('page');

            let loai = _this.data('loai');

            let code = _this.data('code');

            let order_status = _this.data('order_status');

            let tendonhang = _this.data('tendonhang');

            let sday = _this.data('sday');

            let eday = _this.data('eday');

            let str = 'index.php?com=' + com + '&act=' + act;

            if (loai != '') {

                str += '&loai=' + loai;

            }
            if (code != '') {

                str += '&code=' + code;

            }
            if (order_status != '') {

                str += '&order_status=' + order_status;

            }
            if (sday != '') {

                str += '&sday=' + sday;

            }

            if (eday != '') {

                str += '&eday=' + eday;


            }

            str += '&per_page=' + per_page + '&page=' + page;

            if (tendonhang != '') {

                str += '&tendonhang=' + tendonhang;

            }




            if (per_page != '') {

                window.location.href = str;

            }

        });

        $('#export__search').click(function() {

            let code = $('#madonhang').val();

            let order_status = $('#tinhtrangdon').val();

            let tendonhang = $('#tendonhang').val();

            let sday = $('#start').val();

            let eday = $('#end').val();

            window.location.href = 'ajax/export_order_search.php?code=' +
                code + '&order_status=' + order_status + '&sday=' + sday + '&eday=' + eday + '&tendonhang=' + tendonhang;

        });
        $('body').on('click', '.btn__save__export', function() {

            let _o = $(this);

            let _i = _o.data('id');

            window.location.href = 'ajax/export_order_detail.php?id=' + _i;

        });
        $("#xoahet").click(function() {
            var listid = $("input[name='chon']:checked").map(function() {
                return this.value
            }).get().join(",");
            if (listid == undefined || listid == null || listid == '') {
                alert("Bạn chưa chọn đơn hàng cần xóa!");
                return false;
            }

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
                                    "index.html?com=order&act=delete&page=<?= $_GET['page'] ?>&listid=" +
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
        $("#exportchoose").click(function() {
            var listid = $("input[name='chon']:checked").map(function() {
                return this.value
            }).get().join(",");
            if (listid == undefined || listid == null || listid == '') {
                alert("Bạn chưa chọn đơn hàng cần xuất file!");
                return false;
            }
            if (listid.length > 0) {
                $.confirm({
                    title: 'Xác nhận!',
                    content: 'Bạn có chắc chắn muốn xuất những mục này!',
                    buttons: {
                        success: {
                            text: 'Đồng ý!',
                            btnClass: 'btn-blue',
                            action: function() {

                                window.location.href = 'ajax/export_orders_choose.php?listid=' + listid;

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
        $("#exportall").click(function() {
            $.confirm({
                title: 'Xác nhận!',
                content: 'Bạn có chắc chắn muốn xuất file tổng!',
                buttons: {
                    success: {
                        text: 'Đồng ý!',
                        btnClass: 'btn-blue',
                        action: function() {
                            window.location.href = 'ajax/export_all.php';
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
<?php

$khoahocs = $db->rawQuery("select * from #_baiviet where hienthi=1 and type in('tai-lieu-sach','tai-lieu-ebook') order by stt asc, id desc");

?>
<form name="f" id="f" method="post">
    <div class="oneOne" style="margin-top:0;">
        <div style="display:flex; align-items:center">
            <input style="margin-right:10px" type="text" name="madonhang" id="madonhang" class="order-input"
                placeholder="Mã đơn hàng" value="<?= (isset($_GET['code'])) ? $_GET['code'] : "" ?>" />
            <?php /* <input style="margin-right:10px" type="text" name="tendonhang" id="tendonhang" class="order-input"
                placeholder="Tên khóa học hoặc combo"
                value="<?= (isset($_GET['tendonhang']))? $_GET['tendonhang'] : ""?>" />
            <select name="date_order" style="margin-right:10px;width:150px" id="date_order" class="main_select select-w order-input">
                <option value="0">Lọc đơn hàng</option>
                <option value="1" <?= (isset($_GET['type_order']) & $_GET['type_order'] == 1 )? "selected" : ""?>>Theo ngày đặt đơn</option>
                <option value="2" <?= (isset($_GET['type_order']) & $_GET['type_order'] == 2 )? "selected" : ""?>>Theo ngày xác nhận đơn</option>
            </select>
             */ ?>
            <select name="tinhtrangdon" id="tinhtrangdon" class="main_select select-w order-input">
                <option value="0">Tình trạng</option>
                <?php foreach ($config['order-status'] as $key => $value) { ?>
                    <option value="<?= $key ?>"
                        <?= (isset($_GET['order_status']) & $_GET['order_status'] == $key) ? "selected" : "" ?>>
                        <?= $value['name'] ?></option>
                <?php } ?>
            </select>
            <div class="dayrange-group">
                <span class="dayrange-label">Tùy chỉnh: </span>
                <input type="text" autocomplete="off" name="start" title="Nhập địa chỉ" id="start"
                    class="dayrange-item daterange" value="<?= $_GET["sday"] ?>" placeholder="YYYY-MM-DD" />
                <span class="dayrange-line"></span>
                <input type="text" autocomplete="off" name="end" title="Nhập địa chỉ" id="end"
                    class="dayrange-item daterange" value="<?= $_GET["eday"] ?>" placeholder="YYYY-MM-DD" />
                <button type="button" class="btn btn-sm bg-gradient-primary" id="search_btn">Xem</button>
                <button type="button" class="btn dayrange-item text-white"
                    onclick="window.location.href='index.php?com=order&act=man&page=1'">
                    Refresh
                </button>
            </div>
        </div>
    </div>
    <div class="oneOne" style="margin-top:0;">
        <div style="float:left;"></div>
    </div>
    <div class="oneOne">
        <div class="box-admin" style="display:flex; align-items:center; justify-content:space-between">

            <div class="box-action">
                <?php if (($kiemtra == 1 & ($xoa)) || ($kiemtra != 1)) { ?>
                    <a class="btn btn-sm bg-gradient-danger text-white" id="xoahet">
                        <i class="far fa-trash-alt mr-2"></i>Xóa tất cả
                    </a>
                <?php } ?>
                <a class="btn btn-sm bg-gradient-excel text-white" id="exportchoose">
                    <i class="fas fa-file-excel mr-2"></i>Xuất file chọn
                </a>
                <a class="btn btn-sm bg-gradient-excel text-white" id="exportall">
                    <i class="fas fa-file-excel mr-2"></i>Xuất tất cả
                </a>
                <?php /* <a class="btn btn-sm bg-gradient-excel text-white" id="export__search">
                    <i class="fas fa-file-excel mr-2"></i>Xuất file tìm kiếm
                </a> */ ?>
            </div>
            <div class="box__sortby">
                <select name="sortby" id="sortby" class="main_select sortby__select" style="min-width:150px"
                    data-com="<?= $_GET["com"] ?>" data-act="<?= $_GET["act"] ?>" data-page="<?= $_GET["page"] ?>"
                    data-loai="<?= $_GET["loai"] ?>" data-code="<?= $_GET["code"] ?>"
                    data-order_status="<?= $_GET["order_status"] ?>" data-tendonhang="<?= $_GET["tendonhang"] ?>"
                    data-sday="<?= $_GET["sday"] ?>" data-eday="<?= $_GET["eday"] ?>">
                    <option value="">Số đơn hiển thị</option>
                    <option value="10" <?php if ($_GET['per_page'] == 10) echo 'selected'; ?>>10</option>
                    <option value="20" <?php if ($_GET['per_page'] == 20) echo 'selected'; ?>>20</option>
                    <option value="30" <?php if ($_GET['per_page'] == 30) echo 'selected'; ?>>30</option>
                    <option value="50" <?php if ($_GET['per_page'] == 50) echo 'selected'; ?>>50</option>
                    <option value="75" <?php if ($_GET['per_page'] == 75) echo 'selected'; ?>>75</option>
                    <option value="100" <?php if ($_GET['per_page'] == 100) echo 'selected'; ?>>100</option>
                    <option value="125" <?php if ($_GET['per_page'] == 125) echo 'selected'; ?>>125</option>
                    <option value="150" <?php if ($_GET['per_page'] == 150) echo 'selected'; ?>>150</option>
                    <option value="250" <?php if ($_GET['per_page'] == 250) echo 'selected'; ?>>250</option>
                    <option value="500" <?php if ($_GET['per_page'] == 500) echo 'selected'; ?>>500</option>
                    <option value="1000" <?php if ($_GET['per_page'] == 1000) echo 'selected'; ?>>1000</option>
                    <option value="2000" <?php if ($_GET['per_page'] == 2000) echo 'selected'; ?>>2000</option>
                </select>
            </div>
        </div>
    </div>
    <div class="oneOne">
        <div class="widget mtop10">
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
                            <td class="sortCol" width="100">
                                <div style="padding-right: 20px;">Mã đơn hàng <span></span></div>
                            </td>
                            <td class="sortCol" width="150">
                                <div style="padding-right: 20px;">Họ tên <span></span></div>
                            </td>
                            <td width="100">
                                <div>Điện thoại</div>
                            </td>
                            <td width="100">
                                <div>Email</div>
                            </td>
                            <td width="100">
                                <div>Thanh toán</div>
                            </td>
                            <td width="100">
                                <div>Giao hàng</div>
                            </td>
                            <td align="center" class="sortCol" width="100">
                                <div style="padding-right: 20px;">Ngày đặt<span></span></div>
                            </td>
                            <!-- <td class="sortCol" width="150">
                                <div>Xác nhận đơn<span></span></div>
                            </td> -->

                            <td class="sortCol" width="100">
                                <div style="padding-right: 20px;">Số tiền<span></span></div>
                            </td>
                            <td class="sortCol" width="100">
                                <div>Tình trạng</div>
                            </td>
                            <?php /* <td width="50" align="center">
                                <div>Lịch sử<span></span></div>
                            </td> */ ?>
                            <td width="50" align="center">
                                <div>Xuất file</div>
                            </td>
                            <?php if (($kiemtra == 1 & ($sua || $xoa)) || ($kiemtra != 1)) { ?>
                                <td class="tb_data_small" style="width: 100px !important;">Thao tác</td>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0, $count = count($items); $i < $count; $i++) {
                        ?>
                            <tr>
                                <td>
                                    <label class="stardust-checkbox checker">
                                        <input class="stardust-checkbox__input" name="chon" id="check<?= $i ?>" type="checkbox"
                                            value="<?= $items[$i]['id'] ?>" style="display:none">
                                        <div class="stardust-checkbox__box"></div>
                                    </label>
                                </td>
                                <td align="left" <?php if ($items[$i]['view'] == 0) {
                                                        echo "style='font-weight:bold;'";
                                                    } ?>>
                                    <?= $items[$i]['code'] ?>
                                </td>
                                <td <?php if ($items[$i]['view'] == 0) {
                                        echo "style='font-weight:bold;'";
                                    } ?>>
                                    <?= $items[$i]['fullname'] ?>
                                </td>
                                <td <?php if ($items[$i]['view'] == 0) {
                                        echo "style='font-weight:bold;'";
                                    } ?>>
                                    <?= $items[$i]['phone'] ?>
                                </td>
                                <td <?php if ($items[$i]['view'] == 0) {
                                        echo "style='font-weight:bold;'";
                                    } ?>>
                                    <?= $items[$i]['email'] ?>
                                </td>

                                <td align="center" <?php if ($items[$i]['view'] == 0) {
                                                        echo "style='font-weight:bold;'";
                                                    } ?>>
                                    <?= $func->getFieldOne('ten_' . $lang, 'baiviet', $items[$i]['payment']) ?>
                                </td>
                                <td align="center" <?php if ($items[$i]['view'] == 0) {
                                                        echo "style='font-weight:bold;'";
                                                    } ?>>
                                    <?= $func->getFieldOne('ten_' . $lang, 'baiviet', $items[$i]['payship']) ?>
                                </td>
                                <td align="center" <?php if ($items[$i]['view'] == 0) {
                                                        echo "style='font-weight:bold;'";
                                                    } ?>>
                                    <?= $items[$i]['createdAt'] ?>
                                </td>
                                <!-- <td align="center" <?php if ($items[$i]['view'] == 0) {
                                                            echo "style='font-weight:bold;'";
                                                        } ?>>
                            <?= $items[$i]['salesAt'] ?>
                            </td> -->
                                <td align="center" <?php if ($items[$i]['view'] == 0) {
                                                        echo "style='font-weight:bold;'";
                                                    } ?>>
                                    <span <?php if (!empty($items[$i]['id_customer'])) {
                                                echo "color='#f00;'";
                                            } ?>>
                                        <?= $func->changeMoney($items[$i]['total_price'], $lang) ?>
                                    </span>
                                </td>
                                <td align="center" <?php if ($items[$i]['view'] == 0) {
                                                        echo "style='font-weight:bold;'";
                                                    } ?>>
                                    <?php
                                    if ($config['order-status']) { ?>
                                        <?php if (($kiemtra == 1 & ($sua)) || ($kiemtra != 1)) { ?>
                                            <select name="order_status" class="main_select select-w order_status"
                                                data-o="<?= $items[$i]['id'] ?>">
                                                <?php foreach ($config['order-status'] as $key => $value) { ?>
                                                    <option value="<?= $key ?>" data-color="<?= $value['color'] ?>"
                                                        <?= ($items[$i]['order_status'] == $key) ? "selected" : "" ?>>
                                                        <?= $value['name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        <?php } ?>
                                    <?php } else {
                                        echo $config['order-status'][$items[$i]['order_status']];
                                    } ?>
                                </td>

                                <?php /* <td class="actBtns">
                                <a href="javascript:void(0)" class="js-log"
                                    data-file="<?= $items[$i]['code']."_".$items[$i]['id'] ?>">
                                    <i class="fal fa-history"></i>
                                </a>
                            </td> */ ?>
                                <td class="actBtns">
                                    <a data-id="<?= $items[$i]['id'] ?>" title="" style="cursor:pointer"
                                        class="smallButton tipS btn__save__export" target="_blank"
                                        original-title="Xuất đơn hàng excel"><i class="fal fa-file-excel"></i></a>&nbsp;
                                </td>
                                <?php if (($kiemtra == 1 & ($sua || $xoa)) || ($kiemtra != 1)) { ?>
                                    <td class="actBtns">
                                        <?php if (($kiemtra == 1 & ($sua)) || ($kiemtra != 1)) { ?>
                                            <a class="text-primary"
                                                href="index.php?com=order&act=edit&id=<?= $items[$i]['id'] ?>&page=<?= $_GET["page"] ?>"
                                                title="" class="smallButton tipS" original-title="Xem và sửa đơn hàng"><i
                                                    class="fas fa-edit"></i></a>
                                        <?php } ?>
                                        <?php if (($kiemtra == 1 & ($xoa)) || ($kiemtra != 1)) { ?>
                                            <a class="text-danger" data-product="<?= $items[$i]['id'] ?>" data-com="<?= $_GET['com'] ?>"
                                                data-act="delete" data-tbl="<?= $_GET['tbl'] ?>" data-type="<?= $_GET['type'] ?>"
                                                data-page="<?= $_GET['page'] ?>" href="javascript:" data-js-delete title=""
                                                class="smallButton tipS" original-title="Xóa ">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        <?php } ?>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>
<div class="paging"><?= $paging ?></div>

<script>
    $(() => {
        $(".order_status").each(function() {
            let $this = $(this);
            let option = $(this).find("option:selected");
            let color = option.data("color");
            $this.css("color", color);
            $this.css("border-color", color);
        })
        $(".order_status").change(function() {
            let $this = $(this);
            let order = $this.data("o");
            let status = $this.val();
            // let option = $(this).find("option:selected");
            // let color = option.data("color");
            // $this.css("color", color);
            // $this.css("border-color", color);
            var params = {
                order: order,
                status: status
            };
            $.confirm({

                title: 'Xác nhận!',

                content: 'Bạn có chắc chắn muốn thay đổi trạng thái đơn hàng này!',

                buttons: {

                    success: {

                        text: 'Đồng ý!',

                        btnClass: 'btn-blue',

                        action: function() {

                            $.post('ajax/UpdateOrder.php', params, function(data, status) {
                                if (status == "success") {
                                    window.location.reload();
                                }
                            })

                        }

                    },

                    cancel: {

                        text: 'Hủy ngay!',

                        btnClass: 'btn-red'

                    }
                }
            });
        });

        $(".js-log").click(function() {
            let file = $(this).data("file");
            let params = {
                file: file
            }
            $.post('ajax/history_log.php', params, function(data, status) {
                if (status == "success") {
                    $("body").append(data);
                }
            })
        });
    })
</script>
<?php /*
<script>
var daysOfWeek = ["CN", "T2", "T3", "T4", "T5", "T6", "T7"];

var monthNames = ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9",
    "Tháng 10", "Tháng 11", "Tháng 12"
];

$(function() {
    $('.daterange').daterangepicker({

        singleDatePicker: false,

        timePicker: false,

        opens: 'right',

        applyButtonClasses: "btn-success",

        cancelClass: "btn-light",

        showDropdowns: false,

        autoUpdateInput: false,

        linkedCalendars: false,

        showDropdowns: true,

        locale: {

            cancelLabel: 'Clear',

            format: 'YYYY/MM/DD',

            daysOfWeek: daysOfWeek,

            monthNames: monthNames,

            firstDay: 1

        }
    }, function(start, end, label) {

        var years = moment().diff(start, 'years');

    });

    $('.daterange').on('apply.daterangepicker', function(ev, picker) {

        $(this).val(picker.startDate.format('YYYY/MM/DD')+" - "+picker.endDate.format("YYYY/MM/DD"));

    });

    $('.timerange').daterangepicker({
        timePicker: true,
        timePicker24Hour: true,
        timePickerIncrement: 1,
        locale: {
            format: 'HH:mm'
        }
    }).on('show.daterangepicker', function(ev, picker) {
        picker.container.find(".calendar-table").hide();
    });
});
</script>
*/ ?>

<script>
    var daysOfWeek = ["CN", "T2", "T3", "T4", "T5", "T6", "T7"];

    var monthNames = ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9",
        "Tháng 10", "Tháng 11", "Tháng 12"
    ];

    $(function() {
        $('.daterange').daterangepicker({

            singleDatePicker: true,

            timePicker: false,

            opens: 'right',

            applyButtonClasses: "btn-success",

            cancelClass: "btn-light",

            autoUpdateInput: false,

            linkedCalendars: false,

            showDropdowns: true,

            locale: {

                cancelLabel: 'Clear',

                format: 'YYYY-MM-DD',

                daysOfWeek: daysOfWeek,

                monthNames: monthNames,

                firstDay: 1

            },
            minDate: "2020-01-01",
            maxDate: "<?= date('Y-m-d') ?>"
        }, function(start, end, label) {

            var years = moment().diff(start, 'years');

        });

        $('.daterange').on('apply.daterangepicker', function(ev, picker) {

            $(this).val(picker.startDate.format('YYYY-MM-DD'));

        });

    });
</script>
<script type="text/javascript">
    $(document).ready(function() {

        window.asd = $('.multiselect-info').SumoSelect({

            placeholder: 'Chọn khóa học cần tìm',

            csvDispCount: 3,

            captionFormat: '{0} Selected',

            floatWidth: 500,

            forceCustomRendering: false,

            triggerChangeCombined: true,

            selectAll: true,

            search: true,

            searchText: 'Search...',

            noMatch: 'No matches for "{0}"',

            prefix: '',

            locale: ['OK', 'Cancel', 'Select All'],

            up: 'false',

            showTitle: 'true',

        });

    });
</script>
<script src="assets/plugins/datatable/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        jQuery.extend(jQuery.fn.dataTableExt.oSort, {
            "numeric-comma-pre": function(a) {
                var x = (a === "-") ? 0 : a.replace(/[,.]/g, ''); // Loại bỏ dấu chấm hoặc phẩy
                return parseFloat(x);
            },
            "numeric-comma-asc": function(a, b) {
                return a - b;
            },
            "numeric-comma-desc": function(a, b) {
                return b - a;
            }
        });
        $('.sTable').DataTable({
            "paging": false, // Kích hoạt phân trang
            "searching": false, // Kích hoạt tính năng tìm kiếm
            "ordering": true, // Cho phép sắp xếp
            "info": false, // Hiển thị thông tin tổng quan (số dòng)
            // "lengthMenu": [5, 10, 25, 50], // Số dòng mỗi trang
            // "pageLength": 10, // Mặc định hiển thị 10 dòng mỗi trang
            "columnDefs": [{
                    "orderable": false,
                    "targets": [0, 3, 4, 5, 6, 9, 10, 11]
                } // Không cho phép sắp xếp cột 1 và cột 4 (Name và Age)
            ]
        });

    });
</script>