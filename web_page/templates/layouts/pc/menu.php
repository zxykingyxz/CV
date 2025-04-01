<div class="w-full">
    <div class="">
        <ul class="flex flex-wrap items-center justify-between ">
            <?php foreach ($authArrs as $key => $value) {
                if (!in_array($key, array_merge($notShowMenu, []))) {
            ?>
                    <?= $sample->getTemplateLayoutsFor([
                        'name_layouts' => 'li_menu',
                        'class_form' => '',
                        'title' => (!empty($value['title'])) ? $value['title'] : '',
                        'isCheck' => $value['isCheck'],
                        'level' => $value['level'],
                        'full' => $value['menu_full'],
                        'type' => $key,
                    ]) ?>
            <?php }
            } ?>
        </ul>
    </div>
</div>