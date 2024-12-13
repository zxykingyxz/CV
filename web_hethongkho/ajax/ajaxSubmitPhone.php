<?php
require_once 'ajaxConfig.php';
if ($func->isAjax()) {
    $response = array();
    $send = array();
    $data = $_POST['data'];
    foreach ($data as $key => $value) {
        $$key = htmlspecialchars($func->sanitize($value));
    }
    $arr = [
        'dienthoai' => 'required|phone',
    ];

    $rules = [
        'dienthoai' => [
            'required' => 'Vui lòng nhập số điện thoại',
            'phone' => 'Vui lòng nhập đúng định dạng số điện thoại',
        ],
    ];
    $error_popup = $validate->validate($arr, $rules, $config['csrf']);

    foreach ($error_popup as $key => $value) {
        $messageError = $value;
        break;
    }

    $checkPhone = $db->rawQueryOne("select id from #_booking where dienthoai=? and type=? limit 0,1", array($phone, 'contact'));
    if (!empty($error_popup)) {
        $response['status'] = 201;

        $response['error'] = 'error';

        $response['message'] = $messageError . " !!!";
    } else {

        if ($checkPhone) {

            $response['status'] = 201;

            $response['error'] = 'error';

            $response['message'] = 'Số điện thoại của bạn đã tồn tại trong hệ thống !!!';
        } else {

            $send['type'] = 'register';

            $send['ngaytao'] = time();

            $send['hienthi'] = 1;

            foreach ($data as $key => $value) {
                $send[$key] = $$key;
            }

            $insert = $db->insert('booking', $send);

            if ($insert) {
                $titleSubject = 'Số Điện Thoại Đăng Ký Nhận Thông Tin Tư Vấn';
                /* Gán giá trị gửi email */
                $strThongtin = '';
                $classEmail->setEmail('tennguoigui', $data["ten_vi"]);
                $classEmail->setEmail('emailnguoigui', $data['email']);
                $classEmail->setEmail('dienthoainguoigui', $data['dienthoai']);
                $classEmail->setEmail('diachinguoigui', $data['diachi']);
                $classEmail->setEmail('tieudelienhe', $titleSubject);
                $classEmail->setEmail('noidunglienhe', $data['noidung']);
                if ($classEmail->getEmail('tennguoigui')) {
                    $strThongtin .= 'Họ và Tên: <span style="text-transform:capitalize">' . $classEmail->getEmail('tennguoigui') . '</span><br>';
                }
                if ($classEmail->getEmail('emailnguoigui')) {
                    $strThongtin .= 'Email: <a href="mailto:' . $classEmail->getEmail('emailnguoigui') . '" target="_blank">' . $classEmail->getEmail('emailnguoigui') . '</a><br>';
                }
                if ($classEmail->getEmail('diachinguoigui')) {
                    $strThongtin .= 'Địa chỉ: ' . $classEmail->getEmail('diachinguoigui') . '<br>';
                }
                if ($classEmail->getEmail('dienthoainguoigui')) {
                    $strThongtin .= 'Số điện thoại: ' . $classEmail->getEmail('dienthoainguoigui') . '';
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
                $subject = $titleSubject;
                $message = str_replace($emailVars, $emailVals, $classEmail->markdown('phone/admin'));
                $file = '';

                if ($classEmail->sendEmail("admin", $arrayEmail, $subject, $message, $file)) {
                    /* Send email customer */
                    if (!empty($data['email'])) {
                        $arrayEmail = array(
                            "dataEmail" => array(
                                "name" => $classEmail->getEmail('tennguoigui'),
                                "email" => $data['email'],
                            )
                        );
                        $subject = "Thư liên hệ từ " . $row_setting['name_' . $lang];
                        $message = str_replace($emailVars, $emailVals, $classEmail->markdown('phone/admin'));
                        $file = '';
                        if ($classEmail->sendEmail("customer", $arrayEmail, $subject, $message, $file)) {
                            $response['status'] = 200;

                            $response['error'] = 'success';

                            $response['message'] = "Đăng ký thành công ! Cảm ơn bạn đã quan tâm";
                        };
                    } else {
                        $response['status'] = 200;

                        $response['error'] = 'success';

                        $response['message'] = "Đăng ký thành công ! Cảm ơn bạn đã quan tâm";
                    }
                } else {
                    $response['status'] = 201;

                    $response['error'] = 'error';

                    $response['message'] = 'Hệ thống lỗi đăng ký không thành công !!!!';
                };
            } else {

                $response['status'] = 201;

                $response['error'] = 'error';

                $response['message'] = 'Hệ thống lỗi đăng ký không thành công !!!!';
            }
        }
    }

    // }else{

    //     $response['status']=203;

    //     $response['error']='error';

    //     $response['message']='Mã xác nhận không chính xác';
    // }

    echo json_encode($response);
}
