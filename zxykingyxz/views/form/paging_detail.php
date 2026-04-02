<?php
$total_page = intdiv($total, $per_page);
if ($total % $per_page) {
    $total_page += 1;
}
if ($total_page > 1) {
    $list_button = [];
    $distance_page = 3;
    if ($total_page <= 5) {
        for ($i = 0; $i < $total_page; $i++) {
            $list_button[$i] = $i + 1;
        }
    } else {
        for ($i = $distance_page; $i > 0; $i--) {
            if (($page - $i) > 0) {
                $list_button[] = $page - $i;
            }
        }
        $list_button[] = $page;
        for ($i = 1; $i <= $distance_page; $i++) {
            if (($page + $i) <= $total_page) {
                $list_button[] = $page + $i;
            }
        }
    }
    $list_button = array_filter($list_button);
    // check url
    $url = 'http';
    // Kiểm tra nếu có header 'X-Forwarded-Proto' (cho trường hợp reverse proxy)
    if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
        $url .= "s";
    } else if (isset($_SERVER["HTTPS"]) && ($_SERVER["HTTPS"] == "on" || $_SERVER["HTTPS"] == "1")) {
        $url .= "s";
    }
    $url .= "://";

    if ($_SERVER["SERVER_PORT"] != "80") {
        $url .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $url .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    $url = explode("&page=", $url);
    $url = $url[0] . '&page=';

?>
    <div class="flex justify-center items-center content-center gap-1">
        <?php if ($page != 1) { ?>
            <a href="<?= $url . 1 ?>" title="Trang đầu" class="text-xs text-black h-[28px] aspect-[1/1] rounded-sm border border-gray-100 shadow bg-white hover:bg-blue-600 hover:border-blue-600 hover:text-white [&.active]bg-blue-600 [&.active]:border-blue-600 [&.active]text-white overflow-hidden transition-all duration-300 inline-flex justify-center items-center">
                <i class="fas fa-angle-double-left"></i>
            </a>
            <a href="<?= $url . ($page - 1) ?>" title="Trang trước" class="text-xs text-black h-[28px] aspect-[1/1] rounded-sm border border-gray-100 shadow bg-white hover:bg-blue-600 hover:border-blue-600 hover:text-white [&.active]bg-blue-600 [&.active]:border-blue-600 [&.active]text-white overflow-hidden transition-all duration-300 inline-flex justify-center items-center">
                <i class="fas fa-angle-left"></i>
            </a>
            <div class="inline-flex justify-center items-center h-[28px] mx-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                    <path d="M1.20001 7.2C1.86275 7.2 2.40002 6.66274 2.40002 6C2.40002 5.33725 1.86275 4.79999 1.20001 4.79999C0.537262 4.79999 0 5.33725 0 6C0 6.66274 0.537262 7.2 1.20001 7.2Z" fill="#AAAAAA" />
                    <path d="M5.99994 7.2C6.66268 7.2 7.19994 6.66274 7.19994 6C7.19994 5.33725 6.66268 4.79999 5.99994 4.79999C5.33719 4.79999 4.79993 5.33725 4.79993 6C4.79993 6.66274 5.33719 7.2 5.99994 7.2Z" fill="#AAAAAA" />
                    <path d="M10.8 7.2C11.4627 7.2 12 6.66274 12 6C12 5.33725 11.4627 4.79999 10.8 4.79999C10.1372 4.79999 9.59998 5.33725 9.59998 6C9.59998 6.66274 10.1372 7.2 10.8 7.2Z" fill="#AAAAAA" />
                </svg>
            </div>
        <?php } ?>

        <?php foreach ($list_button as $value_page) { ?>
            <a href="<?= $url . $value_page ?>" title="Trang <?= $value_page ?>" class=" <?= ($value_page == $page) ? "active" : '' ?> text-sm text-black [&.active]:h-[32px] h-[28px] aspect-[1/1] rounded-sm border border-gray-100 shadow bg-white hover:bg-blue-600 hover:border-blue-600 hover:text-white [&.active]:bg-blue-600 [&.active]:border-blue-600 [&.active]:text-white overflow-hidden transition-all duration-300 inline-flex justify-center items-center">
                <span>
                    <?= $value_page ?>
                </span>
            </a>
        <?php } ?>
        <?php if ($page != $total_page) { ?>
            <div class="inline-flex justify-center items-center h-[28px] mx-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                    <path d="M1.20001 7.2C1.86275 7.2 2.40002 6.66274 2.40002 6C2.40002 5.33725 1.86275 4.79999 1.20001 4.79999C0.537262 4.79999 0 5.33725 0 6C0 6.66274 0.537262 7.2 1.20001 7.2Z" fill="#AAAAAA" />
                    <path d="M5.99994 7.2C6.66268 7.2 7.19994 6.66274 7.19994 6C7.19994 5.33725 6.66268 4.79999 5.99994 4.79999C5.33719 4.79999 4.79993 5.33725 4.79993 6C4.79993 6.66274 5.33719 7.2 5.99994 7.2Z" fill="#AAAAAA" />
                    <path d="M10.8 7.2C11.4627 7.2 12 6.66274 12 6C12 5.33725 11.4627 4.79999 10.8 4.79999C10.1372 4.79999 9.59998 5.33725 9.59998 6C9.59998 6.66274 10.1372 7.2 10.8 7.2Z" fill="#AAAAAA" />
                </svg>
            </div>
            <a href="<?= $url . ($page + 1) ?>" title="Trang sau" class="text-xs text-black h-[28px] aspect-[1/1] rounded-sm border border-gray-100 shadow bg-white hover:bg-blue-600 hover:border-blue-600 hover:text-white [&.active]bg-blue-600 [&.active]:border-blue-600 [&.active]text-white overflow-hidden transition-all duration-300 inline-flex justify-center items-center">
                <i class="fas fa-angle-right"></i>
            </a>
            <a href="<?= $url . $total_page ?>" title="Trang cuối" class="text-xs text-black h-[28px] aspect-[1/1] rounded-sm border border-gray-100 shadow bg-white hover:bg-blue-600 hover:border-blue-600 hover:text-white [&.active]bg-blue-600 [&.active]:border-blue-600 [&.active]text-white overflow-hidden transition-all duration-300 inline-flex justify-center items-center">
                <i class="fas fa-angle-double-right"></i>
            </a>
        <?php } ?>
    </div>
<?php } ?>