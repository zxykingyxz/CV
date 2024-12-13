<table class="min-w-[1000px] w-full border-collapse border border-gray-300 rounded-md overflow-hidden">
    <thead class="bg-gray-200">
        <tr>
            <?php foreach ($data_head as $k_table => $v_table) { ?>
                <th class="border border-gray-300 px-4 py-2 text-left <?= $v_table['class'] ?>"><?= $v_table['title'] ?></th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data_value as $k_table_value => $v_table_value) { ?>
            <tr class="odd:bg-white even:bg-gray-100 hover:bg-blue-100 cursor-pointer transition-all">
                <td class="border border-gray-300 px-4 py-2">Hạng <?= $k_table_value + 1 ?></td>
                <td class="border border-gray-300 px-4 py-2"><?= $v_table_value["ten_vi"] ?></td>
                <td class="border border-gray-300 px-4 py-2">Developer</td>
            </tr>
            <tr class="odd:bg-white even:bg-gray-100 ">
                <td class="flex flex-wrap justify-center items-center p-4" colspan="<?= count($data_head) ?>">

                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>