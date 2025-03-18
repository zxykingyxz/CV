<?php
// đăng ký
$info_client = $cache->getCache("select  ten_$lang as ten , slogan_$lang as slogan,mota_$lang as mota from #_bannerqc where type=? and hienthi=1 ", array('info-client'), 'fetch', _TIMECACHE);

?>
<!-- đăng ký nhận tin -->
<section class="section-client py-5 bg-black">
    <div class="grid_s wide">
        <div class="flex flex-wrap items-center gap-5 md:gap-[70px]">
            <div class="w-full lg:w-[37%]">
                <div class="<?= $class_title_main ?>  mb-1">
                    <span class="text-white ">
                        <?= $info_client['ten'] ?>
                    </span>
                </div>
                <div class="<?= $class_content_main ?>  ">
                    <span class=" text-white">
                        <?= htmlspecialchars_decode($info_client['mota']) ?>
                    </span>
                </div>
            </div>
            <form action="" method="POST" name="form_client" class="form_client submit_load w-full flex flex-wrap justify-center items-center  gap-3 flex-1 " enctype="multipart/form-data">
                <div class="flex-1 min-w-[250px] overflow-hidden rounded-lg bg-white flex items-center">
                    <div class="h-[50px] aspect-[1/1] inline-flex justify-center items-center leading-[0]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                            <g clip-path="url(#clip0_1_296)">
                                <path d="M9.85724 10.1262C11.1808 10.1262 12.3269 9.65154 13.2633 8.71496C14.1997 7.77854 14.6744 6.63276 14.6744 5.30906C14.6744 3.98583 14.1997 2.8399 13.2632 1.90316C12.3266 0.966887 11.1806 0.492188 9.85724 0.492188C8.53354 0.492188 7.38776 0.966887 6.45132 1.90331C5.51489 2.83974 5.04004 3.98567 5.04004 5.30906C5.04004 6.63276 5.51489 7.77869 6.45148 8.71512C7.38806 9.65139 8.534 10.1262 9.85724 10.1262Z" fill="var(--html-bg-website)" />
                                <path d="M18.2863 15.871C18.2593 15.4813 18.2047 15.0562 18.1242 14.6073C18.0431 14.155 17.9385 13.7275 17.8134 13.3367C17.6842 12.9328 17.5084 12.534 17.2911 12.1517C17.0656 11.755 16.8007 11.4095 16.5034 11.1253C16.1926 10.8279 15.8121 10.5888 15.372 10.4144C14.9335 10.2409 14.4475 10.153 13.9276 10.153C13.7234 10.153 13.526 10.2368 13.1447 10.485C12.91 10.6381 12.6355 10.8151 12.3291 11.0108C12.0671 11.1778 11.7122 11.3342 11.2738 11.4758C10.8461 11.6142 10.4118 11.6844 9.98322 11.6844C9.5546 11.6844 9.12048 11.6142 8.69232 11.4758C8.25439 11.3343 7.89948 11.1779 7.63779 11.011C7.33429 10.817 7.05963 10.64 6.82144 10.4849C6.44058 10.2366 6.24298 10.1528 6.03882 10.1528C5.5188 10.1528 5.03296 10.2409 4.59457 10.4145C4.15482 10.5886 3.77411 10.8277 3.46298 11.1254C3.16589 11.4098 2.90085 11.7552 2.67563 12.1517C2.4585 12.534 2.28271 12.9327 2.15332 13.3369C2.02835 13.7276 1.92383 14.155 1.84265 14.6073C1.76224 15.0556 1.70761 15.4809 1.6806 15.8715C1.65405 16.2542 1.64062 16.6514 1.64062 17.0525C1.64062 18.0965 1.9725 18.9417 2.62695 19.565C3.27332 20.1801 4.12857 20.4921 5.16861 20.4921H14.7987C15.8388 20.4921 16.6937 20.1803 17.3402 19.565C17.9948 18.9422 18.3267 18.0968 18.3267 17.0524C18.3266 16.6494 18.313 16.2519 18.2863 15.871Z" fill="var(--html-bg-website)" />
                            </g>
                        </svg>
                    </div>
                    <div class="h-7 w-0 border-l border-gray-300"></div>
                    <div>
                        <input type="text" name="data[fullname]" id="fullname" class="text-sm font-normal font-main-400 px-3 h-[50px] placeholder-slate-400  bg-inherit   block w-full " required value="" placeholder="Nhập Họ Tên">
                    </div>
                </div>
                <div class=" flex-1 min-w-[250px] overflow-hidden rounded-lg bg-white flex items-center">
                    <div class="h-[50px] aspect-[1/1] inline-flex justify-center items-center leading-[0]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="27" viewBox="0 0 28 27" fill="none">
                            <path d="M22.7521 17.424C22.0386 17.4071 21.1405 17.3655 20.5731 17.2665C19.9592 17.1585 19.2208 16.9493 18.7009 16.7884C18.2932 16.6624 17.8492 16.7737 17.5468 17.073L15.0359 19.5525C13.3009 18.6446 11.9112 17.5871 10.7345 16.4115C9.55092 15.2426 8.48631 13.8623 7.57233 12.1388L10.0685 9.6435C10.3698 9.34312 10.4819 8.90212 10.355 8.49713C10.1942 7.98187 9.98243 7.24837 9.87484 6.63863C9.77404 6.075 9.73327 5.18288 9.71515 4.47413C9.70042 3.861 9.19756 3.375 8.58032 3.375H4.60501C4.10894 3.375 3.47244 3.744 3.47244 4.5C3.47244 9.60638 5.55636 14.4833 9.09677 18.0382C12.6757 21.555 17.5853 23.625 22.7261 23.625C23.4872 23.625 23.8586 22.9928 23.8586 22.5V18.5512C23.8586 17.9381 23.3694 17.4386 22.7521 17.424Z" fill="var(--html-bg-website)" />
                        </svg>
                    </div>
                    <div class="h-7 w-0 border-l border-gray-300"></div>
                    <input type="number" name="data[phone]" id="phone" class="text-sm font-normal font-main-400 px-3 h-[50px] placeholder-slate-400  bg-inherit  block w-full " required value="" placeholder="Nhập Số Điện Thoại">
                </div>
                <button type="submit" name="submit-resgister-client" class="flex-initial h-[50px] bg-[var(--html-bg-website)] hover:brightness-110 transition-all text-sm font-semibold text-white text-center px-9 rounded-lg flex justify-center items-center gap-3">
                    <span>Đăng Ký</span>
                </button>
            </form>
        </div>
    </div>
</section>