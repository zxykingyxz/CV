<?php	if(!defined('_source')) die("Error");


$folder=_upload_hinhanh;

switch($act){
	case "capnhat":
		getTitle();
		$template = "title/item_add";
		break;
	case "save":
		saveTitle();
		break;		
	default:
		$template = "index";
}

function getTitle(){

    global $db,$func,$com,$type,$url_path, $item,$GLOBAL,$table;

    $table=$GLOBAL[$com][$type];

    $sql = "select * from #_{$com} where type='".$type."' limit 0,1";
   
    $item = $db->rawQueryOne($sql);

}
function saveTitle(){
   
    global $db,$func,$config,$url_path,$folder,$GLOBAL,$table;

    $com=isset($_GET['com']) ? $_GET['com'] : '';

    $type=isset($_GET['type']) ? $_GET['type'] : '';

    $table=$GLOBAL[$com][$type];

    $data=$_POST['data'];

    $item=$db->rawQueryOne("select id from #_$com where type=? limit 1", array($type));

    if($_POST){
        
        foreach($data as $k=>$v){

           $send[$k]=htmlspecialchars($func->magicQuote($v));
            
        }
    }

    $file=$_FILES['file'];

    if(!empty($file)){

        if($file['error']==0){
                
            $photo = $func->uploadImg(0,"photo","",$file,$folder,$com,$table['img-width'],$table['img-height'],$table['img-ratio'],$table['img-b']);
            
            $send['photo'] = $photo['photo'];

        }
    }

    $dataSeo = (isset($_POST['dataseo'])) ? $_POST['dataseo'] : null;

    if($dataSeo)
    {
        foreach($dataSeo as $column => $value)
        {
            $dataSeo[$column] = htmlspecialchars($value);
        }
    }

    
    if(!empty($item)){

    	$send['ngaysua']=time();

    	$db->where('type',$type);

    	$updateData=$db->update($com,$send);


    	if($updateData){	

	        // $db->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array(0,$com,'capnhat',$type));

	        // $dataSeo['idmuc'] = 0;

	        // $dataSeo['com'] = $com;

	        // $dataSeo['act'] = 'capnhat';

	        // $dataSeo['type'] = $type;

	        // $db->insert('seo',$dataSeo);
	       
	        $response['status']=200;
	        
	        $response['message']="Cập nhật thông tin thành công";
	        
	        $message=base64_encode(json_encode($response));
	        
	        $func->redirect("index.html?com={$com}&act=capnhat{$url_path}&message={$message}");

	    }else{

    		$response['status']=201;
    
	        $response['message']="Cập nhật thông tin không thành công";
	        
	        $message=base64_encode(json_encode($response));
	        
	        $func->redirect("index.html?com={$com}&act=capnhat{$url_path}&message={$message}");

	    }
    
    }else{

        $send['type']=$type;

        $send['ngaytao']=time();

    	$insertID=$db->insert($com,$send);

    	if($insertID){	

	        // $db->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array(0,$com,'capnhat',$type));

	        // $dataSeo['idmuc'] = 0;

	        // $dataSeo['com'] = $com;

	        // $dataSeo['act'] = 'capnhat';

	        // $dataSeo['type'] = $type;

	        // $db->insert('seo',$dataSeo);
	       
	        $response['status']=200;
	        
	        $response['message']="Thêm thông tin thành công";
	        
	        $message=base64_encode(json_encode($response));
	        
	        $func->redirect("index.html?com={$com}&act=capnhat{$url_path}&message={$message}");
	        
	    }else{

    		$response['status']=201;
    
	        $response['message']="Thêm thông tin không thành công";
	        
	        $message=base64_encode(json_encode($response));
	        
	        $func->redirect("index.html?com={$com}&act=capnhat{$url_path}&message={$message}");

	    }
    
    
    }
}
?>