<?php

$data_breadcrumbs = "";
if (str_contains($_ACT, "add")) {
    $data_breadcrumbs = "Thêm mới";
}
if (str_contains($_ACT, "edit")) {
    $data_breadcrumbs = "Chỉnh sửa";
}
if (str_contains($_ACT, "save")) {
    $data_breadcrumbs = "Lưu";
}
if (str_contains($_ACT, "copy")) {
    $data_breadcrumbs = "Sao Chép";
}
if (str_contains($_ACT, "import")) {
    $data_breadcrumbs = "Import";
}
$link_breadcrumbs = $func->getUrlParam([
    "com" => $_COM,
    "src" => $_SRC,
    "type" => $_TYPE,
    "act" => 'man',
]);
$class_hover = "hover:text-blue-500  transition-all duration-300";
?>
<div class=" w-full hidden md:flex items-center justify-between ">
    <div class="text-2xl font-medium capitalize">
        <span><?= $title ?></span>
    </div>
    <ul class="flex gap-[4px] text-base font-normal text-[#666666] items-center" id="breadcrumbs">
        <li>
            <a href="<?= $func->getUrlParam(["com" => 'index']) ?>" title="<?= 'Home' ?>" class="inline-flex items-center gap-2 <?= $class_hover ?>">
                <span>Home</span>
            </a>
        </li>
        <li>
            <i data-lucide="chevron-right" class="w-[18px] h-[18px]"></i>
        </li>
        <li class="">
            <a href="<?= $link_breadcrumbs ?>" title="<?= $title ?>" class="inline-flex items-center gap-2 capitalize <?= $class_hover ?>">
                <span><?= $title ?></span>
            </a>
        </li>
        <?php if (!empty($data_breadcrumbs)) { ?>
            <li>
                <i data-lucide="chevron-right" class="w-[18px] h-[18px]"></i>
            </li>
            <li>
                <a href="<?= $jv0 ?>" title="<?= $data_breadcrumbs ?>" class="inline-flex items-center gap-2 capitalize <?= $class_hover ?>">
                    <span><?= $data_breadcrumbs ?></span>
                </a>
            </li>
        <?php } ?>
    </ul>
</div>