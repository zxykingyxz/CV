<?php if (!defined('_source')) die("Error");

$folder = _upload_baiviet;

$folder_img = _upload_hinhanh;

switch ($act) {
	case "man_list":
		$apiProduct->getMans();
		$template = "baiviet/list/items";
		break;
	case "add_list":
		$template = "baiviet/list/item_add";
		break;
	case "edit_list":
		$apiProduct->getMan();
		$template = "baiviet/list/item_add";
		break;
	case "save_list":
		$apiProduct->saveMan();
		break;
	case "delete_list":
		$apiProduct->deleteMan();
		break;
		#===================================================
	case "man_cat":
		$apiProduct->getMans();
		$apiProduct->getPageList();
		$template = "baiviet/cat/items";
		break;
	case "add_cat":
		$apiProduct->getPageList();
		$template = "baiviet/cat/item_add";
		break;
	case "edit_cat":
		$apiProduct->getMan();
		$apiProduct->getPageList();
		$template = "baiviet/cat/item_add";
		break;
	case "save_cat":
		$apiProduct->saveMan();
		break;
	case "delete_cat":
		$apiProduct->deleteMan();
		break;
		#===================================================
	case "man_item":
		$apiProduct->getMans();
		$apiProduct->getPageList();
		$template = "baiviet/item/items";
		break;
	case "add_item":
		$apiProduct->getPageList();
		$template = "baiviet/item/item_add";
		break;
	case "edit_item":
		$apiProduct->getMan();
		$apiProduct->getPageList();
		$template = "baiviet/item/item_add";
		break;
	case "save_item":
		$apiProduct->saveMan();
		break;
	case "delete_item":
		$apiProduct->deleteMan();
		break;
		#===================================================
	case "man":
		$apiProduct->getPageList();
		$apiProduct->getMans();
		$template = "baiviet/man/items";
		break;
	case "add":
		$apiProduct->getPageList();
		$template = "baiviet/man/item_add";
		break;
	case "edit":
		$apiProduct->getMan();
		$apiProduct->getPageList();
		$template = "baiviet/man/item_add";
		break;
	case "save":
		$apiProduct->saveMan();
		break;
	case "copy":
		getCopy();
		$template = "baiviet/man/item_add";
		break;
	case 'save_copy':
		saveCopy();
		break;
	case "delete":
		$apiProduct->deleteMan();
		break;
	default:
		$template = "index";
}
function getCopy()
{

	global $id, $db, $func, $url_path, $type, $item, $GLOBAL, $table, $items_list, $items_cat, $items_item;

	$id = isset($_GET["id_copy"]) ? $_GET["id_copy"] : '';

	$com = isset($_GET["com"]) ? $_GET["com"] : '';

	$sql = "select * from #_$com where id=?";

	$item = $db->rawQueryOne($sql, array($id));

	$table = $GLOBAL[$com][$type];

	if (empty($item)) {

		$response['status'] = 201;

		$response['message'] = "Dữ liệu #id{$id} không có trong hệ thống ";

		$message = base64_encode(json_encode($response));

		$func->redirect("index.html?com=$com&act=man{$url_path}&message={$message}");
	}

	$items_list = $db->rawQuery("SELECT * from #_baiviet_list where type=? order by stt asc, id desc", array($type));

	if ($id) {

		$items_cat = $db->rawQuery("SELECT * from #_baiviet_cat where type=? and id_list=? order by stt asc, id desc", array($type, $item['id_list']));

		$items_item = $db->rawQuery("SELECT * from #_baiviet_item where type=? and id_cat=? order by stt asc, id desc", array($type, $item['id_cat']));
	}
}

