<?php

$rows_htgh = $db->rawQuery("select id, ten_$lang,photo from #_baiviet where hienthi=1 and type=? order by stt asc,id desc", array('htgh'));

$rows_httt = $db->rawQuery("select id, ten_$lang,photo,noidung_$lang from #_baiviet where hienthi=1 and type=? order by stt asc,id desc", array('pttt'));
?>
<section class="carts py-5 bg-bray">

    <div class="grid_s wide">

        <?php
        if (is_array($_SESSION['cart']) && count($_SESSION['cart']) == 0 && ($config['cart']['combo-cart'] ? (is_array($_SESSION['combo']) && count($_SESSION['combo']) == 0) : true)) { ?>

            <div class="row d-flex flex-wrap ds-mobile">

                <div class="empty-cart p-5 w-9/12 text-center mt-2.5 ">

                    <img src="assets/images/mascot@2x.png" alt="i-web" class="empty__img mx-auto">

                    <p class="empty__note mt-2.5"><?= _khongcosanphamnaotronggio ?></p><a href="<?= $func->getType('san-pham') ?>" class="empty__btn"><?= _tieptucmuahang ?></a>

                </div>


            </div>

        <?php } else { ?>

            <div class="row">

                <div class="col w-full">
                    <?= $flash->getMessages("frontend") ?>
                </div>

                <div class="col w-full mb-5 ">

                    <?php if ($deviceType == 'computer') { ?>

                        <?= $cart->getTemplateCart($lang) ?>

                    <?php } else { ?>

                        <?= $cart->getTemplateCart_m($lang) ?>

                    <?php } ?>

                </div>

            </div>

            <form action="<?= $func->getComUrl('carts?src=thanh-toan') ?>" novalidate method="post" class="form-validate-checkout" id="form-checkout" autocomplete="off" enctype="multipart/form-data" name="form-checkout">
                <input type="hidden" name="checkout">
                <div class="row ">

                    <div class="col w-full">

                        <div class="line-gradient"></div>

                        <div class="bg-white p-5">

                            <div class="row d-flex flex-wrap">

                                <div class="col w-full lg:w-1/2 w-100-m">

                                    <div class="row-input">

                                        <div class="wrap-input">

                                            <input class="input form--control wrap-input__checkout-name" required type="text" name="dataOrder[fullname]" id="fullname" value="<?= (empty($account_info['fullname'])) ? $flash->get('fullname') : $account_info['fullname'] ?>" placeholder="<?= _hovaten ?>">
                                            <small class="invalid">Vui lòng nhập họ tên</small>
                                        </div>

                                    </div>

                                </div>

                                <div class="col w-full lg:w-1/2">

                                    <div class="row-input">

                                        <div class="wrap-input">
                                            <input class="input form--control wrap-input__checkout-email" required type="text" name="dataOrder[email]" id="email" value="<?= (empty($account_info['email'])) ? $flash->get('email') : $account_info['email'] ?>" placeholder="Email">
                                            <small class="invalid">Vui lòng nhập email</small>
                                        </div>

                                    </div>

                                </div>

                                <div class="col w-full lg:w-1/2">

                                    <div class="row-input">

                                        <div class="wrap-input">

                                            <input class="input form--control wrap-input__checkout-phone" required type="text" name="dataOrder[phone]" id="phone" value="<?= (empty($account_info['phone'])) ? $flash->get('phone') : $account_info['phone'] ?>" placeholder="<?= _dienthoai ?>">
                                            <small class="invalid">Vui lòng nhập số điện thoại</small>
                                        </div>

                                    </div>

                                </div>

                                <div class="col w-full lg:w-1/2">

                                    <div class="row-input">

                                        <div class="wrap-input">

                                            <input class="input form--control wrap-input__checkout-address" type="text" name="dataOrder[address]" id="address" value="<?= (empty($account_info['address'])) ? $flash->get('address') : $account_info['address'] ?>" placeholder="<?= _diachi ?>">
                                            <small class="invalid">Vui lòng nhập địa chỉ</small>
                                        </div>

                                    </div>

                                </div>

                                <?php

                                $result_city = $apiPlace->getPlace('place_citys', "id, name_$lang", 'id asc');

                                if ($account_info['id_city'] != 0) {

                                    $result_dist = $apiPlace->getFieldWhere('place_dists', $account_info['id_city'], "id, name_$lang as name,code", 'id_city', 'numb asc, id desc');
                                }

                                ?>

                                <div class="col w-full lg:w-1/2">

                                    <div class="row-input">

                                        <div class="wrap-input">

                                            <select class="input-select form--control select wrap-input__checkout-city" name="dataOrder[id_city]" id="id_city" onchange="onChangeSelect('#id_dist',{id:this.value, fs:'id,name_<?= $lang ?> as name, code',fw:'id_city',t:'place/dists',tt:'Chọn quận huyện'})">

                                                <option value=""><?= _chontinhthanh ?></option>

                                                <?php foreach ($result_city as $k => $v) { ?>

                                                    <option value="<?= $v['id'] ?>" <?= ($v['id'] == (empty($account_info['id_city'])) ? $flash->get('id_city') : $account_info['id_city']) ? 'selected' : '' ?>>
                                                        <?= $v['name_' . $lang] ?></option>

                                                <?php } ?>

                                            </select>

                                            <small class="invalid">Vui lòng chọn tỉnh/thành phố</small>

                                        </div>

                                    </div>

                                </div>

                                <div class="col w-full lg:w-1/2">

                                    <div class="row-input">

                                        <div class="wrap-input">

                                            <select class="input-select form--control select wrap-input__checkout-dist" name="dataOrder[id_dist]" id="id_dist">

                                                <option value=""><?= _chonquanhuyen ?></option>

                                                <?php if (is_array($result_dist) && count($result_dist) > 0) {
                                                    foreach ($result_dist as $k => $v) { ?>

                                                        <option value="<?= $v['id'] ?>" <?= ($v['id'] == (empty($account_info['id_dist'])) ? $flash->get('id_dist') : $account_info['id_dist']) ? 'selected' : '' ?>>
                                                            <?= $v['code'] ?> <?= $v['name'] ?></option>

                                                <?php }
                                                } ?>

                                            </select>

                                            <small class="invalid">Vui lòng chọn quận/huyện</small>

                                        </div>

                                    </div>

                                </div>

                                <div class="col w-full">

                                    <div class="row-input">

                                        <div class="wrap-input">

                                            <textarea class="input h wrap-input__checkout-content" name="dataOrder[notes]" id="notes" rows="10" placeholder="<?= _ghichu ?>"><?= $flash->get('notes') ?></textarea>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col w-full lg:w-9/12 mt-5">
                        <div class="line-gradient"></div>
                        <div class="shadown--cart">
                            <div class="row">
                                <div class="col w-full md:w-1/2">
                                    <div class="box-payments pd-checkout-cart">
                                        <label class="lbl-payment">
                                            <?= _phuongthucthanhtoan ?>
                                        </label>
                                        <div class="box-payment-checkout grid grid-cols-2 gap-2.5 mt-2.5">
                                            <?php $flashPayment = $flash->get('payment'); ?>
                                            <?php foreach ($rows_httt as $key => $val) { ?>
                                                <label for="payment<?= $val['id'] ?>" class="radio-item res--span--6 checkout--info--cart js-payment tooltip-checkout">
                                                    <input type="radio" <?= (!empty($flashPayment) && $flashPayment == $val['id']) ? 'checked' : '' ?> name="dataOrder[payment]" id="payment<?= $val['id'] ?>" class="wrap-input__checkout-payment input-position" value="<?= $val['id'] ?>" />
                                                    <div class="rd-text">
                                                        <div class="rd-img flex items-center">
                                                            <div class="logo-col">
                                                                <img width="48" height="48" src="<?= _upload_baiviet_l . $val["photo"] ?>" alt="<?= $val["ten_$lang"] ?>" />
                                                            </div>
                                                            <div><?= $val["ten_$lang"] ?></div>
                                                        </div>
                                                    </div>
                                                </label>
                                            <?php } ?>
                                        </div>
                                        <label class="lbl-payment mt-7">
                                            <?= _phuongthucgiaohang ?>
                                        </label>
                                        <div class="box-payment-ship grid grid-cols-2 gap-2.5 mt-2.5">
                                            <?php $flashPayship = $flash->get('payship'); ?>
                                            <?php foreach ($rows_htgh as $key => $value) { ?>
                                                <div class="rd-giaohang res--span--6 relative">
                                                    <label for="payship<?= $value['id'] ?>" class="radio-item checkout--info--cart js-payship tooltip-checkout">
                                                        <input type="radio" <?= (!empty($flashPayment) && $flashPayment == $value['id']) ? 'checked' : '' ?> name="dataOrder[payship]" id="payship<?= $value['id'] ?>" class="wrap-input__checkout-payship input-position" value="<?= $value['id'] ?>" />
                                                        <div class="rd-text">
                                                            <div class="rd-img d-flex align-items-center">
                                                                <div class="logo-col">
                                                                    <img width="48" height="48" src="<?= _upload_baiviet_l . $value["photo"] ?>" alt="<?= $value["ten_$lang"] ?>" />
                                                                </div>
                                                                <div><?= $value["ten_$lang"] ?></div>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col w-full md:w-1/2 bg-white">
                                    <div class="pd-checkout-cart" id="show--content"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col w-full lg:w-3/12 mt-5">
                        <div class="box-total-cart-price sticky-cart">
                            <div class="line-gradient"></div>
                            <div class="shadown--cart bg-white">
                                <ul class="prices__items">
                                    <li class="prices__item"><span class="prices__text"><?= _tamtinh ?></span><span class="prices__value"><span id="js-price-temp"><?= $cart->numbMoney($cart->getTotalOrder(), ' VNĐ') ?></span></span>
                                    </li>
                                </ul>
                                <div class="prices__total">
                                    <span class="prices__text"><?= _thanhtien ?></span>
                                    <span class="prices__value prices__value--final"><span id="js-total-cart"><?= $cart->numbMoney($cart->getTotalOrder(), ' VNĐ') ?></span><i>(<?= _dabaogomvatneuco ?>)</i>
                                    </span>
                                    <input type="hidden" id="js-total-cart-input" class="wrap-input__checkout-payment-total" value="<?= $cart->numbMoney($cart->getTotalOrder(), ' VNĐ') ?>">
                                </div>
                            </div>
                            <button type="submit" class="cart__submit cs--btn-cart t-uppercase js-checkout__tpl"><?= _thanhtoan ?></button>
                        </div>
                    </div>
                </div>
            </form>
        <?php } ?>
    </div>
</section>