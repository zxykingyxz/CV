<link href="plugin/sumoselect/sumoselect.css" rel="stylesheet" />

<script src="plugin/sumoselect/jquery.sumoselect.min.js"></script>

<script src="assets/js/star.js"></script>

<link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css" />

<script src="assets/plugins/moment/moment.js"></script>

<script src="assets/plugins/daterangepicker/daterangepicker.js"></script>



<script type="text/javascript">
    $(document).ready(function() {

        $('.chonngonngu li a').click(function(event) {

            var lang = $(this).attr('href');

            $('.chonngonngu li a').removeClass('active');

            $(this).addClass('active');

            $('.lang_hidden').removeClass('active');

            $('.lang_' + lang).addClass('active');

            return false;

        });

    });
</script>

<div class="wrapper">
    <div class="control_frm">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="index.html?com=flashsale&act=add<?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?><?php if ($_GET['page'] != '') echo '&page=' . $_GET['page']; ?>"><span>Flash sale</span></a>
                </li>
                <li class="current"><a href="#" onclick="return false;"><?= ($_GET['act'] == 'edit') ? 'Sửa' : 'Thêm' ?></a>
                </li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>

    <form name="supplier" class="form" action="index.html?com=flashsale&act=save<?php if ($_GET['id'] != '') echo '&id=' . $_GET['id']; ?><?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?><?php if ($_GET['page'] != '') echo '&page=' . $_GET['page']; ?>" method="post" enctype="multipart/form-data" autocomplete="off" accept-charset="utf-8">
        <div class="mtop0">
            <div class="oneOne">
                <div class="widget mtop0">
                    <div class="title chonngonngu" style="border-bottom: 0px solid transparent">
                        <ul>
                            <?php foreach ($config['lang'] as $k => $v) { ?>
                                <li><a href="<?= $k ?>" class="<?= ($k == $config['lang-default']) ? 'active' : '' ?> tipS" title="<?= $v ?>"><img src="./images/<?= $k ?>.png" alt="" class="<?= $func->changeTitle($v) ?>" /><?= $v ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="<?= ($GLOBAL[$com][$type]['full'] == true) ? 'oneOne' : 'colLeft' ?>">
                <div class="widget mtop0">
                    <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
                        <h6>Thông tin chung</h6>
                    </div>
                    <?php foreach ($config['lang'] as $k => $v) { ?>
                        <div class="formRow lang_hidden lang_<?= $k ?> <?= ($k == 'vi') ? 'active' : '' ?>">
                            <label>Tiêu đề [<?= $v ?>]</label>
                            <div class="formRight">
                                <input type="text" data-validation="required" data-validation-error-msg="Tên không được để trống" <?php if ($table['alias'] == true) { ?>onkeyup="changeSlug('name_<?= $k ?>','alias_<?= $k ?>','url_seo_<?= $k ?>','title_seo_<?= $k ?>','title_<?= $k ?>')" <?php } ?> name="data[ten_<?= $k ?>]" title="Nhập tên danh mục" id="name_<?= $k ?>" class="tipS" value="<?= @$item['ten_' . $k] ?>" />
                            </div>
                            <div class="clear"></div>
                        </div>
                    <?php } ?>
                    <?php if ($GLOBAL[$com][$type]['img'] == true) { ?>
                        <div class="formRow">

                            <label>Tải hình ảnh:</label>

                            <div class="formRight">

                                <?php if ($_GET['act'] == 'edit' || $_GET['act'] == 'copy') { ?>

                                    <input type="file" id="file" name="file" />

                                <?php } else { ?>

                                    <input data-validation="required" data-validation-allowing="jpg, png" data-validation-max-size="300kb" data-validation-error-msg-required="Bạn chưa chọn file" type="file" id="file" name="file" />

                                <?php } ?>

                                <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">

                                <br />
                                <br />
                                <span style="display: inline-block; line-height: 30px;color:#CCC;">

                                    Width: <?= $table['img-width'] * $table['img-ratio'] ?>px -

                                    Height:<?= $table['img-height'] * $table['img-ratio'] ?>px
                                </span>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <?php if ($_GET['act'] == 'edit' || $_GET['act'] == 'copy') { ?>
                            <div class="formRow">
                                <label>Hình Hiện Tại :</label>
                                <div class="formRight">
                                    <div class="mt10"><img style="max-width:clamp(100px,100%,250px); height: auto;" src="<?= _upload_baiviet . $item['photo'] ?>" alt="NO PHOTO" width="<?= $table['img-width'] ?>" height="<?= $table['img-height'] ?>" /></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($GLOBAL[$com][$type]['date'] == true) { ?>
                        <div class="formRow">

                            <label>Ngày bắt đầu</label>

                            <div class="formRight">

                                <input type="text" data-validation="required" data-validation-error-msg="Không được để trống" name="data[time_start]" title="Nhập địa chỉ" id="time_start" class="tipS  daterange" value="<?= ($item["time_start"] != '') ? @date("Y-m-d H:i", $item['time_start']) : @date('Y-m-d H:i');  ?>" />
                            </div>

                            <div class="clear"></div>

                        </div>


                        <div class="formRow">

                            <label>Ngày kết thúc</label>

                            <div class="formRight">

                                <input type="text" data-validation="required" data-validation-error-msg="Không được để trống" name="data[time_end]" title="Nhập địa chỉ" id="time_end" class="tipS  daterange" value="<?= ($item["time_end"] != '') ? @date("Y-m-d H:i", $item['time_end']) : @date('Y-m-d H:i');  ?>" />

                            </div>

                            <div class="clear"></div>

                        </div>
                    <?php } ?>
                </div>
            </div>



            <div class="<?= ($GLOBAL[$com][$type]['full'] == true) ? 'oneOne' : 'colRight' ?>">

                <div class="widget mtop0">

                    <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />

                        <h6>Thuộc tính</h6>

                    </div>

                    <div class="formRow">



                        <div class="formRight">

                            <label>Số thứ tự: </label>

                            <input type="text" class="tipS" value="<?= isset($item['stt']) ? $item['stt'] : $func->checkNumb('stt', $com, $type) ?>" name="data[stt]" style="width:40px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">

                        </div>

                        <div class="clear"></div>

                    </div>

                    <div class="formRow">

                        <div class="formRight">

                            <label class="stardust-checkbox">

                                Hiển thị

                                <input class="stardust-checkbox__input" <?= (!isset($item['hienthi']) || $item['hienthi'] == 1) ? 'checked="checked"' : '' ?> name="hienthi" type="checkbox" value="1" style="display:none">

                                <div class="stardust-checkbox__box"></div>

                            </label>

                        </div>

                    </div>

                </div>

                <div class="clear"></div>

            </div>

        </div>



        <div class="formRow fixedBottom">

            <div class="formRight">

                <input type="hidden" name="id_attr" value="<?= $rowId['id'] ?>" />

                <div class="box-admin" style="display:flex; align-items:center;justify-content:flex-end">

                    <div class="box-action">

                        <button type="submit" class="btn btn-sm bg-gradient-primary text-white">

                            <i class="far fa-save mr-2"></i>Lưu

                        </button>

                        <button type="submit" class="btn btn-sm bg-gradient-success" name="save-here"><i class="far fa-save mr-2"></i>Lưu tại trang</button>

                        <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>

                        <a class="btn btn-sm bg-gradient-danger text-white" href="index.html?com=flashsale&act=man<?php if ($_GET['type'] != '') echo '&type=' . $_GET['type']; ?>">

                            <i class="fas fa-sign-out-alt mr-2"></i>Thoát

                        </a>

                    </div>

                </div>



            </div>

        </div>

        <div class="clear"></div>

</div>

</form>

</div>

<script type="text/javascript">
    $(document).ready(function() {

        window.asd = $('.multiselect-info').SumoSelect({

            placeholder: 'Chọn nhà cung ứng',

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



<script>
    var daysOfWeek = ["CN", "T2", "T3", "T4", "T5", "T6", "T7"];



    var monthNames = ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9",

        "Tháng 10", "Tháng 11", "Tháng 12"

    ];



    $(function() {

        $('.daterange').daterangepicker({

            singleDatePicker: true,

            timePicker: true,

            timePicker24Hour: true,

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

                format: 'YYYY-MM-DD HH:mm',

                daysOfWeek: daysOfWeek,

                monthNames: monthNames,

                firstDay: 1

            }

        }, function(start, end, label) {

            var years = moment().diff(start, 'years');

        });

        $('.daterange').on('apply.daterangepicker', function(ev, picker) {

            $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm'));

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