<div class="grid_s wide">
    <div class="flex flex-wrap flex-col text-center justify-center items-center h-[100vh] ">
        <div class="h-20 text-white text-3xl aspect-[1/1] rounded-[50%] bg-blue-400 inline-flex justify-center items-center text-center">
            <div>
                <span>
                    <?= substr($account_info['name'], 0, 1) ?>
                </span>
            </div>
        </div>
        <span class="mt-1 text-blue-600 text-sm">
            <?= $account_info['name'] ?>
        </span>
        <div class="text-3xl font-bold text-red-600 text-center mt-3 mb-4">
            <span>Bạn Chưa Đăng Xuất Tài Khoản</span>
        </div>
        <div class="inline-flex justify-center items-center gap-2">
            <a href="<?= $url_dashboard_man ?>" class="bg-blue-500 hover:bg-blue-600 transition-all duration-300 text-sm text-white font-semibold inline-flex h-8 rounded-md px-6 justify-center items-center text-center">Tiếp Tục</a>
            <div class="text-[13px]">
                <span>hoặc</span>
            </div>
            <a href="<?= $jv0 ?>" class="button_logout bg-red-500 hover:bg-red-600 transition-all duration-300 text-sm text-white font-semibold inline-flex h-8 rounded-md px-6 justify-center items-center text-center">Đăng Xuất</a>
        </div>
    </div>
</div>