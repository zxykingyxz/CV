<form method="POST" action="<?= $func->getUrlParam(['com' => $_COM, 'src' => $_SRC, 'type' => $_TYPE, 'act' => "save", "id" => (int)htmlspecialchars($_GET['id']), "page" => $array_param_value['page']]) ?>" name="form-detail" class="w-full flex-1 flex flex-wrap flex-col" enctype="multipart/form-data" autocomplete="off" accept-charset="utf-8">
    <div class="py-4 px-3 sm:px-5 w-full h-[inherit] flex-1">
        <div class="w-full flex flex-wrap gap-3">
            <?= $sample->getTemplateLayoutsFor([
                'name_layouts' => 'breadcrumbs',
                'title' => $data_setting['title'],
            ]) ?>
            <div class="w-full bg-white shadow-md shadow-gray-300 overflow-hidden rounded px-2 sm:px-4 py-4 sm:py-6">
                <div class="text-lg font-bold capitalize">
                    <span>
                        Form Thông tin
                    </span>
                </div>
                <div class="mt-4 grid grid-cols-1 gap-3">
                    <div class=" w-full grid grid-cols-1 sm:grid-cols-2  gap-3">
                        <input type="hidden" name="data[text][type]" value="<?= $_TYPE ?>">
                        <?= $sample->getTemplateLayoutsFor([
                            'name_layouts' => 'input_default',
                            'class_form' => '',
                            'class' => '',
                            'label' => 'Tiêu Đề',
                            'placeholder' => 'Nhập Tiêu Đề ',
                            'id' => 'title',
                            'data' => 'data[text][title]',
                            'value' => (isset($data_detail['title'])) ? htmlspecialchars_decode($data_detail['title']) : "",
                            'type' => 'text',
                            'required' => true,
                            'readonly' => false,
                            'function' => '',
                            'form' => true,
                        ]); ?>
                        <?= $sample->getTemplateLayoutsFor([
                            'name_layouts' => 'select_default',
                            'class_form' => '',
                            'class' => '',
                            'label' => 'Loại Công Nợ',
                            'placeholder' => 'Nhập Loại Công Nợ',
                            'id' => 'loai',
                            'data' => 'data[number][loai]',
                            'data_option' => $config['data'][$_TYPE],
                            'name_col_view' => 'title',
                            'name_col_value' => 'value',
                            'value' => (isset($data_detail['loai'])) ? htmlspecialchars_decode($data_detail['loai']) : "",
                            'required' => true,
                            'readonly' => false,
                            'function' => '',
                            'form' => true,
                        ]); ?>
                        <?= $sample->getTemplateLayoutsFor([
                            'name_layouts' => 'input_default',
                            'class_form' => '',
                            'class' => 'input_date',
                            'label' => 'Ngày',
                            'placeholder' => 'Nhập Ngày Tạo',
                            'id' => 'date',
                            'data' => 'data[date][date]',
                            'value' => (isset($data_detail['date'])) ? date("d/m/Y", htmlspecialchars_decode($data_detail['date'])) : date("d/m/Y", time()),
                            'type' => 'text',
                            'required' => true,
                            'readonly' => false,
                            'function' => '',
                            'form' => true,
                        ]); ?>
                        <?= $sample->getTemplateLayoutsFor([
                            'name_layouts' => 'input_default',
                            'class_form' => '',
                            'class' => 'input_price',
                            'label' => 'Giá Công Nợ(đ)',
                            'placeholder' => 'Nhập Giá Công Nợ',
                            'id' => '',
                            'data' => 'data[number][debt_price]',
                            'value' => (isset($data_detail['debt_price'])) ? htmlspecialchars_decode($data_detail['debt_price']) : 0,
                            'type' => 'text',
                            'required' => true,
                            'readonly' => false,
                            'function' => '',
                            'form' => true,
                        ]); ?>
                    </div>
                    <div class="w-full">
                        <div class="text-base font-semibold text-gray-600  ">
                            <span>Lần thanh toán</span>
                        </div>
                        <div class="form_all_items w-full  grid grid-cols-1 mt-2 border-t border-gray-200">
                            <?= $html_body_detail ?>
                        </div>
                        <div class="mt-2">
                            <div class="button_add_items_congno cursor-pointer h-[35px] bg-blue-500 hover:brightness-90 transition-all duration-300 text-sm font-normal text-white text-center px-4 rounded-sm inline-flex justify-center items-center gap-2 text-nowrap">
                                <i class="fas fa-plus"></i>
                                <span>Thêm thanh toán</span>
                            </div>
                        </div>
                    </div>
                    <?= $sample->getTemplateLayoutsFor([
                        'name_layouts' => 'textarea_default',
                        'class_form' => '',
                        'class' => '',
                        'label' => 'Ghi Chú',
                        'placeholder' => 'Nhập Ghi Chú',
                        'rows' => 7,
                        'id' => 'notes',
                        'data' => 'data[content][notes]',
                        'value' => (isset($data_detail['notes'])) ? htmlspecialchars_decode($data_detail['notes']) : "",
                        'required' => false,
                        'readonly' => false,
                        'function' => '',
                        'form' => true,
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
    <?= $sample->getTemplateLayoutsFor([
        'name_layouts' => 'handle_button_default_detail',
        'title' => $data_setting,
        'allow_back' => true,
        'allow_save' => true,
        'allow_save_here' => true,
    ]) ?>
</form>