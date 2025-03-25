<?php

// giới thiệu
$info_introducce = $cache->getCache("select  ten_$lang as ten,mota_$lang as mota ,text_$lang as text ,text2_$lang as text2 ,slogan_$lang as slogan ,link,photo from #_bannerqc where type=? and hienthi=1", array('info_introducce'), 'fetch', _TIMECACHE);

$criteria = $cache->getCache("select ten_$lang as ten ,photo from #_photo where type=? and hienthi=1 order by stt asc", array('criteria'), 'result', _TIMECACHE);

$images_introduce = $cache->getCache("select ten_$lang as ten ,photo from #_photo where type=? and hienthi=1 order by stt asc limit 0,3", array('images_introduce'), 'result', _TIMECACHE);

?>
<script>
    var form_criteria_main = $(".form_criteria_main");
    form_criteria_main.owlCarousel({
        dots: false,
        loop: true,
        center: false,
        nav: false,
        rewind: false,
        lazyLoad: true,
        responsive: {
            0: {
                items: 3,
                margin: 10,
            },
            600.5: {
                items: 4,
                margin: 20,
            },
        },
        responsiveClass: true,
        autoplay: true,
        autoplayTimeout: 6000,
        autoplayHoverPause: true,
        navText: ["<i class='fas fa-angle-left'></i>", "<i class='fas fa-angle-right'></i>"],
    });