function saveCopy()
{

	global $db, $func, $config, $lang, $type, $folder, $url_path, $GLOBAL, $table;

	$id = (int)$_GET['id_copy'];

	$com = (string)$_GET['com'];

	$file = $_FILES['file'];

	$table = $GLOBAL[$com][$type];

	if ($id) {

		$data = $_POST['data'];

		$pCopy = $db->rawQueryOne("select * from #_baiviet where id=? limit 1", array($id));

		foreach ($data as $column => $value) {

			$send[$column] = htmlspecialchars($value);
		}

		if ($data['giaban']) {

			$send['giaban'] = str_replace(',', '', $data['giaban']);
		}
		if ($data['giacu']) {

			$send['giacu'] = str_replace(',', '', $data['giacu']);
		}

		if ($data['giabansale']) {

			$send['giabansale'] = str_replace(',', '', $data['giabansale']);
		}
		if ($data['max']) {

			$send['max'] = str_replace(',', '', $data['max']);
		}

		if ($data['min']) {

			$send['min'] = str_replace(',', '', $data['min']);
		}

		if ($data['dien-tich']) {

			$send['dien-tich'] = str_replace(',', '', $data['dien-tich']);
		}

		if ($data['text_search']) {

			$send['text_search'] = $func->changeSearch($data['ten_vi']);
		}
		$send['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;

		$savehere = (isset($_POST['save-here'])) ? true : false;

		if (isset($table['seo']) && $table['seo'] == true) {

			$dataSeo = (isset($_POST['dataseo'])) ? $_POST['dataseo'] : null;

			if ($dataSeo) {

				foreach ($dataSeo as $column => $value) {

					$dataSeo[$column] = htmlspecialchars($value);
				}
			}
		}


		if (!empty($file['name'])) {


			if ($id) {

				if ($file['error'] == 0) {


					$photo = $func->uploadImg($id, "photo", "thumb", $file, $folder, $com, $table['img-width'], $table['img-height'], $table['img-ratio'], $table['img-b']);



					$send['photo'] = $photo['photo'];



					$send['thumb'] = $photo['thumb'];
				}
			} else {

				if ($file['error'] == 0) {

					$photo = $func->uploadImg(0, "photo", "thumb", $file, $folder, $com, $table['img-width'], $table['img-height'], $table['img-ratio'], $table['img-b']);

					$send['photo'] = $photo['photo'];

					$send['thumb'] = $photo['thumb'];
				}
			}
		} else {

			@copy($folder . $pCopy['photo'], $folder . 'copy' . $id . '_' . $pCopy['photo']);

			@copy($folder . $pCopy['thumb'], $folder . 'copy' . $id . '_' . $pCopy['thumb']);

			$send['photo'] = 'copy' . $id . '_' . $pCopy['photo'];

			$send['thumb'] = 'copy' . $id . '_' . $pCopy['thumb'];
		}



		$send['ngaytao'] = time();

		$send['type'] = $type;

		$insertID = $db->insert($com, $send);

		if ($insertID) {

			if (isset($table['seo']) && $table['seo'] == true) {

				$dataSeo['idmuc'] = $insertID;

				$dataSeo['com'] = $com;

				$dataSeo['act'] = 'man' . $tbl;

				$dataSeo['type'] = $type;

				$db->insert('seo', $dataSeo);
			}

			if (isset($table['alias']) && $table['alias'] == true) {

				$dataAlias['id_parent'] = $insertID;

				$dataAlias['com'] = $com;

				$dataAlias['act'] = '';

				$dataAlias['type'] = $type;

				foreach ($config['lang'] as $k => $v) {

					$dataAlias['tenkhongdau_' . $k] = $data['tenkhongdau_' . $k];
				}

				$dataAlias['ngaytao'] = time();

				$db->insert('alias', $dataAlias);
			}

			$response['status'] = 200;

			$response['message'] = "Copy #id{$id} thành công";

			$message = base64_encode(json_encode($response));

			if ($savehere) $func->redirect("index.html?com={$com}&act=copy{$url_path}&message={$message}");
			else $func->redirect("index.html?com={$com}&act=man{$url_path}&message={$message}");
		} else {

			$response['status'] = 201;

			$response['message'] = "Copy #id{$id} không thành công";

			$message = base64_encode(json_encode($response));

			if ($savehere) $func->redirect("index.html?com={$com}&act=copy{$url_path}&message={$message}");
			else $func->redirect("index.html?com={$com}&act=man{$url_path}&message={$message}");
		}
	}
}
