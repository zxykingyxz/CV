<?php
require_once '../ajaxConfig.php';

if ($func->isAjax()) {

    @$value = htmlspecialchars($_POST['value']);

    @$form = htmlspecialchars($_POST['form']);

    $response = [
        "html" => [],
        "data" => [],
    ];
    switch ($form) {
        case 'viewed':
            $key = array_search($value, $_SESSION['product_viewed']);
            if (!empty($_SESSION['product_viewed'][$key])) {
                unset($_SESSION['product_viewed'][$key]);
                $response['html']['notification'] = "Hoàn thành xóa sản phẩm đã xem";
            }
            $func->_setCookie('_product_viewed_', $func->json_encode($_SESSION['product_viewed']));
            break;
        case 'like':
            if (empty($_SESSION['product_liked']) && !is_array($_SESSION['product_liked'])) {
                $_SESSION['product_liked'] = [];
            }
            if (!in_array($value, $_SESSION['product_liked']) && !empty($value)) {
                $_SESSION['product_liked'][] = $value;
            } else {
                $key = array_search($value, $_SESSION['product_liked']);
                if (!empty($_SESSION['product_liked'][$key])) {
                    unset($_SESSION['product_liked'][$key]);
                }
            }
            $func->_setCookie('_product_liked_', $func->json_encode($_SESSION['product_liked']));
            $response['data']['total'] = (!empty($_SESSION['product_liked'])) ?  count($_SESSION['product_liked']) : 0;
            break;
        default:
            break;
    }
    echo json_encode($response);
};
