<?php
global $logo;
// order by
$orderbyForProduct = $func->getOrderByTypeFor('san-pham');

$per_page_index = $func->getPagingByComFor("index");

$class_title_sup_main = "text-[#2F2E2E] text-sm sm:text-base font-normal font-main-400";
$class_title_main = "text-[20px] sm:text-[24px] leading-normal sm:leading-normal text-[#3C3C3C] font-bold font-main-700";
$class_content_main = "text-black text-xs sm:text-sm leading-[1.78] sm:leading-[1.78] font-light font-main-300";

// tiêu chí

$criteria = $cache->getCache("select ten_$lang as ten ,photo from #_photo where type=? and hienthi=1 order by stt asc", array('criteria'), 'result', _TIMECACHE);

// sản phẩm bán chạy
$info_product_banchay_index = $cache->getCache("select  ten_$lang as ten,mota_$lang as mota from #_bannerqc where type=? and hienthi=1", array('info_product_banchay_index'), 'fetch', _TIMECACHE);

$list_procuct_banchay = $cache->getCache("select id,type, ten_$lang as ten , tenkhongdau_$lang as tenkhongdau,photo,photo2,giaban,masp,banchay from #_baiviet where type=? and banchay=1 and hienthi=1 order by stt asc,id desc", array("san-pham"), 'result', _TIMECACHE);

// danh mục sản phẩm
$list_c1_procuct = $cache->getCache("select id,type, ten_$lang as ten , tenkhongdau_$lang as tenkhongdau,photo from #_baiviet_list where type=? and noibat=1 and hienthi=1 order by stt asc,id desc", array("san-pham"), 'result', _TIMECACHE);

// tin tức

$info_client_index = $cache->getCache("select  ten_$lang as ten,mota_$lang as mota from #_bannerqc where type=? and hienthi=1", array('info_client_index'), 'fetch', _TIMECACHE);

$list_blogs = $cache->getCache("select id,type,luotxem, ten_$lang as ten , tenkhongdau_$lang as tenkhongdau,photo,ngaytao from #_baiviet where type=? and noibat=1 and hienthi=1 order by stt asc,id desc", array("tin-tuc"), 'result', _TIMECACHE);

?>

<div class="h-5 sm:h-11 "></div>

