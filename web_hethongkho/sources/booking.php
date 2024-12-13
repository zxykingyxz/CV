<?php if (!defined('_source')) die("Error");
if (!empty($_POST)) {
	$form = $_POST['data'];
	$email = htmlspecialchars($form['email']);

	// $check_mail=$d->get_fetch_array('select count(email) as sum from table_booking where email="'.$email.'"');
	// if($check_mail['sum'] >= 5){
	// 	transfer('Bạn chỉ có thể upload tối đa 5 file, vui lòng thử lại sau','index.html');
	// }
	// $file_size=$_FILES['files']['size'];
	// $file_name= $_FILES['files']['name'];
	// $filename= explode('.',$file_name);
	// $changename= changeTitle($filename[0]);
	// $fileAcualExt=$filename[1];
	// $allowed = array('doc','docx','pdf','ppt','DOC','DOCX','PDF','PPT','PPTX','xls','xlsx','XLS','XLSX','jpg','JPG','jpeg','JPEG','png','PNG','gif','GIF');
	// if(in_array($fileAcualExt,$allowed)){
	// 	if($file_size <= 3*MB){
	// 		if($file = upload_image("files", 'doc|docx|pdf|ppt|pptx|DOC|DOCX|PDF|PPT|PPTX|xls|xlsx|XLS|XLSX|jpg|png|gif|JPG|PNG|GIF', _upload_tailieu_l,$changename)){
	// 			$data['tenfile'] = $changename;
	// 			$data['tailieu'] = $file;
	// 		}
	// 	}else{
	// 		transfer('Dung lượng file vượt quá ngưỡng cho phép, vui lòng thử lại sau','index.html');
	// 	}
	// }else{
	// 	transfer('Không hỗ trợ định dạng file này, vui lòng thử lại sau','index.html');
	// }
	$hoten = htmlspecialchars($form['hoten']);
	$dienthoai = htmlspecialchars($form['phone']);
	$diachi = htmlspecialchars($form['diachi']);
	$noidung = htmlspecialchars($form['noidung']);
	$body = '<table>';
	$body .= '
					<tr>
						<th colspan="2">&nbsp;</th>
					</tr>
					<tr>
						<th colspan="2">Thư từ website <a href="https://' . $row_setting['website'] . '">' . $row_setting['website'] . '</a></th>
					</tr>
					<tr>
						<th colspan="2">&nbsp;</th>
					</tr>
					<tr>
						<th>Họ tên :</th><td>' . $hoten . '</td>
					</tr>
					<tr>
						<th>Email :</th><td>' . $email . '</td>
					</tr>
					<tr>
						<th>Phone :</th><td>' . $dienthoai . '</td>
					</tr>
					<tr>
						<th>Địa chỉ :</th><td>' . $diachi . '</td>
					</tr>';
	$body .= '</table>';

	$data['ten_vi'] = $hoten;
	$data['email'] = $email;
	$data['dienthoai'] = $dienthoai;
	$data['info'] = $services;
	$data['diachi'] = $diachi;
	$data['noidung'] = $noidung;
	$data['type'] = 'dat-lich';
	$data['ngaytao'] = time();
	$d->setTable('booking');
	$d->insert($data);
	if ($func->sendMailIndex($row_setting['email'], 'Thông tin đặt lịch website', $body, array($row_setting['email'], $email), null, null)) {

		$func->transfer("Gửi thông tin đăng ký thành công !", $https_config);
	} else {

		$func->transfer("Gửi thông tin đăng ký thất bại!", $https_config);
	}
}
