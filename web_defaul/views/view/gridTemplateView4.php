<?php
$title_sup = "text-xs leading-[2] line-clamp-2 font-medium font-main-500 text-[#7088FF] transition-all duration-300";
$title = "text-xs sm:text-sm leading-[1.8] sm:leading-[1.8] line-clamp-2 font-semibold font-main-700 text-[#323232] transition-all duration-300";
$content = "text-sm sm:text-base h-[calc(14px*2*4)] sm:h-[calc(16px*2*4)] leading-[2] sm:leading-[2] line-clamp-4 font-normal font-main-400 text-[#4E4E4E] ";

foreach ($data as $key => $value) {
?>
    <div class="group/templateView_four relative bg-white  px-1 py-1  load_website <?= $class ?> ">
        <div class="text-justify mb-5 <?= $content ?> ">
            <span class="">
                <?= (isset($value["mota_$lang"])) ? htmlspecialchars_decode($value["mota_$lang"]) : htmlspecialchars_decode($value['mota']) ?>
            </span>
        </div>
        <div class="flex items-center gap-3">
            <div class="w-[150px] flex-initial inline-flex justify-center flex-wrap leading-[0] text-center">
                <div class=" rounded-full overflow-hidden w-[58px] mb-3">
                    <?= $func->addHrefImg([
                        'addhref' => true,
                        'href' =>  $jv0,
                        'sizes' => '100x100x1',
                        'actual_width' => 400,
                        'upload' => _upload_hinhanh_l,
                        'image' => ($value["photo"]),
                        'alt' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
                    ]); ?>
                </div>
                <div class="w-full">
                    <a href='<?= !empty($value['link']) ? $value['link'] : $jv0 ?>' class="capitalize <?= $title ?>" <?= !empty($value['link']) ? "target='_blank'" : '' ?>>
                        <?= (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"] ?>
                    </a>
                </div>
                <div class="<?= $title_sup ?> w-full">
                    <span>
                        <?= (isset($value["slogan_$lang"])) ? htmlspecialchars_decode($value["slogan_$lang"]) : htmlspecialchars_decode($value['slogan']) ?>
                    </span>
                </div>
            </div>
            <div class="flex-1 ">
                <div class="">
                    <span class='color-star' style='--rating:<?= $func->getRating($value['number']) ?>'>
                    </span>
                </div>
            </div>
        </div>
    </div>
<?php } ?>