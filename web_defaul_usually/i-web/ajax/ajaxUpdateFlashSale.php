<?php
require_once 'ajaxConfig.php';

@$id_check = htmlspecialchars($_POST['id_check']);

@$id_sale = htmlspecialchars($_POST['id_sale']);

$set_data = rtrim($id_check, ',');

$check_sale = $db->rawQueryOne("update table_flashsale set id_product = '{$set_data}'where type=? and id=? ", array('flashsale', $id_sale));
