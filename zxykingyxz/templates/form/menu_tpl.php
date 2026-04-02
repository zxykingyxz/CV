<?php
$border_color_left_menu = "border-white";
$text_color_left_menu = "text-white capitalize";
$background_left_menu = "";
$class_items_left_menu = "gap-2  pl-3 py-3 text-[15px]";
$class_option_left_menu = "gap-4  pl-3 py-2 text-[15px]";
$class_form_icons_left_menu = " w-[22px] aspect-[1/1] flex justify-center items-center";
$class_icons_left_menu = " text-[16px] ";

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
    <i class="fas fa-angle-down  text-[16px]"></i>
</div>
<?php
$htmlArrowLeftMenu = ob_get_clean();

?>
<div class="h-[100vh] bg-[var(--html-bg-all-admin)] w-[250px] ">
    <div class="w-full h-full flex flex-wrap flex-col">
        <div class="w-full px-5 py-3 border-b <?= $border_color_left_menu ?> relative">
            <?= $func->addHrefImg([
                'addhref' => true,
                'href' =>  $func->getUrlParam(["com" => "index"]),
                'sizes' => '170x47x2',
                'url' => "assets/images/logo.png",
                'alt' => "Trang Chủ",
                'actual_width' => 500,
            ]); ?>
        </div>
        <ul class="form_menu_admin flex-1 overflow-x-hidden overflow-y-auto scroll-design-one max-h-[initial]">
            <?php
            // ----------------- ngân sách -------------------
            $name_items_ngansach = 'Quản lý ngân sách';
            $_COM_ngansach = 'ngansach';
            $check_ngansach =  ($_COM == $_COM_ngansach) ? true : false;
            $data_ngansach =  $GLOBAL['ngansach'];
            if (!empty($data_ngansach)) {
            ?>
                <li class=" ">
                    <div class="btn_menu_admin group peer  flex  w-full <?= $text_color_left_menu ?>  <?= ($check_ngansach) ? "on" : "" ?> " data-nb="ngansach_admin_<?= $value ?>">
                        <a class="flex-1 flex items-center <?= $class_items_left_menu ?> " href="<?= $jv0 ?>" title="<?= $name_items_ngansach ?>">
                            <div class=" <?= $class_form_icons_left_menu ?>">
                                <i class="fal fa-boxes <?= $class_icons_left_menu ?>"></i>
                            </div>
                            <span><?= $name_items_ngansach ?></span>
                        </a>
                        <?= $htmlArrowLeftMenu ?>
                    </div>
                    <div class="data_menu_admin hidden " style="<?= ($check_ngansach) ? "display: block;" : "" ?>" data-nb="ngansach_admin_<?= $value ?>">
                        <ul class=" w-full  <?= $text_color_left_menu ?> bg-inherit  transition-all duration-300">
                            <?php foreach ($data_ngansach as $key => $value) {
                                $check_items_ngansach = $func->checkLeftMenu(["com" => $_COM_ngansach, "src" => $_COM_ngansach, "type" =>  $key]);
                                $link_ngansach = $func->getUrlParam(["com" => $_COM_ngansach, "src" =>  $_COM_ngansach, "type" =>  $key, "act" =>  "man"]);
                            ?>
                                <li class="<?= $background_left_menu ?> <?= ($check_items_ngansach) ? "active" : "" ?> transition-all duration-300 pl-3">
                                    <a class="flex items-center <?= $class_option_left_menu ?>" href="<?= $link_ngansach ?>" title="<?= $value['title_main'] ?>">
                                        <i class=" fas fa-angle-right text-base "></i>
                                        <span><?= $value['title_main'] ?></span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
            <?php } ?>
            <?php
            // ----------------- Công Nợ -------------------
            $name_items_congno = 'Quản lý Công Nợ';
            $_COM_congno = 'congno';
            $check_congno =  ($_COM == $_COM_congno) ? true : false;
            $data_congno =  $GLOBAL['congno'];
            if (!empty($data_congno)) {
            ?>
                <li class=" ">
                    <div class="btn_menu_admin group peer  flex  w-full <?= $text_color_left_menu ?>  <?= ($check_congno) ? "on" : "" ?> " data-nb="congno_admin_<?= $value ?>">
                        <a class="flex-1 flex items-center <?= $class_items_left_menu ?> " href="<?= $jv0 ?>" title="<?= $name_items_congno ?>">
                            <div class=" <?= $class_form_icons_left_menu ?>">
                                <i class="fas fa-coins <?= $class_icons_left_menu ?>"></i>
                            </div>
                            <span><?= $name_items_congno ?></span>
                        </a>
                        <?= $htmlArrowLeftMenu ?>
                    </div>
                    <div class="data_menu_admin hidden " style="<?= ($check_congno) ? "display: block;" : "" ?>" data-nb="congno_admin_<?= $value ?>">
                        <ul class=" w-full  <?= $text_color_left_menu ?> bg-inherit  transition-all duration-300">
                            <?php foreach ($data_congno as $key => $value) {
                                $check_items_congno = $func->checkLeftMenu(["com" => $_COM_congno, "src" =>  $_COM_congno, "type" =>  $key]);
                                $link_congno = $func->getUrlParam(["com" => $_COM_congno, "src" =>  $_COM_congno, "type" =>  $key, "act" =>  "man"]);
                            ?>
                                <li class="<?= $background_left_menu ?> <?= ($check_items_congno) ? "active" : "" ?> transition-all duration-300 pl-3">
                                    <a class="flex items-center <?= $class_option_left_menu ?>" href="<?= $link_congno ?>" title="<?= $value['title_main'] ?>">
                                        <i class=" fas fa-angle-right text-base "></i>
                                        <span><?= $value['title_main'] ?></span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
            <?php } ?>
            <?php
            // ----------------- báo cáo -------------------
            $name_items_baocao = 'Quản lý báo cáo';
            $_COM_baocao = 'baocao';
            $check_baocao =  ($_COM == $_COM_baocao) ? true : false;
            $data_baocao =  $GLOBAL['baocao'];
            if (!empty($data_baocao)) {
            ?>
                <li class=" ">
                    <div class="btn_menu_admin group peer  flex  w-full <?= $text_color_left_menu ?>  <?= ($check_baocao) ? "on" : "" ?> " data-nb="baocao_admin_<?= $value ?>">
                        <a class="flex-1 flex items-center <?= $class_items_left_menu ?> " href="<?= $jv0 ?>" title="<?= $name_items_baocao ?>">
                            <div class=" <?= $class_form_icons_left_menu ?>">
                                <i class="fas fa-file-invoice <?= $class_icons_left_menu ?>"></i>
                            </div>
                            <span><?= $name_items_baocao ?></span>
                        </a>
                        <?= $htmlArrowLeftMenu ?>
                    </div>
                    <div class="data_menu_admin hidden " style="<?= ($check_baocao) ? "display: block;" : "" ?>" data-nb="baocao_admin_<?= $value ?>">
                        <ul class=" w-full  <?= $text_color_left_menu ?> bg-inherit  transition-all duration-300">
                            <?php foreach ($data_baocao as $key => $value) {
                                $check_items_baocao = $func->checkLeftMenu(["com" => $_COM_baocao, "src" =>  $_COM_baocao, "type" =>  $key]);
                                $link_baocao = $func->getUrlParam(["com" => $_COM_baocao, "src" =>  $_COM_baocao, "type" =>  $key, "act" =>  "man"]);
                            ?>
                                <li class="<?= $background_left_menu ?> <?= ($check_items_baocao) ? "active" : "" ?> transition-all duration-300 pl-3">
                                    <a class="flex items-center <?= $class_option_left_menu ?>" href="<?= $link_baocao ?>" title="<?= $value['title_main'] ?>">
                                        <i class=" fas fa-angle-right text-base "></i>
                                        <span><?= $value['title_main'] ?></span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
            <?php } ?>

            <?php
            // ----------------- Cài đặt -------------------
            $name_items_settings = 'Quản lý Cài đặt';
            $_COM_settings = 'settings';
            $check_settings =  ($_COM == $_COM_settings) ? true : false;
            $data_settings =  $GLOBAL['settings'];
            if (!empty($data_settings)) {
            ?>
                <li class=" ">
                    <div class="btn_menu_admin group peer  flex  w-full <?= $text_color_left_menu ?>  <?= ($check_settings) ? "on" : "" ?> " data-nb="settings_admin_<?= $value ?>">
                        <a class="flex-1 flex items-center <?= $class_items_left_menu ?> " href="<?= $jv0 ?>" title="<?= $name_items_settings ?>">
                            <div class=" <?= $class_form_icons_left_menu ?>">
                                <i class="fas fa-cogs <?= $class_icons_left_menu ?>"></i>
                            </div>
                            <span><?= $name_items_settings ?></span>
                        </a>
                        <?= $htmlArrowLeftMenu ?>
                    </div>
                    <div class="data_menu_admin hidden " style="<?= ($check_settings) ? "display: block;" : "" ?>" data-nb="settings_admin_<?= $value ?>">
                        <ul class=" w-full  <?= $text_color_left_menu ?> bg-inherit  transition-all duration-300">
                            <?php foreach ($data_settings as $key => $value) {
                                $check_items_settings = $func->checkLeftMenu(["com" => $_COM_settings, "src" =>  $_COM_settings, "type" =>  $key]);
                                $link_settings = $func->getUrlParam(["com" => $_COM_settings, "src" =>  $_COM_settings, "type" =>  $key, "act" =>  "man"]);
                            ?>
                                <li class="<?= $background_left_menu ?> <?= ($check_items_settings) ? "active" : "" ?> transition-all duration-300 pl-3">
                                    <a class="flex items-center <?= $class_option_left_menu ?>" href="<?= $link_settings ?>" title="<?= $value['title_main'] ?>">
                                        <i class=" fas fa-cog text-base "></i>
                                        <span><?= $value['title_main'] ?></span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>