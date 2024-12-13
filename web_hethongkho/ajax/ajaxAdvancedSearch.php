<?php
require_once 'ajaxConfig.php';

if ($func->isAjax()) {

    @$keywords = htmlspecialchars($_POST['value']);

    if (!empty($keywords)) {

        $specialChars = ['=', '+', '@', '#', '$', '^', '&', '*', '(', ')', '[', ']', '{', '}', ';', '\'', '"', '\\', '!', '~', '|', ',', '.', '<', '>', '?', '/'];
        $keywords = str_replace($specialChars, ' ', $keywords);

        $array_kw = explode(' ', $keywords);

        $keywords_sql = '';

        $i = 0;

        foreach ($array_kw as $v) {
            if (!empty($v)) {
                if ($i != 0) {
                    $keywords_sql .= '|';
                }
                $keywords_sql .= $v;
                $i++;
            }
        }

        $where .= " and ((ten_$lang REGEXP '$keywords_sql') or (masp REGEXP '$keywords_sql'))";

        $url_page .= '&keywords=' . $keywords;

        $sql = "SELECT id,type,giaban,giacu,giabansale,ten_$lang as ten,photo,tenkhongdau_$lang as tenkhongdau from #_baiviet where type=? {$where} order by stt asc ";

        $tintuc = $db->rawQuery($sql, array('san-pham'));

        if (!empty($tintuc)) {
?>
            <div class="form_view_product_search">
                <div class="d-grid g-l-1 g-m-1 g-c-1 g10-l g10-m g10-c scroll_form_view_product_search scrollbar-y100">
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
            <div class="form_view_product_search">
                <span style="font-size: 16px; font-weight: 500; color: #000;">
                    Không có sản phẩm...
                </span>
            </div>
<?php
        }
    } else {
    }
};
