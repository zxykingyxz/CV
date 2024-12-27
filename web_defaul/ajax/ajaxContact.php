<?php
require_once 'ajaxConfig.php';
if ($func->isAjax()) {
    $response = array();
    $send = array();
    $data = $_POST['data'];
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
            'required' => 'Vui lòng chọn chuyên viên tư vấn',
        ],

    ];
    $error_popup = $validate->validate($arr, $rules, $config['csrf']);

    foreach ($error_popup as $key => $value) {
        $messageError = $value;
        break;
    }

    if (!empty($error_popup)) {
        $response['status'] = 201;

        $response['error'] = 'error';

        $response['message'] = $messageError . " !!!";
    } else {



        $send['ngaytao'] = time();

        $send['hienthi'] = 1;

        foreach ($data as $key => $value) {
            $send[$key] = htmlspecialchars($func->sanitize($value));
        }
        // $send['ngayvao'] = strtotime($data['ngayvao']);

        // $send['ngayra'] = strtotime($data['ngayra']);
        $insert = $db->insert('booking', $send);

        if ($insert) {
            $titleSubject = 'Khách khàng ' . $data["ten_vi"] . ' Đăng Ký Hợp Tác Kinh Doanh';
            /* Gán giá trị gửi email */
            $strThongtin = '';
            $classEmail->setEmail('tennguoigui', $data["ten_vi"]);
            $classEmail->setEmail('emailnguoigui', $data['email']);
            $classEmail->setEmail('dienthoainguoigui', $data['dienthoai']);
            $classEmail->setEmail('diachinguoigui', $data['diachi']);
            $classEmail->setEmail('tieudelienhe', $titleSubject);
            $classEmail->setEmail('noidunglienhe', $data['noidung']);
            if ($classEmail->getEmail('tennguoigui')) {
                $strThongtin .= '<span style="text-transform:capitalize">' . $classEmail->getEmail('tennguoigui') . '</span><br>';
            }
            if ($classEmail->getEmail('emailnguoigui')) {
                $strThongtin .= '<a href="mailto:' . $classEmail->getEmail('emailnguoigui') . '" target="_blank">' . $classEmail->getEmail('emailnguoigui') . '</a><br>';
            }
            // if ($classEmail->getEmail('diachinguoigui')) {
            //     $strThongtin .= '' . $classEmail->getEmail('diachinguoigui') . '<br>';
            // }
            if ($classEmail->getEmail('dienthoainguoigui')) {
                $strThongtin .= 'Tel: ' . $classEmail->getEmail('dienthoainguoigui') . '';
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
            $subject = "Thư liên hệ từ " . $row_setting['name_' . $lang];
            $message = str_replace($emailVars, $emailVals, $classEmail->markdown('contact/admin'));
            $file = '';

            if ($classEmail->sendEmail("admin", $arrayEmail, $subject, $message, $file)) {
                /* Send email customer */
                $arrayEmail = array(
                    "dataEmail" => array(
                        "name" => $classEmail->getEmail('tennguoigui'),
                        "email" => $row_setting['email']
                    )
                );
                $subject = "Thư liên hệ từ " . $row_setting['name_' . $lang];
                $message = str_replace($emailVars, $emailVals, $classEmail->markdown('contact/admin'));
                $file = '';

                if ($classEmail->sendEmail("customer", $arrayEmail, $subject, $message, $file)) {
                    $response['status'] = 200;

                    $response['error'] = 'success';

                    $response['message'] = _thongbaothanhcong;
                };
            } else {
                $response['status'] = 201;

                $response['error'] = 'error';

                $response['message'] = _thongbaothatbai;
            };
        } else {

            $response['status'] = 201;

            $response['error'] = 'error';

            $response['message'] = _thongbaothatbai;
        }
    }

    // }else{

    //     $response['status']=203;

    //     $response['error']='error';

    //     $response['message']='Mã xác nhận không chính xác';
    // }

    echo json_encode($response);
}
