<?php
// dự án

$info_project_index = $cache->getCache("select  ten_$lang as ten,mota_$lang as mota from #_bannerqc where type=? and hienthi=1", array('info_project_index'), 'fetch', _TIMECACHE);

$list_project = $cache->getCache("select id,type, ten_$lang as ten , tenkhongdau_$lang as tenkhongdau,photo from #_baiviet where type=? and noibat=1 and hienthi=1 order by stt asc,id desc", array("du-an"), 'result', _TIMECACHE);

?>
<script>
    $(".form_project_main").flipster({
        style: "carousel",
        spacing: -0.5,
        loop: true,
        nav: true,
        buttons: false,
    });
</script>
<!-- dự án -->
<?php if (!empty($list_project)) { ?>
    <section class="section-project pb-8 sm:pb-[50px] ">
        <div class="grid_s wide ">
            <div class="rounded-xl sm:rounded-[32px] bg-white px-3 sm:px-5 pt-5 pb-7 ">
                <div class="w-full text-center flex flex-wrap justify-center">
                    <?php if (!empty($info_project_index["ten"])) { ?>
                        <div class="<?= $class_title_main ?>   w-full">
                            <span>
                                <?= $info_project_index["ten"] ?>
                            </span>
                        </div>
                    <?php } ?>
                    <?php if (!empty($info_project_index["mota"])) { ?>
                        <div class="mt-2 <?= $class_content_main ?>">
                            <span class="line-clamp-6">
                                <?= htmlspecialchars_decode($info_project_index["mota"]) ?>
                            </span>
                        </div>
                    <?php } ?>
                </div>
                <div class="flipster form_project_main mt-7">
                    <ul class="">
                        <?php foreach ($list_project as $key => $value) { ?>
                            <li class="max-w-[80%] w-[560px]">
                                <?= $this->getTemplateLayoutsFor([
                                    'name_layouts' => 'gridTemplateNews7',
                                    'seoHeading' => 'h6',
                                    'class' => '',
                                    'data' => [$value],
                                ]) ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="w-full flex justify-center items-center mt-5 sm:mt-[70px]">
                    <a href="<?= $func->getType("du-an") ?>" title="Xem thêm tất cả dự án" class=" capitalize outline-none border-none inline-flex justify-center items-center leading-none h-10 rounded-full px-8 bg-[var(--html-bg-website)] text-white text-base font-medium font-main-500 text-center hover:bg-[var(--html-sc-website)] gap-2 transition-all duration-300" data-value="<?= $info["id"] ?>" data-form="view_info_introduce">
                        <span>Xem thêm tất cả dự án</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                            <g clip-path="url(#clip0_3_69)">
                                <path d="M1.329 8.61973H12.1909L10.156 10.6549C9.57144 11.2395 10.4482 12.1163 11.0327 11.5317L12.886 9.67537L14.1232 8.43614C14.363 8.19491 14.363 7.80532 14.1232 7.5641L11.0327 4.46972C10.9152 4.34889 10.7533 4.28109 10.5847 4.28249C10.0281 4.28256 9.7549 4.9606 10.156 5.34662L12.1957 7.38178H1.297C0.439746 7.42432 0.503753 8.66241 1.329 8.61973Z" fill="currentColor" />
                            </g>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
<?php } ?>