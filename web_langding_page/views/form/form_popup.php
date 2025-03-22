<div class="<?= $class_form_js ?> fixed top-0 left-0 bg-[#00000087] z-50 w-full h-[100vh] flex flex-wrap flex-col opacity-0 scale-110 invisible [&.active]:scale-100 [&.active]:opacity-100 [&.active]:visible  transition-all duration-300">
    <div class="w-full flex-1 min-h-6 <?= $class_close_form_js ?>">
    </div>
    <?php

    /*
    <div class="<?= $class_close_form_js ?> absolute inline-flex justify-center items-center h-7 aspect-[1/1] top-3 right-3 rounded-md bg-slate-300 cursor-pointer hover:bg-red-600 hover:text-white transition-all text-base z-10">
        <span>
            <i class="fas fa-times"></i>
        </span>
    </div>
    */ ?>
    <div class="w-full flex max-h-[calc(100%-60px)]">
        <div class="flex-1 min-w-[10px] <?= $class_close_form_js ?>"></div>
        <div class="w-full relative <?= $class_form ?> max-h-full overflow-x-hidden overflow-y-auto scroll-design-one shadow-md shadow-gray-300 border border-gray-100 rounded-md ">
            <?php
            switch ($check_form) {
                case 'view_info_introduce':
                case 'view_baiviet':
            ?>
                    <div class=" w-full <?= (!empty($background)) ? $background : 'bg-white' ?> py-4 px-3">
                        <div class="<?= $class_close_form_js ?> absolute inline-flex justify-center items-center h-7 aspect-[1/1] top-3 right-3 rounded-full bg-inherit cursor-pointer hover:bg-red-600 hover:text-white transition-all text-base z-10 ">
                            <span>
                                <i class="fas fa-times"></i>
                            </span>
                        </div>
                        <div class="h-5"></div>
                        <div class="text-xl font-main-700 font-bold leading-relaxed">
                            <span>
                                <?= $data['ten'] ?>
                            </span>
                        </div>
                        <div class="text-base w-full content mt-5">
                            <div>
                                <?= htmlspecialchars_decode($data['mota']) ?>
                            </div>
                            <div>
                                <?= htmlspecialchars_decode($data['noidung']) ?>
                            </div>
                        </div>
                    </div>
            <?php
                    break;
                default:
                    break;
            }
            ?>
        </div>
        <div class="flex-1 min-w-[10px] <?= $class_close_form_js ?>"></div>
    </div>
    <div class="w-full flex-1 min-h-6 <?= $class_close_form_js ?>">
    </div>
</div>