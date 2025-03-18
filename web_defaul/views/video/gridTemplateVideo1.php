<?php foreach ($data as $key => $value) {
    if (!empty($value['video'])) {
        $link = _upload_hinhanh_l . $value['video'];
    } else {
        $link = $value["link"];
    }
?>
    <div class="group/gridTemplateVideo_One overflow-hidden transition">
        <div class="aspect-[387/273] w-full" data-fancybox="video_<?= $value["id"] ?>" href="<?= $link ?>">
            <?= $func->addHrefImg([
                'addhref' => true,
                'href' =>  $jv0,
                'sizes' => '387x273x1',
                'actual_width' => 800,
                'upload' => _upload_hinhanh_l,
                'image' => $value['photo'],
                'alt' => $value["ten"]
            ]); ?>
        </div>
    </div>
<?php } ?>