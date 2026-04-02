<?php
$data_setting = $GLOBAL[$_COM][$_TYPE];

$link_man = $func->getUrlParam([
    "com" => $_COM,
    "src" => $_SRC,
    "type" => $_TYPE,
    "act" => "man",
]);

switch ($_ACT) {
    case 'man':
        $layouts = $source . "/" . $_TYPE . "/list";
        $data_list = $func->getDataList();
        $data_table = $data_list->data;
        foreach ($data_table as $key_table => $value_table) {
            if ($value_table["total_price"] > 0) {
                switch ($value_table['loai']) {
                    case 1:
                        $data_table_one[] = $value_table;
                        break;
                    case 2:
                        $data_table_two[] = $value_table;
                        break;
                    default:
                        break;
                }
            } else {
                $data_table_out[] = $value_table;
            }
        }
        $html_type_one = $sample->getTemplateLayoutsFor([
            'name_layouts' => 'items_' . $_COM . "_" . $_TYPE,
            'data' => $data_table_one,
            'status' => 1,
        ]);
        $html_type_two = $sample->getTemplateLayoutsFor([
            'name_layouts' => 'items_' . $_COM . "_" . $_TYPE,
            'data' => $data_table_two,
            'status' => 2,
        ]);
        $html_type_out = $sample->getTemplateLayoutsFor([
            'name_layouts' => 'items_' . $_COM . "_" . $_TYPE,
            'data' => $data_table_out,
            'status' => 999,
        ]);
        $html = [
            "tablebody" => $html_tablebody,
        ];
        break;
    case 'add':
        $layouts = $source . "/" . $_TYPE . "/detail";
        break;
    case 'edit':
        $layouts = $source . "/" . $_TYPE . "/detail";
        $data_detail = $func->getDataDetail();
        $html_body_detail = $sample->getTemplateLayoutsFor([
            'name_layouts' => 'items_detail_' . $_COM,
            'data' => json_decode($data_detail['items'], true),
        ]);
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
