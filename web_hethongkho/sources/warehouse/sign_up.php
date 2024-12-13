<?php
if (isset($_POST['submit-resgister-man']) && !empty($_POST)) {

    $send = array();

    $data = $_POST['data'];

    $fullname = htmlspecialchars($warehouse_func->sanitize($data['fullname']));

    $phone = htmlspecialchars($warehouse_func->sanitize($data['phone']));

    $city = htmlspecialchars($warehouse_func->sanitize($data['city']));

    $email = htmlspecialchars($warehouse_func->sanitize($data['email']));

    $captcha = htmlspecialchars($warehouse_func->sanitize($data['captcha']));

    $agreeCheck = htmlspecialchars($warehouse_func->sanitize($data['agreeCheck']));

    if (empty($fullname && isset($fullname))) {
        $warehouse_func->transfer('Họ tên không đúng định dạng hoặc để trống!', $url_sign_up_form, false);
    }
    $_SESSION[$sessison_account_warehouse_tmp]['name'] = $fullname;

    if (!empty($phone) && !$warehouse_func->isPhone($phone) && isset($phone)) {
        $warehouse_func->transfer('Số điện thoại không hợp lệ!', $url_sign_up_form, false);
    }
    $check_phone = $db->rawQueryOne("select id from #_" . $name_table_account . " where phone = '" . $phone . "'", array());
    $check_phone_sub = $db->rawQueryOne("select id from #_" . $name_table_subaccount . " where phone = '" . $phone . "'", array());
    if ((!empty($check_phone)) || (!empty($check_phone_sub))) {
        $warehouse_func->transfer('Số Điện Thoại đã tồn tại!', $url_sign_up_form, false);
    }
    $_SESSION[$sessison_account_warehouse_tmp]['phone'] = $phone;

    if (empty($city) && isset($city)) {
        $warehouse_func->transfer('Khu vực không được để trống!', $url_sign_up_form, false);
    }
    $_SESSION[$sessison_account_warehouse_tmp]['city'] = $city;

    if (empty($email && isset($email))) {
        $warehouse_func->transfer('Email không được để trống!', $url_login_form, false);
    }
    if (!empty($email) && !$warehouse_func->isEmail($email) && isset($email)) {
        $warehouse_func->transfer('Email không hợp lệ!', $url_sign_up_form, false);
    }
    $check_email = $db->rawQueryOne("select id from #_" . $name_table_account . " where email = '" . $email . "'", array());
    $check_email_sub = $db->rawQueryOne("select id from #_" . $name_table_subaccount . " where email = '" . $email . "'", array());
    if ((!empty($check_email)) || (!empty($check_email_sub))) {
        $warehouse_func->transfer('Email đã tồn tại!', $url_sign_up_form, false);
    }
    $_SESSION[$sessison_account_warehouse_tmp]['email'] = $email;

    if (empty($captcha && isset($captcha))) {
        $warehouse_func->transfer('Captcha không được để trống!', $url_sign_up_form, false);
    }
    if (!empty($captcha && isset($captcha))  && ($captcha !== $_SESSION["captcha_sign_up_warehouse"])) {
        $warehouse_func->transfer('Captcha không hợp lệ!', $url_sign_up_form, false);
    }
    if (empty($agreeCheck && isset($agreeCheck)) && ($agreeCheck === "on")) {
        $warehouse_func->transfer('Bạn chưa đồng ý với điều khoản của chúng tôi!', $url_sign_up_form, false);
    }

    $warehouse_func->transfer('Cháo mừng bạn đến với phần mềm quản lý hệ thống kho của I-Web', $url_sign_up_list);
}

if (isset($_POST['submit-resgister-list']) && !empty($_POST)) {

    $send = array();

    $data = $_POST['data'];

    $subdomain = htmlspecialchars($warehouse_func->sanitize($data['subdomain']));

    $profession = htmlspecialchars($warehouse_func->sanitize($data['profession']));

    if (empty($profession && isset($profession))) {
        $warehouse_func->transfer('Ngành nghề không được để trống', $url_sign_up_form, false);
    }
    if (empty($subdomain && isset($subdomain))) {
        $warehouse_func->transfer('Tên cửa hàng không được để trống', $url_sign_up_form, false);
    }
    if (strlen($subdomain) > 30) {
        $warehouse_func->transfer('Tên cửa hàng tối đa 30 ký tự', $url_sign_up_form, false);
    }
    $check_subdomain = $db->rawQueryOne("select id from #_" . $name_table_account . " where subdomain = '" . $subdomain . "' ", array());
    if (!empty($check_subdomain)) {
        $warehouse_func->transfer('Tên cửa hàng đã tồn tại', $url_sign_up_form, false);
    }
    if (preg_match('/[^\x20-\x7E]/', $subdomain)) {
        $warehouse_func->transfer('Tên cửa hàng không được chứa dấu', $url_sign_up_form, false);
    }
    if (preg_match('/[^a-z0-9]/', $subdomain)) {
        $warehouse_func->transfer('Tên cửa hàng không được chứa ký tự đặc biệt và khoảng trắng', $url_sign_up_form, false);
    }
    if (preg_match('/[A-Z]/', $subdomain)) {
        $warehouse_func->transfer('Tên cửa hàng không được chứa chữ hoa', $url_sign_up_form, false);
    }
    if (isset($subdomain)) {
        $send['subdomain'] = $subdomain;
    }
    if (isset($profession)) {
        $send['profession'] = $profession;
    }

    $send['date_created'] = time();

    $send['trash'] = false;

    $password = $warehouse_func->generalPassword();

    $send['password'] = $warehouse_func->encrypt($password);

    $_SESSION[$sessison_account_warehouse_tmp] = array_merge($_SESSION[$sessison_account_warehouse_tmp], $send);

    $insertId = $db->insert('warehouse_account', $_SESSION[$sessison_account_warehouse_tmp]);

    if ($insertId) {
        $_SESSION[$sessison_account_warehouse]['id'] = $insertId;
        $_SESSION[$sessison_account_warehouse]['sub'] = false;
        $_SESSION[$sessison_account_warehouse]['id_owner'] = $insertId;
        $warehouse_func->transfer('Tạo tài khoản thành công', $url_sign_up_result);
    } else {
        $warehouse_func->transfer('Tạo tài khoản bị lỗi', $url_sign_up_list, false);
    }
}
