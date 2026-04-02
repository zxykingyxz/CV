<?php
include_once _LIB . 'autoload.php';
new autoload();
$db = new PDODb($config['database']);
$func = new functions($db);
$sample = new ReWorkedTemplate();
$router = new AltoRouter();

$jv0 = 'javascript:void(0)';
$class_title_table_default = 'bg-slate-200 text-slate-900 dark:text-zink-50';
$padding_th_table_default = 'px-3 py-3';
$padding_td_table_default = 'px-3 py-2';

$data_settings_ngansach = $db->rawQueryOne("select * from table_settings where 1 and type='ngan-sach'");

$settings_ngansach = json_decode($data_settings_ngansach['settings'], true);
