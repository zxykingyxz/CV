<?php if (!defined('_source')) die("Error");

$folder = "upload/hinhanh/";

switch ($act) {
	case "capnhat":
		getMan();
		$template = "company/item_add";
		break;
	case "save":
		saveMan();
		break;
	default:
		$template = "index";
}

function getMan()
{

	global $db, $type, $item, $GLOBAL, $table;

	$table = $GLOBAL['company'][$type];

	$item = $db->rawQueryOne("select * from #_company where type=? limit 0,1", array($type));
}

function saveMan()
{

	global $db, $func, $url_path, $type, $GLOBAL, $table;

	$com = isset($_GET['com']) ? $_GET['com'] : '';

	$table = $GLOBAL['company'][$type];

	$data = $_POST['data'];

	$item = $db->rawQueryOne("select * from #_company where type=? limit 0,1", array($type));

	if ($_POST) {

		foreach ($data as $k => $v) {

			$send[$k] = htmlspecialchars($v);
		}
	}

	if (!empty($item)) {

		$send['ngaysua'] = time();

		$db->where('type', $type);

		$updateData = $db->update('company', $send);

		if ($updateData) {

			$response['status'] = 200;

			$response['message'] = "Cập nhật thông tin thành công";

			$message = base64_encode(json_encode($response));

			$func->redirect("index.html?com=company&act=capnhat{$url_path}&message={$message}");
		} else {

			$response['status'] = 201;

			$response['message'] = "Cập nhật thông tin không thành công";

			$message = base64_encode(json_encode($response));

			$func->redirect("index.html?com=company&act=capnhat{$url_path}&message={$message}");
		}
	} else {

		$send['type'] = $type;

		$send['ngaytao'] = time();

		$insertID = $db->insert('company', $send);

		if ($insertID) {
			$response['status'] = 200;
			$response['message'] = "Thêm dữ liệu thành công";
			$message = base64_encode(json_encode($response));
			$func->redirect("index.html?com=company&act=capnhat{$url_path}&message={$message}");
		} else {
			$response['status'] = 201;
			$response['message'] = "Thêm dữ liệu không thành công";
			$message = base64_encode(json_encode($response));
			$func->redirect("index.html?com=company&act=capnhat{$url_path}&message={$message}");
		}
	}
}
