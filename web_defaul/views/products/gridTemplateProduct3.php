<?php
$title = "text-black  text-xs sm:text-[13px] leading-normal sm:leading-normal h-[calc(12px*1.5*2)] sm:h-[calc(13px*1.5*2)] font-main-500 font-medium group-hover/templateProduct_Three:text-[var(--html-bg-website)] line-clamp-2 transition-all duration-300 ";

foreach ($data as $key => $value) {
    $list_product_sub = $func->getProductsFlashsale($value['id_product_list']);
?>
    <div class="h-full ">
        <div class="group/templateProduct_Three load_website h-full overflow-hidden bg-white border border-[#E1DEDE] hover:border-[var(--html-bg-website)] p-3 rounded-lg flex flex-wrap flex-col transition-all duration-500   <?= $class ?> ">
            <div class="flex flex-wrap items-center gap-2 h-6 overflow-hidden">
                <?php if (!empty($value['text_new'])) { ?>
                    <div class="py-1 px-2 text-[10px] leading-normal text-[#DD2F2C] font-medium font-main-500 rounded bg-[rgba(234,_4,_0,_0.10)]">
                        <span>
                            <?= "Mẫu Mới" ?>
                        </span>
                    </div>
                <?php } ?>
                <?php if (isset($value['installment'])) { ?>
                    <div class="py-1 px-2 text-[10px] leading-normal text-[#000] font-medium font-main-500 rounded bg-[#F2EDED]">
                        <span>
                            <?= "Trả góp " . $value['installment'] . "%" ?>
                        </span>
                    </div>
                <?php } ?>
            </div>
            <div class='relative w-full aspect-[510/510] overflow-hidden mt-5 '>
                <div class=" w-full absolute bg-white z-20 group-hover/templateProduct_Three:z-10 transition-all duration-300 ">
                    <?= $func->addHrefImg([
                        'classfix' => 'w-full',
                        'addhref' => true,
                        'href' =>  $func->getUrl($value),
                        'isLazy' => true,
                        'sizes' => "510x510x1",
                        'actual_width' => 800,
                        'upload' => _upload_baiviet_l,
                        'image' => ($value["photo"]),
                        'alt' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
                    ]); ?>
                </div>
                <?php if (!empty($value["photo2"])) { ?>
                    <div class=" w-full absolute bg-white z-10 group-hover/templateProduct_Three:z-20 transition-all duration-300">
                        <?= $func->addHrefImg([
                            'classfix' => 'w-full',
                            'addhref' => true,
                            'href' =>  $func->getUrl($value),
                            'isLazy' => true,
                            'sizes' => "510x510x1",
                            'actual_width' => 800,
                            'upload' => _upload_baiviet_l,
                            'image' => ($value["photo2"]),
                            'alt' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
                        ]); ?>
                    </div>
                <?php } ?>
            </div>
            <div class="mt-5 flex-1 flex flex-wrap flex-col">
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
                    <div class="text-[13px] text-[#DD2F2C] font-medium font-main-500 leading-tight">
                        <span>
                            <?= ($value['giaban'] < $value['giacu']) ? "-" . floor((($value['giacu'] - $value['giaban']) / $value['giacu']) * 100) . "%" : "" ?>
                        </span>
                    </div>
                </div>
                <div class="mt-1 h-4 text-[#FC9502] text-[13px] leading-none font-medium font-main-500 line-clamp-1">
                    <span><?= $value['slogan'] ?></span>
                </div>
                <div class="mt-3 leading-none">
                    <div class="views_product_info cursor-pointer inline-flex items-center leading-none gap-1" data-value="<?= $value['id'] ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                            <g clip-path="url(#clip0_68_706)">
                                <path d="M18.0352 8.68479C17.8741 8.50509 13.9992 4.27869 9.14591 4.27869C4.29258 4.27869 0.417734 8.50509 0.256606 8.68479C0.0768997 8.88565 0.0768997 9.18929 0.256606 9.39015C0.417734 9.56986 4.29265 13.7963 9.14591 13.7963C13.9992 13.7963 17.8741 9.56986 18.0352 9.39015C18.2149 9.18929 18.2149 8.88565 18.0352 8.68479ZM9.14591 12.7387C7.10524 12.7387 5.44463 11.0781 5.44463 9.03747C5.44463 6.9968 7.10524 5.33619 9.14591 5.33619C11.1866 5.33619 12.8472 6.9968 12.8472 9.03747C12.8472 11.0781 11.1866 12.7387 9.14591 12.7387Z" fill="black" />
                                <path d="M9.66544 7.97994C9.66544 7.44801 9.9295 6.98006 10.3312 6.69225C9.97075 6.50771 9.56868 6.39368 9.13669 6.39368C7.67899 6.39368 6.49292 7.57974 6.49292 9.03745C6.49292 10.4952 7.67899 11.6812 9.13669 11.6812C10.4418 11.6812 11.522 10.7283 11.7354 9.48308C10.6706 9.82589 9.66544 9.0206 9.66544 7.97994Z" fill="black" />
                            </g>
                            <defs>
                                <clipPath id="clip0_68_706">
                                    <rect x="0.11792" y="0.0131836" width="18.0481" height="18.0481" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                        <span class="">
                            Tính năng
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>