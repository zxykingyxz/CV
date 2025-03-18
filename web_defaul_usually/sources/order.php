<?php if (!defined('_source')) die("Error");
$info_order = (isset($_GET['info_order'])) ? addslashes($_GET['info_order']) : "";

$where = " and (code='$info_order' or phone='$info_order')";
$order = $db->rawQuery("select * from #_order where 1 $where  ", array());

/* SEO */
$seoDB = $seo->getSeoDB(0, 'info', 'capnhat', $type);
if (!empty($seoDB['title_' . $seolang])) $seo->setSeo('h1', $seoDB['title_' . $seolang]);
if (!empty($seoDB['title_' . $seolang])) $seo->setSeo('title', $seoDB['title_' . $seolang]);
if (!empty($seoDB['keywords_' . $seolang])) $seo->setSeo('keywords', $seoDB['keywords_' . $seolang]);
if (!empty($seoDB['description_' . $seolang])) $seo->setSeo('description', $seoDB['description_' . $seolang]);

$titleContainer = (!empty($seo->getSeo('h1'))) ? $seo->getSeo('h1') : $title_seo;
$str_breadcrumbs = $breadcrumbs->getUrl('Trang chủ', array(array('alias' => $com, 'name' => $title_seo)));
