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
        'email' => 'required|email',
    ];

    $rules = [
        'email' => [
            'required' => 'Vui lòng nhập email',
            'phone' => 'Vui lòng nhập đúng định dạng email',
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

                $response['status'] = 200;

                $response['error'] = 'success';

                $response['message'] = 'Gửi thông tin thành công!!! cảm ơn bạn đã quan tâm';
            } else {

                $response['status'] = 201;

                $response['error'] = 'error';

                $response['message'] = 'Hệ thống lỗi đăng ký không thành công !!!!';
            }

            // $body = '<div style="max-width: 1230px; padding: 0px 15px; box-sizing: border-box; margin: 0 auto;">
            //                     <div style="margin: 0px -10px; display: flex; flex-wrap: wrap;">
            //                         <div style="width: calc(100% / 12 * 12);">
            //                             <table style="width: 100%; border-collapse: collapse;">
            //                                 <thead style="background-color: #ebebeb;">
            //                                     <th style="width: 20%; padding: 12px 15px; text-align: center; font-size: 14px; color: #000;">Họ tên</th>
            //                                     <th style="width: 20%; padding: 12px 15px; text-align: center; font-size: 14px; color: #000;">Điện thoại</th>
            //                                     <th style="width: 20%; padding: 12px 15px; text-align: center; font-size: 14px; color: #000;">Email</th>
            //                                     <th style="width: 20%; padding: 12px 15px; text-align: center; font-size: 14px; color: #000;">Địa chỉ</th>
            //                                     <th style="width: 20%; padding: 12px 15px; text-align: center; font-size: 14px; color: #000;">Nội dung</th>
            //                                 </thead>
            //                                 <tbody>
            //                                     <tr style="border-bottom: 1px solid #ebebeb;">
            //                                         <td style="padding: 12px 15px; text-align: center; font-size: 14px; color: #000; border: 0;">' . $fullname . '</td>
            //                                         <td style="padding: 12px 15px; text-align: center; font-size: 14px; color: #000; border: 0;">' . $phone . '</td>
            //                                         <td style="padding: 12px 15px; text-align: center; font-size: 14px; color: #000; border: 0;">' . $email . '</td>
            //                                         <td style="padding: 12px 15px; text-align: center; font-size: 14px; color: #000; border: 0;">' . $address . '</td>
            //                                         <td style="padding: 12px 15px; text-align: center; font-size: 14px; color: #000; border: 0;">' . $content . '</td>
            //                                     </tr>
            //                                 </tbody>
            //                             </table>
            //                         </div>
            //                     </div>
            //                 </div>';

            // if($func->sendMailAjax($row_setting['email'],'Đăng ký tư vấn từ website',$body,array($row_setting['email'],$email),null,null)){

            //     if($insert){

            //         $response['status']=200;

            //         $response['error']='success';

            //         $response['message']='Đăng ký thành công!!! cảm ơn bạn đã quan tâm';

            //     }else{

            //         $response['status']=201;

            //         $response['error']='error';

            //         $response['message']='Hệ thống lỗi đăng ký không thành công !!!!';

            //     }

            // }

        }
    }

    // }else{

    //     $response['status']=203;

    //     $response['error']='error';

    //     $response['message']='Mã xác nhận không chính xác';
    // }

    echo json_encode($response);
}
