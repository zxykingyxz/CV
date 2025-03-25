<?php

$title = "text-sm leading-normal h-[calc(14px*1.5*2)] line-clamp-2 font-bold font-main-700 text-[#5C5C5C] transition-all duration-300";
$content = "text-[13px] leading-normal h-[calc(13px*1.5*3)] line-clamp-3  font-normal font-main-400 text-black ";

foreach ($data as $k => $v) {
    $seoDB = $seo->getSeoDB($v['id'], 'baiviet', 'man_list', $v["type"]);
    $desc = (isset($seoDB["description_$lang"])) ? $seoDB["description_$lang"] : $seoDB["description"];
?>
    <div class="group/templateNew_one load_website bg-white border-2 border-[var(--html-bg-website)] rounded-lg px-5 py-4 ">
        <div class=" w-full aspect-[515/404] overflow-hidden rounded-lg mb-4 relative leading-[0]">
            <?= $func->addHrefImg([
                'classfix' => 'w-full',
                'addhref' => true,
                'href' =>  $func->getUrl($v),
                'sizes' => '515x404x1',
                'actual_width' => 800,
                'upload' => _upload_baiviet_l,
                'image' => ($v["photo"]),
                'alt' => (isset($v["ten_$lang"])) ? $v["ten_$lang"] : $v["ten"],
            ]); ?>
        </div>
        <div class=" mb-3 <?= $title ?> text-center">
            <?= $func->addHref([
                'class' => "",
                'href' => $func->getUrl($v),
                'title' => (isset($v["ten_$lang"])) ? $v["ten_$lang"] : $v["ten"],
                'seoHeading' => $seoHeading,
            ]) ?>
        </div>
        <div class="flex justify-center">
            <div class=" <?= $content ?> w-full md:w-[80%]">
                <span class='line-clamp-3'>
                    <?= $desc ?>
                </span>
            </div>
        </div>
    </div>
<?php } ?>