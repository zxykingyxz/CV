<?php	if(!defined('_source')) die("Error");
$folder=_upload_album;
switch($act){
	case "man":
		$apiProduct->getMans();
		$template = "album/man/items";
		break;
	case "add":		
		$template = "album/man/item_add";
		break;
	case "edit":		
		$apiProduct->getMan();
		$template = "album/man/item_add";
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