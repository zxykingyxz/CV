<?php
$author_post = $db->rawQuery("select ten_$lang as ten,id,id_list,tenkhongdau_$lang as tenkhongdau,type,luotxem,ngaytao,ngaysua from #_baiviet where hienthi=1 and type in ('san-pham','du-an','tin-tuc','dich-vu','chinh-sach') and id_tacgia=? order by stt asc,id asc ", array($row_detail["id"]));

$postCount = $db->rawQueryOne("select count(id) as total from #_baiviet where hienthi=1 and type in ('san-pham','du-an','tin-tuc','dich-vu','chinh-sach') and id_tacgia=?", array($row_detail["id"]));

?>

<section class="wrapper-detail mt-5 mb-5">
    <div class="grid_s wide">
        <div class="flex flex-wrap gap-3">
            <div class="flex-1 max-w-full ">
                <div class="bg_form_all">
                    <div class="flex items-center gap-5 mb-5">
                        <div class="flex-initial rounded-full p-2 sm:p-4 bg-white overflow-hidden shadow-lg border  border-gray-200 ">
                            <div class="overflow-hidden rounded-full max-w-[80px] sm:max-w-[100px] leading-[0]">
                                <?= $func->addHrefImg([
                                    'addhref' => true,
                                    'href' =>  $jv0,
                                    'target' => '',
                                    'sizes' => '500x500x1',
                                    'upload' => _upload_baiviet_l,
                                    'image' => $row_detail['photo'],
                                    'alt' => (isset($row_detail["ten_$lang"])) ? $row_detail["ten_$lang"] : $row_detail["ten"],
                                ]); ?>
                            </div>
                        </div>
                        <div class="flex-1 flex flex-col">
                            <?= $func->getTemplateLayoutsFor([
                                'name_layouts' => 'titleSeo',
                                'title' => $titleContainer,
                                'class' => 'text-[var(--html-bg-website)] capitalize text-xl sm:text-2xl font-bold font-main-700 mb-1',
                                'banner_tpl' => $banner_tpl,
                            ]); ?>
                            <div class="text-sm sm:text-base font-medium font-main mb-2 sm:mb-5">
                                <span><?= $row_detail["job_$lang"] ?></span>
                            </div>
                            <div class="flex gap-2 items-center">
                                <?php if (!empty($row_detail["link_facebook"])) { ?>
                                    <a href="<?= $row_detail["link_facebook"] ?>" title="facebook" class="inline-block leading-[0]" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                                            <g clip-path="url(#clip0_102_83)">
                                                <path d="M26.25 0H3.75C1.68187 0 0 1.68187 0 3.75V26.25C0 28.3181 1.68187 30 3.75 30H26.25C28.3181 30 30 28.3181 30 26.25V3.75C30 1.68187 28.3181 0 26.25 0Z" fill="#1976D2" />
                                                <path d="M25.3125 15H20.625V11.25C20.625 10.215 21.465 10.3125 22.5 10.3125H24.375V5.625H20.625C17.5181 5.625 15 8.14313 15 11.25V15H11.25V19.6875H15V30H20.625V19.6875H23.4375L25.3125 15Z" fill="#FAFAFA" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_102_83">
                                                    <rect width="30" height="30" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </a>
                                <?php } ?>
                                <?php if (!empty($row_detail["link_zalo"])) { ?>
                                    <a href="<?= $row_detail["link_zalo"] ?>" title="zalo" class="inline-block leading-[0]" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                                            <g clip-path="url(#clip0_102_104)">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.6692 0.0996094H16.3194C19.9592 0.0996094 22.0862 0.634206 23.9743 1.64653C25.8625 2.65884 27.3525 4.13751 28.3534 6.02568C29.3657 7.91382 29.9003 10.0408 29.9003 13.6806V16.3195C29.9003 19.9592 29.3657 22.0862 28.3534 23.9744C27.3411 25.8625 25.8625 27.3526 23.9743 28.3535C22.0862 29.3659 19.9592 29.9005 16.3194 29.9005H13.6805C10.0408 29.9005 7.91376 29.3659 6.02562 28.3535C4.1375 27.3412 2.64746 25.8625 1.64652 23.9744C0.6342 22.0862 0.0996094 19.9592 0.0996094 16.3195V13.6806C0.0996094 10.0408 0.6342 7.91382 1.64652 6.02568C2.65883 4.13751 4.1375 2.64747 6.02562 1.64653C7.90242 0.634206 10.0408 0.0996094 13.6692 0.0996094Z" fill="#0068FF" />
                                                <path opacity="0.12" fill-rule="evenodd" clip-rule="evenodd" d="M29.9002 15.8843V16.3198C29.9002 19.9595 29.3656 22.0865 28.3533 23.9747C27.341 25.8628 25.8623 27.3529 23.9741 28.3538C22.086 29.3662 19.959 29.9008 16.3192 29.9008H13.6804C10.7021 29.9008 8.73672 29.5428 7.08624 28.8581L4.36523 26.0561L29.9002 15.8843Z" fill="#001A33" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.6674 26.1535C6.06114 26.3076 7.80366 25.9102 9.04092 25.3095C14.4135 28.2791 22.8118 28.1372 27.8954 24.8839C28.0925 24.5882 28.2767 24.2806 28.4477 23.9618C29.4637 22.0667 30.0002 19.932 30.0002 16.279V13.6305C30.0002 9.9774 29.4637 7.84266 28.4477 5.94764C27.4431 4.05262 25.9477 2.56856 24.0526 1.55255C22.1576 0.536543 20.0228 0 16.3698 0H13.7099C10.5986 0 8.57892 0.391652 6.88194 1.13936C6.78918 1.22242 6.69816 1.30691 6.60906 1.39281C1.6304 6.19218 1.25195 16.5956 5.47367 22.2469C5.47838 22.2553 5.4836 22.2637 5.48933 22.2722C6.14004 23.2311 5.51216 24.9092 4.53041 25.891C4.37059 26.0394 4.42766 26.1307 4.6674 26.1535Z" fill="white" />
                                                <path d="M12.338 10.2H6.50299V11.4511H10.5522L6.55981 16.399C6.43471 16.581 6.34375 16.7516 6.34375 17.1383V17.4568H11.8489C12.1219 17.4568 12.3494 17.2293 12.3494 16.9563V16.2852H8.09539L11.8489 11.5762C11.9057 11.508 12.0081 11.3829 12.0536 11.326L12.0764 11.2919C12.2925 10.9734 12.338 10.7004 12.338 10.3706V10.2Z" fill="#0068FF" />
                                                <path d="M19.7651 17.4568H20.5954V10.2H19.3442V17.0359C19.3442 17.2635 19.5262 17.4568 19.7651 17.4568Z" fill="#0068FF" />
                                                <path d="M15.4886 11.8154C13.9189 11.8154 12.645 13.0893 12.645 14.659C12.645 16.2287 13.9189 17.5026 15.4886 17.5026C17.0583 17.5026 18.3322 16.2287 18.3322 14.659C18.3436 13.0893 17.0697 11.8154 15.4886 11.8154ZM15.4886 16.331C14.5673 16.331 13.8166 15.5803 13.8166 14.659C13.8166 13.7377 14.5673 12.987 15.4886 12.987C16.4099 12.987 17.1606 13.7377 17.1606 14.659C17.1606 15.5803 16.4213 16.331 15.4886 16.331Z" fill="#0068FF" />
                                                <path d="M24.2921 11.7698C22.711 11.7698 21.4258 13.0551 21.4258 14.6361C21.4258 16.2172 22.711 17.5025 24.2921 17.5025C25.8731 17.5025 27.1584 16.2172 27.1584 14.6361C27.1584 13.0551 25.8731 11.7698 24.2921 11.7698ZM24.2921 16.3309C23.3594 16.3309 22.6087 15.5802 22.6087 14.6475C22.6087 13.7148 23.3594 12.9641 24.2921 12.9641C25.2248 12.9641 25.9755 13.7148 25.9755 14.6475C25.9755 15.5802 25.2248 16.3309 24.2921 16.3309Z" fill="#0068FF" />
                                                <path d="M17.6738 17.4566H18.3449V11.9741H17.1733V16.9675C17.1733 17.2291 17.4008 17.4566 17.6738 17.4566Z" fill="#0068FF" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_102_104">
                                                    <rect width="30" height="30" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </a>
                                <?php } ?>
                                <?php if (!empty($row_detail["link_twitter"])) { ?>
                                    <a href="<?= $row_detail["link_twitter"] ?>" title="twitter" class="inline-block leading-[0]" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                                            <g clip-path="url(#clip0_102_113)">
                                                <path d="M27.6316 0H2.36842C1.06038 0 0 1.06038 0 2.36842V27.6316C0 28.9396 1.06038 30 2.36842 30H27.6316C28.9396 30 30 28.9396 30 27.6316V2.36842C30 1.06038 28.9396 0 27.6316 0Z" fill="#03A9F4" />
                                                <path d="M24.7165 8.97427C23.9857 9.29346 23.2126 9.50552 22.4211 9.60387C23.2554 9.10914 23.8791 8.32535 24.1738 7.40124C23.3929 7.86473 22.5384 8.19116 21.6474 8.36637C21.1015 7.78246 20.3924 7.37636 19.6125 7.20089C18.8325 7.02542 18.0179 7.08871 17.2744 7.38252C16.5309 7.67633 15.8931 8.18706 15.4438 8.84829C14.9946 9.50952 14.7547 10.2906 14.7553 11.0901C14.7525 11.3952 14.7837 11.6997 14.8481 11.998C13.2632 11.9201 11.7125 11.5088 10.2974 10.7908C8.88224 10.0729 7.63449 9.0645 6.6356 7.8315C6.12217 8.70863 5.9631 9.74872 6.19091 10.7392C6.41872 11.7297 7.01621 12.5958 7.86126 13.1605C7.23052 13.1434 6.61313 12.9749 6.06126 12.669V12.7124C6.06304 13.6318 6.38127 14.5226 6.96247 15.235C7.54366 15.9474 8.35239 16.4379 9.25271 16.6243C8.912 16.7138 8.56089 16.7576 8.20863 16.7545C7.95498 16.7592 7.70156 16.7367 7.45271 16.6874C7.71064 17.4781 8.20723 18.1695 8.87416 18.6664C9.54109 19.1633 10.3456 19.4414 11.1771 19.4624C9.76808 20.5637 8.03115 21.1619 6.24284 21.1618C5.9242 21.1645 5.60574 21.146 5.28955 21.1065C7.11298 22.2821 9.23842 22.9033 11.408 22.8947C18.7402 22.8947 22.7488 16.8216 22.7488 11.5578C22.7488 11.3822 22.7488 11.2124 22.7349 11.0427C23.5156 10.4793 24.1871 9.77836 24.7165 8.97427Z" fill="white" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_102_113">
                                                    <rect width="30" height="30" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </a>
                                <?php } ?>
                                <?php if (!empty($row_detail["link_instagram"])) { ?>
                                    <a href="<?= $row_detail["link_instagram"] ?>" title="instagram" class="inline-block leading-[0]" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                                            <g clip-path="url(#clip0_102_101)">
                                                <path d="M1.87513 2.04137C-0.482373 4.49012 0.000127003 7.09137 0.000127003 14.9939C0.000127003 21.5564 -1.14487 28.1351 4.84763 29.6839C6.71888 30.1651 23.2989 30.1651 25.1676 29.6814C27.6626 29.0376 29.6926 27.0139 29.9701 23.4851C30.0089 22.9926 30.0089 7.00387 29.9689 6.50137C29.6739 2.74262 27.3601 0.576369 24.3114 0.137619C23.6126 0.036369 23.4726 0.00636903 19.8876 0.000119029C7.17138 0.00636903 4.38388 -0.559881 1.87513 2.04137Z" fill="url(#paint0_linear_102_101)" />
                                                <path d="M14.9973 3.92378C10.4585 3.92378 6.14852 3.52003 4.50227 7.74503C3.82227 9.49003 3.92102 11.7563 3.92102 15.0013C3.92102 17.8488 3.82977 20.525 4.50227 22.2563C6.14477 26.4838 10.4898 26.0788 14.9948 26.0788C19.341 26.0788 23.8223 26.5313 25.4885 22.2563C26.1698 20.4938 26.0698 18.2613 26.0698 15.0013C26.0698 10.6738 26.3085 7.88003 24.2098 5.78253C22.0848 3.65753 19.211 3.92378 14.9923 3.92378H14.9973ZM14.0048 5.92003C23.4723 5.90503 24.6773 4.85253 24.0123 19.4738C23.776 24.645 19.8385 24.0775 14.9985 24.0775C6.17352 24.0775 5.91977 23.825 5.91977 14.9963C5.91977 6.06503 6.61977 5.92503 14.0048 5.91753V5.92003ZM20.9098 7.75878C20.176 7.75878 19.581 8.35378 19.581 9.08753C19.581 9.82128 20.176 10.4163 20.9098 10.4163C21.6435 10.4163 22.2385 9.82128 22.2385 9.08753C22.2385 8.35378 21.6435 7.75878 20.9098 7.75878ZM14.9973 9.31253C11.856 9.31253 9.30977 11.86 9.30977 15.0013C9.30977 18.1425 11.856 20.6888 14.9973 20.6888C18.1385 20.6888 20.6835 18.1425 20.6835 15.0013C20.6835 11.86 18.1385 9.31253 14.9973 9.31253ZM14.9973 11.3088C19.8785 11.3088 19.8848 18.6938 14.9973 18.6938C10.1173 18.6938 10.1098 11.3088 14.9973 11.3088Z" fill="white" />
                                            </g>
                                            <defs>
                                                <linearGradient id="paint0_linear_102_101" x1="1.93265" y1="28.084" x2="29.8145" y2="3.95259" gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#FFDD55" />
                                                    <stop offset="0.5" stop-color="#FF543E" />
                                                    <stop offset="1" stop-color="#C837AB" />
                                                </linearGradient>
                                                <clipPath id="clip0_102_101">
                                                    <rect width="30" height="30" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="flex mb-5">
                        <p class="mr-7"><i class="fa-regular fa-calendar mr-1"></i> <?= $func->daysOfTheWeek($row_detail["ngaytao"]) ?>, <?= date('d/m/Y', $row_detail['ngaytao']) ?></p>
                        <p><i class="fa-light fa-eye mr-1"></i><?= $row_detail['luotxem'] ?></p>
                    </div>
                    <?php if (!empty($row_detail['mota_' . $lang])) { ?>
                        <div class=" content mb-5">
                            <?= htmlspecialchars_decode($row_detail['mota_' . $lang]) ?>
                        </div>
                    <?php } ?>
                    <div class="mb-3">
                        <?php if (!empty($row_detail['noidung_' . $lang])) { ?>
                            <div class="wrapper-toc ">
                                <div class="content zoom-detail ">
                                    <?= $func->htmlDecodeContent($seo->getSeo('content')) ?>
                                </div>
                            </div>
                        <?php } else { ?>
                            <?= $func->getTemplateLayoutsFor([
                                'name_layouts' => 'form_nocontent',
                                'class' => '',
                            ]) ?>
                        <?php } ?>
                    </div>
                    <div class="bg-gray-100 rounded-md px-2 py-3 ">
                        <div>
                            <span class="">Chia sẻ:</span>
                        </div>
                        <div class="">
                            <?php include_once _source . 'shareLinks.php' ?>
                        </div>
                    </div>
                    <?php if (count($author_post) > 0) { ?>
                        <div class="w-full mt-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <?php foreach ($author_post as $key => $value) {
                                    $seoDB = $seo->getSeoDB($value['id'], 'baiviet', 'man', $value["type"]);
                                ?>
                                    <div class="rounded-md px-3 py-5  bg-gray-100">
                                        <div class='text-sm sm:text-base leading-normal sm:leading-normal font-bold font-main-700 text-gray-700 hover:text-[var(--html-bg-website)] transition-all duration-300 mb-3'>
                                            <a href='<?= $func->getUrl($value) ?>' title='<?= $value['ten'] ?>' aria-label='<?= $value['ten'] ?>' role='link' rel='dofollow'><?= $value['ten'] ?></a>
                                        </div>
                                        <div class='text-xs sm:text-sm leading-[1.78] font-normal font-main-400 text-[#3D3A3A] mb-5'>
                                            <span>
                                                <?= $seoDB["description_$lang"] ?>
                                            </span>
                                        </div>
                                        <div class='text-sm text-[#575757]'>
                                            <span class='mr-7'><i class='fa fa-calendar'></i> <?= ($value['ngaysua'] != 0) ? date('d/m/Y', $value['ngaysua']) : date('d/m/Y', $value['ngaytao']) ?></span>
                                            <span><i class='fa fa-eye'></i> <?= $value['luotxem'] ?></span>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?= $func->getTemplateLayoutsFor([
                'name_layouts' => 'relatedPosts',
                'data' => $tintuc,
                'class_form' => "w-full sm:w-[25%] min-w-[230px]",
            ]) ?>
        </div>
    </div>
</section>