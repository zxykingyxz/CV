<?php

use PhpOffice\PhpSpreadsheet\Calculation\Information\Value;

require_once '../ajaxConfig.php';
require_once _lib . "warehouse/warehouse_function.php";
$warehouse_func = new warehouse_function();
require_once _source . "warehouse/data.php";

if ($warehouse_func->isAjax()) {
    @$value = htmlspecialchars($_POST['value']);
    @$form = htmlspecialchars($_POST['form']);
    switch ($form) {
        case 'city':
            $list_dist = $db->rawQuery("select name_$lang as name, id from #_place_dists where id_city=? ", array($value));
            ob_start();
            if (!empty($list_dist)) { ?>
                <select name="customer[district]" id="" required class=" border-none bg-inherit px-2 py-2 w-full h-full">
                    <option value="">-- Chọn Quận Huyện --</option>
                    <?php foreach ($list_dist as $key_dist => $value_dist) { ?>
                        <option value="<?= $value_dist['id'] ?>"><?= $value_dist['name'] ?></option>
                    <?php } ?>
                </select>
                <?php
            }
            $html = ob_get_clean();
            break;
        case 'search_customer':
            if (!empty($value)) {
                $where .= " and ";
                $where .= $warehouse_func->getSqlWhereKeywords($value);
            }
            $list_customer = $db->rawQuery("select id,name,code from #_$name_table_warehouse_customer where  " . $warehouse_func->getAccountParam()->sql . " $where ", array());
            ob_start();
            if (!empty($list_customer)) {
                if ((!empty($value))) {
                ?>
                    <div class="bg-white border border-gray-200 rounded-md p-2 w-full">
                        <div class="w-full max-h-[150px] overflow-x-hidden overflow-y-auto scroll-y grid grid-cols-1 gap-1 ">
                            <?php foreach ($list_customer as $key_customer => $value_customer) { ?>
                                <div class="option_customer text-sm border rounded border-gray-200 cursor-pointer bg-white hover:bg-gray-200 transition-all duration-300 flex items-center gap-2" data-value="<?= $value_customer['id'] ?>">
                                    <div class="flex-initial py-2 px-2">
                                        <span>
                                            <?= $value_customer['code'] ?>
                                        </span>
                                    </div>
                                    <div class="flex-1 py-2 px-2">
                                        <span>
                                            <?= $value_customer['name'] ?>
                                        </span>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="bg-white border border-gray-200 rounded-md p-2 w-full">
                    <span class="text-sm text-gray-700">
                        Không có khách hàng bạn muốn tìm...
                    </span>
                </div>
            <?php
            }
            $html = ob_get_clean();
            break;
        case 'option_customer':
            $info_customer = $db->rawQueryOne("select id,name,code,phone,address,email from #_$name_table_warehouse_customer where  " . $warehouse_func->getAccountParam()->sql . " and id=? ", array($value));
            ob_start();
            ?>
            <input type="hidden" name="data[id_customer]" value="<?= $info_customer['id'] ?>" required>
            <div class="flex flex-wrap flex-col gap-1 text-sm text-gray-800">
                <div class="">
                    <span class="font-bold">Họ và Tên: </span>
                    <span><?= $warehouse_func->value_handing_column("name", $info_customer); ?></span>
                </div>
                <div class="">
                    <span class="font-bold">Mã Khách Hàng: </span>
                    <span><?= $warehouse_func->value_handing_column("code", $info_customer); ?></span>
                </div>
                <?php if (!empty($info_customer['phone'])) { ?>
                    <div class="">
                        <span class="font-bold">Số Điện Thoại: </span>
                        <span><?= $warehouse_func->value_handing_column("phone", $info_customer); ?></span>
                    </div>
                <?php } ?>
                <?php if (!empty($info_customer['email'])) { ?>
                    <div class="">
                        <span class="font-bold">Email: </span>
                        <span><?= $warehouse_func->value_handing_column("email", $info_customer); ?></span>
                    </div>
                <?php } ?>
                <?php if (!empty($info_customer['address'])) { ?>
                    <div class="">
                        <span class="font-bold">Địa chỉ: </span>
                        <span><?= $warehouse_func->value_handing_column("address", $info_customer); ?></span>
                    </div>
                <?php } ?>
                <div class="cursor-pointer form_input_customer">
                    <span class="text-red-500">(Nhấn vào đây để tự nhập khách hàng mới)</span>
                </div>
            </div>
            <?php
            $html = ob_get_clean();
            break;
        case 'form_input_customer':
            $html = $warehouse_func->getTemplateLayoutsFor([
                'name_layouts' => 'form_input_customer',
                'list_dist' => $list_dist,
                'list_city' => $list_city,
            ]);
            break;
        case 'search_ship':
            if (!empty($value)) {
                $where .= " and ";
                $where .= $warehouse_func->getSqlWhereKeywords($value);
            }
            $list_ship = $db->rawQuery("select id,name,code from #_$name_table_warehouse_ship where  " . $warehouse_func->getAccountParam()->sql . " $where ", array());
            ob_start();
            if (!empty($list_ship)) {
                if ((!empty($value))) {
            ?>
                    <div class="bg-white border border-gray-200 rounded-md p-2 w-full">
                        <div class="w-full max-h-[150px] overflow-x-hidden overflow-y-auto scroll-y grid grid-cols-1 gap-1 ">
                            <?php foreach ($list_ship as $key_ship => $value_ship) { ?>
                                <div class="option_ship text-sm border rounded border-gray-200 cursor-pointer bg-white hover:bg-gray-200 transition-all duration-300 flex items-center gap-2" data-value="<?= $value_ship['id'] ?>">
                                    <div class="flex-initial py-2 px-2">
                                        <span>
                                            <?= $value_ship['code'] ?>
                                        </span>
                                    </div>
                                    <div class="flex-1 py-2 px-2">
                                        <span>
                                            <?= $value_ship['name'] ?>
                                        </span>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="bg-white border border-gray-200 rounded-md p-2 w-full">
                    <span class="text-sm text-gray-700">
                        Không có đối tác bạn muốn tìm...
                    </span>
                </div>
            <?php
            }
            $html = ob_get_clean();
            break;
        case 'option_ship':
            $info_ship = $db->rawQueryOne("select id,name,code,photo,address,phone from #_$name_table_warehouse_ship where  " . $warehouse_func->getAccountParam()->sql . " and id=? ", array($value));
            ob_start();
            ?>
            <input type="hidden" name="data[id_ship]" value="<?= $info_ship['id'] ?>" required>
            <div class="flex flex-wrap flex-col gap-1 text-sm text-gray-800">
                <div class="flex items-center w-full max-w-full gap-2 pb-2">
                    <div class="w-[15%]">
                        <?= $warehouse_func->addHrefImg([
                            'classfix' => 'overflow-hidden inline-flex justify-center items-center w-full aspect-[1/1] shadow p-[3px] rounded-sm bg-white transition-all duration-300',
                            'class' => '',
                            'addhref' => true,
                            'href' => $jv0,
                            'create_thumbs' => false,
                            'sizes' => '600x600x2',
                            'upload' => _upload_baiviet_l,
                            'image' =>  $info_ship["photo"],
                            'alt' => $warehouse_func->getNameData($info_ship["name"]),
                        ]); ?>
                    </div>
                    <div class="flex-1">
                        <span><?= $warehouse_func->value_handing_column("name", $info_ship); ?></span>
                    </div>
                </div>
                <div class="">
                    <span class="font-bold">Mã Đối Tác: </span>
                    <span><?= $warehouse_func->value_handing_column("code", $info_ship); ?></span>
                </div>
                <?php if (!empty($info_ship['phone'])) { ?>
                    <div class="">
                        <span class="font-bold">Số Điện Thoại: </span>
                        <span><?= $warehouse_func->value_handing_column("phone", $info_ship); ?></span>
                    </div>
                <?php } ?>
                <?php if (!empty($info_ship['address'])) { ?>
                    <div class="">
                        <span class="font-bold">Địa chỉ: </span>
                        <span><?= $warehouse_func->value_handing_column("address", $info_ship); ?></span>
                    </div>
                <?php } ?>
            </div>
<?php
            $html = ob_get_clean();
            break;
        default:
            break;
    }

    $return = [
        "html" => [
            "html" => $html,
        ],
        "data" => [
            "sum_price_format" => $warehouse_func->changeMoney($sum_price),
        ],
    ];
};
echo json_encode($return);
exit;
