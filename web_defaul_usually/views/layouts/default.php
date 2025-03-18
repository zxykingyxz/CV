<!-- hotline top -->
<div class="">
    <a href="<?= str_replace('.', '', str_replace(' ', '', $hotline_one['link'])) ?>" title="<?= (isset($hotline_one["ten_$lang"])) ? $hotline_one["ten_$lang"] : $hotline_one["ten"] ?>" class="inline-flex leading-[0] items-center gap-6">
        <div class="h-[35px] aspect-[1/1] rounded-full bg-white inline-flex justify-center items-center leading-[0]">
            <?= $func->addHrefImg([
                'addhref' => false,
                'sizes' => '200x200x2',
                'actual_width' => 1000,
                'upload' => _upload_hinhanh_l,
                'image' => $hotline_one["photo"],
                'alt' => (isset($hotline_one["ten_$lang"])) ? $hotline_one["ten_$lang"] : $hotline_one["ten"],
            ]); ?>
        </div>
        <div class="">
            <div class="text-[#1E1E1E] text-sm font-main-600 font-semibold leading-none mb-2">
                <span>
                    <?= (isset($hotline_one["ten_$lang"])) ? $hotline_one["ten_$lang"] : $hotline_one["ten"] ?>
                </span>
            </div>
            <div class="text-[var(--html-bg-website)] font-bold font-main-700 text-2xl leading-none">
                <span>
                    <?= (isset($hotline_one["mota_$lang"])) ? $hotline_one["mota_$lang"] : $hotline_one["mota"] ?>
                </span>
            </div>
        </div>
    </a>
</div>
<!-- giỏ hàng -->
<?php if ($config['cart']['turn_on'] == true) { ?>
    <div class="">
        <a class="relative  inline-flex justify-center items-end text-white text-base font-normal font-main-400 leading-none gap-2" href="<?= $func->getType('carts') . '?src=gio-hang' ?>" title="Giỏ hàng">
            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="23" viewBox="0 0 19 23" fill="none">
                <path d="M0 6.06331H18.1366V18.4424C18.1339 20.5755 16.4054 22.3039 14.2726 22.3066H3.86425C1.73123 22.3039 0.002816 20.5755 4.16959e-05 18.4427V18.4424L0 6.06331ZM16.6802 7.51971H1.45638V18.4424C1.45805 19.7716 2.53509 20.8486 3.86408 20.8503H14.2724C15.6016 20.8486 16.6786 19.7716 16.6803 18.4426V18.4425L16.6802 7.51971ZM13.5054 9.56832H12.049V4.93707C12.049 3.29089 10.7145 1.95636 9.0683 1.95636C7.42209 1.95636 6.08759 3.29089 6.08759 4.93709V9.56834H4.63125V4.93707C4.63125 2.48655 6.61777 0.5 9.0683 0.5C11.5188 0.5 13.5054 2.48655 13.5054 4.93707V9.56832Z" fill="white" />
            </svg>
            <span>
                Giỏ hàng
                <sup class="view-cart">(<?= $cart->getTotalQuality() ?>)</sup>
            </span>
        </a>
    </div>
<?php } ?>

