<?php
$title = " text-sm sm:text-base leading-normal sm:leading-normal h-[calc(14px*1.5*2)] sm:h-[calc(16px*1.5*2)] line-clamp-2 font-semibold font-main-600 text-[#424040] group-hover/templatePost_five:text-[var(--html-cl-website)] transition-all duration-300";

foreach ($data as $k => $v) {
?>
    <div class="group/templatePost_five load_website relative bg-[var(--html-sc-website)] rounded-lg overflow-hidden">
        <div class=" overflow-hidden rounded-lg relative mb-5  bg-inherit">
            <?= $func->addHrefImg([
                'classfix' => 'w-full',
                'addhref' => true,
                'href' =>  $func->getUrl($v),
                'sizes' => '215x224x1',
                'actual_width' => 600,
                'upload' => _upload_baiviet_l,
                'image' => ($v["photo"]),
                'alt' => (isset($v["ten_$lang"])) ? $v["ten_$lang"] : $v["ten"],
            ]); ?>
            <div class="absolute bottom-0 right-0 pointer-events-none">
                <div class="bg-[var(--html-sc-website)] rounded-t-[30px] rounded-bl-[30px] overflow-hidden border-[6px] border-[var(--html-sc-website)] ">
                    <div class=" w-[54px] aspect-[1/1] bg-white group-hover/templatePost_five:bg-[var(--html-bg-website)] rounded-full overflow-hidden border border-[var(--html-bg-website)] inline-flex justify-center items-center leading-[0] transition-all duration-500">
                        <span class="text-lg sm:text-xl text-[var(--html-bg-website)] group-hover/templatePost_five:text-white font-bold font-main-700 transition-all duration-500">
                            <?= sprintf("%02d", $v['stt']) ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="text-center mb-3 sm:mb-5">
                <?= $func->addHref([
                    'class' => $title,
                    'href' => $func->getUrl($v),
                    'title' => (isset($v["ten_$lang"])) ? $v["ten_$lang"] : $v["ten"],
                    'seoHeading' => $seoHeading,
                ]) ?>
            </div>
            <div class=" flex justify-center items-center ">
                <a href="<?= $func->getUrl($v) ?>" title="<?= (isset($v["ten_$lang"])) ? $v["ten_$lang"] : $v["ten"] ?>" class="cursor-pointer text-base inline-flex leading-[0] font-bold font-main-700 text-[var(--html-bg-website)] justify-center items-center bg-white h-9 sm:h-11 rounded-[100px] px-8 sm:px-11 border border-[var(--html-bg-website)] group-hover/templatePost_five:text-white relative  transition-all duration-300 z-10 overflow-hidden ">
                    <div class="absolute top-0 left-0 w-full h-full opacity-0  group-hover/templatePost_five:opacity-100  pointer-events-nfive z-[-1] transition-all duration-500" style="background: var(--color-linear-button);"></div>
                    <span class="whitespace-nowrap">Xem Ngay</span>
                </a>
            </div>
        </div>
    </div>
<?php } ?>