<?php if (!$func->isGoogleSpeed()) { ?>
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
<?php } ?>
<?php
$css->setCache("cached");
if (!$func->isGoogleSpeed()) {
    $css->setCss("assets/css/normalize.css");
}
// defaul
$css->setCss("assets/css/reset.css");
$css->setCss("assets/css/animation.css");
$css->setCss("assets/css/tailwind/output.css");
$css->setCss("assets/plugins/PNotify/PNotify.css");
$css->setCss("assets/plugins/PNotify/BrightTheme.css");
$css->setCss("assets/plugins/Fancybox/Fancybox.css");
$css->setCss("assets/plugins/jquery-confirm/jquery-confirm.css");
$css->setCss("assets/plugins/jssocials/jssocials.css");
$css->setCss("assets/plugins/jssocials/jssocials-theme-flat.css");
$css->setCss("assets/plugins/swiper/swiper-bundle.css");
$css->setCss("assets/plugins/slick/slick.css");
$css->setCss("assets/plugins/slick/slick-theme.css");
$css->setCss("assets/plugins/toc/toc.css");
$css->setCss("assets/plugins/owlcarousel/owl.carousel.min.css");
$css->setCss("assets/plugins/owlcarousel/owl.theme.default.css");
$css->setCss("assets/plugins/Notiflix/notiflix.css");

// có thể chỉnh sửa
$css->setCss("assets/plugins/flatpickr/flatpickr.min.css");
$css->setCss("assets/plugins/aos/aos.css");
$css->setCss("assets/plugins/wow/animate.compat.css");
$css->setCss("assets/css/default.css");
$css->setCss("assets/css/style.css");

echo $css->getCss();

?>

<style>
    <?php if (!$func->isGoogleSpeed()) {
        $file_name = (!empty($optionsSetting['fonts']) ? $optionsSetting['fonts'] : 'Inter');
        $folder_fonts =  "assets/fonts/" . $file_name;
        $file_name_t = strtolower($file_name);
        $font_weights = [
            'thin' => 100,
            'extralight' => 200,
            'light' => 300,
            'regular' => 400,
            'medium' => 500,
            'semibold' => 600,
            'bold' => 700,
            'extrabold' => 800,
            'black' => 900,
        ];
        if (is_dir($folder_fonts) && is_readable($folder_fonts)) {
            $files = scandir($folder_fonts);
            foreach ($files as $file) {
                if (file_exists($folder_fonts . '/' . $file) && !in_array($file, ['.', '..'])) {
                    $file_info = pathinfo($file);
                    $font_variant = strtolower($file_info['filename']);
    ?>@font-face {
        font-family: '<?= $file_info['filename'] ?>';
        src: url('<?= $folder_fonts . '/' . $file ?>') format('truetype');
    }

    <?php
                }
            }
        }

    ?><?php $colorSetting = $optionsSetting['color']; ?> :root {

        --html-all-website: <?= $colorSetting['background-web'] ?>;
        --html-bg-website: <?= $colorSetting['background-primary'] ?>;
        --html-cl-website: <?= $colorSetting['primary-color'] ?>;
        --html-sc-website: <?= $colorSetting['second-color'] ?>;
        --value-top-fixed: 30px;
        --color-star: #ffbf00;
        --color-linear-sc: linear-gradient(90deg, #FFC300 0%, #997500 100%);
        --font-main: var(--font-main-500);
        /* font thường */
        <?php if (is_dir($folder_fonts) && is_readable($folder_fonts)) {
            $files = scandir($folder_fonts);
            foreach ($files as $file) {
                if (file_exists($folder_fonts . '/' . $file) && !in_array($file, ['.', '..'])) {
                    $file_info = pathinfo($file);
                    $font_variant = strtolower($file_info['filename']);
                    $font_variant = str_replace($file_name_t . '-', '', $font_variant);
                    if (!empty($font_weights[$font_variant])) {
                        $font_weight =  $font_weights[$font_variant];
        ?>--font-main-<?= $font_weight ?>: '<?= $file_info['filename'] ?>', sans-serif;
        <?php
                    }
                }
            }
        }
        ?>
    }

    <?php } ?>
</style>