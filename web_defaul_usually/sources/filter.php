<?php

include _source . 'searchPro.php';

$per_page = $func->getPagingByComFor('tim-kiem');
$url_page .= '&show=' . $per_page;

$count_per = ($page * $per_page);
$startpoint = ($page * $per_page) - $per_page;
$limit = ' limit ' . $startpoint . ',' . $per_page;
$type = array_map(function ($item) {
    return "'" . $item . "'";
}, $type);
$type = implode(",", $type);

$sql = "select *,tenkhongdau_$lang as tenkhongdau from #_baiviet where hienthi=1 and type in ($type) {$where} {$order_by} " . $limit;
$tintuc = $db->rawQuery($sql, array());
$sqlq = "select COUNT(*) as `numb` from #_baiviet where hienthi=1 and type in ($type) {$where} {$order_by}";
$count = $db->rawQueryOne($sqlq, array());
$total = $count['numb'];
$total_paging = $total - $count_per;

include _source . "Route/ajaxRoute.php";

$title = 'Kết quả có ' . $total . ' ' . $textButton . ' được tìm thấy!';
$seo->setSeo('h1', $title);

$titleContainer = (!empty($seo->getSeo('h1'))) ? $seo->getSeo('h1') : $title;

$arr = array(array('alias' => 'tim-kiem?' . $url_page, 'name' => 'Kết quả tìm kiếm'));
$str_breadcrumbs = $breadcrumbs->getUrl('Trang chủ', $arr);
