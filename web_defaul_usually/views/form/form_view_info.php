<div class=" w-full <?= (!empty($background)) ? $background : 'bg-white' ?> py-4 px-3">
    <div class="<?= $close_popup ?> absolute inline-flex justify-center items-center h-7 aspect-[1/1] top-3 right-3 rounded-full bg-inherit cursor-pointer hover:bg-red-600 hover:text-white transition-all text-base z-10 ">
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
        <p>
            <?= htmlspecialchars_decode($data['mota']) ?>
        </p>
        <p>
            <?= htmlspecialchars_decode($data['noidung']) ?>
        </p>
    </div>
</div>