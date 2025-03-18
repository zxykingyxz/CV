<?php

session_start();
defined('_root') ?:  define('_root', __DIR__);
defined('_ds') ?:  define('_ds', DIRECTORY_SEPARATOR);
defined('_lib') ?:  define('_lib', '..' . _ds . 'libraries' . _ds);
defined('_source') ?:  define('_source', _root . _ds . 'sources' . _ds);
defined('_lang') ?:  define('_lang', '..' . _ds . 'sources' . _ds);
defined('_template') ?:  define('_template', _root . _ds . 'templates' . _ds);
defined('_thumbs') ?:  define('_thumbs', '../thumbs');
defined('_watermark') ?:  define('_watermark', '../watermark');

$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;

$lang = $_SESSION['lang_admin'] = (!isset($_SESSION['lang_admin']) || $_SESSION['lang_admin'] == '') ? 'vi' : $_SESSION['lang_admin'];

$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : "";
$com = (isset($_GET['com'])) ? htmlspecialchars($_GET['com']) : "";
$src = (isset($_GET['src'])) ? htmlspecialchars($_GET['src']) : "";
$act = (isset($_GET['act'])) ? htmlspecialchars($_GET['act']) : "";
$type = (isset($_GET['type'])) ? htmlspecialchars($_GET['type']) : "";
$tbl = (isset($_GET['tbl']) && !empty($_GET['tbl'])) ? '_' . htmlspecialchars($_GET['tbl']) : "";

$url_path = $tbl;
$url_path .= (isset($_GET['tbl']) && !empty($_GET['tbl'])) ? '&tbl=' . htmlspecialchars($_GET['tbl']) . '' : '';
$url_path .= (isset($_GET['id_list'])) ? '&id_list=' . htmlspecialchars($_GET['id_list']) . '' : '';
$url_path .= (isset($_GET['id_cat'])) ? '&id_cat=' . htmlspecialchars($_GET['id_cat']) . '' : '';
$url_path .= (isset($_GET['id_item'])) ? '&id_item=' . htmlspecialchars($_GET['id_item']) . '' : '';
$url_path .= (isset($_GET['id_sub'])) ? '&id_sub=' . htmlspecialchars($_GET['id_sub']) . '' : '';
$url_path .= (isset($_GET['id'])) ? '&id=' . htmlspecialchars($_GET['id']) . '' : '';
$url_path .= (isset($_GET['id_product'])) ? '&id_product=' . htmlspecialchars($_GET['id_product']) . '' : '';
$url_path .= (isset($_GET['id_flash'])) ? '&id_flash=' . htmlspecialchars($_GET['id_flash']) . '' : '';
$url_path .= (isset($_GET['keyword'])) ? '&keyword=' . htmlspecialchars($_GET['keyword']) . '' : '';
$url_path .= (isset($_GET['type'])) ? '&type=' . htmlspecialchars($_GET['type']) . '' : '';
$url_path .= (isset($_GET['act_baiviet'])) ? '&act_baiviet=' . htmlspecialchars($_GET['act_baiviet']) . '' : '';
$url_path .= (isset($_GET['page'])) ? '&page=' . htmlspecialchars($_GET['page']) . '' : '';
$url_path .= (isset($_GET['page_baiviet'])) ? '&page_baiviet=' . htmlspecialchars($_GET['page_baiviet']) . '' : '';

$login_name = 'IWEBCO';

include_once _lib . "config.php";
include_once _lib . "setting.php";
include_once _lang . "langWeb/lang_$lang.php";
require_once _lib . 'autoload.php';

new autoload();
require_once _lib . 'PHPExcel/PHPExcel.php';
$db = new PDODb($config['database']);
$func = new functions($db);
$logs = new writeLog(_upload_logs);
$apiProduct = new product($db, $func, $com, $com . $tbl, $com . '_photo');
$apiComment = new comment($db, $func, $com);
$apiPhotos = new photos($db, $func, $com, $com . $tbl, $com . '_photo');
$apiPage = new page($db, $func, $com, 'baiviet_photo');
$apiSetting = new settings($db, $func, $com);
$apiSearchs = new searchs($db, $func, $com);
$apiUser = new userAdmin($db, $func, $com);
$apiPhoto = new photo($db, $func, $com);
$apiCart = new cartAdmin($db, $func, $com);
$apiPlace = new place($db, $func);
$apiSeopage = new seopages($db, $func, $com);
$cache = new FileCache($db);
$seo = new seos($db);

$func->checkTwoAccess();
$logo = $db->rawQueryOne("select photo from #_bannerqc where hienthi=1 and type=? limit 0,1", array('logo'));
$row_setting = $db->rawQueryOne("select * from #_setting limit 0,1");
$language = $db->rawQuery("select * from #_lang");

