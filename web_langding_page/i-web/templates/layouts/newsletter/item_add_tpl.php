

<h3>Thêm Email</h3>
<form name="frm" method="post" action="index.html?com=newsletter&act=save<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?><?php if($_REQUEST['page']!='') echo'&page='. $_REQUEST['page'];?>" enctype="multipart/form-data" class="nhaplieu">
	
    <b>Email</b> <input type="text" name="email" value="<?=$item['email']?>" class="input" /><br /><br>
	<b>Hiển thị</b> <input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>><br />
	
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.html?com=newsletter&act=man&type=<?=$_GET['type']?>&page=<?=$_GET['page']?>'" class="btn" />
</form>