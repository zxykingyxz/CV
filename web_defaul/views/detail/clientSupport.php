<?php
$mota_sb = $cache->getCache("select mota_$lang as mota from #_company where type=? and hienthi=1", array('desc_support'), 'fetch',  _TIMECACHE);

?>
<div class="form_clientSupport <?= $class ?>">
    <div class="text-[var(--html-bg-website)] font-bold font-main text-base sm:text-lg lg:text-xl capitalize text-center mt-2">
        <span><?= _hotrokhachhang ?></span>
    </div>
    <div class="text-gray-400 text-xs sm:text-sm capitalize font-main font-medium text-center mt-1">
        <span>
            <?= _yeucaugoilai ?>
        </span>
    </div>
    <div class="content">
        <?= htmlspecialchars_decode($mota_sb['mota']) ?>
    </div>
    <div class=" mt-2">
        <input type="number" autocomplete="off" class="phone_clientSupport_js w-full p-2 h-10 bg-white text-gray-600 placeholder:text-gray-400 rounded text-sm font-main border border-gray-200  " placeholder="<?= _nhapsodienthoai ?>" />
        <span class="error_clientSupport text-[10px] text-red-600"></span>
        <div class="btn_clientSupport_js flex justify-center items-center px-3 h-10 rounded bg-[var(--html-bg-website)] text-white font-main capitalize text-base border-none font-semibold cursor-pointer transition-all duration-300 mt-2 "><?= _lienhevoichungtoi ?></div>
    </div>
    <div class="flex justify-between items-end mt-2">
        <a href="https://zalo.me/<?= str_replace(' ', '', str_replace('.', '', $row_setting["sozalo"])) ?>" target="_blank" title="Chat zalo" rel="nofollow" role="link" class="font-main font-medium text-[var(--html-bg-website)]">Chat zalo</a>
        <a href="tel:<?= str_replace(' ', '', str_replace('.', '', $row_setting["hotline"])) ?>" class="text-base font-main font-bold text-[var(--html-bg-website)]" title="<?= $row_setting["hotline"] ?>" aria-label="<?= $row_setting["hotline"] ?>" role="link" rel="nofollow"><?= $row_setting["hotline"] ?></a>
    </div>
</div>