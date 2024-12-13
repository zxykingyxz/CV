<?php
    /* Set the default timezone */
    date_default_timezone_set("Asia/Ho_Chi_Minh");

    /* Set the date */
    if((isset($_GET['month']) && $_GET['month'] != '') && (isset($_GET['year']) && $_GET['year'] != ''))
    {
        $time = $_GET['year'].'-'.$_GET['month'].'-1';
        $date = strtotime($time);
    }
    else
    {
        $date = strtotime(date('y-m-d')); 
    }
    $day = date('d', $date);
    $month = date('m', $date);
    $year = date('Y', $date);
    $firstDay = mktime(0,0,0,$month, 1, $year);
    $title = strftime('%B', $firstDay);
    $dayOfWeek = date('D', $firstDay);
    $daysInMonth = cal_days_in_month(0, $month, $year);
    /* Get the name of the week days */
    $timestamp = strtotime('next Sunday');
    $weekDays = array();
    for ($i = 0; $i < 7; $i++) {
        $weekDays[] = strftime('%a', $timestamp);
        $timestamp = strtotime('+1 day', $timestamp);
    }
    $blank = date('w', strtotime("{$year}-{$month}-01"));

?>
<script src="js/chart/js/chartli.js"></script>
<script type="text/javascript">
var CheckDelete = (confirm) => {
    var s = confirm('<?=_bancomuonxoa?>');
    if (s) {
        window.location.href = confirm;
    }
}
$(function() {
    $('button[data-view-id]').click(function() {
        var month = $('#month').val();
        var year = $('#year').val();
        window.location.href = 'index.html?month=' + month + '&year=' + year;
    });
});
</script>
<form name="supplier" id="validate" class="form" action="index.html" method="get" enctype="multipart/form-data">
    <div class="oneOne mtop10">
        <div class="widget bg-white mtop0">
            <div class="title">
                <h6 stle="color:red">Chào mừng bạn đến với trang quản trị website !</h6>
                <p>Nếu bạn cần hỗ trợ trong quá trình sử dụng xin vui lòng liên hệ với i-web theo thông tin sau:</p>
                <p>
                    <a style="color:red;font-weight:bold" href="tel:02862717789" title="02862717789">Điện thoại:
                        028.6271.7789</a>
                    <a style="color:#0280cc;font-weight:bold" href="mailto:i-web@i-web.vn" title="i-web@i-web.vn">Email:
                        i-web@i-web.vn</a>
                    <a style="color:#1c9213;font-weight:bold" target="_blank" href="https://i-web.vn"
                        title="i-web.vn">Website: i-web.vn</a>
                </p>
            </div>

            <div class="formRow">
                <label>Thống kê truy cập</label>
                <div class="formRight">
                    <div class="card-body">
                        <div class="col-4 w-m-50">
                            <div class="form-group">
                                <select class="form-control select2" name="month" id="month">
                                    <option value="">Chọn tháng</option>
                                    <?php for($i=1; $i<=12 ;$i++) { ?>
                                    <?php
                                if(isset($_GET['year'])) $selected = ($i==$_GET['month']) ? 'selected':'';
                                else $selected = ($i==date('m')) ? 'selected':'';
                                ?>
                                    <option value="<?=$i?>" <?=$selected?>>Tháng <?=$i?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-4 w-m-50">
                            <div class="form-group">
                                <select class="form-control select2" name="year" id="year">
                                    <option value="">Chọn năm</option>
                                    <?php for($i=2000;$i<=date('Y')+20;$i++) { ?>
                                    <?php
                                if(isset($_GET['year'])) $selected = ($i==$_GET['year']) ? 'selected':'';
                                else $selected = ($i==date('Y')) ? 'selected':'';
                                ?>
                                    <option value="<?=$i?>" <?=$selected?>>Năm <?=$i?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-4 w-m-100">
                            <div class="form-group"><button type="button" data-view-id class="btn-chart btn-success">Xem
                                    thống
                                    Kê truy cập</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="js/chart/js/chartli.js"></script>
            <script type="text/javascript">
            $(function() {
                $('#chart_visitor').highcharts({
                    chart: {
                        type: 'line'
                    },
                    title: {
                        text: 'Thống kê truy cập tháng : <?php echo $month ?> - <?php echo $year ?> '
                    },
                    subtitle: {
                        text: 'Devetloper by : <a href="http://i-web.vn">i-web.vn .LTD</a>'
                    },
                    xAxis: {
                        categories: [
                            <?php for($i = 1; $i <= $daysInMonth; $i++):?> '<?=$i?>',
                            <?php endfor; ?>
                        ]
                    },
                    yAxis: {
                        title: {
                            text: 'Tổng lượt truy cập'
                        }
                    },
                    plotOptions: {
                        line: {
                            dataLabels: {
                                enabled: true
                            },
                            enableMouseTracking: false
                        }
                    },
                    series: [{
                        name: 'Số người truy cập',
                        data: [
                            <?php for($i = 1; $i <= $daysInMonth; $i++):
                     $k = $i+1;
                    $begin = strtotime($year.'-'.$month.'-'.$i);
                    $end = strtotime($year.'-'.$month.'-'.$k);

                    $query             =    "SELECT COUNT(*) AS todayrecord FROM #_counters WHERE tm>='$begin' and tm<'$end' "; 
                    $todayrc  = $db->rawQueryOne($query); 
                    $today_visitors     =    $todayrc['todayrecord'];
                ?>
                            <?=$today_visitors?>,
                            <?php endfor; ?>

                        ]
                    }]
                });
                // $("#datepicker").datepicker({
                //     dateFormat: 'yy-mm-dd'
                // });
            });
            </script>
            <?php /*
            <!-- Resources -->
            <script src="plugin/chart/core.js"></script>
            <script src="plugin/chart/charts.js"></script>
            <script src="plugin/chart/animated.js"></script>
            <!-- Chart code -->
            <script>
            am4core.ready(function() {
                // Themes begin
                am4core.useTheme(am4themes_animated);
                // Themes end

                var chart = am4core.create("chartdiv", am4charts.XYChart);
                chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

                chart.data = [
                    <?php for($i = 1; $i <= $daysInMonth; $i++){
                        $k = $i+1;
                        $begin = strtotime($year.'-'.$month.'-'.$i);
                        $end = strtotime($year.'-'.$month.'-'.$k);
                        
                        $query             =    "SELECT COUNT(*) AS todayrecord FROM #_counters WHERE tm>='$begin' and tm<'$end' "; 
                        $todayrc  = $db->rawQueryOne($query); 
                        $today_visitors     =    $todayrc['todayrecord'];
                    ?> {
                        "Month": "<?=$i?>",
                        "visits": <?=$today_visitors?>
                    },
                    <?php }?>
                ];

                var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                categoryAxis.renderer.grid.template.location = 0;
                categoryAxis.dataFields.category = "Month";
                categoryAxis.renderer.minGridDistance = 10;
                categoryAxis.fontSize = 11;

                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.min = 0;
                valueAxis.max = 10000;
                valueAxis.strictMinMax = true;
                valueAxis.renderer.minGridDistance = 30;
                // axis break
                var axisBreak = valueAxis.axisBreaks.create();
                axisBreak.startValue = 2100;
                axisBreak.endValue = 22900;
                //axisBreak.breakSize = 0.005;

                // fixed axis break
                var d = (axisBreak.endValue - axisBreak.startValue) / (valueAxis.max - valueAxis.min);
                axisBreak.breakSize = 0.05 * (1 - d) /
                    d; // 0.05 means that the break will take 5% of the total value axis height

                // make break expand on hover
                var hoverState = axisBreak.states.create("hover");
                hoverState.properties.breakSize = 1;
                hoverState.properties.opacity = 0.1;
                hoverState.transitionDuration = 1500;

                axisBreak.defaultState.transitionDuration = 1000;

                var series = chart.series.push(new am4charts.ColumnSeries());
                series.dataFields.categoryX = "Month";
                series.dataFields.valueY = "visits";
                series.columns.template.tooltipText = "{valueY.value}";
                series.columns.template.tooltipY = 0;
                series.columns.template.strokeOpacity = 0;

                // as by default columns of the same series are of the same color, we add adapter which takes colors from chart.colors color set
                series.columns.template.adapter.add("fill", function(fill, target) {
                    return chart.colors.getIndex(target.dataItem.index);
                });

            });
            </script>
            <!-- HTML -->
            <div id="chartdiv" style="width: 100%; height: 400px; float: left;"></div>
            <div class="clear"></div>
            */ ?>
            <div id="chart_visitor" style="width: 100%; height: 400px; float: left;"></div>
            <div class="clear"></div>
            <script src="js/highcharts/highcharts.js"></script>
            <script src="js/highcharts/modules/exporting.js"></script>
        </div>
        <div class="clear"></div>
    </div>
</form>