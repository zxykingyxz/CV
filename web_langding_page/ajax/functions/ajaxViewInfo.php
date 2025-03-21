<?php
require_once '../ajaxConfig.php';

if ($func->isAjax()) {

    @$value = htmlspecialchars($_POST['value']);
    @$form = htmlspecialchars($_POST['form']);
    $max_width = "";
    switch ($form) {
        case 'view_info_introduce':
            $sql = "select ten_$lang as ten,noidung_$lang as noidung,mota_$lang as mota from #_info where id=$value";
            $max_width = " max-w-[1000px] ";
            break;
        case 'view_baiviet':
            $sql = "select ten_$lang as ten,noidung_$lang as noidung,mota_$lang as mota from #_baiviet where id=$value";
            $max_width = " max-w-[1000px] ";
            break;
        default:
            break;
    }

    $info_product = $db->rawQueryOne($sql, array());


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
