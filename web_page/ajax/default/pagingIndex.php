<?php
require_once '../ajaxConfig.php';
if ($func->isAjax()) {
    @$form = htmlspecialchars($_POST['form']);
    @$page = htmlspecialchars($_POST['page']);
    @$layouts = htmlspecialchars($_POST['layouts']);
    @$seoheading = htmlspecialchars($_POST['seoheading']);
    @$items = htmlspecialchars($_POST['items']);
    @$total = htmlspecialchars($_POST['total']);
    @$sql = htmlspecialchars($_POST['sql']);
    @$select = htmlspecialchars($_POST['select']);
    @$where = htmlspecialchars($_POST['where']);

    $sql = explode("|", $sql);

    switch ($form) {
        case 'product':
            $orderbyForProduct = $func->getOrderByTypeFor('san-pham');
            $item_start = ($items * ($page - 1));
            $where_sql = " 1 ";
            foreach ($sql as $key => $value) {
                switch ($key) {
                    case 0:
                        $where_sql .= " and type='" . $sql[0] . "'";
                        break;
                    case 1:
                        $where_sql .= " and id_list=" . $sql[1] . "";
                        break;
                    case 2:
                        $where_sql .= " and id_cat=" . $sql[2] . "";
                        break;
                    case 3:
                        $where_sql .= " and id_item=" . $sql[3] . "";
                        break;
                    case 4:
                        $where_sql .= " and id_sub=" . $sql[4] . "";
                        break;
                    default:
                        break;
                }
            }
            $data = $db->rawQuery("select id,type, ten_$lang as ten , tenkhongdau_$lang as tenkhongdau,photo,photo2,giaban,masp,banchay from #_baiviet where ((banchay IS NULL) or (banchay <> 1)) and noibat=1 and $where_sql and hienthi=1 order by stt asc,id desc limit $item_start,$items", array());
            $form_items = "product_items_index_" . $sql[1];
            $form_paging = "paging_index_" . $sql[1];
            $title = "sản phẩm";

            break;
        default:
            break;
    }
    if (!empty($data)) {
        $showLayout = $sample->getTemplateLayoutsFor([
            'name_layouts' => $layouts,
            'seoHeading' => $seoheading,
            'data' => $data,
        ]);
        $paging =  $sample->getTemplateLayoutsFor([
            'name_layouts' => 'loadMoreIndex',
            'formHandle' => $form,
            'formItems' => $form_items,
            'formPaging' =>  $form_paging,
            'total' => $total,
            'numberItems' => $items,
            'pagingCurrent' => $page + 1,
            'layoutsItems' => $layouts,
            'seoHeading' => $seoheading,
            'type' => !empty($sql[0]) ? $sql[0] : "",
            'id_list' => !empty($sql[1]) ? $sql[1] : "",
            'id_cat' => !empty($sql[2]) ? $sql[2] : "",
            'id_item' => !empty($sql[3]) ? $sql[3] : "",
            'id_sub' => !empty($sql[4]) ? $sql[4] : "",
            'title' =>  $title,
        ]);
    }
    echo json_encode([
        'html' => [
            "items" => $showLayout,
            "paging" => $paging,
        ],
        'data' => [
            "total" => $total,
        ]
    ]);
    exit;
}
