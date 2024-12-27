<?php

use function Composer\Autoload\includeFile;

if (!defined('_source')) die("Error");

/* SEO */
$seoDB = $seo->getSeoDB(0, 'setting', 'capnhat', '');

if (!empty($seoDB['title_' . $seolang])) $seo->setSeo('h1', $seoDB['title_' . $seolang]);

if (!empty($seoDB['title_' . $seolang])) $seo->setSeo('title', $seoDB['title_' . $seolang]);

if (!empty($seoDB['keywords_' . $seolang])) $seo->setSeo('keywords', $seoDB['keywords_' . $seolang]);

if (!empty($seoDB['description_' . $seolang])) $seo->setSeo('description', $seoDB['description_' . $seolang]);

$seo->setSeo('url', $func->getCurrentPageURL());

$seo->setSeo('type', (!empty($obj_type) ? $obj_type : ''));

$img_json_bar = (isset($seoPage['options']) && $seoPage['options'] != '') ? json_decode($seoPage['options'], true) : null;

if ($img_json_bar == null || ($img_json_bar['p'] != $seoPage['photo'])) {
    if (isset($seoPage['photo']) && !empty($seoPage['photo'])) {
        $img_json_bar = $func->getImgSize($seoPage['photo'], _upload_hinhanh_l . $seoPage['photo']);
    } else {
        // Xử lý khi không có thông tin ảnh
        $img_json_bar = null;  // Hoặc giá trị mặc định
    }
    if (!empty($img_json_bar)) {
        $seo->updateSeoDB(json_encode($img_json_bar), 'photo', $seoPage['id']);
    }
}

if (is_array($img_json_bar) && count($img_json_bar) > 0) {
    // Đảm bảo $img_json_bar là mảng và có phần tử
    $seo->setSeo('photo', $https_config . _upload_hinhanh_l . $seoPage['photo']);

    $seo->setSeo('photo:width', $img_json_bar['w']);
    $seo->setSeo('photo:height', $img_json_bar['h']);
    $seo->setSeo('photo:type', $img_json_bar['m']);
}
