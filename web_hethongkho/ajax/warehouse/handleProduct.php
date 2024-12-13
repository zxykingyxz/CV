<?php
require_once '../ajaxConfig.php';
require_once _lib . "warehouse/warehouse_function.php";
$warehouse_func = new warehouse_function();
require_once _source . "warehouse/data.php";

if ($warehouse_func->isAjax()) {
    @$_SRC = htmlspecialchars($_POST['src']);
    @$_TYPE = htmlspecialchars($_POST['type']);
    @$_ACT = htmlspecialchars($_POST['act']);
    @$form = htmlspecialchars($_POST['form']);
    $sum_price = 0;
    $sum_quantity = 0;

    switch ($form) {
        case 'search':
            @$keywords = htmlspecialchars($_POST['value']);
            if (!empty($keywords)) {
                $where .= " and ";
                $where .= $warehouse_func->getSqlWhereKeywords($keywords);
            }
            break;
        case 'add':
            @$id_add = !empty($_POST['value']) ? htmlspecialchars($_POST['value']) : null;
            @$quantity = !empty($_POST['quantity']) ? htmlspecialchars($_POST['quantity']) : null;
        case 'list':
            @$array_list_product = !empty($_POST['list_product']) ? $_POST['list_product'] : [];
            $array_list_product = array_map(function ($item) {
                return json_decode($item, true);
            }, $array_list_product);
            if (!empty($id_add)) {
                $exists = false;

                foreach ($array_list_product as $key => $value) {
                    if ($value['id'] == $id_add && $value['quantity'] != $quantity) {
                        $array_list_product[$key]['quantity'] = (!empty($quantity)) ? $quantity : 1;
                        $exists = true;
                        break;
                    }
                }
                if (!$exists) {
                    $array_list_product[] = ["id" => $id_add, "quantity" => $quantity];
                }
            }

            if ($_TYPE == "export" && $_SRC == "transaction") {
                foreach ($array_list_product as $key => $value) {
                    $quantity_available = $warehouse_func->getQuantityProductOrdered($value['id']);
                    if ($value['quantity'] > $quantity_available) {
                        $array_list_product[$key]['quantity'] = (!empty($quantity_available)) ? $quantity_available : 1;
                    }
                }
            }
            $list_product = array_column($array_list_product, 'id');

            $id_list = implode(',', $list_product);
            $where .= (!empty($id_list)) ? " and id IN ($id_list) " : " and id IN (0)";

            break;
        default:
            break;
    };
    if ($_SRC == 'transaction') {
        switch ($_TYPE) {
            case 'export':
                $sql = "select id,id_warehouse,id_supplier,code,name,sale_price,capital_price,photo,quantity,calculation_unit from #_$name_table_warehouse_product where " . $warehouse_func->getAccountParam()->sql . " $where and status=1 and quantity>0 and trash<>true";
                break;
            case 'import':
                $sql = "select id,id_warehouse,id_supplier,code,name,sale_price,capital_price,photo,quantity,calculation_unit from #_$name_table_warehouse_product where " . $warehouse_func->getAccountParam()->sql . " $where and status=1 and trash<>true";
                break;
            default:
                break;
        }
    }
    $data_product = $db->rawQuery($sql);

    if (!empty($data_product)) {
        foreach ($data_product as $key => $value) {
            foreach ($array_list_product as $value_check) {
                if ($value_check['id'] == $value['id']) {
                    $quantity = $value_check['quantity'];
                    break;
                }
            }
            if (in_array($_TYPE, ['import'])) {
                $sum_price += (int)$quantity * (int)$value['capital_price'];
            } else {
                $sum_price += (int)$quantity * (int)$value['sale_price'];
            }
            $sum_quantity += (int)$quantity;
        }
        if (($form != "search") || ($form == "search" && !empty($keywords))) {
            $html = $warehouse_func->getTemplateLayoutsFor([
                'name_layouts' => 'form_productList',
                'class_form' => '',
                'data' => $data_product,
                'save_cache' => false,
                'array_list_product' => $array_list_product,
                'form' => $form,
                '_SRC' => $_SRC,
                '_TYPE' => $_TYPE,
                'global' => ['db', 'name_table_warehouse_bill_detail'],
            ]);
        }
    } else {
        $html = '
        <div class="w-full text-sm text-gray-400 bg-white p-3 border border-gray-200 rounded-md">
            <span>
                Không có sản phẩm ...
            </span>
        </div>';
    }

    $return = [
        "html" => [
            "html" => $html,
        ],
        "data" => [
            "sum_price_format" => $warehouse_func->changeMoney($sum_price),
            "sum_price" => $sum_price,
            "total_quanity_format" => $warehouse_func->money($sum_quantity),
            "total_quanity" => $sum_quantity,
        ],
    ];
};
echo json_encode($return);
exit;
