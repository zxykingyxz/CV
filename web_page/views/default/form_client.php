<?php
$class_title_sup_main = "text-[#2F2E2E] text-sm sm:text-base font-normal font-main-400";
$class_title_main = "text-[20px] sm:text-[24px] leading-normal sm:leading-normal text-[var(--html-bg-website)] font-bold font-main-700";
$class_content_main = "text-[#3D3A3A] text-xs sm:text-sm leading-[1.78] sm:leading-[1.78] font-normal font-main-400";

?>
<div class=" overflow-hidden form_left_dk  bg-white px-3 sm:px-7 pt-9 pb-7 shadow-[0px_4px_25px_0px_rgba(0,_0,_0,_0.10)]">
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