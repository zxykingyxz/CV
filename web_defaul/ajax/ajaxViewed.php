<?php
require_once 'ajaxConfig.php';

if ($func->isAjax()) {

    @$value = htmlspecialchars($_POST['value']);

    $key = array_search($value, $_SESSION['product_viewed']);

    if (!empty($_SESSION['product_viewed'][$key])) {
        unset($_SESSION['product_viewed'][$key]);
    }

    $func->_setCookie('_product_viewed_', $func->json_encode($_SESSION['product_viewed']));
};
