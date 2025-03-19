<?php	if(!defined('_source')) die("Error");
$folder=_upload_avatar;
switch($act){
	case "man":
		$apiProduct->getMans();
		$template = "thanhvien/items";
		break;
	case "add":
		$template = "thanhvien/item_add";
		break;
	case "edit":
		$apiProduct->getMan();
		$template = "thanhvien/item_add";
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