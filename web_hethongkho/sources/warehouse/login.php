<?php
if (empty($_SESSION['error_account'])) {
    $_SESSION['error_account'] = [
        "number" => 0,
        "time_error" => 0,
    ];
}
if ($_SESSION['error_account']["number"] >= 5) {
    $_SESSION['error_account']["time_error"] = time() + (2 * 60 * 60);
    $_SESSION['error_account']["number"] = 0;
}
if ($_SESSION['error_account']["time_error"] >= time()) {
    $warehouse_func->transfer('Bạn không thể đăng nhập nữa vì đăng nhập sai quá 5 lần và sẽ mở lại vào lúc ' . date("H:i d/m/Y", $_SESSION['error_account']["time_error"]), $https_config, false);
}

// đăng nhập
if (isset($_POST['submit-resgister-login']) && !empty($_POST)) {

    $send = array();

    $data = $_POST['data'];

    $subdomain = htmlspecialchars($warehouse_func->sanitize($data['subdomain']));

    $username = htmlspecialchars($warehouse_func->sanitize($data['username']));

    $password = htmlspecialchars($warehouse_func->sanitize($data['password']));

    if (empty($subdomain && isset($subdomain))) {
        $warehouse_func->transfer('Tên cửa hàng không được để trống', $url_login_form, false);
    }
    if (empty($username && isset($username))) {
        $warehouse_func->transfer('Tên tài khoản không được để trống', $url_login_form, false);
    }
    if (empty($password && isset($password))) {
        $warehouse_func->transfer('Mật khẩu không được để trống', $url_login_form, false);
    }
    $check_subdomain = $db->rawQueryOne("select id,subdomain from #_" . $name_table_account . " where subdomain = '" . $subdomain . "' and trash<>true", array());
    if (empty($check_subdomain)) {
        $_SESSION['error_account']["number"] = $_SESSION['error_account']["number"] + 1;
        $warehouse_func->transfer('Tên cửa hàng không tồn tại hoặc đã bị vô hiệu hóa!', $url_login_form, false);
    }
    $check_username = $db->rawQueryOne("select id from #_" . $name_table_account . " where phone = '" . $username . "' and subdomain ='" . $check_subdomain['subdomain'] . "' and trash<>true", array());
    $check_username_sub = $db->rawQueryOne("select id,id_owner from #_" . $name_table_subaccount . " where phone = '" . $username . "' and id ='" . $check_subdomain['id'] . "' and trash<>true", array());

    if (empty($check_username) && empty($check_username_sub)) {
        $_SESSION['error_account']["number"] = $_SESSION['error_account']["number"] + 1;
        $warehouse_func->transfer('Tài khoản không tồn tại hoặc đã bị vô hiệu hóa!', $url_login_form, false);
    }

    if ((!empty($check_username)) || (!empty($check_username_sub))) {
        if (!empty($check_username)) {
            $table_check_username = $name_table_account;
            $table_check_username_id = $check_username['id'];
            $table_check_sub = false;
            $id_owner = $check_username['id'];
        }
        if (!empty($check_username_sub)) {
            $table_check_username = $name_table_subaccount;
            $table_check_username_id = $check_username_sub['id'];
            $table_check_sub = true;
            $id_owner = $check_username_sub['id_owner'];
        }

        $check_password = $db->rawQueryOne("select * from #_" . $table_check_username . " where password = '" . $warehouse_func->encrypt($password) . "' and id ='" . $table_check_username_id . "' and trash<>true", array());

        if (empty($check_password)) {
            $_SESSION['error_account']["number"] = $_SESSION['error_account']["number"] + 1;
            $warehouse_func->transfer('Sai mật khẩu', $url_login_form, false);
        }
    }
    $_SESSION['error_account']["number"] = 0;
    $_SESSION[$sessison_account_warehouse]['id'] = $check_password['id'];
    $_SESSION[$sessison_account_warehouse]['sub'] =  $table_check_sub;
    $_SESSION[$sessison_account_warehouse]['id_owner'] =  $id_owner;

    $warehouse_func->transfer('Đăng nhập thành công', $url_dashboard_man);
}

// quên mật khẩu
if (isset($_POST['submit-forgot-password']) && !empty($_POST)) {

    $send = array();

    $data = $_POST['data'];

    $subdomain = htmlspecialchars($warehouse_func->sanitize($data['subdomain']));

    $username = htmlspecialchars($warehouse_func->sanitize($data['username']));

    $email = htmlspecialchars($warehouse_func->sanitize($data['email']));

    if (empty($subdomain && isset($subdomain))) {
        $warehouse_func->transfer('Tên cửa hàng không được để trống!', $url_login_form, false);
    }
    if (empty($username && isset($username))) {
        $warehouse_func->transfer('Tên tài khoản không được để trống!', $url_login_form, false);
    }
    if (empty($email && isset($email))) {
        $warehouse_func->transfer('Email không được để trống!', $url_login_form, false);
    }
    if (!empty($email) && !$warehouse_func->isEmail($email) && isset($email)) {
        $warehouse_func->transfer('Email không hợp lệ!', $url_sign_up_form, false);
    }
    $check_forgot_password = $db->rawQueryOne("select * from #_" . $name_table_account . " where subdomain = '" . $subdomain . "' and phone = '" . $username . "' and email = '" . $email . "' and trash<>true", array());

    $password = $warehouse_func->generalPassword();

    $password = $warehouse_func->encrypt($password);

    $db->rawQueryOne("update table_" . $name_table_account . " set password = '" . $password . "'  where id = '" . $check_forgot_password['id'] . "' and trash<>true", array());

    if (!empty($check_forgot_password)) {
        $_SESSION[$sessison_account_warehouse_tmp]['name'] = $check_forgot_password['name'];
        $_SESSION[$sessison_account_warehouse_tmp]['subdomain'] = $check_forgot_password['subdomain'];
        $_SESSION[$sessison_account_warehouse_tmp]['phone'] = $check_forgot_password['phone'];
        $_SESSION[$sessison_account_warehouse_tmp]['password'] = $password;
        $_SESSION[$sessison_account_warehouse]['id'] = $check_forgot_password['id'];
        $_SESSION[$sessison_account_warehouse]['sub'] = false;
        $warehouse_func->transfer('Xác thực tài khoản thành công', $url_login_result);
    } else {
        $warehouse_func->transfer('Tài khoản không tồn tại hoặc thông tin tài khoản bạn cung cấp bị sai! Nếu tài khoản phụ xin liên hệ tài khoản chủ để được đổi mật khẩu', $url_login_forgot_password, false);
    }
}
