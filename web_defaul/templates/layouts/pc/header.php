<?php
$list_c1_product_menu = $cache->getCache("select id,type , ten_$lang as ten , tenkhongdau_$lang as tenkhongdau from #_baiviet_list where noibat=1 and type in ('dien-tu','dien-lanh','do-gia-dung','hang-trung-bay') and hienthi=1 order by stt asc", array(), 'result', _TIMECACHE);
?>
<header class=" sticky  bg-[var(--html-all-website)] w-full top-0 z-40   header_menu [&.animate]:shadow-lg  group/header transition-all duration-300 ">
    <div class="grid_s wide relative ">
        <div class="flex py-1 items-center justify-between  transition-all duration-300 gap-[64px]">
            <div class="flex-initial leading-[0]">
                <?= $func->addHrefImg([
                    'classfix' => 'overflow-hidden inline-flex hover-left w-[330px]  transition-all duration-300',
                    'addhref' => true,
                    'href' =>   '',
                    'sizes' => '330x95x2',
                    'actual_width' => 800,
                    'isLazy' => true,
                    'upload' => _upload_hinhanh_l,
                    'image' => ($logo["photo"]),
                    'alt' => (isset($row_setting["name_$lang"])) ? $row_setting["name_$lang"] : $row_setting["name"],
                ]); ?>
                <?php if ($source == 'index') { ?>
                    <h2>
                    <?php } ?>
                    <span class="hidden">
                        Tranh Chủ
                    </span>
                    <?php if ($source == 'index') { ?>
                    </h2>
                <?php } ?>
            </div>
            <div class="flex-1 ">
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
            </div>
            <div class="pl-[7%]">
                <?php if ($config['cart']['turn_on'] == true) { ?>
                    <div class="menu-cart">
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
                    <div class="search-order cursor-pointer inline-flex justify-center items-end gap-2 text-white font-normal font-main-400 text-base leading-none mt-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
                            <path d="M15.6565 7.65796C14.4245 7.65796 13.421 8.66147 13.421 9.89345C13.421 11.1254 14.4245 12.1289 15.6565 12.1289C16.1922 12.1289 16.6843 11.9387 17.0698 11.6229L18.4046 12.9576C18.4252 12.9791 18.4499 12.9962 18.4772 13.008C18.5045 13.0198 18.5339 13.0261 18.5636 13.0264C18.5933 13.0267 18.6228 13.021 18.6504 13.0098C18.6779 12.9986 18.7029 12.9819 18.724 12.9609C18.745 12.9399 18.7616 12.9148 18.7729 12.8873C18.7841 12.8598 18.7897 12.8303 18.7894 12.8005C18.7891 12.7708 18.7829 12.7414 18.7711 12.7141C18.7593 12.6868 18.7422 12.6621 18.7207 12.6415L17.386 11.3068C17.7018 10.9212 17.892 10.4292 17.892 9.89345C17.892 8.66147 16.8885 7.65796 15.6565 7.65796ZM15.6565 8.10506C16.6469 8.10506 17.4449 8.9031 17.4449 9.89345C17.4449 10.8838 16.6469 11.6818 15.6565 11.6818C14.6662 11.6818 13.8681 10.8838 13.8681 9.89345C13.8681 8.9031 14.6662 8.10506 15.6565 8.10506Z" fill="white" />
                            <path d="M12.2891 4.07886H5.60558C5.47382 4.07886 5.36841 4.19002 5.36841 4.32898C5.36841 4.46794 5.47382 4.57911 5.60558 4.57911H12.2891C12.4209 4.57911 12.5263 4.46794 12.5263 4.32898C12.5263 4.19002 12.4209 4.07886 12.2891 4.07886ZM12.2891 5.59003H5.60558C5.47382 5.59003 5.36841 5.7012 5.36841 5.84015C5.36841 5.97911 5.47382 6.09028 5.60558 6.09028H12.2891C12.4209 6.09028 12.5263 5.97911 12.5263 5.84015C12.5263 5.7012 12.4209 5.59003 12.2891 5.59003ZM12.2891 7.1012H5.60558C5.47382 7.1012 5.36841 7.21237 5.36841 7.35133C5.36841 7.49028 5.47382 7.60145 5.60558 7.60145H12.2891C12.4209 7.60145 12.5263 7.49028 12.5263 7.35133C12.5263 7.21237 12.4209 7.1012 12.2891 7.1012ZM12.2891 8.6089H5.60558C5.47382 8.6089 5.36841 8.72006 5.36841 8.85902C5.36841 8.99798 5.47382 9.10915 5.60558 9.10915H12.2891C12.4209 9.10915 12.5263 8.99798 12.5263 8.85902C12.5263 8.72354 12.4209 8.6089 12.2891 8.6089ZM12.2891 10.1201H5.60558C5.47382 10.1201 5.36841 10.2312 5.36841 10.3702C5.36841 10.5092 5.47382 10.6203 5.60558 10.6203H12.2891C12.4209 10.6203 12.5263 10.5092 12.5263 10.3702C12.5263 10.2347 12.4209 10.1201 12.2891 10.1201ZM12.2891 11.6312H5.60558C5.47382 11.6312 5.36841 11.7424 5.36841 11.8814C5.36841 12.0203 5.47382 12.1315 5.60558 12.1315H12.2891C12.4209 12.1315 12.5263 12.0203 12.5263 11.8814C12.5263 11.7424 12.4209 11.6312 12.2891 11.6312Z" fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M17.4141 13.6128H15.4785V12.1245C15.128 12.0967 14.8003 11.9881 14.514 11.8174V13.6161H5.32302C5.05604 13.6128 4.83911 13.8306 4.83911 14.0987V15.858C4.83911 16.2266 4.54209 16.5248 4.17498 16.5248C4.15496 16.5248 4.13494 16.5282 4.11491 16.5315C4.09489 16.5282 4.07487 16.5248 4.05484 16.5248C3.68774 16.5248 3.39071 16.2266 3.39071 15.858V2.13867C3.39071 1.90075 3.34066 1.67623 3.25055 1.47181H13.8499C14.217 1.47181 14.514 1.77006 14.514 2.13867V7.97211C14.7339 7.84098 14.9782 7.74652 15.2385 7.69715C15.3171 7.68219 15.3972 7.67137 15.4785 7.66493V2.13867C15.4785 1.23388 14.7476 0.5 13.8465 0.5H1.58189C0.700837 0.523458 0 1.26069 0 2.14873V3.90804C0 4.03538 0.0500597 4.15937 0.140167 4.2532C0.230275 4.34368 0.353756 4.39395 0.480574 4.39395H2.41622V15.8613C2.41622 16.7661 3.14709 17.5 4.04817 17.5C4.06819 17.5 4.08821 17.4966 4.10824 17.4933C4.12826 17.4966 4.14829 17.5 4.16831 17.5H16.2627C17.1638 17.5 17.8947 16.7661 17.8947 15.8613V14.102C17.898 13.8306 17.6844 13.6128 17.4141 13.6128ZM0.971159 3.42214V2.14873C0.971159 1.41819 1.73541 1.47181 1.73541 1.47181H1.75877C2.12587 1.47181 2.42289 1.77006 2.42289 2.13867V3.42214H0.971159ZM16.9302 15.8613C16.9302 16.2299 16.6332 16.5282 16.2661 16.5282H5.66343C5.75354 16.3238 5.8036 16.0992 5.8036 15.8613V14.5879H16.9302V15.8613Z" fill="white" />
                        </svg>
                        <span>Tra cứu đơn hàng</span>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="w-full bg-[#282727] ">
        <div class="grid_s wide">
            <div class="form_menu flex relative justify-between items-center py-5">
                <div class="group/DM flex-initial leading-[0]">
                    <div class=" inline-flex justify-center items-center leading-none gap-4 text-base font-semibold font-main-700 text-white cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="19" viewBox="0 0 27 19" fill="none">
                            <path d="M1 1H26" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M1 9.33325H26" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M1 17.6667H26" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span>Danh mục</span>
                    </div>
                    <div class="opacity-0 invisible  group-hover/DM:opacity-100 group-hover/DM:visible  absolute top-full w-full left-0 bg-white shadow-md shadow-gray-300 border border-gray-200 rounded-md overflow-hidden flex transition-all duration-300 ">
                        <div class="w-[250px] bg-gray-200 border-r border-gray-300">
                            <div class="grid grid-cols-1 ">
                                <?php foreach (array('dien-tu', 'dien-lanh', 'do-gia-dung', 'hang-trung-bay') as $value) { ?>
                                    <div class=" bg-inherit [&.on]:bg-white [&.on]:text-[var(--html-cl-website)] w-full first:border-none border-t border-gray-300 btn_menu transition-all duration-300 <?= ($value == 'dien-tu') ? "on" : "" ?> " data-nb="<?= $value ?>">
                                        <?php if ($source == 'index') { ?>
                                            <h2>
                                            <?php } ?>
                                            <a href="<?= $jv0 ?>" title="<?= $authArrs[$value]['title'] ?>" class=" flex px-3 py-5 ">
                                                <span><?= $authArrs[$value]['title'] ?></span>
                                            </a>
                                            <?php if ($source == 'index') { ?>
                                            </h2>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="flex-1">
                            <?php foreach (array('dien-tu', 'dien-lanh', 'do-gia-dung', 'hang-trung-bay') as $value) {
                                $list_c1_dm = $cache->getCache("select id,type, ten_$lang as ten , tenkhongdau_$lang as tenkhongdau ,photo from #_baiviet_list where type=? and hienthi=1 order by stt asc", array($value), 'result', _TIMECACHE);
                            ?>
                                <div class="w-full data_menu p-2 opacity_animaiton <?= ($value == 'dien-tu') ? "" : "hidden" ?>" data-nb="<?= $value ?>">
                                    <div class="grid w-full gap-2 grid-cols-6 max-h-[300px] overflow-y-auto overflow-x-hidden scroll-y">
                                        <?php foreach ($list_c1_dm as $key_dm => $value_dm) { ?>
                                            <div class="w-full ">
                                                <div class="w-full inline-flex justify-center items-center">
                                                    <div class="max-w-[60px]">
                                                        <?= $func->addHrefImg([
                                                            'addhref' => true,
                                                            'href' =>  $func->getUrl($value_dm),
                                                            'sizes' => '70x70x2',
                                                            'actual_width' => 400,
                                                            'upload' => _upload_baiviet_l,
                                                            'image' =>  $value_dm["photo"],
                                                            'alt' => (isset($value_dm["ten_$lang"])) ? $value_dm["ten_$lang"] : $value_dm["ten"],
                                                        ]); ?>
                                                    </div>
                                                </div>
                                                <div class="w-full text-center text-xs font-normal font-main-400 text-black">
                                                    <?php if ($source == 'index') { ?>
                                                        <h3>
                                                        <?php } ?>
                                                        <a href="<?= $func->getUrl($value_dm) ?>" title="<?= (isset($value_dm["ten_$lang"])) ? $value_dm["ten_$lang"] : $value_dm["ten"] ?>">
                                                            <span>
                                                                <?= (isset($value_dm["ten_$lang"])) ? $value_dm["ten_$lang"] : $value_dm["ten"] ?>
                                                            </span>
                                                        </a>
                                                        <?php if ($source == 'index') { ?>
                                                        </h3>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="flex-1 ">
                    <div class="hidden">
                        <?php if ($source == 'index') { ?>
                            <h2>
                            <?php } ?>
                            <span>Sản Phấm</span>
                            <?php if ($source == 'index') { ?>
                            </h2>
                        <?php } ?>
                    </div>
                    <div class="max-w-full flex items-center overflow-x-auto overflow-y-hidden gap-9">
                        <div class="flex-1"></div>
                        <?php foreach ($list_c1_product_menu as $key_c1_product_menu => $value_c1_product_menu) { ?>
                            <a href="<?= $func->getUrl($value_c1_product_menu) ?>" title="<?= $value_c1_product_menu['ten'] ?>" class="inline-block leading-tight text-base text-white font-main-400 font-normal italic">
                                <span>
                                    <?= $value_c1_product_menu['ten'] ?>
                                </span>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>