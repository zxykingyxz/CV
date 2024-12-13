<script src="./assets/plugins/highcharts/highcharts.js"></script>
<script src="./assets/plugins/highcharts/accessibility.js"></script>
<script src="./assets/plugins/highcharts/export-data.js"></script>
<script src="./assets/plugins/highcharts/exporting.js"></script>
<script src="./assets/plugins/highcharts/data.js"></script>
<script src="./assets/plugins/highcharts/series-label.js"></script>
<section class="section-dashboard py-4 ">
    <div class="grid_x wide ">
        <div class="flex flex-wrap gap-4">
            <div class="bg-white w-[100%] rounded-lg shadow-lg shadow-gray-300 border border-gray-200 p-3 sm:p-4">
                <div class="text-sm font-semibold mb-6">
                    <span>
                        KẾT QUẢ BÁN HÀNG HÔM NAY
                    </span>
                </div>
                <div class="flex flex-wrap justify-center items-center gap-2">
                    <?php foreach ($sales_results as $k_results => $v_results) { ?>
                        <div class="inline-flex flex-1 gap-3 <?= $v_results['color'] ?> rounded-md justify-items-centers items-center px-2 sm:px-4 py-3 min-w-[300px]">
                            <div class="h-8 w-8 bg-white rounded-[50%] text-base text-center flex justify-center items-center">
                                <?= $v_results['icons'] ?>
                            </div>
                            <div class="flex flex-col gap-[1px]">
                                <div class="text-xs text-white font-normal ">
                                    <span>
                                        <?= $v_results['quantity'] ?>
                                    </span>
                                </div>
                                <div class="text-2xl text-white font-normal ">
                                    <span>
                                        <?= $v_results['total_money'] ?>
                                    </span>
                                </div>
                                <div class="text-xs text-white font-normal ">
                                    <span>
                                        <?= $v_results['title'] ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="bg-white w-[100%] rounded-lg shadow-lg shadow-gray-300 border border-gray-200 p-3 sm:p-4">
                <div class="text-sm font-semibold mb-3 sm:mb-6">
                    <span>
                        BẢNG THỐNG KÊ DOANH THU
                    </span>
                </div>
                <div class="flex flex-wrap items-center gap-1 form_btn_chart_dashboard">
                    <?= $warehouse_func->getTemplateLayoutsFor([
                        'name_layouts' => 'dropdownLayoutsWarehouse',
                        "first_title" => 'Theo Ngày',
                        "first_value" => 'ngay',
                        "array_data" => $array_select_chart,
                        "name_title" => 'title',
                        "name_value" => 'value',
                        "class_form" => 'form_all_chart',
                        "class_button" => 'btn_all_chart',
                        "class_data" => 'data_all_chart',
                        "id_data_check" => 'select_chart_dashboard',
                        "class_data_input" => 'data_input_all_chart',
                        "class_data_output" => 'data_output_all_chart',
                    ]);
                    ?>
                    <div class="form_chart_dashboard_c2 flex flex-wrap items-center gap-1">
                        <?= $html ?>
                    </div>
                </div>
                <?php if (!empty($total_order)) { ?>
                    <div class="mt-6 flex justify-center items-center overflow-x-auto scroll-x" id="view_chart_dashboard">
                        <div class=" h-[500px] min-w-[1000px] w-full" id="revenue_statistics_table"></div>
                    </div>
                <?php } else {
                    echo $warehouse_func->getTemplateLayoutsFor([
                        'name_layouts' => 'templateNodata',
                    ]);
                } ?>
            </div>
            <?php /*
            <div class="bg-white w-[100%] rounded-lg shadow-lg p-3 sm:p-4 scrollbar-fix5">
                <div class="text-sm font-semibold mb-3 sm:mb-6">
                    <span>
                        TOP 10 SẢN PHẨM BÁN CHẠY NHẤT TRONG THÁNG <?= date('m') ?>
                    </span>
                </div>
                <div class="flex flex-wrap items-center gap-1 form_btn_chart_dashboard">
                    <?= $warehouse_func->getTemplateLayoutsFor([
                        'name_layouts' => 'dropdownLayoutsWarehouse',
                        "first_title" => $array_select_top10[0]['title'],
                        "first_value" => $array_select_top10[0]['value'],
                        "array_data" => $array_select_top10,
                        "name_title" => 'title',
                        "name_value" => 'value',
                        "class_form" => 'form_dashboard_top10',
                        "class_button" => 'btn_dashboard_top10',
                        "class_data" => 'data_dashboard_top10',
                        "id_data_check" => 'select_top10_dashboard',
                        "class_data_input" => 'data_input_dashboard_top10',
                        "class_data_output" => 'data_output_dashboard_top10',
                    ]);
                    ?>
                </div>
                <?php if (empty($total_product_top10)) { ?>
                    <div class=" mt-6 overflow-x-auto overflow-y-hidden scroll-x rounded-md border border-gray-300 shadow-md">

                    </div>
                <?php } else {
                    echo $warehouse_func->getTemplateLayoutsFor([
                        'name_layouts' => 'templateNodata',
                    ]);
                } ?>
            </div>
            */ ?>
        </div>
    </div>
</section>

<script>
    if ($('body #revenue_statistics_table').length > 0) {
        Highcharts.chart('revenue_statistics_table', {
            credits: {
                enabled: false,
            },
            chart: {
                type: 'column',
                scrollablePlotArea: {
                    minWidth: 700
                }
            },
            title: {
                text: 'Biểu Đồ Doanh Thu',
                align: 'left'
            },
            xAxis: {
                categories: <?php echo json_encode(array_values($array_x)); ?>,
                tickWidth: 0,
                gridLineWidth: 1,
                showFirstLabel: true
            },

            yAxis: [{
                title: {
                    text: 'Doanh thu (VNĐ)'
                },
                labels: {
                    align: 'right',
                    x: -3,
                    y: 3,
                    formatter: function() {
                        return Highcharts.numberFormat(this.value / 1000000, 0, ',', '.') + 'M'; // Chia giá trị cho 1 triệu và thêm 'M'
                    }
                },
                showFirstLabel: false
            }],
            tooltip: {
                crosshairs: true,
                shared: true,
                formatter: function() {
                    return 'Ngày: <b>' + this.key + '</b><br>' +
                        'Giá trị: <b>' + Highcharts.numberFormat(this.y / 1000000, 1, ',', '.') + 'M</b>';
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.1, // Điều chỉnh khoảng cách giữa các cột
                    groupPadding: 0.1, // Điều chỉnh khoảng cách giữa các nhóm cột
                    borderWidth: 0, // Không có viền cho cột
                }
            },
            series: [{
                    name: 'Đơn Hoàn Thành',
                    data: <?php echo json_encode(array_values($array_success)); ?>,
                    marker: {
                        enabled: false,
                    },
                    showInLegend: true,
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        style: {
                            fontWeight: 'bold',
                            textOutline: 'none'
                        },
                        formatter: function() {
                            return Highcharts.numberFormat(this.y / 1000000, 1, ',', '.') + 'M';
                        }
                    },
                    zIndex: 2,
                    tooltip: {
                        pointFormatter: function() {
                            return this.series.name + ': <b>' + Highcharts.numberFormat(this.y / 1000000, 1, ',', '.') + 'M</b>';
                        }
                    }
                },
                <?php /*
                {
                    name: 'Trả Hàng',
                    data: <?php echo json_encode(array_values($array_cancel)); ?>,
                    marker: {
                        enabled: false,
                    },
                    showInLegend: true,
                    color: 'red',
                }
                    */ ?>
            ]
        });
    };
</script>