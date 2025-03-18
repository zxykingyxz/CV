<?php
global $class_button_form_info_data;
global $jv0;

?>
<?php if (!empty($data_setting['contents'])) { ?>
    <div class="mt-2 w-full form_baiviet_admin">
        <div class="w-full scroll-design-one">
            <ul class="flex text-nowrap text-center dark:border-zink-500 nav-tabs">
                <?php foreach ($data_setting['contents'] as $key_content => $value_content) { ?>
                    <li class=" group  btn_baiviet_admin <?= ($key_content == 0) ? "active" : "" ?>" data-nb="<?= $value_content['type'] . "_" . $value_lang ?>">
                        <a href="<?= $jv0 ?>" class="<?= $class_button_form_info_data ?>">
                            <span>
                                <?= $value_content['title'] . " [" . $value_lang . "]" ?>
                            </span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="w-full">
            <?php foreach ($data_setting['contents'] as $key_content => $value_content) { ?>
                <div class="w-full  opacity_animaiton data_baiviet_admin <?= ($key_content == 0) ? "" : " hidden" ?>" data-nb="<?= $value_content['type'] . "_" . $value_lang ?>">
                    <?= $this->getTemplateLayoutsFor([
                        'name_layouts' => 'textarea_default',
                        'class_form' => '',
                        'class' => ($value_content["ckeditor"]) ? 'ClassCkEditor' : "",
                        'label' => $value_content['title'] . ' [' . $value_lang . ']',
                        'placeholder' => 'Nhập ' . $value_content['title'],
                        'id' => $value_content['type'] . "_" . $key_lang,
                        'data' => "data[text][" . $value_content['type'] . "_" . $key_lang . "]",
                        'value' => (isset($data_detail[$value_content['type'] . "_" . "$key_lang"])) ? htmlspecialchars_decode($data_detail[$value_content['type'] . "_" . "$key_lang"]) : "",
                        'type' => 'text',
                        'rows' => 25,
                        'required' => false,
                        'readonly' => false,
                        'function' => '',
                        'form' => false,
                    ]); ?>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>