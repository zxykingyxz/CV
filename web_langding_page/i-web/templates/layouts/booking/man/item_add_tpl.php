<link href="plugin/sumoselect/sumoselect.css" rel="stylesheet" />

<script src="plugin/sumoselect/jquery.sumoselect.min.js"></script>

<script src="assets/js/star.js"></script>

<link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css" />

<script src="assets/plugins/moment/moment.js"></script>

<script src="assets/plugins/daterangepicker/daterangepicker.js"></script>



<div class="wrapper">
    <div class="control_frm">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="index.html?com=booking&act=add<?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?>"><span>Đăng
                            ký tư vấn</span></a></li>
                <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>

    <form name="supplier" id="validate" class="form" action="index.html?com=booking&act=save&id=<?= ($_GET['id'] != '') ? $_GET['id'] : '' ?>&type=<?= ($_GET['type'] != '') ? $_GET['type'] : '' ?>" method="post" enctype="multipart/form-data">
        <div class="oneOne">
            <div class="widget mtop0">
                <?php if ($GLOBAL[$com][$type]['file'] == true) { ?>
                    <div class="formRow">
                        <label>Tải file</label>
                        <div class="formRight">
                            <a href="<?= _upload_tailieu . $item['tailieu'] ?>" title=""><?= $item['tailieu'] ?></a>
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>
                <?php if ($GLOBAL[$com][$type]['ten'] == true) { ?>
                    <div class="formRow">
                        <label>Tên</label>
                        <div class="formRight">
                            <input type="text" name="data[ten_vi]" title="Họ tên" id="ten_vi" readonly class="tipS validate[required]" value="<?= @$item['ten_vi'] ?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>
                <?php if ($GLOBAL[$com][$type]['email'] == true) { ?>
                    <div class="formRow">
                        <label>Email</label>
                        <div class="formRight">
                            <input type="text" name="data[email]" title="Email người đặt đặt lịch" readonly id="email" class="tipS validate[required]" value="<?= @$item['email'] ?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>
                <?php if ($GLOBAL[$com][$type]['nhucau'] == true) { ?>
                    <div class="formRow">
                        <label>Nhu cầu</label>
                        <div class="formRight">
                            <input type="text" name="data[nhucau]" title="Nhu cầu của bạn" id="nhucau" class="tipS validate[required]" value="<?= @$item['nhucau'] ?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>
                <?php if ($GLOBAL[$com][$type]['ngaydatlich'] == true) { ?>
                    <div class="formRow">
                        <label>Ngày đặt lịch</label>
                        <div class="formRight">
                            <input type="text" name="data[ngaydatlich]" title="Ngày đặt lịch" id="ngaydatlich" class="tipS validate[required] daterange" value="<?= @$item['ngaydatlich'] ?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>
                <?php if ($GLOBAL[$com][$type]['soluong'] == true) { ?>
                    <div class="formRow">
                        <label>Số lượng</label>
                        <div class="formRight">
                            <input type="text" name="data[soluong]" title="Số lượng" id="soluong" class="tipS validate[required]" value="<?= @$item['soluong'] ?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>
                <?php if ($GLOBAL[$com][$type]['songuoi'] == true) { ?>
                    <div class="formRow">
                        <label>Số người</label>
                        <div class="formRight">
                            <input type="text" name="data[songuoi]" title="Số lượng" id="songuoi" class="tipS validate[required]" value="<?= @$item['songuoi'] ?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>
                <?php if ($GLOBAL[$com][$type]['quycach'] == true) { ?>
                    <div class="formRow">
                        <label>Quy cách</label>
                        <div class="formRight">
                            <input type="text" name="data[quycach]" title="Quy cách" id="quycach" class="tipS validate[required]" value="<?= @$item['quycach'] ?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>
                <?php if ($GLOBAL[$com][$type]['loai_thung'] == true) { ?>
                    <div class="formRow">
                        <label>Loại thùng</label>
                        <div class="formRight">
                            <input type="text" name="data[loai_thung]" title="Loại thùng" id="loai_thung" class="tipS validate[required]" value="<?= @$item['loai_thung'] ?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>
                <?php if ($GLOBAL[$com][$type]['loai_sp'] == true) { ?>
                    <div class="formRow">
                        <label>In</label>
                        <div class="formRight">
                            <input type="text" name="data[loai_sp]" title="In" id="loai_sp" class="tipS validate[required]" value="<?= @$item['loai_sp'] ?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>
                <?php if ($GLOBAL[$com][$type]['product'] == true) { ?>
                    <div class="formRow">
                        <label>Sản phẩm</label>
                        <div class="formRight">
                            <input type="text" name="data[product]" readonly title="Sản phẩm" id="product" class="tipS validate[required]" value="<?= @$item['product'] ?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>
                <?php if ($GLOBAL[$com][$type]['phone'] == true) { ?>
                    <div class="formRow">
                        <label>Điện thoại</label>
                        <div class="formRight">
                            <input type="text" name="data[dienthoai]" readonly title="Điện thoại người đặt đặ lịch" id="dienthoai" class="tipS validate[required]" value="<?= @$item['dienthoai'] ?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>
                <?php if ($GLOBAL[$com][$type]['website'] == true) { ?>
                    <div class="formRow">
                        <label>Website</label>
                        <div class="formRight">
                            <input type="text" name="data[website]" title="Điện thoại người đặt đặ lịch" id="website" class="tipS validate[required]" value="<?= @$item['website'] ?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>
                <?php if ($GLOBAL[$com][$type]['diachi'] == true) { ?>
                    <div class="formRow">
                        <label>Địa chỉ</label>
                        <div class="formRight">
                            <input type="text" name="data[diachi]" title="Địa chỉ" readonly id="diachi" class="tipS validate[required]" value="<?= $item['diachi'] ?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>
                <?php if ($GLOBAL[$com][$type]['dichvu'] == true) {

                    $getService = $db->rawQueryOne("select id,ten_$lang as ten,photo from #_baiviet where hienthi=1 and type=? and id=? limit 1", array('linh-vuc-hoat-dong', $item["id_dichvu"]));

                ?>
                    <div class="formRow">
                        <label>Dịch vụ đã chọn:</label>
                        <div class="formRight">
                            <a title="<?= $getService["ten"] ?>" href="javascript:void(0)"><?= $getService["ten"] ?></a>
                        </div>
                        <div class="formRight" style="margin-top:20px">
                            <img width="200" src="<?= _upload_baiviet . $getService["photo"] ?>" alt="">
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>

                <?php
                $question_register = $db->rawQuery("select id,ten_$lang as ten from #_photo where hienthi=1 and type=? order by stt asc", array('question_register'));
                $count = 1;
                if (!empty($question_register)) {
                    foreach ($question_register as $item_question_register) { ?>
                        <div class="formRow">
                            <label>Câu trả lời <?= $count ?> (Câu hỏi <?= $count ?>: <?= !empty($item_question_register['ten']) ? $item_question_register['ten'] : 'Không có' ?>)</label>
                            <div class="formRight">
                                <input type="text" name="data[question<?= $count ?>]" title="Địa chỉ" readonly class="tipS" value="<?= $item["question" . $count] ?>" />
                            </div>
                            <div class="clear"></div>
                        </div>
                    <?php $count++;
                    }
                    ?>

                <?php } ?>
                <?php if ($GLOBAL[$com][$type]['id_mxh'] == true) {

                    $getService = $db->rawQueryOne("select id,ten_$lang as ten from #_photo where hienthi=1 and type=? and id=? limit 1", array('mangxahoi', $item["id_mxh"]));
                ?>
                    <div class="formRow">
                        <label>Biết đến website thông qua:</label>
                        <div class="formRight">
                            <a title="<?= $getService["ten"] ?>" href="javascript:void(0)"><?= $getService["ten"] ?></a>
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>

                <?php if ($GLOBAL[$com][$type]['gioitinh'] == true) { ?>
                    <div class="formRow">
                        <label>Giới tính</label>
                        <div class="formRight">
                            <input type="text" name="data[gioitinh]" title="Giới tính" readonly id="gioitinh" class="tipS validate[required]" value="<?= $item['gioitinh'] ?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>
                <?php if ($GLOBAL[$com][$type]['noidung'] == true) { ?>
                    <div class="formRow">
                        <label>Nội dung</label>
                        <div class="ck_editor">
                            <textarea id="noidung" name="data[noidung]" class="ck_editors"><?= htmlspecialchars_decode(@$item['noidung']) ?></textarea>
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>

                <?php if ($GLOBAL[$com][$type]['ngayvao'] == true) { ?>
                    <div class="formRow">
                        <label>Ngày vào</label>
                        <div class="formRight">
                            <input type="text" name="data[ngayvao]" title="Địa chỉ" id="ngayvao" class="tipS validate[required]" value="<?= date('d-m-Y', $item["ngayvao"]) ?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>
                <?php if ($GLOBAL[$com][$type]['ngayra'] == true) { ?>
                    <div class="formRow">
                        <label>Ngày ra</label>
                        <div class="formRight">
                            <input type="text" name="data[ngayra]" title="Địa chỉ" id="ngayra" class="tipS validate[required]" value="<?= date('d-m-Y', $item["ngayra"]) ?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>
                <div class="formRow">
                    <div class="formRight">
                        <label class="stardust-checkbox">
                            Hiển thị
                            <input class="stardust-checkbox__input" <?= (!isset($item['hienthi']) || $item['hienthi'] == 1) ? 'checked="checked"' : '' ?> name="hienthi" type="checkbox" value="1" style="display:none">
                            <div class="stardust-checkbox__box"></div>
                        </label>
                    </div>
                </div>
                <div class="formRow">
                    <div class="formRight">
                        <label>Số thứ tự: </label>
                        <input type="text" class="tipS" value="<?= isset($item['stt']) ? $item['stt'] : 1 ?>" name="data[stt]" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
                    </div>
                    <div class="clear"></div>
                </div>

            </div>
            <div class="formRow fixedBottom">
                <div class="box-admin" style="display:flex; align-items:center;justify-content:flex-end">
                    <div class="box-action">
                        <button type="submit" class="btn btn-sm bg-gradient-primary text-white submit-check">
                            <i class="far fa-save mr-2"></i>Lưu
                        </button>
                        <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
                        <a class="btn btn-sm bg-gradient-danger text-white" href="index.html?com=booking&act=man&id=<?= ($_GET['id'] != '') ? $_GET['id'] : '' ?>&type=<?= ($_GET['type'] != '') ? $_GET['type'] : '' ?>">
                            <i class="fas fa-sign-out-alt mr-2"></i>Thoát
                        </a>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </form>
</div>


<script>
    var daysOfWeek = ["CN", "T2", "T3", "T4", "T5", "T6", "T7"];



    var monthNames = ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9",

        "Tháng 10", "Tháng 11", "Tháng 12"

    ];



    $(function() {

        $('.daterange').daterangepicker({

            singleDatePicker: true,

            timePicker: false,

            timePicker24Hour: false,

            timePickerIncrement: 1,

            opens: 'right',

            applyButtonClasses: "btn-success",

            cancelClass: "btn-light",

            showDropdowns: false,

            autoUpdateInput: false,

            linkedCalendars: false,

            showDropdowns: true,

            locale: {

                cancelLabel: 'Clear',

                format: 'DD/MM/YYYY',

                daysOfWeek: daysOfWeek,

                monthNames: monthNames,

                firstDay: 1

            }

        }, function(start, end, label) {

            var years = moment().diff(start, 'years');

        });

        $('.daterange').on('apply.daterangepicker', function(ev, picker) {

            $(this).val(picker.startDate.format('DD/MM/YYYY'));

        });

        $('.timerange').daterangepicker({

            timePicker: false,

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