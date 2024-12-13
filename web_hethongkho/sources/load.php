<?php

$params = array();
@$id    =   htmlspecialchars($_GET['id']);
@$idl   =   htmlspecialchars($_GET['idl']);
@$idc   =   htmlspecialchars($_GET['idc']);
@$idi   =   htmlspecialchars($_GET['idi']);
@$ids   =   htmlspecialchars($_GET['ids']);
@$type  =   htmlspecialchars($_GET['type']);
@$page  =   htmlspecialchars($_GET['page']);
$where = "";
if (!empty($idl)) {
    $params['idl'] = $idl;
    $where .= " and id_list=" . $idl;
}
if (!empty($idc)) {
    $params['idc'] = $idc;
    $where .= " and id_cat=" . $idc;
}
if (!empty($idi)) {
    $params['idi'] = $idi;
    $where .= " and id_item=" . $idi;
}
if (!empty($ids)) {
    $params['ids'] = $ids;
    $where .= " and id_sub=" . $ids;
}
if (!empty($type)) {
    $params['type'] = $type;
}
if (!empty($page)) {
    $params['page'] = $page;
}
$order_by = ' order by stt asc, id desc';
$per_page = $row_setting["page_in"];
$count_per = ($page * $per_page);
$startpoint =  $count_per - $per_page;
$sql = "select *,tenkhongdau_$lang as tenkhongdau from #_baiviet where hienthi=1 and noibat<>0$where and type=? $order_by limit $startpoint,$per_page";
$tintuc = $cache->getcache($sql, array($type), 'result', _TIMECACHE);
$count = $cache->getcache("select COUNT(*) as `numb` from #_baiviet where hienthi=1 and noibat<>0$where and type=?", array($type), 'fetch', _TIMECACHE);
$total = $count['numb'];
$total_paging = $total - $count_per;
if ($func->isAjax()) {
    echo json_encode([
        'html' => $func->getTemplateLayoutsFor($tintuc, 'h6', 'col l-3 m-4 c-6 mb20 mb-tl-16 mb-m-8 d-flex flex-col'),
        'paging' => $layouts->$loadmore($total_paging, $params, _sanpham)
    ]);
    exit;
}
