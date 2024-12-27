<?php if (!defined('_source')) die("Error");


$folder = _upload_hinhanh;

switch ($act) {
	case "capnhat":
		getInfo();
		$template = "info/item_add";
		break;
	case "save":
		saveInfo();
		break;
	default:
		$template = "index";
}

function getInfo()
{

	global $db, $func, $com, $type, $url_path, $item, $GLOBAL, $table;

	$table = $GLOBAL[$com][$type];

	$sql = "select * from #_{$com} where type='" . $type . "' limit 0,1";

	$item = $db->rawQueryOne($sql);
}
function saveInfo()
{

	global $db, $func, $config, $url_path, $folder, $GLOBAL, $table;

	$com = isset($_GET['com']) ? $_GET['com'] : '';

	$type = isset($_GET['type']) ? $_GET['type'] : '';

	$table = $GLOBAL[$com][$type];

	$data = $_POST['data'];

	$item = $db->rawQueryOne("select id from #_$com where type=? limit 1", array($type));

	if ($_POST) {

		foreach ($data as $k => $v) {

			$send[$k] = htmlspecialchars($v);
		}
	}

	$send['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;

	$send['mucluc'] = isset($_POST['mucluc']) ? 1 : 0;

	$file = $_FILES['file'];

	if (!empty($file)) {

		if ($file['error'] == 0) {

			$photo = $func->uploadImg(0, "photo", "", $file, $folder, $com, $table['img-width'], $table['img-height'], $table['img-ratio'], $table['img-b']);

			$send['photo'] = $photo['photo'];
		}
	}

	$file1 = $_FILES['file1'];

	if (!empty($file1)) {

		if ($file1['error'] == 0) {

			$photo = $func->uploadImg(0, "video", "", $file1, $folder, $com, $table['img-width'], $table['img-height'], $table['img-ratio'], $table['img-b']);

			$send['video'] = $photo['video'];
		}
	}

	$file2 = $_FILES['file2'];

	if (!empty($file2)) {

		if ($file2['error'] == 0) {

			$photo = $func->uploadImg(0, "photo2", "", $file2, $folder, $com, $table['img-width'], $table['img-height'], $table['img-ratio'], $table['img-b']);

			$send['photo2'] = $photo['photo2'];
		}
	}

	$dataSeo = (isset($_POST['dataseo'])) ? $_POST['dataseo'] : null;

	if ($dataSeo) {
		foreach ($dataSeo as $column => $value) {
			$dataSeo[$column] = htmlspecialchars($value);
		}
	}


	if (!empty($item)) {

		$send['ngaysua'] = time();

		$db->where('type', $type);

		$updateData = $db->update($com, $send);

		if ($updateData) {

			$db->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?", array(0, $com, 'capnhat', $type));

			$dataSeo['idmuc'] = 0;

			$dataSeo['com'] = $com;

			$dataSeo['act'] = 'capnhat';

			$dataSeo['type'] = $type;

			$db->insert('seo', $dataSeo);

			$response['status'] = 200;

			$response['message'] = "Cập nhật thông tin thành công";

			$message = base64_encode(json_encode($response));

			$func->redirect("index.html?com={$com}&act=capnhat{$url_path}&message={$message}");
		} else {

			$response['status'] = 201;

			$response['message'] = "Cập nhật thông tin không thành công";

			$message = base64_encode(json_encode($response));

			$func->redirect("index.html?com={$com}&act=capnhat{$url_path}&message={$message}");
		}
	} else {

		$send['type'] = $type;

		$send['ngaytao'] = time();

		$insertID = $db->insert($com, $send);

		if ($insertID) {

			$db->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?", array(0, $com, 'capnhat', $type));

			$dataSeo['idmuc'] = 0;

			$dataSeo['com'] = $com;

			$dataSeo['act'] = 'capnhat';

			$dataSeo['type'] = $type;

			$db->insert('seo', $dataSeo);

			$response['status'] = 200;

			$response['message'] = "Thêm thông tin thành công";

			$message = base64_encode(json_encode($response));

			$func->redirect("index.html?com={$com}&act=capnhat{$url_path}&message={$message}");
		} else {

			$response['status'] = 201;

			$response['message'] = "Thêm thông tin không thành công";

			$message = base64_encode(json_encode($response));

			$func->redirect("index.html?com={$com}&act=capnhat{$url_path}&message={$message}");
		}
	}
}
