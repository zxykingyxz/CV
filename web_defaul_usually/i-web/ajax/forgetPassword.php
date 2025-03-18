<?php 

	require_once 'ajaxConfig.php';

	@$username=isset($_POST['username']) ? $_POST['username'] : '';

	$query="select id from #_user where numb_contract='".$username."' limit 1";

	$item=$db->rawQueryOne($query);

	if($item){

		$password_new=$func->randString(8);

		$password_encrypted=$func->encryptPassword($config['secret'],$password_new,$config['salt']);

		$update=$db->rawQuery("update #_user set password=? where id=?",array($password_encrypted,$item['id']));

		$res['status']=200;
		$res['message']="Mật khẩu của bạn đã được reset";
		$res['password']=$password_new;

	}else{

		$res['status']=201;
		$res['message']="Số hợp đồng không đúng!";

	}

	$file=@fopen('log.txt','a+');

	if($file){

		$data="update--".$res['status']."--".date('d-m-Y H:i:s',time())."--".$res['password']."\r\n";
		fwrite($file,$data);
		fclose($file);

	}

	echo json_encode($res);
 ?>