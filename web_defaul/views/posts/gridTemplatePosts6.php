<?php
$title = "text-base sm:text-lg leading-normal sm:leading-normal h-[calc(16px*1.5*2)] sm:h-[calc(18px*1.5*2)] line-clamp-2 font-medium font-main-500 text-black transition-all duration-300";

foreach ($data as $key => $value) {
?>
    <div class="group/templatePost_six load_website bg-[#fff] pb-2 overflow-hidden ">
        <div class=" overflow-hidden  mb-3 sm:mb-5 relative leading-[0]">
            <?= $func->addHrefImg([
                'classfix' => 'w-full',
                'addhref' => true,
                'href' =>  $func->getUrl($value),
                'sizes' => '100x100x1',
                'actual_width' => 600,
                'upload' => _upload_baiviet_l,
                'image' => ($value["photo"]),
                'alt' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
            ]); ?>
        </div>
        <div class="relative">
            <div class="text-center group-hover/templatePost_six:opacity-0 opacity-100 transition-all duration-300 ">
                <?= $func->addHref([
                    'class' => $title,
                    'href' => $func->getUrl($value),
                    'title' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
                    'seoHeading' => $seoHeading,
                ]) ?>
            </div>
            <div class="absolute top-0 left-0 w-full h-full scale-90 bg-white opacity-0 flex group-hover/templatePost_six:opacity-100  group-hover/templatePost_six:scale-100 justify-center items-center transition-all duration-300">
                <a href="<?= $func->getUrl($value) ?>" title="<?= (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"] ?>" class='<?= $button ?> flex items-center gap-2 '>
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                        <g clip-path="url(#clip0_1_27)">
                            <path d="M1.33807 12.9878L22.4799 12.9878" stroke="var(--html-bg-website)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M15.3493 5.98779L23.4986 12.9878L15.3493 19.9878" stroke="var(--html-bg-website)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </g>
                        <defs>
                            <clipPath id="clip0_1_27">
                                <rect width="24.4479" height="24" fill="white" transform="translate(0.0693359 0.987793)" />
                            </clipPath>
                        </defs>
                    </svg>
                </a>
            </div>
        </div>
    </div>
<?php } ?>