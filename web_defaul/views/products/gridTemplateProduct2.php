<?php
$title = "text-black  text-xs sm:text-[13px] leading-normal sm:leading-normal h-[calc(12px*1.5*2)] sm:h-[calc(13px*1.5*2)] font-main-500 font-medium group-hover/templateProduct_Two:text-[var(--html-bg-website)] line-clamp-2 transition-all duration-300 ";

foreach ($data as $key => $value) {
?>
    <div class="h-full ">
        <div class="group/templateProduct_Two load_website h-full overflow-hidden bg-white border border-[#E1DEDE] hover:border-[var(--html-bg-website)] p-3 rounded-lg transition-all duration-500   <?= $class ?> ">
            <div class='relative z-10 w-full aspect-[510/510] '>
                <div class=" w-full absolute top-0 left-0 w-full h-full bg-white z-20 group-hover/templateProduct_Two:z-10 transition-all duration-300 ">
                    <?= $func->addHrefImg([
                        'classfix' => 'w-full',
                        'addhref' => true,
                        'href' =>  $func->getUrl($value),
                        'isLazy' => true,
                        'sizes' => "510x510x1",
                        'actual_width' => 900,
                        'upload' => _upload_baiviet_l,
                        'image' => ($value["photo"]),
                        'alt' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
                    ]); ?>
                </div>
                <?php if (!empty($value["photo2"])) { ?>
                    <div class=" w-full absolute top-0 left-0 w-full h-full bg-white z-10 group-hover/templateProduct_Two:z-20 transition-all duration-300">
                        <?= $func->addHrefImg([
                            'classfix' => 'w-full',
                            'addhref' => true,
                            'href' =>  $func->getUrl($value),
                            'isLazy' => true,
                            'sizes' => "510x510x1",
                            'actual_width' => 900,
                            'upload' => _upload_baiviet_l,
                            'image' => ($value["photo2"]),
                            'alt' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
                        ]); ?>
                    </div>
                <?php } ?>
            </div>
            <div class="mt-5">
                <div>
                    <?= $func->addHref([
                        'class' => $title,
                        'href' => $func->getUrl($value),
                        'title' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
                        'seoHeading' => $seoHeading,
                    ]) ?>
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
                <div class="mt-2 pl-2">
                    <div class="flex relative">
                        <div class="absolute top-1/2 left-0 -translate-y-1/2 -translate-x-1/2 z-10">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M9.00098 11.9487C9 6 11 2 15 0C15.5 6 21 8 21 15C21 19.9706 16.9706 24 12 24C7.02944 24 3 19.9706 3 15C3 11.5 4 10 6 8C6 11 9.00098 11.9487 9.00098 11.9487Z" fill="#F16923" />
                                <path opacity="0.1" d="M12 23.7499C7.97406 23.7499 4.56451 21.1342 3.3623 17.5117C4.45032 21.2586 7.90216 23.9999 12 23.9999C16.0978 23.9999 19.5497 21.2586 20.6377 17.5117C19.4355 21.1342 16.0259 23.7499 12 23.7499Z" fill="#010101" />
                                <path d="M16.5 17.5C16.5 19.9853 14.4853 22 12 22C9.51472 22 7.5 19.9853 7.5 17.5C7.5 15.8229 8 14.9583 9 14C9 16 10.5 16.5 10.5 16.5C10.4995 13.6496 11.5 11.9583 13.5 11C13.75 13.875 16.5 14.8125 16.5 17.5Z" fill="#FDB816" />
                                <path opacity="0.2" d="M10.5 16.75C10.4995 13.8995 11.5 12.2083 13.5 11.25C13.7451 14.0682 16.3857 15.0289 16.4902 17.597C16.491 17.564 16.5 17.5332 16.5 17.5C16.5 14.8125 13.75 13.875 13.5 11C11.5 11.9583 10.4995 13.6495 10.5 16.5C10.5 16.5 9 16 9 14C8 14.9583 7.5 15.8229 7.5 17.5C7.5 17.5241 7.50671 17.5464 7.50708 17.5704C7.54352 16.0148 8.0379 15.172 9 14.25C9 16.25 10.5 16.75 10.5 16.75Z" fill="white" />
                                <path opacity="0.1" d="M12 21.7499C9.53882 21.7499 7.54565 19.7722 7.50708 17.3203C7.50568 17.3815 7.5 17.4363 7.5 17.4999C7.5 19.9852 9.51471 21.9999 12 21.9999C14.4853 21.9999 16.5 19.9852 16.5 17.4999C16.5 17.4468 16.4923 17.3986 16.4902 17.3469C16.4374 19.7863 14.4521 21.7499 12 21.7499Z" fill="#010101" />
                                <path opacity="0.2" d="M9.00098 12.1987C9 6.25 11 2.25 15 0.25C15.4968 6.21222 20.9254 8.22974 20.9938 15.1235C20.9943 15.0819 21 15.0417 21 15C21 8 15.5 6 15 0C11 2 9 6 9.00098 11.9487C9.00098 11.9487 6 11 6 8C4 10 3 11.5 3 15C3 15.0364 3.005 15.0715 3.00543 15.1078C3.03406 11.7154 4.02905 10.2209 6 8.25C6 11.25 9.00098 12.1987 9.00098 12.1987Z" fill="white" />
                                <path d="M9.00098 11.9487C9 6 11 2 15 0C15.5 6 21 8 21 15C21 19.9706 16.9706 24 12 24C7.02944 24 3 19.9706 3 15C3 11.5 4 10 6 8C6 11 9.00098 11.9487 9.00098 11.9487Z" fill="url(#paint0_linear_87_11)" />
                                <defs>
                                    <linearGradient id="paint0_linear_87_11" x1="4.906" y1="8.459" x2="21.397" y2="16.149" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="white" stop-opacity="0.2" />
                                        <stop offset="1" stop-color="white" stop-opacity="0" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                        <div class="bg-[#E4E3E3] rounded-r-[20px] h-5 flex-1 flex relative text-[10px] sm:text-[11px] lg:text-[13px] font-medium font-main-500 text-center">
                            <div class="bg-[#FFD23E] h-full" style="width: <?= floor($value['qty'] / $value['qty_start'] * 100) ?>%;"> </div>
                            <span class="absolute w-full top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 "><?= "Còn " . $value['qty'] . "/" . $value['qty_start'] . " suất" ?></span>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="js-buynow cursor-pointer h-7 w-full rounded border border-[#FFDB65] bg-white text-black group-hover/templateProduct_Two:bg-[var(--html-bg-website)] group-hover/templateProduct_Two:border-[var(--html-bg-website)] group-hover/templateProduct_Two:text-white text-sm font-normal font-main-400 inline-flex justify-center items-center leading-[0] transition-all duration-300" data-id="<?= $value['id'] ?>" data-qty="1">
                        <span>Mua Ngay</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>