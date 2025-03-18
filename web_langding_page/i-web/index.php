<?php

session_start();
defined('_root') ?:  define('_root', __DIR__);
defined('_ds') ?:  define('_ds', DIRECTORY_SEPARATOR);
defined('_lib') ?:  define('_lib', '..' . _ds . 'libraries' . _ds);
defined('_source') ?:  define('_source', '..' . _ds . 'sources' . _ds);
defined('_libAdmin') ?:  define('_libAdmin', _root . _ds . 'libraries' . _ds);
defined('_sourceAdmin') ?:  define('_sourceAdmin', _root . _ds . 'sources' . _ds);
defined('_views') ?:  define('_views', _root . _ds . 'views' . _ds);
defined('_templates') ?:  define('_templates', _root . _ds . 'templates' . _ds);
defined('_layouts') ?:  define('_layouts', _templates  . 'layouts' . _ds);
defined('_form') ?:  define('_form', _templates  . 'form' . _ds);
defined('_assets') ?:  define('_assets', _root . _ds . 'assets' . _ds);
defined('_thumbs') ?:  define('_thumbs', '../thumbs');
defined('_watermark') ?:  define('_watermark', '../watermark');

include_once _lib . "config.php";
include_once _lib . "setting.php";
include_once _sourceAdmin . "dataDefaul.php";
include_once _sourceAdmin . "dataDefaul.php";
include_once _source . "langWeb/lang_$lang.php";
include_once _libAdmin . "controller.php";
include_once _templates . "handleLayouts.php";
