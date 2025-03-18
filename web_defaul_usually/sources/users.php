
<?php

$src = isset($_GET['src']) ? addslashes($_GET['src']) : '';
switch ($src) {
	case 'dang-nhap':
		$title_seo = 'Đăng nhập';
		$template = 'account/login';
		if ($func->isLogin()) {
			$func->transfer(_trangkhongtontai, $https_config);
		}
		if (!empty($_POST['login-user'])) loginMember();
		break;
	case 'dang-ky':
		$title_seo = 'Đăng nhập';
		$template = 'account/registration';
		if ($func->isLogin()) {
			$func->transfer(_trangkhongtontai, $https_config);
		}
		if (!empty($_POST['registration-user'])) signupMember();
		break;
	case 'active':
		$title_seo = 'Kích hoạt tài khoản';
		if ($func->isLogin()) {
			$func->transfer(_trangkhongtontai, $https_config);
		}
		if (!empty($_GET['token'])) checkActivationMember();
		break;
	case 'quen-mat-khau':
		$title_seo = 'Thay đổi mật khẩu';
		$template = 'account/forgot_password';
		if ($func->isLogin()) {
			$func->transfer(_trangkhongtontai, $https_config);
		}
		if (!empty($_POST['forgot-password-user'])) forgotPasswordMember();
		break;
	case 'thong-tin':
		$title_seo = 'Thông tin tài khoản';
		$template = 'account/item';
		$templateAuth = 'account/info';
		if (!$func->isLogin()) {
			$func->transfer(_trangkhongtontai, $https_config);
		}
		if (!empty($_POST['info-user'])) infoMember();
		break;
	case 'check-login':
		if ($func->isAjax() && $func->isLogin()) {
			if (!isset($_SESSION['check-login'])) {
				$response = array();
				$status = $func->getAccount();
				if (!empty($status)) {
					$response['status'] = 200;
				} else {
					$response['url'] = 'account?src=dang-nhap';
					$response['status'] = 201;
					$_SESSION['check-login'] = true;
					unset($_SESSION[$loginMember]);
				}
				echo json_encode($response);
			}
		}
		exit;
	case 'dang-xuat':
		if (!$func->isLogin()) {
			$func->transfer(_trangkhongtontai, $https_config);
		}
		logoutMember();
	default:
		if (!$func->isLogin()) {
			$func->transfer(_trangkhongtontai, $https_config);
		}
		break;
}
$str_breadcrumbs = $breadcrumbs->getUrl('Trang chủ', array(array('alias' => 'account?src=' . $src, 'name' => $title_seo)));

