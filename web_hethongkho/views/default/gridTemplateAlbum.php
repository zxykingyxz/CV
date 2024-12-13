<?php
switch ($com) {
    case 'video':
?>
        <?php
        foreach ($data as $key => $value) {
            if ($value['check_video'] == 1 && !empty($value['video'])) {
        ?>
                <div class='layouts-album '>
                    <div class=''>
                        <video width='100%' height='auto' autoplay="" muted="" loop="" controls="" style="max-width:100%;object-fit: cover;aspect-ratio: 16/9;">

                            <source src="<?= _upload_hinhanh_l . $value['video'] ?>" type="video/mp4">

                        </video>
                    </div>
                    <div class='text-album t-center'>
                        <span class='line-2'>
                            <?= (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"] ?>
                        </span>
                    </div>
                </div>
            <?php } else {
                $link = !empty($value['link']) ? $func->getYoutube($value['link']) : '';
            ?>
                <div class='layouts-album load_website'>
                    <div class=''>
                        <iframe width='100%' height='auto' style='aspect-ratio:16/9;max-width:100%;' allowfullscreen src='https://www.youtube.com/embed/<?= $link ?>'>
                        </iframe>
                    </div>
                    <div class='text-album t-center'>
                        <span class='line-2'>
                            <?= (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"] ?>
                        </span>
                    </div>
                </div>

        <?php
            }
        } ?>
    <?php
        break;
    case '':
    ?>

    <?php
        break;
    default:
    ?>
        <?php foreach ($data as $key => $value) {
            $photos = $cache->getCache("select id,photo from #_album_photo where type=? and id_baiviet=? order by stt asc, id desc", array($value["type"], $value["id"]), 'result', _TIMECACHE);
        ?>
            <div class='layouts-album o-hidden load_website  '>
                <div class='img-layouts-album pd10 p-relative'>
                    <?= $func->addHrefImg([
                        'addhref' => true,
                        'href' =>  _upload_hinhanh_l . ($value["photo"]),
                        'sizes' => '620x620x1',
                        'data' => 'data-fancybox="images-tpl-detail' . $value['id'] . '"',
                        'upload' => _upload_hinhanh_l,
                        'image' => ($value["photo"]),
                        'alt' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
                    ]); ?>
                </div>
                <?php foreach ($photos as $kn => $vn) { ?>
                    <?= $func->addHrefImg([
                        'addhref' => true,
                        'class' => '',
                        'classfix' => 'd-none',
                        'href' =>  _upload_hinhanh_l . ($vn["photo"]),
                        'sizes' => '620x620x1',
                        'data' => 'data-fancybox="images-tpl-detail' . $value['id'] . '"',
                        'upload' => _upload_hinhanh_l,
                        'image' => ($vn["photo"]),
                        'alt' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
                    ]); ?>
                <?php } ?>
                <div class='text-album t-center'>
                    <span class='line-2'>
                        <?= (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"] ?>
                    </span>
                </div>
            </div>
        <?php } ?>
<?php
        break;
}
?>