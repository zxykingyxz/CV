<div class="header-navbar__box">
    <div class="">
        <ul class="flex flex-wrap items-center justify-center gap-[33px]">
            <li>
                <a href="" rel="dofollow" role="link" aria-label="Trang chủ" title="Trang chủ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                        <path d="M18.4877 8.26408C18.4873 8.26365 18.4869 8.26321 18.4864 8.26278L10.7359 0.512573C10.4056 0.182068 9.96635 0 9.49915 0C9.03195 0 8.59272 0.181923 8.26222 0.512428L0.515782 8.25872C0.513173 8.26133 0.510563 8.26408 0.507954 8.26669C-0.170452 8.94901 -0.169292 10.0561 0.511288 10.7366C0.822224 11.0477 1.23289 11.2279 1.67197 11.2467C1.6898 11.2485 1.70778 11.2494 1.7259 11.2494H2.0348V16.953C2.0348 18.0817 2.95311 19 4.08205 19H7.11429C7.4216 19 7.67093 18.7508 7.67093 18.4434V13.9717C7.67093 13.4566 8.08986 13.0377 8.6049 13.0377H10.3934C10.9084 13.0377 11.3274 13.4566 11.3274 13.9717V18.4434C11.3274 18.7508 11.5765 19 11.884 19H14.9162C16.0452 19 16.9635 18.0817 16.9635 16.953V11.2494H17.2499C17.717 11.2494 18.1562 11.0674 18.4869 10.7369C19.1682 10.0552 19.1685 8.94626 18.4877 8.26408Z" fill="#11CDF5" />
                    </svg>
                </a>
            </li>
            <?php foreach ($authArrs as $key => $value) {
                if (!in_array($key, $notShowMenu)) {
            ?>
                    <?= $func->getTemplateLayoutsFor([
                        'name_layouts' => 'li_menu',
                        'class_form' => '',
                        'title' => (!empty($value['title'])) ? $value['title'] : '',
                        'level' => (!empty($value['level'])) ? $value['level'] : '',
                        'full' => (!empty($value['menu_full'])) ? $value['menu_full'] : '',
                        'type' => (!empty($key)) ? $key : '',
                    ]) ?>
            <?php }
            } ?>
            <li class="flex gap-5 items-center">
                <div class="flex items-center justify-center">
                    <span class="search-Click hover:bg-[var(--html-bg-website)] hover:text-white hover:border-inherit text-[#000000a3] w-8 aspect-[1/1] border border-[#000000a3] rounded-[50%] inline-flex justify-center items-center transition-all cursor-pointer">
                        <i class="fa-regular fa-magnifying-glass text-sm"></i>
                    </span>
                </div>
                <?php if ($config['cart']['turn_on']) { ?>
                    <div class="menu-cart relative flex justify-between items-center">
                        <a class="relative icons_cart inline-flex justify-center items-center w-6 aspect-[1/1] " href="carts?src=gio-hang" title="Giỏ hàng">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="21" viewBox="0 0 18 21" fill="none">
                                <path d="M-0.00195312 5.2593H17.1436V16.962C17.141 18.9785 15.507 20.6124 13.4908 20.615H3.65113C1.63467 20.6125 0.000708994 18.9785 -0.00191371 16.9622V16.962L-0.00195312 5.2593ZM15.7668 6.63612H1.37485V16.962C1.37642 18.2185 2.3946 19.2367 3.65098 19.2383H13.4906C14.7471 19.2367 15.7653 18.2185 15.7669 16.9621V16.962L15.7668 6.63612ZM12.7654 8.57278H11.3886V4.19461C11.3886 2.63838 10.1271 1.37678 8.57081 1.37678C7.01456 1.37678 5.75298 2.63838 5.75298 4.19463V8.5728H4.37622V4.19461C4.37622 1.87799 6.2542 0 8.57081 0C10.8874 0 12.7654 1.87799 12.7654 4.19461V8.57278Z" fill="black" />
                            </svg>
                            <span class="view-cart absolute flex items-center justify-center bottom-[80%] left-[80%] px-1.5 rounded-full bg-main text-white"><?= $cart->getTotalQuality() ?></span>
                        </a>
                    </div>
                <?php } ?>
            </li>
            <?php if ($config['lang_check'] || $config['gg_lang']) { ?>
                <li>
                    <?php include _layouts . "langweb.php"; ?>
                </li>
            <?php } ?>

            <li class="flex gap-2">
                <a href="<?= $url_login_form ?>" class="text-blue-500 bg-blue-500 font-semibold text-base border  border-blue-500 rounded-full bg-inherit hover:bg-blue-600 hover:border-inherit hover:text-white inline-flex justify-center items-center text-center transition-all h-9 px-3 sm:px-6" target="_blank" title=" <?= _dangky ?>">
                    <span>
                        <?= "Đăng Nhập" ?>
                    </span>
                </a>
                <a href="<?= $url_sign_up_form ?>" class="text-blue-500 font-semibold text-base border border-blue-500 rounded-full bg-inherit hover:bg-blue-600 hover:border-inherit hover:text-white inline-flex justify-center items-center text-center transition-all h-9 px-3 sm:px-6" target="_blank" title=" <?= _dangky ?>">
                    <span>
                        <?= _dangky ?>
                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>