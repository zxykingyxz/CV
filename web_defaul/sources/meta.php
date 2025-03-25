<!-- Basehref -->
<base href="<?= $https_config ?>" />

<!-- UTF-8 -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- Title, Keywords, Description -->
<title><?= (!empty($seo->getSeo('title'))) ? $seo->getSeo('title') : $row_setting["name_$lang"] ?></title>
<meta name="keywords" content="<?= $seo->getSeo('keywords') ?>" />
<meta name="description" content="<?= $seo->getSeo('description') ?>" />
<!-- Canonical -->
<link rel="canonical" href="<?= (!empty($row_cano)) ? $row_cano : $func->getCurrentPageUrlCano() ?>" />
<!-- Chống đổi màu trên IOS -->
<meta name="format-detection" content="telephone=no">
<!-- Viewport -->
<?php if ($config['website']['debug-responsive']) { ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=5" />
<?php } else { ?>
	<meta name="viewport" content="width=1500" />
<?php } ?>
<!-- Robots -->

<meta name="robots" content="<?php if ($source == 'index' || $source == 'baiviet') {
									echo $config['website']['robots'];
								} else {
									if (!empty($row_detail["index_robots"])) {
										echo $row_detail["index_robots"];
									} else {
										echo $config['website']['robots'];
									}
								} ?>" />

<!-- Favicon -->
<link href="<?= _upload_hinhanh_l . $row_setting['bgtop'] ?>" rel="shortcut icon" type="image/x-icon" />

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