<?php
$list_c1_product_menu = $cache->getCache("select id,type , ten_$lang as ten , tenkhongdau_$lang as tenkhongdau from #_baiviet_list where noibat=1 and type in ('dien-tu','dien-lanh','do-gia-dung','hang-trung-bay') and hienthi=1 order by stt asc", array(), 'result', _TIMECACHE);
?>
<header class=" hidden lg:block  bg-white w-full sticky top-0 left-0  z-40   header_menu [&.animate]:shadow-lg  group/header transition-all duration-300 ">
    <div class="grid_x wide no_p  relative  opacity_animaiton ">
        <div class="flex relative  justify-between  transition-all duration-300 gap-[22px]">
            <div class="relative flex-initial flex items-center px-[21px] py-[29px] leading-[0] w-[250px] z-10">
                <div class="absolute top-0 left-0 h-full w-full bg-[#EEEEEE] z-[-1]" style="clip-path: polygon(0 0,100% 0,180px 100%,0 100%);"></div>
                <div class="w-[176px]">
                    <?= $func->addHrefImg([
                        'classfix' => 'overflow-hidden inline-flex hover-left transition-all duration-300',
                        'addhref' => true,
                        'href' =>   '',
                        'sizes' => '176x79x2',
                        'actual_width' => 300,
                        'isLazy' => true,
                        'upload' => _upload_hinhanh_l,
                        'image' => ($logo["photo"]),
                        'alt' => (isset($row_setting["name_$lang"])) ? $row_setting["name_$lang"] : $row_setting["name"],
                    ]); ?>
                </div>
                <?php if ($source == 'index') { ?>
                    <h2>
                    <?php } ?>
                    <span class="hidden">
                        Tranh Chủ
                    </span>
                    <?php if ($source == 'index') { ?>
                    </h2>
                <?php } ?>
            </div>
            <div class="flex-1 border-r border-[#DDD]">
                <div class="w-full border-b p-3 border-[#DDD] flex items-center justify-end gap-[30px]">
                    <div class="inline-flex items-center gap-2">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path d="M13.1562 5.08825C13.1562 5.08544 13.1562 5.0815 13.1562 5.07812C13.1562 2.82587 11.3304 1 9.07812 1C6.82587 1 5 2.82587 5 5.07812C5 7.08175 6.44506 8.74844 8.35025 9.09156L8.375 9.0955L8.32243 15.8882C8.32243 16.2763 8.69 16.5883 9.07812 16.5883C9.46625 16.5883 9.78125 16.2763 9.78125 15.8882V9.0955C11.7078 8.74956 13.1517 7.08794 13.1562 5.08825ZM9.07812 7.76012C7.60269 7.76012 6.40625 6.56369 6.40625 5.08825C6.40625 3.61281 7.60269 2.41638 9.07812 2.41638C10.5536 2.41638 11.75 3.61281 11.75 5.08825C11.7483 6.56313 10.553 7.75844 9.07812 7.76012Z" fill="#DD0100" />
                            </svg>
                        </div>
                        <div class="text-[#424242] text-sm font-normal font-main-400">
                            <span><?= $row_setting["address_$lang"] ?></span>
                        </div>
                    </div>
                    <div class="inline-flex items-center gap-2">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="15" viewBox="0 0 17 15" fill="none">
                                <path d="M14.5 1H2.5C1.67157 1 1 1.71686 1 2.60116V12.2081C1 13.0924 1.67157 13.8093 2.5 13.8093H14.5C15.3284 13.8093 16 13.0924 16 12.2081V2.60116C16 1.71686 15.3284 1 14.5 1Z" stroke="#DD0100" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M16 3.95596L9.2725 8.6394C9.04095 8.79833 8.77324 8.88262 8.5 8.88262C8.22676 8.88262 7.95905 8.79833 7.7275 8.6394L1 3.95596" stroke="#DD0100" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="text-[#424242] text-sm font-normal font-main-400">
                            <span><?= $row_setting["email"] ?></span>
                        </div>
                    </div>
                </div>
                <div class="w-full flex items-center  justify-between">
                    <?php include _layouts . "pc/menu.php"; ?>
                    <button class="views_popup_client border-none outline-none inline-flex items-center gap-2 text-base font-bold font-main-700 text-[var(--html-cl-website)] px-[32px]">
                        <span>
                            NHẬN BÁO GIÁ
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="20" viewBox="0 0 17 20" fill="none">
                            <path d="M13.0597 12.282L13.0597 4.15544L4.5 4.78201" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M1 18.282L12 5.28201" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="flex-initial inline-flex items-center pr-6">
                <a href="tel:<?= $func->handlePhoneNumberUrl($row_setting["hotline"]) ?>" title="<?= $row_setting["hotline"] ?>" class="inline-flex items-center gap-3">
                    <div class="w-[54px] aspect-[1/1] bg-[var(--html-cl-website)] flex justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="31" height="31" viewBox="0 0 31 31" fill="none">
                            <g clip-path="url(#clip0_16_54)">
                                <path d="M1.5832 13.2301C1.06397 11.8251 0.697462 10.3896 0.78909 8.86245C0.850176 7.91563 1.21669 7.12152 1.91917 6.44958C2.65219 5.7471 3.38522 4.98353 4.11824 4.28105C5.06507 3.33423 6.28678 3.33423 7.2336 4.28105C7.81391 4.86136 8.42476 5.47222 9.00507 6.05253C9.58538 6.63284 10.1657 7.18261 10.7155 7.76292C11.7234 8.77083 11.7234 9.96199 10.7155 10.9699C10.013 11.7029 9.27996 12.4054 8.54693 13.1079C8.36368 13.2911 8.33313 13.4439 8.42476 13.6882C8.91345 14.8488 9.58538 15.8567 10.3795 16.8341C11.9372 18.7583 13.7392 20.4687 15.8466 21.8126C16.3048 22.0874 16.7935 22.3012 17.2821 22.5456C17.5265 22.6678 17.6792 22.6372 17.893 22.4234C18.5955 21.6904 19.3285 20.9574 20.0615 20.2243C21.0084 19.2775 22.2301 19.2775 23.1769 20.2243C24.3375 21.385 25.5287 22.5456 26.6893 23.7367C27.6667 24.7141 27.6667 25.9358 26.6893 26.9132C26.0174 27.5851 25.3149 28.2265 24.704 28.929C23.7877 29.9369 22.6577 30.2729 21.3443 30.2118C19.4507 30.1202 17.6792 29.4788 15.9994 28.6541C12.2426 26.8216 9.00507 24.2865 6.31732 21.0795C4.3015 18.7277 2.65219 16.1316 1.5832 13.2301ZM30.218 13.8739C29.5209 6.99359 24.0616 1.51553 17.1899 0.789348C16.3603 0.701681 15.6328 1.33898 15.6328 2.17319V2.19986C15.6328 2.91444 16.1746 3.50823 16.8852 3.5831C22.4234 4.1666 26.8562 8.57495 27.447 14.1319C27.5232 14.8482 28.1252 15.3919 28.8455 15.384C29.6549 15.3751 30.2996 14.6792 30.218 13.8739ZM15.6328 7.44578V7.46529C15.6328 8.13124 16.0993 8.72312 16.7557 8.83555C18.1046 9.06659 19.3525 9.7111 20.3364 10.695C21.3203 11.6789 21.9648 12.9268 22.1959 14.2757C22.3083 14.9321 22.9002 15.3986 23.5661 15.3986H23.5784C24.4374 15.3986 25.1044 14.6261 24.9542 13.7804C24.2568 9.85338 21.1531 6.74878 17.2455 6.0691C16.4014 5.92229 15.6328 6.58906 15.6328 7.44578Z" fill="white" />
                            </g>
                        </svg>
                    </div>
                    <div class="grid grid-cols-1 gap-1">
                        <div class="text-sm font-medium font-main-500">
                            <span>
                                Hotline 24/7
                            </span>
                        </div>
                        <div class=" text-black text-base font-bold font-main-700">
                            <span>
                                <?= $row_setting["hotline"] ?>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="absolute bottom-0 right-0 w-full h-3 bg-[#EEEEEE]"></div>
            <div class="absolute bottom-0 left-[174px] w-[23px] h-3 bg-[var(--html-bg-website)] z-10" style="clip-path: polygon(5px 0px,100% 0px,0px 100%);"></div>
        </div>
    </div>
</header>