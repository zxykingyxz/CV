<?php



	$idl=addslashes($_GET['idl']);

	$per_page=$row_setting['page_sp'];



	$startpoint = ($page * $per_page) - $per_page;

    $condition = '';

    if($idl){
        $condition = " and find_in_set('".$idl."',id_thuonghieu)";
    }


    $sql="select *, tenkhongdau_$lang as tenkhongdau from table_baiviet where hienthi=1 and khuyenmai=1 $condition and type='san-pham' order by stt asc limit $startpoint,$per_page";

    $tintuc=$db->rawQuery($sql);



    $sql="select count(*) as num from table_baiviet where hienthi=1 $condition and  khuyenmai=1 and type='san-pham' order by stt asc";



    $count = $db->rawQuery($sql);

        

    $c=$db->rawQueryOne($sql);

    if($idl){

        $sql="select ten_$lang, mota_km_$lang from table_baiviet_list where hienthi=1 and id=? and type='thuong-hieu' order by stt asc";

        $th = $db->rawQueryOne($sql,array($idl));

    }

    $total = $c['num'];

    

    $url = $func->getCurrentPageURL();


    $paging = $func->pagination($total,$per_page,$page,$url,$idl);



    $str_breadcrumbs = $breadcrumbs->getUrl('Trang chủ',array(array('alias'=>'khuyen-mai','name'=>'Khuyến mãi')));

    $seopage = $db->rawQueryOne("select * from #_seopage where type = ? limit 0,1",array('khuyen-mai'));

    if($idl){

        $seo->setSeo('h1','SẢN PHẨM KHUYẾN MÃI '.$th['ten_'.$lang]);

        $seo->setSeo('content',$th['mota_km_'.$lang]);

    }else{

    $seo->setSeo('h1',$seopage['title_'.$seolang]);

    $seo->setSeo('content',$seopage['mota_'.$lang]);

    }

    if(!empty($seopage['title_'.$seolang])) $seo->setSeo('title',$seopage['title_'.$seolang]);

        else $seo->setSeo('title',$title_seo);

        if(!empty($seopage['keywords_'.$seolang])) $seo->setSeo('keywords',$seopage['keywords_'.$seolang]);

        if(!empty($seopage['description_'.$seolang])) $seo->setSeo('description',$seopage['description_'.$seolang]);

        $seo->setSeo('url',$func->getCurrentPageURL());

        $img_json_bar = (isset($seopage['options']) && $seopage['options'] != '') ? json_decode($seopage['options'],true) : null;

        if(!empty($seopage['photo']))

        {

            if($img_json_bar == null || ($img_json_bar['p'] != $seopage['photo']))

            {

                $img_json_bar = $func->getImgSize($seopage['photo'],_upload_seopage_l.$seopage['photo']);

                $seo->updateSeoDB(json_encode($img_json_bar),'seopage',$seopage['id']);

            }

            if(count($img_json_bar) > 0)

            {

                $seo->setSeo('photo',$https_config._thumbs.'/'.$img_json_bar['w'].'x'.$img_json_bar['h'].'x2/'._upload_seopage_l.$seopage['photo']);

                $seo->setSeo('photo:width',$img_json_bar['w']);

                $seo->setSeo('photo:height',$img_json_bar['h']);

                $seo->setSeo('photo:type',$img_json_bar['m']);

            }

        }


	

?>