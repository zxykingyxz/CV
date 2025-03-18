<?php

include_once _SOURCEADMIN  . "dataParam.php";

if (!empty($_SESSION['login'])) {
    $dataAcconutLogged = $func->getInfoAccount();
}
if (((!isset($_SESSION[LOGINADMIN]) || $_SESSION[LOGINADMIN] == false) && $_COM != "user" && $_ACT != "login") || empty($_COM)) {
    $func->redirect($func->getUrlParam(["com" => "user", "src" => "user", "act" => "login"]));
}
if ((isset($_SESSION[LOGINADMIN]) || $_SESSION[LOGINADMIN] == true) && $_COM == "user" && $_ACT == "login") {
    $func->redirect($func->getUrlParam(["com" => "index", "src" => "index"]));
}


switch ($_COM) {
    case 'baiviet':
    case 'info':
    case 'coupons':
    case 'flashsale':
        $source = $_SRC;
        break;
    case 'index':
        $layouts = "index/index";
        $source = "index";
        break;
    case 'user':
        $source = $_SRC;
        break;
    default:
        $func->redirect($func->getUrlParam(["com" => "error"]));
        break;
}

if (!empty($source)) include_once _SOURCEADMIN . $source . ".php";
