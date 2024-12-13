<?php
$data_status = $warehouse_func->status_handing_column();

$folder = _upload_baiviet_l;

if (isset($_POST['submit-add-data']) && !empty($_POST)) {

    $id =  (int)$_POST['id'];

    $data = $_POST['data'];

    $photo[0] = $_FILES['photo'];

    $_SESSION[$sessison_status_load] = $warehouse_func->save_data([
        "id" => $id,
        "data" => $data,
        "photo" => $photo,
        "folder" =>  $folder,
        "table" => $main_table,
    ]);

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}

$list_city = $cache->getCache("select name_$lang as name, id from #_place_citys ", array(), 'result', _TIMECACHE);

$list_dist = $cache->getCache("select name_$lang as name, id from #_place_dists ", array(), 'result', _TIMECACHE);
