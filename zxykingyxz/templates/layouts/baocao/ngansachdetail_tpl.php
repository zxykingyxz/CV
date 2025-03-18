<?php
$data_content = json_decode($data_detail['contents'], true);
$class_title_info_detail = "text-[13px]";
$class_info_detail = "text-sm";

?>
<form method="POST" action="<?= $func->getUrlParam(['com' => $_COM, 'src' => $_SRC, 'type' => $_TYPE, 'act' => "save", "id" => (int)htmlspecialchars($_GET['id']), "page" => $array_param_value['page']]) ?>" name="form-detail" class="w-full flex-1 flex flex-wrap flex-col" enctype="multipart/form-data" autocomplete="off" accept-charset="utf-8">
    <div class="py-4 px-3 sm:px-5 w-full h-[inherit] flex-1">
        <div class="w-full flex flex-wrap gap-3">
            <?= $sample->getTemplateLayoutsFor([
                'name_layouts' => 'breadcrumbs',
                'title' => $data_setting['title'],
            ]) ?>
            <div class="w-full flex flex-wrap gap-3">
                <div class="flex-initial w-full sm:w-[50%] md:w-[60%] lg:w-[70%] bg-white shadow-md shadow-gray-300 overflow-hidden rounded px-2 sm:px-4 py-8 sm:py-12">
                    <div class="text-xl sm:text-2xl font-bold capitalize text-center text-red-500">
                        <span>
                            <?= $data_detail['title'] ?>
                        </span>
                    </div>
                    <div class="mt-4 w-full">
                        <?php if (!empty($data_content['chitieulon'])) { ?>
                            <div class="mt-6">
                                <div class="text-base sm:text-lg font-semibold ">
                                    <span>
                                        <?= "1) Các khoản chi tiểu lớn trong tháng" ?>
                                    </span>
                                </div>
                                <div class="mt-4 w-full overflow-auto scroll-design-one  ">
                                    <table class="w-full min-w-[500px] border-collapse border border-gray-200 shadow-md ">
                                        <thead class="">
                                            <tr class="<?= $class_title_table_default ?> ">
                                                <th class="<?= $padding_th_table_default ?> text-center w-[10px] text-nowrap">#</th>
                                                <th class="<?= $padding_th_table_default ?> text-left ">Tiêu Đề</th>
                                                <th class="<?= $padding_th_table_default ?> text-left w-[10px] text-nowrap">Giá</th>
                                                <th class="<?= $padding_th_table_default ?> text-left w-[10px] text-nowrap">Loại Chi Tiêu</th>
                                                <th class="<?= $padding_th_table_default ?> text-left w-[10px] text-nowrap">Ngày Chi Tiêu</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200" id="table_body">
                                            <?php foreach ($data_content['chitieulon'] as $key => $value) { ?>
                                                <tr class="even:bg-gray-50 hover:bg-gray-100">
                                                    <td class="<?= $padding_td_table_default ?> text-center">
                                                        <?= $key + 1 ?>
                                                    </td>
                                                    <td class="<?= $padding_td_table_default ?>">
                                                        <a href="<?= $jv0 ?>" title="<?= $value['title'] ?>" class="w-full h-full">
                                                            <?= $value['title'] ?>
                                                        </a>
                                                    </td>
                                                    <td class="<?= $padding_td_table_default ?>">
                                                        <span class="text-nowrap text-red-600 font-bold">
                                                            <?= $func->formatMoney($value['price'], "đ") ?>
                                                        </span>
                                                    </td>
                                                    <td class="<?= $padding_td_table_default ?>">
                                                        <span class="text-nowrap ">
                                                            <?= $func->getTypeDataConfig("chi-tieu", $value['loai'])['title'] ?>
                                                        </span>
                                                    </td>
                                                    <td class="<?= $padding_td_table_default ?>">
                                                        <span class="text-nowrap">
                                                            <?= date("d/m/Y", $value['date']) ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (!empty($data_content['thunhap'])) { ?>
                            <div class="mt-6">
                                <div class="text-base sm:text-lg font-semibold ">
                                    <span>
                                        <?= "2) Các khoản thu nhập trong tháng" ?>
                                    </span>
                                </div>
                                <div class="mt-4 w-full overflow-auto scroll-design-one  ">
                                    <table class="w-full min-w-[500px] border-collapse border border-gray-200 shadow-md ">
                                        <thead class="">
                                            <tr class="<?= $class_title_table_default ?> ">
                                                <th class="<?= $padding_th_table_default ?> text-center w-[10px] text-nowrap">#</th>
                                                <th class="<?= $padding_th_table_default ?> text-left ">Tiêu Đề</th>
                                                <th class="<?= $padding_th_table_default ?> text-left w-[10px] text-nowrap">Giá</th>
                                                <th class="<?= $padding_th_table_default ?> text-left w-[10px] text-nowrap">Loại Nhận</th>
                                                <th class="<?= $padding_th_table_default ?> text-left w-[10px] text-nowrap">Ngày Nhận</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200" id="table_body">
                                            <?php foreach ($data_content['thunhap'] as $key => $value) { ?>
                                                <tr class="even:bg-gray-50 hover:bg-gray-100">
                                                    <td class="<?= $padding_td_table_default ?> text-center">
                                                        <?= $key + 1 ?>
                                                    </td>
                                                    <td class="<?= $padding_td_table_default ?>">
                                                        <a href="<?= $jv0 ?>" title="<?= $value['title'] ?>" class="w-full h-full">
                                                            <?= $value['title'] ?>
                                                        </a>
                                                    </td>
                                                    <td class="<?= $padding_td_table_default ?>">
                                                        <span class="text-nowrap text-red-600 font-bold">
                                                            <?= $func->formatMoney($value['price'], "đ") ?>
                                                        </span>
                                                    </td>
                                                    <td class="<?= $padding_td_table_default ?>">
                                                        <span class="text-nowrap ">
                                                            <?= $func->getTypeDataConfig("thu-nhap", $value['loai'])['title'] ?>
                                                        </span>
                                                    </td>
                                                    <td class="<?= $padding_td_table_default ?>">
                                                        <span class="text-nowrap">
                                                            <?= date("d/m/Y", $value['date']) ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="flex-1 h-[inherit] bg-white shadow-md shadow-gray-300 overflow-hidden rounded px-3 py-6">
                    <div class="text-2xl font-semibold text-center">
                        <span>
                            Tổng Kết Báo Cáo
                        </span>
                    </div>
                    <div class="grid grid-cols-1 mt-6 gap-3">
                        <div class="w-full grid grid-cols-2 gap-2 <?= $class_title_info_detail ?> text-blue-500">
                            <div class="w-full ">
                                <span>
                                    Chi Tiêu Ăn Uống Định Mức Ngày
                                </span>
                            </div>
                            <div class="w-full <?= $class_info_detail ?> font-bold ">
                                <span class="text-nowrap">
                                    <?= $func->formatMoney($data_content['chitieuanuongngaydinhmuc'], "đ") ?>
                                </span>
                            </div>
                        </div>
                        <div class="w-full grid grid-cols-2 gap-2 <?= $class_title_info_detail ?> text-blue-500">
                            <div class="w-full ">
                                <span>
                                    Chi Tiêu Ăn Uống Định Mức Tháng
                                </span>
                            </div>
                            <div class="w-full <?= $class_info_detail ?> font-bold ">
                                <span class="text-nowrap">
                                    <?= $func->formatMoney($data_content['chitieuanuongthangdinhmuc'], "đ") ?>
                                </span>
                            </div>
                        </div>
                        <div class="w-full grid grid-cols-2 gap-2 <?= $class_title_info_detail ?>">
                            <div class="w-full ">
                                <span>
                                    Chi Tiêu Ăn Uống Tháng
                                </span>
                            </div>
                            <div class="w-full <?= $class_info_detail ?> font-bold ">
                                <span class="text-nowrap">
                                    <?= $func->formatMoney($data_content['chitieuanuongthang'], "đ") ?>
                                </span>
                                <?php if (!empty($data_content['chitieuanuongthangdinhmuc'])) { ?>
                                    <span class="text-nowrap <?= ($data_content['chitieuanuongthang'] <= $data_content['chitieuanuongthangdinhmuc']) ? "text-green-500" : "text-red-500" ?>">
                                        <?= "(" . (int)(($data_content['chitieuanuongthang'] / $data_content['chitieuanuongthangdinhmuc']) * 100) . "%)" ?>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="w-full grid grid-cols-2 gap-2 <?= $class_title_info_detail ?> text-blue-500">
                            <div class="w-full ">
                                <span>
                                    Chi Tiêu Mua Sắm Định Mức Tháng
                                </span>
                            </div>
                            <div class="w-full <?= $class_info_detail ?> font-bold ">
                                <span class="text-nowrap">
                                    <?= $func->formatMoney($data_content['chitieumuasamthangdinhmuc'], "đ") ?>
                                </span>
                            </div>
                        </div>
                        <div class="w-full grid grid-cols-2 gap-2 <?= $class_title_info_detail ?>">
                            <div class="w-full ">
                                <span>
                                    Chi Tiêu Mua Sắm Tháng
                                </span>
                            </div>
                            <div class="w-full <?= $class_info_detail ?> font-bold ">
                                <span class="text-nowrap">
                                    <?= $func->formatMoney($data_content['chitieumuasamthang'], "đ") ?>
                                </span>
                                <?php if (!empty($data_content['chitieumuasamthangdinhmuc'])) { ?>
                                    <span class="text-nowrap <?= ($data_content['chitieumuasamthang'] <= $data_content['chitieumuasamthangdinhmuc']) ? "text-green-500" : "text-red-500" ?>">
                                        <?= "(" . (int)(($data_content['chitieumuasamthang'] / $data_content['chitieumuasamthangdinhmuc']) * 100) . "%)" ?>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="w-full grid grid-cols-2 gap-2 <?= $class_title_info_detail ?> text-blue-500">
                            <div class="w-full ">
                                <span>
                                    Chi Tiêu Sinh Hoạt Định Mức Tháng
                                </span>
                            </div>
                            <div class="w-full <?= $class_info_detail ?> font-bold ">
                                <span class="text-nowrap">
                                    <?= $func->formatMoney($data_content['chitieusinhhoatthangdinhmuc'], "đ") ?>
                                </span>
                            </div>
                        </div>
                        <div class="w-full grid grid-cols-2 gap-2 <?= $class_title_info_detail ?>">
                            <div class="w-full ">
                                <span>
                                    Chi Tiêu Sinh Hoạt Tháng
                                </span>
                            </div>
                            <div class="w-full <?= $class_info_detail ?> font-bold ">
                                <span class="text-nowrap">
                                    <?= $func->formatMoney($data_content['chitieusinhhoatthang'], "đ") ?>
                                </span>
                                <?php if (!empty($data_content['chitieusinhhoatthangdinhmuc'])) { ?>
                                    <span class="text-nowrap <?= ($data_content['chitieusinhhoatthang'] <= $data_content['chitieusinhhoatthangdinhmuc']) ? "text-green-500" : "text-red-500" ?>">
                                        <?= "(" . (int)(($data_content['chitieusinhhoatthang'] / $data_content['chitieusinhhoatthangdinhmuc']) * 100) . "%)" ?>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="w-full grid grid-cols-2 gap-2 <?= $class_title_info_detail ?>">
                            <div class="w-full ">
                                <span>
                                    Chi Tiêu Gia Đình Tháng
                                </span>
                            </div>
                            <div class="w-full <?= $class_info_detail ?> font-bold ">
                                <span class="text-nowrap">
                                    <?= $func->formatMoney($data_content['chitieugiadinhthang'], "đ") ?>
                                </span>
                            </div>
                        </div>
                        <div class="w-full grid grid-cols-2 gap-2 <?= $class_title_info_detail ?>">
                            <div class="w-full ">
                                <span>
                                    Chi Tiêu Tài Chính Tháng
                                </span>
                            </div>
                            <div class="w-full <?= $class_info_detail ?> font-bold ">
                                <span class="text-nowrap">
                                    <?= $func->formatMoney($data_content['chitieutaichinhthang'], "đ") ?>
                                </span>
                            </div>
                        </div>
                        <div class="w-full grid grid-cols-2 gap-2 <?= $class_title_info_detail ?>">
                            <div class="w-full ">
                                <span>
                                    Chi Tiêu Kinh Doanh Tháng
                                </span>
                            </div>
                            <div class="w-full <?= $class_info_detail ?> font-bold ">
                                <span class="text-nowrap">
                                    <?= $func->formatMoney($data_content['chitieukinhdoanhthang'], "đ") ?>
                                </span>
                            </div>
                        </div>
                        <div class="w-full grid grid-cols-2 gap-2 <?= $class_title_info_detail ?>">
                            <div class="w-full ">
                                <span>
                                    Chi Tiêu Sức Khỏe Tháng
                                </span>
                            </div>
                            <div class="w-full <?= $class_info_detail ?> font-bold ">
                                <span class="text-nowrap">
                                    <?= $func->formatMoney($data_content['chitieusuckhoethang'], "đ") ?>
                                </span>
                            </div>
                        </div>
                        <div class="w-full grid grid-cols-2 gap-2 <?= $class_title_info_detail ?>">
                            <div class="w-full ">
                                <span>
                                    Chi Tiêu Bảo Dưỡng Tháng
                                </span>
                            </div>
                            <div class="w-full <?= $class_info_detail ?> font-bold ">
                                <span class="text-nowrap">
                                    <?= $func->formatMoney($data_content['chitieubaoduongthang'], "đ") ?>
                                </span>
                            </div>
                        </div>
                        <div class="w-full grid grid-cols-2 gap-2 <?= $class_title_info_detail ?>">
                            <div class="w-full ">
                                <span>
                                    Chi Tiêu Khác Tháng
                                </span>
                            </div>
                            <div class="w-full <?= $class_info_detail ?> font-bold ">
                                <span class="text-nowrap">
                                    <?= $func->formatMoney($data_content['chitieukhacthang'], "đ") ?>
                                </span>
                            </div>
                        </div>
                        <div class="w-full grid grid-cols-2 gap-2 <?= $class_title_info_detail ?>">
                            <div class="w-full ">
                                <span>
                                    Thu Nhập Chính Tháng
                                </span>
                            </div>
                            <div class="w-full <?= $class_info_detail ?> font-bold ">
                                <span class="text-nowrap">
                                    <?= $func->formatMoney($data_content['thunhapchinhthang'], "đ") ?>
                                </span>
                            </div>
                        </div>
                        <div class="w-full grid grid-cols-2 gap-2 <?= $class_title_info_detail ?>">
                            <div class="w-full ">
                                <span>
                                    Thu Nhập Phụ Tháng
                                </span>
                            </div>
                            <div class="w-full <?= $class_info_detail ?> font-bold ">
                                <span class="text-nowrap">
                                    <?= $func->formatMoney($data_content['thunhapphuthang'], "đ") ?>
                                </span>
                            </div>
                        </div>
                        <div class="w-full grid grid-cols-2 gap-2 <?= $class_title_info_detail ?>">
                            <div class="w-full ">
                                <span>
                                    Thu Nhập Đầu Tư Tháng
                                </span>
                            </div>
                            <div class="w-full <?= $class_info_detail ?> font-bold ">
                                <span class="text-nowrap">
                                    <?= $func->formatMoney($data_content['thunhapdaututhang'], "đ") ?>
                                </span>
                            </div>
                        </div>
                        <div class="w-full grid grid-cols-2 gap-2 <?= $class_title_info_detail ?>">
                            <div class="w-full ">
                                <span>
                                    Thu Nhập Thụ Động Tháng
                                </span>
                            </div>
                            <div class="w-full <?= $class_info_detail ?> font-bold ">
                                <span class="text-nowrap">
                                    <?= $func->formatMoney($data_content['thunhapthudongthang'], "đ") ?>
                                </span>
                            </div>
                        </div>
                        <div class="w-full grid grid-cols-2 gap-2 <?= $class_title_info_detail ?>">
                            <div class="w-full ">
                                <span>
                                    Thu Nhập Khác Tháng
                                </span>
                            </div>
                            <div class="w-full <?= $class_info_detail ?> font-bold ">
                                <span class="text-nowrap">
                                    <?= $func->formatMoney($data_content['thunhapkhacthang'], "đ") ?>
                                </span>
                            </div>
                        </div>
                        <div class="w-full grid grid-cols-2 gap-2 <?= $class_title_info_detail ?> text-blue-500">
                            <div class="w-full ">
                                <span>
                                    Thu Nhập Định Mức Tháng
                                </span>
                            </div>
                            <div class="w-full <?= $class_info_detail ?> font-bold ">
                                <span class="text-nowrap">
                                    <?= $func->formatMoney($data_content['thunhapdinhmuc'], "đ") ?>
                                </span>
                            </div>
                        </div>
                        <div class="w-full grid grid-cols-2 gap-2 <?= $class_title_info_detail ?> text-blue-500">
                            <div class="w-full ">
                                <span>
                                    Tiết Kiệm Định Mức Tháng
                                </span>
                            </div>
                            <div class="w-full <?= $class_info_detail ?> font-bold ">
                                <span class="text-nowrap">
                                    <?= $func->formatMoney($data_content['tietkiemthangdinhmuc'], "đ") ?>
                                </span>
                            </div>
                        </div>
                        <div class="w-full grid grid-cols-2 gap-2 <?= $class_title_info_detail ?>">
                            <div class="w-full ">
                                <span>
                                    Thu Nhập Tháng
                                </span>
                            </div>
                            <div class="w-full <?= $class_info_detail ?> font-bold ">
                                <span class="text-nowrap">
                                    <?= $func->formatMoney($data_content['thunhapthang'], "đ") ?>
                                </span>
                                <?php if (!empty($data_content['thunhapdinhmuc'])) { ?>
                                    <span class="text-nowrap <?= ($data_content['thunhapthang'] <= $data_content['thunhapdinhmuc']) ? "text-red-500" : "text-green-500" ?>">
                                        <?= "(" . (int)(($data_content['thunhapthang'] / $data_content['thunhapdinhmuc']) * 100) . "%)" ?>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="w-full grid grid-cols-2 gap-2 <?= $class_title_info_detail ?>">
                            <div class="w-full ">
                                <span>
                                    Chi Tiêu Tháng
                                </span>
                            </div>
                            <div class="w-full <?= $class_info_detail ?> font-bold ">
                                <span class="text-nowrap">
                                    <?= $func->formatMoney($data_content['chitieuthang'], "đ") ?>
                                </span>
                            </div>
                        </div>
                        <?php
                        $price_save = $data_content['thunhapthang'] - $data_content['chitieuthang'];
                        ?>
                        <div class="w-full grid grid-cols-2 gap-2 <?= $class_title_info_detail ?>">
                            <div class="w-full ">
                                <span>
                                    Tiền Tiết Kiệm Trong Tháng
                                </span>
                            </div>
                            <div class="w-full <?= $class_info_detail ?> font-bold ">
                                <span class="text-nowrap">
                                    <?= $func->formatMoney($price_save, "đ") ?>
                                </span>
                                <?php if (!empty($data_content['tietkiemthangdinhmuc'])) { ?>
                                    <span class="text-nowrap <?= ($price_save >= $data_content['tietkiemthangdinhmuc']) ? "text-green-500" : (($price_save > 0) ? "text-yellow-500" : "text-red-500") ?>">
                                        <?= "(" . (int)(($price_save / $data_content['tietkiemthangdinhmuc']) * 100) . "%)" ?>
                                    </span>
                                <?php } ?>
                            </div>
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
    ]) ?>
</form>