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
    <div class=" form_gglang relative ">
        <div class="btn_gglang h-[30px] max-w-[60px] overflow-hidden <?= $title_gglangweb ?> cursor-pointer  flex flex-wrap  justify-center gap-1" data-nb="gglangweb">
            <div class="data_output_gglang h-[30px] flex justify-center items-center gap-1" data-lang="/vi/vi">
                <div class="h-full aspect-[40/28] relative">
                    <img width="40" height="40" src="assets/images/lang/flag_vi.svg" alt="<?= _tiengviet ?>" class="absolute top-0 left-0 h-full w-full object-cover" />
                </div>
                <span>
                    VI
                </span>
            </div>
            <div class="data_output_gglang h-[30px] flex justify-center items-center gap-1" data-lang="/vi/en">
                <div class="h-full aspect-[40/28] relative">
                    <img width="40" height="40" src="assets/images/lang/flag_en.svg" alt="<?= _tienganh ?>" class="absolute top-0 left-0 h-full w-full object-cover" />
                </div>
                <span>
                    EN
                </span>
            </div>
        </div>
        <div class="data_gglang absolute top-[calc(100%+8px)] bg-white rounded-sm p-1 right-0 z-40 w-[60px] hidden shadow  " data-nb="gglangweb">
            <div class="inline-flex flex-wrap items-end justify-start leading-[0] gap-1">
                <div class="flex w-full items-center h-5 data_input_gglang" data-value="vi|vi">
                    <a class="cursor-pointer h-full flex justify-center items-center gap-1 <?= $title_gglangweb_option ?> " translate="no" title="<?= _tiengviet ?>" data-lang="vi|vi">
                        <div class="h-full aspect-[40/28] relative">
                            <img width="40" height="40" src="assets/images/lang/flag_vi.svg" alt="<?= _tiengviet ?>" class="absolute top-0 left-0 h-full w-full object-cover" />
                        </div>
                        <span>VI</span>
                    </a>
                </div>
                <div class="flex  w-full items-center h-5 data_input_gglang" data-value="vi|en">
                    <a class="cursor-pointer h-full flex justify-center items-center gap-1 <?= $title_gglangweb_option ?> " translate="no" title="<?= _tienganh ?>" data-lang="vi|en">
                        <div class="h-full aspect-[40/28] relative">
                            <img width="40" height="40" src="assets/images/lang/flag_en.svg" alt="<?= _tienganh ?>" class="absolute top-0 left-0 h-full w-full object-cover" />
                        </div>
                        <span>EN</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>