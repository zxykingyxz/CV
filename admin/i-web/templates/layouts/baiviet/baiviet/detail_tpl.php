<form method="POST" action="<?= $func->getUrlParam(['com' => $_COM, 'src' => $_SRC, 'type' => $_TYPE, 'act' => "save", "id" => (int)htmlspecialchars($_GET['id']), "page" => $array_param_value['page']]) ?>" name="form-detail" class="form_lang_admin w-full flex-1 flex flex-wrap flex-col" enctype="multipart/form-data" autocomplete="off" accept-charset="utf-8">
    <input type="hidden" name="data[text][type]" value="<?= $_TYPE ?>">
    <div class="<?= $class_padding_form_data ?> w-full h-[inherit] flex-1">
        <div class="w-full flex flex-wrap gap-3">
            <?= $sample->getTemplateLayoutsFor([
                'name_layouts' => 'breadcrumbs',
                'title' => $data_setting['title'],
            ]) ?>
        </div>
        <div class=" mt-2">
            <?= $sample->getTemplateLayoutsFor([
                'name_layouts' => 'form_lang_detail',
                'title' => $data_setting['title'],
            ]) ?>
        </div>
        <div class="flex flex-wrap mt-4 justify-between items-start ">
            <div class="<?= $class_form_view_left ?> ">
                <?php foreach ($config['lang'] as $key_lang => $value_lang) { ?>
                    <div class="w-full data_lang_admin <?= ($key_lang != $_LANG) ? 'hidden' : "" ?>" data-nb="lang_data_<?= $key_lang ?>">
                        <div class="<?= $class_grid_column_form_view ?>">
                            <div class="w-full bg_form_all ">
                                <div>
                                    <span class=" text-base font-semibold">
                                        Thông tin link
                                    </span>
                                </div>
                                <div class="w-full grid grid-cols-1 gap-3 mt-4">
                                    <?= $sample->getTemplateLayoutsFor([
                                        'name_layouts' => 'input_default',
                                        'class_form' => '',
                                        'class' => '',
                                        'label' => 'Tiêu Đề [' . $value_lang . ']',
                                        'placeholder' => 'Nhập Tiêu Đề ',
                                        'id' => "ten_$key_lang",
                                        'data' => "data[text][ten_$key_lang]",
                                        'value' => (isset($data_detail["ten_$key_lang"])) ? htmlspecialchars_decode($data_detail["ten_$key_lang"]) : "",
                                        'type' => 'text',
                                        'required' => true,
                                        'readonly' => false,
                                        'function' => '',
                                        'form' => true,
                                    ]); ?>
                                    <?= $sample->getTemplateLayoutsFor([
                                        'name_layouts' => 'input_url_default',
                                        'class_form' => '',
                                        'class' => '',
                                        'label' => '[' . $value_lang . '] Đường hiển thị (Bạn có thể thay đổi đường dẫn)',
                                        'placeholder' => 'Nhập tên không dấu',
                                        'url_text' => $https_config,
                                        'id' => "tenkhongdau_$key_lang",
                                        'data' => "data[link][tenkhongdau_$key_lang]",
                                        'value' => (isset($data_detail["tenkhongdau_$key_lang"])) ? htmlspecialchars_decode($data_detail["tenkhongdau_$key_lang"]) : "",
                                        'type' => 'text',
                                        'required' => true,
                                        'readonly' => false,
                                        'function' => '',
                                        'form' => true,
                                    ]); ?>
                                    <?php if ($data_setting["link_cano"]) { ?>
                                        <?= $sample->getTemplateLayoutsFor([
                                            'name_layouts' => 'input_default',
                                            'class_form' => '',
                                            'class' => '',
                                            'label' => 'Link canonical [' . $value_lang . ']',
                                            'placeholder' => 'Nhập Link canonical',
                                            'id' => "cano_$key_lang",
                                            'data' => "data[link][cano_$key_lang]",
                                            'value' => (isset($data_detail["cano_$key_lang"])) ? htmlspecialchars_decode($data_detail["cano_$key_lang"]) : "",
                                            'type' => 'text',
                                            'required' => false,
                                            'readonly' => false,
                                            'function' => '',
                                            'form' => true,
                                        ]); ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="w-full bg_form_all">
                                <div>
                                    <span class=" text-base font-semibold">
                                        Thông tin bài viết
                                    </span>
                                </div>
                                <div class="w-full grid grid-cols-1 gap-3 mt-4">
                                    <?php if ($data_setting["job"]) { ?>
                                        <?= $sample->getTemplateLayoutsFor([
                                            'name_layouts' => 'input_default',
                                            'class_form' => '',
                                            'class' => '',
                                            'label' => 'Vị trí [' . $value_lang . ']',
                                            'placeholder' => 'Nhập Vị trí',
                                            'id' => "job_$key_lang",
                                            'data' => "data[text][job_$key_lang]",
                                            'value' => (isset($data_detail["job_$key_lang"])) ? htmlspecialchars_decode($data_detail["job_$key_lang"]) : "",
                                            'type' => 'text',
                                            'required' => true,
                                            'readonly' => false,
                                            'function' => '',
                                            'form' => true,
                                        ]); ?>
                                    <?php } ?>
                                    <?= $sample->getTemplateLayoutsFor([
                                        'name_layouts' => 'form_contents_data',
                                        'data_setting' => $data_setting,
                                        'value_lang' => $value_lang,
                                        'key_lang' => $key_lang,
                                    ]); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?= $sample->getTemplateLayoutsFor([
                    'name_layouts' => 'form_seo_data',
                    'data_setting' => $data_setting,
                    'class_form' => "mt-4",
                ]); ?>
            </div>
            <div class="<?= $class_form_view_right . " " . $class_grid_column_form_view ?>">
                <div class="bg_form_all w-full">
                    <div>
                        <span class=" text-base font-semibold">
                            Thuộc tính bài viết
                        </span>
                    </div>
                    <div class="w-full">

                    </div>
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