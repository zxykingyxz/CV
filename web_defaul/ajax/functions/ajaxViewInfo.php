<?php
require_once '../ajaxConfig.php';

if ($func->isAjax()) {

    @$value = htmlspecialchars($_POST['value']);
    @$form = htmlspecialchars($_POST['form']);
    @$active = htmlspecialchars($_POST['active']);
    $max_width = " max-w-[500px] ";
    $info_product = [];
    $sql = "";
    switch ($form) {
        case 'view_info_product':
            $sql = "select id,type,video,link,giaban,giacu,ten_$lang as ten,photo,tenkhongdau_$lang as tenkhongdau,thongsokythuat_$lang as thongsokythuat from #_baiviet where id=$value order by stt asc ";
            $max_width = " max-w-[1000px] ";
            break;
        case 'view_info_pay':
            $sql = "select id,type,ten_$lang as ten,mota_$lang as mota from #_photo where id=$value order by stt asc ";
            $max_width = " max-w-[500px] ";
            break;
        case 'view_product_detail':
            $sql = "select id,type,video,link,ten_$lang as ten,photo,tenkhongdau_$lang as tenkhongdau,thongsokythuat_$lang as thongsokythuat,mota_$lang as mota from #_baiviet where id=$value order by stt asc ";
            $max_width = " max-w-[1200px] ";
            break;
        default:
            break;
    }

    if (!empty($sql)) {
        $info_product = $db->rawQueryOne($sql, array());
    }
    $html = $sample->getTemplateLayoutsFor([
        'name_layouts' => 'form_popup',
        'data' => $info_product,
        'class_form' => $max_width,
        'check_form' => $form,
        'active' => $active,
        'class_form_js' => "form_popup",
        'class_close_form_js' => "close_form_popup",
        'save_cache' => false,
    ]);
    $response = array();
    $response["html"] = $html;
    echo json_encode($response);
    exit;
};
