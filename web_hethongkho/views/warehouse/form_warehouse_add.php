<?php
global $name_table_warehouse_bill_goods_detail;
global $name_table_warehouse_bill_detail;
global $name_table_warehouse_supplier;
global $name_table_warehouse_customer;
global $name_table_warehouse_ship;
global $array_param_value_id;

$check_bill_detail = false;

switch ($_SRC) {
    case 'warehouse':
        switch ($_TYPE) {
            case 'warehouse':
            case '':
                $title_add = "Kho";
                $column = ['name', 'code', 'photo', 'city', 'district', 'address', 'max_quantity', 'status'];
                break;
            case 'product':
                $title_add = "Sản Phẩm";
                $column = ['name', 'code', 'photo', 'id_supplier', 'barcode', 'sale_price', 'capital_price', 'calculation_unit', 'heft', 'size', 'location', 'quantity', 'max_quantity', 'min_quantity', 'painted', 'brand', 'origin', 'note'];
                $array_input_hiden = [
                    "id_warehouse" => $array_param_value_id['id_warehouse'],
                ];
                break;
            default:
                break;
        }
        break;
    case 'partner':
        switch ($_TYPE) {
            case 'supplier':
            case '':
                $title_add = "Nhà Cung Cấp";
                $column = ['name', 'code', 'photo', 'phone', 'email', 'city', 'district', 'address', 'company', 'tax_code', 'note', 'status'];
                break;
            case 'customer':
                $title_add = "Khách Hàng";
                $column = ['name', 'code', 'gender', 'photo', 'phone', 'email', 'birthdate', 'city', 'district', 'address', 'kind', "company", 'tax_code', 'status'];
                break;
            case 'ship':
                $title_add = "Đơn Vị Vận Chuyển";
                $column = ['name', 'code', 'photo', 'phone', 'city', 'district', 'address',  "company", 'tax_code', 'note', 'status'];
                break;
            default:
                break;
        }
        break;
    case 'transaction':
        switch ($_TYPE) {
            case 'import':
                if ($_ACT == "man") {
                    $column = ['code', 'import_date',  'note', 'status'];
                    if (!empty($data)) {
                        $list_product_detail = $db->rawQuery("select * from #_$name_table_warehouse_bill_goods_detail where " . $this->getAccountParam()->sql . " and id_bill_goods=?", array($data['id']));
                    }
                }
                break;
            case 'export':
                if ($_ACT == "man") {
                    $column = ['code', 'id_ship',  'id_customer',  'heft', 'size', 'note', 'status'];
                    if (!empty($data)) {
                        $list_product_detail = $db->rawQuery("select * from #_$name_table_warehouse_bill_detail where " . $this->getAccountParam()->sql . " and id_bill=?", array($data['id']));
                    }
                }
                break;
            default:
                break;
        }
        $check_bill_detail = true;
        break;
    default:
        # code...
        break;
}
$input_text_defail = ["class" => "", "type" => "text", "required" => false, "readonly" => false];
$input_text_date = ["class" => "input_date", "type" => "text", "required" => false, "readonly" => false];
$input_number_defail = ["class" => "", "type" => "number", "required" => false, "readonly" => false,];
$input_number_required = ["class" => "", "type" => "number", "required" => true, "readonly" => false,];
if (!empty($data)) {
    $input_number_quantity = ["class" => "", "type" => "number", "required" => true, "readonly" => true,];
} else {
    $input_number_quantity = ["class" => "", "type" => "number", "required" => true, "readonly" => false,];
}

