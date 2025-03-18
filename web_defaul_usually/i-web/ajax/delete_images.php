<?php
	require_once 'ajaxConfig.php';
	$id=$_POST['id'];
	$table=$_POST['table'];
	$sql = "select id,photo,thumb from #_$table where id='".$id."'";
	$row = $db->rawQuery($sql);

	if(count($row)>0){
		for($i=0;$i<count($row);$i++){
			if($table=='product_photo'){
				$func->deleteLink('../'._upload_product.$row[$i]['photo']);
				$func->deleteLink('../'._upload_product.$row[$i]['thumb']);
			}
			if($table=='album'){
				$func->deleteLink('../'._upload_album.$row[$i]['photo']);
				$func->deleteLink('../'._upload_album.$row[$i]['thumb']);
			}
			if($table=='baiviet_photo'){
				$func->deleteLink('../'._upload_baiviet.$row[$i]['photo']);
				$func->deleteLink('../'._upload_baiviet.$row[$i]['thumb']);
			}
			
		}
		$sql = "delete from #_$table where id='".$id."'";
		$db->rawQuery($sql);
	}
	
?>
