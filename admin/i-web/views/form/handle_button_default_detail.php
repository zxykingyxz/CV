<?php
$link_man = $func->getUrlParam([
    "com" => $_COM,
    "src" => $_SRC,
    "type" => $_TYPE,
    "act" => "man",
    "page" => $array_param_value['page'],
]);
?>
<div class="shadow shadow-gray-300 bg-white p-2 w-full rounded sticky bottom-0 left-0">
    <div class="w-full flex flex-wrap gap-2 items-center justify-end">
        <?php if ($allow_back) { ?>
            <a href="<?= $link_man ?>" title="Quay lại" class=" h-[32px] bg-blue-500 hover:brightness-90 transition-all duration-300 text-sm font-normal text-white text-center px-3 rounded flex justify-center items-center gap-2 text-nowrap">
                <i class="fas fa-backward"></i>
                <span>Quay lại</span>
            </a>
        <?php } ?>
        <?php if ($allow_save) { ?>
            <button type="submit" name="save-data" value="save" class=" h-[32px] bg-green-500 hover:brightness-90 transition-all duration-300 text-sm font-normal text-white text-center px-3 rounded flex justify-center items-center gap-2 text-nowrap">
                <i class=" fas fa-save"></i>
                <span>Lưu</span>
            </button>
        <?php } ?>

        <?php if ($allow_save_here) { ?>
            <button type="submit" name="save-data" value="save-here" class=" h-[32px] bg-green-500 hover:brightness-90 transition-all duration-300 text-sm font-normal text-white text-center px-3 rounded flex justify-center items-center gap-2 text-nowrap">
                <i class=" fas fa-save"></i>
                <span>Lưu tại đây</span>
            </button>
        <?php } ?>
    </div>
</div>