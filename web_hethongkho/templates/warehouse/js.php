<script type="text/javascript">
    var _FRAMEWORK = _FRAMEWORK || {};
    var _ROOT = "<?= ($config['lang_check']) ? $https_config . $lang . '/' : $https_config ?>";
    var _URL = "<?= $func->getCurrentPageURL() ?>";
    var _LANG = <?= $config['lang_check'] ? 'true' : 'false' ?>;
</script>
<?php if (($config['gg_lang'])) { ?>
    <script type="text/javascript">
        function GoogleLanguageTranslatorInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'vi',
                autoDisplay: false
            }, 'google_language_translator');
        }
    </script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=GoogleLanguageTranslatorInit"></script>
<?php } ?>

<?php
$js->setJs('./assets/js/all.js');
$js->setJs("./assets/js/lazyload.min.js");
$js->setJs("./assets/js/jssor.slider-25.2.0.min.js");
$js->setJs("./assets/plugins/sweetalert2/sweetalert2.min.js");
$js->setJs("./assets/js/jssor_1_slider_init.js");
$js->setJs("./assets/plugins/CustomPlugin/btnNoneBlockPlugin.js");
$js->setJs("./assets/plugins/flatpickr/flatpickr.min.js");
$js->setJs("./assets/plugins/flatpickr/vn.js");
$js->setJs("./assets/js/lang/$lang.js");
$js->setJs("./assets/js/warehouse.js");

echo $js->getJs();
?>