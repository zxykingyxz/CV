<?php
$data_breadcrumbs = "";
if (str_contains($act, "add")) {
    $data_breadcrumbs = "Thêm mới";
}
if (str_contains($act, "edit")) {
    $data_breadcrumbs = "Chỉnh sửa";
}
if (str_contains($act, "save")) {
    $data_breadcrumbs = "Lưu";
}
if (str_contains($act, "copy")) {
    $data_breadcrumbs = "Sao Chép";
}
if (str_contains($act, "list")) {
    $act_home = "man_list";
} elseif (str_contains($act, "cat")) {
    $act_home = "man_cat";
} elseif (str_contains($act, "item")) {
    $act_home = "man_item";
} elseif (str_contains($act, "sub")) {
    $act_home = "man_sub";
} else {
    $act_home = "man";
}
$link_breadcrumbs = $func->getUrlParam([
    "com" => $com,
    "src" => $src,
    "act" => $act_home,
    "type" => $type,
    "id" => "",
]);
?>
<div class="bg-gray-300 h-[30px] px-3 w-full hidden md:flex items-center ">
    <ul class="flex gap-[6px] text-xs font-normal text-[#666666] items-center" id="breadcrumbs">
        <li>
            <a href="<?= $link_breadcrumbs ?>" title="<?= $title ?>" class="inline-flex items-center gap-2">
                <i class="fas fa-home"></i>
                <span><?= $title ?></span>
            </a>
        </li>
        <?php if (!empty($data_breadcrumbs)) { ?>
            <li>
                <span>/</span>
            </li>
            <li>
                <a href="<?= $jv0 ?>" title="<?= $data_breadcrumbs ?>" class="inline-flex items-center gap-2">
                    <span><?= $data_breadcrumbs ?></span>
                </a>
            </li>
        <?php } ?>
    </ul>
</div>