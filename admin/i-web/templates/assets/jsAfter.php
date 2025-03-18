<script src="assets/plugins/Custom/btnNoneBlockPlugin.js" type="text/javascript"></script>
<script src="assets/plugins/Custom/updateUrlParams.js" type="text/javascript"></script>
<script src="assets/plugins/Custom/formatInputPlugin.js" type="text/javascript"></script>
<script src="assets/plugins/sumoselect/jquery.sumoselect.min.js" type="text/javascript"></script>
<script src="ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="assets/plugins/notiflix/notiflix.js" type="text/javascript"></script>

<script src="assets/js/main.js" type="text/javascript"></script>
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