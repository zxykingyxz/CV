<?php if (!defined('_source')) die("Error");
$folder = _upload_baiviet;
switch ($act) {
	case "man":
		$apiProduct->getMans();
		$template = "flashsale/man/items";
		break;
	case "add":
		$template = "flashsale/man/item_add";
		break;
	case "edit":
		$apiProduct->getMan();
		$template = "flashsale/man/item_add";
		break;
	case "save":
		$apiProduct->saveMan();
		break;
	case "delete":
		$apiProduct->deleteMan();
		break;
	case "man_info":
		$apiProduct->getMans_flashSale();
		$template = "flashsale/info/items";
		break;
	default:
		$template = "index";
}
