<?php
require_once '../ajaxConfig.php';

if ($func->isAjax()) {

    @$value = htmlspecialchars($_POST['value']);
    @$form = htmlspecialchars($_POST['form']);
    @$active = htmlspecialchars($_POST['active']);
    $max_width = " max-w-[500px] ";
    $info_product = [];
    $sql = "";
    $response = array();

    switch ($form) {
        case 'views_popup_client':
            $max_width = " max-w-[500px] ";
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
    $response["html"] = $html;
    echo json_encode($response);
    exit;
};
