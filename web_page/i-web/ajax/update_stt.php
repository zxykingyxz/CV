<?php
	require_once 'ajaxConfig.php';
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";	

	$table = $_POST['table'];
	$id = $_POST['id'];
	$value = $_POST['value'];

	$data['stt'] = $value;
	$db->where('id', $id);
	$db->update($table,$data);


?>
	
	