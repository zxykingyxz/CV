
<div class="section-main">
    <div class="wrapper">
        <div class="content-main">
            <div class="wrap-info p-4 p-lg-5">
                <div class="title-user">
                    <span><?=$title_seo?></span>
                </div>
                <form class="form-user validation-user row" novalidate method="post" action="account?src=thong-tin" enctype="multipart/form-data">
                    <?= $flash->getMessages("frontend") ?>
                    <div class="col l-6 m-6 c-12 input-user mb15">
                        <label for="fullname">Họ và tên:</label>
                        <input type="text" class="form-control form-bg" id="fullname" name="fullname" placeholder="Nhập họ tên" value="<?= (!empty($flash->has('fullname'))) ? $flash->get('fullname') : $account_info['fullname'] ?>" required>
                        <small class="invalid">Vui lòng nhập họ tên</small>
                    </div>
                    <div class="col l-6 m-6 c-12 input-user mb15">
                        <label for="username">Tài khoản:</label>
                        <input type="text" class="form-control form-bg" id="username" name="username" placeholder="Nhập tài khoản" value="<?= $account_info['username'] ?>" readonly required>
                    </div>
                    <div class="col l-6 m-6 c-12 input-user mb15">
                        <label for="old-password">Mật khẩu cũ:</label>
                        <input type="password" class="form-control form-bg" id="old-password" name="old-password" placeholder="Nhập mật khẩu cũ">
                    </div>
                    <div class="col l-6 m-6 c-12 input-user mb15">
                        <label for="new-password">Mật khẩu mới:</label>
                        <input type="password" class="form-control form-bg" id="new-password" name="new-password" placeholder="Nhập mật khẩu mới">
                    </div>
                    <div class="col l-6 m-6 c-12 input-user mb15">
                        <label for="new-password-confirm">Nhập lại mật khẩu mới:</label>
                        <input type="password" class="form-control form-bg" id="new-password-confirm" name="new-password-confirm" placeholder="Nhập lại mật khẩu mới">
                    </div>
                    <div class="col l-6 m-6 c-12 input-user mb15">
                        <?php $flashGender = $flash->get('gender'); ?>
                        <label>Giới tính:</label>
                        <div class="d-flex align-items-center">
                            <div class="radio-user custom-control custom-radio d-flex align-items-center gap5 mr30">
                                <input type="radio" id="nam" name="gender" class="custom-control-input" <?= (!empty($flashGender) && $flashGender == 1) ? 'checked' : (($account_info['gender'] == 1) ? 'checked' : '') ?> value="1" required>
                                <label class="custom-control-label mg0" for="nam">Nam</label>
                            </div>
                            <div class="radio-user custom-control custom-radio d-flex align-items-center gap5">
                                <input type="radio" id="nu" name="gender" class="custom-control-input" <?= (!empty($flashGender) && $flashGender == 2) ? 'checked' : (($account_info['gender'] == 2) ? 'checked' : '') ?> value="2" required>
                                <label class="custom-control-label mg0" for="nu">Nữ</label>
                            </div>
                        </div>
                    </div>
                    <div class="col l-6 m-6 c-12 input-user mb15">
                        <label for="birthday">Ngày sinh:</label>
                        <input type="text" class="form-control form-bg" id="birthday" name="birthday" placeholder="Ngày sinh" value="<?= (!empty($flash->has('birthday'))) ? $flash->get('birthday') : date("d/m/Y", $account_info['birthday']) ?>" required autocomplete="off">
                        <small class="invalid">Vui lòng nhập email</small>
                    </div>
                    <div class="col l-6 m-6 c-12 input-user mb15">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control form-bg" id="email" name="email" placeholder="Nhập email" value="<?= (!empty($flash->has('email'))) ? $flash->get('email') : $account_info['email'] ?>" required>
                        <small class="invalid">Vui lòng nhập email</small>
                    </div>
                    <div class="col l-6 m-6 c-12 input-user mb15">
                        <label for="phone">Điện thoại:</label>
                        <input type="number" class="form-control form-bg" id="phone" name="phone" placeholder="Nhập điện thoại" value="<?= (!empty($flash->has('phone'))) ? $flash->get('phone') : $account_info['phone'] ?>" required>
                        <small class="invalid">Vui lòng nhập số điện thoại</small>
                    </div>
                    <div class="col l-12 m-12 c-12 input-user mb15">
                        <label for="address">Địa chỉ:</label>
                        <input type="text" class="form-control form-bg" id="address" name="address" placeholder="Nhập địa chỉ" value="<?= (!empty($flash->has('address'))) ? $flash->get('address') : $account_info['address'] ?>" required>
                        <small class="invalid">Vui lòng nhập địa chỉ</small>
                    </div>
                    <div class="col l-12 m-12 c-12 input-user">
                        <div class="button-register t-center">
                            <input type="submit" class="button-user" name="info-user" value="Cập nhật"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>