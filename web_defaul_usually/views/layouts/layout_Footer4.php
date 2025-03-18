<?php
$bg_footer = $cache->getCache("select ten_$lang as ten,slogan_$lang as slogan,mota_$lang as mota,photo from #_bannerqc where hienthi=1 and type=? limit 0,1", array('bg_footer'), 'fetch', _TIMECACHE);

$footer = $cache->getCache("select mota_$lang as mota,ten_$lang as ten from #_company where type=? limit 1", array('footer'), 'fetch', _TIMECACHE);

$support_center = $cache->getCache("select mota_$lang as mota from #_company where type=? limit 1", array('support-center'), 'fetch', _TIMECACHE);

$pay = $cache->getCache("select id, ten_$lang as ten ,photo from #_photo where type=? and hienthi=1 order by stt asc ", array('pay'), 'result', _TIMECACHE);

$footer_class_title = " font-main-600 font-semibold text-base text-[#343434] capitalize ";

$footer_class_content = "text-[#343434] text-[13px] font-medium font-main-500 leading-normal ";

$margin_top = " mt-6 ";

?>
<script>
    // button xem thông tin thanh toán
    $('body').on('click', '.views_pay_info', function() {
        let value = $(this).data('value');
        $.ajax({
            url: 'ajax/functions/ajaxViewInfo.php',
            type: 'POST',
            data: {
                value: value,
                form: 'view_info_pay',
            },
            dataType: 'json',
            beforeSend: function() {
                loadApplication(true);
            },
            success: function(data) {
                $('body').append(data.html);
                $('body .form_popup').addClass('active');
                $("body ").css('overflow', 'hidden');
                $('body').on('click', '.close_form_popup', function() {
                    if ($(this).closest(' .form_popup').hasClass('active')) {
                        $(this).closest(' .form_popup').remove();
                        $("body ").css('overflow', 'auto');
                    }
                });
                _FRAMEWORK.loadWesite();
                _FRAMEWORK.Lazys();
                loadApplication(false);
            },
            complete: function() {}
        });
    });
</script>