<!-- tiêu chí -->
<?php if (!empty($criteria)) { ?>
    <section class="section-criteria pb-5 sm:pb-11 ">
        <div class="grid_s wide ">
            <div class="w-full">
                <div class="owl-carousel form_criteria_main owl-theme   ">
                    <?php foreach ($criteria as $key_tc => $value_tc) { ?>
                        <div class="group border border-[var(--html-sc-website)] hover:border-[var(--html-bg-website)]  bg-inherit rounded-xl sm:rounded-2xl p-3 sm:p-4 flex items-center transition-all duration-300 gap-3">
                            <div class="w-[45px] sm:w-[65px] h-[45px] sm:h-[65px] flex-initial rounded-full bg-[var(--html-sc-website)] p-2 group-hover:bg-[var(--html-bg-website)] transition-all duration-300">
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
                            <div class="flex-1 text-center text-sm sm:text-base font-normal font-main-400 text-[var(--html-sc-website)] group-hover:text-[var(--html-bg-website)] transition-all duration-300">
                                <span class="line-clamp-2">
                                    <?= $value_tc["ten"] ?>
                                </span>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>

<!-- sản phẩm bán chạy -->
<?php if (!empty($list_procuct_banchay)) { ?>
    <section class="section-product  pb-5 sm:pb-11 ">
        <div class="grid_s wide ">
            <div class="rounded-xl sm:rounded-[32px] bg-[rgba(0,_78,_171,_0.10)] px-3 sm:px-[47px] pt-9 pb-9 ">
                <div class="w-full text-center flex flex-wrap justify-center">
                    <?php if (!empty($info_product_banchay_index["ten"])) { ?>
                        <div class="<?= $class_title_main ?>   w-full">
                            <span class="text-[var(--html-bg-website)]">
                                <?= $info_product_banchay_index["ten"] ?>
                            </span>
                        </div>
                    <?php } ?>
                    <?php if (!empty($info_product_banchay_index["mota"])) { ?>
                        <div class="mt-2 <?= $class_content_main ?>">
                            <span class="line-clamp-6">
                                <?= htmlspecialchars_decode($info_product_banchay_index["mota"]) ?>
                            </span>
                        </div>
                    <?php } ?>
                </div>
                <div class="owl-carousel form_product_banchay_main owl-theme mt-7">
                    <?= $this->getTemplateLayoutsFor([
                        'name_layouts' => 'gridTemplateProduct2',
                        'seoHeading' => 'h5',
                        'class' => '',
                        'data' => $list_procuct_banchay,
                        'bgWhite' => true,
                    ]) ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>

<!-- sản phẩm -->
<?php if (!empty($list_c1_procuct)) { ?>
    <section class="section-product  pb-5 sm:pb-11 ">
        <div class="grid_s wide ">
            <div class="form_product_index rounded-xl sm:rounded-[32px] bg-white px-3 sm:px-[47px] pt-5 sm:pt-8 pb-8 ">
                <div class="w-full flex justify-center items-center">
                    <?php if (count($list_c1_procuct) > 3  || ($deviceType == "phone")) { ?>
                        <div class="w-[calc(100%-80px)]">
                            <div class=" owl-carousel form_dm_product_index owl-theme">
                                <?php foreach ($list_c1_procuct as $key_c1 => $value_c1) { ?>
                                    <div class="flex justify-center">
                                        <button class="group [&.on]:font-bold  relative border-none h-full flex items-center outline-none  py-1 text-[#3C3C3C] text-center text-sm sm:text-base md:text-xl font-normal font-main-400 btn_product_index <?= ($key_c1 == 0) ? "on" : "" ?>" data-nb="dmc1_product_<?= $value_c1['id'] ?>">
                                            <span>
                                                <?= $value_c1['ten'] ?>
                                            </span>
                                            <div class="absolute group-[&.on]:w-full bottom-0 left-0 border-t-2 border-[#3C3C3C] w-[28px] transition-all duration-300"></div>
                                        </button>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="w-full flex flex-wrap items-center justify-center gap-3 sm:gap-5 md:gap-7 lg:gap-[70px]">
                            <?php foreach ($list_c1_procuct as $key_c1 => $value_c1) { ?>
                                <div class="flex justify-center">
                                    <button class="group [&.on]:font-bold  relative border-none h-full flex items-center outline-none  py-1 text-[#3C3C3C] text-center text-sm sm:text-base md:text-xl font-normal font-main-400 btn_product_index <?= ($key_c1 == 0) ? "on" : "" ?>" data-nb="dmc1_product_<?= $value_c1['id'] ?>">
                                        <span>
                                            <?= $value_c1['ten'] ?>
                                        </span>
                                        <div class="absolute group-[&.on]:w-full bottom-0 left-0 border-t-2 border-[#3C3C3C] w-[28px] transition-all duration-300"></div>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="mt-7">
                    <?php foreach ($list_c1_procuct as $key_c1 => $value_c1) {
                        $list_procuct = $cache->getCache("select id,type, ten_$lang as ten , tenkhongdau_$lang as tenkhongdau,photo,photo2,giaban,masp,banchay from #_baiviet where type=? and ((banchay IS NULL) or (banchay <> 1)) and noibat=1 and id_list=? and hienthi=1 order by stt asc,id desc limit 0,$per_page_index", array("san-pham", $value_c1['id']), 'result', _TIMECACHE);
                        $count_product = $cache->getCache("select COUNT(id) as total from #_baiviet where type=? and ((banchay IS NULL) or (banchay <> 1)) and noibat=1 and id_list=? and hienthi=1 order by stt asc,id desc", array("san-pham", $value_c1['id']), 'fetch', _TIMECACHE);
                    ?>
                        <div class="w-full data_product_index  <?= ($key_c1 == 0) ? "" : "hidden" ?>" data-nb="dmc1_product_<?= $value_c1['id'] ?>">
                            <div class="w-full grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-3 lg:gap-5" id="<?= "product_items_index_" . $value_c1['id'] ?>">
                                <?= $this->getTemplateLayoutsFor([
                                    'name_layouts' => 'gridTemplateProduct2',
                                    'seoHeading' => 'h5',
                                    'class' => '',
                                    'data' => $list_procuct,
                                ]) ?>
                            </div>
                            <?php if ($count_product['total'] > $per_page_index) { ?>
                                <div class="flex justify-center mt-2" id="paging_index_<?= $value_c1['id'] ?>">
                                    <?= $this->getTemplateLayoutsFor([
                                        'name_layouts' => 'loadMoreIndex',
                                        'formHandle' => "product",
                                        'formItems' => "product_items_index_" . $value_c1['id'],
                                        'formPaging' => "paging_index_" . $value_c1['id'],
                                        'total' => $count_product['total'],
                                        'numberItems' => $per_page_index,
                                        'pagingCurrent' => 2,
                                        'layoutsItems' => "gridTemplateProduct2",
                                        'seoHeading' => "h6",
                                        'select' => "id,type, ten_$lang as ten , tenkhongdau_$lang as tenkhongdau,photo,photo2,giaban,masp,banchay",
                                        'where' => "where type=? and ((banchay IS NULL) or (banchay <> 1)) and noibat=1 and id_list=? and hienthi=1 order by stt asc,id desc",
                                        'type' => $value_c1['type'],
                                        'id_list' => $value_c1['id'],
                                        'id_cat' => "",
                                        'id_item' => "",
                                        'id_sub' => "",
                                        'title' => "sản phẩm",
                                    ]) ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>

<!-- Đăng ký -->
<section class="section-client pb-5 sm:pb-11 ">
    <div class="grid_s wide ">
        <div class="w-full  ">
            <div class="w-full flex flex-wrap  gap-[18px]">
                <div class="flex-initial w-full lg:w-1/2  rounded-xl sm:rounded-[32px] bg-white px-3 sm:px-[20px] pt-[39px] pb-[28px]">
                    <div class=" mb-5 sm:mb-7">
                        <a href="<?= $func->getType('tin-tuc'); ?>" title="<?= "TIN TỨC" ?>" class=" <?= $class_title_main ?>">
                            <?= "TIN TỨC" ?>
                        </a>
                    </div>
                    <div class=" form_blogs_main " style="margin-bottom: 0px;">
                        <?php foreach ($list_blogs as $key => $value) { ?>
                            <div class="slide-item mb-5">
                                <?= $this->getTemplateLayoutsFor([
                                    'name_layouts' => 'gridTemplateNews6',
                                    'seoHeading' => 'h3',
                                    'data' => [$value],
                                ]) ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="flex-1 rounded-xl sm:rounded-[32px] bg-white px-3 sm:px-[28px] pt-[39px] pb-[28px] border border-[var(--html-sc-website)]">
                    <div class="w-full text-center ">
                        <div class="w-full  flex justify-center items-center <?= $class_title_main ?> gap-2 ">
                            <span class="flex-initial ">
                                <?= $info_client_index["ten"] ?>
                            </span>
                        </div>
                        <div class="mt-2 <?= $class_content_main ?>">
                            <span class="line-clamp-6 ">
                                <?= htmlspecialchars_decode($info_client_index["mota"]) ?>
                            </span>
                        </div>
                    </div>
                    <div class="mt-5">
                        <form action="" method="POST" name="form_client" id="client" class="form_client w-full flex flex-wrap items-start gap-3 " enctype="multipart/form-data">
                            <div class="w-full grid grid-cols-1 gap-[15px]">
                                <?= $this->getTemplateLayoutsFor([
                                    'name_layouts' => 'input_web',
                                    'class_form' => 'w-full',
                                    'label' => "Họ Và Tên",
                                    'placeholder' => "Nhập Họ Và Tên",
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
                                <?= $this->getTemplateLayoutsFor([
                                    'name_layouts' => 'input_web',
                                    'class_form' => 'w-full',
                                    'label' => "Địa chỉ",
                                    'placeholder' => "Nhập Địa chỉ",
                                    'id' => 'address',
                                    'data' => 'data[address]',
                                    'value' => '',
                                    'type' => 'text',
                                    'save_cache' => false,
                                    'required' => true,
                                    'readonly' => false,
                                    'function' => '',
                                    'form' => false,
                                ]); ?>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-[15px]">
                                    <?= $this->getTemplateLayoutsFor([
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
                                    <?= $this->getTemplateLayoutsFor([
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
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-[15px]">
                                    <?= $this->getTemplateLayoutsFor([
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
                                        <div class="form_captcha_js flex justify-center items-center w-full h-[50px] rounded-md border border-[var(--html-bg-website)] bg-white pl-2 pr-3">
                                            <div class="flex-initial code_captcha rounded "></div>
                                            <div class="flex-1"></div>
                                            <div class="h-[28px] inline-flex justify-center items-center rounded-[50%] overflow-hidden cursor-pointer aspect-[1/1] btn_captcha_js [&.on]:animate-load-captcha" data-name="captcha_price_quote" data-size="80x18">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="none">
                                                    <path d="M10.1791 1.89692C12.6208 1.89692 14.7918 3.06403 16.1711 4.87769L13.9492 7.11346H19.6044V1.42269L17.5133 3.52698C15.7866 1.37717 13.1428 0 10.1791 0C4.97373 0 0.753906 4.24641 0.753906 9.48462H2.63895C2.63895 5.29405 6.01481 1.89692 10.1791 1.89692ZM17.7193 9.48462C17.7193 13.6752 14.3435 17.0723 10.1791 17.0723C7.73755 17.0723 5.56648 15.9052 4.18728 14.0916L6.40905 11.8558H0.753906V17.5465L2.84502 15.4423C4.57171 17.5921 7.21545 18.9692 10.1791 18.9692C15.3845 18.9692 19.6044 14.7228 19.6044 9.48462H17.7193Z" fill="#3C3C3C" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?= $this->getTemplateLayoutsFor([
                                    'name_layouts' => 'textarea_web',
                                    'class_form' => 'w-full',
                                    'class' => "",
                                    'label' => "Nội Dung",
                                    'placeholder' => "Nhập Nội Dung",
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
                                <div class="w-full flex items-center justify-center mt-5">
                                    <button type="submit" name="submit-resgister-client" class="w-full max-w-[184px] uppercase h-[50px] bg-[var(--html-sc-website)] hover:bg-[var(--html-bg-website)] transition-all duration-300 text-base font-bold font-main-700 text-white text-center px-7 rounded-lg flex justify-center items-center gap-3">
                                        <span>GỬI</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="17" viewBox="0 0 18 17" fill="none">
                                            <g clip-path="url(#clip0_33_315)">
                                                <path d="M15.664 8.08575V14.5543H1.73166V1.61715H8.69784V0H-0.0098877V16.1715H17.4056V8.08575H15.664Z" fill="currentColor" />
                                                <path d="M10.4466 0L12.9544 2.3287L8.0177 6.91278L9.96823 8.72398L14.9049 4.1399L17.4128 6.4686V0H10.4466Z" fill="currentColor" />
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>