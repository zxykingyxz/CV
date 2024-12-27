<?php

if (isset($_POST['submit-resgister-client']) && !empty($_POST)) {

    $folder_sendEmail = "newsletter";

    $respone = array();

    $send = array();

    $data = $_POST['data'];

    $fullname = htmlspecialchars($func->sanitize($data['fullname']));

    $phone = htmlspecialchars($func->sanitize($data['phone']));

    $email = htmlspecialchars($func->sanitize($data['email']));

    $service = htmlspecialchars($func->sanitize($data['service']));

    $captcha = htmlspecialchars($func->sanitize($data['captcha']));

    $notes = htmlspecialchars($func->sanitize($data['notes']));


    if (empty($captcha) && isset($captcha)) {
        $func->transfer('Captcha không được để trống!', $_SERVER['HTTP_REFERER']);
    }
    if ($_SESSION['captcha_price_quote'] != $captcha) {
        $func->transfer('Captcha không đúng!', $_SERVER['HTTP_REFERER']);
    }
    if (empty($fullname && isset($fullname))) {
        $func->transfer('Họ tên không được để trống!', $_SERVER['HTTP_REFERER']);
    }
    if (empty($phone)  && isset($phone)) {
        $func->transfer('Số điện thoại không được để trống!', $_SERVER['HTTP_REFERER']);
    }
    if (!empty($phone) && !$func->isPhone($phone) && isset($phone)) {
        $func->transfer('Số điện thoại không hợp lệ!', $_SERVER['HTTP_REFERER']);
    }
    if (empty($service) && isset($service)) {
        $func->transfer('Dịch vụ không được để trống!', $_SERVER['HTTP_REFERER']);
    }
    if (empty($email)  && isset($email)) {
        $func->transfer('Email không được để trống!', $_SERVER['HTTP_REFERER']);
    }
    if (!empty($email) && !$func->isEmail($email) && isset($email)) {
        $func->transfer('Email không hợp lệ!', $_SERVER['HTTP_REFERER']);
    }

    if (isset($fullname)) {
        $send['ten_vi'] = $fullname;
    }
    if (isset($email)) {
        $send['email'] = $email;
    }
    if (isset($phone)) {
        $send['dienthoai'] = $phone;
    }
    if (isset($service)) {
        $send['id_dichvu'] = $service;
    }
    if (isset($notes)) {
        $send['noidung'] = $notes;
    }

    $send['ngaytao'] = time();

    $send['type'] = 'client';

    $send['hienthi'] = 1;

    $insertId = $db->insert('booking', $send);

    // if ($insertId) {
    //     $func->transfer('Đăng ký nhận tin thành công', $_SERVER['HTTP_REFERER']);
    // } else {
    //     $func->transfer('Đăng ký nhận tin không thành công', $_SERVER['HTTP_REFERER']);
    // }

    include _source  . 'email.php';
}
