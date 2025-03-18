<?php if(!defined('_source')) die("Error");

    switch($act){
    	case "man":
    		getMans();
    		$template = "redirect/items";
    		break;
    	case "add":		
    		$template = "redirect/item_add";
    		break;
    	case "edit":
    		getMan();
    		$template = "redirect/item_add";
    		break;
    	case "save":
    		saveMan();
    		break;
    	case "delete":
    		deleteMan();
    		break;			
    	default:
    		$template = "index";
    }

    function getMans(){

    	global $db,$func,$type,$url_path, $items, $paging,$page;

        $perPage = 10;

        $startpoint = ($page * $perPage) - $perPage;
        
        $limit = ' limit '.$startpoint.','.$perPage;

        $where = '#_redirect';

        if($_GET['keyword']!='')
        {
            $keyword=   ($_GET['keyword']);
            
            $where.=" where ( oldlink LIKE '%{$keyword}%' or  newlink LIKE '%{$keyword}%')";
        }

        $where .=" order by id desc";

        $sql = "select * from {$where} {$limit}";

        $items = $db->rawQuery($sql);

        $url = $func->getCurrentPageURLAdmin();

        $sql = "SELECT COUNT(*) as `numb` FROM {$where}";
        
        $count = $db->rawQueryOne($sql);

        $total=$count['numb'];

        $paging = $func->paginationAdmin($total,$perPage,$page,$url);

    }

    function getMan(){

        global $db,$func, $type,$page,$url_path, $item;

        $id = (int)($_GET['id']);

        $sql = "select * from #_redirect where id=?";

        $item = $db->rawQueryOne($sql,array($id));
        
        if(empty($item)){
           
            $response['status']=201;
           
            $response['message']="Dữ liệu #id{$id} không có trong hệ thống ";
           
            $message=base64_encode(json_encode($response));
            
            $func->redirect("index.html?com=redirect&act=man{$url_path}&message={$message}");
        
        }

    }

    function saveMan(){
               
        global $db,$func,$config,$url_path,$type;

        $id = (int)$_GET['id'];

        $data=$_POST['data'];

        if($_POST){

            foreach($data as $k=>$v){

               $send[$k]=htmlspecialchars($func->magicQuote($v));
                
            }
            
        }

        $savehere = (isset($_POST['save-here'])) ? true : false;

        if($id){

            $send['updateAt']=$db->now();
            $db->where('id', $id);
            $updateData=$db->update('redirect',$send);
            if($updateData){
                $response['status']=200;
                $response['message']="Cập nhật thông tin #id{$id} thành công";
                $message=base64_encode(json_encode($response));

               if($savehere) $func->redirect("index.html?com=redirect&act=edit{$url_path}&message={$message}");
                else $func->redirect("index.html?com=redirect&act=man{$url_path}&message={$message}");
            }else{
                $response['status']=201;
                $response['message']="Cập nhật thông tin #id{$id} không thành công";
                $message=base64_encode(json_encode($response));
                $func->redirect("index.html?com=redirect&act=man{$url_path}&message={$message}");
            }
        }else{
            $send['createAt']=$db->now();

            $insertID=$db->insert('redirect',$send);
            if($insertID){
                $response['status']=200;
                $response['message']="Thêm dữ liệu #id{$insertID} thành công";
                $message=base64_encode(json_encode($response));
                if($savehere) $func->redirect("index.html?com=redirect&act=edit&id={$insertID}{$url_path}&message={$message}");
                else $func->redirect("index.html?com=redirect&act=man{$url_path}&message={$message}");
            }else{
                $response['status']=201;
                $response['message']="Thêm dữ liệu #id{$insertID} không thành công";
                $message=base64_encode(json_encode($response));
                
                $func->redirect("index.html?com=redirect&act=man{$url_path}&message={$message}");
            }
        }
    }

    function deleteMan(){
        global $db,$func,$type,$url_path;
        if(isset($_GET['id'])){
            $id =  (int)$_GET['id'];
            $item=$db->rawQueryOne("select id from #_redirect where id=?",array($id));
            if($item){
                $db->where('id', $item['id']);
                $db->delete('redirect');
                $response['status']=200;
                $response['message']="Xóa thông tin #id{$id} thành công";
                $message=base64_encode(json_encode($response));
                $func->redirect("index.html?com=redirect&act=man{$url_path}&message={$message}");
            }else{
                $response['status']=201;
                $response['message']='Hệ thống đang gặp vấn đề, không thể xóa dữ liệu!';
                $message=base64_encode(json_encode($response));
                $func->redirect("index.html?com=redirect&act=man{$url_path}&message={$message}");
            }
        } elseif (isset($_GET['listid'])==true){

            $listid = explode(",",$_GET['listid']);
            if(count($listid)){
                foreach ($listid as $k => $v) {
                    $id=(int)$v;
                    $item=$db->rawQueryOne("select id from #_redirect where id=?",array($id));
                    if($item){
                        $db->where('id', $item['id']);
                        $db->delete('redirect');
                    }
                }
                $response['status']=200;
                $response['message']="Xóa thông tin thành công";
                $message=base64_encode(json_encode($response));
                $func->redirect("index.html?com=redirect&act=man{$url_path}&message={$message}");
            }else{
                $response['status']=200;
                $response['message']='Không nhận được dữ liệu';
                $message=base64_encode(json_encode($response));
                $func->redirect("index.html?com=redirect&act=man{$url_path}&message={$message}");
            }
        }
    }

?>