<?php
require_once '../ajaxConfig.php';

if ($func->isAjax() && isset($_POST)) {
    $form = isset($_POST['form']) ? htmlspecialchars($_POST['form']) : '';
    switch ($form) {
        case 'delete_cache':
            $check_delete_cache = $func->deleteFolder($_SERVER["DOCUMENT_ROOT"] . "/cache");
            if ($check_delete_cache) {
                $data = [
                    "status" => 200,
                    "message" => "Xóa cache thành công!",
                ];
            } else {
                $data = [
                    "status" => 201,
                    "message" => "Xóa cache thất bại!",
                ];
            }
            break;
        default:
            echo json_encode([
                'html' => $html,
                'data' => [
                    "status" => 201,
                    "message" => "Dữ liệu không được cấu hình!",
                ]
            ]);
            break;
    }
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
