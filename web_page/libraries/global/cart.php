<?php

// #==============pttt==============

$nametype = 'pttt';

$GLOBAL['baiviet'][$nametype]['title_main'] = 'Phương thức thanh toán';

$GLOBAL['baiviet'][$nametype]['title'] = 'danh sách Phương thức thanh toán';

$GLOBAL['baiviet'][$nametype]['cart'] = true;

$GLOBAL['baiviet'][$nametype]['full'] = false;

$GLOBAL['baiviet'][$nametype]['check'] = array(

    "hienthi" => "Hiển thị"

);

$GLOBAL['baiviet'][$nametype]['tag'] = true;

$GLOBAL['baiviet'][$nametype]['img'] = true;

$GLOBAL['baiviet'][$nametype]['img-width'] = 285;

$GLOBAL['baiviet'][$nametype]['img-height'] = 215;

$GLOBAL['baiviet'][$nametype]['img-ratio'] = 1;

$GLOBAL['baiviet'][$nametype]['mota'] = false;

$GLOBAL['baiviet'][$nametype]['mota-ckeditor'] = true;

$GLOBAL['baiviet'][$nametype]['noidung'] = true;

$GLOBAL['baiviet'][$nametype]['noidung-ckeditor'] = true;

#==============htgh==============

$nametype = 'htgh';

$GLOBAL['baiviet'][$nametype]['title_main'] = 'Hình thức giao hàng';

$GLOBAL['baiviet'][$nametype]['title'] = 'danh sách Hình thức giao hàng';

$GLOBAL['baiviet'][$nametype]['cart'] = true;

$GLOBAL['baiviet'][$nametype]['full'] = false;

$GLOBAL['baiviet'][$nametype]['check'] = array(

    "hienthi" => "Hiển thị"

);

$GLOBAL['baiviet'][$nametype]['tag'] = true;

$GLOBAL['baiviet'][$nametype]['img'] = true;

$GLOBAL['baiviet'][$nametype]['img-width'] = 72;

$GLOBAL['baiviet'][$nametype]['img-height'] = 72;

$GLOBAL['baiviet'][$nametype]['img-ratio'] = 1;

$GLOBAL['baiviet'][$nametype]['mota'] = false;

$GLOBAL['baiviet'][$nametype]['mota-ckeditor'] = false;

$GLOBAL['baiviet'][$nametype]['noidung'] = true;

$GLOBAL['baiviet'][$nametype]['noidung-ckeditor'] = true;


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

$GLOBAL['attribute'][$nametype]['color'] = false;

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