foreach ($language as $k => $v) {
    $ngonngu[$v['item']] = $v["lang_$lang"];
}

$_SESSION['SCRIPT_FILENAME'] = $https_config;

if ($GLOBAL_PERMISSION == true && isset($_SESSION[$login_name])) {
    $kiemtra = 1;
    if (
        $act != 'save' &&
        $act != 'save_list' &&
        $act != 'save_cat' &&
        $act != 'save_list' &&
        $act != 'save_item' &&
        $act != 'save_export' &&
        $act != 'save_import' &&
        $act != 'save_photo' &&
        $act != 'save_export' &&
        $act != 'save_import' &&
        $act != 'save_lang'
    ) {
        if ($com != 'user') {
            if ($com != '' && $com != 'index') {
                if ($type != '')
                    $quyen_user = $com . '_' . $act . '_' . $type;
                else
                    $quyen_user = $com . '_' . $act;
                if ($quyen_user == '_') {
                    $quyen_user == '';
                }
                if (!in_array($quyen_user, $_SESSION['permissions'])) {
                    $response['status'] = 200;
                    $response['message'] = "Bạn không có quyền vào khu vực này !";
                    $message = base64_encode(json_encode($response));
                    $func->redirect("index.html?message=" . $message);
                    exit;
                }
            }
        }
    }
}
/* Delete cache */
$cacheAction = array(
    'save',
    'save_copy',
    'save_list',
    'save_cat',
    'save_item',
    'save_sub',
    'capnhat',
    'delete',
    'delete_list',
    'delete_cat',
    'delete_item',
    'delete_sub'
);
if (isset($_POST) && isset($cacheAction) && count($cacheAction) > 0) {
    if (in_array($act, $cacheAction)) {
        $cache->DeleteCache();
    }
}
switch ($com) {
    case 'map':
        $source = "map";
        break;
    case 'member':
        $source = "thanhvien";
        break;
    case 'attribute':
        $source = "attribute";
        break;
    case 'ngonngu':
        $source = "lang";
        break;
    case 'video':
        $source = "video";
        break;
    case 'contact':
        $source = "contact";
        break;
    case 'booking':
        $source = "booking";
        break;
    case 'comment':
        $source = "comment";
        break;
    case 'newsletter':
        $source = "newsletter";
        break;
    case 'phanquyen':
        $source = "phanquyen";
        break;
    case 'company':
        $source = "company";
        break;
    case 'baiviet':
        $source = "baiviet";
        break;
    case 'combo':
        $source = "combo";
        break;
    case 'order':
        $source = "order";
        break;
    case 'properties':
        $source = "properties";
        break;
    case 'info':
        $source = "info";
        break;
    case 'title':
        $source = "title";
        break;
    case 'permissions':
        $source = "phanquyen";
        break;
    case 'user':
        $source = "user";
        break;
    case 'photo':
        $source = "photo";
        break;
    case 'seopage':
        $source = "seos";
        break;
    case 'cache':
        $source = "cache";
        break;
    case 'setting':
        $source = "setting";
        break;
    case 'redirect':
        $source = "redirect";
        break;
    case 'bannerqc':
        $source = "bannerqc";
        break;
    case 'album':
        $source = "album";
        break;
    case 'tags':
        $source = 'tags';
        break;
    case 'flashsale':
        $source = "flashsale";
        break;
    case 'warehouse':
        $source = "warehouse";
        break;
    default:
        $source = "";
        $template = "index";
        break;
}

if ((!isset($_SESSION[$login_name]) || $_SESSION[$login_name] == false) && $act != "login") {
    $func->redirect("index.html?com=user&act=login");
}
if ($source != "") include _source . $source . ".php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Administrator - Hệ thống quản trị nội dung</title>
    <link href="images/favicon.png" rel="shortcut icon" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/main.css" rel="stylesheet" rel="stylesheet" type="text/css" />
    <link href="css/mobile.css" rel="stylesheet" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/fontAwesome/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="plugin/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css">
    <link href="css/toast.css" type="text/css" rel="stylesheet" />
    <link href="css/admin_output.css" type="text/css" rel="stylesheet" />
    <link href="plugin/metisMenu/metisMenu.min.css" rel="stylesheet" type="text/css">
    <link href="plugin/confirm/jquery-confirm.min.css" rel="stylesheet" type="text/css">
    <link href="js/plugins/multiupload/css/jquery.filer.css" type="text/css" rel="stylesheet" />
    <link href="js/plugins/multiupload/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
    <script>
        var FRAMEWORK = FRAMEWORK || {};
        var ROOT = "<?= $https_config ?>";
        var COM = "<?= $_GET["com"] ?>";
        var ACT = "<?= $_GET["act"] ?>";
        var LANG = "<?= $lang ?>"
    </script>
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="plugin/metisMenu/metisMenu.min.js"></script>
    <script type="text/javascript" src="assets/js/functions.js"></script>

    <script>
        $(function() {
            $('#menu1').metisMenu();
        });
    </script>
