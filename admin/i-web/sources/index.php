<?php
$month_dashboard = (isset($array_param_value['month'])) ? htmlspecialchars($array_param_value['month']) : date("m", time());
$year_dashboard = (isset($array_param_value['year'])) ? htmlspecialchars($array_param_value['year']) : date("Y", time());
$view_dashboard = (isset($array_param_value['view'])) ? htmlspecialchars($array_param_value['view']) : "ngay";

if (!empty($month_dashboard) && !empty($year_dashboard)) {
    $time = $year_dashboard . '-' . $month_dashboard . '-1';
    $date = strtotime($time);
} else {
    $date = strtotime(date('y-m-d'));
}
$day = date('d', $date);
$month = date('m', $date);
$year = date('Y', $date);


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
