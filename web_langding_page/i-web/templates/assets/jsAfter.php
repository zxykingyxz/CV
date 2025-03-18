<script src="assets/plugins/Custom/btnNoneBlockPlugin.js" type="text/javascript"></script>
<script src="assets/plugins/Custom/updateUrlParams.js" type="text/javascript"></script>
<script src="assets/plugins/Custom/formatInputPlugin.js" type="text/javascript"></script>
<script src="assets/plugins/sumoselect/jquery.sumoselect.min.js" type="text/javascript"></script>
<script src="assets/js/main.js" type="text/javascript"></script>
<?php
if (!empty($_GET['message']) && $_GET['message'] != NULL) {
    $notice = json_decode(base64_decode($_GET['message']), true);
    $status = ($notice['status'] == 200) ? 'success' : 'error';
?>
    <script type="text/javascript">
        FRAMEWORK.showNotification({
            title: 'Thông báo hệ thống',
            message: "<?= $notice['message'] ?>",
            status: "<?= $status ?>"
        });
    </script>
<?php } ?>