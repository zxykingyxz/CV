<div class="<?= (!empty($class_form) ? $class_form : 'h-3 ') ?> bg-white relative aspect-[1/1] border border-[var(--html-bg-website)] rounded-sm overflow-hidden">
    <input type="checkbox" name="<?= $data ?>" id="<?= $data ?>" value="<?= $value ?>" class="<?= (!empty($class_input) ? $class_input : '') ?> absolute opacity-0 top-0 left-0 w-full h-full z-10 cursor-pointer peer" <?= ($required) ? "required" : "" ?> <?= ($checked) ? "checked" : "" ?>>
    <div class="peer-checked:scale-100 transition-all duration-300 rounded-[50%] overflow-hidden bg-[var(--html-bg-website)] absolute top-[50%] left-[50%] h-5 aspect-[1/1] inline-flex justify-center items-center leading-[0] -translate-x-1/2 -translate-y-1/2 scale-0">
        <div class=" relative aspect-[1/1] inline-flex justify-center items-center ">
            <i class="fas fa-check text-white leading-none" style="font-size: 60%;"></i>
        </div>
    </div>
</div>