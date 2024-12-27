<?php if ($config['lang_check']) { ?>
    <ul class="fix-ul-lang d-flex align-items-center gap10">
        <li>
            <a href="<?= $func->currentLangLink('vi') ?>" title="<?= _tiengviet ?>">
                <img width="25" height="25" src="assets/images/lang/flag_vi.svg" alt="<?= _tiengviet ?>" />
            </a>
        </li>
        <li>
            <a href="<?= $func->currentLangLink('en') ?>" title="<?= _tienganh ?>">
                <img width="25" height="25" src="assets/images/lang/flag_en.svg" alt="<?= _tienganh ?>" />
            </a>
        </li>
    </ul>
<?php } ?>
<?php if ($config['gg_lang']) {
    $title_gglangweb = "text-white font-main font-thin text-xs";
    $title_gglangweb_option = "font-main font-thin text-xs";
?>
    <div id="google_language_translator" class="hidden"></div>
    <div class="inline-flex justify-center items-center gap-3 text-white leading-[0] text-lg">
        <div class="data_output_gglang w-[30px] aspect-[40/28] cursor-pointer flex justify-center items-center gap-1" data-lang="vi|vi">
            <div class="h-full aspect-[40/28] relative">
                <img width="40" height="40" src="assets/images/lang/flag_vi.svg" alt="<?= _tiengviet ?>" class="absolute top-0 left-0 h-full w-full object-cover" />
            </div>
        </div>
        <div class="data_output_gglang w-[30px] aspect-[40/28]  cursor-pointer flex justify-center items-center gap-1" data-lang="vi|en">
            <div class="h-full aspect-[40/28] relative">
                <img width="40" height="40" src="assets/images/lang/flag_en.svg" alt="<?= _tienganh ?>" class="absolute top-0 left-0 h-full w-full object-cover" />
            </div>
        </div>
    </div>
<?php } ?>