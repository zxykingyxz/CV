<?php
$width_info = "w-4/12"
?>
<section class="mt-5 mb-7">
    <div class="grid_s wide">
        <div class="bg_form_all">
            <div class="flex justify-center items-center text-center ">
                <?= $func->getTemplateLayoutsFor([
                    'name_layouts' => 'titleSeo',
                    'title' => $titleContainer,
                    'class' => 'title-container mb-5',
                    'banner_tpl' => $banner_tpl,
                ]); ?>
            </div>
            <div class="">
                <?php if (!empty($order)) { ?>
                    <div class="grid grid-cols-1  gap-5">
                        <?php foreach ($order as $key => $value) {
                            $order_detail = $db->rawQuery("select * from #_order_detail where id_order=?  ", array($value['id']));
                        ?>
                            <div>
                                <div class="mb-3">
                                    <span class="text-xl font-bold font-main-700 text-black">
                                        <?= "Mã Đơn Hàng: " . $value['code'] ?>
                                    </span>
                                </div>
                                <div class=" flex flex-wrap   w-full bg-white border border-gray-300">
                                    <div class="basis-full md:basis-5/12 px-3 py-4 flex-initial">
                                        <div class=" mb-3">
                                            <span class="text-base font-bold font-main-700 text-black">
                                                Thông tin đơn hàng
                                            </span>
                                        </div>
                                        <div class="grid grid-cols-1 gap-2">
                                            <?php if (!empty($value['fullname'])) {  ?>
                                                <div class="flex flex-wrap gap-2 text-sm">
                                                    <div class="<?= $width_info ?> ">
                                                        <span class="font-bold font-main-700">
                                                            Tên khách hàng
                                                        </span>
                                                    </div>
                                                    <div class="flex-1">
                                                        <span>
                                                            <?= $value['fullname'] ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php if (!empty($value['email'])) {  ?>
                                                <div class="flex flex-wrap gap-2 text-sm">
                                                    <div class="<?= $width_info ?> ">
                                                        <span class="font-bold font-main-700">
                                                            Email
                                                        </span>
                                                    </div>
                                                    <div class="flex-1">
                                                        <span>
                                                            <?= $value['email'] ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php if (!empty($value['phone'])) {  ?>
                                                <div class="flex flex-wrap gap-2 text-sm">
                                                    <div class="<?= $width_info ?> ">
                                                        <span class="font-bold font-main-700">
                                                            Số điện thoại
                                                        </span>
                                                    </div>
                                                    <div class="flex-1">
                                                        <span>
                                                            <?= $value['phone'] ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php if (!empty($value['id_city'])) {
                                                $city = $db->rawQueryOne("select name_$lang as name from #_place_citys where id=?  ", array($value['id_city']));
                                            ?>
                                                <div class="flex flex-wrap gap-2 text-sm">
                                                    <div class="<?= $width_info ?> ">
                                                        <span class="font-bold font-main-700">
                                                            Tỉnh Thành
                                                        </span>
                                                    </div>
                                                    <div class="flex-1">
                                                        <span>
                                                            <?= $city['name'] ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php if (!empty($value['id_dist'])) {
                                                $dists = $db->rawQueryOne("select name_$lang as name from #_place_dists where id=?  ", array($value['id_dist']));
                                            ?>
                                                <div class="flex flex-wrap gap-2 text-sm">
                                                    <div class="<?= $width_info ?> ">
                                                        <span class="font-bold font-main-700">
                                                            Quận Huyện
                                                        </span>
                                                    </div>
                                                    <div class="flex-1">
                                                        <span>
                                                            <?= $dists['name'] ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php if (!empty($value['address'])) {  ?>
                                                <div class="flex flex-wrap gap-2 text-sm">
                                                    <div class="<?= $width_info ?> ">
                                                        <span class="font-bold font-main-700">
                                                            Địa chỉ
                                                        </span>
                                                    </div>
                                                    <div class="flex-1">
                                                        <span>
                                                            <?= $value['address'] ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php if (!empty($value['payment'])) {
                                                $payment = $db->rawQueryOne("select ten_$lang as ten from #_baiviet where id=?  ", array($value['payment']));
                                            ?>
                                                <div class="flex flex-wrap gap-2 text-sm">
                                                    <div class="<?= $width_info ?> ">
                                                        <span class="font-bold font-main-700">
                                                            Pay
                                                        </span>
                                                    </div>
                                                    <div class="flex-1">
                                                        <span>
                                                            <?= $payment['ten'] ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php if (!empty($value['payship'])) {
                                                $payship = $db->rawQueryOne("select ten_$lang as ten from #_baiviet where id=?  ", array($value['payship']));
                                            ?>
                                                <div class="flex flex-wrap gap-2 text-sm">
                                                    <div class="<?= $width_info ?> ">
                                                        <span class="font-bold font-main-700">
                                                            Ship
                                                        </span>
                                                    </div>
                                                    <div class="flex-1">
                                                        <span>
                                                            <?= $payship['ten'] ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php if (!empty($value['createdAt'])) {  ?>
                                                <div class="flex flex-wrap gap-2 text-sm">
                                                    <div class="<?= $width_info ?> ">
                                                        <span class="font-bold font-main-700">
                                                            Ngày đặt
                                                        </span>
                                                    </div>
                                                    <div class="flex-1">
                                                        <span>
                                                            <?= preg_replace("/-/", "/", $value['createdAt']) ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php if (!empty($value['total_price_tmp'])) {  ?>
                                                <div class="flex flex-wrap gap-2 text-sm">
                                                    <div class="<?= $width_info ?> ">
                                                        <span class="font-bold font-main-700">
                                                            Tạm tính
                                                        </span>
                                                    </div>
                                                    <div class="flex-1">
                                                        <span>
                                                            <?= $func->money($value['total_price_tmp'], "đ") ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php if (!empty($value['total_price'])) {  ?>
                                                <div class="flex flex-wrap gap-2 text-sm">
                                                    <div class="<?= $width_info ?> ">
                                                        <span class="font-bold font-main-700">
                                                            Thành tiền
                                                        </span>
                                                    </div>
                                                    <div class="flex-1">
                                                        <span>
                                                            <?= $func->money($value['total_price'], "đ") ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php if (!empty($value['order_status'])) {  ?>
                                                <div class="flex flex-wrap gap-2 text-sm">
                                                    <div class="<?= $width_info ?> ">
                                                        <span class="font-bold font-main-700">
                                                            Trạng thái
                                                        </span>
                                                    </div>
                                                    <div class="flex-1">
                                                        <span>
                                                            <?php switch ($value['order_status']) {
                                                                case 1:
                                                                    echo "Chờ Xác Nhận";
                                                                    break;
                                                                case 2:
                                                                    echo "Đã Hoàn Thành";
                                                                    break;
                                                                case 3:
                                                                    echo "Đã Hủy";
                                                                    break;
                                                                default:
                                                                    break;
                                                            } ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php if (!empty($value['notes'])) {  ?>
                                                <div class="flex flex-wrap gap-2 text-sm">
                                                    <div class="<?= $width_info ?> ">
                                                        <span class="font-bold font-main-700">
                                                            Ghi Chú
                                                        </span>
                                                    </div>
                                                    <div class="flex-1">
                                                        <span>
                                                            <?= $value['notes'] ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="flex-1 ">
                                        <div class="w-full h-full bg-gray-100   content-start">
                                            <?php foreach ($order_detail as $key_detail => $value_detail) { ?>
                                                <div class="flex w-full items-center gap-2 p-2  border-b border-gray-300 ">
                                                    <div class="w-[50px] bg-white leading-[0] ">
                                                        <?= $func->addHrefImg([
                                                            'addhref' => false,
                                                            'sizes' => '600x600x2',
                                                            'upload' => _upload_baiviet_l,
                                                            'image' => ($value_detail["photo"]),
                                                            'alt' =>  $value_detail["name"],
                                                        ]); ?>
                                                    </div>
                                                    <div class="flex-1 flex flex-wrap items-center gap-2 ">
                                                        <div class="flex-1">
                                                            <span class="text-sm font-medium font-main-500">
                                                                <?= $value_detail["name"] ?>
                                                            </span>
                                                        </div>
                                                        <div class="w-full md:w-[130px] ">
                                                            <span class="text-sm font-bold font-main-700 text-red-500">
                                                                <?= $func->money($value_detail["price"], "đ") . "(x" . $value_detail["qty"] . ")" ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } else { ?>
                    <div class="h-[100px] text-center flex flex-col flex-wrap gap-3 justify-center items-center">
                        <svg width="50" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 93 87">
                            <defs>
                                <rect id="defaultpage_nodata-a" width="45" height="33" x="44" y="32" rx="2"></rect>
                                <mask id="defaultpage_nodata-b" width="45" height="33" x="0" y="0" fill="#fff" maskContentUnits="userSpaceOnUse" maskUnits="objectBoundingBox">
                                    <use xlink:href="#defaultpage_nodata-a"></use>
                                </mask>
                            </defs>
                            <g fill="none" fill-rule="evenodd" transform="translate(-3 -4)">
                                <rect width="96" height="96"></rect>
                                <ellipse cx="48" cy="85" fill="#F2F2F2" rx="45" ry="6"></ellipse>
                                <path fill="#FFF" stroke="#D8D8D8" d="M79.5,17.4859192 L66.6370555,5.5 L17,5.5 C16.1715729,5.5 15.5,6.17157288 15.5,7 L15.5,83 C15.5,83.8284271 16.1715729,84.5 17,84.5 L78,84.5 C78.8284271,84.5 79.5,83.8284271 79.5,83 L79.5,17.4859192 Z"></path>
                                <path fill="#DBDBDB" fill-rule="nonzero" d="M66,6 L67.1293476,6 L67.1293476,16.4294956 C67.1293476,17.1939227 67.7192448,17.8136134 68.4469198,17.8136134 L79,17.8136134 L79,19 L68.4469198,19 C67.0955233,19 66,17.849146 66,16.4294956 L66,6 Z"></path>
                                <g fill="#D8D8D8" transform="translate(83 4)">
                                    <circle cx="7.8" cy="10.28" r="3" opacity=".5"></circle>
                                    <circle cx="2" cy="3" r="2" opacity=".3"></circle>
                                    <path fill-rule="nonzero" d="M10.5,1 C9.67157288,1 9,1.67157288 9,2.5 C9,3.32842712 9.67157288,4 10.5,4 C11.3284271,4 12,3.32842712 12,2.5 C12,1.67157288 11.3284271,1 10.5,1 Z M10.5,7.10542736e-15 C11.8807119,7.10542736e-15 13,1.11928813 13,2.5 C13,3.88071187 11.8807119,5 10.5,5 C9.11928813,5 8,3.88071187 8,2.5 C8,1.11928813 9.11928813,7.10542736e-15 10.5,7.10542736e-15 Z" opacity=".3"></path>
                                </g>
                                <path fill="#FAFAFA" d="M67.1963269,6.66851903 L67.1963269,16.32 C67.2587277,17.3157422 67.675592,17.8136134 68.4469198,17.8136134 C69.2182476,17.8136134 72.735941,17.8136134 79,17.8136134 L67.1963269,6.66851903 Z"></path>
                                <use fill="#FFF" stroke="#D8D8D8" stroke-dasharray="3" stroke-width="2" mask="url(#defaultpage_nodata-b)" xlink:href="#defaultpage_nodata-a"></use>
                                <rect width="1" height="12" x="54" y="46" fill="#D8D8D8" rx=".5"></rect>
                                <rect width="1" height="17" x="62" y="40" fill="#D8D8D8" rx=".5"></rect>
                                <rect width="1" height="10" x="70" y="48" fill="#D8D8D8" rx=".5"></rect>
                                <rect width="1" height="14" x="78" y="43" fill="#D8D8D8" rx=".5"></rect>
                            </g>
                        </svg>
                        <div class="text-sm font-normal font-main-400 text-gray-300">
                            <span>Thông tin đơn hàng không tồn tại!</span>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>