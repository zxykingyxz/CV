<form action="" method="POST" name="form_warehouse_add" class="w-full flex flex-wrap gap-4 sm:gap-9 <?= (!empty($background)) ? $background : 'bg-white' ?> pt-4 px-3" enctype="multipart/form-data">
    <div class=" w-full flex <?= (!empty($background)) ? $background : 'bg-white' ?>">
        <div class="title flex-1 w-full text-xl text-black font-bold ">
            <span>
                Nhập dữ liệu từ file
                <span class="text-[11px] font-thin">
                    (Tải về file mẫu:
                    <span class="button_download_excel text-blue-600 cursor-pointer">Excel file</span>)
                </span>
            </span>
        </div>
        <div class="<?= $close_popup ?> absolute inline-flex justify-center items-center h-6 aspect-[1/1] top-3 right-3 rounded-md bg-slate-200 cursor-pointer hover:bg-red-600 hover:text-white transition-all text-sm z-10">
            <span>
                <i class="fas fa-times"></i>
            </span>
        </div>
    </div>

    <div class="inline-flex flex-wrap w-full text-base">
        <span>
            Hệ thống cho phép nhập tối đa 5.000 mặt hàng mỗi lần từ file .
            <br /><br />
            Mã hàng chứa kí tự đặc biệt (@, #, $, *, /, -, _,...) và chữ có dấu sẽ gây khó khăn khi In.
            <br /><br />
            Với hình ảnh và một số trường khác không có trong file excel mẫu phải tự cập nhật sau khi thêm vào hệ thống.
            <br /><br />
            Với hình ảnh và một số trường khác không có trong file excel mẫu phải tự cập nhật sau khi thêm vào hệ thống.
        </span>
    </div>

    <div class="flex w-full gap-3 items-end justify-end sticky bottom-0 right-0 <?= (!empty($background)) ? $background : 'bg-white' ?> py-3">
        <label class="block w-full">
            <div class="block text-sm font-semibold text-slate-600">
                <span>
                    File dữ liệu
                    <sup class="text-red-600">(Đúng như form mẫu)</sup>
                </span>
            </div>
            <div class="mt-1 w-full">
                <input type="file" name="photo" accept=".xls,.xlsx" placeholder="Chọn hình ảnh của bạn" <?= (!empty($data['photo'])) ? '' : 'required' ?> class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-200 file:text-blue-700 hover:file:bg-blue-300 " />
            </div>
        </label>
        <button type="submit" name="submit-add-data" class=" px-4 h-9 text-sm sm:text-base font-normal rounded-md  text-white bg-green-500 hover:bg-green-600 transition-all duration-300 inline-flex justify-center items-center gap-1 cursor-pointer">
            <i class="fas fa-file-import"></i>
            <div class="">
                <span>Import</span>
            </div>
        </button>
    </div>
</form>