<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
error_reporting(E_ALL & ~E_NOTICE & ~8192);
defined('_root') ?:  define('_root',  __DIR__);
defined('_ds') ?:  define('_ds', DIRECTORY_SEPARATOR);
defined('_lib') ?:  define('_lib', _root . _ds . 'libraries' . _ds);
defined('_source') ?:  define('_source', _root . _ds . 'sources' . _ds);
defined('_template') ?:  define('_template', _root . _ds . 'templates' . _ds);
defined('_layouts') ?:  define('_layouts', _template . _ds . 'layouts' . _ds);
defined('_assets') ?:  define('_assets', _root . _ds . 'assets' . _ds);
defined('_css') ?:  define('_css', _assets . _ds . 'css' . _ds);
defined('_views') ?:  define('_views', _root . _ds . 'views' . _ds);
defined('_thumbs') ?:  define('_thumbs', 'thumbs');
defined('_watermark') ?:  define('_watermark', 'watermark');
defined('_TIMECACHE') ?:  define('_TIMECACHE', 2 * 60 * 60);

include_once _lib . "config.php";
include_once _lib . 'autoload.php';
include_once _lib . 'translate.php';
include_once _source . 'autoRobotsTxt.php';

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

include_once _lib . 'controller.php';

switch ($com) {
    case 'quan-ly-kho':
        include_once _template . "warehouse/desktop.php";
        break;
    default:
        include_once _template . "desktop.php";
        break;
}
