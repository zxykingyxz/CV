<?php if ($count_product['total'] > $per_page_index) { ?>
    <div class="" id="paging_index_<?= $value_dm_c1['id'] ?>">
        <?= $sample->getTemplateLayoutsFor([
            'name_layouts' => 'loadMoreIndex',
            'formHandle' => "product",
            'formItems' => "product_items_index_" . $value_dm_c1['id'],
            'formPaging' => "paging_index_" . $value_dm_c1['id'],
            'total' => $count_product['total'],
            'numberItems' => $per_page_index,
            'pagingCurrent' => 2,
            'layoutsItems' => "gridTemplateProduct2",
            'seoHeading' => "h6",
            'type' => $value_dm_c1['type'],
            'id_list' => $value_dm_c1['id'],
            'id_cat' => "",
            'id_item' => "",
            'id_sub' => "",
            'title' => "sản phẩm",
        ]) ?>
    </div>
<?php } ?>
<script>
    $('body').on('click', '.view__load_index', function() {
        let _this = $(this);
        let page = parseInt(_this.attr('data-page'));
        let layouts = _this.attr('data-layouts');
        let form = _this.attr('data-form');
        let seoheading = _this.attr('data-seoheading');
        let items = parseInt(_this.attr('data-items'));
        let total = parseInt(_this.attr('data-total'));
        let sql = _this.attr('data-sql');
        let formItems = _this.attr('data-form-items');
        let formPaging = _this.attr('data-form-paging');

        $.ajax({
            url: "ajax/default/pagingIndex.php",
            type: 'POST',
            data: {
                form: form,
                page: page,
                layouts: layouts,
                seoheading: seoheading,
                items: items,
                total: total,
                sql: sql,
            },
            dataType: 'JSON',
            beforeSend: function() {
                $('.rp-loader').show();
                _this.hide();
            },
            success: function(data) {
                $('#' + formItems).append(data.html.items);
                $('#' + formPaging).html(data.html.paging);
                $('.rp-loader').hide();
                _this.show();
                _FRAMEWORK.Lazys();
                _FRAMEWORK.loadWesite();
            },
            error: function(data) {},
            complete: function() {}
        });

    });
</script>
<?php
if ($total > 0 && ($total > ($numberItems * ($pagingCurrent - 1)))) {
    $sql = "";
    if (!empty($type)) {
        if (!empty($sql)) {
            $sql .= "|";
        }
        $sql .= $type;
    }
    if (!empty($id_list)) {
        if (!empty($sql)) {
            $sql .= "|";
        }
        $sql .= $id_list;
    }
    if (!empty($id_cat)) {
        if (!empty($sql)) {
            $sql .= "|";
        }
        $sql .= $id_cat;
    }
    if (!empty($id_item)) {
        if (!empty($sql)) {
            $sql .= "|";
        }
        $sql .= $id_item;
    }
    if (!empty($id_sub)) {
        if (!empty($sql)) {
            $sql .= "|";
        }
        $sql .= $id_sub;
    }
    $attr = '';
    if (isset($formHandle)) {
        $attr .= " data-form=" . $formHandle;
    }
    if (isset($pagingCurrent)) {
        $attr .= " data-page=" . $pagingCurrent;
    }
    if (isset($layoutsItems)) {
        $attr .= " data-layouts=" . $layoutsItems;
    }
    if (isset($seoHeading)) {
        $attr .= " data-seoheading=" . $seoHeading;
    }
    if (isset($numberItems)) {
        $attr .= " data-items=" . $numberItems;
    }
    if (isset($total)) {
        $attr .= " data-total=" . $total;
    }
    if (!empty($sql)) {
        $attr .= " data-sql=" . $sql;
    }
    if (!empty($formItems)) {
        $attr .= " data-form-items=" . $formItems;
    }
    if (!empty($formPaging)) {
        $attr .= " data-form-paging=" . $formPaging;
    }
?>
    <div class="flex ">
        <div class=" basis-full flex justify-center mt-4 sm:mt-10 mb-3">
            <a <?= trim($attr) ?> class=' px-8 sm:px-[52px] py-2 rounded  transition-all duration-300 text-white font-main text-sm sm:text-base font-semibold font-main-600 leading-none bg-[var(--html-bg-website)] hover:bg-[var(--html-sc-website)] cursor-pointer flex justify-center items-center gap-2 view__load_index ' title='Xem thêm'>
                <span>
                    <?= "Xem thêm" ?> <span><?= $total - ($numberItems * ($pagingCurrent - 1)) ?></span> <?= $title ?>
                </span>
                <div class="">
                    <i class='fas fa-arrow-right mr-1 '></i>
                </div>
            </a>
            <div class="rp-loader w-[40px] hidden h-[40px] m-auto p-1 animate-[rotate_2s_linear_infinite]">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" style="width: 100%; height: 100%; fill: var(--html-bg-website);">
                    <circle r="80" cx="500" cy="90" style="fill: var(--html-bg-website);"></circle>
                    <circle r="80" cx="500" cy="910" style="fill: var(--html-bg-website);"></circle>
                    <circle r="80" cx="90" cy="500" style="fill: var(--html-bg-website);"></circle>
                    <circle r="80" cx="910" cy="500" style="fill: var(--html-bg-website);"></circle>
                    <circle r="80" cx="212" cy="212" style="fill: var(--html-bg-website);"></circle>
                    <circle r="80" cx="788" cy="212" style="fill: var(--html-bg-website);"></circle>
                    <circle r="80" cx="212" cy="788" style="fill: var(--html-bg-website);"></circle>
                    <circle r="80" cx="788" cy="788" style="fill: var(--html-bg-website);"></circle>
                </svg>
            </div>
        </div>
    </div>
<?php
}
?>