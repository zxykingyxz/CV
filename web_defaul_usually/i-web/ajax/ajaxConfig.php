<?php

session_start();

defined('_root') ?:  define('_root', __DIR__);

defined('_source1') ?:  define('_source1', '../../sources/langWeb/');

defined('_ds') ?:  define('_ds', DIRECTORY_SEPARATOR);

defined('_lib') ?:  define('_lib', '..' . _ds . '..' . _ds . 'libraries' . _ds);

$lang = $_SESSION['lang_admin'] = (!isset($_SESSION['lang_admin']) || $_SESSION['lang_admin'] == '') ? 'vi' : $_SESSION['lang_admin'];

include_once _lib . "config.php";

include_once _source1 . "lang_$lang.php";

include_once _lib . 'autoload.php';

new autoload();

$db = new PDODb($config['database']);

$func = new functions($db);
