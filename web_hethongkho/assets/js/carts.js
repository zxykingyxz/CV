$.fn.closePopup = (id) => {
    $(id).remove();
};

$.fn.showPopup = (html) => {
    $('body').append(html);
};
var url_source = _ROOT + 'carts.js';

var selector = {

    // check tất cả sản phẩm
    checkAll: ' .check-all-product',

    // check từng sản phẩn
    checkBox: ' input[name="check-product"]',

    // tổng số lượng sản phẩn được check
    total_check_product: 'body .view-cart',

    // tổng số tiền 
    total_cart: 'body .total_cart',

    // tổng số tiền tạm tính
    total_tmp_cart: 'body .price-temp-cart',

    // thành tiền
    into_money: 'body .view-price',

    // thành tiền
    into_money_coupons: 'body .view_price_coupons',

    // các sản phẩm  trong giỏ hàng
    items_cart_product: 'body .item-cart-product',

    // số lượng từng sản phẩm
    number_cart_product: '.number_cart_product',

    // button tăng giảm só lượng
    button_qty_cart_product: '.btn_qty_product',

    // tổng giá tiền từng sản phẩm
    total_price_items_product: '.total_price_items_product',


    // giá tiền từng sản phẩm
    price_items_product: '.price_items_product',

    // xóa tất cả sản phẩm đã chọn
    delete_all_product: '.delete_all_product',

    // số lượng trang chi tiết
    qty1: '#qty',
    qty2: '#quantityInput',

    // submit thanh toán

    submit_pay: 'body button.cart__submit',

    // button phương thức 
    btn_pay: '.btn_pay',

    // button thuộc tính sản phẩm chi tiết sản phầm
    btn_attribute: '.btn_attribute',

    // option thuộc tính sản phẩm
    option_attribute: '.items_option_attribute',

    // button mã giảm giá
    btn_coupons: '.btn_coupons_ajax',

};

function view_Cart(data, $this = null) {
    if ($(selector.total_check_product).length) {
        $(selector.total_check_product).html(data['total-product']);
    }
    if ($(selector.total_cart).length) {
        $(selector.total_cart).html(data['price-string']);
        $(selector.total_cart).val(data['price-string']);
    }
    if ($(selector.total_tmp_cart).length) {
        $(selector.total_tmp_cart).html(data['price-string-tmp']);
    }
    if ($(selector.into_money).length) {
        $(selector.into_money).html(data['price-string']);
    }
    if ($(selector.into_money_coupons).length) {
        $(selector.into_money_coupons).html(data['price-string-coupons']);
    }
    if ($this instanceof jQuery) {
        $this.closest(selector.items_cart_product).find(selector.price_items_product).text(data['items-price']);

        $this.closest(selector.items_cart_product).find(selector.total_price_items_product).text(data['total-items-price']);

        $this.closest(selector.items_cart_product).find(selector.number_cart_product).val(data['qty-product']);

        $this.closest(selector.items_cart_product).find(selector.number_cart_product).text(data['qty-product']);
    }
}

function funcAddCart(el, check = false) {

    $.ajax({

        url: url_source,

        type: 'post',

        data: $(el).serialize() + '&check=' + check,

        dataType: 'json',

        success: function(data) {

            if (check) {

                window.location.href = data.url;

            } else {
                view_Cart(data);

                notiAlert(lang.cam_on_ban_da_mua);


            }
        }

    });

}

function funcDeleteCart(code, src) {
    var params = {
        code: code,
        src: src
    };
    $.ajax({
        url: url_source,
        type: 'post',
        data: params,
        dataType: 'json',
        beforeSend: function() {
            $('#loader').addClass('active');
        },
        success: function(res) {
            if (res['count-cart'] == 0) {
                redirect(res['url']);
            } else {
                view_Cart(res);
                $.each(res['code'], function(index, value) {
                    $(selector.items_cart_product).each(function() {
                        if ($(this).data('code') == value) {
                            $(this).remove();
                        }
                    });
                });
            }
        },
        complete: function() {
            $('#loader').removeClass('active');
        }
    });
};

function datacheck(list_check) {
    $.ajax({
        url: url_source,

        type: 'post',

        data: {

            list_check: list_check,

            src: 'checkCart',

        },
        dataType: 'json',

        beforeSend: function() {
            $('#loader').addClass('active');
        },
        success: function(res) {
            view_Cart(res);


        },
        complete: function() {
            $('#loader').removeClass('active');
        }
    });
    if (list_check.length > 0) {
        $(selector.submit_pay).prop('disabled', false);
    } else {
        $(selector.submit_pay).prop('disabled', true);
    }
};

