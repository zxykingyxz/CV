<?php
$title = "text-black  text-xs sm:text-[13px] leading-normal sm:leading-normal h-[calc(12px*1.5*2)] sm:h-[calc(13px*1.5*2)] font-main-500 font-medium group-hover/templateProduct_Five:text-[var(--html-bg-website)] line-clamp-2 transition-all duration-300 ";

foreach ($data as $key => $value) {
    $list_product_sub = $func->getProductsFlashsale($value['id_product_list']);
?>
    <div class="h-full ">
        <div class="group/templateProduct_Five load_website h-full overflow-hidden bg-white  flex flex-wrap flex-col transition-all duration-500   <?= $class ?> ">
            <div class='relative w-full aspect-[186/191] rounded overflow-hidden'>
                <div class=" w-full  bg-white transition-all duration-300 leading-[0] ">
                    <?= $func->addHrefImg([
                        'classfix' => 'w-full',
                        'addhref' => true,
                        'href' =>  $func->getUrl($value),
                        'isLazy' => true,
                        'sizes' => "186x191x1",
                        'actual_width' => 800,
                        'upload' => _upload_baiviet_l,
                        'image' => ($value["photo"]),
                        'alt' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
                    ]); ?>
                </div>
                <div class="absolute top-1 left-2 flex items-center">
                    <?php if (!empty($value['giaban']) && !empty($value['giacu'])) { ?>
                        <div class="py-2 px-2 text-[12px] leading-none text-red-600 font-medium font-main-500 rounded bg-red-100 ">
                            <span>
                                <?= ($value['giaban'] < $value['giacu']) ? "-" . floor((($value['giacu'] - $value['giaban']) / $value['giacu']) * 100) . "%" : "" ?>
                            </span>
                        </div>
                    <?php } ?>
                </div>
                <div class="absolute top-1 right-2 flex items-center">
                    <?php if (!empty($value['sale']) && ($value['sale'] == 1)) { ?>
                        <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" width="46" height="41" viewBox="0 0 46 41" fill="none">
                                <path d="M0.835815 4.49951C0.835815 2.29037 2.62668 0.499512 4.83582 0.499512H41.8443C44.0534 0.499512 45.8443 2.29037 45.8443 4.49951V27.2981C45.8443 28.8213 44.9792 30.2124 43.6129 30.8859L25.6778 39.7272C24.5897 40.2636 23.317 40.2772 22.2176 39.7642L3.14426 30.8632C1.73597 30.206 0.835815 28.7925 0.835815 27.2384V4.49951Z" fill="#A2DDFF" />
                            </svg>
                            <div class="absolute top-0 left-0 w-full h-full">
                                <div class="w-full flex items-center py-[2px] px-1">
                                    <div class="flex-1  text-[10px] leading-normal">
                                        <div class=" text-[var(--html-bg-website)]">
                                            <span>
                                                Mua
                                            </span>
                                        </div>
                                        <div class="text-white">
                                            <span>
                                                Tặng
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex-initial text-white text-2xl font-medium font-main-500">
                                        <span>
                                            1
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="mt-5 mb-2 px-2 flex-1 flex flex-wrap flex-col">
                <div>
                    <?= $func->addHref([
                        'class' => $title,
                        'href' => $func->getUrl($value),
                        'title' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
                        'seoHeading' => $seoHeading,
                    ]) ?>
                </div>
                <div class="flex-1 flex flex-wrap items-center gap-2 overflow-hidden max-h-[50px] mt-2">
                    <?php foreach ($list_product_sub as $key_sub => $value_sub) { ?>
                        <div class="py-1 px-2 text-[10px] leading-normal text-black bg-[#F2EDED] font-medium font-main-500 rounded ">
                            <span>
                                <?= $value_sub['title_sub'] ?>
                            </span>
                        </div>
                    <?php } ?>
                </div>
                <div class="mt-3">
                    <div class='text-[#DD2F2C] text-base sm:text-lg font-bold font-main-700 leading-none'>
                        <?= (($value['giaban']) != 0) ? $func->money($value['giaban']) . '<sup class="underline">đ</sup>' : 'Liên hệ' ?>
                    </div>
                </div>
                <div class="mt-2 flex items-center gap-3">
                    <del class='text-[#8A8888] text-[13px] leading-none font-normal font-main-400 h-4 block'>
                        <?= (($value['giacu']) != 0) ? $func->money($value['giacu']) . '<sup class="underline">đ</sup>' : ' ' ?>
                    </del>
                </div>
                <div class="mt-1 flex items-center gap-2">
                    <div class="flex-initial">
                        <span class='color-star' style='--rating:<?= $func->getRating($value['rating']) ?>'>
                        </span>
                    </div>
                    <div class="h-3 w-0 border-l border-gray-300"></div>
                    <div class="text-[10px] font-normal font-main-400 text-[#8A8888]">
                        <span><?= (!empty($value['luotxem']) ? $value['luotxem'] : 0) . " lượt mua" ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>