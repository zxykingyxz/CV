<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$urlcu = '';
$id = addslashes($_REQUEST['id']);
switch($act){

	case "man_lang":
		get_langs();
		$template = "ngonngu/langs";
		break;
	case "add_lang":		
		$template = "ngonngu/lang_add";
		break;
	case "edit_lang":		
		get_ngonngu();
		$template = "ngonngu/lang_edit";
		break;
	case "save_lang":
		save_lang();
		break;
	case "delete_lang":
		delete_lang();
		break;	
	default:
		$template = "index";
}

#====================================
function get_langs(){

	global $db,$func,$type,$url_path, $items, $paging,$page;

	$perPage = 10;

	$startpoint = ($page * $perPage) - $perPage;

	$limit = ' limit '.$startpoint.','.$perPage;

	$where = '#_lang';

	if($_REQUEST['keyword']!=''){

		$ten = trim($_REQUEST['keyword']);

		$where.=" where item like '%$ten%' or lang_vi like '%$ten%' or lang_en like '%$ten%'";

	}
	$where .=" order by id desc";

    $sql = "select * from {$where} {$limit}";

	$items = $db->rawQuery($sql);

    $url = $func->getCurrentPageURLAdmin();

    $sql = "SELECT COUNT(*) as `numb` FROM {$where}";
    
    $count = $db->rawQueryOne($sql);

    $total=$count['numb'];



    $paging = $func->paginationAdmin($total,$perPage,$page,$url);
	// Doc va ghi file langvi, langen, langta
	$file_lang = "../sources/langWeb/lang_vi.php";

	if (!file_exists ($file_lang)){
		$file_lang = @fopen ($file_lang, "w+") or die ("Couldn't create the file");
		fwrite($file_lang, "<?php \n");
		foreach ($items as $key => $value) {
			$line = "@define ('".$value['item']."','".$value['lang_vi']."');\n";
			fwrite($file_lang, $line);
		}
		fwrite($file_lang, '?>');
		fclose ($file_lang);
	}
	// Doc va ghi file langen
	$file_langen = "../sources/langWeb/lang_en.php";
	if (!file_exists ($file_langen)){
		$file_langen = @fopen ($file_langen, "w+") or die ("Couldn't create the file");
		fwrite($file_langen, "<?php \n");
		foreach ($items as $key => $value) {
			$line = "@define ('".$value['item']."','".$value['lang_en']."');\n";
			fwrite($file_langen, $line);
		}
		fwrite($file_langen, '?>');
		fclose ($file_langen);
	}
}
function get_ngonngu(){
	global $db,$func, $type,$page,$url_path, $item;

    $id = (int)($_GET['id']);

    $sql = "select * from #_lang where id=?";

    $item = $db->rawQueryOne($sql,array($id));
    
    if(empty($item)){
       
        $response['status']=201;
       
        $response['message']="Dữ liệu #id{$id} không có trong hệ thống ";
       
        $message=base64_encode(json_encode($response));
        
        $func->redirect("index.html?com=ngonngu&act=man_lang{$url_path}&message={$message}");
    
    }
}
function save_lang(){
	global $db,$func,$config;
	if(empty($_POST)) 
		$func->transfer("Không nhận được dữ liệu", "index.php?com=ngonngu&act=man_lang");
	$id = (int)($_POST['id']);
	if($id){

		$data['item'] = $_POST['item'];

		foreach($config['lang'] as $k => $v){

			$data['lang_'.$k] = $_POST['lang_'.$k];

		}

		$db->Where('id', $id);

		$updateData=$db->update('lang',$data);


		if($updateData){

			create_lang();

			$func->redirect("index.php?com=ngonngu&act=man_lang&page=".$_REQUEST["page"]);

		}else{

			$func->transfer("Cập nhật bị lỗi", "index.php?com=ngonngu&act=man_lang&page=".$_REQUEST["page"]);
		}
	}
	else{

		$data['item'] = $_POST['item'];

		foreach($config['lang'] as $k => $v){

			$data['lang_'.$k] = $_POST['lang_'.$k];

		}
		$insertID=$db->insert('lang',$data);

		if($insertID){

			create_lang();

			$func->redirect("index.php?com=ngonngu&act=man_lang");

		}
		else

			$func->transfer("Dữ liệu bị lỗi, không thể thêm mới", "index.php?com=ngonngu&act=man_lang");
	}
}
function delete_lang(){	
	global $db,$func;

	if(isset($_GET['id'])){

		$id =  (int)$_GET['id'];

		$sql = "delete from #_lang where id='".$id."'";

		$db->rawQuery($sql);

		if($_REQUEST['page']!='') $page = "&page=". $_REQUEST['page'];

		else $page = "";

		if($db->rawQuery($sql)){

			$func->redirect("index.php?com=ngonngu&act=man_lang".$page);

		}else{

			$func->transfer("Xóa dữ liệu thành công", "index.php?com=ngonngu&act=man_lang".$page);

		}

	}elseif (isset($_GET['listid'])==true){

		$listid = explode(",",$_GET['listid']);
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i];
			$id =  (int)$idTin;
			$sql = "delete from #_lang where id='".$id."'";
			$db->query($sql);
		}
		$func->redirect("index.php?com=ngonngu&act=man_lang&page=".$_REQUEST['page']);
	}
	// else transfer("Không nhận được dữ liệu", "index.php?com=ngonngu&act=man_lang");
}
function create_lang(){
	global $db;
	$sql = "select * from #_lang where id != 0 order by id desc";
	$items = $db->rawQuery($sql);
	// Doc va ghi file lang, langen, langjp
	$file_lang = "../sources/langWeb/lang_vi.php";
	if (file_exists ($file_lang)){
		unlink($file_lang);
		$file_lang = @fopen ($file_lang, "w+") or die ("Couldn't create the file");
		fwrite($file_lang, "<?php \n");
		foreach ($items as $key => $value) {
			$line = "@define ('".$value['item']."','".$value['lang_vi']."');\n";
			fwrite($file_lang, $line);
		}
		fwrite($file_lang, '?>');
		fclose ($file_lang);
	}

	$file_langen = "../sources/langWeb/lang_en.php";
	if (file_exists ($file_langen)){
		unlink($file_langen);
		$file_langen = @fopen ($file_langen, "w+") or die ("Couldn't create the file");
		fwrite($file_langen, "<?php \n");
		foreach ($items as $key => $value) {
			$line = "@define ('".$value['item']."','".$value['lang_en']."');\n";
			fwrite($file_langen, $line);
		}
		fwrite($file_langen, '?>');
		fclose ($file_langen);
	}
}
?>