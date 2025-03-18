<?php

switch ($act) {
    case "login":
        if (!empty($_POST) && $func->isAjax()) {
            echo json_encode($apiUser->login());
            exit;
        }
        $template = "user/login";
        break;
    case "logout":
        $apiUser->logOut();
        break;
    case "man":
        $apiUser->getMans();
        $template = "user/items";
        break;
    case "add":
        $template = "user/item_add";
        break;
    case "edit":
        $apiUser->getMan();
        $template = "user/item_add";
        break;
    case "save":
        $apiUser->saveMan();
        break;
    case "delete":
        $apiUser->deleteMan();
        break;
    case "phanquyen":
        $apiUser->perMission();
        $template = "user/phanquyen";
        break;
    case "save_phanquyen":
        $apiUser->savePerMission();
        break;
    default:
        break;
}