</script>
<!-- giới thiệu -->
<?php if (!empty($info_introducce)) { ?>
    <section class="section-introduce pb-8 sm:pb-[80px] ">
        <div class="grid_s wide ">
            <div class=" rounded-xl sm:rounded-[32px] bg-white px-3 sm:px-12 pt-9 pb-6">
                <div class="w-full flex flex-wrap items-center justify-center gap-5 md:gap-[30px] ">
                    <div class="w-full lg:w-[calc(50%-30px)]">
                        <div class="flex items-center  <?= $class_title_sup_main ?> gap-2 ">
                            <span class="flex-initial">
                                <?= $info_introducce["ten"] . " " ?>
                            </span>
                        </div>
                        <div class="<?= $class_title_main ?> mt-2 ">
                            <span>
                                <?= $info_introducce["slogan"] ?>
                            </span>
                        </div>
                        <div class="mt-2 text-sm leading-[1.8] font-normal font-main-400">
                            <span class="text-[#6C6C6C] line-clamp-6 ">
                                <?= htmlspecialchars_decode($info_introducce["mota"]) ?>
                            </span>
                        </div>
                        <div class="mt-7 flex flex-wrap gap-8 items-center ">
                            <a href="<?= $info_introducce['link'] ?>" title="Tìm hiểu thêm " class=" capitalize outline-none border-none inline-flex justify-center items-center leading-none h-10 rounded-full px-8 bg-[var(--html-bg-website)] text-white text-base font-medium font-main-500 text-center hover:bg-[var(--html-sc-website)] gap-2 transition-all duration-300" data-value="<?= $info["id"] ?>" data-form="view_info_introduce">
                                <span>Tìm hiểu thêm</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                                    <g clip-path="url(#clip0_3_69)">
                                        <path d="M1.329 8.61973H12.1909L10.156 10.6549C9.57144 11.2395 10.4482 12.1163 11.0327 11.5317L12.886 9.67537L14.1232 8.43614C14.363 8.19491 14.363 7.80532 14.1232 7.5641L11.0327 4.46972C10.9152 4.34889 10.7533 4.28109 10.5847 4.28249C10.0281 4.28256 9.7549 4.9606 10.156 5.34662L12.1957 7.38178H1.297C0.439746 7.42432 0.503753 8.66241 1.329 8.61973Z" fill="currentColor" />
                                    </g>
                                </svg>
                            </a>
                            <a href="tel:<?= $func->handlePhoneNumberUrl($row_setting["hotline"]) ?>" title="<?= $row_setting["hotline"] ?>" class="inline-flex items-center gap-1">
                                <div class="w-[54px] aspect-[1/1] text-[var(--html-cl-website)] flex justify-center items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="31" height="31" viewBox="0 0 31 31" fill="none">
                                        <g clip-path="url(#clip0_16_54)">
                                            <path d="M1.5832 13.2301C1.06397 11.8251 0.697462 10.3896 0.78909 8.86245C0.850176 7.91563 1.21669 7.12152 1.91917 6.44958C2.65219 5.7471 3.38522 4.98353 4.11824 4.28105C5.06507 3.33423 6.28678 3.33423 7.2336 4.28105C7.81391 4.86136 8.42476 5.47222 9.00507 6.05253C9.58538 6.63284 10.1657 7.18261 10.7155 7.76292C11.7234 8.77083 11.7234 9.96199 10.7155 10.9699C10.013 11.7029 9.27996 12.4054 8.54693 13.1079C8.36368 13.2911 8.33313 13.4439 8.42476 13.6882C8.91345 14.8488 9.58538 15.8567 10.3795 16.8341C11.9372 18.7583 13.7392 20.4687 15.8466 21.8126C16.3048 22.0874 16.7935 22.3012 17.2821 22.5456C17.5265 22.6678 17.6792 22.6372 17.893 22.4234C18.5955 21.6904 19.3285 20.9574 20.0615 20.2243C21.0084 19.2775 22.2301 19.2775 23.1769 20.2243C24.3375 21.385 25.5287 22.5456 26.6893 23.7367C27.6667 24.7141 27.6667 25.9358 26.6893 26.9132C26.0174 27.5851 25.3149 28.2265 24.704 28.929C23.7877 29.9369 22.6577 30.2729 21.3443 30.2118C19.4507 30.1202 17.6792 29.4788 15.9994 28.6541C12.2426 26.8216 9.00507 24.2865 6.31732 21.0795C4.3015 18.7277 2.65219 16.1316 1.5832 13.2301ZM30.218 13.8739C29.5209 6.99359 24.0616 1.51553 17.1899 0.789348C16.3603 0.701681 15.6328 1.33898 15.6328 2.17319V2.19986C15.6328 2.91444 16.1746 3.50823 16.8852 3.5831C22.4234 4.1666 26.8562 8.57495 27.447 14.1319C27.5232 14.8482 28.1252 15.3919 28.8455 15.384C29.6549 15.3751 30.2996 14.6792 30.218 13.8739ZM15.6328 7.44578V7.46529C15.6328 8.13124 16.0993 8.72312 16.7557 8.83555C18.1046 9.06659 19.3525 9.7111 20.3364 10.695C21.3203 11.6789 21.9648 12.9268 22.1959 14.2757C22.3083 14.9321 22.9002 15.3986 23.5661 15.3986H23.5784C24.4374 15.3986 25.1044 14.6261 24.9542 13.7804C24.2568 9.85338 21.1531 6.74878 17.2455 6.0691C16.4014 5.92229 15.6328 6.58906 15.6328 7.44578Z" fill="currentColor" />
                                        </g>
                                    </svg>
                                </div>
                                <div class="grid grid-cols-1 gap-[2px]">
                                    <div class="text-sm font-medium font-main-500">
                                        <span>
                                            Hotline 24/7
                                        </span>
                                    </div>
                                    <div class=" text-[var(--html-bg-website)] text-2xl font-bold font-main-700 text-nowrap">
                                        <span>
                                            <?= $row_setting["hotline"] ?>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="mt-7 sm:mt-11 w-full lg:w-[90%]">
                            <div class="owl-carousel form_criteria_main owl-theme   ">
                                <?php foreach ($criteria as $key_tc => $value_tc) { ?>
                                    <div class=" w-full py-3">
                                        <div class="w-full flex justify-center">
                                            <div class="w-[52px] h-[52px] rounded-full border border-white shadow-[0_0_0_4px_#EDEDED] bg-[#EDEDED] p-3 ">
                                                <div class="w-full h-full ring_web">
                                                    <?= $func->addHrefImg([
                                                        'addhref' => true,
                                                        'href' => $jv0,
                                                        'sizes' => '100x100x1',
                                                        'actual_width' => 100,
                                                        'upload' => _upload_hinhanh_l,
                                                        'image' => ($value_tc["photo"]),
                                                        'alt' => $value_tc["ten"],
                                                    ]); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-full text-center mt-4 text-[#5C5C5C] text-sm font-medium font-main-500">
                                            <span class="line-clamp-2">
                                                <?= $value_tc['ten'] ?>
                                            </span>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="w-full lg:w-[50%] relative aspect-[555/490]  ">
                        <div class=" absolute top-0 left-0 w-[48%] h-auto overflow-hidden rounded-lg leading-[0]">
                            <?= $func->addHrefImg([
                                'addhref' => true,
                                'classfix' => "zoom_web",
                                'href' => $jv0,
                                'sizes' => '268x292x1',
                                'actual_width' => 700,
                                'upload' => _upload_hinhanh_l,
                                'image' => ($images_introduce[0]["photo"]),
                                'alt' => $images_introduce[0]["ten"],
                            ]); ?>
                        </div>
                        <div class="absolute top-1/2 right-0 -translate-y-1/2 w-[48%] h-auto overflow-hidden rounded-lg leading-[0]">
                            <?= $func->addHrefImg([
                                'addhref' => true,
                                'classfix' => "zoom_web",
                                'href' => $jv0,
                                'sizes' => '268x356x1',
                                'actual_width' => 700,
                                'upload' => _upload_hinhanh_l,
                                'image' => ($images_introduce[1]["photo"]),
                                'alt' => $images_introduce[1]["ten"],
                            ]); ?>
                        </div>
                        <div class="absolute bottom-0 left-[9%] w-[35%] h-auto overflow-hidden rounded-lg leading-[0]">
                            <?= $func->addHrefImg([
                                'addhref' => true,
                                'classfix' => "zoom_web",
                                'href' => $jv0,
                                'sizes' => '194x175x1',
                                'actual_width' => 700,
                                'upload' => _upload_hinhanh_l,
                                'image' => ($images_introduce[0]["photo"]),
                                'alt' => $images_introduce[0]["ten"],
                            ]); ?>
                        </div>
                        <div class="absolute top-[61%] left-[47%] -translate-x-1/2 -translate-y-1/2 w-[144px] h-[144px] rounded-full  bg-white border-[12px] border-white shadow-lg shadow-gray-300 z-10 ">
                            <div class="w-full h-full rounded-full border border-[var(--html-bg-website)] flex flex-wrap justify-center items-center content-center">
                                <div class="w-full text-center ">
                                    <span class=" text-[var(--html-bg-website)] text-[40px] font-black font-main-900 leading-none">
                                        <?= $info_introducce["text"] ?>
                                    </span>
                                </div>
                                <div class="w-full text-center mt-1">
                                    <span class="text-sm capitalize font-semibold font-main-600 text-[#535353]">
                                        <?= $info_introducce["text2"] ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>