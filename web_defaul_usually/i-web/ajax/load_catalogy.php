<?php
	
	require_once 'ajaxConfig.php';
	$id = (int)$_POST['val'];
	$table = htmlspecialchars($_POST['table']);
	$type = htmlspecialchars($_POST['type']);
	$field_change = htmlspecialchars($_POST['field_change']);
	if($type!='null'){
		$param_change = array($type,$id);
		if($id){
			if($table == 'baiviet_cat'){
				$title = 'Chọn danh mục cấp 2';
			}
			if($table == 'baiviet_item'){
				$title = 'Chọn danh mục cấp 3';
			}
			if($table == 'baiviet_sub'){
				$title = 'Chọn danh mục cấp 4';
			}
			$resp = $db->rawQuery("SELECT ten_vi,id from #_$table where type=? and $field_change=? order by stt asc, id desc",$param_change);
		}
	}else{
		if($table == 'place_dists'){
			$title = 'Chọn quận / huyện';
		}
		if($table == 'place_wards'){
			$title = 'Chọn phường / xã';
		}
		$param_change = array($id);
		$resp = $db->rawQuery("SELECT name_vi,id from #_$table where $field_change=? order by id desc",$param_change);
	}
	
?>
<option value="0"><?=$title?></option>
<?php for($i=0;$i<count($resp);$i++){ ?>
<option value="<?=$resp[$i]['id']?>"><?=$resp[$i]['ten_vi']?></option>
<?php } ?>