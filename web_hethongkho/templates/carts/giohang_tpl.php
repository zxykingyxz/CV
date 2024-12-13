<section class="carts mt-5 pt-2.5 pb-5 bg-bray">
	<div class="grid_s wide">
		<?php if (is_array($_SESSION['cart']) && count($_SESSION['cart']) == 0) { ?>
			<?= $cart->getTemplateLayoutsFor([
				'name_layouts' => 'no_data',
			], true); ?>
		<?php } else { ?>
			<div class=" flex flex-wrap gap-3">
				<div class="flex-1">
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
				<div class=" w-full lg:w-3/12 md:w-4/12 ">
					<div class="box-total-cart-price mt-2.5 sticky-cart">
						<div class="shadown--cart bg-white">
							<ul class="prices__items">
								<li class="prices__item"><span class="prices__text"><?= _tamtinh ?></span><span class="prices__value"><span id="js-price-temp"><?= $cart->numbMoney($cart->getTotalOrder(), ' ₫') ?></span></span>
								</li>
							</ul>
							<div class="prices__total">
								<span class="prices__text"><?= _thanhtien ?></span>
								<span class="prices__value prices__value--final"><span id="js-total-cart"><?= $cart->numbMoney($cart->getTotalOrder(), ' ₫') ?></span><i>(<?= _dabaogomvatneuco ?>)</i>
								</span>
							</div>
						</div>
						<a href="<?= $func->getComUrl('carts?src=thanh-toan') ?>" class="cart__submit cs--btn-cart t-uppercase"><?= _thanhtoandonhang ?></a>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</section>