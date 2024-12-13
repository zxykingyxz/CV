<?php
if ($config['change_img_contents']['change'] == true) {
    $url_old = $config['change_img_contents']['url_old'];
    $url_news = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $url_news .= $_SERVER['HTTP_HOST'] . '/';
    $table_list = ['_baiviet', '_baiviet_list', '_baiviet_cat', '_baiviet_item', '_seopage'];
    foreach ($table_list as $value) {
        $db->rawQuery("update #$value SET noidung_vi = REPLACE(noidung_vi, '$url_old', '$url_news'), noidung_en = REPLACE(noidung_en, '$url_old', '$url_news') WHERE 1");
    }
}
