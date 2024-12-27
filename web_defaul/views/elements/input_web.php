<?php
$class_label = "text-sm font-semibold text-slate-600";
$class_text = "text-xs font-normal font-main-400 ";
$class_form_layouts = "px-3 h-[40px] border shadow-sm border-[#D9D9D9] placeholder-slate-400 rounded";

?>
<?php if ($form !== false) { ?>
    <div class="<?= $class_form ?>">
        <label>
            <?php if ($no_lable !== true) { ?>
                <div for="<?= $data ?>" class="block <?= $class_label ?> <?= ($required) ? " after:content-['*'] after:ml-0.5 after:text-red-500 " : "" ?>"><?= $lable ?></div>
                <div class="mt-1">
                <?php } ?>
            <?php } ?>
            <input type="<?= $type ?>" name="data[<?= $data ?>]" id="<?= $id ?>" class="<?= $class . " " . $class_text . " " . $class_form_layouts ?> bg-white  disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 focus:outline-none focus:border-[var(--html-cl-website)] focus:ring-[var(--html-cl-website)] block w-full focus:ring-1  disabled:shadow-none" <?= ($required) ? "required" : "" ?> <?= ($readonly) ? "readonly" : "" ?> value="<?= $value ?>" placeholder="<?= $placeholder ?>" <?= $function ?>>
            <?php if ($form !== false) { ?>
                <?php if ($no_lable !== true) { ?>
                </div>
            <?php } ?>
        </label>
    </div>
<?php } ?>