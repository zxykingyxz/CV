<?php	if(!defined('_source')) die("Error");
$folder=_upload_hinhanh;
switch($act){
	case "man":
		$apiProduct->getMans();
		$template = "video/man/items";
		break;
	case "add":		
		$template = "video/man/item_add";
		break;
	case "edit":		
		$apiProduct->getMan();
		$template = "video/man/item_add";
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