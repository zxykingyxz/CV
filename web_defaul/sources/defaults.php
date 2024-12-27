<?php

// setting
$row_setting = $cache->getCache("select * from #_setting limit 0,1");
$optionsSetting = json_decode($row_setting['options'], true);

$cart->updateCartCookie();

if (empty($_SESSION['product_viewed'])) {
	$_SESSION['product_viewed'] = $func->json_decode($func->_getCookie('_product_viewed_'));
}
// thông tin tài khoản
if ($config['account']['action']) {
	if (isset($_SESSION[$loginMember]['id']) && !empty($_SESSION[$loginMember]['id'])) {
		$account_info = $cache->getCache("select * from #_customers where hienthi=1 and id=?", [$_SESSION[$loginMember]['id']], 'fetch', _TIMECACHE);
	} else {
		$account_info = [];
	}
}

// email
$classEmail = new email($db, $config, $row_setting);

// value
$jv0 = 'javascript:void(0)';
$page_index = ($deviceType == 'phone') ? 20 : 20;
$time_slider = $row_setting["time_slider"];
$time_animation_wow = 1.2;

// value data
$bct = $cache->getCache("select photo,link,hienthi from #_bannerqc where hienthi=1 and type=? limit 0,1", array('bocongthuong'), 'fetch', _TIMECACHE);

$dmca = $cache->getCache("select photo,link,hienthi from #_bannerqc where hienthi=1 and type=? limit 0,1", array('dmca'), 'fetch', _TIMECACHE);

$logo = $cache->getCache("select photo , width_img,height_img from #_bannerqc where hienthi=1 and type=? limit 0,1", array('logo'), 'fetch', _TIMECACHE);

$seoPage = $cache->getCache("select photo,options , width_img,height_img from #_bannerqc where hienthi=1 and type=? limit 0,1", array('hinhdaidien'), 'fetch', _TIMECACHE);

$socical = $cache->getCache("select id,photo as photo,ten_$lang as ten,mota_$lang as mota,link from #_photo where hienthi=1 and type=?", array('mangxahoi'), 'result', _TIMECACHE);

$chinhsach = $cache->getCache("select type,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau from #_baiviet where type=? and hienthi=1 order by stt asc,id desc", array('chinh-sach'), 'result', _TIMECACHE);

$hotro = $cache->getCache("select type,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau from #_baiviet where type=? and hienthi=1 order by stt asc,id desc", array('ho-tro-khach-hang'), 'result', _TIMECACHE);

$banner_tpl = $cache->getCache("select ten_$lang as ten,text_$lang as text,slogan_$lang as slogan,photo,type from #_bannerqc where hienthi=1 and type=? limit 1", array("banner_$com"), 'fetch', _TIMECACHE);

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
