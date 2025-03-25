<?php	
	if(!defined('_source')) die("Error");
	switch($act)
	{
		case "delete":
			deleteCache();
			break;

		default:
			$template = "404";
	}
	function deleteCache()
	{
		global $func, $cache;
		if($cache->DeleteCache()) $func->transfer("Xóa cache thành công", "index.html");
		else $func->transfer("Xóa cache thất bại", "index.html");
	}
?>