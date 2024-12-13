<?php

$title = "text-base sm:text-xl leading-normal h-[calc(16px*1.5*2)] sm:h-[calc(20px*1.5*2)] line-clamp-2 font-semibold font-main-600 text-[var(--html-cl-website)] transition-all duration-300";
$content = "text-sm sm:text-base leading-loose sm:leading-loose h-[calc(14px*2*3)] sm:h-[calc(16px*2*3)] line-clamp-3 font-normal font-main-400 text-black ";

foreach ($data as $k => $v) {
    $seoDB = $seo->getSeoDB($v['id'], 'baiviet', 'man', $v["type"]);
    $desc = (isset($seoDB["description_$lang"])) ? $seoDB["description_$lang"] : $seoDB["description"];
?>
    <div class="group/templateNew_one  ">
        <div class=" overflow-hidden rounded-md sm:rounded-lg mb-5 sm:mb-7 relative leading-[0]">
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
            <div class="absolute top-0 left-0 w-full h-full flex flex-col flex-wrap px-4  py-3 pointer-events-none " style="background: var(--color-linear-spl);">
                <div class="flex-1"></div>
                <div class="w-full flex gap-2 leading-none items-center text-white text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <g clip-path="url(#clip0_1_106)">
                            <path d="M13.5045 1.79517H12.2131V3.08657C12.2131 3.34485 11.9978 3.51703 11.7826 3.51703C11.5674 3.51703 11.3521 3.34485 11.3521 3.08657V1.79517H4.46466V3.08657C4.46466 3.34485 4.24943 3.51703 4.0342 3.51703C3.81896 3.51703 3.60373 3.34485 3.60373 3.08657V1.79517H2.31233C1.66663 1.79517 1.19312 2.35477 1.19312 3.08657V4.63625H14.9681V3.08657C14.9681 2.35477 14.1932 1.79517 13.5045 1.79517ZM1.19312 5.54023V13.4178C1.19312 14.1926 1.66663 14.7092 2.35538 14.7092H13.5475C14.2363 14.7092 15.0111 14.1496 15.0111 13.4178V5.54023H1.19312ZM5.02427 12.7721H3.99115C3.81896 12.7721 3.64678 12.6429 3.64678 12.4277V11.3515C3.64678 11.1793 3.77592 11.0072 3.99115 11.0072H5.06732C5.23951 11.0072 5.41169 11.1363 5.41169 11.3515V12.4277C5.36865 12.6429 5.23951 12.7721 5.02427 12.7721ZM5.02427 8.89787H3.99115C3.81896 8.89787 3.64678 8.76873 3.64678 8.5535V7.47733C3.64678 7.30514 3.77592 7.13296 3.99115 7.13296H5.06732C5.23951 7.13296 5.41169 7.2621 5.41169 7.47733V8.5535C5.36865 8.76873 5.23951 8.89787 5.02427 8.89787ZM8.46801 12.7721H7.39184C7.21965 12.7721 7.04747 12.6429 7.04747 12.4277V11.3515C7.04747 11.1793 7.17661 11.0072 7.39184 11.0072H8.46801C8.64019 11.0072 8.81238 11.1363 8.81238 11.3515V12.4277C8.81238 12.6429 8.68324 12.7721 8.46801 12.7721ZM8.46801 8.89787H7.39184C7.21965 8.89787 7.04747 8.76873 7.04747 8.5535V7.47733C7.04747 7.30514 7.17661 7.13296 7.39184 7.13296H8.46801C8.64019 7.13296 8.81238 7.2621 8.81238 7.47733V8.5535C8.81238 8.76873 8.68324 8.89787 8.46801 8.89787ZM11.9117 12.7721H10.8356C10.6634 12.7721 10.4912 12.6429 10.4912 12.4277V11.3515C10.4912 11.1793 10.6203 11.0072 10.8356 11.0072H11.9117C12.0839 11.0072 12.2561 11.1363 12.2561 11.3515V12.4277C12.2561 12.6429 12.127 12.7721 11.9117 12.7721ZM11.9117 8.89787H10.8356C10.6634 8.89787 10.4912 8.76873 10.4912 8.5535V7.47733C10.4912 7.30514 10.6203 7.13296 10.8356 7.13296H11.9117C12.0839 7.13296 12.2561 7.2621 12.2561 7.47733V8.5535C12.2561 8.76873 12.127 8.89787 11.9117 8.89787Z" fill="white" />
                        </g>
                        <defs>
                            <clipPath id="clip0_1_106">
                                <rect width="14.6359" height="14.6359" fill="white" transform="translate(0.763428 0.933838)" />
                            </clipPath>
                        </defs>
                    </svg>
                    <span>
                        <?= date("d/m/Y", $v['ngaytao']) ?>
                    </span>
                </div>
            </div>
        </div>
        <div class=" mb-2 <?= $title ?>">
            <?= $func->addHref([
                'class' => "",
                'href' => $func->getUrl($v),
                'title' => (isset($v["ten_$lang"])) ? $v["ten_$lang"] : $v["ten"],
                'seoHeading' => $seoHeading,
            ]) ?>
        </div>
        <div class=" <?= $content ?>">
            <span class=''>
                <?= $desc ?>
            </span>
        </div>
    </div>
<?php } ?>