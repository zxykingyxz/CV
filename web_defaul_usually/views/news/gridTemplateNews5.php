<?php

$title = "text-base sm:text-xl leading-normal sm:leading-normal h-[calc(16px*1.5*2)] sm:h-[calc(20px*1.5*2)] line-clamp-2 font-medium font-main-500 text-white group-hover/templateNew_five:text-[var(--html-bg-website)] transition-all duration-300";
$content = "text-xs sm:text-sm leading-[1.78] sm:leading-[1.78] h-[calc(12px*1.78*3)] sm:h-[calc(14px*1.78*3)]  font-normal font-main-400 text-white ";

foreach ($data as $k => $value) {
    $seoDB = $seo->getSeoDB($value['id'], 'baiviet', 'man', $value["type"]);
    $desc = (isset($seoDB["description_$lang"])) ? $seoDB["description_$lang"] : $seoDB["description"];
?>
    <div class="group/templateNew_five relative load_website overflow-hidden rounded-2xl ">
        <div class="w-full overflow-hidden  aspect-[387/334] relative leading-[0] z">
            <?= $func->addHrefImg([
                'classfix' => 'w-full',
                'addhref' => true,
                'href' =>  $func->getUrl($value),
                'sizes' => '387x334x1',
                'actual_width' => 600,
                'upload' => _upload_baiviet_l,
                'image' => ($value["photo"]),
                'alt' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
            ]); ?>
        </div>
        <div class="absolute top-0 left-0 w-full h-full z-10 pointer-events-none">
            <div class="flex w-full h-full ">
                <div class="flex-1 relative flex h-full items-end    ">
                    <div class="absolute top-0 left-0 w-full h-full z-[-1] bg-[rgba(255,255,255,0.10)] group-hover/templateNew_five:bg-[rgba(0,0,0,0.74)] backdrop-blur-[7.5px]  transition-all duration-300 "></div>
                    <div class=" px-2 py-6">
                        <div class="mb-3 text-center ">
                            <?= $func->addHref([
                                'class' => $title,
                                'href' => $func->getUrl($value),
                                'title' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
                                'seoHeading' => $seoHeading,
                            ]) ?>
                        </div>
                        <div class="mb-6 text-center <?= $content ?>">
                            <span class='line-clamp-3'>
                                <?= $desc ?>
                            </span>
                        </div>
                        <div class=" flex justify-center">
                            <a href="<?= $func->getUrl($value) ?>" title="<?= (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"] ?>" class="inline-flex justify-center items-center leading-none h-10 rounded-full px-8 bg-white text-[var(--html-bg-website)] text-base font-medium font-main-500 text-center group-hover/templateNew_five:bg-[var(--html-bg-website)] group-hover/templateNew_five:text-white gap-2 transition-all duration-300">
                                Xem Thêm
                            </a>
                        </div>
                    </div>
                </div>
                <div class="w-7 h-full">
                    <div class="h-[45px] w-full relative">
                        <div class="absolute top-0 right-0 h-full px-2 inline-flex justify-center gap-2 items-center bg-[var(--html-bg-website)] text-white text-sm font-normal font-main-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
                                <path d="M6.79102 2.17108V5.50441" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M13.582 2.17108V5.50441" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M16.129 3.83771H4.24465C3.30699 3.83771 2.54688 4.5839 2.54688 5.50437V17.171C2.54688 18.0915 3.30699 18.8377 4.24465 18.8377H16.129C17.0667 18.8377 17.8268 18.0915 17.8268 17.171V5.50437C17.8268 4.5839 17.0667 3.83771 16.129 3.83771Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M2.54688 8.83771H17.8268" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M6.79102 12.1711H6.79935" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M10.1865 12.1711H10.1949" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M13.582 12.1711H13.5904" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M6.79102 15.5044H6.79935" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M10.1865 15.5044H10.1949" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M13.582 15.5044H13.5904" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span>
                                <?= date('d/m/Y', $value['ngaytao']) ?>
                            </span>
                        </div>
                    </div>
                    <div class="w-full aspect-[28/21] bg-[var(--html-bg-website)] brightness-75 " style="clip-path: polygon(0% 0%, 100% 0%,0% 100%);"></div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>