<?php if ($data['count-cart'] > 0) { ?>
    <div class="mt-2">
        <div class="bg-white py-2 px-3 rounded shadow-md shadow-gray-400 ">
            <div class=" flex items-center text-sm leading-none font-bold">
                <div class="flex-1" style="text-align:left !important;">
                    <label class="flex items-center gap-2">
                        <?= $this->getTemplateLayoutsFor([
                            'name_layouts' => 'checkbok_rectangular',
                            'class_input' => 'check-all-product',
                            'data' => 'checkbox_all',
                            'value' => "",
                            'required' => false,
                        ]); ?>
                        <span class="">Tất cả (<span id="total-product"><?= $data["total-product"] ?></span> sản phẩm)</span>
                    </label>
                </div>
                <div class="w-2/12">
                    Đơn giá
                </div>
                <div class="w-2/12">
                    Số lượng
                </div>
                <div class="w-2/12">
                    Thành tiền
                </div>
                <div class="flex-initial text-center h-7 w-7 inline-flex leading-[0] justify-center items-center">
                    <img class="cursor-pointer delete_all_product" src="assets/images/trash.svg" alt="deleted">
                </div>
            </div>
        </div>
        <div class="form-btn-nb bg-white px-3 py-2 mt-3 rounded shadow-lg shadow-gray-400 ">
            <?php for ($i = 0; $i < $data['count-cart']; $i++) {
                $pid = $data['cart'][$i]['productid'];
                $qty = $data['cart'][$i]['qty'];
                $code = $data['cart'][$i]['code'];
                $checked = $data['cart'][$i]['checked'];
                $attribute = $data['cart'][$i]['attribute'];
                $price = $this->getPrice($pid, $attribute);
                $name = $this->getProductName($pid, 'ten_' . $lang);
                $info_product = $db->rawQueryOne("select id,photo,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,options from #_baiviet where id=?", array($pid));
                if (!empty($info_product['options'])) {
                    $options_product = json_decode($info_product['options'], true);
                } else {
                    $options_product = [];
                }
            ?>
                <div class="item-cart-product flex items-center border-b last:border-none py-2 " data-code="<?= $code ?>" data-id-product="<?= $pid ?>">
                    <div class="item flex-1 flex items-center gap-2">
                        <label>
                            <?= $this->getTemplateLayoutsFor([
                                'name_layouts' => 'checkbok_rectangular',
                                'class_input' => '',
                                'data' => 'check-product',
                                'value' => $pid,
                                'required' => false,
                            ]); ?>
                        </label>
                        <div class="flex-1 flex items-center gap-2">
                            <?= $this->addHrefImg([
                                'classfix' => 'overflow-hidden inline-flex leading-[0] justify-center items-end h-[50px] aspect-[1/1] shadow p-[3px] rounded-sm bg-white transition-all duration-300',
                                'class' => '',
                                'addhref' => true,
                                'create_thumbs' => false,
                                'href' => $this->getUrl($info_product),
                                'sizes' => '200x200x2',
                                'upload' => _upload_baiviet_l,
                                'image' => $info_product["photo"],
                                'alt' => (isset($info_product["ten_$lang"])) ? $info_product["ten_$lang"] : $options_product["ten"],
                            ]); ?>
                            <div class="form_name_cart flex flex-1 g-3 items-center">
                                <?= $this->getTemplateLayoutsFor([
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
                    <div class="text-center  w-2/12">
                        <span class="price_items_product"><?= $this->numbMoney($price, '') ?> ₫</span>
                    </div>
                    <div class="text-center item w-2/12">
                        <div class=" inline-flex leading-[0] items-center border border-gray-300">
                            <div class="btn_qty_product inline-flex leading-[0] items-center justify-center h-6 w-6 bg-transparent cursor-pointer rounded-none" data-macth='0'>-</div>
                            <input type="number" id="quantity" class="number_cart_product border-t-0 border-b-0 border-l border-r border-gray-300 text-center rounded-none h-6 w-8 " name="qty" value="<?= $qty ?>">
                            <div class="btn_qty_product inline-flex leading-[0] items-center justify-center h-6 w-6 bg-transparent cursor-pointer rounded-none " data-macth='1'>+</div>
                        </div>
                    </div>
                    <div class="text-center  w-2/12">
                        <span class="total_price_items_product text-red-600"><?= $this->numbMoney($price * $qty, '') ?> ₫</span>
                    </div>
                    <div class="flex-initial text-center h-7 w-7 inline-flex leading-[0] justify-center items-center">
                        <img data-code="<?= $code ?>" class="delCart cursor-pointer" src="assets/images/trash.svg" alt="deleted">
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>