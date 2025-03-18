<?php
$size_input = (!empty($size)) ? $size : "w-4 h-4";
?>
<label class="flex items-center cursor-pointer group">
    <input type="checkbox" name="<?= $name ?>" id="<?= $id . "_" . $value ?>" value="<?= $value ?>" class="hidden <?= $class ?>">
    <div class="<?= $size_input ?> overflow-hidden flex items-center justify-center border border-solid border-gray-300 rounded-sm bg-white transition-all group-has-[input:checked]:bg-blue-500 group-has-[input:checked]:border-blue-500">
        <svg class="w-[90%] h-[90%] text-white hidden group-has-[input:checked]:block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-3-3a1 1 0 011.414-1.414L9 11.586l6.293-6.293a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>
    </div>
</label>