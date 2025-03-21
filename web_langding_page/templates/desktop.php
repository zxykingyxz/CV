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

    <?php $sample->getTemplate(_layouts . "assets/css", [
        'css' => $css
    ]) ?>
    <script type="text/javascript" src="./assets/js/jquery.min.js"></script>
</head>

<body id="body_main" itemscope itemtype="https://schema.org/WebPage" class="bg-[#F7F3F3] <?= ($config['layouts']['load_all']) ? 'body_load' : '' ?> ">
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
    <div id="wrapper" class="relative ">
        <?php if (($deviceType  == 'computer' || $config['website']['debug-responsive'] == false)) { ?>
            <?php
            include_once _layouts . "pc/header.php";
            ?>
        <?php } else { ?>
            <?php $sample->getTemplate(_layouts . "mobile/top", [
                'logo' => $logo,
            ]) ?>
            <?php $sample->getTemplate(_layouts . "mobile/menu_ds2", [
                'authArrs' => $authArrs,
                'logo' => $logo,
                'notShowMenu' => $notShowMenu,
            ]) ?>
        <?php } ?>

        <?php if ($source == 'index') { ?>
            <?php $sample->getTemplate(_layouts . "slider", [
                'time_slider' => $time_slider,
            ])  ?>
            <?php $sample->getTemplate(_layouts . "main", [
                'seo' => $seo,
                'time_slider' => $time_slider,
                'flash_sale' => $flash_sale,
                'time_animation_wow' => $time_animation_wow,
            ]) ?>
        <?php } ?>
        <?php
        $sample->getTemplate(_layouts . "footer", [
            'chinhsach' => $chinhsach,
            'hotro' => $hotro,
            'socical' => $socical,
            'bct' => $bct,
            'dmca' => $dmca,
            'template' => $template,
            'time_animation_wow' => $time_animation_wow,
        ]) ?>
        <?php $sample->getTemplate(_layouts . "sectionCall", [
            'template' => $template,
            'row_tacgia' => (!empty($row_tacgia)) ? $row_tacgia : '',
        ]) ?>
        <div class="scroll-indicator "></div>
    </div>
    <?php include_once _layouts . "assets/js.php"; ?>
</body>

</html>