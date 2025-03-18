<?php

$title = "text-sm sm:text-base leading-normal h-[calc(14px*1.5*2)] sm:h-[calc(16px*1.5*2)] line-clamp-2 font-normal font-main-400 text-black group-hover/templateNew_four:text-[var(--html-bg-website)] transition-all duration-300";

foreach ($data as $k => $v) {
?>
    <div class="group/templateNew_four ">
        <div class=" w-full aspect-[335/220] overflow-hidden rounded-md sm:rounded-lg mb-5 relative leading-[0]">
            <?= $func->addHrefImg([
                'classfix' => 'w-full',
                'addhref' => true,
                'href' =>  $func->getUrl($v),
                'sizes' => '335x220x1',
                'actual_width' => 600,
                'upload' => _upload_baiviet_l,
                'image' => ($v["photo"]),
                'alt' => (isset($v["ten_$lang"])) ? $v["ten_$lang"] : $v["ten"],
            ]); ?>
        </div>
        <div class=" mb-3 ">
            <?= $func->addHref([
                'class' => $title,
                'href' => $func->getUrl($v),
                'title' => (isset($v["ten_$lang"])) ? $v["ten_$lang"] : $v["ten"],
                'seoHeading' => $seoHeading,
            ]) ?>
        </div>
    </div>
<?php } ?>