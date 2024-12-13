<?php

require_once 'ajaxConfig.php';

if ($func->isAjax()) {

    @$captcha = htmlspecialchars($_POST['captcha']);

    @$name = htmlspecialchars($_POST['name']);

    $_SESSION[$name] = $captcha;

    $res['captcha'] = $captcha;
}

echo json_encode($res);
