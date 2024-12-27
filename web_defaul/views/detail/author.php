<?php if (!empty($author)) { ?>
    <div class="<?= $class_form ?>">
        <div class="flex items-center flex-col md:flex-row gap-5">
            <div class="flex-initial flex items-center flex-col gap-3">
                <?= $func->addHrefImg([
                    'classfix' => 'overflow-hidden hover-left cubic-img w-[150px] rounded-full aspect-[236/236]',
                    'class' => 'object-cover',
                    'addhref' => true,
                    'href' =>  $func->getUrl($author),
                    'isLazy' => true,
                    'sizes' => '600x600x2',
                    'upload' => _upload_baiviet_l,
                    'image' => ($author["photo"]),
                    'alt' => (isset($author["ten_$lang"])) ? $author["ten_$lang"] : $author["ten"],
                ]); ?>
                <div class=" flex gap-1">
                    <div class="">
                        Được viết bởi:
                    </div>
                    <div class=" font-bold color-main">
                        <a href="<?= $func->getUrl($author) ?>" title="<?= $author["ten"] ?>"><?= $author["ten"] ?></a>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="">
                    <?= $func->htmlDecodeContent($author['mota']) ?>
                </div>
                <ul class=" flex items-center">
                    <li>
                        <a href="<?= (!empty($author["link_facebook"])) ? $author["link_facebook"] : 'javascript:void(0)' ?>" title="Link facebook" rel="nofollow" <?php if (!empty($author["link_facebook"])) { ?> target="_blank" <?php } ?>>
                            <img src="./assets/images/socical-facebook.png" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="<?= (!empty($author["link_zalo"])) ? $author["link_zalo"] : 'javascript:void(0)' ?>" title="Link zalo" rel="nofollow" <?php if (!empty($author["link_zalo"])) { ?> target="_blank" <?php } ?>>
                            <img src="./assets/images/socical-zalo.png" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="<?= (!empty($author["link_instagram"])) ? $author["link_instagram"] : 'javascript:void(0)' ?>" title="Link instagram" rel="nofollow" <?php if (!empty($row_detail["link_instagram"])) { ?> target="_blank" <?php } ?>>
                            <img src="./assets/images/socical-instagram.png" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="<?= $author["link_twitter"] ?>" title="Linh twitter" rel="nofollow" <?php if (!empty($author["link_twitter"])) { ?> target="_blank" <?php } ?>>
                            <img src="./assets/images/socical-twitter.png" alt="">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<?php } ?>