<!-- tìm kiếm input-->
<form method="GET" action="tim-kiem" class="form-search relative bg-white rounded-full pr-1 py-1 pl-6 transition-all duration-500  mx-auto w-full ">
    <div class=" flex justify-center items-center max-w-full">
        <div class="flex-1">
            <input type="text" size="0" name="keywords" class="keyword w-full bg-inherit flex-1 h-10 outline-none border-none text-sm font-normal font-main-400 placeholder:text-[#474747]" placeholder="Nhập sản phẩm bạn cần tìm....">
        </div>
        <?php if ($config['function']['advancedSearch'] == true) { ?>
            <div class="close_view_search hidden">
                <div class="inline-flex w-10 aspect-[1/1] justify-center items-center cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" id="Capa_1" enable-background="new 0 0 320.591 320.591" viewBox="0 0 320.591 320.591" style="width: 15px; height: auto; fill: var(--html-bg-website);">
                        <g>
                            <g id="close_1_">
                                <path d="m30.391 318.583c-7.86.457-15.59-2.156-21.56-7.288-11.774-11.844-11.774-30.973 0-42.817l257.812-257.813c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875l-259.331 259.331c-5.893 5.058-13.499 7.666-21.256 7.288z" style="fill: var(--html-bg-website);" />
                                <path d="m287.9 318.583c-7.966-.034-15.601-3.196-21.257-8.806l-257.813-257.814c-10.908-12.738-9.425-31.908 3.313-42.817 11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414-6.35 5.522-14.707 8.161-23.078 7.288z" style="fill: var(--html-bg-website);" />
                            </g>
                        </g>
                    </svg>
                </div>
            </div>
            <div class=" view_load_search hidden">
                <div class="inline-flex w-10 aspect-[1/1] justify-center items-center cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" style="width: 25px; height: auto; fill: var(--html-bg-website);">
                        <circle r="80" cx="500" cy="90" style="fill: var(--html-bg-website);"></circle>
                        <circle r="80" cx="500" cy="910" style="fill: var(--html-bg-website);"></circle>
                        <circle r="80" cx="90" cy="500" style="fill: var(--html-bg-website);"></circle>
                        <circle r="80" cx="910" cy="500" style="fill: var(--html-bg-website);"></circle>
                        <circle r="80" cx="212" cy="212" style="fill: var(--html-bg-website);"></circle>
                        <circle r="80" cx="788" cy="212" style="fill: var(--html-bg-website);"></circle>
                        <circle r="80" cx="212" cy="788" style="fill: var(--html-bg-website);"></circle>
                        <circle r="80" cx="788" cy="788" style="fill: var(--html-bg-website);"></circle>
                    </svg>
                </div>
            </div>
        <?php } ?>
        <button type="submit" class="btn-search font-normal font-main-400 flex-initial rounded-full outline-none border-none cursor-pointer text-sm h-10 leading-[0] inline-flex justify-center items-center px-3 gap-2  bg-[var(--html-all-website)] text-white ">
            <i class="fas fa-search font-light text-lg leading-[0] inline-flex justify-center items-center"></i>
            <span>Tìm Kiếm</span>
        </button>
    </div>
</form>
<?php if ($config['function']['advancedSearch'] == true) { ?>
    <div class="view_input relative" style="width: 100%;"></div>
<?php } ?>

<!-- tìm kiếm button -->
<div class="search-Click flex items-center justify-center w-[36px] rounded-full border border-[var(--html-bg-website)] aspect-[1/1]">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
        <g clip-path="url(#clip0_1_3)">
            <path d="M19.8104 18.9119L14.6468 13.8308C15.999 12.3616 16.8298 10.4187 16.8298 8.28068C16.8291 3.7071 13.062 0 8.41466 0C3.76732 0 0.00019455 3.7071 0.00019455 8.28068C0.00019455 12.8543 3.76732 16.5614 8.41466 16.5614C10.4226 16.5614 12.2643 15.8668 13.7109 14.7122L18.8946 19.8134C19.1472 20.0622 19.5573 20.0622 19.8098 19.8134C20.063 19.5646 20.063 19.1607 19.8104 18.9119ZM8.41466 15.2873C4.48251 15.2873 1.29488 12.1504 1.29488 8.28068C1.29488 4.41101 4.48251 1.27403 8.41466 1.27403C12.3469 1.27403 15.5344 4.41101 15.5344 8.28068C15.5344 12.1504 12.3469 15.2873 8.41466 15.2873Z" fill="var(--html-bg-website)" />
        </g>
        <defs>
            <clipPath id="clip0_1_3">
                <rect width="20" height="20" fill="none" />
            </clipPath>
        </defs>
    </svg>
</div>