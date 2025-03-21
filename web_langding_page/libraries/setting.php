<?php

/** ARTICLE SETTING*/

$SPECIAL = [];

$PUBLIC = [];

$PRIVATE = [];

$PHOTOS = [];

$setting['color'] = array(
	'background-primary' => 'Màu chính',
	'primary-color' => 'Màu chữ text',
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
	}
}
