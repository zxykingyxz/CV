<?php
// param check
$array_param_data = ["keywords", "status", "id_list", "id_cat", "id_item", "id_sup"];

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
// where
$array_option_param = [];

if ($id_list != '') {
    $array_option_param[] = " id_list={$id_list}";
}
if ($id_cat != '') {
    $array_option_param[] = " id_cat={$id_cat}";
}
if ($id_item != '') {
    $array_option_param[] = " id_item={$id_item}";
}
if ($id_sup != '') {
    $array_option_param[] = " id_sup={$id_sup}";
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
