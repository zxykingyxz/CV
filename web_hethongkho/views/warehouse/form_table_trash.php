<?php foreach ($data as $key => $value) { ?>
    <div class="w-full">
        <div class="w-full mb-1">
            <span class="text-sm text-gray-700 font-bold">
                <?= $value['name'] ?>
            </span>
        </div>
        <?php $column = ['code', 'date_trash']; ?>
        <table class="form_table_views table-auto  w-full border-collapse border border-gray-200  ">
            <thead class="bg-gray-200">
                <tr>
                    <th class=" border border-gray-200 px-2 py-1 text-left bg-gray-300 sticky top-0 z-10 ">
                        <span>
                            STT
                        </span>
                    </th>
                    <?php foreach ($column as $v_column) { ?>
                        <th class=" border border-gray-200 px-2 py-1 text-left bg-gray-300 sticky top-0  <?= ($v_column == 'name') ? "w-[250px] left-0 z-20" : " z-10" ?> ">
                            <span>
                                <?= $this->value_handing_column($v_column) ?>
                            </span>
                        </th>
                    <?php } ?>
                    <th class=" border border-gray-200 text-left bg-gray-300 sticky top-0 z-10 ">
                        <span>
                        </span>
                    </th>
                    <th class=" border border-gray-200  text-left bg-gray-300 sticky top-0 z-10 ">
                        <span>
                        </span>
                    </th>
                </tr>
            </thead>
            <tbody class="body_table">
                <?php
                foreach ($value['data'] as $k_table_value => $v_table_value) {
                ?>
                    <tr class="template-default transition-all duration-200">
                        <td class=" bg-inherit border border-gray-300 w-9 " align="center">
                            <div class="inline-flex  justify-center items-center w-9 pt-1">
                                <?= $k_table_value + 1 ?>
                            </div>
                        </td>
                        <?php foreach ($column as $v_column) { ?>
                            <td class=" border border-gray-300 px-2 py-1  bg-inherit">
                                <span>
                                    <?= $this->value_handing_column($v_column, $v_table_value); ?>
                                </span>
                            </td>
                        <?php } ?>
                        <td class=" bg-inherit border border-gray-300 w-8">
                            <div class="inline-flex justify-center items-center content-center w-8">
                                <a href="<?= $jv0 ?>" class="button_undo cursor-pointer text-base text-gray-400 hover:text-gray-700 transition-all duration-300 flex justify-center items-center w-full aspect-[1/1]" data-id="<?= $v_table_value['id'] ?>" data-table="<?= $key ?>" title="Hoàn Tác Dữ Liệu">
                                    <i class="fas fa-undo"></i>
                                </a>
                            </div>
                        </td>
                        <td class=" bg-inherit border border-gray-300 w-8">
                            <div class="inline-flex justify-center items-center content-center w-8">
                                <a href="<?= $jv0 ?>" class="button_delete cursor-pointer text-base text-gray-400 hover:text-gray-700 transition-all duration-300 flex justify-center items-center w-full aspect-[1/1]" data-id="<?= $v_table_value['id'] ?>" data-table="<?= $key ?>" title="Xóa Dữ Liệu">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php }  ?>
            </tbody>
        </table>
    </div>
<?php } ?>