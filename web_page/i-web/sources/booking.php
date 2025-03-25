
<?php if (!defined('_source')) die("Error");
//===========================================================
$folder = 'upload/hinhanh/';
switch ($act) {
	case "man":
		$apiProduct->getMans();
		$template = "booking/man/items";
		break;
	case "add":
		$template = "booking/man/item_add";
		break;
	case "edit":
		$apiProduct->getMan();
		$template = "booking/man/item_add";
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
