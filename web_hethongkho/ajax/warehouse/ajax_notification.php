<?php
require_once '../ajaxConfig.php';
require_once _lib . "warehouse/warehouse_function.php";
$warehouse_func = new warehouse_function();


if ($warehouse_func->isAjax()) {
    @$status = htmlspecialchars($_POST['status']);
    @$messenger = htmlspecialchars($_POST['messenger']);

    $status_load['status'] = $status;
    $status_load['messenger'] = $messenger;

    if (!empty($status_load)) {
        $html =  $warehouse_func->getTemplateLayoutsFor([
            'name_layouts' => 'form_notification_status',
            'status_notification' => $status_load,
        ]);
    }

    $response['html'] = $html;
    echo json_encode($response);
}
