<div class="wrapper">

    <div class="control_frm">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a
                        href="index.html?com=user&act=add&id=<?=$_GET['id']?>&type="<?=$_GET['type']?>><span>Thêm
                            thành viên</span></a></li>
                <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
    <form name="frm" class="form form-validate" method="post"
        action="index.html?com=user&act=save&id=<?=$_GET['id']?>&type=<?=$_GET['type']?>"
        enctype="multipart/form-data" autocomplete="off" accept-charset="utf-8">
        <div class="oneOne">
            <div class="widget mtop0">
                <div class="formRow">
                    <label>Tên đăng nhập :</label>
                    <div class="formRight">
                        <input data-validation="required" data-validation-error-msg="Tên đăng nhập không được để trống" type="text" name="data[username]" id="username" value="<?=$item['username']?>"
                            class="input" <?php if($_GET['act']=='edit'){?> readonly="readonly" <?php } ?> />
                    </div>
                    <div class="clear"></div>
                </div>
                <?php if($_GET['act']=='edit'){?>
                <div class="formRow">
                    <label>Mật khẩu cũ :</label>
                    <div class="formRight">
                        <input data-validation="required" data-validation-error-msg="Mật khẩu không được để trống" type="password" name="data[oldpassword]" id="oldpassword" value="" class="input" />
                    </div>
                    <div class="clear"></div>
                </div>
                <?php }?>
                <div class="formRow">
                    <label><?=($_GET['act']=='edit') ? 'Mật khẩu mới :' : 'Mật khẩu :'?></label>
                    <div class="formRight">
                        <input data-validation="required" data-validation-error-msg="Mật khẩu mới không được để trống" type="password" name="newpassword" id="newpassword" value="" class="input" />
                    </div>
                    <div class="clear"></div>
                </div>
                <?php if($_GET['act']=='edit'){?>
                <div class="formRow">
                    <label>Nhập lại mật khẩu mới :</label>
                    <div class="formRight">
                        <input data-validation="required" data-validation-error-msg="Mật khẩu nhập lại không được để trống" type="password" name="cfpassword" id="cfpassword" value="" class="input" />
                    </div>
                    <div class="clear"></div>
                </div>
                <?php }?>

                <div class="formRow">
                    <label>Email :</label>
                    <div class="formRight">
                        <input data-validation="required" data-validation-error-msg="Email không được để trống" type="text" name="data[email]" id="email" value="<?=$item['email']?>" class="input" />
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label>Họ tên :</label>
                    <div class="formRight">
                        <input data-validation="required" data-validation-error-msg="Họ tên không được để trống" type="text" name="data[ten]" id="ten" value="<?=$item['ten']?>" class="input" />
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label>Điện thoại :</label>
                    <div class="formRight">
                        <input data-validation="required" data-validation-error-msg="Điện thoại không được để trống" type="text" name="data[dienthoai]" value="<?=$item['dienthoai']?>" class="input" />
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label>Địa chỉ :</label>
                    <div class="formRight">
                        <input type="text" name="data[diachi]" id="diachi" value="<?=$item['diachi']?>" class="input" />
                    </div>
                    <div class="clear"></div>
                </div>
                <?php /*
                <div class="formRow">
                    <label>Avatar:</label>
                    <div class="formRight">
                        <input type="file" id="file1" name="avatar" />
                        <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS"
                            original-title="Tải file pdf">
                    </div>
                    <div class="clear"></div>
                </div>
                <?php if($_GET['act']=='edit'){?>
                <div class="formRow">
                    <label>Avatar Hiện Tại :</label>
                    <div class="formRight">
                        <div class="mt10">
                            <img src="<?=_upload_avatar.$item['avatar']?>" alt="Avatar" />
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <?php } */ ?>
                <div class="formRow">
                    <label>Số thứ tự :</label>
                    <div class="formRight">
                        <input type="text" name="data[stt]" value="<?=isset($item['stt'])?$item['stt']:1?>"
                            style="width:30px">
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow ">
                    <label></label>
                    <div class="formRight">

                        <div class="box-admin" style="display:flex; align-items:center;justify-content:flex-end">
                            <div class="box-action">
                                <button type="submit" class="btn btn-sm bg-gradient-primary text-white submit-check">
                                    <i class="far fa-save mr-2"></i>Lưu
                                </button>
                                <button type="reset" class="btn btn-sm bg-gradient-secondary"><i
                                        class="fas fa-redo mr-2"></i>Làm lại</button>
                                <a class="btn btn-sm bg-gradient-danger text-white" href="index.html?com=user&act=man">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Thoát
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </form>