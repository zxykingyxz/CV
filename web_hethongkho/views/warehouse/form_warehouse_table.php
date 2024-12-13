<?php
global $_SRC, $_TYPE, $_ACT, $main_table;
switch ($_SRC) {
    case 'warehouse':
        switch ($_TYPE) {
            case 'warehouse':
            case '':
                $column = ['name', 'code', 'city', 'max_quantity', 'status', 'date_created', 'list_product_warehouse', 'import_trash'];
                break;
            case 'product':
                $column = ['name', 'code', 'sale_price', 'capital_price', 'quantity', 'max_quantity', 'min_quantity', 'status', 'import_trash'];
                break;
            default:
                break;
        }
        break;
    case 'partner':
        switch ($_TYPE) {
            case 'supplier':
            case '':
                $column = ['name', 'code', 'city', 'district', 'status', 'date_created', 'list_product_supplier', 'import_trash'];
                break;
            case 'customer':
                $column = ['name', 'code', 'city', 'district', 'status', 'import_trash'];
                break;
            case 'ship':
                $column = ['name', 'code', 'phone', 'city', 'district', 'status', 'import_trash'];
                break;
            default:
                break;
        }
        break;
    case 'transaction':
        switch ($_TYPE) {
            case 'import':
                $column = ['code', 'id_importer', 'total_quantity', 'total_price', 'import_date', 'status', 'import_trash'];
                break;
            case 'export':
                $column = ['code', 'id_exporter', 'id_customer', 'id_ship', 'total_quantity', 'total_price', 'status', 'import_trash'];
                break;
            default:
                break;
        }
        break;
    default:
        break;
}

