<?php

?>
<section class="section-product py-4 ">
    <div class="grid_x wide ">
        <div class="bg-white rounded-xl p-3 shadow-lg shadow-gray-300 border border-gray-200">
            <div class="flex-1 w-full text-base text-black font-bold ">
                <span>
                    Danh Sách Thùng Rác
                    <sup class="text-xs font-thin text-red-600">(Các dữ liệu sẽ được xóa trong 30 ngày)</sup>
                </span>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3  mt-1 pt-2 border-t border-gray-200 gap-3" id="list_trash">
                <?= $html_table ?>
            </div>
        </div>
    </div>
</section>