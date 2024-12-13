<?php foreach ($data as $key => $value) {
    $class_form = "";
    switch ($value['viewed']) {
        case 1:
            switch ($value['status']) {
                case 1:
                    $class_form = "success";
                    break;
                case 2:
                    $class_form = "error";
                    break;
                default:
                    break;
            }
            break;
        case 2:
            $class_form = "viewed";
            break;
        default:
            break;
    }
?>
    <div class="data_input_all_notification cursor-pointer border <?= $class_form ?> [&.success]:border-green-300 [&.success]:text-green-600 [&.success]:bg-green-50 [&.error]:border-red-300 [&.error]:text-red-600 [&.error]:bg-red-50 [&.viewed]:border-gray-300 [&.viewed]:text-gray-600 [&.viewed]:bg-gray-50  flex flex-wrap py-1 px-2 gap-y-1 gap-x-[2px] " data-value="<?= $value['id'] ?>">
        <div class="w-full text-sm">
            <span>
                <?= $value['name'] ?>
            </span>
        </div>
        <div class="flex-1">
            <div class="text-xs">
                <span>
                    <?= $value['content'] ?>
                </span>
            </div>
        </div>
        <div class="flex-initial inline-flex justify-center items-end">
            <span class="text-[8px] leading-normal">
                <?= $this->getTimeAgo($value['date_created']) ?>
            </span>
        </div>
    </div>
<?php } ?>