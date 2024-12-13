<?php
switch ($status_notification['status']) {
    case 200:
        $color = "text-green-500";
        $border = "border-green-200";
        $shadow = "shadow-green-500";
        $background = "bg-green-500";
        break;
    case 201:
        $color = "text-red-500";
        $border = "border-red-200";
        $shadow = "shadow-red-500";
        $background = "bg-red-500";
        break;
    default:
        break;
}
$text = $status_notification['messenger'];
?>
<div class="form_notification fixed  top-3 right-2 z-50 w-[250px] <?= $color ?> px-3 py-2 rounded-md shadow-md <?= $shadow ?> border <?= $border ?> bg-white transition-all duration-1000 translate-x-[calc(100%+50px)] opacity-0 invisible">
    <div class="flex items-center gap-3">
        <div class="flex-initial inline-flex justify-center items-center h-8 aspect-[1/1] rounded text-white <?= $background ?>">
            <i class="fas fa-bell shake_design"></i>
        </div>
        <div class="flex-1">
            <div class=" text-base font-semibold">
                <span>
                    Thông báo hệ thống
                </span>
            </div>
            <div class="mt-1 text-xs">
                <span>
                    <?= $text ?>
                </span>
            </div>
        </div>
    </div>
</div>