<?php

if (!defined('_lib')) die("Errors");
date_default_timezone_set('Asia/Ho_Chi_Minh');
// ------------ meta ----------
$config['arrayDomainSSL'] = array();
// ------- cấu hình web -------
$config['website'] = array(
	'server-name' => $_SERVER['SERVER_NAME'],
	'url' => '/',
	'debug-css' => false,
	'debug-js' => false,
	'show-tool' => true,
	'isCache' => true,
	'debug-developer' => true,
	'debug-responsive' => true,
	'error-reporting' => true,
	'robots' => 'index,follow',
	'image' => array(
		'hasWebp' => false
	),
	'upload' => array(
		'max-width' => 1600,
		'max-height' => 1600
	),
);
// -------- giao diện -----------
$config['layouts'] = array(
	'load_all' => false,
	'paging' => false,
	'tap_list' => true,
	'is_search' => true,
	'filter_search' => false,
	'menu-full' => true,
);
// ------- cơ sở dữ liệu -----
$config['database'] = array(
	'type' => 'mysql',
	'host' => 'localhost',
	'url' => '/upload/',
	'port' => 3306,
	'prefix' => 'table_',
	'charset' => 'utf8mb4'
);
if ((strpos($_SERVER['DOCUMENT_ROOT'], 'laragon')) || (strpos($_SERVER['DOCUMENT_ROOT'], 'xampp'))) {
	$config['database']['dbname'] = "db_hethongkho";
	$config['database']['username'] = "root";
	$config['database']['password'] = "";
} else {
	$config['database']['dbname'] = "iwebvietna_mautp_one";
	$config['database']['username'] = "iwebvietna_mautp_one";
	$config['database']['password'] = "5s94TnSnmeUd7drz8wfZ";
}


// ------ Cấu hình Email ------
$config['optionsEmail'] = array(
	'mailertype' => 1,
	'ip_host' => 'mail93219.maychuemail.com',
	'port_host' => 465,
	'secure_host' => 'ssl',
	'email_host' => 'test@i-web.vn',
	'password_host' => '2Sn76K4pT4',
	'host_gmail' => '',
	'port_gmail' => '',
	'email_gmail' => '',
	'password_gmail' => '',
);
// ---- cài đặt đăng nhập admin ----
$config['login-lock'] = array(
	'attempt' => 5,
	'delay' => 15
);
// ------ trạng thái mua hàng ------
$config['order-status'] = array(
	1 => array(
		"name" => "Chưa thanh toán",
		"color" => "#007bff",
	),
	2 => array(
		"name" => "Đã thanh toán",
		"color" => "#37a000",
	),
	3 => array(
		"name" => "Đã hủy",
		"color" => "#a71d2a",
	),
);
// --------- webmaster ---------
$config['author'] = array(
	'name' => 'Nguyễn Nhật Quang',
	'email' => 'nguyennhatquang.iweb@gmail.com',
	'create' => date('d/m/Y H:i:s')
);
// -------- ngôn ngữ web --------
$config['lang'] = array(
	'vi' => 'Vi',
	// 'en' => 'En',
);
$config['seo-lang'] = array(
	'vi' => 'Vi',
	// 'en' => 'En',
);
// -------- Các chức năng --------
#Chung
$config['function'] = array(
	'advancedSearch' => false,
);
# Ngôn ngữ
$config['lang_check'] = false;
# GG Dịch
$config['gg_lang'] = false;
# Tài Khoản
$config['account']['action'] = array(
	"action" => true,
);
$config['like_product'] = false;
# Giỏ Hàng
$config['cart'] = array(
	'turn_on' => false,
	'cart-advance' => true,
	'cart-qty' => true,
	'flash_sale' => false,
	'coupon_cart' => true,
);
$config['cart']['attribute'] = array(
	'view_update' => true,
);
# Thay đổi đường link khi up web
$config['change_img_contents'] = array(
	'change' => true,
	'url_old' => 'http://demo6.iwebvietnam.vn/tenwebdemo/',
);
# Save cache
$config['cache'] = array(
	'save_cache_temple' => false,
);
// -------- ID Fanpage --------
$config['faceid'] = "582534979152027";
$config['facebook-id'] = "";
// -------- Đầu mã hóa --------
$config['secret'] = '@287Rzx_^!*95&';
// -------- Đuôi mã hóa --------
$config['salt'] = '^29#_%z/@$';
// -------- CSRF --------
$config['csrf'] = true;
/* Error reporting */
error_reporting(($config['website']['error-reporting']) ? E_ALL : 0);
/* Cấu hình base */
require_once _lib . 'checkSSL.php';
$check_ssl = new checkSSL();
$http = $check_ssl->getProtocol();
$config_url = $config['website']['server-name'] . $config['website']['url'];
$https_config = $http . $config_url;
define('ADMIN', 'i-web');
define('LOGINADMIN', 'IWEBCO');
define('_TOKEN', '0290324TG');
define('_basename', str_replace(basename(__DIR__), '', __DIR__));
define('_asset', $https_config);
$loginMember = 'signin';
// cấu hình upload
require_once _lib . "constant.php";
