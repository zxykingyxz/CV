<?php
$class_label = "text-sm font-semibold text-slate-600";
$class_text = "text-xs font-normal font-main-400 ";
$class_form_layouts = "px-3 h-[36px] border shadow-sm border-slate-300 placeholder-slate-400 rounded-md";

?>
<?php if ($form !== false) { ?>
    <label class=" <?= $class_form ?>">
        <?php if ($no_label !== true) { ?>
            <div for="<?= $data ?>" class="<?= $class_labe ?> block <?= ($required) ? " after:content-['*'] after:ml-0.5 after:text-red-500 " : "" ?>"><?= $label ?></div>
            <div class="mt-1">
            <?php } ?>
        <?php } ?>
        <select name="dataOrder[<?= $data ?>]" id="<?= $id ?>" class=" <?= $class . " " . $class_text . " " . $class_form_layouts ?> bg-white  disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 focus:outline-none focus:border-[var(--html-cl-website)] focus:ring-[var(--html-cl-website)] block w-full focus:ring-1  disabled:shadow-none" <?= ($required) ? "required" : "" ?> <?= $function ?>>
            <option value="">-- <?= $placeholder ?> --</option>
            <?php foreach ($data_option as $k_city => $v_city) { ?>
                <option value="<?= $v_city[$name_col_value] ?>" <?= ($value == $v_city[$name_col_value]) ? "selected" : "" ?>><?= $v_city[$name_col_view] ?></option>
            <?php } ?>
        </select>
        <?php if ($form !== false) { ?>
            <?php if ($no_label !== true) { ?>
            </div>
        <?php } ?>
    </label>
<?php } ?>