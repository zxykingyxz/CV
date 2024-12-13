<?php if (!defined('_source')) die("Error");

@$id =  htmlspecialchars($_GET['id']);

$per_page = $row_setting["page_video"];

if ($id != '') {

    $row_detail = $db->rawQueryOne("select * from #_video where hienthi=1 and type='" . $type_com . "' and tenkhongdau='" . $id . "'");
    $title_cat = $row_detail["ten_$lang"];
    $title_bar .= $row_detail["ten_$lang"];
    $title = $row_detail["ten_$lang"];
    $tintuc_khac = $db->rawQuery("select * from #_video where hienthi=1 and type='" . $type_com . "' and id<>'" . $id . "' limit 0,6");
} else {

    $per_page = 100; // Set how many records do you want to display per page.

    $startpoint = ($page * $per_page) - $per_page;

    $limit = ' limit ' . $startpoint . ',' . $per_page;

    $where = " #_video where type='video' and hienthi>0 order by stt,id desc";

    $sql = "select * from $where $limit";

    $tintuc = $db->rawQuery($sql);

    $count = $db->rawQueryOne("select COUNT(*) as `numb` from #_video where hienthi=1 and type=?", array('video'));

    $total = $count["numb"];

    $url = $func->getCurrentPageURL();

    $paging = $func->pagination($total, $per_page, $page, $url);

    $seopage = $db->rawQueryOne("select * from #_seopage where type = ? limit 0,1", array('video'));

    $seo->setSeo('h1', $seopage['title_' . $seolang]);

    $seo->setSeo('subject', $seopage['mota_' . $lang]);

    $seo->setSeo('content', $seopage['noidung_' . $lang]);

    $row_toc = $seopage['mucluc'];

    if (!empty($seopage['title_' . $seolang])) $seo->setSeo('title', $seopage['title_' . $seolang]);

    else $seo->setSeo('title', $title_seo);

    if (!empty($seopage['keywords_' . $seolang])) $seo->setSeo('keywords', $seopage['keywords_' . $seolang]);

    if (!empty($seopage['description_' . $seolang])) $seo->setSeo('description', $seopage['description_' . $seolang]);

    $seo->setSeo('url', $func->getCurrentPageURL());

    $img_json_bar = (isset($seopage['options']) && $seopage['options'] != '') ? json_decode($seopage['options'], true) : null;

    if (!empty($seopage['photo'])) {

        if ($img_json_bar == null || ($img_json_bar['p'] != $seopage['photo'])) {

            $img_json_bar = $func->getImgSize($seopage['photo'], _upload_seopage_l . $seopage['photo']);

            $seo->updateSeoDB(json_encode($img_json_bar), 'seopage', $seopage['id']);
        }

        if (count($img_json_bar) > 0) {

            $seo->setSeo('photo', $https_config . _thumbs . '/' . $img_json_bar['w'] . 'x' . $img_json_bar['h'] . 'x2/' . _upload_seopage_l . $seopage['photo']);

            $seo->setSeo('photo:width', $img_json_bar['w']);

            $seo->setSeo('photo:height', $img_json_bar['h']);

            $seo->setSeo('photo:type', $img_json_bar['m']);
        }
    }

    $str_breadcrumbs = $breadcrumbs->getUrl('trang chủ', array(array('alias' => $com, 'name' => $title_seo)));
    // $paging = $func->pagination($where,$per_page,$page,$url);

    $title_bar .= $title_cat;

    if (count($tintuc) == 0) $title_cat = "Nội Dung Đang Cập Nhật...";
}
