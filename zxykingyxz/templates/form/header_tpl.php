<div class="sticky top-0 left-0 w-full z-20">
    <div class="w-full bg-gray-100 shadow-md shadow-gray-300 py-3 px-4 sm:px-7">
        <div class="w-full flex items-center justify-between gap-2">
            <div class="flex-initial inline-flex gap-3 justify-center items-center">
                <div class="action_menu_admin cursor-pointer inline-flex lg:hidden gap-2 justify-center items-center">
                    <div class="w-[30px] aspect-[1/1] flex justify-center items-center text-gray-500 ">
                        <i class=" fas fa-bars text-[16px]"></i>
                    </div>
                </div>
                <a href="<?= $func->getUrlParam(["com" => "index"]); ?>" title="Home" target="_blank" class="inline-flex justify-center items-center gap-2 text-gray-500">
                    <span class="text-[16px] hidden lg:inline-block">Home </span>
                </a>
            </div>
            <div class="flex-1 flex justify-end justify-items-end items-center gap-6">
                <button id="buttonDeleteCache" class=" inline-flex justify-center items-center gap-2 text-gray-500 border-none outline-none ">
                    <div class="">
                        <i class="fas fa-folder-minus text-[18px] "></i>
                    </div>
                    <div class="">
                        <span>
                            Xóa Cache
                        </span>
                    </div>
                </button>
                <button id="fullscreenBtn" class=" inline-flex justify-center items-center gap-2 text-gray-500 border-none outline-none">
                    <div class="">
                        <i class="fas fa-expand-arrows-alt text-[18px] "></i>
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>