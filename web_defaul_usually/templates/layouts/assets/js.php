<script type="text/javascript">
    var _FRAMEWORK = _FRAMEWORK || {};
    var _ROOT = "<?= ($config['lang_check']) ? $https_config . $lang . '/' : $https_config ?>";
    var _URL = "<?= $func->getCurrentPageURL() ?>";
    var _COM = "<?= $com ?>";
    var _LANG = <?= $config['lang_check'] ? 'true' : 'false' ?>;
    var _TOC = "<?= $rowc['data']['toc'] ?>";
    var _PID = "<?= (!empty($row_detail['id'])) ? $row_detail['id'] : '' ?>";
    var _LIST_TOC = <?= (!empty($row_toc)) ? $row_toc : 0 ?>;
    var _KEYWORD = "<?= $_GET["keywords"] ?>";
    var _PLACEHOLDER = ["Nhập Sản Phẩm Bạn Cần Tìm...."];
    var PAGE_INDEX = "<?= $func->getPagingByComFor('index') ?>";
    var NAME_COMPANY = "<?= $row_setting["name_$lang"] ?>";
    var nonecopy = " <?= $row_setting["block_copy"] ?>";
    var isMobile = "<?= $deviceType == 'phone' ? 'true' : 'false' ?>";
    var time_popup = "<?= $row_setting['time_popup'] ?>";
    var time_slider = "<?= !empty($time_slider) ? $time_slider : 5000 ?>";
    var flashsale_web_end = "<?= (!empty($flash_sale) && $config['cart']['flash_sale'] === true) ? date('Y-m-d H:i:s', $flash_sale['time_end']) : 0 ?>";
    <?php
    $array_js_developer =  $func->getNameFileinFolder(_assets . 'js/developer');
    $array_js_functions =  $func->getNameFileinFolder(_assets . 'js/functions');

    ?>
    var array_js_developer = "<?= (!empty($array_js_developer)) ? implode(",", array_column($array_js_developer, 'name')) : ""; ?>";
    var array_js_functions = "<?= (!empty($array_js_functions)) ? implode(",", array_column($array_js_functions, 'name')) : ""; ?>";
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
// defaul
$js->setJs("assets/js/lazyload.min.js");
$js->setJs("assets/plugins/PNotify/PNotify.js");
$js->setJs("assets/plugins/jssocials/jssocials.js");
$js->setJs("assets/plugins/jquery-confirm/jquery-confirm.js");
$js->setJs("assets/plugins/swiper/swiper-bundle.js");
$js->setJs("assets/js/lang/$lang.js");
$js->setJs("assets/js/scrollAnimation.js");
$js->setJs("assets/plugins/toc/toc.js");
$js->setJs("assets/plugins/Fancybox/Fancybox.js");
$js->setJs("assets/plugins/owlcarousel/owl.carousel.min.js");
$js->setJs("assets/js/functions.js");
$js->setJs("assets/js/index.js");
$js->setJs("assets/js/carts.js");
// có thể chỉnh sửa
$js->setJs("assets/plugins/aos/aos.js");
$js->setJs("assets/plugins/flatpickr/flatpickr.min.js");
$js->setJs("assets/plugins/flatpickr/vn.js");
$js->setJs('assets/plugins/wow/wow.min.js');
$js->setJs("assets/plugins/jquery-ui/jquery-ui.js");
$js->setJs("assets/plugins/Custom/btnNoneBlockPlugin.js");
$js->setJs("assets/plugins/Custom/formatInputPlugin.js");
$js->setJs("assets/plugins/Custom/dynamicUrlBuilder.js");
$js->setJs("assets/plugins/Custom/showHideContents.js");
$js->setJs("assets/plugins/Custom/captchaGenerator.js");

$js->setJs("assets/js/social-login.js");

echo $js->getJs();
?>
<!-- Js Addons -->

<?= $addons->set('script-main', 'script-main', 1); ?>
<?= $addons->get(); ?>

<script type="text/javascript" src="./assets/plugins/flowbite/dist/flowbite.min.js"></script>

<script>
    $("#shareButtonLabel").jsSocials({
        url: '<?= $func->getCurrentPageURL() ?>',
        text: '',
        showCount: false,
        shareIn: "blank",
        showLabel: false,
        shares: [{
                share: "email",
                shareUrl: "mailto:<?= $row_setting['email'] ?>",
            },
            {
                share: "twitter",
            },
            {
                share: "facebook",
            },
            {
                share: "telegram",
                shareUrl: "https://telegram.me/share/url?url=<?= $func->getCurrentPageURL() ?>",
            },
        ],
    });
</script>
<script>
    $(document).ready(function() {

        var totalitems = $(".form-sequence").children('.items-sequence').length;
        var currentIndex = 1;

        function updateSequence() {
            setTimeout(function() {
                $(".form-sequence").children('.items-sequence').removeClass('on');
                $(".form-sequence").children('.items-sequence:nth-child(' + currentIndex + ')').addClass('on');

                if (currentIndex === totalitems) {
                    currentIndex = 1;
                } else {
                    currentIndex++;
                }

                updateSequence();
            }, 3000);
        };
        updateSequence();

    });
</script>

<script>
    $(document).ready(function() {
        setTimeout(function() {
            $("body").removeClass("body_load");
        }, 100)
    });
</script>