<?php
global $logo;
// order by
$orderbyForProduct = $func->getOrderByTypeFor('san-pham');
$orderbyForService = $func->getOrderByTypeFor('dich-vu');
$orderbyForTips = $func->getOrderByTypeFor('meo-thu-cung');


$class_title_sup_main = "text-[#3D3A3A] text-sm sm:text-base font-bold font-main-600";
$class_title_main = "text-[20px] sm:text-[32px] text-black font-bold font-main-700";
$class_content_main = "text-[#3D3A3A] text-xs sm:text-sm leading-[1.78] sm:leading-[1.78] font-normal font-main-400";

// banner dưới menu
$banner_under_menu = $cache->getCache("select  ten_$lang as ten ,link,photo from #_bannerqc where type=? and hienthi=1", array('banner-under-menu'), 'fetch', _TIMECACHE);

// danh mục sản phẩm
$list_c1_procuct = $cache->getCache("select id,type, ten_$lang as ten , tenkhongdau_$lang as tenkhongdau,photo from #_baiviet_list where type in ('dien-tu','dien-lanh','do-gia-dung','hang-trung-bay') and hienthi=1 order by stt asc", array(), 'result', _TIMECACHE);

// chương trình khuyến mãi
$banner_sale_product = $cache->getCache("select  ten_$lang as ten ,link,photo from #_bannerqc where type=? and hienthi=1", array('banner-sale-product'), 'fetch', _TIMECACHE);

$banner_sale_main = $cache->getCache("select ten_$lang as ten ,photo from #_photo where type=? and hienthi=1 order by stt asc limit 0,3", array('banner-sale-main'), 'result', _TIMECACHE);

$list_flashsale = $cache->getCache("select id, ten_$lang as ten ,id_product,photo from #_flashsale where hienthi=1 order by stt asc", array(), 'result', _TIMECACHE);

// banner sản phảm
$banner_product_main = $cache->getCache("select ten_$lang as ten ,photo from #_photo where type=? and hienthi=1 order by stt asc limit 0,2", array('banner-product'), 'result', _TIMECACHE);

// sản phẩm nổi bật
$list_c1_procuct_nb = $cache->getCache("select id,type, ten_$lang as ten , tenkhongdau_$lang as tenkhongdau,photo from #_baiviet_list where type in ('dien-tu','dien-lanh','do-gia-dung','hang-trung-bay') and hienthi=1 order by stt asc", array(), 'result', _TIMECACHE);

// banner dưới sản phẩm
$banner_under_product = $cache->getCache("select ten_$lang as ten,photo from #_bannerqc where type=? and hienthi=1 order by stt asc ", array('banner-under-product'), 'fetch', _TIMECACHE);

// slider dưới sản phảm
$slider_under_product = $cache->getCache("select ten_$lang as ten ,photo from #_photo where type=? and hienthi=1 order by stt asc limit 0,4", array('banner-under-product'), 'result', _TIMECACHE);

// tin tức
$list_blogs = $cache->getCache("select id,type,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,photo from #_baiviet where noibat=1 and type=? and hienthi=1 order by stt asc", array('tin-tuc'), 'result', _TIMECACHE);

// mọi người tìm kiếm
$list_c2 = $cache->getCache("select id,type,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau from #_baiviet_cat where type in ('dien-tu','dien-lanh','do-gia-dung','hang-trung-bay') and hienthi=1 order by stt asc", array(), 'result', _TIMECACHE);

?>

