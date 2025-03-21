<?php
$title = "text-black  text-sm sm:text-[15px] leading-normal sm:leading-normal h-[calc(14px*1.5*2)] sm:h-[calc(15px*1.5*2)] font-main-400 font-normal group-hover/templateProduct_Three:text-[var(--html-bg-website)] line-clamp-2 transition-all duration-300 ";

$width = 400;

$height = 400;
foreach ($data as $key => $value) {
    $list_photos = $cache->getCache("select photo from #_album_photo where type=? and id_baiviet=? and hienthi=1 order by stt asc", array($value['type'], $value['id']), 'result', _TIMECACHE);

    $href =  _upload_hinhanh_l . $value['photo'];
?>
    <div class="group/templateImages_One load_website  overflow-hidden transition-all duration-300   <?= $class ?> ">
        <div class='relative rounded overflow-hidden'>
            <div class="w-full aspect-[<?= $width . "/" . $height ?>] bg-white transition-all duration-300 leading-[0] ">
                <?= $func->addHrefImg([
                    'classfix' => 'w-full',
                    'addhref' => true,
                    'href' =>  $href,
                    'isLazy' => true,
                    'sizes' => $width . "x" . $height . "x1",
                    'actual_width' => 500,
                    'data' => 'data-fancybox="collection_images' . $value['id'] . '" ',
                    'upload' => _upload_hinhanh_l,
                    'image' => ($value["photo"]),
                    'alt' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
                ]); ?>
                <?php if (!empty($list_photos)) { ?>
                    <div class="hidden">
                        <?php foreach ($list_photos as $key_list => $value_list) {
                            $href_list = _upload_hinhanh_l . $value_list['photo'];
                        ?>
                            <?= $func->addHrefImg([
                                'classfix' => 'w-full',
                                'addhref' => true,
                                'href' =>  $href_list,
                                'isLazy' => true,
                                'sizes' => "400x400x1",
                                'actual_width' => $width,
                                'data' => 'data-fancybox="collection_images' . $value['id'] . '" ',
                                'upload' => _upload_hinhanh_l,
                                'image' => ($value_list["photo"]),
                                'alt' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
                            ]); ?>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>