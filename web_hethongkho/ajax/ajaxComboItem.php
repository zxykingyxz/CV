<?php
require_once 'ajaxConfig.php';
if ($func->isAjax()) {

    // flash sale
    $current_time = time();
    $flash_sale = $db->rawQueryOne("select id,id_product, time_start, time_end from #_flashsale where hienthi=1 and time_start<={$current_time} and time_end>={$current_time} limit 1", array());

    $id_product = isset($_POST['id_product']) ? addslashes($_POST['id_product']) : '';
    $id_product_old = isset($_POST['id_product_old']) ? addslashes($_POST['id_product_old']) : '';
    $id_list = isset($_POST['id_list']) ? addslashes($_POST['id_list']) : '';
    $price = isset($_POST['price']) ? addslashes($_POST['price']) : 0;
    $src = isset($_POST['src']) ? addslashes($_POST['src']) : '';
    $sql = "SELECT *,tenkhongdau_$lang as tenkhongdau from #_baiviet where type=? and id=? order by stt asc ";
    $row_detail = $db->rawQueryOne($sql, array('san-pham', $id_product));
    $row_detail_old = $db->rawQueryOne($sql, array('san-pham', $id_product_old));
    $additional = (!empty($row_detail['id']) && !empty($flash_sale['id_product']) && in_array($row_detail['id'], explode(',', $flash_sale['id_product']))) ? 1 : 0;
    $additional_old = (!empty($row_detail_old['id']) && !empty($flash_sale['id_product']) && in_array($row_detail_old['id'], explode(',', $flash_sale['id_product']))) ? 1 : 0;
    $response = [];


    // var_dump($additional);

    switch ($src) {

        case 'add':
            // var_dump($additional);

            $response['id_list'] = $row_detail['id_list'];
            $response['id'] = $row_detail['id'];
            $response['ten'] = $row_detail["ten_$lang"];
            $response['img'] = 'upload/baiviet/' . $row_detail['photo'];
            $response['url'] = $func->getUrl($row_detail);
            if ($id_product_old != '') {
                $price_old = $additional_old == 1 ? $row_detail_old['giabansale'] : ($row_detail_old['giaban'] != 0 ? $row_detail_old['giaban'] : $row_detail_old['giacu']);
                $price = $price - $price_old;
            }
            $price_show = $additional == 1 ? $row_detail['giabansale'] : ($row_detail['giaban'] != 0 ? $row_detail['giaban'] : $row_detail['giacu']);
            $response['price'] = $func->changeMoney($price + $price_show, '');
            break;
        case 'delete':
            $response['id_list'] = $row_detail['id_list'];
            $response['ten'] = 'Lựa chọn thiết bị';
            $response['img'] = 'assets/images/noimage1.png';
            $response['url'] = 'javascript:void(0)';
            $price_show = $additional == 1 ? $row_detail['giabansale'] : ($row_detail['giaban'] != 0 ? $row_detail['giaban'] : $row_detail['giacu']);
            // var_dump($price_show);
            // var_dump($additional);

            $response['price'] = $func->changeMoney($price - $price_show, '');
            // var_dump($price_show);
            break;
        default:
            break;
    }
}

echo json_encode($response);
