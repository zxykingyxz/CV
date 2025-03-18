<!-- sản phẩm nổi bật danh mục c1 -->
<?php if (!empty($list_c1_procuct)) { ?>
    <?php foreach ($list_c1_procuct  as $key_dm_c1 => $value_dm_c1) {
        // sản phẩm nổi bật
        $list_c1_procuct = $cache->getCache("select id,type, ten_$lang as ten , tenkhongdau_$lang as tenkhongdau,photo,icon, banner from #_baiviet_list where type=? and hienthi=1 $orderbyForProduct", array('san-pham'), 'result', _TIMECACHE);


        $list_product = $cache->getCache("select id,type, ten_$lang as ten ,hot, tenkhongdau_$lang as tenkhongdau,photo2,photo,masp,giaban,giacu from #_baiviet where noibat=1 and type=? and id_list=? and hienthi=1 $orderbyForProduct limit 0,$per_page_index", array($value_dm_c1['type'], $value_dm_c1['id']), 'result', _TIMECACHE);
        $list_c2_product = $cache->getCache("select id,type,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau from #_baiviet_cat where  type=? and id_list=? and hienthi=1 $orderbyForProduct", array($value_dm_c1['type'], $value_dm_c1['id']), 'result', _TIMECACHE);
        $count_product = $cache->getCache("select COUNT(id) as total from #_baiviet where noibat=1 and type=? and id_list=? and hienthi=1 $orderbyForProduct ", array($value_dm_c1['type'], $value_dm_c1['id']), 'fetch', _TIMECACHE);
        if (!empty($list_product)) {
    ?>
            <section class="section-product pb-8 sm:pb-14   ">
                <div class="grid_s wide ">
                    <div class="group/DMC2 relative z-10 w-full overflow-hidden rounded-2xl h-[320px] bg-gray-400" <?php if (!empty($value_dm_c1['banner'])) { ?> style="background: url(<?= _upload_baiviet_l . $value_dm_c1['banner'] ?>) no-repeat center/cover ;" <?php } ?>>
                        <div class="opacity-100 group-hover/DMC2:opacity-0 absolute top-0 left-0 w-full h-full transition-all duration-500" style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.60) 0%, rgba(0, 0, 0, 0.60) 100%);"></div>
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[937px] h-[calc(100%-30px)] max-w-[calc(100%-30px)]">
                            <div class="relative w-full h-full overflow-hidden rounded-lg px-3 sm:px-6 md:px-11 py-5 flex flex-wrap content-center items-center gap-3  group-hover/DMC2:backdrop-blur-[8px] backdrop-blur-0 transition-all duration-300">
                                <div class="opacity-0 group-hover/DMC2:opacity-55  absolute z-[-1] top-0 left-0 w-full h-full bg-[var(--html-bg-website)] transition-all duration-500"></div>
                                <div class="w-full flex justify-center items-center gap-3 ">
                                    <div class="flex-initial aspect-[1/1] w-8">
                                        <?= $func->addHrefImg([
                                            'addhref' => false,
                                            'sizes' => '32x32x2',
                                            'actual_width' => 200,
                                            'upload' => _upload_baiviet_l,
                                            'image' => ($value_dm_c1["icon"]),
                                            'alt' => (isset($value_dm_c1["ten_$lang"])) ? $value_dm_c1["ten_$lang"] : $value_dm_c1["ten"],
                                        ]); ?>
                                    </div>
                                    <div class="<?= $class_title_main ?>">
                                        <a href=" <?= $func->getUrl($value_dm_c1) ?>" title=" <?= $value_dm_c1['ten'] ?>" class=" text-white">
                                            <span>
                                                <?= $value_dm_c1['ten'] ?>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="h-[0px] group-hover/DMC2:h-[210px] overflow-hidden transition-all duration-500">
                                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-1 sm:gap-2 lg:gap-3 h-[210px] overflow-y-auto overflow-x-hidden scroll-design-one">
                                        <?php foreach ($list_c2_product  as $key_dm_c2 => $value_dm_c2) { ?>
                                            <div class="flex items-start gap-2">
                                                <div class="flex-initial">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                        <circle cx="9" cy="9" r="9" fill="white" />
                                                        <path d="M5.03998 9.42262L8.08613 12.24L12.96 5.76001" stroke="var(--html-bg-website)" />
                                                    </svg>
                                                </div>
                                                <div class="flex-1">
                                                    <a href=" <?= $func->getUrl($value_dm_c2) ?>" title=" <?= $value_dm_c2['ten'] ?>" class=" text-white text-xs sm:text-sm md:text-base font-normal font-main-400">
                                                        <span>
                                                            <?= $value_dm_c2['ten'] ?>
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 sm:mt-10">
                        <div class="w-full bg-white rounded-lg px-3 sm:px-5 md:px-8 pt-7 sm:pt-11 pb-4 sm:pb-8">
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4  gap-1 sm:gap-3 lg:gap-4" id="product_items_index_<?= $value_dm_c1['id'] ?>">
                                <?= $sample->getTemplateLayoutsFor([
                                    'name_layouts' => 'gridTemplateProduct2',
                                    'seoHeading' => 'h6',
                                    'data' => $list_product,
                                ]) ?>
                            </div>
                            <?php if ($count_product['total'] > $per_page_index) { ?>
                                <div class="" id="paging_index_<?= $value_dm_c1['id'] ?>">
                                    <?= $sample->getTemplateLayoutsFor([
                                        'name_layouts' => 'loadMoreIndex',
                                        'formHandle' => "product",
                                        'formItems' => "product_items_index_" . $value_dm_c1['id'],
                                        'formPaging' => "paging_index_" . $value_dm_c1['id'],
                                        'total' => $count_product['total'],
                                        'numberItems' => $per_page_index,
                                        'pagingCurrent' => 2,
                                        'layoutsItems' => "gridTemplateProduct2",
                                        'seoHeading' => "h6",
                                        'type' => $value_dm_c1['type'],
                                        'id_list' => $value_dm_c1['id'],
                                        'id_cat' => "",
                                        'id_item' => "",
                                        'id_sub' => "",
                                        'title' => "sản phẩm",
                                    ]) ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>
    <?php } ?>
<?php } ?>