<div class="<?= (!empty($class_form) ? $class_form : 'h-5 ') ?> bg-white relative aspect-[1/1] border border-blue-600 rounded overflow-hidden">
    <input type="checkbox" name="data[<?= $data ?>]" id="<?= $data ?>" value="<?= $value ?>" class="absolute opacity-0 top-0 left-0 w-full h-full z-10 cursor-pointer peer" <?= ($required) ? "required" : "" ?> <?= $param_checkbox ?>>
    <div class="peer-checked:scale-100 transition-all duration-300 rounded-[50%] overflow-hidden bg-blue-500 absolute top-[50%] left-[50%] h-5 aspect-[1/1] flex justify-center items-center -translate-x-1/2 -translate-y-1/2 scale-0">
        <div class=" relative">
            <i class="fas fa-check text-white" style="font-size: 70%;"></i>
        </div>
    </div>
</div>