function loginMember()
{
	global $db, $func, $flash, $config, $https_config, $loginMember, $lang;

	/* Data */
	$username = (!empty($_POST['username'])) ? htmlspecialchars($func->sanitize($_POST['username'])) : '';
	$password = (!empty($_POST['password'])) ? htmlspecialchars($func->sanitize($_POST['password'])) : '';
	$passwordMD5 = md5($password);
	$remember = (!empty($_POST['remember-user'])) ? htmlspecialchars($_POST['remember-user']) : false;
	/* Valid data */
	if (empty($username)) {
		$response['messages'][] = 'Tên đăng nhập không được trống';
	}

	if (empty($password)) {
		$response['messages'][] = 'Mật khẩu không được trống';
	}

	if (!empty($response)) {
		$response['status'] = 'danger';
		$message = base64_encode(json_encode($response));
		$flash->set("message", $message);
		$func->redirect($https_config . "account?src=dang-nhap");
	}

	$row = $db->rawQueryOne("select id, password, username, phone, address, email, fullname from #_customers where username = ? and hienthi=1 limit 0,1", array($username));

	if (!empty($row)) {
		if ($row['password'] == $passwordMD5) {
			/* Tạo login session */
			$id_user = $row['id'];
			$lastlogin = time();
			$login_session = md5($row['password'] . $lastlogin);
			$db->rawQuery("update #_customers set login_session = ?, lastlogin = ? where id = ?", array($login_session, $lastlogin, $id_user));

			/* Lưu session login */
			$_SESSION[$loginMember]['id'] = $row['id'];
			$_SESSION[$loginMember]['username'] = $row['username'];
			$_SESSION[$loginMember]['phone'] = $row['phone'];
			$_SESSION[$loginMember]['address'] = $row['address'];
			$_SESSION[$loginMember]['email'] = $row['email'];
			$_SESSION[$loginMember]['fullname'] = $row['fullname'];
			$_SESSION[$loginMember]['login_session'] = $login_session;

			/*Xóa trạng thái check login */
			unset($_SESSION['check-login']);

			/* Nhớ mật khẩu */
			$func->_unsetCookie('login_member_id');
			$func->_unsetCookie('login_member_session');
			if ($remember) {
				$time_expiry = time() + 3600 * 24;
				$func->_setCookie('login_member_id', $row['id'], $time_expiry);
				$func->_setCookie('login_member_session', $login_session, $time_expiry);
			}
			$linkInfo = ($config['lang_check']) ? $https_config . $lang . '/account?src=thong-tin' : $https_config;
			$func->transfer("Đăng nhập thành công", $linkInfo);
		} else {
			$response['messages'][] = 'Tên đăng nhập hoặc mật khẩu không chính xác. Hoặc tài khoản của bạn chưa được xác nhận từ Quản trị website';
		}
	} else {
		$response['messages'][] = 'Tên đăng nhập hoặc mật khẩu không chính xác. Hoặc tài khoản của bạn chưa được xác nhận từ Quản trị website';
	}

	/* Response error */
	if (!empty($response)) {
		$response['status'] = 'danger';
		$message = base64_encode(json_encode($response));
		$flash->set("message", $message);
		$func->redirect($https_config . "account?src=dang-nhap");
	}
}
function signupMember()
{
	global $db, $func, $flash, $config, $https_config, $lang;

	/* Data */
	$message = '';
	$response = array();
	$username = (!empty($_POST['username'])) ? htmlspecialchars($func->sanitize($_POST['username'])) : '';
	$password = (!empty($_POST['password'])) ? htmlspecialchars($func->sanitize($_POST['password'])) : '';
	$passwordMD5 = md5($password);
	$repassword = (!empty($_POST['repassword'])) ? $_POST['repassword'] : '';
	$fullname = (!empty($_POST['fullname'])) ? htmlspecialchars($func->sanitize($_POST['fullname'])) : '';
	$email = (!empty($_POST['email'])) ? htmlspecialchars($func->sanitize($_POST['email'])) : '';
	$confirm_code = $func->digitalRandom(0, 3, 6);
	$phone = (!empty($_POST['phone'])) ? htmlspecialchars($func->sanitize($_POST['phone'])) : 0;
	$address = (!empty($_POST['address'])) ? htmlspecialchars($func->sanitize($_POST['address'])) : '';
	$gender = (!empty($_POST['gender'])) ? htmlspecialchars($func->sanitize($_POST['gender'])) : 0;
	$birthday = (!empty($_POST['birthday'])) ? htmlspecialchars($func->sanitize($_POST['birthday'])) : '';

	/* Valid data */
	if (empty($fullname)) {
		$response['messages'][] = 'Họ tên không được trống';
	}

	if (empty($username)) {
		$response['messages'][] = 'Tài khoản không được trống';
	}

	if (!empty($username)) {
		if (!$func->isAlphaNum($username)) {
			$response['messages'][] = 'Tài khoản chỉ được nhập chữ thường và số (chữ thường không dấu, ghi liền nhau, không khoảng trắng)';
		}

		if ($func->checkAccount($username, 'username', 'customers')) {
			$response['messages'][] = 'Tài khoản đã tồn tại';
		}
	}

	if (empty($password)) {
		$response['messages'][] = 'Mật khẩu không được trống';
	}

	if (!empty($password) && empty($repassword)) {
		$response['messages'][] = 'Xác nhận mật khẩu không được trống';
	}

	if (!empty($password) && !empty($repassword) && !$func->isMatch($password, $repassword)) {
		$response['messages'][] = 'Mật khẩu không trùng khớp';
	}

	if (empty($gender)) {
		$response['messages'][] = 'Chưa chọn giới tính';
	}

	if (empty($birthday)) {
		$response['messages'][] = 'Ngày sinh không được trống';
	}

	if (!empty($birthday) && !$func->isDate($birthday)) {
		$response['messages'][] = 'Ngày sinh không hợp lệ';
	}

	if (empty($email)) {
		$response['messages'][] = 'Email không được trống';
	}

	if (!empty($email)) {
		if (!$func->isEmail($email)) {
			$response['messages'][] = 'Email không hợp lệ';
		}

		if ($func->checkAccount($email, 'email', 'customers')) {
			$response['messages'][] = 'Email đã tồn tại';
		}
	}

	if (!empty($phone) && !$func->isPhone($phone)) {
		$response['messages'][] = 'Số điện thoại không hợp lệ';
	}

	if (empty($address)) {
		$response['messages'][] = 'Địa chỉ không được trống';
	}

	if (!empty($response)) {
		/* Flash data */
		$flash->set('fullname', $fullname);
		$flash->set('username', $username);
		$flash->set('gender', $gender);
		$flash->set('birthday', $birthday);
		$flash->set('email', $email);
		$flash->set('phone', $phone);
		$flash->set('address', $address);

		/* Errors */
		$response['status'] = 'danger';
		$message = base64_encode(json_encode($response));
		$flash->set('message', $message);
		$linkDk = ($config['lang_check']) ? $https_config . $lang . '/account?src=dang-ky' : $https_config . "account?src=dang-ky";
		$func->redirect($linkDk);
	}
	/* Save data */
	$data['fullname'] = $fullname;
	$data['username'] = $username;
	$data['password'] = md5($password);
	$data['email'] = $email;
	$data['phone'] = $phone;
	$data['address'] = $address;
	$data['token'] = $func->uuid();
	$data['gender'] = $gender;
	$data['birthday'] = strtotime(str_replace("/", "-", $birthday));
	$data['confirm_code'] = $confirm_code;
	$data["avatar"] = $func->make_avatar($func->createdImg($username));
	$insert = $db->insert('customers', $data);

	if ($insert) {
		sendActivation($username);
		$linkLogin = ($config['lang_check']) ? $https_config . $lang . '/account?src=dang-nhap' : $https_config . 'account?src=dang-nhap';
		$func->transfer("Đăng ký thành viên thành công. Vui lòng kiểm tra email: " . $data['email'] . " để kích hoạt tài khoản", $linkLogin);
	} else {
		$func->transfer("Đăng ký thành viên thất bại. Vui lòng thử lại sau.", $https_config, false);
	}
}

