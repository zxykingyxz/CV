<section class="wrap-top py-1">
    <div class="grid_s wide">
        <div class="row items-center justify-between">
            <div class="col flex-initial ">
                <div class="flex items-center gap-4">
                    <?php if (!empty($row_setting["hotline"])) { ?>
                        <div class="text-[var(--html-bg-website)]">
                            <i class="pr-3 fa-solid fa-phone"></i> Hỗ trợ tư vấn: <span><?= $row_setting["hotline"] ?></span>
                        </div>
                    <?php } ?>
                    <?php if (!empty($row_setting["timework_$lang"])) { ?>
                        <div class="text-[var(--html-bg-website)]">
                            <i class="pr-3 fa-solid fa-clock"></i> <span><?= $row_setting["timework_$lang"] ?></span>
                        </div>
                    <?php } ?>
                    <?php if (!empty($row_setting["email"])) { ?>
                        <div class="text-[var(--html-bg-website)]">
                            <i class="pr-3 fa-solid fa-envelope"></i> <span><?= $row_setting["email"] ?></span>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col flex-initial  ">
                <div class="inline-flex gap-2  justify-items-end  ">
                    <?php foreach ($socical as $key_mxk => $value_xmh) {
                    ?>
                        <?= $func->addHrefImg([
                            'classfix' => 'overflow-hidden inline-flex justify-center items-end h-5 aspect-[1/1] shadow p-[3px] rounded-sm bg-white hover:bg-[var(--html-bg-website)] transition-all duration-300',
                            'class' => '',
                            'addhref' => true,
                            'create_thumbs' => false,
                            'href' => (!empty($value_xmh["link"])) ? $value_xmh["link"] : $jv0,
                            'target' => (!empty($value_xmh["link"])) ? '_blank' : '',
                            'sizes' => '100x100x2',
                            'upload' => _upload_hinhanh_l,
                            'image' => ($value_xmh["photo"]),
                            'alt' => (isset($value_xmh["ten_$lang"])) ? $value_xmh["ten_$lang"] : $value_xmh["ten"],
                        ]); ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>