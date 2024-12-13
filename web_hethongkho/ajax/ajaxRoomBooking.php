<?php
require_once 'ajaxConfig.php';
if ($func->isAjax()) {
    $response = array();
    $send = array();
    $room = $_POST['room'];
    $price = $_POST['price'];
    $people = $_POST['people'];
    $data = $_POST['data'];
    foreach ($data as $key => $value) {
        $$key = htmlspecialchars($func->sanitize($value));
    }
    $arr = [
        'ten_vi' => 'required|min-lenght:1',
        'dienthoai' => 'required|phone',
        'email' => 'required|email',
        'ngayvao' => 'required',
        'ngayra' => 'required',
        'songuoi' => 'required|min:1',
        'sophong' => 'required|min:1',
    ];

    $rules = [
        'ten_vi' => [
            'required' => 'Vui lòng nhập họ tên',
            'min-lenght' => 'Họ tên tối thiểu 1 ký tự',
        ],

        'dienthoai' => [
            'required' => 'Vui lòng nhập số điện thoại',
            'phone' => 'Vui lòng nhập đúng định dạng số điện thoại',
        ],
        'email' => [
            'required' => 'Vui lòng nhập email',
            'email' => 'Vui lòng nhập đúng định dạng email',
        ],
        'ngayvao' => [
            'required' => 'Vui lòng nhập ngày vào',
        ],
        'ngayra' => [
            'required' => 'Vui lòng nhập ngày ra',
        ],
        'songuoi' => [
            'required' => 'Vui lòng nhập số người',
            'min' => 'Số người tối thiểu là 1',
        ],
        'sophong' => [
            'required' => 'Vui lòng nhập số phòng',
            'min' => 'Số phòng tối thiểu là 1',
        ],

    ];
    $dataBooking = $db->rawQuery("select * from #_booking where type = ? and id_product=? ", ['dat-phong', $data['id_product']]);
    if (!empty($dataBooking)) {
        $totalRoom = 0;
        foreach ($dataBooking as $k => $v) {
            $totalRoom += $v['sophong'];
        }
    }


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
    } else if ((($totalRoom + $data['sophong'] > $room) || ($totalRoom == $room)) && ($totalRoom != 0)) {

        $phongconlai = $room - $totalRoom;

        $response['status'] = 201;

        $response['error'] = 'error';

        $response['message'] = $phongconlai == 0 ? "Phòng này đã hết" : "Phòng loại này chỉ còn " . $phongconlai . " phòng trống !!!";
    } else {
        if ($room < $data['sophong']) {
            $response['status'] = 201;

            $response['error'] = 'error';

            $response['message'] = "Phòng loại này chỉ còn " . $room . " phòng trống !!!";
        } else if ($checkPhone) {

            $response['status'] = 201;

            $response['error'] = 'error';

            $response['message'] = 'Số điện thoại của bạn đã tồn tại trong hệ thống !!!';
        } else 
            if (($people *  $data['sophong']) < $data['songuoi']) {
            $response['status'] = 201;

            $response['error'] = 'error';

            $response['message'] = 'Tối đa ' . $people . ' người 1 phòng';
        } else {
            foreach ($data as $key => $value) {
                $send[$key] = $$key;
            }

            $send['type'] = 'dat-phong';

            $send['ngaytao'] = time();

            $send['ngayvao'] = strtotime($ngayvao);

            $send['ngayra'] = strtotime($ngayra);

            $send['ngaytao'] = time();

            $send['hienthi'] = 1;

            $insert = $db->insert('booking', $send);

            if ($insert) {

                $response['status'] = 200;

                $response['error'] = 'success';

                $response['price'] = $price;

                $response['people'] = $people;

                $response['message'] = 'Gửi thông tin thành công!!! cảm ơn bạn đã quan tâm';
            } else {

                $response['status'] = 201;

                $response['error'] = 'error';

                $response['message'] = 'Hệ thống lỗi đăng ký không thành công !!!!';
            }
        }
    }


    echo json_encode($response);
}
