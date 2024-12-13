<?php
global $flash_sale;
foreach ($data as $k => $v) {
    $additional = (!empty($v['id']) && !empty($flash_sale['id_product']) && in_array($v['id'], explode(',', $flash_sale['id_product']))) ? 1 : 0;
    $list_name_c2_sp = $cache->getCache("select  ten_$lang as ten  from #_baiviet_list where  type=? and id=?  order by stt asc", array('san-pham', $v['id_list']), 'fetch', _TIMECACHE);
?>
    <div class="h-full">
        <div class="group/templateProduct_One h-full group overflow-hidden bg-white border border-transparent hover:border-main transition-all duration-500 rounded-lg  <?= $class ?> ">
            <div class='relative w-full aspect-[510/510] '>
                <div class="absolute w-full aspect-[510/510] z-20 group-hover/templateProduct_One:z-10 transition-all duration-300 ">
                    <?= $func->addHrefImg([
                        'classfix' => 'w-full',
                        'addhref' => true,
                        'href' =>  $func->getUrl($v),
                        'isLazy' => true,
                        'sizes' => "510x510x1",
                        'actual_width' => 800,
                        'upload' => _upload_baiviet_l,
                        'image' => ((isset($v["photo_$lang"])) ? $v["photo_$lang"] : $v["photo"]),
                        'alt' => (isset($v["ten_$lang"])) ? $v["ten_$lang"] : $v["ten"],
                    ]); ?>
                </div>
                <?php if (!empty($v["photo2"])) { ?>
                    <div class="absolute  w-full aspect-[510/510] z-10 group-hover/templateProduct_One:z-20 transition-all duration-300">
                        <?= $func->addHrefImg([
                            'classfix' => 'w-full',
                            'addhref' => true,
                            'href' =>  $func->getUrl($v),
                            'isLazy' => true,
                            'sizes' => "510x510x1",
                            'actual_width' => 800,
                            'upload' => _upload_baiviet_l,
                            'image' => ((isset($v["photo2_$lang"])) ? $v["photo2_$lang"] : $v["photo2"]),
                            'alt' => (isset($v["ten_$lang"])) ? $v["ten_$lang"] : $v["ten"],
                        ]); ?>
                    </div>
                <?php } ?>
            </div>
            <div class='p-3'>
                <?= $func->addHref([
                    'class' => 'text-black font-main-600 text-[14px] transition-all duration-500 group-hover:color-main capitalize leading-normal line-clamp-2 h-[calc(14px*1.5*2)]',
                    'href' => $func->getUrl($v),
                    'title' => (isset($v["ten_$lang"])) ? $v["ten_$lang"] : $v["ten"],
                    'seoHeading' => $seoHeading,
                ]) ?>
                <div class='flex flex-wrap items-center flex-col sm:flex-row gap-2'>
                    <div class='w-full md:w-auto text-red-500 font-main-600 text-[14px] font-semibold'>
                        <?= ((($additional == 1) ? $v['giabansale'] : $v['giaban']) != 0) ? $func->changeMoney(($additional == 1) ? $v['giabansale'] : $v['giaban'], $lang) . ' <span class="underline">' . $v['donvitinh'] . '</span>' : 'Liên hệ' ?>
                    </div>
                    <del class='w-full md:w-auto text-gray-300 font-main-600 text-[14px] font-semibold'>
                        <?= $v["giacu"] > 0 ? $func->changeMoney($v["giacu"], '') .  ($v['donvitinh'] != '' ? ' <span class="underline">' . $v['donvitinh'] . '</span>' : '') : '' ?>
                    </del>
                </div>
            </div>
        </div>
    </div>
<?php } ?>