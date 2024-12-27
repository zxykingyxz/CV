<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act)
{
	case "man":
		get_items();
		$template = "coupon/items";
		break;
	case "add":
		$template = "coupon/item_add";
		break;
	case "edit":
		get_item();
		$template = "coupon/item_add";
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
function get_items()
{
	global $d, $items, $paging,$page;

	$per_page = 10;
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;

	$where = " #_coupon ";
	if($_REQUEST['mauudai']!='')
	{
		$mauudai=addslashes($_REQUEST['mauudai']);
		$where.=" where ma LIKE '%$mauudai%'";
		$link_add .= "&mauudai=".$_GET['mauudai'];
	}
	$where .=" order by stt asc, id desc";

	$sql = "select * from $where $limit";
	$d->query($sql);
	$items = $d->result_array();

	$url = "index.php?com=coupon&act=man".$link_add;
	$paging = pagination($where,$per_page,$page,$url);
}

function get_item()
{
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=coupon&act=man");
	
	$sql = "select * from #_coupon where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=coupon&act=man");
	$item = $d->fetch_array();
}

function save_item()
{
	global $d;
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=coupon&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	if($id)
	{
		$id =  themdau($_POST['id']);
		$data['code'] = $_POST['code'];
		$data['percent'] = (int)$_POST['percent'];		
		$data['type'] = (int)$_POST['type'];
		$data['date_start'] = strtotime($_POST['date_start']);
		$data['date_end'] = strtotime($_POST['date_end']);
		$data['status'] = (int)$_POST['status'];
		$data['numb'] = $_POST['numb'];
		
		$d->setTable('coupon');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=coupon&act=man");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=coupon&act=man");
	}
	else
	{ 
		$uudai=(int)$_REQUEST['uudai'];
		for($i=0;$i<$uudai;$i++)
		{
			if((int)$_POST['phantram']>0)
			{
				$data['code'] = $_POST['code'.$i];
				$data['percent'] = (int)$_POST['percent'];		
				$data['type'] = (int)$_POST['type'];
				$data['date_start'] = strtotime($_POST['date_start']);
				$data['date_end'] = strtotime($_POST['date_end']);
				$data['numb'] = $i+1;
				$data['status'] = 0;
				$d->setTable('coupon');
				$d->insert($data);
			}
		}
		redirect("index.php?com=coupon&act=man");
	}
}

function delete_item()
{
	global $d;
	
	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);

		$sql = "delete from #_coupon where id='".$id."'";
		if($d->query($sql))
			header("Location:index.php?com=coupon&act=man");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=coupon&act=man");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_coupon where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			$sql = "delete from #_coupon where id='".$id."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=coupon&act=man");
	}
	else transfer("Không nhận được dữ liệu", "index.php?com=coupon&act=man");
}
?>