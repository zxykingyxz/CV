<?php if (!defined('_source')) die("Error");

$folder = _upload_hinhanh;

switch ($act) {
	case "man":
		$apiPhotos->getMans();
		$template = "photo/photos";
		break;
	case "add":
		$template = "photo/photo_add";
		break;
	case "edit":
		$apiPhotos->getMan();
		$template = "photo/photo_add";
		break;
	case "save":
		$apiPhotos->saveMan();
		break;
	case "delete":
		$apiPhotos->deleteMan();
		break;
	default:
		$template = "index";
}
