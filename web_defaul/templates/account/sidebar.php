<nav id="navbar-user">
    <div class="wrapper--head--sidebar d-flex align-items-center gap10">
        <div class="res--thumb--user">
            <?=$func->addHrefImg([
                'sizes' => '50x50x1',
                'upload' => _upload_user_l,
                'image' => $account_info['avatar']
            ])?>
        </div>
        <div class="res--fullname--user">
            <span class="line-1">
                <?=$account_info["fullname"]?>
            </span>
        </div>
    </div>
    <div class="wrapper--body--sidebar">
        <ul>
            <li>
                <a href="account?src=thong-tin" class="<?php if($src=='thong-tin') echo 'active'; ?>" title="Thông tin tài khoản">
                    <span class="d-flex">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </span>
                    <span>Thông tin tài khoản</span>
                </a>    
            </li>
            <!-- <li>
                <a href="account?src=change-password" class="<?php if($src=='change-password') echo 'active'; ?>" title="Thay đổi mật khẩu">
                    Thay đổi mật khẩu
                </a>    
            </li> -->
            <li>
                <a href="account?src=dang-xuat" title="Đăng xuất">
                    <span class="d-flex">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                    </span>   
                    <span>Đăng xuất</span>
                </a>
            </li>
        </ul>   
    </div>
</nav>