if (!empty($data) && !empty($column)) {
?>
    <style>
        .body_table tr {
            background: #ffffff;
        }

        .body_table tr:nth-child(4n+3) {
            background: #F2F2F2;
        }

        .body_table tr:nth-child(2n+1):hover {
            background: #e6e6e6;
        }
    </style>
    <table class="form_table_views table-auto min-w-[1000px] w-full border-collapse border border-gray-200  ">
        <thead class="bg-gray-200">
            <tr>
                <th class=" border border-gray-200 w-9  text-left bg-blue-300 sticky top-0 z-10">
                    <div class="inline-flex  justify-center items-center w-9 pt-1">
                        <?= $this->getTemplateLayoutsFor([
                            'name_layouts' => 'checkbok_rectangular',
                            'data' => 'export_all',
                            'class_form' => 'h-4',
                            'value' => '',
                        ]); ?>
                    </div>
                </th>
                <?php foreach ($column as $v_column) { ?>
                    <th class=" border border-gray-200 px-4 py-2 text-left bg-blue-300 sticky top-0  <?= ($v_column == 'name') ? "w-[250px] left-0 z-20" : " z-10" ?> ">
                        <span>
                            <?= $this->value_handing_column($v_column) ?>
                        </span>
                    </th>
                <?php } ?>
            </tr>
        </thead>
        <tbody class="body_table">
            <?php foreach ($data as $k_table_value => $v_table_value) { ?>
                <tr class="item_tbody_table cursor-pointer transition-all duration-200">
                    <td class=" bg-inherit border border-gray-300 w-9 ">
                        <div class="inline-flex  justify-center items-center w-9 pt-1">
                            <?= $this->getTemplateLayoutsFor([
                                'name_layouts' => 'checkbok_rectangular',
                                'data' => 'export',
                                'class_form' => 'h-4',
                                'value' => $v_table_value['id'],
                            ]); ?>
                        </div>
                    </td>
                    <?php foreach ($column as $v_column) {
                        switch ($v_column) {
                            case 'import_trash':
                    ?>
                                <td class=" bg-inherit border border-gray-300 w-11">
                                    <div class="inline-flex justify-center items-center content-center w-11">
                                        <a href="<?= $jv0 ?>" class="button_trash cursor-pointer text-base text-gray-400 hover:text-gray-700 transition-all duration-300 flex justify-center items-center w-full aspect-[1/1]" data-id="<?= $v_table_value['id'] ?>" data-table="<?= $main_table ?>" title="Chuyển Vào Thùng Rác">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            <?php break;
                            case 'list_product_warehouse':
                            ?>
                                <td class=" bg-inherit border border-gray-300 w-11">
                                    <div class="inline-flex justify-center items-center content-center w-11">
                                        <a href="<?= $url_warehouse_product . '&id_warehouse=' . $v_table_value['id'] ?>" class="text-xl text-gray-400 hover:text-gray-700 transition-all duration-300" title="<?= htmlspecialchars($v_table_value['name']) ?>">
                                            <i class="fas fa-list-ul"></i>
                                        </a>
                                    </div>
                                </td>
                            <?php break;
                            case 'list_product_supplier':
                            ?>
                                <td class=" bg-inherit border border-gray-300 w-11">
                                    <div class="inline-flex justify-center items-center content-center w-11">
                                        <a href="<?= $url_warehouse_product . '&id_supplier=' . $v_table_value['id'] ?>" class="text-xl text-gray-400 hover:text-gray-700 transition-all duration-300" title="<?= htmlspecialchars($v_table_value['name']) ?>">
                                            <i class="fas fa-list-ul"></i>
                                        </a>
                                    </div>
                                </td>
                            <?php break;
                            default:
                            ?>
                                <td class=" bg-inherit border border-gray-300 px-4 py-2  <?= (($v_column == 'name') || (!in_array("name", $column) && ($v_column == 'code'))) ? "sticky left-0 z-10 btn_table_views" : "" ?>  " data-nb="<?= $k_table_value . "column" ?>">
                                    <?php if (($v_column == 'name') && !empty($v_table_value['photo'])) { ?>
                                        <div class="flex items-center content-center gap-2 w-full">
                                            <?php if (!empty($v_table_value['photo'])) { ?>
                                                <div class="flex-initial w-10 aspect-[1/1] border border-gray-200 bg-white overflow-hidden">
                                                    <?= $this->addHrefImg([
                                                        'classfix' => 'overflow-hidden inline-flex justify-center items-center h-full aspect-[1/1] p-[3px] ',
                                                        'class' => '',
                                                        'addhref' => true,
                                                        'href' => $jv0,
                                                        'create_thumbs' => false,
                                                        'sizes' => '200x200x2',
                                                        'upload' => _upload_baiviet_l,
                                                        'image' =>  $v_table_value["photo"],
                                                        'alt' => $this->getNameData($v_table_value["name"]),
                                                    ]); ?>
                                                </div>
                                            <?php } ?>
                                            <div class="flex-1">
                                            <?php } ?>
                                            <span>
                                                <?php
                                                if (in_array($v_column, [
                                                    'max_quantity',
                                                    'quantity',
                                                    'min_quantity',
                                                    'booked',
                                                    'total_quantity',
                                                ])) {
                                                    echo $this->money($this->value_handing_column($v_column, $v_table_value));
                                                } else if (in_array($v_column, [
                                                    'sale_price',
                                                    'capital_price',
                                                    'total_price',
                                                ])) {

                                                    if (!empty($v_table_value['calculation_unit'])) {
                                                        echo $this->money($this->value_handing_column($v_column, $v_table_value)) . htmlspecialchars_decode($v_table_value['calculation_unit']);
                                                    } else {
                                                        echo $this->changeMoney($this->value_handing_column($v_column, $v_table_value));
                                                    }
                                                } else {
                                                    echo $this->value_handing_column($v_column, $v_table_value);
                                                }
                                                ?>
                                            </span>
                                            <?php if (($v_column == 'name') && !empty($v_table_value['photo'])) { ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </td>
                    <?php
                                break;
                        }
                    } ?>
                </tr>
                <tr class=" data_table_views hidden " data-nb="<?= $k_table_value . "column" ?>">
                    <td colspan="<?= count($column) + 1 ?>">
                        <div class="w-full max-w-[calc(100vw-20px)] sticky top-0 left-0">
                            <?= $this->getTemplateLayoutsFor([
                                'name_layouts' => 'form_warehouse_add',
                                'data' => $v_table_value,
                                'background' => 'bg-green-100',
                                'global' => ['cache', 'data_status', 'list_city', 'list_dist', 'db', 'lang'],
                            ]); ?>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php } else {
    echo $this->getTemplateLayoutsFor([
        'name_layouts' => 'templateNodata',
    ]);
} ?>