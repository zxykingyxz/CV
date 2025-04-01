<?php
$title = "text-[#3C3C3C]  text-xs sm:text-sm leading-normal sm:leading-normal h-[calc(12px*1.5*2)] sm:h-[calc(14px*1.5*2)] font-main-400 font-normal hover:text-[var(--html-bg-website)] line-clamp-2 transition-all duration-300 ";
if ($bgWhite) {
    $class_bg = "bg-white";
} else {
    $class_bg = "bg-[#F7F3F3]";
}
foreach ($data as $key => $value) {
?>
    <div class="h-full ">
        <div class="group/templateProduct_Two  load_website h-full overflow-hidden <?= $class_bg ?>  p-3 rounded-xl transition-all duration-300   <?= $class ?> ">
            <div class='relative z-10 w-full aspect-[236/273] overflow-hidden rounded-md '>
                <div class="  absolute top-0 left-0 w-full h-full  z-20 group-hover/templateProduct_Two:z-10 transition-all duration-300 ">
                    <?= $func->addHrefImg([
                        'classfix' => '',
                        'addhref' => true,
                        'href' =>  $func->getUrl($value),
                        'isLazy' => true,
                        'sizes' => "235x273x1",
                        'actual_width' => 400,
                        'upload' => _upload_baiviet_l,
                        'image' => ($value["photo"]),
                        'alt' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
                    ]); ?>
                </div>
                <?php if (!empty($value["photo2"])) { ?>
                    <div class=" absolute top-0 left-0 w-full h-full bg-white z-10 group-hover/templateProduct_Two:z-20 transition-all duration-300">
                        <?= $func->addHrefImg([
                            'classfix' => 'w-full',
                            'addhref' => true,
                            'href' =>  $func->getUrl($value),
                            'isLazy' => true,
                            'sizes' => "235x273x1",
                            'actual_width' => 400,
                            'upload' => _upload_baiviet_l,
                            'image' => ($value["photo2"]),
                            'alt' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
                        ]); ?>
                    </div>
                <?php } ?>
                <?php if ($value["banchay"] == 1) { ?>
                    <div class=" absolute top-0 left-[10px] w-[39px] h-[48px] text-center text-xs text-white font-normal font-main-400 z-30 p-1 pb-4" style="clip-path: polygon(0 0,100% 0,100% calc(100% - 12px),50% 100%,0 calc(100% - 12px));background: linear-gradient(180deg, #D32F2F 0%, #FF5A26 100%);">
                        <div class="">Bán</div>
                        <div class="">Chạy</div>
                    </div>
                <?php } ?>
            </div>
            <div class="mt-4">
                <div>
                    <?= $func->addHref([
                        'class' => $title,
                        'href' => $func->getUrl($value),
                        'title' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
                        'seoHeading' => $seoHeading,
                    ]) ?>
                </div>
                <div class="mt-2">
                    <div class='text-[var(--html-sc-website)] text-base font-medium font-main-500 leading-none transition-all duration-300'>
                        <?= (($value['giaban']) != 0) ? $func->money($value['giaban'], " VNĐ") : 'Liên hệ' ?>
                    </div>
                </div>
                <div class="mt-2">
                    <div class='text-[#3C3C3C] text-[13px]  font-light font-main-300 leading-none '>
                        <span><?= "Mã sản phẩm: " . (!empty($value['masp']) ? $value['masp'] : "Đang cập nhật") ?></span>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="js-buynow cursor-pointer h-[40px] w-full rounded-md sm:rounded-[14px] bg-[var(--html-sc-website)] text-white hover:bg-[var(--html-bg-website)]  text-sm font-normal font-main-400 inline-flex justify-center items-center leading-[0] transition-all duration-300" data-id="<?= $value['id'] ?>" data-qty="1">
                        <span class="leading-none">Mua Ngay</span>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="js-addcart cursor-pointer h-[40px] w-full rounded-md sm:rounded-[14px] border border-[var(--html-sc-website)] bg-white text-[var(--html-sc-website)] hover:border-[var(--html-bg-website)]  hover:text-[var(--html-bg-website)] text-sm font-normal font-main-400 inline-flex justify-center items-center leading-[0] transition-all duration-300" data-id="<?= $value['id'] ?>" data-qty="1">
                        <span class="leading-none">Thêm vào giỏ</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>