<?php
require_once '../ajaxConfig.php';

if ($func->isAjax() && isset($_POST)) {
    $form = isset($_POST['form']) ? htmlspecialchars($_POST['form']) : '';
    switch ($form) {
        case 'fullscreen':
            if (isset($_SESSION['FULLSCREEN']) || empty($_SESSION['FULLSCREEN'])) {
                $_SESSION['FULLSCREEN'] = true;
            } else {
                $_SESSION['FULLSCREEN'] = !$_SESSION['FULLSCREEN'];
            }
            $data = [
                "status" => 200,
                "turnOn" => $_SESSION['FULLSCREEN'],
            ];
            break;
        default:

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
