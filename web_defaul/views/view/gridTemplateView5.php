<?php
$title = " text-sm sm:text-base leading-normal sm:leading-normal h-[calc(14px*1.5*1)] sm:h-[calc(16px*1.5*1)]  line-clamp-1 font-medium font-main-500 text-[#000] group-hover/templateView_five:text-[var(--html-cl-website)] transition-all duration-300";
$content = "text-sm sm:text-base h-[calc(14px*2*1)] sm:h-[calc(16px*2*1)] leading-normal sm:leading-normal line-clamp-1 font-normal font-main-400 text-[#000] ";

foreach ($data as $k => $v) {
?>
    <div class="group/templateView_five relative bg-white">
        <div class=" overflow-hidden rounded-lg relative mb-5">
            <?= $func->addHrefImg([
                'classfix' => 'w-full',
                'addhref' => true,
                'href' => !empty($value["link"]) ? $value["link"] : $jv0,
                'target' => !empty($value["link"]) ? '_blank' : "",
                'sizes' => '215x224x1',
                'actual_width' => 600,
                'upload' => _upload_hinhanh_l,
                'image' => ($v["photo"]),
                'alt' => (isset($v["ten_$lang"])) ? $v["ten_$lang"] : $v["ten"],
            ]); ?>
            <div class="absolute bottom-0 right-0 pointer-events-none ">
                <div class="bg-white rounded-t-[30px] rounded-bl-[30px] overflow-hidden border-[6px] border-white ">
                    <div class=" w-[54px] aspect-[1/1] bg-[var(--html-bg-website)] rounded-full overflow-hidden border border-[var(--html-bg-website)] inline-flex justify-center items-center leading-[0] transition-all duration-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                            <path d="M12.5051 11.2163V15.2163" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M14.5051 13.2163H10.5051" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M16.5051 6.21631V4.21631C16.5051 3.68588 16.2944 3.17717 15.9193 2.80209C15.5443 2.42702 15.0356 2.21631 14.5051 2.21631H10.5051C9.97469 2.21631 9.46599 2.42702 9.09091 2.80209C8.71584 3.17717 8.50513 3.68588 8.50513 4.21631V6.21631" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M18.5051 6.21631V20.2163" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M6.50513 6.21631V20.2163" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M20.5051 6.21631H4.50513C3.40056 6.21631 2.50513 7.11174 2.50513 8.21631V18.2163C2.50513 19.3209 3.40056 20.2163 4.50513 20.2163H20.5051C21.6097 20.2163 22.5051 19.3209 22.5051 18.2163V8.21631C22.5051 7.11174 21.6097 6.21631 20.5051 6.21631Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="text-center mb-3">
                <?= $func->addHref([
                    'class' => $title,
                    'href' => $func->getUrl($v),
                    'title' => (isset($v["ten_$lang"])) ? $v["ten_$lang"] : $v["ten"],
                    'seoHeading' => $seoHeading,
                ]) ?>
            </div>
            <div class="text-center <?= $content ?> ">
                <span class="">
                    <?= (isset($v["mota_$lang"])) ? htmlspecialchars_decode($v["mota_$lang"]) : htmlspecialchars_decode($v['mota']) ?>
                </span>
            </div>
        </div>
    </div>
<?php } ?>