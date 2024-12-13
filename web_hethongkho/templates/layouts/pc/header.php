<header class="sticky top-0 z-40 bg-white shadow-lg  group/header ">
    <div class="grid_s wide relative bg-white">
        <div class="flex justify-between items-center gap-[45px] pt-[10px] pb-[9px]">
            <div class="flex-initial">
                <?= $func->addHrefImg([
                    'classfix' => 'overflow-hidden inline-flex hover-left w-[60px] aspect-[108/90]',
                    'addhref' => true,
                    'href' =>   '',
                    'sizes' => '500x500x2',
                    'isLazy' => true,
                    'upload' => _upload_hinhanh_l,
                    'image' => ($logo["photo"]),
                    'alt' => (isset($row_setting["name_$lang"])) ? $row_setting["name_$lang"] : $row_setting["name"],
                ]); ?>
            </div>
            <?php include _layouts . 'pc/menu.php' ?>
        </div>
    </div>
</header>