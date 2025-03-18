<?php
include_once _lib . 'autoload.php';
new autoload();
$injection = new AntiSQLInjection();
$db = new PDODb($config['database']);
$sample = new ReWorkedTemplate();
$func = new functions($db);
$addons = new AddonsOnline();
$cart = new cartFrontEnd($db);
$detect = new MobileDetect;
$router = new AltoRouter();
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
$breadcrumbs = new breadCrumbs($db, $func);
$json_schema = new jsonSchema($db, $func);
$flash = new flash();
$validate = new Validator($func);
$cache = new FileCache($db);
$apiPlace = new place($db, $func);
$seo = new seos($db);
$css = new CssMinify($config['website']['debug-css'], $func);
$js = new JsMinify($config['website']['debug-js'], $func);

// giỏ hàng
if ($config['cart']['turn_on']) {
    $cart->getCartCookie();
    $cart->updateCartCookie();
    // flash sale
    $flash_sale = [];
    if ($config['cart']['flash_sale'] == true) {
        $current_time = time();
        $flash_sale = $cache->getCache("select id,id_product, time_start, time_end from #_flashsale where hienthi=1 and time_start<={$current_time} and time_end>={$current_time} limit 1", array(), 'fetch', _TIMECACHE);
        if (!empty($flash_sale['id_product'])) {
            $where_no_sale = " and id not in (" . $flash_sale['id_product'] . ") ";
            $where_sale = " and id in (" . $flash_sale['id_product'] . ") ";
        } else {
            $where_no_sale = "";
            $where_sale = "";
        }
    }
}

// sản phẩm đã xem
if (empty($_SESSION['product_viewed']) && $config['function']['product_viewed'] ==  true) {
    $_SESSION['product_viewed'] = $func->json_decode($func->_getCookie('_product_viewed_'));
}

// sản phẩm đã like
if (empty($_SESSION['product_liked']) && $config['function']['product_liked'] ==  true) {
    $_SESSION['product_liked'] = $func->json_decode($func->_getCookie('_product_liked_'));
}

// thông tin tài khoản
if ($config['account']['action']) {
    if (isset($_SESSION[$loginMember]['id']) && !empty($_SESSION[$loginMember]['id'])) {
        $account_info = $cache->getCache("select * from #_customers where hienthi=1 and id=?", [$_SESSION[$loginMember]['id']], 'fetch', _TIMECACHE);
    } else {
        $account_info = [];
    }
}

$jv0 = 'javascript:void(0)';
