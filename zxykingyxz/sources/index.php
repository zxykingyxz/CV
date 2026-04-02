<?php

$layouts = "index";

$where = "";

// Kiểm tra ngày tháng
$start_hour = ' 00:00:00';
$end_hour = ' 23:59:59';

$year = (!empty($array_param_value['year'])) ? htmlspecialchars($array_param_value['year']) : date('Y', time());

$month = (!empty($array_param_value['month'])) ? htmlspecialchars($array_param_value['month']) : date('m', time());

$daysInMonth = cal_days_in_month(0, $month, $year);

$time_start_day = strtotime(date('Y-m-d', time()) . $start_hour);
$time_end_day  = strtotime(date('Y-m-d', time()) . $end_hour);
$time_start_month = strtotime($year . '-' . $month . '-1' . $start_hour);
$time_end_month = strtotime($year . '-' . $month . '-' . $daysInMonth . $end_hour);

$data_total_chitieu_anuong_day = $db->rawQueryOne("select SUM(price) as price from table_ngansach where 1 and loai=1 and type='chi-tieu' and (date>=$time_start_day and date<=$time_end_day)");

$data_total_chitieu_day = $db->rawQueryOne("select SUM(price) as price from table_ngansach where 1 and type='chi-tieu' and (date>=$time_start_day and date<=$time_end_day)");

$data_total_chitieu_anuong_month = $db->rawQueryOne("select SUM(price) as price from table_ngansach where 1 and type='chi-tieu' and loai=1 and (date>=$time_start_month and date<=$time_end_month)");

$data_total_chitieu_muasam_month = $db->rawQueryOne("select SUM(price) as price from table_ngansach where 1 and type='chi-tieu' and loai=2 and (date>=$time_start_month and date<=$time_end_month)");

$data_total_chitieu_sinhhoat_month = $db->rawQueryOne("select SUM(price) as price from table_ngansach where 1 and type='chi-tieu' and loai=3 and (date>=$time_start_month and date<=$time_end_month)");

$data_total_chitieu_month = $db->rawQueryOne("select SUM(price) as price from table_ngansach where 1 and type='chi-tieu' and (date>=$time_start_month and date<=$time_end_month)");

$data_total_chitieu_all = $db->rawQueryOne("select SUM(price) as price from table_ngansach where 1 and type='chi-tieu' ", array());

$data_total_thunhap_month = $db->rawQueryOne("select SUM(price) as price from table_ngansach where 1 and type='thu-nhap' and (date>=$time_start_month and date<=$time_end_month)");

$data_total_thunhap_all = $db->rawQueryOne("select SUM(price) as price from table_ngansach where 1 and type='thu-nhap' ", array());

$data_chart = $func->getDataDashboard();
