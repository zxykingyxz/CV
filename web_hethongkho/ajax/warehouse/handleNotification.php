<?php

use PhpOffice\PhpSpreadsheet\Calculation\Information\Value;

require_once '../ajaxConfig.php';
require_once _lib . "warehouse/warehouse_function.php";
$warehouse_func = new warehouse_function();
require_once _source . "warehouse/data.php";

if ($warehouse_func->isAjax()) {
    @$id = htmlspecialchars($_POST['id']);
    $db->rawQueryOne("update table_$name_table_warehouse_notification set viewed=2 where " . $warehouse_func->getAccountParam()->sql . " and id=? ", array($id));
    $total_notification = $db->rawQueryOne("select COUNT(id) as total from #_$name_table_warehouse_notification where " . $warehouse_func->getAccountParam()->sql . " and viewed=1", array());
    $icons_99 = "";
    if (!empty($total_notification)) {
        if ($total_notification['total'] > 99) {
            $quantity_notification = 99;
            $icons_99 = "+";
        } else {
            $quantity_notification = $total_notification['total'];
        }
    } else {
        $quantity_notification = 0;
    }

    $return['status'] = 200;
    $return['quantity'] = $quantity_notification . $icons_99;
};
echo json_encode($return);
exit;
