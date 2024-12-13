<?php

$title = "text-sm sm:text-base leading-normal sm:leading-normal h-[calc(14px*1.5*2)] sm:h-[calc(16px*1.5*2)] line-clamp-2 font-medium font-main-500 text-[var(--html-bg-website)] transition-all duration-300";
$content = "text-xs sm:text-sm leading-[1.78] sm:leading-[1.78] h-[calc(12px*1.78*3)] sm:h-[calc(14px*1.78*3)] line-clamp-3 font-normal font-main-400 text-[#3D3A3A] ";

foreach ($data as $k => $value) {
    $seoDB = $seo->getSeoDB($value['id'], 'baiviet', 'man', $value["type"]);
    $desc = (isset($seoDB["description_$lang"])) ? $seoDB["description_$lang"] : $seoDB["description"];
    if (!empty($valuealue['id_tacgia'])) {
        $info_tacgia = $db->rawQueryOne("select ten_$lang as ten  from #_baiviet where id=? and type=? and hienthi=1 order by stt asc", array($value['id_tacgia'], 'tac-gia'));
    }
?>
    <div class="group/templateNew_two  ">
        <div class=" overflow-hidden rounded mb-5 relative leading-[0]">
            <?= $func->addHrefImg([
                'classfix' => 'w-full',
                'addhref' => true,
                'href' =>  $func->getUrl($value),
                'sizes' => '387x305x1',
                'actual_width' => 600,
                'upload' => _upload_baiviet_l,
                'image' => ($value["photo"]),
                'alt' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
            ]); ?>
        </div>
        <div>
            <div class="mb-3">
                <div class="">
                    <div class="w-full flex gap-2 leading-none items-center text-[#3D3A3A] text-xs font-main-400 font-normal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
                            <path d="M6.79102 2.17108V5.50441" stroke="var(--html-bg-website)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M13.582 2.17108V5.50441" stroke="var(--html-bg-website)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M16.129 3.83771H4.24465C3.30699 3.83771 2.54688 4.5839 2.54688 5.50437V17.171C2.54688 18.0915 3.30699 18.8377 4.24465 18.8377H16.129C17.0667 18.8377 17.8268 18.0915 17.8268 17.171V5.50437C17.8268 4.5839 17.0667 3.83771 16.129 3.83771Z" stroke="var(--html-bg-website)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M2.54688 8.83771H17.8268" stroke="var(--html-bg-website)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M6.79102 12.1711H6.79935" stroke="var(--html-bg-website)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M10.1865 12.1711H10.1949" stroke="var(--html-bg-website)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M13.582 12.1711H13.5904" stroke="var(--html-bg-website)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M6.79102 15.5044H6.79935" stroke="var(--html-bg-website)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M10.1865 15.5044H10.1949" stroke="var(--html-bg-website)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M13.582 15.5044H13.5904" stroke="var(--html-bg-website)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span>
                            <?= date('F j, Y', $value['ngaytao']) ?>
                        </span>
                        <span>-</span>
                        <span><?= (!empty($info_tacgia['ten'])) ? $info_tacgia['ten'] : "Admin" ?></span>
                    </div>
                </div>
            </div>
            <div class="mb-3 <?= $title ?>">
                <?= $func->addHref([
                    'class' => "",
                    'href' => $func->getUrl($value),
                    'title' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
                    'seoHeading' => $seoHeading,
                ]) ?>
            </div>
            <div class="mb-6 <?= $content ?>">
                <span class=''>
                    <?= $desc ?>
                </span>
            </div>
            <div class="">
                <a href="<?= $func->getUrl($value) ?>" title="<?= (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"] ?>" class=" h-9 sm:h-10 inline-flex justify-center items-center leading-none gap-2 bg-inherit text-[#3D3A3A] text-base rounded  font-medium font-main-500 group/button hover:px-3 hover:gap-4 hover:bg-[var(--html-bg-website)]  hover:text-white transition-all duration-300 ">
                    <span>Xem ngay</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="25" viewBox="0 0 26 25" fill="none">
                        <g clip-path="url(#clip0_1_998)" class="transition-all duration-300  group-hover/button:*:stroke-[#ffffff]">
                            <path d="M2.14551 12.5044L23.2873 12.5044" stroke="#3D3A3A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M16.1567 5.50439L24.306 12.5044L16.1567 19.5044" stroke="#3D3A3A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </g>
                    </svg>
                </a>
            </div>
        </div>
    </div>
<?php } ?>