<div class="py-4 px-3 sm:px-5 w-full h-[inherit]">
    <div class="w-full flex flex-wrap gap-3">
        <?= $sample->getTemplateLayoutsFor([
            'name_layouts' => 'breadcrumbs',
            'title' => $data_setting['title'],
        ]) ?>
        <?= $sample->getTemplateLayoutsFor([
            'name_layouts' => 'handle_button_default',
            'data_setting' => $data_setting,
            'allow_add' => true,
            'allow_delete' => true,
            'allow_import' => true,
        ]) ?>
        <div class="form_table_detal w-full shadow-md shadow-gray-300 bg-white rounded-md overflow-hidden" data-url="<?= $_COM ?>">
            <input type="hidden" name="src" class="param_table_detail" value="<?= $_SRC ?>">
            <input type="hidden" name="act" class="param_table_detail" value="<?= $_ACT ?>">
            <input type="hidden" name="type" class="param_table_detail" value="<?= $_TYPE ?>">
            <div class="w-full py-2 px-3">
                <div class="w-full flex items-center">
                    <div>
                        <h3>
                            <span class=" text-xl">
                                Danh sách
                            </span>
                        </h3>
                    </div>
                </div>
                <div class="mt-2 flex flex-wrap items-center gap-2">
                    <div class="w-full sm:w-[300px]">
                        <?= $sample->getTemplateLayoutsFor([
                            'name_layouts' => 'input_default',
                            'class_form' => '',
                            'class' => 'param_table_detail',
                            'placeholder' => 'Tìm kiếm ... ',
                            'id' => 'keywords',
                            'data' => 'keywords',
                            'value' => (!empty($array_param_value['keywords'])) ? $array_param_value['keywords'] : "",
                            'type' => 'text',
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
                            'label' => 'Loại thu nhập',
                            'placeholder' => 'Chọn Loại Thu Nhập',
                            'id' => 'loai',
                            'data' => 'loai',
                            'data_option' => $config['data'][$_TYPE],
                            'name_col_view' => 'title',
                            'name_col_value' => 'value',
                            'value' => (!empty($array_param_value['loai'])) ? $array_param_value['loai'] : "",
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
                </div>
            </div>
            <div class="w-full py-2 px-3">
                <div class="w-full flex items-center gap-3">
                    <div class="inline-flex items-center gap-3">
                        <div class="pagging_list">
                            <?= $html_pagging ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-2 w-full overflow-auto  scroll-design-one  ">
                <table class="w-full min-w-[1000px] border-collapse border border-gray-200 shadow-md ">
                    <thead class="">
                        <tr class="<?= $class_title_table_default ?> ">
                            <th class="<?= $padding_th_table_default ?> text-center w-[10px] text-nowrap">
                                <?= $sample->getTemplateLayoutsFor([
                                    'name_layouts' => 'input_checkbox_default',
                                    'class' => 'input_check_all_default',
                                    'name' => 'check_all',
                                    'id' => 'check_all',
                                ]) ?>
                            </th>
                            <th class="<?= $padding_th_table_default ?> text-center w-[10px] text-nowrap">#</th>
                            <th class="<?= $padding_th_table_default ?> text-left ">Tiêu Đề</th>
                            <th class="<?= $padding_th_table_default ?> text-left w-[10px] text-nowrap">Giá</th>
                            <th class="<?= $padding_th_table_default ?> text-left w-[10px] text-nowrap">Loại Thu Nhập</th>
                            <th class="<?= $padding_th_table_default ?> text-left w-[10px] text-nowrap">Ngày Nhận</th>
                            <th class="<?= $padding_th_table_default ?> text-center w-[10px] text-nowrap">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="table_body">
                        <?= $html_tablebody ?>
                    </tbody>
                </table>
            </div>
            <div class="w-full py-2 px-3">
                <div class="w-full flex items-center gap-3">
                    <div class="inline-flex items-center gap-3">
                        <div class="pagging_list">
                            <?= $html_pagging ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>