<?php
$data_setting = $GLOBAL[$_COM][$_TYPE];
switch ($_TYPE) {
    case 'ngan-sach':
        $link_man = $func->getUrlParam([
            "com" => $_COM,
            "src" => $_SRC,
            "type" => $_TYPE,
            "act" => "man",
        ]);
        switch ($_ACT) {
            case 'man':
                $layouts = $source . "/ngansachlist";
                $data_list = $func->getDataList();
                $data_table = $data_list->data;
                $html_tablebody = $sample->getTemplateLayoutsFor([
                    'name_layouts' => 'items_' . $_SRC . "_ngansach",
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
            case 'view':
                $layouts = $source . "/ngansachdetail";
                $data_detail = $func->getDataDetail();
                if (empty($data_detail)) {
                    $func->redirect($link_man);
                }
                break;
            default:
                $func->redirect($link_man);
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
