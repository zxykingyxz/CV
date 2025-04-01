<?php

$title = "text-sm sm:text-[15px] leading-[1.33] sm:leading-[1.33] h-[calc(14px*1.33*2)] sm:h-[calc(15px*1.33*2)] line-clamp-2 font-medium font-main-400 text-[#474747] group-hover/templateNew_six:text-[var(--html-bg-website)] transition-all duration-300";
$content = "text-[13px] leading-[1.53] h-[calc(13px*1.53*3)] font-normal font-main-400 text-[#717070] ";

foreach ($data as $k => $value) {
    $seoDB = $seo->getSeoDB($value['id'], 'baiviet', 'man', $value["type"]);
    $desc = (isset($seoDB["description_$lang"])) ? $seoDB["description_$lang"] : $seoDB["description"];
?>
    <div class="group/templateNew_six load_website flex items-center gap-4 w-full ">
        <div class="flex-initial w-[49%] overflow-hidden aspect-[273/154] rounded-lg relative leading-[0]">
            <?= $func->addHrefImg([
                'classfix' => 'w-full',
                'addhref' => true,
                'href' =>  $func->getUrl($value),
                'sizes' => '273x154x1',
                'actual_width' => 500,
                'upload' => _upload_baiviet_l,
                'image' => ($value["photo"]),
                'alt' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
            ]); ?>
        </div>
        <div class="flex-1">
            <div class="mb-3">
                <div class="">
                    <div class="w-full flex flex-wrap gap-2 leading-none items-center text-[var(--html-sc-website)] group-hover/templateNew_six:text-[var(--html-bg-website)] text-xs font-main-300 font-light transition-all duration-300">
                        <div class="inline-flex items-center gap-2 text-nowrap">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                    <g clip-path="url(#clip0_1_178)">
                                        <path d="M13.008 0.903809H11.7166V2.19521C11.7166 2.45349 11.5014 2.62568 11.2861 2.62568C11.0709 2.62568 10.8557 2.45349 10.8557 2.19521V0.903809H3.9682V2.19521C3.9682 2.45349 3.75297 2.62568 3.53774 2.62568C3.3225 2.62568 3.10727 2.45349 3.10727 2.19521V0.903809H1.81587C1.17017 0.903809 0.696655 1.46342 0.696655 2.19521V3.74489H14.4716V2.19521C14.4716 1.46342 13.6968 0.903809 13.008 0.903809ZM0.696655 4.64887V12.5264C0.696655 13.3013 1.17017 13.8178 1.85892 13.8178H13.0511C13.7398 13.8178 14.5146 13.2582 14.5146 12.5264V4.64887H0.696655ZM4.52781 11.8807H3.49469C3.3225 11.8807 3.15032 11.7516 3.15032 11.5363V10.4602C3.15032 10.288 3.27946 10.1158 3.49469 10.1158H4.57086C4.74305 10.1158 4.91523 10.2449 4.91523 10.4602V11.5363C4.87219 11.7516 4.74305 11.8807 4.52781 11.8807ZM4.52781 8.00651H3.49469C3.3225 8.00651 3.15032 7.87737 3.15032 7.66214V6.58597C3.15032 6.41379 3.27946 6.2416 3.49469 6.2416H4.57086C4.74305 6.2416 4.91523 6.37074 4.91523 6.58597V7.66214C4.87219 7.87737 4.74305 8.00651 4.52781 8.00651ZM7.97155 11.8807H6.89538C6.72319 11.8807 6.55101 11.7516 6.55101 11.5363V10.4602C6.55101 10.288 6.68015 10.1158 6.89538 10.1158H7.97155C8.14373 10.1158 8.31592 10.2449 8.31592 10.4602V11.5363C8.31592 11.7516 8.18678 11.8807 7.97155 11.8807ZM7.97155 8.00651H6.89538C6.72319 8.00651 6.55101 7.87737 6.55101 7.66214V6.58597C6.55101 6.41379 6.68015 6.2416 6.89538 6.2416H7.97155C8.14373 6.2416 8.31592 6.37074 8.31592 6.58597V7.66214C8.31592 7.87737 8.18678 8.00651 7.97155 8.00651ZM11.4153 11.8807H10.3391C10.1669 11.8807 9.99474 11.7516 9.99474 11.5363V10.4602C9.99474 10.288 10.1239 10.1158 10.3391 10.1158H11.4153C11.5875 10.1158 11.7597 10.2449 11.7597 10.4602V11.5363C11.7597 11.7516 11.6305 11.8807 11.4153 11.8807ZM11.4153 8.00651H10.3391C10.1669 8.00651 9.99474 7.87737 9.99474 7.66214V6.58597C9.99474 6.41379 10.1239 6.2416 10.3391 6.2416H11.4153C11.5875 6.2416 11.7597 6.37074 11.7597 6.58597V7.66214C11.7597 7.87737 11.6305 8.00651 11.4153 8.00651Z" fill="currentColor" />
                                    </g>
                                </svg>
                            </span>
                            <span class="text-[#818080] leading-none pt-[2px]">
                                <?= date('d/m/Y', $value['ngaytao']) ?>
                            </span>
                        </div>
                        <div class="hidden sm:block h-[11px] w-0 border-l border-[#C4BEBE]"></div>
                        <div class="inline-flex items-center gap-2 text-nowrap">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="13" viewBox="0 0 17 13" fill="none">
                                    <path d="M1.04575 6.98168C0.984749 6.7989 0.984749 6.59783 1.04575 6.41505C1.63989 4.81274 2.6484 3.44272 3.94343 2.47868C5.23845 1.51464 6.76168 1 8.32 1C9.87832 1 11.4015 1.51464 12.6966 2.47868C13.9916 3.44272 15.0001 4.81274 15.5942 6.41505C15.6553 6.59783 15.6553 6.7989 15.5942 6.98168C15.0001 8.58399 13.9916 9.95401 12.6966 10.9181C11.4015 11.8821 9.87832 12.3967 8.32 12.3967C6.76168 12.3967 5.23845 11.8821 3.94343 10.9181C2.6484 9.95401 1.63989 8.58399 1.04575 6.98168Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M8.31991 9.14085C9.53267 9.14085 10.5158 8.04736 10.5158 6.69847C10.5158 5.34959 9.53267 4.2561 8.31991 4.2561C7.10716 4.2561 6.12402 5.34959 6.12402 6.69847C6.12402 8.04736 7.10716 9.14085 8.31991 9.14085Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            <span class="text-[#818080] leading-none pt-[2px]">
                                <?= $value['luotxem'] . " lượt xem" ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-2 <?= $title ?>">
                <?= $func->addHref([
                    'class' => "",
                    'href' => $func->getUrl($value),
                    'title' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
                    'seoHeading' => $seoHeading,
                ]) ?>
            </div>
            <div class=" hidden md:block <?= $content ?>">
                <span class='line-clamp-3'>
                    <?= $desc ?>
                </span>
            </div>
        </div>
    </div>
<?php } ?>