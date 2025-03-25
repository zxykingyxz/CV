<?php
	require_once 'ajaxConfig.php';

	@$id_product=$_POST['product'];
	@$value=$_POST['value'];
	@$type=$_POST['type'];
	@$loai=$_POST['loai'];
	if($loai=='idl'){

		$sql="update table_baiviet set id_list='".$value."' where type='".$type."' and id='".$id_product."'";
		$db->rawQuery($sql);
		echo $sql;
	
		$sql="update table_baiviet set id_cat='0' where type='".$type."' and id='".$id_product."'";
		$db->rawQuery($sql);

		$sql="update table_baiviet set id_item='0' where type='".$type."' and id='".$id_product."'";
		$db->rawQuery($sql);

	}
	if($loai=='idc'){
		$sql="update table_baiviet set id_cat='".$value."' where type='".$type."' and id='".$id_product."'";
		$db->rawQuery($sql);

		echo $sql;

		$sql="update table_baiviet set id_item='0' where type='".$type."' and id='".$id_product."'";
		$db->rawQuery($sql);
	}

	if($loai=='idi'){

		$sql="update table_baiviet set id_item='".$value."' where type='".$type."' and id='".$id_product."'";
		$db->rawQuery($sql);

		echo $sql;
	}


	echo 1;
?>