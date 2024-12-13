<?php
require_once '../ajaxConfig.php';
require_once _lib . "warehouse/warehouse_function.php";
$warehouse_func = new warehouse_function();
require_once _lib . "warehouse/warehouse_url.php";
include_once _source . "warehouse/data.php";

if ($warehouse_func->isAjax()) {
    $_SESSION[$sessison_account_warehouse] = [];
    $res['url'] = $url_login_form;
}
echo json_encode($res);
