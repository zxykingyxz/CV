<?php
$bg_footer = $cache->getCache("select ten_$lang as ten,slogan_$lang as slogan,mota_$lang as mota,photo from #_bannerqc where hienthi=1 and type=? limit 0,1", array('bg_footer'), 'fetch', _TIMECACHE);

$footer = $cache->getCache("select mota_$lang as mota,ten_$lang as ten from #_company where type=? limit 1", array('footer'), 'fetch', _TIMECACHE);

$footer_class_title = " font-main-600 font-semibold text-base text-white capitalize ";

$footer_class_content = "text-white text-[13px] font-normal font-main-400 leading-normal ";

$margin_top = " mt-6 ";

$list_service = $db->rawQuery("select id,ten_$lang as ten from #_baiviet where type=? and hienthi=1 order by stt asc", array('dich-vu'));

$class_title_main = "text-[20px] sm:text-[24px] leading-normal sm:leading-normal text-[var(--html-bg-website)] font-bold font-main-700";

$list_partner = $cache->getCache("select ten_$lang as ten ,link,photo from #_photo where type=? and hienthi=1 order by stt asc ", array('partner'), 'result', _TIMECACHE);

?>

<!-- Đăng ký -->
<section class="section-client pb-8 sm:pb-12 ">
    <div class="grid_s wide ">
        <div class="w-full flex flex-wrap  gap-5 sm:gap-7  md:gap-10 lg:gap-[80px] ">
            <div class="form_right_dk flex-initial w-full md:w-[35%] lg:w-[49%] pt-2 sm:pt-9 pb-7">
                <div class="w-full text-center ">
                    <div class="<?= $class_title_main ?> mt-2  w-full">
                        <span class=" ">
                            <?= "ĐỐI TÁC" ?>
                        </span>
                    </div>
                </div>
                <div class="owl-carousel form_partner owl-theme mt-7">
                    <?php
                    $list_tmp = array();
                    foreach ($list_partner as $k => $v) {
                        if (((($k + 1) % 3 === 0) && ($k != 0)) || (count($list_partner) == ($k + 1))) {
                            array_push($list_tmp, $v);
                    ?>
                            <div class="grid grid-cols-1 gap-3 md:gap-4 lg:gap-[18px]">
                                <?php foreach ($list_tmp as $key => $value) { ?>
                                    <div class="overflow-hidden aspect-[185/91] w-full bg-white border border-[#EEE] hover:border-[var(--html-bg-website)] rounded-lg transition-all duration-300">
                                        <?= $func->addHrefImg([
                                            'classfix' => 'w-full zoom_web',
                                            'addhref' => true,
                                            'href' => (!empty($value['link'])) ? $value['link'] : $jv0,
                                            'sizes' => '185x91x2',
                                            'actual_width' => 300,
                                            'upload' => _upload_hinhanh_l,
                                            'image' => ($value["photo"]),
                                            'alt' => $value["ten"],
                                        ]); ?>
                                    </div>
                                <?php } ?>
                            </div>
                    <?php
                            $list_tmp = array();
                        } else {
                            array_push($list_tmp, $v);
                        }
                    }
                    ?>

                </div>
            </div>
            <div class="flex-1 form_left_dk rounded-xl sm:rounded-[32px] bg-white px-3 sm:px-7 pt-9 pb-7 shadow-[0px_4px_25px_0px_rgba(0,_0,_0,_0.10)]">
                <div class="w-full text-center ">
                    <div class="<?= $class_title_main ?> mt-2  w-full">
                        <span class=" ">
                            <?= "ĐĂNG KÝ NGAY" ?>
                        </span>
                    </div>
                </div>
                <div class="mt-5">
                    <form action="" method="POST" name="form_client" id="client" class="form_client w-full flex flex-wrap items-start gap-3 " enctype="multipart/form-data">
                        <div class="w-full grid grid-cols-1 gap-[15px]">
                            <?= $this->getTemplateLayoutsFor([
                                'name_layouts' => 'input_web',
                                'class_form' => 'w-full',
                                'label' => "Họ Và Tên",
                                'placeholder' => "Nhập Họ Và Tên",
                                'id' => 'fullname',
                                'data' => 'data[fullname]',
                                'value' => '',
                                'type' => 'text',
                                'save_cache' => false,
                                'required' => true,
                                'readonly' => false,
                                'function' => '',
                                'form' => false,
                            ]); ?>
                            <?= $this->getTemplateLayoutsFor([
                                'name_layouts' => 'input_web',
                                'class_form' => 'w-full',
                                'label' => "Địa chỉ",
                                'placeholder' => "Nhập Địa chỉ",
                                'id' => 'address',
                                'data' => 'data[address]',
                                'value' => '',
                                'type' => 'text',
                                'save_cache' => false,
                                'required' => true,
                                'readonly' => false,
                                'function' => '',
                                'form' => false,
                            ]); ?>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-[15px]">
                                <?= $this->getTemplateLayoutsFor([
                                    'name_layouts' => 'input_web',
                                    'class_form' => 'w-full',
                                    'label' => "Số Điện Thoại",
                                    'placeholder' => "Số Điện Thoại",
                                    'id' => 'phone',
                                    'data' => 'data[phone]',
                                    'value' => '',
                                    'type' => 'number',
                                    'save_cache' => false,
                                    'required' => true,
                                    'readonly' => false,
                                    'function' => '',
                                    'form' => false,
                                ]); ?>
                                <?= $this->getTemplateLayoutsFor([
                                    'name_layouts' => 'input_web',
                                    'class_form' => 'w-full',
                                    'label' => "Email",
                                    'placeholder' => "Email",
                                    'id' => 'email',
                                    'data' => 'data[email]',
                                    'value' => '',
                                    'type' => 'text',
                                    'save_cache' => false,
                                    'required' => true,
                                    'readonly' => false,
                                    'function' => '',
                                    'form' => false,
                                ]); ?>
                            </div>
                            <?= $this->getTemplateLayoutsFor([
                                'name_layouts' => 'textarea_web',
                                'class_form' => 'w-full',
                                'class' => "",
                                'label' => "Nội Dung",
                                'placeholder' => "Nhập Nội Dung",
                                'id' => "notes",
                                'data' => "data[notes]",
                                'rows' => 6,
                                'value' => '',
                                'save_cache' => false,
                                'required' => false,
                                'readonly' => false,
                                'function' => '',
                                'form' => false,
                            ]); ?>

                            <div class="w-full flex items-center justify-center mt-5">
                                <button type="submit" name="submit-resgister-client" class="w-full max-w-[184px] uppercase h-[50px] bg-[var(--html-bg-website)] hover:bg-[var(--html-sc-website)] transition-all duration-300 text-[15px] font-semibold text-white text-center px-7 rounded-lg flex justify-center items-center gap-[10px]">
                                    <span>GỬI</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="17" viewBox="0 0 18 17" fill="none">
                                        <path d="M15.6641 8.08575V14.5543H1.73178V1.61715H8.69796V0H-0.00976562V16.1715H17.4057V8.08575H15.6641Z" fill="currentColor" />
                                        <path d="M10.4465 0L12.9543 2.3287L8.01758 6.91278L9.96811 8.72398L14.9048 4.1399L17.4126 6.4686V0H10.4465Z" fill="currentColor" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<footer class="section-footer  footer overflow-hidden relative bg-white" <?php if (!empty($bg_footer['photo'])) { ?> style="background: url(<?= _upload_hinhanh_l . $bg_footer['photo'] ?>) no-repeat center/cover ;" <?php } ?>>
    <div class="grid_s wide">
        <div class=" pt-5  pb-3 relative z-30">
            <div class="flex justify-center">
                <div class="w-full lg:w-[85%] row justify-between gap-5 sm:gap-2">
                    <!-- thông tin liên hệ -->
                    <div class="col flex-1 relative overflow-hidden content">
                        <div class="wow " data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="0.2s">
                            <div class=" <?= $footer_class_content ?>">
                                <?= $func->htmlDecodeContent($footer["mota"]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col overflow-hidden basis-full  md:basis-6/12 lg:basis-[30%] flex justify-start lg:justify-center">
                        <div class="wow " data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="0.4s">
                            <div class="<?= $footer_class_title ?>">
                                <span>quy định & chính sách</span>
                            </div>
                            <div class="<?= $margin_top ?>">
                                <ul class="grid grid-cols-1 gap-3">
                                    <?php foreach ($chinhsach as $key => $value) {
                                    ?>
                                        <li class="group transition-all duration-300 ">
                                            <a href="<?= $func->getUrl($value) ?>" title="<?= $value['ten'] ?>" class="flex items-center gap-2 group-hover:translate-x-3 transition-all duration-300">
                                                <div class="flex-initial leading-none aspect-[1/1] w-[7px] flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="6" height="7" viewBox="0 0 6 7" fill="none">
                                                        <circle cx="3" cy="3.06592" r="3" fill="var(--html-bg-website)" />
                                                    </svg>
                                                </div>
                                                <div class="<?= $footer_class_content ?>  flex-1   transition-all duration-300 group-hover:text-[var(--html-bg-website)] ">
                                                    <?= $value['ten'] ?>
                                                </div>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- mạng xã hội -->
                    <div class="col overflow-hidden flex-1 max-w-[500px] sm:max-w-[300px] flex justify-start lg:justify-center">
                        <div class=" w-full wow " data-wow-duration="<?= $time_animation_wow ?>s" data-wow-delay="0.6s">
                            <div class="<?= $footer_class_title ?>">
                                <span>Kết Nối Với Chúng Tôi</span>
                            </div>
                            <div class="<?= $margin_top  ?>"></div>
                            <div class="grid grid-cols-2 gap-3 mb-4 ">
                                <?php foreach ($socical as $k => $v) { ?>
                                    <a href="<?= $v['link'] != '' ? $v['link'] : $jv0 ?>" title="<?= $v['ten'] ?>" target="<?= $v['link'] != '' ? '_blank' : '_top' ?>" class="group/mxh py-3 px-5 text-[13px] font-medium font-main-500 flex justify-center items-center gap-2 bg-white hover:bg-[var(--html-bg-website)] hover:text-white shadow-[3px_4px_10px_0px_rgba(0,_0,_0,_0.15)] border border-gray-100 hover:border-[var(--html-bg-website)] rounded-lg transition-all duration-300 ">
                                        <div class="w-5 aspect-[1/1] overflow-hidden group-hover/mxh:brightness-0  group-hover/mxh:invert transition-all duration-300 leading-[0]">
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
                                        <div class="flex-1">
                                            <span>
                                                <?= $v['ten'] ?>
                                            </span>
                                        </div>
                                    </a>
                                <?php }  ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include _layouts . "sectionCopy.php"; ?>
    </div>
</footer>