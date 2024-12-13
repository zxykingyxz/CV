<section class="section-product py-4 ">
    <div class="grid_x wide ">
        <form action="" method="POST" name="form" class="w-full flex flex-wrap gap-4" enctype="multipart/form-data">
            <div class="flex-1 w-full lg:w-auto relative z-10">
                <div class="flex flex-wrap gap-4 max-w-full sticky top-[120px] left-0">
                    <div class="w-full flex flex-wrap gap-5 justify-start items-center ">
                        <div class="text-xl font-bold inline-flex justify-center items-center gap-3 text-gray-700">
                            <a href="<?= $url_transaction_import_man ?>" title="Quay Lại" class="block ">
                                <i class="fas fa-arrow-left font-medium"></i>
                            </a>
                            <span>
                                Nhập Hàng
                            </span>
                        </div>
                        <div class="flex-1 max-w-[600px]  basis-full sm:basis-auto flex flex-wrap gap-2 justify-start items-center relative z-40">
                            <div class="w-full  flex items-center rounded bg-white border border-gray-300 shadow-md shadow-gray-400 overflow-hidden ">
                                <div class="inline-flex justify-center items-center  h-10 aspect-[1/1]">
                                    <i class="fas fa-search font-normal text-base text-gray-500"></i>
                                </div>
                                <input type="text" name="search_product" class="h-10 border-none bg-inherit pl-1 flex-1 " placeholder="Nhập Tên/Mã Sản Phẩm" onkeydown="blockEnter(event)">
                                <div class="close_view_search hidden">
                                    <div class="flex cursor-pointer justify-center items-center w-10 aspect-[1/1]">
                                        <svg xmlns="http://www.w3.org/2000/svg" id="Capa_1" enable-background="new 0 0 320.591 320.591" viewBox="0 0 320.591 320.591" style="width: 15px; height: auto; fill: #ccc;">
                                            <g>
                                                <g id="close_1_">
                                                    <path d="m30.391 318.583c-7.86.457-15.59-2.156-21.56-7.288-11.774-11.844-11.774-30.973 0-42.817l257.812-257.813c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875l-259.331 259.331c-5.893 5.058-13.499 7.666-21.256 7.288z" style="fill: #ccc;" />
                                                    <path d="m287.9 318.583c-7.966-.034-15.601-3.196-21.257-8.806l-257.813-257.814c-10.908-12.738-9.425-31.908 3.313-42.817 11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414-6.35 5.522-14.707 8.161-23.078 7.288z" style="fill: #ccc;" />
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                                <div class=" view_load_search hidden">
                                    <div class="rp-loader flex justify-center items-center w-10 aspect-[1/1]">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" style="width: 18px; height: auto; fill: #ccc;">
                                            <circle r="80" cx="500" cy="90" style="fill: #ccc;"></circle>
                                            <circle r="80" cx="500" cy="910" style="fill: #ccc;"></circle>
                                            <circle r="80" cx="90" cy="500" style="fill: #ccc;"></circle>
                                            <circle r="80" cx="910" cy="500" style="fill: #ccc;"></circle>
                                            <circle r="80" cx="212" cy="212" style="fill: #ccc;"></circle>
                                            <circle r="80" cx="788" cy="212" style="fill: #ccc;"></circle>
                                            <circle r="80" cx="212" cy="788" style="fill: #ccc;"></circle>
                                            <circle r="80" cx="788" cy="788" style="fill: #ccc;"></circle>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="view_input absolute top-[calc(100%+5px)] left-0 w-full shadow-md shadow-gray-300 rounded-md z-10 "></div>
                        </div>
                    </div>
                    <div class=" bg-white border border-gray-300 w-full rounded shadow-xl shadow-gray-300 overflow-y-hidden overflow-x-auto scroll-x grid grid-cols-1 gap-1 p-2" id="list_product">
                        <?= $warehouse_func->getTemplateLayoutsFor([
                            'name_layouts' => 'templateNodata',
                        ]); ?>
                    </div>
                </div>
            </div>
            <div class=" max-w-full basis-full lg:max-w-[350px] lg:basis-[30%]  min-w-[150px]">
                <div class="sticky top-[120px] left-0">
                    <div class="bg-white rounded-md border border-gray-200 shadow-md p-3 flex flex-wrap flex-col gap-2">
                        <div class="flex items-end gap-1">
                            <div class="form_inputcode flex-1">
                                <?= $warehouse_func->getTemplateLayoutsFor([
                                    'name_layouts' => 'input_warehouse',
                                    'class_form' => 'w-full',
                                    'lable' => $warehouse_func->getTitleColumn('code'),
                                    'placeholder' => 'Nhập ' . $warehouse_func->getTitleColumn('code'),
                                    'data' => 'code',
                                    'value' => '',
                                    'type' => 'text',
                                    'save_cache' => false,
                                    'required' => true,
                                    'readonly' => false,
                                ]);
                                ?>
                            </div>
                            <div class="button_random flex-initial flex justify-center items-center h-9 aspect-[1/1] bg-green-500 rounded-md cursor-pointer ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                    <path d="M14.2584 16.9886L9.7525 13.9808C9.70056 13.947 9.64053 13.9278 9.57866 13.9251C9.51678 13.9224 9.45531 13.9363 9.40063 13.9654C9.34596 13.9946 9.30007 14.0378 9.26773 14.0907C9.23539 14.1435 9.21778 14.2041 9.21674 14.2661V15.4177C7.63761 15.3394 6.1284 14.7418 4.92315 13.7175C3.71791 12.6933 2.88397 11.2996 2.55067 9.75266C2.83628 8.41091 3.50292 7.18026 4.47047 6.20859C4.50266 6.17663 4.52821 6.1386 4.54565 6.09671C4.56308 6.05482 4.57206 6.00988 4.57207 5.9645C4.57208 5.91912 4.56312 5.87418 4.54569 5.83228C4.52827 5.79038 4.50274 5.75234 4.47056 5.72037C4.43839 5.68839 4.40021 5.6631 4.35823 5.64596C4.31624 5.62882 4.27128 5.62016 4.22594 5.62049C4.1806 5.62082 4.13578 5.63013 4.09404 5.64788C4.05231 5.66563 4.0145 5.69147 3.9828 5.72391C2.91161 6.80519 2.17722 8.17459 1.86886 9.66573C1.5605 11.1569 1.69144 12.7055 2.24577 14.1236C2.80011 15.5417 3.75398 16.768 4.99148 17.6538C6.22898 18.5395 7.69685 19.0464 9.21674 19.113V20.2817C9.21776 20.3437 9.23535 20.4043 9.26768 20.4572C9.30002 20.5101 9.34591 20.5533 9.4006 20.5824C9.45528 20.6116 9.51676 20.6255 9.57865 20.6228C9.64053 20.6201 9.70056 20.6008 9.7525 20.567L14.2584 17.5592C14.3058 17.5283 14.3448 17.486 14.3718 17.4362C14.3988 17.3864 14.4129 17.3306 14.4129 17.2739C14.4129 17.2172 14.3988 17.1615 14.3718 17.1116C14.3448 17.0618 14.3058 17.0195 14.2584 16.9886Z" fill="#fff" />
                                    <path d="M13.4273 2.88801V1.71926C13.4263 1.65722 13.4088 1.59656 13.3765 1.5436C13.3442 1.49065 13.2983 1.44734 13.2436 1.4182C13.1888 1.38905 13.1273 1.37514 13.0654 1.37791C13.0035 1.38068 12.9434 1.40003 12.8915 1.43395L8.38565 4.44176C8.33876 4.4731 8.30031 4.51553 8.27372 4.5653C8.24713 4.61506 8.23322 4.67063 8.23322 4.72707C8.23321 4.7835 8.24712 4.83907 8.27371 4.88884C8.3003 4.93861 8.33874 4.98104 8.38563 5.01238L12.8915 8.02017C12.9434 8.05395 13.0035 8.07318 13.0653 8.07588C13.1272 8.07859 13.1887 8.06466 13.2434 8.03554C13.298 8.00643 13.3439 7.96319 13.3763 7.91032C13.4086 7.85745 13.4262 7.79688 13.4273 7.7349V6.58334C15.0064 6.66162 16.5156 7.25922 17.7208 8.28347C18.9261 9.30772 19.76 10.7014 20.0933 12.2483C19.8077 13.5901 19.1411 14.8207 18.1735 15.7924C18.1108 15.8574 18.0761 15.9445 18.077 16.035C18.078 16.1254 18.1144 16.2118 18.1785 16.2755C18.2426 16.3392 18.3292 16.3751 18.4195 16.3754C18.5099 16.3757 18.5967 16.3404 18.6612 16.2771C19.7324 15.1958 20.4668 13.8264 20.7751 12.3352C21.0835 10.8441 20.9526 9.29544 20.3982 7.87738C19.8439 6.45932 18.89 5.23293 17.6525 4.3472C16.415 3.46148 14.9471 2.95455 13.4273 2.88801Z" fill="#fff" />
                                </svg>
                            </div>
                        </div>
                        <?php
                        echo $warehouse_func->getTemplateLayoutsFor([
                            'name_layouts' => 'input_warehouse',
                            'class_form' => 'w-full',
                            'class' => 'input_date_import',
                            'lable' => "Ngày Nhập",
                            'placeholder' => "Chọn Ngày Nhập",
                            'data' => "import_date",
                            'value' => "",
                            'type' => 'text',
                            'save_cache' => false,
                            'required' => true,
                            'readonly' => false,
                        ]);
                        ?>
                        <div class="grid grid-cols-1 gap-4 mt-3 mb-3">
                            <div class="flex flex-wrap justify-between items-center text-sm text-gray-800">
                                <div class="">
                                    <span>
                                        Tổng Giá:
                                    </span>
                                </div>
                                <div class="text-red-600">
                                    <span class="total_price_format">
                                        0đ
                                    </span>
                                </div>
                            </div>
                            <input type="hidden" name="data[total_price]" value="0">
                            <div class="flex flex-wrap justify-between items-center text-sm text-gray-800">
                                <div class="">
                                    <span>
                                        Tổng Số Lượng:
                                    </span>
                                </div>
                                <div class="text-red-600">
                                    <span class="total_quantity_format">
                                        0
                                    </span>
                                </div>
                            </div>
                            <input type="hidden" name="data[total_quantity]" value="0">
                            <div class="flex flex-wrap justify-between items-center text-sm text-gray-800">
                                <div class="">
                                    <span>
                                        Trạng Thái:
                                    </span>
                                </div>
                                <div class="text-red-600">
                                    <span>
                                        Phiếu Tạm
                                    </span>
                                </div>
                            </div>
                        </div>
                        <?php
                        echo $warehouse_func->getTemplateLayoutsFor([
                            'name_layouts' => 'textarea_warehouse',
                            'class_form' => 'w-full',
                            'class' => '',
                            'lable' => "Ghi Chú",
                            'placeholder' => "Nhập Ghi Chú",
                            'data' => "note",
                            'value' => "",
                            'save_cache' => false,
                            'required' => false,
                            'readonly' => false,
                        ]);
                        ?>
                        <div class="flex-1"></div>
                        <div class="flex justify-start items-center gap-2 text-sm sm:text-base">
                            <button type="submit" name="submit-add-data" value="save-tmp" class="px-4 h-9  font-normal rounded-md  text-white bg-blue-500 hover:bg-blue-600 transition-all duration-300 inline-flex justify-center items-center gap-2 cursor-pointer">
                                <i class="fas fa-file-alt"></i>
                                <span>Lưu Tạm</span>
                            </button>
                            <button type="submit" name="submit-add-data" value="save-success" class="px-4 h-9 font-normal rounded-md  text-white bg-green-500 hover:bg-green-600 transition-all duration-300 inline-flex justify-center items-center gap-2 cursor-pointer">
                                <i class="fas fa-check"></i>
                                <span>Hoàn Thành</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<script>
    // chặn enter
    function blockEnter(event) {
        if (event.key === "Enter" || event.keyCode === 13) {
            event.preventDefault();
        }
    } // giới hàng số lượng
    function limitInput(input) {
        input.value = input.value.replace(/^0+/, '');
        if (input.value.length > 3) {
            input.value = input.value.slice(0, 5); // Cắt bỏ phần vượt quá 3 chữ số
        } else if (input.value.length <= 0) {
            input.value = 1;
        }
    }

    function handleProduct(form = null, id = null, quantity = null, list_product = []) {
        $.ajax({
            url: 'ajax/warehouse/handleProduct.php',
            type: 'POST',
            data: {
                src: '<?= $_SRC ?>',
                type: '<?= $_TYPE ?>',
                form: form,
                value: id,
                quantity: quantity,
                list_product: list_product,
            },
            dataType: "json",
            beforeSend: function() {
                loadApplication(true);
            },
            success: function(data) {
                $('body').find('#list_product').html(data.html.html);
                $('body').find('.total_price_format').text(data.data.sum_price_format);
                $('body').find(' input[name="data[total_price]"]').val(data.data.sum_price);
                $('body').find('.total_quantity_format').text(data.data.total_quanity_format);
                $('body').find(' input[name="data[total_quantity]"]').val(data.data.total_quanity);
                _FRAMEWORK.Lazys();
            },
            complete: function() {
                loadApplication(false);
            }
        });
    }
    $(document).ready(function() {
        // random code
        $('body').on('click', '.button_random', function() {
            var _this = $(this);
            if (!_this.hasClass('on')) {
                _this.addClass('on');
                $.ajax({
                    url: 'ajax/warehouse/handleCode.php',
                    type: 'POST',
                    data: {
                        com: '<?= $com ?>',
                        src: '<?= $_SRC ?>',
                        type: '<?= $_TYPE ?>',
                        act: '<?= $_ACT ?>',
                    },
                    dataType: 'Json',
                    beforeSend: function() {

                    },
                    success: function(result) {
                        if ($(_this).siblings('.form_inputcode').find('input[name="data[code]"]').length > 0) {
                            $(_this).siblings('.form_inputcode').find('input[name="data[code]"]').val(result.data.code).trigger('input');
                        }
                    },
                    complete: function() {
                        setTimeout(function() {
                            _this.removeClass('on');
                        }, 500);
                    },
                });
            }
        });
        $('body input[name="data[code]"]').each(function() {
            if (($(this).val() === '') && $(this).closest('.form_inputcode').siblings('.button_random').length > 0) {
                $(this).closest('.form_inputcode').siblings('.button_random').trigger('click');
            }
        });
        // end
        // tìm kiếm nâng cao
        var typingTimer;
        var time_addkeywords = 300;

        $('body').on('input', 'input[name="search_product"]', function() {
            if ($('body').find('.view_input').length > 0) {
                var _this = $(this);
                clearTimeout(typingTimer);
                $('body').find('.view_load_search').css('display', 'block');
                $('body').find('.close_view_search').css('display', 'none');
                typingTimer = setTimeout(function() {
                    var value = _this.val();
                    $.ajax({
                        url: 'ajax/warehouse/handleProduct.php',
                        type: 'POST',
                        data: {
                            src: '<?= $_SRC ?>',
                            type: '<?= $_TYPE ?>',
                            act: '<?= $_ACT ?>',
                            value: value,
                            form: 'search',
                        },
                        dataType: "json",
                        beforeSend: function() {},
                        success: function(data) {
                            $('body').find('.view_input').html(data.html.html);
                            $('body').find('.view_load_search').css('display', 'none');
                            if (value.length > 0) {
                                $('body').find('.close_view_search').css('display', 'block');
                            } else {
                                $('body').find('.close_view_search').css('display', 'none');
                            };
                            _FRAMEWORK.Lazys();
                        },
                        complete: function() {}
                    });
                }, time_addkeywords);
            }
        });
        $('body').on('click', '.close_view_search', function() {
            var _this = $(this);
            $('body').find('.view_input>div').remove();
            $('body').find('input[name="keywords_product"]').val('');
            $('body').find('.close_view_search').css('display', 'none');
        });
        // thêm
        $('body').on('click', ' .add_list_product', function() {
            var _this = $(this);
            var id = $(this).data('value');
            var quantity = $(this).siblings('.form_quantity').find('input[name="quantity"]').val();
            var list_product = [];
            $('body #list_product input[name="data[list_id_product][]"]').each(function() {
                let _this_name = $(this);
                let product = _this_name.val(); // Lấy giá trị của 'data-value' từ phần tử hiện tại
                list_product.push(product);
            });
            if (id > 0) {
                handleProduct("add", id, quantity, list_product);
            }
        });
        // xóa
        $('body').on('click', ' .remove_list_product', function() {
            var _this = $(this);
            _this.closest('.template-default').remove();
            var list_product = [];
            $('body #list_product input[name="data[list_id_product][]"]').each(function() {
                let _this_name = $(this);
                let product = _this_name.val(); // Lấy giá trị của 'data-value' từ phần tử hiện tại
                list_product.push(product);
            });
            handleProduct("list", null, null, list_product);
        });
        // tăng giảm số lượng
        $('body').on('click', '.increase_quantity', function() {
            let _this = $(this);
            let value_qty = parseInt(_this.siblings('.form_value_quantity').find('input[name="quantity"]').val());
            if (!isNaN(value_qty) && value_qty < 99999) {
                _this.siblings('.form_value_quantity').find('input[name="quantity"]').val(value_qty + 1).trigger('change');
            }
        });

        $('body').on('click', '.reduce_quantity', function() {
            let _this = $(this);
            let value_qty = parseInt(_this.siblings('.form_value_quantity').find('input[name="quantity"]').val());
            if (!isNaN(value_qty) && value_qty > 1) {
                _this.siblings('.form_value_quantity').find('input[name="quantity"]').val(value_qty - 1).trigger('change');
            }
        });
        $('body').on('change', 'input[name="quantity"]', function() {
            let _this = $(this);
            let value_qty = parseInt(_this.val());
            if (!isNaN(value_qty) && value_qty >= 1 && value_qty <= 99999 && _this.closest('.form_quantity').siblings('input[name="data[list_id_product][]"]').length > 0) {
                let value_data = _this.closest('.form_quantity').siblings('input[name="data[list_id_product][]"]').val();
                let data = JSON.parse(value_data);
                data.quantity = value_qty;
                _this.closest('.form_quantity').siblings('input[name="data[list_id_product][]"]').val(JSON.stringify(data));
                let list_product = [];
                $('body #list_product input[name="data[list_id_product][]"]').each(function() {
                    let _this_name = $(this);
                    let product = _this_name.val(); // Lấy giá trị của 'data-value' từ phần tử hiện tại
                    list_product.push(product);
                });
                handleProduct("list", null, null, list_product);
            }
        });
    })
</script>