<?php
$start_hour_reports = ' 00:00:00';
$end_hour_reports = ' 23:59:59';

if (!empty($data_settings_ngansach['date_report']) && isset($data_settings_ngansach['date_report'])) {
    $date_starts_reports = $data_settings_ngansach['date_report'];
} else {
    $data_date_starts = $db->rawQueryOne("select date from table_ngansach order by id asc");
    $date_starts_reports = $data_date_starts['date'];
}

$data_month_starts = date("m", $date_starts_reports);
$data_year_starts = date("Y", $date_starts_reports);

$daysInMonthCheck = cal_days_in_month(0, $data_month_starts, $data_year_starts);

$date_check_reports = strtotime(str_replace('/', '-',  $daysInMonthCheck . "/" . $data_month_starts  . "/" . $data_year_starts . $end_hour_reports));

if ($date_check_reports <= time()) {

    $month_reports_starts = (float)(date("m", $date_check_reports));
    $year_reports_starts = date("Y", $date_check_reports);
    $check_year_current = 0;

    for ($year_reports = (int)$year_reports_starts; $year_reports <= (int)date("Y", time()); $year_reports++) {

        if ($year_reports == (int)date("Y", time())) {
            $month_reports_end = (int)date("m", time()) - 1;
        } else {
            $month_reports_end = 12;
        }
        if ($check_year_current != 0) {
            $month_reports_starts = 1;
        }

        for ($month_reports = (int)$month_reports_starts; $month_reports <= (int)$month_reports_end; $month_reports++) {

            $send_reports_ngansach = [];
            $data_contents_reports_ngansach = [];

            $daysInMonthReports = cal_days_in_month(0, $month_reports, $year_reports);

            $time_start_reports_ngansach = strtotime($year_reports . '-' . $month_reports . '-1' . $start_hour_reports);
            $time_end_reports_ngansach = strtotime($year_reports . '-' . $month_reports . '-' . $daysInMonthReports . $end_hour_reports);

            $sql_date_reports_ngansach = " (date>=$time_start_reports_ngansach and date<=$time_end_reports_ngansach) ";

            $data_contents_reports_ngansach['chitieulon'] = $db->rawQuery("select * from table_ngansach where type='chi-tieu' and $sql_date_reports_ngansach and price>? order by id asc", array($settings_ngansach['chitieulon']));

            $data_contents_reports_ngansach['thunhap'] = $db->rawQuery("select * from table_ngansach where type='thu-nhap' and $sql_date_reports_ngansach and price>? order by id asc", array($settings_ngansach['chitieulon']));

            $data_contents_reports_ngansach['chitieuanuongthang'] = ($db->rawQueryOne("select SUM(price) as price from table_ngansach where 1 and type='chi-tieu' and loai=1 and $sql_date_reports_ngansach"))['price'];

            $data_contents_reports_ngansach['chitieumuasamthang'] = ($db->rawQueryOne("select SUM(price) as price from table_ngansach where 1 and type='chi-tieu' and loai=2 and $sql_date_reports_ngansach"))['price'];

            $data_contents_reports_ngansach['chitieusinhhoatthang'] = ($db->rawQueryOne("select SUM(price) as price from table_ngansach where 1 and type='chi-tieu' and loai=3 and $sql_date_reports_ngansach"))['price'];

            $data_contents_reports_ngansach['chitieugiadinhthang'] = ($db->rawQueryOne("select SUM(price) as price from table_ngansach where 1 and type='chi-tieu' and loai=4 and $sql_date_reports_ngansach"))['price'];

            $data_contents_reports_ngansach['chitieutaichinhthang'] = ($db->rawQueryOne("select SUM(price) as price from table_ngansach where 1 and type='chi-tieu' and loai=5 and $sql_date_reports_ngansach"))['price'];

            $data_contents_reports_ngansach['chitieukinhdoanhthang'] = ($db->rawQueryOne("select SUM(price) as price from table_ngansach where 1 and type='chi-tieu' and loai=6 and $sql_date_reports_ngansach"))['price'];

            $data_contents_reports_ngansach['chitieusuckhoethang'] = ($db->rawQueryOne("select SUM(price) as price from table_ngansach where 1 and type='chi-tieu' and loai=7 and $sql_date_reports_ngansach"))['price'];

            $data_contents_reports_ngansach['chitieubaoduongthang'] = ($db->rawQueryOne("select SUM(price) as price from table_ngansach where 1 and type='chi-tieu' and loai=8 and $sql_date_reports_ngansach"))['price'];

            $data_contents_reports_ngansach['chitieukhacthang'] = ($db->rawQueryOne("select SUM(price) as price from table_ngansach where 1 and type='chi-tieu' and loai=99 and $sql_date_reports_ngansach"))['price'];

            $data_contents_reports_ngansach['chitieuthang'] = ($db->rawQueryOne("select SUM(price) as price from table_ngansach where 1 and type='chi-tieu' and $sql_date_reports_ngansach"))['price'];

            $data_contents_reports_ngansach['thunhapchinhthang'] = ($db->rawQueryOne("select SUM(price) as price from table_ngansach where 1 and type='thu-nhap' and loai=1 and $sql_date_reports_ngansach"))['price'];

            $data_contents_reports_ngansach['thunhapphuthang'] = ($db->rawQueryOne("select SUM(price) as price from table_ngansach where 1 and type='thu-nhap' and loai=2 and $sql_date_reports_ngansach"))['price'];

            $data_contents_reports_ngansach['thunhapdaututhang'] = ($db->rawQueryOne("select SUM(price) as price from table_ngansach where 1 and type='thu-nhap' and loai=3 and $sql_date_reports_ngansach"))['price'];

            $data_contents_reports_ngansach['thunhapthudongthang'] = ($db->rawQueryOne("select SUM(price) as price from table_ngansach where 1 and type='thu-nhap' and loai=4 and $sql_date_reports_ngansach"))['price'];

            $data_contents_reports_ngansach['thunhapkhacthang'] = ($db->rawQueryOne("select SUM(price) as price from table_ngansach where 1 and type='thu-nhap' and loai=99 and $sql_date_reports_ngansach"))['price'];

            $data_contents_reports_ngansach['thunhapthang'] = ($db->rawQueryOne("select SUM(price) as price from table_ngansach where 1 and type='thu-nhap' and $sql_date_reports_ngansach"))['price'];

            $data_contents_reports_ngansach['chitieuanuongngaydinhmuc'] = $settings_ngansach['chitieu_anuong_day'];

            $data_contents_reports_ngansach['chitieuanuongthangdinhmuc'] = $settings_ngansach['chitieu_anuong_month'];

            $data_contents_reports_ngansach['chitieumuasamthangdinhmuc'] = $settings_ngansach['chitieu_muasam_month'];

            $data_contents_reports_ngansach['chitieusinhhoatthangdinhmuc'] = $settings_ngansach['chitieu_sinhhoat_month'];

            $data_contents_reports_ngansach['thunhapdinhmuc'] = $settings_ngansach['thunhap_codinh_month'];

            $data_contents_reports_ngansach['tietkiemthangdinhmuc'] = $settings_ngansach['tietkiem_month'];

            $send_reports_ngansach["title"] = "Báo cáo chi tiết ngân sách tháng " . $month_reports . "/" . $year_reports;

            $send_reports_ngansach["type"] = "ngan-sach";

            $send_reports_ngansach["contents"] = json_encode($data_contents_reports_ngansach);

            $send_reports_ngansach["date_reports"] = $time_end_reports_ngansach;

            $send_reports_ngansach["date_created"] = time();

            $db->insert("baocao", $send_reports_ngansach);

            $db->rawQueryOne("update #_settings SET date_report=? WHERE type=?", array(((int)$time_end_reports_ngansach + 1), "ngan-sach"));
        }
        $check_year_current++;
    }
}
