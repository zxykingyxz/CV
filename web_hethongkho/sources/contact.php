<?php if (!defined('_source')) die("Error");
if (isset($_POST['submit-contact']) && !empty($_POST)) {
	$response = array();
	$send = array();
	$data = $_POST['dataContact'];
	$fullname = htmlspecialchars($func->sanitize($data['fullname']));
	$phone = htmlspecialchars($func->sanitize($data['phone']));
	$email = htmlspecialchars($func->sanitize($data['email']));
	$address = htmlspecialchars($func->sanitize($data['address']));
	$content = htmlspecialchars($func->sanitize($data['content']));
	$captcha = htmlspecialchars($func->sanitize($data['captcha']));

	if (empty($fullname)) {
		$response['messages'][] = 'Họ tên không được để trống!';
	}
	if (empty($phone)) {
		$response['messages'][] = 'Số điện thoại không được để trống!';
	}
	if (!empty($phone) && !$func->isPhone($phone)) {
		$response['messages'][] = 'Số điện thoại không hợp lệ!';
	}
	if (!empty($email) && !$func->isEmail($email)) {
		$response['messages'][] = 'Email không hợp lệ!';
	}
	if (empty($address)) {
		$response['messages'][] = 'Địa chỉ không được để trống!';
	}
	if ($captcha != $_SESSION['captcha_code']) {
		$response['messages'][] = 'Captcha không hợp lệ!';
	}
	if (!empty($response)) {
		/* Flash data */
		if (!empty($data)) {
			foreach ($data as $k => $v) {
				if (!empty($v)) {
					$flash->set($k, $v);
				}
			}
		}

		/* Errors */
		$response['status'] = 'danger';
		$message = base64_encode(json_encode($response));
		$flash->set("message", $message);
		$func->redirect($com);
	}

	if ($captcha == $_SESSION['captcha_code']) {
		$titleSubject = 'Liên hệ đến từ website';
		$send['fullname'] = $fullname;
		$send['email'] = $email;
		$send['phone'] = $phone;
		$send['address'] = $address;
		$send['content'] = $content;
		$send['subject'] = $titleSubject;
		$send['hienthi'] = 1;
		$send['type'] = 'contact';
		$send['createdAt'] = time();
		$insertId = $db->insert('contact', $send);

		if (!$insertId) $func->transfer("Gửi liên hệ thất bại. Vui lòng thử lại sau.", $_SERVER['HTTP_REFERER'], false);

		/* Gán giá trị gửi email */
		$strThongtin = '';
		$classEmail->setEmail('tennguoigui', $data['fullname']);
		$classEmail->setEmail('emailnguoigui', $data['email']);
		$classEmail->setEmail('dienthoainguoigui', $data['phone']);
		$classEmail->setEmail('diachinguoigui', $data['address']);
		$classEmail->setEmail('tieudelienhe', $titleSubject);
		$classEmail->setEmail('noidunglienhe', $data['content']);
		if ($classEmail->getEmail('tennguoigui')) {
			$strThongtin .= '<span style="text-transform:capitalize">' . $classEmail->getEmail('tennguoigui') . '</span><br>';
		}
		if ($classEmail->getEmail('emailnguoigui')) {
			$strThongtin .= '<a href="mailto:' . $classEmail->getEmail('emailnguoigui') . '" target="_blank">' . $classEmail->getEmail('emailnguoigui') . '</a><br>';
		}
		if ($classEmail->getEmail('diachinguoigui')) {
			$strThongtin .= '' . $classEmail->getEmail('diachinguoigui') . '<br>';
		}
		if ($classEmail->getEmail('dienthoainguoigui')) {
			$strThongtin .= 'Tel: ' . $classEmail->getEmail('dienthoainguoigui') . '';
		}
		$classEmail->setEmail('thongtin', $strThongtin);

		/* Defaults attributes email */
		$emailDefaultAttrs = $classEmail->defaultAttrs();

		/* Variables email */
		$emailVars = array(
			'{emailTitleSender}',
			'{emailInfoSender}',
			'{emailSubjectSender}',
			'{emailContentSender}'
		);
		$emailVars = $classEmail->addAttrs($emailVars, $emailDefaultAttrs['vars']);

		/* Values email */
		$emailVals = array(
			$classEmail->getEmail('tennguoigui'),
			$classEmail->getEmail('thongtin'),
			$classEmail->getEmail('tieudelienhe'),
			$classEmail->getEmail('noidunglienhe')
		);
		$emailVals = $classEmail->addAttrs($emailVals, $emailDefaultAttrs['vals']);

		/* Send email admin */
		$arrayEmail = null;
		$subject = "Khách khàng " . $classEmail->getEmail('emailnguoigui') . " Đăng Ký Nhận Thông Tin Tư Vấn";
		$message = str_replace($emailVars, $emailVals, $classEmail->markdown('contact/admin'));
		$file = '';

		if ($classEmail->sendEmail("admin", $arrayEmail, $subject, $message, $file)) {

			/* Send email customer */
			$arrayEmail = array(
				"dataEmail" => array(
					"name" => $classEmail->getEmail('tennguoigui'),
					"email" => $classEmail->getEmail('emailnguoigui')
				)
			);
			$subject = "Thư liên hệ từ " . $https_config;
			$message = str_replace($emailVars, $emailVals, $classEmail->markdown('contact/customer'));
			$file = '';

			if ($classEmail->sendEmail("customer", $arrayEmail, $subject, $message, $file)) $func->transfer("Gửi liên hệ thành công", $_SERVER['HTTP_REFERER']);
		} else $func->transfer("Gửi liên hệ thất bại. Vui lòng thử lại sau", $_SERVER['HTTP_REFERER'], false);
	} else {
		$func->transfer("Gửi liên hệ thất bại. Vui lòng thử lại sau", $_SERVER['HTTP_REFERER'], false);
	}
}
$row_contact = $db->rawQueryOne("select ten_$lang,mota_$lang ,noidung_$lang from #_company where type=? limit 0,1", array($type));
/* SEO */
$seopage = $db->rawQueryOne("select * from #_seopage where type = ? limit 0,1", array($type));
if (!empty($seopage['title_' . $seolang])) $seo->setSeo('h1', $seopage['title_' . $seolang]);
if (!empty($seopage['title_' . $seolang])) $seo->setSeo('title', $seopage['title_' . $seolang]);
if (!empty($seopage['keywords_' . $seolang])) $seo->setSeo('keywords', $seopage['keywords_' . $seolang]);
if (!empty($seopage['description_' . $seolang])) $seo->setSeo('description', $seopage['description_' . $seolang]);
$seo->setSeo('url', $func->getCurrentPageURL());
$img_json_bar = (isset($seopage['options']) && $seopage['options'] != '') ? json_decode($seopage['options'], true) : null;
if ($img_json_bar == null || ($img_json_bar['p'] != $seopage['photo'])) {
	$img_json_bar = $func->getImgSize($seopage['photo'], _upload_seopage_l . $seopage['photo']);
	$seo->updateSeoDB(json_encode($img_json_bar), 'seopage', $seopage['id']);
}
if (count($img_json_bar) > 0) {
	$seo->setSeo('photo', $https_config . _thumbs . '/' . $img_json_bar['w'] . 'x' . $img_json_bar['h'] . 'x2/' . _upload_seopage_l . $seopage['photo']);
	$seo->setSeo('photo:width', $img_json_bar['w']);
	$seo->setSeo('photo:height', $img_json_bar['h']);
	$seo->setSeo('photo:type', $img_json_bar['m']);
}

$str_breadcrumbs = $breadcrumbs->getUrl('Trang chủ', array(array('alias' => $type, 'name' => $title_seo)));
