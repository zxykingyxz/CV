<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Hệ thống quản lý ngân sách</title>
    <link href="assets/images/favicon.png" rel="shortcut icon" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        :root {
            --html-all-admin: #eab741;
            --html-bg-all-admin: #212529;
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link href="assets/plugins/fontawesome/css/all.min.css" type="text/css" rel="stylesheet">
    <link href="assets/css/reset.css" type="text/css" rel="stylesheet" />
    <link href="assets/css/tailwind/output.css" type="text/css" rel="stylesheet" />
    <link href="assets/css/default.css" type="text/css" rel="stylesheet" />
    <link href="assets/css/style.css" type="text/css" rel="stylesheet" />
    <link href="assets/plugins/Notiflix/notiflix.css" type="text/css" rel="stylesheet" />
    <link href="assets/plugins/flatpickr/flatpickr.min.css" type="text/css" rel="stylesheet" />
    <link href="assets/plugins/sumoselect/sumoselect.css" type="text/css" rel="stylesheet" />
    <link href="assets/plugins/rangeSlider/ion.rangeSlider.css" type="text/css" rel="stylesheet" />

    <script>
        var FRAMEWORK = FRAMEWORK || {};
        var ROOT = "<?= $https_config ?>";
        var COM = "<?= $_COM ?>";
        var ACT = "<?= $_ACT ?>";
        var TYPE = "<?= $_TYPE ?>";
        var LANG = "<?= $lang ?>";
    </script>
    <script src="assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="assets/plugins/Notiflix/notiflix.js" type="text/javascript"></script>
    <script src="assets/plugins/lucide/lucide.min.js" type="text/javascript"></script>
    <script src="assets/plugins/flatpickr/flatpickr.min.js" type="text/javascript"></script>
    <script src="assets/plugins/flatpickr/vn.js" type="text/javascript"></script>
    <script src="assets/js/functions.js" type="text/javascript"></script>
</head>

<body class="body_load opacity-100 transition-all duration-300">
    <?php
    include_once _TEMPLATES . $template . "_tpl.php";
    ?>
    <div class="" id="form_modal"></div>
    <script src="assets/plugins/sumoselect/jquery.sumoselect.min.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/animationNumber.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/updateUrlParams.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/formatInputPlugin.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/btnNoneBlockPlugin.js" type="text/javascript"></script>
    <script src="assets/plugins/rangeSlider/ion.rangeSlider.js" type="text/javascript"></script>
    <script src="assets/js/index.js" type="text/javascript"></script>
    <?php if (!empty($_GET['message']) && $_GET['message'] != NULL) {
        $notice = json_decode(base64_decode($_GET['message']), true);
        $status = ($notice['status'] == 200) ? 'success' : 'error';
    ?>
        <script type="text/javascript">
            FRAMEWORK.showNotification({
                title: "Thông báo hệ thống",
                message: "<?= $notice['message'] ?>",
                status: "<?= $status ?>",
            });
            window.history.pushState(null, '', "<?= $func->getUrlParam(["com" => $_COM, "src" => $_SRC, 'type' => $_TYPE, "act" => $_ACT,  "page" => $array_param_value['page']]) ?>");
        </script>
    <?php } ?>
</body>

</html>