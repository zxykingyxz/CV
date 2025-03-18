<?php
$border_color_left_menu = "border-white";
$text_color_left_menu = "text-white capitalize";
$background_left_menu = "bg-inherit hover:bg-[var(--html-all-admin)] [&.active]:bg-[var(--html-all-admin)]";
$class_items_left_menu = "gap-2  pl-3 py-2 text-xs";
$class_option_left_menu = "gap-2  pl-3 py-2 text-xs";
$class_form_icons_left_menu = " w-[17px] aspect-[1/1] flex justify-center items-center";
$class_icons_left_menu = " text-[14px] font-light ";

$array_act_check = ["man", "add", "edit", "save", "delete", "copy"];
$check_act = "man";

foreach ($array_act_check as $text_act) {
    if (strpos($act, $text_act)) {
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
            <div class="absolute top-full left-1/2 -translate-x-1/2 -translate-y-1/2 <?= $text_color_left_menu ?> z-10 text-sm">
                <i class="fas fa-globe"></i>
            </div>
        </div>
        <ul class="form_menu_admin flex-1 overflow-x-hidden overflow-y-auto scroll-design-one max-h-[initial]">
            <?php
            // ----------------- trang chủ -------------------
            $check_index = $func->checkLeftMenu(["com" => "index"]);
            ?>
            <li class="<?= $background_left_menu ?> <?= ($check_index) ? "active" : "" ?> transition-all duration-300 border-b bg-inherit <?= $border_color_left_menu ?>">
                <div class="btn_menu_admin flex <?= $text_color_left_menu ?> w-full ">
                    <a class="flex-1 flex items-center <?= $class_items_left_menu ?> " href="index.html?com=index" title="Trang chủ">
                        <div class=" <?= $class_form_icons_left_menu ?>">
                            <i class="fal fa-home <?= $class_icons_left_menu ?>"></i>
                        </div>
                        <span>Trang Chủ</span>
                    </a>
                </div>
            </li>

            <?php
            // ----------------- tác giả -------------------
            $type_author = "tac-gia";
            $check_author = $func->checkLeftMenu(["com" => "baiviet", "type" => $type_author]);
            $link_author = $func->getUrlParam(["com" => "baiviet", "act" => "man", "type" => $type_author]);
            $check_items_author = $func->checkLeftMenu(["com" => "baiviet", "type" => $type_author]);

            ?>
            <li class=" border-b bg-inherit <?= $border_color_left_menu ?>">
                <div class="btn_menu_admin group peer  flex  w-full <?= $text_color_left_menu ?>  <?= ($check_author) ? "on" : "" ?> " data-nb="author_admin">
                    <a class="flex-1 flex items-center <?= $class_items_left_menu ?> " href="<?= $jv0 ?>" title="<?= $GLOBAL['baiviet'][$type_author]['title_main'] ?>">
                        <div class=" <?= $class_form_icons_left_menu ?>">
                            <i class=" fas fa-user-alt <?= $class_icons_left_menu ?>"></i>
                        </div>
                        <span><?= $GLOBAL['baiviet'][$type_author]['title_main'] ?></span>
                    </a>
                    <?= $htmlArrowLeftMenu ?>
                </div>
                <div class="data_menu_admin hidden " style="<?= ($check_author) ? "display: block;" : "" ?>" data-nb="author_admin">
                    <ul class=" w-full  <?= $text_color_left_menu ?> bg-inherit  transition-all duration-300">
                        <li class="<?= $background_left_menu ?> <?= ($check_items_author) ? "active" : "" ?> transition-all duration-300 pl-3">
                            <a class="flex items-center <?= $class_option_left_menu ?>" href="<?= $link_author ?>" title="<?= $GLOBAL['baiviet'][$type_author]['title'] ?>">
                                <i class=" fas fa-angle-right text-sm font-light"></i>
                                <span><?= $GLOBAL['baiviet'][$type_author]['title'] ?></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <?php
            // ----------------- Trang tỉnh -------------------
            $type_provincial = 'info';
            $data_provincial = $GLOBAL[$type_provincial];
            if (!empty($data_provincial)) {
                $check_provincial = $func->checkLeftMenu(["com" => $type_provincial]);
            ?>
                <li class=" border-b bg-inherit <?= $border_color_left_menu ?>">
                    <div class="btn_menu_admin group peer  flex  w-full <?= $text_color_left_menu ?>  <?= ($check_provincial) ? "on" : "" ?> " data-nb="provincial_admin">
                        <a class="flex-1 flex items-center <?= $class_items_left_menu ?> " href="<?= $jv0 ?>" title="Quản lý tác giả">
                            <div class=" <?= $class_form_icons_left_menu ?>">
                                <i class="  fal fa-pager <?= $class_icons_left_menu ?>"></i>
                            </div>
                            <span>Trang Tỉnh</span>
                        </a>
                        <?= $htmlArrowLeftMenu ?>
                    </div>
                    <div class="data_menu_admin hidden " style="<?= ($check_provincial) ? "display: block;" : "" ?>" data-nb="provincial_admin">
                        <ul class=" w-full  <?= $text_color_left_menu ?> bg-inherit  transition-all duration-300">
                            <?php foreach ($data_provincial as $key_provincial => $value_provincial) {
                                $link_provincial = $func->getUrlParam(["com" => $type_provincial, "act" => "capnhat", "type" => $key_provincial]);
                                $check_items_provincial = $func->checkLeftMenu(["com" => $type_provincial, "type" => $key_provincial]);
                            ?>
                                <li class="<?= $background_left_menu ?> <?= ($check_items_provincial) ? "active" : "" ?> transition-all duration-300 pl-3">
                                    <a class="flex items-center <?= $class_option_left_menu ?>" href="<?= $link_provincial ?>" title="<?= $value_provincial['title_main'] ?>">
                                        <i class=" fas fa-angle-right text-sm font-light"></i>
                                        <span><?= $value_provincial['title_main'] ?></span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
            <?php } ?>

            <?php
            // ----------------- Mã giảm giá -------------------
            $name_items_coupons = 'Mã giảm giá';
            $type_coupons = 'coupons';
            $data_coupons = $GLOBAL[$type_coupons];
            if (!empty($data_coupons) && $config['cart']['coupons'] == true) {
                $check_coupons = $func->checkLeftMenu(["com" => $type_coupons]);
            ?>
                <li class=" border-b bg-inherit <?= $border_color_left_menu ?>">
                    <div class="btn_menu_admin group peer  flex  w-full <?= $text_color_left_menu ?>  <?= ($check_coupons) ? "on" : "" ?> " data-nb="coupons_admin">
                        <a class="flex-1 flex items-center <?= $class_items_left_menu ?> " href="<?= $jv0 ?>" title="<?= $name_items_coupons ?>">
                            <div class=" <?= $class_form_icons_left_menu ?>">
                                <i class="  fas fa-qrcode <?= $class_icons_left_menu ?>"></i>
                            </div>
                            <span><?= $name_items_coupons ?></span>
                        </a>
                        <?= $htmlArrowLeftMenu ?>
                    </div>
                    <div class="data_menu_admin hidden " style="<?= ($check_coupons) ? "display: block;" : "" ?>" data-nb="coupons_admin">
                        <ul class=" w-full  <?= $text_color_left_menu ?> bg-inherit  transition-all duration-300">
                            <?php foreach ($data_coupons as $key_coupons => $value_coupons) {
                                $link_coupons = $func->getUrlParam(["com" => $type_coupons, "act" =>  "man", "type" => $key_coupons]);
                                $check_items_coupons = $func->checkLeftMenu(["com" => $type_coupons, "act" =>  $check_act, "type" => $key_coupons]);
                            ?>
                                <li class="<?= $background_left_menu ?> <?= ($check_items_coupons) ? "active" : "" ?> transition-all duration-300 pl-3">
                                    <a class="flex items-center <?= $class_option_left_menu ?>" href="<?= $link_coupons ?>" title="<?= $value_coupons['title_main'] ?>">
                                        <i class=" fas fa-angle-right text-sm font-light"></i>
                                        <span><?= $value_coupons['title_main'] ?></span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
            <?php } ?>

            <?php
            // ----------------- Flash sale -------------------
            $name_items_flashsale = 'Khuyến mãi';
            $type_flashsale = 'flashsale';
            $data_flashsale = $GLOBAL[$type_flashsale];
            if (!empty($data_flashsale) && $config['cart']['flash_sale'] == true) {
                $check_flashsale = $func->checkLeftMenu(["com" => $type_flashsale]);
            ?>
                <li class=" border-b bg-inherit <?= $border_color_left_menu ?>">
                    <div class="btn_menu_admin group peer  flex  w-full <?= $text_color_left_menu ?>  <?= ($check_flashsale) ? "on" : "" ?> " data-nb="flashsale_admin">
                        <a class="flex-1 flex items-center <?= $class_items_left_menu ?> " href="<?= $jv0 ?>" title="<?= $name_items_flashsale ?>">
                            <div class=" <?= $class_form_icons_left_menu ?>">
                                <i class="fas fa-dollar-sign <?= $class_icons_left_menu ?>"></i>
                            </div>
                            <span><?= $name_items_flashsale ?></span>
                        </a>
                        <?= $htmlArrowLeftMenu ?>
                    </div>
                    <div class="data_menu_admin hidden " style="<?= ($check_flashsale) ? "display: block;" : "" ?>" data-nb="flashsale_admin">
                        <ul class=" w-full  <?= $text_color_left_menu ?> bg-inherit  transition-all duration-300">
                            <?php foreach ($data_flashsale as $key_flashsale => $value_flashsale) {
                                $link_flashsale = $func->getUrlParam(["com" => $type_flashsale, "act" =>  "man", "type" => $key_flashsale]);
                                $check_items_flashsale = $func->checkLeftMenu(["com" => $type_flashsale, "act" =>  $check_act, "type" => $key_flashsale]);
                            ?>
                                <li class="<?= $background_left_menu ?> <?= ($check_items_flashsale) ? "active" : "" ?> transition-all duration-300 pl-3">
                                    <a class="flex items-center <?= $class_option_left_menu ?>" href="<?= $link_flashsale ?>" title="<?= $value_flashsale['title_main'] ?>">
                                        <i class=" fas fa-angle-right text-sm font-light"></i>
                                        <span><?= $value_flashsale['title_main'] ?></span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
            <?php } ?>

            <?php
            // ---------------- Quản lý đặt hàng -------------------
            if ($config['cart']['turn_on']) {
                $name_items_cart = 'Quản lý đặt hàng';
                $title_order_cart = 'Danh sách đơn hàng';
                $data_items_cart = ["pttt", "htgh"];
                $check_cart = (in_array($type, $data_items_cart) && $com == "baiviet")  || $com == "order";
            ?>
                <li class=" border-b bg-inherit <?= $border_color_left_menu ?>">
                    <div class="btn_menu_admin group peer  flex  w-full <?= $text_color_left_menu ?>  <?= ($check_cart) ? "on" : "" ?> " data-nb="cart_admin_<?= $value ?>">
                        <a class="flex-1 flex items-center <?= $class_items_left_menu ?> " href="<?= $jv0 ?>" title="<?= $name_items_cart ?>">
                            <div class=" <?= $class_form_icons_left_menu ?>">
                                <i class="fas fa-shopping-cart <?= $class_icons_left_menu ?>"></i>
                            </div>
                            <span><?= $name_items_cart ?></span>
                        </a>
                        <?= $htmlArrowLeftMenu ?>
                    </div>
                    <div class="data_menu_admin hidden " style="<?= ($check_cart) ? "display: block;" : "" ?>" data-nb="cart_admin_<?= $value ?>">
                        <ul class=" w-full  <?= $text_color_left_menu ?> bg-inherit  transition-all duration-300">
                            <?php foreach ($data_items_cart as  $value_typr_order) {
                                $check_items_baiviet = $func->checkLeftMenu(["com" => 'baiviet', "act" =>  $check_act, "type" => $value_typr_order]);
                                $link_baiviet = $func->getUrlParam(["com" => 'baiviet', "act" =>  "man", "type" => $value_typr_order]);
                                $data_baiviet = $GLOBAL['baiviet'][$value_typr_order];
                            ?>
                                <li class="<?= $background_left_menu ?> <?= ($check_items_baiviet) ? "active" : "" ?> transition-all duration-300 pl-3">
                                    <a class="flex items-center <?= $class_option_left_menu ?>" href="<?= $link_baiviet ?>" title="<?= $data_baiviet['title_main'] ?>">
                                        <i class=" fas fa-angle-right text-sm font-light"></i>
                                        <span><?= $data_baiviet['title_main'] ?></span>
                                    </a>
                                </li>
                            <?php } ?>
                            <li class="<?= $background_left_menu ?> <?= ($func->checkLeftMenu(["com" => "order", "act" =>  $check_act])) ? "active" : "" ?> transition-all duration-300 pl-3">
                                <a class="flex items-center <?= $class_option_left_menu ?>" href="<?= $func->getUrlParam(["com" => "order", "act" =>  "man"]) ?>" title="<?= $title_order_cart ?>">
                                    <i class=" fas fa-angle-right text-sm font-light"></i>
                                    <span><?= $title_order_cart ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            <?php } ?>

            <?php
            // ----------------- Danh mục cấp -------------------
            if (!empty($PRIVATE)) {
                $type_level = 'baiviet';
                $dataLevel = ['list', 'cat', 'item'];
                foreach ($PRIVATE as $key => $value) {
                    $data_level = $GLOBAL[$type_level][$value];
                    $check_level = $func->checkLeftMenu(["com" => $type_level, "type" => $value]);
            ?>
                    <li class=" border-b bg-inherit <?= $border_color_left_menu ?>">
                        <div class="btn_menu_admin group peer  flex  w-full <?= $text_color_left_menu ?>  <?= ($check_level) ? "on" : "" ?> " data-nb="level_admin_<?= $value ?>">
                            <a class="flex-1 flex items-center <?= $class_items_left_menu ?> " href="<?= $jv0 ?>" title="<?= $data_level['title_main'] ?>">
                                <div class=" <?= $class_form_icons_left_menu ?>">
                                    <i class="fal fa-boxes <?= $class_icons_left_menu ?>"></i>
                                </div>
                                <span><?= $data_level['title_main'] ?></span>
                            </a>
                            <?= $htmlArrowLeftMenu ?>
                        </div>
                        <div class="data_menu_admin hidden " style="<?= ($check_level) ? "display: block;" : "" ?>" data-nb="level_admin_<?= $value ?>">
                            <ul class=" w-full  <?= $text_color_left_menu ?> bg-inherit  transition-all duration-300">
                                <?php foreach ($dataLevel as $valueLevel) {
                                    $link_level = $func->getUrlParam(["com" => $type_level, "act" =>   "man_" . $valueLevel, "type" => $value]);
                                    $check_items_level = $func->checkLeftMenu(["com" => $type_level, "act" =>  $check_act . "_" . $valueLevel, "type" => $value]);
                                    switch ($valueLevel) {
                                        case 'list':
                                            $dataOptionLevel = $GLOBAL_LEVEL1[$type_level][$value];
                                            break;
                                        case 'cat':
                                            $dataOptionLevel = $GLOBAL_LEVEL2[$type_level][$value];
                                            break;
                                        case 'item':
                                            $dataOptionLevel = $GLOBAL_LEVEL3[$type_level][$value];
                                            break;
                                        default:
                                            break;
                                    }
                                    if (!empty($dataOptionLevel)) {
                                ?>
                                        <li class="<?= $background_left_menu ?> <?= ($check_items_level) ? "active" : "" ?> transition-all duration-300 pl-3">
                                            <a class="flex items-center <?= $class_option_left_menu ?>" href="<?= $link_level ?>" title="<?= $dataOptionLevel['title'] ?>">
                                                <i class=" fas fa-angle-right text-sm font-light"></i>
                                                <span><?= $dataOptionLevel['title'] ?></span>
                                            </a>
                                        </li>
                                <?php }
                                } ?>
                                <li class="<?= $background_left_menu ?> <?= ($func->checkLeftMenu(["com" => $type_level, "act" =>  $check_act, "type" => $value])) ? "active" : "" ?> transition-all duration-300 pl-3">
                                    <a class="flex items-center <?= $class_option_left_menu ?>" href="<?= $func->getUrlParam(["com" => $type_level, "act" =>  "man", "type" => $value]) ?>" title="<?= $data_level['title'] ?>">
                                        <i class=" fas fa-angle-right text-sm font-light"></i>
                                        <span><?= $data_level['title'] ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
            <?php }
            } ?>

            <?php
            // ----------------- Bài Viết Chung -------------------
            if (!empty($PUBLIC)) {
                $name_items_baiviet = 'Quản lý bài viết chung';
                $type_baiviet = 'baiviet';
                $check_baiviet = in_array($type, $PUBLIC) && $com == $type_baiviet;
            ?>
                <li class=" border-b bg-inherit <?= $border_color_left_menu ?>">
                    <div class="btn_menu_admin group peer  flex  w-full <?= $text_color_left_menu ?>  <?= ($check_baiviet) ? "on" : "" ?> " data-nb="baiviet_admin_<?= $value ?>">
                        <a class="flex-1 flex items-center <?= $class_items_left_menu ?> " href="<?= $jv0 ?>" title="<?= $name_items_baiviet ?>">
                            <div class=" <?= $class_form_icons_left_menu ?>">
                                <i class="fal fa-boxes <?= $class_icons_left_menu ?>"></i>
                            </div>
                            <span><?= $name_items_baiviet ?></span>
                        </a>
                        <?= $htmlArrowLeftMenu ?>
                    </div>
                    <div class="data_menu_admin hidden " style="<?= ($check_baiviet) ? "display: block;" : "" ?>" data-nb="baiviet_admin_<?= $value ?>">
                        <ul class=" w-full  <?= $text_color_left_menu ?> bg-inherit  transition-all duration-300">
                            <?php foreach ($PUBLIC as $key => $value) {
                                $check_items_baiviet = $func->checkLeftMenu(["com" => $type_baiviet, "act" =>  $check_act, "type" => $value]);
                                $link_baiviet = $func->getUrlParam(["com" => $type_baiviet, "act" =>  "man", "type" => $value]);
                                $data_baiviet = $GLOBAL[$type_baiviet][$value];
                            ?>
                                <li class="<?= $background_left_menu ?> <?= ($check_items_baiviet) ? "active" : "" ?> transition-all duration-300 pl-3">
                                    <a class="flex items-center <?= $class_option_left_menu ?>" href="<?= $link_baiviet ?>" title="<?= $data_baiviet['title_main'] ?>">
                                        <i class=" fas fa-angle-right text-sm font-light"></i>
                                        <span><?= $data_baiviet['title_main'] ?></span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
            <?php } ?>

            <?php
            // ----------------- Quản lý hình ảnh & Video -------------------
            $type_photo = 'photo';
            $data_photo = $GLOBAL[$type_photo];
            if (!empty($data_photo)) {
                $name_items_photo = 'Quản lý hình ảnh & Video';
                $check_photo = $com == "photo";
            ?>
                <li class=" border-b bg-inherit <?= $border_color_left_menu ?>">
                    <div class="btn_menu_admin group peer  flex  w-full <?= $text_color_left_menu ?>  <?= ($check_photo) ? "on" : "" ?> " data-nb="photo_admin_<?= $value ?>">
                        <a class="flex-1 flex items-center <?= $class_items_left_menu ?> " href="<?= $jv0 ?>" title="<?= $name_items_photo ?>">
                            <div class=" <?= $class_form_icons_left_menu ?>">
                                <i class="  fal fa-images <?= $class_icons_left_menu ?>"></i>
                            </div>
                            <span><?= $name_items_photo ?></span>
                        </a>
                        <?= $htmlArrowLeftMenu ?>
                    </div>
                    <div class="data_menu_admin hidden " style="<?= ($check_photo) ? "display: block;" : "" ?>" data-nb="photo_admin_<?= $value ?>">
                        <ul class=" w-full  <?= $text_color_left_menu ?> bg-inherit  transition-all duration-300">
                            <?php foreach ($data_photo as $key_photo => $value_photo) {
                                $check_items_photo = $func->checkLeftMenu(["com" => $type_photo, "act" =>  $check_act, "type" => $key_photo]);
                                $link_photo = $func->getUrlParam(["com" => $type_photo, "act" =>  "man", "type" => $key_photo]);
                            ?>
                                <li class="<?= $background_left_menu ?> <?= ($check_items_photo) ? "active" : "" ?> transition-all duration-300 pl-3">
                                    <a class="flex items-center <?= $class_option_left_menu ?>" href="<?= $link_photo ?>" title="<?= $value_photo['title_main'] ?>">
                                        <i class=" fas fa-angle-right text-sm font-light"></i>
                                        <span><?= $value_photo['title_main'] ?></span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
            <?php } ?>

            <?php
            // ----------------- Hình ảnh & tiêu đề -------------------
            $type_bannerqc = 'bannerqc';
            $data_bannerqc = $GLOBAL[$type_bannerqc];
            if (!empty($data_bannerqc)) {
                $name_items_bannerqc = 'Hình ảnh & tiêu đề';
                $check_bannerqc = $com == "bannerqc";
            ?>
                <li class=" border-b bg-inherit <?= $border_color_left_menu ?>">
                    <div class="btn_menu_admin group peer  flex  w-full <?= $text_color_left_menu ?>  <?= ($check_bannerqc) ? "on" : "" ?> " data-nb="bannerqc_admin_<?= $value ?>">
                        <a class="flex-1 flex items-center <?= $class_items_left_menu ?> " href="<?= $jv0 ?>" title="<?= $name_items_bannerqc ?>">
                            <div class=" <?= $class_form_icons_left_menu ?>">
                                <i class="fas fa-image <?= $class_icons_left_menu ?>"></i>
                            </div>
                            <span><?= $name_items_bannerqc ?></span>
                        </a>
                        <?= $htmlArrowLeftMenu ?>
                    </div>
                    <div class="data_menu_admin hidden " style="<?= ($check_bannerqc) ? "display: block;" : "" ?>" data-nb="bannerqc_admin_<?= $value ?>">
                        <ul class=" w-full  <?= $text_color_left_menu ?> bg-inherit  transition-all duration-300">
                            <?php foreach ($data_bannerqc as $key_bannerqc => $value_bannerqc) {
                                $check_items_bannerqc = $func->checkLeftMenu(["com" => $type_bannerqc, "act" =>  $check_act, "type" => $key_bannerqc]);
                                $link_bannerqc = $func->getUrlParam(["com" => $type_bannerqc, "act" =>  "man", "type" => $key_bannerqc]);
                            ?>
                                <li class="<?= $background_left_menu ?> <?= ($check_items_bannerqc) ? "active" : "" ?> transition-all duration-300 pl-3">
                                    <a class="flex items-center <?= $class_option_left_menu ?>" href="<?= $link_bannerqc ?>" title="<?= $value_bannerqc['title_main'] ?>">
                                        <i class=" fas fa-angle-right text-sm font-light"></i>
                                        <span><?= $value_bannerqc['title_main'] ?></span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
            <?php } ?>

            <?php
            // ----------------- Liên hệ -------------------
            $type_booking = 'booking';
            $data_booking = $GLOBAL[$type_booking];
            if (!empty($data_booking)) {
                $name_items_booking = 'Liên hệ';
                $check_booking = $com == "booking";
            ?>
                <li class=" border-b bg-inherit <?= $border_color_left_menu ?>">
                    <div class="btn_menu_admin group peer  flex  w-full <?= $text_color_left_menu ?>  <?= ($check_booking) ? "on" : "" ?> " data-nb="booking_admin_<?= $value ?>">
                        <a class="flex-1 flex items-center <?= $class_items_left_menu ?> " href="<?= $jv0 ?>" title="<?= $name_items_booking ?>">
                            <div class=" <?= $class_form_icons_left_menu ?>">
                                <i class="fas fa-id-card <?= $class_icons_left_menu ?>"></i>
                            </div>
                            <span><?= $name_items_booking ?></span>
                        </a>
                        <?= $htmlArrowLeftMenu ?>
                    </div>
                    <div class="data_menu_admin hidden " style="<?= ($check_booking) ? "display: block;" : "" ?>" data-nb="booking_admin_<?= $value ?>">
                        <ul class=" w-full  <?= $text_color_left_menu ?> bg-inherit  transition-all duration-300">
                            <?php foreach ($data_booking as $key_booking => $value_booking) {
                                $check_items_booking = $func->checkLeftMenu(["com" => $type_booking, "act" =>  $check_act, "type" => $key_booking]);
                                $link_booking = $func->getUrlParam(["com" => $type_booking, "act" =>  "man", "type" => $key_booking]);
                            ?>
                                <li class="<?= $background_left_menu ?> <?= ($check_items_booking) ? "active" : "" ?> transition-all duration-300 pl-3">
                                    <a class="flex items-center <?= $class_option_left_menu ?>" href="<?= $link_booking ?>" title="<?= $value_booking['title_main'] ?>">
                                        <i class=" fas fa-angle-right text-sm font-light"></i>
                                        <span><?= $value_booking['title_main'] ?></span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
            <?php } ?>

            <?php
            // ----------------- Quản lý seo -------------------
            $type_seopage = 'seopage';
            $data_seopage = $setting['seopage']['page'];
            $name_items_seopage = 'Quản lý seo';
            $check_seopage = in_array($com, ['seopage', 'redirect']);
            ?>
            <li class=" border-b bg-inherit <?= $border_color_left_menu ?>">
                <div class="btn_menu_admin group peer  flex  w-full <?= $text_color_left_menu ?>  <?= ($check_seopage) ? "on" : "" ?> " data-nb="seopage_admin_<?= $value ?>">
                    <a class="flex-1 flex items-center <?= $class_items_left_menu ?> " href="<?= $jv0 ?>" title="<?= $name_items_seopage ?>">
                        <div class=" <?= $class_form_icons_left_menu ?>">
                            <i class="fal fa-share-alt <?= $class_icons_left_menu ?>"></i>
                        </div>
                        <span><?= $name_items_seopage ?></span>
                    </a>
                    <?= $htmlArrowLeftMenu ?>
                </div>
                <div class="data_menu_admin hidden " style="<?= ($check_seopage) ? "display: block;" : "" ?>" data-nb="seopage_admin_<?= $value ?>">
                    <ul class=" w-full  <?= $text_color_left_menu ?> bg-inherit  transition-all duration-300">
                        <?php foreach ($data_seopage as $key_seopage => $value_seopage) {
                            $check_items_seopage = $func->checkLeftMenu(["com" => $type_seopage, "act" =>  "capnhat", "type" => $key_seopage]);
                            $link_seopage = $func->getUrlParam(["com" => $type_seopage, "act" =>  "capnhat", "type" => $key_seopage]);
                        ?>
                            <li class="<?= $background_left_menu ?> <?= ($check_items_seopage) ? "active" : "" ?> transition-all duration-300 pl-3">
                                <a class="flex items-center <?= $class_option_left_menu ?>" href="<?= $link_seopage ?>" title="<?= $value_seopage ?>">
                                    <i class=" fas fa-angle-right text-sm font-light"></i>
                                    <span><?= $value_seopage ?></span>
                                </a>
                            </li>
                        <?php } ?>
                        <li class="<?= $background_left_menu ?> <?= ($com == "redirect") ? "active" : "" ?> transition-all duration-300 pl-3">
                            <a class="flex items-center <?= $class_option_left_menu ?>" href="<?= $func->getUrlParam(["com" => "redirect", "act" =>  "man"]) ?>" title="<?= "Redirect url" ?>">
                                <i class=" fas fa-angle-right text-sm font-light"></i>
                                <span><?= "Redirect url" ?></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <?php
            // ----------------- Cài đặt cấu hình -------------------
            $type_setting = 'setting';
            $data_company = $GLOBAL['company'];
            $data_map = $GLOBAL['map'];
            $name_items_setting = 'Cài đặt cấu hình';
            $check_setting = in_array($com, ['map', 'setting', 'company']);
            ?>
            <li class=" border-b bg-inherit <?= $border_color_left_menu ?>">
                <div class="btn_menu_admin group peer  flex  w-full <?= $text_color_left_menu ?>  <?= ($check_setting) ? "on" : "" ?> " data-nb="setting_admin_<?= $value ?>">
                    <a class="flex-1 flex items-center <?= $class_items_left_menu ?> " href="<?= $jv0 ?>" title="<?= $name_items_setting ?>">
                        <div class=" <?= $class_form_icons_left_menu ?>">
                            <i class="fal fa-cogs <?= $class_icons_left_menu ?>"></i>
                        </div>
                        <span><?= $name_items_setting ?></span>
                    </a>
                    <?= $htmlArrowLeftMenu ?>
                </div>
                <div class="data_menu_admin hidden " style="<?= ($check_setting) ? "display: block;" : "" ?>" data-nb="setting_admin_<?= $value ?>">
                    <ul class=" w-full  <?= $text_color_left_menu ?> bg-inherit  transition-all duration-300">
                        <?php foreach ($data_company as $key_company => $value_company) {
                            $check_items_company = $func->checkLeftMenu(["com" => "company", "act" =>  $check_act, "type" => $key_company]);
                            $link_company = $func->getUrlParam(["com" => "company", "act" =>  "man", "type" => $key_company]);
                        ?>
                            <li class="<?= $background_left_menu ?> <?= ($check_items_company) ? "active" : "" ?> transition-all duration-300 pl-3">
                                <a class="flex items-center <?= $class_option_left_menu ?>" href="<?= $link_company ?>" title="<?= $value_company['title'] ?>">
                                    <i class=" fas fa-angle-right text-sm font-light"></i>
                                    <span><?= $value_company['title'] ?></span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php foreach ($data_map as $key_map => $value_map) {
                            $check_items_map = $func->checkLeftMenu(["com" => "map", "act" =>  $check_act, "type" => $key_map]);
                            $link_map = $func->getUrlParam(["com" => "map", "act" =>  "man", "type" => $key_map]);
                        ?>
                            <li class="<?= $background_left_menu ?> <?= ($check_items_map) ? "active" : "" ?> transition-all duration-300 pl-3">
                                <a class="flex items-center <?= $class_option_left_menu ?>" href="<?= $link_map ?>" title="<?= $value_map['title'] ?>">
                                    <i class=" fas fa-angle-right text-sm font-light"></i>
                                    <span><?= $value_map['title'] ?></span>
                                </a>
                            </li>
                        <?php } ?>
                        <li class="<?= $background_left_menu ?> <?= ($com ==  $type_setting) ? "active" : "" ?> transition-all duration-300 pl-3">
                            <a class="flex items-center <?= $class_option_left_menu ?>" href="<?= $func->getUrlParam(["com" =>  $type_setting, "act" =>  "capnhat"]) ?>" title="<?= "Cấu Hình Chung" ?>">
                                <i class=" fas fa-angle-right text-sm font-light"></i>
                                <span><?= "Cấu Hình Chung" ?></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>