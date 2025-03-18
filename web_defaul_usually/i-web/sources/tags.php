<?php	if(!defined('_source')) die("Error");

$folder=_upload_baiviet;

$folder_img=_upload_hinhanh;



	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";



	switch($act){
        
		case "man":
            $apiProduct->getMans();
            $apiProduct->getPageList();
            $template = "tags/items";
            break;
        case "add":
            $apiProduct->getPageList();
            $template = "tags/item_add";
            break;
        case "edit":
            $apiProduct->getMan();
            $apiProduct->getPageList();
            $template = "tags/item_add";
            break;
        case "save":
            $apiProduct->saveMan();
            break;
        case "copy":
            getCopy();
            $template = "tags/item_add";
            break;
        case 'save_copy':
            saveCopy();
            break;
        case "delete":
            $apiProduct->deleteMan();
            break;
        default:
            $template = "index";

	}

?>



<?php



	function getListItem(){



		global $d, $items, $paging, $page;



		$per_page = 10;



		$startpoint = ($page * $per_page) - $per_page;



		$limit = ' limit '.$startpoint.','.$per_page;



		$where = " #_tags ";



		$where .= " where type='".$_GET['type']."' ";



		if($_REQUEST['keyword']!='')

		{

			$keyword=addslashes($_REQUEST['keyword']);



			$where.=" and ten_vi LIKE '%$keyword%'";



			$link_add .= "&keyword=".$_GET['keyword'];



		}

		$where .=" order by id desc";



		$sql = "select * from $where $limit";



		$d->query($sql);



		$items = $d->result_array();



		$url = "index.php?com=baiviet&act=man&type=".$_GET['type']."&page=".$_GET['page']."";



		$paging = pagination($where,$per_page,$page,$url);



	}



	function getManItem(){



		global $d, $item;



		$id = isset($_GET['id']) ? themdau($_GET['id']) : "";



		if(!$id)

			redirect("index.php?com=tags&act=man&type=".$_GET['type']."&page=".$_GET['page']);



		$sql = "select * from #_tags where id='".$id."'";



		$d->query($sql);



		if($d->num_rows()==0) 

			redirect("index.php?com=tags&act=man&type=".$_GET['type']."&page=".$_GET['page']);



		$item = $d->fetch_array();



	}



	function saveMan(){



		global $d;



		$file_name=images_name($_FILES['file']['name']);

		$file_name1=images_name($_FILES['file1']['name']);



		$id=(int)$_POST['id'];



		$data=$_POST['data'];



		if($_POST){



			foreach($data as $k => $v){



				$send[$k]=htmlspecialchars($v);



			}



		}



		$send['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;



		if($id){



			if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_baiviet,$file_name)){

				$send['photo'] = $photo;

				$d->setTable('tags');

				$d->setWhere('id', $id);

				$d->select();

				if($d->num_rows()>0){

					$row = $d->fetch_array();

					delete_file(_upload_baiviet.$row['photo']);

				}

			}



			$send['ngaysua']=time();



			$d->setTable('tags');



			$d->setWhere('id',$id);



			if($d->update($send)){



				redirect("index.php?com=tags&act=man&type=".$_GET['type']."&page=".$_GET['page']);



			}



		}else{



			if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_baiviet,$file_name)){

				$send['photo'] = $photo;

			}



			$send['ngaytao']=time();



			$d->setTable('tags');



			if($d->insert($send)){



				redirect("index.php?com=tags&act=man&type=".$_GET['type']."&page=".$_GET['page']);



			}



		}

		

	}

	function deleteMan(){



		global $d;



		if(isset($_GET['id'])){



			$id =  themdau($_GET['id']);



			$sql = "delete from #_tags where id='".$id."'";



			if($d->query($sql)){



				redirect("index.php?com=tags&act=man&type=".$_GET['type']."&page=".$_GET['page']);



			}



		}elseif (isset($_GET['listid'])==true){



			$listid = explode(",",$_GET['listid']);

			for ($i=0 ; $i<count($listid) ; $i++){

				$idTin=$listid[$i];

				$id =  themdau($idTin);

				$sql = "delete from #_tags where id='".$id."'";

				$d->query($sql);

			}

			redirect("index.php?com=tags&act=man&type=".$_GET['type']."&page=".$_GET['page']);

		}



	}

?>