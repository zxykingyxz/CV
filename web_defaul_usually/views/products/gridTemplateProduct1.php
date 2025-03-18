<?php
$title = "text-[#222] font-main-400 text-sm sm:text-base leading-[1.4] sm:leading-[1.4] h-[calc(14px*1.4*2)] sm:h-[calc(16px*1.4*2)] group-hover/templateProduct_One:text-[var(--html-bg-website)] line-clamp-2 transition-all duration-300 ";

foreach ($data as $key => $value) {
?>
    <div class="h-full">
        <div class="group/templateProduct_One h-full overflow-hidden bg-white  transition-all duration-500  <?= $class ?> ">
            <div class='relative w-full aspect-[510/510] overflow-hidden '>
                <div class="absolut bg-white z-20 group-hover/templateProduct_One:z-10 transition-all duration-300 ">
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
                    <div class="absolute bg-white z-10 group-hover/templateProduct_One:z-20 transition-all duration-300">
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
            <div class='p-2'>
                <div class="mb-3 text-xs sm:text-sm font-light font-main-300 text-black">
                    <span>
                        <?= "Thương Hiệu: " . (!empty($value['slogan']) ? $value['slogan'] : "Đang cập nhật") ?>
                    </span>
                </div>
                <div class="mb-3">
                    <?= $func->addHref([
                        'class' => $title,
                        'href' => $func->getUrl($value),
                        'title' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
                        'seoHeading' => $seoHeading,
                    ]) ?>
                </div>
                <div class='flex flex-wrap items-center flex-col sm:flex-row gap-2'>
                    <div class='w-full md:w-auto text-red-600 text-base sm:text-lg font-semibold font-main-600'>
                        <?= (($value['giaban']) != 0) ? $func->changeMoney($value['giaban'], $lang) . ' <span class="underline">' . $value['donvitinh'] . '</span>' : 'Liên hệ' ?>
                    </div>
                    <del class='w-full md:w-auto text-[#222020] text-xs sm:text-sm font-main-400 font-normal'>
                        <?= $value["giacu"] > 0 ? $func->changeMoney($value["giacu"], '') .  ($value['donvitinh'] != '' ? ' <span class="underline">' . $value['donvitinh'] . '</span>' : '') : '' ?>
                    </del>
                </div>
            </div>
        </div>
    </div>
<?php } ?>