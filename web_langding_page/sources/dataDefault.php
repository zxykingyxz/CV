<?php
include_once _lib . 'autoload.php';
new autoload();
$injection = new AntiSQLInjection();
$db = new PDODb($config['database']);
$sample = new ReWorkedTemplate();
$func = new functions($db);
$addons = new AddonsOnline();
$cart = new cartFrontEnd($db);
$detect = new MobileDetect;
$router = new AltoRouter();
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
$breadcrumbs = new breadCrumbs($db, $func);
$json_schema = new jsonSchema($db, $func);
$flash = new flash();
$validate = new Validator($func);
$cache = new FileCache($db);
$apiPlace = new place($db, $func);
$seo = new seos($db);
$css = new CssMinify($config['website']['debug-css'], $func);
$js = new JsMinify($config['website']['debug-js'], $func);


$jv0 = 'javascript:void(0)';
