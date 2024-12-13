<?php
switch ($com) {
    case 'tac-gia':
        $title_relatedposts = "Tác Giả Khác";
        break;
    default:
        $title_relatedposts = "Bài Viết Liên Quan";
        break;
}
?>
<?php if (count($data) > 0) { ?>
    <div class=" <?= $class_form ?>">
        <div class="bg_form_all sticky top-[var(--value-top-fixed)] left-0 ">
            <div class="bg-gray-100 text-lg font-bold text-[var(--html-bg-website)] mb-3 py-1 px-1">
                <span>
                    <i class="fa fa-caret-right" aria-hidden="true"></i>&nbsp;
                    <span><?= $title_relatedposts ?></span>
                </span>
            </div>
            <ul class="scroll-y overflow-x-hidden overflow-y-auto max-h-[385px] grid grid-cols-1 gap-2">
                <?php foreach ($data as $key => $value) { ?>
                    <li class=" group leading-[0]">
                        <a href="<?= $func->getUrl($value) ?>" aria-label="<?= $value["ten_$lang"] ?>" title="<?= $value["ten_$lang"] ?>" class="inline-flex gap-2 leading-[0]" role="link" rel="dofollow">
                            <div class="bg-white">
                                <?= $func->addHrefImg([
                                    'classfix' => 'overflow-hidden hover-left  w-[90px]  aspect-[236/236]',
                                    'class' => 'object-cover',
                                    'isLazy' => true,
                                    'sizes' => '600x550x1',
                                    'upload' => _upload_baiviet_l,
                                    'image' => ($value["photo"]),
                                    'alt' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
                                ]); ?>
                            </div>
                            <div class="flex flex-col">
                                <div class="text-xs line-clamp-3 group-hover:text-[var(--html-bg-website)] transition-all duration-300 font-bold">
                                    <span><?= $value["ten_$lang"] ?></span>
                                </div>
                                <div class="flex-1"></div>
                                <div class="text-xs">
                                    <span><i class="fa-light fa-calendar-clock pr-2"></i>
                                        <?= ($value["ngaysua"] != 0) ? date('d/m/Y', $value["ngaysua"]) : date('d/m/Y', $value["ngaytao"]) ?>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
<?php } ?>