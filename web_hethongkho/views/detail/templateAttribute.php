<?php
$data_attribute = json_decode($row_detail['options'], true);
?>
<?php
foreach ($data_attribute['attribute'] as $value) {
    $type_attribute = $func->returnUnsignedName($value);
    $ds_attribute = $cache->getCache("select * from #_attribute where type=? and id_product=? and hienthi=1 order by stt asc", array($type_attribute, $row_detail['id']), 'result', _TIMECACHE);
    if (!empty($ds_attribute)) {
?>
        <div class=" flex flex-wrap form-btn-nb mb-2">
            <div class="text-xl capitalize text-gray-500  w-full">
                <span class=""><?= $value ?></span>
            </div>
            <div class="flex flex-wrap flex-1 gap-2 mt-2">
                <?php foreach ($ds_attribute as $k_tt => $v_tt) { ?>
                    <div class="btn_attribute flex-initial cursor-pointer py-1 px-3 border border-gray-700 text-sm font-main-400 font-normal text-gray-400 rounded-sm   btn-nb text-center relative " data-id-attribute="<?= $v_tt['id'] ?>" data-form-attribute="<?= $type_attribute ?>_input" data-type="<?= $v_tt['type'] ?>" data-id-product="<?= $row_detail['id'] ?>">
                        <span>
                            <?= $v_tt["ten_$lang"] ?>
                        </span>
                        <div class="right-0 bottom-0 pr-[2px] pb-[2px] pointer-events-none transition-all duration-300 opacity-0 absolute inline-flex justify-end items-end">
                            <svg xmlns="http://www.w3.org/2000/svg" height="9" width="9" viewBox="0 0 520 520" fill="#fff">
                                <g id="_7-Check" data-name="7-Check">
                                    <path d="m79.423 240.755a47.529 47.529 0 0 0 -36.737 77.522l120.73 147.894a43.136 43.136 0 0 0 36.066 16.009c14.654-.787 27.884-8.626 36.319-21.515l250.787-403.892c.041-.067.084-.134.128-.2 2.353-3.613 1.59-10.773-3.267-15.271a13.321 13.321 0 0 0 -19.362 1.343q-.135.166-.278.327l-252.922 285.764a10.961 10.961 0 0 1 -15.585.843l-83.94-76.386a47.319 47.319 0 0 0 -31.939-12.438z" />
                                </g>
                            </svg>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <input type="hidden" name="attribute[<?= $type_attribute ?>]" value="0" data-form-attribute="<?= $type_attribute ?>_input" />
        </div>
<?php }
}   ?>