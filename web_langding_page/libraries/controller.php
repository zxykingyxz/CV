<?php
$func->checkURL();
$func->checkUrlRedirect();
/* Router */
$router->setBasePath($config['website']['url']);
$router->map('GET', array(ADMIN . '/', ADMIN), function () {
	global $func, $config;
	$func->redirect($config['website']['url'] . ADMIN . "/index.html");
	exit;
});
$router->map('GET', array(ADMIN, ADMIN), function () {
	global $func, $config;
	$func->redirect($config['website']['url'] . ADMIN . "/index.html");
	exit;
});
$router->map('GET|POST', '', 'index');
$router->map('GET|POST', 'index.php', 'index', 'index');
$router->map('GET|POST', 'sitemap.xml', 'sitemap', 'sitemap');

if ($config['lang_check']) {
	$router->map('GET|POST', '[lang:lang]/', '', '');
	$router->map('GET|POST', '[lang:lang]/[a:com]', '', '');
} else {
	$router->map('GET|POST', '[a:com]', '', '');
}

// hình ảnh thường
$router->map('GET', _thumbs . '/[i:w]x[i:h]x[i:z]/[**:src]', function ($w, $h, $z, $src) {
	global $func;
	$func->createThumb($w, $h, $z, $src, null, _thumbs);
}, 'thumb');

// Đóng dấu logo
$data_watermark = $cache->getCache("select hienthi,photo,options from #_bannerqc where type=? ", array('watermark'), 'fetch', _TIMECACHE);
$router->map('GET', _watermark . '/product/[i:w]x[i:h]x[i:z]/[**:src]', function ($w, $h, $z, $src) {
	global $func, $data_watermark;
	$func->createThumb($w, $h, $z, $src, $data_watermark, "product");
}, 'watermark');

$match = $router->match();

if (is_array($match)) {
	if (is_callable($match['target'])) {
		call_user_func_array($match['target'], $match['params']);
	} else {
		$com = (isset($match['params']['com'])) ? htmlspecialchars($match['params']['com']) : htmlspecialchars($match['target']);
		$page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 1;
		// if ($config['website']['show-tool']) $func->pageTime();
		if ($com == 'download') $func->dowloadFolder(_root);
		if ($com == 'min' && $page == 'max') $func->pagePage();
	}
} else {
	header('HTTP/1.0 404 Not Found', true, 404);
	include("404.php");
	exit;
}

/* Lang */
if (!empty($match['params']['lang'])) $_SESSION['lang'] = $match['params']['lang'];
else if (empty($_SESSION['lang']) && empty($match['params']['lang'])) $_SESSION['lang'] = $row_setting['lang_default'];
$lang = $_SESSION['lang'];
// /* Check lang */
$weblang = (!empty($config['lang'])) ? array_keys($config['lang']) : array();
if (!in_array($lang, $weblang)) {
	$_SESSION['lang'] = 'vi';
	$lang = $_SESSION['lang'];
}
if ($config['lang_check']) {
	foreach ($translate[$lang] as $key => $value) {
		if ($com == $value) {
			$com = $key;
			break;
		}
	}
}


/* SEO Lang */
$seolang = $lang;

$attr_com = array(
	array("tbl" => "info", "field" => "id", "source" => "info", "com" => "gioi-thieu", "type" => "gioi-thieu", 'sitemap' => true),

	array("tbl" => "baiviet", "field" => "id", "source" => "products", "com" => "dien-tu", "type" => "dien-tu", 'sitemap' => true),

	array("tbl" => "baiviet_cat", "field" => "idc", "source" => "products", "com" => "dien-tu", "type" => "dien-tu", 'sitemap' => true),

	array("tbl" => "baiviet_list", "field" => "idl", "source" => "products", "com" => "dien-tu", "type" => "dien-tu", 'sitemap' => true),

	array("tbl" => "baiviet", "field" => "id", "source" => "products", "com" => "dien-lanh", "type" => "dien-lanh", 'sitemap' => true),

	array("tbl" => "baiviet_cat", "field" => "idc", "source" => "products", "com" => "dien-lanh", "type" => "dien-lanh", 'sitemap' => true),

	array("tbl" => "baiviet_list", "field" => "idl", "source" => "products", "com" => "dien-lanh", "type" => "dien-lanh", 'sitemap' => true),

	array("tbl" => "baiviet", "field" => "id", "source" => "products", "com" => "do-gia-dung", "type" => "do-gia-dung", 'sitemap' => true),

	array("tbl" => "baiviet_cat", "field" => "idc", "source" => "products", "com" => "do-gia-dung", "type" => "do-gia-dung", 'sitemap' => true),

	array("tbl" => "baiviet_list", "field" => "idl", "source" => "products", "com" => "do-gia-dung", "type" => "do-gia-dung", 'sitemap' => true),

	array("tbl" => "baiviet", "field" => "id", "source" => "products", "com" => "hang-trung-bay", "type" => "hang-trung-bay", 'sitemap' => true),

	array("tbl" => "baiviet_cat", "field" => "idc", "source" => "products", "com" => "hang-trung-bay", "type" => "hang-trung-bay", 'sitemap' => true),

	array("tbl" => "baiviet_list", "field" => "idl", "source" => "products", "com" => "hang-trung-bay", "type" => "hang-trung-bay", 'sitemap' => true),

	array("tbl" => "baiviet", "field" => "id", "source" => "brand", "com" => "thuong-hieu", "type" => "thuong-hieu", 'sitemap' => true),

	array("tbl" => "baiviet", "field" => "id", "source" => "products", "com" => "tin-tuc", "type" => "tin-tuc", 'sitemap' => true),

	array("tbl" => "baiviet", "field" => "id", "source" => "products", "com" => "chinh-sach", "type" => "chinh-sach", 'sitemap' => true),

	array("tbl" => "baiviet", "field" => "id", "source" => "products", "com" => "tac-gia", "type" => "tac-gia", 'sitemap' => false),

	array("tbl" => "contact", "field" => "id", "source" => "contact", "com" => "lien-he", "type" => "lien-he", 'sitemap' => true),

	array("tbl" => "photo", "field" => "id", "source" => "products", "com" => "bo-suu-tap", "type" => "bo-suu-tap", 'sitemap' => false),

);

include_once _source . "langWeb/lang_$lang.php";

include_once _source  . "defaults.php";

include_once _source  . "validateForm.php";
// routers
include_once _source  . "auth.php";

switch ($com) {

	case 'sitemap':
		include_once "sitemap.php";

		exit();
	case '':
	case 'index':
		$title_seo = $row_setting["name_$lang"];
		$source = 'index';
		$template = 'index';
		$seo->setSeo('type', 'website');
		break;
	default:
		header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
		$template = "error/404";
		break;
}

if (!empty($source)) include_once _source  . $source . ".php";

include_once _source  . "changeLink.php";
