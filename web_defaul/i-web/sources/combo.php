<?php if (!defined('_source')) die("Error");

$folder = _upload_hinhanh;

switch ($act) {
    case "man":
        $apiCombos->getMans();
        $template = "combo/items";
        break;
    case "add":
        $template = "combo/item_add";
        break;
    case "edit":
        $apiCombos->getMan();
        $template = "combo/item_add";
        break;
    case "save":
        $apiCombos->saveMan();
        break;
    case "delete":
        $apiCombos->deleteMan();
        break;
    default:
        $template = "index";
}
