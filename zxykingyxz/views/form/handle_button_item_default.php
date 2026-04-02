<?php
$link_edit = $func->getUrlParam([
    "com" => $_COM,
    "src" => $_SRC,
    "type" => $_TYPE,
    "act" => "edit",
    "id" => $id,
    "page" => $array_param_value['page'],
]);
$link_view = $func->getUrlParam([
    "com" => $_COM,
    "src" => $_SRC,
    "type" => $_TYPE,
    "act" => "view",
    "id" => $id,
    "page" => $array_param_value['page'],
]);
$link_delete = $func->getUrlParam([
    "com" => $_COM,
    "src" => $_SRC,
    "type" => $_TYPE,
    "act" => 'delete',
    "list_delete" => $id,
    "page" => $array_param_value['page'],
]);
$size = "h-[25px] w-[25px] flex items-center rounded justify-center px-[4px]";
?>
<div class="flex gap-1 items-center justify-center ">
    <?php if ($allow_edit) { ?>
        <a href="<?= $link_edit ?>" title="Chỉnh sửa" class=" text-blue-500 hover:text-blue-600 bg-blue-100 transition-all duration-300  <?= $size ?>">
            <i data-lucide="file-pen-line"></i>
        </a>
    <?php } ?>
    <?php if ($allow_view) { ?>
        <a href="<?= $link_view ?>" title="Chỉnh sửa" class=" text-green-500 hover:text-green-600 bg-green-100 transition-all duration-300  <?= $size ?>">
            <i data-lucide="eye"></i>
        </a>
    <?php } ?>
    <?php if ($allow_delete) { ?>
        <button data-url="<?= $link_delete ?>" class="button_delete_one text-red-500 hover:text-red-600 bg-red-100 transition-all duration-300  outline-none border-none <?= $size ?>">
            <i data-lucide="trash-2"></i>
        </button>
    <?php } ?>
</div>