<section class="section-sign_up_list bg-blue-500">
    <div class="grid_x wide ">
        <div class="flex justify-center items-center h-[100vh] py-6 ">
            <div class="bg-white  rounded-lg py-6 px-2 sm:px-5 border border-gray-200 max-h-[395px] h-[100%]  overflow-hidden">
                <div class=" text-blue-600 text-base sm:text-2xl font-bold text-center mb-6">
                    <span>Đăng nhập tài khoản</span>
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
                        <div class="w-full">
                            <label for="password" class="block text-sm font-semibold text-slate-600 after:content-['*'] after:ml-0.5 after:text-red-500 ">Mật Khẩu</label>
                            <div class="mt-1 relative form_password">
                                <?= $warehouse_func->getTemplateLayoutsFor([
                                    'name_layouts' => 'input_warehouse',
                                    'class_form' => 'w-full',
                                    'lable' => 'Mật Khẩu ',
                                    'placeholder' => 'Nhập Mật Khẩu',
                                    'data' => 'password',
                                    'type' => 'password',
                                    'save_cache' => false,
                                    'form' => false,
                                    'required' => true,
                                ]); ?>
                                <div class=" showPassword group/password text-sm text-gray-500 absolute top-0 right-0 h-full aspect-[1/1] z-10 cursor-pointer inline-flex justify-center items-center">
                                    <div class="show_password block group-[.on]/password:hidden">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                    <div class="hiden_password hidden group-[.on]/password:block">
                                        <i class="fas fa-eye-slash"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full flex justify-between items-center">
                            <a href="<?= $url_login_forgot_password ?>" class="text-xs text-blue-500 block flex-initial">
                                Quên mật khẩu?
                            </a>
                            <a href="<?= $url_sign_up_form ?>" class="text-xs text-blue-500 block flex-initial">
                                Đăng ký tài khoản
                            </a>
                        </div>
                        <div class="w-full flex items-center justify-center mt-2">
                            <button type="submit" name="submit-resgister-login" class="h-9 sm:h-10 lg:h-11 bg-blue-600 hover:bg-blue-700 transition-all text-base font-semibold text-white text-center px-7 rounded-full">
                                Đăng Nhập
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>