<?php

$sortby = (isset($_GET['sortby'])) ? addslashes($_GET['sortby']) : "";
$id = (isset($_GET['id'])) ? addslashes($_GET['id']) : "";
$ids = (isset($_GET['ids'])) ? addslashes($_GET['ids']) : "";
$idl = (isset($_GET['idl'])) ? addslashes($_GET['idl']) : "";
$idc = (isset($_GET['idc'])) ? addslashes($_GET['idc']) : "";
$idi = (isset($_GET['idi'])) ? addslashes($_GET['idi']) : "";
$is_brand = (isset($_GET['is_brand'])) ? addslashes($_GET['is_brand']) : "";
$is_price = (isset($_GET['is_price'])) ? addslashes($_GET['is_price']) : "";
$is_tags = (isset($_GET['is_tags'])) ? addslashes($_GET['is_tags']) : "";
$url_page = '';
if ($idl != '') {
    $where .= " and id_list={$idl}";
    $url_page .= '&idl=' . $idl;
}
if ($idc != '') {
    $where .= " and id_cat={$idc}";
    $url_page .= '&idc=' . $idc;
}
if ($idi != '') {
    $where .= " and id_item={$idi}";
    $url_page .= '&idi=' . $idi;
}

if ($is_brand != '') {
    $arr_option = explode(',', $is_brand);
    $where .= " and (";
    foreach ($arr_option as $k => $v) {
        if ($k == 0) {
            $where .= " find_in_set($v,id_thuonghieu)";
        } else {
            $where .= " or find_in_set($v,id_thuonghieu)";
        }
    }
    $where .= ")";
    $url_page .= '&is_brand=' . $is_brand;
}
if ($is_price != '') {
    $arr_option = explode(',', $is_price);
    $where .= " and (";
    foreach ($arr_option as $key => $vstr) {
        $gia_s = $db->rawQueryOne("select max,min from #_baiviet where type=? and id=?", array('muc-gia', $vstr));
        if ($key == 0) {
            if ($gia_s["max"] != 0) {
                $where .= " giaban between {$gia_s['min']} and {$gia_s['max']}";
            } else {
                $where .= " giaban > {$gia_s['min']}";
            }
        } else {
            if ($gia_s["max"] != 0) {
                $where .= " or giaban between {$gia_s['min']} and {$gia_s['max']}";
            } else {
                $where .= " or giaban > {$gia_s['min']}";
            }
        }
    }
    $where .= ")";
    $url_page .= '&is_price=' . $is_price;
}
if ($is_tags != '') {
    $arr_option = explode(',', $is_tags);
    $where .= " and (";
    foreach ($arr_option as $k => $v) {
        if ($k == 0) {
            $where .= " find_in_set($v,tags)";
        } else {
            $where .= " or find_in_set($v,tags)";
        }
    }
    $where .= ")";
    $url_page .= '&is_tags=' . $is_tags;
}

if (!empty($sortby)) {
    if ($sortby == 's-1') {
        $where .= ' and khuyenmai=1';
        $url_page .= '&sortby=' . $sortby;
    } elseif ($sortby == 's-2') {
        $where .= ' and spmoi=1';
        $url_page .= '&sortby=' . $sortby;
    } else {
        $ex_sort_by = str_replace('-', ' ', $sortby);
        $order_by = ' order by ' . $ex_sort_by;
        $url_page .= '&sortby=' . $sortby;
    }
} else {

    $order_by = $func->getOrderByTypeFor($type);
}
