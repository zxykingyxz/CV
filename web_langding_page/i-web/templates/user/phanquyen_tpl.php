<style>
.wrap-phanquyen>b {
    display: block;
    line-height: 35px;
    font-size: 13px;
    text-transform: uppercase;
    text-align: left;
}

.wrap-phanquyen p {
    border-top: 1px solid #ddd;
    background: #fcfcfc;
    margin: 0;
    clear: both;
}

.wrap-phanquyen .item-phanquyen {
    display: inline-block;
    vertical-align: top;
    line-height: 35px;
    width: 145px;
}

.item-phanquyen div.checker {
    margin: 10px !important
}

.wrap-phanquyen p label {
    display: block;
    float: none !important;
}
</style>
<div class="wrapper">
    <div class="control_frm" style="margin-top:25px;">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a
                        href="index.html?com=permissions&act=add<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Thêm
                            phân quyền</span></a></li>
                <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
    <form name="supplier" id="validate" class="form" action="index.html?com=user&act=save_phanquyen" method="post"
        enctype="multipart/form-data">
        <div class="widget">
            <div class="formRow">
                <div class="formRight">
                    <?php if(count($GLOBAL['baiviet'])>0) { ?>
                    <?php foreach($GLOBAL['baiviet'] as $key => $value) {?>
                    <div class="wrap-phanquyen">
                        <b>Phân quyền <?=$value['title_main']?></b>
                        <?php if($value['list']==true){?>
                        <p><label><b><?=$GLOBAL_LEVEL1['baiviet']['san-pham']['title']?></b></label>
                        <div class="box-phanquyen">
                            <div class="item-phanquyen chontatca">
                                <input type="checkbox" name="" value="">Chọn tất cả
                            </div>
                            <div class="body-check">
                                <div class="item-phanquyen">
                                    <input name="quyen[]" type="checkbox" value="baiviet_man_list_<?=$key?>"
                                        <?php if(in_array('baiviet_man_list_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xem
                                    danh sách
                                </div>
                                <div class="item-phanquyen">
                                    <input name="quyen[]" type="checkbox" value="baiviet_add_list_<?=$key?>"
                                        <?php if(in_array('baiviet_add_list_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Thêm
                                    mới
                                </div>
                                <div class="item-phanquyen">
                                    <input name="quyen[]" type="checkbox" value="baiviet_edit_list_<?=$key?>"
                                        <?php if(in_array('baiviet_edit_list_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Chỉnh
                                    sửa
                                </div>
                                <div class="item-phanquyen">
                                    <input name="quyen[]" type="checkbox" value="baiviet_delete_list_<?=$key?>"
                                        <?php if(in_array('baiviet_delete_list_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xóa
                                </div>
                            </div>
                        </div>
                        </p>
                        <?php }?>
                        <?php if($value['cat']==true){?>
                        <p><label><b><?=$GLOBAL_LEVEL2['baiviet']['san-pham']['title']?></b></label>
                        <div class="box-phanquyen">
                            <div class="item-phanquyen chontatca">
                                <input type="checkbox" name="" value="">Chọn tất cả
                            </div>
                            <div class="body-check">
                                <div class="item-phanquyen">
                                    <input name="quyen[]" type="checkbox" value="baiviet_man_cat_<?=$key?>"
                                        <?php if(in_array('baiviet_man_cat_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xem
                                    danh sách
                                </div>
                                <div class="item-phanquyen">
                                    <input name="quyen[]" type="checkbox" value="baiviet_add_cat_<?=$key?>"
                                        <?php if(in_array('baiviet_add_cat_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Thêm
                                    mới
                                </div>
                                <div class="item-phanquyen">
                                    <input name="quyen[]" type="checkbox" value="baiviet_edit_cat_<?=$key?>"
                                        <?php if(in_array('baiviet_edit_cat_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Chỉnh
                                    sửa
                                </div>
                                <div class="item-phanquyen">
                                    <input name="quyen[]" type="checkbox" value="baiviet_delete_cat_<?=$key?>"
                                        <?php if(in_array('baiviet_delete_cat_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xóa
                                </div>
                            </div>
                        </div>
                        </p>
                        <?php }?>
                        <?php if($value['item']==true){?>
                        <p><label><b><?=$GLOBAL_LEVEL3['baiviet']['san-pham']['title']?></b></label>
                        <div class="box-phanquyen">
                            <div class="item-phanquyen chontatca">
                                <input type="checkbox" name="" value="">Chọn tất cả
                            </div>
                            <div class="body-check">
                                <div class="item-phanquyen">
                                    <input name="quyen[]" type="checkbox" value="baiviet_man_item_<?=$key?>"
                                        <?php if(in_array('baiviet_man_item_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xem
                                    danh sách
                                </div>
                                <div class="item-phanquyen">
                                    <input name="quyen[]" type="checkbox" value="baiviet_add_item_<?=$key?>"
                                        <?php if(in_array('baiviet_add_item_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Thêm
                                    mới
                                </div>
                                <div class="item-phanquyen">
                                    <input name="quyen[]" type="checkbox" value="baiviet_edit_item_<?=$key?>"
                                        <?php if(in_array('baiviet_edit_item_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Chỉnh
                                    sửa
                                </div>
                                <div class="item-phanquyen">
                                    <input name="quyen[]" type="checkbox" value="baiviet_delete_item_<?=$key?>"
                                        <?php if(in_array('baiviet_delete_item_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xóa
                                </div>
                            </div>
                        </div>
                        </p>
                        <?php }?>
                        <?php if($value['mausac']==true) { ?>
                        <p><label><b>Danh mục màu</b></label>
                        <div class="box-phanquyen">
                            <div class="item-phanquyen chontatca">
                                <input type="checkbox" name="" value="">Chọn tất cả
                            </div>
                            <div class="body-check">
                                <div class="item-phanquyen">
                                    <input name="quyen[]" type="checkbox" value="baiviet_man_mau_<?=$key?>"
                                        <?php if(in_array('baiviet_man_mau_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xem
                                    danh sách
                                </div>
                                <div class="item-phanquyen">
                                    <input name="quyen[]" type="checkbox" value="baiviet_add_mau_<?=$key?>"
                                        <?php if(in_array('baiviet_add_mau_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Thêm
                                    mới
                                </div>
                                <div class="item-phanquyen">
                                    <input name="quyen[]" type="checkbox" value="baiviet_edit_mau_<?=$key?>"
                                        <?php if(in_array('baiviet_edit_mau_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Chỉnh
                                    sửa
                                </div>
                                <div class="item-phanquyen">
                                    <input name="quyen[]" type="checkbox" value="baiviet_delete_mau_<?=$key?>"
                                        <?php if(in_array('baiviet_delete_mau_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xóa
                                </div>
                            </div>
                        </div>
                        </p>
                        <?php } ?>
                        <?php if($value['size']==true) { ?>
                        <p><label><b>Danh mục size</b></label>
                        <div class="box-phanquyen">
                            <div class="item-phanquyen chontatca">
                                <input type="checkbox" name="" value="">Chọn tất cả
                            </div>
                            <div class="body-check">
                                <div class="item-phanquyen">
                                    <input name="quyen[]" type="checkbox" value="baiviet_man_size_<?=$key?>"
                                        <?php if(in_array('baiviet_man_size_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xem
                                    danh sách
                                </div>
                                <div class="item-phanquyen">
                                    <input name="quyen[]" type="checkbox" value="baiviet_add_size_<?=$key?>"
                                        <?php if(in_array('baiviet_add_size_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Thêm
                                    mới
                                </div>
                                <div class="item-phanquyen">
                                    <input name="quyen[]" type="checkbox" value="baiviet_edit_size_<?=$key?>"
                                        <?php if(in_array('baiviet_edit_size_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Chỉnh
                                    sửa
                                </div>
                                <div class="item-phanquyen">
                                    <input name="quyen[]" type="checkbox" value="baiviet_delete_size_<?=$key?>"
                                        <?php if(in_array('baiviet_delete_size_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xóa
                                </div>
                            </div>
                        </div>
                        </p>
                        <?php } ?>
                        <p><label><b><?=$value['title_main']?></b></label>
                        <div class="box-phanquyen">
                            <div class="item-phanquyen chontatca">
                                <input type="checkbox" name="" value="">Chọn tất cả
                            </div>
                            <div class="body-check">
                                <div class="item-phanquyen">
                                    <input name="quyen[]" type="checkbox" value="baiviet_man_<?=$key?>"
                                        <?php if(in_array('baiviet_man_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xem
                                    danh sách
                                </div>
                                <div class="item-phanquyen">
                                    <input name="quyen[]" type="checkbox" value="baiviet_add_<?=$key?>"
                                        <?php if(in_array('baiviet_add_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Thêm
                                    mới
                                </div>
                                <div class="item-phanquyen">
                                    <input name="quyen[]" type="checkbox" value="baiviet_edit_<?=$key?>"
                                        <?php if(in_array('baiviet_edit_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Chỉnh
                                    sửa
                                </div>
                                <div class="item-phanquyen">
                                    <input name="quyen[]" type="checkbox" value="baiviet_delete_<?=$key?>"
                                        <?php if(in_array('baiviet_delete_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xóa
                                </div>
                            </div>
                        </div>
                        </p>
                        <?php if($value['import']==true) { ?>
                        <p><label>Import <?=$value['title_main']?></label>
                        <div class="body-check">
                            <div class="item-phanquyen">
                                <input name="quyen[]" type="checkbox" value="excel_import_<?=$key?>"
                                    <?php if(in_array('excel_import_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Cập
                                nhật
                            </div>
                        </div>
                        </p>
                        <?php } ?>
                        <?php if($value['export']==true) { ?>
                        <p><label>Export <?=$value['title_main']?></label>
                        <div class="body-check">
                            <div class="item-phanquyen">
                                <input name="quyen[]" type="checkbox" value="excel_export_<?=$key?>"
                                    <?php if(in_array('excel_export_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xuất
                                file
                            </div>
                        </div>
                        </p>
                        <?php } ?>
                    </div>
                    <?php }?>
                    <?php }?>
                    <?php if(count($GLOBAL['search'])>0) { ?>
                    <div class="wrap-phanquyen">
                        <b>Phân quyền tìm kiếm</b>
                        <?php foreach($GLOBAL['search'] as $key => $value) { ?>
                        <p><label><b><?=$value['title_main']?></b></label>
                        <div class="box-phanquyen">
                            <div class="item-phanquyen chontatca">
                                <input type="checkbox" name="" value="">Chọn tất cả
                            </div>
                            <div class="body-check">
                                <div class="item-phanquyen">
                                    <input name="quyen[]" type="checkbox" value="search_man_<?=$key?>"
                                        <?php if(in_array('search_man_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xem
                                    danh sách
                                </div>
                                <div class="item-phanquyen">
                                    <input name="quyen[]" type="checkbox" value="search_add_<?=$key?>"
                                        <?php if(in_array('search_add_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Thêm
                                    mới
                                </div>
                                <div class="item-phanquyen">
                                    <input name="quyen[]" type="checkbox" value="search_edit_<?=$key?>"
                                        <?php if(in_array('search_edit_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Chỉnh
                                    sửa
                                </div>
                                <div class="item-phanquyen">
                                    <input name="quyen[]" type="checkbox" value="search_delete_<?=$key?>"
                                        <?php if(in_array('search_delete_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xóa
                                </div>
                            </div>
                        </div>
                        </p>
                        <?php }?>
                    </div>
                    <?php }?>
                    <?php if($ORDER==true) { ?>
                    <div class="wrap-phanquyen">
                        <b>Phân quyền giỏ hàng</b>
                        <p><label><b>Giỏ hàng</b></label>
                        <div class="box-phanquyen">
                            <div class="item-phanquyen chontatca">
                                <input type="checkbox" name="" value="">Chọn tất cả
                            </div>
                            <div class="body-check">
                                <div class="item-phanquyen">
                                    <input name="quyen[]" type="checkbox" value="order_man"
                                        <?php if(in_array('order_man', $ds_quyen)) echo 'checked="checked"'; ?>>Xem danh
                                    sách
                                </div>
                                <div class="item-phanquyen">
                                    <input name="quyen[]" type="checkbox" value="order_edit"
                                        <?php if(in_array('order_edit', $ds_quyen)) echo 'checked="checked"'; ?>>Chỉnh
                                    sửa
                                </div>
                                <div class="item-phanquyen">
                                    <input name="quyen[]" type="checkbox" value="order_delete"
                                        <?php if(in_array('order_delete', $ds_quyen)) echo 'checked="checked"'; ?>>Xóa
                                </div>
                            </div>
                        </div>
                        </p>
                        <?php }?>
                        <?php if(count($GLOBAL['info'])>0) { ?>
                        <div class="wrap-phanquyen">
                            <b>Phân quyền trang tĩnh</b>
                            <?php foreach($GLOBAL['info'] as $key => $value) { ?>
                            <p><label><b><?=$value['title_main']?></b></label>
                            <div class="box-phanquyen">
                                <div class="item-phanquyen chontatca">
                                    <input type="checkbox" name="" value="">Chọn tất cả
                                </div>
                                <div class="body-check">
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="info_capnhat_<?=$key?>"
                                            <?php if(in_array('info_capnhat_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xem
                                        danh sách
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="info_edit_<?=$key?>"
                                            <?php if(in_array('info_edit_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Chỉnh
                                        sửa
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="info_delete_<?=$key?>"
                                            <?php if(in_array('info_delete_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xóa
                                    </div>
                                </div>
                            </div>
                            </p>
                            <?php }?>
                        </div>
                        <?php }?>
                        <?php if(count($GLOBAL['photo'])>0) { ?>
                        <div class="wrap-phanquyen">
                            <b>Phân quyền hình ảnh</b>
                            <?php foreach($GLOBAL['photo'] as $key => $value) { ?>
                            <p><label><b><?=$value['title_main']?></b></label>
                            <div class="box-phanquyen">
                                <div class="item-phanquyen chontatca">
                                    <input type="checkbox" name="" value="">Chọn tất cả
                                </div>
                                <div class="body-check">
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="photo_man_photo_<?=$key?>"
                                            <?php if(in_array('photo_man_photo_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xem
                                        danh sách
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="photo_add_photo_<?=$key?>"
                                            <?php if(in_array('photo_add_photo_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Thêm
                                        mới
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="photo_edit_photo_<?=$key?>"
                                            <?php if(in_array('photo_edit_photo_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Chỉnh
                                        sửa
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="photo_delete_photo_<?=$key?>"
                                            <?php if(in_array('photo_delete_photo_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xóa
                                    </div>
                                </div>
                            </div>
                            </p>
                            <?php }?>
                        </div>

                        <?php }?>
                        <?php if(count($GLOBAL['album'])>0) { ?>
                        <?php foreach($GLOBAL['album'] as $key => $value) { ?>
                        <div class="wrap-phanquyen">
                            <b>Phân quyền album</b>
                            <?php if($value['list']==true){?>
                            <p><label><b><?=$GLOBAL_LEVEL1['album']['album']['title']?></b></label>
                            <div class="box-phanquyen">
                                <div class="item-phanquyen chontatca">
                                    <input type="checkbox" name="" value="">Chọn tất cả
                                </div>
                                <div class="body-check">
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="album_man_list_<?=$key?>"
                                            <?php if(in_array('album_man_list_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xem
                                        danh sách
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="album_add_list_<?=$key?>"
                                            <?php if(in_array('album_add_list_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Thêm
                                        mới
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="album_edit_list_<?=$key?>"
                                            <?php if(in_array('album_edit_list_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Chỉnh
                                        sửa
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="album_delete_list_<?=$key?>"
                                            <?php if(in_array('album_delete_list_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xóa
                                    </div>
                                </div>
                            </div>
                            </p>
                            <?php }?>
                            <p><label><b><?=$value['title_main']?></b></label>
                            <div class="box-phanquyen">
                                <div class="item-phanquyen chontatca">
                                    <input type="checkbox" name="" value="">Chọn tất cả
                                </div>
                                <div class="body-check">
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="album_man_<?=$key?>"
                                            <?php if(in_array('album_man_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xem
                                        danh sách
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="album_add_<?=$key?>"
                                            <?php if(in_array('album_add_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Thêm
                                        mới
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="album_edit_<?=$key?>"
                                            <?php if(in_array('album_edit_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Chỉnh
                                        sửa
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="album_delete_<?=$key?>"
                                            <?php if(in_array('album_delete_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xóa
                                    </div>
                                </div>
                            </div>
                            </p>
                        </div>
                        <?php }?>
                        <?php }?>
                        <?php if(count($GLOBAL['bannerqc'])>0) { ?>
                        <div class="wrap-phanquyen">
                            <b>Phân quyền hình ảnh tĩnh</b>
                            <?php foreach($GLOBAL['bannerqc'] as $key => $value) { ?>
                            <p><label><b><?=$value['title_main']?></b></label>
                            <div class="box-phanquyen">
                                <div class="item-phanquyen chontatca">
                                    <input type="checkbox" name="" value="">Chọn tất cả
                                </div>
                                <div class="body-check">
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="bannerqc_capnhat_<?=$key?>"
                                            <?php if(in_array('bannerqc_capnhat_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xem
                                        danh sách
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="bannerqc_add_<?=$key?>"
                                            <?php if(in_array('bannerqc_add_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Thêm
                                        mới
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="bannerqc_edit_<?=$key?>"
                                            <?php if(in_array('bannerqc_edit_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Chỉnh
                                        sửa
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="bannerqc_delete_<?=$key?>"
                                            <?php if(in_array('bannerqc_delete_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xóa
                                    </div>
                                </div>
                            </div>
                            </p>
                            <?php }?>
                        </div>
                        <?php }?>
                        <?php if(count($GLOBAL['video'])>0) { ?>
                        <?php foreach($GLOBAL['video'] as $key => $value) { ?>
                        <div class="wrap-phanquyen">
                            <b>Phân quyền video</b>
                            <p><label><b><?=$value['title_main']?></b></label>
                            <div class="box-phanquyen">
                                <div class="item-phanquyen chontatca">
                                    <input type="checkbox" name="" value="">Chọn tất cả
                                </div>
                                <div class="body-check">
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="video_man_<?=$key?>"
                                            <?php if(in_array('video_man_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xem
                                        danh sách
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="video_add_<?=$key?>"
                                            <?php if(in_array('video_add_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Thêm
                                        mới
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="video_edit_<?=$key?>"
                                            <?php if(in_array('video_edit_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Chỉnh
                                        sửa
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="video_delete_<?=$key?>"
                                            <?php if(in_array('video_delete_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xóa
                                    </div>
                                </div>
                            </div>
                            </p>
                        </div>
                        <?php }?>
                        <?php }?>
                        <?php if(count($GLOBAL['member'])>0) { ?>
                        <div class="wrap-phanquyen">
                            <b>Phân quyền thành viên</b>
                            <?php foreach($GLOBAL['member'] as $key => $value) { ?>
                            <p><label><b><?=$value['title_main']?></b></label>
                            <div class="box-phanquyen">
                                <div class="item-phanquyen chontatca">
                                    <input type="checkbox" name="" value="">Chọn tất cả
                                </div>
                                <div class="body-check">
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="member_man_<?=$key?>"
                                            <?php if(in_array('member_man_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xem
                                        danh sách
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="member_add_<?=$key?>"
                                            <?php if(in_array('member_add_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Thêm
                                        mới
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="member_edit_<?=$key?>"
                                            <?php if(in_array('member_edit_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Chỉnh
                                        sửa
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="member_delete_<?=$key?>"
                                            <?php if(in_array('newsletter_delete_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xóa
                                    </div>
                                </div>
                            </div>
                            </p>
                            <?php }?>
                        </div>
                        <?php }?>
                        <?php if($CONTACT==true) { ?>
                        <div class="wrap-phanquyen">
                            <b>Phân quyền đăng ký liên hệ</b>
                            <p><label><b>Contact</b></label>
                            <div class="box-phanquyen">
                                <div class="item-phanquyen chontatca">
                                    <input type="checkbox" name="" value="">Chọn tất cả
                                </div>
                                <div class="body-check">
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="contact_man"
                                            <?php if(in_array('contact_man', $ds_quyen)) echo 'checked="checked"'; ?>>Xem
                                        danh sách
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="contact_add"
                                            <?php if(in_array('contact_add', $ds_quyen)) echo 'checked="checked"'; ?>>Thêm
                                        mới
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="contact_edit"
                                            <?php if(in_array('contact_edit', $ds_quyen)) echo 'checked="checked"'; ?>>Chỉnh
                                        sửa
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="contact_delete"
                                            <?php if(in_array('contact_delete', $ds_quyen)) echo 'checked="checked"'; ?>>Xóa
                                    </div>
                                </div>
                            </div>
                            </p>
                        </div>
                        <?php }?>
                        <?php if(count($GLOBAL['newsletter'])>0) { ?>
                        <div class="wrap-phanquyen">
                            <b>Phân quyền đăng ký nhận tin</b>
                            <?php foreach($GLOBAL['newsletter'] as $key => $value) { ?>
                            <p><label><b><?=$value['title_main']?></b></label>
                            <div class="box-phanquyen">
                                <div class="item-phanquyen chontatca">
                                    <input type="checkbox" name="" value="">Chọn tất cả
                                </div>
                                <div class="body-check">
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="newsletter_man_<?=$key?>"
                                            <?php if(in_array('newsletter_man_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xem
                                        danh sách
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="newsletter_add_<?=$key?>"
                                            <?php if(in_array('newsletter_add_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Thêm
                                        mới
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="newsletter_edit_<?=$key?>"
                                            <?php if(in_array('newsletter_edit_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Chỉnh
                                        sửa
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="newsletter_delete_<?=$key?>"
                                            <?php if(in_array('newsletter_delete_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xóa
                                    </div>
                                </div>
                            </div>
                            </p>
                            <?php }?>
                        </div>
                        <?php }?>
                        <?php if(count($GLOBAL['booking'])>0) { ?>
                        <div class="wrap-phanquyen">
                            <b>Phân quyền booking</b>
                            <?php foreach($GLOBAL['booking'] as $key => $value) { ?>
                            <p><label><b><?=$value['title_main']?></b></label>
                            <div class="box-phanquyen">
                                <div class="item-phanquyen chontatca">
                                    <input type="checkbox" name="" value="">Chọn tất cả
                                </div>
                                <div class="body-check">
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="booking_man_<?=$key?>"
                                            <?php if(in_array('booking_man_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xem
                                        danh sách
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="booking_add_<?=$key?>"
                                            <?php if(in_array('booking_add_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Thêm
                                        mới
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="booking_edit_<?=$key?>"
                                            <?php if(in_array('booking_edit_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Chỉnh
                                        sửa
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="booking_delete_<?=$key?>"
                                            <?php if(in_array('booking_delete_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xóa
                                    </div>
                                </div>
                            </div>
                            </p>
                            <?php }?>
                        </div>
                        <?php }?>
                        <?php if($COIN==true) { ?>
                        <div class="wrap-phanquyen">
                            <b>Phân quyền điểm thưởng</b>
                            <p><label><b>Điểm thưởng</b></label>
                            <div class="box-phanquyen">
                                <div class="item-phanquyen chontatca">
                                    <input type="checkbox" name="" value="">Chọn tất cả
                                </div>
                                <div class="body-check">
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="coin_man"
                                            <?php if(in_array('coin_man', $ds_quyen)) echo 'checked="checked"'; ?>>Xem
                                        danh sách
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="coin_add"
                                            <?php if(in_array('coin_add', $ds_quyen)) echo 'checked="checked"'; ?>>Thêm
                                        mới
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="coin_edit"
                                            <?php if(in_array('coin_edit', $ds_quyen)) echo 'checked="checked"'; ?>>Chỉnh
                                        sửa
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="coin_delete"
                                            <?php if(in_array('coin_delete', $ds_quyen)) echo 'checked="checked"'; ?>>Xóa
                                    </div>
                                </div>
                            </div>
                            </p>
                        </div>
                        <?php }?>
                        <?php if(count($GLOBAL['company'])>0) { ?>
                        <div class="wrap-phanquyen">
                            <b>Phân quyền liên hệ</b>
                            <?php foreach($GLOBAL['company'] as $key => $value) { ?>
                            <p><label><b><?=$value['title_main']?></b></label>
                            <div class="box-phanquyen">
                                <div class="item-phanquyen chontatca">
                                    <input type="checkbox" name="" value="">Chọn tất cả
                                </div>
                                <div class="body-check">
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="company_capnhat_<?=$key?>"
                                            <?php if(in_array('company_capnhat_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xem
                                        danh sách
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="company_add_<?=$key?>"
                                            <?php if(in_array('company_add_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Thêm
                                        mới
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="company_edit_<?=$key?>"
                                            <?php if(in_array('company_edit_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Chỉnh
                                        sửa
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="company_delete_<?=$key?>"
                                            <?php if(in_array('company_delete_'.$key, $ds_quyen)) echo 'checked="checked"'; ?>>Xóa
                                    </div>
                                </div>
                            </div>
                            </p>
                            <?php }?>
                        </div>
                        <?php }?>
                        <div class="wrap-phanquyen">
                            <b>Phân quyền admin</b>
                            <p><label><b>Thiết lập phân quyền</b></label>
                                <div class="box-phanquyen">
                                    <div class="item-phanquyen chontatca">
                                        <input type="checkbox" name="" value="">Chọn tất cả
                                    </div>
                                    <div class="body-check">
                                        <div class="item-phanquyen">
                                            <input name="quyen[]" type="checkbox" value="user_man"
                                                <?php if(in_array('user_man', $ds_quyen)) echo 'checked="checked"'; ?>>Xem danh sách
                                        </div>
                                        <div class="item-phanquyen">
                                            <input name="quyen[]" type="checkbox" value="user_act"
                                                <?php if(in_array('user_act', $ds_quyen)) echo 'checked="checked"'; ?>>Sửa thành viên
                                        </div>
                                        <div class="item-phanquyen">
                                            <input name="quyen[]" type="checkbox" value="user_delete"
                                                <?php if(in_array('user_delete', $ds_quyen)) echo 'checked="checked"'; ?>>Xóa thành viên
                                        </div>
                                        <div class="item-phanquyen">
                                            <input name="quyen[]" type="checkbox" value="permissions_phanquyen"
                                                <?php if(in_array('permissions_phanquyen', $ds_quyen)) echo 'checked="checked"'; ?>>
                                            Xem phân quyền
                                        </div>
                                        <div class="item-phanquyen">
                                            <input name="quyen[]" type="checkbox" value="permissions_save_phanquyen"
                                                <?php if(in_array('permissions_save_phanquyen', $ds_quyen)) echo 'checked="checked"'; ?>>
                                            Sửa phân quyền
                                        </div>
                                    </div>
                                </div>
                            </p>
                        </div>
                        <div class="wrap-phanquyen">
                            <b>Phân quyền thiết lập hệ thống</b>
                            <p><label><b>Thiết lập thông tin</b></label>
                            <div class="item-phanquyen">
                                <input name="quyen[]" type="checkbox" value="setting_capnhat"
                                    <?php if(in_array('setting_capnhat', $ds_quyen)) echo 'checked="checked"'; ?>>Chỉnh
                                sửa
                            </div>
                            </p>
                        </div>
                        <?php if($GLOBAL_LANG==true) { ?>
                        <div class="wrap-phanquyen">
                            <b>Phân quyền ngôn ngữ</b>
                            <p><label><b>Ngôn ngữ</b></label>
                            <div class="box-phanquyen">
                                <div class="item-phanquyen chontatca">
                                    <input type="checkbox" name="" value="">Chọn tất cả
                                </div>
                                <div class="body-check">
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="ngonngu_man_lang"
                                            <?php if(in_array('ngonngu_man_lang', $ds_quyen)) echo 'checked="checked"'; ?>>Xem
                                        danh sách
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="ngonngu_add_lang"
                                            <?php if(in_array('ngonngu_add', $ds_quyen)) echo 'checked="checked"'; ?>>Thêm
                                        mới
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="ngonngu_edit_lang"
                                            <?php if(in_array('ngonngu_edit', $ds_quyen)) echo 'checked="checked"'; ?>>Chỉnh
                                        sửa
                                    </div>
                                    <div class="item-phanquyen">
                                        <input name="quyen[]" type="checkbox" value="ngonngu_delete_lang"
                                            <?php if(in_array('ngonngu_delete', $ds_quyen)) echo 'checked="checked"'; ?>>Xóa
                                    </div>
                                </div>
                            </div>
                            </p>
                        </div>
                        <?php }?>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="widget">
                <div class="formRow">
                    <div class="formRight">
                        <input type="hidden" name="type" id="id_this_type" value="<?=$_REQUEST['type']?>" />
                        <input type="hidden" name="id" id="id_this_post" value="<?=@$item['id']?>" />
                        <input type="submit" class="blueB" onclick="TreeFilterChanged2(); return false;"
                            value="Hoàn tất" />
                        <a href="index.html?com=user&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"
                            onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title=""
                            class="button tipS" original-title="Thoát">Thoát</a>
                    </div>
                    <div class="clear"></div>
                </div>

            </div>
    </form>
</div>