<?php
$title = "text-base leading-normal h-[calc(16px*1.5*2)] line-clamp-2 font-semibold font-main-600 text-[#424040] group-hover/templateView_one:text-[var(--html-cl-website)] transition-all duration-300";
$content = "text-sm leading-relaxed h-[calc(14px*1.625*4)] line-clamp-4 font-normal font-main-400 text-[#424040] transition-all duration-300";

foreach ($data as $k => $v) {
?>
    <div class="group/templateView_one load_website bg-white relative overflow-hidden rounded-2xl sm:rounded-[32px]  p-3 sm:p-4 z-10" style="box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.15);">
        <div class="absolute top-0 left-0 w-full h-full opacity-0  group-hover/templateView_one:opacity-100  pointer-events-none z-[-1] transition-all duration-500" style="background: var(--color-linear-sc);"></div>
        <div class='w-full aspect-[360/220] overflow-hidden rounded-xl sm:rounded-2xl'>
            <?= $func->addHrefImg([
                'classfix' => 'w-full',
                'addhref' => true,
                'href' =>  !empty($v['link']) ? $v['link'] : $jv0,
                'sizes' => '360x220x1',
                'actual_width' => 500,
                'upload' => _upload_hinhanh_l,
                'image' => ($v["photo"]),
                'alt' => (isset($v["ten_$lang"])) ? $v["ten_$lang"] : $v["ten"],
            ]); ?>
        </div>
        <div class="mt-4 sm:mt-6">
            <div class="text-center mb-2 <?= $title ?>">
                <?= $func->addHref([
                    'class' => '',
                    'href' => !empty($v['link']) ? $v['link'] : $jv0,
                    'title' => (isset($v["ten_$lang"])) ? $v["ten_$lang"] : $v["ten"],
                    'seoHeading' => "",
                ]) ?>
            </div>
            <div class="mb-5 sm:mb-11">
                <span class='<?= $content ?>'>
                    <?= (isset($v["mota_$lang"])) ? htmlspecialchars_decode($v["mota_$lang"]) : htmlspecialchars_decode($v['mota']) ?>
                </span>
            </div>
        </div>
    </div>
<?php } ?>