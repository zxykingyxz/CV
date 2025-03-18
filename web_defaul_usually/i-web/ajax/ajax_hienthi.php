<?php 
	require_once 'ajaxConfig.php';
	if(isset($_POST["id"])){
		echo $sql = "update ".$_POST["table"]." SET ".$_POST["type"]."=".$_POST["value"]." WHERE  id = ".$_POST["id"]."";
		$data = $db->rawQuery($sql);
	}
?>