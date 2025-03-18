<?php
	require_once 'ajaxConfig.php';
	
	$idl=$_POST['idl'];

	$d->reset();
    $sql = "select id,ten_vi from #_baiviet_list where id_thuonghieu='$idl' order by id desc";
    $d->query($sql);
    $row_cat = $d->result_array();

?>
<option>Chọn danh mục cấp 1</option>
<?php for($i=0;$i<count($row_cat);$i++){ ?>   
<option value="<?=$row_cat[$i]['id']?>"><?=$row_cat[$i]['ten_vi']?></option>
<?php } ?>   