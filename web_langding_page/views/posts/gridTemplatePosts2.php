<?php
$title_sup = "text-base leading-normal  line-clamp-1 font-semibold font-main-600 text-[#4B4A4A] transition-all duration-300";
$title = "text-base leading-normal h-[calc(16px*1.5*2)] line-clamp-2 font-semibold font-main-600 text-black transition-all duration-300";
$button = "text-base leading-none font-medium font-main-500 text-black group-hover/templatePost_two:text-[var(--html-cl-website)]  transition-all duration-300";

foreach ($data as $k => $v) {
    $seoDB = $seo->getSeoDB($v['id'], 'baiviet', 'man', $v["type"]);
    $desc = (isset($seoDB["description_$lang"])) ? $seoDB["description_$lang"] : $seoDB["description"];
?>
    <div class="group/templatePost_two load_website bg-[#fff] rounded-[10px] sm:rounded-[20px]  pb-2 ">
        <div class="w-full aspect-[335/220] overflow-hidden rounded-md sm:rounded-2xl mb-3 sm:mb-5 relative leading-[0]">
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
            <div class="absolute top-0 left-0 w-full h-full flex flex-col flex-wrap px-4  py-3 pointer-events-none opacity-0 group-hover/templatePost_two:opacity-100 transition-all duration-300 " style="background: var(--color-linear-spl);">
            </div>
        </div>
        <div class="content_post">
            <div class="mb-2">
                <span class='<?= $title_sup ?>'>
                    <?= 'Dự án' ?>
                </span>
            </div>
            <div class=" mb-2 sm:mb-3">
                <?= $func->addHref([
                    'class' => $title,
                    'href' => $func->getUrl($v),
                    'title' => (isset($v["ten_$lang"])) ? $v["ten_$lang"] : $v["ten"],
                    'seoHeading' => $seoHeading,
                ]) ?>
            </div>
            <div class="">
                <a href="<?= $func->getUrl($v) ?>" title="<?= (isset($v["ten_$lang"])) ? $v["ten_$lang"] : $v["ten"] ?>" class='<?= $button ?> flex items-center gap-2 '>
                    <span>
                        Xem chi tiết
                    </span>
                    <svg class=" group-hover/templatePost_two:*:fill-[var(--html-cl-website)] transition-all duration-300" xmlns="http://www.w3.org/2000/svg" width="23" height="13" viewBox="0 0 23 13" fill="none">
                        <path d="M1.8042 7.52732H19.0025L15.7804 10.9773C14.8549 11.9683 16.2432 13.4547 17.1687 12.4637L20.1031 9.31683L22.062 7.21609C22.4416 6.80716 22.4416 6.14673 22.062 5.73781L17.1687 0.492238C16.9825 0.287398 16.7263 0.172464 16.4593 0.174841C15.5779 0.17496 15.1454 1.32437 15.7804 1.97874L19.0101 5.42875H1.75353C0.396192 5.50086 0.497538 7.59967 1.8042 7.52732Z" fill="black" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
<?php } ?>