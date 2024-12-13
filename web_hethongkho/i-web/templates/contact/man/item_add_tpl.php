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

    <div class="control_frm" style="margin-top:25px;">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li class="current"><a href="#" onclick="return false;"><?= _them ?></a></li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
    <div class="oneOne">
        <form name="supplier" id="validate" class="form"
            action="index.html?com=contact&act=save<?php if ($_REQUEST['type'] != '') echo '&type=' . $_REQUEST['type']; ?><?php if ($_REQUEST['id'] != '') echo '&id=' . $_REQUEST['id']; ?>"
            method="post" enctype="multipart/form-data">
            <div class="widget mt0">
                <div class="formRow">
                    <label><?= _hoten ?> : </label>
                    <div class="formRight">
                        <?= @$item['fullname'] ?>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label><?= _dienthoai ?> : </label>
                    <div class="formRight">
                        <?= @$item['phone'] ?>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label><?= _email ?> : </label>
                    <div class="formRight">
                        <?= @$item['email'] ?>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label><?= _diachi ?> : </label>
                    <div class="formRight">
                        <?= @$item['address'] ?>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label><?= _tieude ?> : </label>
                    <div class="formRight">
                        <?= @$item['subject'] ?>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label><?= _noidung ?></label>
                    <div class="formRight">
                        <textarea rows="4" cols="" title="Nhập Ghi chú ." class="tipS"
                            name="content"><?= @$item['content'] ?></textarea>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <div class="formRight">
                        <label class="stardust-checkbox">
                            Hiển thị
                            <input class="stardust-checkbox__input"
                                <?= (!isset($item['hienthi']) || $item['hienthi'] == 1) ? 'checked="checked"' : '' ?>
                                name="hienthi" type="checkbox" value="1" style="display:none">
                            <div class="stardust-checkbox__box"></div>
                        </label>
                    </div>
                </div>
                <div class="formRow">
                    <div class="formRight">
                        <label><?= _sothutu ?>: </label>
                        <input type="text" class="tipS" value="<?= isset($item['stt']) ? $item['stt'] : 1 ?>" name="data[stt]"
                            style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)"
                            original-title="Số thứ tự của danh mục, chỉ nhập số">
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
                        <button type="reset" class="btn btn-sm bg-gradient-secondary"><i
                                class="fas fa-redo mr-2"></i>Làm lại</button>
                        <a class="btn btn-sm bg-gradient-danger text-white"
                            href="index.html?com=contact&act=man<?php if ($_REQUEST['type'] != '') echo '&type=' . $_REQUEST['type']; ?>">
                            <i class="fas fa-sign-out-alt mr-2"></i>Thoát
                        </a>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </form>
    </div>
</div>