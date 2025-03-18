<?php

if (!empty($_POST)) {
    $check_send = false;
    $check_send_mail = false;
    $name_captcha = '';

    // kiểm tra nút submit
    if (isset($_POST['submit-resgister-client'])) {
        $check_send_mail = true;
        $type = 'client';
    }

    // kiểm tra dữ liệu
    if ($check_send_mail || $check_send) {
        $respone = array();
        $send = array();

        if (isset($_POST['data'])) {
            $data = $_POST['data'];
        } else {
            $func->transfer('Dữ liệu không hợp lệ!', $_SERVER['HTTP_REFERER']);
            exit;
        }

        $send['ngaytao'] = time();
        $send['hienthi'] = 1;

        switch ($type) {
            case 'client':
                $folder_sendEmail = "newsletter";
                $send['type'] = 'client';
                break;
            default:
                $func->transfer('Loại form không được hỗ trợ!', $_SERVER['HTTP_REFERER']);
                exit;
        }

        foreach ($data as $key => $value) {
            $value_handled = htmlspecialchars($func->sanitize($value));
            switch ($key) {
                case 'captcha':
                    if (empty($value_handled)) {
                        $func->transfer('Captcha không được để trống!', $_SERVER['HTTP_REFERER']);
                        exit;
                    }
                    if ($_SESSION[$name_captcha] != $value_handled) {
                        $func->transfer('Captcha không đúng!', $_SERVER['HTTP_REFERER']);
                        exit;
                    }
                    break;
                case 'fullname':
                    if (empty($value_handled)) {
                        $func->transfer('Họ tên không được để trống!', $_SERVER['HTTP_REFERER']);
                        exit;
                    }
                    $send['ten_vi'] = $value_handled;
                    break;
                case 'phone':
                    if (empty($value_handled)) {
                        $func->transfer('Số điện thoại không được để trống!', $_SERVER['HTTP_REFERER']);
                        exit;
                    }
                    if (!empty($value_handled) && !$func->isPhone($value_handled)) {
                        $func->transfer('Số điện thoại không hợp lệ!', $_SERVER['HTTP_REFERER']);
                        exit;
                    }
                    $send['dienthoai'] = $value_handled;
                    break;
                case 'email':
                    if (empty($value_handled)) {
                        $func->transfer('Email không được để trống!', $_SERVER['HTTP_REFERER']);
                        exit;
                    }
                    if (!empty($value_handled) && !$func->isEmail($value_handled)) {
                        $func->transfer('Email không hợp lệ!', $_SERVER['HTTP_REFERER']);
                        exit;
                    }
                    $send['email'] = $value_handled;
                    break;
                case 'address':
                    if (empty($value_handled)) {
                        $func->transfer('Địa chỉ không được để trống!', $_SERVER['HTTP_REFERER']);
                        exit;
                    }
                    $send['diachi'] = $value_handled;
                    break;
                case 'service':
                    if (empty($value_handled)) {
                        $func->transfer('Dịch vụ không được để trống!', $_SERVER['HTTP_REFERER']);
                        exit;
                    }
                    $send['id_dichvu'] = $value_handled;
                    break;
                case 'product':
                    if (empty($value_handled)) {
                        $func->transfer('Sản phẩm không được để trống!', $_SERVER['HTTP_REFERER']);
                        exit;
                    }
                    $send['id_product'] = $value_handled;
                    break;
                case 'notes':
                    $send['noidung'] = $value_handled;
                    break;
                default:
                    break;
            }
        }

        $insertId = $db->insert('booking', $send);
        if (!$insertId) {
            error_log("Failed to insert booking: " . json_encode($send));
            $func->transfer('Lỗi hệ thống! Vui lòng thử lại.', $_SERVER['HTTP_REFERER']);
            exit;
        }

        if ($check_send_mail) {
            include _source . 'email.php';
        } else {
            $func->transfer('Đăng ký nhận tin thành công!', $_SERVER['HTTP_REFERER']);
            exit;
        }
    }
}
