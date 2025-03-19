<?php	if(!defined('_source')) die("Error");

$folder=_upload_hinhanh;

switch($act){
	case "capnhat":
		$apiSetting->getInfo();
		$template = "setting/item_add";
		break;
	case "save":
		$apiSetting->saveInfo();
		break;
		
	default:
		$template = "index";
}

?>
