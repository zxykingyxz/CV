<?php
require_once '../ajaxConfig.php';
require_once _lib . "warehouse/warehouse_function.php";
$warehouse_func = new warehouse_function();
include_once _source . "warehouse/data.php";

if ($warehouse_func->isAjax()) {
    @$id = htmlspecialchars($_POST['id']);
    @$status = htmlspecialchars($_POST['status']);
    @$table = htmlspecialchars($_POST['table']);

    $response = $warehouse_func->delete_data($id, $status, $table);

    echo json_encode($response);
}
