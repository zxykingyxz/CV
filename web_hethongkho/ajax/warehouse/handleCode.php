<?php
require_once '../ajaxConfig.php';
require_once _lib . "warehouse/warehouse_function.php";
$warehouse_func = new warehouse_function();
require_once _source . "warehouse/data.php";

if ($warehouse_func->isAjax()) {
    @$com = htmlspecialchars($_POST['com']);
    @$_SRC = htmlspecialchars($_POST['src']);
    @$_TYPE = htmlspecialchars($_POST['type']);
    @$_ACT = htmlspecialchars($_POST['act']);
    @$code = (isset($_POST['code'])) ? htmlspecialchars($_POST['code']) : '';
    @$check = (isset($_POST['code'])) ? true : false;

    switch ($com) {
        case 'quan-ly-kho':
            switch ($_SRC) {
                case 'warehouse':
                    $column_table = "code";
                    switch ($_TYPE) {
                        case 'warehouse':
                        case '':
                            $code = ($check == false) ? 'MK' : '';
                            $table = "table_" . $name_table_warehouse_warehouse;
                            break;
                        case 'product':
                            $code = ($check == false) ? 'SP' : '';
                            $table = "table_" . $name_table_warehouse_product;
                            break;
                        default:
                            break;
                    }
                    break;
                case 'partner':
                    $column_table = "code";
                    switch ($_TYPE) {
                        case 'supplier':
                            $code = ($check == false) ? 'NCC' : '';
                            $table = "table_" . $name_table_warehouse_supplier;
                            break;
                        case 'customer':
                            $code = ($check == false) ? 'KH' : '';
                            $table = "table_" . $name_table_warehouse_customer;
                            break;
                        case 'ship':
                            $code = ($check == false) ? 'DVVC' : '';
                            $table = "table_" . $name_table_warehouse_ship;
                            break;
                        default:
                            break;
                    }
                    break;
                case 'transaction':
                    $column_table = "code";
                    switch ($_TYPE) {
                        case 'import':
                            $code = ($check == false) ? 'NK' : '';
                            $table = "table_" . $name_table_warehouse_bill_goods;
                            break;
                        case 'export':
                            $code = ($check == false) ? 'HĐ' : '';
                            $table = "table_" . $name_table_warehouse_bill;
                            break;
                        default:
                            break;
                    }
                    break;
                default:
                    break;
            }
            break;
        default:
            break;
    }

    do {
        if ($check == false) {
            for ($i = 0; $i < 8; $i++) {
                $code .= mt_rand(0, 9);
            }
        }
        $check_code = $db->rawQueryOne("select id FROM $table WHERE " . $warehouse_func->getAccountParam()->sql . " and $column_table = ?", array($code));
        if ($check != false) {
            if (!empty($check_code)) {
                $return = [
                    "data" => [
                        "status" => 201,
                        "mess" => 'Mã đã bị trùng',
                    ],
                ];
            } elseif (strlen($code) < 7) {
                $return = [
                    "data" => [
                        "status" => 201,
                        "mess" => 'Mã quá ngắn',
                    ],
                ];
            } else {
                $return = [
                    "data" => [
                        "status" => 200,
                        "mess" => 'Mã hợp lệ',
                    ],
                ];
            }
            echo json_encode($return);
            exit;
        }
    } while (!empty($check_code));
    $return = [
        "html" => [
            "html" => '',
        ],
        "data" => [
            "code" => $code,
        ],
    ];
};
echo json_encode($return);
exit;
