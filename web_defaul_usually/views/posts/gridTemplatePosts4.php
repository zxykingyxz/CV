<?php
$title = "text-sm sm:text-base line-clamp-2 font-medium font-main-500 text-black group-hover/templatePost_four:text-[var(--html-bg-website)] transition-all duration-300";

foreach ($data as $key => $value) {
    if (!empty($value['id_list'])) {
        $info_list = $db->rawQueryOne("select ten_$lang as ten  from #_baiviet_list where id=? and type=? and hienthi=1 order by stt asc", array($value['id_list'], 'du-an'));
    }

?>
    <div class="group/templatePost_four load_website relative bg-white  mb-5 sm:mb-[35px] ">
        <div class="w-full aspect-[400/438] overflow-hidden relative mb-2 border border-gray-200 leading-[0]">
            <?= $func->addHrefImg([
                'classfix' => 'w-full',
                'addhref' => true,
                'href' =>  $func->getUrl($value),
                'sizes' => '400x438x1',
                'actual_width' => 600,
                'upload' => _upload_baiviet_l,
                'image' => ($value["photo"]),
                'alt' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
            ]); ?>
            <div class="absolute top-0 left-0 w-full h-full bg-[#18181880] inline-flex justify-center items-center text-center leading-[0] pointer-events-none scale-95 opacity-0 group-hover/templatePost_four:scale-100 group-hover/templatePost_four:opacity-100 transition-all duration-300">
                <div class="inline-flex justify-center items-center text-white text-sm font-normal font-main-400 gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                        <path d="M2.87476 12.6316C2.79142 12.407 2.79142 12.1601 2.87476 11.9356C3.68646 9.96742 5.06428 8.2846 6.83353 7.10046C8.60279 5.91632 10.6838 5.28418 12.8128 5.28418C14.9417 5.28418 17.0227 5.91632 18.792 7.10046C20.5612 8.2846 21.9391 9.96742 22.7508 11.9356C22.8341 12.1601 22.8341 12.407 22.7508 12.6316C21.9391 14.5997 20.5612 16.2825 18.792 17.4667C17.0227 18.6508 14.9417 19.2829 12.8128 19.2829C10.6838 19.2829 8.60279 18.6508 6.83353 17.4667C5.06428 16.2825 3.68646 14.5997 2.87476 12.6316Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M12.8127 15.2834C14.4696 15.2834 15.8127 13.9403 15.8127 12.2834C15.8127 10.6266 14.4696 9.28345 12.8127 9.28345C11.1559 9.28345 9.81274 10.6266 9.81274 12.2834C9.81274 13.9403 11.1559 15.2834 12.8127 15.2834Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="">
                        Xem chi tiết
                    </span>
                </div>
            </div>
        </div>
        <div class="">
            <div class="text-center">
                <?= $func->addHref([
                    'class' => $title,
                    'href' => $func->getUrl($value),
                    'title' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
                    'seoHeading' => $seoHeading,
                ]) ?>
            </div>
        </div>
    </div>
<?php } ?>