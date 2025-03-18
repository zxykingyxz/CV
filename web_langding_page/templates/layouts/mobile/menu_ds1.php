<?php
global $authArrs, $notShowMenu;
$socical_header = $cache->getCache("select id,photo,ten_$lang as ten,link from #_photo where hienthi=1 and type=?", array('mangxahoi_header'), 'result', _TIMECACHE);

?>

<div class="box-modal-menu d-none d-block-m d-block-tablet" id="menuSide">

    <div class="box-modal-menu__header p-relative">

        <div class="box-modal-menu__header-box">

            <div class="box-modal-menu__header-box-close" id="close-menumobile">

                <span><i class="fa-solid fa-square-xmark"></i></span>

                <span><?= _dong ?></span>

            </div>

            <a href="" title="<?= _trangchu ?>" class="box-modal-menu__header-box-home">

                <span><i class="fa-sharp fa-solid fa-house-user"></i></span>

                <span><?= _trangchu ?></span>

            </a>

            <div class="box-modal-menu__header-box-search ">

                <?php /* include _layouts."ggtranslate.php"; */ ?>

                <input autocomplete="off" role="text" class="autocomplete_keyword_searchs" data-role="search-input" type="text" name="keywords" id="keywords-mmenu" placeholder="Tìm kiếm sản phẩm...">

                <div class="search-autocompletes autocomplete_shows"></div>

                <button class="button-search-mmenu" type="submit" data-btn-search="" data-target="#keywords-mmenu" data-view="">

                    <i class="fa-light fa-magnifying-glass"></i>

                </button>

            </div>

        </div>

    </div>

    <div class="p-relative">

        <ul class="list menu_list ">

            <?php foreach ($authArrs as $key => $value) {
                $list_c1 = $cache->getCache("select id,type,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau from #_baiviet_list where hienthi=1 and type=? order by stt asc, id desc", array($key), 'result', _TIMECACHE);

                if (!in_array($key, $notShowMenu)) { ?>

                    <li>

                        <div class="d-flex p-relative">

                            <a itemprop="url" title="<?= $value['title'] ?>" href="<?= $func->getType($key) ?>"><?= $value['title'] ?></a>

                            <?php if (count($list_c1) > 0) { ?>

                                <a href="javascript:" class="toggle-btn ic-arrow">

                                    <span></span>

                                </a>

                            <?php } ?>

                        </div>

                        <ul class="inner ul-list-none" style="display: none;">

                            <?php if (count($list_c1) > 0) {

                                foreach ($list_c1 as $key => $vc1) {

                                    $c2 = $db->rawQuery("select id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,photo,type from #_baiviet_cat where hienthi=1 and id_list=? order by stt asc,id desc", array($vc1['id']));

                            ?>

                                    <li class="mt10 mb10">

                                        <div class="d-flex p-relative">

                                            <a itemprop="url" title="<?= $vc1["ten"] ?>" href="<?= $func->getUrl($vc1) ?>"><?= $vc1["ten"] ?></a>

                                            <?php if (count($c2) > 0) { ?>

                                                <a href="javascript:" class="toggle-btn ic-arrow">

                                                    <span></span>

                                                </a>

                                            <?php } ?>

                                        </div>

                                        <?php if (count($c2) > 0) { ?>

                                            <ul class="inner ul-list-none pr20" style="display: none;">

                                                <?php foreach ($c2 as $key => $vc2) {

                                                    $c3 = $db->rawQuery("select id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,photo,type from #_baiviet_item where hienthi=1 and id_cat=? order by stt asc,id desc", array($vc2['id']));

                                                ?>

                                                    <li class="mt10 mb10">

                                                        <div class="d-flex p-relative">

                                                            <a itemprop="url" title="<?= $vc2["ten"] ?>" href="<?= $func->getUrl($vc2) ?>"><?= $vc2["ten"] ?></a>

                                                            <?php if (count($c3) > 0) { ?>

                                                                <a href="javascript:" class="toggle-btn ic-arrow">

                                                                    <span></span>

                                                                </a>

                                                            <?php } ?>

                                                        </div>

                                                        <?php if (count($c3) > 0) { ?>

                                                            <ul class="inner ul-list-none pr20" style="display: none;">

                                                                <li class="mt10 mb10">

                                                                    <div class="wrapper-cat__product">

                                                                        <div class="row">

                                                                            <?php foreach ($c3 as $key => $vc3) { ?>

                                                                                <div class="col l-12 m-12 c-12 mb10">

                                                                                    <div class="wrapper-cat__product-box d-flex flex-col flex-cl-1">

                                                                                        <div class="wrapper-cat__product-box-detail d-flex flex-col flex-cl-1">

                                                                                            <div class="wrapper-cat__product-box-title line-2 flex-cl-1">

                                                                                                <a href="<?= $func->getUrl($vc3) ?>" title="<?= $vc3["ten"] ?>" class="no-menu-css"><?= $vc3["ten"] ?></a>

                                                                                            </div>

                                                                                        </div>

                                                                                    </div>

                                                                                </div>

                                                                            <?php } ?>

                                                                        </div>

                                                                    </div>

                                                                </li>

                                                            </ul>

                                                        <?php } ?>

                                                    </li>

                                                <?php } ?>

                                            </ul>

                                        <?php } ?>

                                    </li>

                            <?php }
                            } ?>

                        </ul>

                    </li>

            <?php }
            } ?>

        </ul>

        <?php
        /*
        <div class=" mt25 d-flex justify-content-center">
            <a class="btn__header">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                    <g clip-path="url(#clip0_348_593)">
                        <path d="M3.66567 4.0675H3.88027C4.2064 4.0675 4.47077 3.80304 4.47077 3.47699V1.84746V1.23793C4.47077 0.91189 4.2064 0.647461 3.88027 0.647461H3.66567C3.33956 0.647461 3.0752 0.91189 3.0752 1.23793V1.84749V3.47699C3.0752 3.80304 3.33956 4.0675 3.66567 4.0675Z" fill="white" />
                        <path d="M11.2399 4.05285H11.4545C11.7807 4.05285 12.045 3.78842 12.045 3.46235V1.69279V1.22325C12.045 0.897241 11.7807 0.632812 11.4545 0.632812H11.2399C10.9138 0.632812 10.6494 0.897241 10.6494 1.22325V1.69279V3.46231C10.6495 3.78842 10.9138 4.05285 11.2399 4.05285Z" fill="white" />
                        <path d="M14.0401 1.84766H12.5246V3.61719C12.5246 4.20747 12.0444 4.53305 11.4541 4.53305H11.2395C10.6493 4.53305 10.169 4.05282 10.169 3.46253V1.84766H4.95059V3.47716C4.95059 4.06745 4.47039 4.54768 3.8801 4.54768H3.6655C3.07525 4.54768 2.59505 4.06745 2.59505 3.47716V1.84766H0.959973C0.430652 1.84766 0 2.27831 0 2.80766V14.4077C0 14.9371 0.430652 15.3677 0.959973 15.3677H14.0401C14.5694 15.3677 15 14.9371 15 14.4077V2.80766C15.0001 2.27834 14.5694 1.84766 14.0401 1.84766ZM14.0401 14.4077H0.960004L0.959973 5.64765H14.0402L14.0407 14.4077C14.0407 14.4077 14.0405 14.4077 14.0401 14.4077Z" fill="white" />
                        <path d="M7.99579 8.58572H9.71948C9.78781 8.58572 9.84321 8.53033 9.84321 8.462V6.96943C9.84321 6.9011 9.78781 6.8457 9.71948 6.8457H7.99579C7.92747 6.8457 7.87207 6.9011 7.87207 6.96943V8.462C7.87207 8.53033 7.92747 8.58572 7.99579 8.58572Z" fill="white" />
                        <path d="M10.8083 8.58572H12.532C12.6003 8.58572 12.6557 8.53033 12.6557 8.462V6.96943C12.6557 6.9011 12.6003 6.8457 12.532 6.8457H10.8083C10.74 6.8457 10.6846 6.9011 10.6846 6.96943V8.462C10.6846 8.53033 10.74 8.58572 10.8083 8.58572Z" fill="white" />
                        <path d="M2.36982 11.0291H4.09348C4.1618 11.0291 4.2172 10.9737 4.2172 10.9054V9.41279C4.2172 9.34446 4.1618 9.28906 4.09348 9.28906H2.36982C2.30149 9.28906 2.24609 9.34446 2.24609 9.41279V10.9054C2.24609 10.9737 2.30149 11.0291 2.36982 11.0291Z" fill="white" />
                        <path d="M5.18232 11.0291H6.90598C6.9743 11.0291 7.0297 10.9737 7.0297 10.9054V9.41279C7.0297 9.34446 6.9743 9.28906 6.90598 9.28906H5.18232C5.11399 9.28906 5.05859 9.34446 5.05859 9.41279V10.9054C5.05859 10.9737 5.11399 11.0291 5.18232 11.0291Z" fill="white" />
                        <path d="M7.99579 11.0291H9.71945C9.78778 11.0291 9.84318 10.9737 9.84318 10.9054V9.41279C9.84318 9.34446 9.78778 9.28906 9.71945 9.28906H7.99579C7.92747 9.28906 7.87207 9.34446 7.87207 9.41279V10.9054C7.87207 10.9737 7.92747 11.0291 7.99579 11.0291Z" fill="white" />
                        <path d="M10.8083 11.0291H12.532C12.6003 11.0291 12.6557 10.9737 12.6557 10.9054V9.41279C12.6557 9.34446 12.6003 9.28906 12.532 9.28906H10.8083C10.74 9.28906 10.6846 9.34446 10.6846 9.41279V10.9054C10.6846 10.9737 10.74 11.0291 10.8083 11.0291Z" fill="white" />
                        <path d="M4.09345 11.7329H2.36982C2.30149 11.7329 2.24609 11.7883 2.24609 11.8566V13.3492C2.24609 13.4176 2.30149 13.473 2.36982 13.473H4.09348C4.1618 13.473 4.2172 13.4176 4.2172 13.3492V11.8566C4.21717 11.7883 4.16177 11.7329 4.09345 11.7329Z" fill="white" />
                        <path d="M6.90598 11.7329H5.18232C5.11399 11.7329 5.05859 11.7883 5.05859 11.8566V13.3492C5.05859 13.4176 5.11399 13.473 5.18232 13.473H6.90598C6.9743 13.473 7.0297 13.4176 7.0297 13.3492V11.8566C7.0297 11.7883 6.9743 11.7329 6.90598 11.7329Z" fill="white" />
                        <path d="M9.71948 11.7329H7.99579C7.92747 11.7329 7.87207 11.7883 7.87207 11.8566V13.3492C7.87207 13.4176 7.92747 13.473 7.99579 13.473H9.71948C9.78781 13.473 9.84321 13.4176 9.84321 13.3492V11.8566C9.84321 11.7883 9.78781 11.7329 9.71948 11.7329Z" fill="white" />
                        <path d="M12.532 11.7329H10.8083C10.74 11.7329 10.6846 11.7883 10.6846 11.8566V13.3492C10.6846 13.4176 10.74 13.473 10.8083 13.473H12.532C12.6003 13.473 12.6557 13.4176 12.6557 13.3492V11.8566C12.6557 11.7883 12.6003 11.7329 12.532 11.7329Z" fill="white" />
                    </g>
                    <defs>
                        <clipPath id="clip0_348_593">
                            <rect width="15" height="15" fill="white" transform="translate(0 0.5)" />
                        </clipPath>
                    </defs>
                </svg>
                <span>
                    Đặt bàn ngay
                </span>
            </a>
        </div>
       */
        ?>
    </div>
</div>