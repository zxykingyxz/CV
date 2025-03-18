<div class="sticky top-0 left-0 w-full z-20">
    <div class="w-full bg-[var(--html-bg-all-admin)] py-2 px-2   sm:px-3">
        <div class="w-full flex items-center justify-between gap-2">
            <div class="flex-initial inline-flex gap-3 justify-center items-center">
                <div class="action_menu_admin cursor-pointer inline-flex lg:hidden gap-2 justify-center items-center">
                    <div class="w-[30px] aspect-[1/1] flex justify-center items-center text-white ">
                        <i class=" fas fa-bars text-[16px]"></i>
                    </div>
                </div>
                <div class="inline-flex gap-2 justify-center items-center">
                    <div class="w-[28px] aspect-[1/1] flex justify-center items-center text-white border border-white rounded-full">
                        <i class=" fas fa-user text-[13px]"></i>
                    </div>
                    <div class="text-[13px] text-white hidden lg:inline-block">
                        <span> <?= "Xin chào, " . $dataAcconutLogged->username . " !" ?> </span>
                    </div>
                </div>
            </div>
            <div class="flex-1 flex justify-end justify-items-end items-center gap-6">
                <a href="<?= $func->getUrlParam(["com" => "cache", "act" => "delete"]); ?>" title="Xóa Cache" target="_blank" class="inline-flex justify-center items-center gap-2 text-white">
                    <div class="">
                        <i class="fas fa-folder-minus text-[16px] "></i>
                    </div>
                    <span class="text-[11px] hidden lg:inline-block">Xóa Cache </span>
                </a>
                <a href="<?= $https_config . "sitemap.xml" ?>" title="Cập Nhật Sitemap" target="_blank" class="inline-flex justify-center items-center gap-2 text-white">
                    <div class="">
                        <i class="far fa-sitemap text-[14px] "></i>
                    </div>
                    <span class="text-[11px] hidden lg:inline-block">Cập Nhật Sitemap </span>
                </a>
                <a href="<?= $https_config ?>" title="Vào Website" target="_blank" class="inline-flex justify-center items-center gap-2 text-white">
                    <div class="">
                        <i class="fas fa-share-square text-[14px] "></i>
                    </div>
                    <span class="text-[11px] hidden lg:inline-block">Vào Website</span>
                </a>
                <a href="<?= $func->getUrlParam(["com" => "user", "act" => "edit", "type" => "user", "id" => $dataAcconutLogged->id]); ?>" title="Thông tin tài khoản" class="inline-flex justify-center items-center gap-2 text-white">
                    <div class="">
                        <i class="fas fa-user-alt text-[14px] "></i>
                    </div>
                    <span class="text-[11px] hidden lg:inline-block">Thông tin tài khoản</span>
                </a>
                <?php
                // ---------------- thông báo trang web ---------------
                $tong_count = 0;
                $class_button_notification = "py-2 px-2 border-gray-200 hover:bg-gray-200";

                if ($config['cart']['turn_on']) {
                    $sql = "select COUNT(*) as total FROM #_order where view=0 ";
                    $data_cart = $db->rawQueryOne($sql);
                    if (!empty($data_cart)) {
                        $tong_count += $data_cart['total'];
                    }
                }

                if (!empty($GLOBAL['booking'])) {
                    foreach ($GLOBAL['booking'] as $key_booking => $val_booking) {
                        $sqlBooking = "select COUNT(*) as total FROM #_booking where type='" . $key_booking . "' and view=0";
                        $data_booking = $db->rawQueryOne($sqlBooking);
                        if (!empty($data_booking)) {
                            $tong_count += $data_booking['total'];
                        }
                    }
                }
                ?>
                <div class="group relative inline-flex justify-center items-center cursor-pointer z-10">
                    <i class="<?= ($tong_count > 0) ? "shake_design" : "" ?> far fa-bell text-white text-[20px]"></i>
                    <div class=" absolute   top-[0%] right-[0%]   translate-x-[50%] translate-y-[-40%]   leading-[0]">
                        <div class="relative inline-flex items-center justify-center bg-red-500 h-[16px] min-w-[16px] px-[3px] rounded-full text-white text-[11px] leading-[0] z-10">
                            <?php if ($tong_count > 0) { ?>
                                <div class="absolute inline-flex h-full w-full animate-ping rounded-full bg-red-500 opacity-75 z-[-1]"></div>
                            <?php } ?>
                            <span class=" leading-none">
                                <?= $tong_count ?>
                            </span>
                        </div>
                    </div>
                    <div class=" group-hover:visible group-hover:opacity-100 group-hover:scale-y-100 opacity-0 invisible scale-y-75 absolute top-full right-[-10px] w-[200px]  transition-all duration-300 ">
                        <div class="flex h-[2px]"></div>
                        <div class="flex h-[10px]">
                            <div class="flex-1 h-full"></div>
                            <div class="flex-initial h-full w-[14px] bg-white" style="clip-path: polygon(50% 0,100% 100%,0 100%);"></div>
                            <div class="flex-initial h-full w-[11px]"></div>
                        </div>
                        <div class="bg-white overflow-hidden rounded shadow-md shadow-gray-300 w-full text-sm font-normal flex flex-wrap">
                            <?php
                            // ----------------- Liên hệ -------------------
                            $type_booking = 'booking';
                            $data_booking = $GLOBAL[$type_booking];
                            if (!empty($data_booking)) {
                            ?>
                                <?php foreach ($data_booking as $key_booking => $value_booking) {
                                    $check_items_booking = $func->checkLeftMenu(["com" => $type_booking, "act" =>  $check_act, "type" => $key_booking]);
                                    $link_booking = $func->getUrlParam(["com" => $type_booking, "act" =>  "man", "type" => $key_booking]);
                                    $total_booking = $db->rawQueryOne("select COUNT(*) as total FROM #_booking where type='" . $key_booking . "' and view=0");
                                ?>
                                    <a href="<?= $link_booking ?>" title="<?= $value_booking['title_main'] ?>" class=" <?= $class_button_notification ?> w-full flex items-center border-t  first:border-none bg-inherit  transition-all duration-300">
                                        <span>
                                            <?= $value_booking['title_main'] . " (" . $total_booking['total'] . ")" ?>
                                        </span>
                                    </a>
                                <?php } ?>
                            <?php }  ?>
                            <?php
                            // ----------------- Đặt hàng -------------------
                            if ($config['cart']['turn_on']) {
                                $title_header_cart = "Thông báo đặt hàng";
                            ?>
                                <a href="<?= $func->getUrlParam(["com" => "order", "act" =>  "man"]) ?>" title="<?= $title_header_cart ?>" class=" <?= $class_button_notification ?> w-full flex items-center border-t  first:border-none bg-inherit  transition-all duration-300">
                                    <span>
                                        <?= $title_header_cart . " (" . $data_cart['total'] . ")" ?>
                                    </span>
                                </a>
                            <?php }  ?>
                        </div>
                    </div>
                </div>
                <a href="<?= $func->getUrlParam(["com" => "user", "act" => "logout"]); ?>" title="Logout" class="inline-flex justify-center items-center gap-2 text-white">
                    <div class="">
                        <i class="fas fa-sign-out-alt text-[14px]"></i>
                    </div>
                    <span class="text-[11px] hidden lg:inline-block">Logout</span>
                </a>
            </div>
        </div>
    </div>
</div>