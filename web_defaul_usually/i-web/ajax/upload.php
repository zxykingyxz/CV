
<?php

    require_once 'ajaxConfig.php';

    @$id=$_POST["id"];

    $items=$db->rawQuery("select * from #_comment where id=?",[$id]);

    if(!empty($_FILES['file']) && count($_FILES['file'])){

        if(isset($_FILES['file'])){

            $file=$_FILES['file'];

            $file_name = $func->imagesName($_FILES['file']['name']);

            $photo = $func->uploadPhoto($file,'.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF|.webp', '../../upload/user/',$file_name);

            $sendx['photo'] = $photo;

            $db->where('id',$id);

            $db->update('comment',$sendx);

        }

    }

    echo 1;
    
?>