<?php

// setting
$row_setting = $cache->getCache("select * from #_setting limit 0,1");
$optionsSetting = json_decode($row_setting['options'], true);
$classEmail = new email($db, $config, $row_setting);

// value
$page_index = ($deviceType == 'phone') ? 20 : 20;
$time_slider = $row_setting["time_slider"];
$time_animation_wow = 1.5;

// value data
$bct = $cache->getCache("select photo,link,hienthi from #_bannerqc where hienthi=1 and type=? limit 0,1", array('bocongthuong'), 'fetch', _TIMECACHE);

$dmca = $cache->getCache("select photo,link,hienthi from #_bannerqc where hienthi=1 and type=? limit 0,1", array('dmca'), 'fetch', _TIMECACHE);

$logo = $cache->getCache("select photo from #_bannerqc where hienthi=1 and type=? limit 0,1", array('logo'), 'fetch', _TIMECACHE);

$logo_footer = $cache->getCache("select photo from #_bannerqc where hienthi=1 and type=? limit 0,1", array('logo_footer'), 'fetch', _TIMECACHE);

$seoPage = $cache->getCache("select photo,options from #_bannerqc where hienthi=1 and type=? limit 0,1", array('hinhdaidien'), 'fetch', _TIMECACHE);

$socical = $cache->getCache("select id,photo as photo,ten_$lang as ten,mota_$lang as mota,link from #_photo where hienthi=1 and type=?", array('mangxahoi'), 'result', _TIMECACHE);

$chinhsach = $cache->getCache("select type,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau from #_baiviet where type=? and hienthi=1 order by stt asc,id desc", array('chinh-sach'), 'result', _TIMECACHE);

$hotro = $cache->getCache("select type,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau from #_baiviet where type=? and hienthi=1 order by stt asc,id desc", array('ho-tro-khach-hang'), 'result', _TIMECACHE);

$banner_tpl = $cache->getCache("select ten_$lang as ten,slogan_$lang as slogan,photo,type from #_bannerqc where hienthi=1 and type=? limit 1", array("banner_$com"), 'fetch', _TIMECACHE);
