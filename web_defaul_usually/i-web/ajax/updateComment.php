<?php 
    require_once 'ajaxConfig.php';

    @$reply = htmlspecialchars($_POST['reply']);

    @$id=$_POST["id"];

    $db->rawQuery("update #_comment SET admin=1, traloi=? where id=?",[$reply,$id]);

?>