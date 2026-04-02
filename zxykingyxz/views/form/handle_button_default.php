<?php

$link_add = $func->getUrlParam([
    "com" => $_COM,
    "src" => $_SRC,
    "type" => $_TYPE,
    "act" => "add",
    "page" => $array_param_value['page'],
]);
$link_delete = $func->getUrlParam([
    "com" => $_COM,
    "src" => $_SRC,
    "type" => $_TYPE,
    "act" => 'delete',
    "page" => $array_param_value['page'],
]);
$link_import = $func->getUrlParam([
    "com" => $_COM,
    "src" => $_SRC,
    "type" => $_TYPE,
    "act" => 'import',
]);
?>
<div class="shadow shadow-gray-300 bg-white p-2 w-full rounded ">
    <div class="grid grid-cols-1 gap-2">
        <div class="flex flex-wrap gap-2 items-center">
            <?php if ($allow_add) { ?>
                <a href="<?= $link_add ?>" title="Thêm mới" class=" h-[35px] bg-blue-500 hover:brightness-90 transition-all duration-300 text-sm font-normal text-white text-center px-4 rounded-sm flex justify-center items-center gap-2 text-nowrap">
                    <i class="fas fa-plus"></i>
                    <span>Thêm mới</span>
                </a>
            <?php } ?>
            <?php if ($allow_delete) { ?>
                <button data-url="<?= $link_delete ?>" class="button_delete_all_default h-[35px] bg-red-500 hover:brightness-90 transition-all duration-300 text-sm font-normal text-white text-center px-4 rounded-sm flex justify-center items-center gap-2 text-nowrap">
                    <i class="fas fa-trash"></i>
                    <span>Xóa tất cả</span>
                </button>
            <?php } ?>
            <?php if ($allow_import) { ?>
                <button data-url="<?= $link_import ?>" class="button_modal_import h-[35px] bg-green-500 hover:brightness-90 transition-all duration-300 text-sm font-normal text-white text-center px-4 rounded-sm flex justify-center items-center gap-2 text-nowrap">
                    <i class="fas fa-file-import"></i>
                    <span>Import</span>
                </button>
            <?php } ?>
        </div>
    </div>
</div>