<script>
    var FRAMEWORK = FRAMEWORK || {};
    var ROOT = "<?= $https_config ?>";
    var COM = "<?= $_COM ?>";
    var ACT = "<?= $_ACT ?>";
    var TYPE = "<?= $_TYPE ?>";
</script>
<script src="assets/js/jquery.min.js" type="text/javascript"></script>
<script src="assets/plugins/lucide/lucide.min.js" type="text/javascript"></script>
<?php
switch ($_COM) {
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