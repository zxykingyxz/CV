<?php
require_once 'ajaxConfig.php';
if ($func->isAjax()) {
    $id_list = isset($_POST['id_list']) ? addslashes($_POST['id_list']) : '';
    $id_product_old = isset($_POST['id_product_old']) ? addslashes($_POST['id_product_old']) : '';
    $price = isset($_POST['price']) ? addslashes($_POST['price']) : 0;
    $sql = "SELECT *,tenkhongdau_$lang as tenkhongdau from #_baiviet where type=? and id_list=? and qty>0 order by stt asc ";
    $tintuc = $db->rawQuery($sql, array('san-pham', $id_list));
    $response = [];
?>
    <?php if (!empty($tintuc)) { ?>
        <?php $response['html'] = $func->getTemplateLayoutsFor([
            'name_layouts' => _views . 'products/gridTemplateProduct10',
            'data' => $tintuc,
        ]); ?>
    <?php } else {
        $response['html'] = '<div class="text-center py-3 text-[20px] font-bold font-main-700 text-[#f00] capitalize">Chưa có sản phẩm</div>';
    } ?>
  
<?php
    $response['id_product_old'] = $id_product_old;
}
echo json_encode($response);
?>