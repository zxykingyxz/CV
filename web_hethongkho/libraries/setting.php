<?php

#=================check per===============

$GLOBAL_LANG = false;

$GLOBAL_PERMISSION = false;

#=================check user===============

$GLOBAL_USER = false;

$GLOBAL_USER_ADMIN = true;

$GLOBAL_USER_CLIENT = true;

#================check member================

$MEMBER = false;

$CONTACT = true;

$NEWSLETTER = false;

$WAREHOUSE = true;

/** ARTICLE SETTING*/

$SPECIAL = [];

$PUBLIC = [];

$PRIVATE = [];

$PHOTOS = [];

$PHOTOS = [];

$CART = [];
// =======================seo page======================
$array_option_setting = [
	'san-pham' => 'Sản phẩm',
	'dich-vu' => 'Dịch vụ',
	'du-an' => 'Dự án',
	'tin-tuc' => 'Tin tức',
];
foreach ($array_option_setting as $key_option_setting => $value_option_setting) {
	$setting['seopage']['page'][$key_option_setting] = $value_option_setting;
	$setting['paging'][$key_option_setting] = "Phân Trang " . $value_option_setting;
}

$setting['seopage']['mota'] = true;
$setting['seopage']['mota-ckeditor'] = true;
$setting['seopage']['noidung'] = true;
$setting['seopage']['noidung-ckeditor'] = true;
$setting['seopage']['img-width'] = 300;
$setting['seopage']['img-height'] = 200;
$setting['seopage']['img-ratio'] = 1;
$setting['seopage']['img-b'] = 200;
$setting['seopage']['thumb'] = '300x200x1';
$setting['seopage']['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
$viewArray = array('htgh', 'pttt');

$setting['color'] = array(
	'background-primary' => 'Màu chính',
	'primary-color' => 'Màu chữ text trên menu',
	'second-color' => 'Màu phụ',
);


$folder_global = _lib . "global";
if (is_dir($folder_global) && is_readable($folder_global)) {
	$files = scandir($folder_global);
	foreach ($files as $file) {
		if (file_exists($folder_global . '/' . $file) && !in_array($file, ['.', '..'])) {
			include_once $folder_global . '/' . $file;
		}
	}
}


foreach ($GLOBAL['baiviet'] as $key => $value) {
	if ($value['public']) {
		array_push($PUBLIC, $key);
	} else if ($value['private']) {
		array_push($PRIVATE, $key);
	} else if ($value['special']) {
		array_push($SPECIAL, $key);
	} else if ($value['cart']) {
		array_push($CART, $key);
	}
}
