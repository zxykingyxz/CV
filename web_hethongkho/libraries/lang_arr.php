<?php 
	/*lang auto create 
	*
	* copyright bossini - tan1993.nina@gmail.com
	*
	* 31/05/2016
	*
	*/
	$lang_config = array();
	#=================================================================bài viết
	$lang_config[0]['name'] = 'baiviet';
	
	$lang_config[0]['value'][0]['name'] = 'ten';
	$lang_config[0]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[0]['value'][1]['name'] = 'mota';
	$lang_config[0]['value'][1]['type'] = 'TEXT';

	$lang_config[0]['value'][2]['name'] = 'noidung';
	$lang_config[0]['value'][2]['type'] = 'TEXT';
	#=================================================================sản phẩm
	$lang_config[1]['name'] = 'product';
	
	$lang_config[1]['value'][0]['name'] = 'ten';
	$lang_config[1]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[1]['value'][1]['name'] = 'mota';
	$lang_config[1]['value'][1]['type'] = 'TEXT';

	$lang_config[1]['value'][2]['name'] = 'noidung';
	$lang_config[1]['value'][2]['type'] = 'TEXT';
	#=================================================================info
	$lang_config[2]['name'] = 'info';
	
	$lang_config[2]['value'][0]['name'] = 'ten';
	$lang_config[2]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[2]['value'][1]['name'] = 'mota';
	$lang_config[2]['value'][1]['type'] = 'TEXT';

	$lang_config[2]['value'][2]['name'] = 'noidung';
	$lang_config[2]['value'][2]['type'] = 'TEXT';
	#=================================================================company
	$lang_config[3]['name'] = 'company';
	
	$lang_config[3]['value'][0]['name'] = 'ten';
	$lang_config[3]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[3]['value'][1]['name'] = 'mota';
	$lang_config[3]['value'][1]['type'] = 'TEXT';

	$lang_config[3]['value'][2]['name'] = 'noidung';
	$lang_config[3]['value'][2]['type'] = 'TEXT';
	#=================================================================list
	$lang_config[4]['name'] = 'list';
	
	$lang_config[4]['value'][0]['name'] = 'ten';
	$lang_config[4]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[4]['value'][1]['name'] = 'mota';
	$lang_config[4]['value'][1]['type'] = 'TEXT';
	#=================================================================cat
	$lang_config[5]['name'] = 'cat';
	
	$lang_config[5]['value'][0]['name'] = 'ten';
	$lang_config[5]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[5]['value'][1]['name'] = 'mota';
	$lang_config[5]['value'][1]['type'] = 'TEXT';
	#=================================================================item
	$lang_config[6]['name'] = 'item';
	
	$lang_config[6]['value'][0]['name'] = 'ten';
	$lang_config[6]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[6]['value'][1]['name'] = 'mota';
	$lang_config[6]['value'][1]['type'] = 'TEXT';
	#=================================================================sub
	$lang_config[7]['name'] = 'sub';
	
	$lang_config[7]['value'][0]['name'] = 'ten';
	$lang_config[7]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[7]['value'][1]['name'] = 'mota';
	$lang_config[7]['value'][1]['type'] = 'TEXT';
	#=================================================================gia
	$lang_config[8]['name'] = 'gia';
	
	$lang_config[8]['value'][0]['name'] = 'ten';
	$lang_config[8]['value'][0]['type'] = 'VARCHAR(255)';
	#=================================================================setting
	$lang_config[9]['name'] = 'setting';
	
	$lang_config[9]['value'][0]['name'] = 'ten';
	$lang_config[9]['value'][0]['type'] = 'VARCHAR(255)';

	$lang_config[9]['value'][1]['name'] = 'slogan';
	$lang_config[9]['value'][1]['type'] = 'VARCHAR(255)';

	$lang_config[9]['value'][2]['name'] = 'diachi';
	$lang_config[9]['value'][2]['type'] = 'VARCHAR(255)';

	#=================================================================lang
	$lang_config[10]['name'] = 'lang';
	$lang_config[10]['value'][0]['name'] = 'type';
	$lang_config[10]['value'][0]['type'] = 'VARCHAR(255)';
	#=================================================================create lang
	foreach ($config['lang'] as $lang) {
		$lang = $lang['type'];
		for ($i=0,$c=count($lang_config); $i < $c; $i++) { 
			$table = $lang_config[$i]['name'];
			for ($j=0,$cc=count($lang_config[$i]['value']); $j < $cc; $j++) { 
				$column  = $lang_config[$i]['value'][$j]['name'];
				$type = $lang_config[$i]['value'][$j]['type'];
				$d->query("SHOW COLUMNS FROM table_".$table." LIKE '".$column."_".$lang."'");
				$row = $d->fetch_array();
				if($row==null){
					$d->query("ALTER TABLE table_".$table." ADD ".$column."_".$lang." $type CHARACTER SET utf8 COLLATE utf8_unicode_ci ");	
				}
			}
		}
	}
	#=================================================================function delete lang
	if(!function_exists("delete_lang")){
		function delete_lang($lang = 'ci'){
			global $lang_config,$d;
			for ($i=0,$c=count($lang_config); $i < $c; $i++) { 
				$table = $lang_config[$i]['name'];
				for ($j=0,$cc=count($lang_config[$i]['value']); $j < $cc; $j++) { 
					$column  = $lang_config[$i]['value'][$j]['name'];
					$d->query("SHOW COLUMNS FROM table_".$table." LIKE '".$column."_".$lang."'");
					$row = $d->fetch_array();
					if($row!=null){
						$d->query("ALTER TABLE table_$table DROP ".$column."_".$lang);
					}
				}
			}
		}
	}
	
	//delete_lang('en');
?>