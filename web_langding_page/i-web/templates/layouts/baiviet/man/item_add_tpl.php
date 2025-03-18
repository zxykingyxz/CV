<?php
$data_setting = $GLOBAL[$com][$type];

$link_back = $func->getUrlParam([
    "com" => $com,
    "src" => $src,
    "act" => $func->getActParam('man'),
    "type" => $type,
    "id" => "",
]);
$link_save = $func->getUrlParam([
    "com" => $com,
    "src" => $src,
    "act" => $func->getActParam('save'),
    "type" => $type,
    "id" => "",
]);
$class_border_all = "border-t border-gray-300 first:border-none";
?>
<div class="p-[10px] w-full h-[inherit]">
    <div class="w-full flex flex-wrap gap-3">
        <?= $sample->getTemplateLayoutsFor([
            'name_layouts' => 'breadcrumbs',
            'title' => $data_setting['title'],
            'global' => ["com", "act", "type", "src"],
        ]) ?>
        <?= $sample->getTemplateLayoutsFor([
            'name_layouts' => 'form_lang_detail',
            'title' => $data_setting['title'],
            'global' => ["com", "act", "type", "src"],
        ]) ?>
        <form method="post" name="supplier" class="w-full" enctype="multipart/form-data" autocomplete="off" accept-charset="utf-8">
            <div class="w-full flex flex-wrap gap-3">
                <div class="flex-1 max-w-full">
                    <div class=" shadow shadow-gray-300 bg-white overflow-hidden w-full rounded ">
                        <div class="w-full py-2 px-2 flex flex-wrap gap-2 items-center <?= $class_border_all ?>">
                            <a href="<?= $link_back ?>" title="Xem danh sách" class=" h-[30px] bg-blue-500 hover:brightness-90 transition-all duration-300 text-xs font-normal text-white text-center px-4 rounded-sm inline-flex justify-center items-center gap-2 text-nowrap">
                                <i class="fas fa-backward"></i>
                                <span>Xem danh sách</span>
                            </a>
                        </div>
                        <div class="w-full py-2 px-3 <?= $class_border_all ?>">
                            <div class="text-sm font-bold">
                                <span>
                                    Nội dung bài viết
                                </span>
                            </div>
                            <div class="flex w-full gap-1 items-end mt-3">
                                <?= $sample->getTemplateLayoutsFor([
                                    'name_layouts' => 'input_admin',
                                    'class_form' => 'flex-1',
                                    'label' => 'Tiêu đề',
                                    'placeholder' => 'Nhập từ khóa ',
                                    'id' => 'keywords',
                                    'data' => 'keywords',
                                    'value' => '',
                                    'type' => 'text',
                                    'required' => true,
                                    'readonly' => false,
                                    'function' => '',
                                    'form' => true,
                                ]); ?>
                            </div>
                        </div>
                        <div class="w-full py-2 px-3 <?= $class_border_all ?>">

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>