<div class="flex-1 gap-2">
    <div class="">
        <a href="<?= $link ?>" title="<?= $name ?>" class="text-sm font-medium font-main"><?= $name ?></a>
    </div>
    <?php
    if ($config['attribute']['view_update'] == false) {
        $name_attribute = "";
        $number_text = 0;
        if (!empty($attribute)) {
            foreach ($attribute as $k => $v) {
                $items = $db->rawQueryOne("select ten_$lang as ten,type from #_attribute where id_product=? and id=? and type=? ", array($pid, $v, $k));
                if (!empty($options['attribute'])) {
                    foreach ($options['attribute'] as $v_t) {
                        if ($func->returnUnsignedName($v_t) == $items['type']) {
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