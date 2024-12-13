<?php if ($data['count-cart'] > 0) { ?>
    <div class="content-cart mt10">
        <div class="thead-cart pt20 pb20 bg-white bordered">
            <div class="tr d-flex align-items-center">
                <div class="td item col-10">
                    <label class="checker all">
                        <input type="checkbox" class="check--box check-all-product">
                        <span class="checkbox-fake"></span>
                        <span class="label">Tất cả (<span id="total-product"><?= $data["total-product"] ?></span> sản phẩm)</span>
                    </label>
                </div>
                <div class="td item col-2 t-center cartDelcart">
                    <img id="deleteall" class="cs-pointer" src="assets/images/trash.svg" alt="deleted">
                </div>
            </div>
        </div>
        <div class="tbody body-cart pt20 pb20 mt10 bg-white bordered">
            <?php
            for ($i = 0; $i < $data['count-cart']; $i++) {
                $pid = $data['cart'][$i]['productid'];
                $qty = $data['cart'][$i]['qty'];
                $code = $data['cart'][$i]['code'];
                $checked = $data['cart'][$i]['checked'];
                $attribute = $data['cart'][$i]['attribute'];
                $price = $cart->getPrice($pid, $attribute);
                $name = $cart->getProductName($pid, 'ten_' . $lang);
                $alias = (($config['website']['lang'] == true) ? $lang . '/' : '') . $cart->getProductName($pid, 'tenkhongdau_' . $lang);
                $options_product = $db->rawQueryOne("select options from #_baiviet where id=?", array($pid));
                if (!empty($options_product['options'])) {
                    $options_product = json_decode($options_product['options'], true);
                } else {
                    $options_product = [];
                }
            ?>
                <div class="border-bottom pt10 pb10 item-cart-product" data-code="<?= $code ?>" data-id-product="<?= $pid ?>">

                    <div class="tr d-flex align-items-center pt10 pb10">

                        <div class="td item col-12 d-flex align-items-center">

                            <label class="checker check-o">

                                <input type="checkbox" class="check--box" <?= ($checked == 1) ? 'checked' : '' ?> name="check-product" value="<?= $code ?>">

                                <span class="checkbox-fake"></span>

                            </label>

                            <a class="cart-img" href="<?= $alias ?>" title="<?= $name ?>">

                                <?= $cart->getProductImg($pid, $lang, _upload_baiviet_l, $config_url, 60, $colorimg) ?>

                            </a>

                            <div class="d-flex f1 g10-l g10-m g10-c form_name_cart align-items-center">

                                <?= $func->getTemplateLayoutsFor([
                                    'name_layouts' => 'getTemplateNameCart',
                                    'options' => $options_product,
                                    'name' => $name,
                                    'pid' => $pid,
                                    'attribute' => $attribute,
                                    'code' => $code,
                                ]) ?>

                            </div>

                        </div>

                    </div>

                    <div class="tr d-flex align-items-center mt10i">

                        <div class="td item col-5">

                            <div class="box-quality d-flex align-items-center">
                                <div class="btn  btn_qty_product " data-macth='0'>-</div>
                                <input type="number" id="qty <?= $code ?> " class="input-quality number_cart_product" name="qty" value="<?= $qty ?>">
                                <div class="btn  btn_qty_product " data-macth='1'>+</div>

                            </div>

                        </div>
                        <div class="td item t-center col-5">
                            <span>
                                <span class="price_items_product">
                                    <?= $cart->numbMoney($price, ' ₫') ?>
                                </span> (x <span class="number_cart_product"><?= $qty ?></span>
                                )</span>

                        </div>

                        <div class="td item col-2 t-center cartDelcart">

                            <img data-code="<?= $code ?>" class="delCart cs-pointer" src="assets/images/trash.svg" alt="deleted">

                        </div>

                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
<?php } ?>