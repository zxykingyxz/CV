<script language="javascript" src="media/scripts/my_script.js"></script>
<script language="javascript">
function js_submit() {
    if (isEmpty(document.frm.email, "Chưa nhập tên đăng nhập.")) {
        document.frm.email.focus();
        return false;
    }
    <?php if($_GET['act']=='add'){?>
    if (isEmpty(document.frm.oldpassword, "Chưa nhập mật khẩu.")) {
        document.frm.oldpassword.focus();
        return false;
    }

    if (document.frm.oldpassword.value.length < 5) {
        alert("Mật khẩu phải nhiều hơn 4 ký tự.");
        document.frm.oldpassword.focus();
        return false;
    }
    <?php } ?>
    if (!isEmpty(document.frm.email) && !check_email(document.frm.email.value)) {
        alert('Email không hợp lệ.');
        document.frm.email.focus();
        return false;
    }
}
</script>
<?php 
	
	$city_place= $d->get_result_array("select id,ten from #_place_city");
	$dataDist= $d->get_result_array("select ten,id from #_place_dist");
	$dataWard= $d->get_result_array("select ten,id from #_place_ward");
    $userInfo=$func->getUserInfo($item['id']);
 ?>
<div class="wrapper">

    <div class="control_frm">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="index.html?com=member&act=add&type=<?=$_GET['type']?>"><span>Thêm thành viên</span></a></li>
                <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
    <form name="frm" class="form" method="post"
        action="index.html?com=member&act=save&id=<?=$_GET['id']?>&type=<?=$_GET['type']?>" enctype="multipart/form-data"
        class="nhaplieu" onSubmit="return js_submit();">
        <div class="oneTwo">
            <div class="widget mtop0">
                <div class="formRow">
                    <label>Tải avatar:</label>
                    <div class="formRight">
                        <input type="file" id="file" name="file" />
                        <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS"
                            original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
                        <br />
                        <br />
                        <span style="display: inline-block; line-height: 30px;color:#CCC;">
                            Width: 100px -
                            Height:100px
                        </span>
                    </div>
                    <div class="clear"></div>
                </div>
                <?php if($_GET['act']=='edit'){?>
                <div class="formRow">
                    <label>Hình Hiện Tại :</label>
                    <div class="formRight">
                        <div class="mt10"><img src="<?=_upload_avatar.$userInfo['avatar']?>" alt="NO PHOTO" width="100" />
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <?php } ?>
                <div class="formRow">
                    <label>#ID :</label>
                    <div class="formRight">
                        <input type="text" name="data[username]" id="username" value="<?=$item['username']?>" class="input"
                            <?php if($_GET['act']=='edit'){?> readonly="readonly" <?php } ?> />
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label>Mật khẩu :</label>
                    <div class="formRight">
                        <input type="password" name="data[password]" id="password" value="" class="input" />
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label>Họ tên :</label>
                    <div class="formRight">
                        <input type="text" name="data[hoten]" id="hoten" value="<?=$userInfo['hoten']?>" class="input" />
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label>Email :</label>
                    <div class="formRight">
                        <input type="text" name="data[email]" id="email" value="<?=$userInfo['email']?>" class="input" />
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label>Số thứ tự :</label>
                    <div class="formRight">
                        <input type="text" name="data[stt]" value="<?=isset($item['stt']) ? $item['stt'] : 1?>"
                            style="width:30px">
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="oneTwo">
            <div class="widget mtop0">
                <!-- <div class="formRow">
                    <label>Ngày sinh :</label>
                    <div class="formRight">
                        <input type="text" name="data[ngaysinh]" id="ngaysinh" value="<?=$item['ngaysinh']?>"
                            class="input" />
                    </div>
                    <div class="clear"></div>
                </div> -->
                <div class="formRow">
                    <label>Điện thoại :</label>
                    <div class="formRight">
                        <input type="text" name="data[dienthoai]" value="<?=$item['dienthoai']?>" class="input" />
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label>Tỉnh/thành phố :</label>
                    <div class="formRight">
                        <select name="data[id_city]" id="acc-city">
                            <option value="0">Tỉnh/Thành phố<span style="color:#f00">(*)</span></option>
                            <?php foreach ($city_place as $key => $value) {?>
                            <option value="<?=$value['id']?>"
                                <?php if($userInfo['id_city']==$value['id']) echo 'selected'; ?>><?=$value['ten']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label>Quận/huyện :</label>
                    <div class="formRight">
                        <select name="data[id_dist]" id="acc-dist">
                            <option value="0">Quận/huyện:<span style="color:#f00">(*)</span></option>
                            <?php foreach ($dataDist as $key => $value) {?>
                            <?php if($userInfo['id_dist']==$value['id']){?>
                            <option value="<?=$value['id']?>"
                                <?php if($userInfo['id_dist']==$value['id']) echo 'selected'; ?>><?=$value['ten']?></option>
                            <?php } ?>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label>Phường/xã :</label>
                    <div class="formRight">
                        <select name="data[id_ward]" id="acc-ward">
                            <option value="0">Phường/xã :<span style="color:#f00">(*)</span></option>
                            <?php foreach ($dataWard as $key => $value) {?>
                            <?php if($item['id_ward']==$value['id']){?>
                            <option value="<?=$value['id']?>"
                                <?php if($userInfo['id_ward']==$value['id']) echo 'selected'; ?>><?=$value['ten']?></option>
                            <?php } ?>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label>Địa chỉ :</label>
                    <div class="formRight">
                        <input type="text" name="data[diachi]" id="diachi" value="<?=$userInfo['diachi']?>" class="input" />
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow fixedBottom">
                    <div class="formRight">
                        <div class="box-admin" style="display:flex; align-items:center;justify-content:flex-end">
                            <div class="box-action">
                                <button type="submit" class="btn btn-sm bg-gradient-primary text-white submit-check">
                                    <i class="far fa-save mr-2"></i>Lưu
                                </button>
                                <button type="reset" class="btn btn-sm bg-gradient-secondary"><i
                                        class="fas fa-redo mr-2"></i>Làm lại</button>
                                <a class="btn btn-sm bg-gradient-danger text-white"
                                    href="index.html?com=member&act=man&type=<?=$_GET['type']?>">
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
    <script language="javascript">
    $(function() {
        $('#acc-city').change(function() {
            var id = $(this).val();
            $.ajax({
                url: 'ajax/loadquan.php',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#acc-dist').html(data);
                }
            })
        });
        $('#acc-dist').change(function() {
            var id = $(this).val();
            $.ajax({
                url: 'ajax/loadxa.php',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#acc-ward').html(data);
                }
            })
        });
    })
    </script>