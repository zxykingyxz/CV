<?php if ($form !== false) { ?>
    <div class="<?= $class_form ?>">
        <label>
            <?php if ($no_lable !== true) { ?>
                <div for="<?= $data ?>" class="block text-sm font-semibold text-slate-600 <?= ($required) ? " after:content-['*'] after:ml-0.5 after:text-red-500 " : "" ?>"><?= $lable ?></div>
                <div class="mt-1">
                <?php } ?>
            <?php } ?>
            <textarea name="data[<?= $data ?>]" id="<?= $data ?>" rows="4" class="resize-none px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1  disabled:shadow-none" <?= ($required) ? "required" : "" ?> <?= ($readonly) ? "readonly" : "" ?> placeholder="<?= $placeholder ?>"><?= $value ?></textarea>
            <?php if ($form !== false) { ?>
                <?php if ($no_lable !== true) { ?>
                </div>
            <?php } ?>
        </label>
    </div>
<?php } ?>