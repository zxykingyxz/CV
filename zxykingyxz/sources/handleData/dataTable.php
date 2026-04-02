<?php
include_once _LIB . "handleTable.php";

$handleTable = new handleTable($config['database']['localhost'], $config['database']['dbname'], $config['database']['username'], $config['database']['password']);

// create table
// subkey, int, bigint, var, text, mediumtext, longtext, boolean

// dữ liệu ngân sách 
$handleTable->setCreateTableSql("table_ngansach", [
    "title|text",
    "notes|text",
    "price|int",
    "loai|int",
    "type|var",
    "date|int",
    "date_created|int",
    "date_update|int"
]);

// dữ liệu công nợ
$handleTable->setCreateTableSql("table_congno", [
    "title|text",
    "items|longtext",
    "notes|text",
    "loai|int",
    "debt_price|int",
    "total_price|int",
    "type|var",
    "date|int",
    "date_created|int",
    "date_update|int"
]);

// dữ liệu báo cáo
$handleTable->setCreateTableSql("table_baocao", [
    "title|text",
    "contents|text",
    "type|var",
    "date_reports|int",
    "date_created|int",
    "date_update|int"
]);

// dữ liệu cấu hình
$handleTable->setCreateTableSql("table_settings", [
    "settings|text",
    "type|var",
    "date_report|int",
    "date_created|int",
    "date_update|int"
]);

$handleTable->setInsertCheckTableSql("table_settings", array("type"), array(
    [
        '{"chitieu_anuong_month":3000000,"chitieu_anuong_day":100000,"chitieu_muasam_month":1000000,"chitieu_sinhhoat_month":1500000,"thunhap_codinh_month":7000000,"tietkiem_month":1500000,"chitieulon":200000}',
        "ngan-sach",
        "",
        time(),
        time()
    ],
));

$handleTable->autoHandleTable();
