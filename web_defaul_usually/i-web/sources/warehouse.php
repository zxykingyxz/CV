<?php if (!defined('_source')) die("Error");

$folder = _upload_baiviet;

$folder_img = _upload_hinhanh;

switch ($type) {
    case 'account':
        switch ($act) {
            case "man":
                $perPage = 10;
                $startpoint = ($page * $perPage) - $perPage;
                $limit = ' limit ' . $startpoint . ',' . $perPage;
                $where = '#_warehouse_account where 1 ';
                if (in_array($type, ['warehouse'])) {
                    $where .= " and type='san-pham'";
                }
                $keywords =   htmlspecialchars($_GET['keyword']);
                $status =   htmlspecialchars($_GET['status']);
                $category =   htmlspecialchars($_GET['category']);

                if (!empty($keywords)) {
                    $specialChars = ['=', '+', '@', '#', '$', '^', '&', '*', '(', ')', '[', ']', '{', '}', ';', '\'', '"', '\\', '!', '~', '|', ',', '.', '<', '>', '?', '/'];
                    $keywords = str_replace($specialChars, ' ', $keywords);
                    $array_kw = explode(' ', $keywords);
                    $keywords_sql = '';
                    $i_keywords = 0;
                    foreach ($array_kw as $k_keywords => $v_keywords) {
                        if (!empty($v_keywords)) {
                            if ($i_keywords != 0) {
                                $keywords_sql .= '|';
                            }
                            $keywords_sql .= $v_keywords;
                            $i_keywords++;
                        }
                    }
                    $where .= " and ((name REGEXP '$keywords_sql')) ";
                }
                $sql = "select * from {$where} {$limit}";
                $items = $db->rawQuery($sql);
                $url = $func->getCurrentPageURLAdmin();
                $sql = "SELECT COUNT(*) as `num` FROM {$where}";
                $count = $db->rawQueryOne($sql);
                $total = $count['num'];
                $paging = $func->paginationAdmin($total, $perPage, $page, $url);
                $template = "warehouse/items";
                break;
            case "edit":
                $apiProduct->getMan();
                $template = "baiviet/list/item_add";
                break;
            case "save":
                $apiProduct->saveMan();
                break;
            case "delete":
                $apiProduct->deleteMan();
                break;
            default:
                $template = "index";
        }
        break;
    default:
        $template = "index";
        break;
}
