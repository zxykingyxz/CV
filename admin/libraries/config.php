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
	'load_all' => false,
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
	$config['database']['dbname'] = "db_1_defaul_edit";
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
	'en' => 'En',
);
#Chung
$config['function'] = array(
	'advancedSearch' => true,
	'product_viewed' => true,
	'product_liked' => true,
);

# Ngôn ngữ
$config['lang_check'] = false;
# GG Dịch
$config['gg_lang'] = true;
# Tài Khoản
$config['account']['action'] = array(
	"action" => true,
);
# Giỏ Hàng
$config['cart'] = array(
	'turn_on' => true,
	'flash_sale' => true,
	'coupons' => true,
	'cart_advance' => false,
	'cart_qty' => true,
);
# Thay đổi đường link khi up web
$config['change_img_contents'] = array(
	'change' => true,
	'url_old' => 'https://demo7-php8.iwebvietnam.com/midtown_0021224w/',
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
// cài đặt admin
$config['login_lock'] = array(
	"login_attempts" => 5,
	"lock_time" => 1 * 60 * 60 * 1000,
);

/* Error reporting */
error_reporting(($config['website']['error-reporting']) ? E_ALL : 0);
/* Cấu hình base */
class checkSSL
{
	public function redirectphp($url)
	{
		$url = str_replace('https//', '', $url);
		$url = str_replace('https/', 'https://', $url);
		$arrayurl = explode('://', $url);
		if (count($arrayurl) == 3) {
			$url = $arrayurl[0] . '://' . $arrayurl[2];
		}
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: $url");
	}
	public function getCurrentPageURLSSL()
	{
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {
			$pageURL .= "s";
		}
		$pageURL .= "://";
		$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
		return $pageURL;
	}
	public function getProtocol()
	{
		// Kiểm tra nếu có header 'X-Forwarded-Proto' (cho trường hợp reverse proxy)
		if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
			return 'https://';
		}
		// Kiểm tra $_SERVER["HTTPS"] nếu tồn tại
		if (isset($_SERVER["HTTPS"]) && ($_SERVER["HTTPS"] == "on" || $_SERVER["HTTPS"] == "1")) {
			return 'https://';
		}
		// Mặc định là HTTP
		return 'http://';
	}

	public function checkTimeSSL($domainName)
	{
		$url = $domainName;
		$orignal_parse = parse_url($url, PHP_URL_HOST);
		$get = stream_context_create(array("ssl" => array("capture_peer_cert" => TRUE)));
		$read = stream_socket_client("ssl://" . $orignal_parse . ":443", $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $get);
		$cert = stream_context_get_params($read);
		$certinfo = openssl_x509_parse($cert['options']['ssl']['peer_certificate']);
		if (strpos($orignal_parse, 'www') !== false) {
			$orignal_parse = str_replace("www.", "", $orignal_parse);
		}
		if ($certinfo['extensions']['subjectAltName'] != "") {
			$cer_domainlist = explode(",", $certinfo['extensions']['subjectAltName']);
			$cer_domainlist = array_map('trim', $cer_domainlist);
			$check_domain = "DNS:" . $orignal_parse;
			if (!in_array($check_domain, $cer_domainlist)) {
				$arrayInfossl = array('songay' => 0, 'version' => $certinfo['version']);
			} else {
				$arrayInfossl = array('songay' => $certinfo['validTo_time_t'], 'version' => $certinfo['version']);
			}
		} else {
			$arrayInfossl = array('songay' => $certinfo['validTo_time_t'], 'version' => $certinfo['version']);
		}
		return $arrayInfossl;
	}
	public function changeDomainssl($domainName)
	{
		$arrayDomain = explode("://", $domainName);
		if ($arrayDomain[0] == 'http') {
			$stringDomainName = str_replace('http:', 'https:', $domainName);
			$this->redirectphp($stringDomainName);
		}
	}
	public function checkChangSLL($runDomainName, $arrayConfig)
	{
		$flagdomain = 1;
		$DomainRun = $_SERVER["SERVER_NAME"];
		if (in_array($DomainRun, $arrayConfig)) {
			$flagdomain = 1;
		} else {
			$flagdomain = 0;
			$runDomainName = 'http://' . $arrayConfig['0'] . $_SERVER["REQUEST_URI"];
		}

		//kiem tra han
		$arrayinfossl = $this->checkTimeSSL($runDomainName);
		/*if($arrayinfossl['songay']=='' && $arrayinfossl['version']==''){
				die("Error: Unable to check certificate. Please check function checkTimeSSL() !");
			}*/
		$timeSLL = $arrayinfossl['songay'];
		$version = $arrayinfossl['version'];

		$NgayHienTai = date('d-m-Y', time());
		$soNgayConLaitInt = $timeSLL - strtotime($NgayHienTai);
		$soNgayConLai = (int)($soNgayConLaitInt / 24 / 60 / 60);

		$arrayDomain = explode("://", $runDomainName);

		if ($soNgayConLai >= 1 && $version > 0) {
			$this->changeDomainssl($runDomainName);
		} else {
			if ($flagdomain == 0) {
				//do nothing
			} else {
				if ($arrayDomain[0] == 'https') {
					$stringDomainName = str_replace('https:', 'http:', $runDomainName);
					$this->redirectphp($stringDomainName);
				}
			}
		}
	}
}
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
if (!defined('_lib')) die("Error");
/* Array folders */
$upload_const = 'upload';
$array_const = array('album', 'baiviet', 'user', 'temp', 'files', 'hinhanh', 'images', 'logs', 'seopage', 'video', 'tailwindcss');
$check_file = (strpos(_ROOT, 'ajax') === false) && (strpos(_ROOT, 'i-web') === false);

