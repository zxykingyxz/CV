<section class="res--account--form pt50 pb50" <?php if ($bg_login && !$func->isGoogleSpeed()) { ?> style="background:url(<?= _upload_hinhanh_l . $bg_login["photo"] ?>) no-repeat center center/cover; background-attachment: fixed;" <?php } ?>>
    <div class="grid_s wide">
        <div class="row">
            <div class="col l-12 c-12 m-12">
                <div class="section-main">
                    <div class="wrapper">
                        <div class="content-main d-flex align-items-center justify-content-center">
                            <div class="wrap-register wapper-default p-5">
                                <div class="title-user">
                                    <span>ĐĂNG KÝ</span>
                                </div>
                                <form class="form-user validation-user" novalidate method="post" action="<?= $func->getComUrl('account?src=dang-ky') ?>" enctype="multipart/form-data" autocomplete="off">
                                    <?= $flash->getMessages("frontend") ?>
                                    <div class="row">
                                        <div class="col l-6 m-6 c-12 input-user mb15">
                                            <label for="fullname">Họ và tên:</label>
                                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Nhập họ tên" value="<?= $flash->get('fullname') ?>" required>
                                            <small class="invalid">Vui lòng nhập họ tên</small>
                                        </div>
                                        <div class="col l-6 m-6 c-12 input-user mb15">
                                            <label for="username">Tài khoản:</label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tài khoản" value="<?= $flash->get('username') ?>" required>
                                            <small class="invalid">Vui lòng nhập tài khoản</small>
                                        </div>
                                        <div class="col l-6 m-6 c-12 input-user mb15">
                                            <label for="password">Mật khẩu:</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
                                            <small class="invalid">Vui lòng nhập mật khẩu</small>
                                        </div>
                                        <div class="col l-6 m-6 c-12 input-user mb15">
                                            <label for="repassword">Nhập lại mật khẩu:</label>
                                            <input type="password" class="form-control" id="repassword" name="repassword" placeholder="Nhập lại mật khẩu" required>
                                            <small class="invalid">Vui lòng nhập lại nhật khẩu</small>
                                        </div>
                                        <div class="col l-6 m-6 c-12 input-user mb15">
                                            <?php $flashGender = $flash->get('gender'); ?>
                                            <label>Giới tính:</label>
                                            <div class="d-flex align-items-center">
                                                <div class="radio-user custom-control custom-radio d-flex align-items-center gap5 mr30">
                                                    <input type="radio" id="nam" name="gender" class="custom-control-input" value="1" <?= ($flashGender == 1) ? 'checked' : '' ?> required>
                                                    <label class="custom-control-label mg0" for="nam">Nam</label>
                                                </div>
                                                <div class="radio-user custom-control custom-radio d-flex align-items-center gap5">
                                                    <input type="radio" id="nu" name="gender" class="custom-control-input" value="2" <?= ($flashGender == 2) ? 'checked' : '' ?> required>
                                                    <label class="custom-control-label mg0" for="nu">Nữ</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col l-6 m-6 c-12 input-user mb15">
                                            <label for="birthday">Ngày sinh:</label>
                                            <input type="text" class="form-control" id="birthday" name="birthday" placeholder="Nhập ngày sinh" value="<?= $flash->get('birthday') ?>" required autocomplete="off">
                                            <small class="invalid">Vui lòng nhập ngày sinh</small>
                                        </div>
                                        <div class="col l-6 m-6 c-12 input-user mb15">
                                            <label for="email">Email:</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" value="<?= $flash->get('email') ?>" required>
                                            <small class="invalid">Vui lòng nhập email</small>
                                        </div>
                                        <div class="col l-6 m-6 c-12 input-user mb15">
                                            <label for="phone">Điện thoại:</label>
                                            <input type="number" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" value="<?= $flash->get('phone') ?>" required>
                                            <small class="invalid">Vui lòng nhập số điện thoại</small>
                                        </div>
                                        <div class="l-12 m-12 c-12 input-user col mb15">
                                            <label for="address">Địa chỉ:</label>
                                            <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ" value="<?= $flash->get('address') ?>" required>
                                            <small class="invalid">Vui lòng nhập địa chỉ</small>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between col l-12 m-12 c-12 button-register">
                                        <p class="mg0">Bạn đã có tài khoản? <a href="<?= $func->getComUrl('account?src=dang-nhap') ?>" class="link-primary text-decoration-underline">Đăng nhập</a></p>
                                        <input disabled type="submit" class="button-user" name="registration-user" value="ĐĂNG KÝ">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>