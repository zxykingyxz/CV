<?php
$class_label = "text-sm font-semibold text-slate-600";
$class_form_seclect = "w-full rounded-md pr-4";
$class_text = " px-3 h-[40px] text-xs font-normal font-main-400 ";

?>
<?php if ($form !== false) { ?>
    <label class=" <?= $class_form ?>">
        <?php if ($no_lable !== true) { ?>
            <div for="<?= $data ?>" class="<?= $class_label ?> block <?= ($required) ? " after:content-['*'] after:ml-0.5 after:text-red-500 " : "" ?>"><?= $lable ?></div>
            <div class="mt-1">
            <?php } ?>
        <?php } ?>
        <div class="bg-white border shadow-sm border-slate-300 placeholder-slate-400 has-[:disabled]:bg-slate-50 has-[:disabled]:text-slate-500 has-[:disabled]:border-slate-200 has-[:focus]:outline-none has-[:focus]:border-[var(--html-cl-website)] has-[:focus]:ring-[var(--html-cl-website)] block  has-[:focus]:ring-1  has-[:disabled]:shadow-none overflow-hidden  <?= $class_form_seclect ?>">
            <select name="<?= $data ?>" id="<?= $id ?>" class=" w-full  <?= $class . " " . $class_text ?> " <?= ($required) ? "required" : "" ?> <?= $function ?>>
                <option value="">-- <?= $placeholder ?> --</option>
                <?php foreach ($data_option as $k_city => $v_city) { ?>
                    <option value="<?= $v_city[$name_col_value] ?>" <?= ($value == $v_city[$name_col_value]) ? "selected" : "" ?>><?= $v_city[$name_col_view] ?></option>
                <?php } ?>
            </select>
        </div>
        <?php if ($form !== false) { ?>
            <?php if ($no_lable !== true) { ?>
            </div>
        <?php } ?>
    </label>
<?php } ?>