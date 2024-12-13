<?php
// menu
$array_menu = [
    "dashboard" => [
        [
            "title" => "Tổng Quan",
            "url" => $url_dashboard_man,
            "icons" => "fas fa-chart-area",
        ]
    ],
    "warehouse" => [
        [
            "title" => "Hàng Hóa",
            "url" => $url_warehouse_warehouse,
            "icons" => "fas fa-cubes",
        ]
    ],
    "partner" => [
        [
            "title" => "Đối Tác",
            "url" => $url_partner_supplier,
            "icons" => "fas fa-handshake",
        ],
        [
            "title" => "Nhà Cung Cấp",
            "url" => $url_partner_supplier,
            "icons" => "fas fa-users",
        ],
        [
            "title" => "Khách Hàng",
            "url" => $url_partner_customer,
            "icons" => "fas fa-user-alt",
        ],
        [
            "title" => "Đơn Vị Vận Chuyển",
            "url" => $url_partner_ship,
            "icons" => "fas fa-shipping-fast",
        ],
    ],
    "transaction" => [
        [
            "title" => "Giao Dịch",
            "url" => $jv0,
            "icons" => "fas fa-hand-holding-usd",
        ],
        [
            "title" => "Bán Hàng",
            "url" => $url_transaction_export_man,
            "icons" => "fas fa-money-check-alt",
        ],
        [
            "title" => "Nhập Hàng",
            "url" => $url_transaction_import_man,
            "icons" => "fas fa-truck-moving",
        ],
    ],
];
// thông báo 
$total_notification = $db->rawQueryOne("select COUNT(id) as total from #_$name_table_warehouse_notification where " . $warehouse_func->getAccountParam()->sql . " and viewed=1 and date_created>?", array(time() - (30 * 24 * 60 * 60)));
$data_notification = $db->rawQuery("select id,name,content,viewed,status,date_created from #_$name_table_warehouse_notification where " . $warehouse_func->getAccountParam()->sql . "  and date_created>? order by date_created desc ", array(time() - (30 * 24 * 60 * 60)));

$icons_99 = "";
if (!empty($total_notification)) {
    if ($total_notification['total'] > 99) {
        $quantity_notification = 99;
        $icons_99 = "+";
    } else {
        $quantity_notification = $total_notification['total'];
    }
} else {
    $quantity_notification = 0;
}

