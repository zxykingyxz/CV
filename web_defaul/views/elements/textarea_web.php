<?php
$class_label = "text-sm font-semibold text-slate-600";
$class_text = "px-3 py-2 text-xs font-normal font-main-400 rounded-md ";
?>
<?php if ($form !== false) { ?>
    <div class="<?= $class_form ?>">
        <label>
            <?php if ($no_lable !== true) { ?>
                <div for="<?= $data ?>" class=" <?= $class_label ?> block <?= ($required) ? " after:content-['*'] after:ml-0.5 after:text-red-500 " : "" ?>"><?= $lable ?></div>
                <div class="mt-1">
                <?php } ?>
            <?php } ?>
            <textarea name="data[<?= $data ?>]" id="<?= $id ?>" rows="<?= $rows ?>" class="<?= $class . " " . $class_text ?> resize-none bg-white border shadow-sm border-[var(--html-sc-website)] placeholder-slate-400 disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 focus:outline-none focus:border-[var(--html-cl-website)] focus:ring-[var(--html-cl-website)] block w-full focus:ring-1  disabled:shadow-none" <?= ($required) ? "required" : "" ?> <?= ($readonly) ? "readonly" : "" ?> placeholder="<?= $placeholder ?>" <?= $function ?>><?= $value ?></textarea>
            <?php if ($form !== false) { ?>
                <?php if ($no_lable !== true) { ?>
                </div>
            <?php } ?>
        </label>
    </div>
<?php } ?>