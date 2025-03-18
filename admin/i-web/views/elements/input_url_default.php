<?php
$class_label = "text-xs font-semibold text-slate-600";
$class_text = "text-xs font-normal font-main-400";
$class_form_layouts = "px-3 h-[32px] border shadow-sm border-[#D9D9D9] placeholder-slate-400 rounded-r-sm";
$class_url = "inline-block px-3 py-2 border ltr:border-r-0 rtl:border-l-0 border-slate-200 bg-slate-100 dark:border-zink-500 dark:bg-zink-600 ltr:rounded-l-md rtl:rounded-r-md";

?>
<?php if ($form !== false) { ?>
    <div class="<?= $class_form ?> ">
        <label>
            <?php if ($no_label !== true) { ?>
                <div for="<?= $data ?>" class="block <?= $class_label ?> <?= ($required) ? " after:content-['*'] after:ml-0.5 after:text-red-500 " : "" ?>">
                    <?= $label ?>
                </div>
                <div class="mt-2">
                <?php } ?>
                <div class="flex ">
                    <div class="flex-initial h-[inherit] bg-gray-200 text-xs font-bold flex items-center px-3 text-nowrap rounded-l-sm overflow-hidden">
                        <span>
                            <?= $url_text ?>
                        </span>
                    </div>
                    <input type="<?= $type ?>" name="<?= $data ?>" id="<?= $id ?>" class="flex-1 ltr:rounded-l-none rtl:rounded-r-none form-input bg-white disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 focus:outline-none focus:border-blue-300 focus:ring-blue-300 block w-full focus:ring-1 disabled:shadow-none <?= $class . " " . $class_text . " " . $class_form_layouts ?>" <?= ($required) ? "required" : "" ?> <?= ($readonly) ? "readonly" : "" ?> value="<?= $value ?>" placeholder="<?= $placeholder ?>" title="<?= $placeholder ?>" <?= $function ?>>
                </div>
                <?php if ($no_label !== true) { ?>
                </div>
            <?php } ?>
        </label>
    </div>
<?php } ?>