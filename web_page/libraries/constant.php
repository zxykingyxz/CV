<?php
if (!defined('_lib')) die("Error");
/* Array folders */
$upload_const = 'upload';
$array_const = array('album', 'baiviet', 'user', 'temp', 'files', 'hinhanh', 'images', 'logs', 'seopage', 'video', 'tailwindcss');

/* Define - Create folders upload */
if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $config['website']['url'] . $upload_const) && $check_file) {
	mkdir($_SERVER['DOCUMENT_ROOT'] . $config['website']['url'] . $upload_const, 0777, true);
	chmod($_SERVER['DOCUMENT_ROOT'] . $config['website']['url'] . $upload_const, 0777);
}
/* Define - Create folders childs */
if (!empty($array_const)) {
	$path_htaccess = $_SERVER['DOCUMENT_ROOT'] . $config['website']['url'] . $upload_const . '/.htaccess';
	if (!file_exists($path_htaccess)) {
		if (is_writable(dirname($path_htaccess))) {
			$content_htaccess = '';
			$content_htaccess .= '<Files ~ "\.(inc|sql|php|cgi|pl|php4|php5|asp|aspx|jsp|txt|kid|cbg|nok|shtml)$">' . PHP_EOL;
			$content_htaccess .= 'order allow,deny' . PHP_EOL;
			$content_htaccess .= 'deny from all' . PHP_EOL;
			$content_htaccess .= '</Files>';

			$file_htaccess = fopen($path_htaccess, "w");
			if ($file_htaccess) {
				fwrite($file_htaccess, $content_htaccess);
				fclose($file_htaccess);
				chmod($path_htaccess, 0644);
			} else {
				trigger_error("Không thể mở file .htaccess để ghi", E_USER_WARNING);
			}
		} else {
			trigger_error("Thư mục không có quyền ghi!", E_USER_WARNING);
		}
	}

	foreach ($array_const as $vconst) {
		$define_lower_upload = strtolower($upload_const);
		$define_lower_const = strtolower($vconst);
		$define_in = '../' . $upload_const . '/' . $define_lower_const . '/';
		$define_out = $upload_const . '/' . $define_lower_const . '/';
		if (!defined($define_lower_upload . '_' . $define_lower_const) && !defined($define_lower_upload . '_' . $define_lower_const . '_l')) {
			define('_' . $define_lower_upload . '_' . $define_lower_const, $define_in);
			define('_' . $define_lower_upload . '_' . $define_lower_const . '_l', $define_out);
			if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $config['website']['url'] . $upload_const . '/' . $define_lower_const)) {
				mkdir($_SERVER['DOCUMENT_ROOT'] . $config['website']['url'] . $upload_const, 0755, true);
				chmod($_SERVER['DOCUMENT_ROOT'] . $config['website']['url'] . $upload_const, 0755);
			}
		}
	}
}
