<?php
require_once 'ajaxConfig.php';
if ($func->isAjax()) {
    $response = array();
    $send = array();
    $date = $_POST['date'];
    $dataBooking = $db->rawQuery("select khunggio  from #_booking where type = ? and ngaydatlich = ?", ['register', $date]);
    $arrData = [];
    foreach ($dataBooking as $item) {
        $arrData[] = $item['khunggio'];
    }
    // }else{

    //     $response['status']=203;

    //     $response['error']='error';

    //     $response['message']='Mã xác nhận không chính xác';
    // }

    echo json_encode($arrData);
}
