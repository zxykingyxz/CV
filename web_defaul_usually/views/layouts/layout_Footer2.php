<?php
$bg_footer = $cache->getCache("select ten_$lang as ten,slogan_$lang as slogan,mota_$lang as mota,photo from #_bannerqc where hienthi=1 and type=? limit 0,1", array('bg_footer'), 'fetch', _TIMECACHE);

$logo_footer = $cache->getCache("select mota_$lang as mota,photo  from #_bannerqc where hienthi=1 and type=? limit 0,1", array('logo_footer'), 'fetch', _TIMECACHE);

$footer = $cache->getCache("select mota_$lang as mota,ten_$lang as ten from #_company where type=? limit 1", array('footer'), 'fetch', _TIMECACHE);

$list_service_footer = $cache->getCache("select id,type , ten_$lang as ten , tenkhongdau_$lang as tenkhongdau  from #_baiviet where footer=1 and type=? and hienthi=1 order by stt asc", array('dich-vu'), 'result', _TIMECACHE);

$footer_class_title = " font-main-600 font-semibold text-base capitalize text-[#fff] ";

$footer_class_content = "text-white text-[13px] font-extralight font-main-300 leading-normal ";

$margin_top = " mt-6 ";

$class_title_sup_footer = "text-white text-sm sm:text-base font-bold font-main-600";
$class_title_footer = "text-white text-xl sm:text-2xl font-bold font-main-700";
$class_content_footer = "text-white text-xs sm:text-sm leading-[1.78] sm:leading-[1.78] font-normal font-main-400";

?>


