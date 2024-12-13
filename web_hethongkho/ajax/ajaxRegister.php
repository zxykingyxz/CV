<?php
require_once 'ajaxConfig.php';
if ($func->isAjax()) {
    $response = array();
    $send = array();
    $data = $_POST['data'];
    if (isset($_POST['capcha'])) {
        $capcha = $_POST['capcha'];
    }
    $arr = [];
    if (isset($data['ten_vi'])) {
        $arr['ten_vi'] = 'required';
    }
    if (isset($data['dienthoai'])) {
        $arr['dienthoai'] = 'required|phone';
    }
    if (isset($data['email'])) {
        $arr['email'] = 'required|email';
    }
    if (isset($data['thoigianhen'])) {
        $arr['thoigianhen'] = 'required';
    }
    if (isset($data['nguoituvan'])) {
        $arr['nguoituvan'] = 'required';
    }
    if (isset($data['id_dichvu'])) {
        $arr['id_dichvu'] = 'required';
    }
    if (isset($data['diachi'])) {
        $arr['diachi'] = 'required';
    }

    $rules = [
        'ten_vi' => [
            'required' => 'Vui lòng nhập họ tên',
        ],
        'email' => [
            'required' => 'Vui lòng nhập email',
            'email' => 'Vui lòng nhập đúng định dạng email',
        ],
        'dienthoai' => [
            'required' => 'Vui lòng nhập số điện thoại',
            'phone' => 'Vui lòng nhập đúng định dạng số điện thoại',
        ],
        'id_dichvu' => [
            'required' => 'Vui lòng chọn dịch vụ hỗ trợ',
        ],
        'thoigianhen' => [
            'required' => 'Vui lòng chọn thời gian hẹn',
        ],
        'nguoituvan' => [
            'required' => 'Vui lòng chọn chuyên viên',
        ],

    ];
    $error_popup = $validate->validate($arr, $rules, $config['csrf']);
    if (isset($_POST['capcha']) && $capcha != $_SESSION['captcha_code']) {
        $error_popup['error_capcha'] = "Mã capcha không hợp lệ";
    }
    foreach ($error_popup as $key => $value) {
        $messageError = $value;
        break;
    }

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

            $send['ngaytao'] = time();

            $send['hienthi'] = 1;

            foreach ($data as $key => $value) {
                if ($key != 'is_checked') {
                    $send[$key] = htmlspecialchars($func->sanitize($value));
                }
            }

            $insert = $db->insert('booking', $send);

            if ($insert) {
                $titleSubject = 'Khách khàng ' . $data["ten_vi"] . ' đăng ký tư vấn';
                /* Gán giá trị gửi email */
                $strThongtin = '';
                $classEmail->setEmail('tennguoigui', $data["ten_vi"]);
                $classEmail->setEmail('emailnguoigui', $data['email']);
                $classEmail->setEmail('dienthoainguoigui', $data['dienthoai']);
                $classEmail->setEmail('diachinguoigui', $data['diachi']);
                $classEmail->setEmail('tieudelienhe', $titleSubject);
                $classEmail->setEmail('noidunglienhe', $data['noidung']);
                if ($classEmail->getEmail('tennguoigui')) {
                    $strThongtin .= 'Họ và tên: <span style="text-transform:capitalize">' . $classEmail->getEmail('tennguoigui') . '</span><br>';
                }
                if ($classEmail->getEmail('emailnguoigui')) {
                    $strThongtin .= 'Email: <a href="mailto:' . $classEmail->getEmail('emailnguoigui') . '" target="_blank">' . $classEmail->getEmail('emailnguoigui') . '</a><br>';
                }
                if ($classEmail->getEmail('diachinguoigui')) {
                    $strThongtin .= 'Địa chỉ: ' . $classEmail->getEmail('diachinguoigui') . '<br>';
                }
                if (!empty($data["id_dichvu"])) {
                    $service = $db->rawQueryOne("select ten_$lang as ten from #_baiviet where id = ? and type = ?", [$data["id_dichvu"], 'dich-vu']);
                    $strThongtin .= 'Loại dịch vụ: ' . $service['ten'] . '<br>';
                }
                if (!empty($data["songuoi"])) {
                    $strThongtin .= 'Số người: ' . $data["songuoi"] . '<br>';
                }
                if (!empty($data["id_mxh"])) {
                    $mxh = $db->rawQueryOne("select ten_$lang as ten from #_photo where id = ? and type = ?", [$data["id_mxh"], 'mangxahoi']);
                    $strThongtin .= 'Biết đến qua: ' . $mxh['ten'] . '<br>';
                }
                if (!empty($data["ngaydatlich"])) {
                    $strThongtin .= 'Ngày đặt lịch: ' . $data["ngaydatlich"] . '<br>';
                }
                if ($classEmail->getEmail('dienthoainguoigui')) {
                    $strThongtin .= 'Số điện thoại: ' . $classEmail->getEmail('dienthoainguoigui') . '<br>';
                }
                if (!empty($data["question1"])) {
                    $strThongtin .= 'Câu trả lời 1: ' . $data["question1"] . '<br>';
                }
                if (!empty($data["question2"])) {
                    $strThongtin .= 'Câu trả lời 2: ' . $data["question2"] . '<br>';
                }
                if (!empty($data["question3"])) {
                    $strThongtin .= 'Câu trả lời 3: ' . $data["question3"] . '<br>';
                }
                if (!empty($data["question4"])) {
                    $strThongtin .= 'Câu trả lời 4: ' . $data["question4"] . '<br>';
                }
                if (!empty($data["question5"])) {
                    $strThongtin .= 'Câu trả lời 5: ' . $data["question5"] . '<br>';
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
                $message = str_replace($emailVars, $emailVals, $classEmail->markdown('register/admin'));
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
                        $message = str_replace($emailVars, $emailVals, $classEmail->markdown('register/customer'));
                        $file = '';

                        if ($classEmail->sendEmail("customer", $arrayEmail, $subject, $message, $file)) {
                            $response['status'] = 200;

                            $response['error'] = 'success';

                            $response['message'] = "Đăng ký tư vấn thành công. Cảm ơn bạn đã quan tâm!";
                        };
                    }

                    $response['status'] = 200;

                    $response['error'] = 'success';

                    $response['message'] = "Đăng ký tư vấn thành công. Cảm ơn bạn đã quan tâm!";
                } else {
                    $response['status'] = 201;

                    $response['error'] = 'error';

                    $response['message'] = 'Hệ thống lỗi đăng ký tư vấn không thành công !!!!';
                };
            } else {

                $response['status'] = 201;

                $response['error'] = 'error';

                $response['message'] = 'Hệ thống lỗi đăng ký không thành công !!!!';
            }
        }
    }



    echo json_encode($response);
}
