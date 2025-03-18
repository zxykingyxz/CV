<?php if(!defined('_source')) die('Error');
	
	$folder=_upload_properties;

	switch($act){

		case 'man':

			getMans();

			$template='properties/items';

			break;

		case 'add':

			$template='properties/add_item';

			break;

		case 'edit':

			getMan();

			$template='properties/add_item';

			break;

		case 'save':

			saveMan();

			break;

		case 'delete':

			deleteMan();

			break;

		default:

			$template='404';

			break;

	}

	function getMans(){

		global $db,$func,$type,$com,$url_path,$items,$setting,$table,$paging,$page;

		$table=$setting[$com][$type];

		$perPage = 10;

        $startpoint = ($page * $perPage) - $perPage;
        
        $limit = ' limit '.$startpoint.','.$perPage;

        $where = '#_baiviet_properties';

        $where.=" where type='$type'";

        if(isset($_GET['keywords'])){

        	$where.=' and ten_vi like "%'.$_GET['keywords'].'%"';

        }

        if(isset($_GET['id_product'])){

        	$where.=' and id_product ="'.$_GET['id_product'].'"';

        }

        $where .=" order by stt asc, id desc";

        $items = $db->rawQuery("select * from {$where} {$limit}");

        $url = $func->getCurrentPageURLAdmin();
        
        $count = $db->rawQueryOne("SELECT COUNT(*) as `num` FROM {$where}");

        $total=$count['num'];

        $paging = $func->paginationAdmin($total,$perPage,$page,$url);

	}

	function getMan(){

		global $db,$func,$type, $url_path,$item,$setting,$table;

		$table=$setting[$com][$type];

		$id=(int)$_GET['id'];

		$item=$db->rawQueryOne("select * from #_baiviet_properties where id=? and type=? limit 1", array($id,$type));

		if(empty($item)){

			$response['status']=200;

			$response['message']='Dữ liệu không có thực!';

			$message=base64_encode(json_encode($response));

			$func->redirect("index.html?com=properties&act=man{$url_path}&message={$message}");

		}

	}

	function saveMan(){

		global $db, $com,$func,$folder,$type,$url_path,$setting;

		$id=isset($_GET["id"]) ? (int)$_GET['id'] : 0;

		$table=$setting[$com]['properties'];

		$data=$_POST['data'];

		foreach($data as $k => $v){

			$send[$k]=htmlspecialchars($func->magicQuote($v));

		}

		$file=$_FILES['file'];

		if(!empty($file)){

			if($id){

				if($file['error']==0){

					$photo = $func->uploadImg($id,"photo","thumb",$file,$folder,'baiviet_properties',$table['img-width'],$table['img-height'],$table['img-ratio'],$table['img-b']);
  
                    $send['photo'] = $photo['photo'];
                    
                    $send['thumb'] = $photo['thumb'];

				}

			}else{

                if($file['error']==0){
                    
                    $photo = $func->uploadImg(0,"photo","thumb",$file,$folder,'baiviet_properties',$table['img-width'],$table['img-height'],$table['img-ratio'],$table['img-b']);
                    
                    $send['photo'] = $photo['photo'];
                    
                    $send['thumb'] = $photo['thumb'];

                }

            }

		}

		$send['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;

		$send['id_product'] = (int)$_GET['id_product'];

		if($data['price']){

			$send['price'] = str_replace(',', '', $data['price']);

		}
		if($data['qty']){

			$send['qty'] = $data['qty'];

		}

		if($id){

			$send['ngaysua']=time();

			$updateData=$db->update('baiviet_properties',$send);

			if($updateData){

				$response['status']=200;

				$response['message']='Cập nhật dữ liệu thành công!';

				$message=base64_encode(json_encode($response));

				$func->redirect("index.html?com=properties&act=man{$url_path}&message={$message}");

			}else{

				$response['status']=201;

				$response['message']='Cập nhật dữ liệu không thành công!';

				$message=base64_encode(json_encode($response));

				$func->redirect("index.html?com=properties&act=man{$url_path}&message={$message}");

			}

		}else{

			$send['ngaytao']=time();

			$send['type']=$type;

			$insertID=$db->insert('baiviet_properties',$send);

			if($insertID){

				$response['status']=200;

				$response['message']='Thêm dữ liệu thành công!';

				$message=base64_encode(json_encode($response));

				$func->redirect("index.html?com=properties&act=man{$url_path}&message={$message}");

			}else{

				$response['status']=201;

				$response['message']='Thêm dữ liệu không thành công!';

				$message=base64_encode(json_encode($response));

				$func->redirect("index.html?com=properties&act=man{$url_path}&message={$message}");

			}


		}

	}

 	function deleteMan(){
        global $db,$func,$type,$url_path,$folder;
        if(isset($_GET['id'])){
            $id =(int)$_GET['id'];
            $item=$db->rawQueryOne("select id,photo,thumb from #_baiviet_properties where id=?",array($id));
            if($item){
                $func->deleteLink($folder.$item['photo']);
                $func->deleteLink($folder.$item['thumb']);
                $db->where('id', $item['id']);
                $db->delete('baiviet_properties');
                $response['status']=200;
                $response['message']="Xóa thông tin #id{$id} thành công";
                $message=base64_encode(json_encode($response));
                $func->redirect("index.html?com=properties&act=man{$url_path}&message={$message}");
            }else{
                $response['status']=201;
                $response['message']='Hệ thống đang gặp vấn đề, không thể xóa dữ liệu!';
                $message=base64_encode(json_encode($response));
                $func->redirect("index.html?com=properties&act=man{$url_path}&message={$message}");
            }
        }elseif (isset($_GET['listid'])==true){
            $listid = explode(",",$_GET['listid']);
            if(count($listid)){
                foreach ($listid as $k => $v) {
                    $id=(int)$v;
                    $item=$db->rawQueryOne("select id,photo,thumb from #_baiviet_properties where id=?",array($id));
                    if($item){
                       $func->deleteLink($folder.$item['photo']);
                       $func->deleteLink($folder.$item['thumb']);
                       $db->where('id', $item['id']);
                       $db->delete('baiviet_properties');
                    }
                }
                $response['status']=200;
                $response['message']="Xóa thông tin thành công";
                $message=base64_encode(json_encode($response));
                $func->redirect("index.html?com=properties&act=man{$url_path}&message={$message}");
            }else{
                $response['status']=201;
                $response['message']='Không nhận được dữ liệu';
                $message=base64_encode(json_encode($response));
                $func->redirect("index.html?com=properties&act=man{$url_path}&message={$message}");
            }
        }
    }

?>