<section class="wrapper-error w-100i py-20">
    <div class="grid_s wide text-center">
        <div class="text-[var(--html-bg-website)] text-xl sm:text-5xl mb-3">
            Error !
        </div>
        <div class="text-red-600 text-3xl sm:text-9xl mb-5 font-black">
            404
        </div>
        <div class="">
            <div class=" text-base sm:text-xl font-bold text-black uppercase mb-2">Trang của bạn không được tìm thấy!</div>
            <div class="text-black font-normal text-xs sm:text-base mb-2 ">Vui luôn truy cập đúng link.</div>
            <a href="<?= $func->getUrlParam(["com" => "index"]) ?>" title="Quay lại" class="inline-block py-2 px-4 uppercase bg-blue-600 rounded-full text-white hover:brightness-110 transition-all duration-300">Về trang chủ</a>
        </div>
    </div>
</section>