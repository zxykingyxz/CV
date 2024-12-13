<div class=" relative  <?= $class_form ?> form_option_dashboard">
    <div class="cursor-pointer rounded-md gap-2 bg-blue-500 text-xs font-medium text-white h-[32px] flex justify-center items-center px-3 <?= $class_button ?> hover " data-nb="<?= $id_data_check ?>">
        <div class="<?= $class_data_output ?>" data-value="<?= $first_value ?>">
            <span> <?= $first_title ?></span>
        </div>
        <i class="fas fa-caret-down"></i>
    </div>
    <div class="hidden absolute top-[100%] left-0 <?= $class_data ?> max-h-60 scroll-bar-y-5 overflow-y-auto overflow-x-hidden out shadow-lg z-40" data-nb="<?= $id_data_check ?>">
        <div class="bg-white rounded-md shadow-lg p-1  flex flex-col flex-wrap  min-w-36 gap-1  ">
            <?php foreach ($array_data as $k_option => $v_option) { ?>
                <div class="py-2 px-3 rounded text-xs font-medium hover:text-white hover:bg-blue-500 text-blue-500 border-blue-500 border-[1px] w-[100%] transition-all cursor-pointer <?= $class_data_input ?>" data-value="<?= $v_option[$name_value] ?>">
                    <span>
                        <?= $v_option[$name_title] ?>
                    </span>
                </div>
            <?php } ?>
        </div>
    </div>
</div>