<?php
include_once _LIB . "handleTable.php";

$handleTable = new handleTable($config['database']['localhost'], $config['database']['dbname'], $config['database']['username'], $config['database']['password']);

// create table
// subkey, int, bigint, var, text, mediumtext, longtext, boolean

$handleTable->setCreateTableSql("table_ngansach", ["title|text", "notes|text", "price|int", "loai|int", "type|var", "date|int", "date_created|int", "date_update|int"]);

$handleTable->setCreateTableSql("table_ngayle", ["title|text", "day|var", "month|var", "type|var"]);

$handleTable->setCreateTableSql("table_baocao", ["title|text", "contents|text", "type|var", "date_reports|int", "date_created|int", "date_update|int"]);

$handleTable->setCreateTableSql("table_settings", ["settings|text", "type|var", "date_report|int", "date_created|int", "date_update|int"]);

// insert table
$handleTable->setInsertTableSql("table_ngayle", array(
    ["Tết Dương lịch", "01", "01", "duong-lich"],
    ["Ngày Thầy thuốc Việt Nam", "27", "02", "duong-lich"],
    ["Ngày Quốc tế Phụ nữ", "08", "03", "duong-lich"],
    ["Ngày Giải phóng miền Nam", "30", "04", "duong-lich"],
    ["Ngày Quốc tế Lao động", "01", "05", "duong-lich"],
    ["Chiến thắng Điện Biên Phủ", "07", "05", "duong-lich"],
    ["Ngày của Mẹ", "08", "05", "duong-lich"],
    ["Ngày sinh Chủ tịch Hồ Chí Minh", "19", "05", "duong-lich"],
    ["Ngày Quốc tế Thiếu nhi", "01", "06", "duong-lich"],
    ["Ngày Báo chí Cách mạng Việt Nam", "21", "06", "duong-lich"],
    ["Ngày Thương binh Liệt sĩ", "27", "07", "duong-lich"],
    ["Cách mạng tháng Tám thành công", "19", "08", "duong-lich"],
    ["Ngày Quốc khánh Việt Nam", "02", "09", "duong-lich"],
    ["Ngày Nhà giáo Việt Nam", "20", "11", "duong-lich"],
    ["Ngày thành lập Quân đội Nhân dân Việt Nam", "22", "12", "duong-lich"],
    ["Ngày Giáng sinh", "25", "12", "duong-lich"],
    ["Giỗ Tổ Hùng Vương", "10", "03", "am-lich"],
    ["Tết Nguyên Đán", "01", "01", "am-lich"],
    ["Tết Trung Thu", "15", "08", "am-lich"]
));

$handleTable->setInsertCheckTableSql("table_settings", array("type"), array(
    ['{"chitieu_anuong_month":3000000,"chitieu_anuong_day":100000,"chitieu_muasam_month":1000000,"chitieu_sinhhoat_month":1500000,"thunhap_codinh_month":7000000,"tietkiem_month":1500000,"chitieulon":200000}', "ngan-sach", "", 1741517113, 1741783561],
));

$handleTable->autoHandleTable();
