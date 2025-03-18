<?php	if(!defined('_source')) die("Error");
switch($act){
	case "man":
		$apiSearchs->getMans();
		$template = "search/items";
		break;
	case "add":		
		$template = "search/item_add";
		break;
	case "edit":		
		$apiSearchs->getMan();
		$template = "search/item_add";
		break;
	case "save":
		$apiSearchs->saveMan();
		break;
		
	case "delete":
		$apiSearchs->deleteMan();
		break;	

	default:
		$template = "index";
}

?>