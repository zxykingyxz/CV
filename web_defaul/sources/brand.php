<?php if (!defined('_source')) die("Error");

include _source  . 'searchPro.php';

$per_page = $func->getPagingByComFor($com);
$countPer = ($page * $per_page);
$startpoint =  $countPer - $per_page;
$subWhere = "";

if (!empty($id)) {
    $row_detail = $cache->getCache("select * ,tenkhongdau_$lang as tenkhongdau from #_baiviet where hienthi=1 and id=? and type=?", array($id, $type), 'fetch', _TIMECACHE);
    if (!empty($row_detail)) {
        $rowc['type'] = 'detail';
        $rowc['data'] = $row_detail;
    } else {
        $flag = false;
    }
}

$row_tacgia = $cache->getCache("select phone,photo,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,mota_$lang as mota,link_facebook,link_instagram,link_twitter,link_zalo,type,job_$lang as job from #_baiviet where hienthi=1 and type=? and id=? limit 1", array('tac-gia', $row_detail["id_tacgia"]), 'fetch', _TIMECACHE);
$photos = $cache->getCache("select id,photo from #_baiviet_photo where type=? and id_baiviet=? order by stt asc, id desc", array($type, $row_detail['id']), 'result', _TIMECACHE);
$func->updateTable('baiviet', $row_detail['id']);
$func->viewAdd($row_detail['id']);
$list_detail = $cache->getCache("select * ,tenkhongdau_$lang as tenkhongdau from #_baiviet_list where id=? and type=? limit 1", array($row_detail['id_list'], $type), 'fetch', _TIMECACHE);
$cat_detail = $cache->getCache("select * ,tenkhongdau_$lang as tenkhongdau from #_baiviet_cat where id=? and type=? limit 1", array($row_detail['id_cat'], $type), 'fetch', _TIMECACHE);
$item_detail = $cache->getCache("select * ,tenkhongdau_$lang as tenkhongdau from #_baiviet_item where id=? and type=? limit 1", array($row_detail['id_item'], $type), 'fetch', _TIMECACHE);

$rowc['data']['toc'] = $row_detail['mucluc'];
$rowc['data']['cano'] = $row_detail["cano_$lang"];
$rowc['data']['robots'] = $row_detail["index_robots"];
$rowc['data']['id'] = $row_detail["id"];
$rowc['data']['photo'] = $row_detail["photo"];
$rowc['data']['table'] = 'baiviet';
$rowc['data']['folder'] = _upload_baiviet_l;

$data['breadcrumbs'][0] = array('alias' => $type, 'name' => $title_seo);
if (!empty($list_detail)) {
    $data['breadcrumbs'][1] = $func->getArray($list_detail);
    $subWhere .= ' and id_list=' . $list_detail['id'];
    if (!empty($cat_detail)) {
        $data['breadcrumbs'][2] = $func->getArray($cat_detail);
        $subWhere .= ' and id_cat=' . $cat_detail['id'];
        if (!empty($item_detail)) {
            $data['breadcrumbs'][3] = $func->getArray($item_detail);
            $subWhere .= ' and id_item=' . $item_detail['id'];
            if (!empty($sub_detail)) {
                $data['breadcrumbs'][4] = $func->getArray($sub_detail);
                $data['breadcrumbs'][5] = $func->getArray($row_detail);
                $subWhere .= ' and id_subs=' . $subs_detail['id'];
            } else {
                $data['breadcrumbs'][4] = $func->getArray($row_detail);
            }
        } else {
            $data['breadcrumbs'][3] = $func->getArray($row_detail);
        }
    } else {
        $data['breadcrumbs'][2] = $func->getArray($row_detail);
    }
} else {
    $data['breadcrumbs'][1] = $func->getArray($row_detail);
}

$subWhere .= ' and id<>' . $row_detail['id'];
if ($config['cart']['cart-qty'] && $com == 'san-pham') {
    $subWhere .= " and qty > 0 ";
}
$seoDB = $seo->getSeoDB($row_detail['id'], 'baiviet', 'man', $row_detail['type']);

$str_breadcrumbs = $breadcrumbs->getUrl('trang chủ', $data['breadcrumbs']);
$breadcrumbs_detail = $breadcrumbs->getUrlDetail($data['breadcrumbs']);
$json_code .= $json_schema->BreadcrumbList('trang chủ', $data['breadcrumbs']);
$json_code .= $json_schema->NewsArticle($row_detail, $seoDB);
$type_list = array_map(function ($item) {
    return "'" . $item . "'";
}, $type_list);
$type_list = implode(",", $type_list);
$tintuc = $cache->getCache("select *,tenkhongdau_$lang as tenkhongdau from #_baiviet where hienthi=1 and find_in_set(" . $row_detail['id'] . ",id_thuonghieu) and type in ($type_list) $where $order_by_ds limit $startpoint,$per_page", array(), 'result', _TIMECACHE);
$count = $cache->getCache("select COUNT(id) as `numb` from #_baiviet where hienthi=1 and find_in_set(" . $row_detail['id'] . ",id_thuonghieu) and type in ( $type_list) $where ", array(), 'fetch', _TIMECACHE);

$total = $count['numb'];
$total_paging = $total - $countPer;
$url = $func->getCurrentPageURL();

include _source . "Route/ajaxRoute.php";

$seo->setSeo('url', $url);
$seo->setSeo('toc', $rowc['data']['toc']);
$seo->setSeo('cano', !empty($rowc['data']['cano']) ? $rowc['data']['cano'] : '');
$seo->setSeo('robots', !empty($rowc['data']['robots']) ? $rowc['data']['robots'] : '');
$seo->setSeo('h1', $rowc['data']['ten_' . $lang]);
$seo->setSeo('subject', $rowc['data']['mota_' . $lang]);
$seo->setSeo('content', $rowc['data']['noidung_' . $lang]);
$titleContainer = (!empty($seo->getSeo('h1'))) ? $seo->getSeo('h1') : $title_seo;
if (!empty($seoDB['title_' . $lang])) $seo->setSeo('title', $seoDB['title_' . $lang]);
else $seo->setSeo('title', $rowc['data']['ten_' . $lang]);
if (!empty($seoDB['keywords_' . $lang])) $seo->setSeo('keywords', $seoDB['keywords_' . $lang]);
if (!empty($seoDB['description_' . $lang])) $seo->setSeo('description', $seoDB['description_' . $lang]);
if (!empty($seoDB['schema'])) $seo->setSeo('schema', $seoDB['schema']);

$array_options = json_decode($rowc['data']['options'], true);
$img_json_bar = (isset($array_options['p']) && !empty($array_options['p'])) ? $array_options['p'] : null;

if ($img_json_bar == null || ($img_json_bar['p'] != $array_options['p'])) {

    $img_json_bar = $func->getImgSize($rowc['data']['photo'], $rowc['data']['folder'] . $rowc['data']['photo']);

    if (isset($array_options)) {
        $array_options = array_merge($array_options, $img_json_bar);
    }

    $seo->updateSeoDB(json_encode($array_options), $rowc['data']['table'], $rowc['data']['id']);
}

if (count($img_json_bar) > 0) {
    $seo->setSeo('photo', $https_config . _thumbs . '/' . $img_json_bar['w'] . 'x' . $img_json_bar['h'] . 'x1/' . $rowc['data']['folder'] . $rowc['data']['photo']);
    $seo->setSeo('photo:width', $img_json_bar['w']);
    $seo->setSeo('photo:height', $img_json_bar['h']);
    $seo->setSeo('photo:type', $img_json_bar['m']);
}
