
<?php

require_once 'ajaxConfig.php';

$code = $func->randString(7);

$_SESSION['captcha_code'] = $code;

echo json_encode([

    'code' => $code
]);
exit;
?>