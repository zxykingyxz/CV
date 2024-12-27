<?php
$photos = $cache->getCache("select id,photo from #_baiviet_photo where type=? and id_baiviet=? order by stt asc, id desc", array($data['type'], $data['id']), 'result', _TIMECACHE);
?>

<div class="form_view_info_product w-full <?= (!empty($background)) ? $background : 'bg-white' ?> py-4 px-3">
    <div class="<?= $close_popup ?> absolute inline-flex justify-center items-center h-7 aspect-[1/1] top-3 right-3 rounded-full bg-inherit cursor-pointer hover:bg-red-600 hover:text-white transition-all text-base z-10 ">
        <span>
            <i class="fas fa-times"></i>
        </span>
    </div>
    <div class="h-5"></div>
    <div class="flex flex-wrap gap-3">
        <div class="w-full md:w-4/12">
            <?= $func->getTemplateLayoutsFor([
                'name_layouts' => 'templateImagesDetail',
                'data' => $data,
                'photos' => $photos,
                'watermark' => false,
            ]) ?>
        </div>
        <div class="flex-1">
            <div class="text-base sm:text-2xl text-black font-bold font-main-700">
                <span class="line-clamp-1">
                    <?= $data['ten'] ?>
                </span>
            </div>
            <div class="mt-2 flex gap-3 items-start">
                <div class='text-[#DD2F2C] text-lg sm:text-xl font-bold font-main-700 leading-none'>
                    <?= (($data['giaban']) != 0) ? $func->money($data['giaban']) . '<sup class="underline">đ</sup>' : 'Liên hệ' ?>
                </div>
                <del class='text-[#8A8888] text-lg sm:text-xl leading-none font-normal font-main-400 h-4 block'>
                    <?= (($data['giacu']) != 0) ? $func->money($data['giacu']) . '<sup class="underline">đ</sup>' : ' ' ?>
                </del>
                <div class="text-[13px] text-[#DD2F2C] font-medium font-main-500 leading-none">
                    <span>
                        <?= ($data['giaban'] < $data['giacu']) ? "-" . floor((($data['giacu'] - $data['giaban']) / $data['giacu']) * 100) . "%" : "" ?>
                    </span>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3 mt-3">
                <div class="text-sm sm:text-base font-bold font-main-700 w-full cursor-pointer h-10 sm:h-12 px-3 rounded-md border border-[var(--html-bg-website)] bg-white text-[var(--html-bg-website)] inline-flex justify-center items-center leading-[0] hover:bg-[var(--html-bg-website)]  hover:text-white transition-all duration-300 js-addcart" data-id="<?= $data['id'] ?>" data-qty="1">
                    <span>
                        Thêm giỏ hàng
                    </span>
                </div>
                <div class="text-sm sm:text-base font-bold font-main-700 w-full cursor-pointer  h-10 sm:h-12 px-3 rounded-md border border-black bg-black text-white inline-flex justify-center items-center leading-[0] hover:bg-[var(--html-bg-website)]  hover:border-[var(--html-bg-website)] transition-all duration-300 js-buynow" data-id="<?= $data['id'] ?>" data-qty="1">
                    <span>
                        Mua ngay
                    </span>
                </div>
            </div>
            <div class="mt-5 content text-base">
                <span>
                    <?= $func->htmlDecodeContent($data['thongsokythuat']) ?>
                </span>
            </div>
        </div>
    </div>
</div>