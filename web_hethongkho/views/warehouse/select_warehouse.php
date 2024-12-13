<label class=" <?= $class_form ?>">
    <?php if ($no_lable !== true) { ?>
        <div for="<?= $data ?>" class="block text-sm font-semibold text-slate-600 <?= ($required) ? " after:content-['*'] after:ml-0.5 after:text-red-500 " : "" ?>"><?= $lable ?></div>
        <div class="mt-1">
        <?php } ?>
        <select name="data[<?= $data ?>]" id="<?= $data ?>" class=" <?= $class ?> px-3 h-9 bg-white border shadow-sm border-slate-300 placeholder-slate-400 disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1  disabled:shadow-none" <?= ($required) ? "required" : "" ?>>
            <option value="">-- <?= $placeholder ?> --</option>
            <?php
            foreach ($data_option as $k_city => $v_city) {
            ?>
                <option value="<?= $v_city[$name_col_value] ?>" <?= ($value == $v_city[$name_col_value]) ? "selected" : "" ?>><?= $v_city[$name_col_view] ?></option>
            <?php } ?>
        </select>
        <?php if ($no_lable !== true) { ?>
        </div>
    <?php } ?>
</label>