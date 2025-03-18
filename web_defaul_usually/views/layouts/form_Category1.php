<?php
$level_1 = $db->rawQuery("select id,type,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau from #_baiviet_list where type=? and hienthi=1 order by stt asc, id desc", array('danh-muc'));

?>
<script>
    $(".form_menu").btnNoneBlockPlugin({
        button: 'btn_menu', // Thay thế class cho button
        data: 'data_menu',
        animation: false,
        check_out: false,
        close: false,
        event_hover: true,
    });
</script>
<div class="form_menu flex-initial  ">
    <div class="group/DM flex-initial leading-[0]">
        <div class=" inline-flex justify-center items-center leading-none gap-2 text-base font-semibold font-main-600 text-black cursor-pointer uppercase">
            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
                <g clip-path="url(#clip0_1_952)">
                    <path d="M6.39945 7.74266H2.05168C1.61147 7.74225 1.1894 7.56723 0.878072 7.25601C0.566747 6.94478 0.391597 6.52276 0.391052 6.08255V1.78878C0.391597 1.34856 0.566747 0.926547 0.878072 0.615318C1.1894 0.30409 1.61147 0.12907 2.05168 0.128662H6.39945C6.83957 0.129206 7.26152 0.304286 7.57273 0.6155C7.88394 0.926714 8.05902 1.34865 8.05957 1.78878V6.08255C8.05902 6.52267 7.88394 6.94461 7.57273 7.25583C7.26152 7.56704 6.83957 7.74212 6.39945 7.74266ZM2.05168 1.41438C1.95238 1.41451 1.85717 1.45398 1.78691 1.52415C1.71664 1.59432 1.67704 1.68947 1.67677 1.78878V6.08255C1.67704 6.18185 1.71664 6.277 1.78691 6.34717C1.85717 6.41734 1.95238 6.45681 2.05168 6.45695H6.39945C6.49871 6.45681 6.59386 6.41732 6.66404 6.34714C6.73423 6.27695 6.77372 6.1818 6.77385 6.08255V1.78878C6.77372 1.68952 6.73423 1.59437 6.66404 1.52419C6.59386 1.454 6.49871 1.41451 6.39945 1.41438H2.05168Z" fill="black" />
                    <path d="M6.42051 16.3567H2.07274C1.63248 16.3561 1.21041 16.181 0.899097 15.8697C0.587787 15.5584 0.412654 15.1363 0.412109 14.696V10.4028C0.412654 9.96258 0.587804 9.54056 0.899129 9.22933C1.21045 8.9181 1.63253 8.74308 2.07274 8.74268H6.42051C6.86045 8.74349 7.28213 8.91869 7.59312 9.22988C7.90411 9.54106 8.07905 9.96285 8.07959 10.4028V14.696C8.07919 15.1361 7.90431 15.558 7.5933 15.8693C7.2823 16.1806 6.86054 16.3559 6.42051 16.3567ZM2.07274 10.0284C1.97344 10.0285 1.87823 10.068 1.80796 10.1382C1.7377 10.2083 1.6981 10.3035 1.69782 10.4028V14.696C1.69796 14.7954 1.7375 14.8907 1.80778 14.961C1.87806 15.0313 1.97335 15.0708 2.07274 15.071H6.42051C6.51981 15.0707 6.61496 15.0311 6.68513 14.9608C6.7553 14.8906 6.79477 14.7954 6.79491 14.696V10.4028C6.79477 10.3035 6.75528 10.2084 6.6851 10.1382C6.61492 10.068 6.51976 10.0285 6.42051 10.0284H2.07274Z" fill="black" />
                    <path d="M15.088 16.3567H10.7402C10.3 16.3561 9.87789 16.181 9.56658 15.8697C9.25527 15.5584 9.08013 15.1363 9.07959 14.696V10.4028C9.08013 9.96258 9.25528 9.54056 9.56661 9.22933C9.87793 8.9181 10.3 8.74308 10.7402 8.74268H15.088C15.5281 8.74322 15.9501 8.9183 16.2613 9.22951C16.5725 9.54073 16.7476 9.96267 16.7481 10.4028V14.696C16.7477 15.1363 16.5727 15.5583 16.2614 15.8697C15.9502 16.181 15.5282 16.3561 15.088 16.3567ZM10.7402 10.031C10.6409 10.0311 10.5457 10.0706 10.4754 10.1407C10.4052 10.2109 10.3656 10.3061 10.3653 10.4054V14.6986C10.3654 14.798 10.405 14.8933 10.4753 14.9636C10.5455 15.0339 10.6408 15.0734 10.7402 15.0735H15.088C15.1873 15.0733 15.2824 15.0337 15.3526 14.9634C15.4228 14.8931 15.4623 14.7979 15.4624 14.6986V10.4028C15.4623 10.3035 15.4228 10.2084 15.3526 10.1382C15.2824 10.068 15.1872 10.0285 15.088 10.0284L10.7402 10.031Z" fill="black" />
                    <path d="M12.837 7.74267C12.0855 7.73709 11.3525 7.50915 10.7304 7.08759C10.1083 6.66603 9.62492 6.06973 9.34121 5.37385C9.0575 4.67797 8.98616 3.91368 9.13618 3.17731C9.2862 2.44095 9.65087 1.76549 10.1842 1.23607C10.7176 0.70666 11.3957 0.346999 12.1332 0.202433C12.8706 0.0578666 13.6344 0.134866 14.3281 0.423724C15.0219 0.712582 15.6146 1.20037 16.0315 1.82559C16.4485 2.45081 16.671 3.18547 16.671 3.93696C16.666 4.94965 16.2595 5.919 15.5408 6.63244C14.822 7.34587 13.8497 7.74514 12.837 7.74267ZM12.837 1.41696C12.3398 1.42254 11.8554 1.57506 11.4448 1.85534C11.0341 2.13561 10.7155 2.5311 10.5291 2.99203C10.3427 3.45297 10.2968 3.95874 10.3972 4.4457C10.4976 4.93265 10.7398 5.37902 11.0933 5.72862C11.4469 6.07823 11.8959 6.31544 12.384 6.41041C12.872 6.50537 13.3772 6.45384 13.8361 6.26231C14.2949 6.07077 14.6868 5.74779 14.9625 5.33401C15.2381 4.92023 15.3853 4.43416 15.3853 3.93696C15.3812 3.26473 15.1106 2.62158 14.6328 2.14865C14.1551 1.67572 13.5092 1.41165 12.837 1.41439V1.41696Z" fill="black" />
                </g>
                <defs>
                    <clipPath id="clip0_1_952">
                        <rect width="18" height="18" fill="white" transform="translate(0.262451)" />
                    </clipPath>
                </defs>
            </svg>
            <span>Danh mục</span>
        </div>
        <div class="opacity-0 invisible  group-hover/DM:opacity-100 group-hover/DM:visible  absolute top-full w-full left-0 bg-white shadow-md shadow-gray-300 border border-gray-200 rounded-md overflow-hidden flex transition-all duration-300 ">
            <div class="w-[250px] bg-gray-200 border-r border-gray-300">
                <div class="grid grid-cols-1 ">
                    <?php foreach ($level_1 as $key_c1 => $value_c1) {
                        $name = (isset($value_c1["ten_$lang"])) ? $value_c1["ten_$lang"] : $value_c1["ten"];
                    ?>
                        <div class=" bg-inherit [&.on]:bg-white [&.on]:text-[var(--html-cl-website)] w-full first:border-none border-t border-gray-300 btn_menu transition-all duration-300 <?= ($key_c1 == 0) ? "on" : "" ?> " data-nb="<?= "product_menu_" . $key_c1 ?>">
                            <?php if ($source == 'index') { ?>
                                <h3>
                                <?php } ?>
                                <a href=" <?= $func->getUrl($value_c1) ?>" rel="dofollow" role="link" aria-label="<?= $name ?>" title="<?= $name ?>" class=" flex px-3 py-5 font-normal">
                                    <span>
                                        <?= $name ?>
                                    </span>
                                </a>
                                <?php if ($source == 'index') { ?>
                                </h3>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="flex-1">
                <?php foreach ($level_1 as $key_c1 => $value_c1) {
                    $list_c2_dm = $cache->getCache("select id,type, ten_$lang as ten , tenkhongdau_$lang as tenkhongdau ,photo from #_baiviet_cat where type=? and id_list=? and hienthi=1 order by stt asc", array($value_c1['type'], $value_c1['id']), 'result', _TIMECACHE);
                ?>
                    <div class="w-full data_menu p-2 opacity_animaiton <?= ($key_c1 == 0) ? "" : "hidden" ?>" data-nb="<?= "product_menu_" . $key_c1 ?>">
                        <div class="grid w-full gap-2 grid-cols-6 max-h-[300px] overflow-y-auto overflow-x-hidden scroll-y" style="row-gap: 20px;">
                            <?php foreach ($list_c2_dm as $key_dm => $value_dm) { ?>
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
                                            <a href="<?= $func->getUrl($value_dm) ?>" title="<?= (isset($value_dm["ten_$lang"])) ? $value_dm["ten_$lang"] : $value_dm["ten"] ?>" class="font-normal">
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
</div>