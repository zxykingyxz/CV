<?php	if(!defined('_source')) die("Error");
switch($act){

	case "man":
		$apiProduct->getMans();
		$template = "contact/man/items";
		break;
	case "add":		
		$template = "contact/man/item_add";
		break;
	case "edit":		
		$apiProduct->getMan();
		$template = "contact/man/item_add";
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