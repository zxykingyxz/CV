<?php 
	require_once 'ajaxConfig.php';
	@$id=(int)$_GET['id'];
	@$type=(string)$_GET['type'];
	@$url=(string)$_GET['url'];
	$sql='select ten_vi as ten,mota_vi as mota,daytin from table_baiviet where id='.$id.' and type="'.$type.'"';
	$news=$db->rawQueryOne($sql);
    if($news['daytin']==1){
		$func->sendMessage($news['ten'],$news['mota'],$url);
		echo 1;
    }
?>