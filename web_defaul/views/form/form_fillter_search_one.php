<?php
$param = $func->getParamProducts([
    "type" => $type,
    "idl" => $idl,
    "idc" => null,
    "idi" => null,
    "ids" => null,
    "id" => null,
]);
if (!empty($param->brand)) {
    $brand = $cache->getCache("select id,ten_$lang as ten,photo from #_baiviet where type=? and id in ($param->brand) and hienthi=1 order by stt asc,id desc", array('thuong-hieu'), 'result', _TIMECACHE);
}
$array_param = [
    "product_type" => [
        "title" => "Loại Sản Phẩm",
    ],
    "technology" => [
        "title" => "Công Nghệ",
    ],
    "weight" => [
        "title" => "Trọng Lượng",
    ],
    "size" => [
        "title" => "Kích Thước",
    ],
    "capacity" => [
        "title" => "Dung tích",
    ],
    "power" => [
        "title" => "Công suất",
    ],
    "door" => [
        "title" => "Cửa",
    ],
];
?>
<div class=" form_filter_price" data-url="<?= $param->url ?>">
    <div class="flex flex-wrap gap-2">
        <div class="relative text-sm  h-9 transition-all duration-300 z-[35]">
            <div class="fixed hidden top-0 left-0 w-full h-full bg-black opacity-40 z-[-10] pointer-events-none data_filter_price " data-nb="filter_<?= "idl" . $idl . "idc" . $idc . "idi" . $idi . "ids" . $ids ?>"></div>
            <div class="cursor-pointer px-2 rounded relative inline-flex h-full w-full justify-center items-center leading-[0] gap-2 border border-[#DFDDDD] bg-white hover:border-[var(--html-bg-website)] [&.on]:border-[var(--html-bg-website)] transition-all duration-300 btn_filter_price z-10" data-nb="filter_<?= "idl" . $idl . "idc" . $idc . "idi" . $idi . "ids" . $ids ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                    <g clip-path="url(#clip0_68_935)">
                        <path d="M18.2841 2.77808H1.84644L8.4215 10.5531V15.9282L11.709 17.572V10.5531L18.2841 2.77808Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </g>
                </svg>
                <span class="leading-none">
                    Lọc
                </span>
            </div>
            <div class="absolute hidden top-full left-0 max-w-[calc(100vw-60px)] w-[900px] data_filter_price " data-nb="filter_<?= "idl" . $idl . "idc" . $idc . "idi" . $idi . "ids" . $ids ?>">
                <div class=" pl-4">
                    <div class="bg-white h-[10px] w-[15px] " style="clip-path: polygon(50% 0%,100% 100%,0% 100%);"></div>
                </div>
                <div class="rounded-md pb-3 pt-1 px-3 overflow-hidden bg-white shadow-md shadow-gray-300 border border-gray-100  ">
                    <div class="w-full ">
                        <div class="w-full flex justify-end">
                            <div class="cursor-pointer btn_filter_price inline-flex justify-center items-center leading-[0] w-6 aspect-[1/1]" data-nb="filter_<?= "idl" . $idl . "idc" . $idc . "idi" . $idi . "ids" . $ids ?>">
                                <span>
                                    <i class="fas fa-times text-xl font-medium text-gray-600"></i>
                                </span>
                            </div>
                        </div>
                        <div class=" flex flex-wrap max-h-[clamp(250px,40vw,400px)] scroll-y overflow-y-auto overflow-x-hidden ">
                            <div class="w-full">
                                <div class="text-sm font-bold font-main-700">
                                    <span>Thương hiệu</span>
                                </div>
                            </div>
                            <?php if (!empty($brand)) { ?>
                                <div class="mt-3 flex flex-wrap gap-3">
                                    <?php foreach ($brand as $key_brand => $value_brand) { ?>
                                        <label class="relative  border border-[#DFDDDD] bg-[#F3F3F3] rounded has-[:checked]:border-[var(--html-bg-website)]  overflow-hidden h-9 aspect-[83/35] transition-all duration-300">
                                            <input type="checkbox" name="brand" id="" value="<?= $value_brand['id'] ?>" class="pointer-events-auto cursor-pointer opacity-0 absolute top-0 left-0 w-full h-full" <?= (in_array($value_brand['id'], explode(',', $array_param_value['brand']))) ? "checked" : "" ?>>
                                            <?= $func->addHrefImg([
                                                'classfix' => "pointer-events-none",
                                                'addhref' => false,
                                                'sizes' => '83x35x2',
                                                'actual_width' => 400,
                                                'upload' => _upload_baiviet_l,
                                                'image' => $value_brand["photo"],
                                                'alt' => $value_brand["ten"],
                                            ]); ?>
                                        </label>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <div class="w-full mt-3 border-t border-gray-200">
                                <div class="mt-3 text-sm font-bold font-main-700">
                                    <span>Khoảng Giá</span>
                                </div>
                            </div>
                            <div class="form_price_range w-full mt-3 flex flex-wrap gap-3 pr-1 form">
                                <div class="flex items-center gap-2">
                                    <input type="text" name="min_price" value="<?= $array_param_value['min_price'] ?>" placeholder="Từ" class="input_price pointer-events-none border px-2 py-1 w-[120px]">
                                    <div class="">
                                        <span>-</span>
                                    </div>
                                    <input type="text" name="max_price" value="<?= $array_param_value['max_price'] ?>" placeholder="Đến" class="input_price  pointer-events-none border px-2 py-1 w-[120px]">
                                </div>
                                <div class="w-full">
                                    <div class="price_range w-full max-w-[420px]"></div>
                                </div>
                            </div>
                            <div class="w-full mt-3 border-t border-gray-200">
                                <div class="mt-3 w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                                    <?php foreach ($array_param as $key_param => $value_param) { ?>
                                        <?php if (!empty($param->$key_param)) { ?>
                                            <div class="w-full">
                                                <div class="text-sm font-bold font-main-700">
                                                    <span>
                                                        <?= $value_param['title'] ?>
                                                    </span>
                                                </div>
                                                <div class="mt-3 w-full">
                                                    <div class="flex flex-wrap gap-2">
                                                        <?php foreach ($param->$key_param as $value_items_param) { ?>
                                                            <label class="relative  border border-[#DFDDDD] bg-white rounded has-[:checked]:border-[var(--html-bg-website)] has-[:checked]:text-[var(--html-bg-website)] overflow-hidden  py-1 px-2 inline-flex justify-center items-center  transition-all duration-300">
                                                                <input type="checkbox" name="<?= $key_param ?>" id="" value="<?= $value_items_param ?>" class="pointer-events-auto cursor-pointer opacity-0 absolute top-0 left-0 w-full h-full" <?= (in_array($value_items_param, explode(',', $array_param_value[$key_param]))) ? "checked" : "" ?>>
                                                                <span>
                                                                    <?= $value_items_param ?>
                                                                </span>
                                                            </label>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="h-2 w-full"></div>
                        </div>
                        <div class="flex justify-center items-center pt-2">
                            <div class="button_filter_price cursor-pointer h-10 px-6 rounded-md bg-[var(--html-bg-website)] text-base inline-flex justify-center items-center leading-none font-bold font-main-700 text-white hover:brightness-110 transition-all duration-300">
                                <span class="text_filter_search">Xem Kết Quả</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (!empty($brand)) { ?>
            <?php foreach ($brand as $key_brand => $value_brand) { ?>
                <div class="border border-[#DFDDDD] bg-[#F3F3F3] rounded hover:border-[var(--html-bg-website)] overflow-hidden h-9 aspect-[83/35] transition-all duration-300">
                    <?= $func->addHrefImg([
                        'classfix' => "",
                        'addhref' => true,
                        'href' =>  $func->addOrUpdateUrlParam($func->getCurrentUrl(), $param->url, "brand", $value_brand['id']),
                        'sizes' => '83x35x2',
                        'actual_width' => 400,
                        'upload' => _upload_baiviet_l,
                        'image' => $value_brand["photo"],
                        'alt' => $value_brand["ten"],
                    ]); ?>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
    <div class="mt-4 sm:mt-6">
        <div class="w-full text-nowrap flex flex-wrap items-start gap-4 sm:gap-6 text-sm sm:text-base leading-none font-medium font-main-500">
            <div class="flex-initial basis-full sm:basis-auto">
                <span>
                    Sắp xếp theo:
                </span>
            </div>
            <div class=" flex-1 flex flex-wrap items-center justify-start gap-3 sm:gap-7 ">
                <a href="<?= $func->addOrUpdateUrlParam($func->getCurrentUrl(), $param->url, "status", 1) ?>" title="Nổi bật" class=" <?= ($array_param_value['status'] == 1) ? "active" : "" ?> hover:text-[var(--html-bg-website)] [&.active]:text-[var(--html-bg-website)]  transition-all duration-300 inline-block">
                    Nổi bật
                </a>
                <a href="<?= $func->addOrUpdateUrlParam($func->getCurrentUrl(), $param->url, "status", 2) ?>" title="Bán chạy" class=" <?= ($array_param_value['status'] == 2) ? "active" : "" ?> hover:text-[var(--html-bg-website)] [&.active]:text-[var(--html-bg-website)] transition-all duration-300 inline-block">
                    Bán chạy
                </a>
                <a href="<?= $func->addOrUpdateUrlParam($func->getCurrentUrl(), $param->url, "status", 3) ?>" title="Giảm giá" class=" <?= ($array_param_value['status'] == 3) ? "active" : "" ?> hover:text-[var(--html-bg-website)] [&.active]:text-[var(--html-bg-website)] transition-all duration-300 inline-block">
                    Giảm giá
                </a>
                <a href="<?= $func->addOrUpdateUrlParam($func->getCurrentUrl(), $param->url, "status", 4) ?>" title="Mới" class=" <?= ($array_param_value['status'] == 4) ? "active" : "" ?> hover:text-[var(--html-bg-website)] [&.active]:text-[var(--html-bg-website)] transition-all duration-300 inline-block">
                    Mới
                </a>
                <div class="relative  cursor-pointer inline-block z-30">
                    <div class="inline-flex gap-1 items-center justify-center  <?= (($array_param_value['status'] == 5) || ($array_param_value['status'] == 6)) ? "active" : "" ?> hover:text-[var(--html-bg-website)] [&.active]:text-[var(--html-bg-website)] transition-all duration-300 btn_filter_price " data-nb="price_filter_<?= "idl" . $idl . "idc" . $idc . "idi" . $idi . "ids" . $ids ?>">
                        <span>Giá</span>
                        <i class="fas fa-chevron-down font-medium text-xs"></i>
                    </div>
                    <div class="hidden absolute top-full right-0 px-3 py-2 rounded-md bg-white border border-gray-200 shadow shadow-gray-200 z-10 data_filter_price" data-nb="price_filter_<?= "idl" . $idl . "idc" . $idc . "idi" . $idi . "ids" . $ids ?>">
                        <div class="flex flex-wrap gap-3 text-nowrap">
                            <a href="<?= $func->addOrUpdateUrlParam($func->getCurrentUrl(), $param->url, "status", 5) ?>" title="Giá giảm dần" class="w-full <?= ($array_param_value['status'] == 5) ? "active" : "" ?> hover:text-[var(--html-bg-website)] [&.active]:text-[var(--html-bg-website)] transition-all duration-300 inline-block">
                                Giá giảm dần
                            </a>
                            <a href="<?= $func->addOrUpdateUrlParam($func->getCurrentUrl(), $param->url, "status", 6) ?>" title="Giá tăng dần" class="w-full <?= ($array_param_value['status'] == 6) ? "active" : "" ?> hover:text-[var(--html-bg-website)] [&.active]:text-[var(--html-bg-website)] transition-all duration-300 inline-block">
                                Giá tăng dần
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>