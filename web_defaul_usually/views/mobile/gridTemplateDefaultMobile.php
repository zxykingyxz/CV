<?php
foreach ($data as $k => $v) {
    if (!empty($v['giaban'])) {
        $price_tmp =  $v['giaban'];
        $price = ($price_tmp > 0) ? $func->changeMoney($price_tmp, $lang) .  ($v['donvitinh'] != '' ? $v['donvitinh']  : '')  : 'Liên hệ: ' . $row_setting['hotline'];
        $old_price = ($v["giacu"] > 0) ? $func->changeMoney($v["giacu"], $lang) .  ($v['donvitinh'] != '' ? $v['donvitinh'] : '') : '';
    }
    if ((!empty($v['giaban'])) && !empty($v['rating'])) {
        $check_add = true;
    } else {
        $check_add = false;
    }
?>

    <div class="template-default o-hidden load_website flex gap-3 <?= $class ?> ">
        <div class='img-template w-3/12 aspect-[1/1] min-w-[100px] overflow-hidden'>
            <?= $func->addHrefImg([
                'addhref' => true,
                'class-fix' =>  "w-full",
                'href' =>  $func->getUrl($v),
                'sizes' => '400x400x1',
                'isLazy' => true,
                'upload' => _upload_baiviet_l,
                'image' => ((isset($v["photo_$lang"])) ? $v["photo_$lang"] : $v["photo"]),
                'alt' => (isset($v["ten_$lang"])) ? $v["ten_$lang"] : $v["ten"],
            ]); ?>
        </div>
        <div class='flex-1 h-full  flex flex-wrap flex-col py-2 '>
            <div class='w-full'>
                <?= $func->addHref([
                    'class' => "text-sm leading-relaxed font-normal font-main-400 line-clamp-3 ",
                    'href' => $func->getUrl($v),
                    'title' => (isset($v["ten_$lang"])) ? $v["ten_$lang"] : $v["ten"],
                    'seoHeading' => $seoHeading,
                ]) ?>
            </div>
            <?php if (!empty($v['rating'])) { ?>
                <div class="">
                    <span class='color-star' style='--rating:<?= $func->getRating($v['rating']) ?>'>
                    </span>
                </div>
            <?php } ?>
            <?php if (!empty($v['giaban'])) { ?>
                <div class='flex flex-wrap items-center gap-1 mb-1'>
                    <div class='text-sm font-semibold font-main-600 text-red-600'>
                        <?= $price ?>
                    </div>
                    <?php if ($v["giacu"] > 0) { ?>
                        <div class="text-xs font-medium font-main-500 text-gray-400">
                            <del class='price-old-template '>
                                <?= $old_price ?>
                            </del>
                            <span class="text-gray-400">
                                (-<?= floor(($v['giaban'] / $v["giacu"]) * 100) ?>%)
                            </span>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            <?php if (!empty($v['ngaytao']) && $check_add == false) { ?>
                <div class="text-sm font-normal font-main-400  inline-flex items-center mb-1 ">
                    <i class="fa-light fa-calendar-clock mr5"></i>
                    <span class="">
                        <?= date('d/m/Y', $v['ngaytao']) ?>
                    </span>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>