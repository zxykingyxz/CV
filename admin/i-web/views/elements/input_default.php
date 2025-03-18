<?php
$class_label = "text-xs font-semibold text-slate-600";
$class_text = "text-xs font-normal font-main-400 ";
$class_form_layouts = "px-3 h-[32px] border shadow-sm border-[#D9D9D9] placeholder-slate-400 rounded-sm";

?>
<?php if ($form !== false) { ?>
    <div class=" <?= $class_form ?>">
        <label>
            <?php if ($no_label !== true) { ?>
                <div for="<?= $data ?>" class="block <?= $class_label ?> <?= ($required) ? " after:content-['*'] after:ml-0.5 after:text-red-500 " : "" ?>"><?= $label ?></div>
                <div class="mt-2">
                <?php } ?>
            <?php } ?>
            <input type="<?= $type ?>" name="<?= $data ?>" id="<?= $id ?>" class=" bg-white  disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 focus:outline-none focus:border-blue-300 focus:ring-blue-300 block w-full  focus:ring-1  disabled:shadow-none <?= $class . " " . $class_text . " " . $class_form_layouts ?>" <?= ($required) ? "required" : "" ?> <?= ($readonly) ? "readonly" : "" ?> value="<?= $value ?>" placeholder="<?= $placeholder ?>" title="<?= $placeholder ?>" <?= $function ?>>
            <?php if ($form !== false) { ?>
                <?php if ($no_label !== true) { ?>
                </div>
            <?php } ?>
        </label>
    </div>
<?php } ?>