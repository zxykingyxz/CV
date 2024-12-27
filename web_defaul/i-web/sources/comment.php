<?php	if(!defined('_source')) die("Error");

$folder=_upload_user;

switch($act){
	
	#===================================================
	case "man":
		$apiComment->getMans();
		$template = "comment/items";
		break;
	case "add":		
		$template = "comment/item_add";
		break;
	case "edit":		
		$apiComment->getMan();
		$template = "comment/item_add";
		break;
	case "save":
		// $apiComment->saveMan();
		break;
		
	case "delete":
		$apiComment->deleteMan();
		break;	

	default:
		$template = "index";
}
$title_main = "Đánh giá ";