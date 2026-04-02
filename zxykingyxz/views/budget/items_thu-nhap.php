<?php if (!empty($data)) { ?>
    <?php foreach ($data as $key => $value) { ?>
        <?php
        $link_edit = $func->getUrlParam([
            "com" => $_COM,
            "src" => $_SRC,
            "type" => $_TYPE,
            "act" => "edit",
            "id" => $value['id'],
        ]);
        ?>
        <tr class="even:bg-gray-50 hover:bg-gray-100">
            <td class="<?= $padding_td_table_default ?> text-center">
                <?= $this->getTemplateLayoutsFor([
                    'name_layouts' => 'input_checkbox_default',
                    'class' => 'input_check_default',
                    'name' => 'check_box_default',
                    'id' => 'check_box_default',
                    'value' => $value['id'],
                ]) ?>
            </td>
            <td class="<?= $padding_td_table_default ?> text-center">
                <?= $startpoint + $key + 1 ?>
            </td>
            <td class="<?= $padding_td_table_default ?>">
                <a href="<?= $link_edit ?>" title="<?= $value['title'] ?>" class="w-full h-full">
                    <?= $value['title'] ?>
                </a>
            </td>
            <td class="<?= $padding_td_table_default ?>">
                <span class="text-nowrap text-red-600 font-bold">
                    <?= $func->formatMoney($value['price'], "đ") ?>
                </span>
            </td>
            <td class="<?= $padding_td_table_default ?>">
                <span class="text-nowrap ">
                    <?= $func->getTypeDataConfig($_TYPE, $value['loai'])['title'] ?>
                </span>
            </td>
            <td class="<?= $padding_td_table_default ?>">
                <span class="text-nowrap">
                    <?= date("d/m/Y", $value['date']) ?>
                </span>
            </td>
            <td class="<?= $padding_td_table_default ?>">
                <?= $this->getTemplateLayoutsFor([
                    'name_layouts' => 'handle_button_item_default',
                    'id' => $value['id'],
                    'allow_edit' => true,
                    'allow_delete' => true,
                ]) ?>
            </td>
        </tr>
    <?php } ?>
<?php } else { ?>
    <?= $this->getTemplateLayoutsFor([
        'name_layouts' => 'form_nodata_table',
    ]) ?>
<?php } ?>