<?php
// giới thiệu
$info = $cache->getCache("select id,type,ten_$lang as ten,slogan_$lang as slogan,mota_$lang as mota,photo from #_info where type=? and hienthi=1", array('ve-chung-toi'), 'fetch', _TIMECACHE);

$list_photos_info = $cache->getCache("select photo from #_baiviet_photo where type=? and id_baiviet=? and hienthi=1 order by stt asc", array($info['type'], $info['id']), 'result', _TIMECACHE);
?>
<script>
    var swiper = new Swiper(".introduce_main", {
        slidesPerView: 1.5,
        spaceBetween: 20,
        centeredSlides: true,
        loop: true,
        navigation: {
            nextEl: ".swiper_button_design_next",
            prevEl: ".swiper_button_design_prev",
        },
    });
</script>
<style>
    .introduce_main .swiper-slide {
        transition: all 0.3s;
        z-index: 5;
    }

    .introduce_main .swiper-slide-prev {
        transform: scale(0.8) translateX(90%);
        opacity: 0.5;
    }

    .introduce_main .swiper-slide-next {
        transform: scale(0.8) translateX(-90%);
        opacity: 0.5;
    }

    .introduce_main .swiper-slide-active {
        z-index: 10;
        transform: scale(1);
        opacity: 1;
    }
</style>
<!-- giới thiệu -->
<?php if (!empty($info)) { ?>
    <section class="section-introduce pb-8 sm:pb-12 ">
        <div class="grid_s wide ">
            <div class="bg_form_all form_opacity_1">
                <div class="w-full flex flex-wrap items-center justify-center gap-5 md:gap-[35px] pb-6">
                    <div class="flex-1">
                        <div class="flex items-center title_gsap_1 <?= $class_title_sup_main ?> gap-2 ">
                            <div class="flex-[0_0_auto] w-4 h-0 border-t border-[var(--html-sc-website)]"></div>
                            <span class="flex-initial">
                                <?= $info["ten"] . " " ?>
                            </span>
                            <div class=" flex-[0_0_auto] w-4 h-0 border-t border-[var(--html-sc-website)]"></div>
                        </div>
                        <div class="<?= $class_title_main ?> title_gsap_1 mt-2 ">
                            <span>
                                <?= $info["slogan"] ?>
                            </span>
                        </div>
                        <div class="mt-2 text-sm leading-[1.8] font-normal font-main-400">
                            <span class="text-[#494949] line-clamp-6 ">
                                <?= htmlspecialchars_decode($info["mota"]) ?>
                            </span>
                        </div>
                        <div class="mt-7 ">
                            <button title="Tìm hiểu thêm " class="views_introduce_info capitalize outline-none border-none inline-flex justify-center items-center leading-none h-10 rounded-full px-8 bg-[var(--html-bg-website)] text-white text-base font-medium font-main-500 text-center hover:bg-[var(--html-sc-website)] gap-2 transition-all duration-300" data-value="<?= $info["id"] ?>" data-form="view_info_introduce">
                                <span>Tìm hiểu thêm</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <g clip-path="url(#clip0_1_59)">
                                        <path d="M6.5625 13.209V16.6875C6.5625 16.9305 6.7185 17.1457 6.9495 17.2222C7.00725 17.241 7.0665 17.25 7.125 17.25C7.3005 17.25 7.47 17.1675 7.578 17.0205L9.61275 14.2515L6.5625 13.209Z" fill="currentColor" />
                                        <path d="M17.7638 0.104316C17.5913 -0.0179335 17.3648 -0.0344335 17.1773 0.0638165L0.302283 8.87632C0.102783 8.98057 -0.0149666 9.19357 0.00153336 9.41782C0.0187834 9.64282 0.168033 9.83482 0.380283 9.90757L5.07153 11.5111L15.0623 2.96857L7.33128 12.2828L15.1935 14.9701C15.252 14.9896 15.3135 15.0001 15.375 15.0001C15.477 15.0001 15.5783 14.9723 15.6675 14.9183C15.81 14.8313 15.9068 14.6851 15.9315 14.5208L17.994 0.645816C18.0248 0.435816 17.9363 0.227316 17.7638 0.104316Z" fill="currentColor" />
                                    </g>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="w-full lg:w-[52%] image_fade_scale_1 ">
                        <div class="swiper introduce_main">
                            <div class="swiper-wrapper">
                                <?php foreach ($list_photos_info as $key => $value) { ?>
                                    <div class="swiper-slide transition-all duration-300">
                                        <div class="w-full rounded-lg sm:rounded-3xl overflow-hidden leading-none">
                                            <?= $func->addHrefImg([
                                                'classfix' => '',
                                                'addhref' => false,
                                                'sizes' => "372x316x1",
                                                'actual_width' => 1100,
                                                'upload' => _upload_hinhanh_l,
                                                'image' => $value["photo"],
                                                'alt' =>  $info["ten"],
                                            ]); ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="w-full mt-5 flex items-center justify-center gap-3 ">
                                <button class="swiper_button_design_prev w-[37px] aspect-[1/1] bg-[#DFDDDD] rounded-full text-[#444343] hover:bg-[var(--html-bg-website)] hover:text-white flex justify-center items-center transition-all duration-300 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="8" viewBox="0 0 16 8" fill="none">
                                        <path d="M0.772627 3.38717C0.577365 3.58243 0.577365 3.89901 0.772627 4.09427L3.95461 7.27626C4.14987 7.47152 4.46645 7.47152 4.66171 7.27626C4.85698 7.08099 4.85698 6.76441 4.66171 6.56915L1.83329 3.74072L4.66171 0.912295C4.85698 0.717032 4.85698 0.40045 4.66171 0.205188C4.46645 0.0099256 4.14987 0.00992557 3.95461 0.205188L0.772627 3.38717ZM15.4573 3.24072L1.12618 3.24072L1.12618 4.24072L15.4573 4.24072L15.4573 3.24072Z" fill="currentColor" />
                                    </svg>
                                </button>
                                <button class="swiper_button_design_next w-[37px] aspect-[1/1] bg-[#DFDDDD] rounded-full text-[#444343] hover:bg-[var(--html-bg-website)] hover:text-white flex justify-center items-center transition-all duration-300 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="8" viewBox="0 0 16 8" fill="none">
                                        <path d="M15.2265 4.09428C15.4218 3.89902 15.4218 3.58243 15.2265 3.38717L12.0445 0.20519C11.8493 0.00992759 11.5327 0.00992757 11.3374 0.20519C11.1422 0.400452 11.1422 0.717034 11.3374 0.912296L14.1659 3.74072L11.3374 6.56915C11.1422 6.76441 11.1422 7.081 11.3374 7.27626C11.5327 7.47152 11.8493 7.47152 12.0445 7.27626L15.2265 4.09428ZM0.541809 4.24072L14.873 4.24072L14.873 3.24072L0.541809 3.24072L0.541809 4.24072Z" fill="currentColor" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>