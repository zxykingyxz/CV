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
    <div class="flex w-full ">
        <div class=" basis-full flex justify-center mt-4 sm:mt-10 mb-3">
            <a <?= trim($attr) ?> class=' flex-1 w-full max-w-[300px] px-8 sm:px-[25px] py-2 rounded-lg sm:rounded-xl   transition-all duration-300 text-[var(--html-bg-website)] font-main text-sm sm:text-base font-normal font-main-400 leading-none border border-[var(--html-bg-website)] hover:bg-[var(--html-sc-website)] hover:border-[var(--html-sc-website)] hover:text-white cursor-pointer flex justify-center items-center gap-2 view__load_index ' title='Xem thêm'>
                <span>
                    <?= "Xem thêm" ?>
                </span>
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <path d="M1.82903 8.61973H12.6909L10.656 10.6549C10.0715 11.2395 10.9482 12.1163 11.5328 11.5317L13.3861 9.67537L14.6232 8.43614C14.863 8.19491 14.863 7.80532 14.6232 7.5641L11.5328 4.46972C11.4152 4.34889 11.2533 4.28109 11.0847 4.28249C10.5281 4.28256 10.2549 4.9606 10.656 5.34662L12.6958 7.38178H1.79703C0.939776 7.42432 1.00378 8.66241 1.82903 8.61973Z" fill="currentColor" />
                    </svg>
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