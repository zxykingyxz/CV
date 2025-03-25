
<?php
if ($func->isAjax()) {
	$src = isset($_POST['src']) ? addslashes($_POST['src']) : '';
	switch ($src) {
		case 'addCart':
			$pid = isset($_POST['pid']) ? addslashes($_POST['pid']) : '';
			$chech_add = $db->rawQueryOne("select id from #_baiviet where id=? AND (id_loai=2)", array($pid));
			if (empty($chech_add)) {
				$qty = isset($_POST['quality']) ? addslashes($_POST['quality']) : '';
				$check = isset($_POST['check']) ? addslashes($_POST['check']) : '';
				$attribute = isset($_POST['attribute']) ? $_POST['attribute'] : '';
				$cart->addToCart($pid, $attribute, $qty);
				$result['cart'] = $_SESSION['cart'];
				$result['count-cart'] = count($_SESSION['cart']);
				$result = $cart->getPrice_All($result);
				if (filter_var($check, FILTER_VALIDATE_BOOLEAN) == true) {
					$result['url'] = 'carts?src=thanh-toan';
				} else {
					$result['url'] = 'carts?src=gio-hang';
				}
				$result['status'] = 200;
			} else {
				$result['status'] = 201;
				$result['message'] = 'Sản phẩm đã hết hàng!';
			}

			echo json_encode($result);
			break;
		case 'checkCart':
			$result = array();
			$check = $_POST['list_check'];
			foreach ($_SESSION['cart'] as $k => $v) {
				if (!empty($check)) {
					if (in_array($v['code'], $check)) {
						$_SESSION['cart'][$k]['checked'] = 1;
					} else {
						$_SESSION['cart'][$k]['checked'] = 0;
					}
				} else {
					$_SESSION['cart'][$k]['checked'] = 0;
				}
			}
			$result = $cart->getPrice_All($result);
			echo json_encode($result);
			break;
		case 'updateCart':
			$code = (string)$_POST['code'];
			$qty = (string)$_POST['qty'];
			$pid = (int)$_POST['pid'];
			if ($cart->updateQuality($code, $qty)) {
				$result['qty-product'] = $qty;
				foreach ($_SESSION['cart'] as $k  => $v) {
					if ($v['code'] == $code) {
						$attribute = $v['attribute'];
					};
				};
				$result = $cart->getPrice_All($result);
				$result['total-items-price'] = $cart->numbMoney(($cart->getPrice($pid, $attribute) * $qty), ' ₫');
			}
			echo json_encode($result);
			break;
		case 'updateAttributeCart':
			$code = (string)$_POST['code'];
			$qty = (string)$_POST['qty'];
			$pid = (int)$_POST['pid'];
			$id = (int)$_POST['id'];
			$type = (string)$_POST['type'];
			$name = $cart->getProductName($pid, 'ten_' . $lang);
			if ($cart->updateAttributeCart($code, $id, $type)) {
				$attribute = $cart->arrangeAttributeCart($code);
				$result = $cart->getPrice_All($result);
				$result['qty-product'] = $qty;
				$result['items-price'] = $cart->numbMoney(($cart->getPrice($pid, $attribute['session']) * 1), ' ₫');
				$result['total-items-price'] = $cart->numbMoney(($cart->getPrice($pid, $attribute['session']) * $qty), ' ₫');
			}
			$result['html'] = $cart->getTemplateLayoutsFor([
				'name_layouts' => 'getTemplateNameCart',
				'options' => $attribute['options'],
				'name' => $name,
				'pid' => $pid,
				'attribute' => $attribute['session'],
				'code' => $code,
			], false);
			echo json_encode($result);
			break;
		case 'deleteCart':
			$code = explode(',', $_POST['code']);
			foreach ($code as $k => $v) {
				$cart->removeProduct($v);
			}
			$result['count-cart'] = count($_SESSION['cart']);
			$result = $cart->getPrice_All($result);
			$result['code'] = $code;
			$result['url'] = 'san-pham';
			echo json_encode($result);
			break;
		case 'update-dist':
			$value = $_POST['value'];
			$result_dist = $db->rawQuery("select id, name_$lang from #_place_dists where id_city=? order by id asc", array($value));
			$html = $cart->getTemplateLayoutsFor([
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
			]);
			echo $html;
			break;
		case 'couponCart':
			if (($config['cart']['coupon_cart']) == true) {
				$coupon = htmlspecialchars($_POST['coupon']);
				if (!empty($_SESSION['coupons'])) {
					unset($_SESSION['coupons']);
					$html = "";
					$result['message'] = _huyapdungmagiamgiathanhcong;
					$result['status'] = 'success';
					$result['check'] = 'cancel';
				} else {
					$coupon_item = $db->rawQueryOne("select * from #_coupons where code=?", array($coupon));
					$current_time = time();
					if (empty($coupon)) {
						// kiểm tra coupons có được nhập không
						$html = "";
						$result['message'] = _banchuanhapmagiamgia;
						$result['status'] = 'error';
						$result['check'] = 'error';
					} else if (empty($coupon_item)) {
						// kiểm tra coupons có đúng không
						$html = "";
						$result['message'] = _magiamgiakhonghople;
						$result['status'] = 'error';
						$result['check'] = 'error';
					} else if (($current_time < (int)$coupon_item['start_date']) || ($current_time > (int)$coupon_item['end_date'])) {
						// kiểm tra thời hạn coupons
						$html = "";
						$result['message'] = _magiamgiadaquathoihang;
						$result['status'] = 'error';
						$result['check'] = 'error';
					} else if ($coupon_item['qty'] <= 0) {
						// kiểm tra số lượng coupons
						$html = "";
						$result['message'] = _magiamgiadahet;
						$result['status'] = 'error';
						$result['check'] = 'error';
					} else {
						// áp dụng coupons
						$_SESSION['coupons'] = $coupon;
						$html = "
						<i>(Đã Áp Dụng Mã Giảm Giá)</i>
						<span>
							Giảm Giá Sản Phẩm - <span class='view_price_coupons'>" . $cart->numbMoney($cart->getTotalOrder_tmp() - $cart->getTotalOrder(), ' ₫') . "</span> 
						</span>
					";

						$result['message'] = _magiamgiadaduocapdung;
						$result['status'] = 'success';
						$result['check'] = 'apply';
					}
				}
				$result['html'] = $html;
				$result = $cart->getPrice_All($result);
				echo json_encode($result);
			}
			break;
		default:
			break;
	}
	exit;
} else {
	$src = isset($_REQUEST['src']) ? addslashes($_REQUEST['src']) : '';
	if ($src == 'thanh-toan') {
		if (isset($_POST["checkout"])) {

			if (count($cart->checkArrayChecked($_SESSION['cart'])) <= 0) {
				$func->transfer('Không có sản phẩm nào được thanh toán',  $func->getType('carts?src=gio-hang'));
			}
			$dataOrder = (!empty($_POST['dataOrder'])) ? $_POST['dataOrder'] : null;

			if (!empty($dataOrder)) {
				$order_code = strtoupper($func->randString(8));
				$order_date = time();
				$fullname = (!empty($dataOrder['fullname'])) ? htmlspecialchars($func->sanitize($dataOrder['fullname'])) : '';
				$phone = (!empty($dataOrder['phone'])) ? htmlspecialchars($func->sanitize($dataOrder['phone'])) : '';
				$email = (!empty($dataOrder['email'])) ? htmlspecialchars($func->sanitize($dataOrder['email'])) : '';
				$notes = (!empty($dataOrder['notes'])) ? htmlspecialchars($func->sanitize($dataOrder['notes'])) : '';
				/**
				 * place
				 */
				$city = (!empty($dataOrder['id_city'])) ? htmlspecialchars($dataOrder['id_city']) : 0;
				$district = (!empty($dataOrder['id_dist'])) ? htmlspecialchars($dataOrder['id_dist']) : 0;
				$ward = (!empty($dataOrder['id_ward'])) ? htmlspecialchars($dataOrder['id_ward']) : 0;
				$city_text = $func->getInfoDetail('name_' . $lang, "place_citys", $city);
				$district_text = $func->getInfoDetail('name_' . $lang, "place_dists", $district);
				$ward_text = $func->getInfoDetail('name_' . $lang, "place_wards", $ward);
				$address = htmlspecialchars($dataOrder['address']) . ', ' . $district_text['name_' . $lang] . ', ' . $city_text['name_' . $lang];
				/**
				 * Payment
				 */
				$order_payment = (!empty($dataOrder['payment'])) ? htmlspecialchars($dataOrder['payment']) : 0;
				$order_payship = (!empty($dataOrder['payship'])) ? htmlspecialchars($dataOrder['payship']) : 0;
				$order_payment_text = $func->getFieldOne('ten_' . $lang, 'baiviet', $dataOrder['payment']);
				$order_payship_text = $func->getFieldOne('ten_' . $lang, 'baiviet', $dataOrder['payship']);

				/** 
				 * price 
				 */
				$temp_price = $cart->getTotalOrder_tmp();

				$total_price = $cart->getTotalOrder();

				// coupons 
				if (!empty($_SESSION['coupons']) && (($config['cart']['coupon_cart']) == true)) {
					$coupons_content = "Giảm giá sản phẩm -" .  $cart->numbMoney($temp_price - $total_price, ' ₫');
				}
				/**
				 * Cart
				 */
				$order_detail = '';

				$max = (!empty($_SESSION['cart'])) ? count($_SESSION['cart']) : 0;
			}

			/**
			 * validate
			 */
			if (empty($order_payment)) {

				$response['messages'][] = 'Bạn chưa chọn hình thức thanh toán';
			}
			if (empty($order_payship)) {

				$response['messages'][] = 'Bạn chưa chọn hình thức giao hàng';
			}
			if (empty($fullname)) {

				$response['messages'][] = 'Bạn chưa nhập họ tên';
			}
			if (empty($phone)) {

				$response['messages'][] = 'Bạn chưa nhập số điện thoại';
			}
			if (!$func->isPhone($phone)) {

				$response['messages'][] = 'Số điện thoại không đúng định dạng';
			}
			if (empty($email)) {

				$response['messages'][] = 'Bạn chưa nhập email';
			}
			if (!$func->isEmail($email)) {

				$response['messages'][] = 'Email không đúng định dạng';
			}
			if (empty($city)) {

				$response['messages'][] = 'Bạn chưa chọn tỉnh/thành phố';
			}
			if (empty($district)) {

				$response['messages'][] = 'Bạn chưa chọn quận/huyện';
			}
			if (empty($address)) {

				$response['messages'][] = 'Bạn chưa nhập địa chỉ';
			}

			if (!empty($response)) {
				/* Flash data */
				if (!empty($dataOrder)) {
					foreach ($dataOrder as $k => $v) {
						if (!empty($v)) {
							$flash->set($k, $v);
						}
					}
				}
				/* Errors */
				$response['status'] = 'danger';
				$message = base64_encode(json_encode($response));
				$flash->set("message", $message);
				$urlpay = "carts?src=thanh-toan";
				$func->redirect($urlpay);
			}

			/* lưu đơn hàng */
			$data_donhang = array();
			$data_donhang['code'] = $order_code;
			$data_donhang['fullname'] = $fullname;
			$data_donhang['phone'] = $phone;
			$data_donhang['email'] = $email;
			$data_donhang['notes'] = $notes;
			$data_donhang['payment'] = $order_payment;
			$data_donhang['payship'] = $order_payship;
			$data_donhang['total_price_tmp'] = $temp_price;
			$data_donhang['total_price'] = $total_price;
			$data_donhang['coupons'] = $_SESSION['coupons'];
			$data_donhang['order_status'] = 1;
			$data_donhang['address'] = $address;
			$data_donhang['id_city'] = $city;
			$data_donhang['id_dist'] = $district;
			$id_insert = $db->insert('order', $data_donhang);

			/* lưu đơn hàng chi tiết */
			if ($id_insert) {
				for ($i = 0; $i < $max; $i++) {
					if ($_SESSION['cart'][$i]['checked'] === 1) {
						$value_product = $cart->getValueCart($_SESSION['cart'][$i]);
						$pid = $value_product->id;
						$q =  $value_product->qty;
						$attribute = $value_product->attribute;
						$proinfo = $value_product->info_product;
						$code = $value_product->code;
						$_price = $value_product->price;
						$old_price = $value_product->price_old;
						$options_product = $value_product->options_product;


						if ($q == 0) continue;
						$data_donhangchitiet = array();
						$data_donhangchitiet['id_product'] = $pid;
						$data_donhangchitiet['id_order'] = $id_insert;
						$data_donhangchitiet['photo'] = $proinfo['photo'];
						$data_donhangchitiet['name'] = $proinfo['ten_' . $lang];
						$data_donhangchitiet['code'] = $code;
						$data_donhangchitiet['price'] = $_price;
						$data_donhangchitiet['sale_off'] = $old_price;
						$data_donhangchitiet['qty'] = $q;
						$array_attribute = ['attribute' => []];
						foreach ($options_product['attribute'] as  $v_t) {
							$type = $func->returnUnsignedName($v_t);
							if (!empty($type)) {
								$option_check = $db->rawQueryOne("select id, ten_$lang as ten, type from #_attribute where id_product=? and id=? and type=?", array($pid, $attribute[$type], $type));
								if (!empty($option_check)) {
									$array_attribute['attribute'][$v_t] = array('type' => $option_check['type'], 'id' => $option_check['id']);
								};
							};
						};

						$data_donhangchitiet['options'] = json_encode($array_attribute, JSON_UNESCAPED_UNICODE);

						$db->insert('order_detail', $data_donhangchitiet);

						// email đơn hàng chi tiết
						if (!empty($proinfo['masp'])) {
							$text_attr = 'Mã sp: <b>' . $proinfo['masp'] . '</b><br>';
						} else {
							$text_attr = 'Mã sp: <b> Đang được cập nhật</b><br>';
						}
						foreach ($options_product['attribute'] as  $v_t) {
							$type = $func->returnUnsignedName($v_t);
							$option_check = $db->rawQueryOne("select id, ten_$lang as ten,type from #_attribute where id_product=? and id=? and type=? ", array($pid, $attribute[$type], $type));
							if (!empty($option_check)) $text_attr .=  "<span style='text-transform: capitalize;'>" . $v_t . ': ' . $option_check['ten'] .  "</span> - ";
						}

						$text_attr = trim($text_attr, ' - ');
						if ($q == 0) continue;
						/* Variables detail order */
						$orderDetailVars = array(
							'{productName}',
							'{productAttr}',
							'{productSalePrice}',
							'{productRegularPrice}',
							'{productQuantity}',
							'{productSaleTotalPrice}',
							'{productRegularTotalPrice}'
						);

						/* Values detail order */
						$orderDetailVals = array(
							$_name,
							$text_attr,
							$func->changeMoney($_price, $lang),
							$func->changeMoney($old_price, $lang),
							$q,
							$func->changeMoney($_price * $q, $lang),
							$func->changeMoney($old_price * $q, $lang)
						);

						/* Get order details */
						$order_detail .= str_replace($orderDetailVars, $orderDetailVals, $classEmail->markdown('order/details', ['productAttr' => $text_attr, 'salePrice' => $_price]));
					}
				}
			}
			/* Total order */
			/* Variables total order */
			$orderTotalVars = array(
				'{orderTempPrice}',
				'{orderShipPrice}',
				'{orderTotalPrice}'
			);

			/* Values total order */
			$orderTotalVals = array(
				$func->changeMoney($temp_price, $lang),
				$func->changeMoney($ship_price, $lang),
				$func->changeMoney($total_price, $lang)
			);

			/* Get total order */
			$order_detail .= str_replace($orderTotalVars, $orderTotalVals, $classEmail->markdown('order/total', ['shipPrice' => $ship_price]));

			/* Defaults attributes email */
			$emailDefaultAttrs = $classEmail->defaultAttrs();

			/* Variables email */
			$emailVars = array(
				'{emailOrderCode}',
				'{emailOrderInfoFullname}',
				'{emailOrderInfoEmail}',
				'{emailOrderInfoPhone}',
				'{emailOrderInfoAddress}',
				'{emailOrderPayment}',
				'{emailOrderPayship}',
				'{emailOrderShipPrice}',
				'{emailOrderInfoRequirements}',
				'{emailOrderDetails}'
			);
			$emailVars = $classEmail->addAttrs($emailVars, $emailDefaultAttrs['vars']);

			/* Values email */
			$emailVals = array(
				$order_code,
				$fullname,
				$email,
				$phone,
				$address,
				$order_payment_text,
				$order_payship_text,
				$ship_price,
				$notes,
				$order_detail
			);
			$emailVals = $classEmail->addAttrs($emailVals, $emailDefaultAttrs['vals']);

			/* Send email admin */
			$arrayEmail = null;
			$subject = "Đơn hàng từ Khách Hàng " . $fullname;
			$message = str_replace($emailVars, $emailVals, $classEmail->markdown('order/admin', ['shipPrice' => $ship_price,  'coupons_content' => $coupons_content]));
			$file = '';
			$classEmail->sendEmail("admin", $arrayEmail, $subject, $message, $file);

			/* Send email customer */
			$arrayEmail = array(
				"dataEmail" => array(
					"name" => $fullname,
					"email" => $email
				)
			);
			$subject = "Đơn hàng từ " . $row_setting['website'];
			$message = str_replace($emailVars, $emailVals, $classEmail->markdown('order/customer', ['shipPrice' => $ship_price, 'coupons_content' => $coupons_content]));
			$file = '';
			$classEmail->sendEmail("customer", $arrayEmail, $subject, $message, $file);

			// Giảm số lượng coupons
			if (!empty($_SESSION['coupons']) && (($config['cart']['coupon_cart']) == true)) {
				$coupon_item = $db->rawQueryOne("select * from #_coupons where code=?", array($_SESSION['coupons']));
				(int)$coupon_item['qty'] -= 1;
				$used_qty = $coupon_item['used_qty'];
				if (!empty($used_qty)) {
					(int)$used_qty += 1;
				} else {
					$used_qty = 1;
				}
				$db->rawQueryOne("update #_coupons set qty=?, used_qty=?  where code=?", array($coupon_item['qty'], $used_qty, $_SESSION['coupons']));
				unset($_SESSION['coupons']);
			}
			/* Xóa giỏ hàng */
			foreach ($_SESSION['cart'] as $k => $v) {
				if ($v['checked'] === 1) {
					unset($_SESSION['cart'][$k]);
				}
			}
			if (!empty($_SESSION['cart'])) {
				$_SESSION['cart'] = array_values($_SESSION['cart']);
			}
			$func->_unsetCookie('_CART_');
			if ($id_insert) {
				$func->transfer("Thông tin đơn hàng đã được gửi thành công. vui lòng kiểm tra hòm thư để biết thông tin tài khoản", $type);
			} else {

				$func->transfer("Thông tin đơn hàng đã được gửi không thành công.", $type);
			}
		}
	}
}
?>