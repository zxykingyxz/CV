<?php

require_once 'ajaxConfig.php';
$slug = $_POST["keywords"];
$lang = $_POST["lang"];
$checkSlug = $func->checkSlug($slug);
if ($checkSlug == 'exists') {
    $result['status'] = 201;
    $result['msg'] = 'Link đã tồn tại';
} else {
    $result['status'] = 200;
    $result['msg'] = '';
}

echo json_encode($result);
