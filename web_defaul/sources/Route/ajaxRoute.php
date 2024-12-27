<?php

if ($config['layouts']['paging']) {
    $paging = $func->getTemplateLayoutsFor([
        'name_layouts' => 'pagingWeb',
        'total' => $total,
        'page' => $page,
        'per_page' => $per_page,
    ]);
} else {
    if ($total_paging > 0) {
        $paging = $func->getTemplateLayoutsFor([
            'name_layouts' => 'loadMore',
            'total' => $total_paging,
            'options' =>  ['page' => $page],
            'title' => $textButton,
        ]);
    }
}

if ($func->isAjax()) {
    $showLayout = $func->getTemplateLayoutsFor([
        'name_layouts' => $layouts,
        'seoHeading' => 'h3',
        'data' => $tintuc,
    ]);
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
