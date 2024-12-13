<?php foreach ($data as $k => $v) { ?>
    <div class=" items_list_profession border-t border-gray-200 py-3  text-gray-600 hover:text-blue-600 cursor-pointer gap-3 transition-all flex items-center" data-value="<?= $v['name'] ?>">
        <div class="h-6 rounded aspect-[1/1] bg-gray-100 text-sm inline-flex justify-center items-center ">
            <span>
                <i class="<?= $v['icon'] ?>"></i>
            </span>
        </div>
        <div class="text-base font-bold">
            <span>
                <?= $v['name'] ?>
            </span>
        </div>
    </div>
<?php } ?>