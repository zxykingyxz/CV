<?php
global $src;
?>
<div class="flex-1 gap-2">
    <div class="">
        <a href="<?= $link ?>" title="<?= $name ?>" class="text-sm font-medium font-main"><?= $name ?></a>
    </div>
    <?php if ($config['cart']['price_attribute']['view_update'] == false || $src == "thanh-toan") {
        $name_attribute = "";
        $number_text = 0;
        if (!empty($attribute)) {
            foreach ($attribute as $k => $v) {
                $items = $db->rawQueryOne("select ten_$lang as ten,type from #_attribute where id_product=? and id=? and type=? ", array($pid, $v, $k));
                if (!empty($options['attribute'])) {
                    foreach ($options['attribute'] as $v_t) {
                        if ($this->returnUnsignedName($v_t) == $items['type']) {
                            if ($number_text != 0) {
                                $name_attribute .= ', ';
                            }
                            $name_attribute .= $v_t . ': ' . $items['ten'];
                            $number_text++;
                        }
                    }
                }
            }
        }
        if (!empty($name_attribute)) {
    ?>
            <span class="mt-1 text-xs font-main font-medium"><?= $name_attribute ?></span>
    <?php }
    } ?>
</div>
<?php if ($config['cart']['price_attribute']['view_update'] == true && ($src != "thanh-toan") && (!empty($options['attribute']))) { ?>
    <div class="f0 grid grid-cols-1 gap-1 ">
        <?php

        foreach ($options['attribute'] as $v_t) {
            $type = $func->returnUnsignedName($v_t);
            $option_check = [];
            if (!empty($attribute[$type]) && (int)($attribute[$type]) != 0) {
                $option_check = $db->rawQueryOne("select id, ten_$lang as ten,type from #_attribute where id_product=? and id=? and type=? ", array($pid, $attribute[$type], $type));
            }
            $option_data = $db->rawQuery("select id, ten_$lang as ten,type from #_attribute where id_product=?  and type=? ", array($pid, $type));

            if (!empty($option_data)) {
        ?>
                <select name="<?= $type ?>" id="<?= $type ?>" class="select_attribute w-[100px] bg-white rounded border border-gray-300 text-[10px] h-[24px] px-1">
                    <option value=""><?= 'Chọn ' . $v_t ?></option>
                    <?php foreach ($option_data as $k => $v) { ?>
                        <option value="<?= $v['id'] ?>" <?= ($option_check['id'] == $v['id']) ? "selected" : "" ?>><?= $v['ten'] ?></option>
                    <?php } ?>
                </select>
        <?php
            }
        }
        ?>
    </div>
<?php } ?>