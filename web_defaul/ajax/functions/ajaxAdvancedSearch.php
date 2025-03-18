<?php
require_once '../ajaxConfig.php';

if ($func->isAjax()) {

    @$keywords = htmlspecialchars($_POST['value']);

    if (!empty($keywords)) {
        $where .= " and ";
        $where .= $func->getSqlWhereKeywords($keywords, ["ten_$lang", "masp"]);
    }
    $sql = "select id,type,giaban,giacu,ten_$lang as ten,photo,tenkhongdau_$lang as tenkhongdau from #_baiviet where hienthi=1 and type in ('dien-tu','dien-lanh','do-gia-dung','hang-trung-bay') $where order by stt asc ";
    $tintuc = $db->rawQuery($sql, array());

    if (!empty($tintuc)) {
?>
        <div class="absolute top-[calc(100%+5px)] left-0 w-full max-w-[500px] p-3 rounded-lg  bg-white shadow-md shadow-gray-500  z-10">
            <div class="grid grid-cols-1 gap-2 max-h-[clamp(230px,32vw,380px)] pr-1 overflow-y-auto overflow-x-hidden scroll-design-one">
                <?= $sample->getTemplateLayoutsFor([
                    'name_layouts' => 'gridTemplateDefaultMobile',
                    'seoHeading' => 'span',
                    'data' => $tintuc,
                ]); ?>
            </div>
            <div class="bg-white text-center pt-3 ">
                <a href="tim-kiem?keywords=<?= $keywords ?>" title="" class="text-xs font-medium text-gray-300 hover:text-[var(--html-bg-website)] transition-all duration-300">
                    <?= "Có " . count($tintuc) . " Sản Phẩm" ?>
                </a>
            </div>
        </div>
    <?php
    } else {
    ?>
        <div class="absolute top-[calc(100%+5px)] left-0 w-full max-w-[500px] px-3 py-3 rounded-lg  bg-white shadow-md shadow-gray-500  z-10">
            <span class="text-base font-medium font-main-500">
                Không có sản phẩm...
            </span>
        </div>
<?php
    }
};
