<div class="grid grid-cols-1 gap-2 text-sm">
    <div class="grid grid-cols-2 gap-2">
        <label class="w-full border-b border-gray-300">
            <input type="text" name="customer[name]" required placeholder="Họ Tên" class="w-full border-none bg-inherit px-2 py-1">
        </label>
        <label class="w-full border-b border-gray-300">
            <input type="number" name="customer[phone]" required placeholder="Số Điện Thoại" class="w-full border-none bg-inherit px-2 py-1">
        </label>
        <label class="w-full border-b border-gray-300 text-gray-600">
            <select name="customer[city]" id="" required class=" border-none bg-inherit px-2 py-2 w-full h-full">
                <option value="">-- Chọn Khu Vực --</option>
                <?php foreach ($list_city as $key_city => $value_city) { ?>
                    <option value="<?= $value_city['id'] ?>"><?= $value_city['name'] ?></option>
                <?php } ?>
            </select>
        </label>
        <label class="w-full border-b border-gray-300 text-gray-600" id="customer_district">
            <select name="customer[district]" id="" required class=" border-none bg-inherit px-2 py-2 w-full h-full">
                <option value="">-- Chọn Quận Huyện --</option>
                <?php foreach ($list_dist as $key_dist => $value_dist) { ?>
                    <option value="<?= $value_dist['id'] ?>"><?= $value_dist['name'] ?></option>
                <?php } ?>
            </select>
        </label>
    </div>
    <label class="w-full border-b border-gray-300 ">
        <input type="text" name="customer[address]" required placeholder="Địa Chỉ" class="w-full border-none bg-inherit px-2 py-1">
    </label>
</div>