<?php 
	require_once 'ajaxConfig.php';
	if(isset($_POST["keyword"]) & $func->isAjax()){

        $where = "";
        $cond=[];
        if(isset($_POST["type"])){
            $where .= ' and type in(';
            $types = explode(",",$_POST["type"]);
            foreach($types as $key => $type){
                if($key == 0){
                    $where .= '?';
                }else{
                    $where .= ",?";
                }
                array_push($cond,$type);
            }
            $where .= ' )';
        }
        if(isset($_POST['keyword'])){
            $keyword = $_POST['keyword'];
            $where .= " and ten_$lang like ?";
            array_push($cond,'%'.$keyword.'%');
        }
        $view = $_POST['view'];
        $idtab = $_POST['id'];
        $box = $_POST['box'];
		$sql = "select id,ten_$lang as ten,giaban,photo from #_baiviet where hienthi=1 {$where} order by id desc";
        $data = $db->rawQuery($sql,$cond);
        foreach($data as $key => $value){?>
            <div class="itemview">
                <a href="javascript:void(0)" onclick="FRAMEWORK.changeView('<?=$view?>','<?=$idtab?>',<?= $value['id']?>,this,'<?= $box?>')">
                    <div class="bvlq">
                        <div class="thumb">
                            <img src="<?= _upload_baiviet.$value['photo']?>" alt="<?= $value['ten']?>"/>
                        </div>
                        <div class="content">
                            <p class="title"><?= $value['ten']?></p>
                            <p class="price"><?= $func->changeMoney($value['giaban'],'đ')?></p>
                        </div>
                    </div>
                </a>
            </div>
        <?php }
	}
?>
