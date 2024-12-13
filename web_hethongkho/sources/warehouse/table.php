<?php
// $array_table = [
//     "table" => [
//         [
//             "name_table" => "table_warehouse_bill_goods",
//             "column" => ['invoice_code_entered', 'supplier', 'importer', 'total_price', 'note', 'status', 'import_date', 'date_created'],
//         ],
//         [
//             "name_table" => "table_warehouse_bill_goods_detail",
//             "column" => ['id_bill_goods', 'id_product', 'name', 'sale_price', 'capital_price', 'quantity', 'total_price', 'status'],
//         ],
//     ],
//     "key_sub" => [
//         [
//             'parent_table' => [],
//             'child_table' => [],
//             'delete' => true,
//             'update' => true,
//         ]
//     ],
// ];
// $func->autoCreateTable($array_table);
// ALTER TABLE table_warehouse_bill_goods_detail
// ADD CONSTRAINT fk_bill_goods
// FOREIGN KEY (id_bill_goods)
// REFERENCES table_warehouse_bill_goods(id)
// ON UPDATE CASCADE
// ON DELETE CASCADE;
// ALTER TABLE table_warehouse_bill_goods_detail
// DROP FOREIGN KEY fk_bill_goods;
// tên bảng và tên cột
$array_table = [
    [
        "name_table" => "table_warehouse_account",
        "column" => ["name", "phone", "email", "password", "subdomain", "token", "city", "district", "address", "birthdate", "profession", "date_created", "trash", "date_trash", "date_logged"],
    ],
    [
        "name_table" => "table_warehouse_subaccount",
        "column" => ["id_owner", "code", "name", "gender", "photo", "thumb", "phone", "email", "birthdate", "password", "city", "district", "address", "CCCD", "position", "decentralization", "history", "salary_type", "salary", "status", "date_created", "trash", "date_trash", "date_logged"],
    ],
    [
        "name_table" => "table_warehouse_notification",
        "column" => ["id_owner", "name", "content", "check_content", "kind", "viewed", "status", "date_created", "trash", "date_trash"],
    ],
    [
        "name_table" => "table_warehouse_comments",
        "column" => ["name", "content", "phone", "status", "date_created", "trash", "date_trash"],
    ],
    [
        "name_table" => "table_warehouse_warehouse",
        "column" => ["id_owner", "code", "name", "photo", "thumb", "city", "district", "address", "max_quantity", "status", "date_created", "trash", "date_trash"],
    ],
    [
        "name_table" => "table_warehouse_supplier",
        "column" => ["id_owner", "code", "name", "photo", "thumb", "phone", "email", "city", "district", "address", "company", "tax_code", "goods_money", "note", "status", "date_created", "trash", "date_trash"],
    ],
    [
        "name_table" => "table_warehouse_expense",
        "column" => ["id_owner", "id_save", "id_staff", "code", "receiver", "payer", "time_save", "price", "kind", "formality", "status", "date_created", "trash", "date_trash", "data_trashed"],
    ],
    [
        "name_table" => "table_warehouse_customer",
        "column" => ["id_owner", "code", "name", "gender", "photo", "thumb", "phone", "email", "birthdate", "city", "district", "address", "kind", "company", "tax_code", "CCCD", "corner_money", "note", "status", "date_created", "trash", "date_trash"],
    ],
    [
        "name_table" => "table_warehouse_ship",
        "column" => ["id_owner", "code", "name", "photo", "thumb", "phone", "city", "district", "address", "company", "tax_code", "salary_paid", "salary_type", "salary", "status", "note",  "date_created", "trash", "date_trash"],
    ],
    [
        "name_table" => "table_warehouse_product",
        "column" => ["id_owner", "id_warehouse", "id_supplier", "code", "name", "photo", "thumb", "barcode", "sale_price", "capital_price", "calculation_unit", "heft", "size", "location", "quantity", "max_quantity", "min_quantity", "painted", "brand", "origin", "note", "status", "date_created", "trash", "date_trash", "data_trashed"],
    ],
    [
        "name_table" => "table_warehouse_bill",
        "column" => ["id_owner", "id_customer", "id_ship", "id_exporter", "status_exporter", "code", "heft", "size", "total_quantity", "total_price", "discount", "pay", "note", "status", "date_created", "trash", "date_trash", "data_trashed"],
    ],
    [
        "name_table" => "table_warehouse_bill_detail",
        "column" => ["id_owner", "id_bill", "id_warehouse", "id_product", "id_supplier", "quantity", "price", "status", "date_created", "data_trashed"],
    ],
    [
        "name_table" => "table_warehouse_bill_goods",
        "column" => ["id_owner", "code", "id_importer", "status_importer", "total_quantity", "total_price", "import_date", "note", "status", "date_created", "trash", "date_trash", "data_trashed"],
    ],
    [
        "name_table" => "table_warehouse_bill_goods_detail",
        "column" => ["id_owner", "id_warehouse", "id_bill_goods", "id_product", "id_supplier", "quantity", "price", "expiration_date", "status", "date_created", "data_trashed"],
    ],
    [
        "name_table" => "table_warehouse_check",
        "column" => ["id_owner", "id_tester", "id_balancer", "code", "checker", "balanced_person", "check_date", "balance_day", "status", "date_created", "trash", "date_trash", "data_trashed"],
    ],
    [
        "name_table" => "table_warehouse_check_detail",
        "column" => ["id_owner", "id_warehouse", "id_check", "id_product", "id_supplier", "name", "warehouse", "supplier", "price", "inventory", "reality", "deviation", "price_deviation", "note", "date_created", "trash", "date_trash", "data_trashed"],
    ]
];

// kiểu dữ liệu và các cột trong bảng
$warehouse_func->autoCreateTable($array_table);