?>
<div class=" form_menu sticky top-0 left-0 z-50">
    <section class="py-1 section-top bg-white">
        <div class="grid_x wide ">
            <div class="flex justify-between items-center">
                <?php
                $logo = $cache->getCache("select photo , width_img,height_img from #_bannerqc where hienthi=1 and type=? limit 0,1", array('logo'), 'fetch', _TIMECACHE);
                if (!empty($logo)) {
                    echo  $func->addHrefImg([
                        'classfix' => 'overflow-hidden inline-flex hover-left w-[60px] aspect-[108/90]',
                        'addhref' => true,
                        'href' =>   '',
                        'sizes' => '500x500x2',
                        'isLazy' => true,
                        'upload' => _upload_hinhanh_l,
                        'image' => ($logo["photo"]),
                        'alt' => (isset($row_setting["name_$lang"])) ? $row_setting["name_$lang"] : $row_setting["name"],
                    ]);
                } else {
                ?>
                    <div class="">
                        Logo
                    </div>
                <?php } ?>
                <div class="inline-flex justify-center items-center gap-2 text-sm">
                    <?php /*
                    <div class="inline-flex justify-center items-center gap-2 bg-white hover:bg-slate-200 py-1 px-2 rounded transition-all duration-300 cursor-pointer">
                        <i class="fas fa-edit text-blue-500 font-normal"></i>
                        <div>
                            <span>Góp ý</span>
                        </div>
                    </div>
                    */ ?>
                    <a href="tel:<?= $row_setting['hotline'] ?>" class="inline-flex justify-center items-center gap-2 bg-white hover:bg-slate-200 py-1 px-2 rounded transition-all duration-300 cursor-pointer">
                        <i class="fas fa-phone text-blue-500 font-normal"></i>
                        <div>
                            <span>Hỗ trợ</span>
                        </div>
                    </a>
                    <div class="form_all_notification relative z-10 ">
                        <div class="btn_all_notification inline-flex justify-center items-center gap-2 bg-white hover:bg-slate-200 py-1 px-2 rounded transition-all duration-300 cursor-pointer" data-nb="notification_web">
                            <div class="relative">
                                <i class=" fas fa-bell text-blue-500 font-normal  <?= ($quantity_notification > 0) ? 'shake_design' : ''  ?> "></i>
                                <div class="absolute bottom-[60%] left-[60%] h-[16px] min-w-[16px] rounded-xl bg-red-600 overflow-hidden p-[3px] inline-flex justify-center items-center ">
                                    <span class="leading-none text-[8px] text-white mt-[2px]" id="quantity_notification">
                                        <?= $quantity_notification . $icons_99  ?>
                                    </span>
                                </div>
                            </div>
                            <div>
                                <span>Thông báo</span>
                            </div>
                        </div>
                        <div class="data_all_notification hidden absolute right-0 top-[calc(100%+5px)] border border-gray-200 shadow-lg shadow-gray-400 p-2 max-w-[300px] w-[100vw] bg-white" data-nb="notification_web">
                            <div class="grid grid-cols-1 gap-2 w-full overflow-y-auto overflow-x-hidden scroll-y max-h-[290px] pr-1">
                                <?= $warehouse_func->getTemplateLayoutsFor([
                                    'name_layouts' => 'items_notification',
                                    'data' => $data_notification,
                                ]); ?>
                            </div>
                        </div>
                    </div>
                    <div class=" group/account font-semibold bg-white py-1 px-2 rounded transition-all duration-300 cursor-pointer inline-flex justify-center items-center gap-2 relative">
                        <div>
                            <span>
                                <?= $account_info['name'] ?>
                            </span>
                        </div>
                        <div class="h-7 text-white text-sm aspect-[1/1] rounded-[50%] bg-blue-400 inline-flex justify-center items-center text-center">
                            <div>
                                <span>
                                    <?= substr($account_info['name'], 0, 1) ?>
                                </span>
                            </div>
                        </div>
                        <div class=" min-w-[180px] opacity-0 invisible group-hover/account:opacity-100 group-hover/account:visible transition-all duration-300  absolute right-0 top-full z-50 text-gray-600 text-base shadow-md shadow-gray-200 border border-gray-200 bg-white rounded-md p-2 flex flex-col justify-center items-center gap-2">
                            <?php /*
                            <a href="<?= $jv0 ?>" class=" py-1 pl-4 pr-10 border border-gray-200 rounded bg-white hover:bg-gray-200 transition-all duration-300 w-full inline-flex gap-2 justify-center items-center">
                                <i class="fas fa-user-circle font-normal"></i>
                                <div class="">
                                    <span>
                                        Tài Khoản
                                    </span>
                                </div>
                            </a>
                            */ ?>
                            <a href="<?= $jv0 ?>" class="button_logout py-1 pl-4 pr-10 border border-gray-200 rounded bg-white hover:bg-gray-200 transition-all duration-300 w-full inline-flex gap-2 justify-center items-center">
                                <i class="fas fa-sign-out-alt font-normal"></i>
                                <div class="">
                                    <span>
                                        Đăng Xuất
                                    </span>
                                </div>
                            </a>
                            <a href="<?= $url_warehouse_trash ?>" class=" py-1 pl-4 pr-10 border border-gray-200 rounded bg-white hover:bg-gray-200 transition-all duration-300 w-full inline-flex gap-2 justify-center items-center">
                                <i class="fas fa-trash"></i>
                                <div class="">
                                    <span>
                                        Thùng Rác
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <header class=" bg-blue-500 ">
        <div class="grid_x wide ">
            <div class="flex flex-nowrap gap-3 justify-items-center">
                <ul class="flex items-center gap-1 flex-1">
                    <?php foreach ($array_menu as $key_menu => $value_menu) { ?>
                        <li class=" group/menu relative py-3 px-4 rounded-md bg-inherit <?= (!empty($_SRC) && ($_SRC == $key_menu)) ? "active" : "" ?> [&.active]:bg-blue-700 hover:bg-blue-700 transition-all duration-300">
                            <a href="<?= $value_menu[0]['url'] ?>" title="<?= $value_menu[0]['title'] ?>" class="flex justify-items-center text-center gap-2 text-base text-white ">
                                <?php if (!empty($value_menu[0]['icons'])) { ?>
                                    <i class="<?= $value_menu[0]['icons'] ?> text-base"></i>
                                <?php  } ?>
                                <span>
                                    <?= $value_menu[0]['title'] ?>
                                </span>
                            </a>
                            <?php if (count($value_menu) > 1) { ?>
                                <div class="absolute top-full left-0 rounded-md bg-white shadow-lg shadow-blue-500 min-w-[180px] overflow-hidden  border border-blue-200  opacity-0 invisible scale-95 group-hover/menu:opacity-100 group-hover/menu:visible group-hover/menu:scale-100 transition-all duration-300">
                                    <?php foreach (array_slice($value_menu, 1) as $key => $value) { ?>
                                        <a href="<?= $value['url'] ?>" title="<?= $value['title'] ?>" class="py-2 px-3 text-blue-500 last:border-0 bg-white border-b border-blue-200  text-sm font-semibold hover:text-white hover:bg-blue-500 transition-all duration-300 flex justify-items-center items-center text-center gap-2">
                                            <?php if (!empty($value['icons'])) { ?>
                                                <i class="<?= $value['icons'] ?> text-base"></i>
                                            <?php  } ?>
                                            <span>
                                                <?= $value['title'] ?>
                                            </span>
                                        </a>
                                    <?php  } ?>
                                </div>
                            <?php  } ?>
                        </li>
                    <?php  } ?>
                </ul>
            </div>
        </div>
    </header>
</div>