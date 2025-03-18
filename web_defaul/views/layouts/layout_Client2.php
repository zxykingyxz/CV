<?php
// đăng ký nhận tin
$info_partner = $cache->getCache("select  ten_$lang as ten  from #_bannerqc where type=? and hienthi=1", array('info-partner'), 'fetch', _TIMECACHE);

$info_receive = $cache->getCache("select  ten_$lang as ten,mota_$lang as mota,photo  from #_bannerqc where type=? and hienthi=1", array('info-receive'), 'fetch', _TIMECACHE);

$list_partner = $cache->getCache("select ten_$lang as ten ,mota_$lang as mota,photo from #_photo where type=? and hienthi=1 order by stt asc ", array('partner'), 'result', _TIMECACHE);

$list_service = $db->rawQuery("select id,ten_$lang as ten from #_baiviet where type=? and hienthi=1 order by stt asc", array('dich-vu'));

$list_product_client = $db->rawQuery("select id,ten_$lang as ten from #_baiviet where type=? and hienthi=1 $orderbyForProduct", array('san-pham'));

?>
<!-- đăng ký nhận tin -->
<section class="section-receive pt-7 sm:pt-[55px]  pb-6 sm:pb-8 ">
    <div class="grid_s wide">
        <div class="flex flex-wrap gap-5">
            <div class="flex-initial w-full h-full lg:w-[52%] rounded-lg sm:rounded-2xl overflow-hidden pt-6 px-3 sm:px-4 pb-8 " style="background:var(--color-linear-two);">
                <div class="w-full text-center pb-4">
                    <a href="<?= $jv0 ?>" title="<?= $info_partner['ten'] ?>" class=" <?= $class_title_main ?>">
                        <span class="text-white">
                            <?= $info_partner['ten'] ?>
                        </span>
                    </a>
                </div>
                <div class="w-full h-full bg-white rounded-lg sm:rounded-2xl  pl-3 sm:pl-6 pr-2 sm:pr-5 py-4 sm:py-9 overflow-hidden shadow-[0px_5px_10px_0px_rgba(0,_0,_0,_0.15)_inset]">
                    <div class="w-full pr-1 max-h-[clamp(358px,40vw,438px)] overflow-y-auto overflow-x-hidden scroll-design-one">
                        <div class=" grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-3 gap-2 sm:gap-3 ">
                            <?php foreach ($list_partner as $key => $value) { ?>
                                <div class="bg-white overflow-hidden aspect-[168/128] w-full rounded-lg border border-gray-200 hover:bg-[var(--html-bg-website)] transition-all duration-300">
                                    <?= $func->addHrefImg([
                                        'classfix' => 'w-full',
                                        'addhref' => true,
                                        'href' => (!empty($value['link'])) ? $value['link'] : $jv0,
                                        'sizes' => '168x128x2',
                                        'actual_width' => 800,
                                        'upload' => _upload_hinhanh_l,
                                        'image' => ($value["photo"]),
                                        'alt' => $value["ten"],
                                    ]); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-1 h-[initial] rounded-lg sm:rounded-2xl overflow-hidden py-5 px-3 sm:px-7" <?php if (!empty($info_receive['photo'])) { ?> style="background: url(<?= _upload_hinhanh_l . $info_receive['photo'] ?>) no-repeat center/cover ;" <?php } ?>>
                <div class="wow fadeInDown" data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="0.2s">
                    <div class="text-center  mb-1">
                        <a href="<?= $jv0 ?>" title="" class=" <?= $class_title_main ?>">
                            <span class="text-white">
                                <?= $info_receive['ten'] ?>
                            </span>
                        </a>
                    </div>
                    <div class="mb-5 text-center flex justify-center ">
                        <div class="w-10/12 ">
                            <span class="<?= $class_content_main ?>">
                                <span class="text-white">
                                    <?= htmlspecialchars_decode($info_receive['mota']) ?>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <form action="" method="POST" name="form_client" class="form_client w-full flex flex-wrap items-start gap-3 " enctype="multipart/form-data">
                    <div class="w-full grid grid-cols-1 gap-[15px]">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-[15px]">
                            <?= $sample->getTemplateLayoutsFor([
                                'name_layouts' => 'input_web',
                                'class_form' => 'w-full',
                                'label' => "Họ Và Tên",
                                'placeholder' => "Họ Và Tên",
                                'id' => 'fullname',
                                'data' => 'data[fullname]',
                                'value' => '',
                                'type' => 'text',
                                'save_cache' => false,
                                'required' => true,
                                'readonly' => false,
                                'function' => '',
                                'form' => false,
                            ]); ?>
                            <?= $sample->getTemplateLayoutsFor([
                                'name_layouts' => 'input_web',
                                'class_form' => 'w-full',
                                'label' => "Số Điện Thoại",
                                'placeholder' => "Số Điện Thoại",
                                'id' => 'phone',
                                'data' => 'data[phone]',
                                'value' => '',
                                'type' => 'number',
                                'save_cache' => false,
                                'required' => true,
                                'readonly' => false,
                                'function' => '',
                                'form' => false,
                            ]); ?>
                        </div>
                        <?= $sample->getTemplateLayoutsFor([
                            'name_layouts' => 'input_web',
                            'class_form' => 'w-full',
                            'label' => "Email",
                            'placeholder' => "Email",
                            'id' => 'email',
                            'data' => 'data[email]',
                            'value' => '',
                            'type' => 'text',
                            'save_cache' => false,
                            'required' => true,
                            'readonly' => false,
                            'function' => '',
                            'form' => false,
                        ]); ?>
                        <?= $sample->getTemplateLayoutsFor([
                            'name_layouts' => 'select_web',
                            'class_form' => 'w-full',
                            'label' => "Sản Phẩm Quan Tâm",
                            'placeholder' => "Sản Phẩm Quan Tâm",
                            'id' => 'product',
                            'data' => 'data[product]',
                            'value' => '',
                            'data_option' => $list_product_client,
                            'name_col_view' => 'ten',
                            'name_col_value' => 'id',
                            'save_cache' => false,
                            'required' => true,
                            'function' => '',
                            'form' => false,
                        ]); ?>
                        <?= $sample->getTemplateLayoutsFor([
                            'name_layouts' => 'select_web',
                            'class_form' => 'w-full',
                            'label' => "Dịch Vụ Quan Tâm",
                            'placeholder' => "Dịch Vụ Quan Tâm",
                            'id' => 'service',
                            'data' => 'data[service]',
                            'value' => '',
                            'data_option' => $list_service,
                            'name_col_view' => 'ten',
                            'name_col_value' => 'id',
                            'save_cache' => false,
                            'required' => true,
                            'function' => '',
                            'form' => false,
                        ]); ?>
                        <?= $sample->getTemplateLayoutsFor([
                            'name_layouts' => 'textarea_web',
                            'class_form' => 'w-full',
                            'class' => "",
                            'label' => "Nội Dung",
                            'placeholder' => "Nội Dung",
                            'id' => "notes",
                            'data' => "data[notes]",
                            'rows' => 4,
                            'value' => '',
                            'save_cache' => false,
                            'required' => false,
                            'readonly' => false,
                            'function' => '',
                            'form' => false,
                        ]); ?>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-[15px]">
                            <?= $sample->getTemplateLayoutsFor([
                                'name_layouts' => 'input_web',
                                'class_form' => 'w-full',
                                'placeholder' => 'Nhập Mã Xác Nhận',
                                'id' => 'captcha',
                                'data' => 'data[captcha]',
                                'value' => '',
                                'type' => 'text',
                                'save_cache' => false,
                                'required' => true,
                                'readonly' => false,
                                'function' => '',
                                'form' => false,
                            ]); ?>
                            <div class="">
                                <div class="form_captcha_js flex justify-center items-center w-full h-[40px] rounded-md bg-white pl-2 pr-3">
                                    <div class="flex-initial code_captcha rounded "></div>
                                    <div class="flex-1"></div>
                                    <div class="h-[28px] inline-flex justify-center items-center rounded-[50%] overflow-hidden cursor-pointer aspect-[1/1] btn_captcha_js [&.on]:animate-load-captcha" data-name="captcha_price_quote" data-size="80x18">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                            <path d="M11.4047 13.8994L7.71469 11.4385C7.67215 11.4109 7.62299 11.3951 7.57232 11.3929C7.52165 11.3907 7.47131 11.4021 7.42653 11.426C7.38176 11.4498 7.34417 11.4852 7.31769 11.5284C7.29121 11.5717 7.27679 11.6212 7.27594 11.6719V12.6141C5.98273 12.5501 4.74679 12.0611 3.75978 11.2231C2.77276 10.3851 2.08983 9.24483 1.81687 7.97914C2.05077 6.88134 2.5967 5.87444 3.38906 5.07945C3.41542 5.05329 3.43634 5.02218 3.45062 4.98791C3.4649 4.95363 3.47226 4.91687 3.47226 4.87973C3.47227 4.8426 3.46493 4.80584 3.45066 4.77155C3.4364 4.73727 3.41548 4.70615 3.38914 4.67999C3.36279 4.65383 3.33152 4.63314 3.29714 4.61911C3.26276 4.60509 3.22594 4.598 3.18881 4.59827C3.15168 4.59854 3.11497 4.60616 3.08079 4.62068C3.04662 4.6352 3.01565 4.65634 2.98969 4.68289C2.11245 5.56758 1.51104 6.68799 1.25851 7.90801C1.00598 9.12803 1.11322 10.3951 1.56718 11.5554C2.02114 12.7156 2.8023 13.719 3.81573 14.4437C4.82916 15.1684 6.03125 15.5831 7.27594 15.6376V16.5938C7.27677 16.6445 7.29118 16.6941 7.31766 16.7374C7.34413 16.7807 7.38172 16.816 7.4265 16.8399C7.47129 16.8637 7.52164 16.8751 7.57231 16.8729C7.62299 16.8707 7.67216 16.8549 7.71469 16.8273L11.4047 14.3663C11.4435 14.341 11.4755 14.3064 11.4976 14.2657C11.5197 14.2249 11.5313 14.1793 11.5313 14.1329C11.5313 14.0865 11.5197 14.0409 11.4976 14.0001C11.4755 13.9593 11.4435 13.9247 11.4047 13.8994Z" fill="black" />
                                            <path d="M10.7241 2.36326V1.40701C10.7233 1.35625 10.709 1.30662 10.6825 1.26329C10.6561 1.21996 10.6185 1.18453 10.5737 1.16069C10.5289 1.13684 10.4785 1.12546 10.4277 1.12772C10.377 1.12999 10.3278 1.14582 10.2853 1.17357L6.59536 3.63451C6.55695 3.66015 6.52547 3.69487 6.50369 3.73559C6.48192 3.7763 6.47052 3.82177 6.47052 3.86794C6.47052 3.91412 6.48191 3.95958 6.50368 4.0003C6.52545 4.04102 6.55694 4.07574 6.59534 4.10138L10.2853 6.56231C10.3279 6.58994 10.377 6.60567 10.4277 6.60789C10.4784 6.6101 10.5287 6.5987 10.5735 6.57488C10.6183 6.55106 10.6558 6.51568 10.6823 6.47243C10.7088 6.42917 10.7232 6.37961 10.7241 6.3289V5.38671C12.0173 5.45076 13.2532 5.93971 14.2402 6.77773C15.2273 7.61575 15.9102 8.75602 16.1832 10.0217C15.9493 11.1195 15.4033 12.1264 14.611 12.9214C14.5596 12.9746 14.5312 13.0459 14.5319 13.1198C14.5327 13.1938 14.5626 13.2645 14.6151 13.3166C14.6676 13.3688 14.7385 13.3981 14.8124 13.3984C14.8864 13.3986 14.9575 13.3697 15.0103 13.3179C15.8876 12.4333 16.489 11.3128 16.7415 10.0928C16.994 8.8728 16.8868 7.6057 16.4328 6.44547C15.9789 5.28524 15.1977 4.28183 14.1843 3.55715C13.1709 2.83246 11.9688 2.4177 10.7241 2.36326Z" fill="black" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full flex items-center justify-center">
                            <button type="submit" name="submit-resgister-client" class="w-full uppercase h-[40px] bg-[var(--html-bg-website)] hover:bg-[var(--html-sc-website)] transition-all duration-300 text-xs font-semibold text-white text-center px-7 rounded-lg flex justify-center items-center gap-3">
                                <span>đăng ký tư vấn ngay</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="13" viewBox="0 0 15 13" fill="none">
                                    <g clip-path="url(#clip0_1_493)">
                                        <path d="M13.2439 6.5V11.7H2.04392V1.3H7.64392V0H0.643921V13H14.6439V6.5H13.2439Z" fill="white" />
                                        <path d="M9.04958 0L11.0656 1.872L7.09705 5.55707L8.66505 7.01307L12.6336 3.328L14.6496 5.2V0H9.04958Z" fill="white" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1_493">
                                            <rect width="14" height="13" fill="white" transform="translate(0.651733)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>
                <div class="text-center mt-5 text-white text-xl font-bold font-main-700">
                    <span><?= "Hotline: " . $row_setting['hotline'] ?></span>
                </div>
            </div>
        </div>
    </div>
</section>