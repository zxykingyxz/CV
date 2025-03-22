<?php
$class_label = "text-sm font-medium text-black";
$class_form_seclect = "w-full border shadow-sm border-[#D9D9D9] rounded-sm pr-4";
$class_text = " pl-3 h-[32px] text-xs font-normal font-main-400 ";

?>
<?php if ($form !== false) { ?>
    <label class=" <?= $class_form ?> ">
        <?php if ($no_lable !== true) { ?>
            <div for="<?= $data ?>" class="<?= $class_label ?> block <?= ($required) ? " after:content-['*'] after:ml-0.5 after:text-red-500 " : "" ?>"><?= $label ?></div>
            <div class="mt-2">
            <?php } ?>
        <?php } ?>
        <div class="w-full">
            <select name="<?= $data ?>" id="<?= $id ?>" class="<?= $class ?>" data-placeholder="<?= $placeholder ?>">
                <option value="" disabled selected></option>
                <?php foreach ($data_option as $k_select => $v_select) { ?>
                    <option value="<?= $v_select[$name_col_value] ?>" <?= ($value == $v_select[$name_col_value]) ? "selected" : "" ?>><?= $v_select[$name_col_view] ?></option>
                <?php } ?>
            </select>
        </div>
        <?php if ($form !== false) { ?>
            <?php if ($no_lable !== true) { ?>
            </div>
        <?php } ?>
    </label>
<?php } ?>