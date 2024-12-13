<section class="res--account--form pt50 pb50" <?php if ($bg_login && !$func->isGoogleSpeed()) { ?> style="background:url(<?= _upload_hinhanh_l . $bg_login["photo"] ?>) no-repeat center center/cover; background-attachment: fixed;" <?php } ?>>
    <div class="grid_s wide">
        <div class="row">
            <div class="col l-12 c-12 m-12">
                <div class="section-main">
                    <div class="wrapper">
                        <div class="content-main d-flex align-items-center justify-content-center">
                            <div class="wrap-user wapper-default">
                                <div class="login-form-wrap p-5">
                                    <div class="title-user">
                                        <span>Đăng nhập</span>
                                    </div>
                                    <form class="form-user validation-user" novalidate method="post" action="<?= $func->getComUrl('account?src=dang-nhap') ?>" enctype="multipart/form-data" autocomplete="off">
                                        <?= $flash->getMessages("frontend") ?>
                                        <div class="input-user mb15">
                                            <label for="username">Tài khoản:</label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tài khoản" autocomplete="off" required>
                                            <small class="invalid">Vui lòng nhập tài khoản</small>
                                        </div>
                                        <div class="input-user mb15">
                                            <label for="password">Mật khẩu:</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" autocomplete="off" required>
                                            <small class="invalid">Vui lòng nhập mật khẩu</small>
                                        </div>
                                        <div class="input-user--btn mb20 t-center">
                                            <input type="submit" disabled class="button-user btn--submit-user" name="login-user" value="Đăng nhập">
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="checkbox-user custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="remember-user" id="remember-user" value="1">
                                                <label class="custom-control-label" for="remember-user">Nhớ mật
                                                    khẩu</label>
                                            </div>
                                            <a href="<?= $func->getComUrl('account?src=quen-mat-khau') ?>" class="link-for" title="Quên mật khẩu">Quên mật khẩu</a>
                                        </div>
                                        <div class="text-center mt10">
                                            <span>Bạn chưa có tài khoản?</span>
                                            <a href="<?= $func->getComUrl('account?src=dang-ky') ?>" class="link-res" title="Đăng ký tại đây">Đăng ký
                                                tại đây</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>