</head>
<?php if (isset($_SESSION[$login_name]) && ($_SESSION[$login_name] == true)) { ?>

    <body style="min-height: 100vh;">
        <div class="full_page" <?php if ($com == '') echo 'style="overflow:hidden"'; ?>>
            <div id="leftSide">
                <?php include _template . "left_tpl.php"; ?>
            </div>
            <div id="rightSide">
                <div class="topNav sidebar-bunker">
                    <?php include _template . "header_tpl.php";

                    ?>
                </div>
                <div class="wrapper">

                    <?php include _template . $template . "_tpl.php"; ?>
                </div>
            </div>
            <div class="clear"></div>
            <div class="fixed-themes">
                <span class="click-cog">
                    <i class="typcn typcn-cog"></i>
                </span>
                <ul class="color-themes-page">
                    <li data-color="005c97" class="gradient-1"><span></span></li>
                    <li data-color="fe8c00" class="gradient-2"><span></span></li>
                    <li data-color="f953c6" class="gradient-3"><span></span></li>
                    <li data-color="00b09b" class="gradient-4"><span></span></li>
                    <li data-color="212529" class="default"><span></span></li>
                    <li data-color="128341" class="green"><span></span></li>
                    <li data-color="4F0791" class="violet"><span></span></li>
                    <li data-color="fd7d0c" class="orange"><span></span></li>
                    <li data-color="05498D" class="blue"><span></span></li>
                    <li data-color="015775" class="blue-dark"><span></span></li>
                    <li data-color="4c8c03" class="green-dark"><span></span></li>
                    <li data-color="dc3545" class="red"><span></span></li>
                    <li data-color="16aaff" class="blue-16aaff"><span></span></li>
                    <li data-color="3ac47d" class="green-3ac47d"><span></span></li>
                    <li data-color="23FCBB" class="linear-23FCBB"><span></span></li>
                    <li data-color="00ff2bc2" class="green-00ff2bc2"><span></span></li>
                </ul>
            </div>
        </div>
        <script>
            var class_ = 'theme-default';
            var color_ = '37a000';
        </script>
        <script type="text/javascript" src="js/plugins/multiupload/jquery.filer.min.js"></script>
        <script type="text/javascript" src="js/jquery.ps-color-picker.min.js"></script>
        <script type="text/javascript" src="js/plugins/forms/uniform.js"></script>
        <script type="text/javascript" src="js/jquery.price_format.2.0.js"></script>
        <script type="text/javascript" src="plugin/validator/jquery.form-validator.min.js"></script>
        <script type="text/javascript" src="plugin/confirm/jquery-confirm.min.js"></script>
        <script type="text/javascript" src="js/toast.js"></script>
        <script type="text/javascript" src="plugin/moment/moment.js"></script>
        <script type="text/javascript" src="plugin/daterangepicker/daterangepicker.js"></script>
        <script type="text/javascript" src="plugin/daterangepicker/daterangepicker.active.js"></script>
        <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
        <script type="text/javascript" src="js/speakingurl.min.js"></script>
        <script type="text/javascript" src="assets/js/custom.js"></script>
    </body>
<?php } else { ?>

    <body class="nobg loginPage" style="background-color:#2990bb">
        <?php include _template . $template . "_tpl.php"; ?>
        <div id="particles-js"></div>
    </body>
    <script src="js/particles.js"></script>
    <script src="js/app.js"></script>
    <script type="text/javascript" src="js/toast.js"></script>
    <script type="text/javascript" src="assets/js/functions.js"></script>
    <script type="text/javascript" src="assets/js/custom.js"></script>
<?php } ?>
<?php if ($notice_admin != '' && ($source == '' || $act == 'login')) { ?>
    <script type="text/javascript">
        $(function() {
            $.toast({
                heading: 'Thông báo hệ thống',
                text: '<?= $notice_admin ?>',
                position: 'top-right',
                stack: false,
                icon: 'error'
            });
        });
    </script>
<?php } ?>
<?php if (!empty($_GET['message']) && $_GET['message'] != NULL) {
    $notice = json_decode(base64_decode($_GET['message']), true);
    $status = ($notice['status'] == 200) ? 'success' : 'error';
?>
    <script type="text/javascript">
        $(function() {
            $.toast({
                heading: 'Thông báo hệ thống',
                text: '<?= $notice['message'] ?>',
                position: 'top-right',
                stack: false,
                icon: '<?= $status ?>'
            });
        });
    </script>
<?php } ?>

</html>