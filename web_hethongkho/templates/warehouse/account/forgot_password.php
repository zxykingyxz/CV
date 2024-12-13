<section class="section-sign_up_list bg-blue-500">
    <div class="grid_x wide ">
        <div class="flex justify-center items-center h-[100vh] py-6 ">
            <div class="bg-white  rounded-lg py-6 px-2 sm:px-5 border border-gray-200 max-h-[395px] h-[100%]  overflow-hidden">
                <div class=" text-blue-600 text-base sm:text-2xl font-bold text-center mb-6">
                    <span>Xác thực tài khoản</span>
                </div>
                <div class=" overflow-x-hidden overflow-y-auto w-full scroll-y h-[calc(100%-50px)] sm:h-[calc(100%-52px)] p-[2px] pr-1">
                    <form action="" name="form-validate-warehouse-login" method="POST" class=" inline-flex flex-wrap justify-center items-center gap-2 w-[300px]">
                        <?= $warehouse_func->getTemplateLayoutsFor([
                            'name_layouts' => 'input_warehouse',
                            'class_form' => 'w-full',
                            'lable' => 'Tên Cửa  Hàng ',
                            'placeholder' => 'Nhập Tên Cửa  Hàng',
                            'data' => 'subdomain',
                            'type' => 'text',
                            'save_cache' => false,
                            'required' => true,
                        ]); ?>
                        <?= $warehouse_func->getTemplateLayoutsFor([
                            'name_layouts' => 'input_warehouse',
                            'class_form' => 'w-full',
                            'lable' => 'Tên Tài Khoản ',
                            'placeholder' => 'Nhập Tên Tài Khoản',
                            'data' => 'username',
                            'type' => 'text',
                            'save_cache' => false,
                            'required' => true,
                        ]); ?>
                        <?= $warehouse_func->getTemplateLayoutsFor([
                            'name_layouts' => 'input_warehouse',
                            'class_form' => 'w-full',
                            'lable' => 'Email',
                            'placeholder' => 'you@example.com',
                            'data' => 'email',
                            'value' => (!empty($_SESSION[$sessison_account_warehouse_tmp]['email'])) ? $_SESSION[$sessison_account_warehouse_tmp]['email'] : "",
                            'type' => 'email',
                            'save_cache' => false,
                            'required' => true,
                        ]); ?>
                        <div class="w-full flex justify-between items-center">
                            <a href="<?= $url_sign_up_form ?>" class="text-xs text-blue-500 block flex-initial">
                                Đăng ký tài khoản
                            </a>
                        </div>
                        <div class="w-full flex items-center justify-center mt-2">
                            <button type="submit" name="submit-forgot-password" class="h-9 sm:h-10 lg:h-11 bg-blue-600 hover:bg-blue-700 transition-all text-base font-semibold text-white text-center px-7 rounded-full">
                                Xác thực
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>