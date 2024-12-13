<?php
$class_forms_defaul = "grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-[5px]";
$layouts_defaul = "gridTemplateProduct6";
$textButton_defaul = "sản phẩm";

$authArrs = array(
  // '' => [
  //   'title' => "Trang chủ",
  // ],
  'gioi-thieu' => [
    'title' => "Giới thiệu",
  ],
  // 'gioi-thieu' => [
  //     'title' => "Giới thiệu",
  //     'method' => NULL,
  //     'type' => 'POST'
  // ],

  'san-pham' => [
    'title' => "Sản phẩm",
    'level' => true,
    'isCheck' => false,
    'menu_full' => false,
    'type' => 'POST',
    'class_form_new' => $class_forms_defaul,
    'layouts' => $layouts_defaul,
    'textButton' => $textButton_defaul,


  ],
  'dich-vu' => [
    'title' => "Dịch vụ",
    'level' =>  true,
    'isCheck' => false,
    'type' => 'POST',
    'class_form_new' => 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2 md:gap-5',
    'layouts' => 'gridTemplateNews1',
    'textButton' => 'dịch vụ',
  ],

  'du-an' => [
    'title' => "Dự án",
    'level' => false,
    'isCheck' => false,
    'type' => 'POST',
    'class_form_new' => 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2 md:gap-5',
    'layouts' => 'gridTemplateNews1',
    'textButton' => 'dự án',

  ],
  'mau-nha-tam' => [
    'title' => "Mẫu phòng tắm",
    'level' => false,
    'isCheck' => false,
    'type' => 'POST',
    'class_form_new' => 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2 md:gap-5',
    'layouts' => 'gridTemplateNews1',
    'textButton' => 'mẫu phòng tắm',

  ],
  'tin-tuc' => [
    'title' => "Tin tức",
    'level' => false,
    'isCheck' => false,
    'type' => 'POST',
    'class_form_new' => 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2 md:gap-5',
    'layouts' => 'gridTemplateNews1',
    'textButton' => 'bài viết',

  ],

  'lien-he' => [
    'title' => "Liên Hệ",
  ],
  'chinh-sach' => [
    'title' => _chinhsach,
  ],
  'ho-tro-khach-hang' => [
    'title' => _hotrokhachhang,
    'type' => 'POST'
  ],

  // 'tags' => [
  //     'title' => 'Tags',
  //     'type' => 'POST'
  // ],
  // 'best-seller' => [
  //     'title' => 'Best seller',
  //     'type' => 'POST'
  // ],
  'load' => [
    'title' => _xemthem,
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
  'ho-tro-khach-hang',
  'mau-nha-tam',
  'tags',
  // 'best-seller',
  'tim-kiem',
  'hoat-dong',
  'load'
];
if (!empty($authArrs[$com])) {
  $routers = $authArrs[$com];
}

if (!empty($routers)) {
  extract($routers);
}
