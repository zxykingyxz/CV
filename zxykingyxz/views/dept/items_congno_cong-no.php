<?php
switch ($status) {
    case 1:
        $class_form = "green";
        break;
    case 2:
        $class_form = "red";
        break;
    case 999:
        $class_form = "out";
        break;
    default:
        break;
}
foreach ($data as $key => $value) {
    // link
    // ======== chỉnh sửa =========
    $link_edit = $func->getUrlParam([
        "com" => $_COM,
        "src" => $_SRC,
        "type" => $_TYPE,
        "act" => "edit",
        "id" => $value['id'],
    ]);
    // =========== xoá ===========
    $link_delete = $func->getUrlParam([
        "com" => $_COM,
        "src" => $_SRC,
        "type" => $_TYPE,
        "act" => 'delete',
        "list_delete" => $value['id'],
    ]);
    // loại
    $type = null;
    foreach ($config['data']["cong-no"] as $item) {
        if ($item["value"] == $value['loai']) {
            $type = $item["title"];
            break;
        }
    }
?>
    <div class="items_views_congno relative <?= $class_form ?> [.green&]:text-green-500 [.red&]:text-red-500 [.out&]:text-gray-500 bg-gray-50 shadow-md shadow-gray-300 rounded-lg  flex flex-wrap flex-col gap-1 py-3 px-4">
        <div class="absolute top-2 right-2 z-[1]">
            <button data-url="<?= $link_delete ?>" class="button_delete_one text-inherit bg-gray-100 hover:bg-gray-200 shadow-sm shadow-gray-300 transition-all duration-300  outline-none border-none h-[25px] w-[25px] flex items-center rounded justify-center px-[4px]">
                <i data-lucide="trash-2"></i>
            </button>
        </div>
        <div class=" h-[calc(20px*1.5*2)] text-xl font-bold">
            <a href="<?= $link_edit ?>" title="<?= $value['title'] ?>" class="line-clamp-2 leading-[1.5] text-inherit">
                <?= $value['title'] ?>
            </a>
        </div>
        <div class="text-base flex flex-wrap justify-between items-start ">
            <span>
                <?= "Giá công nợ:" ?>
            </span>
            <span class="text-gray-700 font-semibold">
                <?= $func->formatMoney($value['debt_price'], "đ") ?>
            </span>
        </div>
        <div class="text-base flex flex-wrap justify-between items-start ">
            <span>
                <?= "Công nợ còn lại:" ?>
            </span>
            <span class="text-gray-700 font-semibold">
                <?= $func->formatMoney($value['total_price'], "đ") ?>
            </span>
        </div>
        <div class="text-xs text-end">
            <span class=" font-medium">
                <?= "Ngày thực hiện: " . date("d/m/y", $value['date']) ?>
            </span>
        </div>
    </div>
<?php } ?>