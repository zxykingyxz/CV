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

    <?php $sample->getTemplate(_layouts . "/css", [
        'css' => $css
    ]) ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <script type="text/javascript" src="./assets/js/all.js"></script>
</head>
<div class="title-default relative center mb-8 hidden">

    <h1 class="text-center">
        <span class=" ">
            <?php if ($seo->getSeo('h1') != "") { ?>
                <?= $seo->getSeo('h1') ?>
            <?php } else {
                echo $title_seo;
            } ?>
        </span>
    </h1>

</div>

<body id="body_main" itemscope itemtype="https://schema.org/WebPage" class=" <?= ($config['layouts']['load_all']) ? 'body_load' : '' ?> ">
    <div class="loadApplication">
        <div class="form_in_loadApplication">
            <div class="icons_loadApplication">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="text_loadApplication">
                <span>
                    Đang xử lý ...
                </span>
            </div>
        </div>
    </div>

    <?php if (!$func->isGoogleSpeed()) { ?>
        <?= $row_setting["code_body"] ?>
    <?php } ?>

    <div id="wrapper" class="relative ">
        <?php
        if (empty($account_info) && !in_array($_SRC, ['sign-up', 'login'])) {
            include_once _template . "warehouse/error/not_logged.php";
        } else if (!empty($account_info) && in_array($_SRC, ['sign-up', 'login']) && $_ACT != "result"  && $_SESSION[$sessison_account_warehouse]['viewed_info'] === true) {
            include_once _template . "warehouse/account/log_out.php";
        } else {
            if (!in_array($_SRC, ['sign-up', 'login'])) {
                include_once _template . "warehouse/menu_warehouse.php";
            }
            include_once _template . $template . ".php"; ?>
            <div class="scroll-indicator "></div>
        <?php } ?>
    </div>
    <?php
    $array_js_developer =  $func->getNameFileinFolder(_assets . 'js/developer');
    if (!empty($array_js_developer)) {
    ?>
        <input type="hidden" name="array_js_developer" value="<?= implode(",", array_column($array_js_developer, 'name')) ?>">
    <?php } ?>

    <?php $sample->getTemplate(_template . "/warehouse/js", [
        'row_toc_show' => $rowc['data']['toc'],
        'row_detail' => $row_detail,
        'source' => $source,
        'row_toc' => $row_toc,
        'com' => $com,
        'deviceType' => $deviceType,
        'js' => $js,
        'addons' => $addons
    ], false) ?>
    <?php
    if (!empty($status_load)) {
        echo $warehouse_func->getTemplateLayoutsFor([
            'name_layouts' => 'form_notification_status',
            'status_notification' => $status_load,
        ]);
    }
    ?>
</body>

</html>