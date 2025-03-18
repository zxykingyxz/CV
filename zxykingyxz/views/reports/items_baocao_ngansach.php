<?php if (!empty($data)) { ?>
    <?php foreach ($data as $key => $value) { ?>
        <?php
        $link_view = $func->getUrlParam([
            "com" => $_COM,
            "src" => $_SRC,
            "type" => $_TYPE,
            "act" => "view",
            "id" => $value['id'],
        ]);
        ?>
        <tr class="even:bg-gray-50 hover:bg-gray-100">
            <td class="<?= $padding_td_table_default ?> text-center">
                <?= $startpoint + $key + 1 ?>
            </td>
            <td class="<?= $padding_td_table_default ?>">
                <a href="<?= $link_view ?>" title="<?= $value['title'] ?>" class="w-full h-full">
                    <?= $value['title'] ?>
                </a>
            </td>
            <td class="<?= $padding_td_table_default ?>">
                <span class="text-nowrap">
                    <?= date("d/m/Y H:i:s", $value['date_reports']) ?>
                </span>
            </td>
            <td class="<?= $padding_td_table_default ?>">
                <span class="text-nowrap">
                    <?= date("d/m/Y H:i:s", $value['date_created']) ?>
                </span>
            </td>
            <td class="<?= $padding_td_table_default ?>">
                <?= $this->getTemplateLayoutsFor([
                    'name_layouts' => 'handle_button_item_default',
                    'id' => $value['id'],
                    'allow_view' => true,
                ]) ?>
            </td>
        </tr>
    <?php } ?>
<?php } else { ?>
    <?= $this->getTemplateLayoutsFor([
        'name_layouts' => 'form_nodata_table',
    ]) ?>
<?php } ?>