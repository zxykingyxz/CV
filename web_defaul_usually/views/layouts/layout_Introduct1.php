<?php
// giới thiệu
$info = $cache->getCache("select id,type,ten_$lang as ten,photo,photo2 from #_info where type=? and hienthi=1", array('gioi-thieu'), 'fetch', _TIMECACHE);

$seoDB_info = $seo->getSeoDB("", 'info', 'capnhat', $info["type"]);

$desc_info = (isset($seoDB_info["description_$lang"])) ? $seoDB_info["description_$lang"] : $seoDB_info["description"];

$criteria_info = $cache->getCache("select ten_$lang as ten from #_photo where type=? and hienthi=1 order by stt asc ", array('criteria-info'), 'result', _TIMECACHE);

?>
<!-- giới thiệu -->
<?php if (!empty($info)) { ?>
    <section class="section-introduct  bg-white">
        <div class="grid_x no_p wide " <?php if (!empty($info['photo2'])) { ?> style="background: url(<?= _upload_hinhanh_l . $info['photo2'] ?>) no-repeat center/cover ;" <?php } ?>>
            <div class="grid_s wide">
                <div class="w-full pt-7 sm:pt-14  pb-8 sm:pb-16 flex flex-wrap items-center justify-center gap-5 md:gap-[70px]">
                    <div class="flex-1">
                        <div class="text-3xl font-bold font-main-700 ">
                            <span>
                                <?= $info["ten"] . " " ?>
                            </span>
                            <span class="text-[var(--html-bg-website)]">
                                <?= $row_setting["name_$lang"] ?>
                            </span>
                        </div>
                        <div class="mt-4 text-base leading-[2.13] font-normal font-main-400">
                            <span class="text-[#595757] line-clamp-6">
                                <?= $desc_info ?>
                            </span>
                        </div>
                        <div class="mt-5">
                            <div class="w-full grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-6">
                                <?php foreach ($criteria_info as $key_criteria => $value_criteria) { ?>
                                    <div class="flex items-center gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="23" viewBox="0 0 22 23" fill="none">
                                            <g clip-path="url(#clip0_1_38)">
                                                <path d="M11 22.4604C17.0751 22.4604 22 17.5356 22 11.4604C22 5.38532 17.0751 0.460449 11 0.460449C4.92487 0.460449 0 5.38532 0 11.4604C0 17.5356 4.92487 22.4604 11 22.4604Z" fill="url(#paint0_linear_1_38)" />
                                                <path d="M9.44984 13.4999L10.6208 11.7862C11.8047 10.0493 12.9891 8.31682 14.174 6.58867C14.5258 6.07775 14.9947 6.00972 15.5027 6.3513C15.6923 6.48011 15.8848 6.60169 16.0715 6.7334C16.5376 7.0634 16.6331 7.54682 16.3104 8.02011C15.0454 9.87854 13.7775 11.7355 12.5067 13.591C11.8882 14.4932 11.2735 15.3959 10.6627 16.2991C10.3038 16.8317 9.83918 16.9345 9.31089 16.5625C8.17905 15.7664 7.05348 14.9612 5.93418 14.1468C5.43194 13.7835 5.3726 13.3146 5.73444 12.8109C5.87918 12.6141 6.01379 12.4143 6.15997 12.2204C6.46102 11.8238 6.91405 11.7239 7.33234 11.9989C7.8201 12.3202 8.28905 12.672 8.76668 13.0121L9.44984 13.4999Z" fill="white" />
                                            </g>
                                            <defs>
                                                <linearGradient id="paint0_linear_1_38" x1="-5.50038" y1="6.96182" x2="32.9997" y2="22.4612" gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="var(--html-bg-website)" />
                                                    <stop offset="0.515625" stop-color="#CD6E6F" />
                                                    <stop offset="1" stop-color="#fff" />
                                                </linearGradient>
                                                <clipPath id="clip0_1_38">
                                                    <rect width="22" height="22" fill="white" transform="translate(0 0.460449)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <div class="flex-1 text-[15px] leading-normal  font-normal font-main-400 ">
                                            <span class="text-[#595757] line-clamp-2">
                                                <?= $value_criteria['ten'] ?>
                                            </span>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="mt-6 md:mt-12">
                            <a href="<?= $func->getType($info["type"]) ?>" title="Liên Hệ" class=" inline-flex justify-center items-center leading-none h-10 rounded-full px-8 bg-[var(--html-bg-website)] text-white text-sm font-semibold font-main-600 text-center hover:brightness-110 gap-2 transition-all duration-300">
                                <span>TƯ VẤN NGAY</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                    <path d="M16.1798 11.5791L10.8158 6.21511L12.23 4.8009L20.0082 12.5791L12.23 20.3572L10.8158 18.943L16.1798 13.5791H4.00818V11.5791H16.1798Z" fill="white" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="w-full lg:w-[46%] rounded-3xl overflow-hidden leading-[0] aspect-[557/458]">
                        <?= $func->addHrefImg([
                            'addhref' => true,
                            'href' => $func->getType($info["type"]),
                            'sizes' => '557x458x1',
                            'actual_width' => 1200,
                            'upload' => _upload_hinhanh_l,
                            'image' => ($info["photo"]),
                            'alt' => $info["ten"],
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>