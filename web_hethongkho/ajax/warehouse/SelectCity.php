<?php
require_once '../ajaxConfig.php';
require_once _lib . "warehouse/warehouse_function.php";
$warehouse_func = new warehouse_function();
require_once _lib . "warehouse/warehouse_url.php";
include_once _source . "warehouse/data.php";

if ($warehouse_func->isAjax()) {
    @$id = htmlspecialchars($_POST['id']);
    $list_dist = $db->rawQuery("select name_$lang as name, id from #_place_dists where id_city=? ", array($id));
    $html = $warehouse_func->getTemplateLayoutsFor([
        'name_layouts' => 'select_warehouse',
        'class_form' => 'w-full',
        'lable' => 'Quận/Huyện',
        'placeholder' => 'Chọn Quận/Huyện',
        'data' => 'district',
        'data_option' => $list_dist,
        'name_col_view' => 'name',
        'name_col_value' => 'id',
        'save_cache' => false,
        'required' => true,
    ]);
    $response['html'] = $html;

    echo json_encode($response);
}
