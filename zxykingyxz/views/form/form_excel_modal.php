<div class="fixed top-0 left-0 w-full h-full bg-[#141414e8] z-40 opacity_animaiton">
    <div class="w-full h-full flex  flex-col">
        <div class="close_modal_import w-full min-h-5 flex-1"></div>
        <div class="w-full min-h-[100px] flex-initial flex ">
            <div class="close_modal_import flex-1  min-w-[10px]"></div>
            <div class="w-full max-w-[400px] max-h-full relative">
                <div class="close_modal_import cursor-pointer absolute top-1 right-1 z-10 flex justify-center items-center w-[25px] aspect-[1/1] leading-none">
                    <i class="fas fa-times text-xl leading-none"></i>
                </div>
                <form method="POST" action="" id="form-import" name="form-import" class="w-full h-full flex-1 flex flex-wrap flex-col" enctype="multipart/form-data" autocomplete="off" accept-charset="utf-8">
                    <div class="w-full h-full bg-white  overflow-hidden rounded-lg px-2 sm:px-4 py-4 sm:py-6 flex flex-col">
                        <input type="hidden" name="value" value="<?= $link_modal ?>">
                        <input type="hidden" name="form" value="import">
                        <div class="w-full text-lg font-bold capitalize">
                            <span>
                                Nhập dữ liệu từ file
                                <span class="text-xs font-extralight">
                                    (Tải về file mẫu:
                                    <span class="button_download_excel_sample" data-url="<?= $link_modal ?>" style="color: blue;cursor: pointer;">Example file</span>)
                                </span>
                            </span>
                        </div>
                        <div class="w-full mt-4  text-base font-medium scroll-design-one overflow-y-auto overflow-x-hidden">
                            <div class="w-full">
                                <p>
                                    Hệ thống cho phép nhập tối đa 5.000 dữ liệu mỗi lần từ file .
                                </p>
                                <p>
                                    Với hình ảnh và một số trường khác không có trong file excel mẫu phải tự cập nhật sau khi thêm vào hệ thống.
                                </p>
                                <p>
                                    Bạn có thể tải file mẫu, thêm dữ liệu để có thể nhập dữ liệu đúng cách.
                                </p>
                            </div>
                        </div>
                        <div class="w-full flex flex-wrap justify-between items-center mt-4 gap-3">
                            <div class="flex-1">
                                <input type="file" name="file" accept=".xlsx, .xls" class="cursor-pointer file:cursor-pointer w-full file:mr-4 file:rounded-full file:border-0 file:bg-violet-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-600 dark:file:text-blue-100 dark:hover:file:bg-blue-500 " />
                            </div>
                            <div class="inline-flex flex-wrap  items-center">
                                <button type="submit" name="submit-import" value="" id="submit-import" class=" h-[35px] bg-green-500 hover:brightness-90 transition-all duration-300 text-base font-normal text-white text-center px-4 rounded flex justify-center items-center gap-2 text-nowrap">
                                    <i class="fas fa-file-import"></i>
                                    <div class="">
                                        <span>Import</span>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="close_modal_import flex-1 min-w-[10px]"></div>
        </div>
        <div class="close_modal_import w-full min-h-5 flex-1"></div>
    </div>
</div>