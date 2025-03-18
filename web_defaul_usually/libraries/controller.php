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
	$router->map('GET|POST', '[lang:lang]/carts.js', 'carts', '');
	$router->map('GET|POST', '[lang:lang]/load.js', 'load', 'load');
} else {
	$router->map('GET|POST', '[a:com]', '', '');
	$router->map('GET|POST', 'carts.js', 'carts', '');
	$router->map('GET|POST', 'load.js', 'load', 'load');
}
$router->map('GET', _thumbs . '/[i:w]x[i:h]x[i:z]/[**:src]', function ($w, $h, $z, $src) {
	global $func;
	$func->createThumb($w, $h, $z, $src, null, _thumbs);
}, 'thumb');
$router->map('GET', _watermark . '/product/[i:w]x[i:h]x[i:z]/[**:src]', function ($w, $h, $z, $src) {
	global $func, $cache;
	$wtm = $cache->getCache("select hienthi,photo,options from #_bannerqc where type=? limit 0,1", array('watermark'), 'fetch', _TIMECACHE);
	$func->createThumb($w, $h, $z, $src, $wtm, "product");
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
if (!empty($com)) {
	foreach ($attr_com as $key => $val) {
		if (!in_array($val['com'], ['lien-he', "bo-suu-tap"])) {
			$urltbl = (!empty($val['tbl'])) ? $val['tbl'] : '';
			$urlfield = (!empty($val['field'])) ? $val['field'] : '';
			$urltype = (!empty($val['type'])) ? $val['type'] : '';
			$urlCom = (!empty($val['com'])) ? $val['com'] : '';
			$row = $db->rawQueryOne("select id,tenkhongdau_vi as slugvi,tenkhongdau_en as slugen from #_{$urltbl} where hienthi=1 and tenkhongdau_$lang=? and type=?", [$com, $urltype]);
			if (!empty($row)) {
				$_GET[$urlfield] = $row['id'];
				$com = $urlCom;
				if ($config['lang_check']) {
					foreach ($config['lang'] as $k => $v) {
						$actLang[$k] = $row['slug' . $k];
					}
				}
				break;
			}
		}
	}
}
include_once _source . "langWeb/lang_$lang.php";

include_once _source  . "defaults.php";

include_once _source  . "validateForm.php";
// routers
include_once _source  . "auth.php";

switch ($com) {
	case 'lien-he':

		$title_seo = $authArrs[$com]['title'];

		$type = "lien-he";

		$seo->setSeo('type', 'object');

		$source = "contact";

		$template = "contacts/contact";

		break;

	case 'gioi-thieu':

		$title_seo = $authArrs[$com]['title'];

		$type = "gioi-thieu";

		$seo->setSeo('type', 'article');

		$source = "baiviet";

		$template = "pages/baiviet";

		break;
	case 'thuong-hieu':

		$title_seo = $authArrs[$com]['title'];

		$type = "thuong-hieu";

		$type_list = ['san-pham', 'dien-tu', 'dien-lanh', 'do-gia-dung', 'hang-trung-bay'];

		$seo->setSeo('type', 'article');

		$source = "brand";

		$template = "pages/default";

		break;
	case 'dien-tu':

		$title_seo = $authArrs[$com]['title'];

		$type = "dien-tu";

		$seo->setSeo('type', isset($_GET['id']) ? "article" : "object");

		$source = "products";

		$template = isset($_GET['id']) ? "pages_detail/product_detail" : "pages/default";

		break;
	case 'dien-lanh':

		$title_seo = $authArrs[$com]['title'];

		$type = "dien-lanh";

		$seo->setSeo('type', isset($_GET['id']) ? "article" : "object");

		$source = "products";

		$template = isset($_GET['id']) ? "pages_detail/product_detail" : "pages/default";

		break;
	case 'do-gia-dung':

		$title_seo = $authArrs[$com]['title'];

		$type = "do-gia-dung";

		$seo->setSeo('type', isset($_GET['id']) ? "article" : "object");

		$source = "products";

		$template = isset($_GET['id']) ? "pages_detail/product_detail" : "pages/default";

		break;
	case 'hang-trung-bay':

		$title_seo = $authArrs[$com]['title'];

		$type = "hang-trung-bay";

		$seo->setSeo('type', isset($_GET['id']) ? "article" : "object");

		$source = "products";

		$template = isset($_GET['id']) ? "pages_detail/product_detail" : "pages/default";

		break;

	case 'tin-tuc':

		$title_seo = $authArrs[$com]['title'];

		$type = "tin-tuc";

		$seo->setSeo('type', isset($_GET['id']) ? "article" : "object");

		$source = "products";

		$template = isset($_GET['id']) ? "pages_detail/news_detail" : "pages/default";

		break;
	case 'chinh-sach':

		$title_seo = $authArrs[$com]['title'];

		$type = "chinh-sach";

		$seo->setSeo('type', isset($_GET['id']) ? "article" : "object");

		$source = "products";

		$template = isset($_GET['id']) ? "pages_detail/news_detail" : "pages/default";

		break;

	case 'tac-gia':

		$title_seo = _tacgia;

		$type = "tac-gia";

		$seo->setSeo('type', isset($_GET['id']) ? "article" : "object");

		$source = "products";

		$template = isset($_GET['id']) ? "pages_detail/author_detail" : "pages/default";

		break;
	case 'tim-kiem':

		$title_seo = $authArrs[$com]['title'];

		$type = ['san-pham', 'dien-tu', 'dien-lanh', 'do-gia-dung', 'hang-trung-bay'];

		$seo->setSeo('type', 'object');

		$source = "filter";

		if (!$func->isAjax()) {

			$template = $config['layouts']['allow_search'] ? "pages/default" : 'error/404';
		}
		break;

	case 'account':

		if (!$config['account']['action']) $func->transfer(_trangkhongtontai, $https_config);

		$title_seo = 'Tài khoản';

		$type = 'user';

		$source = 'users';

		$seo->setSeo('type', "object");

		break;

	case 'tra-cuu':

		$title_seo = "Danh sách đơn hàng";

		$source = "order";

		if (!$func->isAjax()) {

			$template = "pages/order";
		}
		break;
	case 'carts':

		if (!$config['cart']['turn_on']) $func->transfer(_trangkhongtontai, $https_config);

		$title_seo = _giohang;

		$source = "carts";

		$seo->setSeo('type', "object");

		if (!$func->isAjax()) {

			$src = isset($_REQUEST['src']) ? $_REQUEST['src'] : '';

			switch ($src) {

				case 'gio-hang':

					$title_seo = _giohang;

					$template = 'carts/giohang';

					break;

				case 'thanh-toan':

					$title_seo = _thanhtoan;

					$template = 'carts/checkout';

					break;

				default:

					header($_SERVER['SERVER_PROTOCOL'] . " 404 Not Found", true, 404);

					break;
			}

			$str_breadcrumbs = $breadcrumbs->getUrl('Trang chủ', array(array('alias' => 'carts?src=' . $src, 'name' => $title_seo)));
		}
		break;

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
