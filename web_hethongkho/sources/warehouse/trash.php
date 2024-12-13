<?php
$array_list_trash = [];
$html_table = "";
$where_sql_trash = " date_trash>? and trash=true ";
$orderby_sql_trash = " order by date_trash desc ";

if ($warehouse_func->isAjax()) {
    @$id = htmlspecialchars($_POST['id']);
    @$status = htmlspecialchars($_POST['status']);
    @$table = htmlspecialchars($_POST['table']);
    $info_noitfication = $warehouse_func->delete_data($id, $status, $table);
    $data_ajax = [
        "notification" => $info_noitfication,
    ];
}
foreach ($tables_check_trash as $table => $table_label) {
    $table_data = [];
    $table_data = $db->rawQuery("select id,code,date_trash from table_$table where " . $warehouse_func->getAccountParam()->sql . " and $where_sql_trash $orderby_sql_trash ", array($time_check_trash));
    if (!empty($table_data)) {
        $array_list_trash["$table"]['name'] = $table_label;
        $array_list_trash["$table"]['data'] = $table_data;
    }
}

$html_table = $warehouse_func->getTemplateLayoutsFor([
    'name_layouts' => 'form_table_trash',
    'data' => $array_list_trash,
]);

$html_ajax = [
    "table" => $html_table,
];
