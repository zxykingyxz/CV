<?php

$link_add = $func->getUrlParam([
    "com" => $com,
    "src" => $src,
    "act" => $func->getActParam('add'),
    "type" => $type,
    "id" => "",
]);
$link_delete = $func->getUrlParam([
    "com" => $com,
    "src" => $src,
    "act" => $func->getActParam('delete'),
    "type" => $type,
    "id" => "",
]);
?>
<div class="shadow shadow-gray-300 bg-white p-2 w-full rounded ">
    <div class="grid grid-cols-1 gap-2">
        <div class="flex flex-wrap gap-1 items-center">
            <a href="<?= $link_add ?>" title="Thêm mới" class=" h-[30px] bg-blue-500 hover:brightness-90 transition-all duration-300 text-xs font-normal text-white text-center px-4 rounded-sm flex justify-center items-center gap-2 text-nowrap">
                <i class="fas fa-plus"></i>
                <span>Thêm mới</span>
            </a>
            <button title="Xóa tất cả" data-url="<?= $link_delete ?>" class=" h-[30px] bg-red-500 hover:brightness-90 transition-all duration-300 text-xs font-normal text-white text-center px-4 rounded-sm flex justify-center items-center gap-2 text-nowrap">
                <i class="fas fa-trash"></i>
                <span>Xóa tất cả</span>
            </button>
        </div>
        <form class="flex flex-wrap items-center gap-1 w-full">
            <input type="hidden" name="com" value="<?= $com ?>">
            <input type="hidden" name="src" value="<?= $src ?>">
            <input type="hidden" name="act" value="<?= $act ?>">
            <input type="hidden" name="type" value="<?= $type ?>">
            <?php if ($data_setting['list'] == true) { ?>
                <div class="w-[160px] text-[11px]">
                    <select name="id_list" id="" class="sumoselect_one" data-placeholder="Chọn danh mục cấp 1">
                        <option value="" disabled selected></option>
                        <?php foreach ($array_select_year as $k_select => $v_select) { ?>
                            <option value="<?= $v_select['value'] ?>" <?= ($year == $v_select['value']) ? "selected" : "" ?>><?= $v_select['title'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            <?php } ?>
            <?php if ($data_setting['cat'] == true) { ?>
                <div class="w-[160px] text-[11px]">
                    <select name="id_cat" id="" class="sumoselect_one" data-placeholder="Chọn danh mục cấp 2">
                        <option value="" disabled selected></option>
                        <?php foreach ($array_select_year as $k_select => $v_select) { ?>
                            <option value="<?= $v_select['value'] ?>" <?= ($year == $v_select['value']) ? "selected" : "" ?>><?= $v_select['title'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            <?php } ?>
            <?php if ($data_setting['item'] == true) { ?>
                <div class="w-[160px] text-[11px]">
                    <select name="id_item" id="" class="sumoselect_one" data-placeholder="Chọn danh mục cấp 3">
                        <option value="" disabled selected></option>
                        <?php foreach ($array_select_year as $k_select => $v_select) { ?>
                            <option value="<?= $v_select['value'] ?>" <?= ($year == $v_select['value']) ? "selected" : "" ?>><?= $v_select['title'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            <?php } ?>
            <?php if ($data_setting['sub'] == true) { ?>
                <div class="w-[160px] text-[11px]">
                    <select name="id_sub" id="" class="sumoselect_one" data-placeholder="Chọn danh mục cấp 4">
                        <option value="" disabled selected></option>
                        <?php foreach ($array_select_year as $k_select => $v_select) { ?>
                            <option value="<?= $v_select['value'] ?>" <?= ($year == $v_select['value']) ? "selected" : "" ?>><?= $v_select['title'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            <?php } ?>
            <div class="flex items-center gap-1 w-[280px]">
                <?= $this->getTemplateLayoutsFor([
                    'name_layouts' => 'input_admin',
                    'class_form' => 'flex-1',
                    'placeholder' => 'Nhập từ khóa ',
                    'id' => 'keywords',
                    'data' => 'keywords',
                    'value' => '',
                    'type' => 'text',
                    'save_cache' => false,
                    'required' => false,
                    'readonly' => false,
                    'function' => '',
                    'no_lable' => true,
                    'form' => true,
                ]); ?>
                <button type="submit" class="flex-initial h-[30px] bg-blue-600 hover:brightness-90 transition-all duration-300 text-sm font-medium text-white text-center px-3 rounded-sm flex justify-center items-center gap-2">
                    <i class="fas fa-search"></i>
                    <span>Tìm kiếm</span>
                </button>
            </div>
        </form>
    </div>
</div>