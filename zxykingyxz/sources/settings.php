<?php
$data_setting = $GLOBAL[$_COM][$_TYPE];

switch ($_TYPE) {
    case 'ngan-sach':
        switch ($_ACT) {
            case 'man':
                $layouts = $source . "/ngansach";
                $data_detail = $func->getDataDetail();
                $data_info_setting = json_decode($data_detail['settings'], true);
                break;
            case 'save':
                $func->saveDataDefault();
                break;
            default:
                $func->redirect($func->getUrlParam([
                    "com" => $_COM,
                    "src" => $_SRC,
                    'type' => $_TYPE,
                    "act" => "man",
                ]));
                break;
        }
        break;
    default:
        $func->redirect($func->getUrlParam([
            "com" => "index",
        ]));
        break;
}
if ($func->isAjax()) {
    echo json_encode([
        'html' => $html,
        'data' => $data
    ]);
    exit;
}
