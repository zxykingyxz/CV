<?php
$title_sup = "text-sm sm:text-base line-clamp-2 font-medium font-main-500 text-[#3D3A3A] transition-all duration-300";
$title = "text-sm sm:text-base line-clamp-2 font-bold font-main-700 text-[#3D3A3A] transition-all duration-300";
foreach ($data as $key => $value) {
?>
    <div class="group/templateView_three relative load_website <?= $class ?> ">
        <div class="relative mb-5 sm:mb-9 overflow-hidden w-full aspect-[387/535]">
            <?= $func->addHrefImg([
                'addhref' => true,
                'href' =>  $jv0,
                'sizes' => '387x535x1',
                'actual_width' => 800,
                'upload' => _upload_hinhanh_l,
                'image' => ((isset($value["photo_$lang"])) ? $value["photo_$lang"] : $value["photo"]),
                'alt' => (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"],
            ]); ?>
            <?php if (!empty($value['link_facebook']) || !empty($value['link_twitter']) || !empty($value['link_twitter'])) { ?>
                <div class="absolute bottom-0 left-0 w-full translate-y-full group-hover/templateView_three:translate-y-0 transition-all duration-300 ">
                    <div class="w-full relative py-4 sm:py-6 px-2 z-10">
                        <div class="absolute top-0 left-0 w-full h-full bg-[var(--html-bg-website)] opacity-50 pointer-events-none z-[-1]"></div>
                        <div class="flex items-center justify-evenly">
                            <?php if (!empty($value['link_facebook'])) { ?>
                                <a href="<?= $value['link_facebook'] ?>" title="Facebook" target="_blank" class="inline-block leading-[0]">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="39" viewBox="0 0 40 39" fill="none">
                                        <path d="M28.9781 14.4609H23.25V11.2942C23.25 9.66021 23.3865 8.63104 25.7899 8.63104H28.8254V3.59604C27.3482 3.44721 25.863 3.37437 24.3761 3.37754C19.9675 3.37754 16.75 6.00112 16.75 10.8176V14.4609H11.875V20.7942L16.75 20.7926V35.0442H23.25V20.7895L28.2323 20.7879L28.9781 14.4609Z" fill="white" />
                                    </svg>
                                </a>
                            <?php } ?>
                            <?php if (!empty($value['link_twitter'])) { ?>
                                <a href="<?= $value['link_twitter'] ?>" title="Twitter" target="_blank" class="inline-block leading-[0]">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="39" height="39" viewBox="0 0 39 39" fill="none">
                                        <path d="M35.3334 6.54272C34.0984 7.27581 31.6205 8.27489 30.1638 8.56306C30.1211 8.57414 30.0862 8.58839 30.0451 8.59947C28.7578 7.32964 26.994 6.54272 25.0417 6.54272C21.1072 6.54272 17.9167 9.73314 17.9167 13.6677C17.9167 13.8751 17.8993 14.2567 17.9167 14.4594C12.6078 14.4594 8.56716 11.6791 5.66966 8.12606C5.35458 8.91772 5.21683 10.1686 5.21683 11.3434C5.21683 13.5616 6.95058 15.7403 9.65016 17.0909C9.153 17.2191 8.60516 17.311 8.03516 17.311C7.11525 17.311 6.1415 17.0687 5.25008 16.3341C5.25008 16.361 5.25008 16.3863 5.25008 16.4148C5.25008 19.515 8.54025 21.6256 11.4662 22.213C10.8725 22.5629 9.6755 22.5977 9.09125 22.5977C8.67958 22.5977 7.22291 22.4093 6.83341 22.3365C7.64725 24.8777 10.5827 26.3059 13.3805 26.3566C11.1923 28.0729 9.67391 28.7094 5.19308 28.7094H3.66675C6.49775 30.5239 10.103 31.8776 13.7162 31.8776C25.4803 31.8776 32.1667 22.9112 32.1667 14.4594C32.1667 14.3232 32.1636 14.0382 32.1588 13.7516C32.1588 13.7231 32.1667 13.6962 32.1667 13.6677C32.1667 13.625 32.1541 13.5838 32.1541 13.5411C32.1493 13.3257 32.1446 13.1246 32.1398 13.0201C33.3907 12.1176 34.4752 10.9919 35.3334 9.70939C34.1855 10.2192 32.9537 10.5612 31.6601 10.7164C32.9806 9.92473 34.8568 8.03739 35.3334 6.54272Z" fill="white" />
                                    </svg>
                                </a>
                            <?php } ?>
                            <?php if (!empty($value['link_tiktok'])) { ?>
                                <a href="<?= $value['link_tiktok'] ?>" title="TikTok" target="_blank" class="inline-block leading-[0]">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                        <g clip-path="url(#clip0_1_1541)">
                                            <path d="M29.5819 7.98462C27.8127 7.98462 26.1804 7.39853 24.8696 6.4098C23.3662 5.27636 22.286 3.61374 21.9046 1.69743C21.8101 1.22396 21.7593 0.735342 21.7544 0.234619H16.7006V14.0442L16.6945 21.6083C16.6945 23.6305 15.3776 25.3452 13.5521 25.9483C13.0223 26.1233 12.4502 26.2062 11.8544 26.1735C11.0939 26.1317 10.3813 25.9023 9.7619 25.5317C8.44379 24.7434 7.55012 23.3133 7.5259 21.6773C7.48776 19.1204 9.55483 17.0358 12.1099 17.0358C12.6143 17.0358 13.0986 17.1181 13.5521 17.2677V13.4932V12.1363C13.0738 12.0655 12.587 12.0285 12.0948 12.0285C9.29811 12.0285 6.68248 13.191 4.8128 15.2854C3.39963 16.8681 2.55197 18.8873 2.42119 21.0046C2.24985 23.7861 3.26764 26.4302 5.24147 28.381C5.53149 28.6674 5.83604 28.9332 6.15451 29.1784C7.8468 30.4808 9.91569 31.1868 12.0948 31.1868C12.587 31.1868 13.0738 31.1505 13.5521 31.0796C15.5877 30.7781 17.4659 29.8463 18.9481 28.381C20.7693 26.581 21.7756 24.1912 21.7865 21.6476L21.7605 10.352C22.6293 11.0223 23.5793 11.5769 24.5989 12.0074C26.1846 12.6764 27.866 13.0155 29.5964 13.0149V9.34511V7.98341C29.5977 7.98462 29.5831 7.98462 29.5819 7.98462Z" fill="white" />
                                        </g>
                                    </svg>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="w-full ">
            <div class="text-center mb-3">
                <a href='<?= $jv0 ?>' class="<?= $title ?>">
                    <?= (isset($value["ten_$lang"])) ? $value["ten_$lang"] : $value["ten"] ?>
                </a>
            </div>
            <div class="text-center <?= $title_sup ?> ">
                <span class="">
                    <?= (isset($value["mota_$lang"])) ? htmlspecialchars_decode($value["mota_$lang"]) : htmlspecialchars_decode($value['mota']) ?>
                </span>
            </div>
        </div>
    </div>
<?php } ?>