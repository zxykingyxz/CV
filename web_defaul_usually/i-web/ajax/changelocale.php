<?php 
    session_start(); 
      
    @$locale=$_POST['locale'];

    switch($locale){

        case 'vi':
            $_SESSION['lang_admin']='vi';
            $return['code']=1;
        break;

        case 'en':
            $_SESSION['lang_admin']='en';
            $return['code']=1;
        break;

        case 'jp':
            $_SESSION['lang_admin']='jp';
            $return['code']=1;
        break;

        default :
            $return['code']=0;
        break;
        
    }

    $array_list=array('code'=>$return['code']);

    echo json_encode($array_list);
?>
