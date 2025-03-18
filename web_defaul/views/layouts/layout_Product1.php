<!-- sản phẩm nổi bật -->
<?php if (!empty($list_c1_procuct)) { ?>
    <?php
    // sản phẩm nổi bật
    $list_c1_procuct = $cache->getCache("select id,type, ten_$lang as ten , tenkhongdau_$lang as tenkhongdau from #_baiviet_list where type=? and  hienthi=1 order by stt asc", array('san-pham'), 'result', _TIMECACHE);

    $check_c2 = true;
    foreach ($list_c1_procuct as $key_c1 => $value_c1) {
        $list_product_c2 = $cache->getCache("select id,id_list,type , ten_$lang as ten , tenkhongdau_$lang as tenkhongdau  from #_baiviet_cat where type=? and id_list=? and hienthi=1 order by stt asc", array($value_c1['type'], $value_c1['id']), 'result', _TIMECACHE);
        $list_product_nb = $cache->getCache("select id  from #_baiviet where noibat=1 and type=? and id_list=? and hienthi=1 order by stt asc limit 0,2", array($value_c1['type'], $value_c1['id']), 'result', _TIMECACHE);
        if (!empty($list_product_nb)) {
            if (empty($list_product_c2)) {
                $check_c2 = false;
                $list_product = $cache->getCache("select id,type , ten_$lang as ten , tenkhongdau_$lang as tenkhongdau,photo,giaban,giacu  from #_baiviet where noibat=1 and type=? and id_list=? and hienthi=1 $orderbyForProduct ", array($value_c1['type'], $value_c1['id']), 'result', _TIMECACHE);
            }
    ?>
            <section class="section-product  form_product_nb_main pt-4 sm:pt-8 pb-4 sm:pb-8 bg-white   ">
                <div class="grid_s wide  ">
                    <div class="wow fadeInDown" data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="0.2s">
                        <div class="text-center mb-5 md:mb-10">
                            <a href="<?= $func->getUrl($value_c1) ?>" title="<?= $value_c1['ten'] ?>" class=" <?= $class_title_main ?>">
                                <?= $value_c1['ten'] ?>
                            </a>
                        </div>
                        <div class="w-full mb-5 md:mb-10 overflow-y-hidden overflow-x-auto scroll-design-one">
                            <div class="flex text-nowrap items-center gap-4">
                                <div class="flex-1"></div>
                                <?php
                                $check_list_product = 0;
                                if ($check_c2) { ?>
                                    <?php foreach ($list_product_c2 as $key_c2 => $value_c2) {
                                        $list_product = $cache->getCache("select id from #_baiviet where noibat=1 and type=? and id_cat=? and hienthi=1 $orderbyForProduct ", array($value_c1['type'], $value_c2['id']), 'result', _TIMECACHE);
                                        if (!empty($list_product)) {
                                    ?>
                                            <?php if ($check_list_product != 0) { ?>
                                                <div class="h-4 border-l-2 border-gray-300"></div>
                                            <?php } ?>
                                            <a href="<?= $jv0 ?>" title="<?= $value_c2['ten'] ?>" class="<?= ($key_c2 == 0) ? "on" : "" ?> text-black hover:text-[var(--html-bg-website)] [&.on]:text-[var(--html-bg-website)] text-nowrap text-sm sm:text-base font-normal font-main-400 transition-all duration-300 py-2 btn_product_nb_main" data-nb="product_main_<?= $key_c2 . $key_c1 ?>">
                                                <span>
                                                    <?= $value_c2['ten'] ?>
                                                </span>
                                            </a>
                                        <?php $check_list_product++;
                                        } ?>
                                    <?php } ?>
                                <?php } ?>
                                <div class="flex-1"></div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if ($check_c2) {
                        $list_data_product = $list_product_c2;
                    } else {
                        $list_data_product = [["data" => ""]];
                    }
                    ?>
                    <div class="mt-5">
                        <?php
                        $check_list_product = 0;
                        foreach ($list_data_product as $key_data_product => $value_data_product) { ?>
                            <?php
                            if ($check_c2) {
                                $list_product = $cache->getCache("select id,type , ten_$lang as ten , tenkhongdau_$lang as tenkhongdau,photo,giaban,giacu from #_baiviet where noibat=1 and type=? and id_list=? and id_cat=? and hienthi=1 order by stt asc", array($value_c1['type'], $value_data_product['id_list'], $value_data_product['id']), 'result', _TIMECACHE);
                            }
                            if (!empty($list_product)) {
                            ?>
                                <div class="w-full <?= ($check_list_product == 0) ? "" : "hidden" ?> opacity_animaiton data_product_nb_main" data-nb="product_main_<?= $key_data_product . $key_c1 ?>">
                                    <div class="owl-carousel form_product_main owl-theme">
                                        <?= $sample->getTemplateLayoutsFor([
                                            'name_layouts' => 'gridTemplateProduct1',
                                            'seoHeading' => 'h5',
                                            'data' => $list_product,
                                        ]) ?>
                                    </div>
                                    <div class=" mt-3 sm:mt-7 flex justify-center items-center">
                                        <a href="<?= $func->getUrl($value_c1) ?>" title="<?= $value_c1['ten'] ?>" class=" inline-flex justify-center items-center leading-none h-10 rounded-full px-8 bg-[var(--html-bg-website)] text-white text-sm font-semibold font-main-600 text-center hover:brightness-110 gap-2 transition-all duration-300">
                                            <span>Xem Tất Cả</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                                <path d="M16.1798 11.5791L10.8158 6.21511L12.23 4.8009L20.0082 12.5791L12.23 20.3572L10.8158 18.943L16.1798 13.5791H4.00818V11.5791H16.1798Z" fill="white" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            <?php $check_list_product++;
                            } ?>
                        <?php } ?>
                    </div>
                </div>
            </section>
        <?php } ?>
    <?php } ?>
<?php } ?>