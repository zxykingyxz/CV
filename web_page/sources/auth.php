<?php
$class_forms_defaul = 'grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4  gap-3 ';
$layouts_defaul = "gridTemplateProduct2";
$textButton_defaul = "sản Phẩm";

$authArrs = array(
  '' => [
    'title' => "Trang chủ",
  ],
  'gioi-thieu' => [
    'title' => "Giới Thiệu",
  ],
  'san-pham' => [
    'title' => "Sản Phẩm",
    'level' => true,
    'isCheck' => false,
    'type' => 'POST',
    'class_form_new' => $class_forms_defaul,
    'layouts' => $layouts_defaul,
    'textButton' => $textButton_defaul,
  ],
  'tin-tuc' => [
    'title' => "Tin Tức",
    'level' => false,
    'isCheck' => false,
    'type' => 'POST',
    'class_form_new' => 'grid grid-cols-1 md:grid-cols-2  gap-2',
    'layouts' => "gridTemplateNews6",
    'textButton' => "bài viết",
  ],
  'bo-suu-tap' => [
    'title' => "Bộ Sưu tập",
    'level' => false,
    'isCheck' => false,
    'type' => 'POST',
    'class_form_new' => 'grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2',
    'layouts' => "gridTemplateImages2",
    'textButton' => "bộ",
  ],
  'lien-he' => [
    'title' => "Liên Hệ",
  ],
  'chinh-sach' => [
    'title' => _chinhsach,
    'type' => 'POST',
    'class_form_new' => 'grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2',
    'layouts' => "gridTemplateNews9",
    'textButton' => "bài viết",
  ],
  'tim-kiem' => [
    'title' => _timkiem,
    'class_form_new' => $class_forms_defaul,
    'layouts' => $layouts_defaul,
    'textButton' => $textButton_defaul,
  ],
);

$notShowMenu = [
  'chinh-sach',
  'tim-kiem',
];
if (!empty($authArrs[$com])) {
  $routers = $authArrs[$com];
}

if (!empty($routers)) {
  extract($routers);
}
