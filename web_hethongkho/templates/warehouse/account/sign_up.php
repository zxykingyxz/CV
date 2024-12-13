<section class="section-sign_up">
    <div class="grid_x wide no_p">
        <div class="flex justify-center items-center h-[100vh] ">
            <div class="w-1/2 hidden lg:flex h-full bg-blue-600 text-3xl text-center text-white leading-relaxed font-semibold justify-center items-center px-[8%] ">
                <span>Chào Mừng Bạn Đến Với Hệ Thống Quản Lý Kho I-Web</span>
            </div>
            <form action="" name="form-validate-warehouse-sign_up" method="POST" class="form-validate-warehouse-sign_up bg-blue-600 lg:bg-white flex flex-col flex-1 py-6  h-full justify-center items-center">
                <div class="rounded-xl bg-white shadow shadow-gray-400 py-6 pl-3 pr-2 sm:pl-4 sm:pr-3 min-w-[300px] w-[calc(100%-20px)] sm:w-[70%] max-h-[700px] h-[92%] ">
                    <div class=" w-full text-center text-xl sm:text-2xl font-semibold mb-6 sm:mb-9">
                        <span>
                            Tạo tài khoản dùng thử miển phí
                        </span>
                    </div>
                    <div class=" overflow-x-hidden overflow-y-auto w-full scroll-y max-h-[calc(100%-56px)] sm:max-h-[calc(100%-68px)] p-[2px] pr-1">
                        <div class="flex  flex-wrap gap-3 ">
                            <?php
                            echo $warehouse_func->getTemplateLayoutsFor([
                                'name_layouts' => 'input_warehouse',
                                'class_form' => 'w-full',
                                'lable' => 'Họ và Tên',
                                'placeholder' => 'Nhập Họ và Tên',
                                'data' => 'fullname',
                                'value' => (!empty($_SESSION[$sessison_account_warehouse_tmp]['name'])) ? $_SESSION[$sessison_account_warehouse_tmp]['name'] : "",
                                'type' => 'text',
                                'save_cache' => false,
                                'required' => true,
                            ]);
                            echo $warehouse_func->getTemplateLayoutsFor([
                                'name_layouts' => 'input_warehouse',
                                'class_form' => 'w-full',
                                'lable' => 'Số Điện Thoại',
                                'placeholder' => 'Nhập Số Điện Thoại',
                                'data' => 'phone',
                                'value' => (!empty($_SESSION[$sessison_account_warehouse_tmp]['phone'])) ? $_SESSION[$sessison_account_warehouse_tmp]['phone'] : "",
                                'type' => 'text',
                                'save_cache' => false,
                                'required' => true,
                            ]);
                            echo $warehouse_func->getTemplateLayoutsFor([
                                'name_layouts' => 'input_warehouse',
                                'class_form' => 'w-full',
                                'lable' => 'Email',
                                'placeholder' => 'you@example.com',
                                'data' => 'email',
                                'value' => (!empty($_SESSION[$sessison_account_warehouse_tmp]['email'])) ? $_SESSION[$sessison_account_warehouse_tmp]['email'] : "",
                                'type' => 'email',
                                'save_cache' => false,
                                'required' => true,
                            ]);
                            $sign_up_city = $cache->getCache("select name_$lang as name, id from #_place_citys ", array(), 'result', _TIMECACHE);
                            echo $warehouse_func->getTemplateLayoutsFor([
                                'name_layouts' => 'select_warehouse',
                                'class_form' => 'w-full',
                                'class' => 'no_load',
                                'lable' => 'Khu Vực',
                                'placeholder' => 'Chọn Tỉnh/Thành Phố',
                                'data' => 'city',
                                'value' => (!empty($_SESSION[$sessison_account_warehouse_tmp]['city'])) ? $_SESSION[$sessison_account_warehouse_tmp]['city'] : "",
                                'data_option' => $sign_up_city,
                                'name_col_view' => 'name',
                                'name_col_value' => 'id',
                                'save_cache' => false,
                                'required' => true,
                            ]);
                            ?>
                            <div class="w-full">
                                <label for="captcha" class="block text-sm font-semibold text-slate-600">Mã Xác Nhận</label>
                                <div class="mt-1 flex flex-wrap gap-4 items-center">
                                    <div class="flex-initial">
                                        <div class="form_captcha_js flex justify-center items-center min-w-[120px] h-9 ">
                                            <div class="flex-initial code_captcha rounded bg-gray-300"></div>
                                            <div class="flex-1"></div>
                                            <div class="h-[28px] bg-blue-300 inline-flex justify-center items-center rounded-[50%] overflow-hidden cursor-pointer aspect-[1/1] btn_captcha_js [&.on]:animate-load-captcha" data-name="captcha_sign_up_warehouse" data-size="80x18">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                                    <path d="M14.2584 16.9886L9.7525 13.9808C9.70056 13.947 9.64053 13.9278 9.57866 13.9251C9.51678 13.9224 9.45531 13.9363 9.40063 13.9654C9.34596 13.9946 9.30007 14.0378 9.26773 14.0907C9.23539 14.1435 9.21778 14.2041 9.21674 14.2661V15.4177C7.63761 15.3394 6.1284 14.7418 4.92315 13.7175C3.71791 12.6933 2.88397 11.2996 2.55067 9.75266C2.83628 8.41091 3.50292 7.18026 4.47047 6.20859C4.50266 6.17663 4.52821 6.1386 4.54565 6.09671C4.56308 6.05482 4.57206 6.00988 4.57207 5.9645C4.57208 5.91912 4.56312 5.87418 4.54569 5.83228C4.52827 5.79038 4.50274 5.75234 4.47056 5.72037C4.43839 5.68839 4.40021 5.6631 4.35823 5.64596C4.31624 5.62882 4.27128 5.62016 4.22594 5.62049C4.1806 5.62082 4.13578 5.63013 4.09404 5.64788C4.05231 5.66563 4.0145 5.69147 3.9828 5.72391C2.91161 6.80519 2.17722 8.17459 1.86886 9.66573C1.5605 11.1569 1.69144 12.7055 2.24577 14.1236C2.80011 15.5417 3.75398 16.768 4.99148 17.6538C6.22898 18.5395 7.69685 19.0464 9.21674 19.113V20.2817C9.21776 20.3437 9.23535 20.4043 9.26768 20.4572C9.30002 20.5101 9.34591 20.5533 9.4006 20.5824C9.45528 20.6116 9.51676 20.6255 9.57865 20.6228C9.64053 20.6201 9.70056 20.6008 9.7525 20.567L14.2584 17.5592C14.3058 17.5283 14.3448 17.486 14.3718 17.4362C14.3988 17.3864 14.4129 17.3306 14.4129 17.2739C14.4129 17.2172 14.3988 17.1615 14.3718 17.1116C14.3448 17.0618 14.3058 17.0195 14.2584 16.9886Z" fill="blue" />
                                                    <path d="M13.4273 2.88801V1.71926C13.4263 1.65722 13.4088 1.59656 13.3765 1.5436C13.3442 1.49065 13.2983 1.44734 13.2436 1.4182C13.1888 1.38905 13.1273 1.37514 13.0654 1.37791C13.0035 1.38068 12.9434 1.40003 12.8915 1.43395L8.38565 4.44176C8.33876 4.4731 8.30031 4.51553 8.27372 4.5653C8.24713 4.61506 8.23322 4.67063 8.23322 4.72707C8.23321 4.7835 8.24712 4.83907 8.27371 4.88884C8.3003 4.93861 8.33874 4.98104 8.38563 5.01238L12.8915 8.02017C12.9434 8.05395 13.0035 8.07318 13.0653 8.07588C13.1272 8.07859 13.1887 8.06466 13.2434 8.03554C13.298 8.00643 13.3439 7.96319 13.3763 7.91032C13.4086 7.85745 13.4262 7.79688 13.4273 7.7349V6.58334C15.0064 6.66162 16.5156 7.25922 17.7208 8.28347C18.9261 9.30772 19.76 10.7014 20.0933 12.2483C19.8077 13.5901 19.1411 14.8207 18.1735 15.7924C18.1108 15.8574 18.0761 15.9445 18.077 16.035C18.078 16.1254 18.1144 16.2118 18.1785 16.2755C18.2426 16.3392 18.3292 16.3751 18.4195 16.3754C18.5099 16.3757 18.5967 16.3404 18.6612 16.2771C19.7324 15.1958 20.4668 13.8264 20.7751 12.3352C21.0835 10.8441 20.9526 9.29544 20.3982 7.87738C19.8439 6.45932 18.89 5.23293 17.6525 4.3472C16.415 3.46148 14.9471 2.95455 13.4273 2.88801Z" fill="blue" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <?= $warehouse_func->getTemplateLayoutsFor([
                                            'name_layouts' => 'input_warehouse',
                                            'placeholder' => 'Nhập Mã Xác Nhận',
                                            'data' => 'captcha',
                                            'type' => 'text',
                                            'save_cache' => false,
                                            'required' => true,
                                            'form' => false,
                                        ]); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full flex items-center gap-2 text-sm font-normal">
                                <label>
                                    <?= $warehouse_func->getTemplateLayoutsFor([
                                        'name_layouts' => 'checkbok_round',
                                        'data' => 'agreeCheck',
                                        'required' => true,
                                    ]); ?>
                                </label>
                                <span>Tôi đã đọc và đồng ý với các điều khoản của I-Web</span>
                            </div>
                            <div class="w-full flex items-center justify-center">
                                <button type="submit" name="submit-resgister-man" class="h-9 sm:h-10 lg:h-11 bg-blue-600 hover:bg-blue-700 transition-all text-base font-semibold text-white text-center px-7 rounded-full">
                                    Tiếp Tục
                                </button>
                            </div>
                            <div class="w-full flex justify-center items-center">
                                <span class="text-sm text-gray-400">
                                    Bạn đã có tài khoản
                                    <a href="<?= $url_login_form ?>" class=" text-blue-500 flex-initial">
                                        Đăng nhập ngay
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>