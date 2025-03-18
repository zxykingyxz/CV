
<?php	if(!defined('_source')) die("Error");
$folder=_upload_hinhanh;
switch($act){
	case "capnhat":
		$apiPhoto->getPhoto();
		$template = "bannerqc/banner_add";
		break;
	// case "preview-watermark":
	// 	$apiPhoto->previewWatermark();
	// 	break;
	case "save":
		// if($type=='watermark'){
		// 	$apiPhoto->saveWatermark();
		// }else{
		// 	$apiPhoto->savePhoto();
		// }
		$apiPhoto->savePhoto();
		break;
	default:
		$template = "index";
}
?>