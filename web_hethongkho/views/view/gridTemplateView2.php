<?php
$title_sup = "text-xs sm:text-sm leading-[2] sm:leading-[2] line-clamp-2 font-medium font-main-500 text-[var(--html-bg-website)] transition-all duration-300";
$title = "text-base sm:text-lg leading-[1.8] sm:leading-[1.8] line-clamp-2 font-menium font-main-500 text-white transition-all duration-300";
$content = "text-sm sm:text-base h-[calc(14px*2*4)] sm:h-[calc(16px*2*4)] leading-[2] sm:leading-[2] line-clamp-4 font-normal font-main-400 text-white ";

foreach ($data as $key => $value) {
?>
    <div class="group/templateView_two relative bg-[var(--html-sc-website)] rounded-lg px-3 sm:px-5 pt-6 pb-9 mb-8 load_website <?= $class ?> ">
        <div class="flex items-center gap-4 sm:gap-6 mb-5 px-2">
            <div class=" flex-initial rounded-full w-[18%] border-4 border-[var(--html-bg-website)] border-solid">
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
            <div class="flex-1 ">
                <div class="">
                    <a href='<?= !empty($value['link']) ? $value['link'] : $jv0 ?>' class="<?= $title ?>" <?= !empty($value['link']) ? "target='_blank'" : '' ?>>
                        <?= (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"] ?>
                    </a>
                </div>
                <div class="<?= $title_sup ?>">
                    <span>
                        <?= (isset($value["slogan_$lang"])) ? htmlspecialchars_decode($value["slogan_$lang"]) : htmlspecialchars_decode($value['slogan']) ?>
                    </span>
                </div>
                <?php /*
                <div class="">
                    <span class='color-star' style='--rating:<?= $func->getRating($value['number']) ?>'>
                    </span>
                </div>
                */ ?>
            </div>
        </div>
        <div class="text-justify <?= $content ?> ">
            <span class="">
                <?= (isset($value["mota_$lang"])) ? htmlspecialchars_decode($value["mota_$lang"]) : htmlspecialchars_decode($value['mota']) ?>
            </span>
        </div>
        <div class="absolute top-full right-[17%] -translate-y-1/2">
            <div class="inline-flex leading-[0] justify-center items-center h-14  aspect-[1/1] overflow-hidden rounded-full bg-white  border border-[var(--html-bg-website)] border-solid">
                <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29" fill="none">
                    <g clip-path="url(#clip0_1_1146)">
                        <path d="M11.3924 4.08472H0.848633C0.395538 4.08472 0.0283203 4.45193 0.0283203 4.90503V15.4488C0.0283203 15.9019 0.395538 16.2691 0.848633 16.2691H5.30011V23.3567C5.30011 23.8096 5.66733 24.177 6.12042 24.177H8.75653C9.10965 24.177 9.42303 23.951 9.53455 23.6161L12.1704 15.7082C12.1984 15.6246 12.2127 15.537 12.2127 15.4488V4.90503C12.2127 4.45193 11.8455 4.08472 11.3924 4.08472Z" fill="var(--html-bg-website)" />
                        <path d="M27.2079 4.08472H16.6641C16.211 4.08472 15.8438 4.45193 15.8438 4.90503V15.4488C15.8438 15.9019 16.211 16.2691 16.6641 16.2691H21.1158V23.3567C21.1158 23.8096 21.483 24.177 21.9361 24.177H24.572C24.9251 24.177 25.2385 23.951 25.3502 23.6161L27.9861 15.7082C28.0139 15.6246 28.0282 15.537 28.0282 15.4488V4.90503C28.0282 4.45193 27.6609 4.08472 27.2079 4.08472Z" fill="var(--html-bg-website)" />
                    </g>
                </svg>
            </div>
        </div>
    </div>
<?php } ?>