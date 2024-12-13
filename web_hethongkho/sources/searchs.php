<?php

$alias = (isset($_REQUEST['alias'])) ? addslashes($_REQUEST['alias']) : "";

$sortby = (isset($_REQUEST['sortby'])) ? addslashes($_REQUEST['sortby']) : "";

$show = (isset($_REQUEST['show'])) ? addslashes($_REQUEST['show']) : "";

$idl = (isset($_REQUEST['idl'])) ? addslashes($_REQUEST['idl']) : "";

$idc = (isset($_REQUEST['idc'])) ? addslashes($_REQUEST['idc']) : "";

$idi = (isset($_REQUEST['idi'])) ? addslashes($_REQUEST['idi']) : "";

$s1 = (isset($_REQUEST['s1'])) ? addslashes($_REQUEST['s1']) : "";

$s2 = (isset($_REQUEST['s2'])) ? addslashes($_REQUEST['s2']) : "";

$size = (isset($_REQUEST['size'])) ? addslashes($_REQUEST['size']) : "";

$ncu = (isset($_REQUEST['ncu'])) ? addslashes($_REQUEST['ncu']) : "";

$price = (isset($_REQUEST['price'])) ? addslashes($_REQUEST['price']) : "";

$loaidat = (isset($_REQUEST['soil-type'])) ? addslashes($_REQUEST['soil-type']) : "";

$huong = (isset($_REQUEST['direction'])) ? addslashes($_REQUEST['direction']) : "";

$dientich = (isset($_REQUEST['area'])) ? addslashes($_REQUEST['area']) : "";

$keywords = (isset($_REQUEST['keywords'])) ? addslashes($_REQUEST['keywords']) : "";

$page = isset($_GET["p"]) && $_GET["p"] > 0 ? $_GET["p"] : $page;

$url_page = '';

if ($_GET['href']) {

    $get_link = base64_decode($_GET['href']);

    $ex = explode('/', $get_link);

    $com_tag = $ex[count($ex) - 2];

    $alias_tag = $ex[count($ex) - 1];
}
if (!empty($alias_tag) && $alias_tag != $type) {

    $row_list = $db->rawQueryOne("select id from #_baiviet_list where hienthi=1 and tenkhongdau=? and type=?", array($alias_tag, $type));

    if ($row_list) {

        $where = ' and id_list=' . $row_list['id'];
    } else {

        $row_cat = $db->rawQueryOne("select id from #_baiviet_cat where hienthi=1 and tenkhongdau=? and type=?", array($alias_tag, $type));

        if ($row_cat) {

            $where = ' and id_cat=' . $row_cat['id'];
        } else {

            $row_item = $db->rawQueryOne("select id from #_baiviet_item where hienthi=1 and tenkhongdau=? and type=?", array($alias_tag, $type));

            if ($row_item) {

                $where = ' and id_item=' . $row_item['id'];
            }
        }
    }
}
if (!empty($keywords)) {

    $where .= " and (ten_vi like '%" . $keywords . "%' or masp like '%" . $keywords . "%')";

    $url_page .= '&keywords=' . $keywords;
}

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

if ($s1 == 's-1') {

    $where .= " and khuyenmai=1";

    $url_page .= '&s1=' . $s1;
}

if ($s2 == 's-2') {

    $where .= " and moinhat=1";

    $url_page .= '&s2=' . $s2;
}

if ($ncu != '') {

    $where .= " and find_in_set($ncu,id_ncu)";

    $url_page .= '&ncu=' . $ncu;
}

if ($size != '') {

    $where .= " and find_in_set($size,kichthuoc)";

    $url_page .= '&size=' . $size;
}

if ($price != '') {

    $gia_s = $db->rawQueryOne("select max,min from #_baiviet where type=? and id=?", array('gia-ban', $price));

    if ($gia_s["max"] != 0) {

        $where .= " and giaban between {$gia_s['min']} and {$gia_s['max']}";
    } else {

        $where .= " and giaban > {$gia_s['min']}";
    }

    $url_page .= '&price=' . $price;
}

if ($dientich != '') {

    $dientich_s = $db->rawQueryOne("select max,min from #_baiviet where type=? and id=?", array('dien-tich', $dientich));

    if ($dientich_s["max"] != 0) {

        $where .= " and dientich between {$dientich_s['min']} and {$dientich_s['max']}";
    } else {

        $where .= " and dientich > {$dientich_s['min']}";
    }

    $url_page .= '&area=' . $dientich;
}

if ($huong != '') {

    $where .= " and id_huong={$huong}";

    $url_page .= '&direction=' . $huong;
}

if ($loaidat != '') {

    $where .= " and loaidat={$loaidat}";

    $url_page .= '&soil-type=' . $loaidat;
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

    $order_by = ' order by stt asc, id desc';
}

if (!empty($show)) {

    $per_page = $show;

    $url_page .= '&show=' . $per_page;
} else {

    $per_page = $row_setting['page_sp'];

    $url_page .= '&show=' . $per_page;
}

$count_per = ($page * $per_page);

$startpoint =  $count_per - $per_page;

$limit = ' limit ' . $startpoint . ',' . $per_page;

$sql = "SELECT *,tenkhongdau_$lang as tenkhongdau from #_baiviet where type=? {$where} {$order_by} " . $limit;

$tintuc = $db->rawQuery($sql, array($type));

$sqlq = "SELECT COUNT(*) as `numb` from #_baiviet where type=? {$where} {$order_by}";

$count = $db->rawQueryOne($sqlq, array($type));

$total = $count['numb'];

$total_paging = $total - $count_per;

if ($func->isAjax()) {

    echo json_encode([

        'html' => $func->getTemplateLayoutsFor($tintuc, 'h3', $class),

        'paging' => $func->getLoadMore($total_paging, $per_page, $page, 'sản phẩm')

    ]);
} else {

    $url = $func->getCurrentPageURL();

    $paging = $func->pagination($total, $per_page, $page, $url);

    $title = 'Kết quả có ' . $total . ' ' . 'sản phẩm được tìm thấy!';

    $seo->setSeo('h1', $title);
}

$arr = array(array('alias' => 'tim-kiem?' . $url_page, 'name' => 'Kết quả tìm kiếm'));

$str_breadcrumbs = $breadcrumbs->getUrl('Trang chủ', $arr);
