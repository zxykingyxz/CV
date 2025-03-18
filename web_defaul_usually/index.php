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
include_once _lib . 'translate.php';
include_once _source . 'autoRobotsTxt.php';
include_once _source . 'dataDefault.php';
include_once _source . 'dataTable.php';
include_once _lib . 'controller.php';

switch ($com) {
    case 'quan-ly-kho':
        include_once _template . "warehouse/desktop.php";
        break;
    default:

        include_once _template . "desktop.php";
        break;
}
