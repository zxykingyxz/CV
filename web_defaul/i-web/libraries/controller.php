<?php

$com = (isset($_GET['com'])) ? htmlspecialchars($_GET['com']) : "";
$src = (isset($_GET['src'])) ? htmlspecialchars($_GET['src']) : "";
$act = (isset($_GET['act'])) ? htmlspecialchars($_GET['act']) : "";
$type = (isset($_GET['type'])) ? htmlspecialchars($_GET['type']) : "";
$tbl = (isset($_GET['tbl']) && !empty($_GET['tbl'])) ? '_' . htmlspecialchars($_GET['tbl']) : "";

if (!empty($_SESSION['login'])) {
    $dataAcconutLogged = $func->getInfoAccount();
}
if (((!isset($_SESSION[LOGINADMIN]) || $_SESSION[LOGINADMIN] == false) && $com != "user" && $act != "login") || empty($com)) {
    $func->redirect($func->getUrlParam(["com" => "user", "act" => "login"]));
}
if ((isset($_SESSION[LOGINADMIN]) || $_SESSION[LOGINADMIN] == true) && $com == "user" && $act == "login") {
    $func->redirect($func->getUrlParam(["com" => "index"]));
}

include_once _sourceAdmin  . "dataParam.php";

switch ($com) {
    case 'baiviet':
        $source = "baiviet";
        $form = "default";
        break;
    case 'info':
        $source = "info";
        $form = "default";
        break;
    case 'coupons':
        $source = "coupons";
        $form = "default";
        break;
    case 'flashsale':
        $source = "flashsale";
        $form = "default";
        break;
    case 'user':
        $apiUser = new userAdmin($db, $func);
        $source = "user";
        break;
    default:
        $source = "index";
        $form = "default";
        $template = "index/index";
        break;
}

if (!empty($source)) include_once _sourceAdmin . $source . ".php";
