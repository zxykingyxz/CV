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
	'error-reporting' => false,
	'robots' => 'index,follow',
	'search' => 3,
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
	'load_all' => true,
	'paging' => false,
	'tap_list' => true,
	'allow_search' => true,
	'filter_search' => false,
);
// ------- cơ sở dữ liệu -----
$config['database'] = array(
	'type' => 'mysql',
	'host' => 'localhost',
	'url' => $config['website']['url'] . 'upload/',
	'port' => 3306,
	'prefix' => 'table_',
	'charset' => 'utf8mb4'
);
if ((strpos($_SERVER['DOCUMENT_ROOT'], 'laragon')) || (strpos($_SERVER['DOCUMENT_ROOT'], 'xampp'))) {
	$config['database']['dbname'] = "db_vandinh_0180325tg";
	$config['database']['username'] = "root";
	$config['database']['password'] = "";
} else {
	$config['database']['dbname'] = "iwebvietna_vandinh_0180325tg";
	$config['database']['username'] = "iwebvietna_vandinh_0180325tg";
	$config['database']['password'] = "nTQ3vNRk79DqZPDs59zf";
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
$config['seo-lang'] = $config['lang'];

# Thay đổi đường link khi up web
$config['change_img_contents'] = array(
	'change' => true,
	'url_old' => 'https://demo7-php8.iwebvietnam.com/midtown_0021224w/',
);
# Save cache
$config['cache'] = array(
	'save_cache_temple' => false,
);
# GG Dịch
$config['gg_lang'] = true;
# Giỏ Hàng
$config['cart'] = array(
	'turn_on' => true,
	'cart_advance' => true,
	'cart_qty' => true,
	'price_attribute' => array(
		'attribute_one_for_all' => true,
		'client_edit_attribute' => false,
		'total_price' => true,
		'view_update' => true,
		'required_attribute' => true,
	),
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
// cài đặt admin
$config['login_lock'] = array(
	"login_attempts" => 5,
	"lock_time" => 1 * 60 * 60 * 1000,
);

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
// upload file
require_once _lib . "constant.php";
