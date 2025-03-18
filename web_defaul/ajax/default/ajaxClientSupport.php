<?php
require_once '../ajaxConfig.php';
if ($func->isAjax()) {
    @$phone = htmlspecialchars($_POST['phone']);
    $checkPhone = $db->rawQueryOne("select id from #_booking where dienthoai=? and type=? limit 0,1", array($phone, 'goi-lai'));
    if (empty($checkPhone)) {
        if (!empty($phone) && $func->isPhone($phone)) {
            $data['dienthoai'] = $phone;
            $data['type'] = 'goi-lai';
            $data['ngaytao'] = time();
            $data['hienthi'] = 1;
            $insert = $db->insert('booking', $data);
            $response['status'] = 200;
            $response['message'] = 'Gửi yêu cầu thành công, cảm ơn bạn đã quan tâm!';
        } else {
            $response['status'] = 400;
            $response['message'] = 'Số điện thoại không hợp lệ!';
        }
    } else {
        $response['status'] = 400;
        $response['message'] = 'Số điện thoại của bạn đã tồn tại trong hệ thống';
    }
    echo json_encode($response);
}
