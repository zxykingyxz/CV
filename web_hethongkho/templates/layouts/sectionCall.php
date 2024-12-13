<?php
// $hotline = $cache->getCache("select ten_$lang as ten,phone from #_map where hienthi=1 and type=? order by stt asc", array('hotline'), 'result', _TIMECACHE);

$tool = $cache->getCache("select photo,ten_$lang as ten,link from #_photo where hienthi=1 and type=? order by stt asc", array('tool'), 'result', _TIMECACHE);

?>
<?php if ((($config['cart']['turn_on'] != false) || !empty($tool))) { ?>
    <div class="z-40 right-2 rounded-md shadow-md border border-gray-200 top-1/2 -translate-y-1/2 w-auto fixed hidden lg:block ">
        <ul class=" bg-white py-2 px-2 rounded-md inline-flex gap-2 flex-col ">
            <?php if ($config['cart']['turn_on'] != false) { ?>
                <li class="relative last:mb-0 group rounded-[4px] border border-gray-200 h-[36px] aspect-[1/1]  transition-all duration-500 flex flex-col  items-center justify-center">
                    <a href="<?= $func->getType('carts') . '?src=gio-hang' ?>" title="Giỏ hàng" class="relative block ">
                        <svg xmlns="http://www.w3.org/2000/svg" id="Capa_1" enable-background="new 0 0 512.003 512.003" height="32" viewBox="0 0 512.003 512.003" width="32">
                            <g>
                                <path d="m86.1 91.002 17.017 15 14.206-15-14.033-49.117c-1.846-6.445-7.734-10.884-14.429-10.884h-73.861c-8.291 0-15 6.709-15 15s6.709 15 15 15h62.553z" fill="#d5e8fe" />
                                <path d="m376 481.002c-24.814 0-45-20.186-45-45s20.186-45 45-45 45 20.186 45 45-20.186 45-45 45z" fill="#29376d" />
                                <path d="m226 481.002c-24.814 0-45-20.186-45-45s20.186-45 45-45 45 20.186 45 45-20.186 45-45 45z" fill="#47568c" />
                                <path d="m226 421.002c-8.276 0-15 6.724-15 15s6.724 15 15 15 15-6.724 15-15-6.724-15-15-15z" fill="#edf5ff" />
                                <path d="m376 421.002c-8.276 0-15 6.724-15 15s6.724 15 15 15 15-6.724 15-15-6.724-15-15-15z" fill="#d5e8fe" />
                                <path d="m436 361.002h-135-116.455c-11.162 0-18.406-11.755-13.418-21.709l8.291-16.582c3.706-7.412.703-16.421-6.709-20.127-7.397-3.662-16.421-.688-20.127 6.709l-8.291 16.582c-14.94 29.846 6.714 65.127 40.254 65.127h116.455 135c8.291 0 15-6.709 15-15s-6.709-15-15-15z" fill="#d5e8fe" />
                                <path d="m451 376.002c0-8.291-6.709-15-15-15h-135v30h135c8.291 0 15-6.709 15-15z" fill="#b5dbff" />
                                <path d="m508.982 96.963c-2.842-3.75-7.28-5.962-11.982-5.962h-196-214.9l65.471 229.116c1.84 6.442 7.729 10.884 14.429 10.884h135 135c6.7 0 12.589-4.442 14.429-10.884l61-210c1.289-4.526.381-9.389-2.447-13.154z" fill="#6aa9ff" />
                                <path d="m450.429 320.118 61-210c1.289-4.526.381-9.39-2.446-13.154-2.842-3.75-7.28-5.962-11.982-5.962h-196.001v240h135c6.7 0 12.589-4.443 14.429-10.884z" fill="#4895ff" />
                            </g>
                        </svg>
                        <div class="pt-[2px] view-cart absolute inline-flex items-center justify-center bg-red-500 top-[0%] right-[0%] w-[16px] aspect-[1/1] translate-x-[25%] translate-y-[-25%] rounded-full bg-main text-white text-xs">
                            <span>
                                <?= $cart->getTotalQuality() ?>
                            </span>
                        </div>
                    </a>
                </li>
            <?php } ?>
            <?php if (!empty($tool)) { ?>
                <?php foreach ($tool as $k => $v) { ?>
                    <li class=" last:mb-0 group rounded-[4px]  transition-all duration-500 flex flex-col  items-center justify-center">
                        <?= $func->addHrefImg([
                            'classfix' => 'overflow-hidden inline-flex justify-center items-end h-[36px] aspect-[1/1] shadow border border-gray-200 p-[3px] rounded-[4px] bg-white hover:bg-[var(--html-bg-website)] transition-all duration-300',
                            'class' => '',
                            'addhref' => true,
                            'create_thumbs' => false,
                            'href' => (!empty($v["link"])) ? $v["link"] : $jv0,
                            'target' => (!empty($v["link"])) ? '_blank' : '',
                            'sizes' => '100x100x2',
                            'upload' => _upload_hinhanh_l,
                            'image' => ($v["photo"]),
                            'alt' => (isset($v["ten_$lang"])) ? $v["ten_$lang"] : $v["ten"],
                        ]); ?>
                    </li>
                <?php } ?>
            <?php } ?>
        </ul>
    </div>
<?php } ?>

