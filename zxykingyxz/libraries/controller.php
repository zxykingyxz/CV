<?php

$func->createFolder("cache");

$router->setBasePath($config['website']['url']);

$router->map('GET|POST', '', 'index', 'home');
$router->map('GET|POST', 'index.php', 'index', 'index_page');
$router->map('GET|POST', '[a:com]', '', '');

$match = $router->match();

if (is_array($match)) {
    if (is_callable($match['target'])) {
        call_user_func_array($match['target'], $match['params']);
    } else {
        $_COM = isset($match['params']['com']) ? htmlspecialchars($match['params']['com']) : ($match['target'] ? htmlspecialchars($match['target']) : 'index');
        $_PAGE = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 1;
    }
} else {
    header('HTTP/1.0 404 Not Found', true, 404);
    include_once _TEMPLATES . 'error/404.php';
    exit;
}

include_once _SOURCES . "handleData/paramData.php";
include_once _SOURCES . 'handleData/handleReports.php';

switch ($_COM) {
    case '':
    case 'index':
        $template = "form/default";
        $source = 'index';
        break;
    case 'ngansach':
    case 'baocao':
    case 'settings':
        $template = "form/default";
        $source = $_SRC;
        break;
    default:
        $template = "error/404";
        break;
}
if (!empty($source)) include_once _SOURCES  . $source . ".php";
