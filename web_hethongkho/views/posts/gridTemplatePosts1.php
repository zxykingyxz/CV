<?php
$title = "text-base leading-normal h-[calc(16px*1.5*2)] line-clamp-2 font-semibold font-main-600 text-[#424040] group-hover/templatePost_one:text-[var(--html-cl-website)] transition-all duration-300";
$content = "text-sm leading-relaxed h-[calc(14px*1.625*3)] line-clamp-3 font-normal font-main-400 text-black ";

foreach ($data as $k => $v) {
    $seoDB = $seo->getSeoDB($v['id'], 'baiviet', 'man', $v["type"]);
    $desc = (isset($seoDB["description_$lang"])) ? $seoDB["description_$lang"] : $seoDB["description"];
?>
    <div class="group/templatePost_one load_website relative bg-[#FEF1F1] rounded-[12px] sm:rounded-[32px] pt-5 sm:pt-7 px-2 sm:px-4 pb-8 sm:pb-12 mb-7 ">
        <div class="text-center mb-3 sm:mb-5">
            <?= $func->addHref([
                'class' => $title,
                'href' => $func->getUrl($v),
                'title' => (isset($v["ten_$lang"])) ? $v["ten_$lang"] : $v["ten"],
                'seoHeading' => $seoHeading,
            ]) ?>
        </div>
        <div class=" overflow-hidden rounded-md sm:rounded-2xl mb-3 sm:mb-5">
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
        <div class="">
            <span class='<?= $content ?>'>
                <?= $desc ?>
            </span>
        </div>
        <div class="action_warehouse group/button_templatePost_one absolute top-full left-1/2 -translate-x-1/2 -translate-y-1/2 leading-none inline-flex justify-center items-center ">
            <div class="cursor-pointer text-base sm:text-lg inline-flex leading-none font-bold font-main-700 text-[var(--html-bg-website)] justify-center items-center bg-white h-9 sm:h-[50px] rounded-lg  px-6 sm:px-16 border border-[var(--html-bg-website)] hover:text-white relative gap-2 transition-all duration-300 z-10 overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-full opacity-0  group-hover/button_templatePost_one:opacity-100  pointer-events-none z-[-1] transition-all duration-500" style="background: var(--color-linear);"></div>
                <span class="whitespace-nowrap">Báo giá</span>
                <svg class="group-hover/button_templatePost_one:*:stroke-[#ffffff] transition-all duration-300" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                    <path d="M9.09822 9.00253H21.1816V21.0859" stroke="var(--html-bg-website)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M9.09822 21.0859L21.1816 9.00253" stroke="var(--html-bg-website)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
        </div>
    </div>
<?php } ?>