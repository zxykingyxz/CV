<?php
global $src;
if ($data['count-cart'] > 0) { ?>
    <div class="mt-2">
        <div class="bg-white py-2 px-3 rounded shadow-md shadow-gray-300 ">
            <div class=" flex items-center text-sm leading-none font-bold">
                <div class="flex-1 text-sm font-bold font-main-700" style="text-align:left !important;">
                    <label class="flex items-center gap-2">
                        <?= $this->getTemplateLayoutsFor([
                            'name_layouts' => 'checkbok_rectangular_cart',
                            'class_input' => 'check-all-product',
                            'data' => 'checkbox_all',
                            'value' => "",
                            'required' => false,
                        ]); ?>
                        <?php if ($src == "thanh-toan") { ?>
                            <span class="">Tất cả (<span class="view-cart-checked"><?= $data["total-product-checked"] ?></span> sản phẩm)</span>
                        <?php } else { ?>
                            <span class="">Tất cả (<span class="view-cart"><?= $data["total-product"] ?></span> sản phẩm)</span>
                        <?php } ?>
                    </label>
                </div>
                <div class="flex-initial text-center h-7 w-7 inline-flex leading-[0] justify-center items-center">
                    <img class="cursor-pointer delete_all_product" src="assets/images/trash.svg" alt="deleted">
                </div>
            </div>
        </div>
        <div class=" mt-3 px-3 py-2 bg-white rounded">
            <?php
            for ($i = 0; $i < $data['count-cart']; $i++) {
                $value = $this->getValueCart($data['cart'][$i]);
            ?>
                <div class="item-cart-product flex items-center border-b last:border-none py-2 " data-code="<?= $value->code ?>" data-id-product="<?= $value->id ?>">
                    <div class="item w-full flex items-center gap-2">
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
                        <div class="flex-1 flex flex-wrap items-center gap-2">
                            <div class="w-full flex items-center gap-2">
                                <div class="overflow-hidden inline-flex leading-[0] justify-center items-end h-[81px] aspect-[1/1] shadow-md border border-gray-200 p-[3px] rounded-sm bg-white transition-all duration-300">
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
                            <div class="w-full flex items-center  gap-2">
                                <div class="flex-initial item ">
                                    <div class=" inline-flex leading-[0] items-center border border-gray-300">
                                        <div class="btn_qty_items_product inline-flex leading-[0] items-center justify-center h-6 w-6 bg-transparent cursor-pointer rounded-none" data-macth='0'>-</div>
                                        <input type="number" id="quantity" class="number_cart_product border-t-0 border-b-0 border-l border-r border-gray-300 text-center rounded-none h-6 w-8 " name="qty" value="<?= $value->qty ?>">
                                        <div class="btn_qty_items_product inline-flex leading-[0] items-center justify-center h-6 w-6 bg-transparent cursor-pointer rounded-none " data-macth='1'>+</div>
                                    </div>
                                </div>
                                <div class="  flex-1">
                                    <span class="price_items_product text-red-600"><?= $this->numbMoney($value->price) . "(x" ?> <span class="number_cart_product"><?= $value->qty ?></span><?= ")" ?></span>
                                </div>
                                <div class="flex-initial text-center h-7 w-7 inline-flex leading-[0] justify-center items-center">
                                    <img data-code="<?= $value->code ?>" class="delCart cursor-pointer" src="assets/images/trash.svg" alt="deleted">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>