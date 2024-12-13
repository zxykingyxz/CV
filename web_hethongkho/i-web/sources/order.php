<?php	if(!defined('_source')) die("Error");

switch($act){

	case "man":
		$apiCart->getMans();
		$template = "order/items";
		break;
	case "add":		
		$template = "order/item_add";
		break;
	case "edit":
		$apiCart->getMan();
		$template = "order/item_add";
		break;
	case "save":
		$apiCart->saveMan();
		break;
	case "delete":
		$apiCart->deleteMan();
		break;	
	default:
		$template = "index";
}
?>