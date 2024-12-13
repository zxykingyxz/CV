<?php
$check_add = true;
if (!empty($id_supplier)) {
    $check_add = false;
}
?>
<section class="section-product py-4 ">
    <div class="grid_x wide ">
        <div class="w-full flex  gap-4 ">
            <div class=" max-w-[250px] basis-[30%] min-w-[150px] hidden lg:block">
                <div class="sticky top-[120px] left-0">
                    <?= $warehouse_func->getTemplateLayoutsFor([
                        'name_layouts' => 'form_searchlist',
                        'data' => ['name', 'city'],
                        'global' => ['cache', 'lang', 'data_status', 'list_city'],
                    ]); ?>
                </div>
            </div>
            <div class="flex-1 max-w-full">
                <div class="flex flex-wrap gap-4 max-w-full sticky top-[120px] left-0">
                    <div class="w-full flex flex-wrap gap-3 items-center">
                        <?= $warehouse_func->getTemplateLayoutsFor([
                            'name_layouts' => 'form_keywords',
                        ]); ?>
                        <div class="hidden w-0 sm:block sm:w-[5%] md:w-[10%] lg:w-[18%]"></div>
                        <?= $warehouse_func->getTemplateLayoutsFor([
                            'name_layouts' => 'form_button',
                            'add_check' => $check_add,
                            'import_check' => false,
                            'export_check' => true,
                            'sort_check' => true,
                            'global' => ['sort'],
                        ]); ?>
                    </div>
                    <div class=" form_table_view w-full max-h-[1500px] max-w-full overflow-auto scroll-y scroll-x" id="html_table">
                        <?= $html_table ?>
                    </div>
                    <div id="paging_table">
                        <?= $paging_table ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $warehouse_func->getTemplateLayoutsFor([
    'name_layouts' => 'form_warehouse_popup',
    'class_form' => 'max-w-[1200px]',
    'class_form_js' => 'form_popup',
    'class_close_form_js' => 'close_form_popup',
    'check_form' => 'add',
]); ?>
<?= $warehouse_func->getTemplateLayoutsFor([
    'name_layouts' => 'form_warehouse_popup',
    'class_form' => 'max-w-[500px]',
    'class_form_js' => 'form_popup_import',
    'class_close_form_js' => 'close_form_popup_import',
    'check_form' => 'import',
]); ?>