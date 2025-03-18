<?php
$data_setting = $GLOBAL[$_COM][$_TYPE];

$link_man = $func->getUrlParam([
    "com" => $_COM,
    "src" => $_SRC,
    "src" => $_TYPE,
    "act" => "man",
]);

switch ($_ACT) {
    case 'man':
        $layouts = $source . "/" . $_TYPE . "/list";
        $data_list = $func->getDataList();
        $data_table = $data_list->data;
        $html_tablebody = $sample->getTemplateLayoutsFor([
            'name_layouts' => 'items_' . $_TYPE,
            'data' => $data_table,
            'padding_td_table_default' => $padding_td_table_default,
            'startpoint' => $data_list->startpoint,
        ]);
        $html_pagging = $sample->getTemplateLayoutsFor([
            'name_layouts' => 'paging_detail',
            'total' => $data_list->total,
            'page' => !empty($array_param_value['page']) ? (int)$array_param_value['page'] : 1,
            'per_page' => $config['website']['page'],
        ]);
        $html = [
            "tablebody" => $html_tablebody,
            "pagging" => $html_pagging,
        ];
        $data = [
            "total" => $data_list->total,
            "startpoint" => $data_list->startpoint,
        ];
        break;
    case 'add':
        $layouts = $source . "/" . $_TYPE . "/detail";
        break;
    case 'edit':
        $layouts = $source . "/" . $_TYPE . "/detail";
        $data_detail = $func->getDataDetail();
        if (empty($data_detail)) {
            $func->redirect($link_man);
        }
        break;
    case 'delete':
        $func->deleteDataDefault();
        break;
    case 'save':
        $func->saveDataDefault();
        break;
    default:
        $func->redirect($link_man);
        break;
}

if ($func->isAjax()) {
    echo json_encode([
        'html' => $html,
        'data' => $data
    ]);
    exit;
}
