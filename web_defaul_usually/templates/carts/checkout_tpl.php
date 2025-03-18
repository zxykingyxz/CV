<?php
$rows_htgh = $db->rawQuery("select id, ten_$lang as ten,photo,noidung_$lang as noidung from #_baiviet where hienthi=1 and type=? order by stt asc,id desc", array('htgh'));

$rows_httt = $db->rawQuery("select id, ten_$lang as ten,photo,noidung_$lang as noidung from #_baiviet where hienthi=1 and type=? order by stt asc,id desc", array('pttt'));

$payship_tmp = $flash->get('payship');

$payment_tmp = $flash->get('payment');

$payship = (!empty($payship_tmp)) ? $payship_tmp  : $rows_htgh[0]['id'];

$payment = (!empty($payment_tmp)) ? $payment_tmp : $rows_httt[0]['id'];

$id_city = $flash->get('id_city');

$result_city =  $db->rawQuery("select id, name_$lang from #_place_citys order by id asc", array());

if (!empty($id_city)) {
    $result_dist = $db->rawQuery("select id, name_$lang from #_place_dists where id_city=? order by id asc", array($id_city));
} else {
    $result_dist = $db->rawQuery("select id, name_$lang from #_place_dists order by id asc", array());
}

?>
<section class="carts mt-5 pt-3 pb-5 ">
    <div class="grid_s wide">
        <?php if (count($cart->checkArrayChecked($_SESSION['cart'])) == 0) { ?>
            <?= $cart->getTemplateLayoutsFor([
                'name_layouts' => 'no_data',
            ], true); ?>
        <?php } else { ?>
            <div class=" w-full text-red-500 ">
                <?= $flash->getMessages("frontend") ?>
            </div>
            <div class="flex flex-wrap gap-y-3">
                <div class=" w-full mb-5 ">
                    <?php if ($deviceType == 'computer') { ?>
                        <?= $cart->getTemplateLayoutsFor([
                            'name_layouts' => 'getTemplateCart',
                            'data' => $cart->getCart(),
                        ], false); ?>
                    <?php } else { ?>
                        <?= $cart->getTemplateLayoutsFor([
                            'name_layouts' => 'getTemplateCart_m',
                            'data' => $cart->getCart(),
                        ], false); ?>
                    <?php } ?>
                </div>
            </div>
            <div class="w-full mb-5">
                <form action="<?= $func->getComUrl('carts?src=thanh-toan') ?>" novalidate method="post" class="form-validate-checkout w-full" id="form-checkout" autocomplete="off" enctype="multipart/form-data" name="form-checkout">
                    <input type="hidden" name="checkout">
                    <input type="hidden" name="dataOrder[payship]" value="<?= $payship ?>">
                    <input type="hidden" name="dataOrder[payment]" value="<?= $payment ?>">
                    <div class="w-full flex flex-wrap gap-5">
                        <div class="w-full sm:w-6/12 lg:w-8/12 bg-white rounded-md  overflow-hidden shadow-lg shadow-gray-300 border border-gray-200">
                            <div class="flex flex-wrap">
                                <div class="w-full lg:w-6/12 bg-white py-5 px-3">
                                    <div class="">
                                        <span class="text-base font-bold font-main-700">
                                            Thông tin khách hàng
                                        </span>
                                    </div>
                                    <div class="mt-5 grid grid-cols-1 gap-2">
                                        <?= $cart->getTemplateLayoutsFor([
                                            'name_layouts' => 'input_cart',
                                            'class_form' => 'w-full',
                                            'lable' => "Họ và tên",
                                            'placeholder' => "Nhập Họ và tên*",
                                            'id' => 'fullname',
                                            'data' => 'fullname',
                                            'value' => (empty($account_info['fullname'])) ? $flash->get('fullname') : $account_info['fullname'],
                                            'type' => 'text',
                                            'save_cache' => false,
                                            'required' => true,
                                            'readonly' => false,
                                            'no_lable' => true,
                                            'function' => '',
                                        ]); ?>
                                        <?= $cart->getTemplateLayoutsFor([
                                            'name_layouts' => 'input_cart',
                                            'class_form' => 'w-full',
                                            'lable' => "Email",
                                            'placeholder' => "Nhập Email",
                                            'id' => 'email',
                                            'data' => 'email',
                                            'value' => (empty($account_info['email'])) ? $flash->get('email') : $account_info['email'],
                                            'type' => 'email',
                                            'save_cache' => false,
                                            'required' => false,
                                            'readonly' => false,
                                            'no_lable' => true,
                                            'function' => '',
                                        ]); ?>
                                        <?= $cart->getTemplateLayoutsFor([
                                            'name_layouts' => 'input_cart',
                                            'class_form' => 'w-full',
                                            'lable' => "Số điện thoại",
                                            'placeholder' => "Nhập Số điện thoại*",
                                            'id' => 'phone',
                                            'data' => 'phone',
                                            'value' => (empty($account_info['phone'])) ? $flash->get('phone') : $account_info['phone'],
                                            'type' => 'number',
                                            'save_cache' => false,
                                            'required' => true,
                                            'readonly' => false,
                                            'no_lable' => true,
                                            'function' => '',
                                        ]); ?>
                                        <?= $cart->getTemplateLayoutsFor([
                                            'name_layouts' => 'input_cart',
                                            'class_form' => 'w-full',
                                            'lable' => "Địa chỉ",
                                            'placeholder' => "Nhập Địa chỉ",
                                            'id' => 'address',
                                            'data' => 'address',
                                            'value' => $flash->get('address'),
                                            'type' => 'text',
                                            'save_cache' => false,
                                            'required' => false,
                                            'readonly' => false,
                                            'no_lable' => true,
                                            'function' => '',
                                        ]); ?>
                                        <?= $cart->getTemplateLayoutsFor([
                                            'name_layouts' => 'select_cart',
                                            'class_form' => 'w-full',
                                            'lable' => "Tỉnh Thành",
                                            'placeholder' => "Chọn Tỉnh Thành",
                                            'id' => 'id_city',
                                            'data' => 'id_city',
                                            'value' => $flash->get('id_city'),
                                            'data_option' => $result_city,
                                            'name_col_view' => 'name_' . $lang,
                                            'name_col_value' => 'id',
                                            'save_cache' => false,
                                            'required' => true,
                                            'no_lable' => true,
                                            'function' => '',
                                        ]); ?>
                                        <div class="w-full form_dist">
                                            <?= $cart->getTemplateLayoutsFor([
                                                'name_layouts' => 'select_cart',
                                                'class_form' => 'w-full',
                                                'lable' => "Quận Huyện",
                                                'placeholder' => "Chọn Quận Huyện",
                                                'id' => 'id_dist',
                                                'data' => 'id_dist',
                                                'value' => $flash->get('id_dist'),
                                                'data_option' => $result_dist,
                                                'name_col_view' => 'name_' . $lang,
                                                'name_col_value' => 'id',
                                                'save_cache' => false,
                                                'required' => true,
                                                'no_lable' => true,
                                                'function' => '',
                                            ]); ?>
                                        </div>
                                        <?= $cart->getTemplateLayoutsFor([
                                            'name_layouts' => 'textarea_cart',
                                            'class_form' => 'w-full',
                                            'class' => "",
                                            'lable' => "Ghi Chú",
                                            'placeholder' => "Nhập Ghi Chú",
                                            'id' => "notes",
                                            'data' => "notes",
                                            'rows' => 6,
                                            'value' => '',
                                            'save_cache' => false,
                                            'required' => false,
                                            'readonly' => false,
                                            'no_lable' => true,
                                            'function' => '',
                                        ]); ?>
                                    </div>
                                </div>
                                <div class="flex-1 bg-gray-100 px-3 py-5">
                                    <div class="form_payment w-full">
                                        <div class="">
                                            <span class="text-base font-bold font-main-700">
                                                <i class="fa fa-question-circle" aria-hidden="true"></i>
                                                <?= _phuongthucthanhtoan ?>
                                            </span>
                                        </div>
                                        <div class="mt-2 w-full">
                                            <div class="w-full grid grid-cols-1 gap-1">
                                                <?php foreach ($rows_httt as $key => $value) { ?>
                                                    <div class="group/itemOption flex items-center gap-2 cursor-pointer btn_payment btn_option <?= ($key == 0) ? "on" : "" ?>" data-nb="payment_<?= $key ?>" data-name-input="dataOrder[payment]" data-id="<?= $value['id'] ?>">
                                                        <div class="flex-initial leading-[1] ">
                                                            <div class="relative h-[12px] aspect-[1/1] border border-gray-400 group-[&.on]/itemOption:border-[var(--html-bg-website)] group-[&.on]/itemOption:bg-[var(--html-bg-website)] rounded-[50%] leading-[1] overflow-hidden transition-all duration-300">
                                                                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 h-0 aspect-[1/1] group-[&.on]/itemOption:h-[50%] leading-[0] rounded-[50%] overflow-hidden bg-white transition-all duration-300"> </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex-1 text-sm leading-normal font-medium font-main group-[&.on]/itemOption:text-[var(--html-bg-website)]">
                                                            <span>
                                                                <?= $value["ten"] ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="mt-2 mb-2">
                                                <?php foreach ($rows_httt as $key => $value) { ?>
                                                    <div class="opacity_animaiton w-full bg-white px-2 py-2 rounded content data_payment  <?= ($key == 0) ? "on" : "hidden" ?>" data-nb="payment_<?= $key ?>">
                                                        <span>
                                                            <?= htmlspecialchars_decode($value['noidung']) ?>
                                                        </span>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form_payship">
                                        <div class="">
                                            <span class="text-base font-bold font-main-700">
                                                <i class="fa fa-question-circle" aria-hidden="true"></i>
                                                <?= _phuongthucgiaohang ?>
                                            </span>
                                        </div>
                                        <div class="mt-2 w-full">
                                            <div class="w-full grid grid-cols-1 gap-1">
                                                <?php foreach ($rows_htgh as $key => $value) { ?>
                                                    <div class="group/itemOption flex items-center gap-2 cursor-pointer btn_payship btn_option <?= ($key == 0) ? "on" : "" ?>" data-nb="payship_<?= $key ?>" data-name-input="dataOrder[payship]" data-id="<?= $value['id'] ?>">
                                                        <div class="flex-initial leading-[0] ">
                                                            <div class="relative h-[12px] aspect-[1/1] border border-gray-400 group-[&.on]/itemOption:border-[var(--html-bg-website)] group-[&.on]/itemOption:bg-[var(--html-bg-website)] rounded-[50%] leading-[0] overflow-hidden inline-flex justify-center items-center transition-all duration-300">
                                                                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 h-0 aspect-[1/1] group-[&.on]/itemOption:h-[50%] leading-[0] rounded-[50%] overflow-hidden bg-white transition-all duration-300"> </div>
                                                            </div>
                                                        </div>
                                                        <div class=" flex-1 text-sm leading-normal font-medium font-main group-[&.on]/itemOption:text-[var(--html-bg-website)]">
                                                            <span>
                                                                <?= $value["ten"] ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="mt-2 mb-2">
                                                <?php foreach ($rows_htgh as $key => $value) { ?>
                                                    <div class="opacity_animaiton w-full bg-white px-2 py-2 rounded content data_payship  <?= ($key == 0) ? "on" : "hidden" ?>" data-nb="payship_<?= $key ?>">
                                                        <span>
                                                            <?= htmlspecialchars_decode($value['noidung']) ?>
                                                        </span>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class=" sticky top-[var(--value-top-fixed)] left-0">
                                <div class=" bg-white rounded-md overflow-hidden shadow-md shadow-gray-200">
                                    <div class="text-base font-medium font-main-500 py-3 px-3 grid grid-cols-1 gap-1">
                                        <div class=" w-full flex justify-between ">
                                            <div>
                                                <span class="">
                                                    <?= _tamtinh ?>
                                                </span>
                                            </div>
                                            <div>
                                                <span class="price-temp-cart text-gray-600">
                                                    <?= $cart->numbMoney($cart->getTotalOrder_tmp()) ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="text-xs text-gray-500 w-full ">
                                            <i>(<?= _dabaogomvatneuco ?>)</i>
                                        </div>
                                    </div>
                                    <div class="border-t border-gray-300">
                                        <div class="text-base font-medium font-main-500">
                                            <div class=" w-full flex justify-between py-3 px-3">
                                                <div>
                                                    <span class="">
                                                        <?= _thanhtien ?>
                                                    </span>
                                                </div>
                                                <div>
                                                    <span class="total_cart text-red-600 ">
                                                        <?= $cart->numbMoney($cart->getTotalOrder()) ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 w-full">
                                    <button type="submit" class="submit_load w-full text-sm sm:text-base font-bold font-main-700 rounded-md h-10 sm:h-12 overflow-hidden px-3 bg-[var(--html-bg-website)] flex  justify-center items-center text-white hover:brightness-125  capitalize transition-all duration-300">
                                        <?= _thanhtoan ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        <?php } ?>
    </div>
</section>