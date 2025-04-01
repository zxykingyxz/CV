<?php

require_once 'ajaxConfig.php';

$table = $GLOBAL['attribute']['thuoc-tinh'];

@$data_form = htmlspecialchars($_POST['data_form']);

@$type_name = htmlspecialchars($_POST['type']);

@$id_product = htmlspecialchars($_POST['id_product']);

@$id_attribute = htmlspecialchars($_POST['id_attribute']);

@$com = htmlspecialchars($_POST['com']);

$type = $func->returnUnsignedName($type_name);

switch ($data_form) {
    case 'attribute':
?>
        <div class="form_items_attribute_all" style="width: 100%;" data-id-product="<?= $id_product ?>">
            <div class="form_title_attribute_all">
                <div class=" ">
                    <div class="d-flex justify-content-center " style="grid-gap: 5px;">
                        <div class="f1">
                            <input type="text" data-validation="required" data-validation-error-msg="Thuộc tính không được để trống" name="options[attribute][]" title="<?= "Nhập thuộc tính sản phẩm" ?>" class="tipS w100" value="" style="border-radius: .25rem;" />
                        </div>
                        <div class=" btn_attribute_product btn_query_attribute_product justify-content-center align-items-center " style=" display: inline-flex;" data-form="delete_all">
                            <div>
                                <i class="fas fa-trash-alt"></i>
                            </div>
                            <div class="icons_load" style="display: none; padding: 5px;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" style="width: 100%; height: 100%; fill: #fff;">
                                    <circle r="80" cx="500" cy="90" style="fill: #fff;"></circle>
                                    <circle r="80" cx="500" cy="910" style="fill: #fff;"></circle>
                                    <circle r="80" cx="90" cy="500" style="fill: #fff;"></circle>
                                    <circle r="80" cx="910" cy="500" style="fill: #fff;"></circle>
                                    <circle r="80" cx="212" cy="212" style="fill: #fff;"></circle>
                                    <circle r="80" cx="788" cy="212" style="fill: #fff;"></circle>
                                    <circle r="80" cx="212" cy="788" style="fill: #fff;"></circle>
                                    <circle r="80" cx="788" cy="788" style="fill: #fff;"></circle>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <?php if (($config['cart']['price_attribute']['attribute_one_for_all']) == false) { ?>
                <div class="form_footer_attribute_all">
                    <div class="">
                        <label class="title_items_attribute_all">
                            Thêm <?= $type_name ?>
                        </label>
                    </div>
                    <div class="" style="margin-top: 5px;">
                        <div class="form_items_attribute" style="padding:5px;">
                            <div class=" d-flex flex-wrap form-add-ct " style="width: 100%;grid-gap: 5px;">
                            </div>
                            <div class=" btn_attribute_product btn_query_attribute_product bg-gradient-primary justify-content-center align-items-center " style=" display: inline-flex; " data-form="items_attribute">
                                <div>
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div class="icons_load" style="display: none; padding: 5px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" style="width: 100%; height: 100%; fill: #fff;">
                                        <circle r="80" cx="500" cy="90" style="fill: #fff;"></circle>
                                        <circle r="80" cx="500" cy="910" style="fill: #fff;"></circle>
                                        <circle r="80" cx="90" cy="500" style="fill: #fff;"></circle>
                                        <circle r="80" cx="910" cy="500" style="fill: #fff;"></circle>
                                        <circle r="80" cx="212" cy="212" style="fill: #fff;"></circle>
                                        <circle r="80" cx="788" cy="212" style="fill: #fff;"></circle>
                                        <circle r="80" cx="212" cy="788" style="fill: #fff;"></circle>
                                        <circle r="80" cx="788" cy="788" style="fill: #fff;"></circle>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            <?php } ?>
        </div>
        <?php
        break;
    case 'items_attribute':
        if (!empty($type_name)) {
        ?>
            <div class="d-flex flex-wrap form_items_attribute_add w100">
                <div class="w100 d-flex flex-wrap" style="grid-gap: 5px;">
                    <div class="custom-file-container">
                        <label class="">
                            <div class="custom-file-label">
                                Chọn file hình ảnh
                            </div>
                            <div style="width: 100%;margin-top: 5px;">
                                <input type="file" id="file" name="<?= $type ?>[photo][]" class="custom-file-input file-name">
                            </div>
                        </label>
                    </div>
                    <div class="formRow items_add_attribute f1">
                        <label for=""> Tên <?= $type_name ?></label>
                        <input type="text" data-validation="required" data-validation-error-msg="Thuộc tính <?= $type ?> không được để trống" name="<?= $type ?>[ten_<?= $lang ?>][]" title="<?= "Nhập thuộc tính sản phẩm" ?>" class="tipS" value="" style="flex: 1;" />
                    </div>
                    <?php if ($table['gia'] == true) { ?>
                        <div class="formRow items_add_attribute" style="flex: 0;">
                            <label for=""> Giá bán</label>
                            <input type="text" name="<?= $type ?>[giaban][]" title="<?= "Nhập thuộc tính sản phẩm" ?>" class="conso tipS" value="" style="flex: 1;" />
                        </div>
                    <?php } ?>
                    <?php if ($table['giacu'] == true) { ?>
                        <div class="formRow items_add_attribute" style="flex: 0; ">
                            <label for=""> Giá cũ</label>
                            <input type="text" name="<?= $type ?>[giacu][]" title="<?= "Nhập thuộc tính sản phẩm" ?>" class="conso tipS" value="" style="flex: 1;" />
                        </div>
                    <?php } ?>
                    <?php if ($table['giabansale'] == true) { ?>
                        <div class="formRow items_add_attribute" style="flex: 0;">
                            <label for=""> Giá bán sale</label>
                            <input type="text" name="<?= $type ?>[giabansale][]" title="<?= "Nhập thuộc tính sản phẩm" ?>" class="conso tipS" value="" style="flex: 1;" />
                        </div>
                    <?php } ?>
                    <?php if ($table['color'] == true && (in_array($type, ['color', 'mau-sac']))) { ?>
                        <div class="formRow items_add_attribute" style="flex: 0;">
                            <label for=""> Chọn màu</label>
                            <input type="text" name="<?= $type ?>[color][]" title="<?= "Nhập thuộc tính sản phẩm" ?>" class="cp3" value="" style="flex: 1;" />
                        </div>
                    <?php } ?>
                </div>
                <div class="close_items_atribute">
                    <i class="fas fa-times"></i>
                </div>
            </div>
<?php
        };
        break;

    case 'delete_all':
        if (($config['cart']['price_attribute']['attribute_one_for_all']) == true) {
            // xóa setting
            $options_setting = $db->rawQueryOne('select options from #_setting', array());
            $data_attribute_setting = json_decode($options_setting['options'], true);
            foreach ($data_attribute_setting['attribute']  as $k_t => $v_t) {
                if ($v_t == $type_name) {
                    unset($data_attribute_setting['attribute'][$k_t]);
                };
            };

            $data_attribute_setting_json = json_encode($data_attribute_setting, JSON_UNESCAPED_UNICODE);
            $db->rawQueryOne('update #_setting set options = ?', array($data_attribute_setting_json));

            // xóa options sản phẩm
            $items_product = $db->rawQuery("select id,options from #_baiviet where type=?", array('san-pham'));
            foreach ($items_product as $k => $v) {
                $array_options = json_decode($v['options'], true);
                $array_options['attribute'] = $data_attribute_setting['attribute'];
                $array_options = json_encode($array_options, JSON_UNESCAPED_UNICODE);
                $db->rawQueryOne("update #_baiviet set options=? where id=?", array($array_options, $v['id']));
            }
            // xóa attribute
            $db->rawQueryOne("delete from #_attribute where type=?", array($type));
        } else {
            // xóa attribute
            $id_attribute = $db->rawQuery('select id from #_attribute WHERE type = ? and id_product = ? ', array($type, $id_product));
            foreach ($id_attribute as $key => $value) {
                $db->rawQuery('DELETE FROM #_baiviet_photo WHERE type = ? and id_attribute = ? ', array($type, $value['id']));
            }
            $db->rawQuery('DELETE FROM #_attribute WHERE type = ? and id_product = ? ', array($type, $id_product));

            // 
            $options = $db->rawQueryOne('select options from #_baiviet WHERE id = ? ', array($id_product));
            if (!empty($options) && isset($options['options'])) {
                $data_attribute = json_decode($options['options'], true)['attribute'];
            }
            $data_attribute = array_diff($data_attribute, [$type_name]);

            $options_product = array();

            foreach ($data_attribute as $key => $value) {
                $options_product['attribute'][] = $value;
            }

            $options_product = json_encode($options_product, JSON_UNESCAPED_UNICODE);

            $db->rawQueryOne('update #_baiviet set options = ? WHERE id = ? ', array($options_product, $id_product));
        }

        break;

    case 'delete_items':
        $db->rawQuery('DELETE FROM #_baiviet_photo WHERE id_attribute=?', array($id_attribute));

        $info_attribute = $db->rawQuery('select photo,thumb FROM #_attribute WHERE  id=?', array($id_attribute));

        $db->rawQuery('DELETE FROM #_attribute WHERE  id=?', array($id_attribute));

        $func->deleteLink(_upload_baiviet . $info_attribute['photo']);

        $func->deleteLink(_upload_baiviet . $info_attribute['thumb']);

        break;
    default:
}
?>