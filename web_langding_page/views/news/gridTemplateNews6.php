<?php

$title = "text-sm leading-[1.78] h-[calc(14px*1.78*2)] line-clamp-2 font-medium font-main-500 text-[#3D3A3A] group-hover/templateNew_six:text-[var(--html-bg-website)] transition-all duration-300";
$content = "text-[14px] leading-[1.78] h-[calc(13px*1.78*3)] font-normal font-main-400 text-[#3D3A3A] ";

foreach ($data as $k => $value) {
    $seoDB = $seo->getSeoDB($value['id'], 'baiviet', 'man', $value["type"]);
    $desc = (isset($seoDB["description_$lang"])) ? $seoDB["description_$lang"] : $seoDB["description"];
    if (!empty($valuealue['id_tacgia'])) {
        $info_tacgia = $db->rawQueryOne("select ten_$lang as ten  from #_baiviet where id=? and type=? and hienthi=1 order by stt asc", array($value['id_tacgia'], 'tac-gia'));
    }
?>
    <div class="group/templateNew_six load_website flex items-center gap-4 w-full ">
        <div class="flex-initial w-[39%] overflow-hidden aspect-[1/1] rounded-lg relative leading-[0]">
            <?= $func->addHrefImg([
                'classfix' => 'w-full',
                'addhref' => true,
                'href' =>  $func->getUrl($value),
                'sizes' => '285x285x1',
                'actual_width' => 800,
                'upload' => _upload_baiviet_l,
                'image' => ($value["photo"]),
                'alt' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
            ]); ?>
        </div>
        <div class="flex-1">
            <div class="mb-2 <?= $title ?>">
                <?= $func->addHref([
                    'class' => "",
                    'href' => $func->getUrl($value),
                    'title' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
                    'seoHeading' => $seoHeading,
                ]) ?>
            </div>
            <div class="mb-3">
                <div class="">
                    <div class="w-full flex gap-2 leading-none items-center text-[#3D3A3A] text-xs font-main-400 font-normal">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="20" viewBox="0 0 18 20" fill="none">
                                <path d="M12 16.9858V15.4025C12 14.5627 11.6839 13.7572 11.1213 13.1633C10.5587 12.5695 9.79565 12.2358 9 12.2358H4.5C3.70435 12.2358 2.94129 12.5695 2.37868 13.1633C1.81607 13.7572 1.5 14.5627 1.5 15.4025V16.9858" stroke="var(--html-bg-website)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M6.75 9.06917C8.40685 9.06917 9.75 7.65141 9.75 5.90251C9.75 4.1536 8.40685 2.73584 6.75 2.73584C5.09315 2.73584 3.75 4.1536 3.75 5.90251C3.75 7.65141 5.09315 9.06917 6.75 9.06917Z" stroke="var(--html-bg-website)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M16.5 16.9858V15.4025C16.4995 14.7009 16.2783 14.0193 15.871 13.4647C15.4638 12.9102 14.8936 12.5142 14.25 12.3387" stroke="var(--html-bg-website)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12 2.83875C12.6453 3.01315 13.2173 3.4093 13.6257 3.96474C14.0342 4.52018 14.2559 5.20332 14.2559 5.90645C14.2559 6.60959 14.0342 7.29272 13.6257 7.84817C13.2173 8.40361 12.6453 8.79976 12 8.97416" stroke="var(--html-bg-website)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        <span><?= (!empty($info_tacgia['ten'])) ? $info_tacgia['ten'] : "Admin" ?></span>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                <g clip-path="url(#clip0_1_178)">
                                    <path d="M13.008 0.903809H11.7166V2.19521C11.7166 2.45349 11.5014 2.62568 11.2861 2.62568C11.0709 2.62568 10.8557 2.45349 10.8557 2.19521V0.903809H3.9682V2.19521C3.9682 2.45349 3.75297 2.62568 3.53774 2.62568C3.3225 2.62568 3.10727 2.45349 3.10727 2.19521V0.903809H1.81587C1.17017 0.903809 0.696655 1.46342 0.696655 2.19521V3.74489H14.4716V2.19521C14.4716 1.46342 13.6968 0.903809 13.008 0.903809ZM0.696655 4.64887V12.5264C0.696655 13.3013 1.17017 13.8178 1.85892 13.8178H13.0511C13.7398 13.8178 14.5146 13.2582 14.5146 12.5264V4.64887H0.696655ZM4.52781 11.8807H3.49469C3.3225 11.8807 3.15032 11.7516 3.15032 11.5363V10.4602C3.15032 10.288 3.27946 10.1158 3.49469 10.1158H4.57086C4.74305 10.1158 4.91523 10.2449 4.91523 10.4602V11.5363C4.87219 11.7516 4.74305 11.8807 4.52781 11.8807ZM4.52781 8.00651H3.49469C3.3225 8.00651 3.15032 7.87737 3.15032 7.66214V6.58597C3.15032 6.41379 3.27946 6.2416 3.49469 6.2416H4.57086C4.74305 6.2416 4.91523 6.37074 4.91523 6.58597V7.66214C4.87219 7.87737 4.74305 8.00651 4.52781 8.00651ZM7.97155 11.8807H6.89538C6.72319 11.8807 6.55101 11.7516 6.55101 11.5363V10.4602C6.55101 10.288 6.68015 10.1158 6.89538 10.1158H7.97155C8.14373 10.1158 8.31592 10.2449 8.31592 10.4602V11.5363C8.31592 11.7516 8.18678 11.8807 7.97155 11.8807ZM7.97155 8.00651H6.89538C6.72319 8.00651 6.55101 7.87737 6.55101 7.66214V6.58597C6.55101 6.41379 6.68015 6.2416 6.89538 6.2416H7.97155C8.14373 6.2416 8.31592 6.37074 8.31592 6.58597V7.66214C8.31592 7.87737 8.18678 8.00651 7.97155 8.00651ZM11.4153 11.8807H10.3391C10.1669 11.8807 9.99474 11.7516 9.99474 11.5363V10.4602C9.99474 10.288 10.1239 10.1158 10.3391 10.1158H11.4153C11.5875 10.1158 11.7597 10.2449 11.7597 10.4602V11.5363C11.7597 11.7516 11.6305 11.8807 11.4153 11.8807ZM11.4153 8.00651H10.3391C10.1669 8.00651 9.99474 7.87737 9.99474 7.66214V6.58597C9.99474 6.41379 10.1239 6.2416 10.3391 6.2416H11.4153C11.5875 6.2416 11.7597 6.37074 11.7597 6.58597V7.66214C11.7597 7.87737 11.6305 8.00651 11.4153 8.00651Z" fill="var(--html-bg-website)" />
                                </g>
                            </svg>
                        </span>
                        <span>
                            <?= date('d/m/Y', $value['ngaytao']) ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="mb-4 hidden lg:block <?= $content ?>">
                <span class='line-clamp-3'>
                    <?= $desc ?>
                </span>
            </div>
            <div class="">
                <a href="<?= $func->getUrl($value) ?>" title="<?= (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"] ?>" class=" h-9 sm:h-10 inline-flex justify-center items-center leading-none bg-inherit text-[var(--html-bg-website)] border border-[var(--html-bg-website)] text-sm rounded-lg  font-medium font-main-500 group/button px-6 gap-2 hover:bg-[var(--html-bg-website)]  hover:text-white transition-all duration-300 ">
                    <span>Xem chi tiết</span>
                </a>
            </div>
        </div>
    </div>
<?php } ?>