<div class="<?= $class_form ?> form_search_check bg-white shadow-lg shadow-gray-300 overflow-hidden rounded-md border border-gray-300 " data-value="<?= $data_check ?>">
    <div class=" py-2 pl-3 pr-2 text-sm  text-black border-none [&.on]:border-solid [&.on]:border-b [&.on]:border-inherit   w-full flex items-center cursor-pointer gap-1 btn_search_check group/search <?= ($on) ? 'on' : '' ?>" data-nb="<?= $data_nb ?>">
        <div class="title_search flex-1 font-semibold">
            <span>
                <?= $name ?>
            </span>
        </div>
        <div class="h-6 aspect-[1/1] group-[.on]/search:scale-y-[-1] transition-all duration-200 text-sm inline-flex justify-center items-center">
            <i class="fas fa-chevron-down text-xs"></i>
        </div>
    </div>
    <div class="<?= ($on) ? 'block' : 'hidden' ?> data_search_check scroll-y overflow-x-hidden overflow-y-auto max-h-[290px]" data-nb="<?= $data_nb ?>">
        <div class=" w-full flex flex-wrap items-center gap-1 ">
            <?php foreach ($data_list as $key => $value) {
                if (!empty($array_param_value[$data_check])) {
                    $param_checkbox = (in_array($value[$value_check], $array_param_value[$data_check])) ? "checked" : '';
                } else {
                    $param_checkbox = "";
                }
            ?>
                <label class="py-2 pl-3 pr-2 relative text-xs  text-black odd:bg-gray-100 w-full  flex content-center items-center cursor-pointer on gap-2">
                    <?= $this->getTemplateLayoutsFor([
                        'name_layouts' => 'checkbok_rectangular',
                        'data' => $data_check,
                        'class_form' => 'h-3',
                        'value' => $value[$value_check],
                        'param_checkbox' => $param_checkbox,
                    ]); ?>
                    <div class="title_search flex-1 pt-1">
                        <span>
                            <?= $value[$name_check] ?>
                        </span>
                    </div>
                </label>
            <?php } ?>
        </div>
    </div>
</div>