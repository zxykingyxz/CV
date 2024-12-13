<?php
if (isset($_POST['submit-resgister']) && !empty($_POST)) {

    $folder_sendEmail = "newsletter";

    $respone = array();

    $send = array();

    $data = $_POST['data'];

    // $fullname = htmlspecialchars($func->sanitize($data['fullname']));

    $phone = htmlspecialchars($func->sanitize($data['phone']));

    // $address = htmlspecialchars($func->sanitize($data['address']));

    $email = htmlspecialchars($func->sanitize($data['email']));

    // $notes = htmlspecialchars($func->sanitize($data['notes']));

    // if (empty($fullname && isset($fullname))) {
    //     $func->transfer('Họ tên không được để trống', $https_config);
    // }

    if (!empty($phone) && !$func->isPhone($phone) && isset($phone)) {
        $func->transfer('Số điện thoại không hợp lệ', $https_config);
    }

    // if (empty($address) && isset($address)) {
    //     $func->transfer('Địa chỉ không được để trống', $https_config);
    // }

    if (!empty($email) && !$func->isEmail($email) && isset($email)) {
        $func->transfer('Email không hợp lệ', $https_config);
    }


    // if (isset($fullname)) {
    //     $send['ten_vi'] = $fullname;
    // }
    if (isset($email)) {
        $send['email'] = $email;
    }
    // if (isset($address)) {
    //     $send['diachi'] = $address;
    // }
    if (isset($phone)) {
        $send['dienthoai'] = $phone;
    }

    // if (isset($notes)) {
    //     $send['noidung'] = $notes;
    // }

    $send['ngaytao'] = time();

    $send['type'] = 'client';

    $send['hienthi'] = 1;

    $insertId = $db->insert('booking', $send);

    // if ($insertId) {
    //     $func->transfer('Đăng ký nhận tin thành công', $https_config);
    // } else {
    //     $func->transfer('Đăng ký nhận tin không thành công', $https_config);
    // }

    include _source . 'email.php';
}
if (isset($_POST['submit-clientsupport']) && !empty($_POST)) {

    $folder_sendEmail = "newsletter";

    $respone = array();

    $send = array();

    $data = $_POST['data'];

    $phone = htmlspecialchars($func->sanitize($data['phone']));

    if (!empty($phone) && !$func->isPhone($phone)) {

        $flash->set('error', 'Số điện thoại không hợp lệ');
    }


    $error = $flash->get('error');

    if (!empty($error)) {

        $func->transfer($error, $https_config);
    }

    $send['dienthoai'] = $phone;

    $send['ngaytao'] = time();

    $send['type'] = 'goi-lai';

    $send['hienthi'] = 1;

    $insertId = $db->insert('booking', $send);

    if ($insertId) {
        $func->transfer('Đăng ký gọi lại thành công', $https_config);
    } else {
        $func->transfer('Đăng ký gọi lại không thành công', $https_config);
    }
}
