<?php
$width_title_setting = "w-full md:w-[200px]";
?>
<form method="POST" action="<?= $func->getUrlParam(['com' => $_COM, 'src' => $_SRC, 'type' => $_TYPE, 'act' => "save", "id" => (int)htmlspecialchars($data_detail['id'])]) ?>" name="form-detail" class="w-full flex-1 flex flex-wrap flex-col" enctype="multipart/form-data" autocomplete="off" accept-charset="utf-8">
    <div class="py-4 px-3 sm:px-5 w-full h-[inherit] flex-1">
        <div class="w-full flex flex-wrap gap-3">
            <?= $sample->getTemplateLayoutsFor([
                'name_layouts' => 'breadcrumbs',
                'title' => $data_setting['title'],
            ]) ?>
            <div class="w-full mt-2">
                <div class=" flex flex-wrap gap-4">
                    <div class="flex-1 bg-white shadow-md shadow-gray-300 overflow-hidden rounded px-2 sm:px-4 py-4 sm:py-6">
                        <div class="text-xl font-bold capitalize">
                            <span>
                                <?= "Cài đặt " . $data_setting['title'] ?>
                            </span>
                        </div>
                        <div class="w-full grid grid-cols-1 gap-6 mt-8">
                            <input type="hidden" name="data[text][type]" value="<?= $_TYPE ?>">
                            <div class="w-full flex flex-wrap  gap-2">
                                <div class="text-sm <?= $width_title_setting ?>">
                                    <span>
                                        Mức chi tiêu ăn uống hằng tháng (đ)
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <?= $sample->getTemplateLayoutsFor([
                                        'name_layouts' => 'input_default',
                                        'class_form' => '',
                                        'class' => 'input_price',
                                        'label' => 'Chi tiêu ăn uống hằng tháng',
                                        'placeholder' => 'Nhập Chi tiêu ăn uống hằng tháng ',
                                        'id' => 'chitieu_anuong_month',
                                        'data' => 'data[array][settings][number][chitieu_anuong_month]',
                                        'value' => (isset($data_info_setting['chitieu_anuong_month'])) ? htmlspecialchars_decode($data_info_setting['chitieu_anuong_month']) : "",
                                        'type' => 'text',
                                        'required' => false,
                                        'readonly' => false,
                                        'function' => '',
                                        'form' => false,
                                    ]); ?>
                                </div>
                            </div>
                            <div class="w-full flex flex-wrap  gap-2">
                                <div class="text-sm <?= $width_title_setting ?>">
                                    <span>
                                        Mức chi tiêu ăn uống hằng ngày (đ)
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <?= $sample->getTemplateLayoutsFor([
                                        'name_layouts' => 'input_default',
                                        'class_form' => '',
                                        'class' => 'input_price',
                                        'label' => 'chi tiêu ăn uống hằng ngày',
                                        'placeholder' => 'Nhập chi tiêu ăn uống hằng ngày ',
                                        'id' => 'chitieu_anuong_day',
                                        'data' => 'data[array][settings][number][chitieu_anuong_day]',
                                        'value' => (isset($data_info_setting['chitieu_anuong_day'])) ? htmlspecialchars_decode($data_info_setting['chitieu_anuong_day']) : "",
                                        'type' => 'text',
                                        'required' => false,
                                        'readonly' => false,
                                        'function' => '',
                                        'form' => false,
                                    ]); ?>
                                </div>
                            </div>
                            <div class="w-full flex flex-wrap  gap-2">
                                <div class="text-sm <?= $width_title_setting ?>">
                                    <span>
                                        Mức chi tiêu mua sắm hằng tháng (đ)
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <?= $sample->getTemplateLayoutsFor([
                                        'name_layouts' => 'input_default',
                                        'class_form' => '',
                                        'class' => 'input_price',
                                        'label' => 'chi tiêu mua sắm hằng tháng',
                                        'placeholder' => 'Nhập chi tiêu mua sắm hằng tháng ',
                                        'id' => 'chitieu_muasam_month',
                                        'data' => 'data[array][settings][number][chitieu_muasam_month]',
                                        'value' => (isset($data_info_setting['chitieu_muasam_month'])) ? htmlspecialchars_decode($data_info_setting['chitieu_muasam_month']) : "",
                                        'type' => 'text',
                                        'required' => false,
                                        'readonly' => false,
                                        'function' => '',
                                        'form' => false,
                                    ]); ?>
                                </div>
                            </div>
                            <div class="w-full flex flex-wrap  gap-2">
                                <div class="text-sm <?= $width_title_setting ?>">
                                    <span>
                                        Mức chi tiêu sinh hoạt hằng tháng (đ)
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <?= $sample->getTemplateLayoutsFor([
                                        'name_layouts' => 'input_default',
                                        'class_form' => '',
                                        'class' => 'input_price',
                                        'label' => 'chi tiêu sinh hoạt hằng tháng',
                                        'placeholder' => 'Nhập chi tiêu sinh hoạt hằng tháng ',
                                        'id' => 'chitieu_sinhhoat_month',
                                        'data' => 'data[array][settings][number][chitieu_sinhhoat_month]',
                                        'value' => (isset($data_info_setting['chitieu_sinhhoat_month'])) ? htmlspecialchars_decode($data_info_setting['chitieu_sinhhoat_month']) : "",
                                        'type' => 'text',
                                        'required' => false,
                                        'readonly' => false,
                                        'function' => '',
                                        'form' => false,
                                    ]); ?>
                                </div>
                            </div>
                            <div class="w-full flex flex-wrap  gap-2">
                                <div class="text-sm <?= $width_title_setting ?>">
                                    <span>
                                        Mức thu nhập cố định hằng tháng (đ)
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <?= $sample->getTemplateLayoutsFor([
                                        'name_layouts' => 'input_default',
                                        'class_form' => '',
                                        'class' => 'input_price',
                                        'label' => 'thu nhập cố định hằng tháng',
                                        'placeholder' => 'Nhập thu nhập cố định hằng tháng ',
                                        'id' => 'thunhap_codinh_month',
                                        'data' => 'data[array][settings][number][thunhap_codinh_month]',
                                        'value' => (isset($data_info_setting['thunhap_codinh_month'])) ? htmlspecialchars_decode($data_info_setting['thunhap_codinh_month']) : "",
                                        'type' => 'text',
                                        'required' => false,
                                        'readonly' => false,
                                        'function' => '',
                                        'form' => false,
                                    ]); ?>
                                </div>
                            </div>
                            <div class="w-full flex flex-wrap  gap-2">
                                <div class="text-sm <?= $width_title_setting ?>">
                                    <span>
                                        Mức tiết kiểm hằng tháng (đ)
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <?= $sample->getTemplateLayoutsFor([
                                        'name_layouts' => 'input_default',
                                        'class_form' => '',
                                        'class' => 'input_price',
                                        'label' => 'Mức tiết kiểm hằng tháng',
                                        'placeholder' => 'Nhập Mức tiết kiểm hằng tháng ',
                                        'id' => 'tietkiem_month',
                                        'data' => 'data[array][settings][number][tietkiem_month]',
                                        'value' => (isset($data_info_setting['tietkiem_month'])) ? htmlspecialchars_decode($data_info_setting['tietkiem_month']) : "",
                                        'type' => 'text',
                                        'required' => false,
                                        'readonly' => false,
                                        'function' => '',
                                        'form' => false,
                                    ]); ?>
                                </div>
                            </div>
                            <div class="w-full flex flex-wrap  gap-2">
                                <div class="text-sm <?= $width_title_setting ?>">
                                    <span>
                                        Mức chi tiêu lớn (đ)
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <?= $sample->getTemplateLayoutsFor([
                                        'name_layouts' => 'input_default',
                                        'class_form' => '',
                                        'class' => 'input_price',
                                        'label' => 'chi tiêu lớn',
                                        'placeholder' => 'Nhập chi tiêu lớn ',
                                        'id' => 'chitieulon',
                                        'data' => 'data[array][settings][number][chitieulon]',
                                        'value' => (isset($data_info_setting['chitieulon'])) ? htmlspecialchars_decode($data_info_setting['chitieulon']) : "",
                                        'type' => 'text',
                                        'required' => false,
                                        'readonly' => false,
                                        'function' => '',
                                        'form' => false,
                                    ]); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-[480px] content_admin text-base bg-white shadow-md shadow-gray-300 overflow-hidden rounded px-2 sm:px-4 py-4 sm:py-6">
                        <div>
                            <strong class="text-xl">
                                <?= "Mô tả cài đặt " . $data_setting['title'] ?>
                            </strong>
                        </div>
                        <div class="mt-7">
                            <p>
                                Việc cài đặt hệ thống quản lý ngân sách là bước quan trọng giúp doanh nghiệp hoặc cá nhân kiểm soát tài chính hiệu quả. Hệ thống này cho phép theo dõi thu nhập, chi phí, phân loại các khoản chi tiêu và lập kế hoạch tài chính rõ ràng.
                            </p>
                            <p>
                                Thông qua giao diện trực quan, người dùng có thể:
                            </p>
                            <ul>
                                <li>
                                    Thiết lập danh mục ngân sách: Xác định các khoản mục như lương, vận hành, quảng cáo, phát triển sản phẩm,...
                                </li>
                                <li>
                                    Theo dõi chi tiêu: Ghi nhận và phân tích từng giao dịch để đảm bảo không vượt quá ngân sách đã đề ra.
                                </li>
                                <li>
                                    Báo cáo & phân tích: Tạo báo cáo chi tiết theo tháng, quý hoặc năm để đánh giá hiệu suất tài chính và tối ưu chiến lược.
                                </li>
                                <li>
                                    Cảnh báo & nhắc nhở: Nhận thông báo khi ngân sách sắp chạm ngưỡng hoặc có biến động bất thường.
                                </li>
                            </ul>
                            <p>
                                Với một hệ thống quản lý ngân sách chuyên nghiệp, bạn không chỉ tiết kiệm thời gian mà còn đưa ra các quyết định tài chính sáng suốt, đảm bảo sự phát triển bền vững trong tương lai.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $sample->getTemplateLayoutsFor([
        'name_layouts' => 'handle_button_default_detail',
        'title' => $data_setting,
        'allow_back' => true,
        'allow_save' => true,
    ]) ?>
</form>