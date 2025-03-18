<?php

$sortby = (isset($_GET['sortby'])) ? addslashes($_GET['sortby']) : "";
$id = (isset($_GET['id'])) ? addslashes($_GET['id']) : "";
$ids = (isset($_GET['ids'])) ? addslashes($_GET['ids']) : "";
$idl = (isset($_GET['idl'])) ? addslashes($_GET['idl']) : "";
$idc = (isset($_GET['idc'])) ? addslashes($_GET['idc']) : "";
$idi = (isset($_GET['idi'])) ? addslashes($_GET['idi']) : "";
// param check
$array_param_data = ['keywords', 'status'];

$array_param_value = [];
if (!empty($array_param_data)) {
    foreach ($array_param_data as $value_param) {
        $$value_param = (isset($_REQUEST[$value_param])) ? addslashes($_REQUEST[$value_param]) : "";
        if (!empty($$value_param)) {
            $array_param_value[$value_param] = $$value_param;
        } else {
            unset($$value_param);
        }
    }
}
// sắp xếp
$order_by = $func->getOrderByTypeFor($type);
$order_by_ds = $func->getOrderByTypeFor($type);
// where
$array_option_param = [];

if ($idl != '') {
    $array_option_param[] = " id_list={$idl}";
}
if ($idc != '') {
    $array_option_param[] = " id_cat={$idc}";
}
if ($idi != '') {
    $array_option_param[] = " id_item={$idi}";
}
if ($ids != '') {
    $array_option_param[] = " id_sup={$ids}";
}
// param
$i_param = 0;
$param_sql = '';
if (!empty($array_param_value)) {
    foreach ($array_param_value as $key_param => $value_param) {
        if (!empty($value_param)) {
            $param_sql .= ($i_param != 0) ? ' and ' : '';
            switch ($key_param) {
                case 'keywords':
                    $param_sql .= $func->getSqlWhereKeywords($keywords, ["ten_$lang", "masp"]);
                    $i_param++;
                    break;
                case 'brand':
                    $arr_option = array_map('intval', explode(',', $value_param)); // Chuyển tất cả các phần tử thành số nguyên
                    $param_sql .= "(" . implode(' OR ', array_map(function ($value) {
                        "FIND_IN_SET($value, id_thuonghieu)";
                    }, $arr_option)) . ")";
                    $i_param++;
                    break;
                case 'min_price':
                    $param_sql .= "(giaban>=" . preg_replace('/\D/', '', $value_param) . ")";
                    $i_param++;
                    break;
                case 'max_price':
                    $param_sql .= "(giaban<=" . preg_replace('/\D/', '', $value_param) . ")";
                    $i_param++;
                    break;
                case 'status':
                    switch ($value_param) {
                        case 1:
                            $param_sql .= "noibat=1";
                            $i_param++;
                            break;
                        case 2:
                            $param_sql .= "banchay=1";
                            $i_param++;
                            break;
                        case 3:
                            $param_sql .= "sale=1";
                            $i_param++;
                            break;
                        case 4:
                            $param_sql .= "news=1";
                            $i_param++;
                            break;
                        case 5:
                            $order_by_ds = "order by giaban desc";
                            break;
                        case 6:
                            $order_by_ds = "order by giaban asc";
                            break;
                        default:
                            break;
                    }
                    break;
                default:
                    if (!is_array($value_param)) {
                        $value_param = explode(",", $value_param);
                    }
                    $escaped_value = implode('|', array_map(function ($val) {
                        return '^' . addslashes(preg_quote($val)) . '$';
                    }, $value_param));
                    $param_sql .= "($key_param REGEXP '$escaped_value')";
                    $i_param++;
                    break;
            }
        }
    }
}
$where_tmp_param = ($i_param > 0) ? "($param_sql)" : "";

if (!empty($where_tmp_param)) {
    $array_option_param[] =  $where_tmp_param;
}
// end
if (!empty($array_option_param)) {
    $where .= ' and (';
    // total option sql
    foreach ($array_option_param as $key_option_sql => $item_option_sql) {
        $where .= ($key_option_sql != 0) ? ' and ' : '';
        $where .=  $item_option_sql;
    }
    $where .= ')';
}
