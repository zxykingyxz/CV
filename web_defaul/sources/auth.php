<?php
$class_forms_defaul = 'grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3 ';
$layouts_defaul = "gridTemplateProduct3";
$textButton_defaul = "sản Phẩm";

$authArrs = array(
  '' => [
    'title' => "Trang chủ",
  ],
  'gioi-thieu' => [
    'title' => "Giới Thiệu",
  ],
  'thuong-hieu' => [
    'title' => "Thương Hiệu",
    'level' => true,
    'isCheck' => false,
    'type' => 'POST',
    'class_form_new' => $class_forms_defaul,
    'layouts' => $layouts_defaul,
    'textButton' => $textButton_defaul,
  ],
  'dien-tu' => [
    'title' => "Điện tử",
    'level' => true,
    'isCheck' => false,
    'type' => 'POST',
    'class_form_new' => $class_forms_defaul,
    'layouts' => $layouts_defaul,
    'textButton' => $textButton_defaul,
  ],
  'dien-lanh' => [
    'title' => "Điện lạnh",
    'level' => true,
    'isCheck' => false,
    'type' => 'POST',
    'class_form_new' => $class_forms_defaul,
    'layouts' => $layouts_defaul,
    'textButton' => $textButton_defaul,
  ],
  'do-gia-dung' => [
    'title' => "Đồ Gia Dụng",
    'level' => true,
    'isCheck' => false,
    'type' => 'POST',
    'class_form_new' => $class_forms_defaul,
    'layouts' => $layouts_defaul,
    'textButton' => $textButton_defaul,
  ],
  'hang-trung-bay' => [
    'title' => "Hàng trưng bày",
    'level' => true,
    'isCheck' => false,
    'type' => 'POST',
    'class_form_new' => $class_forms_defaul,
    'layouts' => $layouts_defaul,
    'textButton' => $textButton_defaul,
  ],
  'tin-tuc' => [
    'title' => "Tin Tức",
    'level' => true,
    'isCheck' => false,
    'type' => 'POST',
    'class_form_new' => 'grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2',
    'layouts' => "gridTemplateNews4",
    'textButton' => "bài viết",
  ],
  'lien-he' => [
    'title' => "Liên Hệ",
  ],
  'chinh-sach' => [
    'title' => _chinhsach,
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
  'thuong-hieu',
];
if (!empty($authArrs[$com])) {
  $routers = $authArrs[$com];
}

if (!empty($routers)) {
  extract($routers);
}
