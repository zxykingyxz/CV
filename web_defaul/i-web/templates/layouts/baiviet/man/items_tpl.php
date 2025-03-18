<?php
$data_setting = $GLOBAL[$com][$type]
?>
<div class="p-[10px] w-full h-[inherit]">
    <div class="w-full flex flex-wrap gap-3">
        <?= $sample->getTemplateLayoutsFor([
            'name_layouts' => 'breadcrumbs',
            'title' => $data_setting['title'],
            'global' => ["com", "act", "type", "src"],
        ]) ?>
        <?= $sample->getTemplateLayoutsFor([
            'name_layouts' => 'handle_button_default',
            'data_setting' => $data_setting,
            'global' => ["com", "act", "type", "src", "keywords"],
        ]) ?>
        <div class="w-full overflow-x-auto overflow-y-hidden scroll-design-one  shadow-md shadow-gray-300">
            <table class="w-full min-w-[1000px] border-collapse border border-gray-200 shadow-md rounded overflow-hidden">
                <thead>
                    <tr class="<?= $bg_title_table_default ?> text-white">
                        <th class="<?= $padding_td_table_default ?> text-center w-[10px]">
                            <?= $sample->getTemplateLayoutsFor([
                                'name_layouts' => 'input_checkbox_admin',
                                'class' => 'input_check_all',
                                'name' => 'check_all',
                                'id' => 'check_all',
                            ]) ?>
                        </th>
                        <th class="<?= $padding_td_table_default ?> text-center w-[10px]">STT</th>
                        <th class="<?= $padding_td_table_default ?> text-left ">Tên</th>
                        <th class="<?= $padding_td_table_default ?> text-left ">Email</th>
                        <th class="<?= $padding_td_table_default ?> text-left ">Trạng thái</th>
                        <th class="<?= $padding_td_table_default ?> text-center ">Hành động</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr class="odd:bg-gray-100 hover:bg-gray-200">
                        <td class="<?= $padding_td_table_default ?> text-left w-[10px]">
                            <?= $sample->getTemplateLayoutsFor([
                                'name_layouts' => 'input_checkbox_admin',
                                'class' => 'input_check_items',
                                'name' => 'check_items',
                                'id' => 'check_items',
                            ]) ?>
                        </td>
                        <td class="<?= $padding_td_table_default ?> text-center">
                            <div class="w-[40px]">
                                <?= $sample->getTemplateLayoutsFor([
                                    'name_layouts' => 'input_admin',
                                    'class' => 'text-center input_stt',
                                    'placeholder' => 'STT',
                                    'id' => 'stt',
                                    'data' => 'stt',
                                    'value' => 1,
                                    'type' => 'number',
                                    'function' => "data-table=baiviet",
                                    'no_lable' => true,
                                    'form' => true,
                                ]); ?>
                            </div>
                        </td>
                        <td class="<?= $padding_td_table_default ?>">Nguyễn Văn A</td>
                        <td class="<?= $padding_td_table_default ?>">nguyenvana@example.com</td>
                        <td class="<?= $padding_td_table_default ?>">
                            <span class="bg-green-200 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">Hoạt động</span>
                        </td>
                        <td class="<?= $padding_td_table_default ?> text-center">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">Sửa</button>
                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded ml-2">Xóa</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>