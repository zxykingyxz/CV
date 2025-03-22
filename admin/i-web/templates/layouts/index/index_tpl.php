<script src="assets/plugins/highcharts/highcharts.js"></script>
<script src="assets/plugins/highcharts/accessibility.js"></script>
<script src="assets/plugins/highcharts/export-data.js"></script>
<script src="assets/plugins/highcharts/exporting.js"></script>
<script src="assets/plugins/highcharts/data.js"></script>
<script src="assets/plugins/highcharts/series-label.js"></script>

<div class="p-[10px] w-full ">
    <div class="shadow shadow-gray-300 bg-white ">
        <div class="w-full px-[10px] py-3 border-b border-gray-300">
            <div class=" text-xs ">
                <p class="font-semibold text-lg">
                    Chào mừng bạn đến với trang quản trị website !
                </p>
                <p>Nếu bạn cần hỗ trợ trong quá trình sử dụng xin vui lòng liên hệ với i-web theo thông tin sau:</p>
                <p class="font-bold">
                    <a class="text-red-500" href="tel:02862717789" title="02862717789">Điện thoại:
                        <span>028.6271.7789</span>
                    </a>
                    &ensp;
                    <a class="text-blue-500" href="mailto:i-web@i-web.vn" title="i-web@i-web.vn">Email:
                        <span> i-web@i-web.vn</span>
                    </a>
                    &ensp;
                    <a class="text-green-600" target="_blank" href="https://i-web.vn" title="i-web.vn">
                        <span>Website: i-web.vn</span>
                    </a>
                </p>
                <div class="font-bold mt-5">
                    <form method="GET" class="w-full flex flex-wrap items-center gap-2">
                        <input type="hidden" name="com" value="index">
                        <div class="w-[150px]">
                            <?= $sample->getTemplateLayoutsFor([
                                'name_layouts' => 'sumoselect',
                                'class_form' => '',
                                'class' => 'sumoselect_one',
                                'label' => 'Chọn tháng',
                                'placeholder' => 'Chọn tháng',
                                'id' => 'month',
                                'data' => 'month',
                                'data_option' => $array_select_month,
                                'name_col_view' => 'title',
                                'name_col_value' => 'value',
                                'value' => (isset($month)) ? htmlspecialchars_decode($month) : "",
                                'required' => true,
                                'readonly' => false,
                                'function' => '',
                                'form' => false,
                            ]); ?>
                        </div>
                        <div class="w-[150px]">
                            <?= $sample->getTemplateLayoutsFor([
                                'name_layouts' => 'sumoselect',
                                'class_form' => '',
                                'class' => 'sumoselect_one',
                                'label' => 'Chọn Năm',
                                'placeholder' => 'Chọn Năm',
                                'id' => 'year',
                                'data' => 'year',
                                'data_option' => $array_select_year,
                                'name_col_view' => 'title',
                                'name_col_value' => 'value',
                                'value' => (isset($year)) ? htmlspecialchars_decode($year) : "",
                                'required' => true,
                                'readonly' => false,
                                'function' => '',
                                'form' => false,
                            ]); ?>
                        </div>
                        <div class="">
                            <button type="submit" class="w-full h-[30px] bg-blue-500 hover:brightness-90 transition-all duration-300 text-xs font-semibold text-white text-center px-7 rounded-sm flex justify-center items-center gap-3">
                                <span>Xem thống kê</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="p-[10px]">
            <div class="flex " id="view_chart_dashboard">
                <div class=" w-full" id="revenue_statistics_table"></div>
            </div>
        </div>
    </div>
</div>

<script>
    function getStatisticalChartIndex(data_import = {}) {
        const data_default = {
            title: "Thống kê truy cập",
            subtitle: 'Developer by : <a href="http://i-web.vn">i-web.vn .LTD</a>',
            name_id: "revenue_statistics_table",
            data_xAxis: [],
            data_series: []
        };

        // Gộp dữ liệu mặc định và dữ liệu truyền vào
        const info_object = {
            ...data_default,
            ...data_import
        };

        if ($('body #' + info_object.name_id).length > 0) {
            Highcharts.chart(info_object.name_id, {
                credits: {
                    enabled: false
                },
                chart: {
                    type: 'column', // Biểu đồ cột
                    scrollablePlotArea: {
                        minWidth: 700
                    },
                    height: 450
                },
                exporting: {
                    enabled: false
                }, // Tắt menu export
                title: {
                    text: info_object.title,
                    style: {
                        fontSize: 'clamp(16px,3vw,28px)',
                        fontWeight: 'medium',
                        color: '#333333'
                    }
                },
                subtitle: {
                    text: info_object.subtitle
                },
                xAxis: {
                    categories: info_object.data_xAxis,
                    tickWidth: 0,
                    gridLineWidth: 1,
                    showFirstLabel: true
                },
                yAxis: [{
                    title: {
                        text: 'Tổng lượt truy cập',
                        style: {
                            fontSize: '14px'
                        }
                    }
                }],
                tooltip: {
                    crosshairs: true,
                    shared: true,
                    formatter: function() {
                        return `Ngày: <b>${this.key}</b><br>Người truy cập: <b>${this.y} người</b>`;
                    }
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.1,
                        groupPadding: 0.1,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Số người truy cập',
                    data: info_object.data_series,
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
                            return this.y;
                        }
                    },
                    zIndex: 2,
                    tooltip: {
                        pointFormatter: function() {
                            return this.series.name + ': <b>' + this.y + '</b>';
                        }
                    }
                }],
            });
        }
    }
    getStatisticalChartIndex({
        title: 'Thống kê truy cập tháng : <?php echo $month ?> - <?php echo $year ?>',
        data_xAxis: <?= json_encode(array_values($array_x)); ?>,
        data_series: <?= json_encode(array_values($array_series_one)); ?>
    });
</script>