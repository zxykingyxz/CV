<?php

require_once 'ajaxConfig.php';

if ($func->isAjax()) {

    $cache = new FileCache($db);

    $statistic = new statitis($db);

    $res["counter_items"] = $statistic->getCounter();

    $res["counter_online"] = $statistic->statusOnline();

    $res["message"] = "Cập nhật thành công!!!";
}

echo json_encode($res);
