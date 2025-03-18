<?php
/* Set the default timezone */
date_default_timezone_set("Asia/Ho_Chi_Minh");

$lang = $_SESSION['lang_admin'] = (!isset($_SESSION['lang_admin']) || $_SESSION['lang_admin'] == '') ? 'vi' : $_SESSION['lang_admin'];

require_once _libAdmin . 'autoload.php';

new autoload();
$db = new PDODb($config['database']);
$func = new functions($db);
$sample = new ReWorkedTemplate();

$jv0 = 'javascript:void(0)';
$bg_title_table_default = 'bg-gray-600';
$padding_td_table_default = 'px-3 py-2';
// data value
$row_setting = $db->rawQueryOne("select * from #_setting limit 0,1");
$logo = $db->rawQueryOne("select photo from #_bannerqc where hienthi=1 and type=? limit 0,1", array('logo'));
