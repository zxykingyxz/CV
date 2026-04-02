<?php
if (empty($data["title"])) {
    $data["title"][0] = "";
}
foreach ($data['title'] as $key => $value) {
?>
    <div class="form_items_congno odd:bg-gray-100 even:bg-gray-50  flex flex-wrap gap-2 py-2 px-2">
        <div class="flex-[5] min-w-[150px]">
            <?= $this->getTemplateLayoutsFor([
                'name_layouts' => 'input_default',
                'class_form' => '',
                'class' => '',
                'label' => 'Tiêu đề',
                'placeholder' => 'Nhập Tiêu đề ',
                'id' => '',
                'data' => 'data[array_list][items][text][title][]',
                'value' => (isset($value)) ? htmlspecialchars_decode($value) : "",
                'type' => 'text',
                'required' => true,
                'readonly' => false,
                'function' => '',
                'form' => false,
            ]); ?>
        </div>
        <div class="flex-1 min-w-[230px]">
            <?= $this->getTemplateLayoutsFor([
                'name_layouts' => 'select_default',
                'class_form' => '',
                'class' => '',
                'label' => 'Loại Thanh toán',
                'placeholder' => 'Chọn Loại Thanh toán',
                'id' => '',
                'data' => 'data[array_list][items][number][loai][]',
                'data_option' => $config['data']["cong-no-items"],
                'name_col_view' => 'title',
                'name_col_value' => 'value',
                'value' => (isset($data['loai'][$key])) ? htmlspecialchars_decode($data['loai'][$key]) : "",
                'required' => true,
                'readonly' => false,
                'function' => '',
                'form' => false,
            ]); ?>
        </div>
        <div class="flex-1 min-w-[150px]">
            <?= $this->getTemplateLayoutsFor([
                'name_layouts' => 'input_default',
                'class_form' => '',
                'class' => 'input_price',
                'label' => 'mệnh giá',
                'placeholder' => 'Nhập mệnh giá',
                'id' => '',
                'data' => 'data[array_list][items][number][price][]',
                'value' => (isset($data['price'][$key])) ? htmlspecialchars_decode($data['price'][$key]) : "",
                'type' => 'text',
                'required' => true,
                'readonly' => false,
                'function' => '',
                'form' => false,
            ]); ?>
        </div>
        <div class="flex-1 min-w-[150px]">
            <?= $this->getTemplateLayoutsFor([
                'name_layouts' => 'input_default',
                'class_form' => '',
                'class' => 'input_date',
                'label' => 'Ngày Thanh Toán',
                'placeholder' => 'Nhập Ngày Thanh Toán',
                'id' => '',
                'data' => 'data[array_list][items][date][date][]',
                'value' => (isset($data['date'][$key])) ? date("d/m/Y", htmlspecialchars_decode($data['date'][$key])) : date("d/m/Y", time()),
                'type' => 'text',
                'required' => true,
                'readonly' => false,
                'function' => '',
                'form' => false,
            ]); ?>
        </div>
        <div class="button_delete_items_congno flex-initial cursor-pointer  rounded px-2 text-red-500 hover:text-red-600 bg-red-100 transition-all duration-300 flex justify-center items-center outline-none border-none h-[35px] w-[35px]">
            <i data-lucide="trash-2"></i>
        </div>
    </div>
<?php } ?>