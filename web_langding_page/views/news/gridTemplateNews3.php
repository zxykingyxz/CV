<?php

$title = "text-sm sm:text-base leading-normal sm:leading-normal h-[calc(14px*1.5*2)] sm:h-[calc(16px*1.5*2)] line-clamp-2 font-semibold font-main-600 text-[#323232] group-hover/templateNew_three:text-white transition-all duration-300";

foreach ($data as $key => $value) {
    if (!empty($value['id_tacgia'])) {
        $info_tacgia = $db->rawQueryOne("select ten_$lang as ten  from #_baiviet where id=? and type=? and hienthi=1 order by stt asc", array($value['id_tacgia'], 'tac-gia'));
    }
?>
    <div class="group/templateNew_three load_website ">
        <div class=" overflow-hidden rounded-2xl mb-5 relative leading-[0]">
            <div class=" w-full aspect-[367/381]">
                <?= $func->addHrefImg([
                    'classfix' => 'w-full',
                    'addhref' => true,
                    'href' =>  $func->getUrl($value),
                    'sizes' => '367x381x1',
                    'actual_width' => 700,
                    'upload' => _upload_baiviet_l,
                    'image' => ($value["photo"]),
                    'alt' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
                ]); ?>
            </div>
            <div class="absolute top-0 left-0 w-full h-full px-[5%] py-[3%]  flex items-end pointer-events-none">
                <div class="bg-[var(--html-sc-website)] group-hover/templateNew_three:bg-[var(--html-bg-website)] p-2 rounded-lg overflow-hidden w-[80%] min-w-[220px] max-w-full transition-all duration-300">
                    <div class="flex justify-between items-center text-xs text-[#323232] group-hover/templateNew_three:text-white  font-normal font-main-400 pt-1 transition-all duration-300">
                        <div class="inline-flex items-center leading-[0] gap-2">
                            <svg class="group-hover/templateNew_three:*:stroke-white *:transition-all *:duration-300" xmlns="http://www.w3.org/2000/svg" width="19" height="20" viewBox="0 0 19 20" fill="none">
                                <path d="M12.5277 16.8315V15.2482C12.5277 14.4084 12.2116 13.6029 11.649 13.009C11.0864 12.4152 10.3234 12.0815 9.52771 12.0815H5.02771C4.23206 12.0815 3.469 12.4152 2.90639 13.009C2.34378 13.6029 2.02771 14.4084 2.02771 15.2482V16.8315" stroke="#323232" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M7.27771 8.91488C8.93456 8.91488 10.2777 7.49711 10.2777 5.74821C10.2777 3.99931 8.93456 2.58154 7.27771 2.58154C5.62086 2.58154 4.27771 3.99931 4.27771 5.74821C4.27771 7.49711 5.62086 8.91488 7.27771 8.91488Z" stroke="#323232" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M17.0277 16.8317V15.2483C17.0272 14.5467 16.806 13.8651 16.3987 13.3106C15.9915 12.756 15.4213 12.36 14.7777 12.1846" stroke="#323232" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12.5277 2.68457C13.173 2.85898 13.745 3.25513 14.1534 3.81057C14.5619 4.36601 14.7836 5.04914 14.7836 5.75228C14.7836 6.45541 14.5619 7.13855 14.1534 7.69399C13.745 8.24943 13.173 8.64558 12.5277 8.81999" stroke="#323232" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span class="leading-normal"><?= (!empty($info_tacgia['ten'])) ? $info_tacgia['ten'] : "Admin" ?></span>
                        </div>
                        <div class="inline-flex items-center leading-[0] gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                                <g class="group-hover/templateNew_three:*:stroke-white *:transition-all *:duration-300" clip-path="url(#clip0_1_408)">
                                    <path d="M1.292 10.2171C1.22949 10.0487 1.22949 9.86347 1.292 9.69508C1.90077 8.21897 2.93413 6.95686 4.26107 6.06875C5.58802 5.18065 7.14878 4.70654 8.7455 4.70654C10.3422 4.70654 11.903 5.18065 13.2299 6.06875C14.5569 6.95686 15.5902 8.21897 16.199 9.69508C16.2615 9.86347 16.2615 10.0487 16.199 10.2171C15.5902 11.6932 14.5569 12.9553 13.2299 13.8434C11.903 14.7315 10.3422 15.2056 8.7455 15.2056C7.14878 15.2056 5.58802 14.7315 4.26107 13.8434C2.93413 12.9553 1.90077 11.6932 1.292 10.2171Z" stroke="#323232" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M8.74548 12.2061C9.98812 12.2061 10.9955 11.1987 10.9955 9.95605C10.9955 8.71341 9.98812 7.70605 8.74548 7.70605C7.50284 7.70605 6.49548 8.71341 6.49548 9.95605C6.49548 11.1987 7.50284 12.2061 8.74548 12.2061Z" stroke="#323232" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </g>
                            </svg>
                            <span class="leading-normal"><?= ((!empty($value['luotxem'])) ? $value['luotxem'] : 0) . " Lượt Xem" ?></span>
                        </div>
                    </div>
                    <div class="w-full mt-3 mb-4 border-t-2 border-[#979191] group-hover/templateNew_three:border-white transition-all duration-300 "></div>
                    <div class=" <?= $title ?>">
                        <?= $func->addHref([
                            'class' => "",
                            'href' => $func->getUrl($value),
                            'title' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
                            'seoHeading' => $seoHeading,
                        ]) ?>
                    </div>
                </div>
            </div>
            <a href="<?= $func->getUrl($value) ?>" title="<?= (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"] ?>" class="absolute top-0 right-[5%] opacity-0 group-hover/templateNew_three:opacity-100 inline-flex justify-center items-center h-[18%] w-[27%] rounded-b-2xl sm:rounded-b-[32px] bg-[var(--html-bg-website)] transition-all duration-300">
                <span class="text-base font-medium font-main-500 text-white">
                    Xem ngay
                </span>
            </a>
        </div>
    </div>
<?php } ?>