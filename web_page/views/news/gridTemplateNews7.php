<?php

$title = "text-sm sm:text-base leading-[1.68] sm:leading-[1.68] h-[calc(14px*1.68*2)] sm:h-[calc(16px*1.68*2)] line-clamp-2 font-semibold font-main-600 text-white group-hover/templateNew_seven:text-[var(--html-bg-website)] transition-all duration-300";

foreach ($data as $k => $value) {
    $seoDB = $seo->getSeoDB($value['id'], 'baiviet', 'man', $value["type"]);
    $desc = (isset($seoDB["description_$lang"])) ? $seoDB["description_$lang"] : $seoDB["description"];
?>
    <div class="w-full <?= $class ?>">
        <div class="group/templateNew_seven w-full overflow-hidden  aspect-[548/428] relative load_website  rounded-2xl  ">
            <div class="w-full overflow-hidden  aspect-[548/428] relative leading-[0] ">
                <?= $func->addHrefImg([
                    'classfix' => 'w-full',
                    'addhref' => true,
                    'href' =>  $func->getUrl($value),
                    'sizes' => '548x428x1',
                    'actual_width' => 1000,
                    'upload' => _upload_baiviet_l,
                    'image' => ($value["photo"]),
                    'alt' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
                ]); ?>
            </div>
            <div class="absolute top-0 left-0 w-full h-full z-10 pointer-events-none ">
                <div class="flex flex-wrap flex-col w-full h-full py-5 px-7 ">
                    <div class="flex-1"></div>
                    <div class="w-full">
                        <div class=" text-center  ">
                            <?= $func->addHref([
                                'class' => $title,
                                'href' => $func->getUrl($value),
                                'title' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
                                'seoHeading' => $seoHeading,
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>