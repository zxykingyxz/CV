<?php

// Title, Keywords, Description 
$title_meta = (!empty($seo->getSeo('title'))) ? $seo->getSeo('title') : $row_setting["name_$lang"];
$keywords_meta =  $seo->getSeo('keywords');
$description_meta = $seo->getSeo('description');
// <!-- Canonical -->
$link_canonical = (!empty($row_cano)) ? $row_cano : $func->getCurrentPageUrlCano();
// <!-- Viewport -->
$content_viewport_meta = ($config['website']['debug-responsive']) ? "width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=5" : "width=1500";
if (!empty($row_detail["index_robots"])) {
	$robots_meta = $row_detail["index_robots"];
} else {
	$robots_meta = $config['website']['robots'];
}
// <!-- Favicon -->
$favicon_meta = _upload_hinhanh_l . $row_setting['bgtop']
?>
<!-- Basehref -->
<base href="<?= $https_config ?>" />

<!-- UTF-8 -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- Title, Keywords, Description -->
<title><?= $title_meta ?></title>
<meta name="keywords" content="<?= $keywords_meta ?>" />
<meta name="description" content="<?= $description_meta ?>" />
<!-- Canonical -->
<link rel="canonical" href="<?= $link_canonical ?>" />
<!-- Chống đổi màu trên IOS -->
<meta name="format-detection" content="telephone=no">
<!-- Viewport -->
<meta name="viewport" content="<?= $content_viewport_meta ?>" />
<!-- Robots -->

<meta name="robots" content="<?= $robots_meta ?>" />

<!-- Favicon -->
<link href="<?= $favicon_meta ?>" rel="shortcut icon" type="image/x-icon" />

<?php if (count($config['arrayDomainSSL'])) { ?>
	<!-- Security Policy -->
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<?php } ?>
<!-- GEO -->
<meta name="geo.region" content="VN" />
<meta name="geo.position" content="<?= $row_setting['map_marker'] ?>">
<meta name="geo.placename" content="<?= $row_setting["address_$lang"] ?>">
<meta name="ICBM" content="<?= $row_setting['map_marker'] ?>">
<!-- Author - Copyright -->
<meta http-equiv="audience" content="General" />
<meta name="resource-type" content="Document" />
<meta name="distribution" content="Global" />
<meta name='revisit-after' content='1 days' />
<meta name="author" content="<?= $row_setting['name_' . $lang] ?>" />
<meta name="copyright" content="<?= $row_setting['name_' . $lang] . " - [" . $row_setting['email'] . "]" ?>" />

<!-- Facebook -->
<meta property="fb:pages" content="<?= ($row_setting['faceid'] != '') ? $row_setting['faceid'] : $config['facebook-id'] ?>">
<meta property="ia:markup_url" content="<?= $func->getCurrentPageUrlCano() ?>">
<meta property="ia:rules_url" content="<?= $func->getCurrentPageUrlCano() ?>">
<meta property="og:type" content="<?= $seo->getSeo('type') ?>" />
<meta property="og:site_name" content="<?= $row_setting['name_' . $lang] ?>" />
<meta property="og:title" content="<?= $seo->getSeo('title') ?>" />
<meta property="og:description" content="<?= $seo->getSeo('description') ?>" />
<meta property="og:url" content="<?= $seo->getSeo('url') ?>" />
<meta property="og:image" content="<?= $seo->getSeo('photo') ?>" />
<meta property="og:image:alt" content="<?= $seo->getSeo('title') ?>" />
<meta property="og:image:type" content="<?= $seo->getSeo('photo:type') ?>" />
<meta property="og:image:width" content="<?= $seo->getSeo('photo:width') ?>" />
<meta property="og:image:height" content="<?= $seo->getSeo('photo:height') ?>" />

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="<?= $row_setting['email'] ?>" />
<meta name="twitter:creator" content="<?= $row_setting['name_' . $lang] ?>" />
<meta property="fb:app_id" content="<?= ($row_setting['faceid'] != '') ? $row_setting['faceid'] : $config['faceid'] ?>" />
<meta name="dc.language" CONTENT="vietnamese">
<meta name="dc.source" CONTENT="<?= $https_config ?>">
<meta name="dc.title" CONTENT="<?= $seo->getSeo('title') ?>">
<meta name="dc.keywords" CONTENT="<?= $seo->getSeo('keywords') ?>">
<meta name="dc.description" CONTENT="<?= $seo->getSeo('description') ?>">
<!-- Webmaster Tool -->
<?= htmlspecialchars_decode($row_setting['analytics']) ?>
<?= htmlspecialchars_decode($seo->getSeo('schema')) ?>