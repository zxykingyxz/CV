<?php 
	require_once 'ajaxConfig.php';

    if($func->isAjax()){
        
        $orderid = $_POST['order'];

        $status = $_POST['status'];

        $data['order_status']=$status;

        $db->where('id',$orderid);

        $db->update('order',$data);

    }
?>