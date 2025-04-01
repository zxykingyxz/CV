<?php
global $logo_mobile;
$text_top = $cache->getCache("select photo , ten_$lang as ten , mota_$lang as mota ,link from #_bannerqc where type=? and hienthi<>0", array('text_top'), 'fetch', _TIMECACHE);

?>
<section class="section-topmobile  w-full sticky top-0 left-0 z-40 shadow-md bg-white" mobile>
    <div class="grid_s wide">
        <div class="row py-2">
            <div class="col basis-full">
                <div class="flex items-center justify-between relative gap-2">
                    <div class=" flex-1 inline-flex gap-2 items-center content-center ">
                        <div class="btn_menuMb flex flex-wrap w-[30px] gap-1 cursor-pointer">
                            <div class="w-full h-[3px] rounded-full bg-[var(--html-bg-website)]"></div>
                            <div class="w-full h-[3px] rounded-full bg-[var(--html-bg-website)]"></div>
                            <div class="w-full h-[3px] rounded-full bg-[var(--html-bg-website)]"></div>
                        </div>
                        <div class="search-Click flex items-center justify-center w-[36px] rounded-full border border-[var(--html-bg-website)] aspect-[1/1]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <g clip-path="url(#clip0_1_3)">
                                    <path d="M19.8104 18.9119L14.6468 13.8308C15.999 12.3616 16.8298 10.4187 16.8298 8.28068C16.8291 3.7071 13.062 0 8.41466 0C3.76732 0 0.00019455 3.7071 0.00019455 8.28068C0.00019455 12.8543 3.76732 16.5614 8.41466 16.5614C10.4226 16.5614 12.2643 15.8668 13.7109 14.7122L18.8946 19.8134C19.1472 20.0622 19.5573 20.0622 19.8098 19.8134C20.063 19.5646 20.063 19.1607 19.8104 18.9119ZM8.41466 15.2873C4.48251 15.2873 1.29488 12.1504 1.29488 8.28068C1.29488 4.41101 4.48251 1.27403 8.41466 1.27403C12.3469 1.27403 15.5344 4.41101 15.5344 8.28068C15.5344 12.1504 12.3469 15.2873 8.41466 15.2873Z" fill="var(--html-bg-website)" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_1_3">
                                        <rect width="20" height="20" fill="none" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                    </div>
                    <div class="leading-[0] overflow-hidden inline-flex hover-left w-[100px]   ">
                        <?= $func->addHrefImg([
                            'classfix' => '',
                            'addhref' => true,
                            'href' =>   '',
                            'sizes' => '105x72x2',
                            'actual_width' => 800,
                            'isLazy' => true,
                            'upload' => _upload_hinhanh_l,
                            'image' => ($logo["photo"]),
                            'alt' => (isset($row_setting["name_$lang"])) ? $row_setting["name_$lang"] : $row_setting["name"],
                        ]); ?>
                    </div>
                    <?php if ($config['layouts']['allow_search'] || $config['gg_lang']) { ?>
                        <div class=" flex-1 inline-flex gap-2 items-center content-center  justify-end px-1">
                            <?php if ($config['gg_lang'] || $config['lang_check']) { ?>
                                <div class=" flex-initial flex justify-end gap-1 items-center leading-[0]">
                                    <?= $this->getTemplateLayoutsFor([
                                        'name_layouts' => 'ggLangWeb',
                                        'form' => '',
                                    ]) ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>