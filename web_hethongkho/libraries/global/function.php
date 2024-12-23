<?php

#====================watermark============================

$nametype = 'watermark';

$GLOBAL['bannerqc'][$nametype]['title_main'] = 'Hình đóng dấu logo';

$GLOBAL['bannerqc'][$nametype]['title'] = 'Quản lý Hình đóng dấu logo';

$GLOBAL['bannerqc'][$nametype]['full'] = false;

$GLOBAL['bannerqc'][$nametype]['watermark'] = true;

$GLOBAL['bannerqc'][$nametype]['watermark-advanced'] = true;

$GLOBAL['bannerqc'][$nametype]['img'] = true;

$GLOBAL['bannerqc'][$nametype]['img-width'] = 620;

$GLOBAL['bannerqc'][$nametype]['img-height'] = 620;

$GLOBAL['bannerqc'][$nametype]['thumb'] = '620x620x1';

$GLOBAL['bannerqc'][$nametype]['img-ratio'] = 1;

$GLOBAL['bannerqc'][$nametype]['link'] = false;

$GLOBAL['bannerqc'][$nametype]['img_type'] = '.png|.PNG|.Png';

#==============Thuộc tính bộ lọc==============

$nametype = 'muc-gia';

$GLOBAL['baiviet'][$nametype]['title_main'] = 'Mức giá';

$GLOBAL['baiviet'][$nametype]['title'] = 'danh sách Mức giá';

$GLOBAL['baiviet'][$nametype]['property'] = true;

$GLOBAL['baiviet'][$nametype]['full'] = false;

$GLOBAL['baiviet'][$nametype]['max'] = true;

$GLOBAL['baiviet'][$nametype]['min'] = true;

$GLOBAL['baiviet'][$nametype]['check'] = array(

    "hienthi" => "Hiển thị",

);

#==============Thuộc tính bộ lọc==============

$nametype = 'thuong-hieu';

$GLOBAL['baiviet'][$nametype]['title_main'] = 'Thương hiệu';

$GLOBAL['baiviet'][$nametype]['title'] = 'danh sách';

$GLOBAL['baiviet'][$nametype]['property'] = true;

$GLOBAL['baiviet'][$nametype]['full'] = false;

$GLOBAL['baiviet'][$nametype]['check'] = array(

    "hienthi" => "Hiển thị"

);

$GLOBAL['baiviet'][$nametype]['status'] = array();

$GLOBAL['baiviet'][$nametype]['img'] = false;

$GLOBAL['baiviet'][$nametype]['img-width'] = 260;

$GLOBAL['baiviet'][$nametype]['img-height'] = 260;

$GLOBAL['baiviet'][$nametype]['img-ratio'] = 1;

$GLOBAL['baiviet'][$nametype]['link_cano'] = false;

$GLOBAL['baiviet'][$nametype]['schema'] = true;

$GLOBAL['baiviet'][$nametype]['alias'] = true;

$GLOBAL['baiviet'][$nametype]['title-seo'] = true;

$GLOBAL['baiviet'][$nametype]['keywords-seo'] = true;

$GLOBAL['baiviet'][$nametype]['description-seo'] = true;

$GLOBAL['baiviet'][$nametype]['seo'] = false;

$GLOBAL['baiviet'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF|.webp';

$GLOBAL['baiviet'][$nametype]['file_type'] = 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF|xls|XLS';


#==============attribute==============

$nametype = 'thuoc-tinh';

$GLOBAL['attribute'][$nametype]['title_main'] = 'Thuộc tính';

$GLOBAL['attribute'][$nametype]['title'] = 'danh sách';

$GLOBAL['attribute'][$nametype]['full'] = false;

$GLOBAL['attribute'][$nametype]['public'] = false;

$GLOBAL['attribute'][$nametype]['check'] = array(

    "hienthi" => "Hiển thị"

);

$GLOBAL['attribute'][$nametype]['status'] = array();

$GLOBAL['attribute'][$nametype]['img'] = true;

$GLOBAL['attribute'][$nametype]['gia'] = true;

$GLOBAL['attribute'][$nametype]['giacu'] = true;

$GLOBAL['attribute'][$nametype]['giabansale'] = false;

$GLOBAL['attribute'][$nametype]['color'] = true;

$GLOBAL['attribute'][$nametype]['link'] = true;

$GLOBAL['attribute'][$nametype]['video'] = true;

$GLOBAL['attribute'][$nametype]['img-width'] = 380;

$GLOBAL['attribute'][$nametype]['img-height'] = 380;

$GLOBAL['attribute'][$nametype]['img-ratio'] = 2;

$GLOBAL['attribute'][$nametype]['img-gallery'] = true;

$GLOBAL['attribute'][$nametype]['multi-gallery-arr'] = array(

    $nametype => array(

        "title_main_photo" => "Hình ảnh kèm theo",

        "title_sub_photo" => "Hình ảnh",

        "width_photo" => 500,

        "height_photo" => 500,

        "thumb_width_photo" => 500,

        "thumb_height_photo" => 500,

        "thumb_ratio_photo" => 1,

        "img_type_photo" => '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF|.webp'

    )

);

$GLOBAL['attribute'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF|.webp';

$GLOBAL['attribute'][$nametype]['file_type'] = 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF|xls|XLS';


#==============Đánh giá==============

// $nametype = 'danh-gia';

// $GLOBAL['baiviet'][$nametype]['title_main'] = 'Đánh giá';

// $GLOBAL['baiviet'][$nametype]['title'] = 'danh sách';

// $GLOBAL['baiviet'][$nametype]['full'] = false;

// $GLOBAL['baiviet'][$nametype]['check'] = array(

//     "mucluc" => "Mục lục",

//     "hienthi" => "Hiển thị"

// );

// $GLOBAL['baiviet'][$nametype]['img'] = true;

// $GLOBAL['baiviet'][$nametype]['img-width'] = 190;

// $GLOBAL['baiviet'][$nametype]['img-height'] = 290;

// $GLOBAL['baiviet'][$nametype]['img-ratio'] = 1;

// $GLOBAL['baiviet'][$nametype]['rating'] = true;

// $GLOBAL['baiviet'][$nametype]['slogan'] = false;

// $GLOBAL['baiviet'][$nametype]['job'] = true;

// $GLOBAL['baiviet'][$nametype]['mota'] = true;

// $GLOBAL['baiviet'][$nametype]['mota-ckeditor'] = false;

// $GLOBAL['baiviet'][$nametype]['noidung'] = false;

// $GLOBAL['baiviet'][$nametype]['noidung-ckeditor'] = false;

// $GLOBAL['baiviet'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF|.webp';

// $GLOBAL['baiviet'][$nametype]['file_type'] = 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF|xls|XLS';

#========================Mã Giảm Giá==================== 

$nametype = 'ma-giam-gia';

$GLOBAL['coupons'][$nametype]['title_main'] = 'Danh sách Mã giảm giá';

#==============Thuộc tính bộ lọc==============

// $nametype = 'muc-gia';

// $GLOBAL['baiviet'][$nametype]['title_main'] = 'Mức giá';

// $GLOBAL['baiviet'][$nametype]['title'] = 'danh sách Mức giá';

// $GLOBAL['baiviet'][$nametype]['special'] = true;

// $GLOBAL['baiviet'][$nametype]['full'] = false;

// $GLOBAL['baiviet'][$nametype]['max'] = true;

// $GLOBAL['baiviet'][$nametype]['min'] = true;

// $GLOBAL['baiviet'][$nametype]['check'] = array(

//     "hienthi" => "Hiển thị",

// );
