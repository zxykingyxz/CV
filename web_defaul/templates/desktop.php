<!DOCTYPE html>
<html lang="<?= $lang ?>" itemscope itemtype="http://schema.org/WebSite">


<head>
    <?php $sample->getTemplate(_source . "meta", [
        'seo' => $seo,
        'row_cano' => (!empty($row_cano)) ? $row_cano : '',
        'source' => $source,
        'row_detail' => (!empty($row_detail)) ? $row_detail : '',
    ]) ?>
    <?= $json_schema->SearchAction() . $json_schema->Organization() . $json_schema->Person() . $json_schema->Library() . ($json_code ?? '') ?>

    <?php $sample->getTemplate(_layouts . "css", [
        'css' => $css
    ]) ?>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <script type="text/javascript" src="./assets/js/all.js"></script>
</head>

<body id="body_main" itemscope itemtype="https://schema.org/WebPage" class="bg-gray-100 <?= ($config['layouts']['load_all']) ? 'body_load' : '' ?> ">
    <?php if (in_array($com, ['index', " ", "lien-he", "contact"])) { ?>
        <div class="title_seo hidden">
            <h1>
                <span>
                    <?= !empty($seo->getSeo('h1')) ? $seo->getSeo('h1') : $title_seo; ?>
                </span>
            </h1>
        </div>
    <?php } ?>
    <?php if (!$func->isGoogleSpeed()) { ?>
        <?= $row_setting["code_body"] ?>
    <?php } ?>
    <?php $sample->getTemplate(_layouts . "seo", ['com' => $com, 'seo' => $seo]) ?>
    <div id="wrapper" class="relative ">
        <?php if (($deviceType  == 'computer' || $config['website']['debug-responsive'] == false)) { ?>
            <?php
            include_once _layouts . "pc/header.php";
            ?>
        <?php } else { ?>
            <?php $sample->getTemplate(_layouts . "mobile/top", [
                'logo' => $logo,
                'bg_top' => $bg_top,
            ]) ?>
            <?php $sample->getTemplate(_layouts . "mobile/menu_ds2", [
                'authArrs' => $authArrs,
                'bg_top' => $bg_top,
                'logo' => $logo,
                'notShowMenu' => $notShowMenu,
            ]) ?>
        <?php } ?>

        <?php if ($source == 'index') { ?>
            <?php $sample->getTemplate(_layouts . "slider", [
                'time_slider' => $time_slider,
            ])  ?>
            <?php $sample->getTemplate(_layouts . "main", [
                'deviceType' => $deviceType,
                'seo' => $seo,
                'time_slider' => $time_slider,
                'about' => $about,
                'jv0' => $jv0,
                'flash_sale' => $flash_sale,
            ]) ?>
        <?php } ?>
        <?php if ($source != 'index' && !in_array($com, ['account']) && !in_array($template, ['error/404'])) {
            $sample->getTemplate(_layouts . "breads", [
                'str_breadcrumbs' => $str_breadcrumbs,
                'banner_tpl' => $banner_tpl,
                'titleContainer' => $titleContainer,
            ], false);
        } ?>
        <?php
        if (!file_exists(_template . $template . "_tpl.php")) {
            $template = "error/404";
        }
        include _template . $template . "_tpl.php";
        ?>
        <?php
        $sample->getTemplate(_layouts . "footer", [
            'deviceType' => $deviceType,
            'chinhsach' => $chinhsach,
            'hotro' => $hotro,
            'socical' => $socical,
            'row_setting' => $row_setting,
            'jv0' => $jv0,
            'com' => $com,
            'bct' => $bct,
            'dmca' => $dmca,
            'source' => $source,
            'template' => $template,
            'time_animation_wow' => $time_animation_wow,
        ]) ?>
        <?php $sample->getTemplate(_layouts . "sectionCall", [
            'template' => $template,
            'row_tacgia' => (!empty($row_tacgia)) ? $row_tacgia : '',
            'cart' => $cart
        ]) ?>
        <div class="scroll-indicator "></div>
    </div>
    <?= $func->getTemplateLayoutsFor([
        'name_layouts' => 'searchBlock',
    ]) ?>
    <?= $func->getTemplateLayoutsFor([
        'name_layouts' => 'searchOrder',
    ]) ?>
    <?php $sample->getTemplate(_layouts . "zoomImage") ?>

    <?php if (!empty($flash_sale) && $config['cart']['flash_sale'] === true) { ?>
        <input type="hidden" name="flash_web" value="<?= date('Y-m-d H:i:s', $flash_sale['time_end']) ?>">
    <?php } ?>
    <?php
    $array_js_developer =  $func->getNameFileinFolder(_assets . 'js/developer');
    if (!empty($array_js_developer)) {
    ?>
        <input type="hidden" name="array_js_developer" value="<?= implode(",", array_column($array_js_developer, 'name')) ?>">
    <?php } ?>
    <?php
    include_once _layouts . "js.php";
    ?>
</body>

</html>