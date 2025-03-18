<?php if (!defined('_source')) die("Error");

include _source  . 'searchPro.php';


$rowc = [];
$flag = true;
$row_list = false;
$row_cat = false;
$row_item = false;
$row_sub = false;

if (!empty($id)) {
    $row_detail = $cache->getCache("select * ,tenkhongdau_$lang as tenkhongdau from #_baiviet where hienthi=1 and id=? and type=?", array($id, $type), 'fetch', _TIMECACHE);
    if (!empty($row_detail)) {
        $rowc['type'] = 'detail';
        $rowc['data'] = $row_detail;
    } else {
        $flag = false;
    }
}
if (!empty($idl)) {
    $row_list = $cache->getCache("select *,ten_$lang,tenkhongdau_$lang as tenkhongdau,mota_$lang,noidung_$lang from #_baiviet_list where hienthi=1 and type=? and id=? limit 1", array($type, $idl), 'fetch', _TIMECACHE);
    if ($row_list) {
        $rowc['type'] = 'list';
        $rowc['data'] = $row_list;
    } else {
        $flag = false;
    }
}
if (!empty($idc)) {
    $row_cat = $cache->getCache("select *,ten_$lang,tenkhongdau_$lang as tenkhongdau,mota_$lang,noidung_$lang from #_baiviet_cat where hienthi=1 and type=? and id=? limit 1", array($type, $idc), 'fetch', _TIMECACHE);
    if ($row_cat) {
        $rowc['type'] = 'cat';
        $rowc['data'] = $row_cat;
    } else {
        $flag = false;
    }
}
if (!empty($idi)) {
    $row_item = $cache->getCache("select *,ten_$lang,tenkhongdau_$lang as tenkhongdau,mota_$lang,noidung_$lang from #_baiviet_item where hienthi=1 and type=? and id=? limit 1", array($type, $idi), 'fetch', _TIMECACHE);
    if ($row_item) {
        $rowc['type'] = 'item';
        $rowc['data'] = $row_item;
    } else {
        $flag = false;
    }
}
if (!empty($ids)) {
    $row_sub = $cache->getCache("select *,ten_$lang,tenkhongdau_$lang as tenkhongdau,mota_$lang,noidung_$lang from #_baiviet_sub where hienthi=1 and type=? and id=? limit 1", array($type, $ids), 'fetch', _TIMECACHE);
    if ($row_sub) {
        $rowc['type'] = 'sub';
        $rowc['data'] = $row_sub;
    } else {
        $flag = false;
    }
}
if (empty($id) && empty($idl) && empty($idc) && empty($idi) && empty($ids)) {
    $rowc['type'] = 'general';
}

switch ($com) {
    case 'hinh-anh':
        $rowc['type'] = 'photo';
        break;
    default:
}

if ($flag) {
    include _source . "Route/proRoute.php";
} else {
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
    $template = "error/404";
}
