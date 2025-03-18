<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
defined('_ROOT') ?:  define('_ROOT',  __DIR__);
defined('_DS') ?:  define('_DS', DIRECTORY_SEPARATOR);
defined('_LIB') ?:  define('_LIB', _ROOT . _DS . '../' . _DS . 'libraries' . _DS);
defined('_SOURCES') ?:  define('_SOURCES', _ROOT . _DS . '../' . _DS . 'sources' . _DS);
defined('_TEMPLATES') ?:  define('_TEMPLATES', _ROOT . _DS . '../' . _DS . 'templates' . _DS);
defined('_VIEWS') ?:  define('_VIEWS', _ROOT . _DS . '../' . _DS . 'views' . _DS);
defined('_FORM') ?:  define('_FORM', _TEMPLATES . 'form' . _DS);
defined('_LAYOUTS') ?:  define('_LAYOUTS', _TEMPLATES . 'layouts' . _DS);

include_once _LIB . "config.php";
include_once _SOURCES . 'handleData/dataDefault.php';