<footer class="section-product footer  overflow-hidden relative bg-[#2C2C2C]" <?php if (!empty($bg_footer['photo'])) { ?> style="background: url(<?= _upload_hinhanh_l . $bg_footer['photo'] ?>) no-repeat center/cover fixed;" <?php } ?>>
    <div class=" border-b border-[#B3B1B1] pt-[25px] sm:pt-[55px] pb-[30px] sm:pb-[63px]">
        <div class="grid_s wide overflow-hidden">
            <div class="w-full wow fadeInDown" data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="0.2s">
                <?php if (!empty($bg_footer['slogan'])) { ?>
                    <div class="text-center mb-5">
                        <a href="<?= $jv0 ?>" title="" class=" <?= $class_title_sup_footer ?>">
                            <?= $bg_footer['slogan'] ?>
                        </a>
                    </div>
                <?php } ?>
                <div class="text-center mb-5">
                    <a href="<?= $jv0 ?>" title="" class=" <?= $class_title_footer ?>">
                        <?= $bg_footer['ten'] ?>
                    </a>
                </div>
                <div class="mb-12 text-center flex justify-center ">
                    <div class="w-10/12">
                        <span class="<?= $class_content_footer ?>">
                            <?= htmlspecialchars_decode($bg_footer['mota']) ?>
                        </span>
                    </div>
                </div>
                <div class="flex justify-center items-center">
                    <div class="w-full sm:w-[80%] lg:w-[60%] border-b border-[#B3B1B1] pb-5">
                        <form action="" method="POST" name="form_email" class="form_email w-full flex items-center gap-1 " enctype="multipart/form-data">
                            <input type="email" required name="data[email]" class="flex-1 bg-inherit border-none text-base font-medium font-main text-white placeholder:text-white pl-3 sm:pl-7 pr-2" placeholder="Email của bạn">
                            <button type="submit" name="submit-resgister-email" class="text-base font-medium font-main text-white inline-flex leading-none justify-center items-center gap-1">
                                <span>
                                    Đăng Ký
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                                    <g clip-path="url(#clip0_1_1064)">
                                        <path d="M1.48096 12.5898L22.6228 12.5898" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M15.4922 5.58984L23.6415 12.5898L15.4922 19.5898" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </g>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="grid_s wide">
            <div class=" pt-8 sm:pt-[45px] pb-8 sm:pb-[55px] relative z-30">
                <div class="row justify-between gap-5 sm:gap-2">
                    <!-- thông tin liên hệ -->
                    <div class="col flex-1 relative overflow-hidden">
                        <div class="wow fadeInLeft" data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="0.2s">
                            <div class="max-w-[152px] leading-[0]">
                                <?= $func->addHrefImg([
                                    'addhref' => true,
                                    'href' =>  "",
                                    'target' => '',
                                    'sizes' => '152x86x2',
                                    'actual_width' => 500,
                                    'upload' => _upload_hinhanh_l,
                                    'image' => $logo_footer['photo'],
                                    'alt' => "logo footer"
                                ]); ?>
                            </div>
                            <div class="mt-1 mb-4 <?= $footer_class_content ?>">
                                <?= $func->htmlDecodeContent($logo_footer["mota"]) ?>
                            </div>
                            <div class="inline-flex leading-[0] items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="21" viewBox="0 0 22 21" fill="none">
                                    <g clip-path="url(#clip0_1_1124)">
                                        <path d="M16.2784 13.9014C15.5923 13.224 14.7358 13.224 14.0541 13.9014C13.5341 14.417 13.014 14.9327 12.5028 15.4571C12.3629 15.6013 12.2449 15.6319 12.0745 15.5357C11.738 15.3522 11.3797 15.2036 11.0563 15.0026C9.5487 14.0543 8.2858 12.8351 7.1671 11.463C6.61213 10.7813 6.11833 10.0515 5.77311 9.22995C5.70319 9.06389 5.7163 8.95465 5.85176 8.81918C6.37178 8.31664 6.87869 7.80099 7.38997 7.28534C8.10226 6.56868 8.10226 5.72966 7.3856 5.00863C6.9792 4.59785 6.5728 4.19582 6.1664 3.78505C5.74689 3.36554 5.33175 2.94166 4.90787 2.52652C4.22179 1.85793 3.36529 1.85793 2.68358 2.53089C2.1592 3.04654 1.65666 3.5753 1.12353 4.08221C0.62973 4.54979 0.380646 5.12224 0.328207 5.79084C0.245179 6.87894 0.511743 7.90587 0.887555 8.90658C1.65666 10.9779 2.82779 12.8176 4.24801 14.5044C6.1664 16.7855 8.45623 18.5903 11.135 19.8925C12.3411 20.4781 13.5909 20.9282 14.9499 21.0025C15.8851 21.0549 16.6979 20.8189 17.349 20.0892C17.7947 19.591 18.2972 19.1365 18.7692 18.6602C19.4684 17.9523 19.4727 17.0958 18.7779 16.3966C17.9477 15.5619 17.113 14.7317 16.2784 13.9014Z" fill="var(--html-bg-website)" />
                                        <path d="M15.4445 10.4186L17.057 10.1433C16.8035 8.66192 16.1043 7.32036 15.0425 6.2541C13.9194 5.13104 12.4992 4.42312 10.9348 4.20462L10.7075 5.82585C11.918 5.99628 13.0192 6.54252 13.8888 7.41213C14.7103 8.23367 15.2478 9.27371 15.4445 10.4186Z" fill="var(--html-bg-website)" />
                                        <path d="M17.9632 3.4092C16.1016 1.54762 13.7463 0.372117 11.1462 0.00941467L10.9189 1.63065C13.1651 1.94528 15.2014 2.96347 16.8096 4.56722C18.3347 6.09232 19.3354 8.01945 19.6981 10.1388L21.3106 9.86354C20.8867 7.40766 19.7287 5.17901 17.9632 3.4092Z" fill="var(--html-bg-website)" />
                                    </g>
                                </svg>
                                <div class="">
                                    <div class="text-white text-[10px] font-main font-medium leading-none mb-2">
                                        <span>
                                            HOTLINE TƯ VẤN 24/7
                                        </span>
                                    </div>
                                    <div class="text-[var(--html-bg-website)] font-bold font-main text-xl leading-none">
                                        <span>
                                            <?= $row_setting['hotline'] ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Các danh mục footer -->
                    <div class="col overflow-hidden basis-full  md:basis-6/12 lg:basis-[22%] flex justify-start lg:justify-center">
                        <div class=" wow fadeInLeft" data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="0.6s">
                            <div class="<?= $footer_class_title ?>">
                                <span>dịch vụ nổi bật</span>
                            </div>
                            <div class="<?= $margin_top ?>">
                                <ul class="grid grid-cols-1 gap-4">
                                    <?php foreach ($list_service_footer as $key => $value) {
                                        // !empty($value['link']) ? $value['link'] : $jv0
                                    ?>
                                        <li class="group transition-all duration-300 ">
                                            <a href="<?= $func->getUrl($value) ?>" title="<?= $value['ten'] ?>" class="flex items-center gap-2 group-hover:translate-x-3 transition-all duration-300">
                                                <div class="flex-initial leading-none aspect-[1/1] w-[7px] flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="6" height="7" viewBox="0 0 6 7" fill="none">
                                                        <circle cx="3" cy="3.06592" r="3" fill="var(--html-bg-website)" />
                                                    </svg>
                                                </div>
                                                <div class="<?= $footer_class_content ?> flex-1   transition-all duration-300 group-hover:text-[var(--html-bg-website)] ">
                                                    <?= $value['ten'] ?>
                                                </div>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col overflow-hidden basis-full  md:basis-6/12 lg:basis-[22%] flex justify-start lg:justify-center">
                        <div class="wow fadeInLeft" data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="1s">
                            <div class="<?= $footer_class_title ?>">
                                <span>chính sách & quy định</span>
                            </div>
                            <div class="<?= $margin_top ?>">
                                <ul class="grid grid-cols-1 gap-4">
                                    <?php foreach ($chinhsach as $key => $value) {
                                        // !empty($value['link']) ? $value['link'] : $jv0
                                    ?>
                                        <li class="group transition-all duration-300 ">
                                            <a href="<?= $func->getUrl($value) ?>" title="<?= $value['ten'] ?>" class="flex items-center gap-2 group-hover:translate-x-3 transition-all duration-300">
                                                <div class="flex-initial leading-none aspect-[1/1] w-[7px] flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="6" height="7" viewBox="0 0 6 7" fill="none">
                                                        <circle cx="3" cy="3.06592" r="3" fill="var(--html-bg-website)" />
                                                    </svg>
                                                </div>
                                                <div class="<?= $footer_class_content ?>  flex-1   transition-all duration-300 group-hover:text-[var(--html-bg-website)] ">
                                                    <?= $value['ten'] ?>
                                                </div>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- mạng xã hội -->
                    <div class="col overflow-hidden basis-full md:basis-6/12 lg:basis-3/12 block lg:flex justify-start lg:justify-center">
                        <div class=" w-full wow fadeInLeft" data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="1.4s">
                            <div class="<?= $footer_class_title ?>">
                                <span>Kết Nối Nhanh</span>
                            </div>
                            <div class="<?= $margin_top . " " . $footer_class_content  ?> ">
                                <?= $func->htmlDecodeContent($footer["mota"]) ?>
                            </div>
                            <div class="flex items-center gap-3">
                                <?php foreach ($socical as $k => $v) { ?>
                                    <a href="<?= $v['link'] != '' ? $v['link'] : $jv0 ?>" title="<?= $v['ten'] ?>" target="<?= $v['link'] != '' ? '_blank' : '_top' ?>" class="group/mxh leading-[0] inline-flex justify-center items-center h-8 rounded-full border border-[var(--html-bg-website)] bg-inherit hover:bg-[var(--html-bg-website)] transition-all duration-300 overflow-hidden aspect-[1/1]">
                                        <div class="w-5 aspect-[1/1] group-hover/mxh:brightness-0  group-hover/mxh:invert transition-all duration-300">
                                            <?= $func->addHrefImg([
                                                'addhref' => false,
                                                'href' =>  "",
                                                'target' => '',
                                                'sizes' => '20x20x2',
                                                'actual_width' => 500,
                                                'upload' => _upload_hinhanh_l,
                                                'image' => $v['photo'],
                                                'alt' =>  $v['ten']
                                            ]); ?>
                                        </div>
                                    </a>
                                <?php }  ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include _layouts . "sectionCopy.php"; ?>
</footer>