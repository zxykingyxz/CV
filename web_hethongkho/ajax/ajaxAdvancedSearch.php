<?php
require_once 'ajaxConfig.php';

if ($func->isAjax()) {

    @$keywords = htmlspecialchars($_POST['value']);

    if (!empty($keywords)) {

        $where .= " and " . $func->getSqlWhereKeywords($keywords);
    }
    $url_page .= '&keywords=' . $keywords;

    $sql = "SELECT id,type,giaban,giacu,ten_$lang as ten,photo,tenkhongdau_$lang as tenkhongdau from #_baiviet where type in ('san-pham','dien-tu','dien-lanh','do-gia-dung','hang-trung-bay') {$where} order by stt asc ";

    $tintuc = $db->rawQuery($sql, array());

    if (!empty($tintuc)) {
?>
        <div class="absolute top-[calc(100%+5px)] left-0 w-full max-w-[500px] p-3 rounded-lg  bg-white shadow-md shadow-gray-500  z-10">
            <div class="grid grid-cols-1 gap-2 max-h-[clamp(230px,32vw,380px)] pr-1 overflow-y-auto overflow-x-hidden scroll-y">
                <?= $func->getTemplateLayoutsFor([
                    'name_layouts' => 'gridTemplateDefaultMobile',
                    'seoHeading' => 'span',
                    'data' => $tintuc,
                ]); ?>
            </div>
        </div>
    <?php
    } else {
    ?>
        <div class="absolute top-[calc(100%+5px)] left-0 w-full max-w-[500px] px-3 rounded-lg  bg-white shadow-md shadow-gray-500  z-10">
            <span class="text-base font-medium font-main-500">
                Không có sản phẩm...
            </span>
        </div>
<?php
    }
};
