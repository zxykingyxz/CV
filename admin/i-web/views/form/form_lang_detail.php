<div class="shadow shadow-gray-300 bg-white overflow-hidden w-full rounded ">
    <div class="flex flex-wrap gap-0 items-center">
        <?php foreach ($config['lang'] as $key => $value) { ?>
            <div class="inline-flex items-center cursor-pointer gap-2 h-[40px] px-3 bg-inherit  [&.on]:bg-gray-100 <?= ($key == 'vi') ? "on" : "" ?> btn_lang_admin" data-nb="lang_data_<?= $key ?>">
                <div class="w-[35px]">
                    <?= $func->addHrefImg([
                        'addhref' => false,
                        'sizes' => '35x22x1',
                        'url' => "assets/lang/" . $key . ".png",
                        'actual_width' => 500,
                    ]); ?>
                </div>
                <div class="text-sm text-gray-500">
                    <span>
                        <?= $value ?>
                    </span>
                </div>
            </div>
        <?php } ?>
    </div>
</div>