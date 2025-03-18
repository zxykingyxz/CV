<?php
	session_start();
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , '../libraries/');
	$lang = 'vi';

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."blocker.php";
	include_once _lib."functions.php";
	include_once _lib."functions_main.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";	
	$ds = DIRECTORY_SEPARATOR; 
	$storeFolder = '../upload/multiple/'; 
	if (!empty($_FILES)) {
	    $tempFile = $_FILES['file']['tmp_name'];
	    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;
	    $date = new DateTime();
	    $nametemp=explode('.',$_FILES['file']['name']);
	    $nametemp1=changeTitle($nametemp[0]);
	    $nametemp2=$nametemp[1];
	    $newFileName = $date->getTimestamp().$nametemp1.'.'.$nametemp2;
	    $targetFile =  $targetPath.$newFileName; 
	    move_uploaded_file($tempFile,$targetFile);
	    echo $newFileName;
	}
?>