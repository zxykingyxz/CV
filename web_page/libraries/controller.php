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
	array("tbl" => "baiviet", "field" => "id", "source" => "products", "com" => "gioi-thieu", "type" => "gioi-thieu", 'sitemap' => true),

	array("tbl" => "baiviet", "field" => "id", "source" => "products", "com" => "san-pham", "type" => "san-pham", 'sitemap' => true),

	array("tbl" => "baiviet_item", "field" => "idi", "source" => "products", "com" => "san-pham", "type" => "san-pham", 'sitemap' => true),

	array("tbl" => "baiviet_cat", "field" => "idc", "source" => "products", "com" => "san-pham", "type" => "san-pham", 'sitemap' => true),

	array("tbl" => "baiviet_list", "field" => "idl", "source" => "products", "com" => "san-pham", "type" => "san-pham", 'sitemap' => true),

	array("tbl" => "baiviet", "field" => "id", "source" => "products", "com" => "dich-vu", "type" => "dich-vu", 'sitemap' => true),

	array("tbl" => "baiviet_item", "field" => "idi", "source" => "products", "com" => "dich-vu", "type" => "dich-vu", 'sitemap' => true),

	array("tbl" => "baiviet_cat", "field" => "idc", "source" => "products", "com" => "dich-vu", "type" => "dich-vu", 'sitemap' => true),

	array("tbl" => "baiviet_list", "field" => "idl", "source" => "products", "com" => "dich-vu", "type" => "dich-vu", 'sitemap' => true),

	array("tbl" => "baiviet", "field" => "id", "source" => "products", "com" => "du-an", "type" => "du-an", 'sitemap' => true),

	array("tbl" => "baiviet_item", "field" => "idi", "source" => "products", "com" => "du-an", "type" => "du-an", 'sitemap' => true),

	array("tbl" => "baiviet_cat", "field" => "idc", "source" => "products", "com" => "du-an", "type" => "du-an", 'sitemap' => true),

	array("tbl" => "baiviet_list", "field" => "idl", "source" => "products", "com" => "du-an", "type" => "du-an", 'sitemap' => true),

	array("tbl" => "baiviet", "field" => "id", "source" => "products", "com" => "tin-tuc", "type" => "tin-tuc", 'sitemap' => true),

	array("tbl" => "baiviet_item", "field" => "idi", "source" => "products", "com" => "tin-tuc", "type" => "tin-tuc", 'sitemap' => true),

	array("tbl" => "baiviet_cat", "field" => "idc", "source" => "products", "com" => "tin-tuc", "type" => "tin-tuc", 'sitemap' => true),

	array("tbl" => "baiviet_list", "field" => "idl", "source" => "products", "com" => "tin-tuc", "type" => "tin-tuc", 'sitemap' => true),

	array("tbl" => "baiviet", "field" => "id", "source" => "products", "com" => "chinh-sach", "type" => "chinh-sach", 'sitemap' => true),

	array("tbl" => "baiviet", "field" => "id", "source" => "products", "com" => "tac-gia", "type" => "tac-gia", 'sitemap' => false),

	array("tbl" => "contact", "field" => "id", "source" => "contact", "com" => "lien-he", "type" => "lien-he", 'sitemap' => true),

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

		$seo->setSeo('type', isset($_GET['id']) ? "article" : "object");

		$source = "products";

		$template = isset($_GET['id']) ? "pages_detail/news_detail" : "pages/default";

		break;
	case 'san-pham':

		$title_seo = $authArrs[$com]['title'];

		$type = "san-pham";

		$seo->setSeo('type', isset($_GET['id']) ? "article" : "object");

		$source = "products";

		$template = isset($_GET['id']) ? "pages_detail/product_detail" : "pages/default";

		break;
	case 'dich-vu':

		$title_seo = $authArrs[$com]['title'];

		$type = "dich-vu";

		$seo->setSeo('type', isset($_GET['id']) ? "article" : "object");

		$source = "products";

		$template = isset($_GET['id']) ? "pages_detail/news_detail" : "pages/default";

		break;
	case 'du-an':

		$title_seo = $authArrs[$com]['title'];

		$type = "du-an";

		$seo->setSeo('type', isset($_GET['id']) ? "article" : "object");

		$source = "products";

		$template = isset($_GET['id']) ? "pages_detail/project_detail" : "pages/default";

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