$array_input = [
    "top" => [
        "barcode" => $input_number_defail,
        "quantity" => $input_number_quantity,
        "max_quantity" => $input_number_required,
        "min_quantity" => $input_number_required,
        "sale_price" => $input_number_required,
        "capital_price" => $input_number_required,
        "calculation_unit" => $input_text_defail,
        "heft" => $input_text_defail,
        "size" => $input_text_defail,
        "location" => $input_text_defail,
        "brand" => $input_text_defail,
        "origin" => $input_text_defail,
    ],
    "center" => [
        "address" => $input_text_defail,
        "phone" => $input_number_required,
        "email" => ["class" => "", "type" => "email", "required" => false, "readonly" => false],
        "birthdate" => $input_text_date,
        "import_date" => $input_text_date,
        "profession" => $input_text_defail,
        "company" => $input_text_defail,
        "tax_code" => $input_number_defail,
        "CCCD" => $input_text_defail,
        "position" => $input_text_defail,
        "price" => $input_number_defail,
    ],
];
$array_textarea = [
    "painted" => [
        "class" => "",
        "required" => false,
        "readonly" => false,
    ],
    "note" => [
        "class" => "",
        "required" => false,
        "readonly" => false,
    ],
];
?>
<?php if (!empty($column)) { ?>
    <form action="" method="POST" name="form_warehouse_add" class="w-full flex flex-wrap items-start gap-4 <?= (!empty($background)) ? $background : 'bg-white' ?> pt-4 px-3" enctype="multipart/form-data">
        <?php if (empty($data)) { ?>
            <div class=" w-full flex <?= (!empty($background)) ? $background : 'bg-white' ?>">
                <div class="title flex-1 w-full text-base text-black font-bold ">
                    <span>
                        <?= "Thêm Mới " . $title_add ?>
                    </span>
                </div>
                <div class="<?= $close_popup ?> absolute inline-flex justify-center items-center h-7 aspect-[1/1] top-3 right-3 rounded-md bg-inherit cursor-pointer hover:bg-red-600 hover:text-white transition-all text-base z-10 cursor-pointer">
                    <span>
                        <i class="fas fa-times"></i>
                    </span>
                </div>
            </div>
        <?php } else { ?>
            <input type="hidden" name="id" value="<?= $data['id'] ?>">
        <?php } ?>
        <?php if (in_array('photo', $column)) { ?>
            <div class="inline-flex flex-wrap gap-2 w-full sm:w-[50%] lg:max-w-[27%]">
                <label class="block w-full">
                    <div class="block text-sm font-semibold text-slate-600">
                        <span>
                            Hình ảnh
                            <sup>(600x600)</sup>
                        </span>
                    </div>
                    <div class="mt-1 w-full">
                        <input type="file" name="photo" placeholder="Chọn hình ảnh của bạn" <?= (!empty($data['photo'])) ? '' : 'required' ?> class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-200 file:text-blue-700 hover:file:bg-blue-300 " />
                    </div>
                </label>
                <div class="w-full relative aspect-[1/1] load_website overflow-hidden rounded-md bg-white border border-gray-200">
                    <?php if (empty($data)) { ?>
                        <img data-src="<?= "assets/images/no_image.webp" ?>" alt="Ảnh không có sẵn" class="lazy absolute overflow-hidden rounded-md top-0 left-0 w-full h-full object-contain">
                    <?php } else { ?>
                        <?= $this->addHrefImg([
                            'classfix' => 'overflow-hidden inline-flex justify-center items-center h-full aspect-[1/1] shadow p-[3px] rounded-sm bg-white transition-all duration-300',
                            'class' => '',
                            'addhref' => true,
                            'href' => $jv0,
                            'create_thumbs' => false,
                            'sizes' => '600x600x2',
                            'upload' => _upload_baiviet_l,
                            'image' =>  $data["photo"],
                            'alt' => $this->getNameData($data["name"]),
                        ]); ?>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        <div class=" flex-1  grid grid-cols-1 md:grid-cols-2 <?= (!in_array('photo', $column)) ? 'lg:grid-cols-3' : '' ?>  gap-2 content-start justify-start">
            <?php foreach ($array_input_hiden as $key => $value) {
            ?>
                <input type="hidden" name="data[<?= $key ?>]" value="<?= $value ?>">
            <?php } ?>
            <?php
            if (in_array('name', $column)) {
                echo $this->getTemplateLayoutsFor([
                    'name_layouts' => 'input_warehouse',
                    'class_form' => 'w-full',
                    'lable' => $this->getTitleColumn('name'),
                    'placeholder' => 'Nhập ' . $this->getTitleColumn('name'),
                    'data' => 'name',
                    'value' => (!empty($data['name'])) ? $data['name'] : '',
                    'type' => 'text',
                    'save_cache' => false,
                    'required' => true,
                    'readonly' => false,
                ]);
            }
            ?>
            <?php if (in_array('code', $column)) { ?>
                <div class="flex items-end gap-1">
                    <div class="form_inputcode flex-1">
                        <?= $this->getTemplateLayoutsFor([
                            'name_layouts' => 'input_warehouse',
                            'class_form' => 'w-full',
                            'lable' => $this->getTitleColumn('code'),
                            'placeholder' => 'Nhập ' . $this->getTitleColumn('code'),
                            'data' => 'code',
                            'value' => (!empty($data['code'])) ? $data['code'] : '',
                            'type' => 'text',
                            'save_cache' => false,
                            'required' => true,
                            'readonly' => false,
                        ]);
                        ?>
                    </div>
                    <div class="button_random flex-initial flex justify-center items-center h-9 aspect-[1/1] bg-green-500 rounded-md cursor-pointer ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                            <path d="M14.2584 16.9886L9.7525 13.9808C9.70056 13.947 9.64053 13.9278 9.57866 13.9251C9.51678 13.9224 9.45531 13.9363 9.40063 13.9654C9.34596 13.9946 9.30007 14.0378 9.26773 14.0907C9.23539 14.1435 9.21778 14.2041 9.21674 14.2661V15.4177C7.63761 15.3394 6.1284 14.7418 4.92315 13.7175C3.71791 12.6933 2.88397 11.2996 2.55067 9.75266C2.83628 8.41091 3.50292 7.18026 4.47047 6.20859C4.50266 6.17663 4.52821 6.1386 4.54565 6.09671C4.56308 6.05482 4.57206 6.00988 4.57207 5.9645C4.57208 5.91912 4.56312 5.87418 4.54569 5.83228C4.52827 5.79038 4.50274 5.75234 4.47056 5.72037C4.43839 5.68839 4.40021 5.6631 4.35823 5.64596C4.31624 5.62882 4.27128 5.62016 4.22594 5.62049C4.1806 5.62082 4.13578 5.63013 4.09404 5.64788C4.05231 5.66563 4.0145 5.69147 3.9828 5.72391C2.91161 6.80519 2.17722 8.17459 1.86886 9.66573C1.5605 11.1569 1.69144 12.7055 2.24577 14.1236C2.80011 15.5417 3.75398 16.768 4.99148 17.6538C6.22898 18.5395 7.69685 19.0464 9.21674 19.113V20.2817C9.21776 20.3437 9.23535 20.4043 9.26768 20.4572C9.30002 20.5101 9.34591 20.5533 9.4006 20.5824C9.45528 20.6116 9.51676 20.6255 9.57865 20.6228C9.64053 20.6201 9.70056 20.6008 9.7525 20.567L14.2584 17.5592C14.3058 17.5283 14.3448 17.486 14.3718 17.4362C14.3988 17.3864 14.4129 17.3306 14.4129 17.2739C14.4129 17.2172 14.3988 17.1615 14.3718 17.1116C14.3448 17.0618 14.3058 17.0195 14.2584 16.9886Z" fill="#fff" />
                            <path d="M13.4273 2.88801V1.71926C13.4263 1.65722 13.4088 1.59656 13.3765 1.5436C13.3442 1.49065 13.2983 1.44734 13.2436 1.4182C13.1888 1.38905 13.1273 1.37514 13.0654 1.37791C13.0035 1.38068 12.9434 1.40003 12.8915 1.43395L8.38565 4.44176C8.33876 4.4731 8.30031 4.51553 8.27372 4.5653C8.24713 4.61506 8.23322 4.67063 8.23322 4.72707C8.23321 4.7835 8.24712 4.83907 8.27371 4.88884C8.3003 4.93861 8.33874 4.98104 8.38563 5.01238L12.8915 8.02017C12.9434 8.05395 13.0035 8.07318 13.0653 8.07588C13.1272 8.07859 13.1887 8.06466 13.2434 8.03554C13.298 8.00643 13.3439 7.96319 13.3763 7.91032C13.4086 7.85745 13.4262 7.79688 13.4273 7.7349V6.58334C15.0064 6.66162 16.5156 7.25922 17.7208 8.28347C18.9261 9.30772 19.76 10.7014 20.0933 12.2483C19.8077 13.5901 19.1411 14.8207 18.1735 15.7924C18.1108 15.8574 18.0761 15.9445 18.077 16.035C18.078 16.1254 18.1144 16.2118 18.1785 16.2755C18.2426 16.3392 18.3292 16.3751 18.4195 16.3754C18.5099 16.3757 18.5967 16.3404 18.6612 16.2771C19.7324 15.1958 20.4668 13.8264 20.7751 12.3352C21.0835 10.8441 20.9526 9.29544 20.3982 7.87738C19.8439 6.45932 18.89 5.23293 17.6525 4.3472C16.415 3.46148 14.9471 2.95455 13.4273 2.88801Z" fill="#fff" />
                        </svg>
                    </div>
                </div>
            <?php  } ?>

            <?php
            if (in_array('id_supplier', $column)) {
                $list_supplier = $db->rawQuery("select name,id from #_$name_table_warehouse_supplier where status = 1 and trash<>true");
                if (!empty($list_supplier)) {
                    echo $this->getTemplateLayoutsFor([
                        'name_layouts' => 'select_warehouse',
                        'class_form' => 'w-full',
                        'lable' => $this->getTitleColumn('id_supplier'),
                        'placeholder' => 'Chọn ' . $this->getTitleColumn('id_supplier'),
                        'data' => 'id_supplier',
                        'value' => (!empty($data['id_supplier'])) ? $data['id_supplier'] : '',
                        'data_option' => $list_supplier,
                        'name_col_view' => 'name',
                        'name_col_value' => 'id',
                        'save_cache' => false,
                        'required' => true,
                    ]);
                }
            }
            if (in_array('id_customer', $column)) {
                $list_customer = $db->rawQuery("select name,id from #_$name_table_warehouse_customer where status = 1 and trash<>true");
                if (!empty($list_customer)) {
                    echo $this->getTemplateLayoutsFor([
                        'name_layouts' => 'select_warehouse',
                        'class_form' => 'w-full',
                        'lable' => $this->getTitleColumn('id_customer'),
                        'placeholder' => 'Chọn ' . $this->getTitleColumn('id_customer'),
                        'data' => 'id_customer',
                        'value' => (!empty($data['id_customer'])) ? $data['id_customer'] : '',
                        'data_option' => $list_customer,
                        'name_col_view' => 'name',
                        'name_col_value' => 'id',
                        'save_cache' => false,
                        'required' => true,
                    ]);
                }
            }
            if (in_array('id_ship', $column)) {
                $list_ship = $db->rawQuery("select name,id from #_$name_table_warehouse_ship where status = 1 and trash<>true");
                if (!empty($list_ship)) {
                    echo $this->getTemplateLayoutsFor([
                        'name_layouts' => 'select_warehouse',
                        'class_form' => 'w-full',
                        'lable' => $this->getTitleColumn('id_ship'),
                        'placeholder' => 'Chọn ' . $this->getTitleColumn('id_ship'),
                        'data' => 'id_ship',
                        'value' => (!empty($data['id_ship'])) ? $data['id_ship'] : '',
                        'data_option' => $list_ship,
                        'name_col_view' => 'name',
                        'name_col_value' => 'id',
                        'save_cache' => false,
                        'required' => true,
                    ]);
                }
            }
            if (in_array('gender', $column)) {
                $list_gender = [["name" => "Nam", "value" => 1], ["name" => "Nữ", "value" => 2]];
                if (!empty($list_gender)) {
                    echo $this->getTemplateLayoutsFor([
                        'name_layouts' => 'select_warehouse',
                        'class_form' => 'w-full',
                        'lable' => $this->getTitleColumn('gender'),
                        'placeholder' => 'Chọn ' . $this->getTitleColumn('gender'),
                        'data' => 'gender',
                        'value' => (!empty($data['gender'])) ? $data['gender'] : '',
                        'data_option' => $list_gender,
                        'name_col_view' => 'name',
                        'name_col_value' => 'value',
                        'save_cache' => false,
                        'required' => false,
                    ]);
                }
            }
            foreach ($column  as $value_column) {
                if (!empty($array_input['top'][$value_column]) && isset($array_input['top'][$value_column])) {
                    echo $this->getTemplateLayoutsFor([
                        'name_layouts' => 'input_warehouse',
                        'class_form' => 'w-full',
                        'class' => $array_input['top'][$value_column]['class'],
                        'lable' => $this->getTitleColumn($value_column),
                        'placeholder' => 'Nhập ' . $this->getTitleColumn($value_column),
                        'data' => $value_column,
                        'value' => (!empty($data[$value_column])) ? $data[$value_column] : '',
                        'type' => $array_input['top'][$value_column]['type'],
                        'save_cache' => false,
                        'required' => $array_input['top'][$value_column]['required'],
                        'readonly' => $array_input['top'][$value_column]['readonly'],
                    ]);
                }
            }
            if (in_array('city', $column)) {
                if (!empty($list_city)) {
                    echo $this->getTemplateLayoutsFor([
                        'name_layouts' => 'select_warehouse',
                        'class_form' => 'w-full',
                        'lable' => $this->getTitleColumn('city'),
                        'placeholder' => 'Chọn ' . $this->getTitleColumn('city'),
                        'data' => 'city',
                        'value' => (!empty($data['city'])) ? $data['city'] : '',
                        'data_option' => $list_city,
                        'name_col_view' => 'name',
                        'name_col_value' => 'id',
                        'save_cache' => false,
                        'required' => true,
                    ]);
                    if (!empty($data['city'])) {
                        $list_dist = $db->rawQuery("select name_$lang as name, id from #_place_dists where id_city=? ", array($data['city']));
                    }
                }
            }
            if (in_array('district', $column)) {
            ?>
                <div class="form_select_district">
                    <?php
                    if (!empty($list_dist)) {
                        echo $this->getTemplateLayoutsFor([
                            'name_layouts' => 'select_warehouse',
                            'class_form' => 'w-full',
                            'lable' => $this->getTitleColumn('district'),
                            'placeholder' => 'Chọn ' . $this->getTitleColumn('district'),
                            'data' => 'district',
                            'value' => (!empty($data['district'])) ? $data['district'] : '',
                            'data_option' => $list_dist,
                            'name_col_view' => 'name',
                            'name_col_value' => 'id',
                            'save_cache' => false,
                            'required' => true,
                        ]);
                    }
                    ?>
                </div>
            <?php
            }
            foreach ($column  as $value_column) {
                if (!empty($array_input['center'][$value_column]) && isset($array_input['center'][$value_column])) {
                    switch ($value_column) {
                        case 'birthdate':
                        case 'balance_day':
                        case 'check_date':
                        case 'expiration_date':
                        case 'import_date':
                            $value_input = (!empty($data[$value_column])) ? date("d/m/Y", $data[$value_column]) : '';
                            break;
                        default:
                            $value_input = (!empty($data[$value_column])) ? $data[$value_column] : '';
                            break;
                    }
                    echo $this->getTemplateLayoutsFor([
                        'name_layouts' => 'input_warehouse',
                        'class_form' => 'w-full',
                        'class' => $array_input['center'][$value_column]['class'],
                        'lable' => $this->getTitleColumn($value_column),
                        'placeholder' => 'Nhập ' . $this->getTitleColumn($value_column),
                        'data' => $value_column,
                        'value' => $value_input,
                        'type' => $array_input['center'][$value_column]['type'],
                        'save_cache' => false,
                        'required' => $array_input['center'][$value_column]['required'],
                        'readonly' => $array_input['center'][$value_column]['readonly'],
                    ]);
                }
            }
            if (in_array('status', $column)) {
                echo $this->getTemplateLayoutsFor([
                    'name_layouts' => 'select_warehouse',
                    'class_form' => 'w-full',
                    'lable' => $this->getTitleColumn('status'),
                    'placeholder' => 'Nhập ' . $this->getTitleColumn('status'),
                    'data' => 'status',
                    'value' => (!empty($data['status'])) ? $data['status'] : '',
                    'data_option' => $data_status,
                    'name_col_view' => 'name',
                    'name_col_value' => 'value',
                    'save_cache' => false,
                    'required' => true,
                ]);
            }
            ?>
        </div>
        <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-2 content-start justify-start">
            <?php
            foreach ($column  as $value_column) {
                if (!empty($array_textarea[$value_column]) && isset($array_textarea[$value_column])) {
                    echo $this->getTemplateLayoutsFor([
                        'name_layouts' => 'textarea_warehouse',
                        'class_form' => 'w-full',
                        'class' => $array_textarea[$value_column]['class'],
                        'lable' => $this->getTitleColumn($value_column),
                        'placeholder' => 'Nhập ' . $this->getTitleColumn($value_column),
                        'data' => $value_column,
                        'value' => (!empty($data[$value_column])) ? $data[$value_column] : '',
                        'save_cache' => false,
                        'required' => $array_textarea[$value_column]['required'],
                        'readonly' => $array_textarea[$value_column]['readonly'],
                    ]);
                }
            }
            ?>
        </div>
        <?php if (($check_bill_detail == true) && !empty($data)) { ?>
            <div class="w-full  bg-white rounded p-2 shadow-md shadow-gray-300 border border-gray-200">
                <div class="max-w-full overflow-x-auto overflow-y-hidden scroll-x">
                    <?php $column_table_product = ['id_product', 'code_product', 'id_warehouse', 'id_supplier', 'quantity', 'price']; ?>
                    <table class="form_table_views table-auto min-w-[1000px] w-full border-collapse border border-gray-200  ">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class=" border border-gray-200 px-3 py-2 text-left bg-blue-300 sticky top-0 z-10 ">
                                    <span>
                                        STT
                                    </span>
                                </th>
                                <?php foreach ($column_table_product as $value_product) { ?>
                                    <th class=" border border-gray-200 px-4 py-2 text-left bg-blue-300 sticky top-0  <?= ($value_product == 'name') ? "w-[250px] left-0 z-20" : " z-10" ?> ">
                                        <span>
                                            <?php if ($value_product == 'quantity') {
                                                echo "Số Lượng";
                                            } else {
                                                echo $this->value_handing_column($value_product);
                                            }
                                            ?>
                                        </span>
                                    </th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody class="body_table">
                            <?php
                            foreach ($list_product_detail as $key_detail => $value_detail) {
                            ?>
                                <tr class="template-default transition-all duration-200">
                                    <td class=" bg-inherit border border-gray-300 w-9 " align="center">
                                        <div class="inline-flex  justify-center items-center w-9 pt-1">
                                            <?= $key_detail + 1 ?>
                                        </div>
                                    </td>
                                    <?php foreach ($column_table_product as $value_product) {
                                    ?>
                                        <td class=" bg-inherit border border-gray-300 px-4 py-2  <?= ($value_product == 'name') ? "sticky left-0 z-10 " : "" ?> ">
                                            <div class="flex items-center content-center gap-2 w-full">
                                                <div class="flex-1">
                                                    <span>
                                                        <?php
                                                        if (in_array($value_product, [
                                                            'max_quantity',
                                                            'quantity',
                                                            'min_quantity',
                                                        ])) {
                                                            echo $this->money($this->value_handing_column($value_product, $value_detail));
                                                        } else if (in_array($value_product, [
                                                            'sale_price',
                                                            'price',
                                                            'capital_price',
                                                        ])) {
                                                            echo $this->changeMoney($this->value_handing_column($value_product, $value_detail));
                                                        } else {
                                                            echo $this->value_handing_column($value_product, $value_detail);
                                                        }
                                                        ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } ?>
        <div class="flex w-full gap-3 items-center justify-end sticky bottom-0 right-0 <?= (!empty($background)) ? $background : 'bg-white' ?> py-3">
            <button type="submit" name="submit-add-data" class=" px-4 h-9 text-sm sm:text-base font-normal rounded-md  text-white bg-green-500 hover:bg-green-600 transition-all duration-300 inline-flex justify-center items-center gap-1 cursor-pointer">
                <i class="fas fa-file-download"></i>
                <?php if (empty($data)) { ?>
                    <div class="">
                        <span>Lưu</span>
                    </div>
                <?php } else { ?>
                    <div class="">
                        <span>Sửa</span>
                    </div>
                <?php } ?>
            </button>
        </div>
    </form>
    <script>
        // random code
        $('body').on('click', '.button_random', function() {
            var _this = $(this);
            if (!_this.hasClass('on')) {
                _this.addClass('on');
                $.ajax({
                    url: 'ajax/warehouse/handleCode.php',
                    type: 'POST',
                    data: {
                        com: '<?= $com ?>',
                        src: '<?= $_SRC ?>',
                        type: '<?= $_TYPE ?>',
                        act: '<?= $_ACT ?>',
                    },
                    dataType: 'Json',
                    beforeSend: function() {

                    },
                    success: function(result) {
                        if ($(_this).siblings('.form_inputcode').find('input[name="data[code]"]').length > 0) {
                            $(_this).siblings('.form_inputcode').find('input[name="data[code]"]').val(result.data.code).trigger('input');
                        }
                    },
                    complete: function() {
                        setTimeout(function() {
                            _this.removeClass('on');
                        }, 500);
                    },
                });
            }
        });
        $('body input[name="data[code]"]').each(function() {
            if (($(this).val() === '') && $(this).closest('.form_inputcode').siblings('.button_random').length > 0) {
                $(this).closest('.form_inputcode').siblings('.button_random').trigger('click');
            }
        });
        // end
    </script>
<?php } ?>