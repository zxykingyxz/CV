<?php
if ($data_setting["seo"]) {
    global $https_config;
?>
    <div class="w-full bg_form_all <?= $class_form ?> ">
        <div>
            <span class=" text-base font-semibold">
                Thông tin seo
            </span>
        </div>
        <div class="w-full grid grid-cols-1 gap-5 mt-4 ">
            <?php foreach ($config['lang'] as $key_lang => $value_lang) { ?>
                <div class="w-full data_lang_admin <?= ($key_lang != $_LANG) ? 'hidden' : "" ?>" data-nb="lang_data_<?= $key_lang ?>">
                    <?= $this->getTemplateLayoutsFor([
                        'name_layouts' => 'input_default',
                        'class_form' => '',
                        'class' => '',
                        'label' => 'Title (' . $value_lang . ')',
                        'placeholder' => 'Nhập Title ',
                        'id' => "title_$key_lang",
                        'data' => "dataseo[text][title_$key_lang]",
                        'value' => (isset($data_seo_detail["title_$key_lang"])) ? htmlspecialchars_decode($data_seo_detail["title_$key_lang"]) : "",
                        'type' => 'text',
                        'required' => true,
                        'readonly' => false,
                        'function' => '',
                        'form' => true,
                    ]); ?>
                </div>
                <div class="w-full data_lang_admin <?= ($key_lang != $_LANG) ? 'hidden' : "" ?>" data-nb="lang_data_<?= $key_lang ?>">
                    <?= $this->getTemplateLayoutsFor([
                        'name_layouts' => 'textarea_default',
                        'class_form' => '',
                        'class' => '',
                        'label' => 'Description (' . $value_lang . ')',
                        'placeholder' => 'Nhập Description ',
                        'id' => "description_$key_lang",
                        'rows' => 7,
                        'data' => "dataseo[text][description_$key_lang]",
                        'value' => (isset($data_seo_detail["description_$key_lang"])) ? htmlspecialchars_decode($data_seo_detail["description_$key_lang"]) : "",
                        'type' => 'text',
                        'required' => true,
                        'readonly' => false,
                        'function' => '',
                        'form' => true,
                    ]); ?>
                </div>
            <?php } ?>
            <?= $this->getTemplateLayoutsFor([
                'name_layouts' => 'textarea_default',
                'class_form' => '',
                'class' => '',
                'label' => 'Schema Json <a class=" font-medium text-blue-500" href="https://developers.google.com/search/docs/advanced/structured-data/search-gallery" target="_blank">(Tài liệu tham khảo)</a>',
                'placeholder' => 'Nhập Schema Json ',
                'rows' => 7,
                'id' => "schema_$key_lang",
                'data' => "dataseo[text][schema_$key_lang]",
                'value' => (isset($data_seo_detail["schema_$key_lang"])) ? htmlspecialchars_decode($data_seo_detail["schema_$key_lang"]) : "",
                'type' => 'text',
                'required' => false,
                'readonly' => false,
                'function' => '',
                'form' => true,
            ]); ?>
        </div>
        <div class=" mt-5">
            <p class="text-lg text-black">Hiển thị kết quả tìm kiếm google search</p>
            <p>
                <a href="#" class="text-sm text-green-600"><?= $https_config ?></a>
            </p>
            <h2 class="text-xl text-blue-600 font-semibold hover:underline">
                <p>
                    <a href="#">[SEO Onpage] là gì? Hướng dẫn tối ưu SEO Onpage...</a>
                </p>
            </h2>
            <p class="text-gray-600 text-sm">
                Hướng dẫn SEO onpage căn bản tối ưu để trang web chuẩn SEO lên top Google nhanh
                và bền vững, kỹ thuật tối ưu SEO onpage đơn giản.
            </p>
        </div>
    </div>
<?php } ?>