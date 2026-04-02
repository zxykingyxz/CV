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
            <input type="hidden" name="type" class="param_table_detail" value="<?= $_TYPE ?>">
            <input type="hidden" name="act" class="param_table_detail" value="<?= $_ACT ?>">
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
                            'label' => 'Loại Công Nợ',
                            'placeholder' => 'Chọn Loại Công Nợ',
                            'id' => 'type',
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
                </div>
            </div>
            <div class="w-full pt-2 px-3 ">
                <div class="w-full flex items-center">
                    <div>
                        <h4>
                            <span class=" text-lg">
                                Công nợ cần thu
                            </span>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="mt-2 w-full  grid grid-flow-col sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-3 border-t border-[#D9D9D9] ">
                <?= $html_type_one ?>
            </div>
            <div class="w-full pt-2 px-3 ">
                <div class="w-full flex items-center ">
                    <div>
                        <h4>
                            <span class=" text-lg">
                                Công nợ cần trả
                            </span>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="mt-2 w-full  grid grid-flow-col sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-3 border-t border-[#D9D9D9] ">
                <?= $html_type_two ?>
            </div>
            <div class="w-full pt-2 px-3 ">
                <div class="w-full flex items-center">
                    <div>
                        <h4>
                            <span class=" text-lg">
                                Công nợ đã hoàn thành
                            </span>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="mt-2 w-full  grid grid-flow-col sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-3 border-t border-[#D9D9D9] ">
                <?= $html_type_out ?>
            </div>
        </div>
    </div>
</div>