<div class="form_search_checkbox gap-2 flex flex-wrap content-start">
    <?php
    if (!empty($data_status)) {
        echo $this->getTemplateLayoutsFor([
            'name_layouts' => 'form_checksearch',
            'class_form' => 'w-full items_search_checkbox',
            'name' => 'Trạng thái',
            'data_list' => $data_status,
            'data_nb' => 'search_status',
            'data_check' => 'status',
            'value_check' => "value",
            'name_check' => 'name',
            'on' => true,
            'global' => ['array_param_value'],
        ]);
    }
    if (!empty($list_city)) {
        echo $this->getTemplateLayoutsFor([
            'name_layouts' => 'form_checksearch',
            'class_form' => 'w-full items_search_checkbox',
            'name' => 'Khu vực',
            'data_list' => $list_city,
            'data_nb' => 'search_city',
            'data_check' => 'city',
            'value_check' => 'id',
            'name_check' => 'name',
            'name_check' => 'name',
            'on' => false,
            'global' => ['array_param_value'],
        ]);
    }
    ?>
</div>