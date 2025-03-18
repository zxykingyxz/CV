<script>
    var FRAMEWORK = FRAMEWORK || {};
    var ROOT = "<?= $https_config ?>";
    var COM = "<?= $com ?>";
    var ACT = "<?= $act ?>";
    var TYPE = "<?= $type ?>";
    var LANG = "<?= $lang ?>"
</script>
<script src="assets/js/jquery.min.js" type="text/javascript"></script>
<script src="assets/plugins/toast/toast.js" type="text/javascript"></script>

<?php
switch ($com) {
    case 'user':
?>
        <script src="assets/js/particles.js" type="text/javascript"></script>
    <?php
        break;
    default:
    ?>
        <script src="assets/js/functions.js" type="text/javascript"></script>
<?php break;
}
?>