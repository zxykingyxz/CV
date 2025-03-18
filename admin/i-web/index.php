<?php

session_start();
defined('_ROOT') ?:  define('_ROOT', __DIR__);
defined('_DS') ?:  define('_DS', DIRECTORY_SEPARATOR);
defined('_lib') ?:  define('_lib', '..' . _DS . 'libraries' . _DS);
defined('_source') ?:  define('_source', '..' . _DS . 'sources' . _DS);
defined('_LIBADMIN') ?:  define('_LIBADMIN', _ROOT . _DS . 'libraries' . _DS);
defined('_SOURCEADMIN') ?:  define('_SOURCEADMIN', _ROOT . _DS . 'sources' . _DS);
defined('_VIEWS') ?:  define('_VIEWS', _ROOT . _DS . 'views' . _DS);
defined('_TEMPLATES') ?:  define('_TEMPLATES', _ROOT . _DS . 'templates' . _DS);
defined('_LAYOUTS') ?:  define('_LAYOUTS', _TEMPLATES  . 'layouts' . _DS);
defined('_FORM') ?:  define('_FORM', _TEMPLATES  . 'form' . _DS);
defined('_ASSETS') ?:  define('_ASSETS', _ROOT . _DS . 'assets' . _DS);
defined('_THUMBS') ?:  define('_THUMBS', '../thumbs');
defined('_WATERMARK') ?:  define('_WATERMARK', '../watermark');

include_once _lib . "config.php";
include_once _LIBADMIN . "setting/setting.php";
include_once _SOURCEADMIN . "handleData/dataDefaul.php";
include_once _SOURCEADMIN . "handleData/dataParam.php";
include_once _LIBADMIN . "controller.php";
include_once _TEMPLATES . "handleLayouts.php";
