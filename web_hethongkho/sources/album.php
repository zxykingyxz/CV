<?php  if(!defined('_source')) die("Error");

	
	$id =  addslashes($_GET['id']);
	
	$sql = "select * from #_album_cat where hienthi=1 and id='".$id."'";
	$d->query($sql);
	$album_detail = $d->result_array();
	
	#các tin cu hon
	$sql_khac = "select * from #_album_photo where hienthi=1 and id_album ='".$id."' order by id desc";
	$d->query($sql_khac);
	$album_images = $d->result_array();
	
	// cac tin tuc
	
	$sql_tintuc = "select * from #_album where hienthi=1 order by id desc";
	$d->query($sql_tintuc);
	$album = $d->result_array();
	
	
	$title_bar .= $row_meta['title'];
	$keyword_bar .= $row_meta['keywords'];
	$description_bar .= $row_meta['description'];
	
?>