<script src="assets/plugins/highcharts/highcharts.js"></script>
<script src="assets/plugins/highcharts/accessibility.js"></script>
<script src="assets/plugins/highcharts/export-data.js"></script>
<script src="assets/plugins/highcharts/exporting.js"></script>
<script src="assets/plugins/highcharts/data.js"></script>
<script src="assets/plugins/highcharts/series-label.js"></script>
<?php
$class_form_all = "shadow-md shadow-gray-300 bg-white rounded p-3";
?>
<div class="p-[10px] w-full">
    <div class="flex flex-wrap w-full gap-4 items-center ">
        <form action="" method="GET" name="form_search_index" class="w-full flex flex-wrap items-center gap-3 <?= $class_form_all ?>" enctype="multipart/form-data">
            <div class="w-full sm:w-[250px]">
                <?= $sample->getTemplateLayoutsFor([
                    'name_layouts' => 'select_sumoselect',
                    'class_form' => '',
                    'class' => 'param_table_detail sumoselect_one',
                    'label' => 'Tháng',
                    'placeholder' => 'Chọn Tháng',
                    'id' => 'month',
                    'data' => 'month',
                    'data_option' => $config['data']['month'],
                    'name_col_view' => 'title',
                    'name_col_value' => 'value',
                    'value' => (!empty($array_param_value['month'])) ? $array_param_value['month'] : "",
                    'function' => '',
                    'no_label' => true,
                    'form' => true,
                ]); ?>
            </div>
            <div class="w-full sm:w-[250px]">
                <?= $sample->getTemplateLayoutsFor([
                    'name_layouts' => 'select_sumoselect',
                    'class_form' => '',
                    'class' => 'param_table_detail sumoselect_one',
                    'label' => 'Năm',
                    'placeholder' => 'Chọn Năm',
                    'id' => 'year',
                    'data' => 'year',
                    'data_option' => $config['data']['year'],
                    'name_col_view' => 'title',
                    'name_col_value' => 'value',
                    'value' => (!empty($array_param_value['year'])) ? $array_param_value['year'] : "",
                    'function' => '',
                    'no_label' => true,
                    'form' => true,
                ]); ?>
            </div>
            <button type="submit" name="submit-statistical" class=" h-[35px] bg-blue-500 hover:brightness-90 transition-all duration-300 text-sm font-normal text-white text-center px-4 rounded-sm flex justify-center items-center gap-2 text-nowrap">
                <span>Xem thống kê</span>
            </button>
        </form>
        <div class="w-full flex flex-wrap gap-4">
            <div class="flex-1 h-[inherit]  flex flex-wrap items-center justify-center" data-module="countup">
                <div class="w-full h-full flex flex-wrap flex-col gap-4">
                    <div class="w-full pt-8 pb-4 px-6 <?= $class_form_all ?>">
                        <div class="">
                            <p>
                                <span class="text-base font-semibold text-red-500">
                                    Tổng chi tiêu trong ngày:
                                </span>
                                <span class="animation_price text-base  font-medium" data-value="<?= !empty($data_total_chitieu_day['price']) ? $data_total_chitieu_day['price'] : 0 ?>"></span>
                            </p>
                            <p>
                                <span class="text-base font-semibold text-blue-500">
                                    Tổng thu nhập trong tháng:
                                </span>
                                <span class="animation_price text-base  font-medium" data-value="<?= !empty($data_total_thunhap_month['price']) ? $data_total_thunhap_month['price'] : 0 ?>"></span>
                            </p>
                            <p>
                                <span class="text-base font-semibold text-blue-500">
                                    Tổng chi tiêu trong tháng:
                                </span>
                                <span class="animation_price text-base  font-medium" data-value="<?= !empty($data_total_chitieu_month['price']) ? $data_total_chitieu_month['price'] : 0 ?>"></span>
                            </p>
                            <p>
                                <span class="text-base font-semibold text-green-500">
                                    Tổng thu nhập:
                                </span>
                                <span class="animation_price text-base  font-medium" data-value="<?= !empty($data_total_thunhap_all['price']) ? $data_total_thunhap_all['price'] : 0 ?>"></span>
                            </p>
                            <p>
                                <span class="text-base font-semibold text-green-500">
                                    Tổng chi tiêu:
                                </span>
                                <span class="animation_price text-base  font-medium" data-value="<?= !empty($data_total_chitieu_all['price']) ? $data_total_chitieu_all['price'] : 0 ?>"></span>
                            </p>
                            <p>
                                <span class="text-base font-semibold">
                                    Tổng ngân sách:
                                </span>
                                <span class="animation_price text-xl text-red-600 font-bold" data-value="<?= (float)$data_total_thunhap_all['price'] - (float)$data_total_chitieu_all['price'] ?>"></span>
                            </p>
                        </div>
                    </div>
                    <div class="flex-1 w-full flex items-center  pt-8 pb-4 px-6 <?= $class_form_all ?>">
                        <div class=" w-full ">
                            <p>
                                <span class="text-base font-semibold ">
                                    Hạn mức chi tiêu ăn uống còn lại trong ngày:
                                </span>
                                <span class=" text-lg text-red-500  font-semibold <?= !empty($settings_ngansach['chitieu_anuong_day']) ? "animation_price" : "" ?>" data-value="<?= !empty($settings_ngansach['chitieu_anuong_day']) ? ((float)$settings_ngansach['chitieu_anuong_day'] - (float)$data_total_chitieu_anuong_day['price'])  : 0 ?>">Đang cập nhật</span>
                            </p>
                            <p>
                                <span class="text-base font-semibold ">
                                    Hạn mức chi tiêu ăn uống còn lại trong tháng:
                                </span>
                                <span class=" text-lg text-red-500  font-semibold <?= !empty($settings_ngansach['chitieu_anuong_month']) ? "animation_price" : "" ?>" data-value="<?= !empty($settings_ngansach['chitieu_anuong_month']) ? ((float)$settings_ngansach['chitieu_anuong_month'] - (float)$data_total_chitieu_anuong_month['price'])  : 0 ?>">Đang cập nhật</span>
                            </p>
                            <p>
                                <span class="text-base font-semibold ">
                                    Hạn mức chi tiêu sinh hoạt còn lại trong tháng:
                                </span>
                                <span class=" text-lg text-red-500  font-semibold <?= !empty($settings_ngansach['chitieu_sinhhoat_month']) ? "animation_price" : "" ?>" data-value="<?= !empty($settings_ngansach['chitieu_sinhhoat_month']) ? ((float)$settings_ngansach['chitieu_sinhhoat_month'] - (float)$data_total_chitieu_sinhhoat_month['price'])  : 0 ?>">Đang cập nhật</span>
                            </p>
                            <p>
                                <span class="text-base font-semibold ">
                                    Hạn mức chi tiêu mua sắm còn lại trong tháng:
                                </span>
                                <span class=" text-lg text-red-500  font-semibold <?= !empty($settings_ngansach['chitieu_muasam_month']) ? "animation_price" : "" ?>" data-value="<?= !empty($settings_ngansach['chitieu_muasam_month']) ? ((float)$settings_ngansach['chitieu_muasam_month'] - (float)$data_total_chitieu_muasam_month['price'])  : 0 ?>">Đang cập nhật</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-[25%] <?= $class_form_all ?>" id="form_pie_chitieu"> </div>
            <div class="w-full lg:w-[25%] <?= $class_form_all ?>" id="form_pie_thunhap"> </div>
        </div>
        <div class="w-full <?= $class_form_all ?>" id="form_column_thunhap"></div>

        <div class="w-full <?= $class_form_all ?>" id="form_column_chitieu"></div>
    </div>
