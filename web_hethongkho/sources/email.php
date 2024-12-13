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
    $info_lvhd = $db->rawQueryOne("select  ten_$lang as ten  from #_baiviet where type=? and hienthi=1 and id=? order by stt asc", array('linh-vuc-hoat-dong', $data['service']));

    $classEmail->setEmail('dichvudachon',  $info_lvhd['ten']);
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
$subject = "Thư liên hệ từ khách hàng của " . $https_config;
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
        $subject = "Thư liên hệ từ " . $https_config;
        $message = str_replace($emailVars, $emailVals, $classEmail->markdown($folder_sendEmail . '/customer'));
        $file = '';

        if ($classEmail->sendEmail("customer", $arrayEmail, $subject, $message, $file)) {
            $func->transfer("Đăng ký nhận tin thành công", $_SERVER['HTTP_REFERER']);
        }
    } else {
        $func->transfer("Đăng ký nhận tin thành công", $_SERVER['HTTP_REFERER']);
    }
} else $func->transfer("Đăng ký nhận tin thất bại. Vui lòng thử lại sau", $_SERVER['HTTP_REFERER'], false);
