<?php	if(!defined('_source')) die("Error");
$act = (isset($_GET['act'])) ? addslashes($_GET['act']) : "";

switch($act){
	case "man":
		get_items();
		$template = "com/items";
		break;
	case "add":
		$template = "com/item_add";
		break;
	case "edit":
		get_item();
		$template = "com/item_add";
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
	default:
		$template = "index";
}

function get_items(){
	global $d, $items, $paging,$page;

	$per_page = 10;
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;

	$where = " #_com ";

	if($_REQUEST['hienthi']!='')
	{
	$id_up = $_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_com where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hienthi'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_com SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_com SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	$where .=" order by stt asc, id desc";
	$sql = "select * from $where $limit";
	$d->query($sql);
	$items = $d->result_array();
	
	$url = "index.php?com=com&act=man&type=".$_GET['type']."".$link_add;
	$paging = pagination($where,$per_page,$page,$url);
}

function get_item(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=com&act=man");
	
	$sql = "select * from #_com where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=com&act=man");
	$item = $d->fetch_array();
}

function save_item(){
	global $d;

	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=com&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		$id =  themdau($_POST['id']);
		$data['ten_vi'] = $_POST['ten'];
		$data['com'] = $_POST['ten_com'];
		$data['act_com'] = $_POST['act_com'];
		$data['act'] = $_POST['ten_act'];
		// $data['danhmuc'] = isset($_POST['danhmuc']) ? 1 : 0;
		$data['type'] = $_POST['type'];
		$data['type2'] = $_POST['type2'];
		$data['loaiuser'] = $_POST['loaiuser'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		
		$d->setTable('com');
		$d->setWhere('id', $id);
		if($d->update($data))
			transfer("Dữ liệu đã được cập nhật", "index.php?com=com&act=man");
		else
			transfer("Cập nhật dữ liệu bị lỗi ", "index.php?com=com&act=man");
	}else{

		$data['ten_vi'] = $_POST['ten'];
		$data['com'] = $_POST['ten_com'];
		$data['act_com'] = $_POST['act_com'];
		$data['act'] = $_POST['ten_act'];
		$data['type'] = $_POST['type'];
		$data['type2'] = $_POST['type2'];
		$data['loaiuser'] = $_POST['loaiuser'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		// $data['danhmuc'] = isset($_POST['danhmuc']) ? 1 : 0;
		
		$d->setTable('com');
		if($d->insert($data))
			transfer("Dữ liệu đã được lưu", "index.php?com=com&act=man");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=com&act=man");
	}
}

function delete_item(){
	global $d;
        if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
			$sql = "delete from #_com where id='".$id."'";
			$d->query($sql);
		if($d->query($sql))
			redirect("index.php?com=com&act=man".$id_catt."");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=com&act=man");
	}else transfer("Không nhận được dữ liệu", "index.php?com=com&act=man");}
?>