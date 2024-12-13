<?php
if ($form == "search") { ?>
    <div class="w-full  bg-white p-3 border border-gray-200  rounded-md">
        <div class=" scroll-y w-full max-h-[250px] sm:max-h-[340px] overflow-x-hidden overflow-y-auto grid grid-cols-1 gap-2 pr-1">
            <?php
            foreach ($data as $key => $value) {
                $quantity = 1;
                if ($_TYPE == 'export' && $_SRC == "transaction") {
                    $quantity_available = $this->getQuantityProductOrdered($value['id']);
                }
            ?>
                <div class=" <?= $class_form ?> template-default flex items-center gap-3 p-2 border border-gray-200 shadow shadow-gray-200 rounded-md">
                    <div class="flex-initial w-14 aspect-[1/1] border border-gray-200 bg-white overflow-hidden">
                        <?= $this->addHrefImg([
                            'classfix' => 'overflow-hidden inline-flex justify-center items-center h-full aspect-[1/1] p-[3px] ',
                            'class' => '',
                            'addhref' => true,
                            'create_thumbs' => false,
                            'sizes' => '200x200x2',
                            'upload' => _upload_baiviet_l,
                            'image' =>  $value["photo"],
                            'alt' => $this->getNameData($value["name"]),
                        ]); ?>
                    </div>
                    <div class="flex-1 flex flex-col gap-1 text-xs text-gray-800">
                        <div class=" text-sm text-blue-600">
                            <span>
                                <?= $this->getNameData($value["name"]) ?>
                            </span>
                        </div>
                        <?php if ($_TYPE == 'export' && $_SRC == "transaction") { ?>
                            <div class="">
                                <span>
                                    <?= "Giá Bán: " . $this->changeMoney($this->value_handing_column('sale_price', $value)) ?>
                                </span>
                            </div>
                            <div class="">
                                <span>
                                    <?= "Có thể đặt: " . $this->money($quantity_available) ?>
                                </span>
                            </div>
                        <?php } ?>
                        <?php if ($_TYPE == 'import' && $_SRC == "transaction") { ?>
                            <div class="">
                                <span>
                                    <?= "Giá Vốn: " . $this->changeMoney($this->value_handing_column('capital_price', $value)) ?>
                                </span>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form_quantity flex-initial px-4 hidden sm:inline-flex justify-center items-center ">
                        <div class="inline-flex border border-gray-300 text-gray-700 overflow-hidden rounded-full">
                            <div class="reduce_quantity cursor-pointer w-6 h-6 inline-flex justify-center items-center text-center text-xl ">
                                <span>-</span>
                            </div>
                            <div class="form_value_quantity  overflow-hidden border-gray-300  inline-flex justify-center items-center border-x px-[2px]">
                                <input type="number" name="quantity" value="<?= $quantity ?>" class="border-none text-center h-6 w-11" oninput="limitInput(this)" onkeydown="blockEnter(event)">
                            </div>
                            <div class="increase_quantity cursor-pointer w-6 h-6 inline-flex justify-center items-center text-center text-xl  ">
                                <span>+</span>
                            </div>
                        </div>
                    </div>
                    <div class=" add_list_product flex-initial  hidden sm:inline-flex justify-center items-center text-sm font-bold text-white cursor-pointer h-7 px-3 rounded bg-green-500 gap-1" data-value="<?= $value['id'] ?>">
                        <i class=" fas fa-plus"></i>
                        <div class="">
                            Thêm
                        </div>
                    </div>
                    <div class="inline-flex sm:hidden justify-center items-center flex-col gap-2">
                        <div class="form_quantity flex-initial px-4 inline-flex  justify-center items-center">
                            <div class="inline-flex border border-gray-300 text-gray-700 overflow-hidden rounded-full">
                                <div class="reduce_quantity cursor-pointer w-4 h-4 inline-flex justify-center items-center text-center text-sm ">
                                    <span>-</span>
                                </div>
                                <div class="form_value_quantity  overflow-hidden border-gray-300  inline-flex justify-center items-center border-x px-[2px]">
                                    <input type="number" name="quantity" value="<?= $quantity ?>" class="border-none text-center h-4 w-8 text-xs" oninput="limitInput(this)" onkeydown="blockEnter(event)">
                                </div>
                                <div class="increase_quantity cursor-pointer w-4 h-4 inline-flex justify-center items-center text-center text-sm  ">
                                    <span>+</span>
                                </div>
                            </div>
                        </div>
                        <div class=" add_list_product flex-initial  inline-flex justify-center items-center text-xs font-bold text-white cursor-pointer h-6 px-2 rounded bg-green-500 gap-1" data-value="<?= $value['id'] ?>">
                            <i class=" fas fa-plus"></i>
                            <div class="">
                                Thêm
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } ?>
        </div>
    </div>
    <?php } else {
    if ($_SRC == 'transaction') {
        switch ($_TYPE) {
            case 'import':
    ?>
                <?php $column = ['name', 'code', 'id_warehouse', 'id_supplier', 'capital_price', 'quantity']; ?>
                <table class="form_table_views table-auto min-w-[900px] w-full border-collapse border border-gray-200  ">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class=" border border-gray-200 px-3 py-2 text-left bg-blue-300 sticky top-0 z-10 ">
                                <span>
                                    STT
                                </span>
                            </th>
                            <?php foreach ($column as $v_column) { ?>
                                <th class=" border border-gray-200 px-4 py-2 text-left bg-blue-300 sticky top-0  <?= ($v_column == 'name') ? "w-[250px] left-0 z-20" : " z-10" ?> ">
                                    <span>
                                        <?= $this->value_handing_column($v_column) ?>
                                    </span>
                                </th>
                            <?php } ?>
                            <th class=" border border-gray-200 px-4 py-2 text-left bg-blue-300 sticky top-0 z-10 ">
                                <span>
                                    Số Lượng
                                </span>
                            </th>
                            <th class=" border border-gray-200  text-left bg-blue-300 sticky top-0 z-10 " style="width: 40px;">
                                <span>
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="body_table">
                        <?php
                        foreach ($data as $k_table_value => $v_table_value) {
                            $quantity = 1;
                            foreach ($array_list_product as $value_check) {
                                if ($value_check['id'] == $v_table_value['id']) {
                                    $quantity = (int)$value_check['quantity'];
                                    break;
                                }
                            }
                        ?>
                            <tr class="template-default transition-all duration-200">
                                <td class=" bg-inherit border border-gray-300 w-9 " align="center">
                                    <div class="inline-flex  justify-center items-center w-9 pt-1">
                                        <?= $k_table_value + 1 ?>
                                    </div>
                                </td>
                                <?php foreach ($column as $v_column) { ?>
                                    <td class=" border border-gray-300 px-4 py-2  <?= ($v_column == 'name') ? "sticky left-0 z-10 bg-white " : " bg-inherit " ?> ">
                                        <?php if (($v_column == 'name') && !empty($v_table_value['photo'])) { ?>
                                            <div class="flex items-center content-center gap-2 w-full">
                                                <?php if (!empty($v_table_value['photo'])) { ?>
                                                    <div class="flex-initial w-10 aspect-[1/1] border border-gray-200 bg-white overflow-hidden">
                                                        <?= $this->addHrefImg([
                                                            'classfix' => 'overflow-hidden inline-flex justify-center items-center h-full aspect-[1/1] p-[3px] ',
                                                            'class' => '',
                                                            'addhref' => true,
                                                            'create_thumbs' => false,
                                                            'href' => $jv0,
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
                                                    ])) {
                                                        echo $this->money($this->value_handing_column($v_column, $v_table_value));
                                                    } else if (in_array($v_column, [
                                                        'sale_price',
                                                        'capital_price',
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
                                <?php } ?>
                                <td class="bg-inherit border border-gray-300" align="center">
                                    <div class="form_quantity flex-initial px-2 inline-flex justify-center items-center">
                                        <div class="inline-flex border border-gray-300 text-gray-700 overflow-hidden rounded-full">
                                            <div class="reduce_quantity cursor-pointer w-6 h-6 inline-flex justify-center items-center text-center text-xl ">
                                                <span>-</span>
                                            </div>
                                            <div class="form_value_quantity  overflow-hidden border-gray-300  inline-flex justify-center items-center border-x px-[2px]">
                                                <input type="number" name="quantity" value="<?= $quantity ?>" class="border-none text-center h-6 w-11" oninput="limitInput(this)" onkeydown="blockEnter(event)">
                                            </div>
                                            <div class="increase_quantity cursor-pointer w-6 h-6 inline-flex justify-center items-center text-center text-xl  ">
                                                <span>+</span>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="data[list_id_product][]" value='{"id": "<?= $v_table_value['id'] ?>", "quantity": <?= $quantity ?>}'>
                                </td>
                                <td class="bg-inherit border border-gray-300 ">
                                    <div class="px-2">
                                        <div class="remove_list_product flex-initial inline-flex justify-center items-center text-sm font-bold text-white cursor-pointer h-7 px-2 rounded bg-red-500 gap-1">
                                            <i class="fas fa-trash"></i>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php
                break;
            case 'export':
            ?>
                <div class="grid grid-cols-1 gap-2">
                    <?php
                    foreach ($data as $k_table_value => $v_table_value) {
                        $quantity = 1;
                        $quantity_available = $this->getQuantityProductOrdered($v_table_value['id']);
                        foreach ($array_list_product as $value_check) {
                            if ($value_check['id'] == $v_table_value['id']) {
                                $quantity = (int)$value_check['quantity'];
                                break;
                            }
                        }
                    ?>
                        <div class="template-default flex flex-wrap items-center rounded-lg shadow-lg shadow-gray-200 border border-gray-200 px-3 py-2 gap-2">
                            <div class="w-full flex items-center gap-2 text-sm">
                                <div class="flex-initial text-red-500">
                                    <span>
                                        <?= $this->value_handing_column('code', $v_table_value) ?>
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <span>
                                        <?= $this->value_handing_column('name', $v_table_value) ?>
                                    </span>
                                </div>
                                <div class=" cursor-pointer remove_list_product">
                                    <i class="fas fa-times font-medium text-gray-600 hover:text-gray-800 transition-all duration-300 "></i>
                                </div>
                            </div>
                            <div class="w-full flex items-center gap-2 text-sx">
                                <div class="flex-1  text-red-500">
                                    <span>
                                        <?= "Giá Bán: " .  $this->money($this->value_handing_column('sale_price', $v_table_value), "đ") ?>
                                    </span>
                                </div>
                                <div class="flex-initial">
                                    <span>
                                        <?= "Có thể đặt: " . $this->money($quantity_available) ?>
                                    </span>
                                </div>
                                <div class="form_quantity flex-initial  inline-flex justify-center items-center">
                                    <div class="inline-flex border border-gray-300 text-gray-700 overflow-hidden rounded-full">
                                        <div class="reduce_quantity cursor-pointer w-6 h-6 inline-flex justify-center items-center text-center text-xl ">
                                            <span>-</span>
                                        </div>
                                        <div class="form_value_quantity  overflow-hidden border-gray-300  inline-flex justify-center items-center border-x px-[2px]">
                                            <input type="number" name="quantity" value="<?= $quantity ?>" class="border-none text-center h-6 w-11" oninput="limitInput(this)" onkeydown="blockEnter(event)">
                                        </div>
                                        <div class="increase_quantity cursor-pointer w-6 h-6 inline-flex justify-center items-center text-center text-xl  ">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="data[list_id_product][]" value='{"id": "<?= $v_table_value['id'] ?>", "quantity": <?= $quantity ?>}'>
                            </div>
                        </div>
                    <?php } ?>
                </div>

<?php
                break;
            default:
                # code...
                break;
        }
    }
}
?>