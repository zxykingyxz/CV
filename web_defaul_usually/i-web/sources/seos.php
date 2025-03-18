<?php if(!defined('_source')) die("Error");

	$folder=_upload_seopage;

	switch($act){

		case 'capnhat':

			getSeoPage();

			$template = "seos/item_add";

			break;

		case "save":

			saveSeoPage();

			break;	

		default:

			break;

	}

	function getSeoPage(){

        global $db, $type,$url_path, $item,$setting,$table;

        $table=$setting['seopage'];

        $sql = "select * from #_seopage where type='{$type}' limit 0,1";
       
        $item = $db->rawQueryOne($sql);
    
    }
    function saveSeoPage(){
           
        global $db, $func,$url_path,$folder,$type,$setting,$table;

        $file_name=$func->imagesName($_FILES['file']['name']);
        
        $item = $db->rawQueryOne("select id from #_seopage where type='{$type}'");

        $table=$setting['seopage'];

        $data=$_POST['data'];

        if($_POST){
            
            foreach($data as $k=>$v){

                $send[$k]=htmlspecialchars($v);

            }
        }

        $file=$_FILES['file'];

        if(!empty($file)){

            if($file['error']==0){
                    
                $photo = $func->uploadImg(0,"photo","",$file,$folder,'seopage',$table['img-width'],$table['img-height'],$table['img-ratio'],$table['img-b']);
                
                $send['photo'] = $photo['photo'];

            }
        }
         $send['mucluc']=isset($_POST['mucluc']) ? 1 : 0;


        if(!empty($item)){

            $send['ngaysua']=time();

            $db->where('type', $type);

            $updateData=$db->update('seopage',$send);

            if($updateData){
               
                $response['status']=200;
                
                $response['message']="Cập nhật thông tin thành công";
                
                $message=base64_encode(json_encode($response));
                
                $func->redirect("index.html?com=seopage&act=capnhat{$url_path}&message={$message}");
            
            }else{
                
                $response['status']=201;
                
                $response['message']="Cập nhật thông tin không thành công";
                
                $message=base64_encode(json_encode($response));
                
                $func->redirect("index.html?com=seopage&act=capnhat{$url_path}&message={$message}");
            
            }
        }else{

        	$send['type']=$type;

            $send['ngaytao']=time();

            $insertID=$db->insert('seopage',$send);

            if($insertID){

                $response['status']=200;

                $response['message']="Thêm dữ liệu thành công";

                $message=base64_encode(json_encode($response));

                $func->redirect("index.html?com=seopage&act=capnhat{$url_path}&message={$message}");

            }else{

                $response['status']=201;

                $response['message']="Thêm dữ liệu không thành công";

                $message=base64_encode(json_encode($response));

                $func->redirect("index.html?com=seopage&act=capnhat{$url_path}&message={$message}");

            }
        }
    }

?>