<!-- banner dưới menu -->
<?php if (!empty($banner_under_menu)) { ?>
    <section class="section-banner py-3 sm:py-6">
        <div class="grid_s_news wide form_nb">
            <div class="w-full relative data_nb" data-nb="banner_under_menu">
                <div class="absolute top-1 right-1 cursor-pointer  z-10 btn_nb on" data-nb="banner_under_menu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" fill="#979797" />
                        <path d="M15 9L9 15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9 9L15 15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="w-full overflow-hidden aspect-[1360/250]">
                    <?= $func->addHrefImg([
                        'addhref' => true,
                        'href' => !empty($banner_under_menu["link"]) ? $banner_under_menu["link"] : $jv0,
                        'target' => !empty($banner_under_menu["link"]) ? '_blank' : "",
                        'sizes' => '1360x250x1',
                        'actual_width' => 1700,
                        'upload' => _upload_hinhanh_l,
                        'image' => ($banner_under_menu["photo"]),
                        'alt' => $banner_under_menu["ten"],
                    ]); ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>

<!-- danh mục sản phẩm -->
<?php if (!empty($list_c1_procuct)) { ?>
    <section class="section-banner pb-8 sm:pb-11">
        <div class="grid_s_news wide form_nb">
            <div class="w-full bg-white py-7 px-6 rounded-xl sm:rounded-[32px] overflow-hidden ">
                <div class="owl-carousel form_c1_procuct owl-theme">
                    <?php
                    $list_tmp = array();
                    foreach ($list_c1_procuct as $k => $v) {
                        $count_product = $cache->getCache("select COUNT(id) as total from #_baiviet where id_list=? and type in ('dien-tu','dien-lanh','do-gia-dung','hang-trung-bay') and hienthi=1 order by stt asc", array($v['id']), 'fetch', _TIMECACHE);
                        $v['total'] = $count_product['total'];
                        if (((($k + 1) % 2 === 0) && ($k != 0)) || (count($list_c1_procuct) == ($k + 1))) {
                            array_push($list_tmp, $v);
                    ?>
                            <div class="grid grid-cols-1 gap-3 md:gap-5 lg:gap-8">
                                <?php foreach ($list_tmp as $key => $value) { ?>
                                    <div class="w-full ">
                                        <div class="w-full inline-flex justify-center items-center">
                                            <div class="max-w-[70px]">
                                                <?= $func->addHrefImg([
                                                    'addhref' => true,
                                                    'href' =>  $func->getUrl($value),
                                                    'sizes' => '70x70x2',
                                                    'actual_width' => 400,
                                                    'upload' => _upload_baiviet_l,
                                                    'image' =>  $value["photo"],
                                                    'alt' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
                                                ]); ?>
                                            </div>
                                        </div>
                                        <div class="w-full text-center mt-2  ">
                                            <?php if ($source == 'index') { ?>
                                                <h3>
                                                <?php } ?>
                                                <a href="<?= $func->getUrl($value) ?>" title="<?= (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"] ?>" class="text-sm sm:text-base leading-normal sm:leading-normal h-[calc(14px*2*1.5)] sm:h-[calc(16px*2*1.5)] flex items-center justify-center line-clamp-2 font-bold font-main-700 text-black">
                                                    <span>
                                                        <?= (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"] ?>
                                                    </span>
                                                </a>
                                                <?php if ($source == 'index') { ?>
                                                </h3>
                                            <?php } ?>
                                        </div>
                                        <div class="w-full text-center text-sm font-medium font-main-500 text-black italic mt-1">
                                            <span class="">
                                                <?= "(" . $value['total'] . " sản phẩm)" ?>
                                            </span>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                    <?php
                            $list_tmp = array();
                        } else {
                            array_push($list_tmp, $v);
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
    </section>
<?php } ?>

<!-- chương trình khuyến mãi -->
<?php if (!empty($list_flashsale)) { ?>
    <section class="section-banner pb-8 sm:pb-14  ">
        <div class="grid_s_news wide form_nb">
            <div class="wow fadeInDown " data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="0.2s">
                <div class="text-center flex justify-center mb-8 sm:mb-12 gap-2 sm:gap-4 ">
                    <div class=" uppercase  <?= $class_title_main ?>">
                        <span>Chương Trình Khuyến Mãi</span>
                    </div>
                    <div>
                        <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 42 42" fill="none">
                                <path d="M13.2504 37.507C17.4226 39.6472 22.2221 40.2269 26.7839 39.1416C31.3457 38.0563 35.3699 35.3774 38.1313 31.5876C40.8927 27.7977 42.2097 23.1462 41.845 18.4713C41.4803 13.7964 39.4579 9.40538 36.1422 6.08965C32.8264 2.77393 28.4355 0.751482 23.7605 0.386774C19.0856 0.0220662 14.4341 1.33908 10.6443 4.10048C6.85442 6.86188 4.17549 10.8861 3.09019 15.4479C2.00489 20.0097 2.5846 24.8092 4.72486 28.9814L0.352783 41.879L13.2504 37.507Z" fill="#FF0D00" />
                            </svg>
                            <span class="absolute top-1/2 left-1/2 -translate-x-1/2 translate-y-[calc(-50%-2px)] text-[#FEE900] text-sm font-bold font-main-700">Hot</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form_flashsale w-full bg-white pt-3 pb-5 px-3 rounded-xl sm:rounded-[32px] overflow-hidden ">
                <div class="grid_s wide ">
                    <div class="w-full overflow-hidden rounded-lg sm:rounded-2xl leading-[0]">
                        <?= $func->addHrefImg([
                            'addhref' => true,
                            'href' => !empty($banner_sale_product["link"]) ? $banner_sale_product["link"] : $jv0,
                            'target' => !empty($banner_sale_product["link"]) ? '_blank' : "",
                            'sizes' => '1196x63x1',
                            'actual_width' => 1800,
                            'upload' => _upload_hinhanh_l,
                            'image' => ($banner_sale_product["photo"]),
                            'alt' => $banner_sale_product["ten"],
                        ]); ?>
                    </div>
                    <div class="mt-5 grid  grid-cols-1 md:grid-cols-3 gap-5">
                        <?php foreach ($banner_sale_main as $key => $value) { ?>
                            <div class="w-full overflow-hidden rounded-lg sm:rounded-2xl leading-[0]">
                                <?= $func->addHrefImg([
                                    'addhref' => true,
                                    'href' => !empty($value["link"]) ? $value["link"] : $jv0,
                                    'target' => !empty($value["link"]) ? '_blank' : "",
                                    'sizes' => '387x187x1',
                                    'actual_width' => 1000,
                                    'upload' => _upload_hinhanh_l,
                                    'image' => ($value["photo"]),
                                    'alt' => $value["ten"],
                                ]); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="mt-4 sm:mt-7 flex items-center overflow-x-auto overflow-y-hidden scroll-x">
                        <?php foreach ($list_flashsale as $key_dm => $value_dm) { ?>
                            <div class="w-2/12 min-w-[120px] aspect-[200/100] overflow-hidden bg-white border-b-2 border-[#EBE0E0] hover:border-[var(--html-bg-website)] hover:bg-[#FFFCD5] [&.on]:border-[var(--html-bg-website)] [&.on]:bg-[#FFFCD5] transition-all duration-300 btn_flashsale <?= ($key_dm == 0) ? "on" : "" ?>" data-nb="flashsale_<?= $key_dm ?>">
                                <?= $func->addHrefImg([
                                    'addhref' => true,
                                    'href' =>  $jv0,
                                    'sizes' => '200x100x2',
                                    'actual_width' => 500,
                                    'upload' => _upload_baiviet_l,
                                    'image' => ($value_dm["photo"]),
                                    'alt' =>  $value_dm["ten"],
                                ]); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="mt-4 sm:mt-7">
                        <?php foreach ($list_flashsale as $key_dm => $value_dm) {
                            $list_product_sale = $func->getProductsFlashsale($value_dm['id_product']);
                        ?>
                            <div class="w-full opacity_animaiton  <?= ($key_dm == 0) ? "" : "hidden" ?>  data_flashsale" data-nb="flashsale_<?= $key_dm ?>">
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-x-3 gap-y-4 sm:gap-y-9">
                                    <?= $this->getTemplateLayoutsFor([
                                        'name_layouts' => 'gridTemplateProduct2',
                                        'seoHeading' => 'span',
                                        'data' => array_slice($list_product_sale, 0, 12),
                                    ]) ?>
                                </div>
                                <?php if (count($list_product_sale) > 12) { ?>
                                    <div class="mt-9 flex justify-center items-center">
                                        <a href="<?= $func->getType('dien-tu') ?>" title="sản phẩm" class="group hover:text-[var(--html-bg-website)] inline-flex justify-center items-center gap-1 text-base font-bold font-main-700 transition-all duration-300">
                                            <span><?= "Xem thêm " . (count($list_product_sale) - 12) . " sản phẩm" ?></span>
                                            <svg class="group-hover:*:stroke-[var(--html-bg-website)] transition-all duration-300" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                                                <path d="M6.10571 17.1724L11.1057 12.1724L6.10571 7.17236" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M13.1057 17.1724L18.1057 12.1724L13.1057 7.17236" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>

<!-- banner sản phảm -->
<?php if (!empty($banner_product_main)) { ?>
    <section class="section-banner pb-8 sm:pb-14">
        <div class="grid_s_news wide form_nb">
            <div class="w-full relative grid grid-cols-1 md:grid-cols-2 gap-5">
                <?php foreach ($banner_product_main as $key => $value) { ?>
                    <div class="w-full overflow-hidden rounded-md sm:rounded-lg leading-[0] ">
                        <div class="zoom">
                            <?= $func->addHrefImg([
                                'addhref' => true,
                                'href' => !empty($value["link"]) ? $value["link"] : $jv0,
                                'target' => !empty($value["link"]) ? '_blank' : "",
                                'sizes' => '670x223x1',
                                'actual_width' => 1000,
                                'upload' => _upload_hinhanh_l,
                                'image' => ($value["photo"]),
                                'alt' => $value["ten"],
                            ]); ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>

<!-- sản phẩm nổi bật -->
<?php if (!empty($list_c1_procuct_nb)) { ?>
    <?php foreach ($list_c1_procuct_nb  as $key_dm_c1 => $value_dm_c1) {
        $list_product = $cache->getCache("select id,type,ten_$lang as ten,slogan,tenkhongdau_$lang as tenkhongdau,giaban,giacu,photo,photo2,text_new,installment,id_product_list  from #_baiviet where noibat=1 and type in ('dien-tu','dien-lanh','do-gia-dung','hang-trung-bay') and id_list=? and hienthi=1 order by stt asc", array($value_dm_c1['id']), 'result', _TIMECACHE);
        if (!empty($list_product)) {
    ?>
            <section class="section-product pb-8 sm:pb-14   ">
                <div class="grid_s_news wide form_nb overflow-hidden">
                    <div class="form_flashsale w-full bg-white pt-6 pb-5 px-3 rounded-xl sm:rounded-[32px] overflow-hidden ">
                        <div class="grid_s wide ">
                            <div class="wow fadeInDown " data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="0.2s">
                                <a href=" <?= $func->getUrl($value_dm_c1) ?>" title=" <?= $value_dm_c1['ten'] ?>" class=" uppercase  <?= $class_title_main ?>">
                                    <span>
                                        <?= $value_dm_c1['ten'] ?>
                                    </span>
                                </a>
                            </div>
                            <div class="mt-4 sm:mt-6">
                                <?= $this->getTemplateLayoutsFor([
                                    'name_layouts' => 'form_fillter_search_one',
                                    'type' => $value_dm_c1['type'],
                                    'idl' => $value_dm_c1['id'],
                                ]) ?>
                            </div>
                            <div class="mt-5">
                                <div class=" grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-x-3 gap-y-4 sm:gap-y-9">
                                    <?= $this->getTemplateLayoutsFor([
                                        'name_layouts' => 'gridTemplateProduct3',
                                        'seoHeading' => 'h3',
                                        'data' => array_slice($list_product, 0, 6),
                                    ]) ?>
                                </div>
                                <?php if (count($list_product) > 6) { ?>
                                    <div class="mt-9 flex justify-center items-center">
                                        <a href="<?= $func->getUrl($value_dm_c1) ?>" title="<?= $value_dm_c1['ten'] ?>" class="group hover:text-[var(--html-bg-website)] inline-flex justify-center items-center gap-1 text-base font-bold font-main-700 transition-all duration-300">
                                            <span><?= "Xem thêm " . (count($list_product) - 6) . " sản phẩm" ?></span>
                                            <svg class="group-hover:*:stroke-[var(--html-bg-website)] transition-all duration-300" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                                                <path d="M6.10571 17.1724L11.1057 12.1724L6.10571 7.17236" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M13.1057 17.1724L18.1057 12.1724L13.1057 7.17236" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>
    <?php } ?>
<?php } ?>

<!-- banner dưới sản phẩm -->
<?php if (!empty($banner_under_product)) { ?>
    <section class="section-banner pb-5 pt-3 sm:pt-7">
        <div class="grid_s_news wide ">
            <div class=" overflow-hidden rounded-2xl leading-[0]">
                <?= $func->addHrefImg([
                    'addhref' => true,
                    'href' => !empty($banner_under_product["link"]) ? $banner_under_product["link"] : $jv0,
                    'target' => !empty($banner_under_product["link"]) ? '_blank' : "",
                    'sizes' => '1360x430x1',
                    'actual_width' => 2000,
                    'upload' => _upload_hinhanh_l,
                    'image' => ($banner_under_product["photo"]),
                    'alt' => $banner_under_product["ten"],
                ]); ?>
            </div>
        </div>
    </section>
<?php } ?>

<!-- slider dưới sản phẩm -->
<?php if (!empty($slider_under_product)) { ?>
    <section class="section-banner pb-8 sm:pb-14">
        <div class="grid_s_news wide ">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5">
                <?php foreach ($slider_under_product as $key => $value) { ?>
                    <div class=" overflow-hidden rounded-2xl leading-[0]">
                        <?= $func->addHrefImg([
                            'addhref' => true,
                            'href' => !empty($value["link"]) ? $value["link"] : $jv0,
                            'target' => !empty($value["link"]) ? '_blank' : "",
                            'sizes' => '325x527x1',
                            'actual_width' => 1000,
                            'upload' => _upload_hinhanh_l,
                            'image' => ($value["photo"]),
                            'alt' => $value["ten"],
                        ]); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>

<!-- tin tức -->
<?php if (!empty($list_blogs)) { ?>
    <section class="section-blogs pb-8 sm:pb-14  ">
        <div class="grid_s_news wide ">
            <div class="w-full bg-white pt-6 pb-5 px-3 rounded-xl sm:rounded-[32px] overflow-hidden ">
                <div class="grid_s wide ">
                    <div class="wow fadeInDown " data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="0.2s">
                        <a href=" <?= $func->getType('tin-tuc') ?>" title=" <?= "Tin Tức" ?>" class=" uppercase  <?= $class_title_main ?>">
                            <span>
                                <?= "Tin Tức" ?>
                            </span>
                        </a>
                    </div>
                    <div class="mt-5 sm:mt-8 owl-carousel form_blogs owl-theme">
                        <?= $this->getTemplateLayoutsFor([
                            'name_layouts' => 'gridTemplateNews4',
                            'seoHeading' => 'h3',
                            'data' => $list_blogs,
                        ]) ?>
                    </div>
                    <div class="mt-8 flex justify-center items-center">
                        <a href="<?= $func->getType('tin-tuc') ?>" title="Tin tức" class="group hover:text-[var(--html-bg-website)] inline-flex justify-center items-center gap-1 text-base font-bold font-main-700 transition-all duration-300">
                            <span><?= "Xem tất cả" ?></span>
                            <svg class="group-hover:*:stroke-[var(--html-bg-website)] transition-all duration-300" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                                <path d="M6.10571 17.1724L11.1057 12.1724L6.10571 7.17236" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M13.1057 17.1724L18.1057 12.1724L13.1057 7.17236" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>

<!-- mọi người tìm kiếm -->
<?php if (!empty($list_c2)) { ?>
    <section class="section-people-search pb-8 sm:pb-[64px]  ">
        <div class="grid_s wide">
            <div class="wow fadeInDown " data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="0.2s">
                <a href=" <?= $jv0 ?>" title=" <?= "MỌI NGƯỜI CŨNG TÌM KIẾM" ?>" class=" uppercase  <?= $class_title_main ?>">
                    <span>
                        <?= "MỌI NGƯỜI CŨNG TÌM KIẾM" ?>
                    </span>
                </a>
            </div>
        </div>
        <div class="grid_s_news wide ">
            <div class="w-full mt-7 bg-white py-8 rounded-xl sm:rounded-[32px] overflow-hidden ">
                <div class="grid_s wide ">
                    <div class="flex flex-wrap gap-2">
                        <?php foreach ($list_c2 as $key => $value) { ?>
                            <a href="<?= $func->getUrl($value) ?>" title="<?= $value['ten'] ?>" class="bg-[#F2F4F7] py-2 px-3 rounded-full text-xs sm:text-sm text-nowrap font-normal font-main-400 text-black hover:text-white hover:bg-[var(--html-bg-website)] transition-all duration-300">
                                <?= $value['ten'] ?>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>