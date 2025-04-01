<header class=" hidden lg:block py-1  bg-white w-full sticky top-0 left-0  z-40   header_menu [&.animate]:shadow-lg  group/header transition-all duration-300 ">
    <div class="grid_s wide   relative  opacity_animaiton ">
        <div class="flex relative items-center  transition-all duration-300 gap-[70px]">
            <div class="w-[105px] leading-[0]">
                <?= $func->addHrefImg([
                    'classfix' => '',
                    'addhref' => true,
                    'href' =>   '',
                    'sizes' => '105x72x2',
                    'actual_width' => 300,
                    'isLazy' => true,
                    'upload' => _upload_hinhanh_l,
                    'image' => ($logo["photo"]),
                    'alt' => (isset($row_setting["name_$lang"])) ? $row_setting["name_$lang"] : $row_setting["name"],
                ]); ?>
            </div>
            <div class="flex-1">
                <?php include _layouts . "pc/menu.php"; ?>
            </div>
            <div class="flex-initial inline-flex items-center gap-[30px]">
                <div class="search-Click flex items-center justify-center w-[36px] rounded-full text-black cursor-pointer  aspect-[1/1]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <g clip-path="url(#clip0_1_3)">
                            <path d="M19.8104 18.9119L14.6468 13.8308C15.999 12.3616 16.8298 10.4187 16.8298 8.28068C16.8291 3.7071 13.062 0 8.41466 0C3.76732 0 0.00019455 3.7071 0.00019455 8.28068C0.00019455 12.8543 3.76732 16.5614 8.41466 16.5614C10.4226 16.5614 12.2643 15.8668 13.7109 14.7122L18.8946 19.8134C19.1472 20.0622 19.5573 20.0622 19.8098 19.8134C20.063 19.5646 20.063 19.1607 19.8104 18.9119ZM8.41466 15.2873C4.48251 15.2873 1.29488 12.1504 1.29488 8.28068C1.29488 4.41101 4.48251 1.27403 8.41466 1.27403C12.3469 1.27403 15.5344 4.41101 15.5344 8.28068C15.5344 12.1504 12.3469 15.2873 8.41466 15.2873Z" fill="currentColor" />
                        </g>
                    </svg>
                </div>
                <?php if ($config['cart']['turn_on'] != false) { ?>
                    <a href="<?= $func->getType('carts') . '?src=gio-hang' ?>" title="Giỏ hàng" class="relative block  text-black">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="25" viewBox="0 0 20 25" fill="none">
                            <path d="M0 6.91489H20V20.6683C19.9968 23.1886 18.8093 24.9967 16.3158 25H3.68421C1.19046 24.9968 0.00324349 23.1881 0 20.6681V6.91489ZM18.9474 7.97872H1.01626V20.6681C1.01821 22.2386 2.0838 23.9342 3.63756 23.9362H16.3158C17.8697 23.9342 18.9454 22.315 18.9474 20.7447V7.97872ZM14.7368 7.97872H13.6842V4.25532C13.6842 2.31026 11.9246 1.06383 10 1.06383C8.07539 1.06383 6.31579 2.31024 6.31579 4.25532V7.97872H5.26316V4.78723C5.26316 1.89181 7.13505 0 10 0C12.865 0 14.7368 1.89181 14.7368 4.78723V7.97872Z" fill="currentColor" />
                        </svg>
                        <div class="  absolute inline-flex items-center justify-center bg-red-500 top-[0%] right-[-5px] h-[18px] min-w-[18px] px-[3px] pt-[3px]  translate-x-[25%] translate-y-[-25%] rounded-full bg-main text-white  leading-[0]">
                            <span class="view-cart text-[12px] leading-none">
                                <?= $cart->getTotalQuality() ?>
                            </span>
                        </div>
                    </a>
                <?php } ?>
                <?= $sample->getTemplateLayoutsFor([
                    'name_layouts' => 'ggLangWeb',
                    'form' => '',
                ]) ?>
            </div>
        </div>
    </div>
</header>