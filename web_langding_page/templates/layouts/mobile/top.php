<?php
global $logo_mobile;
$text_top = $cache->getCache("select photo , ten_$lang as ten , mota_$lang as mota ,link from #_bannerqc where type=? and hienthi<>0", array('text_top'), 'fetch', _TIMECACHE);

$list_c1_product_menu = $cache->getCache("select id,type,photo,ten_$lang as ten , tenkhongdau_$lang as tenkhongdau from #_baiviet_list where type in ('san-pham') and hienthi=1 order by stt asc", array(), 'result', _TIMECACHE);

$socical_menu = $cache->getCache("select id,photo as photo,ten_$lang as ten,mota_$lang as mota,link from #_photo where hienthi=1 and type=?", array('mangxahoi_menu'), 'result', _TIMECACHE);
?>
<section class="section-topmobile py-2 w-full fixed top-0 left-0 z-40 shadow-md " mobile style="background: linear-gradient(180deg, #000 0%, rgba(0, 0, 0, 0.00) 100%);">
    <div class="grid_s wide">
        <div class="w-full flex items-center justify-between relative gap-2">
            <div class="group/DM flex-initial leading-[0] relative">
                <div class=" inline-flex justify-center items-center leading-none gap-4 text-xl font-normal font-main-400 text-[var(--html-bg-website)] cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="47" height="47" viewBox="0 0 47 47" fill="none">
                        <path d="M5 11H40.25" stroke="var(--html-bg-website)" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M5 22.75H40.25" stroke="var(--html-bg-website)" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M5 34.5H40.25" stroke="var(--html-bg-website)" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="hidden">
                        <?php if ($source == 'index') { ?>
                            <h2>
                            <?php } ?>
                            <span>Sản Phấm</span>
                            <?php if ($source == 'index') { ?>
                            </h2>
                        <?php } ?>
                    </div>
                </div>
                <div class="opacity-0 invisible  group-hover/DM:opacity-100 group-hover/DM:visible  absolute top-full left-0 bg-white shadow-md shadow-gray-300 border border-gray-200 rounded-md overflow-hidden flex transition-all duration-300 ">
                    <div class="w-[250px] bg-white ">
                        <div class="grid grid-cols-1 ">
                            <?php foreach ($list_c1_product_menu as $key => $value) { ?>
                                <div class=" bg-inherit [&.on]:bg-white [&.on]:text-[var(--html-cl-website)] w-full first:border-none border-t border-gray-300 btn_menu transition-all duration-300 btn_scroll" data-target="sanpham_dmc1_<?= $value['id'] ?>">
                                    <?php if ($source == 'index') { ?>
                                        <h3>
                                        <?php } ?>
                                        <a href="<?= $jv0 ?>" title="<?= $value["ten"] ?>" class=" flex items-center gap-3 px-3 py-2 font-normal ">
                                            <div class="w-[50px] aspect-[1/1] bg-[var(--html-bg-website)] rounded-md p-2">
                                                <?= $func->addHrefImg(
                                                    [
                                                        'addhref' => false,
                                                        'upload' => _upload_baiviet_l,
                                                        'image' => $value['photo'],
                                                        'sizes' =>  "50x50x2",
                                                        'actual_width' => 100,
                                                    ]
                                                ); ?>
                                            </div>
                                            <span><?= $value["ten"] ?></span>
                                        </a>
                                        <?php if ($source == 'index') { ?>
                                        </h3>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>