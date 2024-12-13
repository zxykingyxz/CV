<?php
$data_status = $warehouse_func->status_handing_column();

$folder = _upload_baiviet_l;

if (isset($_POST['submit-add-data']) && !empty($_POST)) {

    $id =  (int)$_POST['id'];

    $data = $_POST['data'];

    $photo[0] = $_FILES['photo'];

    if (empty($data['id_customer'])) {
        $customer = $_POST['customer'];
    }
    switch ($_POST['submit-add-data']) {
        case 'save-tmp':
            $data['status'] = 1;
            break;
        case 'save-success':
            $data['status'] = 2;
            break;
        default:
            break;
    }

    $data['id_exporter'] = $_SESSION[$sessison_account_warehouse]['id'];
    $data['status_exporter'] = ($_SESSION[$sessison_account_warehouse]['sub']) ? "sub" : "main";

    $_SESSION[$sessison_status_load] = $warehouse_func->save_data([
        "id" => $id,
        "data" => $data,
        "customer" => $customer,
        "photo" => $photo,
        "folder" =>  $folder,
        "table" => $main_table,
        "sub_table" => $sup_main_table,
    ]);

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}
$list_ship = $db->rawQuery("select id,name,photo from #_$name_table_warehouse_ship where" . $warehouse_func->getAccountParam()->sql . " and trash<>true ", array());

$list_pay = [
    [
        "name" => "Tiền Mặt",
        "value" => 1
    ],
    [
        "name" => "Chuyển Khoản",
        "value" => 2
    ]
];