<footer class="section-footer  footer overflow-hidden relative bg-white" <?php if (!empty($bg_footer['photo'])) { ?> style="background: url(<?= _upload_hinhanh_l . $bg_footer['photo'] ?>) no-repeat center/cover ;" <?php } ?>>
    <div class="grid_s wide">
        <div class=" pt-8 sm:pt-[45px] pb-8 relative z-30">
            <div class="row justify-between gap-5 sm:gap-2">
                <!-- thông tin liên hệ -->
                <div class="col flex-1 relative overflow-hidden">
                    <div class="wow fadeInLeft" data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="0.2s">
                        <div class="<?= $footer_class_title ?>">
                            <span>Thông tin công ty</span>
                        </div>
                        <div class=" mb-4 <?= $margin_top . $footer_class_content ?>">
                            <?= $func->htmlDecodeContent($footer["mota"]) ?>
                        </div>
                    </div>
                </div>
                <div class="col overflow-hidden basis-full  md:basis-6/12 lg:basis-[20%] flex justify-start lg:justify-center">
                    <div class="wow fadeInLeft" data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="0.6s">
                        <div class="<?= $footer_class_title ?>">
                            <span>chính sách & quy định</span>
                        </div>
                        <div class="<?= $margin_top ?>">
                            <ul class="grid grid-cols-1 gap-3">
                                <li class="group transition-all duration-300 ">
                                    <a href="<?= $func->getType('gioi-thieu') ?>" title="<?= "Giới thiệu" ?>" class="flex items-center gap-2 group-hover:translate-x-3 transition-all duration-300">
                                        <div class="<?= $footer_class_content ?>  flex-1   transition-all duration-300 group-hover:text-[var(--html-bg-website)] ">
                                            <?= "Giới thiệu " . $row_setting["name_$lang"] ?>
                                        </div>
                                    </a>
                                </li>
                                <li class="group transition-all duration-300 ">
                                    <a href="<?= $func->getType('tin-tuc') ?>" title="<?= "Tin tức" ?>" class="flex items-center gap-2 group-hover:translate-x-3 transition-all duration-300">
                                        <div class="<?= $footer_class_content ?>  flex-1   transition-all duration-300 group-hover:text-[var(--html-bg-website)] ">
                                            <?= "Tin tức " . $row_setting["name_$lang"] ?>
                                        </div>
                                    </a>
                                </li>
                                <li class="group transition-all duration-300 ">
                                    <a href="<?= $func->getType('lien-he') ?>" title="<?= "Liên hệ" ?>" class="flex items-center gap-2 group-hover:translate-x-3 transition-all duration-300">
                                        <div class="<?= $footer_class_content ?>  flex-1   transition-all duration-300 group-hover:text-[var(--html-bg-website)] ">
                                            <?= "Liên hệ " . $row_setting["name_$lang"] ?>
                                        </div>
                                    </a>
                                </li>
                                <?php foreach ($chinhsach as $key => $value) {
                                ?>
                                    <li class="group transition-all duration-300 ">
                                        <a href="<?= $func->getUrl($value) ?>" title="<?= $value['ten'] ?>" class="flex items-center gap-2 group-hover:translate-x-3 transition-all duration-300">
                                            <div class="<?= $footer_class_content ?>  flex-1   transition-all duration-300 group-hover:text-[var(--html-bg-website)] ">
                                                <?= $value['ten'] ?>
                                            </div>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="w-[177px] mt-4">
                            <?= $func->addHrefImg([
                                'addhref' => true,
                                'href' => !empty($bct["link"]) ? $bct["link"] : $jv0,
                                'target' =>  !empty($bct["link"]) ? "'_blank'" : "",
                                'sizes' => '146x54x2',
                                'actual_width' => 500,
                                'upload' => _upload_hinhanh_l,
                                'image' => ($bct["photo"]),
                                'alt' => "Bộ Công Thương",
                            ]); ?>
                        </div>
                    </div>
                </div>
                <!-- Các danh mục footer -->
                <div class="col overflow-hidden basis-full  md:basis-6/12 lg:basis-[27%] flex justify-start lg:justify-center">
                    <div class=" wow fadeInLeft" data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="1s">
                        <div class="<?= $footer_class_title ?>">
                            <span><?= "Kết nối với " . $row_setting["name_$lang"] ?></span>
                        </div>
                        <div class="mt-3 <?= $margin_top ?> ">
                            <div class="flex items-center gap-1 ">
                                <?php foreach ($socical as $k => $v) { ?>
                                    <a href="<?= $v['link'] != '' ? $v['link'] : $jv0 ?>" title="<?= $v['ten'] ?>" target="<?= $v['link'] != '' ? '_blank' : '_top' ?>" class="group/mxh leading-[0] inline-flex justify-center items-center h-9 rounded-full bg-white hover:bg-[var(--html-bg-website)] transition-all duration-300 overflow-hidden aspect-[1/1]">
                                        <div class="w-[17px] aspect-[1/1] group-hover/mxh:brightness-0  group-hover/mxh:invert transition-all duration-300">
                                            <?= $func->addHrefImg([
                                                'addhref' => false,
                                                'href' =>  "",
                                                'target' => '',
                                                'sizes' => '20x20x2',
                                                'actual_width' => 500,
                                                'upload' => _upload_hinhanh_l,
                                                'image' => $v['photo'],
                                                'alt' =>  $v['ten']
                                            ]); ?>
                                        </div>
                                    </a>
                                <?php }  ?>
                            </div>
                        </div>
                        <div class="<?= $footer_class_title . " " . $margin_top ?>">
                            <span>Phương thức thanh toán</span>
                        </div>
                        <div class="<?= $margin_top ?> grid grid-cols-4 gap-1 w-[64%]">
                            <?php foreach ($pay as $key => $value) { ?>
                                <div class="views_pay_info cursor-pointer w-full aspect-[33/21] inline-flex justify-center items-center bg-white border border-gray-200 rounded-sm" data-value="<?= $value['id'] ?>">
                                    <?= $func->addHrefImg([
                                        'addhref' => false,
                                        'sizes' => '33x21x2',
                                        'upload' => _upload_hinhanh_l,
                                        'image' =>  $value["photo"],
                                        'alt' => $value["ten"],
                                    ]); ?>
                                </div>
                            <?php }  ?>
                        </div>
                    </div>
                </div>

                <!-- mạng xã hội -->
                <div class="col overflow-hidden flex-1 flex justify-start lg:justify-center">
                    <div class=" w-full wow fadeInLeft" data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="1.4s">
                        <div class="<?= $footer_class_title ?>">
                            <span>Tổng đài hỗ trợ</span>
                        </div>
                        <div class=" <?= $margin_top . $footer_class_content ?>">
                            <?= $func->htmlDecodeContent($support_center["mota"]) ?>
                        </div>
                        <div class="<?= $footer_class_title . " " . $margin_top ?>">
                            <span>Đăng ký tin nhận khuyến mãi</span>
                        </div>
                        <div class="<?= $margin_top  ?> w-[80%]">
                            <form action="" method="POST" name="form_client" class="form_client submit_load w-full flex flex-wrap items-start gap-3 " enctype="multipart/form-data">
                                <div class=" flex-1  grid grid-cols-1 gap-3  ">
                                    <?= $sample->getTemplateLayoutsFor([
                                        'name_layouts' => 'input_web',
                                        'class_form' => 'w-full',
                                        'lable' => "Họ Và Tên",
                                        'placeholder' => "Họ Và Tên*",
                                        'id' => 'fullname',
                                        'data' => 'fullname',
                                        'value' => '',
                                        'type' => 'text',
                                        'save_cache' => false,
                                        'required' => true,
                                        'readonly' => false,
                                        'function' => '',
                                        'form' => false,
                                    ]); ?>
                                    <?= $sample->getTemplateLayoutsFor([
                                        'name_layouts' => 'input_web',
                                        'class_form' => 'w-full',
                                        'lable' => "Số Điện Thoại",
                                        'placeholder' => "Số Điện Thoại*",
                                        'id' => 'phone',
                                        'data' => 'phone',
                                        'value' => '',
                                        'type' => 'number',
                                        'save_cache' => false,
                                        'required' => true,
                                        'readonly' => false,
                                        'function' => '',
                                        'form' => false,
                                    ]); ?>
                                    <div class="w-full flex items-center justify-center">
                                        <button type="submit" name="submit-resgister-client" class="w-full uppercase h-[40px] bg-[var(--html-bg-website)] hover:brightness-110 transition-all text-xs font-semibold text-white text-center px-7 rounded flex justify-center items-center gap-3">
                                            <span>ĐĂNG KÝ NGAY</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php include _layouts . "sectionCopy.php"; ?>