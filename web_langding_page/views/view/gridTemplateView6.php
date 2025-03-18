<?php
$title_sup = "text-xs leading-norrmal sm:leading-norrmal line-clamp-2 font-medium font-main-500 text-[var(--html-bg-website)] transition-all duration-300";
$title = "text-sm sm:text-base leading-normal sm:leading-normal font-menium font-main-500 text-black transition-all duration-300";
$content = "text-xs sm:text-sm h-[calc(12px*1.78*3)] sm:h-[calc(14px*1.78*3)] leading-[1.78] sm:leading-[1.78] line-clamp-3 font-normal font-main-400 text-[#3D3B3B] ";

foreach ($data as $key => $value) {
?>
    <div class=" group/templateView_six load_website relative bg-white rounded-lg sm:rounded-2xl px-3 sm:px-4 md:px-6 lg:px-9 pt-4 pb-4 sm:pb-6 mt-[48px] <?= $class ?> ">
        <div class="absolute top-0 right-[12.5%] -translate-y-1/2">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="44" viewBox="0 0 50 44" fill="none">
                <path d="M1.90082e-06 21.7428L3.80163e-06 43.4856L22.0013 43.4856L22.0013 21.7428L7.33382 21.7428C7.33382 13.7503 13.9138 7.24764 22.0013 7.24764L22.0013 -1.92342e-06C9.86907 -8.62781e-07 8.52643e-07 9.7531 1.90082e-06 21.7428Z" fill="url(#paint0_linear_1_503)" />
                <path d="M49.9015 7.24764L49.9015 -1.92342e-06C37.7692 -8.62781e-07 27.9002 9.7531 27.9002 21.7428L27.9002 43.4856L49.9015 43.4856L49.9015 21.7428L35.234 21.7428C35.234 13.7503 41.814 7.24764 49.9015 7.24764Z" fill="url(#paint1_linear_1_503)" />
                <defs>
                    <linearGradient id="paint0_linear_1_503" x1="11.0007" y1="43.4856" x2="11.0007" y2="-9.61708e-07" gradientUnits="userSpaceOnUse">
                        <stop stop-color="var(--html-bg-website)" />
                    </linearGradient>
                    <linearGradient id="paint1_linear_1_503" x1="38.9009" y1="43.4856" x2="38.9008" y2="-9.61708e-07" gradientUnits="userSpaceOnUse">
                        <stop stop-color="var(--html-bg-website)" />
                    </linearGradient>
                </defs>
            </svg>
        </div>
        <div class="w-full h-full">
            <div class="h-[60px] w-full relative">
                <div class=" absolute bottom-0 left-[7px] aspect-[100/100] overflow-hidden flex-initial rounded-full w-[32%] ">
                    <?= $func->addHrefImg([
                        'addhref' => true,
                        'href' =>  $jv0,
                        'sizes' => '100x100x1',
                        'actual_width' => 400,
                        'upload' => _upload_hinhanh_l,
                        'image' => ((isset($value["photo_$lang"])) ? $value["photo_$lang"] : $value["photo"]),
                        'alt' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
                    ]); ?>
                </div>
            </div>
            <div class="text-justify mt-4 <?= $content ?> ">
                <span class="">
                    <?= (isset($value["mota_$lang"])) ? htmlspecialchars_decode($value["mota_$lang"]) : htmlspecialchars_decode($value['mota']) ?>
                </span>
            </div>
            <div class="w-full mt-3 flex items-center gap-2 sm:gap-3">
                <div class="">
                    <a href='<?= !empty($value['link']) ? $value['link'] : $jv0 ?>' class="<?= $title ?>" <?= !empty($value['link']) ? "target='_blank'" : '' ?>>
                        <?= (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"] ?>
                    </a>
                </div>
                <div class="w-2 h-0 border-t border-black"></div>
                <div class="<?= $title_sup ?>">
                    <span>
                        <?= (isset($value["slogan_$lang"])) ? htmlspecialchars_decode($value["slogan_$lang"]) : htmlspecialchars_decode($value['slogan']) ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
<?php } ?>