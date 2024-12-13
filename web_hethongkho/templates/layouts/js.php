<script type="text/javascript">
    var _FRAMEWORK = _FRAMEWORK || {};
    var _ROOT = "<?= ($config['lang_check']) ? $https_config . $lang . '/' : $https_config ?>";
    var _URL = "<?= $func->getCurrentPageURL() ?>";
    var _LANG = <?= $config['lang_check'] ? 'true' : 'false' ?>;
    var _TOC = "<?= $rowc['data']['toc'] ?>";
    var _PID = "<?= (!empty($row_detail['id'])) ? $row_detail['id'] : '' ?>";
    var _LIST_TOC = <?= (!empty($row_toc)) ? $row_toc : 0 ?>;
    var _KEYWORD = "<?= (!empty($_GET["keywords"])) ? $_GET["keywords"] : 0 ?>";
    var _PLACEHOLDER = ["Nhập Sản Phẩm Bạn Cần Tìm...."];
    var PAGE_INDEX = "<?= $func->getPagingByComFor('index') ?>";
    var NAME_COMPANY = "<?= $row_setting["name_$lang"] ?>";
    var nonecopy = " <?= $row_setting["block_copy"] ?>";
    var isMobile = "<?= $deviceType == 'phone' ? 'true' : 'false' ?>";
    var time_popup = "<?= $row_setting['time_popup'] ?>";
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
$js->setJs('assets/plugins/wow/wow.min.js');
$js->setJs("assets/js/lazyload.min.js");
$js->setJs("assets/js/jssor.slider-25.2.0.min.js");
$js->setJs("assets/js/jssor_1_slider_init.js");
$js->setJs("./assets/plugins/sweetalert2/sweetalert2.min.js");
$js->setJs("./assets/plugins/PNotify/PNotify.js");
$js->setJs("./assets/plugins/jssocials/jssocials.js");
$js->setJs("./assets/plugins/aos/aos.js");
$js->setJs("assets/js/functions.js");
$js->setJs("./assets/plugins/CustomPlugin/btnNoneBlockPlugin.js");
$js->setJs("assets/js/lang/$lang.js");
$js->setJs("assets/js/scrollAnimation.js");
$js->setJs("./assets/plugins/owlcarousel/owl.carousel.min.js");
$js->setJs("assets/js/index.js");
$js->setJs("assets/js/carts.js");
$js->setJs("assets/js/social-login.js");

echo $js->getJs();
?>
<!-- Js Addons -->

<?= $addons->set('script-main', 'script-main', 1); ?>
<?= $addons->get(); ?>
<script type="text/javascript" src="./i-web/plugin/moment/moment.js"></script>
<script type="text/javascript" src="./assets/plugins/daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="./assets/plugins/daterangepicker/daterangepicker.active.js"></script>
<script type="text/javascript" src="./assets/plugins/flowbite/dist/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".mySwiper", {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
    });
    var swiper2 = new Swiper(".mySwiper2", {
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        thumbs: {
            swiper: swiper,
        },
    });
</script>
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