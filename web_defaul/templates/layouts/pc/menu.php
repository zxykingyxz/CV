<div class="header-navbar__box">
    <div class="">
        <ul class="flex flex-wrap items-center justify-center gap-[45px]">
            <li class="group/list <?= (($type == '' && $com == 'index')) ? ' active ' : ""; ?>">
                <?php if ($source == 'index') { ?>
                    <h2>
                    <?php } ?>
                    <a href="" rel="dofollow" role="link" aria-label="Trang chủ" title="Trang chủ" class="text-[#474747] group-hover/list:text-[var(--html-cl-website)] group-[&.active]/list:text-[var(--html-cl-website)] ">
                        <i class="fas fa-home text-lg "></i>
                        <span class="hidden">Trang chủ</span>
                    </a>
                    <?php if ($source == 'index') { ?>
                    </h2>
                <?php } ?>
            </li>
            <?php foreach ($authArrs as $key => $value) {
                if (!in_array($key, array_merge($notShowMenu, ["", ""]))) {
            ?>
                    <?= $func->getTemplateLayoutsFor([
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