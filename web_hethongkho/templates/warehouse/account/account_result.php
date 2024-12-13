<style>
    .section-sign_up_list {
        background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
        background-size: 400% 400%;
        animation: gradient 15s ease infinite;
        height: 100vh;
    }

    @keyframes gradient {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }
</style>
<section class="section-sign_up_list">
    <div class="grid_x wide ">
        <div class="flex justify-center items-center min-h-[100vh] ">
            <div class="shadow-md shadow-white rounded-lg py-6 px-2 sm:px-5 border border-gray-200 min-w-[300px] max-w-[40%]">
                <div class=" text-white text-base sm:text-2xl font-bold text-center mb-6">
                    <span>Thông Tin Cửa Hàng Của <?= $_SESSION[$sessison_account_warehouse_tmp]['name'] ?></span>
                </div>
                <div class="w-full flex flex-wrap gap-3">
                    <div class="items_account p-2 border-blue-500 bg-white shadow-blue-500 rounded-xl w-full overflow-hidden shadow-md border-2 flex justify-center items-center gap-2">
                        <div class="flex-1">
                            <div class="text-xs text-gray-400 mb-1">
                                <span>
                                    Tên cửa hàng
                                </span>
                            </div>
                            <div class="text-xl text-blue-500 font-semibold font-main">
                                <span>
                                    <?= $_SESSION[$sessison_account_warehouse_tmp]['subdomain'] ?>
                                </span>
                            </div>
                        </div>
                        <div class="button_copy flex-initial cursor-pointer text-gray-300 text-xl h-7 aspect-[1/1] flex justify-center items-center" data-copy="<?= $_SESSION[$sessison_account_warehouse_tmp]['subdomain'] ?>">
                            <i class="fas fa-copy"></i>
                        </div>
                    </div>
                    <div class="items_account p-2 border-green-500 bg-white shadow-green-500 rounded-xl w-full overflow-hidden shadow-md border-2 flex justify-center items-center gap-2">
                        <div class="flex-1">
                            <div class="text-xs text-gray-400 mb-1">
                                <span>
                                    Tên tài khoản
                                </span>
                            </div>
                            <div class="text-xl text-green-500 font-semibold font-main">
                                <span>
                                    <?= $_SESSION[$sessison_account_warehouse_tmp]['phone'] ?>
                                </span>
                            </div>
                        </div>
                        <div class="button_copy flex-initial cursor-pointer text-gray-300 text-xl h-7 aspect-[1/1] flex justify-center items-center" data-copy="<?= $_SESSION[$sessison_account_warehouse_tmp]['phone'] ?>">
                            <i class="fas fa-copy"></i>
                        </div>
                    </div>
                    <div class="items_account p-2 border-yellow-500 bg-white shadow-yellow-500 rounded-xl w-full overflow-hidden shadow-md border-2 flex justify-center items-center gap-2">
                        <div class="flex-1">
                            <div class="text-xs text-gray-400 mb-1">
                                <span>
                                    Mật khẩu
                                </span>
                            </div>
                            <div class="text-xl text-yellow-500 font-semibold font-main">
                                <span>
                                    <?= $warehouse_func->decrypt($_SESSION[$sessison_account_warehouse_tmp]['password']) ?>
                                </span>
                            </div>
                        </div>
                        <div class="button_copy flex-initial cursor-pointer text-gray-300 text-xl h-7 aspect-[1/1] flex justify-center items-center" data-copy="<?= $warehouse_func->decrypt($_SESSION[$sessison_account_warehouse_tmp]['password']) ?>">
                            <i class="fas fa-copy"></i>
                        </div>
                    </div>
                </div>
                <?php
                unset($_SESSION[$sessison_account_warehouse_tmp]);
                ?>
                <div class="w-full flex justify-center mt-6">
                    <a href="<?= $url_dashboard_man ?>" class="h-11 rounded-full px-7 text-base text-white font-semibold bg-blue-500 hover:bg-blue-600 transition-all duration-300 inline-flex justify-center items-center">
                        Bắt Đầu Quản Lý
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>