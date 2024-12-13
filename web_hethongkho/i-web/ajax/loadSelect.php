<?php
	require_once 'ajaxConfig.php';

	@$id_product=$_POST['product'];
	@$value=$_POST['value'];
	@$type=$_POST['type'];
	@$action = $_POST['action'];

	echo $action;

	if($action == "list"){
		$results=$db->rawQuery("select * from table_baiviet_cat where id_list=? and type=? order by stt asc",array($value,$type));
	}else{
		$results=$db->rawQuery("select * from table_baiviet_item where id_cat=? and type=? order by stt asc",array($value,$type));
	}
	

?>
	<?php if($action=='list'){ ?>

		<option value="0">Chọn danh mục cấp 2</option>
		<?php for($i=0;$i<count($results);$i++){ ?>   
		<option value="<?=$results[$i]['id']?>"> - <?=$results[$i]['ten_vi']?></option>
		<?php } ?>

	<?php }else{?>

		<option value="0">Chọn danh mục cấp 3</option>
		<?php for($i=0;$i<count($results);$i++){ ?>   
		<option value="<?=$results[$i]['id']?>"> - <?=$results[$i]['ten_vi']?></option>
		<?php } ?>
		
	<?php } ?>
