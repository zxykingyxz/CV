<?php
$per_page = $func->getPagingByComFor($com);
$countPer = ($page * $per_page);
$startpoint =  $countPer - $per_page;
$subWhere = "";

switch ($rowc['type']) {
    case 'photo':
        $tintuc = $cache->getCache("select * from #_photo where type=? and hienthi=1 $order_by limit $startpoint,$per_page", array($type), 'result', _TIMECACHE);
        $count = $cache->getCache("select COUNT(*) as `numb` from #_photo where  hienthi=1 and type=?", array($type), 'fetch', _TIMECACHE);

        $str_breadcrumbs = $breadcrumbs->getUrl('trang chủ', array(array('alias' => $type, 'name' => $title_seo)));

        /* SEO */
        $seoDB = $cache->getCache("select * from #_seopage where type = ? limit 0,1", array($com), 'fetch', _TIMECACHE);
        $rowc['data'] = $seoDB;
        $rowc['data']["ten_$lang"] = $seoDB["title_$lang"];
        $rowc['data']['toc'] = $seoDB['mucluc'];
        $rowc['data']['table'] = 'seopage';
        $rowc['data']['folder'] = _upload_seopage_l;
        break;
    case 'general':
        $tintuc = $cache->getCache("select *,tenkhongdau_$lang as tenkhongdau from #_baiviet where hienthi=1 $where and type=? $order_by_ds limit $startpoint,$per_page", array($type), 'result', _TIMECACHE);
        $count = $cache->getCache("select COUNT(*) as `numb` from #_baiviet where hienthi=1 $where and type=?", array($type), 'fetch', _TIMECACHE);
        $list_sale = $cache->getCache("select *,tenkhongdau_$lang as tenkhongdau from #_baiviet where hienthi=1 and sale=1 $where and type=? $order_by_ds ", array($type), 'result', _TIMECACHE);

        /* list */
        $row_list = $cache->getCache("select id,ten_$lang, tenkhongdau_$lang as tenkhongdau,type,photo from #_baiviet_list where hienthi=1 and type=? $order_by", array($type), 'result', _TIMECACHE);

        $json_code .= $json_schema->ItemList($tintuc);
        $str_breadcrumbs = $breadcrumbs->getUrl('trang chủ', array(array('alias' => $type, 'name' => $title_seo)));

        /* SEO */
        $seoDB = $cache->getCache("select * from #_seopage where type = ? limit 0,1", array($com), 'fetch', _TIMECACHE);
        $rowc['data'] = $seoDB;
        $rowc['data']["ten_$lang"] = $seoDB["title_$lang"];
        $rowc['data']['toc'] = $seoDB['mucluc'];
        $rowc['data']['table'] = 'seopage';
        $rowc['data']['folder'] = _upload_seopage_l;
        $list_h2 = $row_list;
        break;
    case 'list':
        $tintuc = $cache->getCache("select *,tenkhongdau_$lang as tenkhongdau from #_baiviet where hienthi=1 $where and type=? $order_by_ds limit $startpoint,$per_page", array($type), 'result', _TIMECACHE);
        $count = $cache->getCache("select COUNT(*) as `numb` from #_baiviet where hienthi=1 $where and type=?", array($type), 'fetch', _TIMECACHE);
        $list_sale = $cache->getCache("select *,tenkhongdau_$lang as tenkhongdau from #_baiviet where hienthi=1 and sale=1 $where and type=? $order_by_ds ", array($type), 'result', _TIMECACHE);
        $banner = $rowc['data']['banner'];

        /* cat */
        $row_cat = $cache->getCache("select *, id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,photo,id_list,type,photo from #_baiviet_cat where hienthi=1 and type=? and id_list=? $order_by", array($type, $row_list["id"]), 'result', _TIMECACHE);

        $rowc['data']['toc'] = $row_list['mucluc'];
        $rowc['data']['cano'] = $row_list["cano_$lang"];
        $rowc['data']['id'] = $row_list["id"];
        $rowc['data']['photo'] = $row_list["photo"];
        $rowc['data']['table'] = 'baiviet_list';
        $rowc['data']['folder'] = _upload_baiviet_l;

        $data['breadcrumbs'][0] = array('alias' => $type, 'name' => $title_seo);
        $data['breadcrumbs'][1] = $func->getArray($row_list);
        $str_breadcrumbs = $breadcrumbs->getUrl('Trang chủ', $data['breadcrumbs']);

        $json_code .= $json_schema->ItemList($tintuc);
        $seoDB = $seo->getSeoDB($row_list['id'], 'baiviet', 'man_list', $row_list['type']);
        $list_h2 = $row_cat;
        break;
    case 'cat':
        $sql = "select *,tenkhongdau_$lang as tenkhongdau from #_baiviet where hienthi=1 $where and type=? $order_by_ds limit $startpoint,$per_page";
        $tintuc = $cache->getCache($sql, array($type), 'result', _TIMECACHE);
        $count = $cache->getCache("select COUNT(*) as `numb` from #_baiviet where hienthi=1 $where and type=?", array($type), 'fetch', _TIMECACHE);
        $list_sale = $cache->getCache("select *,tenkhongdau_$lang as tenkhongdau from #_baiviet where hienthi=1 and sale=1 $where and type=? $order_by_ds", array($type), 'result', _TIMECACHE);

        /* item */
        $row_item = $cache->getCache("select id,id_list,ten_$lang, tenkhongdau_$lang as tenkhongdau,photo,type from #_baiviet_item where hienthi=1 and id_cat=? and type=? $order_by", array($row_cat['id'], $type), 'result', _TIMECACHE);

        $rowc['data']['toc'] = $row_cat['mucluc'];
        $rowc['data']['cano'] = $row_cat["cano_$lang"];
        $rowc['data']['id'] = $row_cat["id"];
        $rowc['data']['photo'] = $row_cat["photo"];
        $rowc['data']['table'] = 'baiviet_cat';
        $rowc['data']['folder'] = _upload_baiviet_l;

        $data['breadcrumbs'][0] = array('alias' => $type, 'name' => $title_seo);
        $row_list = $cache->getCache("select id,ten_$lang,tenkhongdau_$lang as tenkhongdau,type,banner from #_baiviet_list where hienthi=1 and id=? and type=? order by stt asc, id desc", array($row_cat['id_list'], $type), 'fetch', _TIMECACHE);
        $data['breadcrumbs'][1] = $func->getArray($row_list);
        $data['breadcrumbs'][2] = $func->getArray($row_cat);
        $str_breadcrumbs = $breadcrumbs->getUrl('Trang chủ', $data['breadcrumbs']);
        $json_code .= $json_schema->ItemList($tintuc);

        $seoDB = $seo->getSeoDB($row_cat['id'], 'baiviet', 'man_cat', $row_cat['type']);
        $list_h2 = $row_item;
        $banner = $row_list['banner'];

        break;
    case 'item':
        $tintuc = $cache->getCache("select *,tenkhongdau_$lang as tenkhongdau from #_baiviet where hienthi=1 $where and type=? $order_by_ds limit $startpoint,$per_page", array($type), 'result', _TIMECACHE);
        $count = $cache->getCache("select COUNT(*) as `numb` from #_baiviet where hienthi=1 $where and type=?", array($type), 'fetch', _TIMECACHE);
        $list_sale = $cache->getCache("select *,tenkhongdau_$lang as tenkhongdau from #_baiviet where hienthi=1 and sale=1 $where and type=? $order_by_ds ", array($type), 'result', _TIMECACHE);

        $rowc['data']['toc'] = $row_item['mucluc'];
        $rowc['data']['cano'] = $row_item["cano_$lang"];
        $rowc['data']['id'] = $row_item["id"];
        $rowc['data']['photo'] = $row_item["photo"];
        $rowc['data']['table'] = 'baiviet_cat';
        $rowc['data']['folder'] = _upload_baiviet_l;

        $data['breadcrumbs'][0] = array('alias' => $type, 'name' => $title_seo);
        $row_list = $cache->getCache("select id,ten_$lang,tenkhongdau_$lang as tenkhongdau,type,banner from #_baiviet_list where hienthi=1 and id=? and type=? order by stt asc, id desc", array($row_item['id_list'], $type), 'fetch', _TIMECACHE);
        $data['breadcrumbs'][1] = $func->getArray($row_list);
        $row_cat = $cache->getCache("select id,ten_$lang,tenkhongdau_$lang as tenkhongdau,type,id_list from #_baiviet_cat where hienthi=1 and id=? and type=? order by stt asc, id desc", array($row_item['id_cat'], $type), 'fetch', _TIMECACHE);
        $data['breadcrumbs'][2] = $func->getArray($row_cat);
        $data['breadcrumbs'][3] = $func->getArray($row_item);
        $str_breadcrumbs = $breadcrumbs->getUrl('Trang chủ', $data['breadcrumbs']);
        $json_code .= $json_schema->ItemList($tintuc);
        $seoDB = $seo->getSeoDB($row_item['id'], 'baiviet', 'man_item', $row_item['type']);
        $banner = $row_list['banner'];

        break;
    case 'sub':
        $tintuc = $cache->getCache("select *,tenkhongdau_$lang as tenkhongdau from #_baiviet where hienthi=1 $where and type=? $order_by_ds limit $startpoint,$per_page", array($type), 'result', _TIMECACHE);
        $count = $cache->getCache("select COUNT(*) as `numb` from #_baiviet where hienthi=1 $where and type=?", array($type), 'fetch', _TIMECACHE);
        $list_sale = $cache->getCache("select *,tenkhongdau_$lang as tenkhongdau from #_baiviet where hienthi=1 and sale=1 $where and type=? $order_by_ds ", array($type), 'result', _TIMECACHE);

        $rowc['data']['toc'] = $row_item['mucluc'];
        $rowc['data']['cano'] = $row_item["cano_$lang"];
        $rowc['data']['id'] = $row_item["id"];
        $rowc['data']['photo'] = $row_item["photo"];
        $rowc['data']['table'] = 'baiviet_cat';
        $rowc['data']['folder'] = _upload_baiviet_l;

        $data['breadcrumbs'][0] = array('alias' => $type, 'name' => $title_seo);
        $row_list = $cache->getCache("select id,ten_$lang,tenkhongdau_$lang as tenkhongdau,type,banner from #_baiviet_list where hienthi=1 and id=? and type=? order by stt asc, id desc", array($row_item['id_list'], $type), 'fetch', _TIMECACHE);
        $data['breadcrumbs'][1] = $func->getArray($row_list);
        $row_cat = $cache->getCache("select id,ten_$lang,tenkhongdau_$lang as tenkhongdau,type,id_list from #_baiviet_cat where hienthi=1 and id=? and type=? order by stt asc, id desc", array($row_item['id_cat'], $type), 'fetch', _TIMECACHE);
        $data['breadcrumbs'][2] = $func->getArray($row_cat);
        $row_item = $cache->getCache("select id,ten_$lang,tenkhongdau_$lang as tenkhongdau,type,id_cat from #_baiviet_item where hienthi=1 and id=? and type=? order by stt asc, id desc", array($row_item['id_item'], $type), 'fetch', _TIMECACHE);
        $data['breadcrumbs'][3] = $func->getArray($row_item);
        $data['breadcrumbs'][4] = $func->getArray($row_sub);
        $str_breadcrumbs = $breadcrumbs->getUrl(_home, $data['breadcrumbs']);
        $json_code .= $json_schema->ItemList($tintuc);
        $seoDB = $seo->getSeoDB($row_sub['id'], 'baiviet', 'man_sub', $row_sub['type']);
        $banner = $row_list['banner'];

        break;
    case 'detail':
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

        $seoDB = $seo->getSeoDB($row_detail['id'], 'baiviet', 'man', $row_detail['type']);

        $str_breadcrumbs = $breadcrumbs->getUrl('trang chủ', $data['breadcrumbs']);
        $breadcrumbs_detail = $breadcrumbs->getUrlDetail($data['breadcrumbs']);
        $json_code .= $json_schema->BreadcrumbList('trang chủ', $data['breadcrumbs']);
        $json_code .= $json_schema->NewsArticle($row_detail, $seoDB);

        $tintuc_nb = $cache->getCache("select *,tenkhongdau_$lang as tenkhongdau from table_baiviet where noibat=1 and hienthi=1 and type=? order by stt asc, id desc limit 0,20", array($type), 'result', _TIMECACHE);

        $tintuc = $cache->getCache("select *,tenkhongdau_$lang as tenkhongdau from table_baiviet where hienthi=1 and type=?{$subWhere} order by stt asc, id desc limit 0,20", array($type), 'result', _TIMECACHE);
        break;
}

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
$img_json_bar['p'] = (isset($array_options['p']) && !empty($array_options['p'])) ? $array_options['p'] : null;
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
