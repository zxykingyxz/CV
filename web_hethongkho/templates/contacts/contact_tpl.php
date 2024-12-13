<?php
$ha_lienhe = $cache->getCache("select photo from #_bannerqc where hienthi=1 and type=? limit 1", ['ha-lienhe'], 'fetch', _TIMECACHE);
$class_form_input = "px-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-[var(--html-bg-website)] focus:ring-sky-500 block w-full rounded text-sm  focus:ring-1";
?>

<section class=" mt-5 mb-5 ">
    <div class="grid_s wide">
        <div class="bg_form_all ">
            <div class="mb-6">
                <div class="flex flex-wrap gap-3 ">
                    <div class=" w-full md:w-1/2 bg-gray-100 p-3 ">
                        <?= $func->addHrefImg([
                            'sizes' => '570x300x1',
                            'upload' => _upload_hinhanh_l,
                            'image' => $ha_lienhe["photo"],
                            'alt' => 'Hình ảnh liên hệ'
                        ]); ?>
                    </div>
                    <div class="flex-1 ">
                        <div class="contact-page-side-content">
                            <h3 class="text-sm sm:text-base lg:text-xl text-black mb-3 relative font-bold uppercase before:absolute before:border-[var(--html-bg-website)] before:w-[100px] before:-bottom-[1px] before:left-0 before:border-b-[2px]">
                                <span><?= _thongtinlienhe ?></span>
                            </h3>
                            <div class="">
                                <?= htmlspecialchars_decode($row_contact['mota_' . $lang]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap items-start gap-3">
                <div class=" flex-1 ">
                    <div class=" mb-3">
                        <h2 class="text-[20px] text-black relative font-bold uppercase before:absolute before:border-[var(--html-bg-website)] before:w-[100px] before:-bottom-[1px] before:left-0 before:border-b-[2px]">
                            <span><?= _guithudenchungtoi ?></span>
                        </h2>
                    </div>
                    <div class="">
                        <div class="text-red-500 ">
                            <?= $flash->getMessages("frontend") ?>
                        </div>
                        <div class="mt-3">
                            <form action="" method="POST" class="" novalidate enctype="multipart/form-data" autocomplete="off" accept-charset="utf-8">
                                <div class=" flex flex-wrap gap-3">
                                    <div class=" flex-1 flex flex-wrap flex-col gap-3">
                                        <div class="w-full">
                                            <input type="text" required name="dataContact[fullname]" class="<?= $class_form_input ?> py-2" id="customername" value="<?= $flash->get('fullname'); ?>" placeholder="<?= _hoten ?>">
                                        </div>
                                        <div class="w-full">
                                            <input type="email" required name="dataContact[email]" class="<?= $class_form_input ?> py-2" id="customerEmail" value="<?= $flash->get('email'); ?>" placeholder="Email">
                                        </div>
                                        <div class="w-full">
                                            <input type="number" required name="dataContact[phone]" class="<?= $class_form_input ?> py-2" value="<?= $flash->get('phone'); ?>" id="customerPhone" placeholder="<?= _sodienthoai ?>">
                                        </div>
                                        <div class="w-full">
                                            <input type="text" required name="dataContact[address]" class="<?= $class_form_input ?> py-2" value="<?= $flash->get('address'); ?>" id="contactSubject" placeholder="<?= _diachi ?>">
                                        </div>
                                        <div class="w-full">
                                            <div class="flex items-center justify-between gap-2 ">
                                                <div class="flex-cl-1 ">
                                                    <input type="text" class="<?= $class_form_input ?> py-2" id="captcha" required name="dataContact[captcha]" value="" placeholder="Nhập mã captcha">
                                                </div>
                                                <div class="flex items-center result-code">
                                                    <div class="captcha-code text-center w-[70px]"></div>
                                                    <div class="reload-captcha cursor-pointer [&.active]:rotate-90 transition-all duration-300 w-[36px] aspect-[1/1] flex justify-center items-center"><i class="fa-solid fa-arrows-rotate"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" basis-full md:basis-1/2 flex flex-wrap flex-col gap-3">
                                        <div class="w-full ">
                                            <textarea name="dataContact[content]" id="contactMessage" class="<?= $class_form_input ?> resize-none py-3" rows="8" placeholder="<?= _noidung ?>"><?= $flash->get('content'); ?></textarea>
                                        </div>
                                        <div class="w-full">
                                            <button type="submit" name="submit-contact" id="submit-contact" class="h-9 w-full text-center rounded text-white capitalize text-sm font-semibold font-main  bg-[var(--html-bg-website)] hover:bg-[var(--html-cl-website)] transition-all duration-300"><?= _guithongtin ?></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class=" w-full md:w-1/2 ">
                    <div class="overflow-hidden bg-slate-100 p-3 w-full aspect-[600/350] ">
                        <div class="form_ggmap overflow-hidden w-full h-full">
                            <?= htmlspecialchars_decode($row_setting['iframe_map']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    .form_ggmap iframe {
        width: 100%;
        height: 100%;
    }
</style>