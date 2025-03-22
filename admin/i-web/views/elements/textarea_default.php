<?php
$class_label = "text-sm font-medium text-black";
$class_text = "px-3 py-2 text-xs font-normal font-main-400 rounded-sm ";
?>
<?php if ($form !== false) { ?>
    <div class="<?= $class_form ?>">
        <label>
            <?php if ($no_label !== true) { ?>
                <div for="<?= $data ?>" class=" <?= $class_label ?> block <?= ($required) ? " after:content-['*'] after:ml-0.5 after:text-red-500 " : "" ?>"><?= $label ?></div>
                <div class="mt-2">
                <?php } ?>
            <?php } ?>
            <textarea name="<?= $data ?>" id="<?= $id ?>" rows="<?= $rows ?>" class="resize-none bg-white border shadow-sm border-[#D9D9D9] placeholder-slate-400 disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 focus:outline-none focus:border-border-blue-300 focus:ring-border-blue-300 block w-full focus:ring-1  disabled:shadow-none <?= $class . " " . $class_text ?> " <?= ($required) ? "required" : "" ?> <?= ($readonly) ? "readonly" : "" ?> placeholder="<?= $placeholder ?>" <?= $function ?>><?= $value ?></textarea>
            <?php if ($form !== false) { ?>
                <?php if ($no_label !== true) { ?>
                </div>
            <?php } ?>
        </label>
    </div>
<?php } ?>