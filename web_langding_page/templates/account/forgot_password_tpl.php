<section class="res--account--form pt50 pb50" <?php if ($bg_login && !$func->isGoogleSpeed()) { ?> style="background:url(<?= _upload_hinhanh_l . $bg_login["photo"] ?>) no-repeat center center/cover; background-attachment: fixed;" <?php } ?>>
    <div class="grid_s wide">
        <div class="row">
            <div class="col l-12 c-12 m-12">
                <div class="section-main">
                    <div class="wrapper">
                        <div class="content-main d-flex align-items-center justify-content-center">
                            <div class="wrap-user wapper-default p-4 p-lg-5">
                                <div class="title-user">
                                    <span>Quên mật khẩu</span>
                                </div>
                                <form class="form-user validation-user" novalidate method="post" action="account?src=quen-mat-khau" enctype="multipart/form-data" autocomplete="off">
                                    <?= $flash->getMessages("frontend") ?>
                                    <div class="input-user mb15">
                                        <label for="username">Tài khoản:</label>
                                        <input type="text" class="form-control text-sm" id="username" name="username" placeholder="Nhập tài khoản" required>
                                        <small class="invalid">Vui lòng nhập tài khoản</small>
                                    </div>
                                    <div class="input-user mb15">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control text-sm" id="email" name="email" placeholder="Nhập email" required>
                                        <small class="invalid">Vui lòng nhập email</small>
                                    </div>
                                    <div class="t-center button-register">
                                        <input type="submit" disabled name="forgot-password-user" class="button-user" value="Lấy mật khẩu">
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