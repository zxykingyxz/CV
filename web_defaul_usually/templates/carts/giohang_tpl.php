<?php
?>
<section class="carts mt-5 pt-3 pb-5 ">
	<div class="grid_s wide">
		<?php if (empty($_SESSION['cart']) || count($_SESSION['cart']) == 0) { ?>
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
				<div class=" mt-2 w-full lg:w-3/12 md:w-4/12 ">
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
							<a href="<?= $func->getType('carts') . "?src=thanh-toan" ?>" class="text-sm sm:text-base font-bold font-main-700 rounded-md h-10 sm:h-12 overflow-hidden px-3 bg-[var(--html-bg-website)] flex  justify-center items-center text-white hover:brightness-125  capitalize transition-all duration-300">
								<?= 'Thanh toán' ?>
							</a>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</section>