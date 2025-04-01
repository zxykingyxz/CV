<?php
if (!empty($_SESSION['attribute'])) {
    unset($_SESSION['attribute']);
}
?>

<section class="section-product-detail" id="detail-product">
    <div class="grid_s wide">
        <form method="post" data-role="add-to-cart" enctype="multipart/form-data" onsubmit="return false" name="product-detail-<?= $row_detail['id'] ?>" id="product-detail-<?= $row_detail['id'] ?>">
            <input type="hidden" name="src" value="addCart">
            <input type="hidden" name="pid" value="<?= $row_detail['id'] ?>">
            <div class="flex flex-wrap mt-5 mb-5 gap-3">
                <div class="w-full sm:w-8/12 lg:w-9/12 flex flex-col gap-3 ">
                    <div class="bg_form_all w-full flex flex-wrap gap-5">
                        <div class=" w-full sm:w-6/12 ">
                            <div class="form_img_product_detail">
                                <?= $sample->getTemplateLayoutsFor([
                                    'name_layouts' => 'templateImagesDetail',
                                    'data' => $row_detail,
                                    'photos' => $photos,
                                    'watermark' => false,
                                ]) ?>
                            </div>
                        </div>
                        <div class=" flex-1 ">
                            <div class="flex">
                                <div class="flex-1  ">
                                    <?= $sample->getTemplateLayoutsFor([
                                        'name_layouts' => 'titleSeo',
                                        'title' => $titleContainer,
                                        'class' => 'title_detail',
                                        'banner_tpl' => $banner_tpl,
                                    ]); ?>
                                </div>
                                <?php if ($config['function']['product_liked'] == true) { ?>
                                    <div class="flex-initial btn-linkP btn-link  <?= (!empty($_SESSION['product_liked']) && in_array($row_detail['id'], $_SESSION['product_liked'])) ? "active" : "" ?>" data-id="<?= $row_detail['id'] ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" fill="#fff" stroke="#000" stroke-width="2" />
                                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" fill="#fff" />
                                        </svg>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="mt-3">
                                <span class="desc-span color-rating"><?= $func->getRatingComment($row_detail['rating']) ?></span>
                                <span class="text-xs font-main mr-1">(<?= (!empty($row_detail['rating']) ? $row_detail['rating'] : 5) ?>/5)</span>
                                <span class=" mr-1 text-gray-600">
                                    <i class="fa fa-eye ml-2"></i>
                                    <span class=" text-sm mr-1">
                                        <?= $row_detail['luotxem'] ?>
                                    </span>
                                </span>
                            </div>
                            <div class="mt-3 grid grid-cols-1 ">
                                <?php if (!empty($list_detail)) { ?>
                                    <div class="py-2 text-black text-sm font-normal font-main-400  border-b border-[#99999945] ">
                                        <div class="">
                                            <i class="fa-regular fa-square-check mr-1 text-[var(--html-bg-website)]"></i>
                                            &nbsp;<?= _danhmuc ?>: <a href="<?= $func->getUrl($list_detail) ?>" class="desc_span"><?= ($list_detail["ten_$lang"] != '') ? $list_detail["ten_$lang"] : _dangcapnhat . '...' ?></a>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="py-2 text-black text-sm font-normal font-main-400 border-b border-[#99999945]">
                                    <div class="">
                                        <i class="fa-regular fa-square-check mr-1 text-[var(--html-bg-website)]"></i>
                                        &nbsp;<?= _masanpham ?>: <span class="desc_span"><?= ($row_detail['masp'] != '') ? $row_detail['masp'] : 'Đang cập nhật...' ?></span>
                                    </div>
                                </div>
                                <div class="py-2 text-black text-sm font-normal font-main-400 border-b border-[#99999945]">
                                    <div class="">
                                        <i class="fa-regular fa-square-check mr-1 text-[var(--html-bg-website)]"></i>
                                        &nbsp;<?= _tinhtrang ?>: <span class="desc_span"><?= ($row_detail['id_loai'] == 1) ? 'Còn Hàng' : "Hết Hàng" ?></span>
                                    </div>
                                </div>
                                <div class="py-2 text-black text-sm font-normal font-main-400 price_product_js">
                                    <?= $sample->getTemplateLayoutsFor([
                                        'name_layouts' => 'templatePrice',
                                        'product' => $row_detail,
                                        'giaban' => $row_detail['giaban'],
                                        'giabansale' => $row_detail['giabansale'],
                                        'giacu' => $row_detail['giacu'],
                                    ]);
                                    ?>
                                </div>
                                <?php if (($config['cart']['turn_on'] == true) && $deviceType == 'phone') { ?>
                                    <div class="block sm:hidden py-1 text-black text-sm font-normal font-main-400 border-b border-[#99999945]">
                                        <?php if (($config['cart']['cart_advance'] == true)) {  ?>
                                            <?= $sample->getTemplateLayoutsFor([
                                                'name_layouts' => 'templateAttribute',
                                                'data_attribute' => $data_attribute,
                                                'row_detail' => $row_detail,
                                            ]); ?>
                                        <?php } ?>
                                        <div class="bg-blue-50 p-2 rounded  ">
                                            <?= $sample->getTemplateLayoutsFor([
                                                'name_layouts' => 'button_detail_cart',
                                                'id' => $row_detail['id'],
                                            ]) ?>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if (!empty($row_detail["mota_$lang"])) { ?>
                                    <div class="mt-2">
                                        <div class="text-xl capitalize font-main font-bold text-gray-800 px-2 py-1  bg-[#cccccc39]  ">
                                            <?= _mota ?>
                                        </div>
                                        <div class="text-[13px] font-main content mt-2">
                                            <span>
                                                <?= $func->htmlDecodeContent($row_detail["mota_$lang"]) ?>
                                            </span>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="mt-2 grid grid-cols-1 sm:grid-cols-2 gap-2">
                                    <div class="w-full">
                                        <a class="bg-[var(--html-bg-website)] rounded px-2 py-2 block text-center text-white font-main hover:brightness-95 transition-all duration-300" target="_blank" href="https://zalo.me/<?= $func->handlePhoneNumberUrl($row_setting['sozalo']) ?>">
                                            <p class="mb-1"> <i class="fa fa-comment"></i> <?= _chatzalo ?>
                                            </p>
                                            <p class="mb-0 text-xs"><?= _giaidaphotrongaytucthi ?></p>
                                        </a>
                                    </div>
                                    <div class="w-full">
                                        <a class="bg-[var(--html-bg-website)] rounded px-2 py-2 block text-center text-white font-main hover:brightness-95 transition-all duration-300" target="_blank" href="https://m.me/<?= $row_setting['linkmessage'] ?>">
                                            <p class="mb-1"> <i class="fab fa-facebook"></i>
                                                <?= _chatfacebook ?></p>
                                            <p class="mb-0 text-xs"><?= _giaidaphotrongaytucthi ?></p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg_form_all w-full">
                        <div class="">
                            <div class="text-xl capitalize font-main font-bold text-gray-800 px-2 py-1 bg-[#cccccc39]">
                                <span>
                                    <?= _chitietsanpham ?>
                                </span>
                            </div>
                            <div class="relative mt-2">
                                <div class="wrapper-toc">
                                    <div class="content zoom-detail">
                                        <?php if (($row_detail["noidung_$lang"] != '')) { ?>
                                            <?= $func->htmlDecodeContent($row_detail["noidung_$lang"]) ?>
                                        <?php } else { ?>
                                            <?= $sample->getTemplateLayoutsFor([
                                                'name_layouts' => 'form_nocontent',
                                                'class' => '',
                                            ]) ?>
                                        <?php } ?>
                                    </div>
                                    <?php if ($row_detail["noidung_$lang"] != '') { ?>
                                        <div class="mt-5">
                                            <?= $sample->getTemplateLayoutsFor([
                                                'name_layouts' => 'shareLinks',
                                            ]) ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-1 ">
                    <div class="sticky top-[var(--value-top-fixed)] left-0 grid grid-cols-1 gap-2 sm:gap-3 lg:gap-4">
                        <?php if (($config['cart']['turn_on'] == true) && $deviceType != 'phone') { ?>
                            <div class="bg_form_all hidden sm:block ">
                                <?php if (($config['cart']['cart_advance'] == true)) {  ?>
                                    <?= $sample->getTemplateLayoutsFor([
                                        'name_layouts' => 'templateAttribute',
                                        'data_attribute' => $data_attribute,
                                        'row_detail' => $row_detail,
                                    ]);
                                    ?>
                                <?php } ?>
                                <div class="bg-blue-50 p-2 rounded  ">
                                    <?= $sample->getTemplateLayoutsFor([
                                        'name_layouts' => 'button_detail_cart',
                                        'id' => $row_detail['id'],
                                    ]) ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?= $sample->getTemplateLayoutsFor([
                            'name_layouts' => 'clientSupport',
                            'class' => ' bg_form_all',
                        ]) ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<?php if (count($tintuc) > 0) { ?>
    <section class="mb-5 mt-5">
        <div class="grid_s wide">
            <div class="bg_form_all">
                <div class="flex mb-3">
                    <div class="text-lg sm:text-xl font-main capitalize font-bold text-gray-800 px-2 py-1 relative flex-1">
                        <span><?= _sanphamlienquan ?></span>
                    </div>
                    <a href="<?= $func->getType($com) ?>" title="<?= _xemthem ?>" aria-label="<?= _xemthem ?>" role="link" rel="dofollow" class="text-base font-main font-medium text-[var(--html-bg-website)] capitalize inline-flex justify-center items-center gap-1">
                        <span>
                            <?= _xemthem ?>
                        </span>
                        <i class="fas fa-angle-double-right font-medium"></i>
                    </a>
                </div>
                <div class="owl-carousel form_product_detail owl-theme ">
                    <?= $sample->getTemplateLayoutsFor([
                        'name_layouts' => $layouts,
                        'seoHeading' => 'h3',
                        'data' => $tintuc,
                        'class' => 'no_shadow',
                    ]); ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>



<?php
if (!empty($flash_sale)) {
    $additional = (!empty($row_detail['id']) && !empty($flash_sale['id_product']) && in_array($row_detail['id'], explode(',', $flash_sale['id_product']))) ? 1 : 0;
}
$seoDB = $seo->getSeoDB($row_detail['id'], 'baiviet', 'man', $row_detail["type"]);
$desc = (isset($seoDB["description_$lang"])) ? $seoDB["description_$lang"] : $seoDB["description"];
$price_tmp =  ($additional == 1) ? $row_detail['giabansale'] : $row_detail['giaban'];

$productSchema = $func->buildSchemaProduct(
    $row_detail['id'],
    (isset($row_detail["ten_$lang"])) ? $row_detail["ten_$lang"] : $row_detail["ten"],
    _upload_baiviet_l . ((isset($row_detail["photo_$lang"])) ? $row_detail["photo_$lang"] : $row_detail["photo"]),
    $desc,
    $row_detail['masp'],
    $name_brand,
    $name_author,
    $https_config . '/' . $com . '/' . ((isset($row_detail["tenkhongdau_$lang"])) ? $row_detail["tenkhongdau_$lang"] : $row_detail["tenkhongdau"]),
    $func->changeMoney($price_tmp, $lang)
);

?>

<script type="application/ld+json">
    <?php echo $productSchema; ?>
</script>