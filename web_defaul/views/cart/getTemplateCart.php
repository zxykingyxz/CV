<?php if ($data['count-cart'] > 0) { ?>
    <div class="mt-2">
        <div class="bg-white py-2 px-3 rounded shadow-md shadow-gray-300 ">
            <div class=" flex font-bold font-main-700 items-center text-sm leading-none ">
                <div class="flex-1 " style="text-align:left !important;">
                    <label class="flex items-center gap-2">
                        <?= $this->getTemplateLayoutsFor([
                            'name_layouts' => 'checkbok_rectangular_cart',
                            'class_input' => 'check-all-product',
                            'data' => 'checkbox_all',
                            'value' => "",
                            'required' => false,
                        ]); ?>
                        <span class="">Tất cả (<span id="total-product"><?= $data["total-product"] ?></span> sản phẩm)</span>
                    </label>
                </div>
                <div class="w-2/12 text-center">
                    Đơn giá
                </div>
                <div class="w-[12%] text-center">
                    Số lượng
                </div>
                <div class="w-2/12 text-center">
                    Thành tiền
                </div>
                <div class="flex-initial text-center h-7 w-7 inline-flex leading-[0] justify-center items-center">
                    <img class="cursor-pointer delete_all_product" src="assets/images/trash.svg" alt="deleted">
                </div>
            </div>
        </div>
        <div class=" bg-white px-3 py-2 mt-3 rounded shadow-lg shadow-gray-300 ">
            <?php for ($i = 0; $i < $data['count-cart']; $i++) {
                $value = $this->getValueCart($data['cart'][$i]);
            ?>
                <div class="item-cart-product flex items-center border-b last:border-none py-2 " data-code="<?= $value->code ?>" data-id-product="<?= $value->id ?>">
                    <div class="item flex-1 flex items-center gap-2">
                        <label>
                            <?= $this->getTemplateLayoutsFor([
                                'name_layouts' => 'checkbok_rectangular_cart',
                                'class_input' => '',
                                'data' => 'check-product',
                                'value' => $value->code,
                                'checked' => ($value->checked == 1) ? true : false,
                                'required' => false,
                            ]); ?>
                        </label>
                        <div class="flex-1 flex items-center gap-3">
                            <div class="overflow-hidden inline-flex leading-[0] justify-center items-end h-[70px] aspect-[1/1] shadow-md border border-gray-200 p-[3px] rounded-sm bg-white transition-all duration-300">
                                <?= $this->addHrefImg([
                                    'classfix' => '',
                                    'class' => '',
                                    'addhref' => true,
                                    'create_thumbs' => false,
                                    'href' => $this->getUrl($value->info_product),
                                    'sizes' => '200x200x2',
                                    'upload' => _upload_baiviet_l,
                                    'image' => $value->info_product["photo"],
                                    'alt' => $value->info_product["ten"],
                                ]); ?>
                            </div>
                            <div class="form_name_cart flex flex-1 gap-2 items-center">
                                <?= $this->getTemplateLayoutsFor([
                                    'name_layouts' => 'getTemplateNameCart',
                                    'options' => $value->options_product,
                                    'name' => $value->name,
                                    'pid' => $value->id,
                                    'attribute' => $value->attribute,
                                    'code' => $value->code,
                                    'link' => $this->getUrl($value->info_product),
                                ]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="text-center  w-2/12">
                        <span class="price_items_product"><?= $this->numbMoney($value->price, '') ?> ₫</span>
                    </div>
                    <div class="text-center item w-[12%]">
                        <div class=" inline-flex leading-[0] items-center border border-gray-300">
                            <div class="btn_qty_product inline-flex leading-[0] items-center justify-center h-6 w-6 bg-transparent cursor-pointer rounded-none" data-macth='0'>-</div>
                            <input type="number" id="quantity" class="number_cart_product border-t-0 border-b-0 border-l border-r border-gray-300 text-center rounded-none h-6 w-8 " name="qty" value="<?= $value->qty ?>">
                            <div class="btn_qty_product inline-flex leading-[0] items-center justify-center h-6 w-6 bg-transparent cursor-pointer rounded-none " data-macth='1'>+</div>
                        </div>
                    </div>
                    <div class="text-center  w-2/12">
                        <span class="total_price_items_product text-red-600"><?= $this->numbMoney($value->price * $value->qty, '') ?> ₫</span>
                    </div>
                    <div class="flex-initial text-center h-7 w-7 inline-flex leading-[0] justify-center items-center">
                        <img data-code="<?= $value->code ?>" class="delCart cursor-pointer" src="assets/images/trash.svg" alt="deleted">
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>