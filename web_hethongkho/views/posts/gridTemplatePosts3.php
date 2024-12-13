<?php
$title_sup = "text-sm sm:text-base leading-[1.8] line-clamp-2 font-medium font-main-500 text-white transition-all duration-300";
$title = "text-lg sm:text-xl leading-normal line-clamp-2 font-semibold font-main-600 text-white transition-all duration-300";
$content = "text-sm leading-relaxed line-clamp-3 font-normal font-main-400 text-black ";

foreach ($data as $key => $value) {
    if (!empty($value['id_list'])) {
        $info_list = $db->rawQueryOne("select ten_$lang as ten  from #_baiviet_list where id=? and type=? and hienthi=1 order by stt asc", array($value['id_list'], 'du-an'));
    }

?>
    <div class="group/templatePost_three relative bg-white ">
        <div class=" overflow-hidden">
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
        </div>
        <div class="absolute pointer-events-none top-0 left-0 w-full h-full bg-[#18181880] px-3 py-5">
            <div class="w-full h-full flex flex-col">
                <div class="flex-initial min-h-[11%] group-hover/templatePost_three:flex-1 transition-all duration-500"></div>
                <?php if (!empty($info_list['ten'])) { ?>
                    <div class="mb-[10px] <?= $title_sup ?>">
                        <span>
                            <?= $info_list['ten'] ?>
                        </span>
                    </div>
                <?php } ?>
                <div class="">
                    <?= $func->addHref([
                        'class' => $title,
                        'href' => $func->getUrl($value),
                        'title' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
                        'seoHeading' => $seoHeading,
                    ]) ?>
                </div>
                <div class="flex-1 min-h-2 group-hover/templatePost_three:flex-initial transition-all duration-500"></div>
                <div class="flex justify-end">
                    <a href="<?= $func->getUrl($value) ?> " title="<?= (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"] ?>" class=" inline-flex leading-[0] justify-center items-center px-6 py-[6px]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="44" height="23" viewBox="0 0 44 23" fill="none">
                            <path d="M2.3833 10.2769C1.55487 10.2769 0.883301 10.9484 0.883301 11.7769C0.883301 12.6053 1.55487 13.2769 2.3833 13.2769L2.3833 10.2769ZM42.7295 12.8375C43.3153 12.2517 43.3153 11.302 42.7295 10.7162L33.1835 1.17026C32.5978 0.58447 31.648 0.584469 31.0622 1.17026C30.4764 1.75604 30.4764 2.70579 31.0622 3.29158L39.5475 11.7769L31.0622 20.2621C30.4764 20.8479 30.4764 21.7977 31.0622 22.3835C31.648 22.9692 32.5978 22.9692 33.1835 22.3835L42.7295 12.8375ZM2.3833 13.2769L41.6688 13.2769L41.6688 10.2769L2.3833 10.2769L2.3833 13.2769Z" fill="white" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>