<?php
$class_forms_defaul = 'grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4  gap-3 ';
$layouts_defaul = "gridTemplatePosts4";
$textButton_defaul = "sản Phẩm";

$authArrs = array(
  '' => [
    'title' => "Trang chủ",
  ],
  'gioi-thieu' => [
    'title' => "Giới Thiệu",
    'level' => true,
    'isCheck' => true,
    'type' => 'POST',
    'class_form_new' => 'grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2',
    'layouts' => "gridTemplateNews9",
    'textButton' => "bài viết",
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
  'dich-vu' => [
    'title' => "Dịch Vụ",
    'level' => true,
    'isCheck' => false,
    'type' => 'POST',
    'class_form_new' => 'grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2',
    'layouts' => "gridTemplateNews9",
    'textButton' => "bài viết",
  ],
  'du-an' => [
    'title' => "Dự Án",
    'level' => true,
    'isCheck' => false,
    'type' => 'POST',
    'class_form_new' => 'grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2',
    'layouts' => "gridTemplateNews9",
    'textButton' => "bài viết",
  ],
  'tin-tuc' => [
    'title' => "Tin Tức",
    'level' => true,
    'isCheck' => false,
    'type' => 'POST',
    'class_form_new' => 'grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2',
    'layouts' => "gridTemplateNews9",
    'textButton' => "bài viết",
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
