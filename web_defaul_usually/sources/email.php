<?php

/* Gán giá trị gửi email */
$strThongtin = '';
if (!empty($data['fullname'])) {
    $classEmail->setEmail('tennguoigui', $data['fullname']);
}
if (!empty($data['email'])) {
    $classEmail->setEmail('emailnguoigui', $data['email']);
}
if (!empty($data['phone'])) {
    $classEmail->setEmail('dienthoainguoigui', $data['phone']);
}
if (!empty($data['address'])) {
    $classEmail->setEmail('diachinguoigui', $data['address']);
}
if (!empty($data['service'])) {
    $info_service = $db->rawQueryOne("select  ten_$lang as ten  from #_baiviet where type=? and hienthi=1 and id=? order by stt asc", array('dich-vu', $data['service']));
    $classEmail->setEmail('dichvudachon',  $info_service['ten']);
}
if (!empty($data['product'])) {
    $info_product = $db->rawQueryOne("select  ten_$lang as ten  from #_baiviet where type=? and hienthi=1 and id=? order by stt asc", array('san-pham', $data['product']));
    $classEmail->setEmail('sanphamdachon',  $info_product['ten']);
}
if (!empty($data['time'])) {
    $classEmail->setEmail('thoigiandachon',  $data['time']);
}
if (!empty($data['notes'])) {
    $classEmail->setEmail('noidunglienhe', 'Nội dung liên hệ: ' . $data['notes']);
}
$classEmail->setEmail('tieudelienhe', 'Liên hệ từ website');

if ($classEmail->getEmail('tennguoigui')) {
    $strThongtin .= 'Tên khách hàng: ' . '<span style="text-transform:capitalize">' . $classEmail->getEmail('tennguoigui') . '</span><br>';
}
if ($classEmail->getEmail('emailnguoigui')) {
    $strThongtin .= 'Email khách hàng: ' . ' <a href="mailto:' . $classEmail->getEmail('emailnguoigui') . '" target="_blank">' . $classEmail->getEmail('emailnguoigui') . '</a><br>';
}
if ($classEmail->getEmail('diachinguoigui')) {
    $strThongtin .= 'Địa chỉ khách hàng: ' . $classEmail->getEmail('diachinguoigui') . '<br>';
}
if ($classEmail->getEmail('dichvudachon')) {
    $strThongtin .= 'Dịch vụ đã chọn: ' . $classEmail->getEmail('dichvudachon') . '<br>';
}
if ($classEmail->getEmail('sanphamdachon')) {
    $strThongtin .= 'Sản phẩm đã chọn: ' . $classEmail->getEmail('sanphamdachon') . '<br>';
}
if ($classEmail->getEmail('thoigiandachon')) {
    $strThongtin .= 'Thời gian đã chọn: ' . $classEmail->getEmail('thoigiandachon') . '<br>';
}
if ($classEmail->getEmail('dienthoainguoigui')) {
    $strThongtin .= 'Số điện thoại khách hàng: ' . $classEmail->getEmail('dienthoainguoigui')  . '<br>';
}
$classEmail->setEmail('thongtin', $strThongtin);

/* Defaults attributes email */
$emailDefaultAttrs = $classEmail->defaultAttrs();

/* Variables email */
$emailVars = array(
    '{emailTitleSender}',
    '{emailInfoSender}',
    '{emailSubjectSender}',
    '{emailContentSender}'
);
$emailVars = $classEmail->addAttrs($emailVars, $emailDefaultAttrs['vars']);

/* Values email */
$emailVals = array(
    $classEmail->getEmail('tennguoigui'),
    $classEmail->getEmail('thongtin'),
    $classEmail->getEmail('tieudelienhe'),
    $classEmail->getEmail('noidunglienhe')
);
$emailVals = $classEmail->addAttrs($emailVals, $emailDefaultAttrs['vals']);

/* Send email admin */

$arrayEmail = null;
if (!empty($row_setting['website']) && isset($row_setting['website'])) {
    $subject = "Thư liên hệ từ khách hàng của " .  $row_setting['website'];
} else {
    $subject = "Thư liên hệ từ khách hàng trên web";
}
$message = str_replace($emailVars, $emailVals, $classEmail->markdown($folder_sendEmail . '/admin'));
$file = '';


if ($classEmail->sendEmail("admin", $arrayEmail, $subject, $message, $file)) {

    if (!empty($data['email'])) {
        /* Send email customer */
        $arrayEmail = array(
            "dataEmail" => array(
                "name" => $classEmail->getEmail('tennguoigui'),
                "email" => $classEmail->getEmail('emailnguoigui')
            )
        );
        if (!empty($row_setting['website']) && isset($row_setting['website'])) {
            $subject = "Thư liên hệ từ " . $row_setting['website'];
        } else {
            $subject = "Thư liên hệ từ web";
        }
        $message = str_replace($emailVars, $emailVals, $classEmail->markdown($folder_sendEmail . '/customer'));
        $file = '';

        if ($classEmail->sendEmail("customer", $arrayEmail, $subject, $message, $file)) {
            $func->transfer("Đăng ký nhận tin thành công", $_SERVER['HTTP_REFERER']);
        }
    } else {
        $func->transfer("Đăng ký nhận tin thành công", $_SERVER['HTTP_REFERER']);
    }
} else $func->transfer("Đăng ký nhận tin thất bại. Vui lòng thử lại sau", $_SERVER['HTTP_REFERER'], false);
