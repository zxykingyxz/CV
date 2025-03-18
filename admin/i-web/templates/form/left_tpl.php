<?php
$border_color_left_menu = "border-[#0000]";
$text_color_left_menu = "text-white capitalize";
$background_left_menu = "bg-inherit hover:bg-[var(--html-all-admin)] [&.active]:bg-[var(--html-all-admin)]";
$class_items_left_menu = "gap-2  pl-3 py-2 text-xs";
$class_option_left_menu = "gap-2  pl-3 py-2 text-xs";
$class_FORM_icons_left_menu = " w-[17px] aspect-[1/1] flex justify-center items-center";
$class_icons_left_menu = " text-[14px] font-light ";

$array_act_check = ["man", "add", "edit", "save", "delete", "copy"];
$check_act = "man";

foreach ($array_act_check as $text_act) {
    if (strpos($_ACT, $text_act)) {
        $check_act = $text_act;
        break;
    }
}

ob_start();
?>
<div class="cursor-pointer flex flex-initial justify-center items-center h-[initial] w-8 group-[&.on]:scale-y-[-1] transition-all duration-300">
    <i class="fas fa-angle-down font-normal text-[13px]"></i>
</div>
<?php
$htmlArrowLeftMenu = ob_get_clean();

?>
<div class="h-[100vh] bg-[var(--html-bg-all-admin)] w-[220px] ">
    <div class="w-full h-full flex flex-wrap flex-col">
        <div class="w-full px-5 py-3 border-b <?= $border_color_left_menu ?> relative">
            <?= $func->addHrefImg([
                'addhref' => true,
                'href' => "index.html?com=index",
                'sizes' => '170x47x2',
                'url' => "assets/images/logo.png",
                'alt' => "I Web",
                'actual_width' => 500,
            ]); ?>
        </div>
        <ul class="form_menu_admin flex-1 overflow-x-hidden overflow-y-auto scroll-design-one max-h-[initial] mt-2">
            <?php
            // ----------------- tác giả -------------------
            $_TYPE_author = "tac-gia";
            $check_author = $func->checkLeftMenu(["com" => "baiviet", "src" => "baiviet", "type" => $_TYPE_author]);
            $link_author = $func->getUrlParam(["com" => "baiviet", "src" => "baiviet", "act" => "man", "type" => $_TYPE_author]);
            $check_items_author = $func->checkLeftMenu(["com" => "baiviet", "src" => "baiviet", "type" => $_TYPE_author]);
            ?>
            <li class=" border-b bg-inherit <?= $border_color_left_menu ?>">
                <div class="btn_menu_admin group peer  flex  w-full <?= $text_color_left_menu ?>  <?= ($check_author) ? "on" : "" ?> " data-nb="author_admin">
                    <a class="flex-1 flex items-center <?= $class_items_left_menu ?> " href="<?= $jv0 ?>" title="<?= $GLOBAL['baiviet'][$_TYPE_author]['title_main'] ?>">
                        <div class=" <?= $class_FORM_icons_left_menu ?>">
                            <i class=" fas fa-user-alt <?= $class_icons_left_menu ?>"></i>
                        </div>
                        <span><?= $GLOBAL['baiviet'][$_TYPE_author]['title_main'] ?></span>
                    </a>
                    <?= $htmlArrowLeftMenu ?>
                </div>
                <div class="data_menu_admin hidden " style="<?= ($check_author) ? "display: block;" : "" ?>" data-nb="author_admin">
                    <ul class=" w-full  <?= $text_color_left_menu ?> bg-inherit  transition-all duration-300">
                        <li class="<?= $background_left_menu ?> <?= ($check_items_author) ? "active" : "" ?> transition-all duration-300 pl-3">
                            <a class="flex items-center <?= $class_option_left_menu ?>" href="<?= $link_author ?>" title="<?= $GLOBAL['baiviet'][$_TYPE_author]['title'] ?>">
                                <i class=" fas fa-angle-right text-sm font-light"></i>
                                <span><?= $GLOBAL['baiviet'][$_TYPE_author]['title'] ?></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>