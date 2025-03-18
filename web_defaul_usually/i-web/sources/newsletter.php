<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$type = (isset($_REQUEST['type'])) ? addslashes($_REQUEST['type']) : "";
switch($act){
	case "man":
		$apiProduct->getMans();
		$template = "newsletter/items";
		break;
	case "add":
		$template = "newsletter/item_add";
		break;
	case "edit":
		$apiProduct->getMan();
		$template = "newsletter/item_add";
		break;	
	case "send":
		send();
		break;
	case "save":
		$apiProduct->saveMan();
		break;	
	case "delete":
		$apiProduct->deleteMan();
		break;	
	default:
		$template = "index";
}
function send(){
	global $d,$func,$url_path,$config,$path,$config_url;
		
	$mail = new PHPMailer();
	$mail->IsSMTP(); // Gọi đến class xử lý SMTP
	$mail->Host       = $config['mail']['ip']; // tên SMTP server
	$mail->SMTPAuth   = true;                  // Sử dụng đăng nhập vào account
	$mail->SMTPSecure =  $config['mail']['smtp'];                // Sử dụng đăng nhập vào account
	$mail->Port   = $config['mail']['port'];                  // Sử dụng đăng nhập vào account
	$mail->Username   = $config['mail']['email']; // SMTP account username
	$mail->Password   = $config['mail']['password'];  
	$mail->SetFrom($config['mail']['email'], $_POST['ten_vi']);

	if (!empty($_FILES['file']) && count($_FILES['file'])>0) {
        if (isset($_FILES['file'])) {
        	$arrFiles = array();
        	$m = 0;
        	for($i=0;$i<count($_FILES['file']['name']);$i++){
        		if($_FILES['file']['error'][$i]!=4){
        			$files['name'] = $_FILES['file']['name'][$i];
					$files['type'] = $_FILES['file']['type'][$i];
					$files['tmp_name'] = $_FILES['file']['tmp_name'][$i];
					$files['error'] = $_FILES['file']['error'][$i];
					$files['size'] = $_FILES['file']['size'][$i];
					$photo = $func->uploadFileSend('file',$files,$path);
		    		$arrFiles[$m] = $path.$photo['file'];
		    		$m++;
        		}
        	}
        }
    }
    
	$listid = explode(",",$_GET['listid']);
	$arrMail = array();
	for ($i=0 ; $i<count($listid) ; $i++){
		$idTin = $listid[$i]; 
		$id =  (int)$idTin;		
		$sql = "select email from #_newsletters where id=?";
		$row = $db->rawQueryOne($sql,array($id));
		$arrMail[$i] = $row['email'];
		$mail->AddAddress($row['email'], $_POST['ten_vi']);
	}
	for ($i=0; $i < count($arrFiles); $i++) { 
		$mail->AddAttachment($config_url.$arrFiles[$i]);
	}
			
	$mail->Subject    = '['.$_POST['ten_vi'].']';
	$mail->IsHTML(true);
	$mail->CharSet = "utf-8";	
	$body = $_POST['noidung_vi'];
	$mail->Body = $body;
	$mail->Send();
	$data['ten_vi'] = htmlspecialchars($_POST['ten_vi']);
	$data['noidung_vi'] = htmlspecialchars($body);
	$data['file'] = json_encode($arrFiles);
	$data['ngaytao'] = $db->now();
	$id_insert = $db->insert('newsletter', $data);
	if ($id_insert) {
	    $result['status'] = 200;
		$result['message'] = 'Đã thêm dữ liệu thành công id#'.$id_insert;
		$message = base64_encode(json_encode($result));
		$func->transfer('Đã gữi hoàn tất','index.html?com=newsletters&act=man'.$url_path);
	}
	
}

?>