</div>
<script>
    getChartPie(data = {
        id: "form_pie_chitieu",
        title: "<?= "Chi Tiêu " . (!empty($array_param_value['month']) ? $array_param_value['month'] : date("m", time())) . "/" . (!empty($array_param_value['year']) ? $array_param_value['year'] : date("Y", time())) ?>",
        titleSeries: "Chi Tiêu",
        dataSeries: <?= $data_chart->chitieu_pie ?>,
    });
    getChartPie(data = {
        id: "form_pie_thunhap",
        title: "<?= "Thu nhập " . (!empty($array_param_value['month']) ? $array_param_value['month'] : date("m", time())) . "/" . (!empty($array_param_value['year']) ? $array_param_value['year'] : date("Y", time())) ?>",
        titleSeries: "Thu nhập",
        dataSeries: <?= $data_chart->thunhap_pie ?>,
    });
    getChartColumnStacked(data = {
        id: "form_column_chitieu",
        title: "<?= "Chi tiêu chi tiết " . (!empty($array_param_value['month']) ? $array_param_value['month'] : date("m", time())) . "/" . (!empty($array_param_value['year']) ? $array_param_value['year'] : date("Y", time())) ?>",
        titleSeries: "Chi tiêu chi tiết",
        dataSeries: <?= $data_chart->chitieu_column_stacked ?>,
        dataxAxis: <?= $data_chart->chitieu_label_x_column_stacked ?>,
    });
    getChartColumnStacked(data = {
        id: "form_column_thunhap",
        title: "<?= "Thu nhập chi tiết " . (!empty($array_param_value['month']) ? $array_param_value['month'] : date("m", time())) . "/" . (!empty($array_param_value['year']) ? $array_param_value['year'] : date("Y", time())) ?>",
        titleSeries: "Thu nhập chi tiết",
        dataSeries: <?= $data_chart->thunhap_column_stacked ?>,
        dataxAxis: <?= $data_chart->thunhap_label_x_column_stacked ?>,
    });
</script>