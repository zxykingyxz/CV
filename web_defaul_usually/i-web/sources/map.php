<?php	if(!defined('_source')) die("Error");

$folder=_upload_hinhanh;

switch($act){
	case "man":
		$apiProduct->getMans();
		$template = "map/items";
		break;
	case "add":
		$template = "map/item_add";
		break;
	case "edit":
		$apiProduct->getMan();
		$template = "map/item_add";
		break;
	case "save":
		$apiProduct->saveMan();
		break;

	case "delete":
		$apiProduct->deleteMan();
		break;

	default:
		$template = "index";
}
?>
