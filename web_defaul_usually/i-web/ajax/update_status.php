<?php

	require_once 'ajaxConfig.php';

	$table=htmLspecialchars($_POST['table']);

	$id=htmLspecialchars($_POST['id']);

	$val=htmLspecialchars($_POST['val']);

	$type=htmLspecialchars($_POST['type']);

	$data['status']=$val;

	$db->where('id',$id);

	if($db->update($table,$data)){
		$result['status']=1;
	}else{
		$result['status']=0;
	}

	echo json_encode($result);
?>