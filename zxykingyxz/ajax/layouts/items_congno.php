<?php
require_once '../ajaxConfig.php';

if ($func->isAjax() && isset($_POST)) {
    $html = $sample->getTemplateLayoutsFor([
        'name_layouts' => 'items_detail_congno',
        'data' => [""],
    ]);
    $data = [
        "status" => 200,
    ];
    echo json_encode([
        'html' => $html,
        'data' => $data
    ]);
    exit;
} else {
    echo json_encode([
        'html' => $html,
        'data' => [
            "status" => 201,
            "message" => "Dữ liệu không được truyền đi!",
        ]
    ]);
    exit;
}