function sendActivation($username)
{
	global $db, $func, $row_setting, $classEmail, $https_config, $lang, $config;

	/* Lấy thông tin người dùng */
	$row = $db->rawQueryOne("select id, confirm_code, username, password, fullname, email, phone, address,token from #_customers where username = ? limit 0,1", array($username));

	/* Gán giá trị gửi email */
	$iduser = $row['id'];
	$token = $row['token'];
	$confirm_code = $row['confirm_code'];
	$tendangnhap = $row['username'];
	$matkhau = $row['password'];
	$tennguoidung = $row['fullname'];
	$emailnguoidung = $row['email'];
	$dienthoainguoidung = $row['phone'];
	$diachinguoidung = $row['address'];
	$data_active = [
		'token' => $token,
		'expried' => time() + 5 * 60 // link tồn tại trong 5 phút
	];
	$jsonActive = base64_encode($func->json_encode($data_active));
	$linkkichhoat = $https_config . "account?src=active&token=" . $jsonActive;

	/* Thông tin đăng ký */
	$thongtindangky = '<td style="padding:3px 9px 9px 0px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span style="text-transform:normal">Username: ' . $tendangnhap . '</span><br>Mật khẩu: *******' . substr($matkhau, -3) . '<br>Mã kích hoạt: ' . $confirm_code . '</td><td style="padding:3px 0px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">';
	if ($tennguoidung) {
		$thongtindangky .= '<span style="text-transform:capitalize">' . $tennguoidung . '</span><br>';
	}
	if ($emailnguoidung) {
		$thongtindangky .= '<a href="mailto:' . $emailnguoidung . '" target="_blank">' . $emailnguoidung . '</a><br>';
	}
	if ($diachinguoidung) {
		$thongtindangky .= $diachinguoidung . '<br>';
	}
	if ($dienthoainguoidung) {
		$thongtindangky .= 'Tel: ' . $dienthoainguoidung . '</td>';
	}

	/* Defaults attributes email */
	$emailDefaultAttrs = $classEmail->defaultAttrs();

	/* Variables email */
	$emailVars = array(
		'{emailInfoSignupMember}',
		'{emailLinkActiveMember}'
	);
	$emailVars = $classEmail->addAttrs($emailVars, $emailDefaultAttrs['vars']);

	/* Values email */
	$emailVals = array(
		$thongtindangky,
		$linkkichhoat
	);
	$emailVals = $classEmail->addAttrs($emailVals, $emailDefaultAttrs['vals']);

	/* Send email admin */
	$arrayEmail = array(
		"dataEmail" => array(
			"name" => $row['username'],
			"email" => $row['email']
		)
	);
	$subject = "Thư kích hoạt tài khoản thành viên từ " . $row_setting['name_' . $lang];
	$message = str_replace($emailVars, $emailVals, $classEmail->markdown('member/active'));
	$file = '';

	if (!$classEmail->sendEmail("customer", $arrayEmail, $subject, $message, $file)) {
		$linkContact = ($config['lang_check']) ? $https_config . $lang . '/lien-he' : $https_config . 'lien-he';
		$func->transfer("Có lỗi xảy ra trong quá trình kích hoạt tài khoản. Vui lòng liên hệ với chúng tôi.", $linkContact, false);
	}
}
function checkActivationMember()
{
	global $db, $func, $config, $https_config, $lang;
	$token = (!empty($_GET['token'])) ? htmlspecialchars($func->sanitize($_GET['token'])) : '';
	$current_time = time();
	$jd = $func->json_decode(base64_decode($token));
	/* Valid data */
	if ($current_time > $jd['expried']) $func->transfer(_duonglinkhetthoigiankichhoat, $https_config);
	$rowDetail = $db->rawQueryOne("select id,hienthi from #_customers where token = ? limit 0,1", array($jd['token']));
	if (empty($rowDetail)) $func->transfer(_trangkhongtontai, $https_config);
	if ($rowDetail['hienthi'] == 1) $func->transfer(_taikhoandakichhoattruocdo, $https_config);
	$update = $db->rawQuery("update #_customers set hienthi=1 where id=?", [$rowDetail['id']]);
	$linkLogin = ($config['lang_check']) ? $https_config . $lang . '/account?src=dang-nhap' : $https_config . 'account?src=dang-nhap';
	$func->transfer(_kichhoattaikhoanthanhcong, $linkLogin);
}
function forgotPasswordMember()
{
	global $db, $row_setting, $classEmail, $func, $flash, $https_config, $lang;

	/* Data */
	$message = '';
	$response = array();
	$username = (!empty($_POST['username'])) ? htmlspecialchars($func->sanitize($_POST['username'])) : '';
	$email = (!empty($_POST['email'])) ? htmlspecialchars($func->sanitize($_POST['email'])) : '';
	$newpass = substr(md5(rand(0, 999) * time()), 15, 6);
	$newpassMD5 = md5($newpass);
	/* Valid data */
	if (empty($username)) {
		$response['messages'][] = 'Tài khoản không được trống';
	}

	if (!empty($username) && !$func->isAlphaNum($username)) {
		$response['messages'][] = 'Tài khoản chỉ được nhập chữ thường và số (chữ thường không dấu, ghi liền nhau, không khoảng trắng)';
	}

	if (empty($email)) {
		$response['messages'][] = 'Email không được trống';
	}

	if (!empty($email) && !$func->isEmail($email)) {
		$response['messages'][] = 'Email không hợp lệ';
	}

	if (!empty($username) && !empty($email)) {
		$row = $db->rawQueryOne("select id from #_cusstomer where username = ? and email = ? limit 0,1", array($username, $email));

		if (empty($row)) {
			$response['messages'][] = 'Tên đăng nhập hoặc/và email không tồn tại';
		}
	}

	if (!empty($response)) {
		$response['status'] = 'danger';
		$message = base64_encode(json_encode($response));
		$flash->set('message', $message);
		$func->redirect($https_config . "account?src=quen-mat-khau");
	}

	/* Cập nhật mật khẩu mới */
	$data['password'] = $newpassMD5;
	$db->where('username', $username);
	$db->where('email', $email);
	$db->update('customers', $data);

	/* Lấy thông tin người dùng */
	$row = $db->rawQueryOne("select id, username, password, fullname, email, phone, address,token from #_customers where username = ? limit 0,1", array($username));

	/* Gán giá trị gửi email */
	$iduser = $row['id'];
	$token = $row['token'];
	$tendangnhap = $row['username'];
	$matkhau = $row['password'];
	$tennguoidung = $row['fullname'];
	$emailnguoidung = $row['email'];
	$dienthoainguoidung = $row['phone'];
	$diachinguoidung = $row['address'];

	/* Thông tin đăng ký */
	$thongtindangky = '<td style="padding:3px 9px 9px 0px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span style="text-transform:normal">Username: ' . $tendangnhap . '</span><br>Mật khẩu: *******' . substr($matkhau, -3) . '</td><td style="padding:3px 0px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">';
	if ($tennguoidung) {
		$thongtindangky .= '<span style="text-transform:capitalize">' . $tennguoidung . '</span><br>';
	}

	if ($emailnguoidung) {
		$thongtindangky .= '<a href="mailto:' . $emailnguoidung . '" target="_blank">' . $emailnguoidung . '</a><br>';
	}

	if ($diachinguoidung) {
		$thongtindangky .= $diachinguoidung . '<br>';
	}

	if ($dienthoainguoidung) {
		$thongtindangky .= 'Tel: ' . $dienthoainguoidung . '</td>';
	}

	/* Defaults attributes email */
	$emailDefaultAttrs = $classEmail->defaultAttrs();

	/* Variables email */
	$emailVars = array(
		'{emailInfoSignupMember}',
		'{emailNewPasswordMember}'
	);
	$emailVars = $classEmail->addAttrs($emailVars, $emailDefaultAttrs['vars']);

	/* Values email */
	$emailVals = array(
		$thongtindangky,
		$newpass
	);
	$emailVals = $classEmail->addAttrs($emailVals, $emailDefaultAttrs['vals']);

	/* Send email admin */
	$arrayEmail = array(
		"dataEmail" => array(
			"name" => $tennguoidung,
			"email" => $email
		)
	);
	$subject = "Thư cấp lại mật khẩu từ " . $row_setting['name' . $lang];
	$message = str_replace($emailVars, $emailVals, $classEmail->markdown('member/forgot-password'));
	$file = '';

	if ($classEmail->send("customer", $arrayEmail, $subject, $message, $file)) {
		unset($_SESSION[$loginMember]);
		$func->_unsetCookie('login_member_id');
		$func->_unsetCookie('login_member_session');
		$func->transfer("Cấp lại mật khẩu thành công. Vui lòng kiểm tra email: " . $email, $https_config);
	} else {
		$func->transfer("Có lỗi xảy ra trong quá trình cấp lại mật khẩu. Vui lòng liện hệ với chúng tôi.", $https_config . "account?src=quen-mat-khau", false);
	}
}
function infoMember()
{
	global $db, $func, $flash, $rowDetail, $config, $https_config, $loginMember, $lang;

	$iduser = $_SESSION[$loginMember]['id'];

	if ($iduser) {
		$rowDetail = $db->rawQueryOne("select fullname, username, gender, birthday, email, phone, address from #_customers where id = ? limit 0,1", array($iduser));
		if (!empty($_POST['info-user'])) {
			$message = '';
			$response = array();
			$old_password = (!empty($_POST['old-password'])) ? htmlspecialchars($func->sanitize($_POST['old-password'])) : '';
			$old_passwordMD5 = md5($old_password);
			$new_password = (!empty($_POST['new-password'])) ? htmlspecialchars($func->sanitize($_POST['new-password'])) : '';
			$new_passwordMD5 = md5($new_password);
			$new_password_confirm = (!empty($_POST['new-password-confirm'])) ? htmlspecialchars($func->sanitize($_POST['new-password-confirm'])) : '';
			$fullname = (!empty($_POST['fullname'])) ? htmlspecialchars($func->sanitize($_POST['fullname'])) : '';
			$email = (!empty($_POST['email'])) ? htmlspecialchars($func->sanitize($_POST['email'])) : '';
			$phone = (!empty($_POST['phone'])) ? htmlspecialchars($func->sanitize($_POST['phone'])) : 0;
			$address = (!empty($_POST['address'])) ? htmlspecialchars($func->sanitize($_POST['address'])) : '';
			$gender = (!empty($_POST['gender'])) ? htmlspecialchars($func->sanitize($_POST['gender'])) : 0;
			$birthday = (!empty($_POST['birthday'])) ? htmlspecialchars($func->sanitize($_POST['birthday'])) : '';

			/* Valid data */
			if (empty($fullname)) {
				$response['messages'][] = 'Họ tên không được trống';
			}

			if (!empty($old_password)) {
				$isWrongPass = false;
				$row = $db->rawQueryOne("select id from #_customers where id = ? and password = ? limit 0,1", array($iduser, $old_passwordMD5));

				if (empty($row['id'])) {
					$isWrongPass = true;
					$response['messages'][] = 'Mật khẩu cũ không chính xác';
				} else if (empty($new_password)) {
					$isWrongPass = true;
					$response['messages'][] = 'Mật khẩu mới không được trống';
				} else if (!empty($new_password) && empty($new_password_confirm)) {
					$isWrongPass = true;
					$response['messages'][] = 'Xác nhận mật khẩu mới không được trống';
				} else if ($new_password != $new_password_confirm) {
					$isWrongPass = true;
					$response['messages'][] = 'Mật khẩu mới và xác nhận mật khẩu mới không chính xác';
				}
			}

			if (empty($gender)) {
				$response['messages'][] = 'Chưa chọn giới tính';
			}

			if (empty($birthday)) {
				$response['messages'][] = 'Ngày sinh không được trống';
			}

			if (!empty($birthday) && !$func->isDate($birthday)) {
				$response['messages'][] = 'Ngày sinh không hợp lệ';
			}

			if (empty($email)) {
				$response['messages'][] = 'Email không được trống';
			}

			if (!empty($email)) {
				if (!$func->isEmail($email)) {
					$response['messages'][] = 'Email không hợp lệ';
				}

				if ($func->checkAccount($email, 'email', 'customers', $iduser)) {
					$response['messages'][] = 'Email đã tồn tại';
				}
			}

			if (!empty($phone) && !$func->isPhone($phone)) {
				$response['messages'][] = 'Số điện thoại không hợp lệ';
			}

			if (empty($address)) {
				$response['messages'][] = 'Địa chỉ không được trống';
			}

			if (!empty($response)) {
				/* Flash data */
				$flash->set('fullname', $fullname);
				$flash->set('gender', $gender);
				$flash->set('birthday', $birthday);
				$flash->set('email', $email);
				$flash->set('phone', $phone);
				$flash->set('address', $address);

				/* Errors */
				$response['status'] = 'danger';
				$message = base64_encode(json_encode($response));
				$flash->set('message', $message);
				$func->redirect($https_config . "account?src=thong-tin");
			}

			if (!empty($old_password) && empty($isWrongPass)) {
				$data['password'] = $new_passwordMD5;
			}

			$data['fullname'] = $fullname;
			$data['email'] = $email;
			$data['phone'] = $phone;
			$data['address'] = $address;
			$data['gender'] = $gender;
			$data['birthday'] = strtotime(str_replace("/", "-", $birthday));
			$linkLogin = ($config['lang_check']) ? $https_config . $lang . '/account?src=dang-nhap' : $https_config . 'account?src=dang-nhap';
			$linkInfo = ($config['lang_check']) ? $https_config . $lang . '/account?src=thong-tin' : $https_config . 'account?src=thong-tin';
			$db->where('id', $iduser);
			if ($db->update('customers', $data)) {
				if ($old_password) {
					unset($_SESSION[$loginMember]);
					$func->_unsetCookie('login_member_id');
					$func->_unsetCookie('login_member_session');
					$func->transfer("Cập nhật thông tin thành công", $linkLogin);
				} else {
					$func->transfer("Cập nhật thông tin thành công", $linkInfo);
				}
			} else {
				$func->transfer("Cập nhật thông tin thất bại", $linkInfo, false);
			}
		}
	} else {
		$func->transfer("Trang không tồn tại", $https_config, false);
	}
}
function logoutMember()
{
	global $func, $https_config, $loginMember;
	unset($_SESSION[$loginMember]);
	unset($_SESSION['check-login']);
	$func->_unsetCookie('login_member_id');
	$func->_unsetCookie('login_member_session');
	$func->redirect($https_config);
}

?>