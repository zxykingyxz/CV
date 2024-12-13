<?php if ($form !== false) { ?>
    <div class="<?= $class_form ?>">
        <label>
            <?php if ($no_lable !== true) { ?>
                <div for="<?= $data ?>" class="block text-sm font-semibold text-slate-600 <?= ($required) ? " after:content-['*'] after:ml-0.5 after:text-red-500 " : "" ?>"><?= $lable ?></div>
                <div class="mt-1">
                <?php } ?>
            <?php } ?>
            <input type="<?= $type ?>" size="0" name="data[<?= $data ?>]" id="<?= $id ?>" class="<?= $class ?> px-3 h-9 bg-white border shadow-sm border-slate-300 placeholder-slate-400 disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 focus:outline-none focus:border-[var(--html-cl-website)] focus:ring-[var(--html-cl-website)] block w-full rounded-md sm:text-sm focus:ring-1  disabled:shadow-none" <?= ($required) ? "required" : "" ?> <?= ($readonly) ? "readonly" : "" ?> value="<?= $value ?>" placeholder="<?= $placeholder ?>" <?= $function ?>>
            <?php if ($form !== false) { ?>
                <?php if ($no_lable !== true) { ?>
                </div>
            <?php } ?>
        </label>
    </div>
<?php } ?>