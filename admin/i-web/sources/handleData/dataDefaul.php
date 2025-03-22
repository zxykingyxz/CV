<?php
/* Set the default timezone */
date_default_timezone_set("Asia/Ho_Chi_Minh");

$_LANG = $_SESSION['lang_admin'] = (!isset($_SESSION['lang_admin']) || $_SESSION['lang_admin'] == '') ? 'vi' : $_SESSION['lang_admin'];

require_once _LIBADMIN . 'autoload.php';

new autoload();
$db = new PDODb($config['database']);
$func = new functions($db);
$sample = new ReWorkedTemplate();

$jv0 = 'javascript:void(0)';
$class_title_table_default = 'bg-slate-200 text-slate-900 dark:text-zink-50';
$padding_th_table_default = 'px-3 py-3 text-sm';
$padding_td_table_default = 'px-3 py-2 text-sm';
$class_padding_form_data = 'px-[12px] py-[8px]';
$class_button_form_info_data = 'inline-block px-4 py-[6px] text-xs font-semibold transition-all duration-300 ease-linear rounded-t-md text-slate-500 border border-t-2 border-transparent group-[.active]:text-blue-500 group-[.active]:border-slate-300 group-[.active]:border-t-blue-500 group-[.active]:border-b-white hover:text-blue-500';
$class_form_view_left = 'w-full md:w-[calc(100%-250px)] lg:w-[calc(100%-400px)] ';
$class_form_view_right = 'w-full md:w-[235px] lg:w-[385px] ';
$class_grid_column_form_view = "grid grid-cols-1 gap-4";
// data value
$row_setting = $db->rawQueryOne("select * from #_setting limit 0,1");
$logo = $db->rawQueryOne("select photo from #_bannerqc where hienthi=1 and type=? limit 0,1", array('logo'));

$array_select_month = [
    [
        "title" => "Tháng 1",
        "value" => "01"
    ],
    [
        "title" => "Tháng 2",
        "value" => "02"
    ],
    [
        "title" => "Tháng 3",
        "value" => "03"
    ],
    [
        "title" => "Tháng 4",
        "value" => "04"
    ],
    [
        "title" => "Tháng 5",
        "value" => "05"
    ],
    [
        "title" => "Tháng 6",
        "value" => "06"
    ],
    [
        "title" => "Tháng 7",
        "value" => "07"
    ],
    [
        "title" => "Tháng 8",
        "value" => "08"
    ],
    [
        "title" => "Tháng 9",
        "value" => "09"
    ],
    [
        "title" => "Tháng 10",
        "value" => "10"
    ],
    [
        "title" => "Tháng 11",
        "value" => "11"
    ],
    [
        "title" => "Tháng 12",
        "value" => "12"
    ],
];

$array_select_year = [];

for ($y = date('Y'); $y >= 2000; $y--) {
    array_push($array_select_year, [
        "title" => "Năm " . $y,
        "value" => $y
    ]);
}
