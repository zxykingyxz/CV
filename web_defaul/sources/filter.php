<?php
$show = (isset($_REQUEST['show'])) ? addslashes($_REQUEST['show']) : "";
$keywords = (isset($_REQUEST['keywords'])) ? addslashes($_REQUEST['keywords']) : "";

include _source . 'searchPro.php';

if (!empty($keywords)) {
    $where .= " and ";
    $where .= $func->getSqlWhereKeywords($keywords, ["ten_$lang", "masp"]);
}

if ($config['cart']['cart-qty']) {
    $where .= " and qty >0 ";
}
if (!empty($show)) {
    $per_page = $show;
    $url_page .= '&show=' . $per_page;
} else {
    $per_page = $func->getPagingByComFor('tim-kiem');
    $url_page .= '&show=' . $per_page;
}

$count_per = ($page * $per_page);
$startpoint = ($page * $per_page) - $per_page;
$limit = ' limit ' . $startpoint . ',' . $per_page;
$type = array_map(function ($item) {
    return "'" . $item . "'";
}, $type);
$type = implode(",", $type);

$sql = "select *,tenkhongdau_$lang as tenkhongdau from #_baiviet where type in ($type) {$where} {$order_by} " . $limit;
$tintuc = $db->rawQuery($sql, array());
$sqlq = "select COUNT(*) as `numb` from #_baiviet where type in ($type) {$where} {$order_by}";
$count = $db->rawQueryOne($sqlq, array());
$total = $count['numb'];
$total_paging = $total - $count_per;

$output = '';
$output .= '<div class="col l-12 m-12 c-12 mb20 t-center">
        <p>Nội dung đang cập nhật....</p>
    </div>';

include _source . "Route/ajaxRoute.php";

$title = 'Kết quả có ' . $total . ' ' . $textButton . ' được tìm thấy!';
$seo->setSeo('h1', $title);

$titleContainer = (!empty($seo->getSeo('h1'))) ? $seo->getSeo('h1') : $title;

$arr = array(array('alias' => 'tim-kiem?' . $url_page, 'name' => 'Kết quả tìm kiếm'));
$str_breadcrumbs = $breadcrumbs->getUrl('Trang chủ', $arr);