/* Define - Create folders upload */
if (!file_exists(_ROOT . '/' . $upload_const) && $check_file) {
	mkdir(_ROOT . '/' . $upload_const, 0777, true);
	chmod(_ROOT . '/' . $upload_const, 0777);
}

/* Define - Create folders childs */
if (!empty($array_const)) {
	$path_htaccess = _ROOT . '/' . $upload_const . '/.htaccess';
	if (!file_exists($path_htaccess) && $check_file) {
		$content_htaccess = '';
		$content_htaccess .= '<Files ~ "\.(inc|sql|php|cgi|pl|php4|php5|asp|aspx|jsp|txt|kid|cbg|nok|shtml)$">' . PHP_EOL;
		$content_htaccess .= 'order allow,deny' . PHP_EOL;
		$content_htaccess .= 'deny from all' . PHP_EOL;
		$content_htaccess .= '</Files>';

		$file_htaccess = fopen($path_htaccess, "w") or die("Unable to open file");
		fwrite($file_htaccess, $content_htaccess);
		fclose($file_htaccess);
	}
	foreach ($array_const as $vconst) {
		$define_lower_upload = strtolower($upload_const);
		$define_lower_const = strtolower($vconst);
		$define_lower_const = $vconst;
		$define_in = '../' . $upload_const . '/' . $define_lower_const . '/';
		$define_out = $upload_const . '/' . $define_lower_const . '/';
		if (!defined($define_lower_upload . '_' . $define_lower_const) && !defined($define_lower_upload . '_' . $define_lower_const . '_l')) {
			define('_' . $define_lower_upload . '_' . $define_lower_const, $define_in);
			define('_' . $define_lower_upload . '_' . $define_lower_const . '_l', $define_out);
			if (!file_exists(_ROOT . '/' . $upload_const . '/' . $define_lower_const) && $check_file) {
				mkdir(_ROOT . '/' . $upload_const . '/' . $define_lower_const, 0777, true);
				chmod(_ROOT . '/' . $upload_const . '/' . $define_lower_const, 0777);
			}
		}
	}
}