function onChangeSelect(e, p) {

    $.ajax({

        url: url_source,

        type: 'POST',

        data: { p: p, src: 'load-place' },

        success: function(data) {

            $(e).html(data);

        }

    });

};
if (typeof _CART === 'undefined') {

    var _CART = {};
};
_CART.checkCart = () => {
    if (($('body ' + selector.checkBox + ':checked')).length > 0) {
        $('body ' + selector.checkAll).prop('checked', true);
    } else {
        $('body ' + selector.checkAll).prop('checked', false);
    }
    $('body').on('change', selector.checkBox, function() {
        let list_check = [];
        $('body ' + selector.checkBox).each(function() {
            if ($(this).is(':checked')) {
                if ($.inArray($(this).val(), list_check) === -1) {
                    list_check.push($(this).val());
                }
            } else {
                if (list_check.indexOf($(this).val()) !== -1) {
                    list_check.splice(list_check.indexOf($(this).val()), 1);
                }
            }
        });
        console.log(list_check);

        datacheck(list_check);
        if (($('body ' + selector.checkBox + ':checked')).length > 0) {
            $(selector.checkAll).prop('checked', true);
        } else {
            $(selector.checkAll).prop('checked', false);
        }
    });
    $('body').on('change', selector.checkAll, function() {
        let list_check = [];
        if ($('body ' + selector.checkAll).is(':checked')) {
            $('body ' + selector.checkBox).prop('checked', true);
            $('body ' + selector.checkBox).each(function() {
                list_check.push($(this).val());
            });
        } else {
            $('body ' + selector.checkBox).prop('checked', false);
            list_check = [];
        }
        datacheck(list_check);
    });
};
_CART.addCart = () => {

    $('body').on('click', '.btn-buynow', function(e) {

        e.preventDefault();

        var el = $(this).data('el');

        funcAddCart(el, true);

    });

    $('body').on('click', '.btn-addcart', function(e) {

        e.preventDefault();

        var el = $(this).data('el');

        funcAddCart(el, false);

    });
    $('body').on('click', '.js-addcart', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        var qty = $(this).attr('data-qty');
        $.ajax({
            url: url_source,
            type: 'POST',
            data: {
                pid: id,
                quality: qty,
                src: 'addCart'
            },
            dataType: 'json',
            beforeSend: function() {
                $('#loader').addClass('active');
            },
            success: function(res) {
                view_Cart(res)
            },
            complete: function() {
                $('#loader').removeClass('active');
                notiAlert(lang.them_vao_gio_hang_thanh_cong);
            }

        });

    });
    var selector = {
        'qty1': '#qty',
        'qty2': '#quantityInput',
    };
    $('.down').click(function() {
        var result = $(selector.qty1);
        var qty = parseInt(result.val());
        var t = 0;
        if (!isNaN(qty) && qty > 1) {
            t = --qty;
            result.val(t);
            $(selector.qty2).val(t);
        } else {
            return false;
        }
    });
    $('.up').click(function() {
        var result = $(selector.qty1);
        var qty = parseInt(result.val());
        var t = 0;
        if (!isNaN(qty) && qty < 999) {
            t = ++qty;
            result.val(t);
            $(selector.qty2).val(t);

        } else {
            return false;
        }
    });

};
_CART.deleteCart = () => {

    if (exists('body ' + selector.delete_all_product)) {

        $('body').on('click', selector.delete_all_product, function() {

            var code = $('.check-o input[type="checkbox"]:checked').map(function() {

                return this.value;

            }).get().join(',');

            if (code == '') {
                notiAlert(lang.chua_chon_san_pham);

            } else {

                $.confirm({

                    title: lang.xac_nhan,

                    content: lang.ban_co_chac_muon_xoa_muc_nay,

                    buttons: {

                        success: {

                            text: lang.dong_y,

                            btnClass: 'btn-blue',

                            action: function() {

                                funcDeleteCart(code, 'deleteCart');

                            }

                        },

                        cancel: {

                            text: lang.huy_ngay,

                            btnClass: 'btn-red'

                        }

                    }

                });

            }

        });

    }

    if (exists('.delCart')) {

        $('body').on('click', '.delCart', function() {

            var code = $(this).closest(selector.items_cart_product).data('code');

            $.confirm({

                title: lang.xac_nhan,

                content: lang.ban_muon_xoa_san_pham,

                buttons: {

                    success: {

                        text: lang.dong_y,

                        btnClass: 'btn-blue',

                        action: function() {

                            funcDeleteCart(code, 'deleteCart');

                        }

                    },

                    cancel: {

                        text: lang.huy_ngay,

                        btnClass: 'btn-red'

                    }

                }

            });



        });

    }

};
_CART.updateCart = () => {

    $('body').on('click', selector.button_qty_cart_product, function() {
        macth = $(this).data('macth');
        code = $(this).closest(selector.items_cart_product).data("code");
        pid = $(this).closest(selector.items_cart_product).data("id-product");
        qty_tmp = $(this).closest(selector.items_cart_product).find("input" + selector.number_cart_product).val();
        $this = $(this);
        switch (macth) {
            case 1:
                if (qty_tmp < 100) {
                    qty = ++qty_tmp;
                } else {
                    qty = 99;
                }
                break;
            case 0:
                if (qty_tmp > 1) {
                    qty = --qty_tmp;
                } else {
                    qty = 1;
                }
                break;
            default:
        };
        var params = {

            code: code,

            qty: qty,

            pid: pid,

            src: 'updateCart'

        };

        $.ajax({

            url: url_source,

            type: 'post',

            data: params,

            dataType: 'json',

            beforeSend: function() {

                $('#loader').addClass('active');

            },

            success: function(res) {
                view_Cart(res, $this)
            },

            complete: function() {
                $('#loader').removeClass('active');
            }

        });
    });

    $('body').on('click', selector.option_attribute, function() {
        id = $(this).data('id');
        type = $(this).data('type');
        code = $(this).closest(selector.items_cart_product).data("code");
        pid = $(this).closest(selector.items_cart_product).data("id-product");
        qty = $(this).closest(selector.items_cart_product).find("input" + selector.number_cart_product).val();
        $this = $(this);
        var params = {

            code: code,

            qty: qty,

            pid: pid,

            id: id,

            type: type,

            src: 'updateAttributeCart'
        };
        $.ajax({
            url: url_source,
            type: 'post',
            data: params,
            dataType: 'json',
            beforeSend: function() {
                $('#loader').addClass('active');
            },
            success: function(res) {
                view_Cart(res, $this);
                $this.closest('.form_name_cart').html(res.html);
            },
            complete: function() {
                $('#loader').removeClass('active');
            }
        });
    });

};
_CART.checkPayment = () => {
    $('body').on('click', selector.btn_pay, function() {
        var data_name_input = $(this).data('name-input');
        var data_id = $(this).data('id');
        $("input[name='" + data_name_input + "']").val(data_id);
    });
};
_CART.clickAttribute = () => {
    $('body').on('click', selector.btn_attribute, function() {
        var data_id = $(this).data('id-attribute');
        var data_form = $(this).data('form-attribute');
        var data_type = $(this).data('type');
        var data_id_product = $(this).data('id-product');

        $.ajax({

            url: 'ajax/ajaxAttribute.php',

            type: 'post',

            data: {
                id: data_id,
                type: data_type,
                id_product: data_id_product,
            },
            dataType: 'json',
            beforeSend: function() {
                $('#loader').addClass('active');
            },
            success: function(data) {
                $('body .price_product_js').html(data['price']);
                $('body .form_img_product_detail').html(data['photo']);
                $('body input[data-form-attribute="' + data_form + '"]').val(data_id);
                _FRAMEWORK.Lazys();
                _FRAMEWORK.loadWesite();
                _FRAMEWORK.lightSliderPage();
            },
            complete: function() {
                setTimeout(function() {
                    $('#loader').removeClass('active');
                }, 200)
            },

        });
    });

};
_CART.couponsCart = () => {
    $('body').on('input', 'input.input_coupons_ajax', function() {
        if (($(this).val()).length > 0) {
            $(this).closest('.form_coupons').find(selector.btn_coupons).css('pointer-events', 'all');
        } else {
            $(this).closest('.form_coupons').find(selector.btn_coupons).css('pointer-events', 'none');
        }
    });

    $('body').on('click', selector.btn_coupons, function() {
        var _this = $(this);
        var coupon = _this.closest('.form_coupons').find('input.input_coupons_ajax').val();
        var params = {
            coupon: coupon,
            src: 'couponCart',
        };
        $.ajax({

            url: url_source,

            type: 'post',

            data: params,

            dataType: 'json',

            success: function(data) {
                switch (data.check) {
                    case 'apply':
                        _this.closest('.form_coupons').find('input.input_coupons_ajax').prop('disabled', true);
                        _this.text('Hủy');
                        break;
                    case 'cancel':
                        _this.closest('.form_coupons').find('input.input_coupons_ajax').prop('disabled', false);
                        _this.text('Áp Dụng');
                        break;
                    case 'error':
                        _this.text('Áp Dụng');
                        break;
                    default:
                }
                view_Cart(data);
                notiAlert(data.message, data.status);
                $('body .form_text_result_coupons').html(data.html);

            }
        });
    });
};
$(document).ready(function() {
    _CART.addCart();
    _CART.deleteCart();
    _CART.updateCart();
    _CART.checkCart();
    _CART.checkPayment();
    _CART.clickAttribute();
    _CART.couponsCart();
});