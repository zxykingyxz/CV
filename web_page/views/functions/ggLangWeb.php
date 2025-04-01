<?php if ($config['gg_lang']) {
    $data_lang_gg = [
        "vi" => [
            "value" => "vi",
            "title" => "VN",
            "text" => _tiengviet,
            "images" => "assets/images/lang/flag_vi.svg"
        ],
        "en" => [
            "value" => "en",
            "title" => "EN",
            "text" => _tienganh,
            "images" => "assets/images/lang/flag_en.svg"
        ],
    ];
    $title_gglangweb = "text-white font-main font-thin text-xs";
    $title_gglangweb_option = "font-main font-thin text-xs";
?>
    <div id="google_language_translator" class="hidden"></div>
    <?php
    switch ($form) {
        case 'dropdown':
    ?>
            <div class="form_gg_lang  relative inline-block z-10">
                <div class="btn_gg_lang bg-white text-[#464545]  cursor-pointer rounded w-[90px] p-1 flex items-center " data-nb="gg_lang_web">
                    <div class="flex-1 flex items-center gap-1 data_gg_lang_output">
                        <div class="overflow-hidden rounded w-[55%] aspect-[40/28]   flex justify-center items-center gap-1">
                            <div class="h-full aspect-[40/28] relative">
                                <img width="40" height="40" src="<?= $data_lang_gg['vi']['images'] ?>" alt="<?= $data_lang_gg['vi']['text'] ?>" class="absolute top-0 left-0 h-full w-full object-cover" />
                            </div>
                        </div>
                        <div class="flex-1 font-medium text-nowrap" translate="no">
                            <span>
                                <?= $data_lang_gg['vi']['title'] ?>
                            </span>
                        </div>
                    </div>
                    <div class="flex-initial px-1">
                        <i class="fas fa-caret-down text-sm font-semibold"></i>
                    </div>
                </div>
                <div class="data_gg_lang hidden absolute top-[calc(100%+2px)] z-10 right-0 bg-white py-1 pl-1 pr-1 rounded shadow-md " data-nb="gg_lang_web">
                    <div class="w-[70px] grid grid-cols-1 gap-2 pr-2">
                        <?php foreach ($data_lang_gg as $key_gg_lang => $value_gg_lang) { ?>
                            <div class="click_gg_lang w-full" data-lang="<?= $value_gg_lang['value'] ?>">
                                <div class=" data_gg_lang_input rounded overflow-hidden hover:text-[var(--html-bg-website)] text-xs cursor-pointer w-full flex items-center gap-1 transition-all duration-300" data-value="<?= $value_gg_lang['value'] ?>">
                                    <div class="overflow-hidden rounded w-[55%] aspect-[40/28]   flex justify-center items-center gap-1">
                                        <div class="h-full aspect-[40/28] relative">
                                            <img width="40" height="40" src="<?= $value_gg_lang['images'] ?>" alt="<?= $value_gg_lang['text'] ?>" class="absolute top-0 left-0 h-full w-full object-cover" />
                                        </div>
                                    </div>
                                    <div class="flex-1 font-medium text-nowrap" translate="no">
                                        <span>
                                            <?= $value_gg_lang['title'] ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php
            break;
        default:
        ?>
            <div class="inline-flex justify-center items-center gap-2 md:gap-3 text-white leading-[0] text-lg">
                <?php foreach ($data_lang_gg as $key_gg_lang => $value_gg_lang) { ?>
                    <div class="click_gg_lang w-[35px] aspect-[40/28] cursor-pointer flex justify-center items-center gap-1" data-lang="<?= $value_gg_lang['value'] ?>">
                        <div class="h-full aspect-[40/28] relative">
                            <img width="40" height="40" src="<?= $value_gg_lang['images'] ?>" alt="<?= $value_gg_lang['text'] ?>" class="absolute top-0 left-0 h-full w-full object-cover" />
                        </div>
                    </div>
                <?php } ?>
            </div>
    <?php
            break;
    }
    ?>
<?php } ?>