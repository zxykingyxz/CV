<?php

class layouts
{

    public function __construct()
    {
    }
    public function getLoadMore($total, $options = array(), $title = "sản phẩm")
    {
        global $row_setting;
        $html = '';
        if ($total > 0) {
            $html .= $this->markdown('products/loadmore', [
                'total' => $total,
                'per_page' => $row_setting['page_in'],
                'options' => $options,
                'title' => $title
            ]);
        }
        return $html;
    }

    public function getLoadMoreInPage($total, $per_page, $page, $title)
    {
        $html = '';
        if ($total > 0) {
            $html .= "<a class='box_see-more see_more_product_text view__load view__more__page btn-view-index' data-item='{$per_page}' data-page='{$page}'>
                        Xem thêm ({$total}) {$title}  <i class='fa-light fa-chevrons-down ml5'></i>
                    </a>";
        }
        return $html;
    }

    public function markdown($path = '', $params = array())
    {
        $content = '';
        if (!empty($path)) {
            ob_start();
            include _template . "/views/" . $path . ".php";
            $content = ob_get_contents();
            ob_clean();
        }
        return $content;
    }
}
