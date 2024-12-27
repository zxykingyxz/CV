<?php
foreach ($data as $k => $v) {
?>

    <div class="group/viewed items_viewed relative border border-gray-200 rounded-2xl px-2 py-4 o-hidden load_website flex gap-2 <?= $class ?> ">
        <div class="remove_viewed group-hover/viewed:opacity-100 absolute top-1 opacity-0 right-1 z-10 cursor-pointer transition-all duration-300" data-value="<?= $v['id'] ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none">
                <path d="M9 16.989C13.1421 16.989 16.5 13.6311 16.5 9.48901C16.5 5.34688 13.1421 1.98901 9 1.98901C4.85786 1.98901 1.5 5.34688 1.5 9.48901C1.5 13.6311 4.85786 16.989 9 16.989Z" fill="#979797" />
                <path d="M11.25 7.23901L6.75 11.739" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M6.75 7.23901L11.25 11.739" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
        <div class='img-template w-3/12 min-w-[100px] zoom'>
            <?= $func->addHrefImg([
                'addhref' => true,
                'href' =>  $func->getUrl($v),
                'sizes' => '400x400x1',
                'isLazy' => true,
                'upload' => _upload_baiviet_l,
                'image' => ($v["photo"]),
                'alt' => (isset($v["ten_$lang"])) ? $v["ten_$lang"] : $v["ten"],
            ]); ?>
        </div>
        <div class='flex-1 h-full  flex flex-wrap flex-col py-2 '>
            <div class='w-full'>
                <?= $func->addHref([
                    'class' => "text-[13px] leading-relaxed font-normal font-main-400 line-clamp-2 ",
                    'href' => $func->getUrl($v),
                    'title' => (isset($v["ten_$lang"])) ? $v["ten_$lang"] : $v["ten"],
                    'seoHeading' => $seoHeading,
                ]) ?>
            </div>
            <div class="f1"></div>
            <div class="mt-3">
                <div class='text-[#DD2F2C] text-base sm:text-lg font-bold font-main-700 leading-none'>
                    <?= (($v['giaban']) != 0) ? $func->money($v['giaban']) . '<sup class="underline">đ</sup>' : 'Liên hệ' ?>
                </div>
            </div>
            <div class="mt-2 flex items-center gap-3">
                <del class='text-[#8A8888] text-[13px] leading-none font-normal font-main-400 h-4 block'>
                    <?= (($v['giacu']) != 0) ? $func->money($v['giacu']) . '<sup class="underline">đ</sup>' : ' ' ?>
                </del>
                <div class="text-[13px] text-[#DD2F2C] font-medium font-main-500 leading-tight">
                    <span>
                        <?= ($v['giaban'] < $v['giacu']) ? "-" . floor((($v['giacu'] - $v['giaban']) / $v['giacu']) * 100) . "%" : "" ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
<?php } ?>