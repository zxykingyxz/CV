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
                                <div class="w-full grid grid-cols-1 gap-5 mt-4">
                                    <?= $sample->getTemplateLayoutsFor([
                                        'name_layouts' => 'input_default',
                                        'class_form' => '',
                                        'class' => '',
                                        'label' => 'Tiêu Đề (' . $value_lang . ')',
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
                                    <?php if ($data_setting["alias"] && isset($data_setting["alias"])) { ?>
                                        <?= $sample->getTemplateLayoutsFor([
                                            'name_layouts' => 'input_url_default',
                                            'class_form' => '',
                                            'class' => '',
                                            'label' => '(' . $value_lang . ') Đường hiển thị (Bạn có thể thay đổi đường dẫn)',
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
                                    <?php } ?>
                                    <?php if ($data_setting["link_cano"] && isset($data_setting["link_cano"])) { ?>
                                        <?= $sample->getTemplateLayoutsFor([
                                            'name_layouts' => 'input_default',
                                            'class_form' => '',
                                            'class' => '',
                                            'label' => 'Link canonical (' . $value_lang . ')',
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
                                <div class="w-full grid grid-cols-1 gap-5 mt-4">
                                    <?php if ($data_setting["job"] && isset($data_setting["job"])) { ?>
                                        <?= $sample->getTemplateLayoutsFor([
                                            'name_layouts' => 'input_default',
                                            'class_form' => '',
                                            'class' => '',
                                            'label' => 'Vị trí (' . $value_lang . ')',
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
                    <div class="w-full grid grid-cols-1 gap-5 mt-4">
                        <?php if (!empty($data_setting["index_robots"]) && isset($data_setting["index_robots"])) { ?>
                            <?= $sample->getTemplateLayoutsFor([
                                'name_layouts' => 'select_default',
                                'class_form' => '',
                                'class' => '',
                                'label' => 'Tùy chọn index',
                                'placeholder' => 'Chọn index',
                                'id' => 'index_robots',
                                'data' => 'data[text][index_robots]',
                                'data_option' => $data_setting["index_robots"],
                                'name_col_view' => 'title',
                                'name_col_value' => 'value',
                                'value' => (isset($data_detail['index_robots'])) ? htmlspecialchars_decode($data_detail['index_robots']) : "",
                                'required' => true,
                                'readonly' => false,
                                'function' => '',
                                'form' => true,
                            ]); ?>
                        <?php } ?>
                        <?php if (($data_setting["phone"] == true) && isset($data_setting["phone"])) { ?>
                            <?= $sample->getTemplateLayoutsFor([
                                'name_layouts' => 'input_default',
                                'class_form' => '',
                                'class' => '',
                                'label' => 'Số điện thoại',
                                'placeholder' => 'Nhập số điện thoại',
                                'id' => "phone",
                                'data' => "data[text][phone]",
                                'value' => (isset($data_detail["phone"])) ? htmlspecialchars_decode($data_detail["phone"]) : "",
                                'type' => 'text',
                                'required' => false,
                                'readonly' => false,
                                'function' => '',
                                'form' => true,
                            ]); ?>
                        <?php } ?>
                        <?php if (($data_setting["link_facebook"] == true) && isset($data_setting["link_facebook"])) { ?>
                            <?= $sample->getTemplateLayoutsFor([
                                'name_layouts' => 'input_default',
                                'class_form' => '',
                                'class' => '',
                                'label' => 'Link facebook',
                                'placeholder' => 'Nhập link facebook',
                                'id' => "link_facebook",
                                'data' => "data[text][link_facebook]",
                                'value' => (isset($data_detail["link_facebook"])) ? htmlspecialchars_decode($data_detail["link_facebook"]) : "",
                                'type' => 'text',
                                'required' => false,
                                'readonly' => false,
                                'function' => '',
                                'form' => true,
                            ]); ?>
                        <?php } ?>
                        <?php if (($data_setting["link_zalo"] == true) && isset($data_setting["link_zalo"])) { ?>
                            <?= $sample->getTemplateLayoutsFor([
                                'name_layouts' => 'input_default',
                                'class_form' => '',
                                'class' => '',
                                'label' => 'Link zalo',
                                'placeholder' => 'Nhập link zalo',
                                'id' => "link_zalo",
                                'data' => "data[text][link_zalo]",
                                'value' => (isset($data_detail["link_zalo"])) ? htmlspecialchars_decode($data_detail["link_zalo"]) : "",
                                'type' => 'text',
                                'required' => false,
                                'readonly' => false,
                                'function' => '',
                                'form' => true,
                            ]); ?>
                        <?php } ?>
                        <?php if (($data_setting["link_twitter"] == true) && isset($data_setting["link_twitter"])) { ?>
                            <?= $sample->getTemplateLayoutsFor([
                                'name_layouts' => 'input_default',
                                'class_form' => '',
                                'class' => '',
                                'label' => 'Link twitter',
                                'placeholder' => 'Nhập link twitter',
                                'id' => "link_twitter",
                                'data' => "data[text][link_twitter]",
                                'value' => (isset($data_detail["link_twitter"])) ? htmlspecialchars_decode($data_detail["link_twitter"]) : "",
                                'type' => 'text',
                                'required' => false,
                                'readonly' => false,
                                'function' => '',
                                'form' => true,
                            ]); ?>
                        <?php } ?>
                        <?php if (($data_setting["link_instagram"] == true) && isset($data_setting["link_instagram"])) { ?>
                            <?= $sample->getTemplateLayoutsFor([
                                'name_layouts' => 'input_default',
                                'class_form' => '',
                                'class' => '',
                                'label' => 'Link instagram',
                                'placeholder' => 'Nhập link instagram',
                                'id' => "link_instagram",
                                'data' => "data[text][link_instagram]",
                                'value' => (isset($data_detail["link_instagram"])) ? htmlspecialchars_decode($data_detail["link_instagram"]) : "",
                                'type' => 'text',
                                'required' => false,
                                'readonly' => false,
                                'function' => '',
                                'form' => true,
                            ]); ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="bg_form_all w-full">
                    <div>
                        <span class=" text-base font-semibold">
                            Thư viện media bài viết
                        </span>
                    </div>
                    <div class="w-full grid grid-cols-1 gap-5 mt-4">
                        <div class="card-body">
                            <h6 class="mb-4 text-15">Hình ảnh đính kèm</h6>
                            <div class="relative flex items-center justify-center border rounded-md cursor-pointer bg-slate-100 dropzone border-slate-200 dark:bg-zink-600 dark:border-zink-500">
                                <div class="fallback">
                                    <input name="file" type="file" multiple="multiple" class="cursor-pointer absolute top-0 left-0 z-10 opacity-0 w-full h-full">
                                </div>
                                <div class="w-full py-5 text-lg text-center dz-message needsclick">
                                    <div class="mb-3">
                                        <i data-lucide="upload-cloud" class="block mx-auto size-12 text-slate-500 fill-slate-200 dark:text-zink-200 dark:fill-zink-500"></i>
                                    </div>

                                    <div class="mb-0  text-slate-400 text-base font-bold">Upload image files here</div>
                                </div>
                            </div>

                            <ul class="mb-0" id="dropzone-preview">
                                <li class="mt-2" id="dropzone-preview-list">
                                    <!-- This is used as the file preview template -->
                                    <div class="border rounded border-slate-200 dark:border-zink-500">
                                        <div class="flex p-2">
                                            <div class="shrink-0 me-3">
                                                <div class="p-2 rounded-md size-14 bg-slate-100 dark:bg-zink-600">
                                                    <img data-dz-thumbnail class="block w-full h-full rounded-md" src="data:image/png;base64,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" alt="Dropzone-Image">
                                                </div>
                                            </div>
                                            <div class="grow">
                                                <div class="pt-1">
                                                    <h5 class="mb-1 text-15" data-dz-name>&nbsp;</h5>
                                                    <p class="mb-0 text-slate-500 dark:text-zink-200" data-dz-size></p>
                                                    <strong class="error text-danger" data-dz-errormessage></strong>
                                                </div>
                                            </div>
                                            <div class="shrink-0 ms-3">
                                                <button data-dz-remove class="px-2 py-1.5 text-xs text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-custom-400/20">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
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