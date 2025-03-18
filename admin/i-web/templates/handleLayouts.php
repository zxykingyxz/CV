<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Administrator - Hệ thống quản trị nội dung</title>
    <link href="assets/images/favicon.png" rel="shortcut icon" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include_once _TEMPLATES . "assets/css.php"; ?>
    <?php include_once _TEMPLATES . "assets/jsBefore.php"; ?>
</head>

<body>
    <?php
    switch ($_COM) {
        case 'error':
        case 'user':
            include_once _TEMPLATES . $layouts . "_tpl.php";
            break;
        default:
            include_once _FORM  . "default_tpl.php";
            break;
    }
    ?>
    <?php include_once _TEMPLATES . "assets/jsAfter.php"; ?>

</body>

</html>