<?php if (($template != 'products/product_detail')) { ?>
    <div class="sticky bottom-0 py-1 bg-[var(--html-bg-website)] text-white text-xs sm:text-sm w-full z-40 shadow shadow-[var(--html-bg-website)]  block lg:hidden">
        <ul class="flex content-end items-end">
            <li class="flex-1">
                <a id="goidien" class="flex justify-center items-center flex-col " title="Điện thoại" aria-label="Điện thoại" href="tel:<?= str_replace(' ', '', str_replace('.', '', $row_setting["dienthoai"])) ?> ">
                    <div>
                        <img width="35" height="28" src="assets/images/tool/icon-phone2.png" class=" brightness-0 invert lazy" loading="lazy" alt="Icon phone">
                    </div>
                    <span class="mt-[4px]">
                        <?= _dienthoai ?>
                    </span>
                </a>
            </li>
            <li class="flex-1">
                <a id="chatzalo" class="flex justify-center items-center flex-col " title="Chat zalo" aria-label="Chat zalo" href="https://zalo.me/<?= str_replace(' ', '', str_replace('.', '', $row_setting["sozalo"])) ?>">
                    <div>
                        <img width="35" height="28" class="brightness-0 invert lazy" loading="lazy" src="assets/images/tool/icon-zalo2.png" alt="Icon zalo">
                    </div>
                    <span class="mt-[4px]">Chat zalo
                    </span>
                </a>
            </li>
            <?php if ($config['cart']['turn_on'] == false) { ?>
                <li class="flex-1">
                    <a id="nhantin" class="flex justify-center items-center flex-col " title="Nhắn tin" aria-label="Nhắn tin" href="sms:<?= str_replace(' ', '', str_replace('.', '', $row_setting["hotline"])) ?>">
                        <div>
                            <img width="35" height="28" class="brightness-0 invert lazy" loading="lazy" src="assets/images/tool/icon-sms2.png" alt="Icon chat">
                        </div>
                        <span class="mt-[4px]">Nhắn tin</span>
                    </a>
                </li>
            <?php } ?>

            <li class="flex-1">
                <a id="chatfb" class="flex justify-center items-center flex-col " href="https://m.me/<?= $row_setting["linkmessage"] ?>" title="Facebook" aria-label="Facebook">
                    <div>
                        <img width="35" height="28" class="brightness-0 invert lazy" loading="lazy" src="assets/images/tool/icon-mesenger2.png" alt="Icon message">
                    </div>
                    <span class="mt-[4px]">Facebook</span>
                </a>
            </li>
            <li class="flex-1">
                <a id="map" class="flex justify-center items-center flex-col " href="<?= $row_setting["iframe_map1"] ?>" title="Chỉ đường" aria-label="Chỉ đường">
                    <div class="text-lg">
                        <i class="fa-thin fa-map-location-dot"></i>
                    </div>
                    <span><?= _chiduong ?></span>
                </a>
            </li>
            <?php if ($config['cart']['turn_on'] == true) { ?>
                <li class="flex-1">
                    <a id="icon__cart" href="<?= $func->getType('carts') . '?src=thanh-toan' ?>" title="Giỏ hàng" aria-label="Giỏ hàng" class="mt-[11px] relative flex flex-col items-center">
                        <div class="relative">
                            <img width="25" height="22" class="brightness-0 invert lazy" loading="lazy" src="assets/images/tool/cart.png" style="width:25px;" alt="Icon cart">
                            <span class="top-[-2px] right-[-10px] view-cart absolute flex items-center justify-center rounded-full bg-red-500 h-5 aspect-[1/1] text-xs text-white">
                                <span class="pt-[1px]">
                                    <?= $cart->getTotalQuality() ?>
                                </span>
                            </span>
                        </div>
                        <span class="mt-[4px] inline-block"><?= _giohang ?></span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>

<?php if (!empty($hotline)) { ?>
    <div class="hotline-right hidden-xs show js-active cs-pointer d-none-m d-none-tablet" data-target="#support-content">
        <i class="fab fa-whatsapp fab-hothotline1"></i>
        <p style="font-family:var(--monts-light),Arial, Helvetica, sans-serif;">Hotline</p>
        <div class="support-content" id="support-content">
            <ul class="hotline-group">
                <?php foreach ($hotline as $key => $value) { ?>
                    <li>
                        <p><?= $value['ten'] ?></p>
                        <p class="line"><a href="tel:<?= str_replace('.', '', str_replace(' ', '', $value['phone'])) ?>"><?= $value['phone'] ?></a></p>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
<?php } ?>