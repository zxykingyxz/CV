<?php 
	require_once 'ajaxConfig.php';
	@$id = (int)$_POST['id'];
	
	$danhmuc_sanpham = $d->rawQuery("select id, ten from table_place_ward where id_dist=".$id." and hienthi=1 order by id asc");

	$ch = '<option value="0">Chọn phường xã</option>';
	foreach ($danhmuc_sanpham as $key => $value) {
		$ch .= '<option value="'.$value['id'].'">'.$value['ten'].'</option>';
	}

	echo $ch;
 ?>