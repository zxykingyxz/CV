<?php
global $url_transaction_import_add, $url_transaction_export_add;
if ($add_check) {
    switch ($_SRC) {
        case 'transaction':
            switch ($_TYPE) {
                case 'import':
?>
                    <a href="<?= $url_transaction_import_add ?>" title="Nhập Hàng" class="px-4 h-9 text-sm sm:text-base font-normal rounded-md  text-white bg-green-500 hover:bg-green-600 transition-all duration-300 inline-flex justify-center items-center gap-1 cursor-pointer">
                        <i class="fas fa-plus"></i>
                        <div class="">
                            <span>Nhập Hàng</span>
                        </div>
                    </a>
                <?php
                    break;
                case 'export':
                ?>
                    <a href="<?= $url_transaction_export_add ?>" title="Tạo Hóa Đơn" class="px-4 h-9 text-sm sm:text-base font-normal rounded-md  text-white bg-green-500 hover:bg-green-600 transition-all duration-300 inline-flex justify-center items-center gap-1 cursor-pointer">
                        <i class="fas fa-plus"></i>
                        <div class="">
                            <span>Tạo Hóa Đơn</span>
                        </div>
                    </a>
            <?php
                    break;
                default:
                    break;
            }

            break;

        default:
            ?>
            <div class="add_warehouse px-4 h-9 text-sm sm:text-base font-normal rounded-md  text-white bg-green-500 hover:bg-green-600 transition-all duration-300 inline-flex justify-center items-center gap-1 cursor-pointer">
                <i class="fas fa-plus"></i>
                <div class="">
                    <span>Thêm Mới</span>
                </div>
            </div>
    <?php
            break;
    }
    ?>
<?php } ?>
<?php if ($import_check) { ?>
    <div class="add_warehouse_import px-4 h-9 text-sm sm:text-base font-normal rounded-md  text-white bg-green-500 hover:bg-green-600 transition-all duration-300 inline-flex justify-center items-center gap-1 cursor-pointer">
        <i class="fas fa-file-import"></i>
        <div class="">
            <span>Import</span>
        </div>
    </div>
<?php } ?>
<?php if ($export_check) { ?>
    <div class="warehouse_export px-4 h-9 text-sm sm:text-base font-normal rounded-md  text-white bg-green-500 hover:bg-green-600 transition-all duration-300 inline-flex justify-center items-center gap-1 cursor-pointer">
        <i class="fas fa-file-export"></i>
        <div class="">
            <span>Export</span>
        </div>
    </div>
<?php } ?>
<?php if ($sort_check) {
    $array_sort = [
        [
            "value" => 0,
            "name" => "Mặc Định",
        ],
        [
            "value" => 1,
            "name" => "Mới Nhất",
        ],
        [
            "value" => 2,
            "name" => "Cũ Nhất",
        ],
        [
            "value" => 3,
            "name" => "Theo Tên",
        ],
        [
            "value" => 4,
            "name" => "Theo Mã",
        ]
    ]
?>
    <div class="form_sort relative z-20">
        <div class="btn_sort h-9 aspect-[1/1] text-sm sm:text-base font-normal rounded-md  text-white bg-green-500 hover:bg-green-600 transition-all duration-300 inline-flex justify-center items-center gap-1 cursor-pointer" data-nb="sort">
            <i class="fas fa-indent"></i>
        </div>
        <div class="data_sort absolute top-[calc(100%+5px)] rounded-md overflow-hidden border border-green-500 right-0 z-10 bg-white min-w-[120px] shadow shadow-green-500 hidden" data-nb="sort">
            <?php foreach ($array_sort as $key_sort => $value_sort) { ?>
                <div class="data_input_sort <?= ($sort == $value_sort['value']) ? 'active' : '' ?> text-xs font-medium py-2 px-3 w-full bg-white cursor-pointer  border-b border-green-500 hover:text-white hover:bg-green-500 [&.active]:text-white [&.active]:bg-green-500 transition-all duration-300" data-value="<?= $value_sort['value'] ?>">
                    <span>
                        <?= $value_sort['name'] ?>
                    </span>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>