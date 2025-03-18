<?php
$month_dashboard = (isset($_GET['month'])) ? htmlspecialchars($_GET['month']) : date("m", time());
$year_dashboard = (isset($_GET['year'])) ? htmlspecialchars($_GET['year']) : date("Y", time());
$view_dashboard = (isset($_GET['view'])) ? htmlspecialchars($_GET['view']) : "ngay";

if (!empty($month_dashboard) && !empty($year_dashboard)) {
    $time = $year_dashboard . '-' . $month_dashboard . '-1';
    $date = strtotime($time);
} else {
    $date = strtotime(date('y-m-d'));
}
$day = date('d', $date);
$month = date('m', $date);
$year = date('Y', $date);

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

switch ($view_dashboard) {
    case 'ngay':
        $start_date = strtotime("$year-$month-01 00:00:00");
        $end_date = strtotime("$year-$month-$day 23:59:59");
        $array_total_number = cal_days_in_month(0, $month, $year);


        $save_date = $start_date;

        for ($i = 1; $i <= $array_total_number; $i++) {
            $day_start_check = $save_date;
            $day_end_check = $save_date + (24 * 60 * 60) - 1;
            $save_date = $day_end_check + 1;

            $array_total_data_chart = $db->rawQueryOne("select COUNT(*) AS total FROM #_counters WHERE tm>='$day_start_check' and tm<'$day_end_check' ");

            $array_series_one[$i] =  $array_total_data_chart['total'];
            $array_x[$i] = date('d', $day_start_check);
        }
        break;
    default:

        break;
}
