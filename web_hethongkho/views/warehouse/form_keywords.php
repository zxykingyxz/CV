<?= $this->getTemplateLayoutsFor([
    'name_layouts' => 'input_warehouse',
    'class_form' => 'flex-1 w-auto min-w-[200px]',
    'no_lable' => true,
    'placeholder' => 'Nhập tên/mã',
    'data' => 'keywords',
    'type' => 'text',
    'save_cache' => false,
    'required' => false,
]); ?>
<div class="button_search_keywords px-4 h-9 text-sm sm:text-sm font-normal rounded-md  text-white bg-blue-500 hover:bg-blue-600 transition-all duration-300 inline-flex justify-center items-center gap-1 cursor-pointer">
    <i class="fa-regular fa-magnifying-glass"></i>
    <div class="">
        <span>Tìm Kiếm</span>
    </div>
</div>