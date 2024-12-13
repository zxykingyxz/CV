<?php
if (($form == 'thong-ke') || empty($form)) {
    // KẾT QUẢ BÁN HÀNG HÔM NAY
    $current_date = strtotime(date('y-m-d'));
    $current_day = date('d', $current_date);
    $current_month = date('m', $current_date);
    $current_year = date('Y', $current_date);
    $current_start_date = strtotime("$current_year-$current_month-$current_day 00:00:00");
    $current_end_date = strtotime("$current_year-$current_month-$current_day 23:59:59");
    $total_order = $db->rawQuery("select id,total_price,status,date_created from #_$name_table_warehouse_bill where " . $warehouse_func->getAccountParam()->sql . " and status in (2,3) and trash<>true", array());
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
    $array_select_chart = [
        [
            "title" => "Theo Ngày",
            "value" => "ngay"
        ],
        [
            "title" => "Theo Tuần",
            "value" => "tuan"
        ],
        [
            "title" => "Theo Tháng",
            "value" => "thang"
        ],
        [
            "title" => "Theo Quý",
            "value" => "quy"
        ],
    ];
    $array_select_year = [];
    for ($y = date('Y'); $y >= 2000; $y--) {
        array_push($array_select_year, [
            "title" => "Năm " . $y,
            "value" => $y
        ]);
    }

    $current_total_order_success = 0;
    $current_total_money_success = 0;

    $current_total_order_cancel = 0;
    $current_total_money_cancel = 0;
    foreach ($total_order as $k_order => $v_order) {
        if ($v_order['date_created'] >= $current_start_date && $v_order['date_created'] <= $current_end_date) {
            switch ($v_order['status']) {
                case 2:
                    $current_total_order_success++;
                    $current_total_money_success += $v_order['total_price'];
                    break;
                case 3:
                    $current_total_order_cancel++;
                    $current_total_money_cancel += $v_order['total_price'];
                    break;
                default:
                    break;
            }
        }
    }
    $sales_results = [
        "sales_order" => [
            "quantity" => $current_total_order_success . " Hóa Đơn",
            "total_money" => $warehouse_func->money($current_total_money_success, 'đ'),
            "title" => "Doanh thu",
            "color" => "bg-blue-600",
            "icons" => '<span class="inline-block m-0 p-0 text-blue-600">$</span>',
        ],
        "cancellation_order" => [
            "quantity" => $current_total_order_cancel . " Phiếu",
            "total_money" => $warehouse_func->money($current_total_money_cancel, 'đ'),
            "title" => "Trả hàng",
            "color" => "bg-orange-600",
            "icons" => '<span class="inline-block m-0 p-0 ">
             <i class="fa fa-reply-all text-orange-500"></i>
             </span>',
        ]
    ];

    // BIỂU ĐÒ

    $array_total_number = 0;
    $array_total_data_chart = [];

    $array_x = [];
    $array_success = [];
    $array_cancel = [];


    switch ($value_c1) {
        case '':
        case 'ngay':
            if (empty($value_c2)) {
                $array_total_number = cal_days_in_month(0, $current_month, $current_year);
                $array_total_number = $array_total_number - ($array_total_number - (int)$current_day);
                $current_start_check = strtotime("$current_year-$current_month-01 00:00:00");
                $current_end_check = strtotime("$current_year-$current_month-$array_total_number 23:59:59");
            } else {
                // $start_date_c2 = "";
                // $end_date_c2 = "";
                // $value_c2 = trim($value_c2);
                // list($start_date_c2, $end_date_c2) = explode("-", $value_c2);

                // $current_start_check = strtotime(str_replace("/", "-", $start_date_c2));
                // $current_end_check = (strtotime(str_replace("/", "-", $end_date_c2))) + (24 * 60 * 60) - 1;
                // $array_total_number = ($current_end_check - $current_start_check) / (24 * 60 * 60) + 1;

                $month_option = "";
                $year_option = "";
                list($month_option, $year_option) = explode("/", $value_c2);

                $array_total_number = cal_days_in_month(0, $month_option, $year_option);
                $current_start_check = strtotime("$year_option-$month_option-01 00:00:00");
                $current_end_check = strtotime("$year_option-$month_option-$array_total_number 23:59:59");
            }

            $array_total_data_chart = $warehouse_func->checkTottalDateChart([
                "total_order" => $total_order,
                "data_check" => 'date_created',
                "start_check" => $current_start_check,
                "end_check" => $current_end_check,
            ]);
            $save_date = $current_start_check;

            for ($i = 1; $i <= $array_total_number; $i++) {

                $day_start_check = $save_date;
                $day_end_check = $save_date + (24 * 60 * 60) - 1;
                $save_date = $day_end_check + 1;

                $array_money = $warehouse_func->checkDetailReturnDashboard([
                    "total_data" => $array_total_data_chart,
                    "data_check" => 'date_created',
                    "status_check" => 'status',
                    "total_money_check" => 'total_price',
                    "start_check" => $day_start_check,
                    "end_check" => $day_end_check,
                ]);

                $array_success[$i] = $array_money['money_success'];
                $array_cancel[$i] = $array_money['money_cancel'];
                $array_x[$i] = date('d', $day_start_check);
            }
            // if (empty($value_c2)) {
            //     $html = ' 
            //             <div class="relative px-2 rounded-md shadow-md border-gray-200 border-[1px]">
            //                 <input type="text" class="min-w-56 text-sm h-[32px]" name="dashboard_chart_date" placeholder="Thống kê từ ngày tới ngày" value="">
            //             </div>
            //             ';
            // }

            if (empty($value_c2)) {
                $html = "";
                $html .= $warehouse_func->getTemplateLayoutsFor([
                    'name_layouts' => 'dropdownLayoutsWarehouse',
                    "first_title" => 'Tháng ' . date('m'),
                    "first_value" => date('m'),
                    "array_data" => $array_select_month,
                    "name_title" => 'title',
                    "name_value" => 'value',
                    "class_form" => 'form_dashboard_week_month_nb',
                    "class_button" => 'btn_dashboard_week_month_nb',
                    "class_data" => 'data_dashboard_week_month_nb',
                    "id_data_check" => 'select_dashboard_week_month',
                    "class_data_input" => 'data_dashboard_input_month',
                    "class_data_output" => 'data_dashboard_output_month',
                ]);
                $html .= $warehouse_func->getTemplateLayoutsFor([
                    'name_layouts' => 'dropdownLayoutsWarehouse',
                    "first_title" => 'Năm ' . date('Y'),
                    "first_value" => date('Y'),
                    "array_data" => $array_select_year,
                    "name_title" => 'title',
                    "name_value" => 'value',
                    "class_form" => 'form_dashboard_year_nb',
                    "class_button" => 'btn_dashboard_year_nb',
                    "class_data" => 'data_dashboard_year_nb',
                    "id_data_check" => 'select_dashboard_year',
                    "class_data_input" => 'data_dashboard_input_year',
                    "class_data_output" => 'data_dashboard_output_year',
                ]);
            };
            break;
        case 'tuan':
            if (empty($value_c2)) {
                $array_total_number = cal_days_in_month(0, $current_month, $current_year);
                $current_start_check = strtotime("$current_year-$current_month-01 00:00:00");
                $current_end_check = strtotime("$current_year-$current_month-$array_total_number 23:59:59");
            } else {
                $month_option = "";
                $year_option = "";
                list($month_option, $year_option) = explode("/", $value_c2);

                $array_total_number = cal_days_in_month(0, $month_option, $year_option);
                $current_start_check = strtotime("$year_option-$month_option-01 00:00:00");
                $current_end_check = strtotime("$year_option-$month_option-$array_total_number 23:59:59");
            }
            $array_total_data_chart = $warehouse_func->checkTottalDateChart([
                "total_order" => $total_order,
                "data_check" => 'date_created',
                "start_check" => $current_start_check,
                "end_check" => $current_end_check,
            ]);

            if ($array_total_number > 28) {
                $current_week_month = 5;
            } else {
                $current_week_month = 4;
            }
            $save_date = $current_start_check;

            for ($i = 1; $i <= $current_week_month; $i++) {

                $day_start_check = $save_date;
                $day_end_check = $save_date + (7 * 24 * 60 * 60) - 1;
                $save_date = $day_end_check + 1;

                $array_money = $warehouse_func->checkDetailReturnDashboard([
                    "total_data" => $array_total_data_chart,
                    "data_check" => 'date_created',
                    "status_check" => 'status',
                    "total_money_check" => 'total_price',
                    "start_check" => $day_start_check,
                    "end_check" => $day_end_check,
                ]);

                $array_success[$i] = $array_money['money_success'];
                $array_cancel[$i] = $array_money['money_cancel'];
                $array_x[$i] = "Tuần " . $i;
            }

            if (empty($value_c2)) {
                $html = "";
                $html .= $warehouse_func->getTemplateLayoutsFor([
                    'name_layouts' => 'dropdownLayoutsWarehouse',
                    "first_title" => 'Tháng ' . date('m'),
                    "first_value" => date('m'),
                    "array_data" => $array_select_month,
                    "name_title" => 'title',
                    "name_value" => 'value',
                    "class_form" => 'form_dashboard_week_month_nb',
                    "class_button" => 'btn_dashboard_week_month_nb',
                    "class_data" => 'data_dashboard_week_month_nb',
                    "id_data_check" => 'select_dashboard_week_month',
                    "class_data_input" => 'data_dashboard_input_month',
                    "class_data_output" => 'data_dashboard_output_month',
                ]);
                $html .= $warehouse_func->getTemplateLayoutsFor([
                    'name_layouts' => 'dropdownLayoutsWarehouse',
                    "first_title" => 'Năm ' . date('Y'),
                    "first_value" => date('Y'),
                    "array_data" => $array_select_year,
                    "name_title" => 'title',
                    "name_value" => 'value',
                    "class_form" => 'form_dashboard_year_nb',
                    "class_button" => 'btn_dashboard_year_nb',
                    "class_data" => 'data_dashboard_year_nb',
                    "id_data_check" => 'select_dashboard_year',
                    "class_data_input" => 'data_dashboard_input_year',
                    "class_data_output" => 'data_dashboard_output_year',
                ]);
            };
            break;
        case 'thang':
            if (!empty($value_c2)) {
                $current_year = $value_c2;
            }
            $array_total_number = 12;
            $current_start_check = strtotime("$current_year-01-01 00:00:00");
            $current_end_check = strtotime("$current_year-$array_total_number-31 23:59:59");

            $array_total_data_chart = $warehouse_func->checkTottalDateChart([
                "total_order" => $total_order,
                "data_check" => 'date_created',
                "start_check" => $current_start_check,
                "end_check" => $current_end_check,
            ]);

            for ($i = 1; $i <= $array_total_number; $i++) {
                $number_day_in_month = cal_days_in_month(0, sprintf("%02d", $i), $current_year);
                $day_start_check = strtotime("$current_year-" . sprintf("%02d", $i) . "-01 00:00:00");
                $day_end_check = strtotime("$current_year-" . sprintf("%02d", $i) . "-$number_day_in_month 23:59:59");

                $array_money = $warehouse_func->checkDetailReturnDashboard([
                    "total_data" => $array_total_data_chart,
                    "data_check" => 'date_created',
                    "status_check" => 'status',
                    "total_money_check" => 'total_price',
                    "start_check" => $day_start_check,
                    "end_check" => $day_end_check,
                ]);

                $array_success[$i] = $array_money['money_success'];
                $array_cancel[$i] = $array_money['money_cancel'];
                $array_x[$i] = "Tháng " . sprintf("%02d", $i);
                $save_date = $day_end_check;
            }
            if (empty($value_c2)) {
                $html = "";
                $html .= $warehouse_func->getTemplateLayoutsFor([
                    'name_layouts' => 'dropdownLayoutsWarehouse',
                    "first_title" => 'Năm ' . date('Y'),
                    "first_value" => date('Y'),
                    "array_data" => $array_select_year,
                    "name_title" => 'title',
                    "name_value" => 'value',
                    "class_form" => 'form_dashboard_year_nb',
                    "class_button" => 'btn_dashboard_year_nb',
                    "class_data" => 'data_dashboard_year_nb',
                    "id_data_check" => 'select_dashboard_year',
                    "class_data_input" => 'data_dashboard_input_year',
                    "class_data_output" => 'data_dashboard_output_year',
                ]);
            };
            break;
        case 'quy':
            if (!empty($value_c2)) {
                $current_year = $value_c2;
            }
            $array_total_number = 12;
            $current_start_check = strtotime("$current_year-01-01 00:00:00");
            $current_end_check = strtotime("$current_year-$array_total_number-31 23:59:59");

            $array_total_data_chart = $warehouse_func->checkTottalDateChart([
                "total_order" => $total_order,
                "data_check" => 'date_created',
                "start_check" => $current_start_check,
                "end_check" => $current_end_check,
            ]);
            $save_quarters = 1;
            for ($i = 1; $i <= 4; $i++) {
                $day_start_check = strtotime("$current_year-" . sprintf("%02d", $save_quarters) . "-01 00:00:00");
                $save_quarters += 2;
                $number_day_in_month = cal_days_in_month(0, sprintf("%02d", ($save_quarters)), $current_year);
                $day_end_check = strtotime("$current_year-" . sprintf("%02d", $save_quarters) . "-$number_day_in_month 23:59:59");

                $array_money = $warehouse_func->checkDetailReturnDashboard([
                    "total_data" => $array_total_data_chart,
                    "data_check" => 'date_created',
                    "status_check" => 'status',
                    "total_money_check" => 'total_price',
                    "start_check" => $day_start_check,
                    "end_check" => $day_end_check,
                ]);

                $array_success[$i] = $array_money['money_success'];
                $array_cancel[$i] = $array_money['money_cancel'];
                $array_x[$i] = "Quý " . $i;
                $save_quarters += 1;
            }
            if (empty($value_c2)) {
                $html = "";
                $html .= $warehouse_func->getTemplateLayoutsFor([
                    'name_layouts' => 'dropdownLayoutsWarehouse',
                    "first_title" => 'Năm ' . date('Y'),
                    "first_value" => date('Y'),
                    "array_data" => $array_select_year,
                    "name_title" => 'title',
                    "name_value" => 'value',
                    "class_form" => 'form_dashboard_year_nb',
                    "class_button" => 'btn_dashboard_year_nb',
                    "class_data" => 'data_dashboard_year_nb',
                    "id_data_check" => 'select_dashboard_year',
                    "class_data_input" => 'data_dashboard_input_year',
                    "class_data_output" => 'data_dashboard_output_year',
                ]);
            };
            break;
        default:
            break;
    }
    $data_ajax = [
        'array_success' => array_values($array_success),
        'array_cancel' => array_values($array_cancel),
        'array_x' => array_values($array_x),
    ];
    $html_ajax = [
        'html_chart' => $html,
    ];
}
if (($form == 'top10') || empty($form)) {
    $array_select_top10 = [
        [
            "title" => "Theo Số Lượng",
            "value" => "soluong"
        ],
        [
            "title" => "Theo Doanh Thu",
            "value" => "doanhthu"
        ],
    ];
    $array_data_head_table_top10 = [
        "column1" => [
            "title" => "Hạng",
            "class" => "",
        ],
        "column2" => [
            "title" => "Tên Sản Phẩm",
            "class" => " w-full ",
        ],
        "column3" => [
            "title" => ((empty($value_c1) || $value_c1 == "soluong")) ? "Số Lượng" : "Doanh Thu",
            "class" => "",
        ],
    ];
}
